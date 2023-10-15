<?php
require '../Model/conexao.php'; // Verifique se o caminho está correto

// Consulta para obter todos os desvios no Setor "Hidro"
$sql_desvios_setor_hidro = "SELECT d.id_desvio, td.descricao AS tipo_desvio, g.descricao AS gravidade, s.nome_setor AS setor 
FROM desvio d
INNER JOIN tipo_desvio td ON d.tipo_desvio_idtipo_desvio = td.idtipo_desvio
INNER JOIN gravidade g ON d.gravidade_idgravidade = g.idgravidade
INNER JOIN setor s ON d.setor_id_setor = s.id_setor
WHERE d.setor_id_setor = 2";

$result_desvios_setor_hidro = $mysqli->query($sql_desvios_setor_hidro);

$desvios_setor_hidro = [];
if ($result_desvios_setor_hidro) {
    while ($row_desvio = $result_desvios_setor_hidro->fetch_assoc()) {
        $desvios_setor_hidro[] = $row_desvio;
    }
} else {
    echo "Erro na consulta de desvios no Setor Hidro: " . $mysqli->error;
}

$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Desvios - Setor Hidro</title>
</head>
<body>
    <h2>Lista de Desvios - Setor Hidro</h2>
    
    <table border="1">
    <tr>
        <th>ID Desvio</th>
        <th>Tipo de Desvio</th>
        <th>Gravidade</th>
        <th>Setor</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($desvios_setor_hidro as $desvio) { ?>
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
