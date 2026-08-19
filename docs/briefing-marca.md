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
