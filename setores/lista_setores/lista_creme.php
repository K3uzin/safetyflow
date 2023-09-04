<?php
require '../../cadastro/conexao.php'; // Verifique se o caminho está correto

// Consulta para obter todos os desvios no Setor "Cremes"
$sql_desvios_setor_cremes = "SELECT id_desvio, tipo_desvio, gravidade, setor FROM desvios WHERE setor = 3"; // Aqui usei o ID do setor Cremes (3) para a consulta
$result_desvios_setor_cremes = $mysqli->query($sql_desvios_setor_cremes);

$desvios_setor_cremes = [];
if ($result_desvios_setor_cremes) {
    while ($row_desvio = $result_desvios_setor_cremes->fetch_assoc()) {
        $desvios_setor_cremes[] = $row_desvio;
    }
} else {
    echo "Erro na consulta de desvios no Setor Cremes: " . $mysqli->error;
}

$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Desvios - Setor Cremes</title>
</head>
<body>
    <h2>Lista de Desvios - Setor Cremes</h2>
    
    <table border="1">
    <tr>
        <th>ID Desvio</th>
        <th>Tipo de Desvio</th>
        <th>Gravidade</th>
        <th>Setor</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($desvios_setor_cremes as $desvio) { ?>
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
