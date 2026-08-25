<?php
/**
 * painel/includes/header-logado.php
 * Espera as seguintes variáveis já definidas por quem faz include():
 *   $nomeExibicao (string) - primeiro nome do usuário, já com htmlspecialchars
 *   $abaAtiva     (string) - 'ofertas' | 'historico' | 'conta'
 *   $temPropostaPreAprovada (bool) - controla o banner de urgência (opcional, default false)
 */
$abaAtiva = $abaAtiva ?? 'ofertas';
$temPropostaPreAprovada = $temPropostaPreAprovada ?? false;
?>
<div class="painel-top-bar">Atenção! A Libera Cash não cobra nenhum depósito antecipado para a liberação de empréstimo.</div>

<header class="painel-header">
  <div class="painel-header__inner">
    <img src="/images/logo-full-white-text.png?v=2" alt="LiberaCash" class="painel-logo">

    <nav class="painel-nav" aria-label="Navegação do painel">
      <a href="/painel/index.php" class="painel-nav__link <?php echo $abaAtiva === 'ofertas' ? 'is-active' : ''; ?>">Minhas Ofertas</a>
      <a href="/painel/historico.php" class="painel-nav__link <?php echo $abaAtiva === 'historico' ? 'is-active' : ''; ?>">Histórico</a>
      <a href="/painel/minha-conta.php" class="painel-nav__link <?php echo $abaAtiva === 'conta' ? 'is-active' : ''; ?>">Minha Conta</a>
    </nav>

    <div class="painel-header__saudacao">
      <span class="painel-saudacao-texto">Olá, <?php echo $nomeExibicao; ?>!</span>
      <button type="button" id="btnLogout" class="painel-btn-logout">
        <i class="fas fa-sign-out-alt"></i> Sair
      </button>
    </div>
  </div>

  <?php if ($temPropostaPreAprovada): ?>
  <div class="painel-banner-urgencia">
    <i class="fas fa-bolt"></i>
    Olá, <?php echo $nomeExibicao; ?>! Encontramos propostas pré-aprovadas no seu CPF.
  </div>
  <?php endif; ?>
</header>

<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="/css/brand-tokens.css?<?= uniqid() ?>" rel="stylesheet">
<style>
body { padding-top: 32px; }

.painel-top-bar {
  background: var(--lc-gradient-dark, linear-gradient(160deg, #123A22, #081A0F));
  color: var(--lc-off-white, #EAFBEF);
  height: 32px; padding: 0 16px; display: flex; align-items: center; justify-content: center;
  text-align: center; font-size: 11px; font-family: var(--lc-font-body, 'Inter', sans-serif);
  position: fixed; top: 0; left: 0; width: 100%; z-index: 1001;
}

.painel-header { background: var(--lc-gradient-dark, linear-gradient(160deg, #123A22, #081A0F)); position: sticky; top: 32px; z-index: 1000; }
.painel-header__inner {
  max-width: 1100px; margin: 0 auto; padding: 16px 24px;
  display: flex; align-items: center; justify-content: space-between;
  flex-wrap: wrap; gap: 14px;
}
.painel-logo { height: 40px; object-fit: contain; }

.painel-nav { display: flex; gap: 4px; flex-wrap: wrap; }
.painel-nav__link {
  text-decoration: none; font-family: var(--lc-font-body, 'Inter', sans-serif); font-weight: 600;
  font-size: 13.5px; color: rgba(234,251,239,0.65); padding: 8px 14px; border-radius: var(--lc-radius-full, 999px); transition: all .2s;
}
.painel-nav__link:hover { background: rgba(255,255,255,0.08); color: var(--lc-off-white, #EAFBEF); }
.painel-nav__link.is-active { background: var(--lc-gradient-brand, linear-gradient(135deg, #83E167, #6BE193)); color: var(--lc-text-dark, #0C2F1B); }

.painel-header__saudacao { display: flex; align-items: center; gap: 16px; }
.painel-saudacao-texto { font-family: var(--lc-font-display, 'Space Grotesk', sans-serif); font-weight: 600; font-size: 15px; color: var(--lc-off-white, #EAFBEF); }
.painel-btn-logout {
  background: rgba(255,255,255,0.06); border: 1.5px solid rgba(255,255,255,0.18); color: var(--lc-off-white, #EAFBEF); padding: 8px 16px;
  border-radius: var(--lc-radius-full, 999px); font-size: 13px; font-weight: 600; font-family: var(--lc-font-body, 'Inter', sans-serif); cursor: pointer; transition: all 0.2s;
}
.painel-btn-logout:hover { background: rgba(255,255,255,0.14); }

.painel-banner-urgencia {
  background: var(--lc-gradient-brand, linear-gradient(135deg, #83E167, #6BE193));
  color: var(--lc-text-dark, #0C2F1B); text-align: center; font-weight: 700; font-size: 14px;
  padding: 10px 16px; font-family: var(--lc-font-body, 'Inter', sans-serif);
}
.painel-banner-urgencia i { margin-right: 6px; }

@media (max-width: 768px) {
  .painel-header__inner { justify-content: center; }
  .painel-nav { order: 3; width: 100%; justify-content: center; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var btn = document.getElementById('btnLogout');
  if (btn) {
    btn.addEventListener('click', function () {
      fetch('/logout.php', { method: 'POST', credentials: 'same-origin' })
        .finally(function () { window.location.href = '/'; });
    });
  }
});
</script>
