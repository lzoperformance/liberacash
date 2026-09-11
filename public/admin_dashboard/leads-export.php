<?php
/**
 * leads-export.php
 * Exporta os leads filtrados como .xls. Usa o truque clássico de servir
 * uma tabela HTML com Content-Type do Excel — abre perfeitamente no
 * Excel/Google Sheets/Numbers, sem precisar de nenhuma biblioteca extra
 * (esse projeto não usa Composer/PhpSpreadsheet).
 */

require_once __DIR__ . '/auth.php'; // já deixa $pdo pronto
require_once __DIR__ . '/../produtos-config.php';
require_once __DIR__ . '/_leads_filtro.php';

$filtro = lc_montar_filtro_leads($_GET);

$sql = "SELECT u.nome, u.cpf, u.email, u.celular, u.criado_em,
               p.cidade, p.estado, p.produto_interesse, p.renda_mensal,
               p.negativado, p.fonte_renda, p.possui_cartao,
               (SELECT COUNT(*) FROM historico_solicitacoes h WHERE h.user_id = u.id) AS ofertas
        FROM usuarios u
        LEFT JOIN perfil_usuario p ON p.user_id = u.id
        WHERE {$filtro['where']}
        ORDER BY u.criado_em DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($filtro['params']);
$leads = $stmt->fetchAll();

function lc_nome_produto_export($slug)
{
    if (!$slug) return '';
    $p = get_product_by_slug($slug);
    return $p['nome'] ?? $slug;
}

header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment; filename="leads-liberacash-' . date('Y-m-d') . '.xls"');
echo "\xEF\xBB\xBF"; // BOM UTF-8, pra acentuação abrir certo no Excel
?>
<table border="1">
<thead>
<tr>
<th>Nome</th><th>CPF</th><th>E-mail</th><th>Celular</th><th>Cidade</th><th>UF</th>
<th>Produto de interesse</th><th>Renda mensal</th><th>Negativado</th><th>Fonte de renda</th>
<th>Possui cartão</th><th>Ofertas recebidas</th><th>Cadastrado em</th>
</tr>
</thead>
<tbody>
<?php foreach ($leads as $l): ?>
<tr>
<td><?php echo htmlspecialchars($l['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo htmlspecialchars($l['cpf'], ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo htmlspecialchars($l['email'], ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo htmlspecialchars($l['celular'], ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo htmlspecialchars($l['cidade'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo htmlspecialchars($l['estado'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo htmlspecialchars(lc_nome_produto_export($l['produto_interesse']), ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo $l['renda_mensal'] !== null ? number_format((float)$l['renda_mensal'], 2, ',', '.') : ''; ?></td>
<td><?php echo htmlspecialchars($l['negativado'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo htmlspecialchars($l['fonte_renda'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo $l['possui_cartao'] === null ? '' : ((int)$l['possui_cartao'] === 1 ? 'Sim' : 'Não'); ?></td>
<td><?php echo (int)$l['ofertas']; ?></td>
<td><?php echo date('d/m/Y H:i', strtotime($l['criado_em'])); ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
