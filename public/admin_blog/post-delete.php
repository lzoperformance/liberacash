<?php
require_once __DIR__ . '/auth.php'; // já deixa $pdo pronto

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM blog_posts WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header('Location: /admin_blog/index.php?ok=excluido');
exit;
