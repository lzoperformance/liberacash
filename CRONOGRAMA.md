# Cronograma — Relançamento como libera.cash

Base: código do `credito.vc` (funil de crédito pessoal em PHP, sem framework,
front-end exportado do Webflow). A decisão é reaproveitar toda a lógica de
back-end (funil, cadastro/login, painel do cliente, blog, integração com
parceiro Velotax) e refazer completamente a camada de marca (nome, logo,
cores, copy, imagens).

## Ação imediata — não espera o cronograma

Antes de qualquer outra coisa, independente do prazo do rebranding:

1. **Rotacionar a senha do MySQL.** O arquivo `db.php` do repositório
   `credito.vc` tem a senha do banco em texto puro e está commitado no
   GitHub (`lzoperformance/credito.vc`) — não é só um arquivo local, está
   no histórico do repositório. Como a marca foi vendida, o acesso a esse
   repositório pode não estar mais só com você.
2. **Revogar/reemitir a chave de API da Velotax.** O arquivo
   `parceiros-config.php` também está commitado (mesmo listado no
   `.gitignore` — ele já tinha sido versionado antes de entrar na lista, e
   o `.gitignore` não retira arquivos que já estão rastreados). Um dos
   comentários do arquivo tem a chave real da Velotax escrita como exemplo.
3. **Verificar `db-config.php` e `aws-config.php`** pelo mesmo motivo —
   ambos estão rastreados no git hoje (`git ls-files` confirma).
4. Depois de rotacionar, considerar (com calma, sem pressa) limpar esses
   valores do histórico do git com `git filter-repo` ou similar, ou apenas
   aceitar que aquele repositório específico está "queimado" e seguir só
   com o repositório novo do libera.cash, com as credenciais já corrigidas
   (isso já foi feito na cópia em `projeto_liberacash/` — ver `db.php` e
   `config/*.example.php`).

Nenhuma dessas ações depende de decisão de marca — pode fazer em paralelo
a qualquer fase abaixo.

## Fase 0 — Descoberta & Definições (Semana 1)

- [ ] Registrar o domínio `libera.cash` (confirmar disponibilidade e comprar)
- [ ] Definir posicionamento: tom de voz, público-alvo, diferenciais frente
      à concorrência (o texto legal/institucional do credito.vc já dá uma
      base de compliance a reaproveitar)
- [ ] Levantar quais produtos continuam (crédito pessoal, garantia de
      celular, cartões) e quais parcerias seguem ativas sob o novo CNPJ/site
      (parceiros como Velotax, Itaú, Carrefour, Juvo etc. podem exigir novo
      cadastro/aprovação com o novo domínio)
- [ ] Definir se o blog será reaproveitado (conteúdo pertence à marca
      antiga) ou recomeça do zero

## Fase 1 — Identidade Visual & Marca (Semana 1-2)

- [ ] Logo, paleta de cores, tipografia, favicon
- [ ] Novo copy institucional: hero, "sobre", FAQ, rodapé, meta tags/SEO
      (usar o texto atual como esqueleto/estrutura, não como conteúdo final)
- [ ] Novos banners/imagens (o `images/` copiado tem muito arquivo com nome
      e identidade do credito.vc — ver checklist no `README.md`)
- [ ] Definir remetente de e-mail transacional (ex.: `contato@libera.cash`)
      e validar domínio no Amazon SES

## Fase 2 — Reestruturação de Código (Semana 2, em paralelo à Fase 1)

Já em andamento nesta sessão, em `projeto_liberacash/`:

- [x] Separar `public/` (document root), `config/` (segredos fora do
      webroot), `sql/` e `docs/`
- [x] Tirar senha hardcoded do `db.php`, migrar para variável de ambiente
- [x] Unificar as duas conexões de banco redundantes (`db.php` e o antigo
      `db-config.php`) em um único caminho
- [x] Corrigir dois bugs reais encontrados no código original: `contato.php`
      e `aguarde.php` (a página que salva o lead do funil!) apontavam para
      um `db.php` fora do repositório e chamavam uma função
      (`get_db_connection()`) que não existia nesse contexto — o envio de
      leads/contato provavelmente estava quebrando silenciosamente
- [ ] Decidir se mantém Webflow (`webflow.js`, `bundle.min.js`,
      `webflow.css`) ou migra pra algo mais leve — impacta performance e
      facilidade de reaplicar a nova marca
- [ ] Trocar todo domínio/marca hardcoded no código (`credito.vc` em
      `<title>`, meta tags, JSON-LD, links absolutos, textos legais) — ver
      checklist de arquivos no `README.md`

## Fase 3 — Conteúdo & Produtos (Semana 3)

- [ ] Reescrever páginas institucionais (sobre, contato, política de
      privacidade, termos) com a nova marca — a estrutura jurídica/LGPD
      pode ser adaptada, os textos precisam citar `libera.cash`
- [ ] Revisar `produtos-config.php` (nomes, textos, condições) e confirmar
      link/API de cada parceiro sob o novo domínio
- [ ] Definir estratégia de blog (migrar posts, redirecionar ou recomeçar)

## Fase 4 — Infraestrutura & Deploy (Semana 3-4)

Ver `docs/infra-deploy.md` — versão revisada do fluxo Cloudflare → Hostinger
→ CloudPanel → GitHub que você colou. A ideia geral está certa, com alguns
ajustes de segurança e um ponto que já mudou no produto da Cloudflare.

- [ ] Domínio `libera.cash` com nameservers na Cloudflare
- [ ] VPS na Hostinger com CloudPanel (Ubuntu)
- [ ] Site PHP + banco MySQL novo no CloudPanel (senha nova, forte, nunca
      igual à do credito.vc)
- [ ] Deploy key GitHub → CloudPanel, **somente leitura**, repositório novo
      (`liberacash`, não continuar no repo do credito.vc)
- [ ] SSL Full (Strict) na Cloudflare + certificado no CloudPanel
      (Let's Encrypt)
- [ ] Cache Rules (ou Page Rules) com Bypass em `/login*`, `/register*`,
      `/painel/*`, `/admin/*`, `/admin_blog/*`
- [ ] SPF/DKIM do domínio novo configurados no SES (senão e-mail
      transacional cai em spam)
- [ ] Backup automático (site + banco) agendado no CloudPanel

## Fase 5 — QA & Testes (Semana 4)

- [ ] Funil completo (steps 1-9), cadastro, login, "esqueci minha senha"
- [ ] Formulário de contato e captura de lead (`aguarde.php`) — atenção
      especial aqui, era o que estava com bug
- [ ] Integrações de parceiros em sandbox/teste
- [ ] Responsividade e cross-browser
- [ ] Lighthouse (performance/SEO técnico) e `sitemap.xml`/`robots.txt`
      atualizados com o novo domínio
- [ ] Revisão de segurança básica: 2FA/senha forte no admin, rate limit em
      login e cadastro

## Fase 6 — Lançamento (Semana 5)

- [ ] Analytics/Pixels novos (GA4, Meta Pixel, GTM) com IDs do libera.cash
      — não reaproveitar os do credito.vc
- [ ] Google Search Console + submissão de sitemap
- [ ] Monitoramento de uptime e logs de erro ativos desde o primeiro dia

## Fase 7 — Pós-lançamento

- [ ] Acompanhar erros/performance nas primeiras semanas
- [ ] Iterar copy/design com dados reais de conversão
- [ ] Retomar produção de conteúdo/SEO orgânico
