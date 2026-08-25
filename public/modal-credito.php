<?php
/**
 * Modal de Autenticação - Crédito.vc
 * 3 telas: Cadastro Rápido (default) | Login | Esqueci minha senha
 * Include reutilizável antes do </body> em qualquer página.
 */
?>

<!-- ========== MODAL AUTENTICAÇÃO ========== -->
<div class="modal-overlay" id="modalCredito" aria-hidden="true" role="dialog">
  <div class="modal-box">
    <button class="modal-close-btn" id="modalClose" aria-label="Fechar"><i class="fas fa-times"></i></button>

    <div id="modalHeader">
      <div class="modal-logo-wrapper">
        <img src="/images/logo-icon.png" alt="LiberaCash">
      </div>
      <h2 class="modal-title" id="modalCreditoTitle">Crie sua conta<br><span>e veja suas ofertas</span></h2>
      <p class="modal-subtitle" id="modalSubtitle">Rápido, grátis e sem compromisso!</p>
    </div>

    <!-- Mensagem de erro/sucesso geral do painel ativo -->
    <div class="alert-box" id="alertBox" style="display:none"></div>

    <!-- ===== PAINEL 1: CADASTRO RÁPIDO (default) ===== -->
    <form id="formCadastro" class="modal-form auth-panel active" data-panel="cadastro" novalidate>

      <input type="hidden" name="utm_source" id="tracking_utm_source" value="">
      <input type="hidden" name="utm_medium" id="tracking_utm_medium" value="">
      <input type="hidden" name="utm_campaign" id="tracking_utm_campaign" value="">
      <input type="hidden" name="utm_content" id="tracking_utm_content" value="">
      <input type="hidden" name="fbclid" id="tracking_fbclid" value="">
      <input type="hidden" name="gclid" id="tracking_gclid" value="">

      <div class="form-group">
        <input type="text" id="reg_full_name" name="full_name" placeholder="Nome completo" required autocomplete="name">
        <span class="field-error" id="error_reg_full_name"></span>
      </div>

      <div class="form-group">
        <input type="text" id="reg_cpf_number" name="cpf_number" placeholder="CPF" required maxlength="14" inputmode="numeric" autocomplete="off">
        <span class="field-error" id="error_reg_cpf_number"></span>
      </div>

      <div class="form-group">
        <input type="text" id="reg_mobile_phone" name="mobile_phone" placeholder="Celular com DDD" required maxlength="15" inputmode="tel" autocomplete="tel">
        <span class="field-error" id="error_reg_mobile_phone"></span>
      </div>

      <div class="form-group">
        <input type="email" id="reg_email" name="email" placeholder="E-mail" required autocomplete="email">
        <span class="field-error" id="error_reg_email"></span>
      </div>

      <div class="form-group">
        <div class="input-with-icon">
          <input type="password" id="reg_password" name="password" placeholder="Senha" required minlength="6" autocomplete="new-password">
          <span class="input-icon toggle-password" data-target="reg_password"><i class="fas fa-eye"></i></span>
        </div>
        <span class="field-error" id="error_reg_password"></span>
      </div>

      <div class="form-group full-width">
        <label class="checkbox-terms">
          <input type="checkbox" id="reg_terms_accepted" name="terms_accepted" required>
          <span>Ao acessar/utilizar este site, você aceita as condições dos <a href="/termos-e-condicoes/" target="_blank">Termos de uso</a> e <a href="/politica-de-privacidade/" target="_blank">Política de Privacidade</a></span>
        </label>
        <span class="field-error" id="error_reg_terms_accepted"></span>
      </div>

      <button type="submit" class="modal-btn-submit full-width" id="btnCadastro">Criar Conta e Ver Ofertas</button>

      <p class="auth-switch-link full-width">
        Já tem conta? <a href="#" data-switch-to="login">Entrar</a>
      </p>
    </form>

    <!-- ===== PAINEL 2: LOGIN ===== -->
    <form id="formLogin" class="modal-form auth-panel" data-panel="login" novalidate>

      <div class="form-group">
        <input type="text" id="login_identifier" name="identifier" placeholder="CPF ou E-mail" required autocomplete="username">
        <span class="field-error" id="error_login_identifier"></span>
      </div>

      <div class="form-group">
        <div class="input-with-icon">
          <input type="password" id="login_password" name="password" placeholder="Senha" required autocomplete="current-password">
          <span class="input-icon toggle-password" data-target="login_password"><i class="fas fa-eye"></i></span>
        </div>
        <span class="field-error" id="error_login_password"></span>
      </div>

      <button type="submit" class="modal-btn-submit full-width" id="btnLogin">Entrar na minha conta</button>

      <p class="auth-switch-link full-width">
        <a href="#" data-switch-to="esqueci-senha">Esqueceu a senha?</a>
        &nbsp;·&nbsp;
        <a href="#" data-switch-to="cadastro">Criar uma conta</a>
      </p>
    </form>

    <!-- ===== PAINEL 3: ESQUECI MINHA SENHA ===== -->
    <form id="formEsqueciSenha" class="modal-form auth-panel" data-panel="esqueci-senha" novalidate>

      <p class="auth-panel-intro full-width">
        Informe seu e-mail ou CPF cadastrado e enviaremos um link para você redefinir sua senha.
      </p>

      <div class="form-group">
        <input type="text" id="reset_identifier" name="identifier" placeholder="E-mail ou CPF" required autocomplete="username">
        <span class="field-error" id="error_reset_identifier"></span>
      </div>

      <button type="submit" class="modal-btn-submit full-width" id="btnEsqueciSenha">Enviar link de recuperação</button>

      <p class="auth-switch-link full-width">
        <a href="#" data-switch-to="login">Voltar para o Login</a>
      </p>
    </form>

  </div>
</div>

<!-- ========== ANIMAÇÃO "CONSULTANDO PARCEIROS" (Labor Illusion) ========== -->
<div class="overlay-consultando" id="overlayConsultando" aria-hidden="true">
  <div class="overlay-consultando__box">
    <div class="overlay-consultando__spinner"></div>
    <p>Consultando parceiros de crédito para o seu CPF...</p>
  </div>
</div>

<style>
.overlay-consultando { position: fixed; inset: 0; background: rgba(8,26,15,0.96); display: none; align-items: center; justify-content: center; z-index: 10001; }
.overlay-consultando.is-open { display: flex; }
.overlay-consultando__box { text-align: center; font-family: var(--lc-font-body, 'Inter', sans-serif); padding: 0 20px; }
.overlay-consultando__box p { margin-top: 16px; font-weight: 600; color: var(--lc-off-white, #EAFBEF); font-size: 15px; }
.overlay-consultando__spinner { width: 46px; height: 46px; border: 4px solid rgba(131,225,103,0.25); border-top-color: var(--lc-green-400, #83E167); border-radius: 50%; margin: 0 auto; animation: overlayConsultandoSpin 0.8s linear infinite; }
@keyframes overlayConsultandoSpin { to { transform: rotate(360deg); } }
</style>

<!-- ========== ESTILOS DO MODAL ========== -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap');

/* --- Overlay --- */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(8, 26, 15, 0.65);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 9999;
  padding: 20px;
}
.modal-overlay.is-open {
  display: flex;
}

/* --- Container --- */
.modal-box {
  background: var(--lc-white, #fff);
  width: 100%;
  max-width: 420px;
  border-radius: var(--lc-radius-lg, 24px);
  position: relative;
  box-shadow: var(--lc-shadow-modal, 0 20px 60px rgba(8,26,15,.35));
  max-height: 90vh;
  overflow-y: auto;
  animation: modalSlideUp .4s ease;
}
@keyframes modalSlideUp {
  from { transform: translateY(40px); opacity: 0; }
  to   { transform: translateY(0);    opacity: 1; }
}

/* --- Close Button --- */
.modal-close-btn {
  position: absolute;
  top: 16px;
  right: 16px;
  background: rgba(255,255,255,0.15);
  color: white;
  border: none;
  border-radius: 50%;
  width: 32px;
  height: 32px;
  font-size: 14px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background 0.2s;
  z-index: 10;
}
.modal-close-btn:hover { background: rgba(255,255,255,0.28); }

/* --- Header (banda escura, curva pro card claro) --- */
#modalHeader {
  background: var(--lc-gradient-dark, linear-gradient(160deg, #123A22, #081A0F));
  padding: 32px 28px 40px;
  text-align: center;
  position: relative;
  border-radius: var(--lc-radius-lg, 24px) var(--lc-radius-lg, 24px) 0 0;
}
#modalHeader::after {
  content: '';
  position: absolute; left: 0; right: 0; bottom: -1px; height: 24px;
  background: var(--lc-white, #fff);
  border-radius: 24px 24px 0 0;
}
.modal-logo-wrapper { margin-bottom: 16px; }
.modal-logo-wrapper img {
  height: 44px; width: 44px; object-fit: contain; border-radius: 12px;
  filter: drop-shadow(0 8px 16px rgba(0,0,0,0.3));
}
.modal-title {
  font-family: var(--lc-font-display, 'Space Grotesk', sans-serif);
  font-size: 22px;
  font-weight: 600;
  color: var(--lc-off-white, #EAFBEF);
  text-align: center;
  line-height: 1.25;
  margin: 0 0 6px;
}
.modal-title span { color: var(--lc-green-300, #6BE193); }
.modal-subtitle {
  font-size: 13.5px;
  color: rgba(234,251,239,0.68);
  margin: 0;
  text-align: center;
  line-height: 1.4;
  font-family: var(--lc-font-body, 'Inter', sans-serif);
}

/* --- Alert Box (erros/sucesso gerais) --- */
.alert-box {
  border-radius: 10px;
  padding: 10px 14px;
  font-size: 13px;
  margin: 20px 28px 0;
  text-align: center;
  line-height: 1.4;
  font-family: var(--lc-font-body, 'Inter', sans-serif);
}
.alert-box.is-error {
  background: #fdecea;
  border: 1px solid #f5c6cb;
  color: #c0392b;
}
.alert-box.is-success {
  background: var(--lc-surface, #F3FBF3);
  border: 1px solid var(--lc-green-400, #83E167);
  color: var(--lc-green-900, #16562D);
}

/* --- Form --- */
.modal-form {
  display: none;
  flex-direction: column;
  gap: 10px;
  padding: 24px 28px 28px;
  font-family: var(--lc-font-body, 'Inter', sans-serif);
}
.modal-form.active { display: flex; }

/* --- Form Groups --- */
.form-group { position: relative; }
.modal-form input, .modal-form select {
  width: 100%;
  padding: 13px 16px;
  border: 1.5px solid var(--lc-border, #D3EBD9);
  border-radius: var(--lc-radius-md, 16px);
  font-size: 14.5px;
  font-family: var(--lc-font-body, 'Inter', sans-serif);
  color: var(--lc-text-dark, #0C2F1B);
  outline: none;
  transition: border-color .15s, background .15s;
  background-color: var(--lc-surface, #F3FBF3);
  box-sizing: border-box;
}
.modal-form input::placeholder { color: var(--lc-text-muted, #4B5F52); }
.modal-form input:focus {
  border-color: var(--lc-green-500, #7CE071);
  background: #fff;
}
.modal-form input.is-invalid { border-color: #e74c3c; }
.field-error {
  display: block;
  color: #e74c3c;
  font-size: 11px;
  margin-top: 4px;
  padding-left: 16px;
  min-height: 14px;
}

/* --- Password toggle icon --- */
.input-with-icon { position: relative; }
.input-with-icon input { padding-right: 44px; }
.input-icon {
  position: absolute;
  right: 14px;
  top: 50%;
  transform: translateY(-50%);
  color: var(--lc-text-muted, #4B5F52);
}
.toggle-password { cursor: pointer; }

/* --- Checkbox Terms --- */
.checkbox-terms {
  display: flex;
  align-items: flex-start;
  gap: 9px;
  font-size: 12px;
  color: var(--lc-text-muted, #4B5F52);
  cursor: pointer;
  user-select: none;
  line-height: 1.45;
  margin-top: 4px;
}
.checkbox-terms input[type="checkbox"] {
  accent-color: var(--lc-green-600, #2FBE63);
  width: 16px;
  height: 16px;
  cursor: pointer;
  margin-top: 1px;
  flex-shrink: 0;
}
.checkbox-terms a { color: var(--lc-text-dark, #0C2F1B); text-decoration: none; font-weight: 600; }
.checkbox-terms a:hover { text-decoration: underline; }

/* --- Buttons --- */
.modal-btn-submit {
  width: 100%;
  background: var(--lc-gradient-brand, linear-gradient(135deg, #83E167, #6BE193));
  color: var(--lc-text-dark, #0C2F1B);
  padding: 15px 20px;
  border: none;
  border-radius: var(--lc-radius-md, 16px);
  font-size: 15px;
  font-weight: 700;
  font-family: var(--lc-font-body, 'Inter', sans-serif);
  cursor: pointer;
  margin-top: 6px;
  transition: transform .15s, box-shadow .15s;
  box-shadow: 0 6px 16px rgba(131, 225, 103, 0.35);
}
.modal-btn-submit:hover { transform: translateY(-1px); box-shadow: 0 10px 22px rgba(131, 225, 103, 0.45); }
.modal-btn-submit:disabled {
  background: var(--lc-border, #D3EBD9);
  color: var(--lc-text-muted, #4B5F52);
  box-shadow: none;
  cursor: not-allowed;
  transform: none;
}

/* --- Links de troca de painel --- */
.auth-switch-link {
  text-align: center;
  font-size: 13px;
  color: var(--lc-text-muted, #4B5F52);
  margin-top: 8px;
}
.auth-switch-link a {
  color: var(--lc-green-700, #368C52);
  font-weight: 700;
  text-decoration: none;
}
.auth-switch-link a:hover { text-decoration: underline; }

.auth-panel-intro {
  font-size: 13px;
  color: var(--lc-text-muted, #4B5F52);
  text-align: center;
  line-height: 1.5;
  margin-bottom: 4px;
}

/* --- Responsive --- */
@media (max-width: 768px) {
  #modalHeader { padding: 28px 22px 36px; }
  .modal-form { padding: 22px 22px 24px; }
  .modal-title { font-size: 19px; }
}
</style>

<!-- ========== JAVASCRIPT DO MODAL ========== -->
<script>
document.addEventListener('DOMContentLoaded', function() {

  const overlay   = document.getElementById('modalCredito');
  const closeBtn  = document.getElementById('modalClose');
  const alertBox  = document.getElementById('alertBox');
  const titleEl   = document.getElementById('modalCreditoTitle');
  const subEl     = document.getElementById('modalSubtitle');

  const panels = {
    cadastro:       document.getElementById('formCadastro'),
    login:          document.getElementById('formLogin'),
    'esqueci-senha': document.getElementById('formEsqueciSenha'),
  };

  const panelConfig = {
    cadastro: {
      title: 'Crie sua conta<br><span>e veja suas ofertas</span>',
      subtitle: 'Rápido, grátis e sem compromisso!'
    },
    login: {
      title: 'Bem-vindo de volta<br><span>faça login</span>',
      subtitle: 'Acesse sua conta para ver suas propostas.'
    },
    'esqueci-senha': {
      title: 'Esqueceu sua<br><span>senha?</span>',
      subtitle: 'Sem problemas, vamos te ajudar a recuperar.'
    }
  };

  let currentPanel = 'cadastro';

  // ===================================================================
  // TROCA DE PAINEL
  // ===================================================================
  function switchPanel(name) {
    if (!panels[name]) return;
    Object.values(panels).forEach(f => f.classList.remove('active'));
    panels[name].classList.add('active');
    currentPanel = name;
    clearAlert();
    clearAllErrors();

    const cfg = panelConfig[name];
    titleEl.innerHTML = cfg.title;
    subEl.textContent = cfg.subtitle;
  }

  document.querySelectorAll('[data-switch-to]').forEach(function(link) {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      switchPanel(this.dataset.switchTo);
    });
  });

  // ===================================================================
  // ABERTURA / FECHAMENTO DO MODAL
  // ===================================================================
  window.abrirModalCadastro = function(customTitle, customSubtitle) {
    switchPanel('cadastro');
    if (customTitle) titleEl.innerHTML = customTitle;
    if (customSubtitle) subEl.textContent = customSubtitle;
    abrirOverlay();
  };
  window.abrirModalLogin = function() {
    switchPanel('login');
    abrirOverlay();
  };
  window.abrirModalEsqueciSenha = function() {
    switchPanel('esqueci-senha');
    abrirOverlay();
  };

  // Compatibilidade com chamadas antigas do site (todas abrem o cadastro por padrão)
  window.abrirModalSimuleGratis   = window.abrirModalCadastro;
  window.abrirModalProdutos       = function() { window.abrirModalCadastro(); };
  window.abrirModalViaCalculadora = function() { window.abrirModalCadastro(); };

  function abrirOverlay() {
    overlay.classList.add('is-open');
    overlay.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }
  function closeModal() {
    overlay.classList.remove('is-open');
    overlay.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }
  closeBtn.addEventListener('click', closeModal);
  overlay.addEventListener('click', function(e) { if (e.target === overlay) closeModal(); });
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && overlay.classList.contains('is-open')) closeModal();
  });

  // Abertura genérica via botões com data-attributes na página
  document.querySelectorAll('.btn-open-modal').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      const painel = this.dataset.panel || 'cadastro';
      if (painel === 'login') window.abrirModalLogin();
      else if (painel === 'esqueci-senha') window.abrirModalEsqueciSenha();
      else window.abrirModalCadastro(this.dataset.title, this.dataset.subtitle);
    });
  });

  // Captura UTM params da URL (usados no cadastro)
  const urlParams = new URLSearchParams(window.location.search);
  ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'fbclid', 'gclid'].forEach(function(key) {
    const el = document.getElementById('tracking_' + key);
    if (el && urlParams.get(key)) el.value = urlParams.get(key);
  });

  // ===================================================================
  // MOSTRAR/ESCONDER SENHA
  // ===================================================================
  document.querySelectorAll('.toggle-password').forEach(function(icon) {
    icon.addEventListener('click', function() {
      const input = document.getElementById(this.dataset.target);
      const isPwd = input.type === 'password';
      input.type = isPwd ? 'text' : 'password';
      this.innerHTML = isPwd ? '<i class="fas fa-eye-slash"></i>' : '<i class="fas fa-eye"></i>';
    });
  });

  // ===================================================================
  // ALERTAS GERAIS
  // ===================================================================
  function showAlert(msg, type) {
    alertBox.textContent = msg;
    alertBox.className = 'alert-box ' + (type === 'success' ? 'is-success' : 'is-error');
    alertBox.style.display = 'block';
  }
  function clearAlert() {
    alertBox.style.display = 'none';
    alertBox.textContent = '';
  }

  // ===================================================================
  // MÁSCARAS
  // ===================================================================
  function maskCPF(v) {
    return v.replace(/\D/g,'').slice(0,11)
      .replace(/(\d{3})(\d)/, '$1.$2')
      .replace(/(\d{3})(\d)/, '$1.$2')
      .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
  }
  function maskPhone(v) {
    return v.replace(/\D/g,'').slice(0,11)
      .replace(/(\d{2})(\d)/, '($1) $2')
      .replace(/(\d{5})(\d)/, '$1-$2');
  }
  document.getElementById('reg_cpf_number').addEventListener('input', function() { this.value = maskCPF(this.value); });
  document.getElementById('reg_mobile_phone').addEventListener('input', function() { this.value = maskPhone(this.value); });

  // Campo "CPF ou E-mail" / "E-mail ou CPF": só aplica máscara de CPF se parecer só números
  function maskIdentifierIfCPF(input) {
    const raw = input.value.replace(/\D/g, '');
    const looksLikeCpfAttempt = /^[\d.\-]+$/.test(input.value) && raw.length > 0;
    if (looksLikeCpfAttempt) input.value = maskCPF(input.value);
  }
  document.getElementById('login_identifier').addEventListener('input', function() { maskIdentifierIfCPF(this); });
  document.getElementById('reset_identifier').addEventListener('input', function() { maskIdentifierIfCPF(this); });

  // ===================================================================
  // VALIDAÇÕES
  // ===================================================================
  function val(id, test, msg) {
    const el = document.getElementById(id);
    const v = el.value.trim();
    if (!test(v)) {
      el.classList.add('is-invalid');
      document.getElementById('error_' + id).textContent = msg;
      return false;
    }
    el.classList.remove('is-invalid');
    document.getElementById('error_' + id).textContent = '';
    return true;
  }
  function clearAllErrors() {
    document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    document.querySelectorAll('.field-error').forEach(el => el.textContent = '');
  }
  function validarCPF(cpf) {
    cpf = cpf.replace(/\D/g,'');
    if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;
    let sum = 0, rest;
    for (let i = 1; i <= 9; i++) sum += parseInt(cpf[i-1]) * (11 - i);
    rest = (sum * 10) % 11;
    if (rest === 10) rest = 0;
    if (rest !== parseInt(cpf[9])) return false;
    sum = 0;
    for (let i = 1; i <= 10; i++) sum += parseInt(cpf[i-1]) * (12 - i);
    rest = (sum * 10) % 11;
    if (rest === 10) rest = 0;
    return rest === parseInt(cpf[10]);
  }
  function isValidEmail(v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v); }
  function isValidIdentifier(v) {
    if (isValidEmail(v)) return true;
    return validarCPF(v);
  }

  function validarCadastro() {
    let ok = true;
    if (!val('reg_full_name', v => v.length >= 3, 'Informe seu nome completo')) ok = false;
    if (!val('reg_cpf_number', v => validarCPF(v), 'CPF inválido')) ok = false;
    if (!val('reg_mobile_phone', v => v.replace(/\D/g,'').length === 11, 'Telefone inválido')) ok = false;
    if (!val('reg_email', v => isValidEmail(v), 'E-mail inválido')) ok = false;
    if (!val('reg_password', v => v.length >= 6, 'A senha deve ter ao menos 6 caracteres')) ok = false;
    if (!document.getElementById('reg_terms_accepted').checked) {
      document.getElementById('error_reg_terms_accepted').textContent = 'Você precisa aceitar os termos';
      ok = false;
    } else {
      document.getElementById('error_reg_terms_accepted').textContent = '';
    }
    return ok;
  }

  function validarLogin() {
    let ok = true;
    if (!val('login_identifier', v => isValidIdentifier(v), 'Informe um CPF ou e-mail válido')) ok = false;
    if (!val('login_password', v => v.length > 0, 'Informe sua senha')) ok = false;
    return ok;
  }

  function validarEsqueciSenha() {
    return val('reset_identifier', v => isValidIdentifier(v), 'Informe um CPF ou e-mail válido');
  }

  // ===================================================================
  // SUBMISSÕES (AJAX/FETCH)
  // ===================================================================
  function setLoading(btn, loading, labelDefault) {
    btn.disabled = loading;
    btn.textContent = loading ? 'Enviando...' : labelDefault;
  }

  async function postJSON(url, payload) {
    const resp = await fetch(url, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'same-origin',
      body: JSON.stringify(payload)
    });
    let data;
    try { data = await resp.json(); } catch (e) { data = {}; }
    return { ok: resp.ok, data };
  }

  // --- Cadastro ---
  const formCadastro = document.getElementById('formCadastro');
  const btnCadastro   = document.getElementById('btnCadastro');
  formCadastro.addEventListener('submit', async function(e) {
    e.preventDefault();
    clearAlert();
    if (!validarCadastro()) return;

    const payload = {
      full_name: document.getElementById('reg_full_name').value.trim(),
      cpf_number: document.getElementById('reg_cpf_number').value.trim(),
      mobile_phone: document.getElementById('reg_mobile_phone').value.trim(),
      email: document.getElementById('reg_email').value.trim(),
      password: document.getElementById('reg_password').value,
      utm_source: document.getElementById('tracking_utm_source').value,
      utm_medium: document.getElementById('tracking_utm_medium').value,
      utm_campaign: document.getElementById('tracking_utm_campaign').value,
      utm_content: document.getElementById('tracking_utm_content').value,
      fbclid: document.getElementById('tracking_fbclid').value,
      gclid: document.getElementById('tracking_gclid').value
    };

    setLoading(btnCadastro, true, 'Criar Conta e Ver Ofertas');
    try {
      const { ok, data } = await postJSON('/register.php', payload);
      if (ok && data.success) {
        const destino = data.redirect || '/painel';
        const overlay = document.getElementById('overlayConsultando');
        overlay.classList.add('is-open');
        overlay.setAttribute('aria-hidden', 'false');
        const duracaoMs = 3000 + Math.random() * 2000; // 3 a 5 segundos
        setTimeout(function () { window.location.href = destino; }, duracaoMs);
        return; // não reabilita o botão: a página vai navegar
      } else {
        showAlert(data.message || 'Não foi possível criar sua conta. Verifique os dados e tente novamente.', 'error');
      }
    } catch (err) {
      showAlert('Erro de conexão. Tente novamente em instantes.', 'error');
    } finally {
      setLoading(btnCadastro, false, 'Criar Conta e Ver Ofertas');
    }
  });

  // --- Login ---
  const formLogin = document.getElementById('formLogin');
  const btnLogin  = document.getElementById('btnLogin');
  formLogin.addEventListener('submit', async function(e) {
    e.preventDefault();
    clearAlert();
    if (!validarLogin()) return;

    const payload = {
      identifier: document.getElementById('login_identifier').value.trim(),
      password: document.getElementById('login_password').value
    };

    setLoading(btnLogin, true, 'Entrar na minha conta');
    try {
      const { ok, data } = await postJSON('/login.php', payload);
      if (ok && data.success) {
        showAlert('Login realizado! Redirecionando...', 'success');
        window.location.href = data.redirect || '/painel';
      } else {
        showAlert(data.message || 'CPF/e-mail ou senha incorretos.', 'error');
      }
    } catch (err) {
      showAlert('Erro de conexão. Tente novamente em instantes.', 'error');
    } finally {
      setLoading(btnLogin, false, 'Entrar na minha conta');
    }
  });

  // --- Esqueci minha senha ---
  const formEsqueciSenha = document.getElementById('formEsqueciSenha');
  const btnEsqueciSenha  = document.getElementById('btnEsqueciSenha');
  formEsqueciSenha.addEventListener('submit', async function(e) {
    e.preventDefault();
    clearAlert();
    if (!validarEsqueciSenha()) return;

    const payload = {
      identifier: document.getElementById('reset_identifier').value.trim()
    };

    setLoading(btnEsqueciSenha, true, 'Enviar link de recuperação');
    try {
      const { ok, data } = await postJSON('/forgot-password.php', payload);
      if (ok && data.success) {
        showAlert(data.message || 'Se o cadastro existir, enviamos um link de recuperação.', 'success');
      } else {
        showAlert(data.message || 'Não foi possível processar sua solicitação.', 'error');
      }
    } catch (err) {
      showAlert('Erro de conexão. Tente novamente em instantes.', 'error');
    } finally {
      setLoading(btnEsqueciSenha, false, 'Enviar link de recuperação');
    }
  });

});
</script>
