<?php
session_start();
require_once '../model/conexao.php';
require_once 'desvio.class.php';
require_once 'resolucao.class.php';
// die(var_dump($_POST));
$desvio_id = $_SESSION['desvio_selecionado'];
$usuario_id = $_SESSION['user_matricula'];

if (isset($_POST)){

    $status = $_POST['status_resolucao'];
    if ($status = 3){

        $data_resolucao = date('d-m-Y');
    }else{
        $data_resolucao = null;
    }
    $acoes = $_POST['acoes'];
    $new = $_SESSION['new'];
    $resolucao = new resolucao;
    if($new = 1){
        $resolucao->set_resolucao($status,$data_resolucao,$acoes,$usuario_id,$desvio_id,$mysqli);
    }

}
?>