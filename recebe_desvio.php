<?php
require 'cadastro/conexao.php'; // Verifique se o caminho está correto

session_start();

if (!isset($_SESSION["user_matricula"])) {
    // Se o usuário não estiver logado, redirecione para a página de login
    header("Location: login.php");
    exit();
}

$user_matricula = $_SESSION["user_matricula"];

// Consulta para obter o nome do usuário com base na matrícula
$sql_nome = "SELECT nome FROM cadastro WHERE matricula = ?";
$stmt_nome = $mysqli->prepare($sql_nome);

if ($stmt_nome) {
    $stmt_nome->bind_param("s", $user_matricula);
    $stmt_nome->execute();
    $stmt_nome->bind_result($nome_usuario);

    // Armazene o nome em uma variável para exibição posterior
    $stmt_nome->fetch();
    $stmt_nome->close();
} else {
    echo "Erro na preparação do statement: " . $mysqli->error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data_identificacao = $_POST["data_identificacao"];
    $turno = $_POST["turno"];
    $setor = $_POST["setor"];
    $local_desvio = $_POST["local_desvio"];
    $descricao_desvio = $_POST["descricao_desvio"];
    $tipo_desvio = $_POST["tipo_desvio"];
    $gravidade = $_POST["gravidade"];
    $observacoes = $_POST["observacoes"];

    // Realize as validações necessárias aqui

    // Inserção dos dados na tabela de Desvio, associando à matrícula do usuário
    $sql = "INSERT INTO tabela_desvio (user_matricula, user_nome, data_identificacao, turno, setor, local_desvio, descricao_desvio, tipo_desvio, gravidade, observacoes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssssssss", $user_matricula, $nome_usuario, $data_identificacao, $turno, $setor, $local_desvio, $descricao_desvio, $tipo_desvio, $gravidade, $observacoes);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Cadastro de desvio realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar desvio.";
        }

        $stmt->close();
    } else {
        echo "Erro na preparação do statement: " . $mysqli->error;
    }

    // Fechamento da conexão com o banco de dados
    $mysqli->close();
} else {
    echo "O formulário não foi submetido corretamente.";
}

?>
