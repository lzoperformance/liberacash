<?php
/**
 * Página Contato - LiberaCash
 * Formulário de contato + informações de atendimento.
 * Segue o design do blog.php e sobre.php.
 */
require_once __DIR__ . '/db.php';

// Processamento do formulário (salva no banco de dados)
$mensagem_status = '';
$tipo_status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $assunto = trim($_POST['assunto'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if ($nome === '' || $email === '' || $mensagem === '') {
        $mensagem_status = 'Por favor, preencha nome, e-mail e mensagem.';
        $tipo_status = 'erro';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagem_status = 'Por favor, informe um e-mail válido.';
        $tipo_status = 'erro';
    } else {
        if ($pdo) {
            try {
                $stmt = $pdo->prepare(
                    "INSERT INTO contatos (nome, email, telefone, assunto, mensagem) VALUES (?, ?, ?, ?, ?)"
                );
                $stmt->execute([$nome, $email, $telefone, $assunto, $mensagem]);
                $mensagem_status = 'Mensagem enviada com sucesso! Retornaremos em breve.';
                $tipo_status = 'sucesso';
                $nome = $email = $telefone = $assunto = $mensagem = '';
            } catch (PDOException $e) {
                error_log('Erro ao salvar contato: ' . $e->getMessage());
                $mensagem_status = 'Ocorreu um erro ao enviar. Tente novamente.';
                $tipo_status = 'erro';
            }
        } else {
            $mensagem_status = 'Ocorreu um erro ao enviar. Tente novamente.';
            $tipo_status = 'erro';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato | LiberaCash</title>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        {"@type": "ListItem", "position": 1, "name": "Início", "item": "https://libera.cash/"},
        {"@type": "ListItem", "position": 2, "name": "Contato", "item": "https://libera.cash/contato/"}
      ]
    }
    </script>

    <meta name="description" content="Entre em contato com a LiberaCash. Tire dúvidas, envie sugestões ou proponha parcerias.">
    <meta property="og:title" content="Contato | LiberaCash">
    <meta property="og:description" content="Entre em contato com a LiberaCash. Tire dúvidas, envie sugestões ou proponha parcerias.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://libera.cash/contato/">

    <link rel="canonical" href="/contato/">

    <link href="images/favicon.png" rel="shortcut icon" type="image/x-icon">
    <link href="images/webclip.png" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900|Raleway:400,500,600,700,800,900|Montserrat:400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary-green: #2ecc71;
            --dark-green: #27ae60;
            --accent-green: #1de58d;
            --dark-bg: #181a1f;
            --text-dark: #2d3436;
            --gray-text: #666;
            --white: #ffffff;
            --transition: all 0.3s ease;
        }
        body { font-family: 'Lato', sans-serif; color: var(--text-dark); background: #f9f9f9; overflow-x: hidden; padding-top: 32px; }
        .top-bar { background: #19a44a; padding: 0; height: 32px; display: flex; align-items: center; justify-content: center; text-align: center; font-size: 11px; color: #fff; position: fixed; top: 0; left: 0; width: 100%; z-index: 1001; }

        .header { background: var(--primary-green); padding: 10px 0; position: sticky; top: 32px; z-index: 1000; }
        .header-container { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 20px; }
        .logo img { height: 35px; }
        .nav-menu { display: flex; list-style: none; gap: 20px; }
        .nav-menu a { color: #fff; text-decoration: none; font-size: 14px; font-weight: 600; }
        .hamburger { display: none; cursor: pointer; color: #fff; font-size: 24px; }

        .breadcrumbs { max-width: 1100px; margin: 0 auto; padding: 14px 20px; font-size: 13px; color: var(--gray-text); }
        .breadcrumbs a { color: var(--gray-text); text-decoration: none; }
        .breadcrumbs a:hover { color: var(--primary-green); text-decoration: underline; }
        .breadcrumbs .sep { margin: 0 6px; color: #ccc; }
        .breadcrumbs .current { color: var(--text-dark); font-weight: 600; }

        .hero { background: linear-gradient(135deg, var(--primary-green), var(--dark-green)); padding: 70px 20px; text-align: center; color: #fff; }
        .hero h1 { font-family: 'Raleway', sans-serif; font-size: 2.6rem; font-weight: 800; margin-bottom: 15px; }
        .hero p { font-size: 1.1rem; max-width: 720px; margin: 0 auto; opacity: 0.95; line-height: 1.6; }

        .container { max-width: 1100px; margin: 50px auto; padding: 0 20px; }
        .contato-grid { display: grid; grid-template-columns: 1.3fr 1fr; gap: 30px; }

        .card { background: #fff; border-radius: 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); padding: 40px; }
        .card h2 { font-family: 'Raleway', sans-serif; font-size: 1.6rem; color: var(--dark-bg); margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .card h2 i { color: var(--primary-green); }

        /* Formulário */
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: var(--text-dark); margin-bottom: 6px; }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%; padding: 12px 14px; border: 2px solid #eee; border-radius: 10px;
            font-family: inherit; font-size: 14px; color: var(--text-dark); background: #fafafa; transition: var(--transition);
        }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
            outline: none; border-color: var(--primary-green); background: #fff;
        }
        .form-group textarea { resize: vertical; min-height: 120px; }
        .btn-submit {
            background: var(--primary-green); color: #fff; border: none; padding: 14px 30px;
            border-radius: 30px; font-size: 14px; font-weight: 700; cursor: pointer; transition: var(--transition);
        }
        .btn-submit:hover { background: var(--dark-green); transform: translateY(-2px); }

        .alert { padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; }
        .alert-sucesso { background: #e8f8f0; color: #1e7d47; border-left: 4px solid var(--primary-green); }
        .alert-erro { background: #fdecea; color: #a71d2a; border-left: 4px solid #e74c3c; }

        /* Info */
        .info-item { display: flex; align-items: flex-start; gap: 15px; margin-bottom: 22px; }
        .info-icon { flex-shrink: 0; width: 44px; height: 44px; border-radius: 50%; background: #eafaf1; color: var(--primary-green); display: flex; align-items: center; justify-content: center; font-size: 17px; }
        .info-text strong { display: block; font-size: 13px; color: var(--dark-bg); margin-bottom: 3px; }
        .info-text a, .info-text span { font-size: 14px; color: var(--gray-text); text-decoration: none; line-height: 1.5; }
        .info-text a:hover { color: var(--primary-green); }

        .info-social { display: flex; gap: 12px; margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee; }
        .info-social a {
            display: inline-flex; align-items: center; justify-content: center;
            width: 40px; height: 40px; border-radius: 50%; background: var(--primary-green); color: #fff;
            text-decoration: none; font-size: 15px; transition: var(--transition);
        }
        .info-social a:hover { background: var(--dark-green); transform: translateY(-2px); }

        /* Footer */
        .footer { padding: 50px 0; text-align: center; background: #fff; border-top: 1px solid #eee; }
        .footer-container { max-width: 1000px; margin: 0 auto; padding: 0 20px; display: flex; flex-direction: column; align-items: center; }
        .footer-logo { height: 38px; margin-bottom: 25px; }
        .footer-social { display: flex; gap: 15px; margin-bottom: 25px; }
        .footer-social a {
            display: inline-flex; align-items: center; justify-content: center;
            width: 40px; height: 40px; border-radius: 50%; background: var(--primary-green); color: #fff;
            font-size: 16px; text-decoration: none; transition: var(--transition);
        }
        .footer-social a:hover { background: var(--dark-green); transform: translateY(-2px); }
        .footer-text { font-size: 12px; color: #666; line-height: 1.7; text-align: justify; }
        .footer-copyright { margin-top: 25px; padding-top: 20px; border-top: 1px solid #eee; font-size: 12px; color: #999; width: 100%; text-align: center; }

        @media (max-width: 768px) {
            .nav-menu { display: none; }
            .hamburger { display: block; }
            .hero h1 { font-size: 1.8rem; }
            .contato-grid { grid-template-columns: 1fr; }
            .card { padding: 25px; }
            .footer-text { text-align: left; }
        }
    </style>
  <link href="css/brand-tokens.css?<?= uniqid() ?>" rel="stylesheet">
</head>
<body>

<div class="top-bar">
    Atenção! A LiberaCash não cobra nenhum depósito antecipado para a liberação de empréstimo.
</div>

<header class="header">
    <div class="header-container">
        <div class="logo">
            <a href="/"><img src="images/logo.png?v=2" alt="LiberaCash"></a>
        </div>
        <ul class="nav-menu">
            <li><a href="/">Home</a></li>
            <li><a href="/cartoes/">Cartão de Crédito</a></li>
            <li><a href="/blog/">Blog</a></li>
            <li><a href="/sobre/">Sobre</a></li>
            <li><a href="/contato/">Contato</a></li>
        </ul>
        <div class="hamburger"><i class="fas fa-bars"></i></div>
    </div>
</header>

<nav class="breadcrumbs" aria-label="breadcrumb">
    <a href="/">Início</a>
    <span class="sep">/</span>
    <span class="current">Contato</span>
</nav>

<section class="hero">
    <h1>Fale com a LiberaCash</h1>
    <p>Tem dúvidas, sugestões ou quer se tornar nosso parceiro? Preencha o formulário ou use um dos canais abaixo — respondemos em até 2 dias úteis.</p>
</section>

<div class="container">
    <div class="contato-grid">

        <div class="card">
            <h2><i class="fas fa-paper-plane"></i> Envie sua Mensagem</h2>

            <?php if ($mensagem_status): ?>
                <div class="alert alert-<?php echo htmlspecialchars($tipo_status, ENT_QUOTES, 'UTF-8'); ?>">
                    <?php echo htmlspecialchars($mensagem_status, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>

            <form method="post" action="/contato/" novalidate>
                <div class="form-group">
                    <label for="nome">Nome completo *</label>
                    <input type="text" id="nome" name="nome" required value="<?php echo htmlspecialchars($nome ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <div class="form-group">
                    <label for="email">E-mail *</label>
                    <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone / WhatsApp</label>
                    <input type="tel" id="telefone" name="telefone" placeholder="(11) 99999-9999" value="<?php echo htmlspecialchars($telefone ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <div class="form-group">
                    <label for="assunto">Assunto</label>
                    <select id="assunto" name="assunto">
                        <option value="Dúvida geral">Dúvida geral</option>
                        <option value="Suporte">Suporte</option>
                        <option value="Parcerias">Parcerias</option>
                        <option value="Imprensa">Imprensa</option>
                        <option value="Reclamação">Reclamação</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mensagem">Mensagem *</label>
                    <textarea id="mensagem" name="mensagem" required placeholder="Como podemos ajudar?"><?php echo htmlspecialchars($mensagem ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                </div>
                <button type="submit" class="btn-submit"><i class="fas fa-paper-plane"></i> Enviar Mensagem</button>
            </form>
        </div>

        <div class="card">
            <h2><i class="fas fa-address-book"></i> Outros Canais</h2>

            <div class="info-item">
                <div class="info-icon"><i class="fas fa-envelope"></i></div>
                <div class="info-text">
                    <strong>E-mail</strong>
                    <a href="mailto:contato@libera.cash">contato@libera.cash</a>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon"><i class="fab fa-whatsapp"></i></div>
                <div class="info-text">
                    <strong>WhatsApp</strong>
                    <a href="https://wa.me/5511999999999" target="_blank" rel="noopener">(11) 98957-2783</a>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div class="info-text">
                    <strong>Endereço</strong>
                    <span>Av. Paulista, 1636 — Bela Vista<br>São Paulo/SP — CEP 01310-200</span>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon"><i class="far fa-clock"></i></div>
                <div class="info-text">
                    <strong>Atendimento</strong>
                    <span>Segunda a sexta<br>09h às 18h (exceto feriados)</span>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon"><i class="fas fa-shield-alt"></i></div>
                <div class="info-text">
                    <strong>Privacidade</strong>
                    <a href="/politica-de-privacidade/" target="_blank">Ver Política de Privacidade</a>
                </div>
            </div>

            <div class="info-social">
                <a href="https://www.facebook.com/creditovoce" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/credito.vc/" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>

    </div>
</div>

<footer class="footer">
    <div class="footer-container">
        <img src="images/logo-footer.png?v=2" class="footer-logo" alt="LiberaCash">
        <div class="footer-social">
            <a href="https://www.facebook.com/creditovoce" target="_blank" rel="noopener noreferrer" aria-label="Facebook LiberaCash"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/credito.vc/" target="_blank" rel="noopener noreferrer" aria-label="Instagram LiberaCash"><i class="fab fa-instagram"></i></a>
            <a href="#" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn LiberaCash"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <div class="footer-text">
            Ao acessar/utilizar este site, você aceita as condições dos <a href="/termos-e-condicoes/"  target="_blank">Termos de uso</a> e <a href="/politica-de-privacidade/" target="_blank">Política de Privacidade</a>.<br><br>
            LiberaCash é um site da LZO Agência de Publicidade LTDA (CNPJ 05.595.492/0001-05), sediada na Av. Paulista, 1636 — Bela Vista, São Paulo/SP. Não somos uma instituição financeira: oferecemos um serviço 100% gratuito de comparação de crédito pessoal e empresarial, conectando você às melhores condições entre nossos parceiros — principais Fintechs e Bancos do Brasil. Preencha o formulário e receba contato de um parceiro.
        </div>
        <div class="footer-copyright">
            &copy; <?php echo date('Y'); ?> LiberaCash. Todos os direitos reservados.
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('.hamburger').click(function(){ $('.nav-menu').slideToggle(); });
});
</script>

</body>
</html>
