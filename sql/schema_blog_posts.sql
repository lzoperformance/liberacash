-- =====================================================================
-- LiberaCash — Schema do Blog
-- Usada por: admin_blog/* (CMS manual) e scripts/blog-fetch-news.php
-- (pipeline autônomo de notícias)
-- =====================================================================

CREATE TABLE IF NOT EXISTS blog_posts (
  id                INT UNSIGNED NOT NULL AUTO_INCREMENT,
  slug              VARCHAR(220)  NOT NULL,
  titulo            VARCHAR(255)  NOT NULL,
  subtitulo         VARCHAR(255)  NULL,
  conteudo          LONGTEXT      NOT NULL,
  resumo            TEXT          NULL,
  imagem_capa       VARCHAR(500)  NULL,
  categoria         VARCHAR(100)  NOT NULL,
  autor             VARCHAR(150)  NULL,
  status            ENUM('publicado','rascunho') NOT NULL DEFAULT 'rascunho',
  meta_title        VARCHAR(255)  NULL,
  meta_description  VARCHAR(500)  NULL,

  -- Usados pelo pipeline autônomo (scripts/blog-fetch-news.php) —
  -- ficam NULL em posts escritos manualmente pelo admin_blog.
  gerado_por_ia     TINYINT(1)    NOT NULL DEFAULT 0,
  fonte_nome        VARCHAR(100)  NULL,          -- ex.: "InfoMoney"
  fonte_url         VARCHAR(500)  NULL,          -- link do artigo original, pra atribuição e pra evitar duplicar

  created_at        DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at        DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  PRIMARY KEY (id),
  UNIQUE KEY uq_blog_posts_slug (slug),
  KEY idx_blog_posts_fonte_url (fonte_url(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
