<?php  
require_once '../desvio.class.php';

class desvio_teste{

    private $usuario_matricula;//int exat11
    private $nome_usuario;//output only varchar
    private $data_identificacao;//date
    private $turno;//varchar max 20
    private $setor;//int espec(1...7)
    private $local;//varchar max255
    private $descricao_desvio;//text
    private $tipo_desvio;//int espec(a ser delimitado)
    private $gravidade;//int espec(1...4)
    private $area_responsavel;//int espec(a ser delimitado)
    private $img;//varchar max255
    private $status;

    public function set_desvio_testes($conexao,$cenario){
         
        //cenario de sucesso
        if ($cenario == 0){
            echo "<br><br> cenario de sucesso da função set_desvio, o cenario<br> 
            é considerado um sucesso completo, se houve a inserção correta dos dados <br>
            no banco de dados e não seja detectado nenhun erro ou warning durante a execução da função<br><br>";
            $desvio = new desvio;
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
            var_dump($desvio);
           
        }
        //cenario de fracasso (usuario ausente no banco)
        if ($cenario == 1){
            
            echo "cenario de fracasso da função set_desvio, este cenario sera considerado um sucesso<br>
            caso durante sua execução ocorra a interrupição do mesmo, pelo fata do usuario informado não ser valido<br>
            ou não esta presente no banco de dados<br><br>";
            $desvio = new desvio;
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
        }  
        //cenario de fracasso (setor inexistente)
        else if ($cenario == 2){

            echo "cenario de fracasso da função set_desvio, este cenario sera considerado um sucesso<br>
            caso durante sua execução ocorra a interrupição do mesmo, pelo fato do setor informado não ser valido<br>
            ou não esta presente no banco de dados<br><br>";
            $desvio = new desvio;
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
        }
        //cenario de fracasso (tipo_desvio inexistente)
        else if ($cenario == 3){

            echo "cenario de fracasso da função set_desvio, este cenario sera considerado um sucesso<br>
            caso durante sua execução ocorra a interrupição do mesmo, pelo fato do tipo de desvio informado não ser valido<br>
            ou não esta presente no banco de dados<br><br>";
            $desvio = new desvio;
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
        } 
        //cenario fracasso (gravidade inexistente)
        else if ($cenario == 4){

            echo "cenario de fracasso da função set_desvio, este cenario sera considerado um sucesso<br>
            caso durante sua execução ocorra a interrupição do mesmo, pelo fato da gravidade do desvio informado não ser valido<br>
            ou não esta presente no banco de dados<br><br>";
            $desvio = new desvio;
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
        }else{
            echo "por favor insira um cenario de teste valido.<br><br>
            cenario possiveis:<br>
            cenario 0 -> cenario de sucesso<br>
            cenario 1 -> cenario de fracasso(usuario invalido)<br>
            cenario 2 -> cenario de fracasso(setor invalido)<br>
            cenario 3 -> cenario de fracasso(tipo de desvio invalido)<br>
            cenario 4 -> cenario de fracasso(gravidade invalido)<br>";
        }
    }
    public function fetch_last_desvio_usuario($conexao,$cenario){

        //cenario de sucesso
        if ($cenario == 0){
            echo "cenario de sucesso da função fetch_last_desvio_usuario, este cenario é considerado um sucesso<br>
            caso o os dados do ultimo desvio do usuario X forem devidamente extraido do banco de dados<br>
            de forma que não ocorra nenhum erro ou warning durante a excução da memsma e aja consitencia nos dados extraidos.";
            $desvio = new desvio;
            $matricula = 1;
            $desvio->fetch_last_desvio_usuario($matricula,$conexao);
            var_dump($desvio);
        }
        //cenario de fracasso (usuario inexitenste)
        else if($cenario == 1){
            echo "cenario de fracasso da função fetch_last_desvio_usuario, este cenario é considerado um sucesso<br>
            caso durante a exucução do mesmo, o processo seja interronpido devido ao fato de que o usuario a qual<br>
            os dados deverão ser extraido é invalido ou não existente no banco de dados";
            $desvio = new desvio;
            $matricula = 10;
            $desvio->fetch_last_desvio_usuario($matricula,$conexao);
            var_dump($desvio);
        }         
        //cenario de fracasso (nenhum desvio encontrado)
        else if($cenario == 2){
            echo "cenario de fracasso da função fetch_last_desvio_usuario, este cenario é considerado um sucesso<br>
            caso durante a exucução do mesmo, o processo seja interronpido devido ao fato de não haver nenhum desvio aberto<br>
            pelo usuario a qual os dados deverão ser extraido";
            $desvio = new desvio;
            $matricula = 2;
            $desvio->fetch_last_desvio_usuario($matricula,$conexao);
            var_dump($desvio);
        }
        else{
            echo "por favor insira um cenario de teste valido.<br><br>
            cenario possiveis:<br>
            cenario 0 -> cenario de sucesso<br>
            cenario 1 -> cenario de fracasso(usuario invalido)<br>
            cenario 2 -> cenario de fracasso(usuario não possui desvio aberto)<br>";
        }
    }
    public function fetch_last_desvio($conexao,$cenario){

        //cenario de sucesso
        if ($cenario == 0){   
            
            echo "Cenario de sucesso da função fetch_last_desvio, este cenario será considerado um sucesso,<br>
            caso haja a extração correta dos dados do ultimo desvio criado e não apresente nenhum tipo de erro<br>
            ou warning durante a exução";
            $desvio = new desvio;
            $desvio->fetch_last_desvio($conexao);
            var_dump($desvio);
       }
       else{
            echo "por favor insira um cenario de teste valido.<br><br>
            cenario possiveis:<br>
            cenario 0 -> cenario de sucesso<br>";
       }
    }
    public function fetch_desvio_by_filter($conexao,$cenario){

        //cenario de sucesso 
        echo "cenario de sucesso da função fetch_desvio_by_filter, este cenario será considerado um sucesso se"
        if ($cenario == 0){

            $desvio = new desvio;
            $turno = null;
            $setor = null;
            $tipo_desvio = null;
            $gravidade = null;
            $data_i = null;
            $data_f = null;
            $order = -2;
            $desvio_data = $desvio->fetch_desvio_by_filter($turno,$setor,$tipo_desvio,$gravidade,$data_i,$data_f,$order,$conexao);
            
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
            }
        }
    }
}
?>