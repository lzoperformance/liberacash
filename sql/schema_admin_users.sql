-- =====================================================================
-- LiberaCash — Usuários do admin_blog (CMS manual do blog)
-- Usada por: admin_blog/login.php
-- Não tinha schema nem nenhuma linha inserida — login nunca funcionou.
-- =====================================================================

CREATE TABLE IF NOT EXISTS admin_users (
  id            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  username      VARCHAR(80)  NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  criado_em     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (id),
  UNIQUE KEY uq_admin_users_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Pra criar o primeiro usuário admin, gere um hash com:
--   php -r "echo password_hash('SUA_SENHA_AQUI', PASSWORD_DEFAULT);"
-- e rode:
--   INSERT INTO admin_users (username, password_hash) VALUES ('admin', 'COLE_O_HASH_AQUI');
