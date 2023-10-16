<?php 
    class usuario{

        private $nome;/* varchar max60*/
        private $matricula;/* int exat11*/
        private $email;/* varchar max60*/
        private $senha;/* varchar min6-max12*/
        private $adm;/*int espec(1 or 2)*/
        private $setor;/*int espec(1...7)*/

        public function set_usuario($nome,$matricula,$email,$senha,$adm,$setor,$conexao){
            
            if ( $nome == null or $matricula == null or $email == null or $senha == null or $adm == null or $setor == null){

                $usuario_excam = array($nome,$matricula,$email,$senha,$adm,$setor);
                exit('campo vazio'.var_dump($usuario_excam));

            }else if ( strlen($nome) > 60 ){

               exit('nome muito grande');

            }else if (!is_string($nome)){

                exit('tipo de caracter errado(nome)');

            }else if ( strlen($matricula) != 8){

                exit('matricula invalida por numeros de caracteres');
            
            }else if (is_int($matricula)){

                exit('tipo de carcter errado');

            }else if (strlen($email) > 60){

                exit('email muito grande');

            }else if (!is_string($email)){

                exit('tipo de caracter errado(email)');

            }else if (strlen($senha) < 6){

                exit('senha muito pequena');
            
            }else if (strlen($senha) > 12){

                exit('senha muito grande');
            
            }else if (!is_string($senha)){

                exit('tipo de caracter errado(senha)');
            
            }else if (strlen($adm) > 1){

                exit('adm muito grande');

            }else if (!is_int($adm)){

                exit('tipo de caracter errado(adm)');
           
            }else if (!is_int($setor)){

                exit('tipo de caracter errado(setor)');
            
            }
            
            $result = $conexao->query("SELECT id_setor from setor where id_setor = '$setor'");
            $row = $result->num_rows;

            if ( $row == 0){
                
                exit('setor inexistente');
            }
            
            $result = $conexao->query("SELECT email from usuario where email = '$email'");
            $row = $result->num_rows;

            if ( $row != 0){
               
                exit('email ja existe');
            } 
            
            $result = $conexao->query("SELECT matricula from usuario where matricula = '$matricula'");
            $row = $result->num_rows;

            if ($row != 0){

                exit('matricula ja cadastrada');
            }
            else{

                $this->nome = $nome;
                $this->matricula = $matricula;
                $this->email = $email;
                $this->senha = $senha;
                $this->adm = $adm;
                $this->setor= $setor;
                $query = "INSERT INTO usuario
                (nome,
                matricula,
                email,
                senha,
                isAdmin,
                setor) 
                VALUES ('$nome',
                $matricula,
                '$email',
                '$senha',
                $adm,
                $setor)";
                $conexao->query($query);
                
            }
            
        }
        public function fetch_usuario($matricula,$conexao){

            $query = "SELECT * FROM usuario WHERE matricula = $matricula";
            $result = $conexao->query($query);
            if ($result->num_rows == 0){

                exit('usuario não encontrado');

            }else{
               
                $data = mysqli_fetch_assoc($result);
                $this->nome = $data['nome'];
                $this->matricula = $matricula;
                $this->email = $data['email'];
                $this->senha = $data['senha'];
                $this->adm = $data['isAdmin'];
                $this->setor = $data['setor']; 
            }
        }
        public function get_matricula(){
            return $this->matricula;
        }
        public function get_nome(){
            return $this->nome;
        }
        public function get_email(){
            return $this->email;
        }
        public function get_adm(){
            return $this->adm;
        }
        public function get_setor(){
            return $this->setor;
        }
        public function change_senha($matricula,$senha_A,$senha_B,$email,$conexao){

            
            $query = "SELECT senha FROM usuario WHERE matricula = $matricula";
            $result = $conexao->query($query);
            if ($result->num_rows == 0){

                exit('usuario não encontrado');

            }else if ($senha_A != $this->senha){

                exit('senha incompativel');
            
            }else if  ($email != $this->email){

                exit('email invalido');
            
            }else if (strlen($senha_B) > 12 and strlen($senha_B) < 6){

                exit('senha muito longa ou curta');
     
            }else if (!is_string($senha_B)){

                exit('tipo de caracter errado(senha)');
            
            }else{

                $this->senha = $senha_B;
                $query = "UPDATE USUARIO SET senha = '$senha_B' WHERE matricula = $matricula";
                $conexao->query($query);
            }

        }
        public function turn_adm_on($matricula,$conexao){

            if ($this->adm == 1){

                exit('usuario nao tem acesso a está função');
            
            }else if($this->adm == 2){

                $query = "SELECT matricula FROM usuario WHERE matricula = $matricula";
                $result = $conexao->query($query);
                if ($result->num_rows == 0){

                    exit('usuario não encontrado');

                }else{

                    $usuario = new usuario;
                    $usuario->fetch_usuario($matricula,$conexao);
                    $usuario->adm = 2;
                    $query = "UPDATE usuario SET isAdmin = $usuario->adm WHERE matricula = $matricula";
                    $conexao->query($query);
                    $usuario = null;
                }
            }
            
        }
        public function turn_adm_off($matricula,$conexao){

            if ($this->adm == 1){

                exit('usuario nao tem acesso a está função');
            
            }else if($this->adm == 2){

                $query = "SELECT matricula FROM usuario WHERE matricula = $matricula";
                $result = $conexao->query($query);
                if ($result->num_rows == 0){

                    exit('usuario não encontrado');

                }else{

                    $usuario = new usuario;
                    $usuario->fetch_usuario($matricula,$conexao);
                    $usuario->adm = 1;
                    $query = "UPDATE usuario SET isAdmin = 1 WHERE matricula = $matricula";
                    $conexao->query($query);
                    $usuario = null;
                }
            }  
        }
    }
?>
