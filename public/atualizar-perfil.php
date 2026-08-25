<?php
/**
 * atualizar-perfil.php
 * Endpoint único usado por:
 *   - painel/index.php (modal de qualificação dinâmico)
 *   - painel/minha-conta.php (edição completa, com trava de senha p/ dados sensíveis)
 *
 * Espera JSON no corpo. Só grava as colunas permitidas na whitelist abaixo —
 * nunca grava um campo que não esteja nela, mesmo que venha no payload.
 */

declare(strict_types=1);
session_start();
header('Content-Type: application/json; charset=utf-8');

if (empty($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Sessão expirada. Faça login novamente.']);
    exit;
}

require __DIR__ . '/db.php';

$userId = (int)$_SESSION['user_id'];
$input = json_decode(file_get_contents('php://input'), true) ?: [];

// Campos que podem ser atualizados em perfil_usuario e o "tipo" de cada um
// (usado só pra sanitizar antes de gravar).
$camposPermitidos = [
    'cep'             => 'texto',
    'logradouro'      => 'texto',
    'numero'          => 'texto',
    'complemento'     => 'texto',
    'bairro'          => 'texto',
    'cidade'          => 'texto',
    'estado'          => 'texto',
    'data_nascimento' => 'data',
    'genero'          => 'texto',
    'estado_civil'    => 'texto',
    'fonte_renda'     => 'texto',
    'renda_mensal'    => 'moeda',
    'possui_cartao'   => 'booleano',
    'negativado'      => 'texto',
    'modelo_celular'  => 'texto',
    'sistema_celular' => 'texto',
];

// Campos considerados sensíveis: exigem confirmação de senha atual quando
// o VALOR realmente muda (não só quando a chave aparece no payload — o
// formulário do "Minha Conta" sempre manda o formulário inteiro, então
// email/celular sempre estão presentes mesmo sem edição nenhuma).
$camposSensiveis = ['email', 'celular', 'cep', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado'];

$stmtAtual = $pdo->prepare(
    'SELECT u.email, u.celular, p.cep, p.logradouro, p.numero, p.complemento, p.bairro, p.cidade, p.estado
     FROM usuarios u
     LEFT JOIN perfil_usuario p ON p.user_id = u.id
     WHERE u.id = :id LIMIT 1'
);
$stmtAtual->execute(['id' => $userId]);
$valoresAtuais = $stmtAtual->fetch() ?: [];

$tocaCampoSensivel = false;
$editandoContaOuEmail = false;
foreach ($camposSensiveis as $campo) {
    if (!array_key_exists($campo, $input)) continue;

    $valorNovo = is_string($input[$campo]) ? trim($input[$campo]) : $input[$campo];
    $valorAtual = (string)($valoresAtuais[$campo] ?? '');

    // Normaliza celular pra comparar só dígitos (o form manda mascarado)
    if ($campo === 'celular') {
        $valorNovo = preg_replace('/\D/', '', (string)$valorNovo);
    }
    if ($campo === 'cep') {
        $valorNovo = preg_replace('/\D/', '', (string)$valorNovo);
    }

    if ((string)$valorNovo !== $valorAtual) {
        $tocaCampoSensivel = true;
        // Só e-mail/celular de fato travam com senha — o modal de
        // qualificação do dashboard preenche endereço pela primeira vez
        // sem pedir senha nenhuma, e precisa continuar assim.
        if ($campo === 'email' || $campo === 'celular') {
            $editandoContaOuEmail = true;
        }
    }
}

if ($tocaCampoSensivel && $editandoContaOuEmail) {
    // Só exige senha quando E-mail/Telefone estão sendo alterados (Minha Conta).
    // O modal de qualificação do dashboard nunca toca email/celular, então não é afetado.
    $senhaAtual = (string)($input['current_password'] ?? '');
    if ($senhaAtual === '') {
        http_response_code(422);
        echo json_encode(['success' => false, 'message' => 'Confirme sua senha atual para salvar essas alterações.']);
        exit;
    }
    $stmt = $pdo->prepare('SELECT senha_hash FROM usuarios WHERE id = :id LIMIT 1');
    $stmt->execute(['id' => $userId]);
    $row = $stmt->fetch();
    if (!$row || !password_verify($senhaAtual, $row['senha_hash'])) {
        http_response_code(422);
        echo json_encode(['success' => false, 'message' => 'Senha atual incorreta.']);
        exit;
    }
}

// --- Atualiza usuarios (email / celular), se vieram no payload ---
$camposUsuario = [];
if (isset($input['email']) && filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    $camposUsuario['email'] = trim($input['email']);
}
if (isset($input['celular'])) {
    $celular = preg_replace('/\D/', '', (string)$input['celular']);
    if (strlen($celular) === 11) $camposUsuario['celular'] = $celular;
}
if ($camposUsuario) {
    $sets = implode(', ', array_map(fn($c) => "$c = :$c", array_keys($camposUsuario)));
    $stmt = $pdo->prepare("UPDATE usuarios SET $sets WHERE id = :id");
    $stmt->execute($camposUsuario + ['id' => $userId]);
}

// --- Atualiza perfil_usuario (whitelist) ---
$camposPerfil = [];
foreach ($camposPermitidos as $campo => $tipo) {
    if (!array_key_exists($campo, $input)) continue;
    $valor = $input[$campo];

    switch ($tipo) {
        case 'texto':
            $valor = trim((string)$valor);
            if ($campo === 'cep') $valor = preg_replace('/\D/', '', $valor);
            if ($campo === 'estado') $valor = strtoupper(substr($valor, 0, 2));
            break;
        case 'data':
            $valor = preg_match('/^\d{4}-\d{2}-\d{2}$/', (string)$valor) ? $valor : null;
            break;
        case 'moeda':
            $valor = (float)preg_replace('/[^\d,\.]/', '', str_replace(',', '.', preg_replace('/\.(?=\d{3})/', '', (string)$valor)));
            break;
        case 'booleano':
            $valor = in_array($valor, [true, 'true', 1, '1', 'sim'], true) ? 1 : 0;
            break;
    }
    if ($valor === '' ) continue; // não sobrescreve com vazio
    $camposPerfil[$campo] = $valor;
}

if ($camposPerfil) {
    // upsert: garante que existe uma linha em perfil_usuario pra esse user_id
    $stmt = $pdo->prepare('SELECT user_id FROM perfil_usuario WHERE user_id = :id LIMIT 1');
    $stmt->execute(['id' => $userId]);
    $existe = (bool)$stmt->fetch();

    if ($existe) {
        $sets = implode(', ', array_map(fn($c) => "$c = :$c", array_keys($camposPerfil)));
        $stmt = $pdo->prepare("UPDATE perfil_usuario SET $sets WHERE user_id = :user_id");
        $stmt->execute($camposPerfil + ['user_id' => $userId]);
    } else {
        $colunas = array_merge(['user_id'], array_keys($camposPerfil));
        $placeholders = array_map(fn($c) => ":$c", $colunas);
        $stmt = $pdo->prepare('INSERT INTO perfil_usuario (' . implode(',', $colunas) . ') VALUES (' . implode(',', $placeholders) . ')');
        $stmt->execute($camposPerfil + ['user_id' => $userId]);
    }
}

echo json_encode(['success' => true]);
