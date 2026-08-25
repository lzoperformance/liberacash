# Blog autônomo — pipeline de notícias

## Como funciona

`scripts/blog-fetch-news.php` roda via linha de comando (cron, não web):

1. Busca RSS de InfoMoney, G1 Economia e UOL Economia
2. Filtra só itens cujo título/resumo bate com palavra-chave de
   crédito/empréstimo/finanças pessoais (lista em `PALAVRAS_CHAVE` no script)
3. Pula o que já virou post antes (checa por `fonte_url`)
4. Pra cada notícia nova, chama a API da Anthropic pra escrever um post
   **original** (nunca cópia da fonte) — resumo/análise própria, tom
   acessível, terminando com atribuição clara + link pra matéria original
5. Grava em `blog_posts` como **rascunho** (não publica sozinho, de
   propósito — revise em `/admin_blog/` antes de publicar de verdade,
   pelo menos até confiar na qualidade)
6. Trava de segurança: no máximo 3 posts por execução (`MAX_POSTS_POR_EXECUCAO`)

## Por que não copiei o modelo do previeweb.online

Aquele portal parece reescrever matérias da InfoMoney com bylines de
"especialistas" (ex-diretor do Banco Central etc.) que muito provavelmente
são personas fictícias. Isso mistura dois riscos: direito autoral (se não
for claramente resumo+atribuição) e informação enganosa (credencial que
não existe). Esse pipeline aqui só resume com atribuição visível e link
pra fonte real — sem personas inventadas.

## Setup

### 1. Rodar as migrações que faltam

`blog_posts` e `admin_users` nunca tiveram schema — o blog nunca teve
banco de verdade rodando. Via SSH:

```bash
cd /home/libera1/htdocs/libera.cash
mysql -u liberacash -p -h 127.0.0.1 liberacash < sql/schema_blog_posts.sql
mysql -u liberacash -p -h 127.0.0.1 liberacash < sql/schema_admin_users.sql
```

### 2. Criar a chave da Anthropic

1. Pegar uma API key em https://console.anthropic.com/settings/keys
2. No servidor:
   ```bash
   cp config/anthropic-config.example.php config/anthropic-config.php
   ```
3. Editar `config/anthropic-config.php` preenchendo `api_key` (mesmo
   cuidado de sempre: `<?php` na primeira linha, sozinha)

### 3. Testar manualmente antes de agendar

```bash
php scripts/blog-fetch-news.php
```

Confere o resultado em `/admin_blog/` (login ainda precisa de um usuário
— ver nota no fim de `sql/schema_admin_users.sql` pra criar o primeiro).

### 4. Agendar no CloudPanel

CloudPanel → site → aba **Cron Jobs** → novo job:

```
0 8 * * * php /home/libera1/htdocs/libera.cash/scripts/blog-fetch-news.php >> /home/libera1/logs/blog-fetch-news.log 2>&1
```

Isso roda uma vez por dia, às 8h. Ajuste o horário/frequência como quiser.

## Quando estiver confiante na qualidade

Trocar `STATUS_PADRAO` de `'rascunho'` pra `'publicado'` no topo do script
faz publicar direto, sem revisão manual.
