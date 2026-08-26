<?php
/**
 * scripts/seed-initial-posts.php
 * Roda UMA VEZ pra popular o blog com conteúdo inicial (curado à mão,
 * não pelo pipeline de IA) antes do robô de notícias começar a rodar
 * sozinho. Textos originais escritos pra LiberaCash — não são cópia de
 * nenhuma fonte específica, só cobrem os temas mais buscados sobre
 * empréstimo pessoal.
 *
 *   php scripts/seed-initial-posts.php
 *
 * Idempotente: pula qualquer slug que já exista em blog_posts.
 */

declare(strict_types=1);

require __DIR__ . '/../public/db.php'; // dá $pdo

function lc_slug(string $titulo): string
{
    $s = mb_strtolower($titulo, 'UTF-8');
    $s = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $s);
    $s = preg_replace('/[^a-z0-9]+/', '-', $s);
    return trim((string)$s, '-');
}

$posts = [];

$posts[] = [
    'titulo' => 'Como funciona um empréstimo pessoal, do pedido à liberação',
    'subtitulo' => 'Entenda cada etapa antes de contratar',
    'categoria' => 'Crédito',
    'resumo' => 'Do pedido até o dinheiro cair na conta: veja como funciona o processo de um empréstimo pessoal na prática.',
    'conteudo' => <<<'HTML'
<p>Empréstimo pessoal é um tipo de crédito sem destinação específica: você pode usar o dinheiro pra quitar dívidas, reformar a casa, cobrir uma emergência ou qualquer outro motivo. Diferente do financiamento de um carro ou imóvel, aqui a instituição não pede satisfação de onde o valor foi parar.</p>
<p>O processo começa com a simulação: você informa quanto precisa e em quantas parcelas quer pagar, e a instituição calcula uma proposta com base no seu perfil. Em seguida vem a análise de crédito, que cruza informações como histórico de pagamentos, renda declarada e situação no CPF pra decidir se aprova e em quais condições.</p>
<p>Se aprovado, o próximo passo é o envio de documentos — geralmente RG ou CNH, CPF e um comprovante de renda ou de residência, dependendo da instituição. Depois da conferência, você assina o contrato (hoje quase sempre digital) e o valor cai na conta, em prazos que variam de poucas horas a alguns dias úteis.</p>
<p>O prazo de pagamento costuma variar de 6 a 120 meses, e a taxa de juros muda bastante de acordo com o seu perfil de risco, a instituição escolhida e o valor solicitado. É por isso que comparar propostas de mais de um parceiro antes de fechar negócio costuma trazer economia real no fim do contrato.</p>
HTML,
    'meta_title' => 'Como funciona um empréstimo pessoal | LiberaCash',
    'meta_description' => 'Entenda passo a passo como funciona o empréstimo pessoal, da simulação à liberação do dinheiro na conta.',
];

$posts[] = [
    'titulo' => 'O que os bancos analisam antes de aprovar seu empréstimo pessoal',
    'subtitulo' => 'Os critérios que pesam na decisão de crédito',
    'categoria' => 'Crédito',
    'resumo' => 'Renda, histórico de pagamentos, score e mais: veja o que costuma influenciar a aprovação de um empréstimo.',
    'conteudo' => <<<'HTML'
<p>Cada instituição financeira tem seus próprios critérios internos de análise, mas alguns fatores aparecem quase sempre na hora de decidir se libera ou não um empréstimo pessoal — e em quais condições.</p>
<p>O primeiro é a renda. Não precisa ser alta, mas precisa ser compatível com o valor solicitado e as parcelas propostas, pra reduzir o risco de a pessoa não conseguir pagar. Muitas instituições também olham a estabilidade dessa renda: quem tem emprego formal ou renda recorrente como autônomo costuma ter mais facilidade do que quem tem ganhos muito irregulares.</p>
<p>O segundo é o histórico de crédito, que inclui o famoso "score" e o comportamento de pagamento em contratos anteriores — cartões, financiamentos, contas em atraso. Isso não define tudo sozinho, mas ajuda a instituição a estimar o risco de inadimplência.</p>
<p>Também entram na conta o comprometimento de renda (quanto você já paga de outras dívidas por mês) e, em alguns casos, informações adicionais como tempo de conta bancária ou relacionamento prévio com a instituição.</p>
<p>Como cada parceiro pesa esses fatores de um jeito diferente, é normal ser aprovado em um lugar e recusado em outro — por isso vale sempre comparar mais de uma opção antes de desistir.</p>
HTML,
    'meta_title' => 'O que os bancos analisam antes de aprovar um empréstimo | LiberaCash',
    'meta_description' => 'Renda, score, histórico de pagamentos: entenda os critérios que instituições financeiras usam pra aprovar um empréstimo pessoal.',
];

$posts[] = [
    'titulo' => 'Como pedir empréstimo pessoal online: passo a passo',
    'subtitulo' => 'Do celular, sem sair de casa',
    'categoria' => 'Crédito',
    'resumo' => 'Simule, envie os documentos e assine tudo digitalmente. Veja o passo a passo pra pedir um empréstimo pessoal online.',
    'conteudo' => <<<'HTML'
<p>Pedir um empréstimo pessoal online costuma ser bem mais rápido do que ir até uma agência física — o processo inteiro pode ser feito pelo celular ou computador, em poucos passos.</p>
<p>O primeiro passo é a simulação: você informa o valor desejado e o número de parcelas, e a plataforma mostra propostas de diferentes instituições parceiras, já com taxa de juros e valor da parcela estimados.</p>
<p>Depois de escolher a proposta que faz mais sentido pro seu bolso, é hora de enviar os documentos — normalmente uma foto do RG ou CNH, CPF e um comprovante de renda. A maioria das plataformas aceita foto tirada na hora, sem precisar de scanner.</p>
<p>Com os documentos aprovados, o contrato é gerado digitalmente e a assinatura acontece por biometria facial, token por SMS ou assinatura eletrônica — sem papel, sem impressão. Depois disso, o valor costuma cair na conta em poucas horas ou no próximo dia útil, dependendo da instituição.</p>
<p>Antes de assinar qualquer contrato, vale a pena ler as condições com calma: taxa de juros, número de parcelas, CET (Custo Efetivo Total) e eventuais tarifas. Comparar mais de uma proposta ajuda a garantir que você está fechando o melhor negócio disponível pro seu perfil.</p>
HTML,
    'meta_title' => 'Como pedir empréstimo pessoal online | LiberaCash',
    'meta_description' => 'Veja o passo a passo pra solicitar um empréstimo pessoal 100% online, da simulação até o dinheiro na conta.',
];

$posts[] = [
    'titulo' => 'Empréstimo pessoal vale a pena? Como decidir com cabeça fria',
    'subtitulo' => 'Perguntas pra fazer antes de assinar o contrato',
    'categoria' => 'Finanças Pessoais',
    'resumo' => 'Antes de contratar um empréstimo, vale parar e responder algumas perguntas simples. Veja quais.',
    'conteudo' => <<<'HTML'
<p>"Vale a pena pedir um empréstimo?" é uma pergunta que só você pode responder de verdade, porque depende do motivo, do valor e da sua situação financeira atual. Mas existem algumas perguntas que ajudam a decidir com mais clareza.</p>
<p>A primeira é sobre o motivo: o empréstimo vai resolver um problema real (uma emergência, uma dívida mais cara, um investimento que se paga) ou é pra um gasto que dá pra esperar? Trocar uma dívida de cartão de crédito, por exemplo, que costuma ter juros mais altos, por um empréstimo pessoal com parcelas fixas e taxa menor pode ser uma decisão financeiramente inteligente.</p>
<p>A segunda é sobre o tamanho da parcela: ela cabe confortavelmente no seu orçamento mensal, sem comprometer outras contas essenciais? Uma regra prática usada por especialistas em educação financeira é não deixar o total de dívidas passar de 30% da renda mensal.</p>
<p>A terceira é sobre alternativas: existe alguma forma de resolver a necessidade sem contrair uma nova dívida, como usar uma reserva de emergência ou renegociar um débito existente?</p>
<p>Se depois de responder essas três perguntas o empréstimo ainda fizer sentido, o próximo passo é comparar propostas de diferentes instituições — a diferença de taxa entre uma oferta e outra pode representar centenas de reais ao longo do contrato.</p>
HTML,
    'meta_title' => 'Empréstimo pessoal vale a pena? | LiberaCash',
    'meta_description' => 'Três perguntas simples pra decidir com mais segurança se vale a pena contratar um empréstimo pessoal agora.',
];

$posts[] = [
    'titulo' => 'Como funciona a análise de crédito (e o que fazer se seu pedido for negado)',
    'subtitulo' => 'Entender o processo ajuda a melhorar as próximas tentativas',
    'categoria' => 'Crédito',
    'resumo' => 'A análise de crédito não é um "sim ou não" aleatório. Entenda como ela funciona e o que fazer depois de uma negativa.',
    'conteudo' => <<<'HTML'
<p>A análise de crédito é o processo que uma instituição financeira usa pra decidir se aprova um pedido de empréstimo e em quais condições. Ela combina dados que você informa (renda, ocupação) com informações de birôs de crédito, como histórico de pagamentos e situação atual no CPF.</p>
<p>Cada instituição usa um modelo próprio de análise, o que explica por que a mesma pessoa pode ser aprovada em um lugar e recusada em outro — não existe um critério único usado por todo o mercado.</p>
<p>Se o seu pedido for negado, o primeiro passo é não desanimar: vale tentar outras instituições parceiras, já que os critérios variam bastante. Muitas fintechs, por exemplo, têm políticas mais flexíveis pra quem está com o nome negativado ou tem pouco histórico de crédito.</p>
<p>Também vale investir em melhorar seu perfil ao longo do tempo: pagar contas em dia, negociar dívidas em aberto e manter o CPF regularizado tendem a melhorar o score de crédito, o que abre portas pra condições melhores no futuro.</p>
<p>Por fim, é importante desconfiar de qualquer oferta que prometa aprovação garantida mediante pagamento antecipado — instituições sérias nunca cobram uma taxa antes de liberar o crédito.</p>
HTML,
    'meta_title' => 'Como funciona a análise de crédito | LiberaCash',
    'meta_description' => 'Entenda como funciona a análise de crédito de um empréstimo pessoal e o que fazer se o seu pedido for negado.',
];

$posts[] = [
    'titulo' => 'Empréstimo pessoal para negativados: é possível conseguir?',
    'subtitulo' => 'O nome sujo limita, mas não impede',
    'categoria' => 'Crédito',
    'resumo' => 'Estar negativado dificulta, mas não fecha todas as portas. Veja como funciona o crédito pra quem está com o nome sujo.',
    'conteudo' => <<<'HTML'
<p>Estar com o nome negativado — ou seja, com uma dívida em aberto registrada em birôs como Serasa ou SPC — reduz as opções de crédito disponíveis, mas não significa que seja impossível conseguir um empréstimo pessoal.</p>
<p>Isso acontece porque cada instituição financeira tem sua própria política de risco. Bancos tradicionais costumam ser mais restritivos com quem está negativado, mas várias fintechs e financeiras trabalham especificamente com esse público, ajustando a taxa de juros pra compensar o risco maior.</p>
<p>Uma alternativa bastante usada por quem está negativado é o empréstimo com garantia — por exemplo, dando um veículo ou um imóvel como garantia do contrato. Como o risco da instituição diminui, as taxas costumam ser mais baixas do que em modalidades sem garantia.</p>
<p>Outro caminho é focar em modalidades que analisam menos o histórico de crédito e mais a fonte de pagamento, como o empréstimo consignado (descontado direto da folha ou do benefício) pra quem tem carteira assinada, é aposentado ou pensionista do INSS.</p>
<p>Independente do caminho escolhido, vale pesquisar bastante e comparar propostas de diferentes parceiros — as condições pra negativados variam muito de uma instituição pra outra, e às vezes a diferença de taxa é grande.</p>
HTML,
    'meta_title' => 'Empréstimo pessoal para negativados | LiberaCash',
    'meta_description' => 'Estar com o nome sujo dificulta, mas não impede conseguir crédito. Veja as alternativas disponíveis pra negativados.',
];

$posts[] = [
    'titulo' => 'Empréstimo online x empréstimo em agência: o que muda na prática',
    'subtitulo' => 'Comodidade x atendimento presencial',
    'categoria' => 'Crédito',
    'resumo' => 'Rapidez, comodidade e taxas: veja as principais diferenças entre contratar um empréstimo pela internet ou numa agência.',
    'conteudo' => <<<'HTML'
<p>Até alguns anos atrás, pedir um empréstimo pessoal significava ir até uma agência bancária, preencher formulários em papel e esperar dias pela resposta. Hoje, a maior parte do mercado migrou pro digital — mas a opção presencial ainda existe, e entender as diferenças ajuda a escolher o caminho certo.</p>
<p>A principal vantagem do empréstimo online é a velocidade: simulação, envio de documentos e assinatura de contrato acontecem em poucos minutos, e o dinheiro costuma cair na conta em horas. Também é possível comparar várias propostas ao mesmo tempo, sem precisar visitar fisicamente cada instituição.</p>
<p>Já o atendimento presencial pode fazer diferença pra quem tem dúvidas mais específicas ou prefere conversar com uma pessoa antes de assinar um contrato importante. Também costuma ser mais acessível pra quem tem menos familiaridade com tecnologia.</p>
<p>Em termos de taxa de juros, não existe uma regra fixa de que uma modalidade seja sempre mais barata que a outra — isso depende mais da instituição e do perfil de crédito de cada pessoa do que do canal escolhido.</p>
<p>Na prática, o mais importante continua sendo comparar as condições oferecidas, seja online ou presencial, e verificar sempre se a instituição é regulamentada antes de fechar negócio.</p>
HTML,
    'meta_title' => 'Empréstimo online x empréstimo em agência | LiberaCash',
    'meta_description' => 'Entenda as diferenças entre contratar um empréstimo pessoal pela internet ou de forma presencial numa agência.',
];

$posts[] = [
    'titulo' => 'Como conseguir empréstimo com o nome sujo (sem cair em roubada)',
    'subtitulo' => 'Cuidados pra não trocar uma dívida por um golpe',
    'categoria' => 'Crédito',
    'resumo' => 'Quem está negativado é alvo fácil de golpes. Veja como buscar crédito com segurança mesmo com o nome sujo.',
    'conteudo' => <<<'HTML'
<p>Quem está com o nome sujo e precisa de dinheiro costuma virar alvo fácil de golpes — anúncios que prometem "empréstimo garantido, sem consulta ao CPF" são a isca mais comum, e quase sempre terminam em prejuízo. Antes de qualquer coisa, vale entender os sinais de alerta.</p>
<p>Instituição financeira séria nunca cobra uma taxa antecipada pra liberar o empréstimo. Se pedirem um PIX antes de qualquer análise, é golpe. Também desconfie de propostas que chegam por WhatsApp de números desconhecidos, sem CNPJ verificável ou sem presença no site do Banco Central.</p>
<p>Uma forma segura de checar se a instituição é regulamentada é consultar o Registro de Instituições Financeiras do Banco Central, disponível gratuitamente no site do BC. Fintechs e financeiras sérias costumam aparecer nessa lista.</p>
<p>Do lado das opções legítimas, quem está negativado pode buscar empréstimo com garantia (veículo ou imóvel), consignado (se for aposentado, pensionista ou tiver carteira assinada) ou fintechs especializadas em crédito pra esse público — que existem e trabalham dentro da lei, mesmo com taxas um pouco mais altas pra compensar o risco.</p>
<p>O caminho mais seguro é sempre comparar propostas de instituições conhecidas e regulamentadas, em vez de aceitar a primeira oferta que aparece nas redes sociais.</p>
HTML,
    'meta_title' => 'Como conseguir empréstimo com nome sujo com segurança | LiberaCash',
    'meta_description' => 'Veja como buscar crédito estando negativado sem cair em golpes — sinais de alerta e alternativas legítimas.',
];

$posts[] = [
    'titulo' => 'Como escolher o empréstimo certo pro seu perfil',
    'subtitulo' => 'Nem toda modalidade serve pra todo mundo',
    'categoria' => 'Finanças Pessoais',
    'resumo' => 'Consignado, com garantia, pessoal comum: cada modalidade serve melhor pra um perfil diferente. Veja como escolher.',
    'conteudo' => <<<'HTML'
<p>O mercado de crédito oferece várias modalidades de empréstimo, e escolher a certa pro seu momento de vida costuma render taxas melhores e menos dor de cabeça no futuro.</p>
<p>Quem é aposentado, pensionista do INSS ou tem carteira assinada geralmente encontra as menores taxas no consignado, já que a parcela é descontada direto do salário ou benefício, reduzindo o risco pra instituição.</p>
<p>Quem tem um bem — carro ou imóvel — pra dar como garantia costuma conseguir taxas mais baixas no empréstimo com garantia, já que o risco da operação diminui bastante nessa modalidade.</p>
<p>Já quem não se encaixa nesses perfis, ou precisa de mais flexibilidade, costuma optar pelo empréstimo pessoal comum, sem garantia — mais rápido de contratar, mas geralmente com taxas mais altas justamente por não ter uma garantia envolvida.</p>
<p>Independente da modalidade, o critério mais importante continua sendo comparar o CET (Custo Efetivo Total) de diferentes propostas, e não só a taxa de juros anunciada — é o CET que mostra o custo real do empréstimo, incluindo tarifas e outros encargos.</p>
HTML,
    'meta_title' => 'Como escolher o empréstimo certo pro seu perfil | LiberaCash',
    'meta_description' => 'Consignado, com garantia ou pessoal comum: veja qual modalidade de empréstimo combina mais com o seu perfil.',
];

$posts[] = [
    'titulo' => 'Quando vale a pena pedir um empréstimo pessoal (e quando não vale)',
    'subtitulo' => 'Nem toda necessidade de dinheiro pede um empréstimo',
    'categoria' => 'Finanças Pessoais',
    'resumo' => 'Empréstimo é ferramenta, não solução mágica. Veja em quais situações ele costuma fazer sentido — e em quais não.',
    'conteudo' => <<<'HTML'
<p>Um empréstimo pessoal pode ser uma ferramenta financeira útil, mas como qualquer dívida, faz mais sentido em algumas situações do que em outras.</p>
<p>Costuma valer a pena quando o dinheiro resolve um problema concreto e o custo do empréstimo é menor que o custo de não resolver esse problema. Exemplos clássicos: quitar uma dívida de cartão de crédito (que costuma ter juros bem mais altos), cobrir uma emergência médica, ou investir em algo que gera retorno, como uma ferramenta de trabalho pra um autônomo.</p>
<p>Já não costuma valer a pena quando o empréstimo é usado pra sustentar um padrão de consumo acima do que a renda permite, ou quando existe uma alternativa mais barata disponível — como usar uma reserva de emergência que já está guardada, ou negociar diretamente um desconto com quem você deve.</p>
<p>Outro sinal de alerta é pedir um novo empréstimo só pra pagar outro que já está em atraso, sem mudar o hábito que gerou a dívida original — isso tende a criar um ciclo difícil de sair.</p>
<p>No fim, a pergunta mais importante não é "dá pra conseguir o empréstimo?", mas sim "esse empréstimo me deixa numa situação financeira melhor do que estou hoje?".</p>
HTML,
    'meta_title' => 'Quando vale a pena pedir um empréstimo pessoal | LiberaCash',
    'meta_description' => 'Veja em quais situações um empréstimo pessoal costuma fazer sentido financeiro — e quando é melhor evitar.',
];

$posts[] = [
    'titulo' => 'Consignado ou empréstimo pessoal: qual escolher?',
    'subtitulo' => 'Taxa menor x flexibilidade: o trade-off de cada modalidade',
    'categoria' => 'Crédito',
    'resumo' => 'Consignado costuma ter taxa menor, mas nem todo mundo tem acesso. Veja como comparar as duas modalidades.',
    'conteudo' => <<<'HTML'
<p>Empréstimo consignado e empréstimo pessoal comum são duas das modalidades mais procuradas no Brasil, e escolher entre eles depende principalmente do seu vínculo empregatício e da sua prioridade: taxa mais baixa ou mais flexibilidade.</p>
<p>O consignado tem a parcela descontada direto da folha de pagamento, do benefício do INSS ou do contracheque de servidor público. Como o risco de inadimplência é bem menor pra instituição, as taxas costumam ser as mais competitivas do mercado. A limitação é que só tem acesso quem se encaixa nesses perfis — aposentados, pensionistas, servidores e empregados com carteira assinada em empresas conveniadas.</p>
<p>Já o empréstimo pessoal comum não exige vínculo específico e pode ser contratado por autônomos, informais e qualquer pessoa com CPF, mas em compensação costuma ter taxas mais altas, já que a instituição assume mais risco.</p>
<p>Quem tem acesso ao consignado e não tem restrição de margem consignável (o limite de quanto pode ser descontado do salário ou benefício) geralmente sai ganhando ao optar por essa modalidade primeiro, recorrendo ao empréstimo pessoal comum só se precisar de um valor além do limite disponível no consignado.</p>
<p>De qualquer forma, comparar propostas de mais de uma instituição continua sendo o passo que mais impacta o custo final, independente da modalidade escolhida.</p>
HTML,
    'meta_title' => 'Consignado ou empréstimo pessoal: qual escolher? | LiberaCash',
    'meta_description' => 'Entenda as diferenças entre empréstimo consignado e empréstimo pessoal comum pra escolher a melhor opção.',
];

$posts[] = [
    'titulo' => 'CET, juros e parcelas: como calcular se o empréstimo cabe no seu orçamento',
    'subtitulo' => 'Os três números que você precisa entender antes de assinar',
    'categoria' => 'Finanças Pessoais',
    'resumo' => 'Taxa de juros baixa nem sempre significa empréstimo barato. Entenda o que é CET e como usar esse número a seu favor.',
    'conteudo' => <<<'HTML'
<p>Na hora de comparar propostas de empréstimo, é comum olhar só a taxa de juros anunciada — mas esse número sozinho não conta a história toda. O indicador mais completo é o CET, o Custo Efetivo Total.</p>
<p>O CET reúne a taxa de juros mais todas as outras cobranças envolvidas no contrato, como tarifas administrativas, seguros embutidos e impostos. É por isso que duas propostas com a mesma taxa de juros podem ter custos finais bem diferentes — a que tem menos tarifas costuma sair mais barata no total, mesmo com juros parecidos.</p>
<p>Além do CET, vale prestar atenção no valor da parcela em relação à sua renda mensal. Uma regra prática usada por consultores financeiros é não comprometer mais de 30% da renda com o total de dívidas, incluindo o novo empréstimo — isso ajuda a manter uma margem de segurança pra imprevistos.</p>
<p>Também é importante simular o prazo total: parcelas menores geralmente significam prazos mais longos, o que aumenta o valor total pago em juros ao longo do contrato, mesmo que a parcela mensal pareça mais confortável.</p>
<p>Antes de assinar, vale pegar a proposta e calcular: quanto vou pagar no total, considerando todas as parcelas? Esse número, comparado ao valor que você está pedindo emprestado, mostra o custo real da operação.</p>
HTML,
    'meta_title' => 'CET, juros e parcelas: como calcular o custo do empréstimo | LiberaCash',
    'meta_description' => 'Entenda o que é CET e como calcular se as parcelas de um empréstimo pessoal cabem no seu orçamento.',
];

$posts[] = [
    'titulo' => 'Empréstimo para autônomos: quais documentos levar e como aumentar suas chances',
    'subtitulo' => 'Sem contracheque, mas não sem chance',
    'categoria' => 'Crédito',
    'resumo' => 'Quem trabalha por conta própria pode, sim, conseguir crédito. Veja quais documentos ajudam a comprovar renda.',
    'conteudo' => <<<'HTML'
<p>Autônomos costumam achar que ter crédito aprovado é mais difícil por não ter um contracheque formal — e de fato a análise é um pouco diferente, mas longe de ser impossível.</p>
<p>Como não existe um comprovante de renda padrão, instituições costumam aceitar formas alternativas de comprovação: extratos bancários dos últimos meses mostrando entradas recorrentes, declaração de Imposto de Renda, notas fiscais de serviços prestados ou até mesmo o extrato de plataformas onde o autônomo recebe pagamentos (apps de entrega, freelancer, etc.).</p>
<p>Quanto mais organizada e consistente for essa documentação, maior a chance de aprovação — por isso vale manter uma rotina simples de guardar extratos e comprovantes ao longo do ano, em vez de precisar juntar tudo às pressas na hora do pedido.</p>
<p>Outro ponto que ajuda bastante é ter uma conta bancária ativa há mais tempo, de preferência a mesma onde a renda entra regularmente — isso dá mais previsibilidade pra instituição analisar o fluxo financeiro.</p>
<p>Por fim, como cada instituição pesa esses fatores de um jeito diferente, vale simular em mais de um parceiro: um autônomo recusado numa instituição mais tradicional pode ser aprovado sem problema numa fintech com política de análise mais flexível.</p>
HTML,
    'meta_title' => 'Empréstimo para autônomos: documentos e dicas | LiberaCash',
    'meta_description' => 'Veja quais documentos autônomos podem usar pra comprovar renda e aumentar as chances de aprovação de crédito.',
];

$posts[] = [
    'titulo' => 'Score de crédito: como ele afeta a taxa de juros do seu empréstimo',
    'subtitulo' => 'Um número que pode economizar (ou custar) centenas de reais',
    'categoria' => 'Educação Financeira',
    'resumo' => 'Score alto costuma abrir portas pra taxas melhores. Entenda como esse número funciona e como melhorá-lo.',
    'conteudo' => <<<'HTML'
<p>O score de crédito é uma pontuação, geralmente de 0 a 1000, calculada por birôs como Serasa e SPC com base no seu histórico financeiro — pagamentos em dia, dívidas em aberto, tempo de relacionamento com o mercado de crédito, entre outros fatores.</p>
<p>Esse número funciona como um resumo do seu "risco" pra quem empresta dinheiro. Quanto maior o score, menor o risco percebido pela instituição, e isso costuma se traduzir diretamente em taxas de juros mais baixas nas propostas de empréstimo.</p>
<p>Na prática, isso significa que duas pessoas pedindo o mesmo valor, pelo mesmo prazo, podem receber propostas com taxas bem diferentes — só por causa da diferença no score. Ao longo de um contrato de vários meses, isso pode representar uma diferença de centenas de reais no total pago.</p>
<p>Melhorar o score não acontece da noite pro dia, mas alguns hábitos ajudam: pagar contas em dia (inclusive as pequenas, como assinaturas e contas de consumo, que também entram no cálculo em alguns modelos), evitar deixar o nome negativado, e manter um histórico consistente de uso de crédito, sem excessos.</p>
<p>Consultar o próprio score regularmente também ajuda — a maioria dos birôs oferece essa consulta gratuitamente, e acompanhar a evolução ao longo do tempo dá uma noção clara de quando vale a pena buscar propostas melhores no mercado.</p>
HTML,
    'meta_title' => 'Score de crédito e taxa de juros: como funciona | LiberaCash',
    'meta_description' => 'Entenda como o score de crédito influencia a taxa de juros de um empréstimo e como melhorar essa pontuação.',
];

$posts[] = [
    'titulo' => '7 erros comuns ao pedir empréstimo pessoal (e como evitar)',
    'subtitulo' => 'Pequenos deslizes que custam caro',
    'categoria' => 'Finanças Pessoais',
    'resumo' => 'De não comparar propostas a ignorar o CET: veja os erros mais comuns na hora de contratar um empréstimo.',
    'conteudo' => <<<'HTML'
<p>Contratar um empréstimo pessoal parece simples, mas alguns deslizes comuns acabam custando caro lá na frente. Conhecer esses erros ajuda a evitar dor de cabeça.</p>
<p>O primeiro erro é aceitar a primeira proposta sem comparar outras. As condições variam bastante entre instituições, e não comparar significa, na maioria das vezes, pagar mais caro do que precisaria.</p>
<p>O segundo é olhar só a parcela mensal e ignorar o prazo total. Uma parcela menor pode parecer mais confortável, mas se o prazo for muito mais longo, o valor total pago em juros costuma ser bem maior.</p>
<p>O terceiro é não calcular o CET, focando só na taxa de juros anunciada — como vimos, tarifas e encargos adicionais podem mudar bastante o custo real do empréstimo.</p>
<p>O quarto é pedir um valor maior do que realmente precisa, "por segurança". Isso só aumenta o total de juros pagos sem necessidade — o ideal é simular o valor exato da sua necessidade.</p>
<p>O quinto é não considerar o impacto da parcela no orçamento mensal a longo prazo, contratando um valor que fica apertado assim que algum imprevisto acontece.</p>
<p>O sexto é ignorar a reputação da instituição, atraído só pela taxa mais baixa — vale sempre checar se é uma instituição regulamentada pelo Banco Central antes de assinar.</p>
<p>E o sétimo é usar o empréstimo pra cobrir um problema estrutural no orçamento sem mudar o hábito que causou esse problema, criando um ciclo de novas dívidas no futuro.</p>
HTML,
    'meta_title' => '7 erros comuns ao pedir empréstimo pessoal | LiberaCash',
    'meta_description' => 'Veja os erros mais comuns na hora de contratar um empréstimo pessoal e como evitar cada um deles.',
];

$stmtCheck = $pdo->prepare('SELECT id FROM blog_posts WHERE slug = :slug LIMIT 1');
$stmtInsert = $pdo->prepare(
    'INSERT INTO blog_posts
        (slug, titulo, subtitulo, conteudo, resumo, categoria, autor, status,
         meta_title, meta_description, gerado_por_ia)
     VALUES
        (:slug, :titulo, :subtitulo, :conteudo, :resumo, :categoria, :autor, :status,
         :meta_title, :meta_description, 0)'
);

$criados = 0;
$pulados = 0;

foreach ($posts as $post) {
    $slug = lc_slug($post['titulo']);

    $stmtCheck->execute(['slug' => $slug]);
    if ($stmtCheck->fetch()) {
        echo "pulado (já existe): $slug\n";
        $pulados++;
        continue;
    }

    $stmtInsert->execute([
        'slug' => $slug,
        'titulo' => $post['titulo'],
        'subtitulo' => $post['subtitulo'],
        'conteudo' => $post['conteudo'],
        'resumo' => $post['resumo'],
        'categoria' => $post['categoria'],
        'autor' => 'Redação LiberaCash',
        'status' => 'publicado',
        'meta_title' => $post['meta_title'],
        'meta_description' => $post['meta_description'],
    ]);

    echo "criado: $slug\n";
    $criados++;
}

echo "\nFim. $criados post(s) criado(s), $pulados pulado(s) (já existiam).\n";
