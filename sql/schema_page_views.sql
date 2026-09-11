-- =====================================================================
-- LiberaCash — Rastreamento de visitas (analytics próprio)
-- Uma linha por carregamento de página pública. Alimenta o dashboard
-- em /admin_dashboard/ (acessos por dia/semana/mês/hora, páginas mais
-- vistas). IP é armazenado só como hash (sha256), nunca em texto puro.
-- =====================================================================

CREATE TABLE IF NOT EXISTS page_views (
  id            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  path          VARCHAR(255) NOT NULL,
  referrer      VARCHAR(500) NULL,
  utm_source    VARCHAR(100) NULL,
  utm_medium    VARCHAR(100) NULL,
  utm_campaign  VARCHAR(100) NULL,
  user_agent    VARCHAR(255) NULL,
  ip_hash       CHAR(64) NULL,
  criado_em     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (id),
  KEY idx_pageviews_path (path),
  KEY idx_pageviews_criado (criado_em)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
