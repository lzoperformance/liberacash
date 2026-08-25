<?php
/**
 * produtos.php
 * Página de entrada do fluxo "6 cards": o usuário escolhe o tipo de crédito
 * ANTES de informar qualquer dado (diferente do Simule Grátis, que só filtra
 * as opções depois de coletar o valor desejado).
 *
 * Uso:
 *  - Acesso direto: /produtos.php            -> abre o modal no step de escolha (6 cards)
 *  - Com produto pré-selecionado via URL:
 *      /produtos.php?produto=garantia-celular -> pula direto pra "Dados pessoais"
 */
require_once __DIR__ . '/produtos-config.php';
$produtos_ativos = get_products_ordered();

// Se veio ?produto=slug na URL, valida que existe antes de repassar pro JS
$produto_url = isset($_GET['produto']) ? trim($_GET['produto']) : null;
if ($produto_url && !get_product_by_slug($produto_url)) {
    $produto_url = null; // slug inválido, ignora
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Escolha seu crédito | LiberaCash</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/brand-tokens.css?<?= uniqid() ?>" rel="stylesheet" type="text/css">
  <!-- Phosphor Icons (usado nos ícones dos cards de produto) -->
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>

<!-- ========== SEÇÃO DE ENTRADA (6 CARDS) ========== -->
<section class="produtos-hero">
  <h1>Escolha o crédito ideal para você</h1>
  <p>Selecione uma opção abaixo e simule em poucos minutos.</p>

  <div class="produtos-grid">
    <?php foreach ($produtos_ativos as $prod): ?>
    <button
      type="button"
      class="btn-open-modal produtos-card"
      data-entry="produtos"
      data-produto="<?php echo htmlspecialchars($prod['slug']); ?>"
    >
      <i class="ph <?php echo htmlspecialchars($prod['icone']); ?>"></i>
      <span class="produtos-card__nome"><?php echo htmlspecialchars($prod['nome']); ?></span>
      <span class="produtos-card__desc"><?php echo htmlspecialchars($prod['descricao_curta']); ?></span>
    </button>
    <?php endforeach; ?>
  </div>
</section>

<style>
.produtos-hero {
  max-width: 900px;
  margin: 60px auto;
  text-align: center;
  padding: 0 20px;
  font-family: 'Lato', sans-serif;
}
.produtos-hero h1 {
  font-family: 'Raleway', sans-serif;
  font-size: 32px;
  font-weight: 800;
  color: #333;
  margin-bottom: 8px;
}
.produtos-hero > p {
  color: #666;
  margin-bottom: 32px;
}
.produtos-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
}
@media (max-width: 768px) {
  .produtos-grid { grid-template-columns: repeat(2, 1fr); }
}
.produtos-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  padding: 28px 16px;
  border: 2px solid #e0e0e0;
  border-radius: 16px;
  background: #fff;
  cursor: pointer;
  transition: all 0.2s;
  font-family: inherit;
}
.produtos-card:hover {
  border-color: #2ecc71;
  background: #f0fff4;
  transform: translateY(-2px);
}
.produtos-card i {
  font-size: 36px;
  color: #2ecc71;
}
.produtos-card__nome {
  font-weight: 700;
  font-size: 15px;
  color: #333;
}
.produtos-card__desc {
  font-size: 12px;
  color: #888;
}
</style>

<?php include __DIR__ . '/modal-credito.php'; ?>

<?php if ($produto_url): ?>
<script>
  // Produto veio pré-selecionado via URL (?produto=slug): abre o modal já pulando pra "Dados pessoais"
  document.addEventListener('DOMContentLoaded', function() {
    window.abrirModalProdutos('<?php echo htmlspecialchars($produto_url, ENT_QUOTES); ?>');
  });
</script>
<?php endif; ?>

</body>
</html>
