<?php
/**
 * sucesso.php - Pagina de Sucesso / Propostas
 * Exibe as propostas retornadas pela API dos parceiros.
 * Se nao houver propostas, mostra banners dos parceiros gerais.
 */

session_start();

$token = $_GET['token'] ?? '';
$consulta = $_SESSION['consulta'] ?? null;

if (empty($token) || !$consulta || ($consulta['token'] ?? '') !== $token) {
    header('Location: index.php');
    exit;
}

$propostas = $consulta['propostas'] ?? [];
$dados     = $consulta['dados'] ?? [];
$nome      = explode(' ', $dados['full_name'] ?? '')[0];
$valorDesejado = $dados['loan_amount'] ?? 5000;
$produtoAtual  = $consulta['produto'] ?? 'credito-pessoal';

/**
 * Banners de parceiros por produto, usados quando não há propostas "reais" (mock/API)
 * disponíveis para o produto escolhido. Links com '#' são placeholder — ainda sem
 * integração/afiliado configurado. Atualize aqui assim que tiver o link real.
 */
$parceiros_por_produto = [
    'credito-pessoal' => [
        ['nome' => 'No Verde',  'logo' => 'NoVd', 'desc' => 'Empréstimo pessoal rápido, inclusive para negativados', 'link' => '#'],
        ['nome' => 'Velotax',   'logo' => 'Velo', 'desc' => 'Crédito pessoal online com aprovação em minutos', 'link' => 'https://credito.velotax.com.br/cpf?utm_source=b4b'],
        ['nome' => 'Facio',     'logo' => 'Faci', 'desc' => 'Antecipação salarial via convênio com sua empresa', 'link' => '#'],
        ['nome' => 'Creditas',  'logo' => 'Cred', 'desc' => 'Crédito pessoal e com garantia, taxas competitivas', 'link' => '#'],
        ['nome' => 'Simplic',   'logo' => 'Simp', 'desc' => 'Empréstimo pessoal 100% online', 'link' => '#'],
        ['nome' => 'Ferratum',  'logo' => 'Ferr', 'desc' => 'Crédito rápido, aceita negativado', 'link' => '#'],
    ],
    'garantia-celular' => [
        ['nome' => 'Juvo',          'logo' => 'Juvo', 'desc' => 'Empréstimo com garantia do celular, aprovação rápida', 'link' => 'https://app.juvocredito.com.br/emprestimo/dados?utm_source=b4b'],
        ['nome' => 'Pericred',      'logo' => 'Peri', 'desc' => 'Crédito com garantia de celular sem consulta ao Serasa', 'link' => '#'],
        ['nome' => 'Super Digital', 'logo' => 'SupD', 'desc' => 'Dinheiro liberado em até 1 dia útil', 'link' => '#'],
        ['nome' => 'Super Sim',     'logo' => 'SupS', 'desc' => 'Aceita negativado, aprovação rápida', 'link' => '#'],
    ],
    'conta-luz' => [
        ['nome' => 'Crefaz',    'logo' => 'Cref', 'desc' => 'Parcelas descontadas direto na conta de luz', 'link' => '#'],
        ['nome' => 'PlanCredi', 'logo' => 'Plan', 'desc' => 'Empréstimo na conta de luz, sem burocracia', 'link' => '#'],
        ['nome' => 'Reallizi',  'logo' => 'Real', 'desc' => 'Crédito descontado na fatura de energia', 'link' => '#'],
        ['nome' => 'Siga',      'logo' => 'Siga', 'desc' => 'Empréstimo com desconto na conta de luz', 'link' => '#'],
    ],
    'consignado' => [
        // Ainda sem parceiro plugado — todos como placeholder até integrarmos a API real.
        ['nome' => 'Paraná Banco',      'logo' => 'PR',  'desc' => 'Consignado INSS com taxas competitivas', 'link' => '#'],
        ['nome' => 'Facta Financeira',  'logo' => 'Fact', 'desc' => 'Consignado para aposentados e pensionistas', 'link' => '#'],
        ['nome' => 'C6 Consig',         'logo' => 'C6',  'desc' => 'Consignado digital do C6 Bank', 'link' => '#'],
        ['nome' => 'Daycoval',          'logo' => 'Day', 'desc' => 'Consignado INSS tradicional', 'link' => '#'],
        ['nome' => 'Banco BMG',         'logo' => 'BMG', 'desc' => 'Um dos pioneiros em consignado no Brasil', 'link' => '#'],
        ['nome' => 'Sicoob',            'logo' => 'Sico', 'desc' => 'Consignado com taxas entre as mais baixas do mercado', 'link' => '#'],
        ['nome' => 'Banco Safra',       'logo' => 'Safr', 'desc' => 'Consignado INSS com condições competitivas', 'link' => '#'],
        ['nome' => 'Banco Pan',         'logo' => 'Pan',  'desc' => 'Consignado tradicional, um dos mais conhecidos', 'link' => '#'],
        ['nome' => 'Banco Inter',       'logo' => 'Int',  'desc' => 'Consignado 100% digital', 'link' => '#'],
    ],
    'garantia-auto' => [
        ['nome' => 'Creditas', 'logo' => 'Cred', 'desc' => 'Empréstimo com garantia de veículo', 'link' => '#'],
        ['nome' => 'BV',       'logo' => 'BV',   'desc' => 'Crédito com garantia de auto, parcelas que cabem no bolso', 'link' => '#'],
    ],
    'garantia-imovel' => [
        ['nome' => 'Creditas', 'logo' => 'Cred', 'desc' => 'Home equity: use seu imóvel como garantia', 'link' => '#'],
    ],
];
$parceiros_fallback = $parceiros_por_produto[$produtoAtual] ?? $parceiros_por_produto['credito-pessoal'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propostas de Emprestimo - Confira suas opcoes | Credito.vc</title>

    <meta name="description" content="Confira as propostas de emprestimo pre-aprovadas para voce. Compare taxas, parcelas e escolha a melhor opcao.">
    <meta name="robots" content="noindex, nofollow">

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
        }

        /* Top bar */
        .top-bar {
            background-color: #19a44a;
            padding: 8px 0;
            text-align: center;
            font-size: 11px;
            color: #ffffff;
        }

        /* Header */
        .header {
            background-color: var(--primary-green);
            padding: 10px 0;
            position: sticky;
            top: 0;
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

        /* Hero */
        .hero {
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            padding: 60px 20px;
            text-align: center;
            color: white;
        }
        .hero h1 {
            font-family: 'Raleway', sans-serif;
            font-size: 2.4rem;
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
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Resumo */
        .resumo-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            padding: 30px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .resumo-card__icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #e9f7f4;
            color: var(--primary-green);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }
        .resumo-card__info { flex: 1; min-width: 200px; }
        .resumo-card__info strong {
            display: block;
            font-size: 14px;
            color: var(--gray-text);
            font-weight: 500;
            margin-bottom: 4px;
        }
        .resumo-card__info span {
            font-size: 28px;
            font-weight: 800;
            color: var(--primary-green);
            font-family: 'Raleway', sans-serif;
        }

        /* Section Title */
        .section-title {
            font-family: 'Raleway', sans-serif;
            font-size: 1.6rem;
            color: var(--dark-bg);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .section-title i {
            color: var(--primary-green);
        }

        /* Card de Proposta */
        .propostas-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }
        .proposta-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            padding: 24px;
            border: 2px solid transparent;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        .proposta-card:hover {
            border-color: var(--primary-green);
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(46,204,113,0.15);
        }
        .proposta-card.destaque {
            border-color: var(--primary-green);
            background: linear-gradient(135deg, #f0fff4 0%, #e9f7f4 100%);
        }
        .proposta-card.destaque::before {
            content: 'Menor taxa';
            position: absolute;
            top: 18px;
            right: -38px;
            width: 160px;
            text-align: center;
            background: var(--primary-green);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 6px 0;
            transform: rotate(45deg);
            text-transform: uppercase;
            letter-spacing: .5px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }
        .proposta-card__header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
        }
        .proposta-card__logo {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            background: #e9f7f4;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 14px;
            color: var(--primary-green);
            flex-shrink: 0;
            text-transform: uppercase;
            overflow: hidden;
        }
        .proposta-card__logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 6px;
        }
        .proposta-card__name {
            font-family: 'Raleway', sans-serif;
            font-size: 20px;
            font-weight: 700;
        }
        .badge-recomendado {
            background: var(--accent-green);
            color: #000;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }
        .proposta-card__details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }
        .detail-item {
            text-align: center;
            padding: 16px;
            background: #f9f9f9;
            border-radius: 12px;
        }
        .detail-item__label {
            font-size: 11px;
            color: var(--gray-text);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 6px;
        }
        .detail-item__value {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark-bg);
            font-family: 'Raleway', sans-serif;
        }
        .detail-item__value.highlight {
            color: var(--primary-green);
        }

        /* Parcelas */
        .proposta-card__parcelas {
            margin-bottom: 20px;
        }
        .parcela-tag {
            display: inline-block;
            background: #e9f7f4;
            color: var(--dark-green);
            font-size: 13px;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 20px;
            margin: 3px 4px 3px 0;
        }

        /* Botao CTA */
        .btn-solicitar {
            display: block;
            width: 100%;
            padding: 16px;
            background: var(--primary-green);
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: all 0.2s;
            margin-top: auto;
        }
        .btn-solicitar:hover {
            background: var(--dark-green);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(46,204,113,0.4);
        }
        .btn-solicitar i { margin-right: 8px; }

        /* Fallback: Banners Parceiros */
        .fallback-section {
            text-align: center;
            margin-bottom: 40px;
        }
        .fallback-section p {
            font-size: 15px;
            color: var(--gray-text);
            margin-bottom: 24px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }
        .parceiros-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }
        .parceiro-banner {
            background: white;
            border-radius: 15px;
            padding: 30px 24px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            text-decoration: none;
            color: inherit;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            border: 2px solid transparent;
        }
        .parceiro-banner:hover {
            border-color: var(--primary-green);
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(46,204,113,0.15);
        }
        .parceiro-banner__logo {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            background: #e9f7f4;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 800;
            color: var(--primary-green);
            text-transform: uppercase;
            overflow: hidden;
        }
        .parceiro-banner__logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 8px;
        }
        .parceiro-banner__name {
            font-family: 'Raleway', sans-serif;
            font-size: 18px;
            font-weight: 700;
        }
        .parceiro-banner__desc {
            font-size: 13px;
            color: var(--gray-text);
            text-align: center;
            line-height: 1.5;
        }
        .parceiro-banner__cta {
            font-size: 14px;
            font-weight: 600;
            color: var(--primary-green);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Disclaimer */
        .disclaimer {
            background: #fff8e1;
            border: 1px solid #ffe082;
            border-radius: 12px;
            padding: 20px;
            font-size: 13px;
            color: #6d5a00;
            margin-bottom: 30px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            line-height: 1.6;
        }
        .disclaimer i {
            font-size: 18px;
            color: #ffa000;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* CTA Section */
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
        }
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
        .footer-logo { height: 38px; margin-bottom: 25px; }
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
        .footer-text {
            font-size: 12px;
            color: #666666;
            line-height: 1.7;
            text-align: justify;
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

        /* Media */
        @media (max-width: 900px) {
            .propostas-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .nav-menu { display: none; }
            .hamburger { display: block; }
            .hero h1 { font-size: 1.8rem; }
            .hero p { font-size: 1rem; }
            .resumo-card { flex-direction: column; text-align: center; }
            .propostas-grid { grid-template-columns: 1fr; }
            .proposta-card__details { grid-template-columns: repeat(2, 1fr); }
            .parceiros-grid { grid-template-columns: 1fr; }
            .footer-text { text-align: left; }
        }
    </style>
</head>
<body>

<div class="top-bar">
    Atencao! A Credito.vc nao cobra nenhum deposito antecipado para a liberacao de emprestimo.
</div>

<header class="header">
    <div class="header-container">
        <div class="logo">
            <a href="/"><img src="images/logo.png" alt="LiberaCash"></a>
        </div>
        <ul class="nav-menu">
            <li><a href="/">Credito</a></li>
            <li><a href="cartoes.php">Cartao de Credito</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="sobre.php">Sobre</a></li>
            <li><a href="contato.php">Contato</a></li>
        </ul>
        <div class="hamburger"><i class="fas fa-bars"></i></div>
    </div>
</header>

<section class="hero">
    <h1><?php echo htmlspecialchars($nome); ?>, suas propostas estao prontas!</h1>
    <p>
        <?php if (!empty($propostas)): ?>
            Encontramos <?php echo count($propostas); ?> opcao(oes) de emprestimo para voce. Compare e escolha a melhor.
        <?php else: ?>
            No momento nao encontramos propostas pre-aprovadas, mas veja as opcoes dos nossos parceiros.
        <?php endif; ?>
    </p>
</section>

<div class="container">

    <!-- RESUMO -->
    <div class="resumo-card">
        <div class="resumo-card__icon">
            <i class="fas fa-money-bill-wave"></i>
        </div>
        <div class="resumo-card__info">
            <strong>Valor solicitado</strong>
            <span>R$ <?php echo number_format($valorDesejado, 2, ',', '.'); ?></span>
        </div>
    </div>

    <?php if (!empty($propostas)): ?>
    <!-- PROPOSTAS ENCONTRADAS -->
    <h2 class="section-title">
        <i class="fas fa-hand-holding-usd"></i>
        Propostas pre-aprovadas
    </h2>

    <div class="propostas-grid">
    <?php foreach ($propostas as $i => $p): ?>
    <div class="proposta-card <?php echo $i === 0 ? 'destaque' : ''; ?>">
        <div class="proposta-card__header">
            <div class="proposta-card__logo">
                <?php if (!empty($p['logo_img'])): ?>
                    <img src="<?php echo htmlspecialchars($p['logo_img']); ?>" alt="<?php echo htmlspecialchars($p['parceiro']); ?>">
                <?php else: ?>
                    <?php echo htmlspecialchars(substr($p['parceiro'], 0, 4)); ?>
                <?php endif; ?>
            </div>
            <div>
                <div class="proposta-card__name"><?php echo htmlspecialchars($p['parceiro']); ?></div>
                <?php if ($i === 0): ?>
                    <span class="badge-recomendado"><i class="fas fa-star"></i> Recomendado</span>
                <?php endif; ?>
            </div>
        </div>

        <div class="proposta-card__details">
            <div class="detail-item">
                <div class="detail-item__label">Taxa mensal</div>
                <div class="detail-item__value"><?php echo number_format($p['taxa_mes'], 2, ',', '.'); ?>%</div>
            </div>
            <div class="detail-item">
                <div class="detail-item__label">Ate</div>
                <div class="detail-item__value highlight"><?php echo $p['prazo_max']; ?>x</div>
            </div>
            <div class="detail-item">
                <div class="detail-item__label">Valor</div>
                <div class="detail-item__value highlight">R$ <?php echo number_format($p['valor'], 2, ',', '.'); ?></div>
            </div>
        </div>

        <?php if (!empty($p['parcelas'])): ?>
        <div class="proposta-card__parcelas">
            <?php foreach ($p['parcelas'] as $parc): ?>
                <span class="parcela-tag"><?php echo htmlspecialchars($parc['label']); ?></span>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <a href="<?php echo htmlspecialchars($p['link']); ?>" class="btn-solicitar" target="_blank" rel="noopener">
            <i class="fas fa-external-link-alt"></i>
            Solicitar na <?php echo htmlspecialchars($p['parceiro']); ?>
        </a>
    </div>
    <?php endforeach; ?>
    </div>


    <?php else: ?>
    <!-- SEM PROPOSTAS - BANNERS DOS PARCEIROS (por produto) -->
    <div class="fallback-section">
        <h2 class="section-title" style="justify-content: center;">
            <i class="fas fa-handshake"></i>
            Nossos parceiros
        </h2>
        <p>
            Embora nao tenhamos encontrado uma proposta pre-aprovada no momento,
            voce pode solicitar diretamente com nossos parceiros confiaveis:
        </p>

        <div class="parceiros-grid">
            <?php foreach ($parceiros_fallback as $parc): ?>
            <a href="<?php echo htmlspecialchars($parc['link']); ?>" class="parceiro-banner" target="_blank" rel="noopener">
                <div class="parceiro-banner__logo">
                    <?php if (!empty($parc['logo_img'])): ?>
                        <img src="<?php echo htmlspecialchars($parc['logo_img']); ?>" alt="<?php echo htmlspecialchars($parc['nome']); ?>">
                    <?php else: ?>
                        <?php echo htmlspecialchars($parc['logo']); ?>
                    <?php endif; ?>
                </div>
                <div class="parceiro-banner__name"><?php echo htmlspecialchars($parc['nome']); ?></div>
                <div class="parceiro-banner__desc"><?php echo htmlspecialchars($parc['desc']); ?></div>
                <div class="parceiro-banner__cta">Simular agora <i class="fas fa-arrow-right"></i></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- DISCLAIMER -->
    <div class="disclaimer">
        <i class="fas fa-info-circle"></i>
        <div>
            <strong>Importante:</strong> As taxas e condicoes podem variar de acordo com a analise de credito de cada parceiro.
            Os valores apresentados sao estimativas e estao sujeitos a alteracao no momento da contratacao.
            Leia atentamente o contrato antes de firmar qualquer compromisso financeiro.
        </div>
    </div>

    <!-- CTA -->
    <div class="cta-section">
        <h2><i class="fas fa-comments"></i> Precisa de ajuda?</h2>
        <p>Tem alguma duvida sobre as propostas? Entre em contato com nosso time.</p>
        <a href="contato.php" class="cta-btn">ENTRAR EM CONTATO</a>
    </div>

</div>

<footer class="footer">
    <div class="footer-container">
        <img src="images/logo-footer.png" class="footer-logo" alt="LiberaCash">

        <div class="footer-social">
            <a href="https://www.facebook.com/creditovoce" target="_blank" rel="noopener noreferrer" aria-label="Facebook Credito.vc"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/credito.vc/" target="_blank" rel="noopener noreferrer" aria-label="Instagram Credito.vc"><i class="fab fa-instagram"></i></a>
            <a href="#" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn Credito.vc"><i class="fab fa-linkedin-in"></i></a>
        </div>

        <div class="footer-text">
            Ao acessar/utilizar este site, voce aceita as condicoes dos <a href="termos-e-condicoes.php" target="_blank">Termos de uso</a> e <a href="politica-de-privacidade.php" target="_blank">Politica de Privacidade</a>.<br><br>
            Credito.vc e um site da LZO Agencia de Publicidade LTDA (CNPJ 05.595.492/0001-05), sediada na Av. Paulista, 1636 - Bela Vista, Sao Paulo/SP. Nao somos uma instituicao financeira: oferecemos um servico 100% gratuito de comparacao de credito pessoal e empresarial, conectando voce as melhores condicoes entre nossos parceiros - principais Fintechs e Bancos do Brasil. Preencha o formulario e receba contato de um parceiro.
        </div>

        <div class="footer-copyright">
            &copy; <?php echo date('Y'); ?> Credito.vc. Todos os direitos reservados.
        </div>
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
