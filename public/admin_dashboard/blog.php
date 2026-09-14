<?php
require_once __DIR__ . '/auth.php'; // já deixa $pdo pronto

$totalPosts = (int)$pdo->query("SELECT COUNT(*) FROM blog_posts")->fetchColumn();
$publicados = (int)$pdo->query("SELECT COUNT(*) FROM blog_posts WHERE status = 'publicado'")->fetchColumn();
$rascunhos = (int)$pdo->query("SELECT COUNT(*) FROM blog_posts WHERE status = 'rascunho'")->fetchColumn();
$totalViews = (int)$pdo->query("SELECT COALESCE(SUM(views), 0) FROM blog_posts")->fetchColumn();
$geradosIa = (int)$pdo->query("SELECT COUNT(*) FROM blog_posts WHERE gerado_por_ia = 1")->fetchColumn();
$manuais = $totalPosts - $geradosIa;

$topPosts = $pdo->query(
    "SELECT titulo, slug, categoria, views, status, gerado_por_ia
     FROM blog_posts ORDER BY views DESC LIMIT 10"
)->fetchAll();

$porCategoria = $pdo->query(
    "SELECT categoria, COUNT(*) qtd, COALESCE(SUM(views),0) views
     FROM blog_posts GROUP BY categoria ORDER BY qtd DESC"
)->fetchAll();

// Posts publicados por mês (últimos 12 meses)
$porMesRaw = $pdo->query(
    "SELECT DATE_FORMAT(created_at, '%Y-%m') ym, COUNT(*) c
     FROM blog_posts
     WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
     GROUP BY ym ORDER BY ym"
)->fetchAll(PDO::FETCH_KEY_PAIR);
$mesesPt = ['01'=>'Jan','02'=>'Fev','03'=>'Mar','04'=>'Abr','05'=>'Mai','06'=>'Jun','07'=>'Jul','08'=>'Ago','09'=>'Set','10'=>'Out','11'=>'Nov','12'=>'Dez'];
$mesLabels = [];
$mesValores = [];
for ($i = 11; $i >= 0; $i--) {
    $ym = date('Y-m', strtotime("-$i months"));
    [$ano, $mes] = explode('-', $ym);
    $mesLabels[] = $mesesPt[$mes] . '/' . substr($ano, 2);
    $mesValores[] = (int)($porMesRaw[$ym] ?? 0);
}
$pageTitle = 'Blog';
$pageSubtitle = 'Desempenho dos posts, publicados e gerados por IA.';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blog | Dashboard - LiberaCash</title>
<meta name="robots" content="noindex, nofollow">
<script src="/js/chart.min.js?v=1"></script>
<?php include __DIR__ . '/_estilo.php'; ?>
</head>
<?php include __DIR__ . '/_shell_top.php'; ?>

<div class="lc-page-title-row" style="margin-top:-4px;">
    <span></span>
    <a class="lc-btn lc-btn-secondary lc-btn-sm" href="/admin_blog/" target="_blank"><i data-lucide="pencil" style="width:16px;height:16px;"></i> Gerenciar posts</a>
</div>

<div class="lc-kpi-grid">
    <div class="lc-stat">
        <div class="lc-stat-top"><span class="lc-stat-icon"><i data-lucide="files"></i></span><span class="lc-stat-label">Total de posts</span></div>
        <span class="lc-stat-value"><?php echo $totalPosts; ?></span>
    </div>
    <div class="lc-stat">
        <div class="lc-stat-top"><span class="lc-stat-icon"><i data-lucide="check-circle-2"></i></span><span class="lc-stat-label">Publicados</span></div>
        <span class="lc-stat-value"><?php echo $publicados; ?></span>
    </div>
    <div class="lc-stat">
        <div class="lc-stat-top"><span class="lc-stat-icon"><i data-lucide="file-clock"></i></span><span class="lc-stat-label">Rascunhos</span></div>
        <span class="lc-stat-value"><?php echo $rascunhos; ?></span>
    </div>
    <div class="lc-stat">
        <div class="lc-stat-top"><span class="lc-stat-icon"><i data-lucide="eye"></i></span><span class="lc-stat-label">Total de leituras</span></div>
        <span class="lc-stat-value"><?php echo number_format($totalViews, 0, ',', '.'); ?></span>
    </div>
    <div class="lc-stat dark">
        <div class="lc-stat-top"><span class="lc-stat-icon"><i data-lucide="sparkles"></i></span><span class="lc-stat-label">IA / manuais</span></div>
        <span class="lc-stat-value"><?php echo $geradosIa; ?> / <?php echo $manuais; ?></span>
    </div>
</div>

<div class="lc-card">
    <div class="lc-card-header"><h2>Posts publicados por mês</h2></div>
    <div class="lc-chart-wrap"><canvas id="chartMes"></canvas></div>
</div>

<div class="lc-grid-2">
    <div class="lc-card">
        <div class="lc-card-header"><h2>Mais lidos</h2></div>
        <div class="lc-table-wrap">
        <table class="lc-table">
            <thead><tr><th>Post</th><th>Leituras</th><th>Origem</th></tr></thead>
            <tbody>
                <?php if (empty($topPosts)): ?>
                    <tr><td colspan="3" class="lc-empty-row">Nenhum post ainda.</td></tr>
                <?php else: foreach ($topPosts as $p): ?>
                    <tr>
                        <td>
                            <a href="/blog/<?php echo urlencode($p['slug']); ?>/" target="_blank"><?php echo htmlspecialchars($p['titulo'], ENT_QUOTES, 'UTF-8'); ?></a>
                            <?php if ($p['status'] === 'rascunho'): ?><span class="lc-badge warning">rascunho</span><?php endif; ?>
                        </td>
                        <td><?php echo number_format((int)$p['views'], 0, ',', '.'); ?></td>
                        <td><span class="lc-badge <?php echo $p['gerado_por_ia'] ? 'success' : 'neutral'; ?>"><?php echo $p['gerado_por_ia'] ? 'IA' : 'Manual'; ?></span></td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
        </div>
    </div>
    <div class="lc-card">
        <div class="lc-card-header"><h2>Por categoria</h2></div>
        <div class="lc-table-wrap">
        <table class="lc-table">
            <thead><tr><th>Categoria</th><th>Posts</th><th>Leituras</th></tr></thead>
            <tbody>
                <?php if (empty($porCategoria)): ?>
                    <tr><td colspan="3" class="lc-empty-row">Sem dados ainda.</td></tr>
                <?php else: foreach ($porCategoria as $c): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($c['categoria'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo (int)$c['qtd']; ?></td>
                        <td><?php echo number_format((int)$c['views'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
        </div>
    </div>
</div>

<script>
Chart.defaults.font.family = "'Plus Jakarta Sans', 'Urbanist', sans-serif";
Chart.defaults.color = '#828282';
new Chart(document.getElementById('chartMes'), {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($mesLabels); ?>,
        datasets: [{ data: <?php echo json_encode($mesValores); ?>, backgroundColor: '#6BCE52', borderRadius: 4 }]
    },
    options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
});
</script>

<?php include __DIR__ . '/_shell_bottom.php'; ?>
