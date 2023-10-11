<?php

class feedback{

    private $nota;
    private $cometario;
    private $usuario;

    public function set_feedback($nota,$comentario,$usuario,$conexao){

        $query = "SELECT setor from usuario where matricula = $usuario";
        $result = $conexao->query($query);
        
        if($result->num_rows == 0){
            exit('usuario nao cadastrado');
        }

        $query = $conexao->prepare("INSERT INTO feedback(nota,comentario,usuario_matricula) VALUES (?,?,?)");

        $query->bind_param("isi", $nota,$comentario,$usuario);

        $query->execute();

    }
    public function fetch_feedback_usuario($usuario,$conexao){

        $query = "SELECT setor from usuario where matricula = $usuario";
        $result = $conexao->query($query);
        
        if($result->num_rows == 0){
            exit('usuario nao cadastrado');
        }

        $query = "SELECT * from feedback where usuario_matricula = $usuario";
        $result = $conexao->query($query);

        if ($result->num_rows == 0){
            exit('usuario não deu o feedback');

        }else{

            $data = mysqli_fetch_assoc($result);
            $this->nota = $data['nota'];
            $this->comentario = $data['comentario'];
            $this->usuario = $usuario;
        }
    }

}

?>