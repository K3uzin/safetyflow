<?php

class resolucao{

    private $status;//int espc (1 or 2)
    private $descricao;//varchar max 255
    private $acoes;//varchar max 255
    private $usuario;//int max 11
    private $desvio;//int max 11
    private $area_responsavel;//int max 11

    public function set_resolucao($usuario,$desvio,$area_responsavel,$conexao){

        $query = "SELECT setor from usuario where matricula = $usuario";
        $result = $conexao->query($query);
        
        if($result->num_rows == 0){
            exit('usuario nao cadastrado');
        }
        $data = mysqli_fetch_assoc($result);
        $usuario_setor = $data;

        $query = "SELECT descricao_desvio,tipo_desvio,gravidade,area_responsavel,setor,usuario_matricula from desvio where id_desvio = $desvio";
        $result = $conexao->query($query);
        
        if($result->num_rows == 0){
            exit('desvio nao encontrado');
        }
        $data = mysqli_fetch_assoc($result);
        $desvio_descricao = $data['descricao_desvio'];
        $desvio_tipo_desvio = $data['tipo_desvio'];
        $desvio_gravidade = $data['gravidade'];
        $desvio_area_responsavel = $data['area_responsavel'];
        $desvio_setor = $data['setor'];
        $desvio_usuario_matricula = $data['usuario_matricula'];
        $status = 1;
        $acoes = 'a ser decidido';
        $data_resolusao = '3000-01-01';
        $query = $conexao->prepare("INSERT INTO resolucao
        (status, descricao, acoes, data_resolucao, usuario_matricula,
        usuario_setor, id_desvio, desvio_tipo_desvio, desvio_gravidade, desvio_area_r, desvio_setor,
        desvio_usuario_matricula, id_area_r) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $query->bind_param("isssiiiiiiiii", $status, $desvio_descricao, $acoes, $data_resolusao, $usuario,
        $usuario_setor, $desvio, $desvio_tipo_desvio, $desvio_gravidade, $desvio_area_responsavel,
        $desvio_setor, $desvio_usuario_matricula, $area_responsavel);

        $query->execute();

    }
}

?>