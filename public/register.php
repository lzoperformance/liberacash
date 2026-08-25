<?php
/**
 * api/register.php
 * Recebe o cadastro rápido do modal (Tela 1), valida, cria a conta
 * e inicia a sessão do usuário.
 *
 * Este arquivo vive na RAIZ do repositório (mesmo nível de db.php,
 * modal-credito.php, produtos.php etc.) — não dentro de nenhuma
 * subpasta. O db.php expõe a conexão PDO pronta na variável $pdo.
 */

declare(strict_types=1);

session_start();
header('Content-Type: application/json; charset=utf-8');

// ---------------------------------------------------------------------
// Só aceita POST
// ---------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
    exit;
}

require __DIR__ . '/db.php'; // mesmo nível: raiz do repo

if (!isset($pdo) || !($pdo instanceof PDO)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro interno de configuração do servidor.']);
    exit;
}

// ---------------------------------------------------------------------
// Lê e decodifica o JSON do corpo da requisição
// ---------------------------------------------------------------------
$raw   = file_get_contents('php://input');
$input = json_decode($raw, true);

if (!is_array($input)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Requisição inválida.']);
    exit;
}

// ---------------------------------------------------------------------
// Sanitização básica (trim + strip_tags) — validação forte vem a seguir
// ---------------------------------------------------------------------
function clean(?string $v): string {
    return trim(strip_tags($v ?? ''));
}

$nome            = clean($input['full_name']       ?? '');
$cpfRaw          = clean($input['cpf_number']      ?? '');
$celularRaw      = clean($input['mobile_phone']     ?? '');
$email           = clean($input['email']           ?? '');
$senha           = (string)($input['password'] ?? '');

$utmSource   = clean($input['utm_source']   ?? '');
$utmMedium   = clean($input['utm_medium']   ?? '');
$utmCampaign = clean($input['utm_campaign'] ?? '');
$utmContent  = clean($input['utm_content']  ?? '');
$fbclid      = clean($input['fbclid']       ?? '');
$gclid       = clean($input['gclid']        ?? '');

// Normaliza CPF e celular para conter só dígitos
$cpf     = preg_replace('/\D/', '', $cpfRaw);
$celular = preg_replace('/\D/', '', $celularRaw);

// ---------------------------------------------------------------------
// Validações
// ---------------------------------------------------------------------
$errors = [];

if (mb_strlen($nome) < 3) {
    $errors[] = 'Informe seu nome completo.';
}

if (!validarCPF($cpf)) {
    $errors[] = 'CPF inválido.';
}

if (strlen($celular) !== 11) {
    $errors[] = 'Celular inválido. Informe o número com DDD (11 dígitos).';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'E-mail inválido.';
}

if (strlen($senha) < 6) {
    $errors[] = 'A senha deve ter ao menos 6 caracteres.';
}

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

// ---------------------------------------------------------------------
// Verifica duplicidade de CPF ou e-mail
// ---------------------------------------------------------------------
try {
    $stmt = $pdo->prepare('SELECT id, cpf, email FROM usuarios WHERE cpf = :cpf OR email = :email LIMIT 1');
    $stmt->execute(['cpf' => $cpf, 'email' => $email]);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing) {
        $msg = ($existing['cpf'] === $cpf)
            ? 'Já existe uma conta cadastrada com este CPF.'
            : 'Já existe uma conta cadastrada com este e-mail.';
        http_response_code(409);
        echo json_encode(['success' => false, 'message' => $msg]);
        exit;
    }

    // -------------------------------------------------------------
    // Cria o usuário
    // -------------------------------------------------------------
    $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

    $pdo->beginTransaction();

    $insertUsuario = $pdo->prepare(
        'INSERT INTO usuarios (nome, cpf, email, celular, senha_hash, criado_em)
         VALUES (:nome, :cpf, :email, :celular, :senha_hash, NOW())'
    );
    $insertUsuario->execute([
        'nome'       => $nome,
        'cpf'        => $cpf,
        'email'      => $email,
        'celular'    => $celular,
        'senha_hash' => $senhaHash,
    ]);

    $userId = (int)$pdo->lastInsertId();

    // Cria a linha de perfil vazia (será preenchida nas próximas etapas)
    $insertPerfil = $pdo->prepare('INSERT INTO perfil_usuario (user_id) VALUES (:user_id)');
    $insertPerfil->execute(['user_id' => $userId]);

    $pdo->commit();

} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    // Corrida entre a checagem de duplicidade e o INSERT (unique key)
    if ((int)$e->getCode() === 23000 || strpos($e->getMessage(), '1062') !== false) {
        http_response_code(409);
        echo json_encode(['success' => false, 'message' => 'CPF ou e-mail já cadastrado.']);
        exit;
    }
    error_log('[register.php] Erro de banco: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro ao criar sua conta. Tente novamente em instantes.']);
    exit;
}

// ---------------------------------------------------------------------
// (Opcional) Registrar UTMs de origem em log/tabela de leads, se existir
// ---------------------------------------------------------------------
// Exemplo, caso exista uma tabela leads_origem:
// $pdo->prepare('INSERT INTO leads_origem (user_id, utm_source, utm_medium, utm_campaign, utm_content, fbclid, gclid) VALUES (?,?,?,?,?,?,?)')
//     ->execute([$userId, $utmSource, $utmMedium, $utmCampaign, $utmContent, $fbclid, $gclid]);

// ---------------------------------------------------------------------
// Consulta automática de pré-aprovação na Velotax — é essa chamada que
// acontece "por baixo" da animação de 3-5s no front-end. Se falhar por
// qualquer motivo (endpoint ainda não configurado, timeout, etc.), o
// cadastro segue normalmente e o usuário só cai no Cenário B do painel.
// ---------------------------------------------------------------------
try {
    require_once __DIR__ . '/parceiros/velotax-client.php';
    $velotax = new VelotaxClient();
    $resultado = $velotax->consultarPreAprovacao([
        'nome'    => $nome,
        'cpf'     => $cpf,
        'email'   => $email,
        'celular' => $celular,
    ]);

    if ($resultado) {
        require_once __DIR__ . '/produtos-config.php';
        require_once __DIR__ . '/painel/includes/funcoes-perfil.php';

        $produtoVelotax = get_product_by_slug('credito-pessoal');
        $urlParceiro = $resultado['aprovado']
            ? montar_url_parceiro($produtoVelotax, ['utm_source' => 'lzo'], ['cpf' => $cpf])
            : null;

        $pdo->prepare(
            'INSERT INTO historico_solicitacoes
                (user_id, produto_slug, parceiro, valor_solicitado, status, utm_source, url_parceiro, resposta_api_bruta)
             VALUES
                (:user_id, :produto_slug, :parceiro, :valor_solicitado, :status, :utm_source, :url_parceiro, :raw)'
        )->execute([
            'user_id'          => $userId,
            'produto_slug'     => 'credito-pessoal', // Velotax = crédito pessoal; ajustar se cobrir outro produto
            'parceiro'         => 'Velotax',
            'valor_solicitado' => $resultado['valor'],
            'status'           => $resultado['aprovado'] ? 'pre_aprovado' : 'recusado',
            'utm_source'       => 'lzo',
            'url_parceiro'     => $urlParceiro,
            'raw'              => $resultado['raw'],
        ]);

        // TODO: quando o parser em velotax-client.php estiver 100% validado,
        // disparar aqui o e-mail de proposta pré-aprovada:
        //
        //   if ($resultado['aprovado']) {
        //       require_once __DIR__ . '/EmailService.php';
        //       require_once __DIR__ . '/produtos-config.php';
        //       (new EmailService())->enviarPropostaPreAprovada(
        //           ['nome' => $nome, 'email' => $email],
        //           get_product_by_slug('credito-pessoal'),
        //           $resultado['valor']
        //       );
        //   }
    }
} catch (Throwable $e) {
    // Nunca deixa a consulta ao parceiro derrubar o cadastro do usuário.
    error_log('[register.php] Falha na consulta Velotax: ' . $e->getMessage());
}

// ---------------------------------------------------------------------
// Abre a sessão do usuário
// ---------------------------------------------------------------------
session_regenerate_id(true);
$_SESSION['user_id']    = $userId;
$_SESSION['user_nome']  = $nome;
$_SESSION['user_email'] = $email;
$_SESSION['logged_in']  = true;

// Atualiza último login
try {
    $pdo->prepare('UPDATE usuarios SET ultimo_login = NOW() WHERE id = :id')
        ->execute(['id' => $userId]);
} catch (PDOException $e) {
    error_log('[register.php] Falha ao atualizar ultimo_login: ' . $e->getMessage());
}

echo json_encode(['success' => true, 'redirect' => '/painel']);
exit;

// =======================================================================
// Validação de CPF (mesmo algoritmo usado no front-end)
// =======================================================================
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
