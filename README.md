# libera.cash

Relançamento do funil de crédito pessoal que rodava como `credito.vc`
(marca vendida). Este projeto reaproveita toda a lógica de back-end e
refaz identidade visual, copy e domínio do zero.

Ver `CRONOGRAMA.md` para o plano de execução completo, `docs/infra-deploy.md`
para o passo a passo de deploy (Cloudflare + Hostinger + CloudPanel) e
`docs/briefing-marca.md` para as decisões de marca em aberto.

## Estrutura

```
projeto_liberacash/
├── CRONOGRAMA.md          # plano de execução por fases
├── .env.example            # variáveis de ambiente necessárias (sem valores reais)
├── docs/
│   ├── infra-deploy.md     # deploy Cloudflare + Hostinger + CloudPanel
│   └── briefing-marca.md   # perguntas em aberto sobre identidade visual
├── config/                 # segredos (gitignorado) — fora do document root
│   ├── aws-config.example.php
│   └── parceiros-config.example.php
├── sql/                    # schemas e migrações
└── public/                 # document root (é isso que o CloudPanel serve)
    ├── db.php               # conexão MySQL via variável de ambiente
    ├── index.php, sobre.php, contato.php, blog.php, cartoes.php...
    ├── steps/                # funil de qualificação (step1..step9)
    ├── painel/               # área logada do cliente
    ├── admin/, admin_blog/   # administração e CMS do blog
    ├── parceiros/            # integrações (Velotax)
    ├── css/, js/, images/    # assets do front — MUITOS precisam de rebrand
```

Por que `config/` fica fora de `public/`: no `credito.vc` original,
`aws-config.php` e `parceiros-config.php` viviam dentro da pasta servida
pela web. Se o servidor alguma vez servir PHP como texto puro por engano
(erro de configuração, arquivo `.php.bak`, etc.), um arquivo fora do
document root nunca fica exposto por acidente.

## O que já foi feito nesta reorganização

- Estrutura separada em `public/` (web), `config/` (segredos) `docs/` e `sql/`
- `db.php` não tem mais senha hardcoded — lê de variável de ambiente
  (`DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`)
- As duas conexões de banco redundantes que existiam (`db.php` e o antigo
  `db-config.php`) foram unificadas em uma só
- Dois bugs reais corrigidos: `contato.php` e `aguarde.php` apontavam pra
  um `db.php` fora do repositório e chamavam uma função inexistente
  (`get_db_connection()`) — na prática isso quer dizer que o formulário de
  contato e a página que salva o lead do funil provavelmente estavam
  quebrando. Corrigido nesta cópia.
- `EmailService.php` e `parceiros/velotax-client.php` agora apontam pra
  `config/aws-config.php` e `config/parceiros-config.php` (fora do
  document root) em vez de ficarem na raiz pública
- **Nenhuma credencial real foi copiada** — só os arquivos `.example.php`
  com placeholders. Os arquivos reais (`db-config.php`, `aws-config.php`,
  `parceiros-config.php`) do projeto antigo continuam expostos no
  histórico do Git do `credito.vc` e precisam ser rotacionados — ver
  "Ação imediata" em `CRONOGRAMA.md`.

## O que ainda precisa de trabalho manual (Fase 1-2 do cronograma)

- **28 arquivos PHP** ainda têm referências a `credito.vc` / `creditovc`
  (título, meta tags, links absolutos, JSON-LD, textos institucionais).
  Rode `grep -rl "credito" public --include="*.php"` pra ver a lista
  atualizada. Não fiz o find/replace ainda de propósito — isso deveria vir
  junto com a reescrita de copy, não só uma troca de domínio.
- `public/images/`: boa parte dos arquivos tem "creditovc" no nome ou é a
  arte da marca antiga (logo, favicon, banners de topo). Os banners de
  parceiros (Itaú, Carrefour, Juvo, Noverde, Creditas, LATAM Pass) são
  material dos próprios parceiros e podem continuar.
- `public/css/*.webflow.css` e `public/js/webflow.js` / `bundle.min.js`:
  decidir se mantém o export do Webflow ou migra pra algo mais leve.

## Setup local

1. `cp .env.example .env` e preencher com credenciais de desenvolvimento
2. `cp config/aws-config.example.php config/aws-config.php` (idem pro
   `parceiros-config.example.php`) e preencher se for testar essas
   integrações localmente
3. Servidor local PHP: `php -S localhost:8000 -t public`
