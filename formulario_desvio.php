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
    $stmt_nome->bind_result($nome);

    // Armazene o nome em uma variável para exibição posterior
    $stmt_nome->fetch();
    $stmt_nome->close();
} else {
    echo "Erro na preparação do statement: " . $mysqli->error;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formulário de Desvio</title>
</head>
<body>
    <h2>Formulário de Desvio</h2>
    <form action="recebe_desvio.php" method="post" enctype="multipart/form-data">

        <label for="data_identificacao">Data que o desvio foi identificado:</label>
        <input type="date" id="data_identificacao" name="data_identificacao"><br><br>

        <label>Turno que o desvio foi identificado:</label><br>
        <input type="radio" id="turno_manha" name="turno" value="Manhã">
        <label for="turno_manha">Manhã</label><br>
        <input type="radio" id="turno_tarde" name="turno" value="Tarde">
        <label for="turno_tarde">Tarde</label><br>
        <input type="radio" id="turno_noite" name="turno" value="Noite">
        <label for="turno_noite">Noite</label><br><br>

        <label for="setor_desvio">Setor em que o desvio foi identificado</label><br>
        <select id="setor" name="setor" required>
            <option value="1">Administrativa</option>
            <option value="2">Hidro</option>
            <option value="3">Cremes</option>
            <option value="4">Estojo</option>
            <option value="5">Qualidade</option>
            <option value="6">Logística</option>
            <!-- adiciona setores -->
        </select><br><br>

        <label for="local_desvio">Local exato onde o Desvio foi identificado:</label>
        <input type="text" id="local_desvio" name="local_desvio"><br><br>

        <label for="descricao_desvio">Descrição do Desvio:</label>
        <textarea id="descricao_desvio" name="descricao_desvio" rows="4"></textarea><br><br>

        <label for="tipo_desvio">Tipo de Desvio:</label>
        <input type="text" id="tipo_desvio" name="tipo_desvio"><br><br>

        <label for="gravidade">Potencial de Gravidade:</label><br>
        <input type="radio" id="leve" name="gravidade" value="Leve">
        <label for="leve">Leve</label><br>
        <input type="radio" id="moderado" name="gravidade" value="Moderado">
        <label for="moderado">Moderado</label><br>
        <input type="radio" id="grave" name="gravidade" value="Grave">
        <label for="grave">Grave</label><br>
        <input type="radio" id="gravissimo" name="gravidade" value="Gravíssimo">
        <label for="gravissimo">Gravíssimo</label><br><br>


        <label for="area_responsavel">Informe área responsável pela solução:</label>
        <select id="setor" name="setor" required>
            <option value="1">Administrativa</option>
            <option value="2">Hidro</option>
            <option value="3">Cremes</option>
            <option value="4">Estojo</option>
            <option value="5">Qualidade</option>
            <option value="6">Logística</option>
        <label for="observacoes">Observações (opcional):</label>
        <textarea id="observacoes" name="observacoes" rows="4"></textarea><br><br>

        <label for="foto_desvio">Insira uma foto do local do desvio, caso necessário:</label>
        <input type="file" id="foto_desvio" name="foto_desvio"><br><br>

        <input type="submit" value="Enviar">
    </form>
</body>
,





,
