<?php
require '../Model/conexao.php'; // Verifique se o caminho está correto
require_once '../Controller/desvio.class.php';


$desvio = new desvio;
$turno = null;
$setor = 1;
$tipo_desvio = null;
$gravidade = null;
$data_i = null;
$data_f = null;
$order = 1;
$desvio_data = $desvio->fetch_desvio_by_filter($turno,$setor,$tipo_desvio,$gravidade,$data_i,$data_f,$order,$mysqli);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Desvios - Setor Administrativa</title>
</head>
<body>
    <h2>Lista de Desvios - Setor Administrativa</h2>
    
    <form action="" method="POST">
        <select class="form-select" id="filter" name="filter">
            <option value="0">todos os devio</option>
            <option value="1">somente desvios abertos</option>
        </select>
        <button  type="submit">filtra</button>
    </form>
    <table border="1">
    <tr>
        <th>numero do desvio</th>
        <th>Tipo de Desvio</th>
        <th>Gravidade</th>
        <th>Setor</th>
        <th>data de abertura</th>
        <th>data de resolução</th>
        <th>status</th>
    </tr>
    <?php 
    if (isset($_POST)){
        if ($_POST['filter']  == 0){
            foreach ($desvio_data as $desvio){ 
    ?>
                <tr>
                    
                    <td><?php echo htmlspecialchars($desvio['id_desvio']); ?></td>
                    <td><?php echo htmlspecialchars($desvio['tipo_desvio']); ?></td>
                    <td><?php echo htmlspecialchars($desvio['gravidade']); ?></td>
                    <td><?php echo htmlspecialchars($desvio['setor']); ?></td>
                    <td><?php echo htmlspecialchars($desvio['data_identificacao']);?></td>
                    <td>
                        <?php 
                        $id_desvio = $desvio['id_desvio'];
                        $query = "SELECT data_resolucao from resolucao where id_desvio = $id_desvio";
                        $result = $mysqli->query($query);
                        if ($result->num_rows == 0 ){
                            echo htmlspecialchars('não concluido');
                        }else{
                            
                            $data = mysqli_fetch_assoc($result);
                            if ($data['data_resolucao'] == null){
                                echo htmlspecialchars('não concluido');
                            }else{
                                echo htmlspecialchars ($data['data_resolucao']);
                            }
                        }
                        ?>
                    <td>
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
                
    <?php 
            }
        }
        if ($_POST['filter'] == 1){
            foreach ($desvio_data as $desvio){
                $id_desvio = $desvio['id_desvio'];
                $query = "SELECT * FROM resolucao where id_desvio = $id_desvio";
                $result = $mysqli->query($query);
                $data = mysqli_fetch_assoc($result);
                $status = $data['status'];
                if ($status != 3){
                ?>
                    <tr>
                        
                        <td><?php echo htmlspecialchars($desvio['id_desvio']); ?></td>
                        <td><?php echo htmlspecialchars($desvio['tipo_desvio']); ?></td>
                        <td><?php echo htmlspecialchars($desvio['gravidade']); ?></td>
                        <td><?php echo htmlspecialchars($desvio['setor']); ?></td>
                        <td><?php echo htmlspecialchars($desvio['data_identificacao']);?></td>
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
        <?php
                }
            }
        }
    } $mysqli->close();?>
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
