<?php
require '../Model/conexao.php';
require_once '../controller/desvio.class.php';
// Parâmetros de filtragem
/*$orderBy = isset($_GET['order']) ? $_GET['order'] : 'data_identificacao';


// Função que filtra os desvios
function getDesvios($orderBy, $page, $gravidade, $dataInicial, $dataFinal, $setor) {
    global $mysqli, $perPage;

    // Define a ordenação ascendente ou descendente com base na coluna escolhida
    $orderDirection = ($orderBy == 'data_identificacao' || $orderBy == 'gravidade' || $orderBy == 'setor') ? 'ASC' : 'DESC';

    // Calcula o deslocamento (offset) com base na página atual
    $offset = ($page - 1) * $perPage;

    $sql = "SELECT d.id_desvio, d.data_identificacao, td.descricao AS tipo_desvio, g.descricao AS gravidade, s.nome_setor AS setor
            FROM desvio d
            INNER JOIN tipo_desvio td ON d.tipo_desvio_idtipo_desvio = td.idtipo_desvio
            INNER JOIN gravidade g ON d.gravidade_idgravidade = g.idgravidade
            INNER JOIN setor s ON d.setor_id_setor = s.id_setor
            WHERE 1=1";

    if (!empty($gravidade)) {
        $sql .= " AND d.gravidade_idgravidade = " . intval($gravidade);
    }

    if (!empty($dataInicial) && !empty($dataFinal)) {
        $sql .= " AND d.data_identificacao BETWEEN '" . $dataInicial . "' AND '" . $dataFinal . "'";
    }

    if (!empty($setor)) {
        $sql .= " AND d.setor_id_setor = " . intval($setor);
    }

    $sql .= " ORDER BY $orderBy $orderDirection LIMIT $offset, $perPage";

    $result = $mysqli->query($sql);
    $desvios = [];

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $desvios[] = $row;
        }
    } else {
        echo "Erro na consulta de desvios abertos: " . $mysqli->error;
    }

    return $desvios;
}


// Parâmetros de filtro
$gravidadeFilter = isset($_POST['gravidade']) ? $_POST['gravidade'] : "";
$dataInicialFilter = isset($_POST['data_inicial']) ? $_POST['data_inicial'] : "";
$dataFinalFilter = isset($_POST['data_final']) ? $_POST['data_final'] : "";
$setorFilter = isset($_POST['setor']) ? $_POST['setor'] : "";

$desvios_abertos = getDesvios($orderBy, $page, $gravidadeFilter, $dataInicialFilter, $dataFinalFilter, $setorFilter);

// Consulta para contar o número total de desvios abertos
$sql_count_desvios = "SELECT COUNT(*) AS total_desvios FROM desvio";
$result_count_desvios = $mysqli->query($sql_count_desvios);
$row_count_desvios = $result_count_desvios->fetch_assoc();
$total_desvios = $row_count_desvios['total_desvios'];

$mysqli->close();
*/
$desvio = new desvio;
$turno = null;
$setor = null;
$tipo_desvio = null;
$gravidade = null;
$data_i = null;
$data_f = null;
$order = null;

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['setor'])) {
        $setor = (int)$_POST['setor'];
        if ($setor === 0 || $_POST['setor'] === "") {
            $setor = null;
        }
    }
    if( isset($_POST['gravidade'])){
        $gravidade = (int)$_POST['gravidade'];
        if ($gravidade === 0 || $gravidade === ""){
            $gravidade = null;
        }
    }
    if( isset($_POST['data_inicial'])){
        $data_i = $_POST['data_inicial'];
        if($data_i == ""){
            $data_i = null;
        }
    }
    if( isset($_POST['data_final'])){
        $data_f = $_POST["data_final"];
        if($data_f == ""){
            $data_f = null;
        }
    }
    if( isset($_POST['order'])){
        $order = (int)$_POST['order'];  
    }
    
    echo "data final: ".var_dump($data_f)."<br>";
    echo "data inicial: ".var_dump($data_i)."<br>";
    echo "gravidade: ".var_dump($gravidade)."<br>";
    echo "setor: ".var_dump($setor)."<br>";
    
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Lista de Desvios Abertos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Public/Css/totaldesvios.css">
    <script>
        /*function filterAndSort() {
            var orderBy = document.getElementById("orderSelect").value;
            getDesvios(orderBy, 1);
        }
        
        function getDesvios(orderBy, page) {
            var xhr = new XMLHttpRequest();
            var url = "lista_desvios.php?order=" + orderBy + "&page=" + page;
            
            // Adicione a ordenação ascendente (ASC) para as colunas selecionadas
            if (orderBy === "data_identificacao" || orderBy === "gravidade" || orderBy === "setor") {
                url += "&sort=ASC";
            }
            
            xhr.open('GET', url, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    document.querySelector('table tbody').innerHTML = response;
                } else {
                    console.error('Erro na solicitação AJAX');
                }
            };
            xhr.send();
        }*/

        //window.onload = function() {
         //   filterAndSort();
        //};
    </script>
*/
</head>
<body>
    <h2>Lista de Desvios Abertos</h2>

    <!-- Filtrar por -->
    <form method="post">
    <label>Filtrar por:</label>
    <select name="gravidade" id="gravidade">
        <option value="">Todas as Gravidades</option>
        <option value="1">Leve</option>
        <option value="2">Moderado</option>
        <option value="3">Grave</option>
        <option value="4">Gravíssimo</option>
    </select>

    <label>Data Inicial:</label>
    <input type="date" name="data_inicial" id="data_inicial" placeholder="Data Inicial">

    <label>Data Final:</label>
    <input type="date" name="data_final" id="data_final" placeholder="Data Final">

        <select name="setor" id="setor">
            <option value="">Todos os Setores</option>
            <option value="1">Administrativo</option>
            <option value="2">Hidro</option>
            <option value="3">Cremes</option>
            <option value="4">Estojo</option>
            <option value="5">Qualidade</option>
            <option value="6">Logística</option>
           
        </select>

        <button type="submit">Filtrar</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>ID Desvio</th>
                <th>Data de Identificação</th>
                <th>Tipo de Desvio</th>
                <th>Gravidade</th>
                <th>Setor</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $desvio_data = $desvio->fetch_desvio_by_filter($turno,$setor,$tipo_desvio,$gravidade,$data_i,$data_f,$order,$mysqli);
            //var_dump($desvio_data);
             foreach ($desvio_data as $data)    
            {?>
            <tr>
                <td><?php echo $data['id_desvio']; ?></td>
                <?php 
                    $data_Am = $data['data_identificacao'];
                    $datetime = new DateTime($data_Am);
                    $data_Br = $datetime->format('d/m/Y');

                ?>
                <td><?php echo $data_Br; ?></td>
                <td><?php echo $data['tipo_desvio']; ?></td>
                <td><?php echo $data['gravidade']; ?></td>
                <td><?php echo $data['setor']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <script>
    var dataCells = document.querySelectorAll(".data-formatada");

    dataCells.forEach(function(cell) {
        var oldDate = cell.textContent;
        var dateParts = oldDate.split("-");
        var formattedDate = dateParts[2] + "/" + dateParts[1] + "/" + dateParts[0].slice(-2);
        cell.textContent = formattedDate;
    });
</script>
</body>
</html>
