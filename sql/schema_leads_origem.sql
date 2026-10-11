-- =====================================================================
-- leads_origem
-- Origem (primeiro clique) de cada lead cadastrado. 1:1 com usuarios.
-- Preenchida por lc_attr_gravar() em public/attribution.php, chamada no
-- register.php. Só existe linha para quem chegou por link com parâmetros
-- de campanha (utm_*, source, ftid, sub1..sub7, fbclid, gclid...);
-- cadastro direto não gera linha (use LEFT JOIN nos relatórios).
-- =====================================================================
CREATE TABLE IF NOT EXISTS leads_origem (
  id                 INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id            INT UNSIGNED NOT NULL,

  utm_source         VARCHAR(150) NULL,
  utm_medium         VARCHAR(150) NULL,
  utm_campaign       VARCHAR(150) NULL,
  utm_content        VARCHAR(150) NULL,
  utm_term           VARCHAR(150) NULL,

  `source`           VARCHAR(150) NULL,   -- parâmetro ?source= da plataforma de atribuição
  ftid               VARCHAR(150) NULL,   -- id único do clique na plataforma
  campaign_code      VARCHAR(150) NULL,

  sub1               VARCHAR(150) NULL,
  sub2               VARCHAR(150) NULL,
  sub3               VARCHAR(150) NULL,
  sub4               VARCHAR(150) NULL,
  sub5               VARCHAR(150) NULL,
  sub6               VARCHAR(150) NULL,
  sub7               VARCHAR(150) NULL,

  fbclid             VARCHAR(255) NULL,
  gclid              VARCHAR(255) NULL,
  ttclid             VARCHAR(255) NULL,

  landing_path       VARCHAR(255) NULL,   -- página em que o visitante entrou
  referrer           VARCHAR(500) NULL,
  primeiro_clique_em DATETIME     NULL,   -- quando o clique foi capturado (cookie)
  criado_em          DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (id),
  UNIQUE KEY uq_leads_origem_user (user_id),
  KEY idx_leads_origem_utm_source   (utm_source),
  KEY idx_leads_origem_utm_campaign (utm_campaign),
  KEY idx_leads_origem_source       (`source`),
  KEY idx_leads_origem_ftid         (ftid),
  CONSTRAINT fk_leads_origem_user
    FOREIGN KEY (user_id) REFERENCES usuarios(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
