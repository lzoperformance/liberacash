<?php
/**
 * auth.php
 * Reaproveita o mesmo login/sessão do admin_blog (tabela admin_users,
 * $_SESSION['admin_id']) — um único usuário/senha pra tudo que é
 * painel interno. Inclua no topo de qualquer página do dashboard.
 */

session_start();

if (session_status() === PHP_SESSION_ACTIVE) {
    ini_set('session.cookie_httponly', 1);
}

require_once __DIR__ . '/../db.php'; // já deixa $pdo pronto

if (empty($_SESSION['admin_id'])) {
    header('Location: /admin_blog/login.php?next=' . urlencode($_SERVER['REQUEST_URI'] ?? '/admin_dashboard/'));
    exit;
}
