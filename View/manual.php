<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manual de Uso do Software</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      padding-top: 60px;
    }

    footer {
      color: #fff;
    }

    .subtopics {
      display: none;
      margin-left: 20px;
    }

    .topic,
    .subtopic {
      cursor: pointer;
      list-style: none;
    }

    .clickable {
      cursor: pointer;
      color: #003884; /* Cor do azul */
      font-size: 28px; /* Tamanho da fonte aumentado */
      position: relative;
      text-decoration: none;
      transition: text-decoration 0.3s;
    }

    .clickable:hover {
      text-decoration: underline;
    }

    .arrow {
      position: absolute;
      right: 10px; /* Ajuste a posição conforme necessário */
      top: 38%;
      transform: translateY(-50%);
      width: 20px;
      height: 20px;
    }

    .arrow svg {
      width: 100%;
      height: 100%;
      fill: #003884; /* Cor do azul */
      transition: transform 0.3s; /* Adiciona uma transição suave */
    }

    .up svg {
      transform: rotate(180deg); /* Gira a seta para cima */
    }

    .selected .arrow .up {
      transform: rotate(0deg); /* Mantém a seta para cima quando selecionado */
    }

    .selected .arrow .down {
      transform: rotate(180deg); /* Gira a seta para baixo quando selecionado */
    }

    .container-topic {
      padding: 8px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); /* Adiciona uma sombra mais visível */
      margin-bottom: 10px; /* Adiciona espaço na parte inferior para separar os contêineres */
    }

    .topic h5 {
      margin-top: 10px; /* Ajuste conforme necessário */
    }
    .topic a, .subtopic a {
  color: #003884 !important;
}

.content p {
  font-size: 18px; /* Escolha o tamanho desejado, por exemplo, 16 pixels */
}


  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.topic, .subtopic').click(function() {
        var target = $(this).find('a').attr('href');
        $('html, body').animate({ scrollTop: $(target).offset().top }, 800);

        // Trocar a seta ao clicar
        var arrow = $(this).find('.arrow svg');
        arrow.toggleClass('up down');

        // Adicionar a classe 'selected' ao contêiner do tópico
        $(this).toggleClass('selected');
      });

      $('.topic').click(function() {
        $(this).find('.subtopics').slideToggle('slow');
      });
    });
  </script>
</head>
<body>
<div class="container mt-4">
    <h1 class="text-center mb-4">Manual de Uso</h1>

    <div class="container-topic">
        <ol>
            <li class="topic">
                <h5 class="clickable"><a href="#introducao">1. Introdução</a><span class="arrow down"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16"><path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/></svg></span><span class="arrow up" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up" viewBox="0 0 16 16"><path d="M14 11h-1V2a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9H2a1 1 0 0 0-1 1 1 1 0 0 0 1 1h12a1 1 0 0 0 1-1 1 1 0 0 0-1-1zM8 0a.5.5 0 0 0-.5.5v9.707l-2.646-2.647a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l3.5-3.5a.5.5 0 1 0-.708-.708L8.5 10.207V.5A.5.5 0 0 0 8 0z"/></svg></span></h5>
                <ol class="subtopics">
                    <li class="subtopic"><a href="#software-overview">1.1 Visão Geral do Software</a></li>
                    <li class="subtopic"><a href="#user-profile">1.2 Perfil do Usuário</a></li>
                    <li class="subtopic"><a href="#user-profile">1.3 Feedback do Usuário</a></li>
                </ol>
            </li>
            <!-- Adicione outros tópicos seguindo o mesmo padrão -->

        </ol>
    </div>
</div>

<div class="container mt-4">
    <div class="container-topic">
        <ol>
            <li class="topic">
                <h5 class="clickable"><a href="#login">2. Login</a><span class="arrow down"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16"><path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/></svg></span><span class="arrow up" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up" viewBox="0 0 16 16"><path d="M14 11h-1V2a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9H2a1 1 0 0 0-1 1 1 1 0 0 0 1 1h12a1 1 0 0 0 1-1 1 1 0 0 0-1-1zM8 0a.5.5 0 0 0-.5.5v9.707l-2.646-2.647a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l3.5-3.5a.5.5 0 1 0-.708-.708L8.5 10.207V.5A.5.5 0 0 0 8 0z"/></svg></span></h5>
                <ol class="subtopics">
                    <li class="subtopic"><a href="#software-overview">2.1 Acesso ao Sistema</a></li>
                </ol>
            </li>

        </ol>
    </div>
</div>

<div class="container mt-4">
    <div class="container-topic">
        <ol>
            <li class="topic">
                <h5 class="clickable"><a href="#RegistrodeDesvio">3. Registro de Desvio de Segurança</a><span class="arrow down"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16"><path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/></svg></span><span class="arrow up" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up" viewBox="0 0 16 16"><path d="M14 11h-1V2a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9H2a1 1 0 0 0-1 1 1 1 0 0 0 1 1h12a1 1 0 0 0 1-1 1 1 0 0 0-1-1zM8 0a.5.5 0 0 0-.5.5v9.707l-2.646-2.647a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l3.5-3.5a.5.5 0 1 0-.708-.708L8.5 10.207V.5A.5.5 0 0 0 8 0z"/></svg></span></h5>
                <ol class="subtopics">
                    <li class="subtopic"><a href="#software-overview">3.1. Preenchimento do Formulário</a></li>
                    <li class="subtopic"><a href="#software-overview">3.2. Campos Obrigatórios</a></li>
                    <li class="subtopic"><a href="#software-overview">3.3. Anexar Imagem</a></li>
                    <li class="subtopic"><a href="#software-overview">3.4. Selecionar a Área Responsável</a></li>
                    <li class="subtopic"><a href="#software-overview">3.5. Notificação de Progresso</a></li>
                </ol>
            </li>

        </ol>
    </div>
</div>

<div class="container mt-4">
    <div class="container-topic">
        <ol>
            <li class="topic">
                <h5 class="clickable"><a href="#Visualizacao">4. Visualização e Gerenciamento de Desvios</a><span class="arrow down"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16"><path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/></svg></span><span class="arrow up" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up" viewBox="0 0 16 16"><path d="M14 11h-1V2a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9H2a1 1 0 0 0-1 1 1 1 0 0 0 1 1h12a1 1 0 0 0 1-1 1 1 0 0 0-1-1zM8 0a.5.5 0 0 0-.5.5v9.707l-2.646-2.647a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l3.5-3.5a.5.5 0 1 0-.708-.708L8.5 10.207V.5A.5.5 0 0 0 8 0z"/></svg></span></h5>
                <ol class="subtopics">
                    <li class="subtopic"><a href="#software-overview">4.1. Lista de Desvios Abertos</a></li>
                    <li class="subtopic"><a href="#software-overview">4.2. Detalhes do Desvio</a></li>
                    <li class="subtopic"><a href="#software-overview">4.3. Encerrar ou Concluir Desvios</a></li>
                    <li class="subtopic"><a href="#software-overview">4.4. Histórico de Desvios</a></li>
                    <li class="subtopic"><a href="#software-overview">4.5. Notificação Imediata</a></li>
                    <li class="subtopic"><a href="#software-overview">4.6. Estatísticas</a></li>
                </ol>
            </li>

        </ol>
    </div>
</div>

<div class="container mt-4">
    <div class="container-topic">
        <ol>
            <li class="topic">
                <h5 class="clickable"><a href="#Perfil">5. Perfil de Usuário</a><span class="arrow down"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16"><path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/></svg></span><span class="arrow up" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up" viewBox="0 0 16 16"><path d="M14 11h-1V2a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9H2a1 1 0 0 0-1 1 1 1 0 0 0 1 1h12a1 1 0 0 0 1-1 1 1 0 0 0-1-1zM8 0a.5.5 0 0 0-.5.5v9.707l-2.646-2.647a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l3.5-3.5a.5.5 0 1 0-.708-.708L8.5 10.207V.5A.5.5 0 0 0 8 0z"/></svg></span></h5>
                <ol class="subtopics">
                    <li class="subtopic"><a href="#software-overview">5.1. Alteração de Senha</a></li>
                    <li class="subtopic"><a href="#software-overview">5.2. Logout</a></li>
                </ol>
            </li>

        </ol>
    </div>
</div>

<div class="container mt-4">
    <div class="container-topic">
        <ol>
            <li class="topic">
                <h5 class="clickable"><a href="#Perguntas">6. Perguntas Frequentes</a><span class="arrow down"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16"><path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/></svg></span><span class="arrow up" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up" viewBox="0 0 16 16"><path d="M14 11h-1V2a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9H2a1 1 0 0 0-1 1 1 1 0 0 0 1 1h12a1 1 0 0 0 1-1 1 1 0 0 0-1-1zM8 0a.5.5 0 0 0-.5.5v9.707l-2.646-2.647a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l3.5-3.5a.5.5 0 1 0-.708-.708L8.5 10.207V.5A.5.5 0 0 0 8 0z"/></svg></span></h5>
                <ol class="subtopics">
                    <li class="subtopic"><a href="#software-overview">6.1. Como Recuperar a Senha</a></li>
                </ol>
            </li>

        </ol>
    </div>
</div>
<!-- Parte explicativa Manual -->
  <div class="container" id="introducao">
    <h2>Introdução</h2>
    <div class="content">
      <h4 id="software-overview">1.1 Visão Geral do Software</h4>
      <p>O Software de Registro de Desvios de Segurança foi projetado para ajudar as indústrias a manter registros precisos de desvios de segurança identificados pelos funcionários. Ele permite que os usuários relatem ocorrências, gerenciem e acompanhem o andamento dos desvios de segurança, anexem imagens relevantes e atribuam a área responsável pelo reparo.</p>

      <h4 id="user-profile">1.2 Perfil do Usuário</h4>
      <p>O software é destinado a dois tipos de usuários:<br>
         Usuários Padrão: Funcionários que podem registrar desvios, visualizar seu próprio histórico e atualizar informações de perfil.<br>
         Administradores: Funcionários com permissões adicionais para visualizar todos os desvios, encerrá-los ou marcá-los como concluídos.</p>

      <h4 id="software-overview">1.3. Feedback do Usuário</h4>
      <p>Na barra superior, ao clicar na opção “Feedback”, usuário é redirecionado à página para realizar a avaliação do software, podendo contar sua experiência usando-o.
         O usuário pode avaliar o site, classificando:<br>
         Uma Estrela: Muito Ruim<br>
         Duas Estrelas: Ruim<br>
         Três Estrelas: Moderado<br>
         Quatro Estrelas: Ótimo<br>
         Cinco Estrelas: Execelente</p>
    </div>
  </div>

  <div class="container" id="login">
    <h2>Login</h2>
    <div class="content">
      <h4 id="software-overview">2.1 Acesso ao Sistema</h4>
      <p>Para acessar o sistema, insira sua matrícula e senha na página de login. Se você esqueceu sua senha, siga as instruções na seção "Esqueci senha".</p>
    </div>
  </div>

  <div class="container" id="RegistrodeDesvio">
    <h2>Registro de Desvio de Segurança</h2>
    <div class="content">
      <h4 id="software-overview">3.1. Preenchimento do Formulário</h4>
      <p>Ao acessar o sistema, você é redirecionado automaticamente para o formulário para preencher os desvios e informações. Preencha o formulário com as informações solicitadas, incluindo a data de identificação, turno, setor, local do desvio, descrição e outros campos relevantes.</p>
    
      <h4 id="software-overview">3.2. Campos Obrigatórios</h4>
      <p>Certos campos são obrigatórios (indicados por asteriscos). Certifique-se de preenchê-los para enviar com êxito o registro.</p>
      
      <h4 id="software-overview">3.3. Anexar Imagem</h4>
      <p>Se possível, anexe uma imagem relevante do desvio para uma documentação mais precisa. O sistema aceita formatos de imagem como JPG, JPEG e HEIC., e o  tamanho limite de até 15 MB.</p>

      <h4 id="software-overview">3.4. Selecionar a Área Responsável</h4>
      <p>Selecione a área da fábrica responsável pela correção do desvio na lista suspensa "Área Responsável".</p>

      <h4 id="software-overview">3.5. Notificação de Progresso</h4>
      <p>Por meio de notificação via e-mail, o usuário irá ser notificado quando o seu desvio for aberto, concluído ou alterado por um administrador.</p>
    </div>
  </div>

  <div class="container" id="Visualizacao">
    <h2>Visualização e Gerenciamento de Desvios</h2>
    <div class="content">
      <h4 id="software-overview">4.1. Lista de Desvios Abertos</h4>
      <p>Após o registro, os administradores poderão visualizar a lista total de desvios abertos e filtrá-los de acordo com status, gravidade, data e setor. Clicando em lista de desvios na barra de navegação superior.</p>
    
      <h4 id="software-overview">4.2. Detalhes do Desvio</h4>
      <p>Clique em um desvio para ver detalhes, incluindo informações do usuário que relatou o desvio, data de identificação, gravidade, setor, local entre outras informações (somente os administradores tem acesso aos desvios).</p>
      
      <h4 id="software-overview">4.3. Encerrar ou Concluir Desvios</h4>
      <p>Os administradores têm permissão para encerrar, e editar desvios de segurança atribuídos a sua área responsável. Isso indicará que o desvio foi corrigido com sucesso ou não é mais relevante.</p>

      <h4 id="software-overview">4.4. Histórico de Desvios</h4>
      <p>Mantenha o controle do histórico de todos os desvios registrados. Isso ajudará a acompanhar os desvios ao longo do tempo.</p>

      <h4 id="software-overview">4.5. Notificação Imediata</h4>
      <p>Imediatamente após o registro, o administrador da área responsável a qual foi atribuído o desvio de segurança, é notificado a respeito da ocorrência aberta em sua área.</p>

      <h4 id="software-overview">4.6. Estatísticas</h4>
      <p>Ao clicar em setores o administrador será redirecionado a página que conta com a central de todas as áreas, onde contém a informações e estatísticas dos desvios abertos e concluídos.</p>
    </div>
  </div>

  <div class="container" id="Perfil">
    <h2>Perfil de Usuário</h2>
    <div class="content">
      <h4 id="software-overview">5.1. Alteração de Senha</h4>
      <p>Você pode alterar sua senha a qualquer momento na seção "Perfil de Usuário" que será aberta ao clicar no ícone de usuário. Isso garante a segurança da sua conta.</p>
    
      <h4 id="software-overview">5.2. Logout</h4>
      <p>Sempre faça logout quando terminar de usar o sistema para garantir a segurança da sua conta. Ao clicar no ícone do usuário, entre as opções será disponibilizada a opção “Sair”.</p>
    </div>
  </div>

  <div class="container" id="Perguntas">
    <h2>Perguntas Frequentes</h2>
    <div class="content">
      <h4 id="software-overview">6.1. Como Recuperar a Senha</h4>
      <p>Se esqueceu sua senha, clique em "Esqueceu a senha?" Na página de login, o usuário será redirecionado a uma página de recuperação, onde será enviado um link para o email cadastrado na ficha do funcionário. Após esse envio, o usuário deve seguir os demais passos para a atualização da senha.</p>
    </div>
  </div>
  <!-- Adicione outras seções seguindo o mesmo padrão -->

</body>
</html>
