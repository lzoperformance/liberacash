<?php
/**
 * attribution.php
 * Atribuição de origem por PRIMEIRO CLIQUE.
 *
 * Fluxo:
 *  1. Na primeira visita que traz algum parâmetro de campanha na URL
 *     (utm_*, source, ftid, sub1..sub7, fbclid, gclid...), lc_attr_capturar()
 *     grava um cookie first-party (lc_attr, 90 dias). Visitas seguintes NÃO
 *     sobrescrevem — por isso é "primeiro clique".
 *  2. No cadastro (register.php), lc_attr_gravar() lê o cookie e grava a
 *     origem do lead na tabela leads_origem.
 *
 * Compatível com PHP 7.2+. Nada aqui pode derrubar a página nem o cadastro:
 * tudo falha em silêncio (só error_log).
 */

const LC_ATTR_COOKIE = 'lc_attr';
const LC_ATTR_DIAS   = 90;

/** Parâmetros de URL que identificam a origem de um clique. */
function lc_attr_chaves(): array
{
    return [
        'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term',
        'source', 'ftid', 'campaign_code',
        'sub1', 'sub2', 'sub3', 'sub4', 'sub5', 'sub6', 'sub7',
        'fbclid', 'gclid', 'ttclid',
    ];
}

/** Limpa um valor vindo do cliente: só texto simples, sem controle, com limite de tamanho. */
function lc_attr_valor($v, int $max = 150): string
{
    if (!is_scalar($v)) {
        return '';
    }
    $limpo = preg_replace('/[\x00-\x1F\x7F]/', '', (string)$v);
    if ($limpo === null) {
        return '';
    }
    $limpo = trim(strip_tags($limpo));
    return mb_substr($limpo, 0, $max, 'UTF-8');
}

function lc_attr_limite(string $chave): int
{
    return in_array($chave, ['fbclid', 'gclid', 'ttclid'], true) ? 255 : 150;
}

/**
 * Chame no topo de toda página de entrada (antes de qualquer saída).
 * Só grava o cookie se ainda não existe e se a URL trouxe parâmetros.
 */
function lc_attr_capturar(): void
{
    if (PHP_SAPI === 'cli' || isset($_COOKIE[LC_ATTR_COOKIE]) || headers_sent()) {
        return;
    }

    $dados = [];
    foreach (lc_attr_chaves() as $chave) {
        if (isset($_GET[$chave])) {
            $valor = lc_attr_valor($_GET[$chave], lc_attr_limite($chave));
            if ($valor !== '') {
                $dados[$chave] = $valor;
            }
        }
    }
    if (!$dados) {
        return; // visita sem campanha: nada a atribuir
    }

    $path = parse_url((string)($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH);
    $dados['_lp']  = lc_attr_valor($path ?: '/', 255);
    $dados['_ref'] = lc_attr_valor($_SERVER['HTTP_REFERER'] ?? '', 200);
    $dados['_ts']  = time();

    $json = json_encode($dados, JSON_UNESCAPED_UNICODE);
    if ($json === false) {
        return;
    }
    $valor = rtrim(strtr(base64_encode($json), '+/', '-_'), '=');
    if (strlen($valor) > 3800) {
        error_log('lc_attr_capturar: cookie grande demais, ignorado');
        return;
    }

    $expira = time() + LC_ATTR_DIAS * 86400;
    header(
        'Set-Cookie: ' . LC_ATTR_COOKIE . '=' . $valor
        . '; Expires=' . gmdate('D, d M Y H:i:s', $expira) . ' GMT'
        . '; Max-Age=' . (LC_ATTR_DIAS * 86400)
        . '; Path=/; Secure; HttpOnly; SameSite=Lax',
        false
    );
    $_COOKIE[LC_ATTR_COOKIE] = $valor;
}

/** Lê e valida o cookie de atribuição. Retorna [] se ausente ou adulterado. */
function lc_attr_ler(): array
{
    $c = $_COOKIE[LC_ATTR_COOKIE] ?? '';
    if (!is_string($c) || $c === '' || strlen($c) > 4000) {
        return [];
    }
    $bin = base64_decode(strtr($c, '-_', '+/'), true);
    if ($bin === false) {
        return [];
    }
    $d = json_decode($bin, true);
    if (!is_array($d)) {
        return [];
    }

    $out = [];
    foreach (lc_attr_chaves() as $chave) {
        if (isset($d[$chave])) {
            $valor = lc_attr_valor($d[$chave], lc_attr_limite($chave));
            if ($valor !== '') {
                $out[$chave] = $valor;
            }
        }
    }
    if (!$out) {
        return [];
    }
    $out['_lp']  = lc_attr_valor($d['_lp']  ?? '', 255);
    $out['_ref'] = lc_attr_valor($d['_ref'] ?? '', 500);
    $out['_ts']  = isset($d['_ts']) ? (int)$d['_ts'] : 0;
    return $out;
}

/**
 * Grava a origem do lead recém-cadastrado em leads_origem.
 * $postado = corpo JSON do cadastro; só serve de reserva quando o visitante
 * não tem o cookie (ex.: cookies bloqueados) — o cookie de primeiro clique
 * sempre tem prioridade.
 */
function lc_attr_gravar(PDO $pdo, int $userId, array $postado = []): void
{
    try {
        $dados = lc_attr_ler();

        if (!$dados) {
            foreach (lc_attr_chaves() as $chave) {
                if (isset($postado[$chave])) {
                    $valor = lc_attr_valor($postado[$chave], lc_attr_limite($chave));
                    if ($valor !== '') {
                        $dados[$chave] = $valor;
                    }
                }
            }
        }
        if (!$dados) {
            return; // cadastro direto, sem campanha
        }

        $colunas = ['user_id'];
        $marcas  = [':user_id'];
        $params  = ['user_id' => $userId];
        foreach (lc_attr_chaves() as $chave) {
            if (isset($dados[$chave])) {
                $colunas[]       = '`' . $chave . '`';
                $marcas[]        = ':' . $chave;
                $params[$chave]  = $dados[$chave];
            }
        }
        if (!empty($dados['_lp'])) {
            $colunas[] = 'landing_path';
            $marcas[]  = ':landing_path';
            $params['landing_path'] = $dados['_lp'];
        }
        if (!empty($dados['_ref'])) {
            $colunas[] = 'referrer';
            $marcas[]  = ':referrer';
            $params['referrer'] = $dados['_ref'];
        }
        if (!empty($dados['_ts'])) {
            $colunas[] = 'primeiro_clique_em';
            $marcas[]  = ':primeiro_clique_em';
            $params['primeiro_clique_em'] = date('Y-m-d H:i:s', (int)$dados['_ts']);
        }

        $sql = 'INSERT INTO leads_origem (' . implode(',', $colunas) . ') VALUES (' . implode(',', $marcas) . ')';
        $pdo->prepare($sql)->execute($params);
    } catch (Throwable $e) {
        error_log('lc_attr_gravar: ' . $e->getMessage());
    }
}
