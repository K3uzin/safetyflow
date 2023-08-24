<?php
    ini_set("display_errors", 1);

    $mysqli = new mysqli("localhost", "root", "", "sflow");

    if ($mysqli->connect_error){
        echo "erro ao conectar <br>";
        error_log('Connection error: ' . $mysqli->connect_error);
        echo ('Connection error: ' . $mysqli->connect_error);
    }

    //var_dump($mysqli);
