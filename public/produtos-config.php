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
        'nome' => 'Empréstimo Pessoal para Negativados',
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
        'link_afiliado' => 'https://credito.velotax.com.br/cpf?utm_source=lzo', // link de retorno pós-aprovação da Velotax
        'passar_cpf_na_url' => true, // a Velotax precisa do CPF na URL de retorno pra identificar o aprovado
        'ativo' => true,
        'ordem' => 1,
        'tags' => ['rápido', 'sem garantia', 'online'],
        'publico_alvo' => 'Pessoas que precisam de crédito rápido sem oferecer bens como garantia',
        'selos' => ['ALTA CHANCE DE APROVAÇÃO', 'DINHEIRO EM 24H'],
        // Campos de perfil_usuario que precisam estar preenchidos pra liberar direto
        'campos_necessarios' => ['negativado'],
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
        'link_afiliado' => '#', // A definir
        'ativo' => true,
        'ordem' => 2,
        'tags' => ['garantia', 'celular', 'taxas menores'],
        'publico_alvo' => 'Pessoas que possuem smartphone e querem taxas reduzidas',
        'selos' => ['RECOMENDADO PARA VOCÊ'],
        'campos_necessarios' => ['modelo_celular', 'sistema_celular'],
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
        'link_afiliado' => '#', // A definir
        'ativo' => true,
        'ordem' => 4,
        'tags' => ['garantia', 'veículo', 'taxas competitivas'],
        'publico_alvo' => 'Proprietários de veículos que precisam de crédito com melhores condições',
        'selos' => [],
        'campos_necessarios' => ['fonte_renda', 'renda_mensal'],
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
        'link_afiliado' => '#', // A definir
        'ativo' => true,
        'ordem' => 6,
        'tags' => ['consignado', 'INSS', 'aposentado', 'pensionista'],
        'publico_alvo' => 'Aposentados e pensionistas do INSS',
        'selos' => ['RECOMENDADO PARA VOCÊ'],
        'campos_necessarios' => ['data_nascimento', 'fonte_renda', 'renda_mensal'],
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
