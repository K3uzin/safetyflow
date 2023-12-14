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
        $senha = $_POST['senha'];
        $isAdminPost = isset($_POST['isAdmin']) ? $_POST['isAdmin'] : 0;
        $setor = $_POST['setor'];
        $area_responsavel = isset($_POST['area_responsavel']) ? $_POST['area_responsavel'] : null;

        // Verifica se a opção "não especificada" foi selecionada
        if ($area_responsavel === '') {
            // Se "não especificada" foi selecionada, define isAdminPost para 0
            $isAdminPost = 0;
        }

        // Atualiza as informações no banco de dados
        $queryAtualizacao = "UPDATE usuario SET nome=?, email=?, senha=?, isAdmin=?, setor=?, area_responsavel=? WHERE matricula=?";
        $stmtAtualizacao = $mysqli->prepare($queryAtualizacao);
        $stmtAtualizacao->bind_param('sssiisi', $nome, $email, $senha, $isAdminPost, $setor, $area_responsavel, $matricula);

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
    $query = "SELECT matricula, nome, email, senha, isAdmin, setor, area_responsavel FROM usuario WHERE matricula = ?";
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
                Email: <input type='email' name='email' value='{$usuario['email']}' required><br>
                Senha: <input type='password' name='senha' value='{$usuario['senha']}' required><br>";

        // Exibe o campo de seleção para isAdmin
        echo "Admin: 
                <select name='isAdmin'>
                    <option value='1' " . ($usuario['isAdmin'] == 1 ? 'selected' : '') . ">Sim</option>
                    <option value='0' " . ($usuario['isAdmin'] == 0 ? 'selected' : '') . ">Não</option>
                </select><br>";

        // Exibe o campo para setor como select
        echo "Setor: 
                <select name='setor' required>
                    <option value=''>Escolha...</option>";

        $querySetores = "SELECT id_setor, nome_setor FROM setor";
        $resultSetores = $mysqli->query($querySetores);

        while ($rowSetor = $resultSetores->fetch_assoc()) {
            echo "<option value='{$rowSetor['id_setor']}'";
            if ($usuario['setor'] == $rowSetor['id_setor']) {
                echo " selected";
            }
            echo ">{$rowSetor['nome_setor']}</option>";
        }

        echo "</select><br><br>";

        // Exibe o campo de seleção para a área responsável
        echo "Área Responsável: 
                <select name='area_responsavel'>
                    <option value='' " . ($usuario['area_responsavel'] === null ? 'selected' : '') . ">Escolha...</option>";

        $queryAreas = "SELECT id_area, nome_area FROM area_responsavel";
        $resultAreas = $mysqli->query($queryAreas);

        while ($rowArea = $resultAreas->fetch_assoc()) {
            echo "<option value='{$rowArea['id_area']}'";
            if ($usuario['area_responsavel'] == $rowArea['id_area']) {
                echo " selected";
            }
            echo ">{$rowArea['nome_area']}</option>";
        }

        echo "</select><br><br>";

        // Exibe o botão de envio
        echo "<input type='submit' value='";
        echo ($usuario['area_responsavel'] !== null) ? 'Atualizar' : 'Salvar';
        echo "'></form>";

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
