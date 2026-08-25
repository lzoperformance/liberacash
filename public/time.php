<?php
/**
 * Página Time - Credito.vc
 * Apresenta liderança executiva:
 * CEO/Founder, CTO e 8 áreas primordiais com seus líderes.
 * Fotos e nomes são placeholders — substituir pelos reais.
 */

$lideres = [
    // Fundação
    [
        "nome" => "CEO",
        "cargo" => "CEO - Chief Executive Officer",
        "area" => "Liderança Executiva",
        "bio" => "CEO da Crédito.vc, lidera a visão estratégica da empresa e a expansão da plataforma no mercado brasileiro de comparação de crédito.",
        "foto" => "https://ui-avatars.com/api/?name=CEO&background=2ecc71&color=fff&size=300&bold=true",
        "linkedin" => "#",
        "destaque" => true
    ],
    [
        "nome" => "Gustavo Almeida",
        "cargo" => "CTO — Chief Technology Officer",
        "area" => "Tecnologia",
        "bio" => "Responsável pela arquitetura tecnológica, segurança da informação e evolução dos produtos digitais da Crédito.vc.",
        "foto" => "https://ui-avatars.com/api/?name=CTO&background=27ae60&color=fff&size=300&bold=true",
        "linkedin" => "#",
        "destaque" => true
    ],
    // 8 áreas primordiais
    [
        "nome" => "Nome do CFO",
        "cargo" => "CFO — Chief Financial Officer",
        "area" => "Financeiro",
        "bio" => "Gestão financeira, controladoria, planejamento orçamentário e relações com investidores.",
        "foto" => "https://ui-avatars.com/api/?name=CFO&background=2ecc71&color=fff&size=300&bold=true",
        "linkedin" => "#"
    ],
    [
        "nome" => "Nome do CMO",
        "cargo" => "CMO — Chief Marketing Officer",
        "area" => "Marketing",
        "bio" => "Estratégia de marca, aquisição de usuários, performance digital e comunicação institucional.",
        "foto" => "https://ui-avatars.com/api/?name=CMO&background=2ecc71&color=fff&size=300&bold=true",
        "linkedin" => "#"
    ],
    [
        "nome" => "Nome do CPO",
        "cargo" => "CPO — Chief Product Officer",
        "area" => "Produto",
        "bio" => "Roadmap de produto, experiência do usuário e evolução das jornadas de comparação de crédito.",
        "foto" => "https://ui-avatars.com/api/?name=CPO&background=2ecc71&color=fff&size=300&bold=true",
        "linkedin" => "#"
    ],
    [
        "nome" => "Nome do Head Comercial",
        "cargo" => "Head Comercial & Parcerias",
        "area" => "Comercial",
        "bio" => "Relacionamento com bancos e fintechs parceiras, negociação de condições e expansão da rede de parceiros.",
        "foto" => "https://ui-avatars.com/api/?name=Comercial&background=2ecc71&color=fff&size=300&bold=true",
        "linkedin" => "#"
    ],
    [
        "nome" => "Nome do COO",
        "cargo" => "COO — Chief Operating Officer",
        "area" => "Operações",
        "bio" => "Otimização de processos, gestão operacional e eficiência da entrega de propostas de crédito.",
        "foto" => "https://ui-avatars.com/api/?name=COO&background=2ecc71&color=fff&size=300&bold=true",
        "linkedin" => "#"
    ],
    [
        "nome" => "Nome do Head Jurídico",
        "cargo" => "Head de Jurídico & Compliance",
        "area" => "Jurídico",
        "bio" => "Conformidade regulatória, LGPD, contratos com parceiros e assuntos jurídicos societários.",
        "foto" => "https://ui-avatars.com/api/?name=Juridico&background=2ecc71&color=fff&size=300&bold=true",
        "linkedin" => "#"
    ],
    [
        "nome" => "Nome do Head de People",
        "cargo" => "Head of People",
        "area" => "Pessoas & Cultura",
        "bio" => "Atração, desenvolvimento e retenção de talentos, cultura organizacional e experiência do colaborador.",
        "foto" => "https://ui-avatars.com/api/?name=People&background=2ecc71&color=fff&size=300&bold=true",
        "linkedin" => "#"
    ],
    [
        "nome" => "Nome do Head de CS",
        "cargo" => "Head of Customer Success",
        "area" => "Atendimento",
        "bio" => "Experiência do usuário, atendimento multicanal e satisfação de quem usa a Crédito.vc.",
        "foto" => "https://ui-avatars.com/api/?name=CS&background=2ecc71&color=fff&size=300&bold=true",
        "linkedin" => "#"
    ],
];

$destaques = array_filter($lideres, function($l){ return !empty($l['destaque']); });
$areas = array_filter($lideres, function($l){ return empty($l['destaque']); });
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosso Time | Crédito.vc</title>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        {"@type": "ListItem", "position": 1, "name": "Início", "item": "https://libera.cash/"},
        {"@type": "ListItem", "position": 2, "name": "Sobre", "item": "https://libera.cash/sobre/"},
        {"@type": "ListItem", "position": 3, "name": "Nosso Time", "item": "https://libera.cash/time/"}
      ]
    }
    </script>

    <meta name="description" content="Conheça as pessoas por trás da Crédito.vc — CEO, CTO e as lideranças das áreas que fazem nosso comparador de crédito funcionar.">
    <meta property="og:title" content="Nosso Time | Crédito.vc">
    <meta property="og:description" content="Conheça as lideranças da Crédito.vc.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://libera.cash/time/">

    <link rel="canonical" href="/time/">

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

        .breadcrumbs { max-width: 1200px; margin: 0 auto; padding: 14px 20px; font-size: 13px; color: var(--gray-text); }
        .breadcrumbs a { color: var(--gray-text); text-decoration: none; }
        .breadcrumbs a:hover { color: var(--primary-green); text-decoration: underline; }
        .breadcrumbs .sep { margin: 0 6px; color: #ccc; }
        .breadcrumbs .current { color: var(--text-dark); font-weight: 600; }

        .hero { background: linear-gradient(135deg, var(--primary-green), var(--dark-green)); padding: 70px 20px; text-align: center; color: #fff; }
        .hero h1 { font-family: 'Raleway', sans-serif; font-size: 2.6rem; font-weight: 800; margin-bottom: 15px; }
        .hero p { font-size: 1.1rem; max-width: 720px; margin: 0 auto; opacity: 0.95; line-height: 1.6; }

        .container { max-width: 1200px; margin: 50px auto; padding: 0 20px; }

        .section-title {
            text-align: center;
            margin-bottom: 30px;
        }
        .section-title h2 {
            font-family: 'Raleway', sans-serif;
            font-size: 2rem;
            color: var(--dark-bg);
            margin-bottom: 8px;
        }
        .section-title p {
            font-size: 14px;
            color: var(--gray-text);
        }

        /* Destaques (CEO + CTO) */
        .destaques-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            max-width: 800px;
            margin: 0 auto 60px auto;
        }
        .destaque-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s;
            border-top: 4px solid var(--primary-green);
        }
        .destaque-card:hover { transform: translateY(-5px); }
        .destaque-card img { width: 100%; height: 260px; object-fit: cover; }
        .destaque-info { padding: 25px; }
        .destaque-info .area-badge {
            display: inline-block;
            background: #eafaf1;
            color: var(--dark-green);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        .destaque-info h3 {
            font-family: 'Raleway', sans-serif;
            font-size: 1.4rem;
            color: var(--dark-bg);
            margin-bottom: 5px;
        }
        .destaque-info .cargo {
            font-size: 13px;
            color: var(--primary-green);
            font-weight: 700;
            margin-bottom: 12px;
        }
        .destaque-info .bio {
            font-size: 13px;
            color: var(--gray-text);
            line-height: 1.6;
            margin-bottom: 15px;
        }

        /* Grid das áreas */
        .areas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 25px;
        }
        .area-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.05);
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s;
        }
        .area-card:hover { transform: translateY(-4px); box-shadow: 0 15px 30px rgba(0,0,0,0.08); }
        .area-card img { width: 100%; height: 200px; object-fit: cover; }
        .area-info { padding: 18px; }
        .area-info .area-badge {
            display: inline-block;
            background: #eafaf1;
            color: var(--dark-green);
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .area-info h3 {
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
            color: var(--dark-bg);
            margin-bottom: 3px;
        }
        .area-info .cargo {
            font-size: 12px;
            color: var(--primary-green);
            font-weight: 700;
            margin-bottom: 8px;
        }
        .area-info .bio {
            font-size: 12px;
            color: var(--gray-text);
            line-height: 1.55;
            margin-bottom: 12px;
        }

        .lider-social a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #0A66C2;
            color: #fff;
            font-size: 13px;
            text-decoration: none;
            transition: var(--transition);
        }
        .lider-social a:hover { transform: scale(1.1); }

        /* CTA */
        .cta-join {
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            color: #fff;
            text-align: center;
            padding: 50px 30px;
            border-radius: 15px;
            margin-top: 50px;
        }
        .cta-join h2 { font-family: 'Raleway', sans-serif; font-size: 1.8rem; margin-bottom: 12px; }
        .cta-join p { font-size: 15px; max-width: 600px; margin: 0 auto 25px auto; opacity: 0.95; }
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
            .section-title h2 { font-size: 1.5rem; }
            .footer-text { text-align: left; }
        }
    </style>
  <link href="css/brand-tokens.css?<?= uniqid() ?>" rel="stylesheet">
</head>
<body>

<div class="top-bar">
    Atenção! A Crédito.vc não cobra nenhum depósito antecipado para a liberação de empréstimo.
</div>

<header class="header">
    <div class="header-container">
        <div class="logo">
            <a href="/"><img src="images/logo.png" alt="Crédito.vc"></a>
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
    <a href="/sobre/">Sobre</a>
    <span class="sep">/</span>
    <span class="current">Nosso Time</span>
</nav>

<section class="hero">
    <h1>Nosso Time</h1>
    <p>Conheça as pessoas que constroem a Crédito.vc todos os dias. Um time formado por especialistas apaixonados por finanças, tecnologia e por facilitar a vida do brasileiro.</p>
</section>

<div class="container">

    <div class="section-title">
        <h2>Liderança Executiva</h2>
        <p>Quem está no comando da visão e da tecnologia da Crédito.vc</p>
    </div>

    <div class="destaques-grid">
        <?php foreach ($destaques as $lider): ?>
        <div class="destaque-card">
            <img src="<?php echo htmlspecialchars($lider['foto'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($lider['nome'], ENT_QUOTES, 'UTF-8'); ?>">
            <div class="destaque-info">
                <span class="area-badge"><?php echo htmlspecialchars($lider['area'], ENT_QUOTES, 'UTF-8'); ?></span>
                <h3><?php echo htmlspecialchars($lider['nome'], ENT_QUOTES, 'UTF-8'); ?></h3>
                <div class="cargo"><?php echo htmlspecialchars($lider['cargo'], ENT_QUOTES, 'UTF-8'); ?></div>
                <p class="bio"><?php echo htmlspecialchars($lider['bio'], ENT_QUOTES, 'UTF-8'); ?></p>
                <div class="lider-social">
                    <a href="<?php echo htmlspecialchars($lider['linkedin'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="section-title">
        <h2>Lideranças por Área</h2>
        <p>As 8 áreas primordiais que sustentam a operação da Crédito.vc</p>
    </div>

    <div class="areas-grid">
        <?php foreach ($areas as $lider): ?>
        <div class="area-card">
            <img src="<?php echo htmlspecialchars($lider['foto'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($lider['nome'], ENT_QUOTES, 'UTF-8'); ?>">
            <div class="area-info">
                <span class="area-badge"><?php echo htmlspecialchars($lider['area'], ENT_QUOTES, 'UTF-8'); ?></span>
                <h3><?php echo htmlspecialchars($lider['nome'], ENT_QUOTES, 'UTF-8'); ?></h3>
                <div class="cargo"><?php echo htmlspecialchars($lider['cargo'], ENT_QUOTES, 'UTF-8'); ?></div>
                <p class="bio"><?php echo htmlspecialchars($lider['bio'], ENT_QUOTES, 'UTF-8'); ?></p>
                <div class="lider-social">
                    <a href="<?php echo htmlspecialchars($lider['linkedin'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="cta-join">
        <h2>Quer fazer parte do time?</h2>
        <p>Estamos sempre em busca de pessoas talentosas e apaixonadas por transformar o mercado de crédito no Brasil.</p>
        <a href="mailto:carreiras@libera.cash" class="cta-btn">VER OPORTUNIDADES</a>
    </div>

</div>

<footer class="footer">
    <div class="footer-container">
        <img src="images/logo-footer.png" class="footer-logo" alt="Crédito.vc">
        <div class="footer-social">
            <a href="https://www.facebook.com/creditovoce" target="_blank" rel="noopener noreferrer" aria-label="Facebook Crédito.vc"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/credito.vc/" target="_blank" rel="noopener noreferrer" aria-label="Instagram Crédito.vc"><i class="fab fa-instagram"></i></a>
            <a href="#" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn Crédito.vc"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <div class="footer-text">
            Ao acessar/utilizar este site, você aceita as condições dos <a href="/termos-e-condicoes/" target="_blank">Termos de uso</a> e <a href="/politica-de-privacidade/" target="_blank">Política de Privacidade</a>.<br><br>
            Credito.vc é um site da LZO Agência de Publicidade LTDA (CNPJ 05.595.492/0001-05), sediada na Av. Paulista, 1636 — Bela Vista, São Paulo/SP. Não somos uma instituição financeira: oferecemos um serviço 100% gratuito de comparação de crédito pessoal e empresarial, conectando você às melhores condições entre nossos parceiros — principais Fintechs e Bancos do Brasil. Preencha o formulário e receba contato de um parceiro.
        </div>
        <div class="footer-copyright">
            &copy; <?php echo date('Y'); ?> Credito.vc. Todos os direitos reservados.
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
