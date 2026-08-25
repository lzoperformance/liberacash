<?php
/**
 * db.php - Conexão com o banco de dados
 * Credenciais vêm de config/db-config.php (fora do document root,
 * gitignorado — nunca commitado, mesmo padrão do aws-config.php e do
 * parceiros-config.php). Se não existir, cai pra variável de ambiente
 * como alternativa (útil em hosts que suportam env var de verdade).
 *
 * Pra criar o arquivo real: copie config/db-config.example.php pra
 * config/db-config.php e preencha com as credenciais do banco.
 */

$dbConfig = @include __DIR__ . '/../config/db-config.php';
$dbConfig = is_array($dbConfig) ? $dbConfig : [];

$db_host = $dbConfig['host'] ?? (getenv('DB_HOST') ?: '127.0.0.1');
$db_name = $dbConfig['name'] ?? (getenv('DB_NAME') ?: 'liberacash');
$db_user = $dbConfig['user'] ?? (getenv('DB_USER') ?: '');
$db_pass = $dbConfig['pass'] ?? (getenv('DB_PASS') ?: '');

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
