<?php
require '../Model/conexao.php';
require_once '../controller/autenticacao.class.php';
require_once '../controller/usuario.class.php';

session_start();

// Verifica se o usuário logado é administrador
if (!Autenticacao::verificarPermissaoAdmin($mysqli)) {
    echo "Você não tem permissão para excluir usuários.";
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtem a matrícula do usuário a ser excluído
    $matricula = $_POST['matriculaExcluir'];

    // Realiza a exclusão do usuário
    $query = "DELETE FROM usuario WHERE matricula = $matricula";
    if ($mysqli->query($query)) {
        echo "Usuário excluído com sucesso.";
    } else {
        echo "Erro ao excluir usuário: " . $mysqli->error;
    }
} else {
    echo "Acesso inválido.";
}
?>
