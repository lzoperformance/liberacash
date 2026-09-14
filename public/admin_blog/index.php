<?php
require_once __DIR__ . '/auth.php'; // já deixa $pdo pronto

$busca = trim($_GET['busca'] ?? '');
if ($busca !== '') {
    $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE titulo LIKE :b OR categoria LIKE :b ORDER BY created_at DESC");
    $stmt->execute([':b' => '%' . $busca . '%']);
} else {
    $stmt = $pdo->query("SELECT * FROM blog_posts ORDER BY created_at DESC");
}
$posts = $stmt->fetchAll();
$pageTitle = 'Posts do blog';
$pageSubtitle = count($posts) . ' post(s) no total';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Posts | Admin Blog - LiberaCash</title>
<meta name="robots" content="noindex, nofollow">
<?php include __DIR__ . '/../admin_dashboard/_estilo.php'; ?>
</head>
<?php include __DIR__ . '/../admin_dashboard/_shell_top.php'; ?>

<div class="lc-page-title-row" style="margin-top:-4px;">
    <span></span>
    <a class="lc-btn lc-btn-primary" href="/admin_blog/post-form.php"><i data-lucide="plus" style="width:16px;height:16px;"></i> Novo post</a>
</div>

<?php if (isset($_GET['ok'])): ?>
    <div class="lc-badge success" style="display:flex; padding:12px 16px; font-size:13.5px; margin-bottom:16px;">
        <?php
            $mensagens = [
                'criado' => 'Post criado com sucesso!',
                'atualizado' => 'Post atualizado com sucesso!',
                'excluido' => 'Post excluído com sucesso!',
            ];
            echo htmlspecialchars($mensagens[$_GET['ok']] ?? 'Feito!', ENT_QUOTES, 'UTF-8');
        ?>
    </div>
<?php endif; ?>

<div class="lc-card">
    <form method="GET" class="lc-filters" style="margin-bottom: <?php echo empty($posts) ? '0' : '18px'; ?>;">
        <div class="lc-fgroup" style="flex-grow:1; max-width:360px;">
            <label for="busca">Buscar</label>
            <input type="text" id="busca" name="busca" placeholder="Título ou categoria..." value="<?php echo htmlspecialchars($busca, ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <button type="submit" class="lc-btn lc-btn-secondary"><i data-lucide="search" style="width:16px;height:16px;"></i> Buscar</button>
    </form>

    <?php if (empty($posts)): ?>
        <p class="lc-empty-row">Nenhum post encontrado.</p>
    <?php else: ?>
    <div class="lc-table-wrap">
    <table class="lc-table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Categoria</th>
                <th>Status</th>
                <th>Views</th>
                <th>Publicado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $p): ?>
            <tr>
                <td><?php echo htmlspecialchars($p['titulo'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($p['categoria'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><span class="lc-badge <?php echo $p['status'] === 'publicado' ? 'success' : 'warning'; ?>"><?php echo ucfirst($p['status']); ?></span></td>
                <td><?php echo (int)$p['views']; ?></td>
                <td><?php echo date('d/m/Y', strtotime($p['created_at'])); ?></td>
                <td style="white-space:nowrap;">
                    <a href="/admin_blog/post-form.php?id=<?php echo (int)$p['id']; ?>" style="color:var(--forest-700); text-decoration:none; margin-right:14px; font-weight:600; font-size:13px;"><i data-lucide="pencil" style="width:14px;height:14px;vertical-align:-2px;"></i> Editar</a>
                    <a href="/admin_blog/post-delete.php?id=<?php echo (int)$p['id']; ?>" style="color:var(--red-500); text-decoration:none; font-weight:600; font-size:13px;"
                       onclick="return confirm('Tem certeza que quer excluir o post &quot;<?php echo htmlspecialchars(addslashes($p['titulo']), ENT_QUOTES, 'UTF-8'); ?>&quot;? Essa ação não pode ser desfeita.');">
                       <i data-lucide="trash-2" style="width:14px;height:14px;vertical-align:-2px;"></i> Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../admin_dashboard/_shell_bottom.php'; ?>
