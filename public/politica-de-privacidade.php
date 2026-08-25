<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidade - LiberaCash</title>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        {"@type": "ListItem", "position": 1, "name": "Início", "item": "https://libera.cash/"},
        {"@type": "ListItem", "position": 2, "name": "Política de Privacidade", "item": "https://libera.cash/politica-de-privacidade/"}
      ]
    }
    </script>

    <meta name="description" content="Política de Privacidade do site LiberaCash. Saiba como protegemos e utilizamos seus dados.">
    <meta property="og:title" content="Política de Privacidade - LiberaCash">
    <meta property="og:description" content="Transparência e segurança: veja como a LiberaCash trata seus dados pessoais em conformidade com a LGPD.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://libera.cash/politica-de-privacidade/">

    <link rel="canonical" href="/politica-de-privacidade/">

    <link href="images/favicon.png" rel="shortcut icon" type="image/x-icon">
    <link href="images/webclip.png" rel="apple-touch-icon">

    <!-- Fontes / ícones -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900|Raleway:400,500,600,700,800,900|Montserrat:400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --primary-green: #2ecc71;
            --dark-green: #27ae60;
            --accent-green: #1de58d;
            --dark-bg: #181a1f;
            --text-dark: #2d3436;
            --text-light: #636e72;
            --gray-text: #666;
            --white: #ffffff;
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Lato', sans-serif;
            color: var(--text-dark);
            background-color: #f9f9f9;
            overflow-x: hidden;
            padding-top: 32px;
        }

        /* ==== Top Warning Bar ==== */
        .top-bar {
            background-color: #19a44a;
            padding: 0; height: 32px; display: flex; align-items: center; justify-content: center;
            text-align: center;
            font-size: 11px;
            color: #ffffff;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1001;
        }

        /* ==== Header ==== */
        .header {
            background-color: var(--primary-green);
            padding: 10px 0;
            position: sticky;
            top: 32px;
            z-index: 1000;
        }
        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        .logo img { height: 35px; }
        .nav-menu {
            display: flex;
            list-style: none;
            gap: 20px;
        }
        .nav-menu a {
            color: var(--white);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }
        .hamburger {
            display: none;
            cursor: pointer;
            color: white;
            font-size: 24px;
        }

        /* ==== Breadcrumbs ==== */
        .breadcrumbs {
            max-width: 1000px;
            margin: 0 auto;
            padding: 14px 20px;
            font-size: 13px;
            color: var(--text-light);
        }
        .breadcrumbs a { color: var(--text-light); text-decoration: none; }
        .breadcrumbs a:hover { color: var(--primary-green); text-decoration: underline; }
        .breadcrumbs .sep { margin: 0 6px; color: #ccc; }
        .breadcrumbs .current { color: var(--text-dark); font-weight: 600; }

        /* ==== Banner Política ==== */
        .banner-politica {
            width: 100%;
            height: 250px;
            background-image: url('/images/banner-politica.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .banner-politica::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.4); /* Fundo escurecido para destacar o texto */
        }
        .banner-politica h1 {
            position: relative;
            z-index: 1;
            color: #ffffff;
            font-family: 'Raleway', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            text-align: center;
            padding: 0 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        /* ==== Conteúdo de Texto ==== */
        .container {
            max-width: 1000px;
            margin: -40px auto 40px auto; /* Sobe um pouco para sobrepor ao banner */
            padding: 0 20px;
            position: relative;
            z-index: 5;
        }
        .politica-content {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            padding: 40px 50px;
        }
        .politica-content h2 {
            font-family: 'Raleway', sans-serif;
            font-size: 1.5rem;
            color: var(--dark-bg);
            margin-top: 35px;
            margin-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 8px;
        }
        .politica-content p {
            font-size: 16px;
            line-height: 1.8;
            color: var(--gray-text);
            margin-bottom: 15px;
            text-align: justify;
        }
        .politica-content strong {
            color: var(--text-dark);
        }
        .politica-content ul {
            margin-left: 25px;
            margin-bottom: 20px;
            color: var(--gray-text);
            font-size: 16px;
            line-height: 1.8;
        }
        .politica-content ul li {
            margin-bottom: 10px;
        }
        
        /* Estilos para as tabelas da LGPD */
        .politica-content table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            font-size: 15px;
            color: var(--gray-text);
        }
        .politica-content th, .politica-content td {
            border: 1px solid #eee;
            padding: 12px 15px;
            text-align: left;
            vertical-align: top;
        }
        .politica-content th {
            background-color: #f9f9f9;
            color: var(--dark-bg);
            font-weight: 700;
        }
        .politica-content td strong {
            color: var(--primary-green);
        }
        
        .box-destaque {
            background-color: #f1f8f5; 
            padding: 25px; 
            border-radius: 8px; 
            margin-top: 40px; 
            border-left: 5px solid var(--primary-green);
        }

        /* ==== Footer ==== */
        .footer {
            padding: 50px 0;
            text-align: center;
            background-color: var(--white);
            border-top: 1px solid #eee;
        }
        .footer-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .footer-logo { height: 38px; margin-bottom: 25px; }
        .footer-text {
            font-size: 12px;
            color: #666666;
            line-height: 1.7;
            text-align: justify;
        }
        .footer-social {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }
        .footer-social a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-green);
            color: #fff;
            font-size: 16px;
            text-decoration: none;
            transition: var(--transition);
        }
        .footer-social a:hover {
            background: var(--dark-green);
            transform: translateY(-2px);
        }
        .footer-details {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
            max-width: 100%;
            text-align: left;
        }
        .footer-details summary {
            cursor: pointer;
            color: var(--primary-green);
            font-weight: 600;
            margin-bottom: 10px;
        }
        .footer-details p {
            line-height: 1.7;
            margin-top: 10px;
        }
        .footer-copyright {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #999;
            width: 100%;
            text-align: center;
        }

        /* ==== Media Queries ==== */
        @media (max-width: 768px) {
            .nav-menu { display: none; }
            .hamburger { display: block; }
            .banner-politica { height: 180px; }
            .banner-politica h1 { font-size: 2rem; }
            .container { margin-top: -20px; }
            .politica-content { padding: 30px 20px; }
            .footer-text { text-align: left; }
            /* Rolagem para tabelas em celular */
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>
  <link href="css/brand-tokens.css?<?= uniqid() ?>" rel="stylesheet">
</head>
<body>

<!-- ==== Top warning bar ==== -->
<div class="top-bar">
    Atenção! A LiberaCash não cobra nenhum depósito antecipado para a liberação de empréstimo.
</div>

<!-- ==== Header ==== -->
<header class="header">
    <div class="header-container">
        <div class="logo">
            <a href="/"><img src="images/logo.png" alt="LiberaCash"></a>
        </div>
        
        <ul class="nav-menu">
            <li><a href="/">Crédito</a></li>
            <li><a href="/cartoes/">Cartões</a></li>
            <li><a href="/blog/">Blog</a></li>
            <li><a href="/sobre/">Sobre</a></li>
            <li><a href="/contato/">Contato</a></li>
        </ul>
        <div class="hamburger"><i class="fas fa-bars"></i></div>
    </div>
</header>

<nav class="breadcrumbs" aria-label="breadcrumb">
    <a href="/">Início</a>
    <span class="sep">/</span>
    <span class="current">Política de Privacidade</span>
</nav>

<!-- ==== Banner Política ==== -->
<div class="banner-politica">
    <h1>Política de Privacidade</h1>
</div>

<!-- ==== Conteúdo ==== -->
<div class="container">
    <div class="politica-content">
        <p><strong>POLÍTICA DE PRIVACIDADE – WWW.LIBERA.CASH</strong></p>
        <p>
            <strong>LZO AGÊNCIA DE PUBLICIDADE LTDA</strong><br>
            CNPJ: 05.595.492/0001-05<br>
            Endereço: Av. Paulista, 1636 - Conj 04 Sala 1504, Bela Vista, São Paulo/SP, CEP 01.310-200<br>
            Conhecida comercialmente como "LZO Performance"
        </p>
        <p>Para a LZO Performance, proprietária e operadora do site libera.cash, a privacidade e a proteção dos seus dados pessoais são fundamentais. A coleta e a utilização de suas informações ocorrem exclusivamente dentro do âmbito das disposições legais da Lei Geral de Proteção de Dados (Lei nº 13.709/2018 - LGPD), do Marco Civil da Internet (Lei nº 12.965/2014) e das normas de Sigilo Bancário (Lei Complementar nº 105/2001).</p>
        <p>Com esta Política de Privacidade, informamos de maneira transparente como processamos dados pessoais em nosso site, landing pages e formulários voltados à originação e intermediação de crédito.</p>

        <h2>Âmbito de Aplicação</h2>
        <p>Esta política aplica-se especificamente a:</p>
        <ul>
            <li>Todas as páginas de internet, subdomínios e formulários operados na plataforma libera.cash;</li>
            <li>Campanhas de marketing e captação de propostas de crédito geridas pela LZO para este canal;</li>
            <li>Interações realizadas através de canais digitais como e-mail, SMS e aplicativos de mensagens (ex: WhatsApp) vinculados ao site.</li>
        </ul>

        <h2>Definições Importantes</h2>
        <p>Para facilitar a compreensão desta política, adotamos as seguintes definições baseadas na LGPD:</p>
        <ul>
            <li><strong>Dados Pessoais:</strong> Informações relacionadas a pessoa natural identificada ou identificável.</li>
            <li><strong>Titular:</strong> Pessoa física a quem se referem os dados pessoais (você, usuário/solicitante de crédito).</li>
            <li><strong>Controlador:</strong> A quem competem as decisões referentes ao tratamento de dados pessoais.</li>
            <li><strong>Operador:</strong> Quem realiza o tratamento de dados em nome do controlador.</li>
            <li><strong>Tratamento:</strong> Toda operação realizada com dados pessoais (coleta, análise, compartilhamento, armazenamento).</li>
        </ul>

        <h2>Quem Somos e Nosso Papel no Tratamento de Dados</h2>
        <p>A LZO Performance atua no site libera.cash primordialmente como Correspondente Bancário (nos termos da Resolução CMN nº 4.935 do Banco Central do Brasil) ou parceira de originação de leads financeiros:</p>
        <ul>
            <li><strong>LZO como CONTROLADORA:</strong> Somos responsáveis pelas decisões de tratamento quando você navega em nossa plataforma, simula propostas, aceita nossos termos ou entra em contato com nosso atendimento.</li>
            <li><strong>LZO como OPERADORA/CORRESPONDENTE:</strong> Ao coletar seus dados para propostas de financiamento, empréstimos ou cartões, nós os transmitimos para as Instituições Financeiras Parceiras (Bancos/Fintechs). Neste caso, a instituição financeira escolhida atuará como Controladora dos dados para fins de análise final e concessão do crédito, seguindo suas próprias políticas.</li>
        </ul>

        <h2>Quais Dados Coletamos</h2>
        <p>Para viabilizar a análise de crédito pelos nossos parceiros, coletamos informações detalhadas:</p>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Exemplos</th>
                        <th>Origem</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Dados de Identificação</strong></td>
                        <td>Nome completo, e-mail, telefone/celular, CPF, RG, CNH, gênero, data de nascimento, filiação e endereço residencial.</td>
                        <td>Formulários de simulação no site.</td>
                    </tr>
                    <tr>
                        <td><strong>Dados Financeiros e Profissionais</strong></td>
                        <td>Renda mensal, profissão, cargo, dados bancários (agência e conta para depósito), vínculo empregatício (CLT, PJ, Aposentado, Servidor Público), histórico e situação de crédito (restrições).</td>
                        <td>Formulários de simulação no site.</td>
                    </tr>
                    <tr>
                        <td><strong>Dados de Navegação</strong></td>
                        <td>Endereço IP, tipo de navegador, sistema operacional, data/hora de acesso, geolocalização e cookies.</td>
                        <td>Coleta automática via navegador.</td>
                    </tr>
                    <tr>
                        <td><strong>Dados de Interação</strong></td>
                        <td>Histórico de comunicações via WhatsApp, SMS, e-mails de simulação e comportamento em nossas páginas.</td>
                        <td>Ferramentas de atendimento e CRM.</td>
                    </tr>
                    <tr>
                        <td><strong>Dados Enriquecidos</strong></td>
                        <td>Informações sobre restrições financeiras, score de crédito e dados cadastrais adicionais.</td>
                        <td>Consultas legítimas a Bureaus de Crédito e SCR.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2>Para Que Usamos Seus Dados (Finalidades e Bases Legais)</h2>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Finalidade</th>
                        <th>Base Legal (LGPD)</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Análise de Viabilidade de Crédito</strong></td>
                        <td>Proteção ao Crédito (Art. 7º, X) ou Procedimentos Preliminares de Contrato (Art. 7º, V)</td>
                        <td>Avaliar o seu perfil de risco e capacidade de pagamento para apresentar as melhores opções de crédito.</td>
                    </tr>
                    <tr>
                        <td><strong>Envio de Propostas para Bancos Parceiros</strong></td>
                        <td>Execução de Contrato (Art. 7º, V)</td>
                        <td>Transferir seus dados via API para as instituições financeiras parceiras que concederão o crédito simulado.</td>
                    </tr>
                    <tr>
                        <td><strong>Consultas a Bureaus de Crédito</strong></td>
                        <td>Proteção ao Crédito (Art. 7º, X)</td>
                        <td>Consultar birôs como Serasa, Boa Vista e Quod para validar as informações declaradas e pontuação de score.</td>
                    </tr>
                    <tr>
                        <td><strong>Comunicação e Ofertas</strong></td>
                        <td>Consentimento (Art. 7º, I) ou Legítimo Interesse</td>
                        <td>Enviar atualizações sobre o andamento da sua proposta ou novas oportunidades de crédito via e-mail, SMS ou WhatsApp.</td>
                    </tr>
                    <tr>
                        <td><strong>Segurança e Prevenção à Fraude</strong></td>
                        <td>Garantia da Prevenção à Fraude (Art. 11, II, "g")</td>
                        <td>Validar sua identidade (Prevenção à Fraude e Lavagem de Dinheiro) e proteger nossos sistemas através do sistema FormUp®.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2>Compartilhamento de Dados</h2>
        <p>Devido à natureza do serviço de intermediação de crédito, o compartilhamento é essencial e ocorrerá com:</p>
        <ul>
            <li><strong>Instituições Financeiras e Bancos Parceiros:</strong> Entidades integradas ao site para as quais sua proposta é enviada com o objetivo de aprovação do crédito.</li>
            <li><strong>Bureaus de Crédito e Proteção ao Crédito:</strong> Empresas como Serasa Experian, Boa Vista SCPC e Quod, para fins de análise de risco e score.</li>
            <li><strong>Sistema de Informações de Crédito (SCR) do Banco Central:</strong> Consultas autorizadas por você para verificar o histórico de operações de crédito vigentes, conforme normas do BACEN.</li>
            <li><strong>Provedores de Tecnologia:</strong> Ferramentas de CRM, disparo de mensagens e o sistema proprietário FormUp®, operando sob estritos contratos de sigilo.</li>
        </ul>

        <h2>Decisões Automatizadas e Perfilamento (Score)</h2>
        <p>Os processos de simulação do site libera.cash e de nossos parceiros financeiros utilizam processamento automatizado de dados para gerar scores e pré-aprovações de crédito baseados no seu perfil.</p>
        <p>Conforme o Artigo 20 da LGPD, você tem o direito de solicitar a revisão de decisões tomadas unicamente com base em tratamento automatizado de seus dados que afetem seus interesses, bastando entrar em contato através do e-mail privacidade@lzo.com.br.</p>

        <h2>Retenção e Eliminação de Dados</h2>
        <p>Seus dados são armazenados pelo período estritamente necessário para o cumprimento das finalidades:</p>
        <ul>
            <li><strong>Propostas e Simulações:</strong> Mantidas em nossa base para acompanhamento comercial enquanto houver relacionamento ativo, ou pelo prazo legal exigido pelo Banco Central para registros de correspondentes bancários.</li>
            <li><strong>Logs de Acesso:</strong> Guardados por no mínimo 6 meses, em cumprimento ao Art. 15 do Marco Civil da Internet.</li>
            <li><strong>Defesa Jurídica:</strong> Retidos de acordo com os prazos prescricionais civis vigentes (Exercício Regular de Direitos).</li>
        </ul>

        <h2>Segurança dos Dados</h2>
        <p>A LZO Performance adota rigorosas medidas de segurança técnicas para o ambiente do libera.cash, incluindo:</p>
        <ul>
            <li>Uso do sistema proprietário FormUp®, com tráfego de dados criptografado (HTTPS/SSL);</li>
            <li>Protocolos rígidos de segurança de rede para impedir vazamento de dados sensíveis;</li>
            <li>Comunicação de qualquer incidente de segurança envolvendo riscos relevantes à ANPD e aos titulares em até 3 dias úteis (Art. 48 da LGPD).</li>
        </ul>

        <h2>Seus Direitos como Titular (Art. 18 LGPD)</h2>
        <p>Você pode, a qualquer momento, requisitar à LZO Performance:</p>
        <ul>
            <li>Confirmação da existência de tratamento e acesso aos seus dados;</li>
            <li>Correção de dados incompletos ou desatualizados;</li>
            <li>Eliminação de dados desnecessários ou baseados em consentimento;</li>
            <li>Revisão de decisões automatizadas de crédito (Art. 20).</li>
        </ul>
        <p><strong>Como exercer:</strong> Envie um e-mail para privacidade@lzo.com.br. Para proteção do próprio sigilo bancário, poderemos solicitar validação de identidade antes de enviar os dados. O atendimento é gratuito e respondido em até 15 dias.</p>

        <h2>Alterações, Lei Aplicável e Foro</h2>
        <p>Esta política poderá ser modificada a qualquer tempo para adequação a novas normas do Banco Central ou da ANPD. Este documento é regido pelas leis da República Federativa do Brasil. Fica eleito o Foro da Comarca de São Paulo/SP para dirimir litígios.</p>
        
        <p style="margin-top: 40px; font-style: italic;">Data da última atualização: 27/02/2026</p>

        <div class="box-destaque">
            <p style="margin-bottom: 0;"><strong>CONSENTIMENTO E AUTORIZAÇÃO:</strong> Ao preencher os formulários no site libera.cash, você declara ciência inequívoca desta Política e autoriza expressamente a LZO Performance a consultar seus dados junto a bureaus de crédito e transmiti-los às instituições financeiras parceiras para fins de análise e oferta de crédito.</p>
        </div>
    </div>
</div>

<!-- ==== Footer ==== -->
<footer class="footer">
    <div class="footer-container">
        <img src="images/logo-footer.png" class="footer-logo" alt="LiberaCash">

        <div class="footer-social">
            <a href="https://www.facebook.com/creditovoce" target="_blank" rel="noopener noreferrer" aria-label="Facebook LiberaCash"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/credito.vc/" target="_blank" rel="noopener noreferrer" aria-label="Instagram LiberaCash"><i class="fab fa-instagram"></i></a>
            <a href="#" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn LiberaCash"><i class="fab fa-linkedin-in"></i></a>
        </div>

        <div class="footer-text">
            Ao acessar/utilizar este site, você aceita as condições dos <a href="/termos-e-condicoes/" target="_blank">Termos de uso</a> e <a href="/politica-de-privacidade/" target="_blank">Política de Privacidade</a>.<br><br>
            LiberaCash é um site da LZO Agência de Publicidade LTDA (CNPJ 05.595.492/0001-05), sediada na Av. Paulista, 1636 — Bela Vista, São Paulo/SP. Não somos uma instituição financeira: oferecemos um serviço 100% gratuito de comparação de crédito pessoal e empresarial, conectando você às melhores condições entre nossos parceiros — principais Fintechs e Bancos do Brasil. Preencha o formulário e receba contato de um parceiro.
        </div>

        <details class="footer-details">
            <summary>Ver condições completas de crédito</summary>
            <p>Prazo de pagamento: varia de acordo com a instituição financeira escolhida, podendo ser entre 6 e 120 meses. A taxa de juros pode variar de 14,9% a.m. (423,96% a.a.) até 18,5% a.m. (668,75% a.a.), e o custo efetivo total (CET) pode variar de 15,57% a.m. (467,86% a.a.) até 27,29% a.m. (1709,88% a.a.). Exemplo: um empréstimo de R$ 750,00 em 6 meses com taxa de juros de 14,9% a.m. terá parcelas de R$ 198,39 (caso o CET seja igual à taxa de juros). Um modelo de aparelho celular compatível poderá ser necessário para a aprovação do crédito.</p>
        </details>

        <div class="footer-copyright">
            &copy; <?php echo date('Y'); ?> LiberaCash. Todos os direitos reservados.
        </div>
    </div>
</footer>

<!-- ==== Scripts ==== -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    // Menu Hamburger Mobile
    $('.hamburger').click(function(){
        $('.nav-menu').slideToggle();
    });
});
</script>

</body>
</html>
