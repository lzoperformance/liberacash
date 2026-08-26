-- =====================================================================
-- LiberaCash — Adiciona coluna de visualizações em blog_posts
-- Faltava desde a criação da tabela: blog.php já tentava fazer
-- "UPDATE blog_posts SET views = views + 1" ao abrir um post, o que
-- causava erro 500 em toda página de post individual (coluna não existe).
-- Também usada pelo novo bloco "Mais lidos" da sidebar do blog.
-- =====================================================================

ALTER TABLE blog_posts
  ADD COLUMN IF NOT EXISTS views INT UNSIGNED NOT NULL DEFAULT 0 AFTER fonte_url;
