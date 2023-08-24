<?php
require 'cadastro/conexao.php';

// Consulta para obter informações sobre o último desvio no Setor "Cremes"
$sql_ultimo_desvio_cremes = "SELECT user_nome, data_identificacao, local_desvio FROM tabela_desvio WHERE setor = 3 ORDER BY id_desvio DESC LIMIT 1";
$result_ultimo_desvio_cremes = $mysqli->query($sql_ultimo_desvio_cremes);

if ($result_ultimo_desvio_cremes) {
    $row_ultimo_desvio_cremes = $result_ultimo_desvio_cremes->fetch_assoc();
    $ultimo_nome_cremes = $row_ultimo_desvio_cremes['user_nome'];
    $ultimo_data_cremes = $row_ultimo_desvio_cremes['data_identificacao'];
    $ultimo_local_cremes = $row_ultimo_desvio_cremes['local_desvio'];
} else {
    echo "Erro na consulta do último desvio no Setor Cremes: " . $mysqli->error;
    $ultimo_nome_cremes = "";
    $ultimo_data_cremes = "";
    $ultimo_local_cremes = "";
}

// Consulta para contar os desvios no Setor "Cremes"
$sql_total_desvios_cremes = "SELECT COUNT(*) AS total_desvios_cremes FROM tabela_desvio WHERE setor = 3";
$result_total_desvios_cremes = $mysqli->query($sql_total_desvios_cremes);

if ($result_total_desvios_cremes) {
    $row_total_desvios_cremes = $result_total_desvios_cremes->fetch_assoc();
    $total_desvios_cremes = $row_total_desvios_cremes['total_desvios_cremes'];
} else {
    echo "Erro na consulta do total de desvios no Setor Cremes: " . $mysqli->error;
    $total_desvios_cremes = 0;
}

$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contador de Desvios - Setor Cremes</title>
</head>
<body>
    <h2>Contador de Desvios - Setor Cremes</h2>
    
    <h3>Último Desvio no Setor Cremes:</h3>
    <p>Nome: <?php echo $ultimo_nome_cremes; ?></p>
    <p>Data: <?php echo $ultimo_data_cremes; ?></p>
    <p>Local: <?php echo $ultimo_local_cremes; ?></p>
    
    <h3>Estatísticas de Desvios:</h3>
    <p>Total de desvios abertos no Setor Cremes: <?php echo $total_desvios_cremes; ?></p>
</body>
</html>
