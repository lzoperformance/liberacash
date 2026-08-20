<?php
/**
 * forgot-password.php
 * Recebe CPF ou e-mail, gera um token de recuperação e grava em
 * password_resets. O ENVIO DO E-MAIL AINDA NÃO ESTÁ IMPLEMENTADO
 * (fora do escopo do V2, conforme o roadmap) — por enquanto o token
 * só é logado via error_log() para você testar manualmente.
 *
 * Vive na RAIZ do repositório, mesmo nível de db.php e register.php.
 *
 * TODO (pós-V2): plugar um serviço de e-mail (SES, SMTP, etc.) e
 * enviar um link tipo https://libera.cash/redefinir-senha.php?token=...
 * em vez de logar o token.
 */

declare(strict_types=1);

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

// Mensagem sempre igual, exista ou não a conta — evita que alguém
// use este endpoint pra descobrir quais CPFs/e-mails estão cadastrados.
$genericMessage = 'Se o cadastro existir, enviamos um link de recuperação.';

if ($identifierRaw === '') {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Informe um CPF ou e-mail.']);
    exit;
}

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
    echo json_encode(['success' => false, 'message' => 'Informe um CPF ou e-mail válido.']);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id, email FROM usuarios WHERE {$campo} = :valor AND ativo = 1 LIMIT 1");
    $stmt->execute(['valor' => $valor]);
    $usuario = $stmt->fetch();

    if ($usuario) {
        // Invalida tokens antigos ainda não usados desse usuário
        $pdo->prepare('UPDATE password_resets SET usado = 1 WHERE user_id = :id AND usado = 0')
            ->execute(['id' => $usuario['id']]);

        // Gera token aleatório seguro; guardamos só o HASH no banco
        $token     = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $token);
        $expiraEm  = (new DateTime('+1 hour'))->format('Y-m-d H:i:s');

        $pdo->prepare(
            'INSERT INTO password_resets (user_id, token_hash, expira_em, criado_em)
             VALUES (:user_id, :token_hash, :expira_em, NOW())'
        )->execute([
            'user_id'    => $usuario['id'],
            'token_hash' => $tokenHash,
            'expira_em'  => $expiraEm,
        ]);

        // TODO: enviar e-mail real com o link de redefinição.
        // Por enquanto, logamos o token para teste manual.
        error_log(sprintf(
            '[forgot-password.php] Token de recuperação para user_id=%d: %s (expira em %s)',
            $usuario['id'],
            $token,
            $expiraEm
        ));
    }

    // Responde sempre a mesma mensagem, com ou sem usuário encontrado
    echo json_encode(['success' => true, 'message' => $genericMessage]);
    exit;

} catch (PDOException $e) {
    error_log('[forgot-password.php] Erro de banco: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro ao processar sua solicitação. Tente novamente em instantes.']);
    exit;
}
