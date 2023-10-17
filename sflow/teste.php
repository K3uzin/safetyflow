<?php
    require_once 'conexao.php';
    require_once 'usuario.class.php';
    require_once 'desvio.class.php';
    require_once 'resolucao.class.php';
    require_once 'feedback.class.php';
    
    /*teste geral de todas as classes. Para execução correta dos testes e necessario a um banco de dados do projeto safety flow
    limpo de dados no qual sera inserido os presets de dados, em seguida dever ser executado de forma individual,isolada e ordenda
    cada cenario de teste das funçoes das classes apresentados abaixo.*/

    //preset banco de dados

        //tabela setor
            
            //caso mysql

                //alter table desvio rename column tipo_desvio_idtipo_desvio to tipo_desvio;
                //alter table desvio rename column gravidade_idgravidade to gravidade;
                //alter table desvio rename column area_responsavel_id_area to area_responsavel;
                //alter table desvio rename column setor_id_setor to setor;
                
            //caso mariaDB

                //alter table desvio change tipo_desvio_idtipo_desvio tipo_desvio int;
                //alter table desvio change gravidade_idgravidade gravidade int;
                //alter table desvio change area_responsavel_id_area area_responsavel int;
                //alter table desvio change setor_id_setor setor int;
            //

            //INSERT INTO setor(id_setor,nome_setor) VALUES (1,'geral'),(2,'estojo'),(3,'hidro'),(4,'creme');

        //tabela gravidade 

            //INSERT INTO gravidade(idgraviade,descricao) VALUES (1,'leve'),(2,'moderado'),(3,'grave'),(4,'gravissimo');

        //tabela tipo_desvio

            //INSERT INTO tipo_desvio(idtipo_desvio,descricao) VALUES (1,'mecanico'),(2,'ambiental'),(3,'humano'),(4,'estrutural');

        //tabela area_responsavel

            /*INSERT INTO area_responsavel(id_area,nome_area) VALUES (1,'manutencao_eletrica'),(2,'manutencao_hidraulica'),
            (3,'manutencao_pneumatica'),(4,'manutencao_geral'),(5,'meio-ambiente'),(6,'administração');/*
        
        //tabela usuario  

            /*INSERT INTO usuario(nome,matricula,email,senha,isAdmin,setor) 
            VALUES ('luan',1,'luan@gamil.com','123456',2,1),('matheus',3,'mat@gmail.com','123456',1,2),
            ('natalia',4,'natalaia@gmail.com','123456',1,3),('marcos',5,'mark@gmail.com','123456',1,4);*/
        
        //tabela desvio

            /*INSERT INTO desvio(usuario_matricula,setor,area_responsavel,tipo_desvio,gravidade,turno,data_identificacao,descricao_desvio,local_desvio)
            VALUES (1,1,1,1,4,'matutino','2023-01-01','whatever','everywhere'),(1,2,3,2,2,'matutino','2023-01-02','whatever','everywhere'),
            (3,3,2,1,1,'vespertino','2023-01-01','whatever','everywhere'),(4,2,3,2,3,'noturno','2023-01-28','whatever','everywhere'),
            (4,3,3,3,2,'matutino','2023-02-01','whatever','everywhere'),(3,1,2,2,4,'vespertino','2023-02-21','whatever','everywhere'),
            (5,1,3,3,1,'vespertino','2023-03-05','whatever','everywhere'),(3,2,1,3,3,'noturno','2023-03-05','whatever','everywhere'),
            (4,3,3,2,1,'matutino','2023-03-10','whatever','everywhere');*/
        
        //tabela resolucao

            //caso mysql

                //alter table resolucao rename column usuario_setor_id_setor to usuario_setor;
                //alter table resolucao rename column desvio_id_desvio to id_desvio;
                //alter table resolucao rename column desvio_tipo_desvio_idtipo_desvio to desvio_tipo_desvio;
                //alter table resolucao rename column desvio_gravidade_idgravidade to desvio_gravidede;
                //alter tavle resolucao rename column devio_area_responsvavel_id_area to desvio_area_r;
                //alter table resolucao rename column desvio_setor_id_setor to desvio_setor;
                //alter table resolucao rename column area_responsavel_id_area to area_responsavel;

            //caso mariaDB

                //alter table resolucao change usuario_setor_id_setor usuario_setor int;
                //alter table resolucao change desvio_id_desvio id_desvio int;
                //alter table resolucao change desvio_tipo_desvio_idtipo_desvio desvio_tipo_desvio int;
                //alter table resolucao change desvio_gravidade_idgravidade desvio_gravidade int;
                //alter table resolucao change desvio_area_responsavel_id_area desvio_area_r int;
                //alter table resolucao change desvio_setor_id_setro to desvio_setor;
                //alter table resolucao change area_responsavel_id_area to area_responsavel;

        //tabela feedback
        
            //alter table feedback add column data_postagem date;

    //teste classe usuario

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
                var_dump($usuario);*/

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
        
        //teste usuario turn_adm_on(a ser reformulada, funcional)

            //cenario de sucesso
            
                /*$usuario = new usuario;
                $usuario->fetch_usuario(1,$conexao);
                $natalia = 4;
                $usuario->turn_adm_on($natalia,$conexao);
                var_dump($usuario);*/

            //cenario de fracaso (acesso de usuario negado)
            
                /*$usuario = new usuario;
                $usuario->fetch_usuario(3,$conexao);
                $natalia = 2;
                $usuario->turn_adm_on($natalia,$conexao);
                var_dump($usuario);*/

        // teste usuario turn_adm_off (a ser refromulada, não funcional)

            //cenario de sucesso 
               
                /*$usuario = new usuario;
                $usuario->fetch_usuario(1,$conexao);
                $natalia = 3;
                $usuario->turn_adm_on($natalia,$conexao);
                var_dump($usuario);*/

            //cenario de fracaso (acesso de usuario negado)
            
                /*$usuario = new usuario;
                $usuario->fetch_usuario(3,$conexao);
                $natalia = 4;
                $usuario->turn_adm_on($natalia,$conexao);
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
                $desvio->set_desvio($matricula,$data_i,$turno,$setor,$local,$descricao,$tipo_desvio,$gravidade,$area_r,$img,$conexao);*/

        //teste de fetch_last_desvio_usuario

            //cenario de sucesso
                
                /*$desvio = new desvio;
                $matricula = 3;
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
                
                /*$desvio = new desvio;
                $desvio->fetch_last_desvio($conexao);
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
                    echo '<br>';
                    echo 'nome: '.$nome. '<br>';
                    echo 'turno: '.$turno. '<br>';
                    echo 'setor: '.$setor. '<br>';
                    echo 'tipo_desvio: '.$tipo_desvio. '<br>';
                    echo 'gravidade: '.$gravidade. '<br>';
                    echo 'data de identificação: '.$data_identificacao. '<br>';
                    echo 'descrição: '.$descricao. '<br>';
                    echo 'local do desvio: '.$local. '<br>';
                    echo '<br>';
                    echo '<br>';
                    echo '-----------------------------------------------------------------------';
                    $x++;
                }*/
    
    //teste de classe resolucao

        //teste set resolução

            /*$usuario = 1;
            $desvio = 5;
            $area = 2;
            $resolucao = new resolucao;
            $resolucao->set_resolucao($usuario,$desvio,$area,$conexao);
            var_dump($resolucao);*/
        
        //teste de get_all_resolucao
                
            //cenario de sucesso
                
                /*$resolucao = new resolucao;
                $data = $resolucao->get_all_resolucao($conexao);
                $t = count($data)
                for ($x = 0;$x < $t;$x++){
                    
                    $resolucao_i = $data[$x];
                    echo 'id_resolução: '.$resolucao_i['id_resolucao'].'<br>';
                    echo 'status: '.$resolucao_i['status'].'<br>';
                    echo 'acoes: '.$resolucao_i['acoes'].'<br>';
                    echo 'data de resolucao: '.$resolucao_i['data_resolucao'].'<br>';
                    $usuario_data = new usuario;
                    $usuario_data->fetch_usuario($resolucao_i['usuario_matricula'],$conexao);
                    $usuario_nome = $usuario_data->get_nome();
                    $usuario_setor = $usuario_data->get_setor();
                    echo 'responsavel pela resolução: '.$usuario_nome.'<br>';
                    echo 'setor do responsavel: '.$usuario_setor.'<br>';
                    echo 'area responsavel: '.$resolucao_i['id_area_r'];
                    $desvio_data = new desvio;
                    $desvio_data->fetch_desvio($resolucao_i['id_desvio'],$conexao);
                    echo 'responsavel pelo desvio: '.$desvio_data->get_usuario_matricula().'<br>';
                    echo 'data do desvio: '.$desvio_data->get_data_identificacao().'<br>';
                    echo 'graviade do desvio: '.$desvio_data->get_graviade().'<br>';
                    echo 'descrição do desvio: '.$desvio_data->get_descricao().'<br>';
                    echo 'setor do desvio: '.$desvio_data->get_setor().'<br>';
                    echo 'local especifico do descio: '.$desvio_data->get_local().'<br>':
                   
                }*/
        
        //teste  de get_resolucao
        
            //cenario de sucesso

                $resolucao = new resolucao;
                $id_resolucao = 1;
                $resolucao->fetch_resolucao($id_resolucao,$conexao);
                echo 'id_resolução: '.$resolucao->get_id().'<br>';
                echo 'status: '.$resolucao->get_status().'<br>';
                echo 'acoes: '.$resolucao->get_acoes().'<br>';
                echo 'data de resolucao: '.$resolucao->get_data_resolucao().'<br>';
                $usuario_data = new usuario;
                $usuario_data->fetch_usuario($resolucao->get_usuario(),$conexao);
                $usuario_nome = $usuario_data->get_nome();
                $usuario_setor = $usuario_data->get_setor();
                echo 'responsavel pela resolução: '.$usuario_nome.'<br>';
                echo 'setor do responsavel: '.$usuario_setor.'<br>';
                echo 'area responsavel: '.$resolucao->get_area_responsavel().'<br>';
                $desvio_data = new desvio;
                $desvio_data->fetch_desvio($resolucao->get_desvio(),$conexao);
                echo 'responsavel pelo desvio: '.$desvio_data->get_usuario_matricula().'<br>';
                echo 'data do desvio: '.$desvio_data->get_data_identificacao().'<br>';
                echo 'graviade do desvio: '.$desvio_data->get_graviade().'<br>';
                echo 'descrição do desvio: '.$desvio_data->get_descricao().'<br>';
                echo 'setor do desvio: '.$desvio_data->get_setor().'<br>';
                echo 'local especifico do descio: '.$desvio_data->get_local().'<br>':
                
    
    //teste de classe feedback;
    
        //teste set feedback

            //cenario de sucesso
                
                /*$nota = 5;
                $comentario = 'muito bom servico';
                $usuario = 1;
                $feedback = new feedback;
                $feedback->set_feedback($nota,$comentario,$usuario,$conexao);
                var_dump($feedback);*/
            
            //cenario de fracasso (usuario nao cadastrado)

                /*$nota = 5;
                $comentario = null;
                $usuario = 10;
                $feedback = new feedback;
                $feedback->set_feedback($nota,$comentario,$usuario,$conexao);*/

        //teste update_feedback

            //cenario de sucesso

                /*$nota = 3;
                $comentario = 'seviço ok';
                $usuario = 1;
                $feedback = new feedback;
                $feedback->update_feedback($usuario,$nota,$comentario,$conexao);
                var_dump($feedback);*/

            //cenario de fracasso (usuario não castrado)

                /*$nota = 5;
                $comentario = 'premiun';
                $usuario = 100;
                $feedback = new feedback;
                $feedback->update_feedback($usuario,$nota,$comentario,$conexao);
                var_dump($feedback);*/
            
            //cenario de fracasso (usuario não deu feedback ainda)

                /*$nota = 5;
                $comentario = 'premiun';
                $usuario = 2;
                $feedback = new feedback;
                $feedback->update_feedback($usuario,$nota,$comentario,$conexao);
                var_dump($feedback);*/

        //teste de fetch_feedback_usuario

            //cenario de sucesso

                /*$usuario = 1;
                $feedback = new feedback;
                $feedback->fetch_feedback_usuario($usuario,$conexao);
                var_dump($feedback);*/

            //cenario de fracasso (usuario não cadastrado)

                /*$usuario = 10;
                $feedback = new feedback;
                $feedback->fetch_feedback_usuario($usuario,$conexao);
                var_dump($feedback);*/

            //cenario de fracasso (usuario nao deu feedback)

                /*$usuario = 2;
                $feedback = new feedback;
                $feedback->fetch_feedback_usuario($usuario,$conexao);
                var_dump($feedback);*/
            
        //teste de get_feedback_avg_nota
        
            //cenario de sucesso

                /*$nota = 4;
                $comentario = 'muito bom servico';
                $usuario = 3;
                $feedback = new feedback;
                $feedback->set_feedback($nota,$comentario,$usuario,$conexao);
                $nota = 4;
                $comentario = 'satisfeito';
                $usuario = 4;
                $feedback->set_feedback($nota,$comentario,$usuario,$conexao);
                $nota = 1;
                $comentario = 'horrivel';
                $usuario = 5;
                $feedback->set_feedback($nota,$comentario,$usuario,$conexao);
                $avg_feedback_nota = $feedback->get_feedback_avg_nota($conexao);
                echo "resultado esperado = 3 ";
                var_dump($avg_feedback_nota);*/

        //teste de get_all_feedback

            //cenario de sucesso

                /*$feedback = new feedback;
                $feedback_data = $feedback->get_all_feedback($conexao);
                $m = count($feedback_data);
                $x = 0;
                while($x < $m){

                    $feedback_i = $feedback_data[$x];
                    echo ' nota = '.$feedback_i['nota'].' | ';
                    echo ' comentario = '.$feedback_i['comentario'].' | ';
                    echo ' usuario = '.$feedback_i['usuario_matricula'].'<br>' ;
                    $x++;
                }*/
        
        //teste de get_feedback_by_data

            //cenario de sucesso
             
                /*$feedback = new feedback;
                //exit(var_dump($feedback));
                $data_postagem_i = '2023-10-01';
                $data_postagem_f = '2023-10-30';
                $feedback_data = $feedback->get_feedback_by_data($data_postagem_i,$data_postagem_f,$conexao);
                $m = count($feedback_data);
                $x = 0;
                while($x < $m){

                    $feedback_i = $feedback_data[$x];
                    echo ' nota = '.$feedback_i['nota'].' | ';
                    echo ' comentario = '.$feedback_i['comentario'].' | ';
                    echo ' usuario = '.$feedback_i['usuario_matricula'].'<br>' ;
                    $x++;
                }*/

                                


?>