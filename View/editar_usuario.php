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
        $status = $_POST['status'];

        // Verifica se a opção "não especificada" foi selecionada
        if ($area_responsavel === '') {
            // Se "não especificada" foi selecionada, define isAdminPost para 0
            $isAdminPost = 0;
        }

        // Verifica se a área já está atribuída a outro usuário apenas se o usuário for admin
        if ($isAdminPost == 1 && $area_responsavel !== null) {
            // Evita verificar a área se o valor for 0 (Não especificado)
            if ($area_responsavel != 0) {
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
        }

        // Atualiza as informações no banco de dados
        $queryAtualizacao = "UPDATE usuario SET nome=?, email=?, senha=?, isAdmin=?, setor=?, area_responsavel=?, status=? WHERE matricula=?";
        $stmtAtualizacao = $mysqli->prepare($queryAtualizacao);
        $stmtAtualizacao->bind_param('sssiisss', $nome, $email, $senha, $isAdminPost, $setor, $area_responsavel, $status, $matricula);
        

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
    $query = "SELECT matricula, nome, email, senha, isAdmin, setor, area_responsavel, status FROM usuario WHERE matricula = ?";
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

        // Exibe o campo para setor
        echo "Setor: 
                <select name='setor'>
                    <option value='1' " . ($usuario['setor'] == 1 ? 'selected' : '') . ">Administrativa</option>
                    <option value='2' " . ($usuario['setor'] == 2 ? 'selected' : '') . ">Hidro</option>
                    <option value='3' " . ($usuario['setor'] == 3 ? 'selected' : '') . ">Cremes</option>
                    <option value='4' " . ($usuario['setor'] == 4 ? 'selected' : '') . ">Estojo</option>
                    <option value='5' " . ($usuario['setor'] == 5 ? 'selected' : '') . ">Qualidade</option>
                    <option value='6' " . ($usuario['setor'] == 6 ? 'selected' : '') . ">Logística</option>
                </select><br>";

        // Exibe o campo de seleção para status
        echo "Status: 
                <select name='status'>
                    <option value='ativo' " . ($usuario['status'] == 'ativo' ? 'selected' : '') . ">Ativo</option>
                    <option value='inativo' " . ($usuario['status'] == 'inativo' ? 'selected' : '') . ">Inativo</option>
                </select><br>";

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
