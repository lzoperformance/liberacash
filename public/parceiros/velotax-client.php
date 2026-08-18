<?php
/**
 * parceiros/velotax-client.php
 * Consulta automática de pré-aprovação na Velotax, disparada logo após
 * o cadastro rápido (nome, e-mail, celular, CPF) — é a chamada que
 * acontece "por baixo" da animação de 3-5s no modal de cadastro.
 *
 * ⚠️ PENDENTE: preencher VELOTAX_API_BASE_URL assim que a Velotax
 * passar o endpoint. Até lá, o client não quebra o cadastro — ele só
 * loga o erro e devolve null, e o usuário cai no Cenário B (sem
 * proposta automática) normalmente.
 *
 * ⚠️ FORMATO DA RESPOSTA AINDA NÃO CONFIRMADO: o parse abaixo é um
 * "melhor palpite" (aprovado/valor/taxa em chaves comuns de mercado).
 * Assim que rodar o primeiro teste real, a resposta crua fica salva em
 * historico_solicitacoes.resposta_api_bruta — me manda o conteúdo dessa
 * coluna que eu ajusto o parseResposta() pro formato exato.
 */

declare(strict_types=1);

class VelotaxClient
{
    // TODO: preencher com a URL real assim que a Velotax informar
    private const API_BASE_URL = 'https://api.velotax.com.br/PREENCHER/simular';

    private string $apiKey;
    private string $apiProvider;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/parceiros-config.php';
        $velotax = $config['velotax'];

        if (empty($velotax['api_key'])) {
            throw new RuntimeException('VELOTAX_API_KEY não configurada (variável de ambiente ausente).');
        }

        $this->apiKey = $velotax['api_key'];
        $this->apiProvider = $velotax['api_provider'];
    }

    /**
     * Consulta a pré-aprovação logo após o cadastro rápido.
     * $dadosCadastro = ['nome' => ..., 'cpf' => ..., 'email' => ..., 'celular' => ...]
     *
     * Retorna:
     *   [
     *     'aprovado' => bool,
     *     'valor'    => float|null,
     *     'raw'      => string (JSON cru, sempre presente, mesmo em erro)
     *   ]
     * ou null se a chamada falhar (timeout, erro de rede, endpoint não configurado ainda).
     */
    public function consultarPreAprovacao(array $dadosCadastro): ?array
    {
        $payload = [
            'nome'    => $dadosCadastro['nome'],
            'cpf'     => preg_replace('/\D/', '', $dadosCadastro['cpf']),
            'email'   => $dadosCadastro['email'],
            'celular' => preg_replace('/\D/', '', $dadosCadastro['celular']),
        ];

        $ch = curl_init(self::API_BASE_URL);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload, JSON_UNESCAPED_UNICODE),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'x-api-key: ' . $this->apiKey,
                'x-api-provider: ' . $this->apiProvider,
            ],
            CURLOPT_TIMEOUT => 8, // não pode passar muito da janela da animação de 3-5s
            CURLOPT_CONNECTTIMEOUT => 4,
        ]);

        $responseBody = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($responseBody === false) {
            error_log('[VelotaxClient] Erro de conexão: ' . $curlError);
            return null;
        }

        if ($httpCode < 200 || $httpCode >= 300) {
            error_log("[VelotaxClient] HTTP $httpCode: $responseBody");
            return ['aprovado' => false, 'valor' => null, 'raw' => $responseBody];
        }

        return $this->parseResposta($responseBody);
    }

    /**
     * ⚠️ Melhor palpite até termos um exemplo real de resposta da Velotax.
     * Ajustar as chaves ($data['approved'] etc.) assim que soubermos o formato exato.
     */
    private function parseResposta(string $responseBody): array
    {
        $data = json_decode($responseBody, true) ?: [];

        $aprovado = (bool)($data['approved'] ?? $data['aprovado'] ?? $data['pre_approved'] ?? false);
        $valor = $data['amount'] ?? $data['valor'] ?? $data['valor_aprovado'] ?? null;

        return [
            'aprovado' => $aprovado,
            'valor'    => $valor !== null ? (float)$valor : null,
            'raw'      => $responseBody,
        ];
    }
}
