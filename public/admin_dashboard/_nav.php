<?php
$paginaAtual = basename($_SERVER['SCRIPT_NAME']);
?>
<nav class="lc-sidebar" id="lcSidebar">
    <div class="lc-sidebar-logo">
        <img src="/images/logo-icon.png?v=1" alt="LiberaCash">
        <span>Libera<b>Cash</b></span>
    </div>

    <div class="lc-nav-group">
        <span class="lc-eyebrow">Painel</span>
        <a href="/admin_dashboard/index.php" class="lc-nav-item <?php echo $paginaAtual === 'index.php' ? 'active' : ''; ?>">
            <i data-lucide="layout-dashboard"></i><span>Visão geral</span>
        </a>
        <a href="/admin_dashboard/leads.php" class="lc-nav-item <?php echo $paginaAtual === 'leads.php' ? 'active' : ''; ?>">
            <i data-lucide="users"></i><span>Leads</span>
        </a>
        <a href="/admin_dashboard/blog.php" class="lc-nav-item <?php echo $paginaAtual === 'blog.php' ? 'active' : ''; ?>">
            <i data-lucide="newspaper"></i><span>Blog</span>
        </a>
    </div>

    <div class="lc-sidebar-foot">
        <span class="lc-eyebrow">Atalhos</span>
        <a href="/admin_blog/" class="lc-nav-item">
            <i data-lucide="file-edit"></i><span>Admin do blog</span>
        </a>
        <a href="/" target="_blank" class="lc-nav-item">
            <i data-lucide="external-link"></i><span>Ver site</span>
        </a>
        <a href="/admin_blog/logout.php" class="lc-nav-item">
            <i data-lucide="log-out"></i><span>Sair</span>
        </a>
    </div>
</nav>
