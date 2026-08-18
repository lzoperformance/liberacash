-- =====================================================================
-- Crédito.vc — Schema de Usuários e Perfil
-- Banco: creditovc
-- =====================================================================

-- ---------------------------------------------------------------------
-- Tabela: usuarios
-- Dados básicos de conta, criados no cadastro rápido (Tela 1 do modal)
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS usuarios (
  id            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nome          VARCHAR(150) NOT NULL,
  cpf           CHAR(11)     NOT NULL,          -- armazenado só com dígitos (sem máscara)
  email         VARCHAR(150) NOT NULL,
  celular       VARCHAR(11)  NOT NULL,          -- só dígitos, com DDD
  senha_hash    VARCHAR(255) NOT NULL,          -- password_hash() / BCRYPT
  criado_em     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  atualizado_em DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  ultimo_login  DATETIME     NULL,
  ativo         TINYINT(1)   NOT NULL DEFAULT 1,

  PRIMARY KEY (id),
  UNIQUE KEY uq_usuarios_cpf   (cpf),
  UNIQUE KEY uq_usuarios_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Tabela: perfil_usuario
-- Dados complementares preenchidos progressivamente após o cadastro
-- (endereço, renda, negativação, dispositivo, etc.) — 1:1 com usuarios
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS perfil_usuario (
  user_id          INT UNSIGNED NOT NULL,

  -- Endereço
  cep              CHAR(8)      NULL,
  logradouro       VARCHAR(150) NULL,
  numero           VARCHAR(20)  NULL,
  complemento      VARCHAR(100) NULL,
  bairro           VARCHAR(100) NULL,
  cidade           VARCHAR(100) NULL,
  estado           CHAR(2)      NULL,

  -- Perfil pessoal
  data_nascimento  DATE         NULL,
  genero           VARCHAR(20)  NULL,           -- masculino | feminino | outro | nao_informar
  estado_civil     VARCHAR(20)  NULL,           -- solteiro | casado | divorciado | viuvo | uniao_estavel

  -- Renda / crédito
  fonte_renda      VARCHAR(30)  NULL,           -- assalariado_clt | autonomo | empresario | aposentado_pensionista | servidor_publico | militar | desempregado
  renda_mensal     DECIMAL(12,2) NULL,
  possui_cartao    TINYINT(1)   NULL,           -- 1 = sim, 0 = não
  negativado       ENUM('sim','nao','nao_sei') NULL,

  -- Empréstimo desejado
  produto_interesse VARCHAR(30) NULL,           -- slug do produto (credito-pessoal, garantia-celular, conta-luz, garantia-auto, garantia-imovel, consignado)
  valor_desejado    DECIMAL(12,2) NULL,

  -- Garantia por celular
  modelo_celular    VARCHAR(100) NULL,
  sistema_celular   ENUM('android','ios') NULL,

  atualizado_em    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  PRIMARY KEY (user_id),
  CONSTRAINT fk_perfil_usuario_user
    FOREIGN KEY (user_id) REFERENCES usuarios(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
