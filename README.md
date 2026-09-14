# libera.cash

Relançamento do funil de crédito pessoal que rodava como `credito.vc`
(marca vendida). Este projeto reaproveita toda a lógica de back-end e
refaz identidade visual, copy e domínio do zero.

Ver `CRONOGRAMA.md` para o plano de execução completo, `docs/infra-deploy.md`
para o passo a passo de deploy (Cloudflare + Hostinger + CloudPanel),
`docs/briefing-marca.md` para as decisões de marca em aberto e
`design-system/readme.md` para o design system completo (tokens, componentes,
guidelines) usado como referência pro visual do produto.

## Estrutura

```
projeto_liberacash/
├── CRONOGRAMA.md          # plano de execução por fases
├── .env.example            # variáveis de ambiente necessárias (sem valores reais)
├── docs/
│   ├── infra-deploy.md     # deploy Cloudflare + Hostinger + CloudPanel
│   ├── briefing-marca.md   # perguntas em aberto sobre identidade visual
│   └── blog-pipeline.md    # pipeline autônomo de posts do blog
├── design-system/          # design system de referência (tokens, componentes
│   │                       # React+HTML navegáveis, guidelines) — ver seção própria abaixo
├── config/                 # segredos (gitignorado) — fora do document root
│   ├── aws-config.example.php
│   ├── db-config.example.php
│   ├── parceiros-config.example.php
│   └── anthropic-config.example.php
├── sql/                    # schemas e migrações
├── scripts/                 # jobs de linha de comando (fora do document root)
│   ├── blog-fetch-news.php  # pipeline de IA que busca notícias e gera posts
│   └── seed-initial-posts.php
└── public/                 # document root (é isso que o CloudPanel serve)
    ├── db.php               # conexão MySQL via variável de ambiente
    ├── track.php             # registra pageviews (analytics próprio)
    ├── index.php, sobre.php, contato.php, blog.php, cartoes.php...
    ├── steps/                # funil de qualificação (step1..step9)
    ├── painel/               # área logada do cliente
    ├── admin_blog/           # CMS do blog (login próprio, tabela admin_users)
    ├── admin_dashboard/      # analytics + leads + métricas do blog (mesmo login do admin_blog)
    ├── parceiros/            # integrações (Velotax)
    ├── css/, js/, images/    # assets do front
```

## Design system (`design-system/`)

Design system gerado por ferramenta de IA (Stitch/Google Labs), usado como
referência visual pro produto — não é o CSS que o site público usa hoje
(esse continua em `public/css/brand-tokens.css`). Ponto de partida:
`design-system/readme.md`.

- `tokens/` — CSS puro (cores, tipografia, espaçamento, raios, sombras,
  movimento) — o mais fácil de já aproveitar em qualquer página nova.
- `components/` — primitivos em React (`.jsx`) com preview em HTML
  (`*.card.html`) que abre sozinho no navegador. **Este projeto não tem
  toolchain de JS/React** (é PHP puro, sem build step), então os `.jsx` são
  especificação/referência de estrutura e estado, não algo "plugável" direto
  — qualquer tela nova em PHP precisa ser reconstruída em HTML/CSS a partir
  deles, como já foi feito manualmente pro resto do site.
- `guidelines/` e `ui_kits/admin-dashboard/` — specimens e a tela cheia do
  dashboard administrativo, todos abríveis direto no navegador
  (`file://.../design-system/...html` ou servindo a pasta).
- `shots/` — as 29 capturas do case de referência (Behance, projeto "Fynix")
  que orientaram a linguagem visual. Mantidas só como consulta; nada da marca
  do projeto de referência foi copiado — a marca aqui é 100% LiberaCash.
- `_ds_bundle.js` — **não é lixo interno da ferramenta**: é o bundle dos
  componentes React que os arquivos de `ui_kits/` carregam em tempo real
  (via Babel standalone, sem build step) pra renderizar a prévia. Precisa
  continuar na raiz de `design-system/` pros previews não quebrarem.
- `_ds_manifest.json` — metadado da ferramenta (lista de componentes/origem);
  mantido por documentação, não é usado por nenhum HTML de preview.
- `_adherence.oxlintrc.json` — regra de lint (oxlint) de aderência ao design
  system. Não foi ligada a nenhum pipeline porque o projeto não roda lint de
  JS hoje (não há `package.json`/build de front-end) — fica pronta pra quando
  isso existir.

**O que ficou de fora da exportação original** (`~/Downloads/LiberaCash-DesignSystem`),
por ser derivado/cru, não por decisão de conteúdo:
- `uploads/` — as 29 capturas de tela brutas + `logoLC.png` +
  a imagem do WhatsApp, já processadas e superadas por `shots/` (normalizadas)
  e `assets/` (logo tratado).

Não havia nenhum arquivo `DESIGN.md`/`SKILL.md` nem `thumbnail.html` na
exportação, apesar de `readme.md` citar os dois — nem `ui_kits/mobile-app/`
e `ui_kits/landing/`, também citados no índice do próprio readme mas
ausentes da pasta. Aparenta ser uma exportação parcial da ferramenta; se
esses três pedaços fizerem falta, vale re-exportar do Stitch/Google Labs.

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
