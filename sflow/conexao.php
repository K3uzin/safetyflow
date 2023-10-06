<?php
    if(!isset($conexao)){
        ini_set("display errors",1);
        $conexao = new mysqli('localhost','root','123456cds','safetyflow');

        if($conexao->connect_error){
            echo "erro ao conectar <br>";
            error_log("connection error". $conexao->connect_error);
            echo ("connection error". $conexao->connect_error);
        }
    }
?>