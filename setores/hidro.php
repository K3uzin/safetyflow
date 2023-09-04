<?php
require '../cadastro/conexao.php';

// Consulta para obter informações sobre o último desvio no Setor "Hidro"
$sql_ultimo_desvio_hidro = "SELECT user_nome, data_identificacao, local_desvio FROM desvios WHERE setor = 2 ORDER BY id_desvio DESC LIMIT 1";
$result_ultimo_desvio_hidro = $mysqli->query($sql_ultimo_desvio_hidro);

if ($result_ultimo_desvio_hidro) {
    $row_ultimo_desvio_hidro = $result_ultimo_desvio_hidro->fetch_assoc();
    $ultimo_nome_hidro = $row_ultimo_desvio_hidro['user_nome'];
    $ultimo_data_hidro = $row_ultimo_desvio_hidro['data_identificacao'];
    $ultimo_local_hidro = $row_ultimo_desvio_hidro['local_desvio'];
} else {
    echo "Erro na consulta do último desvio no Setor Hidro: " . $mysqli->error;
    $ultimo_nome_hidro = "";
    $ultimo_data_hidro = "";
    $ultimo_local_hidro = "";
}

// Consulta para contar os desvios no Setor "Hidro"
$sql_total_desvios_hidro = "SELECT COUNT(*) AS total_desvios_hidro FROM desvios WHERE setor = 2";
$result_total_desvios_hidro = $mysqli->query($sql_total_desvios_hidro);

if ($result_total_desvios_hidro) {
    $row_total_desvios_hidro = $result_total_desvios_hidro->fetch_assoc();
    $total_desvios_hidro = $row_total_desvios_hidro['total_desvios_hidro'];
} else {
    echo "Erro na consulta do total de desvios no Setor Hidro: " . $mysqli->error;
    $total_desvios_hidro = 0;
}

$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contador de Desvios - Setor Hidro</title>
</head>
<body>
    <h2>Contador de Desvios - Setor Hidro</h2>
    
    <h3>Último Desvio no Setor Hidro:</h3>
    <p>Nome: <?php echo $ultimo_nome_hidro; ?></p>
    <p>Data: <?php echo $ultimo_data_hidro; ?></p>
    <p>Local: <?php echo $ultimo_local_hidro; ?></p>
    
    <h3>Estatísticas de Desvios:</h3>
    <p>Total de desvios abertos no Setor Hidro: <?php echo $total_desvios_hidro; ?></p>
</body>
</html>
