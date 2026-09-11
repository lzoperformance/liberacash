<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    :root { --primary-green: #2ecc71; --dark-green: #27ae60; --dark-bg: #181a1f; }
    body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f6f5; color: #2d3436; }

    .topbar { background: var(--dark-bg); color: #fff; padding: 14px 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
    .topbar .brand { font-weight: 700; font-size: 15px; }
    .topbar .brand span { color: var(--primary-green); }
    .topbar-links a { color: #ccc; text-decoration: none; font-size: 13px; margin-left: 18px; }
    .topbar-links a:hover, .topbar-links a.active { color: #fff; }
    .topbar-links a.active { color: var(--primary-green); font-weight: 600; }

    .wrap { max-width: 1200px; margin: 30px auto; padding: 0 20px 60px 20px; }

    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px; }
    .page-header h1 { font-size: 1.5rem; }
    .btn-new { background: var(--primary-green); color: #fff; padding: 11px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; border: none; cursor: pointer; }
    .btn-new:hover { background: var(--dark-green); }
    .btn-outline { background: #fff; color: var(--dark-green); border: 1.5px solid var(--primary-green); padding: 9px 16px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 13px; display: inline-flex; align-items: center; gap: 6px; }
    .btn-outline:hover { background: #eafaf1; }

    .kpi-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 24px; }
    .kpi-card { background: #fff; border-radius: 12px; padding: 18px 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.04); display: flex; flex-direction: column; gap: 6px; }
    .kpi-card.destaque { background: var(--dark-bg); color: #fff; }
    .kpi-card.destaque .kpi-label { color: #aaa; }
    .kpi-label { font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 0.4px; font-weight: 600; }
    .kpi-value { font-size: 1.7rem; font-weight: 700; }

    .card { background: #fff; border-radius: 12px; padding: 20px 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.04); margin-bottom: 24px; }
    .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; flex-wrap: wrap; gap: 10px; }
    .card-header h2 { font-size: 1.05rem; }

    .tabs { display: flex; gap: 6px; background: #f0f2f1; padding: 4px; border-radius: 8px; }
    .tab { border: none; background: transparent; padding: 6px 14px; border-radius: 6px; font-size: 12.5px; font-weight: 600; color: #666; cursor: pointer; }
    .tab.active { background: #fff; color: var(--dark-green); box-shadow: 0 1px 3px rgba(0,0,0,0.1); }

    .chart-wrap { position: relative; height: 280px; }

    .grid-2 { display: grid; grid-template-columns: 1.3fr 1fr; gap: 20px; }
    @media (max-width: 900px) { .grid-2 { grid-template-columns: 1fr; } }

    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 11px 12px; text-align: left; font-size: 13px; border-bottom: 1px solid #f0f0f0; }
    th { background: #fafafa; font-weight: 700; color: #555; text-transform: uppercase; font-size: 10.5px; letter-spacing: 0.4px; }
    tr:last-child td { border-bottom: none; }
    .empty-cell { text-align: center; padding: 30px 20px; color: #888; }

    .filters { display: flex; gap: 12px; flex-wrap: wrap; align-items: end; margin-bottom: 20px; }
    .filters .fgroup { display: flex; flex-direction: column; gap: 5px; }
    .filters label { font-size: 11.5px; font-weight: 700; color: #666; text-transform: uppercase; }
    .filters input, .filters select { padding: 9px 12px; border: 1.5px solid #ddd; border-radius: 8px; font-size: 13.5px; }

    .pagination { display: flex; gap: 8px; justify-content: center; margin-top: 20px; }
    .pagination a, .pagination span { padding: 7px 13px; border-radius: 6px; font-size: 13px; text-decoration: none; color: #444; border: 1px solid #eee; }
    .pagination a:hover { background: #f4f6f5; }
    .pagination .current { background: var(--primary-green); color: #fff; border-color: var(--primary-green); }

    .badge { padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; display: inline-block; }
    .badge.ia { background: #e8f0fe; color: #1a56db; }
    .badge.manual { background: #f3f0ff; color: #6d28d9; }
    .badge.publicado { background: #eafaf1; color: #1e8449; }
    .badge.rascunho { background: #fff8e1; color: #b7791f; }
</style>
