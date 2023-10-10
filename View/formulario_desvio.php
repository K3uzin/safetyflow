<!-- Possível caminho View/form.php -->
<?php
require '../Model/conexao.php'; // Verifique se o caminho está correto

session_start();

if (!isset($_SESSION["user_matricula"])) {
    // Se o usuário não estiver logado, redirecione para a página de login
    header("Location: login.php");
    exit();
}

$user_matricula = $_SESSION["user_matricula"];

// Consulta para obter o nome do usuário com base na matrícula
$sql_nome = "SELECT nome FROM usuario WHERE matricula = ?";
$stmt_nome = $mysqli->prepare($sql_nome);

if ($stmt_nome) {
    $stmt_nome->bind_param("s", $user_matricula);
    $stmt_nome->execute();
    $stmt_nome->bind_result($nome);

    // Armazene o nome em uma variável para exibição posterior
    $stmt_nome->fetch();
    $stmt_nome->close();
} else {
    echo "Erro na preparação do statement: " . $mysqli->error;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Checklist Desvios Corporativos</title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="bootstrap/css/form-validation.css" rel="stylesheet">
    <link rel="icon" href="img/logo.ico" type="image/x-icon">
</head>

<body class="bg-light">
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" src="img/logo.png" alt="" width="150" height="150">
                <h2>Desvios Corporativos</h2>
                <p class="lead">Abrir um desvio é como ter um superpoder empresarial: você aponta riscos e melhorias
                    essenciais. Seja parte da mudança para um ambiente mais seguro e eficiente!</p>
            </div>
            <div class="row g-3" style="text-align: left; align-items: center; justify-content: center;">
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Faça a diferença!</h4>
                    <form action="recebe_desvio.php" method="post" style="text-align: left;">
                        <div class="row g-3 mt-3">
                            <!-- Data de identificação do desvio -->
                            <div class="col-12">
                                <label for="data_identificacao" class="form-label">Data que o desvio foi
                                    identificado</label>
                                <input type="date" class="form-control" id="data_identificacao" name="data_identificacao"
                                    required="">
                                <div class="invalid-feedback">
                                    Data do desvio é obrigatória.
                                </div>
                            </div>
                            <!-- Turno -->
                            <div class="col-12 mt-3">
                                <label for="turno" class="form-label">Turno</label>
                                <select class="form-select" id="turno" name="turno" required="">
                                    <option value="">Escolha...</option>
                                    <option value="Manhã">Manhã</option>
                                    <option value="Tarde">Tarde</option>
                                    <option value="Noite">Noite</option>
                                </select>
                                <div class="invalid-feedback">
                                    Turno é obrigatório.
                                </div>
                            </div>
                            <!-- Setor -->
                            <div class="col-12 mt-3">
                                <label for="setor_desvio" class="form-label">Setor</label>
                                <select class="form-select" id="setor" name="setor" required="">
                                    <option value="">Escolha...</option>
                                    <option value="1">Administrativa</option>
                                    <option value="2">Hidro</option>
                                    <option value="3">Cremes</option>
                                    <option value="4">Estojo</option>
                                    <option value="5">Qualidade</option>
                                    <option value="6">Logística</option>
                                </select>
                                <div class="invalid-feedback">
                                    Setor é obrigatório.
                                </div>
                            </div>
                            <!-- Local Exato -->
                            <div class="col-12 mt-3">
                                <label for="local_desvio" class="form-label">Local Exato</label>
                                <input type="text" class="form-control" id="local_desvio" name="local_desvio"
                                    required="">
                                <div class="invalid-feedback">
                                    Local exato é obrigatório.
                                </div>
                            </div>
                            <!-- Descrição do Desvio -->
                            <div class="col-12 mt-3">
                                <label for="descricao_desvio" class="form-label">Descrição do Desvio</label>
                                <textarea class="form-control" id="descricao_desvio" name="descricao_desvio" rows="5"
                                    required=""></textarea>
                                <div class="invalid-feedback">
                                    Descrição do desvio é obrigatória.
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <!-- Tipo do Desvio -->
                            <label for="tipo_desvio" class="form-label">Tipo do Desvio</label>
                            <select class="form-select" id="tipo_desvio" name="tipo_desvio" required="">
                                <option value="">Escolha...</option>
                                <option value="Desvio Comportamental">Desvio Comportamental</option>
                                <option value="Desvio Ergonômico">Desvio Ergonômico</option>
                                <option value="Desvio de Segurança">Desvio de Segurança</option>
                                <option value="Desvio de Qualidade">Desvio de Qualidade</option>
                                <option value="Desvio de Processo">Desvio de Processo</option>
                                <option value="Desvio Ambiental">Desvio Ambiental</option>
                                <option value="Desvio de Manutenção">Desvio de Manutenção</option>
                            </select>
                            <div class="invalid-feedback">
                                Tipo do desvio é obrigatório.
                            </div>
                        </div>
                        <!-- Potencial de Gravidade -->
                        <div class="col-12 mt-3">
                            <label for="gravidade" class="form-label">Potencial de Gravidade</label>
                            <select class="form-select" id="gravidade" name="gravidade" required="">
                                <option value="">Escolha...</option>
                                <option value="Leve">Leve</option>
                                <option value="Moderado">Moderado</option>
                                <option value="Grave">Grave</option>
                                <option value="Gravissimo">Gravíssimo</option>
                            </select>
                            <div class="invalid-feedback">
                                Potencial de gravidade é obrigatório.
                            </div>
                        </div>
                        <!-- Área Responsável -->
                        <div class="col-12 mt-3">
                            <label for="area_responsavel" class="form-label">Área Responsável pela Solução</label>
                            <select class="form-select" id="area_responsavel" name="area_responsavel" required="">
                                <option value="">Escolha...</option>
                                <option value="1">Manutenção</option>
                                <option value="2">Engenharia</option>
                                <option value="3">Produção</option>
                                <option value="4">Qualidade</option>
                                <option value="5">Recursos Humanos</option>
                                <option value="6">Segurança do Trabalho</option>
                                <option value="7">Meio Ambiente</option>
                            </select>
                            <div class="invalid-feedback">
                                Área responsável é obrigatória.
                            </div>
                        </div>
                        <!-- Foto do Desvio -->
                        <div class="col-12 mt-3">
                            <label for="foto_desvio" class="form-label">Insira uma foto do desvio, caso
                                necessário</label>
                            <input type="file" class="form-control" id="foto_desvio" name="foto_desvio" accept="image/*, video/*">
                        </div>
                        <!-- Botão de Envio -->
                        <div class="col-12 mt-4 text-center">
                            <button class="btn btn-primary btn-lg" type="submit"
                                style="padding-left: 30px; padding-right: 30px; background-color: #003884;">Abrir
                                desvio</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <!-- Rodapé -->
    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2023 SENAI</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacidade</a></li>
            <li class="list-inline-item"><a href="#">Termos</a></li>
            <li class="list-inline-item"><a href="#">Suporte</a></li>
        </ul>
    </footer>
    <script src="assets/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script>
        // Exemplo de JavaScript inicial para desativar o envio do formulário se houver campos inválidos
        (function () {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>

</html>
