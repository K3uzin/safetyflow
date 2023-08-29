<?php
require '../cadastro/conexao.php';

// Consulta para obter informações sobre o último desvio no Setor "Qualidade"
$sql_ultimo_desvio_qualidade = "SELECT user_nome, data_identificacao, local_desvio FROM tabela_desvio WHERE setor = 5 ORDER BY id_desvio DESC LIMIT 1";
$result_ultimo_desvio_qualidade = $mysqli->query($sql_ultimo_desvio_qualidade);

if ($result_ultimo_desvio_qualidade) {
    $row_ultimo_desvio_qualidade = $result_ultimo_desvio_qualidade->fetch_assoc();
    $ultimo_nome_qualidade = $row_ultimo_desvio_qualidade['user_nome'];
    $ultimo_data_qualidade = $row_ultimo_desvio_qualidade['data_identificacao'];
    $ultimo_local_qualidade = $row_ultimo_desvio_qualidade['local_desvio'];
} else {
    echo "Erro na consulta do último desvio no Setor Qualidade: " . $mysqli->error;
    $ultimo_nome_qualidade = "";
    $ultimo_data_qualidade = "";
    $ultimo_local_qualidade = "";
}

// Consulta para contar os desvios no Setor "Qualidade"
$sql_total_desvios_qualidade = "SELECT COUNT(*) AS total_desvios_qualidade FROM tabela_desvio WHERE setor = 5";
$result_total_desvios_qualidade = $mysqli->query($sql_total_desvios_qualidade);

if ($result_total_desvios_qualidade) {
    $row_total_desvios_qualidade = $result_total_desvios_qualidade->fetch_assoc();
    $total_desvios_qualidade = $row_total_desvios_qualidade['total_desvios_qualidade'];
} else {
    echo "Erro na consulta do total de desvios no Setor Qualidade: " . $mysqli->error;
    $total_desvios_qualidade = 0;
}

$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contador de Desvios - Setor Qualidade</title>
</head>
<body>
    <h2>Contador de Desvios - Setor Qualidade</h2>
    
    <h3>Último Desvio no Setor Qualidade:</h3>
    <p>Nome: <?php echo $ultimo_nome_qualidade; ?></p>
    <p>Data: <?php echo $ultimo_data_qualidade; ?></p>
    <p>Local: <?php echo $ultimo_local_qualidade; ?></p>
    
    <h3>Estatísticas de Desvios:</h3>
    <p>Total de desvios abertos no Setor Qualidade: <?php echo $total_desvios_qualidade; ?></p>
</body>
</html>
