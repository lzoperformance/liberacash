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
<header class="painel-header">
  <div class="painel-header__inner">
    <img src="/images/logo-creditovc.png" alt="Crédito.vc" class="painel-logo">

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

<style>
.painel-header { background: #ffffff; border-bottom: 1px solid #e6e6e6; }
.painel-header__inner {
  max-width: 1100px; margin: 0 auto; padding: 16px 24px;
  display: flex; align-items: center; justify-content: space-between;
  flex-wrap: wrap; gap: 14px;
}
.painel-logo { height: 38px; object-fit: contain; }

.painel-nav { display: flex; gap: 6px; flex-wrap: wrap; }
.painel-nav__link {
  text-decoration: none; font-family: 'Lato', sans-serif; font-weight: 700;
  font-size: 14px; color: #666; padding: 8px 14px; border-radius: 20px; transition: all .2s;
}
.painel-nav__link:hover { background: #f0fff4; color: #1e8449; }
.painel-nav__link.is-active { background: #2ecc71; color: #fff; }

.painel-header__saudacao { display: flex; align-items: center; gap: 16px; }
.painel-saudacao-texto { font-family: 'Raleway', sans-serif; font-weight: 800; font-size: 16px; color: #333; }
.painel-btn-logout {
  background: #fff; border: 1.5px solid #7ed684; color: #1e8449; padding: 8px 16px;
  border-radius: 25px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.2s;
}
.painel-btn-logout:hover { background: #f0fff4; }

.painel-banner-urgencia {
  background: linear-gradient(90deg, #1e8449, #2ecc71);
  color: #fff; text-align: center; font-weight: 700; font-size: 14px;
  padding: 10px 16px;
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
