<?php

class desvio{

    
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

    // função responsavel por da set em novos desvios, os armazenado diretamente no banco de dados.
    public function set_desvio($usuario_matricula,$turno,$setor,$local,$descricao_desvio,$tipo_desvio,$gravidade,$area_responsavel,$img,$conexao){

        $query = "SELECT matricula from usuario where matricula = '$usuario_matricula'";
        $result = $conexao->query($query);
        if($result->num_rows == 0){

            exit('usuario nao cadastrado');
        }
        $query = "SELECT id_setor from setor where id_setor = '$setor'";
        $result = $conexao->query($query);
        if($result->num_rows == 0){
            
            exit('setor invalido');
        }
        $query = "SELECT idtipo_desvio from tipo_desvio where idtipo_desvio = '$tipo_desvio'";
        $result = $conexao->query($query);
        if($result->num_rows == 0){

            exit('tipo de descio invalido');
        }
        $query = "SELECT idgravidade from gravidade where idgravidade = '$gravidade'";
        $result = $conexao->query($query);
        if($result->num_rows == 0){

            exit('gravidade do desvio invalida');
        } 
        
        $data_i = date('Y-m-d');

        $this->usuario_matricula = $usuario_matricula;
        $this->data_identificacao = $data_i;
        $this->turno = $turno;
        $this->setor = $setor;
        $this->local = $local;
        $this->descricao_desvio = $descricao_desvio;
        $this->tipo_desvio = $tipo_desvio;
        $this->gravidade = $gravidade;
        $this->area_responsavel = $area_responsavel;
        $this->img = $img;

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
        foto_desvio) 
        VALUES(
        '$usuario_matricula',
        '$data_i',
        '$turno',
        '$setor',
        '$local',
        '$descricao_desvio',
        '$tipo_desvio',
        '$gravidade',
        '$area_responsavel',
        '$img')");

        
        $query = "SELECT nome,email from usuario where area_responsavel = '$area_responsavel'";
        $result = $conexao->query($query);
        if ($result->num_rows == 0){
            exit('não a responsavel na area selecionada');
        }else{
            $R_email = array();
            while($data = mysqli_fetch_assoc($result)){
                $R_data = $data;
            }
            $query = "SELECT nome_area from area_responsavel where id_responsavel = $area_responsavel";
            $result = $conexao->query($query);
            $data = mysqli_fetch_assoc($result);
            $nome_area = $data['nome_area'];

            foreach($R_data as $responaveis){
                $email = $responsaveis['email'];
                $nome = $responaveis['nome'];
                $assunto = "novo desvio na area".$nome_area;
                $mensagem = 'olá gestor'.$nome.'novo desvio criado na area '.$nome_area;
                $headers = 'from: safetyflow@gmail.com '."\r\n".'no-reply';
                mail($email,$assunto,$mensagem,$headers);
            }
        }
    }
    //função responsavel por extrair o conteudo do atributo usuario_matricula da classe de desvio.
    public function get_usuario_matricula(){
        return $this->usuario_matricula;
    }
    public function get_usuario_nome(){
        return $this->get_usuario_nome;
    }
    //função responsavel por extrair o conteudo do atributo data_identificação da classe de desvio.
    public function get_data_identificacao(){
        return $this->data_identificacao;
    }
    //função responsavel por extrair o conteudo do atributo turno da classe de desvio.
    public function get_turno(){
        return $this->turno;
    }
    //função responsavel por extrair o conteudo do atributo setor da classe de desvio.
    public function get_setor(){
        return $this->setor;
    }
    //função responsavel por extrair o conteudo do atributo local da classe de desvio.
    public function get_local(){
        return $this->local;
    }
    //função responsavel por extrair o conteudo do atributo descricao da classe de desvio.
    public function get_descricao(){
        return $this->descricao;
    }
    //função responsavel por extrair o conteudo do atributo tipo_desvio da classe de desvio.
    public function get_tipo_desvio(){
        return $this->tipo_desvio;
    }
    //função responsavel por extrair o conteudo do atributo gravidade da classe de desvio.
    public function get_gravidade(){
        return $this->gravidade;
    }
    //função responsavel por extrair o conteudo do atributo area_responsavel da classe de desvio.
    public function get_area_responsavel(){
        return $this->area_responsavel;
    }
    //função responsavel por extrair o conteudo do atributo img da classe de desvio.
    public function get_img(){
        return $this->img;
    }
    //função responsavel por da fetch no banco de dados e trazer o ultimo desvio feito por um determinado usuario, 
    //sendo somente necessario uma matricula de um usuario valido e a conexão com o banco de dados.
    public function fetch_last_desvio_usuario($matricula,$conexao){

        $query = "SELECT matricula from usuario where matricula = '$matricula'";
        $result = $conexao->query($query);

        if ($result->num_rows == 0 ){
            exit('usuario inexistente');
        }
       
        $query = "SELECT * from desvio 
        where usuario_matricula = $matricula and data_identificacao = (SELECT MAX(data_identificacao) from desvio where usuario_matricula = $matricula)";
        $result = $conexao->query($query);

        if ($result->num_rows == 0){
            exit('nenhun desvio encontrado');
        }else{
            
            $data = mysqli_fetch_assoc($result);
            $this->usuario_matricula = $data['usuario_matricula'];
            $this->data_identificacao = $data['data_identificacao'];
            $this->turno = $data['turno'];
            $this->local = $data['local_desvio'];
            $this->descricao = $data['descricao_desvio'];

            $nome_id = $data['usuario_matricula'];
            $query = "SELECT nome from usuario where matricula = $nome_id";
            $result = $conexao->query($query);
            $nome = mysqli_fetch_assoc($result);
            $this->get_usuario_nome = $nome['nome'];

            $setor_id = $data['setor'];
            $query ="SELECT nome_setor from setor where id_setor = $setor_id";
            $result = $conexao->query($query);
            $setor_nome = mysqli_fetch_assoc($result);
            $this->setor = $setor_nome;

            $tipo_desvio_id = $data['tipo_desvio'];
            $query ="SELECT nome_setor from tipo_desvio where idtipo_desvio = $tipo_desvio_id";
            $result = $conexao->query($query);
            $tipo_desvio = mysqli_fetch_assoc($result);
            $this->tipo_desvio = $tipo_desvio;

            $gravidade_id = $data['gravidade'];
            $query ="SELECT descricao from gravidade where idgravidade = $gravidade_id";
            $result = $conexao->query($query);
            $gravidade = mysqli_fetch_assoc($result);
            $this->gravidade = $gravidade;

            $area_id = $data['area_responsavel'];
            $query ="SELECT nome_area from area_responsavel where id_area = $area_id";
            $result = $conexao->query($query);
            $area_nome = mysqli_fetch_assoc($result);
            $this->area_responsavel = $area_nome['nome_area'];

            $this->img = $data['foto_desvio'];
        }
    }
    //função responavel por da fetch no devio mais recente, precisando somente da conexão com o banco para funcionar
    public function fetch_last_desvio($conexao){

        $query = "SELECT * from desvio where data_identificacao = (SELECT max(data_identificacao) from desvio)";
        $result = $conexao->query($query);

        if ($result->num_rows == 0){
            exit('nenhum desvio encontrado');
        }else{
            
            $data = mysqli_fetch_assoc($result);
            $this->usuario_matricula = $data['usuario_matricula'];
            $this->data_identificacao = $data['data_identificacao'];
            $this->turno = $data['turno'];
            $this->local = $data['local_desvio'];
            $this->descricao = $data['descricao_desvio'];

            $nome_id = $data['usuario_matricula'];
            $query = "SELECT nome from usuario where matricula = $nome_id";
            $result = $conexao->query($query);
            $nome = mysqli_fetch_assoc($result);
            $this->get_usuario_nome = $nome['nome'];

            $setor_id = $data['setor'];
            $query ="SELECT nome_setor from setor where id_setor = $setor_id";
            $result = $conexao->query($query);
            $setor_nome = mysqli_fetch_assoc($result);
            $this->setor = $setor_nome;

            $tipo_desvio_id = $data['tipo_desvio'];
            $query ="SELECT nome_setor from tipo_desvio where idtipo_desvio = $tipo_desvio_id";
            $result = $conexao->query($query);
            $tipo_desvio = mysqli_fetch_assoc($result);
            $this->tipo_desvio = $tipo_desvio;

            $gravidade_id = $data['gravidade'];
            $query ="SELECT descricao from gravidade where idgravidade = $gravidade_id";
            $result = $conexao->query($query);
            $gravidade = mysqli_fetch_assoc($result);
            $this->gravidade = $gravidade;

            $area_id = $data['area_responsavel'];
            $query ="SELECT nome_area from area_responsavel where id_area = $area_id";
            $result = $conexao->query($query);
            $area_nome = mysqli_fetch_assoc($result);
            $this->area_responsavel = $area_nome['nome_area'];

            $this->img = $data['foto_desvio'];
        }
    }
    //função não testada
    public function fetch_last_desvio_setor($setor,$conexao){
    $query = "SELECT * from desvio where data_identificacao = (SELECT max(data_identificacao) from desvio where setor = $setor order by id_desvio asc)";
        $result = $conexao->query($query);

        if ($result->num_rows == 0){
            exit('nenhum desvio encontrado');
        }else{
             
            $data = mysqli_fetch_assoc($result);
            $this->usuario_matricula = $data['usuario_matricula'];
            $this->data_identificacao = $data['data_identificacao'];
            $this->turno = $data['turno'];
            $this->local = $data['local_desvio'];
            $this->descricao = $data['descricao_desvio'];

            $nome_id = $data['usuario_matricula'];
            $query = "SELECT nome from usuario where matricula = $nome_id";
            $result = $conexao->query($query);
            $nome = mysqli_fetch_assoc($result);
            $this->get_usuario_nome = $nome['nome'];

            $setor_id = $data['setor'];
            $query ="SELECT nome_setor from setor where id_setor = $setor_id";
            $result = $conexao->query($query);
            $setor_nome = mysqli_fetch_assoc($result);
            $this->setor = $setor_nome;

            $tipo_desvio_id = $data['tipo_desvio'];
            $query ="SELECT nome_setor from tipo_desvio where idtipo_desvio = $tipo_desvio_id";
            $result = $conexao->query($query);
            $tipo_desvio = mysqli_fetch_assoc($result);
            $this->tipo_desvio = $tipo_desvio;

            $gravidade_id = $data['gravidade'];
            $query ="SELECT descricao from gravidade where idgravidade = $gravidade_id";
            $result = $conexao->query($query);
            $gravidade = mysqli_fetch_assoc($result);
            $this->gravidade = $gravidade;

            $area_id = $data['area_responsavel'];
            $query ="SELECT nome_area from area_responsavel where id_area = $area_id";
            $result = $conexao->query($query);
            $area_nome = mysqli_fetch_assoc($result);
            $this->area_responsavel = $area_nome['nome_area'];

            $this->img = $data['foto_desvio'];
        }
    }
    public function count_desvio_from_setor($setor,$conexao){
       $query = "SELECT COUNT(*) AS total_desvios FROM desvio WHERE setor = $setor";
       $result = $conexao->query($query);
       if ($result->num_rows == 0){

            return "0";
       }else{
            $data = mysqli_fetch_assoc($result);
            $count = $data['total_desvios'];
            if ($count === 0){
                $query = "SELECT nome_setor from setor where id_setor = $setor";
                $result = $conexao->query($query);
                
                $data = mysqli_fetch_assoc($result);
                $setor_nome = $data['nome_setor'];
                $count = "nenhum desvio encontrado no setor ".$setor_nome;

                return $count;
            }else{
                return $count;
            }
           
        }
    }
    public function fetch_desvio($id_desvio,$conexao){

        $query = "SELECT * from desvio where id_desvio = $id_desvio";
        $result = $conexao->query($query);

        if ($result->num_rows == 0){
            exit('nenhum desvio encontrado');
        }else{
             
            $data = mysqli_fetch_assoc($result);
            $this->usuario_matricula = $data['usuario_matricula'];
            $this->data_identificacao = $data['data_identificacao'];
            $this->turno = $data['turno'];
            $this->local = $data['local_desvio'];
            $this->descricao = $data['descricao_desvio'];

            $nome_id = $data['usuario_matricula'];
            $query = "SELECT nome from usuario where matricula = $nome_id";
            $result = $conexao->query($query);
            $nome = mysqli_fetch_assoc($result);
            $this->get_usuario_nome = $nome['nome'];

            $setor_id = $data['setor'];
            $query ="SELECT nome_setor from setor where id_setor = $setor_id";
            $result = $conexao->query($query);
            $setor_nome = mysqli_fetch_assoc($result);
            $this->setor = $setor_nome['nome_setor'];

            $tipo_desvio_id = $data['tipo_desvio'];
            $query ="SELECT descricao from tipo_desvio where idtipo_desvio = $tipo_desvio_id";
            $result = $conexao->query($query);
            $tipo_desvio = mysqli_fetch_assoc($result);
            $this->tipo_desvio = $tipo_desvio['descricao'];

            $gravidade_id = $data['gravidade'];
            $query ="SELECT descricao from gravidade where idgravidade = $gravidade_id";
            $result = $conexao->query($query);
            $gravidade = mysqli_fetch_assoc($result);
            $this->gravidade = $gravidade['descricao'];

            $area_id = $data['area_responsavel'];
            $query ="SELECT * from area_responsavel where id_area = $area_id";
            $result = $conexao->query($query);
            $area = mysqli_fetch_assoc($result);
            $this->area_responsavel = $area['nome_area'];

            $this->img = $data['foto_desvio'];
           
        }
    }
    // função responsavel em dar fetch em TODOS os devios dentro do espectro do filtro,
    // os armazenandos dentro de um array e retornado o mesmo, para que seu conteudo possa ser manipulado .
    public function fetch_desvio_by_filter($turno,$setor,$tipo_desvio,$gravidade,$data_i,$data_f,$order,$conexao){
      
        $query = "SELECT * from desvio where 1";
        if($turno !== null){
            $query .= " AND turno = '$turno'";
        }
        if($setor !== null){
            $query .= " AND setor = '$setor'";
        }
        if($tipo_desvio !== null){
            $query .= " AND tipo_desvio = '$tipo_desvio'";
        }
        if($gravidade !== null){
            $query .= " AND gravidade = '$gravidade'";
        }
        if($data_i !== null && $data_f == null){
            $query .= " AND data_identificacao = '$data_i'";
        }
        if($data_i !== null && $data_f !== null){
            $query .= " AND data_identificacao >= '$data_i' AND data_identificacao <= '$data_f'";
        }
        if( $order == 1){
            $query .= " ORDER BY gravidade ASC";
        }
        if($order == -1){
            $query .= " ORDER BY gravidade DESC";
        }
        if($order == 2){
            $query .= " ORDER BY data_identificacao ASC";
        }
        if($order == -2){
            $query .= " ORDER BY data_identificacao DESC";
        }
        $result = $conexao->query($query);
        if ($result && $result->num_rows > 0) {
            
            $desvio_data = array();
    
            while ($data = mysqli_fetch_assoc($result)) {
                $setorResult = $conexao->query("SELECT nome_setor from setor where id_setor = {$data['setor']}");
                $tipoDesvioResult = $conexao->query("SELECT descricao from tipo_desvio where idtipo_desvio = {$data['tipo_desvio']}");
                $gravidadeResult = $conexao->query("SELECT descricao from gravidade where idgravidade = {$data['gravidade']}");
                $areaResponsavelResult = $conexao->query("SELECT nome_area from area_responsavel where id_area = {$data['area_responsavel']}");
            
                $setor = $setorResult->fetch_assoc()['nome_setor'];
                $tipoDesvio = $tipoDesvioResult->fetch_assoc()['descricao'];
                $gravidade = $gravidadeResult->fetch_assoc()['descricao'];
                $areaResponsavel = $areaResponsavelResult->fetch_assoc()['nome_area'];
            
                $data['setor'] = $setor;
                $data['tipo_desvio'] = $tipoDesvio;
                $data['gravidade'] = $gravidade;
                $data['area_responsavel'] = $areaResponsavel;
                $desvio_data[] = $data;
            }
            
            return $desvio_data;
            }
            
     
    }
}
