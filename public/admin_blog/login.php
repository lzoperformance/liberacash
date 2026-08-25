<?php
session_start();
require_once __DIR__ . '/../db.php'; // já deixa $pdo pronto

// Já logado? Manda direto pro painel.
if (!empty($_SESSION['admin_id'])) {
    header('Location: /admin_blog/index.php');
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
            header('Location: /admin_blog/index.php');
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
<title>Login | Admin Blog - Crédito.vc</title>
<meta name="robots" content="noindex, nofollow">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background: linear-gradient(135deg, #2ecc71, #27ae60);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-box {
        background: #fff;
        padding: 40px;
        border-radius: 14px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        width: 100%;
        max-width: 360px;
    }
    .login-box h1 {
        font-size: 1.4rem;
        color: #181a1f;
        margin-bottom: 6px;
    }
    .login-box p.sub {
        font-size: 13px;
        color: #666;
        margin-bottom: 24px;
    }
    .form-group { margin-bottom: 16px; }
    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #2d3436;
        margin-bottom: 6px;
    }
    .form-group input {
        width: 100%;
        padding: 12px 14px;
        border: 2px solid #eee;
        border-radius: 8px;
        font-size: 14px;
    }
    .form-group input:focus {
        outline: none;
        border-color: #2ecc71;
    }
    .btn-login {
        width: 100%;
        background: #2ecc71;
        color: #fff;
        border: none;
        padding: 13px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        margin-top: 6px;
    }
    .btn-login:hover { background: #27ae60; }
    .erro {
        background: #fdecea;
        color: #c0392b;
        padding: 10px 14px;
        border-radius: 8px;
        font-size: 13px;
        margin-bottom: 16px;
    }
</style>
</head>
<body>
    <div class="login-box">
        <h1>Admin Blog</h1>
        <p class="sub">Crédito.vc — painel de gerenciamento do blog</p>

        <?php if ($erro): ?>
            <div class="erro"><?php echo htmlspecialchars($erro, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="username">Usuário</label>
                <input type="text" id="username" name="username" autofocus required>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-login">Entrar</button>
        </form>
    </div>
</body>
</html>
