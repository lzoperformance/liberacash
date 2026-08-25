<?php
require_once 'produtos-config.php';

// Capturar produto da URL (se veio de campanha específica)
$produto_url = $_GET['produto'] ?? null;
$produto_default = get_default_product();
$produto_selecionado = $produto_url ? get_product_by_slug($produto_url) : $produto_default;

// Produtos ativos para exibição
$produtos_ativos = get_products_ordered();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>LiberaCash - Empréstimo Rápido e Seguro</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  <meta property="og:title" content="LiberaCash">
  <meta property="og:description" content="Descubra quanto você tem disponível para receber e tenha o dinheiro na sua conta in até 24h.">
  <meta property="og:image" content="https://libera.cash/images/webclip.png">
  <meta property="og:url" content="https://libera.cash/">
  <meta content="summary" name="twitter:card">
  <meta name="description" content="Libera Cash — Empréstimo pessoal online rápido e seguro. Compare propostas de múltiplos parceiros e receba o dinheiro na conta em até 24h. Simule grátis!">
  <meta name="keywords" content="empréstimo pessoal, empréstimo online, crédito pessoal, empréstimo negativado, simular empréstimo, crédito rápido">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="/">
  <meta property="og:type" content="website">
  <meta property="og:locale" content="pt_BR">
  <meta property="og:site_name" content="Libera Cash">
  <meta name="twitter:title" content="Libera Cash - Empréstimo Rápido e Seguro">
  <meta name="twitter:description" content="Compare propostas de empréstimo e receba o dinheiro na conta em até 24h. Simule grátis!">
  <link href="images/favicon.png" rel="shortcut icon" type="image/x-icon">
  <link href="images/webclip.png" rel="apple-touch-icon">
  
  <!-- Preconnect para CDNs -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://cdnjs.cloudflare.com">
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- CSS Principal -->
  <link href="css/webflow.css" rel="stylesheet" type="text/css">
  <link href="css/credito-vc-jul-23.webflow.css?<?= uniqid() ?>" rel="stylesheet" type="text/css">
  <link href="css/main.css?<?= uniqid() ?>" rel="stylesheet" type="text/css">

  <!-- Font Awesome - carregado de forma não-bloqueante -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" media="print" onload="this.media='all'">
  <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"></noscript>
  
  <!-- Fontes Google - link direto (sem WebFont loader) -->
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&family=Raleway:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  
  <!-- Phosphor Icons para os produtos -->
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    :root {
      --primary-green: #2ecc71;
      --dark-green: #27ae60;
      --light-green: #f0fff4;
      --text-dark: #2d3436;
      --text-light: #636e72;
      --white: #ffffff;
      --transition: all 0.3s ease;
    }
    body { font-family: 'Lato', sans-serif; color: var(--text-dark); background-color: var(--white); overflow-x: hidden; padding-top: 32px; }
    
    /* Trava o scroll quando o modal estiver aberto */
    body.no-scroll { overflow: hidden; }
    
    /* Top Warning Bar - fixa no topo, sempre visível */
    .top-bar { background-color: #19a44a; padding: 0; height: 32px; display: flex; align-items: center; justify-content: center; text-align: center; font-size: 11px; color: #ffffff; position: fixed; top: 0; left: 0; width: 100%; z-index: 1001; }

    /* Header */
    .header { background-color: var(--primary-green); padding: 10px 0; position: sticky; top: 32px; z-index: 1000; }
    .header-container { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 20px; }
    .logo img { height: 35px; }
    .nav-menu { display: flex; list-style: none; gap: 20px; }
    .nav-menu a { color: var(--white); text-decoration: none; font-size: 14px; font-weight: 600; }
    .hamburger { display: none; cursor: pointer; color: white; font-size: 24px; }

    /* Banner Slider Ajustado */
    .banner-slider-container { max-width: 684px; margin: 30px auto 20px auto; padding: 0 10px; position: relative; }
    .banner-slider { position: relative; width: 100%; max-height: 156px; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .slider-wrapper { display: flex; width: 300%; transition: transform 0.5s ease-in-out; }
    .slide { width: 33.3333%; display: block; text-decoration: none; }
    .slide img { width: 100%; height: auto; max-height: 156px; object-fit: cover; display: block; border-radius: 12px; }
    
    /* Controles do Carrossel */
    .slider-nav { position: absolute; top: 50%; width: calc(100% - 20px); left: 10px; display: flex; justify-content: space-between; transform: translateY(-50%); pointer-events: none; z-index: 10; }
    .slider-btn { background: rgba(0, 0, 0, 0.35); color: white; border: none; width: 34px; height: 34px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: var(--transition); pointer-events: auto; font-size: 12px; }
    .slider-btn:hover { background: rgba(0, 0, 0, 0.65); }
    .slider-dots { display: flex; justify-content: center; gap: 6px; margin-top: 10px; }
    .dot { width: 8px; height: 8px; border-radius: 50%; background: #ddd; cursor: pointer; transition: var(--transition); }
    .dot.active { background: var(--primary-green); width: 20px; border-radius: 4px; }

    /* ===== HERO SECTION - VERSÃO OTIMIZADA PARA HOMEM.JPG ===== */
    .section-hero { 
        max-width: 1200px; 
        margin: 0 auto; 
        display: flex; 
        align-items: center; 
        justify-content: space-between;
        padding: 0 20px; 
        text-align: left; 
        position: relative; 
        min-height: 600px;
        gap: 40px;
    }
    
    .hero-text { 
        width: 45%; 
        position: relative; 
        z-index: 2;
        flex-shrink: 0;
        animation: slideInLeft 0.8s ease-out;
    }
    
    .hero-text h1 { 
        font-size: 46px; 
        line-height: 1.1; 
        margin-bottom: 20px; 
        font-family: 'Raleway', sans-serif; 
        text-align: left; 
        text-shadow: 0 2px 15px rgba(255, 255, 255, 0.9); 
    }
    
    .hero-text h1 span { 
        color: var(--primary-green); 
    }
    
    .hero-text p { 
        font-size: 19px; 
        color: var(--text-light); 
        margin-bottom: 30px; 
        text-align: left; 
        max-width: 90%; 
        text-shadow: 0 2px 10px rgba(255, 255, 255, 0.8); 
    }
    
    .btn-discover { 
        background-color: var(--primary-green); 
        color: white; 
        padding: 15px 40px; 
        border-radius: 30px; 
        text-decoration: none; 
        font-weight: bold; 
        display: inline-block; 
        transition: all 0.3s ease; 
        cursor: pointer; 
        border: none; 
        position: relative; 
        z-index: 3;
        box-shadow: 0 4px 15px rgba(46, 204, 113, 0.3);
    }
    /* Selo de Confiança no Hero (HTML/CSS — antes era uma imagem JPG que borrava em telas Retina) */
.hero-trust-badges {
    display: flex;
    gap: 24px;
    margin-top: 26px;
    flex-wrap: wrap;
    animation: slideInUp 0.8s ease-out 0.2s both;
}
.hero-trust-badge-item {
    display: flex;
    align-items: center;
    gap: 10px;
}
.hero-trust-badge-item .icon-circle {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    min-width: 38px;
    border-radius: 50%;
    border: 2px solid var(--primary-green);
    background: rgba(46, 204, 113, 0.08);
}
.hero-trust-badge-item .icon-circle i {
    color: var(--primary-green);
    font-size: 16px;
}
.hero-trust-badge-item .label-text {
    font-size: 13.5px;
    font-weight: 700;
    color: #1a1a1a;
    line-height: 1.3;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsividade para Mobile */
@media (max-width: 768px) {
    .hero-trust-badges {
        margin-top: 20px;
        justify-content: center;
        gap: 16px;
    }
    .hero-trust-badge-item .label-text { font-size: 12px; }
    .hero-trust-badge-item .icon-circle { width: 34px; height: 34px; min-width: 34px; }
}
    .btn-discover:hover { 
        background-color: var(--dark-green);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(46, 204, 113, 0.4);
    }
    
    /* Container da imagem otimizado para homem.jpg */
    .hero-img { 
        width: 50%; 
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 1;
        animation: slideInRight 0.8s ease-out;
        overflow: hidden;
        border-radius: 12px;
    }
    
    .hero-img img { 
        width: 100%; 
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    }

    /* Animações */
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Features Grid */
    .features-grid { max-width: 1200px; margin: 40px auto 70px auto; display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; padding: 0 20px; }
    .feature-card { background: #e9f7f4; padding: 20px 18px; border-radius: 20px; text-align: left; border: 1px solid #1fc859; display: flex; flex-direction: column; justify-content: space-between; min-height: 160px; position: relative; }
    .feature-icon-wrapper { width: 55px; height: 55px; background-color: #ffffff; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(0,0,0,0.04); margin-bottom: 20px; }
    .feature-icon { max-width: 32px; max-height: 32px; object-fit: contain; }
    .feature-card h4 { font-size: 15px; font-weight: 600; color: #333333; line-height: 1.3; margin-bottom: 15px; padding-right: 10px; font-family: 'Raleway', sans-serif; }
    .btn-simulate-wrapper { display: flex; justify-content: flex-end; width: 100%; }
    .btn-simulate { background: #1fc859; color: white; padding: 4px 22px; border-radius: 12px; text-decoration: none; font-size: 12px; font-weight: bold; transition: var(--transition); }
    .btn-simulate:hover { background: var(--dark-green); }

    /* Seção de comparação */
    .section-comparison { 
      background-color: #1e5d3b; 
      background-image: url('images/bg-cel-creditovc.png'); 
      background-size: cover; 
      background-position: center center;
      background-repeat: no-repeat;
      padding: 70px 0; 
      color: #ffffff;
    }
    .comparison-container { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1.1fr 0.9fr; gap: 50px; align-items: center; padding: 0 20px; }
    .comp-text { display: flex; flex-direction: column; justify-content: center; text-align: left; }
    .comp-text h2 { font-size: 38px; font-weight: 700; line-height: 1.2; margin-bottom: 25px; font-family: 'Raleway', sans-serif; text-align: left; }
    .comp-text p { font-size: 16px; line-height: 1.5; margin-bottom: 40px; opacity: 0.9; text-align: left; }
    .comp-text .comp-disclaimer { font-size: 11px; opacity: 0.7; margin-bottom: 0; line-height: 1.4; }
    .comp-form { background: #ffffff; padding: 40px 35px; border-radius: 28px; color: #333333; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08); text-align: center; }
    .form-item { margin-bottom: 35px; }
    .form-item label { display: block; font-size: 16px; font-weight: 500; color: #333333; margin-bottom: 12px; }
    .form-item .form-value { display: block; font-size: 22px; font-weight: 700; color: #1fc859; margin-bottom: 15px; }
    /* Slider de Valor e Parcelas - Versão Melhorada */
.form-item input[type="range"] {
    width: 100%;
    -webkit-appearance: none;
    appearance: none;
    height: 6px;
    background: #e9f7f4;
    border-radius: 5px;
    outline: none;
    cursor: pointer;
}

.form-item input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 22px;
    height: 22px;
    background: var(--primary-green);
    border-radius: 50%;
    border: 3px solid #fff; /* Borda branca para destaque */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15); /* Sombra suave */
    cursor: pointer;
    transition: transform 0.2s ease;
}

.form-item input[type="range"]::-webkit-slider-thumb:hover {
    transform: scale(1.1);
    background: var(--dark-green);
}

    .btn-simulate-now { background: #1fc859; color: #ffffff; width: 100%; padding: 14px; border-radius: 25px; border: none; font-size: 15px; font-weight: 700; cursor: pointer; transition: var(--transition); }
    .btn-simulate-now:hover { background: var(--dark-green); box-shadow: 0 5px 15px rgba(31, 200, 89, 0.3); }

    /* Seção de benefícios adicionais */
    .section-features-boxes { background-color: #e9f7f4; padding: 60px 0; }
    .features-boxes-container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
    .section-features-boxes h2 { font-size: 32px; font-weight: 700; color: #2d3436; margin-bottom: 40px; font-family: 'Raleway', sans-serif; text-align: left; }
    .features-boxes-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
    .box-item { background: #ffffff; padding: 30px 25px; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); text-align: left; }
    .box-icon-img { height: 45px; width: auto; object-fit: contain; margin-bottom: 20px; }
    .box-item h4 { font-size: 17px; font-weight: 700; color: #2d3436; margin-bottom: 12px; line-height: 1.3; font-family: 'Raleway', sans-serif; }
    .box-item p { font-size: 14px; color: var(--text-light); line-height: 1.5; }

    /* Testimonials */
    .section-testimonials { padding: 60px 0; background: #fff; }
    .section-testimonials h2 { max-width: 1200px; margin: 0 auto 10px auto; padding: 0 20px; text-align: left; font-family: 'Raleway', sans-serif; font-size: 32px; font-weight: 700; }
    .section-testimonials h2 span { color: var(--primary-green); }
    .testimonials-grid { max-width: 1200px; margin: 30px auto 0 auto; display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; padding: 0 20px; }
    .test-card { background: #fff; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); text-align: center; }
    .stars { color: #f1c40f; margin-bottom: 15px; }
    .test-text { font-size: 14px; font-style: italic; color: #666; margin-bottom: 20px; }
    .test-author { font-weight: bold; color: var(--primary-green); }

    /* FAQ */
    .section-faq { padding: 60px 0; background: #e9f7f4; }
    .section-faq h2 { max-width: 800px; margin: 0 auto 30px auto; padding: 0 20px; text-align: left; font-family: 'Raleway', sans-serif; font-size: 32px; font-weight: 700; }
    .section-faq h2 span { color: var(--primary-green); }
    .faq-container { max-width: 800px; margin: 0 auto; padding: 0 20px; }
    .faq-item { background: white; margin-bottom: 10px; border-radius: 10px; overflow: hidden; border: 1px solid #eee; }
    .faq-header { padding: 20px; cursor: pointer; font-weight: bold; display: flex; justify-content: space-between; }
    .faq-content { padding: 0 20px 20px; display: none; color: #666; font-size: 14px; }

    /* Footer */
    .footer { padding: 50px 0; text-align: center; background-color: var(--white); border-top: 1px solid #eee; }
    .footer-container { max-width: 1000px; margin: 0 auto; padding: 0 20px; display: flex; flex-direction: column; align-items: center; }
    .footer-logo { height: 38px; margin-bottom: 25px; }
    .footer-policy-box { display: inline-flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 25px; font-size: 13px; color: #333333; cursor: pointer; user-select: none; }
    .footer-policy-box input[type="checkbox"] { accent-color: #1fc859; width: 16px; height: 16px; cursor: pointer; }
    .footer-policy-box a { color: #333333; text-decoration: none; font-weight: 500; }
    .footer-policy-box a:hover { text-decoration: underline; }
    .footer-text { font-size: 12px; color: #666; line-height: 1.6; }

    /* ===== REDES SOCIAIS NO FOOTER ===== */
.footer-social {
    display: flex;
    gap: 15px;
    margin-bottom: 25px;
    justify-content: center;
}

.footer-social a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background-color: var(--primary-green );
    color: #fff;
    font-size: 16px;
    text-decoration: none;
    transition: var(--transition);
    border-radius: 50%;
}

.footer-social a:hover {
    background-color: var(--dark-green);
    transform: translateY(-2px);
}

    /* Media Queries */
    @media (max-width: 1024px) {
        .section-hero { 
            min-height: 500px;
            gap: 30px;
        }
        
        .hero-text h1 { 
            font-size: 38px; 
        }
        
        .hero-text p { 
            font-size: 16px; 
        }
    }

    @media (max-width: 768px) {
      .nav-menu { display: none; }
      .hamburger { display: block; }
      
      /* Ajuste Hero Mobile - Otimizado para homem.jpg */
      .section-hero { 
        flex-direction: column; 
        text-align: center; 
        margin: 10px auto 20px auto; 
        min-height: auto;
        gap: 30px;
      }
      
      .hero-text { 
        width: 100%; 
        margin-bottom: 0;
      }
      
      .hero-text h1 { 
        font-size: 34px; 
        text-align: center; 
      }
      
      .hero-text p { 
        text-align: center; 
        max-width: 100%; 
      }
      
      /* Imagem responsiva no mobile */
      .hero-img { 
        width: 100%; 
        max-width: 100%;
        height: 400px;
        border-radius: 12px;
      }
      
      .hero-img img { 
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        border-radius: 12px;
      }

      /* Responsividade dos Títulos */
      .section-features-boxes h2, .section-testimonials h2, .section-faq h2 { text-align: center; font-size: 26px; }
      
      .features-grid, .testimonials-grid, .features-boxes-grid { grid-template-columns: 1fr; }
      .features-grid { margin-bottom: 40px; }
      .comparison-container { grid-template-columns: 1fr; gap: 35px; text-align: center; }
      .comp-text h2 { font-size: 28px; text-align: center; }
      .comp-text p { margin-bottom: 25px; text-align: center; }
      .comp-form { padding: 30px 20px; }
      .banner-slider-container { padding: 0 15px; margin: 20px auto 10px auto; }
      .slider-btn { width: 30px; height: 30px; font-size: 10px; }
      .footer-text { text-align: left; }
      .footer-policy-box { text-align: center; align-items: flex-start; }
      .footer-policy-box input[type="checkbox"] { margin-top: 2px; }
      
      .modal-box { padding: 30px 20px; }
      .modal-title { font-size: 24px; }
    }
  </style>

  <!-- Schema.org: FinancialService -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FinancialService",
    "name": "LiberaCash",
    "url": "https://libera.cash",
    "logo": "images/logo.png",
    "description": "Plataforma de comparação de empréstimo pessoal online. Conectamos você às melhores opções de crédito do mercado.",
    "telephone": "+55-11-0000-0000",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "São Paulo",
      "addressRegion": "SP",
      "addressCountry": "BR"
    },
    "areaServed": "BR",
    "serviceType": ["Empréstimo Pessoal", "Empréstimo com Garantia", "Saque Aniversário FGTS"],
    "sameAs": []
  }
  </script>

  <!-- Schema.org: FAQ -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      {
        "@type": "Question",
        "name": "Como funciona a LiberaCash?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Nós conectamos você às melhores empresas de crédito do mercado. Você preenche um rápido formulário com o seu perfil e nós encontramos as instituições financeiras com as maiores chances de aprovação e as melhores taxas para o seu caso."
        }
      },
      {
        "@type": "Question",
        "name": "Eu tenho que pagar alguma taxa pelo serviço?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Não, o nosso serviço é 100% gratuito para quem busca crédito. Nós não cobramos nenhuma taxa antecipada ou comissão dos usuários."
        }
      },
      {
        "@type": "Question",
        "name": "O que acontece depois que eu preencho o formulário?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "O nosso sistema analisa o seu perfil e o envia com total segurança para as empresas de crédito parceiras que mais combinam com a sua necessidade."
        }
      },
      {
        "@type": "Question",
        "name": "Estar negativado impede que eu faça a simulação?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Não! Trabalhamos com diversos parceiros de crédito que possuem produtos específicos, inclusive opções para negativados, autônomos ou quem está sem margem."
        }
      },
      {
        "@type": "Question",
        "name": "Meus dados pessoais estão seguros com vocês?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Totalmente seguros! Seus dados são confidenciais e protegidos seguindo rigorosamente as diretrizes da LGPD."
        }
      }
    ]
  }
  </script>
  <link href="css/brand-tokens.css?<?= uniqid() ?>" rel="stylesheet" type="text/css">
</head>
<body>

  <div class="top-bar">
    Atenção! A Libera Cash não cobra nenhum depósito antecipado para a liberação de empréstimo.
  </div>

  <header class="header">
    <div class="header-container">
      <div class="logo"><img src="images/logo.png" alt="LiberaCash"></div>
      <nav class="nav-menu">
            <li><a href="/">Crédito Pessoal</a></li>
            <li><a href="/cartoes/">Cartão de Crédito</a></li>
            <li><a href="/blog/">Blog</a></li>
            <li><a href="/sobre/">Sobre</a></li>
            <li><a href="/contato/">Contato</a></li>
      </nav>
      <div class="hamburger"><i class="fas fa-bars"></i></div>
    </div>
  </header>

  <div class="banner-slider-container">
    <div class="banner-slider">
      <div class="slider-wrapper">
        <a href="#linkbanner#" class="slide">
          <img src="images/banner-juvo-creditovc.png" alt="Empréstimo pessoal Juvo">
        </a>
        <a href="https://www.itau.com.br/cartoes/escolha/g/azul-visa-infinite?utm_source=lzo&utm_medium=affiliate&utm_campaign=gl-aff-cartoes-conversao-azul-infinite&cpg_s=sliceafl&utmgl=utm_camp-{campaign.id}" class="slide">
          <img src="images/banner-itaul-infinity.png" alt="Empréstimo pessoal Juvo - Slide 2">
        </a>
        <a href="#linkbanner#" class="slide">
          <img src="images/banner-juvo-creditovc.png" alt="Empréstimo pessoal Juvo - Slide 3">
        </a>
      </div>
    </div>
    <div class="slider-nav">
      <button class="slider-btn prev-btn"><i class="fas fa-chevron-left"></i></button>
      <button class="slider-btn next-btn"><i class="fas fa-chevron-right"></i></button>
    </div>
    <div class="slider-dots">
      <div class="dot active" data-index="0"></div>
      <div class="dot" data-index="1"></div>
      <div class="dot" data-index="2"></div>
    </div>
  </div>

  <!-- HERO SECTION CORRIGIDA - OTIMIZADA PARA HOMEM.JPG -->
  <section class="section-hero">
  <div class="hero-text">
    <h1>Simule seu <span>empréstimo</span> e descubra a condição ideal para você!</h1>
    <p>100% online, sem burocracia e sem compromisso.<br>Simulação gratuita em 2 minutos.</p>
    <button class="btn-discover btn-open-modal" data-title="Qual o melhor  
<span>crédito para você?</span>" data-subtitle="Descubra quanto você tem disponível para receber e tenha o dinheiro na sua conta!" data-icon="">Simule Grátis</button>
    
    <!-- Selo de Confiança (HTML/CSS real, ícones em círculo com contorno) -->
    <div class="hero-trust-badges">
      <div class="hero-trust-badge-item">
        <span class="icon-circle"><i class="fas fa-shield-alt"></i></span>
        <span class="label-text">Seguro e<br>confiável</span>
      </div>
      <div class="hero-trust-badge-item">
        <span class="icon-circle"><i class="fas fa-lock"></i></span>
        <span class="label-text">Seus dados<br>protegidos</span>
      </div>
      <div class="hero-trust-badge-item">
        <span class="icon-circle"><i class="fas fa-check-circle"></i></span>
        <span class="label-text">As melhores<br>condições do mercado</span>
      </div>
    </div>
  </div>
  <div class="hero-img">
    <img src="images/homem.jpg" alt="Homem sorrindo com smartphone - Simule seu empréstimo">
  </div>
</section>

  <section class="features-grid">
    <?php foreach ($produtos_ativos as $prod): ?>
    <div class="feature-card">
      <div class="feature-icon-wrapper">
        <i class="ph <?php echo $prod['icone']; ?>" style="font-size:28px;color:var(--primary-green)"></i>
      </div>
      <h4><?php echo htmlspecialchars($prod['nome']); ?></h4>
      <div class="btn-simulate-wrapper">
        <button class="btn-simulate btn-open-modal" style="border:none; cursor:pointer;" 
                data-title="<?php echo htmlspecialchars($prod['nome']); ?>" 
                data-subtitle="<?php echo htmlspecialchars($prod['descricao']); ?>" 
                data-produto="<?php echo $prod['slug']; ?>">Simular</button>
      </div>
    </div>
    <?php endforeach; ?>
  </section>

  <section class="section-comparison" id="form">
    <div class="comparison-container">
      <div class="comp-text">
        <h2>Compare, escolha <br>e contrate seu <br>empréstimo</h2>
        <p>A plataforma que aumenta suas chances reais de aprovação e conecta você às melhores opções de empréstimos.</p>
        <p class="comp-disclaimer">Parcela calculada com juros de 3,99% a.m. e pode variar conforme cada instituição financeira.</p>
      </div>
      <div class="comp-form">
  <div class="form-item">
    <label>Quanto você deseja?</label>
    <span class="form-value" id="valor-exibido">R$ 2.000,00</span>
    <input type="range" min="500" max="50000" step="100" value="2000" id="input-valor">
  </div>
  <div class="form-item">
    <label>Em quantas parcelas?</label>
    <span class="form-value" id="parcelas-exibidas">24x R$ 131,04</span>
    <input type="range" min="6" max="48" step="6" value="24" id="input-parcelas">
  </div>
  <!-- Note que removemos o 'btn-open-modal' para processar a lógica primeiro -->
  <button class="btn-simulate-now" id="btn-processar-simulacao">Ver Minhas Opções</button>
</div>
    </div>
  </section>

  <section class="section-features-boxes">
    <div class="features-boxes-container">
      <h2>Empréstimo com parcelas que cabem no seu bolso</h2>
      <div class="features-boxes-grid">
        <div class="box-item">
          <img src="images/smile-creditovc.png" class="box-icon-img" alt="Autônomo">
          <h4>Sem complicações ou burocracia!</h4>
          <p>Facilitamos o seu acesso ao crédito.<br>Você preenche o formulário em menos de 2 minutos e nós fazemos o trabalho duro por você.</p>
        </div>
        <div class="box-item">
          <img src="images/smartphone-creditovc.png" class="box-icon-img" alt="Celular">
          <h4>As melhores opções em um só lugar!</h4>
          <p>Conectamos seu perfil a diversas instituições financeiras parceiras para encontrar as taxas mais justas e personalizadas para você.</p>
        </div>
        <div class="box-item">
          <img src="images/money-bag-creditovc.png" class="box-icon-img" alt="Parcelas">
          <h4>Pode ser autônomo e negativado!</h4>
          <p>A LiberaCash entende a sua realidade.<br>Temos parceiros com soluções de crédito sob medida, mesmo se você estiver com o nome sujo.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section-testimonials">
    <h2>Quem conhece, <span>confia</span></h2>
    <div class="testimonials-grid">
      <div class="test-card">
        <div class="stars">★★★★★</div>
        <p class="test-text">"Super indico. Achei que fosse ter muita burocracia, e no fim foi tudo muito rápido."</p>
        <p class="test-author">Marino B.</p>
      </div>
      <div class="test-card">
        <div class="stars">★★★★★</div>
        <p class="test-text">"A experiência foi ótima! Começou com pouco mas foi um bom começo. Prático e seguro."</p>
        <p class="test-author">Lucas C.</p>
      </div>
      <div class="test-card">
        <div class="stars">★★★★★</div>
        <p class="test-text">"Atendimento correto, fui muito bem atendida. O dinheiro caiu na conta na hora."</p>
        <p class="test-author">Maria Luiza S.</p>
      </div>
    </div>
  </section>

  <section class="section-faq">
    <h2>Perguntas <span>Frequentes</span></h2>
    <div class="faq-container">
      <div class="faq-item">
        <div class="faq-header">1 - Como funciona a Libera Cash? <i class="fas fa-chevron-down"></i></div>
        <div class="faq-content">Nós conectamos você às melhores empresas de crédito do mercado.<br>Você preenche um rápido formulário com o seu perfil e nós encontramos as instituições financeiras com as maiores chances de aprovação e as melhores taxas para o seu caso</div>
      </div>
      <div class="faq-item">
        <div class="faq-header">2 - Eu tenho que pagar alguma taxa pelo serviço? <i class="fas fa-chevron-down"></i></div>
        <div class="faq-content">Não, o nosso serviço é 100% gratuito para quem busca crédito.<br>Nós não cobramos nenhuma taxa antecipada ou comissão dos usuários.</div>
      </div>
      <div class="faq-item">
        <div class="faq-header">3 - O que acontece depois que eu preencho o formulário? <i class="fas fa-chevron-down"></i></div>
        <div class="faq-content">O nosso sistema analisa o seu perfil e o envia com total segurança para as empresas de crédito parceiras que mais combinam com a sua necessidade.</div>
      </div>
      <div class="faq-item">
        <div class="faq-header">4 - Estar negativado impede que eu faça a simulação? <i class="fas fa-chevron-down"></i></div>
        <div class="faq-content"> Não! Trabalhamos com diversos parceiros de crédito que possuem produtos específicos, inclusive opções para negativados, autônomos ou quem está sem margem.<br>Vale a pena preencher o formulário para checar suas opções.</div>
      </div>
      <div class="faq-item">
        <div class="faq-header">5 - Meus dados pessoais estão seguros com vocês? <i class="fas fa-chevron-down"></i></div>
        <div class="faq-content">Totalmente seguros!<br>Seus dados são confidenciais e protegidos seguindo rigorosamente as diretrizes da LGPD (Lei Geral de Proteção de Dados). Nós utilizamos criptografia de ponta e só compartilhamos suas informações com instituições financeiras parceiras sérias e autorizadas pelo Banco Central.</div>
      </div>
    </div>
  </section>

  <footer class="footer">
    <div class="footer-container">
      <img src="images/logo-footer.png" class="footer-logo" alt="LiberaCash">

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
Prazo de Pagamento: varia de acordo com a Instituição Financeira escolhida, podendo ser entre 6 e 120 meses. A variação da taxa de juros, de acordo com a Instituição Financeira escolhida, pode ser de 14,9% a.m. (423,96% a.a.) até 18,5% a.m. (668,75% a.a.), e o custo efetivo total (CET) pode variar de 15,57% a.m. (467,86% a.a.) até 27,29% a.m. (1709,88% a.a.). Exemplo: um empréstimo de R$ 750,00 em 6 meses com taxa de juros de 14,9% a.m. (423,96% a.a.) terá parcelas de R$ 198,39 (caso o CET seja igual à taxa de juros). Um modelo de aparelho celular compatível poderá ser necessário para a aprovação do crédito. A Libera Cash não é uma instituição financeira. O portal presta um serviço 100% gratuito e foi criado com o objetivo de ajudar usuários a encontrarem as melhores condições de crédito pessoal e empresarial, personalizadas de acordo com seu perfil. Temos parcerias com as principais Fintechs de Crédito e Bancos do Brasil. Preencha o nosso formulário para solicitar o seu empréstimo pessoal e receber o contato de um de nossos parceiros.      </div>
    </div>
  </footer>

  <?php include 'modal-credito.php'; ?>

  <!-- jQuery e Mask - apenas se necessário, com defer -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" defer></script>
  
  <script defer>
    document.addEventListener('DOMContentLoaded', function(){

      // ==========================================
      // LÓGICAS ORIGINAIS DO SITE (Vanilla JS)
      // ==========================================
      
      // FAQ
      document.querySelectorAll('.faq-header').forEach(function(header) {
        header.addEventListener('click', function(){
          const content = this.nextElementSibling;
          const icon = this.querySelector('i');
          if (content.style.display === 'none' || content.style.display === '') {
            content.style.display = 'block';
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
          } else {
            content.style.display = 'none';
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
          }
        });
      });
      
      // Menu Hamburger Mobile
      document.querySelector('.hamburger').addEventListener('click', function(){
        const menu = document.querySelector('.nav-menu');
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
      });

      // LÓGICA DO CARROSSEL
      let currentIndex = 0;
      const slides = document.querySelectorAll('.slide');
      const slideCount = slides.length;
      let slideInterval;

      function updateSlider() {
        const percentage = -(currentIndex * 33.3333);
        document.querySelector('.slider-wrapper').style.transform = `translateX(${percentage}%)`;
        
        document.querySelectorAll('.dot').forEach(dot => dot.classList.remove('active'));
        document.querySelector(`.dot[data-index="${currentIndex}"]`).classList.add('active');
      }

      function nextSlide() {
        currentIndex = (currentIndex + 1) % slideCount;
        updateSlider();
      }

      function prevSlide() {
        currentIndex = (currentIndex - 1 + slideCount) % slideCount;
        updateSlider();
      }

      function startAutoSlide() {
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, 4000);
      }

      document.querySelector('.next-btn').addEventListener('click', function() {
        nextSlide();
        startAutoSlide();
      });

      document.querySelector('.prev-btn').addEventListener('click', function() {
        prevSlide();
        startAutoSlide();
      });

      document.querySelectorAll('.dot').forEach(function(dot) {
        dot.addEventListener('click', function() {
          currentIndex = parseInt(this.getAttribute('data-index'));
          updateSlider();
          startAutoSlide();
        });
      });

      startAutoSlide();
    });

   document.addEventListener('DOMContentLoaded', function() {
    const inputValor = document.getElementById('input-valor');
    const inputParcelas = document.getElementById('input-parcelas');
    const valorExibido = document.getElementById('valor-exibido');
    const parcelasExibidas = document.getElementById('parcelas-exibidas');
    const btnProcessar = document.getElementById('btn-processar-simulacao');

    // Função para formatar moeda
    const formatMoeda = (valor) => {
        return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(valor);
    };

    // Atualiza valores em tempo real
    function atualizarSimulacao() {
        const valor = parseFloat(inputValor.value);
        const parcelas = parseInt(inputParcelas.value);
        const taxa = 0.0399; // 3.99% a.m.

        // Cálculo de parcela (Price)
        const parcela = (valor * taxa) / (1 - Math.pow(1 + taxa, -parcelas));

        valorExibido.textContent = formatMoeda(valor);
        parcelasExibidas.textContent = `${parcelas}x ${formatMoeda(parcela)}`;
    }

    inputValor.addEventListener('input', atualizarSimulacao);
    inputParcelas.addEventListener('input', atualizarSimulacao);

    // Ao clicar, abre o modal com a pergunta integrada (definida no modal-credito.php)
    btnProcessar.addEventListener('click', function() {
        const valor = parseFloat(inputValor.value);
        window.abrirModalViaCalculadora(valor);
    });
});
  </script>
</body>
</html>
