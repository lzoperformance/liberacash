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
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Posts | Admin Blog - LiberaCash</title>
<meta name="robots" content="noindex, nofollow">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    :root { --primary-green: #2ecc71; --dark-green: #27ae60; --dark-bg: #181a1f; }
    body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f6f5; color: #2d3436; }

    .topbar { background: var(--dark-bg); color: #fff; padding: 14px 24px; display: flex; justify-content: space-between; align-items: center; }
    .topbar .brand { font-weight: 700; font-size: 15px; }
    .topbar .brand span { color: var(--primary-green); }
    .topbar a { color: #ccc; text-decoration: none; font-size: 13px; margin-left: 18px; }
    .topbar a:hover { color: #fff; }

    .wrap { max-width: 1100px; margin: 30px auto; padding: 0 20px; }

    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px; }
    .page-header h1 { font-size: 1.5rem; }
    .btn-new { background: var(--primary-green); color: #fff; padding: 11px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; }
    .btn-new:hover { background: var(--dark-green); }

    .search-bar { margin-bottom: 20px; }
    .search-bar input { width: 100%; max-width: 320px; padding: 10px 14px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; }

    .flash { padding: 12px 16px; border-radius: 8px; margin-bottom: 18px; font-size: 14px; }
    .flash.ok { background: #eafaf1; color: #1e8449; }
    .flash.err { background: #fdecea; color: #c0392b; }

    table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.04); }
    th, td { padding: 13px 16px; text-align: left; font-size: 13.5px; border-bottom: 1px solid #f0f0f0; }
    th { background: #fafafa; font-weight: 700; color: #555; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; }
    tr:last-child td { border-bottom: none; }

    .badge { padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; }
    .badge.publicado { background: #eafaf1; color: #1e8449; }
    .badge.rascunho { background: #fff8e1; color: #b7791f; }

    .actions a { margin-right: 12px; font-size: 13px; text-decoration: none; }
    .actions .edit { color: #2980b9; }
    .actions .del { color: #c0392b; }

    .empty { text-align: center; padding: 50px 20px; color: #888; }
</style>
</head>
<body>

<div class="topbar">
    <div class="brand">Admin <span>Blog</span> · LiberaCash</div>
    <div>
        <span>Olá, <?php echo htmlspecialchars($_SESSION['admin_username'], ENT_QUOTES, 'UTF-8'); ?></span>
        <a href="/blog/" target="_blank">Ver blog <i class="fas fa-external-link-alt"></i></a>
        <a href="/admin_blog/logout.php">Sair <i class="fas fa-sign-out-alt"></i></a>
    </div>
</div>

<div class="wrap">
    <div class="page-header">
        <h1>Posts do Blog</h1>
        <a class="btn-new" href="/admin_blog/post-form.php"><i class="fas fa-plus"></i> Novo Post</a>
    </div>

    <?php if (isset($_GET['ok'])): ?>
        <div class="flash ok">
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

    <div class="search-bar">
        <form method="GET">
            <input type="text" name="busca" placeholder="Buscar por título ou categoria..." value="<?php echo htmlspecialchars($busca, ENT_QUOTES, 'UTF-8'); ?>">
        </form>
    </div>

    <?php if (empty($posts)): ?>
        <div class="empty">Nenhum post encontrado.</div>
    <?php else: ?>
    <table>
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
                <td><span class="badge <?php echo $p['status']; ?>"><?php echo ucfirst($p['status']); ?></span></td>
                <td><?php echo (int)$p['views']; ?></td>
                <td><?php echo date('d/m/Y', strtotime($p['created_at'])); ?></td>
                <td class="actions">
                    <a class="edit" href="/admin_blog/post-form.php?id=<?php echo (int)$p['id']; ?>"><i class="fas fa-pen"></i> Editar</a>
                    <a class="del" href="/admin_blog/post-delete.php?id=<?php echo (int)$p['id']; ?>"
                       onclick="return confirm('Tem certeza que quer excluir o post &quot;<?php echo htmlspecialchars(addslashes($p['titulo']), ENT_QUOTES, 'UTF-8'); ?>&quot;? Essa ação não pode ser desfeita.');">
                       <i class="fas fa-trash"></i> Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

</body>
</html>
