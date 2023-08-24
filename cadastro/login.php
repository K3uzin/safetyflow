<?php
require 'conexao.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["matricula_or_email"]) && isset($_POST["senha"])) {
        $matricula_or_email = $_POST["matricula_or_email"];
        $senha = $_POST["senha"];

        // Consultar o banco de dados para verificar o ID ou e-mail e a senha
        $sql = "SELECT matricula FROM cadastro WHERE (matricula = ? OR email = ?) AND senha = ?";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $matricula_or_email, $matricula_or_email, $senha);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                 session_start();
                 $_SESSION["user_matricula"] = $matricula_or_email; // Armazene o ID do usuário na sessão
    
                 // Redirecionar para o formulário de desvio
                header("Location: ../formulario_desvio.php");
                exit();
                } else {
                     echo "Matrícula ou senha inválidos!";
                }

            $stmt->close();
        } else {
            echo "Erro na preparação do statement: " . $mysqli->error;
        }
    } else {
        echo "Preencha todos os campos!";
    }
}

// Fechar a conexão
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form method="POST" action="login.php">
    <label for="matricula_or_email">Matrícula ou E-mail:</label>
    <input type="text" id="matricula_or_email" name="matricula_or_email"><br><br>
    
    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha"><br><br>
    
    <input type="submit" value="Entrar">
</form>

</body>
</html>
