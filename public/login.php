<?php
/**
 * login.php
 * Recebe CPF ou e-mail + senha, valida credenciais e abre a sessão.
 *
 * Vive na RAIZ do repositório, mesmo nível de db.php e register.php.
 */

declare(strict_types=1);

session_start();
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
    exit;
}

require __DIR__ . '/db.php'; // mesmo nível: raiz do repo ($pdo)

if (!isset($pdo) || !($pdo instanceof PDO)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro interno de configuração do servidor.']);
    exit;
}

$raw   = file_get_contents('php://input');
$input = json_decode($raw, true);

if (!is_array($input)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Requisição inválida.']);
    exit;
}

function clean(?string $v): string {
    return trim(strip_tags($v ?? ''));
}

function validarCPF(string $cpf): bool
{
    if (strlen($cpf) !== 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
        return false;
    }
    for ($t = 9; $t < 11; $t++) {
        $soma = 0;
        for ($i = 0; $i < $t; $i++) {
            $soma += (int)$cpf[$i] * (($t + 1) - $i);
        }
        $digito = ((10 * $soma) % 11) % 10;
        if ((int)$cpf[$t] !== $digito) {
            return false;
        }
    }
    return true;
}

$identifierRaw = clean($input['identifier'] ?? '');
$senha          = (string)($input['password'] ?? '');

// Mensagem genérica de erro — nunca revela se o problema foi o
// identificador ou a senha, pra não facilitar enumeração de contas.
$genericError = 'CPF/e-mail ou senha incorretos.';

if ($identifierRaw === '' || $senha === '') {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => $genericError]);
    exit;
}

// Decide se o identificador é CPF (só dígitos, 11 posições, checksum ok) ou e-mail
$soDigitos = preg_replace('/\D/', '', $identifierRaw);

$campo = null;
$valor = null;

if (strlen($soDigitos) === 11 && validarCPF($soDigitos)) {
    $campo = 'cpf';
    $valor = $soDigitos;
} elseif (filter_var($identifierRaw, FILTER_VALIDATE_EMAIL)) {
    $campo = 'email';
    $valor = $identifierRaw;
} else {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => $genericError]);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id, nome, email, senha_hash, ativo FROM usuarios WHERE {$campo} = :valor LIMIT 1");
    $stmt->execute(['valor' => $valor]);
    $usuario = $stmt->fetch();

    if (!$usuario || !password_verify($senha, $usuario['senha_hash'])) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => $genericError]);
        exit;
    }

    if ((int)$usuario['ativo'] !== 1) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Esta conta está desativada. Entre em contato com o suporte.']);
        exit;
    }

    // Login válido — abre a sessão
    session_regenerate_id(true);
    $_SESSION['user_id']    = (int)$usuario['id'];
    $_SESSION['user_nome']  = $usuario['nome'];
    $_SESSION['user_email'] = $usuario['email'];
    $_SESSION['logged_in']  = true;

    $pdo->prepare('UPDATE usuarios SET ultimo_login = NOW() WHERE id = :id')
        ->execute(['id' => $usuario['id']]);

    echo json_encode(['success' => true, 'redirect' => '/painel']);
    exit;

} catch (PDOException $e) {
    error_log('[login.php] Erro de banco: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro ao processar o login. Tente novamente em instantes.']);
    exit;
}
