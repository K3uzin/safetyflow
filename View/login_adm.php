<?php
require '../Model/conexao.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["matricula_admin_or_email"]) && isset($_POST["senha"])) {
        $matricula_or_email = $_POST["matricula_admin_or_email"];
        $senha = $_POST["senha"];

        // Consultar o banco de dados para verificar a matrícula_admin ou email e a senha
        $sql = "SELECT matricula_admin FROM administradores WHERE (matricula_admin = ? OR email = ?) AND senha = ?";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $matricula_or_email, $matricula_or_email, $senha);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($matricula_admin);
                $stmt->fetch();

                session_start();
                $_SESSION["admin_matricula"] = $matricula_admin; // Armazene a matrícula do administrador na sessão

                // Redirecionar para o painel de administração
                header("Location: ../formulario_desvio.php");
                exit();
            } else {
                echo "Matrícula_admin, email ou senha inválidos!";
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

<h2>Login do Administrador</h2>

<form method="POST" action="login_adm.php">
    <label for="matricula_admin_or_email">Matrícula ou E-mail:</label>
    <input type="text" id="matricula_admin_or_email" name="matricula_admin_or_email"><br><br>
    
    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha"><br><br>
    
    <input type="submit" value="Entrar">
</form>

</body>
</html>