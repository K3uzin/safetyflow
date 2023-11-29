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
            $matricula = '22222223';
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

    }
}
?>