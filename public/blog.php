<?php
/**
 * Blog LiberaCash - blog.php
 * Layout editorial: destaque em hero, grade de posts + sidebar com
 * "Mais lidos" (ranqueado por views reais) e categorias.
 * Header/footer sincronizados com o restante do site (brand-tokens.css).
 *
 * Conteúdo vem da tabela blog_posts. Posts manuais (admin_blog) usam
 * texto puro (nl2br); posts gerados pelo pipeline de IA já vêm com
 * HTML de verdade (<p>...</p>) — por isso a detecção de tag abaixo.
 */

require_once __DIR__ . '/db.php'; // já deixa $pdo pronto

function lc_renderizar_conteudo(string $conteudo): string
{
    if (strpos($conteudo, '<') !== false) {
        return $conteudo; // já é HTML (gerado pelo pipeline de IA ou editado manualmente com tags)
    }
    return '<p>' . nl2br(htmlspecialchars($conteudo, ENT_QUOTES, 'UTF-8')) . '</p>';
}

function lc_tempo_leitura(string $conteudoHtml): int
{
    return max(1, (int)ceil(str_word_count(strip_tags($conteudoHtml)) / 200));
}

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
        $pdo->prepare("UPDATE blog_posts SET views = views + 1 WHERE slug = :slug")
            ->execute(['slug' => $slug]);
    }
}
if ($slug !== null && $current_post === null) {
    header("Location: /blog/", true, 302);
    exit;
}

// --- Todos os posts publicados (listagem, filtro, relacionados, hero) ---
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

// --- Mais lidos (ranking real por views) ---
$mais_lidos = $pdo->query(
    "SELECT slug, titulo, views FROM blog_posts WHERE status = 'publicado' ORDER BY views DESC, created_at DESC LIMIT 5"
)->fetchAll();

// --- Filtro por categoria ---
$categorias = array_values(array_unique(array_column($posts, 'categoria')));
$categoria_filtro = isset($_GET['categoria']) ? $_GET['categoria'] : null;

$posts_filtrados = $posts;
if ($categoria_filtro) {
    $posts_filtrados = array_values(array_filter($posts, function($p) use ($categoria_filtro) {
        return $p['categoria'] === $categoria_filtro;
    }));
}

// --- Post em destaque (hero) — só na listagem sem filtro ---
$post_destaque = (!$categoria_filtro && !empty($posts)) ? $posts[0] : null;
$posts_grid = $posts_filtrados;
if ($post_destaque) {
    $posts_grid = array_values(array_filter($posts_grid, function($p) use ($post_destaque) {
        return $p['slug'] !== $post_destaque['slug'];
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
        <meta property="og:image" content="<?php echo htmlspecialchars($current_post['imagem'] ?: 'https://libera.cash/images/logo-full-dark.png', ENT_QUOTES, 'UTF-8'); ?>">
        <meta property="og:type" content="article">
        <meta property="og:url" content="https://libera.cash/blog/<?php echo urlencode($current_post["slug"]); ?>/">
        <meta name="twitter:card" content="summary_large_image">
    <?php else: ?>
        <meta name="description" content="Blog LiberaCash — Notícias e dicas de crédito, empréstimos e saúde financeira para o brasileiro.">
        <meta property="og:title" content="Blog LiberaCash">
        <meta property="og:description" content="Notícias e dicas de crédito, empréstimos e saúde financeira.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://libera.cash/blog/">
    <?php endif; ?>

    <?php if ($current_post): ?>
    <link rel="canonical" href="https://libera.cash/blog/<?php echo urlencode($current_post["slug"]); ?>/">
<?php else: ?>
    <link rel="canonical" href="https://libera.cash/blog/">
<?php endif; ?>
    <link rel="alternate" type="application/rss+xml" title="LiberaCash Blog" href="/blog/feed.xml">

<?php if ($current_post):
        $partes_data = explode('/', $current_post['data']);
        $data_iso = isset($partes_data[2]) ? $partes_data[2] . '-' . $partes_data[1] . '-' . $partes_data[0] . 'T00:00:00-03:00' : date('c');
        $autor_post = isset($current_post['autor']) ? $current_post['autor'] : 'Redação LiberaCash';

        $jsonld = [
            "@context" => "https://schema.org",
            "@type" => "BlogPosting",
            "headline" => $current_post['titulo'],
            "description" => $current_post['resumo'],
            "image" => $current_post['imagem'] ?: 'https://libera.cash/images/logo-full-dark.png',
            "datePublished" => $data_iso,
            "dateModified" => $data_iso,
            "author" => [
                "@type" => "Organization",
                "name" => $autor_post,
                "url" => "https://libera.cash/blog/"
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => "LiberaCash",
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => "https://libera.cash/images/logo.png"
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

    <link href="/images/favicon.png" rel="shortcut icon" type="image/x-icon">
    <link href="/images/webclip.png" rel="apple-touch-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/css/brand-tokens.css?v=3">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--lc-font-body);
            color: var(--lc-text-dark);
            background-color: #FAFDFB;
            overflow-x: hidden;
            padding-top: 32px;
        }

        /* ==== Top bar / Header (padrão do site) ==== */
        .top-bar {
            background: var(--lc-gradient-dark);
            padding: 0; height: 32px; display: flex; align-items: center; justify-content: center;
            text-align: center; font-size: 11px; color: var(--lc-off-white);
            position: fixed; top: 0; left: 0; width: 100%; z-index: 1001;
        }
        .header { background: var(--lc-white); padding: 14px 0; position: sticky; top: 32px; z-index: 1000; box-shadow: 0 1px 0 var(--lc-border); }
        .header-container { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 20px; }
        .logo img { height: 46px; }
        .nav-menu { display: flex; list-style: none; gap: 4px; }
        .nav-menu a { color: var(--lc-text-muted); text-decoration: none; font-size: 14px; font-weight: 600; font-family: var(--lc-font-body); padding: 8px 14px; border-radius: var(--lc-radius-full); transition: all .2s; }
        .nav-menu a:hover, .nav-menu a.active { background: var(--lc-surface); color: var(--lc-green-900); }
        .hamburger { display: none; cursor: pointer; color: var(--lc-text-dark); font-size: 24px; }

        /* ==== Banner slider ==== */
        .banner-slider-container { max-width: 684px; margin: 26px auto 0 auto; padding: 0 20px; }
        .banner-slider { position: relative; width: 100%; max-height: 156px; border-radius: var(--lc-radius-md); overflow: hidden; box-shadow: var(--lc-shadow-card); }
        .slider-wrapper { display: flex; transition: transform 0.5s ease-in-out; }
        .slide { flex: 0 0 100%; display: block; text-decoration: none; }
        .slide img { width: 100%; height: auto; max-height: 156px; object-fit: cover; display: block; }
        .slider-nav { position: absolute; top: 50%; width: calc(100% - 20px); left: 10px; display: flex; justify-content: space-between; transform: translateY(-50%); pointer-events: none; z-index: 10; }
        .slider-btn { background: rgba(0,0,0,.35); color: #fff; border: none; width: 32px; height: 32px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; pointer-events: auto; font-size: 12px; }
        .slider-btn:hover { background: rgba(0,0,0,.6); }
        .slider-dots { display: flex; justify-content: center; gap: 6px; margin-top: 10px; }
        .dot { width: 8px; height: 8px; border-radius: 50%; background: var(--lc-border); cursor: pointer; }
        .dot.active { background: var(--lc-green-600); width: 20px; border-radius: 4px; }

        /* ==== Intro ==== */
        .blog-intro { text-align: center; margin: 32px auto 8px auto; padding: 0 20px; max-width: 900px; }
        .blog-eyebrow { display: inline-block; font-family: var(--lc-font-display); font-size: 12px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--lc-green-700); margin-bottom: 8px; }
        .blog-intro h1 { font-family: var(--lc-font-display); font-size: 34px; font-weight: 700; color: var(--lc-text-dark); letter-spacing: -0.5px; }
        .blog-intro p { font-size: 15px; color: var(--lc-text-muted); margin-top: 8px; }

        .filter-bar { display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; margin: 22px auto 36px auto; padding: 0 20px; }
        .filter-btn { padding: 8px 18px; border-radius: var(--lc-radius-full); background: var(--lc-white); color: var(--lc-text-dark); text-decoration: none; font-size: 13px; font-weight: 600; border: 1.5px solid var(--lc-border); transition: all .2s; }
        .filter-btn:hover, .filter-btn.active { background: var(--lc-green-600); color: #fff; border-color: var(--lc-green-600); }

        .container { max-width: 1200px; margin: 0 auto 60px auto; padding: 0 20px; }

        /* ==== Hero (post em destaque) ==== */
        .hero-post { display: grid; grid-template-columns: 1.1fr 1fr; gap: 36px; align-items: stretch; background: var(--lc-gradient-dark); border-radius: var(--lc-radius-lg); overflow: hidden; margin-bottom: 48px; box-shadow: var(--lc-shadow-card); }
        .hero-post-image { position: relative; min-height: 260px; background: linear-gradient(135deg, var(--lc-bg-dark-700), var(--lc-bg-dark-900)); }
        .hero-post-image img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .hero-post-image::after { content: ""; position: absolute; inset: 0; background: linear-gradient(180deg, transparent 40%, rgba(8,26,15,.55) 100%); }
        .hero-post-body { padding: 40px 44px 40px 8px; display: flex; flex-direction: column; justify-content: center; }
        .hero-tag { display: inline-flex; align-items: center; gap: 6px; align-self: flex-start; background: rgba(131,225,103,.16); color: var(--lc-green-400); font-size: 11px; font-weight: 700; letter-spacing: 0.8px; text-transform: uppercase; padding: 6px 14px; border-radius: var(--lc-radius-full); margin-bottom: 16px; }
        .hero-post-body h2 { font-family: var(--lc-font-display); font-size: 30px; line-height: 1.2; font-weight: 700; color: #fff; margin-bottom: 14px; }
        .hero-post-body p { font-size: 15px; line-height: 1.6; color: var(--lc-off-white); opacity: .85; margin-bottom: 22px; }
        .hero-meta { font-size: 12px; color: var(--lc-off-white); opacity: .65; margin-bottom: 20px; }
        .hero-read-btn { display: inline-flex; align-items: center; gap: 8px; align-self: flex-start; background: var(--lc-gradient-brand); color: var(--lc-text-dark); font-weight: 700; font-size: 14px; padding: 12px 24px; border-radius: var(--lc-radius-full); text-decoration: none; transition: transform .2s; }
        .hero-read-btn:hover { transform: translateX(3px); }

        /* ==== Layout: grade + sidebar ==== */
        .blog-layout { display: grid; grid-template-columns: 1fr 320px; gap: 40px; align-items: start; }

        .blog-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 26px; }
        .post-card { background: var(--lc-white); border-radius: var(--lc-radius-md); overflow: hidden; box-shadow: var(--lc-shadow-card); transition: transform .25s ease, box-shadow .25s ease; display: flex; flex-direction: column; text-decoration: none; color: inherit; border: 1px solid var(--lc-border); }
        .post-card:hover { transform: translateY(-4px); box-shadow: 0 12px 28px rgba(12,47,27,.12); }
        .post-image-wrap { position: relative; height: 160px; background: var(--lc-surface); }
        .post-image-wrap img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .post-image-fallback { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: var(--lc-gradient-brand); }
        .post-image-fallback i { font-size: 28px; color: var(--lc-green-900); opacity: .5; }
        .post-category { position: absolute; bottom: 10px; left: 10px; background: rgba(8,26,15,.75); color: var(--lc-off-white); font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .6px; padding: 5px 10px; border-radius: var(--lc-radius-full); }
        .post-content { padding: 18px 20px 20px 20px; flex-grow: 1; display: flex; flex-direction: column; }
        .post-title { font-family: var(--lc-font-display); font-size: 16px; font-weight: 700; line-height: 1.35; color: var(--lc-text-dark); margin-bottom: 8px; }
        .post-excerpt { color: var(--lc-text-muted); font-size: 13px; line-height: 1.6; margin-bottom: 16px; flex-grow: 1; }
        .post-footer { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--lc-border); padding-top: 12px; font-size: 11px; color: var(--lc-gray-500); }
        .no-results { text-align: center; padding: 50px 20px; color: var(--lc-text-muted); grid-column: 1 / -1; background: var(--lc-surface); border-radius: var(--lc-radius-md); }

        /* ==== Sidebar ==== */
        .sidebar-card { background: var(--lc-white); border: 1px solid var(--lc-border); border-radius: var(--lc-radius-md); padding: 24px; margin-bottom: 24px; }
        .sidebar-title { font-family: var(--lc-font-display); font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: .6px; color: var(--lc-text-dark); margin-bottom: 18px; display: flex; align-items: center; gap: 8px; }
        .sidebar-title i { color: var(--lc-green-600); }

        .ranked-list { list-style: none; display: flex; flex-direction: column; gap: 16px; }
        .ranked-item { display: flex; align-items: flex-start; gap: 12px; text-decoration: none; }
        .ranked-num { font-family: var(--lc-font-display); font-size: 30px; font-weight: 700; color: transparent; -webkit-text-stroke: 1.5px var(--lc-green-400); line-height: 1; flex-shrink: 0; width: 32px; }
        .ranked-item:hover .ranked-num { -webkit-text-stroke: 1.5px var(--lc-green-600); }
        .ranked-title { font-size: 13px; font-weight: 600; color: var(--lc-text-dark); line-height: 1.4; }
        .ranked-item:hover .ranked-title { color: var(--lc-green-700); }
        .ranked-views { font-size: 11px; color: var(--lc-gray-500); margin-top: 3px; }

        .category-cloud { display: flex; flex-wrap: wrap; gap: 8px; }
        .category-cloud a { font-size: 12px; font-weight: 600; color: var(--lc-text-muted); background: var(--lc-surface); padding: 6px 12px; border-radius: var(--lc-radius-full); text-decoration: none; border: 1px solid var(--lc-border); }
        .category-cloud a:hover { background: var(--lc-green-600); color: #fff; border-color: var(--lc-green-600); }

        .sidebar-cta { background: var(--lc-gradient-dark); color: #fff; border-radius: var(--lc-radius-md); padding: 26px 22px; text-align: center; position: sticky; top: 96px; }
        .sidebar-cta h4 { font-family: var(--lc-font-display); font-size: 17px; margin-bottom: 8px; }
        .sidebar-cta p { font-size: 13px; opacity: .8; margin-bottom: 18px; line-height: 1.5; }
        .sidebar-cta-btn { display: inline-block; width: 100%; background: var(--lc-gradient-brand); color: var(--lc-text-dark); font-weight: 700; font-size: 13.5px; padding: 12px; border-radius: var(--lc-radius-full); border: none; cursor: pointer; }

        /* ==== Post individual ==== */
        .single-post-wrap { max-width: 760px; margin: 0 auto; }
        .breadcrumbs { font-size: 13px; color: var(--lc-text-muted); margin-bottom: 20px; }
        .breadcrumbs a { color: var(--lc-text-muted); text-decoration: none; }
        .breadcrumbs a:hover { color: var(--lc-green-700); text-decoration: underline; }
        .breadcrumbs .sep { margin: 0 6px; color: var(--lc-border); }
        .single-post-category { display: inline-block; background: var(--lc-surface); color: var(--lc-green-700); font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .6px; padding: 6px 14px; border-radius: var(--lc-radius-full); margin-bottom: 16px; }
        .single-post h1 { font-family: var(--lc-font-display); font-size: 2.1rem; line-height: 1.25; color: var(--lc-text-dark); margin-bottom: 16px; letter-spacing: -0.5px; }
        .single-post .post-meta { font-size: 13px; color: var(--lc-text-muted); margin-bottom: 28px; display: flex; align-items: center; flex-wrap: wrap; gap: 4px; }
        .single-post-image { width: 100%; height: 340px; object-fit: cover; border-radius: var(--lc-radius-md); margin-bottom: 32px; display: block; }
        .single-post .post-full-content { font-size: 17px; line-height: 1.85; color: var(--lc-text-dark); }
        .single-post .post-full-content p { margin-bottom: 20px; }
        .single-post .post-full-content em { color: var(--lc-text-muted); font-size: 14px; display: block; border-left: 3px solid var(--lc-green-400); padding-left: 14px; font-style: normal; }
        .single-post .post-full-content em a { color: var(--lc-green-700); font-weight: 600; }

        .post-cta { background: var(--lc-surface); border: 1px solid var(--lc-border); border-radius: var(--lc-radius-md); padding: 30px; margin: 40px 0; text-align: center; }
        .post-cta h4 { font-family: var(--lc-font-display); font-size: 1.15rem; margin-bottom: 8px; color: var(--lc-text-dark); }
        .post-cta p { font-size: 14px; color: var(--lc-text-muted); margin-bottom: 18px; }
        .post-cta-btn { background: var(--lc-gradient-brand); color: var(--lc-text-dark); padding: 13px 28px; border-radius: var(--lc-radius-full); font-weight: 700; font-size: 13.5px; border: none; cursor: pointer; }

        .share-buttons { margin-top: 32px; padding-top: 22px; border-top: 1px solid var(--lc-border); display: flex; gap: 10px; flex-wrap: wrap; align-items: center; }
        .share-buttons span { font-size: 13px; color: var(--lc-text-muted); margin-right: 4px; font-weight: 600; }
        .share-btn { display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: 50%; color: #fff; text-decoration: none; font-size: 15px; transition: transform .2s; }
        .share-btn:hover { transform: scale(1.1); }
        .share-whatsapp { background: #25D366; }
        .share-facebook { background: #1877F2; }
        .share-linkedin { background: #0A66C2; }
        .share-twitter { background: #000; }

        .related-posts { margin-top: 56px; }
        .related-posts h3 { font-family: var(--lc-font-display); font-size: 1.25rem; margin-bottom: 20px; color: var(--lc-text-dark); }
        .related-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px; }

        .back-to-blog { display: inline-flex; align-items: center; gap: 6px; margin-top: 36px; color: var(--lc-green-700); text-decoration: none; font-weight: 600; font-size: 14px; }
        .back-to-blog:hover { gap: 10px; }

        /* ==== Footer (padrão do site) ==== */
        .footer { padding: 50px 0; text-align: center; background-color: var(--lc-white); border-top: 1px solid var(--lc-border); }
        .footer-container { max-width: 1000px; margin: 0 auto; padding: 0 20px; display: flex; flex-direction: column; align-items: center; }
        .footer-logo { height: 52px; margin-bottom: 25px; }
        .footer-social { display: flex; gap: 15px; margin-bottom: 25px; justify-content: center; }
        .footer-social a { display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background-color: var(--lc-green-600); color: #fff; font-size: 16px; text-decoration: none; transition: all .3s ease; border-radius: 50%; }
        .footer-social a:hover { background-color: var(--lc-green-900); transform: translateY(-2px); }
        .footer-text { font-size: 12px; color: var(--lc-text-muted); line-height: 1.6; max-width: 720px; margin: 0 auto; text-align: center; }
        .footer-copy { font-size: 11px; color: var(--lc-gray-500); margin-top: 16px; }

        /* ==== Media queries ==== */
        @media (max-width: 900px) {
            .blog-layout { grid-template-columns: 1fr; }
            .sidebar-cta { position: static; }
            .hero-post { grid-template-columns: 1fr; }
            .hero-post-image { min-height: 200px; }
            .hero-post-body { padding: 28px; }
        }
        @media (max-width: 768px) {
            .nav-menu { display: none; }
            .hamburger { display: block; }
            .blog-intro h1 { font-size: 26px; }
            .single-post h1 { font-size: 1.6rem; }
            .single-post-image { height: 220px; }
        }
    </style>
</head>
<body>

<div class="top-bar">
    Atenção! A LiberaCash não cobra nenhum depósito antecipado para a liberação de empréstimo.
</div>

<header class="header">
    <div class="header-container">
        <div class="logo"><a href="/"><img src="/images/logo.png?v=2" alt="LiberaCash"></a></div>
        <nav class="nav-menu">
            <a href="/">Crédito Pessoal</a>
            <a href="/cartoes/">Cartão de Crédito</a>
            <a href="/blog/" class="active">Blog</a>
            <a href="/sobre/">Sobre</a>
            <a href="/contato/">Contato</a>
        </nav>
        <div class="hamburger"><i class="fas fa-bars"></i></div>
    </div>
</header>

<div class="banner-slider-container">
    <div class="banner-slider">
        <div class="slider-wrapper">
            <a href="#linkbanner#" class="slide"><img src="/images/banner-juvo-creditovc.png" alt="Empréstimo pessoal"></a>
            <a href="https://www.itau.com.br/cartoes/escolha/g/azul-visa-infinite?utm_source=lzo&utm_medium=affiliate&utm_campaign=gl-aff-cartoes-conversao-azul-infinite&cpg_s=sliceafl&utmgl=utm_camp-{campaign.id}" class="slide"><img src="/images/banner-itaul-infinity.png" alt="Itaú Azul Visa Infinite"></a>
            <a href="#linkbanner#" class="slide"><img src="/images/banner-itaul-atacadao.png" alt="Oferta parceira"></a>
            <a href="#linkbanner4#" class="slide"><img src="/images/banner-itaul-passai.png" alt="Oferta parceira"></a>
            <a href="#linkbanner5#" class="slide"><img src="/images/banner-itaul-carredour.png" alt="Oferta parceira"></a>
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

<?php if (!$current_post): ?>
<div class="blog-intro">
    <span class="blog-eyebrow">Blog LiberaCash</span>
    <h1>Notícias e dicas pra sua vida financeira</h1>
    <p>Crédito, empréstimos e organização financeira, explicados de forma simples.</p>
</div>

<div class="filter-bar">
    <a class="filter-btn <?php echo !$categoria_filtro ? 'active' : ''; ?>" href="/blog/">Todos</a>
    <?php foreach ($categorias as $cat): ?>
        <a class="filter-btn <?php echo $categoria_filtro === $cat ? 'active' : ''; ?>" href="/blog/?categoria=<?php echo urlencode($cat); ?>">
            <?php echo htmlspecialchars($cat, ENT_QUOTES, 'UTF-8'); ?>
        </a>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<div class="container">
    <?php if ($current_post): // ==================== POST INDIVIDUAL ==================== ?>
        <div class="single-post-wrap">
            <div class="breadcrumbs">
                <a href="/">Início</a><span class="sep">/</span><a href="/blog/">Blog</a><span class="sep">/</span>
                <?php echo htmlspecialchars($current_post['titulo'], ENT_QUOTES, 'UTF-8'); ?>
            </div>

            <article class="single-post">
                <span class="single-post-category"><?php echo htmlspecialchars($current_post['categoria'], ENT_QUOTES, 'UTF-8'); ?></span>
                <h1><?php echo htmlspecialchars($current_post['titulo'], ENT_QUOTES, 'UTF-8'); ?></h1>
                <div class="post-meta">
                    <i class="far fa-user"></i>&nbsp;<?php echo htmlspecialchars($current_post['autor'], ENT_QUOTES, 'UTF-8'); ?>
                    &nbsp;·&nbsp;<i class="far fa-calendar-alt"></i>&nbsp;<?php echo htmlspecialchars($current_post['data'], ENT_QUOTES, 'UTF-8'); ?>
                    &nbsp;·&nbsp;<i class="far fa-clock"></i>&nbsp;<?php echo lc_tempo_leitura($current_post['conteudo']); ?> min de leitura
                </div>

                <?php if ($current_post['imagem']): ?>
                <img class="single-post-image" src="<?php echo htmlspecialchars($current_post['imagem'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($current_post['titulo'], ENT_QUOTES, 'UTF-8'); ?>">
                <?php endif; ?>

                <div class="post-full-content">
                    <?php echo lc_renderizar_conteudo($current_post['conteudo']); ?>
                </div>

                <div class="post-cta">
                    <h4>Gostou do conteúdo?</h4>
                    <p>Compare propostas de empréstimo em minutos, 100% online e sem compromisso.</p>
                    <button class="post-cta-btn btn-open-modal"
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
                    <a class="share-btn share-whatsapp" href="https://api.whatsapp.com/send?text=<?php echo $texto_share . urlencode($url_atual); ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    <a class="share-btn share-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($url_atual); ?>" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a class="share-btn share-linkedin" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode($url_atual); ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a class="share-btn share-twitter" href="https://twitter.com/intent/tweet?url=<?php echo urlencode($url_atual); ?>&text=<?php echo urlencode($current_post['titulo']); ?>" target="_blank" rel="noopener" aria-label="X"><i class="fab fa-x-twitter"></i></a>
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
                            <a class="post-card" href="/blog/<?php echo urlencode($r['slug']); ?>/">
                                <div class="post-image-wrap">
                                    <?php if ($r['imagem']): ?>
                                        <img src="<?php echo htmlspecialchars($r['imagem'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($r['titulo'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                                    <?php else: ?>
                                        <div class="post-image-fallback"><i class="fas fa-newspaper"></i></div>
                                    <?php endif; ?>
                                    <span class="post-category"><?php echo htmlspecialchars($r['categoria'], ENT_QUOTES, 'UTF-8'); ?></span>
                                </div>
                                <div class="post-content">
                                    <h2 class="post-title"><?php echo htmlspecialchars($r['titulo'], ENT_QUOTES, 'UTF-8'); ?></h2>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <a href="/blog/" class="back-to-blog">&larr; Voltar para o Blog</a>
            </article>
        </div>

    <?php else: // ==================== LISTAGEM ==================== ?>

        <?php if ($post_destaque): ?>
        <a href="/blog/<?php echo urlencode($post_destaque['slug']); ?>/" style="text-decoration:none;">
        <div class="hero-post">
            <div class="hero-post-image">
                <?php if ($post_destaque['imagem']): ?>
                    <img src="<?php echo htmlspecialchars($post_destaque['imagem'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($post_destaque['titulo'], ENT_QUOTES, 'UTF-8'); ?>">
                <?php endif; ?>
            </div>
            <div class="hero-post-body">
                <span class="hero-tag"><i class="fas fa-bolt"></i> Em destaque</span>
                <h2><?php echo htmlspecialchars($post_destaque['titulo'], ENT_QUOTES, 'UTF-8'); ?></h2>
                <p><?php echo htmlspecialchars($post_destaque['resumo'], ENT_QUOTES, 'UTF-8'); ?></p>
                <div class="hero-meta"><?php echo htmlspecialchars($post_destaque['categoria'], ENT_QUOTES, 'UTF-8'); ?> · <?php echo htmlspecialchars($post_destaque['data'], ENT_QUOTES, 'UTF-8'); ?></div>
                <span class="hero-read-btn">Ler matéria completa <i class="fas fa-arrow-right"></i></span>
            </div>
        </div>
        </a>
        <?php endif; ?>

        <div class="blog-layout">
            <div class="blog-grid">
                <?php if (empty($posts_grid) && empty($post_destaque)): ?>
                    <p class="no-results">Ainda não temos posts publicados nessa categoria. Volte em breve!</p>
                <?php else: ?>
                    <?php foreach ($posts_grid as $post): ?>
                    <a class="post-card" href="/blog/<?php echo urlencode($post['slug']); ?>/">
                        <div class="post-image-wrap">
                            <?php if ($post['imagem']): ?>
                                <img src="<?php echo htmlspecialchars($post['imagem'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($post['titulo'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                            <?php else: ?>
                                <div class="post-image-fallback"><i class="fas fa-newspaper"></i></div>
                            <?php endif; ?>
                            <span class="post-category"><?php echo htmlspecialchars($post['categoria'], ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                        <div class="post-content">
                            <h2 class="post-title"><?php echo htmlspecialchars($post['titulo'], ENT_QUOTES, 'UTF-8'); ?></h2>
                            <p class="post-excerpt"><?php echo htmlspecialchars($post['resumo'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <div class="post-footer">
                                <span><i class="far fa-calendar-alt"></i> <?php echo htmlspecialchars($post['data'], ENT_QUOTES, 'UTF-8'); ?></span>
                                <span><?php echo lc_tempo_leitura($post['conteudo']); ?> min</span>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <aside>
                <?php if (!empty($mais_lidos)): ?>
                <div class="sidebar-card">
                    <div class="sidebar-title"><i class="fas fa-fire"></i> Mais lidos</div>
                    <ul class="ranked-list">
                        <?php foreach ($mais_lidos as $i => $ml): ?>
                        <li>
                            <a class="ranked-item" href="/blog/<?php echo urlencode($ml['slug']); ?>/">
                                <span class="ranked-num"><?php echo str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT); ?></span>
                                <span>
                                    <span class="ranked-title"><?php echo htmlspecialchars($ml['titulo'], ENT_QUOTES, 'UTF-8'); ?></span>
                                    <span class="ranked-views"><?php echo (int)$ml['views']; ?> leituras</span>
                                </span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php if (!empty($categorias)): ?>
                <div class="sidebar-card">
                    <div class="sidebar-title"><i class="fas fa-tags"></i> Categorias</div>
                    <div class="category-cloud">
                        <?php foreach ($categorias as $cat): ?>
                            <a href="/blog/?categoria=<?php echo urlencode($cat); ?>"><?php echo htmlspecialchars($cat, ENT_QUOTES, 'UTF-8'); ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="sidebar-cta">
                    <h4>Precisa de dinheiro rápido?</h4>
                    <p>Compare propostas de empréstimo 100% online, sem compromisso.</p>
                    <button class="sidebar-cta-btn btn-open-modal"
                            data-title="Qual o melhor&nbsp;<span>crédito para você?</span>"
                            data-subtitle="Descubra quanto você tem disponível para receber e tenha o dinheiro na sua conta!"
                            data-icon="">Simular agora</button>
                </div>
            </aside>
        </div>
    <?php endif; ?>
</div>

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
            LiberaCash&reg; é um site de comparação e correspondente de instituições financeiras parceiras, não é uma instituição financeira e não realiza empréstimos diretamente. As condições de crédito (taxas, prazos e valores) são definidas exclusivamente pela instituição parceira responsável pela proposta, mediante análise de crédito. A aprovação está sujeita a análise cadastral.
        </div>
        <p class="footer-copy">&copy; <?php echo date('Y'); ?> LiberaCash&reg; — Todos os direitos reservados.</p>
    </div>
</footer>

<?php include 'modal-credito.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('.hamburger').click(function(){
        $('.nav-menu').slideToggle();
    });

    let currentIndex = 0;
    const slideCount = $('.slide').length;
    let slideInterval;

    function updateSlider() {
        $('.slider-wrapper').css('transform', `translateX(${-(currentIndex * 100)}%)`);
        $('.dot').removeClass('active');
        $(`.dot[data-index="${currentIndex}"]`).addClass('active');
    }
    function nextSlide() { currentIndex = (currentIndex + 1) % slideCount; updateSlider(); }
    function prevSlide() { currentIndex = (currentIndex - 1 + slideCount) % slideCount; updateSlider(); }
    function startAutoSlide() { clearInterval(slideInterval); slideInterval = setInterval(nextSlide, 4000); }

    $('.next-btn').click(function(){ nextSlide(); startAutoSlide(); });
    $('.prev-btn').click(function(){ prevSlide(); startAutoSlide(); });
    $('.dot').click(function(){ currentIndex = parseInt($(this).attr('data-index')); updateSlider(); startAutoSlide(); });

    startAutoSlide();
});
</script>

</body>
</html>
