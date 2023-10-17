<?php

class resolucao{

    private $id_resolucao
    private $status;//int espc (1 or 2)
    private $descricao;//varchar max 255
    private $acoes;//varchar max 255
    private $usuario;//int max 11
    private $data_resolucao; //date
    private $desvio;//int max 11
    private $area_responsavel;//int max 11
    
    public function set_resolucao($usuario,$desvio,$area_responsavel,$conexao){
    
        $query = "SELECT matricula from usuario where matricula = $usuario";
        $result = $conexao->query($query);
        if ($result->num_rows == 0){
    
            exit('usuario não cadastrado');
        }
        $query = "SELECT id_desvio from desvio where id_desvio = $desvio";
        $result = $conexao->query($query);
        if ($result->num_rows == 0){
    
            exit('desvio nao existe');
        }
        $query = "SELECT id_area from area_responsavel where id_area = $area_responsavel";
        $result = $conexao->query($query);
        if ($result->num_rows == 0){
    
            exit('area responsavel inexistente');
        }
        $status = 1;
        $query = "SELECT descricao_desvio from desvio where id_desvio = $desvio";
        $result = $conexao->query($query);
        $data = mysqli_fetch_assoc($result);
        $descricao = $data['descricao_desvio'];
        $acoes = 'a ser decidido';
        $data_resolucao = '3000-01-01';
        echo "usuario: $usuario, desvio: $desvio, area_responsavel: $area_responsavel";
    
        $query = $conexao->prepare("INSERT INTO resolucao(status,descricao,acoes,data_resolucao,usuario_matricula,id_desvio,id_area_r)
        VALUES (?,?,?,?,?,?,?)");
        $query->bind_param("isssiii",$status,$descricao,$acoes,$data_resolucao,$usuario,$desvio,$area_responsavel);
        $query->execute();
    
        /*$query = "INSERT INTO resolucao(status,descricao,acoes,data_resolucao,usuario_matricula,id_desvio,id_area_r)
        VALUES ($status,'$descricao','$acoes','$data_resolucao',$usuario,$desvio,$area_responsavel)";
        $conexao->query($query);*/
    
        }
    }
    public function get_all_resolucao($conexao){

        $query = "SELECT * from resolucao";
        $result = $conexao->query($query);
        if ($result->num_rows == 0){
            exit('nenhum resolucao encontrada')
        }
        
        $resolucao_data = array();
        while ($data = mysqli_fetch_assoc($result)){
            $resolucao_data[] = $data;
        }

        return $resolucao_data; 

    }
    public function fetch_resolucao($resolucao,$conexao){

        $query = "SELECT * from resolucao where id_resolucao = $resolucao";
        $result = $conexao->query($query);
        if ($result->num_rows == 0){
            exit('nenhum resolucao encontrada')
        }

        $data = mysqli_fetch_assoc($result);
        $this->id_resolucao = $data['id_resolucao'];
        $this->status = $data['status'];
        $this->acoes = $data['acoes'];
        $this->descricao = $data['descricao'];
        $this->data_resolucao = $data['data_resoluco'];
        $this->usuario = $data['usuario_matricula'];
        $this->desvio = $data['id_desvio'];
        $this->area_responsasavel['id_area_r'];
       

    }
    public function get_id(){
        return $this->id_resolucao;
    }
    public function get_status(){
        return $this->status;
    }
    public function get_acoes(){
        return $this->acoes;
    }
    public function get_descricao(){
        return $this->decricao;
    }
    public function get_data_resolucao(){
        return $this->data_resolucao;
    }
    public function get_usuario(){
        return $this->usuario;
    }
    public function get_desvio(){
        return $this->desvio;
    }
    public function get_area_responsavel(){
        return $this->area_responsavel;
    }


?>