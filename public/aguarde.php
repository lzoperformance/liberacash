<?php
/**
 * aguarde.php — Página de Espera
 *
 * Recebe os dados do formulário (via POST/AJAX),
 * salva no banco de dados, armazena na sessão, consulta a API dos parceiros (mock por enquanto),
 * e retorna o redirect para sucesso.php.
 *
 * Fluxo:
 *   1. Modal envia POST via fetch()
 *   2. Este arquivo processa, salva no banco, salva na sessão, consulta API
 *   3. Retorna JSON com { redirect: "sucesso.php?token=XYZ" }
 *   4. JS do modal faz window.location.href = redirect
 *
 * IMPORTANTE: Aqui entra a integração real com a API dos parceiros.
 * Por enquanto, usamos MOCK (dados simulados).
 */

session_start();
require_once __DIR__ . '/db.php';

/* ============================================================
   1. RECEBER DADOS DO FORMULÁRIO
   ============================================================ */
$dados = [
    'full_name'            => trim($_POST['full_name'] ?? ''),
    'cpf_number'           => trim($_POST['cpf_number'] ?? ''),
    'mobile_phone'         => trim($_POST['mobile_phone'] ?? ''),
    'email'                => trim($_POST['email'] ?? ''),
    'birthdate'            => trim($_POST['birthdate'] ?? ''),
    'gender'               => trim($_POST['gender'] ?? ''),
    'marital_status_id'    => trim($_POST['marital_status_id'] ?? ''),
    'address_postal_code'  => trim($_POST['address_postal_code'] ?? ''),
    'address_street'       => trim($_POST['address_street'] ?? ''),
    'address_number'       => trim($_POST['address_number'] ?? ''),
    'address_complement'   => trim($_POST['address_complement'] ?? ''),
    'address_neighborhood' => trim($_POST['address_neighborhood'] ?? ''),
    'address_city'         => trim($_POST['address_city'] ?? ''),
    'address_state'        => trim($_POST['address_state'] ?? ''),
    'loan_amount'          => intval(preg_replace('/\D/', '', $_POST['loan_amount'] ?? '') ?: '0'),
    'is_negative'          => trim($_POST['is_negative'] ?? ''),
    'income_source'        => trim($_POST['income_source'] ?? ''),
    'gross_income'         => trim($_POST['gross_income'] ?? ''),
    'has_credit_card'      => trim($_POST['has_credit_card'] ?? ''),
    'device_model'         => trim($_POST['device_model'] ?? ''),
    'device_os'            => trim($_POST['device_os'] ?? ''),
    'terms_accepted'       => isset($_POST['terms_accepted']) ? 'sim' : 'nao',
    // Novos campos de rastreamento
    'tipo_produto'         => trim($_POST['tipo_produto'] ?? ''),
    'produto'              => trim($_POST['produto'] ?? ''),
    'product_id'           => trim($_POST['product_id'] ?? ''),
    'utm_source'           => trim($_POST['utm_source'] ?? ''),
    'utm_medium'           => trim($_POST['utm_medium'] ?? ''),
    'utm_campaign'         => trim($_POST['utm_campaign'] ?? ''),
    'utm_content'          => trim($_POST['utm_content'] ?? ''),
    'fbclid'               => trim($_POST['fbclid'] ?? ''),
    'gclid'                => trim($_POST['gclid'] ?? ''),
];

/* ============================================================
   2. VALIDAÇÃO BÁSICA (segurança)
   ============================================================ */
if (empty($dados['full_name']) || empty($dados['cpf_number']) || empty($dados['email'])) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Dados incompletos. Por favor, refaça o formulário.']);
    exit;
}

/* ============================================================
   3. GERAR TOKEN DA CONSULTA
   ============================================================ */
$token = bin2hex(random_bytes(16));

/* ============================================================
   4. SALVAR LEAD NO BANCO DE DADOS
   ============================================================ */
if ($pdo) {
    try {
        $stmt = $pdo->prepare(
            "INSERT INTO leads_credito (
                full_name, cpf_number, mobile_phone, email, birthdate, gender, marital_status_id,
                address_postal_code, address_street, address_number, address_complement,
                address_neighborhood, address_city, address_state, tipo_produto, product_id,
                loan_amount, is_negative, income_source, gross_income, has_credit_card,
                device_model, device_os, terms_accepted, utm_source, utm_medium, utm_campaign, utm_content,
                fbclid, gclid, token
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $dados['full_name'], $dados['cpf_number'], $dados['mobile_phone'], $dados['email'],
            $dados['birthdate'], $dados['gender'], $dados['marital_status_id'],
            $dados['address_postal_code'], $dados['address_street'], $dados['address_number'],
            $dados['address_complement'], $dados['address_neighborhood'], $dados['address_city'],
            $dados['address_state'], $dados['tipo_produto'], $dados['product_id'],
            $dados['loan_amount'], $dados['is_negative'], $dados['income_source'],
            $dados['gross_income'], $dados['has_credit_card'], $dados['device_model'],
            $dados['device_os'], $dados['terms_accepted'], $dados['utm_source'], $dados['utm_medium'],
            $dados['utm_campaign'], $dados['utm_content'], $dados['fbclid'], $dados['gclid'],
            $token
        ]);
    } catch (PDOException $e) {
        error_log('Erro ao salvar lead: ' . $e->getMessage());
        // Não interrompe o fluxo do usuário mesmo se salvar falhar
    }
}

/* ============================================================
   5. SALVAR NA SESSÃO (para sucesso.php recuperar)
   ============================================================ */
$_SESSION['consulta'] = [
    'token'  => $token,
    'dados'  => $dados,
    'timestamp' => time(),
    'produto' => $dados['tipo_produto'] ?: ($dados['produto'] ?? 'credito-pessoal'),
    'product_id' => $dados['product_id'] ?? '001',
    'tracking' => [
        'utm_source'   => $dados['utm_source'],
        'utm_medium'   => $dados['utm_medium'],
        'utm_campaign' => $dados['utm_campaign'],
        'utm_content'  => $dados['utm_content'],
        'fbclid'       => $dados['fbclid'],
        'gclid'        => $dados['gclid'],
    ],
];

/* ============================================================
   6. CONSULTAR API DOS PARCEIROS
   ============================================================
   AQUI ENTRA A INTEGRAÇÃO REAL.
   Exemplo de como seria:

   $ch = curl_init('https://api.parceiro.com/v1/consultar');
   curl_setopt_array($ch, [
       CURLOPT_POST           => true,
       CURLOPT_POSTFIELDS     => json_encode($dados),
       CURLOPT_HTTPHEADER     => [
           'Content-Type: application/json',
           'Authorization: Bearer SEU_TOKEN_AQUI',
       ],
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_TIMEOUT        => 30,
   ]);
   $response = curl_exec($ch);
   $propostas = json_decode($response, true);
   curl_close($ch);

   Por enquanto, usamos MOCK:
   ============================================================ */

// Simula tempo de processamento (a API real vai demorar alguns segundos)
// O delay mínimo de 3s é para dar percepção de "análise real"
$inicio = time();

// MOCK: Gera propostas simuladas baseadas no perfil
$propostas = gerarPropostasMock($dados);

// Garante tempo mínimo de 4 segundos de "processamento"
$elapsed = time() - $inicio;
if ($elapsed < 4) {
    sleep(4 - $elapsed);
}

// Salva propostas na sessão
$_SESSION['consulta']['propostas'] = $propostas;
$_SESSION['consulta']['status'] = !empty($propostas) ? 'com_propostas' : 'sem_propostas';

/* ============================================================
   7. RETORNAR REDIRECT
   ============================================================ */
header('Content-Type: application/json');
echo json_encode([
    'redirect' => 'sucesso.php?token=' . $token,
    'token'    => $token,
    'status'   => $_SESSION['consulta']['status'],
]);
exit;

/* ============================================================
   FUNÇÃO MOCK — Remove quando integrar API real
   ============================================================ */
function gerarPropostasMock(array $dados): array
{
    // Só o Empréstimo Pessoal tem "parceiros" simulados por enquanto.
    // Os demais produtos (Consignado, Garantia de Celular, Conta de Luz, Auto, Imóvel)
    // ainda não têm integração real, então retornam vazio e caem no fallback de
    // banners de parceiros (por produto) em sucesso.php — sem gerar propostas falsas
    // pra produtos que ainda não estão plugados.
    $produto = $dados['tipo_produto'] ?: ($dados['produto'] ?? 'credito-pessoal');
    if ($produto !== 'credito-pessoal') {
        return [];
    }

    $valor = $dados['loan_amount'] ?: 5000;
    $negativado = ($dados['is_negative'] === 'sim');
    $renda = str_replace(['.', ','], ['', '.'], $dados['gross_income'] ?? '0');
    $rendaFloat = floatval($renda);

    $propostas = [];

    // Parceiro 1: Juvo (sempre retorna para perfil básico)
    if (!$negativado) {
        $propostas[] = [
            'parceiro'    => 'Juvo',
            'logo'        => 'juvo',
            'valor'       => $valor,
            'taxa_mes'    => 1.49,
            'parcelas'    => calcularParcelas($valor, 1.49, 24),
            'parcela_min' => round($valor / 24 * 1.15, 2),
            'prazo_max'   => 24,
            'link'        => '#', // Link de afiliado real aqui
        ];
    }

    // Parceiro 2: Creditas (retorna se renda >= 2000)
    if ($rendaFloat >= 2000) {
        $propostas[] = [
            'parceiro'    => 'Creditas',
            'logo'        => 'creditas',
            'valor'       => $valor,
            'taxa_mes'    => 1.69,
            'parcelas'    => calcularParcelas($valor, 1.69, 36),
            'parcela_min' => round($valor / 36 * 1.20, 2),
            'prazo_max'   => 36,
            'link'        => '#',
        ];
    }

    // Parceiro 3: BV (retorna se não negativado e renda >= 1500)
    if (!$negativado && $rendaFloat >= 1500) {
        $propostas[] = [
            'parceiro'    => 'BV',
            'logo'        => 'bv',
            'valor'       => $valor,
            'taxa_mes'    => 1.99,
            'parcelas'    => calcularParcelas($valor, 1.99, 48),
            'parcela_min' => round($valor / 48 * 1.22, 2),
            'prazo_max'   => 48,
            'link'        => '#',
        ];
    }

    // Parceiro 4: NoVerde (aceita negativado)
    if ($negativado) {
        $propostas[] = [
            'parceiro'    => 'NoVerde',
            'logo'        => 'noverde',
            'valor'       => min($valor, 5000),
            'taxa_mes'    => 3.49,
            'parcelas'    => calcularParcelas(min($valor, 5000), 3.49, 12),
            'parcela_min' => round(min($valor, 5000) / 12 * 1.30, 2),
            'prazo_max'   => 12,
            'link'        => '#',
        ];
    }

    // Parceiro 5: Volotax (sempre retorna)
    $propostas[] = [
        'parceiro'    => 'Volotax',
        'logo'        => 'volotax',
        'valor'       => $valor,
        'taxa_mes'    => 2.29,
        'parcelas'    => calcularParcelas($valor, 2.29, 36),
        'parcela_min' => round($valor / 36 * 1.25, 2),
        'prazo_max'   => 36,
        'link'        => '#',
    ];

    // Ordena por menor taxa
    usort($propostas, fn($a, $b) => $a['taxa_mes'] <=> $b['taxa_mes']);

    return $propostas;
}

function calcularParcelas(float $valor, float $taxaMes, int $prazoMax): array
{
    $parcelas = [];
    foreach ([6, 12, 24, $prazoMax] as $n) {
        if ($n > $prazoMax) continue;
        $pm = $valor * ($taxaMes / 100) / (1 - pow(1 + $taxaMes / 100, -$n));
        $parcelas[] = [
            'n'       => $n,
            'valor'   => round($pm, 2),
            'label'   => $n . 'x de R$ ' . number_format($pm, 2, ',', '.'),
        ];
    }
    return $parcelas;
}
