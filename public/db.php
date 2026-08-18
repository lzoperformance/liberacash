<?php
/**
 * db.php - Conexão com o banco de dados
 * Credenciais SEMPRE via variáveis de ambiente do servidor (nunca hardcoded
 * aqui — foi exatamente isso que vazou no repo antigo do credito.vc).
 *
 * Defina no CloudPanel (Site > Environment Variables) ou no .env local:
 *   DB_HOST, DB_NAME, DB_USER, DB_PASS
 */

$db_host = getenv('DB_HOST') ?: '127.0.0.1';
$db_name = getenv('DB_NAME') ?: 'liberacash';
$db_user = getenv('DB_USER') ?: '';
$db_pass = getenv('DB_PASS') ?: '';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    error_log('Erro ao conectar ao banco de dados: ' . $e->getMessage());
    die('Erro ao conectar ao banco de dados.');
}
