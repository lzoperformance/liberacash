# Briefing de marca — libera.cash

Perguntas em aberto pra fechar antes/durante a Fase 1 do cronograma.
Preencher conforme for decidindo — isso vira a referência pra logo, cores,
copy e para qualquer designer/IA gerando peças visuais depois.

## Posicionamento

- Público-alvo principal (ex.: negativados, autônomos, quem busca crédito
  rápido) — o credito.vc mirava bastante "empréstimo pra negativado";
  continua o mesmo foco?
- Tom de voz: mais institucional/confiável (bancos tradicionais) ou mais
  direto/popular (fintech, linguagem simples)?
- O nome "libera.cash" sugere agilidade/desburocratização — vale reforçar
  isso na tagline (ex.: "libera na hora", "sem burocracia")

## Identidade visual

### Paleta — DECIDIDO ✅ (extraída do logo, ver `public/css/brand-tokens.css`)

| Token | Hex | Uso |
|---|---|---|
| `--lc-green-400` | `#8CE64E` | verde lima, ponta esquerda do logo |
| `--lc-green-300` | `#3DDC91` | verde menta/teal, ponta direita do logo |
| `--lc-green-500` | `#5FDD7A` | verde base — CTA, links, destaques |
| `--lc-green-600` | `#2FBE63` | hover/estado ativo |
| `--lc-bg-dark-900/800/700` | `#071A0F` / `#0B2415` / `#0F2E1B` | fundo escuro (hero, footer) — mesmo tom do fundo do logo |
| `--lc-off-white` | `#EAFBEF` | texto sobre fundo escuro |

Valores extraídos visualmente do arquivo de logo enviado (ainda não temos o
arquivo fonte/vetor — pedir PNG ou SVG original pra recalibrar se
necessário, e pra gerar favicon/OG image em alta resolução).

### Logo — versão atualizada (2ª rodada)

Lockup definido: ícone (quadrado arredondado, monograma "Lc" em verde
escuro sobre fundo em gradiente verde-lima, com glow) + wordmark
"**Libera**Cash" — "Libera" em cor neutra (preto no fundo claro, branco no
fundo escuro) e "**Cash**" em verde de destaque, mesma cor do ícone.
Testado em fundo claro e em fundo escuro (`--lc-bg-dark-800`), os dois
funcionam.

Isso define o nome de marca por extenso como **"LiberaCash"** (uma
palavra, L e C maiúsculos) — usar essa grafia em textos/título, mantendo
`libera.cash` só como domínio/URL.

### Ícone — RECEBIDO ✅

Arquivo real recebido (`public/images/logo-icon.png`, 546×546, fundo
transparente). A paleta em `brand-tokens.css` foi recalibrada por
amostragem de pixel direto desse arquivo (não é mais estimativa visual):
verde do fundo `#83E167` → `#6BE193`, verde do monograma `#16562D` /
`#368C52`.

A partir dele já gerei e apliquei em produção:
- `public/images/favicon.png` (64×64) — as páginas referenciam
  `images/favicon.png` por caminho relativo, então trocar o arquivo já
  atualiza o favicon em todo o site, sem editar HTML
- `public/images/webclip.png` (180×180, apple-touch-icon) — mesma lógica

### Wordmark completo — RECEBIDO ✅

Três arquivos reais recebidos e organizados:
- `public/images/logo-full-black-text.png` — "Libera" preto + "Cash" verde,
  fundo transparente → usado como `logo.png` (header, fundo claro)
- `public/images/logo-full-white-text.png` — "Libera" branco + "Cash"
  verde, fundo transparente → usado como `logo-footer.png` (footer —
  **assumi fundo escuro no footer**, não consegui confirmar isso no CSS do
  Webflow antigo por regex; conferir visualmente na Fase 5/QA e trocar por
  `logo-full-black-text.png` se o footer for claro)
- `public/images/logo-full-dark.png` — versão já composta sobre fundo verde
  escuro (sem transparência) — boa candidata pra `og:image`/social card
  mais pra frente

Todas as 10 páginas que referenciavam o logo (`index`, `sobre`, `cartoes`,
`contato`, `time`, `blog`, `sucesso`, `politica-de-privacidade`,
`termos-e-condicoes`) foram atualizadas. De quebra, corrigi um problema
real que apareceu nesse processo: essas páginas carregavam o logo (e vários
banners/links) direto de `https://www.credito.vc/...` — domínio que não é
mais do usuário. Isso foi trocado por caminhos relativos, e os metadados
que precisam ser absolutos (og:url, og:image, canonical, JSON-LD) passaram
a apontar pro domínio novo (`libera.cash`). Detalhe no commit
`4cb6ee5`.

**Ainda pendente:**
- Confirmar visualmente se o footer é claro ou escuro (decide qual versão
  do wordmark fica lá)
- `alt="Crédito.vc"` nas tags de imagem do logo ainda não foi atualizado
  pra "LiberaCash" (cosmético, fica pra Fase 2 junto com o resto da cópia)
- Texto jurídico de termos/política ainda cita `www.credito.vc` — precisa
  de revisão legal de verdade com CNPJ/razão social novos, não é find-replace
- `cartoes.php` tem uma referência solta a um domínio diferente,
  `financeiro.vc` (og:image/og:title), não relacionada ao credito.vc —
  verificar o que é isso antes de decidir o que fazer

Racional: verde reforça "dinheiro liberado" de forma mais direta que o
azul do credito.vc, e o nome `libera.cash` pede um visual mais
ágil/desburocratizado — o gradiente lima→menta ajuda nisso sem cair no
azul-corporativo de banco tradicional.

- Logo: recebido como imagem no chat (símbolo "L" em gradiente verde sobre
  fundo verde escuro). **Falta o arquivo fonte** (PNG/SVG) pra colocar de
  verdade no projeto — favicon precisa de versão quadrada simplificada
  (o "L" sozinho funciona bem pra isso), header precisa de versão com o
  nome "libera.cash" ao lado
- Tipografia — ainda em aberto
- Ícones/ilustrações: o `public/images/` copiado tem uma pasta grande com
  nomes como `logo-creditovc.png`, `banner-header-creditovc.jpg`,
  `smile-creditovc.png` etc. — tudo com "creditovc" no nome ou na arte
  precisa ser refeito. Já os banners de parceiros (Itaú, Carrefour, Juvo,
  Noverde, Creditas, LATAM Pass, Azul) são material dos próprios parceiros
  e podem continuar, desde que a parceria siga ativa sob o novo domínio.

## Produtos e parceiros

- Quais produtos do `produtos-config.php` continuam: crédito pessoal,
  garantia de celular, cartões?
- A parceria com a Velotax segue? (é a única integração de API real hoje,
  em `public/parceiros/velotax-client.php`)
- Outros parceiros (Itaú, Carrefour, Juvo, Noverde, Creditas) — contato já
  feito pra atualizar cadastro com o novo domínio?

## Conteúdo institucional

- Política de privacidade e termos: o texto jurídico atual (LGPD, CET,
  taxas) pode servir de estrutura, mas precisa revisão jurídica com o novo
  nome/CNPJ antes de publicar
- Blog: reaproveitar posts (com revisão de marca) ou recomeçar do zero?
