<?php
require '../Model/conexao.php'; // Verifique se o caminho está correto

// Consulta para obter todos os desvios no Setor "Administrativa"
$sql_desvios_setor_administrativa = "SELECT id_desvio, tipo_desvio, gravidade, setor FROM desvios WHERE setor = 1"; // Aqui usei o ID do setor Administrativa (1) para a consulta
$result_desvios_setor_administrativa = $mysqli->query($sql_desvios_setor_administrativa);

$desvios_setor_administrativa = [];
if ($result_desvios_setor_administrativa) {
    while ($row_desvio = $result_desvios_setor_administrativa->fetch_assoc()) {
        $desvios_setor_administrativa[] = $row_desvio;
    }
} else {
    echo "Erro na consulta de desvios no Setor Administrativa: " . $mysqli->error;
}

$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Desvios - Setor Administrativa</title>
</head>
<body>
    <h2>Lista de Desvios - Setor Administrativa</h2>
    
    <table border="1">
    <tr>
        <th>ID Desvio</th>
        <th>Tipo de Desvio</th>
        <th>Gravidade</th>
        <th>Setor</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($desvios_setor_administrativa as $desvio) { ?>
    <tr>
        <td><?php echo $desvio['id_desvio']; ?></td>
        <td><?php echo $desvio['tipo_desvio']; ?></td>
        <td><?php echo $desvio['gravidade']; ?></td>
        <td><?php echo $desvio['setor']; ?></td>
        <td><a href="#" class="ver-detalhes" data-id="<?php echo $desvio['id_desvio']; ?>">Ver Detalhes</a></td>
    </tr>
    <?php } ?>
</table>

<div id="detalhes-desvio"></div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const detalhesDesvioDiv = document.getElementById("detalhes-desvio");
    const linksVerDetalhes = document.querySelectorAll(".ver-detalhes");

    linksVerDetalhes.forEach(link => {
        link.addEventListener("click", function(event) {
            event.preventDefault();
            
            const idDesvio = this.getAttribute("data-id");
            carregarDetalhesDesvio(idDesvio);
        });
    });

    function carregarDetalhesDesvio(idDesvio) {
        detalhesDesvioDiv.innerHTML = "Carregando detalhes do desvio...";
        
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `detalhes_desvio.php?id_desvio=${idDesvio}`, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                detalhesDesvioDiv.innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
});
</script>
</body>
</html>
