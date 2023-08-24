<?php
require 'cadastro/conexao.php';

// Consulta para obter informações sobre o último desvio no Setor "Estojo"
$sql_ultimo_desvio_estojo = "SELECT user_nome, data_identificacao, local_desvio FROM tabela_desvio WHERE setor = 4 ORDER BY id_desvio DESC LIMIT 1";
$result_ultimo_desvio_estojo = $mysqli->query($sql_ultimo_desvio_estojo);

if ($result_ultimo_desvio_estojo) {
    $row_ultimo_desvio_estojo = $result_ultimo_desvio_estojo->fetch_assoc();
    $ultimo_nome_estojo = $row_ultimo_desvio_estojo['user_nome'];
    $ultimo_data_estojo = $row_ultimo_desvio_estojo['data_identificacao'];
    $ultimo_local_estojo = $row_ultimo_desvio_estojo['local_desvio'];
} else {
    echo "Erro na consulta do último desvio no Setor Estojo: " . $mysqli->error;
    $ultimo_nome_estojo = "";
    $ultimo_data_estojo = "";
    $ultimo_local_estojo = "";
}

// Consulta para contar os desvios no Setor "Estojo"
$sql_total_desvios_estojo = "SELECT COUNT(*) AS total_desvios_estojo FROM tabela_desvio WHERE setor = 4";
$result_total_desvios_estojo = $mysqli->query($sql_total_desvios_estojo);

if ($result_total_desvios_estojo) {
    $row_total_desvios_estojo = $result_total_desvios_estojo->fetch_assoc();
    $total_desvios_estojo = $row_total_desvios_estojo['total_desvios_estojo'];
} else {
    echo "Erro na consulta do total de desvios no Setor Estojo: " . $mysqli->error;
    $total_desvios_estojo = 0;
}

$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contador de Desvios - Setor Estojo</title>
</head>
<body>
    <h2>Contador de Desvios - Setor Estojo</h2>
    
    <h3>Último Desvio no Setor Estojo:</h3>
    <p>Nome: <?php echo $ultimo_nome_estojo; ?></p>
    <p>Data: <?php echo $ultimo_data_estojo; ?></p>
    <p>Local: <?php echo $ultimo_local_estojo; ?></p>
    
    <h3>Estatísticas de Desvios:</h3>
    <p>Total de desvios abertos no Setor Estojo: <?php echo $total_desvios_estojo; ?></p>
</body>
</html>
