<?php
    require_once 'conexao.php';
    require_once 'usuario.class.php';
    require_once 'desvio.class.php';
    
    /*teste geral de todas as classes. Para execução correta dos testes e necessario a um banco de dados do projeto safety flow
    limpo de dados no qual sera inserido os presets de dados, em seguida dever ser executado de forma individual,isolado e ordenda
    cada cenario de teste das funçoes das classes apresentados abaixo.*/
    
    //preset banco de dados

        //tabela setor
            
            //INSERT INTO setor(id_setor,nome_setor) VALUES (1,'geral'),(2,'estojo'),(3,'hidro'),(4,'creme');

        //tabela gravidade 

            //INSERT INTO gravidade(idgraviade,descricao) VALUES (1,'leve'),(2,'moderado'),(3,'grave'),(4,'gravissimo');

        //tabela tipo_desvio

            //INSERT INTO tipo_desvio(idtipo_desvio,descricao) VALUES (1,'mecanico'),(2,'ambiental'),(3,'humano'),(4,'estrutural');

        //tabela area_responsavel

            /*INSERT INTO area_desvio(id_area,nome_area) VALUES (1,'manutencao_eletrica'),(2'manutencao_hidraulica'),
            (3,'manutencao_pneumatica'),(4,'manutencao_geral'),(5,'meio-ambiente'),(6,'administração');/*
        
        //tabela usuario  

            /*INSERT INTO usuario(nome,matricula,email,senha,isAdmin,setor_id_setor) 
            VALUES ('luan',1,'luan@gamil.com','123456',2,1),('matheus',3,'mat@gmail.com','123456',1,2),
            ('natalia',4,'natalaia@gmail.com','123456',1,3),('marcos',5,'mark@gmail.com','123456',1,4);*/
        
        //tabela desvio

            /*INSERT INTO desvio(usuario_matricula,setor,area_responsavel,tipo_desvio,gravidade,turno,data_identificacao,descricao_desvio,local_desvio)
            VALUES (1,1,1,1,4,'matutino','2023-01-01','whatever','everywhere'),(1,2,3,2,2,'matutino','2023-01-02','whatever','everywhere'),
            (3,3,2,1,1,'vespertino','2023-01-01','whatever','everywhere'),(4,2,3,2,3,'noturno','2023-01-28','whatever','everywhere'),
            (4,3,3,3,2,'matutino','2023-02-01','whatever','everywhere'),(3,1,2,2,4,'vespertino','2023-02-21','whatever','everywhere'),
            (5,1,3,3,1,'vespertino','2023-03-05','whatever','everywhere'),(3,2,1,3,3,'noturno','2023-03-05','whatever','everywhere'),
            (4,3,3,2,1,'matutino','2023-03-10','whatever','everywhere');*/

    //teste de set do usuario
        
        //cenario de sucesso
            
            /*$usuario = new usuario;
            $nome = 'guilherme';
            $matricula = '22222223';
            $senha = '123456';
            $email = 'gui@gmail.com';
            $adm = 1;
            $setor = 2;
            $usuario->set_usuario($nome,$matricula,$email,$senha,$adm,$setor,$conexao);*/
        
        //cenario de fracasso (matricula repetido)

            /*$usuario = new usuario;
            $nome = 'guilherme';
            $matricula = '22222222';
            $senha = '123456';
            $email = 'guimas@gmail.com';
            $adm = 1;
            $setor = 3;
            $usuario->set_usuario($nome,$matricula,$email,$senha,$adm,$setor,$conexao);*/
        
        //cenario de fracasso (email repetido)

            /*$usuario = new usuario;
            $nome = 'guilherme';
            $matricula = '22222224';
            $senha = '123456';
            $email = 'gui@gmail.com';
            $adm = 1;
            $setor = 2;
            $usuario->set_usuario($nome,$matricula,$email,$senha,$adm,$setor,$conexao);*/

        //cenario de fracasso (setor inexistente)

            /*$usuario = new usuario;
            $nome = 'guilherme';
            $matricula = '333333333';
            $senha = '123456';
            $email = 'guibmx@gmail.com';
            $adm = 1;
            $setor = 10;
            $usuario->set_usuario($nome,$matricula,$email,$senha,$adm,$setor,$conexao);*/


    //teste de get do usuario

        //cenario de sucesso

            /*$usuario = new usuario;
            $usuario->fetch_usuario(1,$conexao);
            //var_dump($usuario);*/

        //cenario de fracasso

            /*$usuario = new usuario;
            $usuario->fetch_usuario(100,$conexao);
            var_dump($usuario);*/

    //teste change_senha

        //cenario de sucesso

            /*$usuario = new usuario;
            $usuario->fetch_usuario(1,$conexao);
            $senha_antiga = '123456';
            $senha_nova = '654321';
            $email = 'luan@gmail.com';
            $usuario->change_senha(1,$senha_antiga,$senha_nova,$email,$conexao);
            var_dump($usuario);*/
            
        //cenario de fracasso (sennha inconpativel)
        
            /*$usuario = new usuario;
             $usuario->fetch_usuario(1,$conexao);
            $senha_antiga = '123456';
            $senha_nova = '654321';
            $email = 'luan@gmail.com';
            $usuario->change_senha(1,$senha_antiga,$senha_nova,$email,$conexao);
            var_dump($usuario);*/

        //cenario de fracasso (usuario nao encontrado)

            
            /*$usuario = new usuario;
             $usuario->fetch_ususario(1,$conexao);
            $senha_antiga = '248561';
            $senha_nova = '654321';
            $email = 'luan@gmail.com';
            $usuario->change_senha(20,$senha_antiga,$senha_nova,$email,$conexao);
            var_dump($usuario);*/
    
    //teste usuario turn_adm_on

        //cenario de sucesso
        
            /*$usuario = new usuario;
            $usuario->fetch_usuario(1,$conexao);
            $guilherme = 2;
            $usuario->turn_adm_on($guilherme,$conexao);
            var_dump($usuario);*/

         //cenario de fracaso (acesso de usuario negado)
         
            /*$usuario = new usuario;
            $usuario->fetch_usuario(3,$conexao);
            $guilherme = 2;
            $usuario->turn_adm_on($guilherme,$conexao);
            var_dump($usuario);*/

    // teste usuario turn_adm_off

        //cenario de sucesso

            /*$usuario = new usuario;
            $usuario->fetch_usuario(1,$conexao);
            $guilherme = 2;
            $usuario->turn_adm_on($guilherme,$conexao);
            var_dump($usuario);*/

        //cenario de fracaso (acesso de usuario negado)
         
            /*$usuario = new usuario;
            $usuario->fetch_usuario(3,$conexao);
            $guilherme = 2;
            $usuario->turn_adm_on($guilherme,$conexao);
            var_dump($usuario);*/


    //teste da classe desvio

    //teste de set_desvio

        //cenario de sucesso
            
            /*$desvio = new desvio;
            $matricula = 1;
            $data_i = '2023-07-01';
            $turno = 'matutino';
            $setor = 3;
            $local = 'nowhere';
            $descricao = 'whatever';
            $tipo_desvio = 3;
            $gravidade = 4;
            $area_r = 5;
            $img = 'img';
            $desvio->set_desvio($matricula,$data_i,$turno,$setor,$local,$descricao,$tipo_desvio,$gravidade,$area_r,$img,$conexao);
            var_dump($desvio);*/

        //cenario de fracasso (usuario ausente no banco)

            /*$desvio = new desvio;
            $matricula = 20;
            $data_i = '2023-07-01';
            $turno = 'matutino';
            $setor = 3;
            $local = 'nowhere';
            $descricao = 'whatever';
            $tipo_desvio = 3;
            $gravidade = 4;
            $area_r = 5;
            $img = 'img';
            $desvio->set_desvio($matricula,$data_i,$turno,$setor,$local,$descricao,$tipo_desvio,$gravidade,$area_r,$img,$conexao);
        
        //cenario de fracasso (setor inexistente)

            /*$desvio = new desvio;
            $matricula = 1;
            $data_i = '2023-07-01';
            $turno = 'matutino';
            $setor = 10;
            $local = 'nowhere';
            $descricao = 'whatever';
            $tipo_desvio = 3;
            $gravidade = 4;
            $area_r = 5;
            $img = 'img';
            $desvio->set_desvio($matricula,$data_i,$turno,$setor,$local,$descricao,$tipo_desvio,$gravidade,$area_r,$img,$conexao);     

        //cenario de fracasso (tipo_desvio inexistente)

            /*$desvio = new desvio;
            $matricula = 1;
            $data_i = '2023-07-01';
            $turno = 'matutino';
            $setor = 3;
            $local = 'nowhere';
            $descricao = 'whatever';
            $tipo_desvio = 6;
            $gravidade = 4;
            $area_r = 5;
            $img = 'img';
            $desvio->set_desvio($matricula,$data_i,$turno,$setor,$local,$descricao,$tipo_desvio,$gravidade,$area_r,$img,$conexao);
        
        //cenario fracasso (gravidade inexistente)
  
            /*$desvio = new desvio;
            $matricula = 1;
            $data_i = '2023-07-01';
            $turno = 'matutino';
            $setor = 3;
            $local = 'nowhere';
            $descricao = 'whatever';
            $tipo_desvio = 3;
            $gravidade = 7;
            $area_r = 5;
            $img = 'img';
            $desvio->set_desvio($matricula,$data_i,$turno,$setor,$local,$descricao,$tipo_desvio,$gravidade,$area_r,$img,$conexao);

    //teste de fetch_last_desvio_usuario

        //cenario de sucesso
            
            /*$desvio = new desvio;
            $matricula = 1;
            $desvio->fetch_last_desvio_usuario($matricula,$conexao);
            var_dump($desvio);*/
        
        //cenario de fracasso (usuario inexitenste)

            /*$desvio = new desvio;
            $matricula = 10;
            $desvio->fetch_last_desvio_usuario($matricula,$conexao);
            var_dump($desvio);*/
         
        //cenario de fracasso (nenhum desvio encontrado)

            /*$desvio = new desvio;
            $matricula = 8;
            $desvio->fetch_last_desvio_usuario($matricula,$conexao);
            var_dump($desvio);*/

    //teste de fetch_last desvio

        //cenario de sucesso
            
            /*$desvio->fetch_last_desvio($conexao);
            var_dump($desvio);*/

    //teste fetch_desvio_by_filter

        //cenario de sucesso
            
            /*$desvio = new desvio;
            $turno = null;
            $setor = null;
            $tipo_desvio = null;
            $gravidade = null;
            $data_i = null;
            $data_f = null;
            $desvio_data = $desvio->fetch_desvio_by_filter($turno,$setor,$tipo_desvio,$gravidade,$data_i,$data_f,$conexao);
            
            $m = count($desvio_data);
            $x = 0;
            while($x < $m){
                
                $desvio_i = $desvio_data[$x];
                $nome = $desvio_i['usuario_matricula'];
                $turno = $desvio_i['turno'];
                $tipo_desvio = $desvio_i['tipo_desvio'];
                $setor = $desvio_i['setor'];
                $gravidade = $desvio_i['gravidade'];
                $data_identificacao = $desvio_i['data_identificacao'];
                $descricao = $desvio_i['descricao_desvio'];
                $local = $desvio_i['local_desvio'];    
                echo "\n";
                echo 'nome: '.$nome. "\n";
                echo 'turno: '.$turno. "\n";
                echo 'setor: '.$setor. "\n";
                echo 'tipo_desvio: '.$tipo_desvio. "\n";
                echo 'gravidade: '.$gravidade. "\n";
                echo 'data de identificação: '.$data_identificacao. "\n";
                echo 'descrição: '.$descricao. "\n";
                echo 'local do desvio: '.$local. "\n";
                echo "\n";
                echo "\n";
                echo '-----------------------------------------------------------------------';
                $x++;
            }*/
    

?>