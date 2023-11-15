<?php
require '../Model/conexao.php'; // Verifique se o caminho está correto
require_once '../Controller/desvio.class.php';

session_start();
if (isset($_GET['id_desvio'])) {
    
    $id_desvio = $_GET['id_desvio'];

    $desvio = new desvio;
    $desvio->fetch_desvio($id_desvio,$mysqli);
            
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
        //var_dump($imagem_url);
        echo "<br>Imagem do Desvio: <br><img src='$imagem_url' alt='Imagem do desvio'>";
    }else {
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
} else {
   echo "ID do desvio não fornecido.";
}
?>
