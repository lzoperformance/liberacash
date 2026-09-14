<?php
require_once __DIR__ . '/auth.php'; // já deixa $pdo pronto
require_once __DIR__ . '/../produtos-config.php';

// ---------------------------------------------------------------------
// KPIs de acesso
// ---------------------------------------------------------------------
$kpi_hoje = (int)$pdo->query("SELECT COUNT(*) FROM page_views WHERE DATE(criado_em) = CURDATE()")->fetchColumn();
$kpi_7d   = (int)$pdo->query("SELECT COUNT(*) FROM page_views WHERE criado_em >= DATE_SUB(NOW(), INTERVAL 7 DAY)")->fetchColumn();
$kpi_30d  = (int)$pdo->query("SELECT COUNT(*) FROM page_views WHERE criado_em >= DATE_SUB(NOW(), INTERVAL 30 DAY)")->fetchColumn();
$kpi_total = (int)$pdo->query("SELECT COUNT(*) FROM page_views")->fetchColumn();

// ---------------------------------------------------------------------
// Acessos por dia (últimos 30 dias) — preenche dias sem acesso com 0
// ---------------------------------------------------------------------
$porDiaRaw = $pdo->query(
    "SELECT DATE(criado_em) d, COUNT(*) c FROM page_views
     WHERE criado_em >= DATE_SUB(CURDATE(), INTERVAL 29 DAY)
     GROUP BY DATE(criado_em)"
)->fetchAll(PDO::FETCH_KEY_PAIR);
$diasLabels = [];
$diasValores = [];
for ($i = 29; $i >= 0; $i--) {
    $d = date('Y-m-d', strtotime("-$i days"));
    $diasLabels[] = date('d/m', strtotime($d));
    $diasValores[] = (int)($porDiaRaw[$d] ?? 0);
}

// ---------------------------------------------------------------------
// Acessos por semana (últimas 12 semanas)
// ---------------------------------------------------------------------
$porSemanaRaw = $pdo->query(
    "SELECT YEARWEEK(criado_em, 3) yw, MIN(DATE(criado_em)) inicio, COUNT(*) c
     FROM page_views
     WHERE criado_em >= DATE_SUB(CURDATE(), INTERVAL 12 WEEK)
     GROUP BY yw ORDER BY yw"
)->fetchAll();
$semanaLabels = [];
$semanaValores = [];
foreach ($porSemanaRaw as $row) {
    $semanaLabels[] = 'sem. ' . date('d/m', strtotime($row['inicio']));
    $semanaValores[] = (int)$row['c'];
}

// ---------------------------------------------------------------------
// Acessos por mês (últimos 12 meses)
// ---------------------------------------------------------------------
$porMesRaw = $pdo->query(
    "SELECT DATE_FORMAT(criado_em, '%Y-%m') ym, COUNT(*) c
     FROM page_views
     WHERE criado_em >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
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

// ---------------------------------------------------------------------
// Acessos por horário do dia (últimos 30 dias) — pra achar o pico
// ---------------------------------------------------------------------
$porHoraRaw = $pdo->query(
    "SELECT HOUR(criado_em) h, COUNT(*) c FROM page_views
     WHERE criado_em >= DATE_SUB(NOW(), INTERVAL 30 DAY)
     GROUP BY h"
)->fetchAll(PDO::FETCH_KEY_PAIR);
$horaLabels = [];
$horaValores = [];
for ($h = 0; $h < 24; $h++) {
    $horaLabels[] = sprintf('%02dh', $h);
    $horaValores[] = (int)($porHoraRaw[$h] ?? 0);
}
$horaPico = array_search(max($horaValores), $horaValores);

// ---------------------------------------------------------------------
// Páginas mais vistas
// ---------------------------------------------------------------------
$topPaginas = $pdo->query(
    "SELECT path, COUNT(*) c FROM page_views GROUP BY path ORDER BY c DESC LIMIT 10"
)->fetchAll();

// ---------------------------------------------------------------------
// KPIs de leads (tabela usuarios = cada cadastro é um lead)
// ---------------------------------------------------------------------
$leads_hoje = (int)$pdo->query("SELECT COUNT(*) FROM usuarios WHERE DATE(criado_em) = CURDATE()")->fetchColumn();
$leads_7d   = (int)$pdo->query("SELECT COUNT(*) FROM usuarios WHERE criado_em >= DATE_SUB(NOW(), INTERVAL 7 DAY)")->fetchColumn();
$leads_30d  = (int)$pdo->query("SELECT COUNT(*) FROM usuarios WHERE criado_em >= DATE_SUB(NOW(), INTERVAL 30 DAY)")->fetchColumn();
$leads_total = (int)$pdo->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();

// Taxa de conversão (últimos 30 dias): leads novos / visitas na home
$visitasHome30d = (int)$pdo->query(
    "SELECT COUNT(*) FROM page_views WHERE path = '/' AND criado_em >= DATE_SUB(NOW(), INTERVAL 30 DAY)"
)->fetchColumn();
$taxaConversao = $visitasHome30d > 0 ? round(($leads_30d / $visitasHome30d) * 100, 1) : null;

// ---------------------------------------------------------------------
// Produto mais escolhido (historico_solicitacoes = clique real em parceiro)
// ---------------------------------------------------------------------
$produtoRows = $pdo->query(
    "SELECT produto_slug, COUNT(*) c FROM historico_solicitacoes GROUP BY produto_slug ORDER BY c DESC LIMIT 8"
)->fetchAll();
$produtoLabels = [];
$produtoValores = [];
foreach ($produtoRows as $row) {
    $p = get_product_by_slug($row['produto_slug']);
    $produtoLabels[] = $p['nome'] ?? $row['produto_slug'];
    $produtoValores[] = (int)$row['c'];
}
$pageTitle = 'Visão geral';
$pageSubtitle = 'Acessos ao site e o funil de leads, num só lugar.';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard | LiberaCash</title>
<meta name="robots" content="noindex, nofollow">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.5.1/chart.min.js"></script>
<?php include __DIR__ . '/_estilo.php'; ?>
</head>
<?php include __DIR__ . '/_shell_top.php'; ?>

<div class="lc-kpi-grid">
    <div class="lc-stat">
        <div class="lc-stat-top"><span class="lc-stat-icon"><i data-lucide="mouse-pointer-click"></i></span><span class="lc-stat-label">Acessos hoje</span></div>
        <span class="lc-stat-value"><?php echo number_format($kpi_hoje, 0, ',', '.'); ?></span>
    </div>
    <div class="lc-stat">
        <div class="lc-stat-top"><span class="lc-stat-icon"><i data-lucide="calendar-days"></i></span><span class="lc-stat-label">Últimos 7 dias</span></div>
        <span class="lc-stat-value"><?php echo number_format($kpi_7d, 0, ',', '.'); ?></span>
    </div>
    <div class="lc-stat">
        <div class="lc-stat-top"><span class="lc-stat-icon"><i data-lucide="calendar-range"></i></span><span class="lc-stat-label">Últimos 30 dias</span></div>
        <span class="lc-stat-value"><?php echo number_format($kpi_30d, 0, ',', '.'); ?></span>
    </div>
    <div class="lc-stat">
        <div class="lc-stat-top"><span class="lc-stat-icon"><i data-lucide="infinity"></i></span><span class="lc-stat-label">Total desde o início</span></div>
        <span class="lc-stat-value"><?php echo number_format($kpi_total, 0, ',', '.'); ?></span>
    </div>
    <div class="lc-stat dark">
        <div class="lc-stat-top"><span class="lc-stat-icon"><i data-lucide="flame"></i></span><span class="lc-stat-label">Horário de pico</span></div>
        <span class="lc-stat-value"><?php echo $horaLabels[$horaPico] ?? '—'; ?></span>
    </div>
</div>

<div class="lc-card">
    <div class="lc-card-header">
        <h2>Acessos ao longo do tempo</h2>
        <div class="lc-tabs" id="tabsPeriodo">
            <button class="lc-tab active" data-alvo="chartDia">Dia</button>
            <button class="lc-tab" data-alvo="chartSemana">Semana</button>
            <button class="lc-tab" data-alvo="chartMes">Mês</button>
        </div>
    </div>
    <div class="lc-chart-wrap"><canvas id="chartDia"></canvas></div>
    <div class="lc-chart-wrap" style="display:none;"><canvas id="chartSemana"></canvas></div>
    <div class="lc-chart-wrap" style="display:none;"><canvas id="chartMes"></canvas></div>
</div>

<div class="lc-grid-2">
    <div class="lc-card">
        <div class="lc-card-header"><h2>Acessos por horário do dia</h2></div>
        <div class="lc-chart-wrap"><canvas id="chartHora"></canvas></div>
    </div>
    <div class="lc-card">
        <div class="lc-card-header"><h2>Páginas mais vistas</h2></div>
        <div class="lc-table-wrap">
        <table class="lc-table">
            <thead><tr><th>Página</th><th>Acessos</th></tr></thead>
            <tbody>
                <?php if (empty($topPaginas)): ?>
                    <tr><td colspan="2" class="lc-empty-row">Ainda sem dados suficientes.</td></tr>
                <?php else: foreach ($topPaginas as $p): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($p['path'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo number_format((int)$p['c'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
        </div>
    </div>
</div>

<div class="lc-page-title-row" style="margin-top:8px;">
    <h2>Leads</h2>
    <a class="lc-btn lc-btn-dark lc-btn-sm" href="/admin_dashboard/leads.php"><i data-lucide="users" style="width:16px;height:16px;"></i> Ver todos os leads</a>
</div>

<div class="lc-kpi-grid">
    <div class="lc-stat">
        <div class="lc-stat-top"><span class="lc-stat-icon"><i data-lucide="user-plus"></i></span><span class="lc-stat-label">Leads hoje</span></div>
        <span class="lc-stat-value"><?php echo number_format($leads_hoje, 0, ',', '.'); ?></span>
    </div>
    <div class="lc-stat">
        <div class="lc-stat-top"><span class="lc-stat-icon"><i data-lucide="calendar-days"></i></span><span class="lc-stat-label">Últimos 7 dias</span></div>
        <span class="lc-stat-value"><?php echo number_format($leads_7d, 0, ',', '.'); ?></span>
    </div>
    <div class="lc-stat">
        <div class="lc-stat-top"><span class="lc-stat-icon"><i data-lucide="calendar-range"></i></span><span class="lc-stat-label">Últimos 30 dias</span></div>
        <span class="lc-stat-value"><?php echo number_format($leads_30d, 0, ',', '.'); ?></span>
    </div>
    <div class="lc-stat">
        <div class="lc-stat-top"><span class="lc-stat-icon"><i data-lucide="users"></i></span><span class="lc-stat-label">Total de leads</span></div>
        <span class="lc-stat-value"><?php echo number_format($leads_total, 0, ',', '.'); ?></span>
    </div>
    <div class="lc-stat accent">
        <div class="lc-stat-top"><span class="lc-stat-icon"><i data-lucide="trending-up"></i></span><span class="lc-stat-label">Conversão (visita → cadastro, 30d)</span></div>
        <span class="lc-stat-value"><?php echo $taxaConversao !== null ? $taxaConversao . '%' : '—'; ?></span>
    </div>
</div>

<div class="lc-card">
    <div class="lc-card-header"><h2>Produto mais escolhido (cliques em parceiro)</h2></div>
    <div class="lc-chart-wrap"><canvas id="chartProdutos"></canvas></div>
</div>

<script>
Chart.defaults.font.family = "'Plus Jakarta Sans', 'Urbanist', sans-serif";
Chart.defaults.color = '#828282';
const paletaVerde = '#6BCE52';
const paletaVerdeClaro = 'rgba(130,225,102,0.22)';
const paletaEscura = '#0E3223';

function lineChart(id, labels, dados) {
    return new Chart(document.getElementById(id), {
        type: 'line',
        data: { labels, datasets: [{ data: dados, borderColor: paletaVerde, backgroundColor: paletaVerdeClaro, fill: true, tension: 0.3, pointRadius: 2 }] },
        options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
    });
}
function barChart(id, labels, dados, cor) {
    return new Chart(document.getElementById(id), {
        type: 'bar',
        data: { labels, datasets: [{ data: dados, backgroundColor: cor || paletaVerde, borderRadius: 4 }] },
        options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
    });
}

lineChart('chartDia', <?php echo json_encode($diasLabels); ?>, <?php echo json_encode($diasValores); ?>);
barChart('chartSemana', <?php echo json_encode($semanaLabels); ?>, <?php echo json_encode($semanaValores); ?>);
barChart('chartMes', <?php echo json_encode($mesLabels); ?>, <?php echo json_encode($mesValores); ?>);
barChart('chartHora', <?php echo json_encode($horaLabels); ?>, <?php echo json_encode($horaValores); ?>, paletaEscura);
barChart('chartProdutos', <?php echo json_encode($produtoLabels); ?>, <?php echo json_encode($produtoValores); ?>);

document.querySelectorAll('#tabsPeriodo .lc-tab').forEach(function (btn) {
    btn.addEventListener('click', function () {
        document.querySelectorAll('#tabsPeriodo .lc-tab').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.lc-chart-wrap').forEach(w => w.style.display = 'none');
        btn.classList.add('active');
        document.getElementById(btn.dataset.alvo).closest('.lc-chart-wrap').style.display = 'block';
    });
});
</script>

<?php include __DIR__ . '/_shell_bottom.php'; ?>
