<?php
/**
 * blog-feed.php — RSS 2.0 do blog
 * Servido em /blog/feed.xml via rewrite no nginx. Ajuda motores de busca
 * e agregadores (Google News/Discover incluído) a descobrir posts novos
 * rápido, sem esperar o próximo crawl do sitemap.
 */

require_once __DIR__ . '/db.php';

header('Content-Type: application/rss+xml; charset=utf-8');

$posts = $pdo->query(
    "SELECT slug, titulo, resumo, categoria, autor, created_at FROM blog_posts
     WHERE status = 'publicado' ORDER BY created_at DESC LIMIT 30"
)->fetchAll();

function rss_escape(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES | ENT_XML1, 'UTF-8');
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
  <title>Blog LiberaCash</title>
  <link>https://libera.cash/blog/</link>
  <atom:link href="https://libera.cash/blog/feed.xml" rel="self" type="application/rss+xml" />
  <description>Notícias e dicas de crédito, empréstimos e saúde financeira.</description>
  <language>pt-BR</language>
  <lastBuildDate><?php echo date(DATE_RSS); ?></lastBuildDate>
<?php foreach ($posts as $post): ?>
  <item>
    <title><?php echo rss_escape($post['titulo']); ?></title>
    <link>https://libera.cash/blog/<?php echo urlencode($post['slug']); ?>/</link>
    <guid isPermaLink="true">https://libera.cash/blog/<?php echo urlencode($post['slug']); ?>/</guid>
    <description><?php echo rss_escape((string)$post['resumo']); ?></description>
    <category><?php echo rss_escape($post['categoria']); ?></category>
    <author><?php echo rss_escape($post['autor'] ?: 'Redação LiberaCash'); ?></author>
    <pubDate><?php echo date(DATE_RSS, strtotime($post['created_at'])); ?></pubDate>
  </item>
<?php endforeach; ?>
</channel>
</rss>
