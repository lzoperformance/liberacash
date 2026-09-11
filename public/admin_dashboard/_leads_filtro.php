<?php
/**
 * _leads_filtro.php
 * Monta a cláusula WHERE + params a partir de $_GET (de, ate, produto,
 * busca). Compartilhado entre leads.php e leads-export.php pra manter
 * os dois sempre filtrando exatamente igual.
 */

function lc_montar_filtro_leads(array $get): array
{
    $where = ['1=1'];
    $params = [];

    $dataInicio = $get['de'] ?? '';
    $dataFim = $get['ate'] ?? '';
    $produtoFiltro = $get['produto'] ?? '';
    $busca = trim($get['busca'] ?? '');

    if ($dataInicio !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $dataInicio)) {
        $where[] = 'u.criado_em >= :de';
        $params['de'] = $dataInicio . ' 00:00:00';
    }
    if ($dataFim !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $dataFim)) {
        $where[] = 'u.criado_em <= :ate';
        $params['ate'] = $dataFim . ' 23:59:59';
    }
    if ($produtoFiltro !== '') {
        $where[] = 'p.produto_interesse = :produto';
        $params['produto'] = $produtoFiltro;
    }
    if ($busca !== '') {
        $where[] = '(u.nome LIKE :busca OR u.email LIKE :busca OR u.cpf LIKE :busca)';
        $params['busca'] = '%' . $busca . '%';
    }

    return ['where' => implode(' AND ', $where), 'params' => $params];
}
