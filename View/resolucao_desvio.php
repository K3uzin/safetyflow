<?php
require_once '../Model/conexao.php';
require_once '../Controller/desvio.class.php';
require_once '../Controller/resolucao.class.php';
?>
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

$desvio = new desvio;
$desvio_id = $_SESSION['desvio_selecionado'];
$desvio->fetch_desvio($desvio_id,$mysqli);
$resolucao_id = null;

if(isset($_SESSION['resolucao_selecionada'])){
    
    $resolucao_id = $_SESSION['resolucao_selecionada'];

    $resolucao = new resolucao;
    $resolucao->fetch_resolucao($resolucao_id,$mysqli);
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
    <link href="../Public/Css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../Public/Css/form-validation.css" rel="stylesheet">
    <link rel="icon" href="..Public/Img/logo.ico" type="image/x-icon">
</head>

<body class="bg-light">
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" src="../Public/Img/logo.png" alt="" width="150" height="150">
                <h2>Desvios Corporativos</h2>
                <p class="lead">Abrir um desvio é como ter um superpoder empresarial: você aponta riscos e melhorias
                    essenciais. Seja parte da mudança para um ambiente mais seguro e eficiente!</p>
            </div>
            <div class="row g-3" style="text-align: left; align-items: center; justify-content: center;">
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Faça a diferença!</h4>
                    <form action="../Controller/recebe_resolucao.php" method="POST" style="text-align: left;" enctype="multipart/form-data">
                        <div class="row mt-3">
                             <!-- matricula do usuario do desvio -->
                            <div class="col-12">
                                <?php
                                echo "<br>matricula do usuario: <br>";
                                echo $desvio->get_usuario_matricula();
                                ?>    
                            </div>
                             <!-- nome do usuario do desvio -->
                            <div class="col-12">
                                <?php
                                echo "<br>nome do usuario: <br>";
                                echo $desvio->get_usuario_nome();
                                ?>    
                            </div>
                            <!-- Data de identificação do desvio -->
                            <div class="col-12">
                                <?php
                                echo "<br>data de abertura desvio: <br>";
                                echo $desvio->get_data_identificacao();
                                ?>    
                            </div>
                            <!-- Turno -->
                            <div class="col-12 mt-3">
                                <?php
                                echo "<br>turno do desvio: <br>";
                                echo $desvio->get_turno();
                                ?>
                            </div>
                            <!-- Setor -->
                            <div class="col-12 mt-3">
                                <?php
                                echo "<br>setor do desvio: <br>";
                                echo $desvio->get_setor();
                                ?>
                            </div>
                            </div>
                            <!-- Local Exato -->
                            <div class="col-12 mt-3">
                                <?php
                                echo "<br>local exato do desvio: <br>";
                                echo $desvio->get_local();
                                ?>
                            </div>
                            <!-- descricao do desvio -->
                            <div>
                                <?php
                                echo "<br>descricao do desvio: <br>";
                                echo $desvio->get_descricao();
                                ?>
                            </div>
                            <!-- açoes tomadas -->
                            <div class="col-12 mt-3">
                                <?php if ($resolucao_id == null): ?>
                                    <label for="descricao_desvio" class="form-label">açoes tomadas</label>
                                    <textarea class="form-control" id="acoes" name="acoes" rows="5" required=""></textarea>
                                    <div class="invalid-feedback">
                                        Designar uma ação e obrigatorio.
                                    </div>
                                <?php endif;?>
                                <?php if ($resolucao_id != null): ?>
                                    <label for="descricao_desvio" class="form-label">açoes tomadas</label>
                                    <textarea class="form-control" id="acoes" name="acoes" rows="5" required=""><?php echo htmlspecialchars($resolucao->get_acoes());?></textarea>
                                    <div class="invalid-feedback">
                                        Designar uma ação e obrigatorio.
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <!-- Tipo do Desvio -->
                            <label for="tipo_desvio" class="form-label">Tipo do Desvio</label>
                            <select class="form-select" id="tipo_desvio" name="tipo_desvio" required="">
                                <option value="0"><?php echo htmlspecialchars($desvio->get_tipo_desvio());?></option>
                                <option value="1">Desvio Comportamental</option>
                                <option value="2">Desvio Ergonômico</option>
                                <option value="3">Desvio de Segurança</option>
                                <option value="4">Desvio de Qualidade</option>
                                <option value="5">Desvio de Processo</option>
                                <option value="6">Desvio Ambiental</option>
                                <option value="7">Desvio de Manutenção</option>
                            </select>
                            <div class="invalid-feedback">
                                Tipo do desvio é obrigatório.
                            </div>
                        </div>
                        <!-- Potencial de Gravidade -->
                        <div class="col-12 mt-3">
                            <label for="gravidade" class="form-label">Potencial de Gravidade</label>
                            <select class="form-select" id="gravidade" name="gravidade" required="">
                                <option value="0"><?php echo htmlspecialchars($desvio->get_gravidade());?></option>
                                <option value="1">Leve</option>
                                <option value="2">Moderado</option>
                                <option value="3">Grave</option>
                                <option value="4">Gravíssimo</option>
                            </select>
                            <div class="invalid-feedback">
                                Potencial de gravidade é obrigatório.
                            </div>
                        </div>
                        <!-- Área Responsável -->

                        <div class="col-12 mt-3">
                            <label for="area_responsavel" class="form-label">Área Responsável pela Solução</label>
                            <select class="form-select" id="area_responsavel" name="area_responsavel" required="">
                                <option value="0"><?php echo htmlspecialchars($desvio->get_area_responsavel());?></option>
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
                        <!--status do desvio-->
                        <div class="col-12 mt-3">
                            <label for="status" class="form-label">status</label>
                            <?php if ($resolucao_id == null): ?>
                                <select class="form-select" id="status_resolucao" name="status_resolucao" required="">
                                    <option value="">escolha...</option>
                                    <option value="1">em analise</option>
                                    <option value="2">resolucao em andamento</option>
                                    <option value="3">desvio resolvido</option>
                                </select>
                                <div class="invalid-feedback">
                                    status é obrigatório.
                                </div>
                            <?php endif; ?>
                            <?php if ($resolucao_id !== null): ?>
                                <select class="form-select" id="status_resolucao" name="status_resolucao" required="">
                                    <option value="0"><?php echo htmlspecialchars($resolucao->get_status()); ?></option>
                                    <option value="1">Em análise</option>
                                    <option value="2">Resolução em andamento</option>
                                    <option value="3">Desvio resolvido</option>
                                </select>
                            <?php endif; ?>

                        </div>
                        <!-- Foto do Desvio -->
                        <div class="col-12 mt-3">
                        <?php
                            $img = $desvio->get_img();
                                // Exibir a imagem, se existir
                            if ($img != null) {
                                $imagem_url = 'http://localhost/safetyflow/Desvio/' . basename($desvio->get_img());
                                var_dump($imagem_url);
                                echo "<br>Imagem do Desvio: <br><img src='$imagem_url' alt='Imagem do desvio'>";
                            } else {
                                echo "<br>Imagem do Desvio: Nenhuma imagem disponível";
                            }
                        ?>
                        </div>
                        <!-- Botão de Envio -->
                        <?php 
                        $query = "SELECT * from resolucao where id_desvio = $desvio_id";
                        $result = $mysqli->query($query);
                        if($result->num_rows == 0){
                            $b = "abrir resolução do desvio";
                            $new = 1;
                        
                        }
                        if($result->num_rows > 0){
                            $b = "editar resolução";
                            $new = 0;
                        }
                        $_SESSION['new'] = $new
                        ?>
                        <div class="col-12 mt-4 text-center">
                            <button class="btn btn-primary btn-lg" type="submit"
                                style="padding-left: 30px; padding-right: 30px; background-color: #003884;"><?php
                                echo $b;?></button>
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
    <script src="../Public/Js/popper.min.js"></script>
    <script src="../Public/Css/bootstrap.min.css"></script>
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
    <script>
    var dataAtual = new Date().toISOString();

    // Define o valor do campo de entrada oculto com a data atual
    document.getElementById("data_identificacao").value = dataAtual;
  </script>
</body>
</html>