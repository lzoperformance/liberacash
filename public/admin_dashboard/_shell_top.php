<?php
/**
 * _shell_top.php
 * Abre o shell (placa arredondada + sidebar + topbar + área de scroll).
 * Defina $pageTitle (e opcionalmente $pageSubtitle) antes do include.
 * Fecha com _shell_bottom.php.
 */
?>
<body>
<div class="lc-shell">
    <?php include __DIR__ . '/_nav.php'; ?>

    <div class="lc-main">
        <div class="lc-topbar">
            <div style="display:flex; align-items:center; gap:14px;">
                <button class="lc-burger" id="lcBurger" aria-label="Menu"><i data-lucide="menu"></i></button>
                <div>
                    <h1><?php echo htmlspecialchars($pageTitle ?? '', ENT_QUOTES, 'UTF-8'); ?></h1>
                    <?php if (!empty($pageSubtitle)): ?>
                        <div class="lc-topbar-sub"><?php echo htmlspecialchars($pageSubtitle, ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="lc-topbar-right">
                <div class="lc-avatar"><?php echo htmlspecialchars(mb_strtoupper(mb_substr($_SESSION['admin_username'] ?? 'A', 0, 1)), ENT_QUOTES, 'UTF-8'); ?></div>
            </div>
        </div>

        <main class="lc-scroll">