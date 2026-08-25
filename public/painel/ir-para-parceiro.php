<?php
/**
 * painel/ir-para-parceiro.php
 * Clique em "Ver oferta" de um card já liberado: registra em
 * historico_solicitacoes (alimenta a tela Histórico) e redireciona
 * pra URL final do parceiro com as UTMs de rastreamento injetadas.
 */

declare(strict_types=1);
session_start();

if (empty($_SESSION['user_id'])) {
    header('Location: /');
    exit;
}

require __DIR__ . '/../db.php';
require __DIR__ . '/../produtos-config.php';
require __DIR__ . '/includes/funcoes-perfil.php';

$userId = (int)$_SESSION['user_id'];
$slug = isset($_GET['produto']) ? trim((string)$_GET['produto']) : '';
$produto = get_product_by_slug($slug);

if (!$produto) {
    header('Location: /painel/index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM perfil_usuario WHERE user_id = :id LIMIT 1');
$stmt->execute(['id' => $userId]);
$perfil = $stmt->fetch() ?: [];

if (!produto_liberado_completo($produto, $perfil)) {
    // perfil incompleto (ou fora de cobertura de luz): manda de volta pro painel,
    // onde o card vai aparecer bloqueado de novo com o motivo certo.
    header('Location: /painel/index.php');
    exit;
}

$parceiroId = isset($_GET['parceiro']) ? trim((string)$_GET['parceiro']) : null;
$parceiro = get_partner_by_id($produto, $parceiroId);

if (!$parceiro) {
    header('Location: /painel/index.php');
    exit;
}

$extras = [];
if (!empty($parceiro['passar_cpf_na_url'])) {
    $stmt = $pdo->prepare('SELECT cpf FROM usuarios WHERE id = :id LIMIT 1');
    $stmt->execute(['id' => $userId]);
    $cpf = $stmt->fetchColumn();
    if ($cpf) $extras['cpf'] = $cpf;
}

$utms = [
    'utm_source'   => $_GET['utm_source']   ?? 'creditovc',
    'utm_medium'   => $_GET['utm_medium']   ?? 'painel',
    'utm_campaign' => $_GET['utm_campaign'] ?? $produto['slug'],
];
// monta a URL a partir do link do parceiro escolhido (não do produto)
$urlFinal = montar_url_parceiro(
    ['link_afiliado' => $parceiro['link_afiliado'], 'slug' => $produto['slug']],
    $utms,
    $extras
);

$stmt = $pdo->prepare(
    'INSERT INTO historico_solicitacoes
        (user_id, produto_slug, parceiro, valor_solicitado, status, utm_source, utm_medium, utm_campaign, url_parceiro)
     VALUES
        (:user_id, :produto_slug, :parceiro, :valor_solicitado, :status, :utm_source, :utm_medium, :utm_campaign, :url_parceiro)'
);
$stmt->execute([
    'user_id'          => $userId,
    'produto_slug'     => $produto['slug'],
    'parceiro'         => $parceiro['nome'],
    'valor_solicitado' => $perfil['valor_desejado'] ?? null,
    'status'           => 'em_analise',
    'utm_source'       => $utms['utm_source'],
    'utm_medium'       => $utms['utm_medium'],
    'utm_campaign'     => $utms['utm_campaign'],
    'url_parceiro'     => $urlFinal,
]);

// TODO: quando o parceiro tiver um webhook/retorno confirmando a
// contratação (mudando o status pra 'proposta_concluida'), disparar:
//
//   require __DIR__ . '/../EmailService.php';
//   $stmtUser = $pdo->prepare('SELECT nome, email FROM usuarios WHERE id = :id');
//   $stmtUser->execute(['id' => $userId]);
//   (new EmailService())->enviarParabensContratacao($stmtUser->fetch(), $produto);
//
// E quando a checagem automática de propostas pré-aprovadas (Cenário A)
// estiver integrada, disparar no momento em que a linha com
// status='pre_aprovado' for inserida:
//
//   (new EmailService())->enviarPropostaPreAprovada($usuario, $produto, $valor);

header('Location: ' . $urlFinal);
exit;
