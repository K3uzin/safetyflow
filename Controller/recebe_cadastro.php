<?php
require '../Model/conexao.php';
require_once 'usuario.class.php';
session_start();

if (!Autenticacao::verificarPermissaoAdmin($mysqli)) {
    echo "Você não tem permissão para cadastrar novos usuários.";
    exit();
}
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $matricula = $_POST['matricula'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $isAdmin = $_POST['isAdmin'];
    $setor = $_POST['setor'];

    // Cria uma instância da classe Usuario
    $novoUsuario = new Usuario();

    // Chama o método setUsuario para cadastrar o usuário
    $novoUsuario->set_usuario($nome, $matricula, $email, $senha, $isAdmin, $setor, $mysqli);

    // Fecha a conexão com o banco de dados
    $mysqli->close();
    header("Location: ../cadastrar_usuario.php"); // Redireciona para a página de sucesso após o cadastro
    exit(); // Encerra o script
}
?>

