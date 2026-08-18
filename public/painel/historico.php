<?php
/**
 * painel/historico.php
 * Tabela/grid com o histórico de simulações e solicitações do usuário.
 */

declare(strict_types=1);
session_start();

if (empty($_SESSION['user_id'])) {
    header('Location: /');
    exit;
}

require __DIR__ . '/../db.php';
require __DIR__ . '/../produtos-config.php';

$userId = (int)$_SESSION['user_id'];

$stmt = $pdo->prepare('SELECT id, nome FROM usuarios WHERE id = :id LIMIT 1');
$stmt->execute(['id' => $userId]);
$usuario = $stmt->fetch();
if (!$usuario) { session_destroy(); header('Location: /'); exit; }
$nomeExibicao = htmlspecialchars(explode(' ', trim($usuario['nome']))[0] ?: $usuario['nome'], ENT_QUOTES, 'UTF-8');

$stmt = $pdo->prepare('SELECT * FROM historico_solicitacoes WHERE user_id = :id ORDER BY criado_em DESC');
$stmt->execute(['id' => $userId]);
$solicitacoes = $stmt->fetchAll();

$statusLabel = [
    'pre_aprovado'        => ['texto' => 'Pré-Aprovado', 'classe' => 'status--pre-aprovado'],
    'em_analise'          => ['texto' => 'Em Análise', 'classe' => 'status--em-analise'],
    'proposta_concluida'  => ['texto' => 'Proposta Concluída', 'classe' => 'status--concluida'],
    'recusado'            => ['texto' => 'Recusado', 'classe' => 'status--recusado'],
];

$abaAtiva = 'historico';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Meu Histórico — Crédito.vc</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700;800&family=Lato:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<?php include __DIR__ . '/includes/header-logado.php'; ?>

<main class="painel-main">
  <section class="painel-secao">
    <h2 class="painel-secao-titulo">Histórico de solicitações</h2>

    <?php if (!$solicitacoes): ?>
      <div class="historico-vazio">
        <i class="fas fa-folder-open"></i>
        <p>Você ainda não tem nenhuma solicitação. Assim que você ver uma oferta no painel, ela aparece aqui.</p>
        <a href="/painel/index.php" class="oferta-card__btn" style="display:inline-block; width:auto; padding:12px 28px;">Ver minhas ofertas</a>
      </div>
    <?php else: ?>
      <div class="historico-tabela">
        <div class="historico-tabela__cabecalho">
          <span>Data</span><span>Produto / Parceiro</span><span>Valor</span><span>Status</span><span></span>
        </div>
        <?php foreach ($solicitacoes as $s):
          $produtoInfo = get_product_by_slug($s['produto_slug']);
          $status = $statusLabel[$s['status']] ?? ['texto' => $s['status'], 'classe' => '']; ?>
          <div class="historico-linha">
            <span data-label="Data"><?php echo (new DateTime($s['criado_em']))->format('d/m/Y'); ?></span>
            <span data-label="Produto / Parceiro">
              <strong><?php echo htmlspecialchars($produtoInfo['nome'] ?? $s['produto_slug']); ?></strong><br>
              <small><?php echo htmlspecialchars($s['parceiro'] ?: '—'); ?></small>
            </span>
            <span data-label="Valor"><?php echo $s['valor_solicitado'] ? 'R$ ' . number_format((float)$s['valor_solicitado'], 2, ',', '.') : '—'; ?></span>
            <span data-label="Status"><span class="status-pill <?php echo $status['classe']; ?>"><?php echo htmlspecialchars($status['texto']); ?></span></span>
            <span data-label="">
              <?php if ($s['status'] !== 'proposta_concluida' && $s['url_parceiro']): ?>
                <a href="<?php echo htmlspecialchars($s['url_parceiro']); ?>" class="btn-continuar">Continuar Proposta</a>
              <?php endif; ?>
            </span>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </section>
</main>

<?php include __DIR__ . '/includes/footer-logado.php'; ?>

<style>
* { box-sizing: border-box; }
body { margin: 0; font-family: 'Lato', sans-serif; background: #f5f7f6; color: #333; }
.painel-main { max-width: 1100px; margin: 0 auto; padding: 28px 24px 60px; }
.painel-secao-titulo { font-family: 'Raleway', sans-serif; font-size: 20px; font-weight: 800; margin-bottom: 16px; }

.historico-vazio { background: #fff; border-radius: 16px; padding: 40px; text-align: center; color: #888; }
.historico-vazio i { font-size: 32px; margin-bottom: 12px; color: #ccc; }
.historico-vazio p { margin-bottom: 18px; }

.historico-tabela { background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
.historico-tabela__cabecalho, .historico-linha {
  display: grid; grid-template-columns: 100px 2fr 1fr 1fr 140px; gap: 12px; padding: 16px 20px; align-items: center;
}
.historico-tabela__cabecalho { background: #fafafa; font-size: 12px; font-weight: 700; color: #888; text-transform: uppercase; }
.historico-linha { border-top: 1px solid #f0f0f0; font-size: 14px; }
.status-pill { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; }
.status--pre-aprovado { background: #f0fff4; color: #1e8449; }
.status--em-analise { background: #fff8e6; color: #b8860b; }
.status--concluida { background: #eaf3ff; color: #1a5fb4; }
.status--recusado { background: #fdecea; color: #c0392b; }
.btn-continuar { font-size: 12px; font-weight: 700; color: #1e8449; text-decoration: none; border: 1.5px solid #7ed684; padding: 6px 12px; border-radius: 20px; }
.btn-continuar:hover { background: #f0fff4; }

@media (max-width: 768px) {
  .historico-tabela__cabecalho { display: none; }
  .historico-linha { grid-template-columns: 1fr; gap: 4px; padding: 16px; }
  .historico-linha span[data-label]::before { content: attr(data-label) ": "; font-weight: 700; color: #999; font-size: 11px; text-transform: uppercase; }
  .historico-linha span[data-label=""]::before { content: none; }
}
</style>
</body>
</html>
