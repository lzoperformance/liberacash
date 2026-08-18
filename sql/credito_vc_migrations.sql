-- =====================================================================
-- Crédito.vc — Migração incremental para o novo painel
-- Rodar depois de schema_usuarios.sql (não altera as tabelas existentes)
-- =====================================================================

-- ---------------------------------------------------------------------
-- Tabela: historico_solicitacoes
-- Um registro por clique em card de produto / simulação disparada.
-- Alimenta a tela "Histórico" e também é o que decide se um card
-- mostra "Continuar Proposta" (status em aberto) ou "Ver oferta" normal.
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS historico_solicitacoes (
  id             INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id        INT UNSIGNED NOT NULL,
  produto_slug   VARCHAR(30)  NOT NULL,          -- bate com a chave em produtos-config.php
  parceiro       VARCHAR(100) NULL,               -- nome do parceiro no momento do clique (Volotax, Juvo, NoVerde...)
  valor_solicitado DECIMAL(12,2) NULL,
  status         ENUM('pre_aprovado','em_analise','proposta_concluida','recusado') NOT NULL DEFAULT 'pre_aprovado',
  utm_source     VARCHAR(100) NULL,
  utm_medium     VARCHAR(100) NULL,
  utm_campaign   VARCHAR(100) NULL,
  url_parceiro   VARCHAR(500) NULL,               -- URL final com UTMs, pra reabrir em "Continuar Proposta"
  resposta_api_bruta TEXT NULL,                    -- JSON cru da resposta do parceiro (debug, enquanto o formato não está 100% mapeado)
  criado_em      DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  atualizado_em  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  PRIMARY KEY (id),
  KEY idx_historico_user (user_id),
  KEY idx_historico_status (status),
  CONSTRAINT fk_historico_user
    FOREIGN KEY (user_id) REFERENCES usuarios(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- perfil_usuario já cobre todos os campos pedidos no novo fluxo
-- (cep, logradouro, bairro, cidade, estado, data_nascimento, fonte_renda,
--  renda_mensal, negativado, modelo_celular) — nenhuma coluna nova aqui.
-- Só um índice pra acelerar a checagem de completude por produto.
-- Se algum já existir, o MySQL retorna "Duplicate key name" — pode ignorar.
-- ---------------------------------------------------------------------
ALTER TABLE perfil_usuario ADD INDEX idx_perfil_negativado (negativado);
ALTER TABLE perfil_usuario ADD INDEX idx_perfil_cidade_estado (cidade, estado);

-- ---------------------------------------------------------------------
-- Se você já rodou a migração acima antes desta atualização (ou seja,
-- a tabela historico_solicitacoes já existe sem a coluna resposta_api_bruta),
-- rode só esta linha isolada:
-- ---------------------------------------------------------------------
-- ALTER TABLE historico_solicitacoes ADD COLUMN resposta_api_bruta TEXT NULL AFTER url_parceiro;
