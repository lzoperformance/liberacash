<?php
/**
 * painel/includes/footer-logado.php
 * Mesmo padrão visual do rodapé público (logo, redes sociais, disclaimer).
 */
?>
<footer class="painel-footer">
  <div class="painel-footer__inner">
    <img src="/images/logo-footer.png?v=2" alt="LiberaCash" class="painel-footer__logo">

    <div class="painel-footer__social">
      <a href="https://www.facebook.com/creditovoce" target="_blank" rel="noopener noreferrer" aria-label="Facebook LiberaCash"><i class="fab fa-facebook-f"></i></a>
      <a href="https://www.instagram.com/credito.vc/" target="_blank" rel="noopener noreferrer" aria-label="Instagram LiberaCash"><i class="fab fa-instagram"></i></a>
      <a href="#" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn LiberaCash"><i class="fab fa-linkedin-in"></i></a>
    </div>

    <p class="painel-footer__disclaimer">
      LiberaCash&reg; é um site de comparação e correspondente de instituições financeiras parceiras,
      não é uma instituição financeira e não realiza empréstimos diretamente. As condições de crédito
      (taxas, prazos e valores) são definidas exclusivamente pela instituição parceira responsável pela
      proposta, mediante análise de crédito. A aprovação está sujeita a análise cadastral.
    </p>
    <nav class="painel-footer__links">
      <a href="/termos-e-condicoes.php">Termos de Uso</a>
      <a href="/politica-de-privacidade.php">Política de Privacidade</a>
      <a href="/contato.php">Contato</a>
      <a href="/sobre.php">Sobre</a>
    </nav>
    <p class="painel-footer__copy">&copy; <?php echo date('Y'); ?> LiberaCash&reg; — Todos os direitos reservados.</p>
  </div>
</footer>

<style>
.painel-footer { background: var(--lc-white, #fff); border-top: 1px solid var(--lc-border, #D3EBD9); margin-top: 40px; }
.painel-footer__inner {
  max-width: 1100px; margin: 0 auto; padding: 40px 24px 28px; text-align: center;
  font-family: var(--lc-font-body, 'Inter', sans-serif); display: flex; flex-direction: column; align-items: center;
}
.painel-footer__logo { height: 44px; object-fit: contain; margin-bottom: 22px; }
.painel-footer__social { display: flex; gap: 14px; margin-bottom: 22px; }
.painel-footer__social a {
  display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px;
  border-radius: 50%; background: var(--lc-gradient-brand, linear-gradient(135deg,#83E167,#6BE193));
  color: var(--lc-text-dark, #0C2F1B); font-size: 15px; text-decoration: none; transition: transform .15s;
}
.painel-footer__social a:hover { transform: translateY(-2px); }
.painel-footer__disclaimer { font-size: 11px; color: var(--lc-text-muted, #888); line-height: 1.6; max-width: 720px; margin: 0 auto 16px; }
.painel-footer__links { display: flex; gap: 18px; justify-content: center; flex-wrap: wrap; margin-bottom: 12px; }
.painel-footer__links a { font-size: 12px; color: var(--lc-text-muted, #555); text-decoration: none; font-weight: 600; }
.painel-footer__links a:hover { color: var(--lc-green-900, #1e8449); }
.painel-footer__copy { font-size: 11px; color: #aaa; }
</style>
