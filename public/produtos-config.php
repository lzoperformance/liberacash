<?php
/**
 * produtos-config.php - Configuração central de produtos financeiros
 *
 * Cada produto tem sua própria configuração de API, tracking, exibição
 * e — NOVO — o conjunto de campos de perfil necessários para liberar a
 * oferta automaticamente sem passar pelo modal de qualificação.
 *
 * Uso: require_once 'produtos-config.php'; no topo das páginas
 */

$products = [
    'credito-pessoal' => [
        'id' => '001',
        'nome' => 'Empréstimo Pessoal',
        'slug' => 'credito-pessoal',
        'icone' => 'ph-user-circle',
        'descricao' => 'Empréstimo rápido e descomplicado, mesmo com restrição no nome',
        'descricao_curta' => 'Sem garantia',
        'valor_min' => 500,
        'valor_max' => 100000,
        'api_endpoint' => 'https://api.velotax.com.br/PREENCHER/simular', // endpoint de consulta — ainda falta a URL real
        'api_key' => '', // vem de parceiros-config.php, não daqui
        'formup_campaign_id' => '', // A definir
        'pixel_conversion_id' => '', // A definir
        'link_afiliado' => 'https://lzo.upone.link/r/MyBvX4BMkW?pid=', // Velotax — link de retorno pós-aprovação
        'passar_cpf_na_url' => true, // a Velotax precisa do CPF na URL de retorno pra identificar o aprovado
        'ativo' => true,
        'ordem' => 1,
        'tags' => ['rápido', 'sem garantia', 'online'],
        'publico_alvo' => 'Pessoas que precisam de crédito rápido sem oferecer bens como garantia',
        'selos' => ['ALTA CHANCE DE APROVAÇÃO', 'DINHEIRO EM 24H'],
        // Campos de perfil_usuario que precisam estar preenchidos pra liberar direto
        'campos_necessarios' => ['negativado'],
        // Múltiplos parceiros pro mesmo produto — usuário escolhe na tela
        // de "Escolher parceiro" antes de sair pro site de cada um.
        // SuperSim vem primeiro de propósito: é a recomendação padrão pra
        // todo lead nesse produto (pedido do cliente). NoVerde ainda está
        // em prospecção — link aponta direto pro onboarding deles (sem
        // tracking de afiliado ainda) só pra eles verem como fica na landing.
        'parceiros' => [
            [
                'id' => 'supersim',
                'nome' => 'SuperSim',
                'logo' => null, // A DEFINIR
                'descricao_curta' => 'Empréstimo pessoal, aceita nome negativado',
                'link_afiliado' => 'https://lzo.upone.link/r/pw0zGxp2kG?pid=',
                'passar_cpf_na_url' => true,
                'tem_api' => false,
            ],
            [
                'id' => 'velotax',
                'nome' => 'Velotax',
                'logo' => null, // A DEFINIR
                'descricao_curta' => 'Pré-aprovação automática consultando seu CPF',
                'link_afiliado' => 'https://lzo.upone.link/r/MyBvX4BMkW?pid=',
                'passar_cpf_na_url' => true,
                'tem_api' => true,
            ],
            [
                'id' => 'noverde',
                'nome' => 'NoVerde',
                'logo' => null, // A DEFINIR
                'descricao_curta' => 'Empréstimo pessoal sem burocracia',
                'link_afiliado' => 'https://app.noverde.com.br/onboarding', // prospecção, ainda sem link de afiliado com tracking
                'passar_cpf_na_url' => false,
                'tem_api' => false,
            ],
        ],
    ],

    'garantia-celular' => [
        'id' => '002',
        'nome' => 'Empréstimo com Garantia de Celular',
        'slug' => 'garantia-celular',
        'icone' => 'ph-device-mobile',
        'descricao' => 'Use seu celular como garantia e obtenha taxas menores',
        'descricao_curta' => 'Garantia celular',
        'valor_min' => 1000,
        'valor_max' => 50000,
        'api_endpoint' => 'https://api.parceiro2.com/v1/simular', // A definir
        'api_key' => '', // A definir
        'formup_campaign_id' => '', // A definir
        'pixel_conversion_id' => '', // A definir
        'link_afiliado' => 'https://lzo.upone.link/r/k9763WxRqd?pid=', // Juvo
        'passar_cpf_na_url' => true,
        'ativo' => true,
        'ordem' => 2,
        'tags' => ['garantia', 'celular', 'taxas menores'],
        'publico_alvo' => 'Pessoas que possuem smartphone e querem taxas reduzidas',
        'selos' => ['RECOMENDADO PARA VOCÊ'],
        'campos_necessarios' => ['modelo_celular', 'sistema_celular'],
        'parceiros' => [
            [
                'id' => 'juvo',
                'nome' => 'Juvo',
                'logo' => null, // A DEFINIR
                'descricao_curta' => 'Empréstimo com garantia de celular',
                'link_afiliado' => 'https://lzo.upone.link/r/k9763WxRqd?pid=',
                'passar_cpf_na_url' => true,
                'tem_api' => false,
            ],
        ],
    ],

    'garantia-imovel' => [
        'id' => '003',
        'nome' => 'Empréstimo com Garantia de Imóvel',
        'slug' => 'garantia-imovel',
        'icone' => 'ph-house',
        'descricao' => 'Home equity: use seu imóvel como garantia e obtenha valores maiores',
        'descricao_curta' => 'Garantia imóvel',
        'valor_min' => 10000,
        'valor_max' => 500000,
        'api_endpoint' => 'https://api.parceiro3.com/v1/simular', // A definir
        'api_key' => '', // A definir
        'formup_campaign_id' => '', // A definir
        'pixel_conversion_id' => '', // A definir
        'link_afiliado' => '#', // A definir
        'ativo' => true,
        'ordem' => 3,
        'tags' => ['garantia', 'imóvel', 'valores altos'],
        'publico_alvo' => 'Proprietários de imóveis que precisam de valores elevados',
        'selos' => [],
        'campos_necessarios' => ['cep', 'logradouro', 'bairro', 'cidade', 'estado'],
    ],

    'garantia-auto' => [
        'id' => '004',
        'nome' => 'Empréstimo com Garantia de Auto',
        'slug' => 'garantia-auto',
        'icone' => 'ph-car',
        'descricao' => 'Use seu veículo como garantia e obtenha crédito com taxas competitivas',
        'descricao_curta' => 'Garantia auto',
        'valor_min' => 5000,
        'valor_max' => 150000,
        'api_endpoint' => 'https://api.parceiro4.com/v1/simular', // A definir
        'api_key' => '', // A definir
        'formup_campaign_id' => '', // A definir
        'pixel_conversion_id' => '', // A definir
        'link_afiliado' => 'https://lzo.upone.link/r/0z9VvmONlz?pid=', // BV
        'passar_cpf_na_url' => true,
        'ativo' => true,
        'ordem' => 4,
        'tags' => ['garantia', 'veículo', 'taxas competitivas'],
        'publico_alvo' => 'Proprietários de veículos que precisam de crédito com melhores condições',
        'selos' => [],
        'campos_necessarios' => ['fonte_renda', 'renda_mensal'],
        'parceiros' => [
            [
                'id' => 'bv',
                'nome' => 'BV',
                'logo' => null, // A DEFINIR
                'descricao_curta' => 'Empréstimo com garantia de veículo',
                'link_afiliado' => 'https://lzo.upone.link/r/0z9VvmONlz?pid=',
                'passar_cpf_na_url' => true,
                'tem_api' => false,
            ],
        ],
    ],

    'conta-luz' => [
        'id' => '005',
        'nome' => 'Empréstimo na Conta de Luz',
        'slug' => 'conta-luz',
        'icone' => 'ph-lightning',
        'descricao' => 'Empréstimo com parcelas descontadas diretamente na fatura de energia',
        'descricao_curta' => 'Conta de luz',
        'valor_min' => 500,
        'valor_max' => 10000,
        'api_endpoint' => 'https://api.parceiro5.com/v1/simular', // A definir
        'api_key' => '', // A definir
        'formup_campaign_id' => '', // A definir
        'pixel_conversion_id' => '', // A definir
        'link_afiliado' => '#', // A definir
        'ativo' => true,
        'ordem' => 5,
        'tags' => ['conta de luz', 'desconto em folha', 'facilidade'],
        'publico_alvo' => 'Pessoas que preferem parcelas descontadas na fatura de energia',
        'selos' => ['DINHEIRO EM 24H'],
        'campos_necessarios' => ['cep', 'logradouro', 'bairro', 'cidade', 'estado'],
        // Além dos campos acima, esse produto exige checar cidade/UF contra cobertura-luz.json
        'exige_checagem_cobertura' => true,
    ],

    'consignado' => [
        'id' => '006',
        'nome' => 'Empréstimo Consignado',
        'slug' => 'consignado',
        'icone' => 'ph-identification-card',
        'descricao' => 'Empréstimo consignado para aposentados e pensionistas com taxas reduzidas',
        'descricao_curta' => 'Consignado INSS',
        'valor_min' => 1000,
        'valor_max' => 200000,
        'api_endpoint' => 'https://api.parceiro6.com/v1/simular', // A definir
        'api_key' => '', // A definir
        'formup_campaign_id' => '', // A definir
        'pixel_conversion_id' => '', // A definir
        'link_afiliado' => 'https://lzo.upone.link/r/wL9LZnGQ5p?pid=', // Acredity
        'passar_cpf_na_url' => true,
        'ativo' => true,
        'ordem' => 6,
        'tags' => ['consignado', 'INSS', 'aposentado', 'pensionista'],
        'publico_alvo' => 'Aposentados e pensionistas do INSS',
        'selos' => ['RECOMENDADO PARA VOCÊ'],
        'campos_necessarios' => ['data_nascimento', 'fonte_renda', 'renda_mensal'],
        'parceiros' => [
            [
                'id' => 'acredity',
                'nome' => 'Acredity',
                'logo' => null, // A DEFINIR
                'descricao_curta' => 'Crédito consignado',
                'link_afiliado' => 'https://lzo.upone.link/r/wL9LZnGQ5p?pid=',
                'passar_cpf_na_url' => true,
                'tem_api' => false,
            ],
            [
                'id' => 'velotax',
                'nome' => 'Velotax',
                'logo' => null, // A DEFINIR
                'descricao_curta' => 'Crédito consignado',
                'link_afiliado' => 'https://lzo.upone.link/r/MyBvX4BMkW?pid=',
                'passar_cpf_na_url' => true,
                'tem_api' => false,
            ],
        ],
    ],
];

/**
 * Função auxiliar para obter produto por slug
 */
function get_product_by_slug($slug) {
    global $products;
    return isset($products[$slug]) ? $products[$slug] : null;
}

/**
 * Função auxiliar para obter todos os produtos ativos
 */
function get_active_products() {
    global $products;
    return array_filter($products, function($p) {
        return $p['ativo'] === true;
    });
}

/**
 * Função auxiliar para ordenar produtos pela ordem definida
 */
function get_products_ordered() {
    $products = get_active_products();
    usort($products, function($a, $b) {
        return $a['ordem'] - $b['ordem'];
    });
    return $products;
}

/**
 * Função auxiliar para obter produto padrão (primeiro da lista)
 */
function get_default_product() {
    $ordered = get_products_ordered();
    return !empty($ordered) ? reset($ordered) : null;
}

/**
 * Retorna os campos de perfil_usuario que ainda faltam para o produto,
 * dado o array $perfil (linha da tabela perfil_usuario, pode vir vazio []).
 */
function get_campos_faltantes(array $produto, array $perfil): array {
    $faltando = [];
    foreach ($produto['campos_necessarios'] as $campo) {
        if (empty($perfil[$campo])) {
            $faltando[] = $campo;
        }
    }
    return $faltando;
}

/**
 * Um produto está "desbloqueado" quando não falta nenhum campo necessário
 * (a checagem extra de cobertura de conta de luz é feita à parte, em
 * painel/includes/funcoes-perfil.php::checar_cobertura_luz()).
 */
function produto_esta_desbloqueado(array $produto, array $perfil): bool {
    return empty(get_campos_faltantes($produto, $perfil));
}

/**
 * Lista de parceiros de um produto. Se o produto define 'parceiros'
 * (array de opções — ex.: credito-pessoal tem Velotax/SuperSim/NoVerde),
 * retorna essa lista. Senão, sintetiza uma lista de 1 item a partir dos
 * campos antigos (link_afiliado/nome no topo do produto), pra produtos
 * que ainda não foram migrados pro modelo de múltiplos parceiros.
 */
function get_partners_for_product(array $produto): array {
    if (!empty($produto['parceiros'])) {
        return $produto['parceiros'];
    }
    return [[
        'id' => $produto['slug'],
        'nome' => $produto['nome'],
        'logo' => null,
        'descricao_curta' => $produto['descricao_curta'] ?? '',
        'link_afiliado' => $produto['link_afiliado'] ?? '#',
        'passar_cpf_na_url' => $produto['passar_cpf_na_url'] ?? false,
        'tem_api' => false,
    ]];
}

/**
 * Acha um parceiro específico de um produto pelo id. Cai pro primeiro
 * da lista se o id não vier ou não bater com nenhum (link direto antigo
 * continua funcionando).
 */
function get_partner_by_id(array $produto, ?string $parceiroId): ?array {
    $parceiros = get_partners_for_product($produto);
    if ($parceiroId !== null) {
        foreach ($parceiros as $p) {
            if ($p['id'] === $parceiroId) return $p;
        }
    }
    return $parceiros[0] ?? null;
}
