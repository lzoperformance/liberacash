<?php
/**
 * painel/includes/funcoes-perfil.php
 * Funções compartilhadas entre painel/index.php, painel/historico.php,
 * painel/minha-conta.php e atualizar-perfil.php.
 */

declare(strict_types=1);

/**
 * Metadados dos campos usados no modal dinâmico de qualificação.
 * A chave bate com a coluna em perfil_usuario / campos_necessarios.
 * 'grupo' agrupa campos que sempre aparecem juntos no formulário
 * (ex.: o endereço inteiro aparece de uma vez, nunca só o CEP).
 */
function campos_modal_qualificacao(): array {
    return [
        'endereco' => [
            'grupo_de' => ['cep', 'logradouro', 'numero', 'bairro', 'cidade', 'estado'],
            'titulo' => 'Complete seu endereço',
        ],
        'renda' => [
            'grupo_de' => ['fonte_renda', 'renda_mensal'],
            'titulo' => 'Conte sobre sua renda',
        ],
        'negativado' => [
            'grupo_de' => ['negativado'],
            'titulo' => 'Sobre seu nome no CPF',
        ],
        'celular' => [
            'grupo_de' => ['modelo_celular', 'sistema_celular'],
            'titulo' => 'Sobre o celular de garantia',
        ],
        'data_nascimento' => [
            'grupo_de' => ['data_nascimento'],
            'titulo' => 'Sua data de nascimento',
        ],
    ];
}

/**
 * Dado o array de campos_necessarios de um produto (ex.: ['cep','logradouro',...]),
 * devolve a lista de "grupos" de modal que precisam ser exibidos (sem repetir).
 * Ex.: ['cep','bairro'] -> ['endereco']
 */
function grupos_necessarios_para_produto(array $campos_necessarios): array {
    $grupos = [];
    foreach (campos_modal_qualificacao() as $grupoNome => $grupoInfo) {
        if (array_intersect($campos_necessarios, $grupoInfo['grupo_de'])) {
            $grupos[] = $grupoNome;
        }
    }
    return $grupos;
}

/**
 * Verifica se a cidade/UF do perfil está na lista de cidades atendidas
 * para o Empréstimo na Conta de Luz (cobertura-luz.json, na raiz do repo).
 */
function checar_cobertura_luz(?string $cidade, ?string $estado): bool {
    if (empty($cidade) || empty($estado)) return false;

    static $cobertura = null;
    if ($cobertura === null) {
        $path = __DIR__ . '/../../cobertura-luz.json';
        $cobertura = is_file($path)
            ? json_decode(file_get_contents($path), true) ?: []
            : [];
    }

    $normalizar = function (string $v): string {
        $v = mb_strtoupper(trim($v), 'UTF-8');
        $v = strtr($v, [
            'Á'=>'A','À'=>'A','Ã'=>'A','Â'=>'A','Ä'=>'A',
            'É'=>'E','È'=>'E','Ê'=>'E','Ë'=>'E',
            'Í'=>'I','Ì'=>'I','Î'=>'I','Ï'=>'I',
            'Ó'=>'O','Ò'=>'O','Õ'=>'O','Ô'=>'O','Ö'=>'O',
            'Ú'=>'U','Ù'=>'U','Û'=>'U','Ü'=>'U',
            'Ç'=>'C',
        ]);
        return $v;
    };

    $chave = $normalizar($cidade) . '|' . mb_strtoupper(trim($estado), 'UTF-8');
    return in_array($chave, $cobertura, true);
}

/**
 * Um produto está liberado quando: (1) não falta nenhum campo necessário e
 * (2), se for a Conta de Luz, a cidade está na cobertura.
 */
function produto_liberado_completo(array $produto, array $perfil): bool {
    if (!produto_esta_desbloqueado($produto, $perfil)) {
        return false;
    }
    if (!empty($produto['exige_checagem_cobertura'])) {
        return checar_cobertura_luz($perfil['cidade'] ?? null, $perfil['estado'] ?? null);
    }
    return true;
}

/**
 * Monta a URL final do parceiro injetando as UTMs de rastreamento.
 * Usada em painel/ir-para-parceiro.php.
 *
 * Se o link do parceiro já vier com algum parâmetro fixo (ex.: a Velotax
 * exige ?utm_source=lzo no link deles), esse valor tem prioridade sobre
 * o nosso default — nunca sobrescrevemos o que o parceiro já exigiu.
 *
 * $extras permite acrescentar parâmetros específicos do parceiro, como
 * o CPF (ex.: Velotax precisa saber pra quem foi a aprovação).
 */
function montar_url_parceiro(array $produto, array $utms, array $extras = []): string {
    $base = $produto['link_afiliado'] ?: '#';
    if ($base === '#') return '#';

    $partes = parse_url($base);
    $existentes = [];
    if (!empty($partes['query'])) {
        parse_str($partes['query'], $existentes);
    }

    $nossos = array_filter([
        'utm_source'   => $utms['utm_source']   ?? 'creditovc',
        'utm_medium'   => $utms['utm_medium']   ?? 'painel',
        'utm_campaign' => $utms['utm_campaign'] ?? $produto['slug'],
    ]);

    // Prioridade: o que já está fixo no link_afiliado > extras > nossos defaults
    $queryFinal = array_merge($nossos, $extras, $existentes);

    $baseSemQuery = strtok($base, '?');
    return $baseSemQuery . '?' . http_build_query($queryFinal);
}
