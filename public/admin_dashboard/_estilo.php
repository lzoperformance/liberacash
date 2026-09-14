<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Urbanist:ital,wght@0,400..800;1,400..600&family=Plus+Jakarta+Sans:wght@400..700&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide@0.454.0/dist/umd/lucide.js"></script>
<style>
/* ===== Tokens (de design-system/tokens/ — ver design-system/readme.md) ===== */
:root {
  --green-50:#F3FCEB; --green-100:#E6F8D6; --green-200:#CDF1AE; --green-400:#9AE472;
  --green-500:#82E166; --green-600:#6BCE52; --green-700:#51AE3B;
  --forest-900:#07231A; --forest-800:#0E3223; --forest-700:#16562D; --forest-600:#1F6B3C; --forest-500:#2E8450;
  --grey-0:#FFFFFF; --grey-50:#F7F7F7; --grey-100:#F1F1F1; --grey-150:#E9E9E9; --grey-200:#DFDFDF;
  --grey-300:#CBCBCB; --grey-400:#A8A8A8; --grey-500:#828282; --grey-600:#636363;
  --red-500:#E5484D; --red-50:#FDECEC; --amber-500:#E29A2C; --amber-50:#FDF3E2;

  --text-strong:var(--forest-800); --text-body:var(--forest-800); --text-muted:var(--grey-500); --text-subtle:var(--grey-400);
  --surface-desk:var(--grey-150); --surface-card:var(--grey-0); --surface-card-sunken:var(--grey-50);
  --surface-accent-faint:var(--green-50); --surface-hover:var(--grey-100);
  --border-hairline:var(--grey-150); --border-default:var(--grey-200); --border-accent:var(--green-400);
  --status-success-fg:var(--forest-600); --status-success-bg:var(--green-50);
  --status-pending-fg:var(--red-500); --status-pending-bg:var(--red-50);
  --status-warning-fg:var(--amber-500); --status-warning-bg:var(--amber-50);
  --status-neutral-fg:var(--grey-600); --status-neutral-bg:var(--grey-100);

  --font-display:'Space Grotesk','Urbanist',system-ui,sans-serif;
  --font-ui:'Urbanist','Plus Jakarta Sans',system-ui,sans-serif;
  --font-tabular:'Plus Jakarta Sans','Urbanist',system-ui,sans-serif;
  --font-numeric:'Space Grotesk','Plus Jakarta Sans',system-ui,sans-serif;

  --radius-card:20px; --radius-card-inner:14px; --radius-shell:28px; --radius-control:999px; --radius-field:12px; --radius-tile:22px;
  --shadow-card:0 1px 2px rgba(14,50,35,.03),0 8px 24px -12px rgba(14,50,35,.10);
  --shadow-raised:0 2px 4px rgba(14,50,35,.04),0 16px 40px -16px rgba(14,50,35,.14);
  --shadow-shell:0 24px 70px -30px rgba(14,50,35,.22);
  --shadow-accent:0 8px 24px -10px rgba(107,206,82,.55);
  --gradient-brand:linear-gradient(135deg,#86E160 0%,#76DF7D 100%);
  --gradient-hero:radial-gradient(120% 140% at 78% 18%,#A5EB84 0%,#82E166 42%,#6BCE52 100%);
  --sidebar-width:248px; --gap-card:16px; --pad-card:20px; --shell-pad:16px;
}

* { margin:0; padding:0; box-sizing:border-box; }
html, body { height:100%; }
body {
  font-family: var(--font-ui);
  background: var(--surface-desk);
  color: var(--text-body);
  font-size: 15px;
  overflow: hidden;
}
a { color: inherit; }
[data-lucide] { width: 19px; height: 19px; stroke-width: 1.75; display: block; }

/* ===== Shell — a placa arredondada flutuando na mesa cinza ===== */
.lc-shell {
  position: fixed; inset: var(--shell-pad);
  background: var(--surface-card);
  border-radius: var(--radius-shell);
  box-shadow: var(--shadow-shell);
  border: 1px solid var(--border-accent);
  display: flex;
  overflow: hidden;
}

/* ===== Sidebar ===== */
.lc-sidebar {
  width: var(--sidebar-width); flex: 0 0 auto;
  background: var(--surface-card-sunken);
  border-right: 1px solid var(--border-hairline);
  display: flex; flex-direction: column; gap: 18px; padding: 16px;
  overflow-y: auto;
}
.lc-sidebar-logo { display: flex; align-items: center; padding: 6px 6px 4px; margin-bottom: 4px; }
.lc-sidebar-logo img { height: 34px; width: auto; }

.lc-eyebrow { display: block; padding: 0 14px 6px; font: 600 11px/1.2 var(--font-ui); letter-spacing: .08em; text-transform: uppercase; color: var(--text-subtle); }
.lc-nav-group { display: flex; flex-direction: column; gap: 3px; }
.lc-nav-item {
  display: flex; align-items: center; gap: 12px; width: 100%; min-height: 42px; padding: 0 14px;
  border-radius: var(--radius-card-inner); border: 1px solid transparent;
  color: var(--text-muted); font: 500 14px/1 var(--font-ui); text-decoration: none;
  transition: background-color .14s, color .14s;
}
.lc-nav-item:hover { background: var(--grey-100); }
.lc-nav-item.active { background: var(--surface-card); border-color: var(--border-hairline); color: var(--text-strong); font-weight: 600; box-shadow: var(--shadow-card); }
.lc-nav-item.active [data-lucide] { color: var(--forest-700); }
.lc-sidebar-foot { margin-top: auto; display: flex; flex-direction: column; gap: 3px; }

/* ===== Main / topbar ===== */
.lc-main { flex: 1; min-width: 0; display: flex; flex-direction: column; }
.lc-topbar {
  flex: 0 0 auto; height: 64px; padding: 0 28px;
  display: flex; align-items: center; justify-content: space-between; gap: 16px;
  border-bottom: 1px solid var(--border-hairline);
}
.lc-topbar h1 { font: 600 20px/1.2 var(--font-display); color: var(--text-strong); letter-spacing: -.01em; }
.lc-topbar-sub { font-size: 13px; color: var(--text-muted); margin-top: 1px; }
.lc-topbar-right { display: flex; align-items: center; gap: 10px; }
.lc-avatar {
  width: 36px; height: 36px; border-radius: 999px; background: var(--gradient-brand);
  display: flex; align-items: center; justify-content: center; font: 700 13px var(--font-display); color: var(--forest-800);
}
.lc-scroll { flex: 1; min-height: 0; overflow-y: auto; padding: var(--gap-card) 28px 40px; }

/* ===== Cards ===== */
.lc-card { background: var(--surface-card); border-radius: var(--radius-card); box-shadow: var(--shadow-card); padding: var(--pad-card); margin-bottom: var(--gap-card); }
.lc-card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; flex-wrap: wrap; gap: 10px; }
.lc-card-header h2 { font: 600 17px/1.2 var(--font-display); color: var(--text-strong); }

/* ===== KPI stat cards ===== */
.lc-kpi-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(190px, 1fr)); gap: var(--gap-card); margin-bottom: var(--gap-card); }
.lc-stat { display: flex; flex-direction: column; gap: 10px; padding: 16px 18px; border-radius: var(--radius-card-inner); background: var(--surface-card); border: 1px solid var(--border-hairline); }
.lc-stat.accent { background: var(--surface-accent-faint); border-color: var(--border-accent); }
.lc-stat.dark { background: var(--forest-800); border-color: transparent; }
.lc-stat.dark .lc-stat-label { color: rgba(255,255,255,.65); }
.lc-stat.dark .lc-stat-value { color: #fff; }
.lc-stat-top { display: flex; align-items: center; gap: 8px; }
.lc-stat-icon { width: 28px; height: 28px; border-radius: 50%; flex: 0 0 auto; display: grid; place-items: center; background: var(--surface-accent-faint); color: var(--forest-700); }
.lc-stat.dark .lc-stat-icon { background: rgba(255,255,255,.1); color: var(--green-400); }
.lc-stat-label { font: 500 13px/1.3 var(--font-ui); color: var(--text-muted); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.lc-stat-value { font: 700 26px/1.05 var(--font-numeric); color: var(--text-strong); letter-spacing: -.01em; }

/* ===== Tabs ===== */
.lc-tabs { display: flex; gap: 4px; background: var(--grey-100); padding: 4px; border-radius: 999px; }
.lc-tab { border: none; background: transparent; padding: 6px 16px; border-radius: 999px; font: 600 12.5px var(--font-ui); color: var(--text-muted); cursor: pointer; }
.lc-tab.active { background: var(--surface-card); color: var(--forest-700); box-shadow: var(--shadow-card); }

.lc-chart-wrap { position: relative; height: 270px; }
.lc-grid-2 { display: grid; grid-template-columns: 1.3fr 1fr; gap: var(--gap-card); }
@media (max-width: 1100px) { .lc-grid-2 { grid-template-columns: 1fr; } }

/* ===== Table ===== */
.lc-table-wrap { overflow-x: auto; }
table.lc-table { width: 100%; border-collapse: collapse; font-family: var(--font-tabular); }
table.lc-table th {
  text-align: left; padding: 9px 12px; white-space: nowrap; font: 500 12px var(--font-tabular);
  color: var(--text-subtle); background: var(--surface-card-sunken); position: sticky; top: 0;
}
table.lc-table td { padding: 11px 12px; border-bottom: 1px solid var(--border-hairline); font: 500 13px var(--font-tabular); color: var(--text-body); }
table.lc-table tr:hover td { background: var(--surface-hover); }
table.lc-table tr:last-child td { border-bottom: none; }

.lc-actions-cell { white-space: nowrap; }
.lc-action-btn {
  display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px;
  border-radius: var(--radius-control); font: 600 12px var(--font-ui);
  text-decoration: none; white-space: nowrap; margin-right: 8px; border: none; cursor: pointer;
}
.lc-action-btn [data-lucide] { width: 13px; height: 13px; }
.lc-action-btn.edit { color: var(--forest-700); background: var(--surface-accent-faint); }
.lc-action-btn.edit:hover { background: var(--green-100); }
.lc-action-btn.delete { color: var(--red-500); background: var(--status-pending-bg); }
.lc-action-btn.delete:hover { background: #FADCDC; }
.lc-empty-row { text-align: center; padding: 30px 20px; color: var(--text-muted); }

/* ===== Badge ===== */
.lc-badge { display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 999px; font: 600 11px/1.2 var(--font-ui); white-space: nowrap; }
.lc-badge.success { color: var(--status-success-fg); background: var(--status-success-bg); }
.lc-badge.pending { color: var(--status-pending-fg); background: var(--status-pending-bg); }
.lc-badge.warning { color: var(--status-warning-fg); background: var(--status-warning-bg); }
.lc-badge.neutral { color: var(--status-neutral-fg); background: var(--status-neutral-bg); }

/* ===== Buttons ===== */
.lc-btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 42px; padding: 0 20px; border-radius: 999px; font: 600 14px var(--font-ui); text-decoration: none; border: 1px solid transparent; cursor: pointer; white-space: nowrap; transition: transform .1s, box-shadow .15s; }
.lc-btn:active { transform: scale(.98); }
.lc-btn-primary { background: var(--green-500); color: var(--forest-800); }
.lc-btn-primary:hover { background: var(--green-600); box-shadow: var(--shadow-accent); }
.lc-btn-dark { background: var(--forest-800); color: #fff; }
.lc-btn-dark:hover { background: var(--forest-700); }
.lc-btn-secondary { background: var(--surface-card); color: var(--text-strong); border-color: var(--border-default); }
.lc-btn-secondary:hover { background: var(--surface-hover); }
.lc-btn-sm { height: 36px; padding: 0 16px; font-size: 13px; }

/* ===== Formulários (post-form etc.) ===== */
.lc-form-group { margin-bottom: 18px; }
.lc-form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
.lc-form-group label, .lc-form-row label { display: block; font: 700 13px var(--font-ui); color: var(--text-strong); margin-bottom: 7px; }
.lc-form-group label .lc-hint, .lc-form-row label .lc-hint { font-weight: 400; color: var(--text-subtle); font-size: 11.5px; }
.lc-form-group input[type=text], .lc-form-group input[type=url], .lc-form-group textarea, .lc-form-group select,
.lc-form-row input[type=text], .lc-form-row input[type=url], .lc-form-row textarea, .lc-form-row select {
    width: 100%; padding: 11px 14px; border: 1.5px solid var(--border-default); border-radius: var(--radius-field);
    font: 500 14px var(--font-ui); color: var(--text-strong); background: var(--surface-card);
}
.lc-form-group input:focus, .lc-form-group textarea:focus, .lc-form-group select:focus,
.lc-form-row input:focus, .lc-form-row textarea:focus, .lc-form-row select:focus {
    outline: none; border-color: var(--border-accent); box-shadow: 0 0 0 3px rgba(130,225,102,.35);
}
.lc-form-group textarea { resize: vertical; font-family: var(--font-ui); }
.lc-form-group textarea.lc-conteudo { min-height: 260px; }
.lc-form-group textarea.lc-resumo { min-height: 80px; }
.lc-form-actions { margin-top: 22px; display: flex; gap: 14px; align-items: center; }
.lc-form-actions a.lc-cancel { color: var(--text-muted); text-decoration: none; font: 600 14px var(--font-ui); }
.lc-form-actions a.lc-cancel:hover { color: var(--text-strong); }

/* ===== Filters ===== */
.lc-filters { display: flex; gap: 12px; flex-wrap: wrap; align-items: end; }
.lc-fgroup { display: flex; flex-direction: column; gap: 5px; }
.lc-fgroup label { font: 600 11px var(--font-ui); color: var(--text-muted); text-transform: uppercase; letter-spacing: .04em; }
.lc-fgroup input, .lc-fgroup select {
  height: 40px; padding: 0 14px; border: 1.5px solid var(--border-default); border-radius: var(--radius-field);
  font: 500 13.5px var(--font-ui); color: var(--text-strong); background: var(--surface-card);
}
.lc-fgroup input:focus, .lc-fgroup select:focus { outline: none; border-color: var(--border-accent); box-shadow: 0 0 0 3px rgba(130,225,102,.35); }

/* ===== Pagination ===== */
.lc-pagination { display: flex; gap: 6px; justify-content: center; margin-top: 20px; }
.lc-pagination a, .lc-pagination span { padding: 8px 13px; border-radius: 999px; font: 600 13px var(--font-ui); text-decoration: none; color: var(--text-muted); border: 1px solid var(--border-hairline); }
.lc-pagination a:hover { background: var(--surface-hover); }
.lc-pagination .current { background: var(--forest-800); color: #fff; border-color: var(--forest-800); }

/* ===== Page title block ===== */
.lc-page-title-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--gap-card); flex-wrap: wrap; gap: 12px; }
.lc-page-title-row h2 { font: 600 20px/1.2 var(--font-display); color: var(--text-strong); }
.lc-page-title-row .lc-muted { color: var(--text-muted); font-weight: 400; font-size: 15px; }

/* ===== Mobile ===== */
.lc-burger { display: none; }
@media (max-width: 900px) {
  .lc-shell { inset: 0; border-radius: 0; }
  .lc-sidebar { position: fixed; left: 0; top: 0; bottom: 0; z-index: 30; transform: translateX(-100%); transition: transform .25s; box-shadow: var(--shadow-raised); }
  .lc-sidebar.open { transform: translateX(0); }
  .lc-burger { display: inline-grid; place-items: center; width: 38px; height: 38px; border-radius: 10px; border: 1px solid var(--border-hairline); background: var(--surface-card); cursor: pointer; }
  .lc-topbar { padding: 0 16px; }
  .lc-scroll { padding: 12px 16px 32px; }
  .lc-kpi-grid { grid-template-columns: repeat(2, 1fr); }
}
</style>
