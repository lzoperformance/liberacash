<?php
/**
 * auth.php
 * Inclua este arquivo no topo de qualquer página do admin_blog que
 * precise de login. Redireciona para login.php se não autenticado.
 */

session_start();

// Cookie de sessão mais seguro
if (session_status() === PHP_SESSION_ACTIVE) {
    ini_set('session.cookie_httponly', 1);
}

require_once __DIR__ . '/../db.php'; // já deixa $pdo pronto

if (empty($_SESSION['admin_id'])) {
    header('Location: /admin_blog/login.php');
    exit;
}
