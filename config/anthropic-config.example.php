<?php
/**
 * anthropic-config.example.php
 * Modelo do arquivo real: config/anthropic-config.php (gitignorado).
 * Usado por scripts/blog-fetch-news.php pra gerar os posts do blog.
 * Pegue uma chave em https://console.anthropic.com/settings/keys
 */

return [
    'api_key' => getenv('ANTHROPIC_API_KEY') ?: '',
    'model'   => 'claude-sonnet-5',
];
