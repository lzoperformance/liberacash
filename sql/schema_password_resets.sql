-- =====================================================================
-- Crédito.vc — Tabela de tokens de recuperação de senha
-- Banco: creditovc
-- Usada por: forgot-password.php (gera) e um futuro reset-password.php (consome)
-- =====================================================================

CREATE TABLE IF NOT EXISTS password_resets (
  id           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id      INT UNSIGNED NOT NULL,
  token_hash   CHAR(64)     NOT NULL,          -- sha256 do token (nunca guardamos o token puro)
  expira_em    DATETIME     NOT NULL,
  usado        TINYINT(1)   NOT NULL DEFAULT 0,
  criado_em    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (id),
  KEY idx_password_resets_user  (user_id),
  KEY idx_password_resets_token (token_hash),
  CONSTRAINT fk_password_resets_user
    FOREIGN KEY (user_id) REFERENCES usuarios(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
