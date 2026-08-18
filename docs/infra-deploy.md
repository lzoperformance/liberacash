# Infraestrutura & Deploy — avaliação do plano Cloudflare + Hostinger

## Veredito

Faz sentido. Cloudflare na frente da Hostinger, VPS com CloudPanel, deploy
via Git e bloqueio de cache na área de login é um fluxo padrão e sólido
para esse tipo de site (funil de captação de lead com login/painel de
cliente). Vale seguir a estrutura geral do que você colou. Abaixo está o
mesmo passo a passo com ajustes — a maioria é segurança, porque esse site
lida com CPF, e-mail, telefone e renda de gente real.

## Ajustes em relação ao plano original

1. **"Page Rules" da Cloudflare está sendo substituído.** Contas novas da
   Cloudflare vêm direcionadas para **Cache Rules** (em *Caching > Cache
   Rules*) em vez de *Page Rules* legado. O resultado prático é o mesmo
   (bypass de cache num caminho específico), só muda onde você clica. Se
   sua conta ainda mostrar "Page Rules" normalmente, pode usar — o plano
   gratuito dá 3 regras.

2. **Bypass de cache não é só em `/login*`.** Qualquer página que mostra
   dado de usuário autenticado ou processa formulário com dado pessoal
   precisa estar fora de cache: `/login*`, `/register*`, `/painel/*`,
   `/admin/*`, `/admin_blog/*`, `/aguarde*`, `/contato*`. Por padrão a
   Cloudflare já não cacheia HTML dinâmico a menos que "Cache Everything"
   esteja ligado em algum lugar — mas como isso pode mudar no futuro (ex.:
   alguém liga APO ou "Cache Everything" pra ganhar performance), é melhor
   deixar essas regras de bypass explícitas desde o início, não como
   lembrete pra depois.

3. **SSL/TLS: use "Full (Strict)", não o padrão "Flexible".** O plano
   original não menciona isso. Com "Flexible", a conexão Cloudflare→VPS
   fica sem criptografia — ruim pra um site com dados sensíveis. No
   CloudPanel é simples: o próprio painel emite certificado Let's Encrypt
   pro domínio; depois disso, na Cloudflare, mude SSL/TLS para
   **Full (Strict)**. Ative também "Always Use HTTPS" e, se quiser reforçar,
   HSTS.

4. **Deploy key: NÃO marque "Allow write access".** O CloudPanel só
   precisa *ler* o repositório pra fazer `git pull` — não precisa escrever
   nada de volta no GitHub. Uma deploy key com permissão de escrita é
   superfície de ataque desnecessária: se o servidor for comprometido, quem
   invadir também consegue empurrar código pro seu repositório. Deixe a
   chave **somente leitura**.

5. **Repositório novo, não o do credito.vc.** Use um repo próprio pro
   `liberacash` (`projeto_liberacash/` nesta pasta já está pronto pra virar
   esse repo — ver `git init` sugerido no README). O repositório antigo
   tem credenciais reais no histórico do git (ver `CRONOGRAMA.md`, seção
   "Ação imediata") e, com a marca vendida, não é mais só seu.

6. **Bot Fight Mode / WAF básico.** Como há tela de login e cadastro
   públicos, vale ativar (no plano gratuito da Cloudflare, em
   *Security*) o **Bot Fight Mode** e as regras gerenciadas básicas do WAF.
   Ajuda contra tentativa de força bruta em login e criação de contas em
   massa.

7. **Backup agendado.** O CloudPanel tem backup de site + banco embutido
   (local ou pra storage externo). Configure isso já na criação do site —
   não é algo do plano original, mas é barato de fazer agora e caro de não
   ter depois.

## Passo a passo consolidado

### 1. Domínio na Cloudflare
1. Conta gratuita na Cloudflare → **Add Site** → `libera.cash` → plano Free.
2. Cloudflare escaneia os registros e devolve dois nameservers.
3. Na Hostinger (ou no registrador que você usar pro domínio), trocar os
   nameservers pelos da Cloudflare. Propagação: 1-4h, às vezes até 24h.

### 2. VPS com CloudPanel
1. Painel da Hostinger → assinatura de VPS → template com painel visual →
   **CloudPanel (Ubuntu)**.
2. Definir senha mestre, aguardar instalação, anotar o IP público.

### 3. Domínio apontando pro servidor
1. Cloudflare → aba **DNS** → registro tipo `A`, nome `@`, valor = IP do
   VPS, proxy (nuvem laranja) **ativo**.
2. Outro registro tipo `A`, nome `www`, mesmo IP, proxy ativo.

### 4. Site no CloudPanel
1. Acesse `https://IP-DO-VPS:8443`.
2. **Add Site → Create a PHP Site**, domínio `libera.cash`, versão do PHP
   compatível com o código (o funil usa PHP 8+; confirmar com `composer.json`
   se for usar o AWS SDK).
3. Na aba do site, gerar o certificado Let's Encrypt (necessário pro ajuste
   de SSL Full Strict do item 3 acima).
4. Aba **Databases** → criar o banco MySQL (nome sugerido: `liberacash`,
   usuário dedicado — não usar `root`).

### 5. Deploy via Git
1. No site dentro do CloudPanel, aba **Git**.
2. Copiar a chave pública de deploy gerada.
3. GitHub → repositório do `liberacash` → **Settings → Deploy keys → Add
   deploy key** → colar a chave → **sem** marcar "Allow write access".
4. No CloudPanel, informar a URL SSH do repo e a branch (`main`).
   Se a estrutura for `public/` como document root (recomendado — mantém
   `config/` e `sql/` fora da pasta servida pela web), configurar o
   document root do site no CloudPanel para apontar pra `public/` dentro
   do repo clonado.
5. Cadastrar as variáveis de ambiente do site (`DB_HOST`, `DB_NAME`,
   `DB_USER`, `DB_PASS`, `AWS_*`, `VELOTAX_*` — ver `.env.example` na raiz
   deste projeto) na aba de **Environment Variables** do CloudPanel.
6. Clicar em **Deploy**.

### 6. Cache bypass nas áreas sensíveis
1. Cloudflare → **Caching → Cache Rules** (ou **Rules → Page Rules** em
   contas antigas) → nova regra.
2. Condição: URL contém `/login`, `/register`, `/painel`, `/admin`,
   `/aguarde`, `/contato` (pode ser uma regra por caminho ou uma condição
   composta com "or").
3. Ação: **Bypass cache**.
4. Salvar.

### 7. E-mail transacional
1. No Amazon SES, verificar o domínio `libera.cash` e sair do sandbox.
2. Adicionar os registros SPF/DKIM que o SES fornece como registros `TXT`/
   `CNAME` na aba DNS da Cloudflare (proxy **desativado**/DNS only nesses
   registros específicos — nuvem cinza, não laranja).

### 8. Backup
1. CloudPanel → site → **Backups** → agendar (diário ou semanal,
   dependendo do volume de leads).
