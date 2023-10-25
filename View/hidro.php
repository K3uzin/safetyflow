<?php
require '../Model/conexao.php'; // Verifique se o caminho está correto

require_once '../Controller/desvio.class.php';


$desvio = new desvio;
// Consulta para obter informações sobre o último desvio no Setor "Qualidade"
$desvio->fetch_last_desvio_setor(2,$mysqli);
$ultimo_matricula = $desvio->get_usuario_matricula();
$ultimo_data = $desvio->get_data_identificacao();
$ultimo_local  = $desvio->get_local();
$sql_nome_usuario = "SELECT nome FROM usuario WHERE matricula = $ultimo_matricula";

//consulta o nome
$result_nome_usuario = $mysqli->query($sql_nome_usuario);
$row_nome_usuario = $result_nome_usuario->fetch_assoc();
$ultimo_nome_qualidade = $row_nome_usuario['nome'];
// Consulta para contar os desvios no Setor "Qualidade"
$total_desvios_qualidade = $desvio->count_desvio_from_setor(2,$mysqli);

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
    <p>Data: <?php echo $ultimo_data; ?></p>
    <p>Local: <?php echo $ultimo_local; ?></p>
    
    <h3>Estatísticas de Desvios:</h3>
    <p>Total de desvios abertos no Setor Hidro: <?php echo $total_desvios_hidro; ?></p>
</body>
</html>
