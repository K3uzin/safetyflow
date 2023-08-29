<?php
require 'cadastro/conexao.php'; // Verifique se o caminho está correto

session_start();

if (!isset($_SESSION["user_matricula"])) {
    // Se o usuário não estiver logado, redirecione para a página de login
    header("Location: login.php");
    exit();
}

$user_matricula = $_SESSION["user_matricula"];

// Consulta para obter o nome do usuário com base na matrícula
$sql_nome = "SELECT nome FROM cadastro WHERE matricula = ?";
$stmt_nome = $mysqli->prepare($sql_nome);

if ($stmt_nome) {
    $stmt_nome->bind_param("s", $user_matricula);
    $stmt_nome->execute();
    $stmt_nome->bind_result($nome_usuario);

    // Armazene o nome em uma variável para exibição posterior
    $stmt_nome->fetch();
    $stmt_nome->close();
} else {
    echo "Erro na preparação do statement: " . $mysqli->error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data_identificacao = $_POST["data_identificacao"];
    $turno = $_POST["turno"];
    $setor = $_POST["setor"];
    $local_desvio = $_POST["local_desvio"];
    $descricao_desvio = $_POST["descricao_desvio"];
    $tipo_desvio = $_POST["tipo_desvio"];
    $gravidade = $_POST["gravidade"];
    $area_responsavel = $_POST["area_responsavel"];

    // Realize as validações necessárias aqui

    // Verifica se o arquivo de imagem foi enviado e atende aos requisitos
    if ($_FILES["foto_desvio"]["error"] == 0) {
        $imagem_nome = $_FILES["foto_desvio"]["name"];
        $imagem_tmp = $_FILES["foto_desvio"]["tmp_name"];
        $imagem_tamanho = $_FILES["foto_desvio"]["size"];
        $imagem_tipo = $_FILES["foto_desvio"]["type"];
        $pasta_destino = 'setores/listas_setores/fotos_desvio/';

        // Verifica se o diretório de destino existe, senão cria
        if (!is_dir($pasta_destino)) {
            mkdir($pasta_destino, 0777, true);
        }

        // Verifica o tamanho máximo (8 MB) e formatos permitidos
        if ($imagem_tamanho <= 8 * 1024 * 1024) {
            $formatos_permitidos = array("image/jpeg", "image/jpg", "image/heic");
            if (in_array($imagem_tipo, $formatos_permitidos)) {
                // Move o arquivo para o diretório de destino
                move_uploaded_file($imagem_tmp, $pasta_destino . $imagem_nome);
            } else {
                echo "Formato de imagem não permitido. Apenas JPG, JPEG e HEIC são permitidos.";
            }
        } else {
            echo "Tamanho de imagem excede 8 MB.";
        }
    } else {
        $imagem_nome = null; // Define como nulo caso não haja imagem
    }

    // Inserção dos dados na tabela de Desvio, incluindo o caminho da imagem (opcional)
    $sql = "INSERT INTO tabela_desvio (user_matricula, user_nome, data_identificacao, turno, setor, local_desvio, descricao_desvio, tipo_desvio, gravidade, foto_desvio, area_responsavel) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssssssssss", $user_matricula, $nome_usuario, $data_identificacao, $turno, $setor, $local_desvio, $descricao_desvio, $tipo_desvio, $gravidade, $imagem_nome, $area_responsavel);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Cadastro de desvio realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar desvio.";
        }

        $stmt->close();
    } else {
        echo "Erro na preparação do statement: " . $mysqli->error;
    }

    // Fechamento da conexão com o banco de dados
    $mysqli->close();
} else {
    echo "O formulário não foi submetido corretamente.";
}
?>
