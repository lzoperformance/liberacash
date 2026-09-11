<?php
/**
 * track.php
 * Registra uma visualização de página em page_views. Inclua no topo de
 * cada página pública, depois de db.php:
 *
 *   require_once __DIR__ . '/track.php';
 *   lc_track_pageview($pdo);
 *
 * Nunca deve derrubar a página — qualquer erro aqui é só logado.
 */

function lc_track_pageview(PDO $pdo): void
{
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';

    // Pula bots/crawlers óbvios pra não inflar as métricas de visita real.
    if ($ua === '' || preg_match('/bot|crawl|spider|slurp|facebookexternalhit|preview|monitor|pingdom|uptime/i', $ua)) {
        return;
    }

    try {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
        $stmt = $pdo->prepare(
            'INSERT INTO page_views (path, referrer, utm_source, utm_medium, utm_campaign, user_agent, ip_hash)
             VALUES (:path, :ref, :us, :um, :uc, :ua, :ip)'
        );
        $path = parse_url((string)($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH) ?: '/';
        $stmt->execute([
            'path' => substr($path, 0, 255),
            'ref'  => isset($_SERVER['HTTP_REFERER']) ? substr($_SERVER['HTTP_REFERER'], 0, 500) : null,
            'us'   => isset($_GET['utm_source']) ? substr((string)$_GET['utm_source'], 0, 100) : null,
            'um'   => isset($_GET['utm_medium']) ? substr((string)$_GET['utm_medium'], 0, 100) : null,
            'uc'   => isset($_GET['utm_campaign']) ? substr((string)$_GET['utm_campaign'], 0, 100) : null,
            'ua'   => substr($ua, 0, 255),
            'ip'   => $ip !== '' ? hash('sha256', $ip) : null,
        ]);
    } catch (Throwable $e) {
        error_log('lc_track_pageview: ' . $e->getMessage());
    }
}
