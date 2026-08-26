<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termos de Uso e Condições - LiberaCash</title>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        {"@type": "ListItem", "position": 1, "name": "Início", "item": "https://libera.cash/"},
        {"@type": "ListItem", "position": 2, "name": "Termos e Condições", "item": "https://libera.cash/termos-e-condicoes/"}
      ]
    }
    </script>

    <meta name="description" content="Termos de uso e condições de navegação do site LiberaCash.">
    <meta property="og:title" content="Termos e Condições - LiberaCash">
    <meta property="og:description" content="Termos de uso e condições de navegação da nossa plataforma.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://libera.cash/termos-e-condicoes/">

    <link rel="canonical" href="/termos-e-condicoes/">

    <link href="/images/favicon.png" rel="shortcut icon" type="image/x-icon">
    <link href="/images/webclip.png" rel="apple-touch-icon">

    <!-- Fontes / ícones -->
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

        /* ==== Top Warning Bar ==== */
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

        /* ==== Header ==== */
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

        /* ==== Breadcrumbs ==== */
        .breadcrumbs {
            max-width: 1000px;
            margin: 0 auto;
            padding: 14px 20px;
            font-size: 13px;
            color: var(--text-light);
        }
        .breadcrumbs a { color: var(--text-light); text-decoration: none; }
        .breadcrumbs a:hover { color: var(--primary-green); text-decoration: underline; }
        .breadcrumbs .sep { margin: 0 6px; color: #ccc; }
        .breadcrumbs .current { color: var(--text-dark); font-weight: 600; }

        /* ==== Banner Termos ==== */
        .banner-termos {
            width: 100%;
            height: 250px;
            background-image: url('/images/banner-termos.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .banner-termos::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.4); /* Fundo escurecido para destacar o texto */
        }
        .banner-termos h1 {
            position: relative;
            z-index: 1;
            color: #ffffff;
            font-family: 'Raleway', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            text-align: center;
            padding: 0 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        /* ==== Conteúdo de Texto ==== */
        .container {
            max-width: 1000px;
            margin: -40px auto 40px auto; /* Sobe um pouco para sobrepor ao banner */
            padding: 0 20px;
            position: relative;
            z-index: 5;
        }
        .termos-content {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            padding: 40px 50px;
        }
        .termos-content h2 {
            font-family: 'Raleway', sans-serif;
            font-size: 1.5rem;
            color: var(--dark-bg);
            margin-top: 35px;
            margin-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 8px;
        }
        .termos-content p {
            font-size: 16px;
            line-height: 1.8;
            color: var(--gray-text);
            margin-bottom: 15px;
            text-align: justify;
        }
        .termos-content strong {
            color: var(--text-dark);
        }
        .termos-content ul {
            margin-left: 25px;
            margin-bottom: 20px;
            color: var(--gray-text);
            font-size: 16px;
            line-height: 1.8;
        }
        .termos-content ul li {
            margin-bottom: 10px;
        }

        /* ==== Footer ==== */
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
        .footer-logo { height: 38px; margin-bottom: 25px; }
        .footer-text {
            font-size: 12px;
            color: #666666;
            line-height: 1.7;
            text-align: justify;
        }
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
        .footer-details {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
            max-width: 100%;
            text-align: left;
        }
        .footer-details summary {
            cursor: pointer;
            color: var(--primary-green);
            font-weight: 600;
            margin-bottom: 10px;
        }
        .footer-details p {
            line-height: 1.7;
            margin-top: 10px;
        }
        .footer-copyright {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #999;
            width: 100%;
            text-align: center;
        }

        /* ==== Media Queries ==== */
        @media (max-width: 768px) {
            .nav-menu { display: none; }
            .hamburger { display: block; }
            .banner-termos { height: 180px; }
            .banner-termos h1 { font-size: 2rem; }
            .container { margin-top: -20px; }
            .termos-content { padding: 30px 20px; }
            .footer-text { text-align: left; }
        }
    </style>
  <link href="/css/brand-tokens.css?<?= uniqid() ?>" rel="stylesheet">
</head>
<body>

<!-- ==== Top warning bar ==== -->
<div class="top-bar">
    Atenção! A LiberaCash não cobra nenhum depósito antecipado para a liberação de empréstimo.
</div>

<!-- ==== Header ==== -->
<header class="header">
    <div class="header-container">
        <div class="logo">
            <a href="/"><img src="/images/logo.png?v=2" alt="LiberaCash"></a>
        </div>
        
        <ul class="nav-menu">
            <li><a href="/">Crédito</a></li>
            <li><a href="/cartoes/">Cartões</a></li>
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
    <span class="current">Termos e Condições</span>
</nav>

<!-- ==== Banner Termos e Condições ==== -->
<div class="banner-termos">
    <h1>Termos e Condições</h1>
</div>

<!-- ==== Conteúdo ==== -->
<div class="container">
    <div class="termos-content">
        <p><strong>TERMOS DE USO E CONDIÇÕES DE NAVEGAÇÃO – WWW.LIBERA.CASH</strong></p>
        <p>Bem-vindo ao libera.cash. Este site é de propriedade e operado pela LZO AGÊNCIA DE PUBLICIDADE LTDA, inscrita no CNPJ sob o nº 05.595.492/0001-05, com sede na Av. Paulista, 1636 - Conj 04 Sala 1504, Bela Vista, São Paulo/SP, CEP 01.310-200, doravante denominada simplesmente "LZO".</p>
        <p>Ao acessar este site, simular propostas ou preencher nossos formulários, você (doravante denominado "Usuário") aceita e concorda integralmente com as condições destes Termos de Uso. Caso não concorde, solicitamos que não utilize nossa plataforma.</p>

        <h2>1. Natureza do Serviço (O que nós fazemos)</h2>
        <p>A LZO, por meio do site libera.cash, atua como plataforma digital de captação de leads financeiros, originação de propostas e correspondente bancário (nos termos da Resolução CMN nº 4.935 do Banco Central do Brasil).</p>
        <p><strong>Importante:</strong> A LZO NÃO é uma instituição financeira, não concede empréstimos, financiamentos ou cartões de crédito diretamente, e não cobra qualquer taxa ou depósito antecipado do Usuário para a aprovação ou liberação de crédito.</p>
        <p>Nossa função é aproximar o Usuário de potenciais credores, facilitando a busca pelas melhores ofertas do mercado.</p>

        <h2>2. Cadastro do Usuário e Veracidade das Informações</h2>
        <p>Ao preencher os formulários da plataforma, o Usuário declara ser maior de 18 anos, plenamente capaz, e compromete-se a fornecer informações exatas, precisas e verdadeiras.</p>
        <p>O Usuário assume total responsabilidade civil e criminal pela autenticidade dos dados fornecidos (como renda, CPF, restrições financeiras e dados de contato), estando ciente de que dados falsos ou fraudulentos serão reportados às autoridades competentes e resultarão no descarte imediato da proposta.</p>

        <h2>3. Envio de Dados para Parceiros e Bureaus de Crédito</h2>
        <p>O Usuário está ciente e concorda que, ao enviar sua solicitação de crédito através do libera.cash:</p>
        <ul>
            <li>Seus dados cadastrais, financeiros, profissionais e de perfil de crédito serão compartilhados com nossa ampla rede de Instituições Financeiras Parceiras, Bancos, Fintechs, Administradoras de Cartão e Correspondentes Bancários, para fins de análise de risco, viabilidade, simulação de taxas e eventual concessão de crédito.</li>
            <li>Seus dados serão enviados e consultados junto a Bureaus de Crédito, birôs de perfilamento e proteção ao crédito (incluindo Serasa Experian, Boa Vista SCPC, Quod, entre outros de mercado), bem como ao Sistema de Informações de Crédito (SCR) do Banco Central do Brasil, com a finalidade de prevenção à fraude, score comportamental e proteção do crédito.</li>
        </ul>
        <p>A aprovação ou recusa do crédito é de decisão exclusiva e soberana de cada instituição financeira parceira, não tendo a LZO qualquer gerência ou responsabilidade sobre a negativa de crédito.</p>

        <h2>4. Comunicações de Marketing e Canais de Contato</h2>
        <p>Ao disponibilizar e-mail e telefone celular, o Usuário autoriza expressamente a LZO, as empresas do seu grupo econômico e seus parceiros comerciais a entrarem em contato para fins de:</p>
        <ul>
            <li>Informar o andamento da simulação de crédito;</li>
            <li>Enviar novas ofertas de produtos financeiros, empréstimos ou serviços complementares.</li>
        </ul>
        <p>As comunicações poderão ser realizadas via E-mail, SMS, Notificações Push, Ligações Telefônicas e Aplicativos de Mensagens Instantâneas (como WhatsApp). O Usuário poderá revogar esta autorização a qualquer momento através do link de descadastro (opt-out) contido nas mensagens ou enviando um e-mail para privacidade@lzo.com.br.</p>

        <h2>5. Limitação de Responsabilidade</h2>
        <p>A LZO emprega seus melhores esforços e utiliza tecnologia de ponta (sistema proprietário FormUp®) para manter o site seguro e operacional. Contudo, a LZO não se responsabiliza por indisponibilidades temporárias do sistema decorrentes de falhas na internet do usuário, casos fortuitos ou de força maior.</p>
        <p>A LZO não se responsabiliza pelas condições contratuais, taxas de juros ou tarifas pactuadas entre o Usuário e a Instituição Financeira parceira escolhida, sendo tal relação jurídica inteiramente externa à nossa plataforma.</p>

        <h2>6. Propriedade Intelectual</h2>
        <p>Todos os direitos de propriedade intelectual sobre o site libera.cash, incluindo marcas, logotipos, layouts, gráficos, textos e o sistema FormUp®, pertencem exclusivamente à LZO ou estão devidamente licenciados. É proibida a cópia, reprodução ou engenharia reversa sem autorização prévia por escrito.</p>

        <h2>7. Modificações e Atualizações</h2>
        <p>A LZO reserva-se o direito de alterar estes Termos de Uso a qualquer momento, visando adequar-se a mudanças legislativas ou novas resoluções do Banco Central do Brasil. As alterações entrarão em vigor imediatamente após a publicação no site.</p>

        <h2>8. Lei Aplicável e Foro</h2>
        <p>Estes Termos são regidos pelas leis da República Federativa do Brasil. Fica eleito o Foro da Comarca de São Paulo/SP para dirimir quaisquer dúvidas ou controvérsias oriundas deste documento.</p>

        <p style="margin-top: 40px; font-style: italic;">Data da última atualização: 27 de fevereiro de 2026.</p>
    </div>
</div>

<!-- ==== Footer ==== -->
<footer class="footer">
    <div class="footer-container">
        <img src="/images/logo-footer.png?v=2" class="footer-logo" alt="LiberaCash">

        <div class="footer-social">
            <a href="https://www.facebook.com/creditovoce" target="_blank" rel="noopener noreferrer" aria-label="Facebook LiberaCash"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/credito.vc/" target="_blank" rel="noopener noreferrer" aria-label="Instagram LiberaCash"><i class="fab fa-instagram"></i></a>
            <a href="#" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn LiberaCash"><i class="fab fa-linkedin-in"></i></a>
        </div>

        <div class="footer-text">
            Ao acessar/utilizar este site, você aceita as condições dos <a href="/termos-e-condicoes/" target="_blank">Termos de uso</a> e <a href="/politica-de-privacidade/" target="_blank">Política de Privacidade</a>.<br><br>
            LiberaCash é um site da LZO Agência de Publicidade LTDA (CNPJ 05.595.492/0001-05), sediada na Av. Paulista, 1636 — Bela Vista, São Paulo/SP. Não somos uma instituição financeira: oferecemos um serviço 100% gratuito de comparação de crédito pessoal e empresarial, conectando você às melhores condições entre nossos parceiros — principais Fintechs e Bancos do Brasil. Preencha o formulário e receba contato de um parceiro.
        </div>

        <details class="footer-details">
            <summary>Ver condições completas de crédito</summary>
            <p>Prazo de pagamento: varia de acordo com a instituição financeira escolhida, podendo ser entre 6 e 120 meses. A taxa de juros pode variar de 14,9% a.m. (423,96% a.a.) até 18,5% a.m. (668,75% a.a.), e o custo efetivo total (CET) pode variar de 15,57% a.m. (467,86% a.a.) até 27,29% a.m. (1709,88% a.a.). Exemplo: um empréstimo de R$ 750,00 em 6 meses com taxa de juros de 14,9% a.m. terá parcelas de R$ 198,39 (caso o CET seja igual à taxa de juros). Um modelo de aparelho celular compatível poderá ser necessário para a aprovação do crédito.</p>
        </details>

        <div class="footer-copyright">
            &copy; <?php echo date('Y'); ?> LiberaCash. Todos os direitos reservados.
        </div>
    </div>
</footer>

<!-- ==== Scripts ==== -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    // Menu Hamburger Mobile
    $('.hamburger').click(function(){
        $('.nav-menu').slideToggle();
    });
});
</script>

</body>
</html>
