<?php
require '../Model/conexao.php';
require_once '../controller/autenticacao.class.php';
require_once '../controller/usuario.class.php';

session_start();

// Verifica se o usuário logado é administrador
if (!Autenticacao::verificarPermissaoAdmin($mysqli)) {
    echo "Você não tem permissão para editar usuários.";
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtem a matrícula do usuário a ser editado
    $matricula = $_POST['matricula'];

    // Realiza a consulta para obter os detalhes do usuário
    $query = "SELECT * FROM usuario WHERE matricula = $matricula";
    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        // Exiba o formulário de edição preenchido com os detalhes atuais do usuário
        // Implemente o formulário conforme necessário
        echo "<form method='post' action='atualizar_usuario.php'>
                <!-- Campos do formulário -->
                <input type='hidden' name='matricula' value='{$usuario['matricula']}' />
                <input type='text' name='nome' value='{$usuario['nome']}' />
                <input type='email' name='email' value='{$usuario['email']}' />
                <input type='submit' value='Atualizar' />
              </form>";
    } else {
        echo "Usuário não encontrado.";
    }
} else {
    echo "Acesso inválido.";
}
?>
