<?php
    require_once 'conexao.php';
    require_once 'usuario.class.php';
   
   //teste de set do usuario

    /* $usuario = new usuario;
    $nome = 'guilherme';
    $matricula = '1234567891';
    $senha = '123456';
    $email = 'gui@gmail.com';
    $adm = 1;
    $setor = 2;
    $usuario->set_usuario($nome,$matricula,$email,$senha,$adm,$setor,$conexao);*/

    //teste de get do usuario

    $usuario = new usuario;
    $usuario->get_usuario(1234567891,$conexao);
    //var_dump($usuario);

    //teste change_senha

    $senha_antiga = '123456';
    $senha_nova = '654321';
    $email = 'gui@gmail.com';
    $usuario->change_senha(1234567891,$senha_antiga,$senha_nova,$email,$conexao);
    var_dump($usuario);


?>