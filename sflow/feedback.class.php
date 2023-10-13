<?php

class feedback{

    private $nota;
    private $comentario;
    private $usuario;
    private $data_postagem;

    public function set_feedback($nota,$comentario,$usuario,$conexao){

        $query = "SELECT matricula from usuario where matricula = $usuario";
        $result = $conexao->query($query);
        
        if($result->num_rows == 0){
            exit('usuario nao cadastrado');
        }
        
        $query = "SELECT * FROM feedback where usuario_matricula = $usuario";
        $result = $conexao->query($query);

        if($result->num_rows > 0){
            
            exit('usuario ja possui feedback');
        }
        
        $query = $conexao->prepare("INSERT INTO feedback(nota,comentario,usuario_matricula,data_postagem) VALUES (?,?,?,?)");
        $data_postagem = date('Y-m-d');
        $query->bind_param("isis", $nota,$comentario,$usuario,$data_postagem);

        $query->execute();

        $this->nota = $nota;
        $this->comentario = $comentario;
        $this->usuario = $usuario;
        $this->data_postagem = $data_postagem;

    }
    public function update_feedback($usuario,$nota,$comentario,$conexao){
        
        $query = "SELECT matricula from usuario where matricula = $usuario";
        $result = $conexao->query($query);

        if ($result->num_rows == 0){
            exit('usuario não cadastrado');
        }
        
        $query = "SELECT * FROM feedback where usuario_matricula = $usuario";
        $result = $conexao->query($query);

        if($result->num_rows == 0){
            
            exit('usuario não possui feedback');
        }

        $data_postagem = date('Y-m-d');
        $result = $query = $conexao->query("UPDATE feedback set nota = $nota, comentario = '$comentario', data_postagem = '$data_postagem' Where usuario_matricula = $usuario");
       
        if ($result){
            echo "sucesso";
        }else{
            echo "fracasso";
        }
        
        $this->nota = $nota;
        $this->comentario = $comentario;
        $this->usuario = $usuario;
        $this->data_postagem = $data_postagem;

    }
    public function fetch_feedback_usuario($usuario,$conexao){

        $query = "SELECT matricula from usuario where matricula = $usuario";
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
            $this->data_postagem = $data['data_postagem'];
            
        }
    }
    public function get_feedback_avg_nota($conexao){

        $query = "SELECT nota from feedback";
        $result = $conexao->query($query);
        
        if ($result->num_rows == 0){
            exit('nenhum feedback postado');

        }else{

            $nota_total = 0;
            $row = 0;
            while ($data = mysqli_fetch_assoc($result)){

                $nota_total += $data['nota'];
                $row++;
            }
            $nota_avg = $nota_total/$row;
            return $nota_avg;
        }
    }
    public function get_all_feedback($conexao){

        $query = "SELECT * from feedback";
        $result = $conexao->query($query);
       
        if ($result->num_rows == 0){
            exit('nenhum feedback encontrado');

        }else{

            $feedback_data = array();
            while($data = mysqli_fetch_assoc($result)){
                $feedback_data[] = $data;
            }
            return $feedback_data;
        }
    }
    public function get_feedback_by_data($data_postagem_i,$data_postagem_f,$conexao){

        if ($data_postagem_i > $data_postagem_f){
            $t = $data_postagem_f;
            $data_postagem_f = $data_postagem_i;
            $data_postagem_i = $t;
        }
        $query = "SELECT * from feedback where 1";

        if ($data_postagem_i !== null && $data_postagem_f == null){

            $query .= " AND data_postagem = '$data_postagem_i'";
        }
        if ($data_postagem_i !== null && $data_postagem_f !== null){

            $query .= " AND data_postagem >= '$data_postagem_i' && data_postagem <= '$data_postagem_f'";
        }
        if ($data_postagem_i == null & $data_postagem_f == null){
            
            $feedback = new feedback;
            $result = $feedback->get_all_feedback($conexao);
            return $result;
        }
        $result = $conexao->query($query);
        if ($result->num_rows == 0){
            exit('nenhum resultado encontrado');
        }else{

            $feedback_data = array();
            while ($data = mysqli_fetch_assoc($result)){
                $feedback_data[] = $data;
            }
            
            return $feedback_data;
        }
    }

}

?>