<?php
/**
 * sitemap.php — sitemap.xml dinâmico
 * Substitui o sitemap.xml estático antigo (domínio credito.vc, posts que
 * não existem mais). Gera sempre a partir do banco (blog_posts publicados)
 * + páginas fixas do site. Servido em /sitemap.xml via rewrite no nginx.
 */

require_once __DIR__ . '/db.php';

header('Content-Type: application/xml; charset=utf-8');

$paginas_fixas = [
    ['loc' => '/',                          'changefreq' => 'weekly',  'priority' => '1.0'],
    ['loc' => '/cartoes/',                  'changefreq' => 'weekly',  'priority' => '0.9'],
    ['loc' => '/blog/',                     'changefreq' => 'daily',   'priority' => '0.8'],
    ['loc' => '/sobre/',                    'changefreq' => 'monthly', 'priority' => '0.5'],
    ['loc' => '/contato/',                  'changefreq' => 'monthly', 'priority' => '0.5'],
    ['loc' => '/time/',                     'changefreq' => 'monthly', 'priority' => '0.4'],
    ['loc' => '/termos-e-condicoes/',       'changefreq' => 'yearly',  'priority' => '0.3'],
    ['loc' => '/politica-de-privacidade/',  'changefreq' => 'yearly',  'priority' => '0.3'],
];

$posts = $pdo->query(
    "SELECT slug, updated_at FROM blog_posts WHERE status = 'publicado' ORDER BY created_at DESC"
)->fetchAll();

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($paginas_fixas as $p): ?>
  <url>
    <loc>https://libera.cash<?php echo $p['loc']; ?></loc>
    <changefreq><?php echo $p['changefreq']; ?></changefreq>
    <priority><?php echo $p['priority']; ?></priority>
  </url>
<?php endforeach; ?>
<?php foreach ($posts as $post): ?>
  <url>
    <loc>https://libera.cash/blog/<?php echo urlencode($post['slug']); ?>/</loc>
    <lastmod><?php echo date('Y-m-d', strtotime($post['updated_at'])); ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>
<?php endforeach; ?>
</urlset>
