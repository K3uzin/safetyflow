<?php
require_once "../usuario.class.php";

class usuario_teste{

    private $funcao;
    private $cenario;
    private $status_banco;

    public function set_usuario($conexao,$cenario){

         //cenario de sucesso
        if ($cenario == 0){
            $this->funcao = "set_usuario";
            $this->cenario = $cenario;
            echo "cenario de sucesso da função set_usuario, este cenario sera considerado um sucesso casa haja a<br>
            inserção dos dados do usuario no banco de dados e durante o processo não ocorra nenhum erro ou warning";
            $usuario = new usuario;
            $nome = 'guilherme';
            $matricula = '2';
            $senha = '123456';
            $email = 'gui@gmail.com';
            $adm = 1;
            $setor = 2;
            $usuario->set_usuario($nome,$matricula,$email,$senha,$adm,$setor,$conexao);
            $query = "SELECT matricula from usuario where matricula = $matricula";
            $result = $conexao->query($query);
            if ($result->num_rows == 0){
                $this->status_banco = "não houve inserção de dados";
            }else{
                $this->status_banco = "inserção bem sucedida"
            }
        }
         //cenario de fracasso (matricula repetido)
        if ($cenario == 1){
            $this->funcao = "set_usuario";
            $this->cenario = $cenario;
            echo "cenario de fracasso da função set_usuario, este cenario sera considerado caso haja a a interrupção<br>
            da função caso o usuario que está sendo setado já esteja presente no banco";
            $usuario = new usuario;
            $nome = 'guilherme';
            $matricula = '2';
            $senha = '123456';
            $email = 'guimas@gmail.com';
            $adm = 1;
            $setor = 3;
            $usuario->set_usuario($nome,$matricula,$email,$senha,$adm,$setor,$conexao);
            $this->status_banco = "não relevante";
        }   
        //cenario de fracasso (email repetido)
        if ($cenario == 2){
            $this->funcao = "set_usuario";
            $this->cenario = $cenario;
            echo "cenario de fracasso da função set_usuario, este cenario sera considerado caso haja a a interrupção<br>
            da função caso o email que está sendo utilizado já esteja presente no banco ou seja invalido";
            $usuario = new usuario;
            $nome = 'guilherme';
            $matricula = '22222224';
            $senha = '123456';
            $email = 'gui@gmail.com';
            $adm = 1;
            $setor = 2;
            $usuario->set_usuario($nome,$matricula,$email,$senha,$adm,$setor,$conexao);
            $this->status_banco = "não relevante";
        }
        //cenario de fracasso (setor inexistente)
        if ($cenario == 3){
            $this->funcao = "set_usuario";
            $this->cenario = $cenario;
            echo "cenario de fracasso da função set_usuario, este cenario sera considerado caso haja a a interrupção<br>
            da função caso o setor que está sendo utilizado já esteja presente no banco ou seja invalido";
            $usuario = new usuario;
            $nome = 'guilherme';
            $matricula = '333333333';
            $senha = '123456';
            $email = 'guibmx@gmail.com';
            $adm = 1;
            $setor = 10;
            $usuario->set_usuario($nome,$matricula,$email,$senha,$adm,$setor,$conexao);
        }
    }
    public function get_usuario($conexao,$cenario){
        //teste de get do usuario

        //cenario de sucesso
        if($cenario == 0){
            $this->funcao = "get_usuario";
            $this->cenario = $cenario;
            echo "cenario de sucesso da função get_usuario, este cenario será considerado um sucesso caso, haja a execução <br>
            bem sucedida da função, onde não ocorra nenhum tipo de erro ou warnign, e os dados do usuario requisitado sejam recuperados com sucesso.<br>"
            $usuario = new usuario;
            $query = "SELECT * from usuario where matricula = 1";
            $result = $conexao->query($query);
            if ($result->num_rows > 0){
                $this->status_banco = "ok";
            }else{
                $this->status_banco = "usuario não está presente no banco";
            }
            $usuario->fetch_usuario(1,$conexao);
            var_dump($usuario);
        
        }
        //cenario de fracasso
        if($cenario == 1){
            $this->funcao = "get_usuario";
            $this->cenario = $cenario;
            echo "cenario de fracasso da função get_usuario, este cenario será considerado um sucesso caso, haja a interrupção <br>
            bem sucedida da função, devido ao fato que o usuario requisitado não esteja presente no banco.<br>";
            $usuario = new usuario;
            $query = "SELECT * from usuario where matricula = 1";
            $result = $conexao->query($query);
            if ($result->num_rows > 0){
                $this->status_banco = "ok";
            }else{
                $this->status_banco = "usuario não está presente no banco";
            }
            $usuario->fetch_usuario(100,$conexao);
            var_dump($usuario);
        }
    }
    public function change_senha($conexao,$cenario){
        
        //cenario de sucesso
        if ($cenario == 0){
            $this->funcao = "change_senha";
            $this->cenario = $cenario;
            echo "teste da função da change_senha, este teste do cenario de sucesso na função, logo ele é considerado bem sucedido <br>
            caso seja excutado sem nenhum erro ou warning, e a senha do usuario solicitado seja trocada com sucesso";
            $usuario = new usuario;
            $query = "SELECT * from usuario where matricula = 1";
            $result = $conexao->query($query);
            $data = mysqli_fetch_assoc($result);
            if ($result->num_rows > 0){
                $senha_a = $data['senha'];
                $this->status_banco = 
                "usuario: ok<br>
                senha: $senha_a";
            }else{
                $this->status_banco = "usuario não está presente no banco";
            }
            $usuario->fetch_usuario(1,$conexao);
            $senha_antiga = '123456';
            $senha_nova = '654321';
            $email = 'luan@gmail.com';
            $usuario->change_senha(1,$senha_antiga,$senha_nova,$email,$conexao);
            $query = "SELECT * from usuario where matricula = 1";
            $result = $conexao->query($query);
            $data = mysqli_fetch_assoc($result);
            $senha_n = $data['senha']
            if ($result->num_rows > 0){
                $this->status_banco = 
                "usuario: ok<br>
                senha antiga: $senha_a<br>
                senha nova: $senha_n<br>";
            }
            var_dump($usuario);
        }    
        //cenario de fracasso (sennha inconpativel)
        if ($cenario == 1){ 
            
            $this->funcao = "change_senha";
            $this->cenario = $cenario;
            echo "teste da função da change_senha, cenario de fracasso da função change_senha, este cenario será considerado um<br>
            sucesso caso haja a interrupção da função caso a confirmação de senha seja invalida";
            $usuario = new usuario;
            $query = "SELECT * from usuario where matricula = 1";
            $result = $conexao->query($query);
            $data = mysqli_fetch_assoc($result);
            if ($result->num_rows > 0){
                $senha_a = $data['senha'];
                $this->status_banco = 
                "usuario: ok<br>
                senha: $senha_a";
            }else{
                $this->status_banco = "usuario não está presente no banco";
            }
            $usuario->fetch_usuario(1,$conexao);
            $senha_antiga = '123456';
            $senha_nova = '654321';
            $email = 'luan@gmail.com';
            $usuario->change_senha(1,$senha_antiga,$senha_nova,$email,$conexao);
            var_dump($usuario);
        }
        //cenario de fracasso (usuario nao encontrado)
        if ($cenario  == 2){
              
            $this->funcao = "change_senha";
            $this->cenario = $cenario;
            echo "teste da função da change_senha, cenario de fracasso da função change_senha, este cenario será considerado um<br>
            sucesso caso haja a interrupção da função devido oa fato o usuario não está presente no banco";
            $usuario = new usuario;
            $query = "SELECT * from usuario where matricula = 20";
            $result = $conexao->query($query);
            $data = mysqli_fetch_assoc($result);
            if ($result->num_rows > 0){
                $senha_a = $data['senha'];
                $this->status_banco = 
                "usuario: ok<br>
                senha: $senha_a";
            }else{
                $this->status_banco = "usuario não está presente no banco";
            }
            $usuario->fetch_ususario(1,$conexao);
            $senha_antiga = '248561';
            $senha_nova = '654321';
            $email = 'luan@gmail.com';
            $usuario->change_senha(20,$senha_antiga,$senha_nova,$email,$conexao);
            var_dump($usuario);
        }
    }
}
?>