<?php
require '../Model/conexao.php';
require_once '../controller/autenticacao.class.php';
require_once '../controller/usuario.class.php';

// Verifica se o usuário logado é administrador
$isAdmin = Autenticacao::verificarPermissaoAdmin($mysqli);

// Verifica se a matrícula do usuário a ser editado foi fornecida na URL
if (isset($_GET['matricula'])) {
    $matricula = $_GET['matricula'];

    // Verifica se o formulário foi submetido
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Processa o formulário de atualização
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $area_responsavel = isset($_POST['area_responsavel']) ? $_POST['area_responsavel'] : null;

        // Define automaticamente isAdmin com base na presença de uma área responsável
        $isAdminPost = ($area_responsavel !== null) ? 1 : 0;

        // Verifica se a área já está atribuída a outro usuário apenas se o usuário for admin
        if ($isAdminPost == 1 && $area_responsavel !== null) {
            $queryVerificarArea = "SELECT COUNT(*) FROM usuario WHERE area_responsavel = ? AND matricula <> ?";
            $stmtVerificarArea = $mysqli->prepare($queryVerificarArea);
            $stmtVerificarArea->bind_param('is', $area_responsavel, $matricula);
            $stmtVerificarArea->execute();
            $stmtVerificarArea->bind_result($count);
            $stmtVerificarArea->fetch();
            $stmtVerificarArea->close();

            if ($count > 0) {
                echo "Erro: Área já atribuída a outro usuário.";
                exit();
            }
        }

        // Atualiza as informações no banco de dados
        $queryAtualizacao = "UPDATE usuario SET nome=?, email=?, isAdmin=?, area_responsavel=? WHERE matricula=?";
        $stmtAtualizacao = $mysqli->prepare($queryAtualizacao);
        $stmtAtualizacao->bind_param('ssisi', $nome, $email, $isAdminPost, $area_responsavel, $matricula);

        if ($stmtAtualizacao->execute()) {
            echo "Usuário atualizado com sucesso!";
            header("Location: lista_usuario.php"); // Redireciona para a lista de usuários
            exit();
        } else {
            echo "Erro ao atualizar o usuário: " . $stmtAtualizacao->error;
        }

        $stmtAtualizacao->close();
    }

    // Consulta as informações do usuário específico
    $query = "SELECT matricula, nome, email, isAdmin, area_responsavel FROM usuario WHERE matricula = ?";
    $stmt = $mysqli->prepare($query);

    // Altere 's' para 'i' se a matrícula for um número inteiro
    $stmt->bind_param('s', $matricula);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o usuário existe
    if ($result && $result->num_rows == 1) {
        $usuario = $result->fetch_assoc();

        // Exibe o formulário de edição
        echo "<form id='editarForm' action='' method='post'>"; // Deixe o action vazio para enviar para a mesma página
        echo "<input type='hidden' name='matricula' value='{$usuario['matricula']}'>
                Nome: <input type='text' name='nome' value='{$usuario['nome']}' required><br>
                Email: <input type='email' name='email' value='{$usuario['email']}' required><br>";

        // Adiciona campo oculto para isAdmin
        echo "<input type='hidden' name='isAdmin' value='{$usuario['isAdmin']}'>";

        // Exibe o select para a área responsável apenas se o usuário for admin
        echo "<div id='areaResponsavelDiv' style='display: " . ($usuario['isAdmin'] == 1 ? 'block' : 'none') . ";'>
                Área Responsável: 
                <select name='area_responsavel'>";
        echo "<option value='' " . ($usuario['area_responsavel'] === null ? 'selected' : '') . ">Nenhuma</option>";
        $queryAreas = "SELECT id_area, nome_area FROM area_responsavel";
        $resultAreas = $mysqli->query($queryAreas);
        
        while ($rowArea = $resultAreas->fetch_assoc()) {
            echo "<option value='{$rowArea['id_area']}'";
            if ($usuario['area_responsavel'] == $rowArea['id_area']) {
                echo " selected";
            }
            echo ">{$rowArea['nome_area']}</option>";
        }
        echo "</select><br></div>";

        echo "<input type='submit' value='";
        echo ($usuario['area_responsavel'] !== null) ? 'Atualizar' : 'Salvar';
        echo "'>
            </form>";

        // Adiciona script JavaScript para alternar a visibilidade do select de área responsável
        echo "<script>
                document.getElementById('areaResponsavelDiv').style.display = ({$usuario['isAdmin']} === 1) ? 'block' : 'none';
              </script>";
    } else {
        echo "Usuário não encontrado.";
    }

    // Fecha a conexão com o banco de dados
    $stmt->close();
} else {
    echo "Matrícula do usuário não fornecida.";
}

$mysqli->close();
?>
