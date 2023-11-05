<?php
require '../Model/conexao.php'; // Verifique se o caminho está correto
require_once '../Controller/desvio.class.php';

session_start();
if (isset($_GET['id_desvio'])) {
    $id_desvio = $_GET['id_desvio'];

    $desvio = new desvio;
    $desvio->fetch_desvio($id_desvio,$mysqli);
    // Consulta para obter os detalhes de um desvio específico com base no ID do desvio
    /*$sql = "SELECT d.id_desvio, d.data_identificacao, d.turno, d.local_desvio, d.descricao_desvio, d.foto_desvio, td.descricao AS tipo_desvio, g.descricao AS gravidade, s.nome_setor AS setor, u.matricula AS user_matricula, u.nome AS user_nome
            FROM desvio d
            INNER JOIN tipo_desvio td ON d.tipo_desvio_idtipo_desvio = td.idtipo_desvio
            INNER JOIN gravidade g ON d.gravidade_idgravidade = g.idgravidade
            INNER JOIN setor s ON d.setor_id_setor = s.id_setor
            INNER JOIN usuario u ON d.usuario_matricula = u.matricula
            WHERE d.id_desvio = ?";*/
    
    /*$stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id_desvio);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifique se há um desvio para exibir
        if ($result->num_rows > 0) {
            $desvio = $result->fetch_assoc();*/
            
            echo "Detalhes do Desvio:";
            //echo "<br>ID: " . $desvio['id_desvio'];
            echo "<br>Matrícula do Usuário: " . $desvio->get_usuario_matricula();
            echo "<br>Nome do Usuário: " . $desvio->get_usuario_nome();
            echo "<br>Data de Identificação: " . $desvio->get_data_identificacao();
            echo "<br>Turno: " . $desvio->get_turno();
            echo "<br>Setor: " . $desvio->get_setor();
            echo "<br>Local do Desvio: " . $desvio->get_local();
            echo "<br>Descrição do Desvio: " . $desvio->get_descricao();
            echo "<br>Tipo de Desvio: " . $desvio->get_tipo_desvio();
            echo "<br>Gravidade: " . $desvio->get_gravidade();

            $img = $desvio->get_img();
            // Exibir a imagem, se existir
        if ($img != null) {
            $imagem_url = 'http://localhost/safetyflow/Desvio/' . basename($desvio->get_img());
            var_dump($imagem_url);
            echo "<br>Imagem do Desvio: <br><img src='$imagem_url' alt='Imagem do desvio'>";
        } else {
            echo "<br>Imagem do Desvio: Nenhuma imagem disponível";
        }
        $query = "SELECT idresolucao,id_desvio from resolucao where id_desvio = $id_desvio ";
        $result = $mysqli->query($query);
        if($result->num_rows == 0){
            echo "<a href = 'resolucao_desvio.php'>";
            $_SESSION['desvio_selecionado'] = $id_desvio;
            echo "<br><button>atribuir resolucão</button>";
            echo "</a>";
        }else{
            $data = mysqli_fetch_assoc($result);
            $resolucao_id = $data['idresolucao'];
            echo "<a href = 'resolucao_desvio.php'>";
            $_SESSION['resolucao_selecionada'] = $resolucao_id;
            $_SESSION['desvio_selecionado'] = $id_desvio;
            echo "<br><button>editar resolucão</button>";
            echo "</a>";
        }
        // Feche o statement
       /* $stmt->close();
    } else {
        echo "Erro na preparação do statement: " . $mysqli->error;
    }*/

    $mysqli->close();
//} else {
   //echo "ID do desvio não fornecido.";
}
?>
