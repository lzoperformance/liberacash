<?php
/**
 * EmailService.php
 * Envio de e-mails transacionais via Amazon SES.
 *
 * Requer o AWS SDK for PHP (ver instruções no fim do arquivo / na
 * mensagem que acompanha esta entrega). Vive na RAIZ do repo, junto
 * de db.php e aws-config.php.
 *
 * Uso:
 *   require __DIR__ . '/EmailService.php';
 *   $email = new EmailService();
 *   $email->enviarPropostaPreAprovada($usuario, $produto, $valor);
 *   $email->enviarParabensContratacao($usuario, $produto);
 */

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php'; // instalado via composer (aws/aws-sdk-php)

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;

class EmailService
{
    private SesClient $client;
    private string $remetenteEmail;
    private string $remetenteNome;

    public function __construct()
    {
        $config = require __DIR__ . '/../config/aws-config.php';

        $args = [
            'version' => 'latest',
            'region'  => $config['region'],
        ];
        // Só passa 'credentials' explicitamente se key/secret estiverem preenchidos.
        // Sem isso, o SDK tenta IAM Role (EC2) / variáveis de ambiente padrão da AWS.
        if (!empty($config['key']) && !empty($config['secret'])) {
            $args['credentials'] = [
                'key'    => $config['key'],
                'secret' => $config['secret'],
            ];
        }

        $this->client = new SesClient($args);
        $this->remetenteEmail = $config['remetente']['email'];
        $this->remetenteNome  = $config['remetente']['nome'];
    }

    /**
     * Gatilho 1: notifica o usuário que uma proposta pré-aprovada foi
     * liberada no CPF dele. Chamar assim que a checagem automática de
     * parceiros gravar uma linha em historico_solicitacoes com
     * status = 'pre_aprovado'.
     */
    public function enviarPropostaPreAprovada(array $usuario, array $produto, ?float $valor = null): bool
    {
        $valorFmt = $valor ? 'R$ ' . number_format($valor, 2, ',', '.') : 'um valor especial';
        $assunto = 'Você tem uma proposta pré-aprovada no LiberaCash!';
        $corpo = "
            <p>Olá, {$this->primeiroNome($usuario['nome'])}!</p>
            <p>Encontramos uma proposta pré-aprovada de <strong>{$produto['nome']}</strong>
               no valor de <strong>{$valorFmt}</strong> para o seu CPF.</p>
            <p><a href=\"https://libera.cash/painel/index.php\">Acesse seu painel</a> para conferir e contratar.</p>
        ";
        return $this->enviar($usuario['email'], $assunto, $corpo);
    }

    /**
     * Gatilho 2: parabeniza o usuário quando a contratação é concluída.
     * Chamar quando o status em historico_solicitacoes mudar para
     * 'proposta_concluida' (hoje isso ainda não acontece automaticamente —
     * vai depender do retorno/webhook de cada parceiro, que ainda não
     * está integrado).
     */
    public function enviarParabensContratacao(array $usuario, array $produto): bool
    {
        $assunto = 'Parabéns pela contratação!';
        $corpo = "
            <p>Olá, {$this->primeiroNome($usuario['nome'])}!</p>
            <p>Sua contratação de <strong>{$produto['nome']}</strong> foi concluída com sucesso. 🎉</p>
            <p>Você pode acompanhar os detalhes a qualquer momento em
               <a href=\"https://libera.cash/painel/historico.php\">Meu Histórico</a>.</p>
        ";
        return $this->enviar($usuario['email'], $assunto, $corpo);
    }

    private function enviar(string $destinatario, string $assunto, string $corpoHtml): bool
    {
        try {
            $this->client->sendEmail([
                'Source' => "{$this->remetenteNome} <{$this->remetenteEmail}>",
                'Destination' => ['ToAddresses' => [$destinatario]],
                'Message' => [
                    'Subject' => ['Charset' => 'UTF-8', 'Data' => $assunto],
                    'Body' => [
                        'Html' => ['Charset' => 'UTF-8', 'Data' => $corpoHtml],
                    ],
                ],
            ]);
            return true;
        } catch (AwsException $e) {
            error_log('[EmailService] Falha ao enviar via SES: ' . $e->getAwsErrorMessage());
            return false;
        }
    }

    private function primeiroNome(string $nomeCompleto): string
    {
        return htmlspecialchars(explode(' ', trim($nomeCompleto))[0] ?? $nomeCompleto, ENT_QUOTES, 'UTF-8');
    }
}
