<?php
require '../Model/conexao.php'; // Verifique se o caminho está correto

if (isset($_GET['id_desvio'])) {
    $id_desvio = $_GET['id_desvio'];

    // Consulta para obter os detalhes de um desvio específico com base no ID do desvio
    $sql = "SELECT d.id_desvio, d.data_identificacao, d.turno, d.local_desvio, d.descricao_desvio, d.foto_desvio, td.descricao AS tipo_desvio, g.descricao AS gravidade, s.nome_setor AS setor, u.matricula AS user_matricula, u.nome AS user_nome
            FROM desvio d
            INNER JOIN tipo_desvio td ON d.tipo_desvio_idtipo_desvio = td.idtipo_desvio
            INNER JOIN gravidade g ON d.gravidade_idgravidade = g.idgravidade
            INNER JOIN setor s ON d.setor_id_setor = s.id_setor
            INNER JOIN usuario u ON d.usuario_matricula = u.matricula
            WHERE d.id_desvio = ?";
    
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id_desvio);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifique se há um desvio para exibir
        if ($result->num_rows > 0) {
            $desvio = $result->fetch_assoc();
            
            echo "Detalhes do Desvio:";
            echo "<br>ID: " . $desvio['id_desvio'];
            echo "<br>Matrícula do Usuário: " . $desvio['user_matricula'];
            echo "<br>Nome do Usuário: " . $desvio['user_nome'];
            echo "<br>Data de Identificação: " . $desvio['data_identificacao'];
            echo "<br>Turno: " . $desvio['turno'];
            echo "<br>Setor: " . $desvio['setor'];
            echo "<br>Local do Desvio: " . $desvio['local_desvio'];
            echo "<br>Descrição do Desvio: " . $desvio['descricao_desvio'];
            echo "<br>Tipo de Desvio: " . $desvio['tipo_desvio'];
            echo "<br>Gravidade: " . $desvio['gravidade'];

            // Exibir a imagem, se existir
        if ($desvio['foto_desvio']) {
            $imagem_url = 'http://localhost/safetyflow/Public/Img/desvio/' . basename($desvio['foto_desvio']);
            echo "<br>Imagem do Desvio: <br><img src='$imagem_url' alt='Imagem do desvio'>";
        } else {
            echo "<br>Imagem do Desvio: Nenhuma imagem disponível";
        }
        } else {
            echo "Nenhum desvio encontrado com o ID fornecido.";
        }

        // Feche o statement
        $stmt->close();
    } else {
        echo "Erro na preparação do statement: " . $mysqli->error;
    }

    $mysqli->close();
} else {
    echo "ID do desvio não fornecido.";
}
?>
