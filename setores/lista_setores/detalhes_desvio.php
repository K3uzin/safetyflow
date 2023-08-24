<?php
require '../../cadastro/conexao.php'; // Verifique se o caminho está correto

if (isset($_GET['id'])) {
    $id_desvio = $_GET['id'];

    // Consulta para obter os detalhes do desvio com base no ID
    $sql = "SELECT * FROM tabela_desvio WHERE id_desvio = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id_desvio);
        $stmt->execute();
        $result = $stmt->get_result();
        $desvio = $result->fetch_assoc();

        // Exibir os detalhes do desvio
        if ($desvio) {
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
            echo "<br>Observações: " . $desvio['observacoes'];
            // Exibir mais campos conforme necessário
        } else {
            echo "Desvio não encontrado.";
        }

        $stmt->close();
    } else {
        echo "Erro na preparação do statement: " . $mysqli->error;
    }

    $mysqli->close();
} else {
    echo "ID do desvio não fornecido.";
}
?>
