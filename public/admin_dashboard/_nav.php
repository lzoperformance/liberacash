<?php
$paginaAtual = basename($_SERVER['SCRIPT_NAME']);
?>
<div class="topbar">
    <div class="brand">Dashboard <span>LiberaCash</span></div>
    <div class="topbar-links">
        <a href="/admin_dashboard/index.php" class="<?php echo $paginaAtual === 'index.php' ? 'active' : ''; ?>">Visão geral</a>
        <a href="/admin_dashboard/leads.php" class="<?php echo $paginaAtual === 'leads.php' ? 'active' : ''; ?>">Leads</a>
        <a href="/admin_dashboard/blog.php" class="<?php echo $paginaAtual === 'blog.php' ? 'active' : ''; ?>">Blog</a>
        <a href="/admin_blog/"><i class="fas fa-newspaper"></i> Admin do blog</a>
        <a href="/admin_blog/logout.php">Sair <i class="fas fa-sign-out-alt"></i></a>
    </div>
</div>
