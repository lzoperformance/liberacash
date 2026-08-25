<?php
// Caso precise do ID de produto do outro arquivo, descomente as linhas abaixo:
// $product_id = 796;
// $new_product_id = 413;
?>

<!DOCTYPE html>
<html lang="pt-BR" data-wf-page="5ffe2095ae8e1eda5c07a7d4" data-wf-site="5ffe2095ae8e1ebf8707a7d3">
<head>  
  <meta charset="utf-8">
  <title>LiberaCash - Escolha seu Cartão</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  <meta property="og:title" content="LiberaCash - O Financeiro">
  <meta property="og:description" content="Escolha seu novo cartão! Conheça os benefícios de cada um e mude!">
  <meta property="og:image" content="https://www.financeiro.vc/images/webclip-financeiro.png">
  <meta property="og:url" content="https://libera.cash/">
  <meta content="summary" name="twitter:card">
  
  <link href="/images/favicon.png" rel="shortcut icon" type="image/x-icon">
  <link href="/images/webclip.png" rel="apple-touch-icon">
  
  <link href="/css/normalize.css" rel="stylesheet" type="text/css">
  <link href="/css/webflow.css" rel="stylesheet" type="text/css">
  <link href="/css/credito-vc-jul-23.webflow.css?<?= uniqid() ?>" rel="stylesheet" type="text/css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" type="text/css">
  
  <script data-ad-client="ca-pub-3848244970216851" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">
    WebFont.load({
      google: {
        families: [
          "Montserrat:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic",
          "Droid Sans:400,700", 
          "PT Sans:400,400italic,700,700italic", 
          "Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic", 
          "Raleway:100,200,300,regular,500,600,700,800,900,100italic,200italic,300italic,italic,500italic",
          "Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic"
        ]
      }
    });
  </script>
  <script type="text/javascript">
    !function (o, c) {
      var n = c.documentElement, t = " w-mod-";
      n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
    }(window, document);
  </script>

  <style>
    /* ==========================================================================
       ESTILOS GERAIS DA HOME (LIBERACASH)
       ========================================================================== */
    :root {
      --primary-green: #2ecc71;
      --dark-green: #27ae60;
      --light-green: #f0fff4;
      --text-dark: #2d3436;
      --text-light: #636e72;
      --white: #ffffff;
      --transition: all 0.3s ease;
    }
    
    body { font-family: 'Lato', sans-serif; color: var(--text-dark); background-color: var(--white); overflow-x: hidden; margin: 0; padding: 0; box-sizing: border-box; padding-top: 32px; }
    .top-bar { background-color: #19a44a; padding: 0; height: 32px; display: flex; align-items: center; justify-content: center; text-align: center; font-size: 11px; color: #ffffff; width: 100%; position: fixed; top: 0; left: 0; z-index: 1001; }

    /* Menu do Topo */
    .header { background-color: var(--primary-green); padding: 10px 0; position: sticky; top: 32px; z-index: 1000; width: 100%; }
    .header-container { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 20px; }
    .logo img { height: 35px; }
    .nav-menu { display: flex; list-style: none; gap: 20px; margin: 0; padding: 0; }
    .nav-menu a { color: var(--white); text-decoration: none; font-size: 14px; font-weight: 600; }
    .hamburger { display: none; cursor: pointer; color: white; font-size: 24px; }

    /* Footer da Home */
    .footer { padding: 50px 0; text-align: center; background-color: var(--white); border-top: 1px solid #eee; width: 100%; }
    .footer-container { max-width: 1000px; margin: 0 auto; padding: 0 20px; display: flex; flex-direction: column; align-items: center; }
    .footer-logo { height: 38px; margin-bottom: 25px; }
    .footer-policy-box { display: inline-flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 25px; font-size: 13px; color: #333333; cursor: pointer; user-select: none; }
    .footer-policy-box input[type="checkbox"] { accent-color: #1fc859; width: 16px; height: 16px; cursor: pointer; }
    .footer-policy-box a { color: #333333; text-decoration: none; font-weight: 500; }
    .footer-policy-box a:hover { text-decoration: underline; }
    .footer-text { font-size: 12px; color: #666666; line-height: 1.7; text-align: justify; }
    .footer-social { display: flex; gap: 15px; margin-bottom: 25px; }
    .footer-social a { display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; background: var(--primary-green); color: #fff; font-size: 16px; text-decoration: none; transition: var(--transition); }
    .footer-social a:hover { background: var(--dark-green); transform: translateY(-2px); }
    .footer-copyright { margin-top: 25px; padding-top: 20px; border-top: 1px solid #eee; font-size: 12px; color: #999; width: 100%; text-align: center; }

    /* ==========================================================================
       CSS IMPORTADO E INTEGRADO DE CARTÕES (COMPLETAMENTE ISOLADO)
       ========================================================================== */
    span.error { font-size: 10px; color: red; }
    span.error:before { content: '  '; }
    
    .c-all { max-width: 1000px; margin-right: auto; margin-left: auto; }
    .c-all-02 { max-width: 1010px; margin-right: auto; margin-left: auto; }
    .c-lado1 { width: auto; padding-left: 0px; background-color: transparent; }
    .c-box-logo { margin-bottom: 4px; padding-top: 41px; padding-bottom: 0px; }
    .c-row-centered { display: flex; flex-wrap: wrap; justify-content: center; }
    
    .c-titulo1 { margin-top: 52px; margin-bottom: 3px; margin-left: 0px; padding-right: 0px; font-family: Montserrat, sans-serif; color: #fff; font-size: 46px; line-height: 49px; font-weight: 800; }
    .c-text-span { color: #fff; font-size: 51px; font-weight: 800; }
    .c-heading-3 { margin-top: 4px; font-family: 'PT Sans', sans-serif; color: #fff; font-size: 24px; font-weight: 300; }
    .c-arrow { display: inline-block; margin-top: 0px; margin-left: 13px; }
    .c-image-4 { width: 41px; -webkit-transform: rotate(86deg); -ms-transform: rotate(86deg); transform: rotate(86deg); }

    /* Hero de Cartões com Novo Fundo Verde #19a44a */
    .cartoes-hero {
      background-color: #19a44a;
      /* Alterado de 0.85 para 0.60 para a imagem ficar mais nítida, e alterado para .png */
      background-image: linear-gradient(rgba(25, 164, 74, 0.60), rgba(25, 164, 74, 0.60)), url('/images/bg-credito-top.png'); 
      background-size: cover;
      /* Alterado de left center para center center para centralizar o homem */
      background-position: center center; 
      padding: 60px 0;
      min-height: 600px;
      display: flex;
      align-items: center;
      position: relative;
    }
    .cartoes-hero .c-all { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; width: 100%; max-width: 1100px; margin: 0 auto; padding: 0 20px; position: relative; z-index: 2; }

    .box-form-hero { flex: 0 0 420px; background: rgba(255, 255, 255, 0.25); border-radius: 25px; padding: 35px; box-shadow: none; color: #fff; margin-left: 20px; }
    .form-hero-title { font-family: 'Montserrat', sans-serif; font-size: 24px; font-weight: 700; color: #fff; text-align: center; margin-bottom: 25px; line-height: 1.2; }
    .input-hero { width: 100%; height: 45px; background: #fff; border: none; border-radius: 30px; margin-bottom: 12px; padding: 0 25px; font-family: 'Montserrat', sans-serif; font-size: 15px; color: #333; box-sizing: border-box; }
    .checkbox-container { display: flex; align-items: center; font-family: 'Montserrat', sans-serif; font-size: 13px; margin: 15px 0 25px 0; cursor: pointer; }
    .checkbox-container input { margin-right: 10px; width: 18px; height: 18px; }
    
    /* Novo Botão do Form Verde #1fc859 */
    .btn-descobrir { width: 100%; height: 50px; background-color: #1fc859; color: #fff; border: none; border-radius: 30px; font-family: 'Montserrat', sans-serif; font-size: 17px; font-weight: 700; cursor: pointer; transition: 0.3s; }
    .btn-descobrir:hover { background-color: #27ae60; }

    /* Resultado Form Verde #1fc859 */
    #step-resultado { display: none; text-align: center; }
    .resultado-title { font-family: 'Montserrat', sans-serif; font-size: 20px; font-weight: 700; color: #fff; margin-bottom: 20px; line-height: 1.3; }
    .container-cartao-flex { display: flex; justify-content: center; align-items: center; margin-bottom: 25px; }
    .img-cartao-result { max-width: 220px; width: 100%; height: auto; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2)); }
    .btn-peca-agora { display: block; width: 100%; padding: 15px 0; background-color: #1fc859; color: #fff; text-decoration: none; border-radius: 30px; font-family: 'Montserrat', sans-serif; font-size: 18px; font-weight: 700; transition: 0.3s; text-align: center; }
    .btn-peca-agora:hover { background-color: #27ae60; }

    /* Box de Informações de Benefícios */
    .c-box-infos-principais { padding-top: 31px; padding-bottom: 0px; }
    .c-paragraph { margin-bottom: 25px; font-size: 18px; line-height: 26px; font-weight: 600; text-align: center; }
    .c-info-principal-box { width: 100%; height: 187px; margin-right: auto; margin-left: auto; padding: 26px 52px; border-radius: 0px; }
    .c-info-principal-box.tra-o { height: auto; border-style: none solid none none; border-width: 1px; border-color: #000 rgba(0, 0, 0, 0.26) rgba(0, 0, 0, 0.42) #000; }
    .c-paragraph-2 { font-weight: 700; }
    .c-list { list-style-type: decimal; }
    .c-list-item { margin-bottom: 11px; font-size: 13px; }

    /* Cards Individuais de Cartão */
    .c-cartao { position: relative; height: 748px; margin-top: 25px; margin-right: 11px; margin-bottom: 50px; padding: 28px 21px 27px; float: left; clear: none; border-top: 5px solid #000; border-radius: 5px; box-shadow: 0 0 9px 0 rgba(0, 0, 0, 0.15); box-sizing: border-box; }
    .c-cartao.carrefour { border-top-color: #08f; }
    .c-cartao.atacadao { border-top-color: #ff7b00; }
    .c-paragraph-3 { color: #767676; font-size: 11px; font-weight: 600; }
    .c-list-2 { padding-left: 10px; }
    .c-list-item-2 { margin-bottom: 10px; color: #5d00aa; font-size: 12px; line-height: 17px; }
    .c-bt { position: absolute; left: 9%; top: auto; right: 9%; bottom: 3%; margin-top: 9px; }
    
    .c-button { width: 100%; padding-top: 14px; padding-bottom: 14px; border-radius: 5px; -webkit-transition: background-color 200ms ease; transition: background-color 200ms ease; font-weight: 700; text-align: center; cursor: pointer; border: none; text-decoration: none; }
    .c-button:hover { background-color: #27ae60 !important; color: #fff; }
    .c-box-cartao-center { text-align: center; }
    .c-botao-mobile { display: none; padding-right: 75px; padding-left: 75px; }

    /* ==========================================================================
       MEDIA QUERIES RESPONSIVAS INTEGRADAS (SEM DUPLICIDADE)
       ========================================================================== */
    @media screen and (max-width: 991px) {
      .nav-menu { display: none; flex-direction: column; width: 100%; background-color: var(--primary-green); padding: 10px 0; gap: 10px; text-align: center; }
      .hamburger { display: block; }
      
      .cartoes-hero { padding: 40px 0 !important; min-height: auto !important; height: auto !important; display: flex !important; flex-direction: column !important; background-position: top center !important; }
      .cartoes-hero .c-all { flex-direction: column !important; text-align: center; height: auto !important; }
      .c-lado1 { margin-bottom: 30px; width: 100%; min-width: unset; }
      .box-form-hero { flex: 1 1 auto !important; width: 100%; margin-left: 0; margin-bottom: 30px; box-sizing: border-box; position: relative !important; }
      .c-titulo1 { font-size: 36px; line-height: 1.1; }
      
      .c-all { padding-right: 12px; padding-left: 12px; }
      .c-box-infos-principais { padding-right: 40px; padding-left: 40px; }
      .c-info-principal-box { padding: 10px; }
      .c-list { padding-left: 10px; }
      .c-all-02 { padding-right: 12px; padding-left: 12px; }
      .c-cartao { width: 31%; margin-bottom: 10px; }
      .list-3 { padding-left: 10px; }
    }

    @media screen and (max-width: 767px) {
      .footer-text { text-align: left; }
      .footer-policy-box { text-align: center; align-items: flex-start; }
      .footer-policy-box input[type="checkbox"] { margin-top: 2px; }

      .c-lado1 { padding-left: 20px; }
      .c-box-logo { margin-bottom: -1px; padding-top: 20px; text-align: center; }
      .c-titulo1 { margin-top: 24px; padding-right: 126px; font-size: 33px; line-height: 39px; text-align: left; }
      .c-paragraph { margin-bottom: 18px; }
      .c-info-principal-box { height: auto; }
      .c-info-principal-box.tra-o { border-right-style: none; }
      .c-list-item { margin-bottom: 5px; }
      .c-all-02 { padding: 0px; }
      
      .c-cartao { position: relative; width: 83%; height: auto; margin-right: auto; margin-left: auto; float: none; }
      .c-bt { position: static; margin-top: 37px; }
      .c-botao-mobile { display: block; margin-top: 40px; text-align: center; }
      
      .button-3 { padding: 16px 63px; border-radius: 5px; background-color: #5d00aa; box-shadow: 0 0 14px 0 rgba(0, 0, 0, 0.36); -webkit-transition: background-color 425ms ease; transition: background-color 425ms ease; font-size: 16px; font-weight: 700; cursor: pointer; color: #fff; text-decoration: none; display: inline-block; }
      .button-3:hover { background-color: #ff8c00; }
    }

    @media screen and (max-width: 479px) {
      .box-form-hero { padding: 25px 20px; }
      .c-all { padding-right: 5px; padding-left: 5px; }
      .c-lado1 { padding-right: 0px; padding-left: 0px; }
      .c-box-logo { padding: 11px 0px 11px 9px; background-color: transparent; text-align: left; }
      .c-titulo1 { margin-top: 0px; margin-right: 8px; margin-left: 8px; padding: 25px 130px 0px 0px; border-radius: 6px; background-color: transparent; font-size: 40px; line-height: 37px; text-align: left; }
      .c-text-span { font-size: 41px; }
      .c-heading-3 { margin-top: 16px; margin-left: 11px; padding-right: 50px; font-size: 21px; line-height: 26px; }
      .image-3 { width: 49%; }
      .c-arrow { display: inline-block; margin-top: 0px; margin-left: 13px; }
      .c-image-4 { width: 34px; -webkit-transform: rotate(89deg); -ms-transform: rotate(89deg); transform: rotate(89deg); }
      .c-box-infos-principais { padding-right: 7px; padding-left: 7px; }
      .c-paragraph { line-height: 20px; }
      .c-info-principal-box.tra-o { padding-top: 0px; padding-bottom: 0px; }
      .c-list-item { margin-bottom: 2px; }
      .c-all-02 { padding-right: 5px; padding-left: 5px; }
      .c-cartao { margin-top: 5px; }
      .c-botao-mobile { margin-top: 42px; padding-right: 15px; padding-left: 15px; }
    }
  </style>
  <link href="css/brand-tokens.css?<?= uniqid() ?>" rel="stylesheet">
</head>

<body class="body">

  <div class="top-bar">
    Atenção! A LiberaCash não cobra nenhum depósito antecipado para a liberação de empréstimo.
  </div>

  <header class="header">
    <div class="header-container">
        <div class="logo">
            <a href="/"><img src="images/logo.png" alt="LiberaCash"></a>
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

  <div class="cartoes-hero">
    <div class="c-all">
      <div class="c-lado1">
        <div class="c-box-logo"><img src="/images/financeirologo.png" loading="lazy" alt="" class="image-3"></div>
        <h1 class="c-titulo1">Escolha<br>seu <span class="c-text-span">novo cartão!</span></h1>
        <h2 class="c-heading-3">Conheça os benefícios de cada um e mude!</h2>
        <div class="c-arrow"><img src="/images/seta333.png" loading="lazy" alt="" class="image-4"></div>
      </div>

      <div class="box-form-hero">
        <div id="step-formulario">
          <h3 class="form-hero-title">Quer ajuda para escolher o cartão ideal para você?</h3>
          <form id="form-recomendacao">
            <input type="text" name="nome" class="input-hero" placeholder="Nome completo" required>
            <input type="email" name="email" class="input-hero" placeholder="E-mail" required>
            <input type="text" id="renda-input" name="renda" class="input-hero" placeholder="Renda mensal aproximada" required>
            <input type="text" name="cpf" class="input-hero" placeholder="Cpf" id="cpf-mask" required>
            
            <label class="checkbox-container">
              <input type="checkbox" required checked>
              <span>Li e aceito a Política de Privacidade.</span>
            </label>

            <button type="submit" class="btn-descobrir">Descobrir melhor cartão</button>
          </form>
        </div>

        <div id="step-resultado">
          <h3 class="resultado-title">O cartão ideal para seu perfil é:</h3>
          <div class="container-cartao-flex" id="container-cartao-alvo"></div>
          <a href="#" id="link-peca-agora" class="btn-peca-agora">Peça agora</a>
        </div>
      </div>
    </div>
  </div>

  <div class="c-info">
    <div class="c-all-02">
      <div class="c-box-infos-principais">
        <p class="c-paragraph">Selecionamos as melhores ofertas de cartões de crédito para você sair economizando.<br></p>
        <div class="w-row">
          <div class="w-col w-col-6">
            <div class="c-info-principal-box tra-o">
              <p class="c-paragraph-2">Peça agora seu cartão de crédito. Mude!</p>
              <ul role="list" class="c-list">
                <li class="c-list-item">Conheça os benefícios de cada cartão e compare</li>
                <li class="c-list-item">Selecione a oferta desejada e contrate agora mesmo</li>
                <li class="c-list-item">Receba seu cartão sem sair de casa!</li>
              </ul>
            </div>
          </div>
          <div class="w-col w-col-6">
            <div class="c-info-principal-box">
              <p class="c-paragraph-2">Conheça os principais benefícios que você irá aproveitar:</p>
              <ul role="list" class="list-3">
                <li class="c-list-item">Isenção da cobrança de Anuidade</li>
                <li class="c-list-item">Condições exclusivas em Parcelamentos</li>
                <li class="c-list-item">Descontos exclusivos nos estabelecimentos do emissor</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="c-cartoes-container">
    <div class="c-all">
      <div id="box-cart-es" class="c-box-cartoes w-clearfix">
        <div class="w-row">
          <div class="w-col w-col-4">
            <div class="c-cartao" style="height: auto; padding-bottom: 80px; position: relative; margin-bottom: 20px;">
              <div class="c-box-cartao-center" style="text-align: center; margin-bottom: 15px;">
                <img src="/images/azul-infinite.png" loading="lazy" alt="Azul Infinite" style="max-height: 130px; width: auto; display: inline-block;">
              </div>
              <p class="c-paragraph-3">AZUL VISA INFINITE</p>
              <ul role="list" class="c-list-2">
                <li class="c-list-item-2">Até 3,5 pontos por dólar gasto no programa da Azul</li>
                <li class="c-list-item-2">40 mil pontos bônus ao cumprir faturas iniciais</li>
                <li class="c-list-item-2">Mensalidade grátis conforme valor gasto</li>
                <li class="c-list-item-2">Acesso a salas VIP e benefícios exclusivos</li>
                <li class="c-list-item-2">Descontos em passagens e serviços Azul</li>
              </ul>
              <div class="c-bt" style="position: absolute; bottom: 20px; left: 20px; width: calc(100% - 40px); text-align: center;">
                <a href="https://lzo.upone.link/r/7VRQo62qbQ?pid=" target="_blank" class="c-button w-button bt-redirect" data-cartao="azul-infinite" style="display: block; background-color: #1fc859; color:#fff;">PEÇA JÁ</a>
              </div>
            </div>
          </div>

          <div class="w-col w-col-4">
            <div class="c-cartao" style="height: auto; padding-bottom: 80px; position: relative; margin-bottom: 20px;">
              <div class="c-box-cartao-center" style="text-align: center; margin-bottom: 15px;">
                <img src="/images/azulplatinum.png" loading="lazy" alt="Azul Platinum" style="max-height: 130px; width: auto; display: inline-block;">
              </div>
              <p class="c-paragraph-3">AZUL VISA PLATINUM</p>
              <ul role="list" class="c-list-2">
                <li class="c-list-item-2">Até 2,6 pontos por dólar gasto no programa Azul</li>
                <li class="c-list-item-2">16 mil pontos bônus atingindo gasto exigido</li>
                <li class="c-list-item-2">Mensalidade grátis gastando R$ 4 mil por fatura</li>
                <li class="c-list-item-2">Bagagens grátis em voos da Azul</li>
                <li class="c-list-item-2">Descontos na Azul e passagens em até 12x</li>
              </ul>
              <div class="c-bt" style="position: absolute; bottom: 20px; left: 20px; width: calc(100% - 40px); text-align: center;">
                <a href="https://lzo.upone.link/r/xoeoQWP64m?pid=" target="_blank" class="c-button w-button bt-redirect" data-cartao="azul-platinum" style="display: block; background-color: #1fc859; color:#fff;">PEÇA JÁ</a>
              </div>
            </div>
          </div>

          <div class="w-col w-col-4">
            <div class="c-cartao" style="height: auto; padding-bottom: 80px; position: relative; margin-bottom: 20px;">
              <div class="c-box-cartao-center" style="text-align: center; margin-bottom: 15px;">
                <img src="/images/latampassblack.png" loading="lazy" alt="Latam Pass Black" style="max-height: 130px; width: auto; display: inline-block;">
              </div>
              <p class="c-paragraph-3">LATAM PASS BLACK</p>
              <ul role="list" class="c-list-2">
                <li class="c-list-item-2">Até 3,5 milhas por dólar gasto no cartão</li>
                <li class="c-list-item-2">40 mil milhas bônus cumprindo gasto inicial</li>
                <li class="c-list-item-2">Acesso a salas VIP LATAM e Mastercard Black</li>
                <li class="c-list-item-2">Check-in e embarque preferencial LATAM</li>
                <li class="c-list-item-2">Upgrade de cabine em trechos selecionados</li>
              </ul>
              <div class="c-bt" style="position: absolute; bottom: 20px; left: 20px; width: calc(100% - 40px); text-align: center;">
                <a href="https://lzo.upone.link/r/1XxPZyx3PG?pid=" target="_blank" class="c-button w-button bt-redirect" data-cartao="latam-black" style="display: block; background-color: #1fc859; color:#fff;">PEÇA JÁ</a>
              </div>
            </div>
          </div>
        </div>

        <div class="w-row c-row-centered">
          <div class="w-col w-col-4">
            <div class="c-cartao" style="height: auto; padding-bottom: 80px; position: relative; margin-bottom: 20px;">
              <div class="c-box-cartao-center" style="text-align: center; margin-bottom: 15px;">
                <img src="/images/latampassplatinum.png" loading="lazy" alt="Latam Pass Platinum" style="max-height: 130px; width: auto; display: inline-block;">
              </div>
              <p class="c-paragraph-3">LATAM PASS PLATINUM</p>
              <ul role="list" class="c-list-2">
                <li class="c-list-item-2">2 milhas por dólar gasto em compras</li>
                <li class="c-list-item-2">16 mil milhas bônus atingindo gasto exigido</li>
                <li class="c-list-item-2">Mensalidade grátis ao gastar R$ 4 mil por fatura</li>
                <li class="c-list-item-2">Upgrade de cabine com trechos de cortesia</li>
                <li class="c-list-item-2">Passagens LATAM em até 10x sem juros</li>
              </ul>
              <div class="c-bt" style="position: absolute; bottom: 20px; left: 20px; width: calc(100% - 40px); text-align: center;">
                <a href="https://lzo.upone.link/r/42wrQm2arA?pid=" target="_blank" class="c-button w-button bt-redirect" data-cartao="latam-platinum" style="display: block; background-color: #1fc859; color:#fff;">PEÇA JÁ</a>
              </div>
            </div>
          </div>

          <div class="w-col w-col-4">
            <div class="c-cartao" style="height: auto; padding-bottom: 80px; position: relative; margin-bottom: 20px;">
              <div class="c-box-cartao-center" style="text-align: center; margin-bottom: 15px;">
                <img src="/images/passai.png" loading="lazy" alt="Cartão Passaí" style="max-height: 130px; width: auto; display: inline-block;">
              </div>
              <p class="c-paragraph-3">CARTÃO PASSAÍ</p>
              <ul role="list" class="c-list-2">
                <li class="c-list-item-2">Preço de atacado a partir de 1 un. no Assaí</li>
                <li class="c-list-item-2">Parcelamento em até 3x sem juros no Assaí</li>
                <li class="c-list-item-2">Descontos em exames e serviços rede Dasa</li>
                <li class="c-list-item-2">Até 2 cartões adicionais gratuitos</li>
                <li class="c-list-item-2">Benefícios Visa: Proteção e Garantia Estendida</li>
              </ul>
              <div class="c-bt" style="position: absolute; bottom: 20px; left: 20px; width: calc(100% - 40px); text-align: center;">
                <a href="https://lzo.upone.link/r/4a4V4qpVl1?pid=" target="_blank" class="c-button w-button bt-redirect" data-cartao="passai" style="display: block; background-color: #1fc859; color:#fff;">PEÇA JÁ</a>
              </div>
            </div>
          </div>

          <div class="w-col w-col-4">
            <div class="c-cartao carrefour" style="height: auto; padding-bottom: 80px; position: relative; margin-bottom: 20px;">
              <div class="c-box-cartao-center" style="text-align: center; margin-bottom: 15px;">
                <img src="/images/carrefour.png" loading="lazy" alt="Cartão Carrefour" style="max-height: 130px; width: auto; display: inline-block;">
              </div>
              <p class="c-paragraph-3">CARTÃO CARREFOUR</p>
              <ul role="list" class="c-list-2">
                <li class="c-list-item-2">Anuidade zero comprando 1x ao mês na rede</li>
                <li class="c-list-item-2">Descontos diários exclusivos nas lojas Carrefour</li>
                <li class="c-list-item-2">Setor de eletro em até 24x sem juros nas lojas</li>
                <li class="c-list-item-2">Até 70 dias para pagar nos Postos Carrefour</li>
              </ul>
              <div class="c-bt" style="position: absolute; bottom: 20px; left: 20px; width: calc(100% - 40px); text-align: center;">
                <a href="https://lzo.upone.link/r/AlNzQxq15o?pid=" target="_blank" class="c-button w-button bt-redirect" data-cartao="carrefour" style="display: block; background-color: #1fc859; color:#fff;">PEÇA JÁ</a>
              </div>
            </div>
          </div>

          <div class="w-col w-col-4">
            <div class="c-cartao atacadao" style="height: auto; padding-bottom: 80px; position: relative; margin-bottom: 20px;">
              <div class="c-box-cartao-center" style="text-align: center; margin-bottom: 15px;">
                <img src="/images/atacadao.png" loading="lazy" alt="Cartão Atacadão" style="max-height: 130px; width: auto; display: inline-block;">
              </div>
              <p class="c-paragraph-3">CARTÃO ATACADÃO</p>
              <ul role="list" class="c-list-2">
                <li class="c-list-item-2">Preço de atacado a partir de 1 un. no Atacadão</li>
                <li class="c-list-item-2">Até 70 dias para pagar nos Postos Atacadão</li>
                <li class="c-list-item-2">Parcelamento em até 10x sem juros nas drogarias</li>
                <li class="c-list-item-2">Aceitação internacional (Visa ou Mastercard)</li>
              </ul>
              <div class="c-bt" style="position: absolute; bottom: 20px; left: 20px; width: calc(100% - 40px); text-align: center;">
                <a href="https://lzo.upone.link/r/5M2Ab2m7eA?pid=" target="_blank" class="c-button w-button bt-redirect" data-cartao="atacadao" style="display: block; background-color: #1fc859; color:#fff;">PEÇA JÁ</a>
              </div>
            </div>
          </div>
        </div>

        <div class="c-botao-mobile">
          <a href="#box-cart-es" class="button-3 w-button">Peça já seu cartão!</a>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer">
    <div class="footer-container">
      <img src="/images/logo-footer.png" class="footer-logo" alt="LiberaCash">

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
        LiberaCash é um site da LZO Agência de Publicidade LTDA (CNPJ 05.595.492/0001-05), sediada na Av. Paulista, 1636 — Bela Vista, São Paulo/SP. Não somos uma instituição financeira: oferecemos um serviço 100% gratuito de comparação de crédito pessoal e empresarial, conectando você às melhores condições entre nossos parceiros — principais Fintechs e Bancos do Brasil.<br><br>
        <strong>Importante:</strong> As condições dos cartões de crédito, incluindo limite aprovado, anuidade, taxas de juros, encargos, benefícios e demais características, variam conforme a instituição financeira emissora e a análise de crédito do solicitante. A aprovação está sujeita aos critérios exclusivos de cada instituição parceira. A LiberaCash não é uma instituição financeira e não concede crédito nem emite cartões. Nosso portal oferece um serviço gratuito de comparação e conexão entre usuários e instituições financeiras parceiras, facilitando a solicitação de cartões de crédito.
      </div>

      <div class="footer-copyright">
        &copy; <?php echo date('Y'); ?> LiberaCash. Todos os direitos reservados.
      </div>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="/js/webflow.js" type="text/javascript"></script>
  <script src="/js/main.js?<?= uniqid() ?>" type="text/javascript"></script>

  <script>
    $(document).ready(function(){
      // Menu Hamburger Mobile (Do código Home)
      $('.hamburger').click(function(){
        $('.nav-menu').slideToggle();
      });

      // MÁSCARA DE MOEDA PARA O CAMPO DE RENDA
      document.getElementById('renda-input').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove tudo o que não for número
        
        if (value === '') {
          e.target.value = '';
          return;
        }

        // Formata para decimal com duas casas
        value = (parseInt(value, 10) / 100).toFixed(2) + '';
        
        // Troca ponto por vírgula e aplica os pontos de milhar
        value = value.replace(".", ",");
        value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        
        e.target.value = 'R$ ' + value;
      });

      // LÓGICA DE RECOMENDAÇÃO
      document.getElementById('form-recomendacao').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Pega o valor da renda e converte de volta para Float (ex: R$ 1.500,00 -> 1500.00)
        let rendaRaw = document.getElementById('renda-input').value;
        rendaRaw = rendaRaw.replace('R$ ', '').replace(/\./g, '').replace(',', '.');
        const renda = parseFloat(rendaRaw);

        const stepForm = document.getElementById('step-formulario');
        const stepResult = document.getElementById('step-resultado');
        const containerCartao = document.getElementById('container-cartao-alvo');
        const linkPecaAgora = document.getElementById('link-peca-agora');
        
        let imgPath = '';
        let cardName = '';
        let cardLink = '';

        if (renda >= 800 && renda < 2500) {
          imgPath = 'images/atacadao.png';
          cardName = 'Cartão Atacadão';
          cardLink = 'https://lzo.upone.link/r/5M2Ab2m7eA?pid=';
        } else if (renda >= 2500 && renda < 4000) {
          imgPath = 'images/carrefour.png';
          cardName = 'Cartão Carrefour';
          cardLink = 'https://lzo.upone.link/r/AlNzQxq15o?pid=';
        } else if (renda >= 4000 && renda < 6000) {
          imgPath = 'images/azulplatinum.png';
          cardName = 'Azul Visa Platinum';
          cardLink = 'https://lzo.upone.link/r/xoeoQWP64m?pid=';
        } else if (renda >= 6000 && renda < 10000) {
          imgPath = 'images/latampassplatinum.png';
          cardName = 'LATAM Pass Platinum';
          cardLink = 'https://lzo.upone.link/r/42wrQm2arA?pid=';
        } else if (renda >= 10000 && renda <= 15000) {
          imgPath = 'images/azul-infinite.png';
          cardName = 'Azul Visa Infinite';
          cardLink = 'https://lzo.upone.link/r/7VRQo62qbQ?pid=';
        } else if (renda > 15000) {
          imgPath = 'images/latampassblack.png';
          cardName = 'LATAM Pass Black';
          cardLink = 'https://lzo.upone.link/r/1XxPZyx3PG?pid=';
        } else {
          alert('Por favor, insira uma renda válida.');
          return;
        }

        containerCartao.innerHTML = `<img src="${imgPath}" alt="${cardName}" class="img-cartao-result">`;
        
        // Atualiza o link do botão dinâmico
        linkPecaAgora.href = cardLink;
        linkPecaAgora.target = "_blank"; // Garante que abra em uma nova aba

        stepForm.style.display = 'none';
        stepResult.style.display = 'block';
        
        if (window.innerWidth < 991) {
          window.scrollTo({ top: 0, behavior: 'smooth' });
        }
      });

      // Máscara de CPF
      document.getElementById('cpf-mask').addEventListener('input', function (e) {
        let v = e.target.value.replace(/\D/g, '');
        if (v.length > 11) v = v.slice(0, 11);
        if (v.length > 9) v = v.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
        else if (v.length > 6) v = v.replace(/(\d{3})(\d{3})(\d{3})/, "$1.$2.$3");
        else if (v.length > 3) v = v.replace(/(\d{3})(\d{3})/, "$1.$2");
        e.target.value = v;
      });
    });
  </script>

</body>
</html>
