<?php
require 'cadastro/conexao.php';

session_start();

if (!isset($_SESSION["user_matricula"])) {
    header("Location: login.php");
    exit();
}

$user_matricula = $_SESSION["user_matricula"];

$sql_nome = "SELECT nome FROM usuario WHERE matricula = ?";
$stmt_nome = $mysqli->prepare($sql_nome);

if ($stmt_nome) {
    $stmt_nome->bind_param("s", $user_matricula);
    $stmt_nome->execute();
    $stmt_nome->bind_result($nome_usuario);
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

    $imagem_url = null; // Inicializa a variável para o URL da imagem

    // Verifica se o arquivo de imagem foi enviado e atende aos requisitos
    if ($_FILES["foto_desvio"]["error"] == 0) {
        $imagem_tmp = $_FILES["foto_desvio"]["tmp_name"];
        $imagem_tipo = $_FILES["foto_desvio"]["type"];
        $pasta_destino = 'setores/lista_setores/fotos_desvio'; // Diretório acessível pelo servidor
    
        // Verifica o tamanho máximo (8 MB) e formatos permitidos
        if ($_FILES["foto_desvio"]["size"] <= 8 * 1024 * 1024) {
            $formatos_permitidos = array("image/jpeg", "image/jpg", "image/heic");
            if (in_array($imagem_tipo, $formatos_permitidos)) {
                // Gere um nome de arquivo único baseado no horário atual
                $nome_unico = time() . '.' . pathinfo($_FILES["foto_desvio"]["name"], PATHINFO_EXTENSION);
    
                // Move o arquivo para o diretório de destino com o novo nome
                move_uploaded_file($imagem_tmp, $pasta_destino . '/' . $nome_unico);
    
                // URL da imagem no servidor
                $imagem_url = $pasta_destino . '/' . $nome_unico;
            } else {
                echo "Formato de imagem não permitido. Apenas JPG, JPEG e HEIC são permitidos.";
            }
        } else {
            echo "Tamanho de imagem excede 8 MB.";
        }
    }
    

    // Inserção dos dados em Desvio, incluindo o URL da imagem
    $sql = "INSERT INTO desvios (user_matricula, user_nome, data_identificacao, turno, setor, local_desvio, descricao_desvio, tipo_desvio, gravidade, foto_desvio, area_responsavel) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssssssssss", $user_matricula, $nome_usuario, $data_identificacao, $turno, $setor, $local_desvio, $descricao_desvio, $tipo_desvio, $gravidade, $imagem_url, $area_responsavel);
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