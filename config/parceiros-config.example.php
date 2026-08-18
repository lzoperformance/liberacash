<?php
/**
 * parceiros-config.example.php
 * Modelo do arquivo real: config/parceiros-config.php (gitignorado).
 * Copie este arquivo, renomeie removendo ".example" e NUNCA cole uma chave
 * real dentro dele nem em comentário — defina os valores como variável de
 * ambiente no servidor (CloudPanel > Site > Environment Variables) ou no
 * .env local, e referencie via getenv() como abaixo.
 */

return [
    'velotax' => [
        'partner_name'   => 'lzo',
        'key_id'         => getenv('VELOTAX_KEY_ID') ?: null,
        'api_key'        => getenv('VELOTAX_API_KEY') ?: null,
        'api_provider'   => 'velotax',
        'utm_source'     => 'lzo',
        'rate_limit'     => 100,
        'commission_pct' => 10,
    ],

    // Próximos parceiros entram aqui do mesmo jeito, cada um com sua env var própria:
    // 'juvo' => [
    //     'api_key' => getenv('JUVO_API_KEY') ?: null,
    // ],
];
