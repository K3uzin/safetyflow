<?php

class desvio{

    desvio class{

        private $usuario_matricula;//int exat11
        private $data_identificacao;//date
        private $turno;//varchar max20
        private $setor;//int espec(1...7)
        private $local;//varchar max255
        private $descricao_desvio;//text
        private $tipo_desvio;//int espec(a ser delimitado)
        private $gravidade;//int espec(a ser delimitado)
        private $area_responsavel;//int espec(a ser delimitado)
        private $img//varchar max255
        private $status

        public function set_desvio($usuario_matricula,$data_i,$turno,$setor,$local,$descricao_desvio,$tipo_desvio,$gravidade,$area_responsavel){

            
            $user_matricula = $this->user_matricula = $user->matricula;
            $data_idententificacao = $this->data_identificacao = $data_i;
            $turno = $this->turno = $turno;
            $setor = $this->setor = $setor;
            $local = $this->local = $local;
            $descricao = $this->descricao_desvio = $descricao_desvio;
            $tipo_desvio =$this->tipo_desvio = $tipo_desvio;
            $gravidade = $this->gravidade = $gravidade;
            $area_responsavel =$this->area_responsavel = $area_responsavel;
            $img = $this->img = $img;

            $conexao->query("INSERT INTO desvio(
            usuario_matricula,
            data_identificacao,
            turno,
            setor,
            local_desvio,
            descricao_desvio,
            tipo_desvio,
            gravidade,
            area_responsavel,
            img,
            status) 
            VALUES(
            '$usuario_matricula',
            '$data_i',
            '$turno',
            '$setor',
            '$local',
            '$descricao',
            '$tipo_desvio',
            '$gravidade',
            '$area_responsavel',
            '$img')");
        }
        public function get_last_desvio_usuario($matricula){

            $query = "SELECT * from desvio where usuario_matricula = $matricula";
            $result = $conexao->query($query);
            if ($result == null){
                exit('desvio de usuario nao encontrado');
            }else{
               
                $this->usuario_matricula = $resuslt['usuario_matricula'];
                $this->data_identificacao = $result['data_identificacao'];
                $this->turno = $result['turno'];
                $this->setor = $result['setor'];
                $this->local = $result['local_desvio'];
                $this->descricao = $result['descricao'];
                $this->tipo_desvio = $result['tipo_desvio'];
                $this->gravidade = $result['gravidade'];
                $this->area_responsavel = $result['area_responsavel'];
                $this->img = $result['img'];
            }
        }
        public function get_last_desvio(){

            $query = "SELECT * from desvio where max(data_identificacao)";
            $result = $conexao->query($query);
            if ($result == null){
                exit('desvio de usuario nao encontrado');
            }else{
               
                $this->usuario_matricula = $resuslt['usuario_matricula'];
                $this->data_identificacao = $result['data_identificacao'];
                $this->turno = $result['turno'];
                $this->setor = $result['setor'];
                $this->local = $result['local_desvio'];
                $this->descricao = $result['descricao'];
                $this->tipo_desvio = $result['tipo_desvio'];
                $this->gravidade = $result['gravidade'];
                $this->area_responsavel = $result['area_responsavel'];
                $this->img = $result['img'];
            }
        }
        public function get_desvio_by_filter($turno,$setor,$tipo_desvio,$gravidade,$data_i,$data_F){

            if ($turno == null AND $setor == null AND $tipo_desvio == null AND $gravidade == null AND $data_i == null AND $data_f == null){

                $query = "SELECT * from desvio";
                $result = $conexao->query($query);
                While( $row = $result->fatch_assoc){
                
                    $this->usuario_matricula = $row['usuario_matricula'];
                    $this->data_identificacao = $row['data_identificacao'];
                    $this->turno = $row['turno'];
                    $this->setor = $row['setor'];
                    $this->local = $row['local_desvio'];
                    $this->descricao = $row['descricao'];
                    $this->tipo_desvio = $row['tipo_desvio'];
                    $this->gravidade = $row['gravidade'];
                    $this->area_responsavel = $row['area_responsavel'];
                    $this->img = $row['img'];
                }
            }
        }
    }
}