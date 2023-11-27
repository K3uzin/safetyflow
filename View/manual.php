<!doctype html>

<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manual de Uso</title>
    <meta name="description" content="A simple HTML/CSS DocumentationTemplate">
    <meta name="author" content="Carlos Yllobre">

    <link rel="stylesheet" href="../Public/Css/manual.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,600&display=swap"
        rel="stylesheet">

    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"
        integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP"
        crossorigin="anonymous"></script>


</head>

<body>

    <div class="navbar clear nav-top">
        <div class="row content">
            <a href="#"><img class="logo" src="img/Security (700 x 350 px) (370 x 135 px).png"></a>
            <a class="right" style="text-decoration: underline;"
                href="https://docs.google.com/document/d/1ltjkUqQCCrbnJEPiQ8xQmgusvjAtWtMROCyYqeePFIM/edit"><i
                    class="fas fa-book"></i>&nbsp; Documentação</a>
            <a class="right" href="mailto:safetyflow1@gmail.com" target="_blank"><i
                    class="fas fa-paper-plane"></i>&nbsp;
                safetyflow1@gmail.com</a>
        </div>
    </div>

    <div class="container clear">
        <div class="row wrapper">

            <div class="sidepanel">

                <a class="title" href="#">Introdução</a>

                <a class="section" href="#">Versões Compatíveis</a>
                <a class="section" href="#">Perfil do Usuário</a>
                <a class="section" href="#technology">Feedback do Usuário</a>

                <div class="divider left"></div>

                <a class="title" href="#gettingstarted">Login</a>

                <a class="section" href="#installingapp">Acesso ao Sistema</a>
                <div class="divider left"></div>

                <a class="title" href="#basicfeatures">Registro de Desvios</a>

                <a class="section" href="#basicfeatures">Formulário</a>
                <a class="section" href="#basicfeatures">Campos Obrigatórios</a>
                <a class="section" href="#feature3">Anexar Imagem</a>
                <a class="section" href="#feature3">Área Responsável</a>
                <a class="section" href="#feature3">Notificação de Progresso</a>

                <div class="divider left"></div>

                <a class="title" href="#advanced">Gerenciamento de Desvios</a>

                <a class="section" href="#advanced">Lista de Desvios Abertos</a>
                <a class="section" href="#featureb">Detalhes do Desvio</a>
                <a class="section" href="#featurec">Encerrar ou Concluir</a>
                <a class="section" href="#featurec1">Histórico de Desvios</a>
                <a class="section" href="#featurec2">Notificação Imediata</a>
                <a class="section" href="#featured">Estatísticas</a>

                <div class="divider left"></div>

                <a class="title" href="#accesibility">Perfil de Usuário</a>
                <a class="section" href="">Alteração de Senha</a>
                <a class="section" href="">Logout</a>

                <div class="divider left"></div>

                <a class="title" href="#moreinfo">Perguntas Frequentes</a>
                <a class="section" href="">Como Recuperar a Senha</a>

                <div class="space double"></div>

            </div>

            <div class="right-col">



                <h1>Introdução</h1>

                <p>O Software de Registro de Desvios de Segurança foi projetado para ajudar as indústrias a manter
                    registros precisos de desvios de segurança identificados pelos funcionários. Ele permite que os
                    usuários relatem ocorrências, gerenciem e acompanhem o andamento dos desvios de segurança, anexem
                    imagens relevantes e atribuam a área responsável pelo reparo.</p>

                <h2>Versões Compatíveis:</h2>

                <p><b>Versão do Aplicativo 1.0.0.</b> Desfrute da experiência em celulares, tablets e computadores. </p>

                <h2>Perfil do Usuário</h2>

                <p id="technology">
                    O software é destinado a dois tipos de usuários:
                </p>

                <ul>
                    <li>
                        <b>Usuários Padrão</b> Funcionários que podem registrar desvios, visualizar seu próprio
                        histórico e atualizar informações de perfil.
                        <br>
                    <li>
                        <b>Administradores</b> Funcionários com permissões adicionais para visualizar todos os desvios,
                        encerrá-los ou marcá-los como concluídos.
                    </li>
                </ul>

                <h2>Feedback do Usuário</h2>

                <p>Na barra superior, ao clicar na opção "Feedback", o usuário é redirecionado à página para realizar a
                    avaliação do software, podendo compartilhar sua experiência ao utilizá-lo. O usuário tem a
                    possibilidade de avaliar o site, atribuindo uma classificação:
                    <br>
                    <br>
                    <b>Uma Estrela:</b> Muito Ruim<br>

                    <br>

                    <b>Duas Estrelas:</b> Ruim<br>

                    <br>

                    <b>Três Estrelas:</b> Moderado<br>

                    <br>

                    <b>Quatro Estrelas:</b> Ótimo<br>

                    <br>

                    <b>Cinco Estrelas:</b> Excelente<br>

                </p>
                <div class="divider" style="width:24%; margin:30px 0;"></div>

                <h1>Login</h1>

                <h2>Acesso ao Sistema</h2>

                <p>Para acessar o sistema, insira sua matrícula e senha na página de login. Se você esqueceu sua senha,
                    siga as instruções na seção "Esqueci senha".</p>

                <div class="divider" style="width:24%; margin:30px 0;"></div>


                <h1>Registro de Desvio de Segurança</h1>

                <h2>Formulário</h2>

                <p id="basicfeatures">Ao acessar o sistema, você é redirecionado automaticamente para o formulário para
                    preencher os desvios e informações. Preencha o formulário com as informações solicitadas, incluindo
                    a data de identificação, turno, setor, local do desvio, descrição e outros campos relevantes.</p>

                <h2>Campos Obrigatórios</h2>

                <p>
                    Certos campos são obrigatórios (indicados por asteriscos). Certifique-se de preenchê-los para enviar
                    com êxito o registro.
                </p>

                <h2>Anexar Imagem</h2>

                <p>
                    Se possível, anexe uma imagem relevante do desvio para uma documentação mais precisa. O sistema
                    aceita formatos de imagem como JPG, JPEG e HEIC., e o tamanho limite de até 15 MB..
                </p>

                <h2>Área Responsável</h2>

                <p>
                    Selecione a área da fábrica responsável pela correção do desvio na lista suspensa "Área
                    Responsável".
                </p>


                <h2>Notificação de Progresso</h2>

                <p>
                    Por meio de notificação via e-mail, o usuário será informado quando seu desvio for aberto, concluído
                    ou alterado por um administrador.
                </p>


                <div class="divider" style="width:24%; margin:30px 0;"></div>

                <h1>Gerenciamento de Desvios</h1>

                <h2>Lista de Desvios Abertos</h2>

                <p>Após o registro, os administradores poderão visualizar a lista total de desvios abertos e filtrá-los
                    de acordo com status, gravidade, data e setor. Clicando em lista de desvios na barra de navegação
                    superior.
                </p>


                <h2>Detalhes do Desvio</h2>

                <p>Clique em um desvio para ver detalhes, incluindo informações do usuário que relatou o desvio, data de
                    identificação, gravidade, setor, local entre outras informações (somente os administradores tem
                    acesso aos desvios).
                </p>


                <h2>Encerrar ou Concluir Desvios</h2>

                <p>Os administradores têm permissão para encerrar, e editar desvios de segurança atribuídos a sua área
                    responsável. Isso indicará que o desvio foi corrigido com sucesso ou não é mais relevante.</p>


                <h2>Histórico de Desvios</h2>

                <p>
                    Mantenha o controle do histórico de todos os desvios registrados. Isso ajudará a acompanhar os
                    desvios ao longo do tempo.
                </p>

                <h2>Notificação Imediata</h2>

                <p>Imediatamente após o registro, o administrador da área responsável a qual foi atribuído o desvio de
                    segurança, é notificado a respeito da ocorrência aberta em sua área.
                </p>


                <h2>Estatísticas</h2>

                <p>Ao clicar em setores o administrador será redirecionado a página que conta com a central de todas as
                    áreas, onde contém a informações e estatísticas dos desvios abertos e concluídos.
                </p>


                <div class="divider" style="width:24%; margin:30px 0;"></div>

                <h1>Perfil de Usuário</h1>

                <h2>Alteração de Senha</h2>

                <p>Você pode alterar sua senha a qualquer momento na seção "Perfil de Usuário" que será aberta ao clicar
                    no ícone de usuário. Isso garante a segurança da sua conta.
                </p>

                <h2>Logout</h2>

                <p>Sempre faça logout quando terminar de usar o sistema para garantir a segurança da sua conta. Ao
                    clicar no ícone do usuário, entre as opções será disponibilizada a opção “Sair”.
                </p>

                <div class="divider" style="width:24%; margin:30px 0;"></div>

                <h1>Perguntas Frequentes</h1>

                <h2>Como Recuperar a Senha</h2>

                <p>Se esqueceu sua senha, clique em "Esqueceu a senha?" Na página de login, o usuário será redirecionado
                    a uma página de recuperação, onde será enviado um link para o email cadastrado na ficha do
                    funcionário. Após esse envio, o usuário deve seguir os demais passos para a atualização da senha.
                </p>

                <div class="doublespace"></div>
                <div class="divider" style="width:24%; margin:30px 0;"></div>


            </div>

        </div>


    </div>


</body>

</html>
