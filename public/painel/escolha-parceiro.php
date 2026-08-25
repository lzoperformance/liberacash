<?php
/**
 * painel/escolha-parceiro.php
 * Quando um produto liberado tem mais de um parceiro (ex.: credito-pessoal
 * tem Velotax/SuperSim/NoVerde), mostra essa tela pro usuário escolher
 * qual parceiro quer seguir antes de ir pra ir-para-parceiro.php.
 * Produtos com um parceiro só pulam direto essa tela.
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
    header('Location: /painel/index.php');
    exit;
}

$parceiros = get_partners_for_product($produto);

// Só 1 parceiro: nada pra escolher, pula direto pro redirecionamento.
if (count($parceiros) <= 1) {
    $qs = http_build_query(array_merge($_GET, ['parceiro' => $parceiros[0]['id'] ?? '']));
    header('Location: /painel/ir-para-parceiro.php?' . $qs);
    exit;
}

$nomeExibicao = htmlspecialchars(explode(' ', trim($_SESSION['user_nome'] ?? ''))[0] ?: ($_SESSION['user_nome'] ?? ''), ENT_QUOTES, 'UTF-8');
$abaAtiva = 'ofertas';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Escolha o parceiro — LiberaCash</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="../css/brand-tokens.css?<?= uniqid() ?>" rel="stylesheet">
</head>
<body>

<?php include __DIR__ . '/includes/header-logado.php'; ?>

<main class="painel-main">
  <a href="/painel/index.php" class="voltar-link"><i class="fas fa-arrow-left"></i> Voltar</a>

  <section class="painel-secao">
    <h2 class="painel-secao-titulo">Escolha o parceiro para <?php echo htmlspecialchars($produto['nome']); ?></h2>
    <p class="escolha-subtitulo">Comparamos as opções disponíveis pro seu perfil — escolha uma pra continuar direto no site do parceiro.</p>

    <div class="parceiro-grid">
      <?php foreach ($parceiros as $p): ?>
        <div class="parceiro-card">
          <?php if (!empty($p['tem_api'])): ?>
            <span class="parceiro-selo"><i class="fas fa-bolt"></i> Pré-aprovação automática</span>
          <?php endif; ?>

          <div class="parceiro-card__logo">
            <?php if (!empty($p['logo'])): ?>
              <img src="/<?php echo htmlspecialchars($p['logo']); ?>" alt="<?php echo htmlspecialchars($p['nome']); ?>">
            <?php else: ?>
              <span class="parceiro-card__logo-placeholder"><?php echo htmlspecialchars(mb_substr($p['nome'], 0, 2)); ?></span>
            <?php endif; ?>
          </div>

          <h3 class="parceiro-card__nome"><?php echo htmlspecialchars($p['nome']); ?></h3>
          <p class="parceiro-card__desc"><?php echo htmlspecialchars($p['descricao_curta'] ?? ''); ?></p>

          <a href="/painel/ir-para-parceiro.php?produto=<?php echo urlencode($produto['slug']); ?>&parceiro=<?php echo urlencode($p['id']); ?>"
             class="parceiro-card__btn">Escolher <?php echo htmlspecialchars($p['nome']); ?></a>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</main>

<?php include __DIR__ . '/includes/footer-logado.php'; ?>

<style>
* { box-sizing: border-box; }
body { margin: 0; font-family: var(--lc-font-body, 'Inter', sans-serif); background: var(--lc-off-white, #EAFBEF); color: var(--lc-text-dark, #0C2F1B); }
.painel-main { max-width: 1000px; margin: 0 auto; padding: 24px 24px 60px; }
.voltar-link { display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: var(--lc-text-muted, #4B5F52); text-decoration: none; margin-bottom: 20px; }
.voltar-link:hover { color: var(--lc-green-900, #16562D); }

.painel-secao-titulo { font-family: var(--lc-font-display, 'Space Grotesk', sans-serif); font-size: 22px; font-weight: 600; margin: 0 0 8px; }
.escolha-subtitulo { font-size: 14px; color: var(--lc-text-muted, #4B5F52); margin: 0 0 28px; max-width: 560px; line-height: 1.5; }

.parceiro-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 18px; }
.parceiro-card {
  background: var(--lc-white, #fff); border-radius: var(--lc-radius-lg, 24px); padding: 24px;
  box-shadow: var(--lc-shadow-card, 0 2px 12px rgba(12,47,27,.08)); border: 2px solid transparent;
  display: flex; flex-direction: column; align-items: center; text-align: center; gap: 8px;
  transition: box-shadow .2s, transform .2s, border-color .2s;
}
.parceiro-card:hover { box-shadow: 0 10px 28px rgba(12,47,27,.12); transform: translateY(-2px); border-color: var(--lc-green-400, #83E167); }

.parceiro-selo {
  align-self: flex-start; font-size: 10px; font-weight: 800; background: #FFF8E9; color: #A97900;
  padding: 3px 10px; border-radius: var(--lc-radius-full, 999px); margin-bottom: 6px;
}

.parceiro-card__logo {
  width: 64px; height: 64px; border-radius: var(--lc-radius-md, 16px); background: var(--lc-surface, #F3FBF3);
  display: flex; align-items: center; justify-content: center; margin-bottom: 6px; overflow: hidden;
}
.parceiro-card__logo img { max-width: 100%; max-height: 100%; object-fit: contain; }
.parceiro-card__logo-placeholder { font-family: var(--lc-font-display, 'Space Grotesk', sans-serif); font-weight: 700; font-size: 20px; color: var(--lc-green-700, #368C52); }

.parceiro-card__nome { font-family: var(--lc-font-display, 'Space Grotesk', sans-serif); font-size: 17px; font-weight: 600; margin: 0; }
.parceiro-card__desc { font-size: 13px; color: var(--lc-text-muted, #4B5F52); margin: 0 0 8px; line-height: 1.4; flex-grow: 1; }

.parceiro-card__btn {
  width: 100%; text-align: center; text-decoration: none; background: var(--lc-gradient-brand, linear-gradient(135deg,#83E167,#6BE193));
  color: var(--lc-text-dark, #0C2F1B); padding: 12px 16px; border-radius: var(--lc-radius-md, 16px);
  font-size: 14px; font-weight: 700; box-shadow: 0 6px 14px rgba(131,225,103,.3); transition: transform .15s, box-shadow .15s;
}
.parceiro-card__btn:hover { transform: translateY(-1px); box-shadow: 0 8px 18px rgba(131,225,103,.4); }
</style>

</body>
</html>
