<?php
/**
 * painel/index.php
 * Dashboard da área logada — Crédito.vc
 */

declare(strict_types=1);
session_start();

if (empty($_SESSION['user_id'])) {
    header('Location: /');
    exit;
}

require __DIR__ . '/../db.php';                       // painel/ -> raiz do repo ($pdo)
require __DIR__ . '/../produtos-config.php';           // $products + helpers de produto
require __DIR__ . '/includes/funcoes-perfil.php';      // completude, cobertura, campos do modal

$userId = (int)$_SESSION['user_id'];

// ---------------------------------------------------------------------
// Carrega usuário + perfil
// ---------------------------------------------------------------------
$stmt = $pdo->prepare('SELECT id, nome, email FROM usuarios WHERE id = :id LIMIT 1');
$stmt->execute(['id' => $userId]);
$usuario = $stmt->fetch();

if (!$usuario) {
    session_destroy();
    header('Location: /');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM perfil_usuario WHERE user_id = :id LIMIT 1');
$stmt->execute(['id' => $userId]);
$perfil = $stmt->fetch() ?: [];

$nomeExibicao = htmlspecialchars(explode(' ', trim($usuario['nome']))[0] ?: $usuario['nome'], ENT_QUOTES, 'UTF-8');

// ---------------------------------------------------------------------
// Propostas pré-aprovadas (Cenário A) — vêm de checagens automáticas de
// API já registradas em historico_solicitacoes. Enquanto as integrações
// dos parceiros não estiverem plugadas, essa lista fica vazia e cai no
// Cenário B (aviso amigável) — é o comportamento esperado, não um bug.
// ---------------------------------------------------------------------
$stmt = $pdo->prepare(
    "SELECT * FROM historico_solicitacoes WHERE user_id = :id AND status = 'pre_aprovado' ORDER BY criado_em DESC"
);
$stmt->execute(['id' => $userId]);
$propostasPreAprovadas = $stmt->fetchAll();

$temPropostaPreAprovada = count($propostasPreAprovadas) > 0;

// ---------------------------------------------------------------------
// Produtos: status de cada um (liberado / bloqueado) + campos faltantes
// ---------------------------------------------------------------------
$produtosOrdenados = get_products_ordered();
$produtosComStatus = [];
foreach ($produtosOrdenados as $produto) {
    $liberado = produto_liberado_completo($produto, $perfil);
    $produtosComStatus[] = [
        'produto'  => $produto,
        'liberado' => $liberado,
        'grupos_faltantes' => $liberado ? [] : grupos_necessarios_para_produto($produto['campos_necessarios']),
    ];
}

$abaAtiva = 'ofertas';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Meu Painel — Crédito.vc</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700;800&family=Lato:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>

<?php include __DIR__ . '/includes/header-logado.php'; ?>

<main class="painel-main">

  <!-- ========== CALCULADORA / SLIDER ========== -->
  <section class="painel-calc">
    <div class="painel-calc__topo">
      <span>De quanto você precisa?</span>
      <span class="painel-calc__valor" id="calcValorLabel">R$ 15.000</span>
    </div>
    <input type="range" id="calcSlider" min="500" max="50000" step="500" value="15000" class="painel-calc__slider">
    <div class="painel-calc__faixa"><span>R$ 500</span><span>R$ 50.000</span></div>
  </section>

  <!-- ========== PROPOSTAS PRÉ-APROVADAS ========== -->
  <section class="painel-secao">
    <h2 class="painel-secao-titulo">Propostas pré-aprovadas para você</h2>

    <?php if ($temPropostaPreAprovada): ?>
      <div class="painel-grid">
        <?php foreach ($propostasPreAprovadas as $proposta):
          $prodInfo = get_product_by_slug($proposta['produto_slug']); ?>
          <div class="proposta-card">
            <div class="proposta-card__parceiro"><?php echo htmlspecialchars($proposta['parceiro'] ?: 'Parceiro Crédito.vc'); ?></div>
            <div class="proposta-card__valor">
              R$ <?php echo number_format((float)($proposta['valor_solicitado'] ?? 0), 2, ',', '.'); ?>
            </div>
            <p class="proposta-card__produto"><?php echo htmlspecialchars($prodInfo['nome'] ?? $proposta['produto_slug']); ?></p>
            <a href="<?php echo htmlspecialchars($proposta['url_parceiro'] ?: '#'); ?>" class="oferta-card__btn">Contratar agora</a>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="aviso-sem-proposta">
        <i class="fas fa-info-circle"></i>
        <p>
          No momento não encontramos propostas pré-aprovadas automáticas apenas com o seu CPF.
          Mas não se preocupe! Complete os dados do seu perfil abaixo para liberarmos ofertas
          no Consignado, Conta de Luz ou com Garantia.
        </p>
      </div>
    <?php endif; ?>
  </section>

  <!-- ========== PRATELEIRA DE PRODUTOS (6 cards) ========== -->
  <section class="painel-secao">
    <h2 class="painel-secao-titulo">Todas as opções de crédito</h2>
    <div class="painel-grid painel-grid--produtos" id="gridProdutos">
      <?php foreach ($produtosComStatus as $item):
        $produto = $item['produto']; ?>
        <div class="oferta-card <?php echo $item['liberado'] ? 'oferta-card--ativa' : 'oferta-card--bloqueada'; ?>"
             data-valor-min="<?php echo (int)$produto['valor_min']; ?>"
             data-valor-max="<?php echo (int)$produto['valor_max']; ?>">

          <?php if (!empty($produto['selos'])): ?>
            <div class="oferta-card__selos">
              <?php foreach ($produto['selos'] as $selo): ?>
                <span class="selo <?php echo strpos($selo, 'DINHEIRO') !== false ? 'selo--raio' : ''; ?>">
                  <?php echo strpos($selo, 'DINHEIRO') !== false ? '⚡' : '🟢'; ?> <?php echo htmlspecialchars($selo); ?>
                </span>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <div class="oferta-card__icone"><i class="ph <?php echo htmlspecialchars($produto['icone']); ?>"></i></div>
          <h3 class="oferta-card__titulo"><?php echo htmlspecialchars($produto['nome']); ?></h3>
          <p class="oferta-card__desc"><?php echo htmlspecialchars($produto['descricao']); ?></p>

          <?php if ($item['liberado']): ?>
            <span class="oferta-card__status oferta-card__status--ativa"><i class="fas fa-check-circle"></i> Disponível</span>
            <a href="/painel/ir-para-parceiro.php?produto=<?php echo urlencode($produto['slug']); ?>" class="oferta-card__btn">Ver oferta</a>
          <?php else: ?>
            <span class="oferta-card__status oferta-card__status--bloqueada"><i class="fas fa-lock"></i> Bloqueado</span>
            <button type="button" class="oferta-card__btn oferta-card__btn--desbloquear"
                    data-produto="<?php echo htmlspecialchars($produto['slug']); ?>">
              Desbloquear oferta
            </button>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- ========== CARROSSEL DE BLOG ========== -->
  <section class="painel-secao">
    <h2 class="painel-secao-titulo">Conteúdo para você</h2>
    <div class="blog-carrossel" id="blogCarrossel">
      <a href="/blog.php?post=aumentar-chances-aprovacao" class="blog-card">
        <div class="blog-card__img" style="background-image:url('/images/blog/aumentar-chances.jpg')"></div>
        <h3>Como aumentar suas chances de ter crédito aprovado</h3>
      </a>
      <a href="/blog.php?post=organizar-financas" class="blog-card">
        <div class="blog-card__img" style="background-image:url('/images/blog/organizar-financas.jpg')"></div>
        <h3>5 passos para organizar as finanças antes de pedir crédito</h3>
      </a>
      <a href="/blog.php?post=score-credito" class="blog-card">
        <div class="blog-card__img" style="background-image:url('/images/blog/score-credito.jpg')"></div>
        <h3>Entenda como funciona o seu score de crédito</h3>
      </a>
    </div>
  </section>

</main>

<?php include __DIR__ . '/includes/footer-logado.php'; ?>

<!-- ========== MODAL DE QUALIFICAÇÃO DINÂMICO ========== -->
<div class="modal-overlay" id="modalQualificacao" aria-hidden="true" role="dialog">
  <div class="modal-box">
    <button class="modal-close-btn" id="modalQualificacaoClose" aria-label="Fechar"><i class="fas fa-times"></i></button>
    <h2 class="modal-title" id="modalQualificacaoTitle">Complete seu perfil</h2>
    <p class="modal-subtitle">Só mais um passo para desbloquear essa oferta.</p>
    <div class="alert-box" id="modalQualificacaoAlert" style="display:none"></div>

    <form id="formQualificacao" class="modal-form active" novalidate>
      <input type="hidden" id="q_produto_slug" name="produto_slug" value="">

      <!-- Grupo: endereço -->
      <div class="campo-grupo" data-grupo="endereco" style="display:none">
        <div class="form-group">
          <div class="input-with-icon">
            <input type="text" id="q_cep" name="cep" placeholder="CEP (Apenas Números)" maxlength="9" inputmode="numeric">
            <span class="input-icon" id="q_cepLoader" style="display:none"><i class="fas fa-spinner fa-spin"></i></span>
          </div>
        </div>
        <div class="form-group"><input type="text" id="q_logradouro" name="logradouro" placeholder="Logradouro"></div>
        <div class="form-group"><input type="text" id="q_numero" name="numero" placeholder="Número"></div>
        <div class="form-group"><input type="text" id="q_bairro" name="bairro" placeholder="Bairro"></div>
        <div class="form-group"><input type="text" id="q_cidade" name="cidade" placeholder="Cidade"></div>
        <div class="form-group">
          <select id="q_estado" name="estado">
            <option value="">Estado (UF)</option>
            <option value="AC">AC</option><option value="AL">AL</option><option value="AP">AP</option>
            <option value="AM">AM</option><option value="BA">BA</option><option value="CE">CE</option>
            <option value="DF">DF</option><option value="ES">ES</option><option value="GO">GO</option>
            <option value="MA">MA</option><option value="MT">MT</option><option value="MS">MS</option>
            <option value="MG">MG</option><option value="PA">PA</option><option value="PB">PB</option>
            <option value="PR">PR</option><option value="PE">PE</option><option value="PI">PI</option>
            <option value="RJ">RJ</option><option value="RN">RN</option><option value="RS">RS</option>
            <option value="RO">RO</option><option value="RR">RR</option><option value="SC">SC</option>
            <option value="SP">SP</option><option value="SE">SE</option><option value="TO">TO</option>
          </select>
        </div>
      </div>

      <!-- Grupo: renda -->
      <div class="campo-grupo" data-grupo="renda" style="display:none">
        <div class="form-group">
          <select id="q_fonte_renda" name="fonte_renda">
            <option value="" disabled selected>Fonte de renda</option>
            <option value="assalariado_clt">Assalariado (CLT)</option>
            <option value="autonomo">Autônomo</option>
            <option value="empresario">Empresário</option>
            <option value="aposentado_pensionista">Aposentado/Pensionista</option>
            <option value="servidor_publico">Servidor Público</option>
            <option value="militar">Militar</option>
            <option value="desempregado">Desempregado</option>
          </select>
        </div>
        <div class="form-group"><input type="text" id="q_renda_mensal" name="renda_mensal" placeholder="Renda Mensal Aproximada" inputmode="decimal"></div>
      </div>

      <!-- Grupo: negativado -->
      <div class="campo-grupo" data-grupo="negativado" style="display:none">
        <div class="radio-group-wrapper full-width">
          <label>Você está com o nome negativado?</label>
          <div class="radio-group">
            <label class="radio-option"><input type="radio" name="negativado" value="sim"><span>Sim</span></label>
            <label class="radio-option"><input type="radio" name="negativado" value="nao"><span>Não</span></label>
            <label class="radio-option"><input type="radio" name="negativado" value="nao_sei"><span>Não sei</span></label>
          </div>
        </div>
      </div>

      <!-- Grupo: celular -->
      <div class="campo-grupo" data-grupo="celular" style="display:none">
        <div class="form-group"><input type="text" id="q_modelo_celular" name="modelo_celular" placeholder="Modelo do celular"></div>
        <div class="form-group">
          <select id="q_sistema_celular" name="sistema_celular">
            <option value="">Sistema operacional</option>
            <option value="android">Android</option>
            <option value="ios">iOS</option>
          </select>
        </div>
      </div>

      <!-- Grupo: data de nascimento -->
      <div class="campo-grupo" data-grupo="data_nascimento" style="display:none">
        <div class="form-group"><input type="date" id="q_data_nascimento" name="data_nascimento" placeholder="Data de nascimento"></div>
      </div>

      <button type="submit" class="modal-btn-submit full-width" id="btnQualificacao">Salvar e Desbloquear</button>
    </form>
  </div>
</div>

<!-- ========== ANIMAÇÃO DE PROCESSAMENTO (Labor Illusion) ========== -->
<div class="overlay-processando" id="overlayProcessando" aria-hidden="true">
  <div class="overlay-processando__box">
    <div class="spinner"></div>
    <p id="overlayProcessandoTexto">Buscando melhores condições nas instituições...</p>
  </div>
</div>

<!-- ========== ESTILOS ========== -->
<style>
* { box-sizing: border-box; }
body { margin: 0; font-family: 'Lato', sans-serif; background: #f5f7f6; color: #333; }

.painel-main { max-width: 1100px; margin: 0 auto; padding: 28px 24px 60px; }
.painel-secao { margin-bottom: 36px; }
.painel-secao-titulo { font-family: 'Raleway', sans-serif; font-size: 20px; font-weight: 800; color: #333; margin-bottom: 16px; }
.painel-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 18px; }
.painel-grid--produtos { grid-template-columns: repeat(3, 1fr); }
@media (max-width: 900px) { .painel-grid--produtos { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 600px) { .painel-grid--produtos { grid-template-columns: 1fr; } }

/* --- Calculadora --- */
.painel-calc { background: #fff; border-radius: 16px; padding: 20px 24px; margin: 24px 0 36px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
.painel-calc__topo { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 10px; font-weight: 700; }
.painel-calc__valor { color: #1e8449; font-size: 20px; font-family: 'Raleway', sans-serif; }
.painel-calc__slider { width: 100%; accent-color: #2ecc71; }
.painel-calc__faixa { display: flex; justify-content: space-between; font-size: 12px; color: #999; margin-top: 4px; }

/* --- Aviso sem proposta (Cenário B) --- */
.aviso-sem-proposta {
  background: #fff8e6; border: 1px solid #ffe4a3; border-radius: 16px;
  padding: 20px 22px; display: flex; gap: 14px; align-items: flex-start;
}
.aviso-sem-proposta i { color: #e6a817; font-size: 20px; margin-top: 2px; }
.aviso-sem-proposta p { margin: 0; font-size: 14px; color: #7a5c00; line-height: 1.5; }

/* --- Proposta pré-aprovada (Cenário A) --- */
.proposta-card { background: #fff; border-radius: 16px; padding: 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); border: 2px solid #d7f5e0; }
.proposta-card__parceiro { font-size: 12px; font-weight: 700; color: #999; text-transform: uppercase; }
.proposta-card__valor { font-family: 'Raleway', sans-serif; font-size: 24px; font-weight: 800; color: #1e8449; margin: 4px 0; }
.proposta-card__produto { font-size: 13px; color: #666; margin: 0 0 14px; }

/* --- Oferta Card --- */
.oferta-card {
  background: #fff; border-radius: 16px; padding: 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.06);
  border: 2px solid transparent; display: flex; flex-direction: column; gap: 8px; transition: box-shadow 0.2s;
}
.oferta-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.1); }
.oferta-card--ativa { border-color: #d7f5e0; }
.oferta-card--bloqueada { border-color: #eee; background: #fafafa; }
.oferta-card--filtrado-fora { display: none; }

.oferta-card__selos { display: flex; flex-wrap: wrap; gap: 4px; margin-bottom: 2px; }
.selo { font-size: 10px; font-weight: 800; background: #f0fff4; color: #1e8449; padding: 3px 8px; border-radius: 20px; }
.selo--raio { background: #fff8e6; color: #b8860b; }

.oferta-card__icone {
  width: 46px; height: 46px; border-radius: 12px; background: #f0fff4;
  display: flex; align-items: center; justify-content: center; font-size: 22px; color: #2ecc71; margin-bottom: 4px;
}
.oferta-card--bloqueada .oferta-card__icone { background: #f0f0f0; color: #aaa; }
.oferta-card__titulo { font-family: 'Raleway', sans-serif; font-size: 16px; font-weight: 700; color: #333; margin: 0; }
.oferta-card__desc { font-size: 13px; color: #666; margin: 0; line-height: 1.4; flex-grow: 1; }
.oferta-card__status { display: inline-flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 700; width: fit-content; padding: 4px 10px; border-radius: 20px; }
.oferta-card__status--ativa { color: #1e8449; background: #f0fff4; }
.oferta-card__status--bloqueada { color: #999; background: #f0f0f0; }
.oferta-card__btn {
  display: block; text-align: center; text-decoration: none; background: #2ecc71; color: #fff;
  padding: 11px 16px; border-radius: 25px; font-size: 14px; font-weight: 700; border: none;
  cursor: pointer; margin-top: 4px; transition: background 0.2s;
}
.oferta-card__btn:hover { background: #27ae60; }
.oferta-card__btn--desbloquear { background: #fff; color: #1e8449; border: 1.5px solid #7ed684; }
.oferta-card__btn--desbloquear:hover { background: #f0fff4; }

/* --- Carrossel de blog --- */
.blog-carrossel { display: flex; gap: 16px; overflow-x: auto; padding-bottom: 8px; }
.blog-card { flex: 0 0 240px; text-decoration: none; color: #333; }
.blog-card__img { height: 140px; border-radius: 14px; background-size: cover; background-position: center; background-color: #e0e0e0; margin-bottom: 8px; }
.blog-card h3 { font-size: 14px; font-weight: 700; line-height: 1.35; margin: 0; }

/* --- Modal (mesmo padrão do site) --- */
.modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); display: none; justify-content: center; align-items: center; z-index: 9999; padding: 20px; }
.modal-overlay.is-open { display: flex; }
.modal-box { background: #fff; width: 100%; max-width: 460px; border-radius: 20px; padding: 30px 25px; position: relative; box-shadow: 0 10px 40px rgba(0,0,0,0.2); max-height: 90vh; overflow-y: auto; animation: modalSlideUp .4s ease; }
@keyframes modalSlideUp { from { transform: translateY(40px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
.modal-close-btn { position: absolute; top: 12px; right: 15px; background: #2ecc71; color: #fff; border: none; border-radius: 50%; width: 32px; height: 32px; font-size: 16px; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10; }
.modal-close-btn:hover { background: #27ae60; }
.modal-title { font-family: 'Raleway', sans-serif; font-size: 22px; font-weight: 800; color: #333; text-align: center; margin-bottom: 8px; }
.modal-subtitle { font-size: 14px; color: #555; text-align: center; margin-bottom: 18px; }
.alert-box { border-radius: 10px; padding: 10px 14px; font-size: 13px; margin-bottom: 14px; text-align: center; }
.alert-box.is-error { background: #fdecea; border: 1px solid #f5c6cb; color: #c0392b; }
.alert-box.is-success { background: #f0fff4; border: 1px solid #7ed684; color: #1e8449; }
.modal-form { display: flex; flex-direction: column; gap: 12px; }
.campo-grupo { display: flex; flex-direction: column; gap: 12px; }
.form-group { position: relative; }
.modal-form input, .modal-form select { width: 100%; padding: 12px 20px; border: 1px solid #7ed684; border-radius: 25px; font-size: 14px; font-family: 'Lato', sans-serif; color: #333; outline: none; background: #fff; transition: border 0.3s; }
.modal-form input:focus, .modal-form select:focus { border-color: #2ecc71; box-shadow: 0 0 5px rgba(46,204,113,.3); }
.input-with-icon { position: relative; }
.input-icon { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: #2ecc71; }
.radio-group-wrapper { padding: 5px 0; }
.radio-group-wrapper > label { display: block; font-size: 14px; font-weight: 500; color: #333; margin-bottom: 8px; }
.radio-group { display: flex; gap: 8px; flex-wrap: wrap; }
.radio-option { flex: 1; min-width: 70px; cursor: pointer; }
.radio-option input { display: none; }
.radio-option span { display: block; padding: 10px 16px; border: 1px solid #7ed684; border-radius: 25px; text-align: center; font-size: 13px; font-weight: 600; color: #555; background: #fff; transition: all .2s; }
.radio-option input:checked + span { border-color: #2ecc71; background: #2ecc71; color: #fff; }
.modal-btn-submit { width: 100%; background: #2ecc71; color: #fff; padding: 14px 20px; border: none; border-radius: 30px; font-size: 16px; font-weight: bold; cursor: pointer; margin-top: 8px; transition: background .3s; }
.modal-btn-submit:hover { background: #27ae60; }
.modal-btn-submit:disabled { background: #a8dab3; cursor: not-allowed; }

/* --- Overlay de processamento (Labor Illusion) --- */
.overlay-processando { position: fixed; inset: 0; background: rgba(255,255,255,0.94); display: none; align-items: center; justify-content: center; z-index: 10000; }
.overlay-processando.is-open { display: flex; }
.overlay-processando__box { text-align: center; font-family: 'Lato', sans-serif; }
.overlay-processando__box p { margin-top: 16px; font-weight: 700; color: #333; }
.spinner { width: 46px; height: 46px; border: 4px solid #d7f5e0; border-top-color: #2ecc71; border-radius: 50%; margin: 0 auto; animation: spin 0.8s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }

@media (max-width: 600px) { .modal-box { padding: 25px 20px; } }
</style>

<!-- ========== SCRIPT ========== -->
<script>
document.addEventListener('DOMContentLoaded', function () {

  // --- Slider / calculadora filtrando os cards em tempo real ---
  var slider = document.getElementById('calcSlider');
  var label  = document.getElementById('calcValorLabel');
  var cards  = document.querySelectorAll('#gridProdutos .oferta-card');

  function formatarMoeda(v) {
    return 'R$ ' + Number(v).toLocaleString('pt-BR');
  }
  function aplicarFiltro() {
    var valor = parseInt(slider.value, 10);
    label.textContent = formatarMoeda(valor);
    cards.forEach(function (card) {
      var min = parseInt(card.dataset.valorMin, 10);
      var max = parseInt(card.dataset.valorMax, 10);
      card.classList.toggle('oferta-card--filtrado-fora', valor < min || valor > max);
    });
  }
  slider.addEventListener('input', aplicarFiltro);
  aplicarFiltro();

  // --- Overlay de processamento (Labor Illusion) ---
  var overlay = document.getElementById('overlayProcessando');
  var overlayTexto = document.getElementById('overlayProcessandoTexto');
  function mostrarProcessando(texto, duracaoMs, callback) {
    overlayTexto.textContent = texto;
    overlay.classList.add('is-open');
    setTimeout(function () {
      overlay.classList.remove('is-open');
      if (callback) callback();
    }, duracaoMs);
  }

  // --- Modal de qualificação dinâmico ---
  var modal = document.getElementById('modalQualificacao');
  var modalClose = document.getElementById('modalQualificacaoClose');
  var modalTitle = document.getElementById('modalQualificacaoTitle');
  var modalAlert = document.getElementById('modalQualificacaoAlert');
  var form = document.getElementById('formQualificacao');
  var todosGrupos = ['endereco', 'renda', 'negativado', 'celular', 'data_nascimento'];

  // Grupos necessários por produto (espelha painel/includes/funcoes-perfil.php no back-end)
  var gruposPorProduto = <?php
    $mapaGrupos = [];
    foreach ($produtosComStatus as $item) {
        $mapaGrupos[$item['produto']['slug']] = $item['grupos_faltantes'];
    }
    echo json_encode($mapaGrupos, JSON_UNESCAPED_UNICODE);
  ?>;

  var titulosPorGrupo = {
    endereco: 'Complete seu endereço',
    renda: 'Conte sobre sua renda',
    negativado: 'Sobre seu nome no CPF',
    celular: 'Sobre o celular de garantia',
    data_nascimento: 'Sua data de nascimento'
  };

  function abrirModalQualificacao(produtoSlug) {
    var grupos = gruposPorProduto[produtoSlug] || [];
    if (!grupos.length) return;

    document.getElementById('q_produto_slug').value = produtoSlug;
    todosGrupos.forEach(function (g) {
      var el = form.querySelector('[data-grupo="' + g + '"]');
      el.style.display = grupos.indexOf(g) !== -1 ? 'flex' : 'none';
      el.querySelectorAll('input, select').forEach(function (campo) { campo.required = grupos.indexOf(g) !== -1; });
    });
    modalTitle.textContent = grupos.length === 1 ? titulosPorGrupo[grupos[0]] : 'Complete seu perfil';
    modalAlert.style.display = 'none';
    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }
  function fecharModalQualificacao() {
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }

  document.querySelectorAll('[data-produto]').forEach(function (btn) {
    btn.addEventListener('click', function () { abrirModalQualificacao(this.dataset.produto); });
  });
  modalClose.addEventListener('click', fecharModalQualificacao);
  modal.addEventListener('click', function (e) { if (e.target === modal) fecharModalQualificacao(); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && modal.classList.contains('is-open')) fecharModalQualificacao(); });

  // Máscaras
  function maskCEP(v) { return v.replace(/\D/g, '').slice(0, 8).replace(/(\d{5})(\d)/, '$1-$2'); }
  function maskMoney(v) { v = v.replace(/\D/g, ''); v = (parseInt(v || '0') / 100).toFixed(2); return 'R$ ' + v.replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.'); }
  var elCep = document.getElementById('q_cep');
  if (elCep) elCep.addEventListener('input', function () { this.value = maskCEP(this.value); });
  var elRenda = document.getElementById('q_renda_mensal');
  if (elRenda) elRenda.addEventListener('input', function () { this.value = maskMoney(this.value); });

  // ViaCEP
  if (elCep) {
    elCep.addEventListener('blur', function () {
      var cep = this.value.replace(/\D/g, '');
      if (cep.length !== 8) return;
      document.getElementById('q_cepLoader').style.display = 'inline';
      fetch('https://viacep.com.br/ws/' + cep + '/json/')
        .then(function (r) { return r.json(); })
        .then(function (data) {
          if (!data.erro) {
            document.getElementById('q_logradouro').value = data.logradouro || '';
            document.getElementById('q_bairro').value = data.bairro || '';
            document.getElementById('q_cidade').value = data.localidade || '';
            document.getElementById('q_estado').value = data.uf || '';
          }
        })
        .catch(function () {})
        .finally(function () { document.getElementById('q_cepLoader').style.display = 'none'; });
    });
  }

  async function postJSON(url, payload) {
    var resp = await fetch(url, { method: 'POST', headers: { 'Content-Type': 'application/json' }, credentials: 'same-origin', body: JSON.stringify(payload) });
    var data; try { data = await resp.json(); } catch (e) { data = {}; }
    return { ok: resp.ok, data: data };
  }

  form.addEventListener('submit', async function (e) {
    e.preventDefault();
    modalAlert.style.display = 'none';

    var payload = { produto_slug: document.getElementById('q_produto_slug').value };
    new FormData(form).forEach(function (v, k) { payload[k] = v; });

    var btn = document.getElementById('btnQualificacao');
    btn.disabled = true;

    try {
      var resp = await postJSON('/atualizar-perfil.php', payload);
      if (resp.ok && resp.data.success) {
        fecharModalQualificacao();
        mostrarProcessando('Buscando melhores condições nas instituições...', 3000, function () {
          window.location.reload();
        });
      } else {
        modalAlert.textContent = resp.data.message || 'Não foi possível salvar. Tente novamente.';
        modalAlert.className = 'alert-box is-error';
        modalAlert.style.display = 'block';
        btn.disabled = false;
      }
    } catch (err) {
      modalAlert.textContent = 'Erro de conexão. Tente novamente.';
      modalAlert.className = 'alert-box is-error';
      modalAlert.style.display = 'block';
      btn.disabled = false;
    }
  });

});
</script>

</body>
</html>
