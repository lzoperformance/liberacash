<?php
/**
 * scripts/blog-fetch-news.php
 * Pipeline autônomo do blog: busca notícias de crédito/finanças pessoais
 * em RSS de fontes brasileiras confiáveis, filtra pelo que interessa pro
 * ramo de empréstimos, gera um post ORIGINAL (resumo + análise, nunca
 * cópia) com atribuição clara e link pra fonte, e grava como rascunho.
 *
 * Roda via linha de comando (cron), NUNCA pela web — não fica em public/.
 *   php scripts/blog-fetch-news.php
 *
 * Publica como 'rascunho' de propósito: revise antes de publicar de
 * verdade (admin_blog/index.php) até confiar na qualidade do pipeline.
 * Pra publicar direto sem revisão, troca STATUS_PADRAO pra 'publicado'.
 */

declare(strict_types=1);

const STATUS_PADRAO = 'rascunho';

const FONTES = [
    ['nome' => 'InfoMoney',     'rss' => 'https://www.infomoney.com.br/feed/'],
    ['nome' => 'G1 Economia',   'rss' => 'https://g1.globo.com/dynamo/economia/rss2.xml'],
    ['nome' => 'UOL Economia',  'rss' => 'https://rss.uol.com.br/feed/economia.xml'],
];

// Só vira post se o título ou resumo bater com pelo menos uma dessas
// palavras — filtra o que interessa pro ramo de crédito/empréstimo.
const PALAVRAS_CHAVE = [
    'crédito', 'credito', 'empréstimo', 'emprestimo', 'financiamento',
    'cartão de crédito', 'cartao de credito', 'juros', 'selic',
    'dívida', 'divida', 'negativado', 'inadimplência', 'inadimplencia',
    'score', 'consignado', 'cdc', 'fgts', 'renegociação', 'renegociacao',
    'parcelamento', 'taxa de juros', 'spc', 'serasa', 'financiar',
];

const MAX_POSTS_POR_EXECUCAO = 3; // trava de segurança pra não gastar API demais numa rodada só

require __DIR__ . '/../public/db.php'; // dá $pdo

$anthropicConfig = @include __DIR__ . '/../config/anthropic-config.php';
if (!is_array($anthropicConfig) || empty($anthropicConfig['api_key'])) {
    fwrite(STDERR, "Faltando config/anthropic-config.php com api_key. Copie de config/anthropic-config.example.php.\n");
    exit(1);
}

function log_linha(string $msg): void
{
    echo '[' . date('Y-m-d H:i:s') . "] $msg\n";
}

function bate_palavra_chave(string $texto): bool
{
    $texto = mb_strtolower($texto, 'UTF-8');
    foreach (PALAVRAS_CHAVE as $palavra) {
        if (mb_strpos($texto, $palavra) !== false) {
            return true;
        }
    }
    return false;
}

/**
 * Baixa e faz parse de um feed RSS. Retorna lista de
 * ['titulo'=>, 'link'=>, 'resumo'=>, 'publicado_em'=>].
 * Tolerante a encoding ruim (alguns feeds BR não declaram charset certo).
 */
function buscar_itens_rss(string $url): array
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 15,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (LiberaCashBot/1.0; +https://libera.cash)',
    ]);
    $corpo = curl_exec($ch);
    $erro = curl_error($ch);
    curl_close($ch);

    if ($corpo === false || $corpo === '') {
        log_linha("  erro ao baixar $url: $erro");
        return [];
    }

    // Corrige encoding quando o feed não é UTF-8 de verdade (ex.: UOL)
    if (!mb_check_encoding($corpo, 'UTF-8')) {
        $corpo = mb_convert_encoding($corpo, 'UTF-8', 'ISO-8859-1');
    }

    libxml_use_internal_errors(true);
    $xml = simplexml_load_string($corpo);
    if ($xml === false) {
        log_linha("  XML inválido em $url");
        return [];
    }

    $itens = [];
    foreach ($xml->channel->item as $item) {
        $itens[] = [
            'titulo'       => trim((string)$item->title),
            'link'         => trim((string)$item->link),
            'resumo'       => trim(strip_tags((string)$item->description)),
            'publicado_em' => trim((string)$item->pubDate),
        ];
    }
    return $itens;
}

function url_ja_usada(PDO $pdo, string $url): bool
{
    $stmt = $pdo->prepare('SELECT id FROM blog_posts WHERE fonte_url = :url LIMIT 1');
    $stmt->execute(['url' => $url]);
    return (bool)$stmt->fetch();
}

function gerar_slug(string $texto): string
{
    $texto = mb_strtolower($texto, 'UTF-8');
    $texto = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $texto);
    $texto = preg_replace('/[^a-z0-9]+/', '-', $texto);
    return trim((string)$texto, '-');
}

/**
 * Chama a API da Anthropic pra transformar manchete+resumo da fonte num
 * post original: nunca copia o texto da fonte, escreve resumo/análise
 * própria e termina com atribuição + link pra matéria original.
 * Retorna array com titulo/subtitulo/resumo/conteudo_html/categoria/
 * meta_title/meta_description, ou null se a chamada falhar.
 */
function gerar_post_com_ia(array $config, array $itemFonte, string $nomeFonte): ?array
{
    $prompt = <<<PROMPT
Você escreve pro blog da LiberaCash, um comparador de crédito pessoal e
empréstimos no Brasil. Sua tarefa: a partir da manchete e resumo de uma
notícia real (abaixo), escrever um post ORIGINAL — nunca copie frases da
fonte, reescreva com suas próprias palavras, pode adicionar contexto útil
pro público de quem busca crédito pessoal, mas não invente fatos/números
que não estejam na fonte.

Manchete da fonte: {$itemFonte['titulo']}
Resumo da fonte: {$itemFonte['resumo']}
Fonte: {$nomeFonte}

Regras:
- Tom: direto, acessível, sem jargão desnecessário — o leitor não é especialista em economia.
- Tamanho: 3 a 5 parágrafos curtos.
- Termine SEMPRE com uma linha: "Fonte: {$nomeFonte}" (sem o link, isso é adicionado depois automaticamente).
- Não dê conselho financeiro personalizado nem prometa aprovação de crédito.
- Retorne SOMENTE um JSON válido, sem markdown ao redor, no formato:
{"titulo": "...", "subtitulo": "...", "resumo": "1-2 frases pro card de listagem", "conteudo_html": "<p>...</p><p>...</p>", "categoria": "uma palavra ou duas, ex: Crédito, Economia, Finanças Pessoais", "meta_title": "...", "meta_description": "..."}
PROMPT;

    $ch = curl_init('https://api.anthropic.com/v1/messages');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            'content-type: application/json',
            'x-api-key: ' . $config['api_key'],
            'anthropic-version: 2023-06-01',
        ],
        CURLOPT_POSTFIELDS => json_encode([
            'model' => $config['model'] ?? 'claude-sonnet-5',
            'max_tokens' => 1500,
            'messages' => [['role' => 'user', 'content' => $prompt]],
        ]),
    ]);
    $resposta = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $erro = curl_error($ch);
    curl_close($ch);

    if ($resposta === false || $httpCode !== 200) {
        log_linha("  erro na API da Anthropic (HTTP $httpCode): $erro " . substr((string)$resposta, 0, 300));
        return null;
    }

    $dados = json_decode($resposta, true);
    // Não assume que o texto está no bloco [0] — a API pode devolver um
    // bloco de "thinking" antes do bloco de texto, então procura pelo
    // primeiro bloco com type "text" em vez de pegar sempre o índice 0.
    $texto = '';
    foreach (($dados['content'] ?? []) as $bloco) {
        if (($bloco['type'] ?? '') === 'text') {
            $texto = $bloco['text'] ?? '';
            break;
        }
    }
    // Remove eventuais cercas de código markdown, se vierem por engano
    $texto = preg_replace('/^```json\s*|\s*```$/m', '', trim($texto));

    $post = json_decode($texto, true);
    if (!is_array($post) || empty($post['titulo']) || empty($post['conteudo_html'])) {
        log_linha('  resposta da IA não veio no formato esperado: ' . substr($texto, 0, 300));
        return null;
    }
    return $post;
}

// ---------------------------------------------------------------------
// Execução
// ---------------------------------------------------------------------

$stmtInsert = $pdo->prepare(
    'INSERT INTO blog_posts
        (slug, titulo, subtitulo, conteudo, resumo, categoria, autor, status,
         meta_title, meta_description, gerado_por_ia, fonte_nome, fonte_url)
     VALUES
        (:slug, :titulo, :subtitulo, :conteudo, :resumo, :categoria, :autor, :status,
         :meta_title, :meta_description, 1, :fonte_nome, :fonte_url)'
);

$criados = 0;

foreach (FONTES as $fonte) {
    if ($criados >= MAX_POSTS_POR_EXECUCAO) break;

    log_linha("Buscando {$fonte['nome']}...");
    $itens = buscar_itens_rss($fonte['rss']);
    log_linha('  ' . count($itens) . ' itens no feed');

    foreach ($itens as $item) {
        if ($criados >= MAX_POSTS_POR_EXECUCAO) break;
        if ($item['link'] === '' || $item['titulo'] === '') continue;

        $textoParaFiltro = $item['titulo'] . ' ' . $item['resumo'];
        if (!bate_palavra_chave($textoParaFiltro)) continue;

        if (url_ja_usada($pdo, $item['link'])) {
            continue;
        }

        log_linha("  candidato: {$item['titulo']}");

        $post = gerar_post_com_ia($anthropicConfig, $item, $fonte['nome']);
        if ($post === null) {
            continue;
        }

        $conteudoFinal = $post['conteudo_html'] . "\n<p><em>Fonte: <a href=\""
            . htmlspecialchars($item['link'], ENT_QUOTES, 'UTF-8') . "\" target=\"_blank\" rel=\"noopener noreferrer\">"
            . htmlspecialchars($fonte['nome'], ENT_QUOTES, 'UTF-8') . "</a></em></p>";

        $slugBase = gerar_slug($post['titulo']);
        $slug = $slugBase;
        $sufixo = 1;
        while (true) {
            $check = $pdo->prepare('SELECT id FROM blog_posts WHERE slug = :slug LIMIT 1');
            $check->execute(['slug' => $slug]);
            if (!$check->fetch()) break;
            $sufixo++;
            $slug = $slugBase . '-' . $sufixo;
        }

        $stmtInsert->execute([
            'slug' => $slug,
            'titulo' => $post['titulo'],
            'subtitulo' => $post['subtitulo'] ?? '',
            'conteudo' => $conteudoFinal,
            'resumo' => $post['resumo'] ?? '',
            'categoria' => $post['categoria'] ?? 'Crédito',
            'autor' => 'Redação LiberaCash',
            'status' => STATUS_PADRAO,
            'meta_title' => $post['meta_title'] ?? $post['titulo'],
            'meta_description' => $post['meta_description'] ?? ($post['resumo'] ?? ''),
            'fonte_nome' => $fonte['nome'],
            'fonte_url' => $item['link'],
        ]);

        $criados++;
        log_linha("  criado: /admin_blog/post-form.php?id=" . $pdo->lastInsertId() . " (status: " . STATUS_PADRAO . ")");
    }
}

log_linha("Fim. $criados post(s) criado(s).");
