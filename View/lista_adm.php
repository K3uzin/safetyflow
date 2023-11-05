<?php
require '../Model/conexao.php'; // Verifique se o caminho está correto
require_once '../Controller/desvio.class.php';

// Consulta para obter todos os desvios no Setor "Administrativo"
/*$sql_desvios_setor_administrativa = "SELECT d.id_desvio, td.descricao AS tipo_desvio, g.descricao AS gravidade, s.nome_setor AS setor 
FROM desvio d
INNER JOIN tipo_desvio td ON d.tipo_desvio_idtipo_desvio = td.idtipo_desvio
INNER JOIN gravidade g ON d.gravidade_idgravidade = g.idgravidade
INNER JOIN setor s ON d.setor_id_setor = s.id_setor
WHERE d.setor_id_setor = 1";*/

$desvio = new desvio;
$turno = null;
$setor = 1;
$tipo_desvio = null;
$gravidade = null;
$data_i = null;
$data_f = null;
$order = 1;
$desvio_data = $desvio->fetch_desvio_by_filter($turno,$setor,$tipo_desvio,$gravidade,$data_i,$data_f,$order,$mysqli);

//$result_desvios_setor_administrativa = $mysqli->query($sql_desvios_setor_administrativa);

/*$desvios_setor_administrativa = [];
if ($result_desvios_setor_administrativa) {
    while ($row_desvio = $result_desvios_setor_administrativa->fetch_assoc()) {
        $desvios_setor_administrativa[] = $row_desvio;
    }
} else {
    echo "Erro na consulta de desvios no Setor Administrativa: " . $mysqli->error;
}*/


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
        <th>status</th>
    </tr>
    <?php foreach ($desvio_data as $desvio) { ?>
    <tr>

        <td><?php echo htmlspecialchars($desvio['id_desvio']); ?></td>
        <td><?php echo htmlspecialchars($desvio['tipo_desvio']); ?></td>
        <td><?php echo htmlspecialchars($desvio['gravidade']); ?></td>
        <td><?php echo htmlspecialchars($desvio['setor']); ?></td>
        
        <?php
            
            $desvio_id = $desvio['id_desvio'];
            $query = "SELECT status from resolucao where id_desvio = $desvio_id";
            $result = $mysqli->query($query);
            
            if ($result->num_rows == 0){
                $status = "sem resolução aberta";
            }
            
            $data = mysqli_fetch_assoc($result);
            $status = $data['status'];

            if ($status == 0 or $status == null){

                $status = "sem resolução aberta";
            }

            if ($status == 1){

                $status = "em analise";
            }

            if ($status == 2){

                $status = "resolução em andamento";
            }

            if ($status == 3){

                $status = "Desvio resolvido";
            }

        ?>

        <td><?php echo htmlspecialchars($status);?></td>
        <td><a href="#" class="ver-detalhes" data-id="<?php echo $desvio['id_desvio']; ?>">Ver Detalhes</a></td>
    </tr>
    
    <?php } $mysqli->close();?>
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
