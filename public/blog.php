<?php
/**
 * Blog LiberaCash - blog.php
 * Modelo de blog integrado com o design do site libera.cash
 * Suporta listagem, post individual, filtro por categoria,
 * SEO/Open Graph, botões de compartilhamento e posts relacionados.
 * Header e banner sincronizados com home.php.
 *
 * Os posts agora vêm do banco de dados (tabela blog_posts) em vez
 * de um array fixo. Gerencie o conteúdo pelo painel /admin_blog/.
 */

require_once __DIR__ . '/db.php'; // já deixa $pdo pronto

// --- Post individual (via slug) ---
$slug = isset($_GET["post"]) ? $_GET["post"] : null;
$current_post = null;

if ($slug !== null) {
    $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE slug = :slug AND status = 'publicado' LIMIT 1");
    $stmt->execute([':slug' => $slug]);
    $row = $stmt->fetch();
    if ($row) {
        $current_post = [
            'slug'      => $row['slug'],
            'titulo'    => $row['titulo'],
            'categoria' => $row['categoria'],
            'data'      => date('d/m/Y', strtotime($row['created_at'])),
            'autor'     => $row['autor'] ?: 'Redação LiberaCash',
            'resumo'    => $row['resumo'],
            'conteudo'  => $row['conteudo'],
            'imagem'    => $row['imagem_capa'],
        ];
        // Contabiliza visualização (silenciosamente, sem afetar a resposta)
        $pdo->prepare("UPDATE blog_posts SET views = views + 1 WHERE slug = :slug")
            ->execute([':slug' => $slug]);
    }
}
if ($slug !== null && $current_post === null) {
    header("Location: /blog/", true, 302);
    exit;
}

// --- Todos os posts publicados (usados para listagem, filtro e relacionados) ---
$posts = [];
$rows = $pdo->query("SELECT * FROM blog_posts WHERE status = 'publicado' ORDER BY created_at DESC")->fetchAll();
foreach ($rows as $row) {
    $posts[] = [
        'slug'      => $row['slug'],
        'titulo'    => $row['titulo'],
        'categoria' => $row['categoria'],
        'data'      => date('d/m/Y', strtotime($row['created_at'])),
        'autor'     => $row['autor'] ?: 'Redação LiberaCash',
        'resumo'    => $row['resumo'],
        'conteudo'  => $row['conteudo'],
        'imagem'    => $row['imagem_capa'],
    ];
}

// --- Filtro por categoria (listagem) ---
$categorias = array_values(array_unique(array_column($posts, 'categoria')));
$categoria_filtro = isset($_GET['categoria']) ? $_GET['categoria'] : null;

$posts_filtrados = $posts;
if ($categoria_filtro) {
    $posts_filtrados = array_values(array_filter($posts, function($p) use ($categoria_filtro) {
        return $p['categoria'] === $categoria_filtro;
    }));
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $current_post ? "LiberaCash - " . htmlspecialchars($current_post["titulo"], ENT_QUOTES, 'UTF-8') : "LiberaCash - Blog | Dicas Financeiras"; ?></title>

    <!-- SEO / Open Graph -->
    <?php if ($current_post): ?>
        <meta name="description" content="<?php echo htmlspecialchars($current_post['resumo'], ENT_QUOTES, 'UTF-8'); ?>">
        <meta property="og:title" content="<?php echo htmlspecialchars($current_post['titulo'], ENT_QUOTES, 'UTF-8'); ?>">
        <meta property="og:description" content="<?php echo htmlspecialchars($current_post['resumo'], ENT_QUOTES, 'UTF-8'); ?>">
        <meta property="og:image" content="<?php echo htmlspecialchars($current_post['imagem'], ENT_QUOTES, 'UTF-8'); ?>">
        <meta property="og:type" content="article">
        <meta property="og:url" content="https://libera.cash/blog/<?php echo urlencode($current_post["slug"]); ?>/">
        <meta name="twitter:card" content="summary_large_image">
    <?php else: ?>
        <meta name="description" content="Blog LiberaCash — Dicas de saúde financeira, cartões de crédito, empréstimos e organização do seu dinheiro.">
        <meta property="og:title" content="Blog LiberaCash">
        <meta property="og:description" content="Dicas para sua saúde financeira, cartões e empréstimos.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://libera.cash/blog/">
    <?php endif; ?>

    <?php if ($current_post): ?>
    <link rel="canonical" href="https://libera.cash/blog/<?php echo urlencode($current_post["slug"]); ?>/">
<?php else: ?>
    <link rel="canonical" href="/blog/">
<?php endif; ?>
<?php if ($current_post):
        // Converte data DD/MM/AAAA para ISO 8601 com fuso horário de Brasília
        $partes_data = explode('/', $current_post['data']);
        $data_iso = isset($partes_data[2]) ? $partes_data[2] . '-' . $partes_data[1] . '-' . $partes_data[0] . 'T00:00:00-03:00' : date('c');
        $autor_post = isset($current_post['autor']) ? $current_post['autor'] : 'Redação LiberaCash';

        $jsonld = [
            "@context" => "https://schema.org",
            "@type" => "BlogPosting",
            "headline" => $current_post['titulo'],
            "description" => $current_post['resumo'],
            "image" => $current_post['imagem'],
            "datePublished" => $data_iso,
            "dateModified" => $data_iso,
            "author" => [
                "@type" => "Person",
                "name" => $autor_post,
                "url" => "https://libera.cash/blog/"
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => "LiberaCash",
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => "images/logo.png"
                ]
            ],
            "mainEntityOfPage" => [
                "@type" => "WebPage",
                "@id" => "https://libera.cash/blog/" . urlencode($current_post['slug']) . "/"
            ],
            "articleSection" => $current_post['categoria'],
            "inLanguage" => "pt-BR"
        ];
    ?>
    <script type="application/ld+json">
    <?php echo json_encode($jsonld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
    </script>
    <?php endif; ?>

    <?php
        // Breadcrumb: Início > Blog [> Post, se aplicável]
        $breadcrumb_items = [
            ["@type" => "ListItem", "position" => 1, "name" => "Início", "item" => "https://libera.cash/"],
            ["@type" => "ListItem", "position" => 2, "name" => "Blog", "item" => "https://libera.cash/blog/"]
        ];
        if ($current_post) {
            $breadcrumb_items[] = [
                "@type" => "ListItem",
                "position" => 3,
                "name" => $current_post['titulo'],
                "item" => "https://libera.cash/blog/" . urlencode($current_post['slug']) . "/"
            ];
        }
        $breadcrumb_jsonld = [
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => $breadcrumb_items
        ];
    ?>
    <script type="application/ld+json">
    <?php echo json_encode($breadcrumb_jsonld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
    </script>

    <link href="images/favicon.png" rel="shortcut icon" type="image/x-icon">
    <link href="images/webclip.png" rel="apple-touch-icon">

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

        /* ==== Top Warning Bar (fixa, igual às outras páginas) ==== */
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

        /* ==== Header (igual home.php) ==== */
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

        /* Info do blog dentro do header */
        .header-blog-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--white);
            padding: 0 20px;
            line-height: 1.2;
        }
        .header-blog-info strong {
            font-family: 'Raleway', sans-serif;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: 0.3px;
        }
        .header-blog-info span {
            font-size: 12px;
            opacity: 0.92;
            margin-top: 2px;
        }

        /* ==== Banner Slider (igual home.php) ==== */
        .banner-slider-container {
            max-width: 684px;
            margin: 30px auto 20px auto;
            padding: 0 10px;
            position: relative;
        }
        .banner-slider {
            position: relative;
            width: 100%;
            max-height: 156px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .slider-wrapper {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .slide {
            flex: 0 0 100%;
            display: block;
            text-decoration: none;
        }
        .slide img {
            width: 100%;
            height: auto;
            max-height: 156px;
            object-fit: cover;
            display: block;
            border-radius: 12px;
        }
        .slider-nav {
            position: absolute;
            top: 50%;
            width: calc(100% - 20px);
            left: 10px;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
            pointer-events: none;
            z-index: 10;
        }
        .slider-btn {
            background: rgba(0, 0, 0, 0.35);
            color: white;
            border: none;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            pointer-events: auto;
            font-size: 12px;
        }
        .slider-btn:hover { background: rgba(0, 0, 0, 0.65); }
        .slider-dots {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-top: 10px;
        }
        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ddd;
            cursor: pointer;
            transition: var(--transition);
        }
        .dot.active {
            background: var(--primary-green);
            width: 20px;
            border-radius: 4px;
        }

        /* ==== Blog Content ==== */
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Descritivo do blog (entre o banner e os filtros) */
        .breadcrumbs {
            max-width: 1200px;
            margin: 0 auto;
            padding: 14px 20px 0 20px;
            font-size: 13px;
            color: var(--text-light);
        }
        .breadcrumbs a { color: var(--text-light); text-decoration: none; }
        .breadcrumbs a:hover { color: var(--primary-green); text-decoration: underline; }
        .breadcrumbs .sep { margin: 0 6px; color: #ccc; }
        .breadcrumbs .current { color: var(--text-dark); font-weight: 600; }

        .blog-intro {
            text-align: center;
            margin: 20px auto 25px auto;
            padding: 0 20px;
            max-width: 900px;
            background: transparent;
        }
        .blog-intro strong {
            display: block;
            font-family: 'Raleway', sans-serif;
            font-size: 26px;
            font-weight: 800;
            color: var(--dark-bg);
            letter-spacing: 0.3px;
        }
        .blog-intro span {
            display: block;
            font-size: 14px;
            color: var(--text-light);
            margin-top: 6px;
        }
        @media (max-width: 768px) {
            .blog-intro strong { font-size: 20px; }
            .blog-intro span { font-size: 13px; }
        }

        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-bottom: 30px;
        }
        .filter-btn {
            padding: 8px 16px;
            border-radius: 20px;
            background: white;
            color: var(--text-dark);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            border: 2px solid #eee;
            transition: all 0.2s;
        }
        .filter-btn:hover, .filter-btn.active {
            background: var(--primary-green);
            color: white;
            border-color: var(--primary-green);
        }

        /* ==== CTA de Simulação (listagem do blog) ==== */
        .blog-cta-banner {
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            color: #fff;
            border-radius: 15px;
            padding: 28px 35px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .blog-cta-banner .blog-cta-text h3 {
            font-family: 'Raleway', sans-serif;
            font-size: 1.3rem;
            font-weight: 800;
            margin-bottom: 6px;
        }
        .blog-cta-banner .blog-cta-text p {
            font-size: 14px;
            opacity: 0.95;
            margin: 0;
        }
        .blog-cta-btn {
            background: var(--accent-green);
            color: #000;
            padding: 13px 28px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 13.5px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
            transition: transform 0.2s ease;
            flex-shrink: 0;
        }
        .blog-cta-btn:hover { transform: scale(1.05); }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }

        .post-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        .post-card:hover { transform: translateY(-5px); }

        .post-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    display: block;
}
        .post-content {
            padding: 20px;
            flex-grow: 1;
        }
        .post-category {
            color: var(--primary-green);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 10px;
            display: block;
        }
        .post-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.3;
            color: var(--dark-bg);
            font-family: 'Raleway', sans-serif;
        }
        .post-excerpt {
            color: var(--gray-text);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .post-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #eee;
            padding-top: 15px;
            font-size: 12px;
            color: #999;
        }
        .btn-read {
            background-color: var(--accent-green);
            color: #000;
            padding: 8px 20px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 700;
            font-size: 12px;
            display: inline-block;
        }
        .no-results {
            text-align: center;
            padding: 40px;
            color: var(--gray-text);
            grid-column: 1 / -1;
        }

        /* ==== Single Post ==== */
        .single-post {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            padding: 40px;
        }
        .single-post-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 30px;
    display: block;
}
        .single-post h1 {
            font-size: 2.3rem;
            color: var(--dark-bg);
            margin-bottom: 15px;
            font-family: 'Raleway', sans-serif;
        }
        .single-post .post-meta {
            font-size: 14px;
            color: var(--gray-text);
            margin-bottom: 30px;
        }
        .single-post .post-full-content p {
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        /* ==== CTA de Simulação (dentro do post) ==== */
        .post-cta {
            background: #e9f7f4;
            border: 1px solid #1fc859;
            border-radius: 15px;
            padding: 28px 30px;
            margin: 35px 0;
            text-align: center;
        }
        .post-cta h4 {
            font-family: 'Raleway', sans-serif;
            font-size: 1.2rem;
            margin-bottom: 8px;
            color: var(--dark-bg);
        }
        .post-cta p {
            font-size: 14px;
            color: var(--gray-text);
            margin-bottom: 18px;
        }
        .post-cta .blog-cta-btn { margin-top: 0; }

        /* ==== Share Buttons ==== */
        .share-buttons {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }
        .share-buttons span {
            font-size: 13px;
            color: var(--gray-text);
            margin-right: 5px;
            font-weight: 600;
        }
        .share-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            color: white;
            text-decoration: none;
            font-size: 15px;
            transition: transform 0.2s;
        }
        .share-btn:hover { transform: scale(1.1); }
        .share-whatsapp { background: #25D366; }
        .share-facebook { background: #1877F2; }
        .share-linkedin { background: #0A66C2; }
        .share-twitter  { background: #000; }

        /* ==== Related Posts ==== */
        .related-posts { margin-top: 50px; }
        .related-posts h3 {
            font-size: 1.4rem;
            margin-bottom: 20px;
            color: var(--dark-bg);
            font-family: 'Raleway', sans-serif;
        }
        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }
        .related-card {
            background: #f9f9f9;
            border-radius: 10px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            transition: transform 0.3s;
        }
        .related-card:hover { transform: translateY(-3px); }
        .related-image {
    width: 100%;
    height: 120px;
    object-fit: cover;
    display: block;
}
        .related-info { padding: 12px; }
        .related-info small {
            color: var(--primary-green);
            font-weight: 700;
            font-size: 10px;
            text-transform: uppercase;
        }
        .related-info h4 {
            font-size: 13px;
            margin: 5px 0 0;
            line-height: 1.3;
            color: var(--dark-bg);
        }

        .back-to-blog {
            display: inline-block;
            margin-top: 30px;
            color: var(--primary-green);
            text-decoration: none;
            font-weight: 600;
        }

        /* ==== Footer (mesmo estilo home.php) ==== */
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
            .header-blog-info { display: none; }
            .single-post { padding: 20px; }
            .single-post h1 { font-size: 1.8rem; }
            .banner-slider-container { padding: 0 15px; margin: 20px auto 10px auto; }
            .slider-btn { width: 30px; height: 30px; font-size: 10px; }
            .footer-text { text-align: left; }
            .blog-cta-banner { flex-direction: column; text-align: center; padding: 25px; }
        }
    </style>
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

<!-- ==== Banner Slider ==== -->
<div class="banner-slider-container">
    <div class="banner-slider">
        <div class="slider-wrapper">
            <a href="#linkbanner#" class="slide">
                <img src="images/banner-juvo-creditovc.png" alt="Empréstimo pessoal Juvo">
            </a>
            <a href="https://www.itau.com.br/cartoes/escolha/g/azul-visa-infinite?utm_source=lzo&utm_medium=affiliate&utm_campaign=gl-aff-cartoes-conversao-azul-infinite&cpg_s=sliceafl&utmgl=utm_camp-{campaign.id}" class="slide">
                <img src="images/banner-itaul-infinity.png" alt="Itaú Azul Visa Infinite">
            </a>
            <a href="#linkbanner#" class="slide">
                <img src="images/banner-itaul-atacadao.png" alt="Atacadao - Slide 3">
            </a>
            <!-- Slide 4 - substitua o src e o href pelos seus -->
            <a href="#linkbanner4#" class="slide">
                <img src="images/banner-itaul-passai.png" alt="Assai Banner 4">
            </a>
            <!-- Slide 5 - substitua o src e o href pelos seus -->
            <a href="#linkbanner5#" class="slide">
                <img src="images/banner-itaul-carredour.png" alt="Carrefour Banner 5">
            </a>
        </div>
    </div>
    <div class="slider-nav">
        <button class="slider-btn prev-btn" aria-label="Anterior"><i class="fas fa-chevron-left"></i></button>
        <button class="slider-btn next-btn" aria-label="Próximo"><i class="fas fa-chevron-right"></i></button>
    </div>
    <div class="slider-dots">
        <div class="dot active" data-index="0"></div>
        <div class="dot" data-index="1"></div>
        <div class="dot" data-index="2"></div>
        <div class="dot" data-index="3"></div>
        <div class="dot" data-index="4"></div>
    </div>
</div>

<!-- ==== Descritivo do Blog (entre banner e filtros) ==== -->
<div class="blog-intro">
    <strong>Blog LiberaCash</strong>
    <span>Dicas para sua saúde financeira, cartões e empréstimos.</span>
</div>

<!-- ==== Conteúdo ==== -->
<div class="container">
    <?php if ($current_post): // Post individual ?>
        <article class="single-post">
    <img class="single-post-image" src="<?php echo htmlspecialchars($current_post['imagem'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($current_post['titulo'], ENT_QUOTES, 'UTF-8'); ?>">
    <span class="post-category"><?php echo htmlspecialchars($current_post['categoria'], ENT_QUOTES, 'UTF-8'); ?></span>
            <div class="post-meta">
    <i class="far fa-user"></i> <?php echo htmlspecialchars(isset($current_post['autor']) ? $current_post['autor'] : 'Redação LiberaCash', ENT_QUOTES, 'UTF-8'); ?>
    &nbsp;·&nbsp;
    <i class="far fa-calendar-alt"></i> <?php echo htmlspecialchars($current_post['data'], ENT_QUOTES, 'UTF-8'); ?>
    &nbsp;·&nbsp;
    <i class="far fa-clock"></i> <?php echo max(1, (int)ceil(str_word_count(strip_tags($current_post['conteudo'])) / 200)); ?> min de leitura
</div>
            <div class="post-full-content">
                <p><?php echo nl2br(htmlspecialchars($current_post['conteudo'], ENT_QUOTES, 'UTF-8')); ?></p>
            </div>

            <div class="post-cta">
                <h4>Gostou do conteúdo?</h4>
                <p>Compare propostas de empréstimo em minutos, 100% online e sem compromisso.</p>
                <button class="blog-cta-btn btn-open-modal"
                        data-title="Qual o melhor&nbsp;<span>crédito para você?</span>"
                        data-subtitle="Descubra quanto você tem disponível para receber e tenha o dinheiro na sua conta!"
                        data-icon="">Simule seu empréstimo agora</button>
            </div>

            <?php
                $url_atual = "https://libera.cash/blog/" . urlencode($current_post['slug']) . "/";
                $texto_share = urlencode($current_post['titulo'] . ' - ');
            ?>
            <div class="share-buttons">
                <span>Compartilhar:</span>
                <a class="share-btn share-whatsapp" href="https://api.whatsapp.com/send?text=<?php echo $texto_share . urlencode($url_atual); ?>" target="_blank" rel="noopener" aria-label="Compartilhar no WhatsApp"><i class="fab fa-whatsapp"></i></a>
                <a class="share-btn share-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($url_atual); ?>" target="_blank" rel="noopener" aria-label="Compartilhar no Facebook"><i class="fab fa-facebook-f"></i></a>
                <a class="share-btn share-linkedin" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode($url_atual); ?>" target="_blank" rel="noopener" aria-label="Compartilhar no LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a class="share-btn share-twitter" href="https://twitter.com/intent/tweet?url=<?php echo urlencode($url_atual); ?>&text=<?php echo urlencode($current_post['titulo']); ?>" target="_blank" rel="noopener" aria-label="Compartilhar no X"><i class="fab fa-x-twitter"></i></a>
            </div>

            <?php
                $relacionados = [];
                foreach ($posts as $p) {
                    if ($p['slug'] !== $current_post['slug'] && $p['categoria'] === $current_post['categoria']) {
                        $relacionados[] = $p;
                    }
                    if (count($relacionados) >= 3) break;
                }
            ?>
            <?php if (!empty($relacionados)): ?>
            <div class="related-posts">
                <h3>Leia também</h3>
                <div class="related-grid">
                    <?php foreach ($relacionados as $r): ?>
                        <a class="related-card" href="/blog/<?php echo urlencode($r['slug']); ?>/">
    <img class="related-image" src="<?php echo htmlspecialchars($r['imagem'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($r['titulo'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
    <div class="related-info">
                                <small><?php echo htmlspecialchars($r['categoria'], ENT_QUOTES, 'UTF-8'); ?></small>
                                <h4><?php echo htmlspecialchars($r['titulo'], ENT_QUOTES, 'UTF-8'); ?></h4>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <a href="/blog/" class="back-to-blog">&larr; Voltar para o Blog</a>
        </article>
    <?php else: // Listagem ?>
        <div class="filter-bar">
            <a class="filter-btn <?php echo !$categoria_filtro ? 'active' : ''; ?>" href="/blog/">Todos</a>
            <?php foreach ($categorias as $cat): ?>
                <a class="filter-btn <?php echo $categoria_filtro === $cat ? 'active' : ''; ?>"
                   href="/blog/?categoria=<?php echo urlencode($cat); ?>">
                    <?php echo htmlspecialchars($cat, ENT_QUOTES, 'UTF-8'); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="blog-cta-banner">
            <div class="blog-cta-text">
                <h3>Precisa de dinheiro rápido?</h3>
                <p>Compare propostas de empréstimo em minutos, 100% online e sem compromisso.</p>
            </div>
            <button class="blog-cta-btn btn-open-modal"
                    data-title="Qual o melhor&nbsp;<span>crédito para você?</span>"
                    data-subtitle="Descubra quanto você tem disponível para receber e tenha o dinheiro na sua conta!"
                    data-icon="">Simule seu empréstimo agora</button>
        </div>

        <div class="blog-grid">
            <?php if (empty($posts_filtrados)): ?>
                <p class="no-results">Nenhum post encontrado para essa categoria.</p>
            <?php else: ?>
                <?php foreach ($posts_filtrados as $post): ?>
                <article class="post-card">
    <img class="post-image" src="<?php echo htmlspecialchars($post['imagem'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($post['titulo'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
    <div class="post-content">
                        <span class="post-category"><?php echo htmlspecialchars($post['categoria'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <h2 class="post-title"><?php echo htmlspecialchars($post['titulo'], ENT_QUOTES, 'UTF-8'); ?></h2>
                        <p class="post-excerpt"><?php echo htmlspecialchars($post['resumo'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <div class="post-footer">
    <span>
        <i class="far fa-calendar-alt"></i> <?php echo htmlspecialchars($post['data'], ENT_QUOTES, 'UTF-8'); ?>
        &nbsp;·&nbsp;
        <i class="far fa-clock"></i> <?php echo max(1, (int)ceil(str_word_count(strip_tags($post['conteudo'])) / 200)); ?> min de leitura
    </span>
    <a href="/blog/<?php echo urlencode($post['slug']); ?>/" class="btn-read">LER MAIS</a>
</div>
                    </div>
                </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<!-- ==== Footer (mesma estrutura da home) ==== -->
<footer class="footer">
    <div class="footer-container">
        <img src="images/logo-footer.png" class="footer-logo" alt="LiberaCash">

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

<?php include 'modal-credito.php'; ?>

<!-- ==== Scripts ==== -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
$(document).ready(function(){

    // Menu Hamburger Mobile
    $('.hamburger').click(function(){
        $('.nav-menu').slideToggle();
    });

    // Carrossel de banners (mesma lógica do home.php)
    let currentIndex = 0;
    const slideCount = $('.slide').length;
    let slideInterval;

    function updateSlider() {
        const percentage = -(currentIndex * 100);
        $('.slider-wrapper').css('transform', `translateX(${percentage}%)`);
        $('.dot').removeClass('active');
        $(`.dot[data-index="${currentIndex}"]`).addClass('active');
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

    $('.next-btn').click(function() { nextSlide(); startAutoSlide(); });
    $('.prev-btn').click(function() { prevSlide(); startAutoSlide(); });
    $('.dot').click(function() {
        currentIndex = parseInt($(this).attr('data-index'));
        updateSlider();
        startAutoSlide();
    });

    startAutoSlide();
});
</script>

</body>
</html>
