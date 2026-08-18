<?php
/**
 * painel/minha-conta.php
 * Exibe e permite editar todos os dados do usuário. Salvar alterações em
 * dados sensíveis (e-mail, telefone, endereço) exige a senha atual —
 * a checagem em si acontece em /atualizar-perfil.php.
 */

declare(strict_types=1);
session_start();

if (empty($_SESSION['user_id'])) {
    header('Location: /');
    exit;
}

require __DIR__ . '/../db.php';

$userId = (int)$_SESSION['user_id'];

$stmt = $pdo->prepare('SELECT id, nome, email, celular FROM usuarios WHERE id = :id LIMIT 1');
$stmt->execute(['id' => $userId]);
$usuario = $stmt->fetch();
if (!$usuario) { session_destroy(); header('Location: /'); exit; }

$stmt = $pdo->prepare('SELECT * FROM perfil_usuario WHERE user_id = :id LIMIT 1');
$stmt->execute(['id' => $userId]);
$perfil = $stmt->fetch() ?: [];

$nomeExibicao = htmlspecialchars(explode(' ', trim($usuario['nome']))[0] ?: $usuario['nome'], ENT_QUOTES, 'UTF-8');
$abaAtiva = 'conta';

function v($arr, $key) { return htmlspecialchars((string)($arr[$key] ?? ''), ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Minha Conta — Crédito.vc</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700;800&family=Lato:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<?php include __DIR__ . '/includes/header-logado.php'; ?>

<main class="painel-main">
  <section class="painel-secao">
    <h2 class="painel-secao-titulo">Meus dados</h2>
    <div class="alert-box" id="contaAlert" style="display:none"></div>

    <form id="formMinhaConta" class="conta-form">

      <fieldset class="conta-fieldset">
        <legend>Dados pessoais</legend>
        <div class="conta-grid">
          <div class="form-group"><label>Nome completo</label><input type="text" value="<?php echo v($usuario,'nome'); ?>" disabled></div>
          <div class="form-group"><label>Data de nascimento</label><input type="date" name="data_nascimento" value="<?php echo v($perfil,'data_nascimento'); ?>"></div>
          <div class="form-group"><label>Estado civil</label>
            <select name="estado_civil">
              <option value="">Selecione</option>
              <?php foreach (['solteiro'=>'Solteiro(a)','casado'=>'Casado(a)','divorciado'=>'Divorciado(a)','viuvo'=>'Viúvo(a)','uniao_estavel'=>'União estável'] as $val=>$label): ?>
                <option value="<?php echo $val; ?>" <?php echo ($perfil['estado_civil'] ?? '') === $val ? 'selected' : ''; ?>><?php echo $label; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </fieldset>

      <fieldset class="conta-fieldset conta-fieldset--sensivel">
        <legend>Contato <span class="conta-badge-lock"><i class="fas fa-lock"></i> requer senha</span></legend>
        <div class="conta-grid">
          <div class="form-group"><label>E-mail</label><input type="email" name="email" value="<?php echo v($usuario,'email'); ?>"></div>
          <div class="form-group"><label>Celular</label><input type="tel" name="celular" id="conta_celular" value="<?php echo v($usuario,'celular'); ?>"></div>
        </div>
      </fieldset>

      <fieldset class="conta-fieldset conta-fieldset--sensivel">
        <legend>Endereço <span class="conta-badge-lock"><i class="fas fa-lock"></i> requer senha</span></legend>
        <div class="conta-grid">
          <div class="form-group"><label>CEP</label><input type="text" name="cep" id="conta_cep" value="<?php echo v($perfil,'cep'); ?>" maxlength="9"></div>
          <div class="form-group"><label>Logradouro</label><input type="text" name="logradouro" value="<?php echo v($perfil,'logradouro'); ?>"></div>
          <div class="form-group"><label>Número</label><input type="text" name="numero" value="<?php echo v($perfil,'numero'); ?>"></div>
          <div class="form-group"><label>Complemento</label><input type="text" name="complemento" value="<?php echo v($perfil,'complemento'); ?>"></div>
          <div class="form-group"><label>Bairro</label><input type="text" name="bairro" value="<?php echo v($perfil,'bairro'); ?>"></div>
          <div class="form-group"><label>Cidade</label><input type="text" name="cidade" value="<?php echo v($perfil,'cidade'); ?>"></div>
          <div class="form-group"><label>Estado</label><input type="text" name="estado" value="<?php echo v($perfil,'estado'); ?>" maxlength="2"></div>
        </div>
      </fieldset>

      <fieldset class="conta-fieldset">
        <legend>Renda e crédito</legend>
        <div class="conta-grid">
          <div class="form-group"><label>Fonte de renda</label>
            <select name="fonte_renda">
              <option value="">Selecione</option>
              <?php foreach (['assalariado_clt'=>'Assalariado (CLT)','autonomo'=>'Autônomo','empresario'=>'Empresário','aposentado_pensionista'=>'Aposentado/Pensionista','servidor_publico'=>'Servidor Público','militar'=>'Militar','desempregado'=>'Desempregado'] as $val=>$label): ?>
                <option value="<?php echo $val; ?>" <?php echo ($perfil['fonte_renda'] ?? '') === $val ? 'selected' : ''; ?>><?php echo $label; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group"><label>Renda mensal</label><input type="text" name="renda_mensal" id="conta_renda" value="<?php echo $perfil['renda_mensal'] ?? ''; ?>"></div>
          <div class="form-group"><label>Está negativado?</label>
            <select name="negativado">
              <option value="">Selecione</option>
              <option value="sim" <?php echo ($perfil['negativado'] ?? '') === 'sim' ? 'selected' : ''; ?>>Sim</option>
              <option value="nao" <?php echo ($perfil['negativado'] ?? '') === 'nao' ? 'selected' : ''; ?>>Não</option>
              <option value="nao_sei" <?php echo ($perfil['negativado'] ?? '') === 'nao_sei' ? 'selected' : ''; ?>>Não sei</option>
            </select>
          </div>
        </div>
      </fieldset>

      <fieldset class="conta-fieldset">
        <legend>Celular de garantia</legend>
        <div class="conta-grid">
          <div class="form-group"><label>Modelo do celular</label><input type="text" name="modelo_celular" value="<?php echo v($perfil,'modelo_celular'); ?>"></div>
          <div class="form-group"><label>Sistema operacional</label>
            <select name="sistema_celular">
              <option value="">Selecione</option>
              <option value="android" <?php echo ($perfil['sistema_celular'] ?? '') === 'android' ? 'selected' : ''; ?>>Android</option>
              <option value="ios" <?php echo ($perfil['sistema_celular'] ?? '') === 'ios' ? 'selected' : ''; ?>>iOS</option>
            </select>
          </div>
        </div>
      </fieldset>

      <!-- Confirmação de senha, exigida só quando Contato ou Endereço mudaram -->
      <div class="conta-confirmacao-senha" id="blocoSenhaAtual" style="display:none">
        <p><i class="fas fa-lock"></i> Você alterou dados sensíveis. Confirme sua senha atual para salvar:</p>
        <input type="password" id="conta_senha_atual" placeholder="Senha atual" autocomplete="current-password">
      </div>

      <button type="submit" class="modal-btn-submit" id="btnSalvarConta">Salvar alterações</button>
    </form>
  </section>
</main>

<?php include __DIR__ . '/includes/footer-logado.php'; ?>

<style>
* { box-sizing: border-box; }
body { margin: 0; font-family: 'Lato', sans-serif; background: #f5f7f6; color: #333; }
.painel-main { max-width: 800px; margin: 0 auto; padding: 28px 24px 60px; }
.painel-secao-titulo { font-family: 'Raleway', sans-serif; font-size: 20px; font-weight: 800; margin-bottom: 16px; }

.conta-form { background: #fff; border-radius: 16px; padding: 8px 28px 28px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
.conta-fieldset { border: none; border-top: 1px solid #f0f0f0; padding: 20px 0; }
.conta-fieldset:first-of-type { border-top: none; }
.conta-fieldset legend { font-family: 'Raleway', sans-serif; font-weight: 800; font-size: 14px; color: #1e8449; padding: 0; display: flex; align-items: center; gap: 8px; }
.conta-badge-lock { font-size: 10px; font-weight: 700; color: #b8860b; background: #fff8e6; padding: 2px 8px; border-radius: 10px; }
.conta-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; margin-top: 14px; }
@media (max-width: 600px) { .conta-grid { grid-template-columns: 1fr; } }
.form-group label { display: block; font-size: 12px; font-weight: 700; color: #888; margin-bottom: 4px; }
.form-group input, .form-group select { width: 100%; padding: 11px 16px; border: 1px solid #ddd; border-radius: 10px; font-size: 14px; font-family: 'Lato', sans-serif; }
.form-group input:disabled { background: #f5f5f5; color: #999; }
.form-group input:focus, .form-group select:focus { border-color: #2ecc71; outline: none; }

.conta-confirmacao-senha { background: #fff8e6; border: 1px solid #ffe4a3; border-radius: 12px; padding: 16px; margin-top: 18px; }
.conta-confirmacao-senha p { margin: 0 0 10px; font-size: 13px; color: #7a5c00; }
.conta-confirmacao-senha input { width: 100%; padding: 11px 16px; border: 1px solid #ffe4a3; border-radius: 10px; }

.modal-btn-submit { width: 100%; background: #2ecc71; color: #fff; padding: 14px 20px; border: none; border-radius: 30px; font-size: 16px; font-weight: bold; cursor: pointer; margin-top: 20px; transition: background .3s; }
.modal-btn-submit:hover { background: #27ae60; }
.modal-btn-submit:disabled { background: #a8dab3; cursor: not-allowed; }

.alert-box { border-radius: 10px; padding: 12px 16px; font-size: 13px; margin-bottom: 16px; }
.alert-box.is-error { background: #fdecea; border: 1px solid #f5c6cb; color: #c0392b; }
.alert-box.is-success { background: #f0fff4; border: 1px solid #7ed684; color: #1e8449; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var form = document.getElementById('formMinhaConta');
  var alertBox = document.getElementById('contaAlert');
  var blocoSenhaAtual = document.getElementById('blocoSenhaAtual');
  var camposSensiveis = ['email', 'celular', 'cep', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado'];
  var valoresIniciais = {};
  camposSensiveis.forEach(function (nome) {
    var el = form.querySelector('[name="' + nome + '"]');
    if (el) valoresIniciais[nome] = el.value;
  });

  function alterouCampoSensivel() {
    return camposSensiveis.some(function (nome) {
      var el = form.querySelector('[name="' + nome + '"]');
      return el && el.value !== valoresIniciais[nome];
    });
  }
  form.addEventListener('input', function () {
    blocoSenhaAtual.style.display = alterouCampoSensivel() ? 'block' : 'none';
  });

  function maskMoney(v) { v = v.replace(/\D/g, ''); v = (parseInt(v || '0') / 100).toFixed(2); return 'R$ ' + v.replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.'); }
  var elRenda = document.getElementById('conta_renda');
  if (elRenda && elRenda.value) elRenda.value = maskMoney(String(Math.round(parseFloat(elRenda.value) * 100)));
  if (elRenda) elRenda.addEventListener('input', function () { this.value = maskMoney(this.value); });

  form.addEventListener('submit', async function (e) {
    e.preventDefault();
    alertBox.style.display = 'none';

    var payload = {};
    new FormData(form).forEach(function (v, k) { payload[k] = v; });

    if (alterouCampoSensivel()) {
      var senha = document.getElementById('conta_senha_atual').value;
      if (!senha) {
        alertBox.textContent = 'Confirme sua senha atual para salvar essas alterações.';
        alertBox.className = 'alert-box is-error';
        alertBox.style.display = 'block';
        return;
      }
      payload.current_password = senha;
    }

    var btn = document.getElementById('btnSalvarConta');
    btn.disabled = true; btn.textContent = 'Salvando...';

    try {
      var resp = await fetch('/atualizar-perfil.php', { method: 'POST', headers: { 'Content-Type': 'application/json' }, credentials: 'same-origin', body: JSON.stringify(payload) });
      var data = await resp.json();
      if (resp.ok && data.success) {
        alertBox.textContent = 'Dados salvos com sucesso!';
        alertBox.className = 'alert-box is-success';
        alertBox.style.display = 'block';
        setTimeout(function () { window.location.reload(); }, 1200);
      } else {
        alertBox.textContent = data.message || 'Não foi possível salvar. Tente novamente.';
        alertBox.className = 'alert-box is-error';
        alertBox.style.display = 'block';
        btn.disabled = false; btn.textContent = 'Salvar alterações';
      }
    } catch (err) {
      alertBox.textContent = 'Erro de conexão. Tente novamente.';
      alertBox.className = 'alert-box is-error';
      alertBox.style.display = 'block';
      btn.disabled = false; btn.textContent = 'Salvar alterações';
    }
  });
});
</script>
</body>
</html>
