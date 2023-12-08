<?php
require '../Model/conexao.php';
require_once 'autenticacao.class.php';
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

    // Verifica se a variável $_POST['area_responsavel'] está definida antes de usá-la
    $area_responsavel = isset($_POST['area_responsavel']) ? $_POST['area_responsavel'] : null;

    // Cria uma instância da classe Usuario
    $novoUsuario = new Usuario();

    // Chama o método setUsuario para cadastrar o usuário
    $novoUsuario->set_usuario($nome, $matricula, $email, $senha, $isAdmin, $setor, $area_responsavel, $mysqli);

    // Fecha a conexão com o banco de dados
    $mysqli->close();
    header("Location: ../view/cadastrar_usuario.php"); // Redireciona para a página de sucesso após o cadastro
    exit(); // Encerra o script
}
?>

