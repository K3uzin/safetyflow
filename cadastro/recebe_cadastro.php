<?php
require 'conexao.php'; // Verifique se o caminho está correto

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $setor = $_POST["setor"];

    // Realize as validações necessárias aqui

    // Inserção dos dados na tabela Cadastro
    $sql = "INSERT INTO cadastro (nome, email, senha, setor_id) VALUES ('$nome', '$email', '$senha', '$setor')";

    if ($mysqli->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $mysqli->error;
    }

    // Fechamento da conexão com o banco de dados
    $mysqli->close();
} else {
    echo "O formulário não foi submetido corretamente.";
}
?>
