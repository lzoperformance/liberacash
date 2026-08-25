<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: /admin/login.php');
    exit;
}

require_once __DIR__ . '/../db.php';

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM blog_posts WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    header('Location: /admin/');
    exit;
}

$stmt = $pdo->query("SELECT id, titulo, slug, categoria, status, views, created_at FROM blog_posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Blog - LiberaCash</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f4f6f8; margin: 0; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #f0f0f0; padding-bottom: 15px; }
        .btn { padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 14px; display: inline-block; }
        .btn-green { background: #2ecc71; color: #fff; }
        .btn-green:hover { background: #27ae60; }
        .btn-danger { background: #e74c3c; color: #fff; }
        .btn-edit { background: #3498db; color: #fff; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { text-align: left; padding: 12px; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; color: #666; font-size: 13px; text-transform: uppercase; }
        .badge { padding: 4px 8px; border-radius: 12px; font-size: 11px; font-weight: bold; text-transform: uppercase; }
        .badge-publicado { background: #e8f8f0; color: #2ecc71; }
        .badge-rascunho { background: #fef5e7; color: #f39c12; }
        .actions { display: flex; gap: 8px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Gerenciador de Artigos do Blog</h2>
            <div>
                <a href="/admin/post-edit.php" class="btn btn-green">+ Novo Post</a>
                <a href="/admin/logout.php" style="margin-left: 15px; color: #666; text-decoration: none;">Sair</a>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Categoria</th>
                    <th>Status</th>
                    <th>Views</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($posts)): ?>
                    <tr><td colspan="6" style="text-align:center; color:#888;">Nenhum post cadastrado ainda.</td></tr>
                <?php else: ?>
                    <?php foreach ($posts as $p): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($p['titulo']) ?></strong><br><small style="color:#999;">/blog/<?= htmlspecialchars($p['slug']) ?>/</small></td>
                            <td><?= htmlspecialchars($p['categoria']) ?></td>
                            <td><span class="badge badge-<?= $p['status'] ?>"><?= $p['status'] ?></span></td>
                            <td><?= $p['views'] ?></td>
                            <td><?= date('d/m/Y', strtotime($p['created_at'])) ?></td>
                            <td class="actions">
                                <a href="/admin/post-edit.php?id=<?= $p['id'] ?>" class="btn btn-edit">Editar</a>
                                <a href="/admin/index.php?action=delete&id=<?= $p['id'] ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este post?')">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
