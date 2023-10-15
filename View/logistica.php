<?php
require '../Model/conexao.php'; // Verifique se o caminho está correto

// Consulta para obter informações sobre o último desvio no Setor "Logística"
$sql_ultimo_desvio = "SELECT usuario_matricula, data_identificacao, local_desvio FROM desvio WHERE setor_id_setor = 6 ORDER BY id_desvio DESC LIMIT 1";
$result_ultimo_desvio = $mysqli->query($sql_ultimo_desvio);

if ($result_ultimo_desvio) {
    $row_ultimo_desvio = $result_ultimo_desvio->fetch_assoc();
    $ultimo_matricula = $row_ultimo_desvio['usuario_matricula'];
    $ultimo_data = $row_ultimo_desvio['data_identificacao'];
    $ultimo_local = $row_ultimo_desvio['local_desvio'];

    // Consulta para obter o nome do usuário do último desvio
    $sql_nome_usuario = "SELECT nome FROM usuario WHERE matricula = $ultimo_matricula";
    $result_nome_usuario = $mysqli->query($sql_nome_usuario);

    if ($result_nome_usuario && $result_nome_usuario->num_rows > 0) {
        $row_nome_usuario = $result_nome_usuario->fetch_assoc();
        $ultimo_nome_logistica = $row_nome_usuario['nome'];
    } else {
        $ultimo_nome_logistica = "";
    }
} else {
    echo "Erro na consulta do último desvio: " . $mysqli->error;
    $ultimo_nome_logistica = "";
    $ultimo_data_logistica = "";
    $ultimo_local_logistica = "";
}

// Consulta para contar os desvios no Setor "Logística"
$sql_total_desvios = "SELECT COUNT(*) AS total_desvios FROM desvio WHERE setor_id_setor = 6";
$result_total_desvios = $mysqli->query($sql_total_desvios);

if ($result_total_desvios) {
    $row_total_desvios = $result_total_desvios->fetch_assoc();
    $total_desvios_logistica = $row_total_desvios['total_desvios'];
} else {
    echo "Erro na consulta do total de desvios: " . $mysqli->error;
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
    <p>Data: <?php echo $ultimo_data; ?></p>
    <p>Local: <?php echo $ultimo_local; ?></p>
    
    <h3>Estatísticas de Desvios:</h3>
    <p>Total de desvios abertos no Setor Logística: <?php echo $total_desvios_logistica; ?></p>
</body>
</html>
