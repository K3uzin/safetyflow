<?php
require '../../cadastro/conexao.php'; // Verifique se o caminho está correto

if (isset($_GET['id_desvio'])) {
    $id_desvio = $_GET['id_desvio'];

    // Consulta para obter os detalhes de um desvio específico com base no ID do desvio
    $sql = "SELECT * FROM desvios WHERE id_desvio = ?";
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
                $imagem_url = 'http://localhost/tcc/' . $desvio['foto_desvio'];
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
