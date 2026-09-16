# Headers de segurança — configuração de infraestrutura

A Fase 4 da auditoria (CSP, HSTS, Permissions-Policy) não dá pra
resolver editando os arquivos PHP — precisa ser configurado no nginx
(CloudPanel Vhost Editor) ou no Cloudflare. Este documento tem a
configuração exata pra colar, igual foi feito antes pras regras de
rewrite das URLs limpas.

## O que já existe (confirmado via `curl -sI https://libera.cash/`)

```
x-frame-options: SAMEORIGIN
x-content-type-options: nosniff
referrer-policy: same-origin
```

## O que falta

### 1. HSTS (baixo risco — pode ativar direto)

O site já roda 100% em HTTPS em todas as páginas testadas, então isso
é seguro de ligar sem passo intermediário.

```nginx
add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;
```

### 2. Permissions-Policy (baixo risco — pode ativar direto)

Desativa APIs de navegador que o site não usa (câmera, microfone,
geolocalização, etc.). Não afeta nada que já funciona hoje.

```nginx
add_header Permissions-Policy "camera=(), microphone=(), geolocation=(), payment=()" always;
```

### 3. CSP (Content-Security-Policy) — ativar em Report-Only PRIMEIRO

Esse é o único que tem risco real de quebrar alguma coisa se a lista
de domínios permitidos estiver incompleta — a própria auditoria pede
pra começar em modo "Report-Only" (só avisa no console do navegador,
não bloqueia nada) antes de aplicar de verdade.

Mapeei todo domínio externo que o site carrega hoje (script, estilo,
fonte, imagem, iframe) varrendo os arquivos PHP:

- `www.googletagmanager.com` — GTM
- `www.google-analytics.com`, `*.google-analytics.com`,
  `*.analytics.google.com` — GA4 (o endpoint de coleta varia por
  região/sessão, por isso o wildcard)
- `fonts.googleapis.com` — CSS de fontes
- `fonts.gstatic.com` — arquivos de fonte
- `cdnjs.cloudflare.com` — Font Awesome, jQuery, jQuery Mask, Chart.js
  (admin)
- `code.jquery.com` — jQuery UI (só em cartoes.php)
- `unpkg.com` — Phosphor Icons (home e produtos.php)
- `ajax.googleapis.com` — WebFont Loader (cartoes.php,
  sucessoMetaTags.php)
- `pagead2.googlesyndication.com` — Google AdSense (cartoes.php)

**Passo 1 — cole isso no Vhost Editor (bloco `listen 8080`, mesmo
lugar das regras de rewrite):**

```nginx
add_header Content-Security-Policy-Report-Only "default-src 'self'; script-src 'self' 'unsafe-inline' www.googletagmanager.com www.google-analytics.com cdnjs.cloudflare.com code.jquery.com unpkg.com ajax.googleapis.com pagead2.googlesyndication.com; style-src 'self' 'unsafe-inline' fonts.googleapis.com cdnjs.cloudflare.com; font-src 'self' fonts.gstatic.com cdnjs.cloudflare.com; img-src 'self' data: www.google-analytics.com; connect-src 'self' www.google-analytics.com *.google-analytics.com *.analytics.google.com; frame-src www.googletagmanager.com;" always;
```

**Passo 2 — deixa rodando pelo menos 3-5 dias.** Abre o site, abre o
DevTools (F12) → aba Console, navega pelas páginas principais
(home, cartões, blog, contato, sobre, o modal de cadastro/login) e
procura por mensagens tipo `Content-Security-Policy-Report-Only:
The page's settings blocked...`. Cada uma dessas aponta um domínio
que faltou na lista acima.

**Passo 3 — só depois de rodar limpo por alguns dias**, troca
`Content-Security-Policy-Report-Only` por `Content-Security-Policy`
(remove o `-Report-Only`) pra passar a bloquear de verdade.

## Comandos de validação

Depois de aplicar, confirma que os headers estão saindo:

```bash
curl -sI https://libera.cash/ | grep -iE "strict-transport|permissions-policy|content-security-policy"
```

## Por que não fiz isso direto no código

Essas diretivas vivem na config do nginx (CloudPanel), não em nenhum
arquivo PHP do repositório — não tem `.htaccess` sendo lido (nginx não
lê Apache config, é um problema que já resolvemos antes nesse
projeto) e não faz sentido adicionar via `header()` no PHP porque
teria que estar em toda página individualmente e ainda assim não
cobriria assets estáticos (CSS/JS/imagens) servidos direto pelo nginx.
