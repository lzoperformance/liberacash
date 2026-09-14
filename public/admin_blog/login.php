<?php
session_start();
require_once __DIR__ . '/../db.php'; // já deixa $pdo pronto

// Só aceita "next" se for um caminho interno relativo (evita open redirect).
$next = $_GET['next'] ?? $_POST['next'] ?? '';
$destino = (is_string($next) && preg_match('#^/[A-Za-z0-9/_.\-?=&%]*$#', $next) && strpos($next, '//') !== 0)
    ? $next
    : '/admin_blog/index.php';

// Já logado? Manda direto pro painel.
if (!empty($_SESSION['admin_id'])) {
    header('Location: ' . $destino);
    exit;
}

$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $erro = 'Preencha usuário e senha.';
    } else {
        $stmt = $pdo->prepare('SELECT id, password_hash FROM admin_users WHERE username = :u LIMIT 1');
        $stmt->execute([':u' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $username;
            header('Location: ' . $destino);
            exit;
        }

        $erro = 'Usuário ou senha inválidos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | Admin Blog - LiberaCash</title>
<meta name="robots" content="noindex, nofollow">
<?php include __DIR__ . '/../admin_dashboard/_estilo.php'; ?>
<style>
    body { display: flex; align-items: center; justify-content: center; min-height: 100vh; overflow: auto; }
    .lc-login-box {
        background: var(--surface-card); padding: 40px; border-radius: var(--radius-shell);
        box-shadow: var(--shadow-shell); border: 1px solid var(--border-accent);
        width: 100%; max-width: 360px;
    }
    .lc-login-box img { height: 34px; margin-bottom: 22px; }
    .lc-login-box h1 { font: 600 22px/1.2 var(--font-display); color: var(--text-strong); margin-bottom: 4px; }
    .lc-login-box p.sub { font-size: 13px; color: var(--text-muted); margin-bottom: 26px; }
    .lc-form-group { margin-bottom: 16px; }
    .lc-form-group label { display: block; font: 600 12.5px var(--font-ui); color: var(--text-strong); margin-bottom: 6px; }
    .lc-form-group input {
        width: 100%; height: 44px; padding: 0 14px; border: 1.5px solid var(--border-default);
        border-radius: var(--radius-field); font: 500 14px var(--font-ui); color: var(--text-strong);
    }
    .lc-form-group input:focus { outline: none; border-color: var(--border-accent); box-shadow: 0 0 0 3px rgba(130,225,102,.35); }
    .lc-btn-login {
        width: 100%; height: 46px; background: var(--green-500); color: var(--forest-800); border: none;
        border-radius: var(--radius-control); font: 700 14.5px var(--font-ui); cursor: pointer; margin-top: 6px;
    }
    .lc-btn-login:hover { background: var(--green-600); box-shadow: var(--shadow-accent); }
</style>
</head>
<body>
    <div class="lc-login-box">
        <img src="/images/logo.png?v=2" alt="LiberaCash">
        <h1>Admin Blog</h1>
        <p class="sub">Painel de gerenciamento do blog</p>

        <?php if ($erro): ?>
            <div class="lc-badge pending" style="display:flex; padding:10px 14px; font-size:13px; margin-bottom:16px;"><?php echo htmlspecialchars($erro, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="next" value="<?php echo htmlspecialchars($destino, ENT_QUOTES, 'UTF-8'); ?>">
            <div class="lc-form-group">
                <label for="username">Usuário</label>
                <input type="text" id="username" name="username" autofocus required>
            </div>
            <div class="lc-form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="lc-btn-login">Entrar</button>
        </form>
    </div>
</body>
</html>
