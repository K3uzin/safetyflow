<?php
require '../Model/conexao.php';

// Consulta para obter informações sobre o último desvio no Setor "Logística"
$sql_ultimo_desvio_logistica = "SELECT user_nome, data_identificacao, local_desvio FROM desvios WHERE setor = 6 ORDER BY id_desvio DESC LIMIT 1";
$result_ultimo_desvio_logistica = $mysqli->query($sql_ultimo_desvio_logistica);

if ($result_ultimo_desvio_logistica) {
    $row_ultimo_desvio_logistica = $result_ultimo_desvio_logistica->fetch_assoc();
    $ultimo_nome_logistica = $row_ultimo_desvio_logistica['user_nome'];
    $ultimo_data_logistica = $row_ultimo_desvio_logistica['data_identificacao'];
    $ultimo_local_logistica = $row_ultimo_desvio_logistica['local_desvio'];
} else {
    echo "Erro na consulta do último desvio no Setor Logística: " . $mysqli->error;
    $ultimo_nome_logistica = "";
    $ultimo_data_logistica = "";
    $ultimo_local_logistica = "";
}

// Consulta para contar os desvios no Setor "Logística"
$sql_total_desvios_logistica = "SELECT COUNT(*) AS total_desvios_logistica FROM desvios WHERE setor = 6";
$result_total_desvios_logistica = $mysqli->query($sql_total_desvios_logistica);

if ($result_total_desvios_logistica) {
    $row_total_desvios_logistica = $result_total_desvios_logistica->fetch_assoc();
    $total_desvios_logistica = $row_total_desvios_logistica['total_desvios_logistica'];
} else {
    echo "Erro na consulta do total de desvios no Setor Logística: " . $mysqli->error;
    $total_desvios_logistica = 0;
}

$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contador de Desvios - Setor Logística</title>
</head>
<body>
    <h2>Contador de Desvios - Setor Logística</h2>
    
    <h3>Último Desvio no Setor Logística:</h3>
    <p>Nome: <?php echo $ultimo_nome_logistica; ?></p>
    <p>Data: <?php echo $ultimo_data_logistica; ?></p>
    <p>Local: <?php echo $ultimo_local_logistica; ?></p>
    
    <h3>Estatísticas de Desvios:</h3>
    <p>Total de desvios abertos no Setor Logística: <?php echo $total_desvios_logistica; ?></p>
</body>
</html>
