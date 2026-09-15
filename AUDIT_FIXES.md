# Auditoria técnica LiberaCash — registro de correções

Este arquivo documenta a execução da auditoria técnica externa (performance,
SEO, acessibilidade, segurança) recebida em 2026-09-15. Trabalho feito em
fases, com checkpoint (commit + relatório) ao final de cada uma — combinado
com o operador do projeto.

## Nota sobre o escopo original da auditoria

O documento da auditoria foi escrito como um prompt genérico para um agente
rodando num projeto com `npm`, pipeline de lint/build/CI e Playwright. Este
projeto é **PHP procedural + export do Webflow**, sem esse tooling (sem
`package.json`, sem CI, sem suíte de testes automatizados, deploy via
`git pull` manual no servidor). Cada item real da auditoria foi traduzido
para o stack de verdade deste projeto em vez de forçar ferramentas que não
existem aqui. Validação de sintaxe PHP é feita via PHPStan playground API
(`https://api.phpstan.org/analyse`, sem PHP local instalado). Não há
Lighthouse local — métricas de bytes/tamanho/TTFB abaixo foram medidas
diretamente (curl, `sips`, tamanho de arquivo real); os scores de
Performance/Accessibility/SEO do Lighthouse precisam ser medidos pelo
operador no Chrome DevTools antes/depois de cada fase, porque a auditoria é
explícita: **não inventar métricas**.

## FASE 0 — Baseline (repositório)

- Stack: PHP procedural (sem framework), MySQL/MariaDB via PDO, nginx +
  PHP-FPM (CloudPanel/Hostinger), Cloudflare na frente, deploy por
  `git pull` manual.
- Sem testes automatizados, sem lint/build configurado, sem CI/CD.
- Head/canonical/meta robots/JSON-LD são gerados inline em cada página
  pública (`public/*.php`), não há template engine compartilhado — cada
  página tem seu próprio `<head>`.
- Rotas públicas principais: `/`, `/cartoes/`, `/blog/` (+ posts), `/sobre/`,
  `/contato/`, `/termos-e-condicoes/`, `/politica-de-privacidade/`.

## FASE 1.1 — Imagens (CONCLUÍDO — checkpoint 1)

### Baseline medido (2026-09-15, antes da correção)

| Asset | Dimensão real | Exibido a | Peso PNG original |
|---|---|---|---|
| `hero-mulher-nova.png` | 1200×917 | até 580px (desktop) / 100vw (mobile) | 965 KB |
| `logo.png` / `logo-footer.png` | 1529×532 | 34–52px de altura | 58 KB |
| `banner-juvo-creditovc.png` | 684×156 | 684×156 (1:1, container já bate) | 76,7 KB |
| `banner-itaul-infinity.png` | 684×156 | 684×156 | 109,1 KB |
| `smile-creditovc.png` | 512×512 | 45px de altura | 16,4 KB |
| `smartphone-creditovc.png` | 512×512 | 45px de altura | 6,7 KB |
| `money-bag-creditovc.png` | 512×512 | 45px de altura | 16,5 KB |

Nenhuma dessas tags `<img>` tinha `width`, `height`, `srcset` ou `loading`.
Confirma o achado da auditoria (LCP mobile ~13,72s, imagem LCP = hero sem
dimensões).

TTFB medido agora (3 requisições, `curl`, edge cache HIT): 82–268ms — bem
abaixo do que a auditoria registrou (762ms–2,58s). Não sei se a diferença é
cache Cloudflare aquecido ou localização; registro os dois valores, não
assumo qual é o "real" sem o operador rodar Lighthouse.

### O que foi feito

- Gerado AVIF + WebP (com `cwebp`/`avifenc`, instalados via Homebrew nesta
  máquina) para os 7 assets prioritários, em `<picture>` com fallback PNG.
- Hero: 4 variantes responsivas (480/580/960/1200w) em AVIF/WebP, `srcset`
  + `sizes`, `width="1200" height="917"` no `<img>` fallback,
  `fetchpriority="high"`, sem `loading="lazy"` (é o elemento LCP).
- Logo/logo-footer (mesmo arquivo, usado em ~13 páginas): **arquivo mestre
  substituído** por uma versão redimensionada (1529×532 → 480×167 — ainda
  dá margem de até ~3x retina para o maior uso real, 52px no footer).
  Isso corrige o peso em todas as páginas de uma vez, sem editar cada
  template. Versão com cache-bust `?v=3` (era `?v=2`) em todas as ~21
  ocorrências — necessário porque o Cloudflare cacheia essas URLs por
  10 anos (`cache-control: max-age=315360000`); sem trocar a versão, o
  arquivo antigo continuaria sendo servido do edge cache.
- Ícones (smile/smartphone/money-bag): versões dimensionadas a 120px
  (cobre retina até ~2,6x) em vez de 512×512. `alt=""` — são decorativos,
  o `<h4>` ao lado já descreve o conteúdo (WCAG: imagem decorativa não
  precisa de alt descritivo).
- Banners: já estavam no tamanho certo (684×156 = tamanho do container),
  só receberam AVIF/WebP + `width`/`height`. Segundo e terceiro slide do
  carrossel (fora da viewport inicial) ganharam `loading="lazy"`; o
  primeiro slide não, por estar visível de cara.
- `decoding="async"` em todas as imagens acima.
- Adicionado `width`/`height` a todas as 21 tags de logo espalhadas pelo
  site (public + painel + admin), prevenindo layout shift.

### Resultado medido (arquivo gerado vs. original, mesmo conteúdo visual)

| Asset | PNG original | AVIF (o que a maioria dos navegadores vai baixar) | Redução |
|---|---|---|---|
| hero (mobile, 480w) | 965 KB | 23,7 KB | **97,5%** |
| hero (desktop, 580w) | 965 KB | 29,0 KB | **97,0%** |
| logo/logo-footer | 58 KB | 7,7 KB (avif 480w) | **86,7%** |
| banner-juvo | 76,7 KB | 9,9 KB | **87,1%** |
| banner-itau-infinity | 109,1 KB | 12,4 KB | **88,6%** |
| smile | 16,4 KB | 2,7 KB | **83,7%** |
| smartphone | 6,7 KB | 1,5 KB | **77,4%** |
| money-bag | 16,5 KB | 2,5 KB | **84,7%** |

Economia só nesses 7 assets, no cenário mobile (hero em 480w): de
~1.265 KB para ~60 KB carregados — cerca de **1,2 MB a menos** no payload
da home no pior caso (primeira visita, sem cache).

### Itens NÃO cobertos nesta fase (ficam para o próximo checkpoint)

- `#linkbanner#` (e `#linkbanner4#` em blog.php): links mortos nos
  banners do carrossel, e um dos 3 slides da home é literalmente a MESMA
  imagem do slide 1 duplicada com alt-text errado. **Isso não é só SEO —
  hoje 2 dos 3 slides do carrossel da home não levam a lugar nenhum.**
  Vou tratar isso na FASE 2 (SEO técnico / links), mas quero confirmar
  com o operador qual deve ser o destino real de cada slide antes de
  mudar um link de conversão.
- `banner-itaul-passai.png` (usado só em blog.php) ainda não foi otimizado
  — não estava na lista de "assets prioritários" da auditoria, mas mesma
  categoria de problema. Fica pro próximo checkpoint de imagens.
- CSS crítico / render-blocking (1.2), JS (1.3), fontes (1.4), TTFB/HTML
  inicial (1.5) — ainda não iniciado.
- `<picture>` com AVIF/WebP para o logo nas ~11 páginas que não são
  index.php/blog.php ainda usam só o PNG (já menor, mas sem os formatos
  modernos) — o arquivo mestre já está otimizado em todas, só falta o
  `<picture>` nelas se quiser espremer mais.

### Riscos residuais / o que testar depois do deploy

- Cache do Cloudflare: como os arquivos `logo.png`/`logo-footer.png`
  foram sobrescritos com o MESMO nome, e o cache-bust mudou de `?v=2`
  para `?v=3`, isso deve forçar tudo a buscar a versão nova. Se algum
  lugar aparecer com o logo "puxado" (esticado) depois do deploy, é
  sinal de cache do navegador do usuário — pedir refresh forçado
  (Cmd+Shift+R).
- Testar visualmente em pelo menos 2 navegadores reais (o `<picture>`
  com AVIF é suportado por tudo que interessa hoje — Chrome, Edge,
  Firefox, Safari 16+ — mas vale conferir).
- Pedir ao operador rodar Lighthouse mobile + desktop na home
  ANTES de considerar esta fase "validada de verdade" — o que medi acima
  é peso de arquivo, não o score do Lighthouse.

## Comandos executados (reprodutibilidade)

```bash
# instalação das ferramentas de conversão (uma vez, nesta máquina)
brew install webp libavif libtiff

# conversão (exemplo do hero, repetido para cada asset/largura)
sips -Z 580 hero-mulher-nova.png --out hero-580w.png
cwebp -q 82 hero-580w.png -o hero-580w.webp
avifenc -q 60 --speed 6 hero-580w.png hero-580w.avif

# validação de sintaxe PHP (sem PHP local — via PHPStan playground API)
curl -s -X POST https://api.phpstan.org/analyse \
  -H "Content-Type: application/json" \
  -d '{"code": "<conteúdo do arquivo>", "level": "1", "phpVersion": 70200}'
```

## Itens bloqueados (precisam de acesso/decisão externa)

- Lighthouse real (mobile/mobile) antes/depois: **BLOQUEADO — REQUER
  CHROME DEVTOOLS DO OPERADOR**. Comando: abrir DevTools → aba
  Lighthouse → Mobile → Analyze page load, na home em produção.
- CSP/HSTS/Permissions-Policy (Fase 4): dependem de configuração no
  Cloudflare/CloudPanel, fora do repositório. Serão documentados num
  `INFRA_SECURITY_HEADERS.md` quando chegarmos nessa fase.
