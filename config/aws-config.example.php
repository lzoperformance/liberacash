<?php
/**
 * aws-config.example.php
 * Modelo do arquivo real: config/aws-config.php (gitignorado).
 * Usado pelo EmailService.php (Amazon SES) para e-mails transacionais.
 * Em produção, prefira IAM Role (se o servidor for EC2) e deixe key/secret
 * vazios — o SDK cai automaticamente para as credenciais padrão da AWS.
 */

return [
    'region' => getenv('AWS_REGION') ?: 'sa-east-1',
    'key'    => getenv('AWS_ACCESS_KEY_ID') ?: '',
    'secret' => getenv('AWS_SECRET_ACCESS_KEY') ?: '',
    'remetente_email' => getenv('SES_FROM_EMAIL') ?: 'contato@libera.cash',
    'remetente_nome'  => 'Libera.cash',
];
