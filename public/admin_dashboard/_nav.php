<?php
// Reaproveitado por /admin_dashboard/ e /admin_blog/ — usa o caminho
// completo (não só o nome do arquivo) pra saber onde estamos, já que
// os dois têm um "index.php".
$caminhoAtual = $_SERVER['SCRIPT_NAME'] ?? '';
$emDashboard = strpos($caminhoAtual, '/admin_dashboard/') !== false;
$emBlog = strpos($caminhoAtual, '/admin_blog/') !== false;
$paginaAtual = basename($caminhoAtual);
?>
<nav class="lc-sidebar" id="lcSidebar">
    <div class="lc-sidebar-logo">
        <img src="/images/logo.png?v=7" alt="LiberaCash" width="480" height="167">
    </div>

    <div class="lc-nav-group">
        <span class="lc-eyebrow">Painel</span>
        <a href="/admin_dashboard/index.php" class="lc-nav-item <?php echo ($emDashboard && $paginaAtual === 'index.php') ? 'active' : ''; ?>">
            <i data-lucide="layout-dashboard"></i><span>Visão geral</span>
        </a>
        <a href="/admin_dashboard/leads.php" class="lc-nav-item <?php echo ($emDashboard && $paginaAtual === 'leads.php') ? 'active' : ''; ?>">
            <i data-lucide="users"></i><span>Leads</span>
        </a>
        <a href="/admin_dashboard/blog.php" class="lc-nav-item <?php echo ($emDashboard && $paginaAtual === 'blog.php') ? 'active' : ''; ?>">
            <i data-lucide="newspaper"></i><span>Blog</span>
        </a>
    </div>

    <div class="lc-nav-group">
        <span class="lc-eyebrow">Conteúdo</span>
        <a href="/admin_blog/" class="lc-nav-item <?php echo $emBlog ? 'active' : ''; ?>">
            <i data-lucide="file-edit"></i><span>Posts do blog</span>
        </a>
    </div>

    <div class="lc-sidebar-foot">
        <a href="/" target="_blank" class="lc-nav-item">
            <i data-lucide="external-link"></i><span>Ver site</span>
        </a>
        <a href="/admin_blog/logout.php" class="lc-nav-item">
            <i data-lucide="log-out"></i><span>Sair</span>
        </a>
    </div>
</nav>
