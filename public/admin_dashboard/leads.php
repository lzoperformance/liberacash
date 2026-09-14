<?php
require_once __DIR__ . '/auth.php'; // já deixa $pdo pronto
require_once __DIR__ . '/../produtos-config.php';
require_once __DIR__ . '/_leads_filtro.php';

$dataInicio = $_GET['de'] ?? '';
$dataFim = $_GET['ate'] ?? '';
$produtoFiltro = $_GET['produto'] ?? '';
$busca = trim($_GET['busca'] ?? '');
$pagina = max(1, (int)($_GET['pagina'] ?? 1));
$porPagina = 50;

$filtro = lc_montar_filtro_leads($_GET);
$whereSql = $filtro['where'];
$params = $filtro['params'];

$totalLeads = (int)(function () use ($pdo, $whereSql, $params) {
    $stmt = $pdo->prepare(
        "SELECT COUNT(*) FROM usuarios u LEFT JOIN perfil_usuario p ON p.user_id = u.id WHERE $whereSql"
    );
    $stmt->execute($params);
    return $stmt->fetchColumn();
})();

$totalPaginas = max(1, (int)ceil($totalLeads / $porPagina));
$pagina = min($pagina, $totalPaginas);
$offset = ($pagina - 1) * $porPagina;

$sql = "SELECT u.id, u.nome, u.cpf, u.email, u.celular, u.criado_em,
               p.cidade, p.estado, p.produto_interesse, p.renda_mensal, p.negativado, p.fonte_renda,
               (SELECT COUNT(*) FROM historico_solicitacoes h WHERE h.user_id = u.id) AS ofertas
        FROM usuarios u
        LEFT JOIN perfil_usuario p ON p.user_id = u.id
        WHERE $whereSql
        ORDER BY u.criado_em DESC
        LIMIT $porPagina OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$leads = $stmt->fetchAll();

$produtosDisponiveis = get_products_ordered();

function lc_fmt_moeda($valor)
{
    if ($valor === null || $valor === '') return '—';
    return 'R$ ' . number_format((float)$valor, 2, ',', '.');
}

function lc_nome_produto($slug)
{
    if (!$slug) return '—';
    $p = get_product_by_slug($slug);
    return $p['nome'] ?? $slug;
}

// Monta a query string atual (sem "pagina") pra reusar nos links de paginação e no export
$qs = $_GET;
unset($qs['pagina']);
$qsBase = http_build_query($qs);

function lc_badge_negativado($valor)
{
    if ($valor === 'sim') return '<span class="lc-badge pending">Sim</span>';
    if ($valor === 'nao') return '<span class="lc-badge success">Não</span>';
    if ($valor === 'nao_sei') return '<span class="lc-badge warning">Não sabe</span>';
    return '<span class="lc-badge neutral">—</span>';
}

$pageTitle = 'Leads';
$pageSubtitle = number_format($totalLeads, 0, ',', '.') . ' encontrados com esses filtros';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Leads | Dashboard - LiberaCash</title>
<meta name="robots" content="noindex, nofollow">
<?php include __DIR__ . '/_estilo.php'; ?>
</head>
<?php include __DIR__ . '/_shell_top.php'; ?>

<div class="lc-card">
    <form method="GET" class="lc-filters">
        <div class="lc-fgroup">
            <label for="de">De</label>
            <input type="date" id="de" name="de" value="<?php echo htmlspecialchars($dataInicio, ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <div class="lc-fgroup">
            <label for="ate">Até</label>
            <input type="date" id="ate" name="ate" value="<?php echo htmlspecialchars($dataFim, ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <div class="lc-fgroup">
            <label for="produto">Produto de interesse</label>
            <select id="produto" name="produto">
                <option value="">Todos</option>
                <?php foreach ($produtosDisponiveis as $p): ?>
                    <option value="<?php echo htmlspecialchars($p['slug'], ENT_QUOTES, 'UTF-8'); ?>" <?php echo $produtoFiltro === $p['slug'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($p['nome'], ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="lc-fgroup" style="flex-grow:1; min-width:200px;">
            <label for="busca">Nome, e-mail ou CPF</label>
            <input type="text" id="busca" name="busca" placeholder="Buscar..." value="<?php echo htmlspecialchars($busca, ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <button type="submit" class="lc-btn lc-btn-dark"><i data-lucide="filter" style="width:16px;height:16px;"></i> Filtrar</button>
        <?php if ($dataInicio || $dataFim || $produtoFiltro || $busca): ?>
            <a class="lc-btn lc-btn-secondary" href="/admin_dashboard/leads.php">Limpar</a>
        <?php endif; ?>
        <a class="lc-btn lc-btn-primary" style="margin-left:auto;" href="/admin_dashboard/leads-export.php?<?php echo htmlspecialchars($qsBase, ENT_QUOTES, 'UTF-8'); ?>"><i data-lucide="file-down" style="width:16px;height:16px;"></i> Exportar Excel</a>
    </form>
</div>

<div class="lc-card">
    <div class="lc-table-wrap">
    <table class="lc-table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Contato</th>
                <th>Cidade/UF</th>
                <th>Produto</th>
                <th>Renda</th>
                <th>Negativado</th>
                <th>Ofertas</th>
                <th>Cadastro</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($leads)): ?>
                <tr><td colspan="8" class="lc-empty-row">Nenhum lead encontrado com esses filtros.</td></tr>
            <?php else: foreach ($leads as $l): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($l['nome'], ENT_QUOTES, 'UTF-8'); ?></strong><br><span style="color:var(--text-subtle);font-size:11.5px;">CPF <?php echo htmlspecialchars($l['cpf'], ENT_QUOTES, 'UTF-8'); ?></span></td>
                    <td><?php echo htmlspecialchars($l['email'], ENT_QUOTES, 'UTF-8'); ?><br><span style="color:var(--text-subtle);font-size:11.5px;"><?php echo htmlspecialchars($l['celular'], ENT_QUOTES, 'UTF-8'); ?></span></td>
                    <td><?php echo $l['cidade'] ? htmlspecialchars($l['cidade'] . '/' . $l['estado'], ENT_QUOTES, 'UTF-8') : '—'; ?></td>
                    <td><?php echo htmlspecialchars(lc_nome_produto($l['produto_interesse']), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo lc_fmt_moeda($l['renda_mensal']); ?></td>
                    <td><?php echo lc_badge_negativado($l['negativado']); ?></td>
                    <td><?php echo (int)$l['ofertas']; ?></td>
                    <td><?php echo date('d/m/Y H:i', strtotime($l['criado_em'])); ?></td>
                </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>
    </div>
</div>

<?php if ($totalPaginas > 1): ?>
<div class="lc-pagination">
    <?php for ($p = 1; $p <= $totalPaginas; $p++): ?>
        <?php if ($p === $pagina): ?>
            <span class="current"><?php echo $p; ?></span>
        <?php else: ?>
            <a href="?<?php echo htmlspecialchars($qsBase, ENT_QUOTES, 'UTF-8'); ?>&pagina=<?php echo $p; ?>"><?php echo $p; ?></a>
        <?php endif; ?>
    <?php endfor; ?>
</div>
<?php endif; ?>

<?php include __DIR__ . '/_shell_bottom.php'; ?>
