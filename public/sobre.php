<?php
/**
 * Página Sobre - LiberaCash
 * Página institucional com informações da empresa,
 * missão, valores e equipe. Segue o design do blog.php.
 */
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre a LiberaCash | Quem Somos</title>

    <meta name="description" content="Conheça a LiberaCash — um serviço 100% gratuito de comparação de crédito pessoal e empresarial que conecta você às melhores condições entre os principais bancos e fintechs do Brasil.">
    <meta property="og:title" content="Sobre a LiberaCash | Quem Somos">
    <meta property="og:description" content="Conheça a LiberaCash — comparação gratuita de crédito entre os principais bancos e fintechs do Brasil.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://libera.cash/sobre/">

    <link rel="canonical" href="/sobre/">

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        {"@type": "ListItem", "position": 1, "name": "Início", "item": "https://libera.cash/"},
        {"@type": "ListItem", "position": 2, "name": "Sobre", "item": "https://libera.cash/sobre/"}
      ]
    }
    </script>

    <link href="/images/favicon.png" rel="shortcut icon" type="image/x-icon">
    <link href="/images/webclip.png" rel="apple-touch-icon">

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
            --text-light: #636e72;
            --gray-text: #666;
            --white: #ffffff;
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Lato', sans-serif;
            color: var(--text-dark);
            background-color: #f9f9f9;
            overflow-x: hidden;
            padding-top: 32px;
        }

        /* Top bar - fixa no topo, sempre visível */
        .top-bar {
            background-color: #19a44a;
            padding: 0; height: 32px; display: flex; align-items: center; justify-content: center;
            text-align: center;
            font-size: 11px;
            color: #ffffff;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1001;
        }

        /* Header */
        .header {
            background-color: var(--primary-green);
            padding: 10px 0;
            position: sticky;
            top: 32px;
            z-index: 1000;
        }
        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        .logo img { height: 35px; }
        .nav-menu {
            display: flex;
            list-style: none;
            gap: 20px;
        }
        .nav-menu a {
            color: var(--white);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }
        .hamburger {
            display: none;
            cursor: pointer;
            color: white;
            font-size: 24px;
        }

        /* Breadcrumbs */
        .breadcrumbs {
            max-width: 1000px;
            margin: 0 auto;
            padding: 14px 20px;
            font-size: 13px;
            color: var(--gray-text);
        }
        .breadcrumbs a { color: var(--gray-text); text-decoration: none; }
        .breadcrumbs a:hover { color: var(--primary-green); text-decoration: underline; }
        .breadcrumbs .sep { margin: 0 6px; color: #ccc; }
        .breadcrumbs .current { color: var(--text-dark); font-weight: 600; }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            padding: 70px 20px;
            text-align: center;
            color: white;
        }
        .hero h1 {
            font-family: 'Raleway', sans-serif;
            font-size: 2.6rem;
            font-weight: 800;
            margin-bottom: 15px;
        }
        .hero p {
            font-size: 1.1rem;
            max-width: 720px;
            margin: 0 auto;
            opacity: 0.95;
            line-height: 1.6;
        }

        /* Container */
        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .section {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            padding: 40px;
            margin-bottom: 30px;
        }
        .section h2 {
            font-family: 'Raleway', sans-serif;
            font-size: 1.8rem;
            color: var(--dark-bg);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .section h2 i {
            color: var(--primary-green);
            font-size: 1.6rem;
        }
        .section p {
            font-size: 15px;
            line-height: 1.8;
            color: var(--text-dark);
            margin-bottom: 15px;
        }

        /* Valores em grid */
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 25px;
        }
        .value-card {
            background: #f9f9f9;
            padding: 25px 20px;
            border-radius: 12px;
            text-align: center;
            transition: transform 0.3s;
        }
        .value-card:hover { transform: translateY(-4px); }
        .value-card i {
            font-size: 2rem;
            color: var(--primary-green);
            margin-bottom: 12px;
        }
        .value-card h3 {
            font-family: 'Raleway', sans-serif;
            font-size: 1.05rem;
            color: var(--dark-bg);
            margin-bottom: 8px;
        }
        .value-card p {
            font-size: 13px;
            color: var(--gray-text);
            line-height: 1.5;
            margin: 0;
        }

        /* Números / Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 20px;
            margin-top: 25px;
        }
        .stat-card {
            text-align: center;
            padding: 20px;
        }
        .stat-number {
            font-family: 'Raleway', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--primary-green);
            display: block;
        }
        .stat-label {
            font-size: 13px;
            color: var(--gray-text);
            margin-top: 5px;
        }

        /* Carrossel de parceiros */
        .logos-container {
            width: 100%;
            overflow: hidden;
            display: flex;
            margin-top: 20px;
        }
        .logos-track {
            display: flex;
            width: 200%;
            animation: infiniteScroll 30s linear infinite;
            will-change: transform;
        }
        .logos-track:hover { animation-play-state: paused; }
        .logo-item {
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            min-width: fit-content;
        }
        .logo-item img {
            height: 26px;
            width: auto;
            max-width: 130px;
            object-fit: contain;
            filter: grayscale(10%) opacity(0.9);
            transition: var(--transition);
        }
        .logo-item img:hover { filter: grayscale(0%) opacity(1); }
        @keyframes infiniteScroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* CTA */
        .cta-section {
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            color: white;
            text-align: center;
            padding: 50px 30px;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        .cta-section h2 {
            font-family: 'Raleway', sans-serif;
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: white;
            justify-content: center;
        }
        .cta-section h2 i { color: white; }
        .cta-section p {
            font-size: 15px;
            max-width: 600px;
            margin: 0 auto 25px auto;
            opacity: 0.95;
        }
        .cta-btn {
            display: inline-block;
            background: var(--accent-green);
            color: #000;
            padding: 14px 32px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            transition: transform 0.2s;
        }
        .cta-btn:hover { transform: scale(1.05); }

        /* Footer */
        .footer {
            padding: 50px 0;
            text-align: center;
            background-color: var(--white);
            border-top: 1px solid #eee;
        }
        .footer-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .footer-logo { height: 52px; margin-bottom: 25px; }
        .footer-social {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }
        .footer-social a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-green);
            color: #fff;
            font-size: 16px;
            text-decoration: none;
            transition: var(--transition);
        }
        .footer-social a:hover {
            background: var(--dark-green);
            transform: translateY(-2px);
        }
        .footer-policy-box { display: inline-flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 25px; font-size: 13px; color: #333333; cursor: pointer; user-select: none; }
        .footer-policy-box input[type="checkbox"] { accent-color: #1fc859; width: 16px; height: 16px; cursor: pointer; }
        .footer-policy-box a { color: #333333; text-decoration: none; font-weight: 500; }
        .footer-policy-box a:hover { text-decoration: underline; }
        .footer-text {
            font-size: 12px;
            color: #666666;
            line-height: 1.6;
            max-width: 720px;
            margin: 0 auto;
            text-align: center;
        }
        .footer-copy {
            font-size: 11px;
            color: #999;
            margin-top: 16px;
        }

        /* Media */
        @media (max-width: 768px) {
            .nav-menu { display: none; }
            .hamburger { display: block; }
            .hero h1 { font-size: 1.8rem; }
            .hero p { font-size: 1rem; }
            .section { padding: 25px; }
            .section h2 { font-size: 1.4rem; }
            .footer-text { text-align: left; }
            .logo-item { padding: 0 25px; }
            .logo-item img { height: 22px; }
        }
    </style>
  <link href="/css/brand-tokens.css?<?= uniqid() ?>" rel="stylesheet">
</head>
<body>

<div class="top-bar">
    Atenção! A LiberaCash não cobra nenhum depósito antecipado para a liberação de empréstimo.
</div>

<header class="header">
    <div class="header-container">
        <div class="logo">
            <a href="/"><img src="/images/logo.png?v=2" alt="LiberaCash"></a>
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

<section class="hero">
    <h1>Sobre a LiberaCash</h1>
    <p>Somos um comparador gratuito de crédito que conecta você às melhores condições entre os principais bancos e fintechs do Brasil, de forma simples, rápida e transparente.</p>
</section>

<div class="container">

    <div class="section">
        <h2><i class="fas fa-bullseye"></i> Nossa Missão</h2>
        <p>Facilitar o acesso ao crédito para brasileiros de todo o país, oferecendo uma comparação clara e imparcial das melhores ofertas do mercado. Acreditamos que informação de qualidade é o primeiro passo para decisões financeiras mais inteligentes.</p>
        <p>Nosso compromisso é ajudar você a encontrar a modalidade de crédito mais adequada ao seu perfil, com as condições mais vantajosas e sem burocracia.</p>
    </div>

    <div class="section">
        <h2><i class="fas fa-eye"></i> Nossa Visão</h2>
        <p>Ser a plataforma de referência em comparação de crédito no Brasil, reconhecida pela qualidade do serviço, transparência das informações e pelo cuidado com nossos usuários.</p>
    </div>

    <div class="section">
        <h2><i class="fas fa-heart"></i> Nossos Valores</h2>
        <div class="values-grid">
            <div class="value-card">
                <i class="fas fa-shield-alt"></i>
                <h3>Transparência</h3>
                <p>Informações claras e sem letras miúdas em todas as ofertas.</p>
            </div>
            <div class="value-card">
                <i class="fas fa-hand-holding-usd"></i>
                <h3>Gratuidade</h3>
                <p>Serviço 100% grátis para o usuário. Sem taxas nem pegadinhas.</p>
            </div>
            <div class="value-card">
                <i class="fas fa-user-shield"></i>
                <h3>Segurança</h3>
                <p>Proteção total dos seus dados conforme a LGPD.</p>
            </div>
            <div class="value-card">
                <i class="fas fa-lightbulb"></i>
                <h3>Educação Financeira</h3>
                <p>Conteúdo gratuito para você tomar as melhores decisões.</p>
            </div>
        </div>
    </div>

    <div class="section">
        <h2><i class="fas fa-building"></i> Quem Somos</h2>
        <p>LiberaCash é uma marca da <strong>LZO Agência de Publicidade LTDA</strong> (CNPJ 05.595.492/0001-05), sediada na Av. Paulista, 1636 — Bela Vista, São Paulo/SP.</p>
        <p>Importante: <strong>não somos uma instituição financeira</strong>. Não emprestamos dinheiro nem emitimos cartões de crédito. O que fazemos é conectar você aos melhores parceiros do mercado, bancos consolidados e fintechs inovadoras, para que você compare condições e escolha a opção que faz mais sentido pra você.</p>
        <p>Trabalhamos com os principais nomes do setor financeiro brasileiro, sempre em busca das melhores condições para nossos usuários.</p>
        <p>Sabe quem esta por trás de tudo isso? <strong>nosso time de especialistas!</strong>. Quer conhecer eles? </p> <a href="/time/" class="cta-btn">Conheça nosso Time</a>
    </div>

    <div class="section">
        <h2><i class="fas fa-chart-line"></i> Como Trabalhamos</h2>
        <p><strong>1. Você preenche um formulário simples</strong> com seus dados e o tipo de crédito que procura.</p>
        <p><strong>2. Comparamos as ofertas</strong> dos nossos parceiros para o seu perfil, sem custo algum.</p>
        <p><strong>3. Você recebe as melhores propostas</strong> e escolhe a que mais te agrada — sem compromisso.</p>
        <p><strong>4. A contratação é feita diretamente com o banco ou fintech</strong> escolhido, sob as condições oferecidas por eles.</p>
    </div>

    <div class="section">
        <h2><i class="fas fa-handshake"></i> Nossos Parceiros</h2>
        <p>Trabalhamos com as principais Fintechs de Crédito e Bancos do Brasil para trazer as melhores condições para você.</p>
        <div class="logos-container">
            <div class="logos-track">
                <div class="logo-item"><img src="/images/juvo-creditovc.png" alt="Juvo"></div>
                <div class="logo-item"><img src="/images/noverde-creditovc.png" alt="NoVerde"></div>
                <div class="logo-item"><img src="/images/creditas-creditovc.png" alt="Creditas"></div>
                <div class="logo-item"><img src="/images/bv-creditovc.png" alt="Banco BV"></div>
                <div class="logo-item"><img src="/images/juvo-creditovc.png" alt="Juvo"></div>
                <div class="logo-item"><img src="/images/noverde-creditovc.png" alt="NoVerde"></div>
                <div class="logo-item"><img src="/images/creditas-creditovc.png" alt="Creditas"></div>
                <div class="logo-item"><img src="/images/bv-creditovc.png" alt="Banco BV"></div>
                <div class="logo-item"><img src="/images/juvo-creditovc.png" alt="Juvo"></div>
                <div class="logo-item"><img src="/images/noverde-creditovc.png" alt="NoVerde"></div>
                <div class="logo-item"><img src="/images/creditas-creditovc.png" alt="Creditas"></div>
                <div class="logo-item"><img src="/images/bv-creditovc.png" alt="Banco BV"></div>
                <div class="logo-item"><img src="/images/juvo-creditovc.png" alt="Juvo"></div>
                <div class="logo-item"><img src="/images/noverde-creditovc.png" alt="NoVerde"></div>
                <div class="logo-item"><img src="/images/creditas-creditovc.png" alt="Creditas"></div>
                <div class="logo-item"><img src="/images/bv-creditovc.png" alt="Banco BV"></div>
            </div>
        </div>
    </div>

    <div class="cta-section">
        <h2><i class="fas fa-comments"></i> Fale com a Gente</h2>
        <p>Tem alguma dúvida, sugestão ou quer ser nosso parceiro? Adoraríamos ouvir você.</p>
        <a href="/contato/" class="cta-btn">ENTRAR EM CONTATO</a>
    </div>

</div>

<footer class="footer">
    <div class="footer-container">
        <img src="/images/logo-footer.png?v=2" class="footer-logo" alt="LiberaCash">

        <div class="footer-social">
            <a href="https://www.facebook.com/creditovoce" target="_blank" rel="noopener noreferrer" aria-label="Facebook LiberaCash"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/credito.vc/" target="_blank" rel="noopener noreferrer" aria-label="Instagram LiberaCash"><i class="fab fa-instagram"></i></a>
            <a href="#" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn LiberaCash"><i class="fab fa-linkedin-in"></i></a>
        </div>

        <label class="footer-policy-box" id="policyLabel">
            <input type="checkbox" id="policyCheckbox" checked>
            <span>Ao acessar/utilizar este site, você aceita as condições dos <a href="/termos-e-condicoes/" target="_blank">Termos de uso</a> e <a href="/politica-de-privacidade/" target="_blank">Política de Privacidade</a></span>
        </label>

        <div class="footer-text">
            LiberaCash&reg; é um site de comparação e correspondente de instituições financeiras parceiras, não é uma instituição financeira e não realiza empréstimos diretamente. As condições de crédito (taxas, prazos e valores) são definidas exclusivamente pela instituição parceira responsável pela proposta, mediante análise de crédito. A aprovação está sujeita a análise cadastral.
        </div>
        <p class="footer-copy">&copy; <?php echo date('Y'); ?> LiberaCash&reg; — Todos os direitos reservados.</p>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('.hamburger').click(function(){
        $('.nav-menu').slideToggle();
    });
});
</script>

</body>
</html>
