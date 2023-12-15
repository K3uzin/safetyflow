<?php
require '../Model/conexao.php'; // Verifique se o caminho está correto

require_once '../Controller/desvio.class.php';


$desvio = new desvio;
// Consulta para obter informações sobre o último desvio no Setor "Administrativa"
$desvio->fetch_last_desvio_setor(1,$mysqli);
$ultimo_matricula = $desvio->get_usuario_matricula();
$ultimo_data = $desvio->get_data_identificacao();
$ultimo_local  = $desvio->get_local();
$sql_nome_usuario = "SELECT nome FROM usuario WHERE matricula = $ultimo_matricula";

//consulta o nome
$result_nome_usuario = $mysqli->query($sql_nome_usuario);
$row_nome_usuario = $result_nome_usuario->fetch_assoc();
$ultimo_nome_administrativa = $row_nome_usuario['nome'];
// Consulta para contar os desvios no Setor "Administrativa"
$total_desvios_administrativa = $desvio->count_desvio_from_setor(1,$mysqli);
;

$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contador de Desvios - Setor Administrativa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/Css/areas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <img class="logo" src="../Public/Img/logo.png" alt="Logo do aplicativo">
       
        <h1>Contador de Desvios</h1>
       
        <h2>Setor Administrativo</h2>
       
        <div class="section-title">
            <h3>Informações do Último Desvio:</h3>
        </div>
        <div class="card">
            <div class="card-body">
                <p class="card-text"><strong>Nome:</strong> <span id="ultimo-nome"></span></p>
                <p class="card-text"><strong>Data:</strong> <span id="ultimo-data"></span></p>
                <p class="card-text"><strong>Local:</strong> <span id="ultimo-local"></span></p>
            </div>
        </div>
       
        <div class="section-title">
            <h3>Estatísticas de Desvios:</h3>
        </div>
        <div class="card">
            <div class="card-body">
                <p class="card-text"><strong>Total de desvios abertos:</strong> <span id="total-desvios"></span></p>
            </div>
        </div>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
