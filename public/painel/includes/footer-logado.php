<?php
/**
 * painel/includes/footer-logado.php
 * IMPORTANTE: este é um placeholder com a estrutura e os disclaimers
 * padrão do mercado de crédito. Troque o conteúdo pelo HTML exato do
 * rodapé do site público (copie e cole aqui) para ficar 100% igual.
 */
?>
<footer class="painel-footer">
  <div class="painel-footer__inner">
    <p class="painel-footer__disclaimer">
      LiberaCash é um site de comparação e correspondente de instituições financeiras parceiras,
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
    <p class="painel-footer__copy">&copy; <?php echo date('Y'); ?> LiberaCash — Todos os direitos reservados.</p>
  </div>
</footer>

<style>
.painel-footer { background: #fafafa; border-top: 1px solid #e6e6e6; margin-top: 40px; }
.painel-footer__inner {
  max-width: 1100px; margin: 0 auto; padding: 28px 24px; text-align: center;
  font-family: 'Lato', sans-serif;
}
.painel-footer__disclaimer { font-size: 11px; color: #888; line-height: 1.6; max-width: 720px; margin: 0 auto 16px; }
.painel-footer__links { display: flex; gap: 18px; justify-content: center; flex-wrap: wrap; margin-bottom: 12px; }
.painel-footer__links a { font-size: 12px; color: #555; text-decoration: none; font-weight: 600; }
.painel-footer__links a:hover { color: #1e8449; }
.painel-footer__copy { font-size: 11px; color: #aaa; }
</style>
