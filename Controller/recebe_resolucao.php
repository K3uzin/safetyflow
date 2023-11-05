<?php
session_start();

require_once '../model/conexao.php';
require_once 'desvio.class.php';
require_once 'resolucao.class.php';

$desvio_id = $_SESSION['desvio_selecionado'];
$usuario_id = $_SESSION['user_matricula'];


if (isset($_POST)){

    
    $status = $_POST['status_resolucao'];

    $tipo_desvio = $_POST['tipo_desvio'];
    if ($tipo_desvio == 0){
        
        $query = "SELECT tipo_desvio from desvio where id_desvio = $desvio_id";
        $result = $mysqli->query($query);
        
        if($result->num_rows == 0){
            exit('não a tipo desvio');

        }else{

            $data = mysqli_fetch_assoc($result);
            $tipo_desvio = $data['tipo_desvio'];
        }
    }

    $gravidade = $_POST['gravidade'];
    if ($gravidade == 0){
        
        $query = "SELECT gravidade from desvio where id_desvio = $desvio_id";
        $result = $mysqli->query($query);
        
        if($result->num_rows == 0){
            exit('não a gravidade');

        }else{

            $data = mysqli_fetch_assoc($result);
            $gravidade = $data['gravidade'];
        }
    }

    $area_responsavel = $_POST['area_responsavel'];
    if ($area_responsavel == 0){
        
        $query = "SELECT area_responsavel from desvio where id_desvio = $desvio_id";
        $result = $mysqli->query($query);
        
        if($result->num_rows == 0){
            exit('area respnsavel inexistente');

        }else{

            $data = mysqli_fetch_assoc($result);
            $area_responsavel = $data['area_responsavel'];
        }
    }
    if ($status == 3){

        $data_resolucao = '2023-11-03';
    }else{
        $data_resolucao = null;
    }
    $acoes = $_POST['acoes'];
    $new = $_SESSION['new'];
    $resolucao = new resolucao;
    if($new == 1){
        $resolucao->set_resolucao($status,$data_resolucao,$acoes,$usuario_id,$desvio_id,$area_responsavel,$mysqli);
    }
    if($new == 0){
        $resolucao_id = $_SESSION['resolucao_selecionada']; 
        $resolucao->update_resolucao($resolucao_id,$usuario_id,$status,$acoes,$tipo_desvio,$gravidade,$area_responsavel,$data_resolucao,$mysqli);
        exit('sucesso');
    }

    
}
?>