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
}
?>