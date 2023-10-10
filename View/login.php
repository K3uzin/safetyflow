<?php
require '../Model/conexao.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["matricula_or_email"]) && isset($_POST["senha"])) {
        $matricula_or_email = $_POST["matricula_or_email"];
        $senha = $_POST["senha"];

        // Consultar o banco de dados para verificar o ID ou e-mail e a senha
        $sql = "SELECT matricula FROM usuario WHERE (matricula = ? OR email = ?) AND senha = ?";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $matricula_or_email, $matricula_or_email, $senha);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                 session_start();
                 $_SESSION["user_matricula"] = $matricula_or_email; // Armazene o ID do usuário na sessão
    
                 // Redirecionar para o formulário de desvio
                header("Location: formulario_desvio.php");
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

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Acessar desvios</title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="bootstrap/css/sign-in.css">
    <link rel="icon" href="img/logo.ico" type="image/x-icon">
</head>

<body class="text-center">
    <main class="form-signin">
        <form method="POST" action="login.php">
            <img class="mb-4" src="img/logo.png" alt="" width="150" height="150">
            <h1 class="h3 mb-3 fw-normal">Acessar conta</h1>

            <label for="matricula_or_email" class="visually-hidden">Matrícula ou E-mail</label>
            <input type="text" id="matricula_or_email" name="matricula_or_email" class="form-control" placeholder="Matrícula ou E-mail" required="" autofocus="">

            <label for="senha" class="visually-hidden">Senha</label>
            <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required="">

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Manter-me conectado
                </label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit"
                style="background-color: #003884;">Acessar</button>

            <p class="mt-5 mb-3 text-muted">&copy; 2023</p>
        </form>

    </main>
    <!-- Scripts -->
    <script src="assets/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script>
        // Função que executa após o carregamento do DOM
        document.addEventListener("DOMContentLoaded", function () {
            // Captura o input da matrícula
            const matriculaInput = document.getElementById("matricula_or_email");

            // Event listener para cada vez que o valor do input for alterado
            matriculaInput.addEventListener("input", function () {
                // Remove tudo exceto dígitos do valor do input
                const value = matriculaInput.value.replace(/[^\d]/g, "");
            });
        });
    </script>
</body>

</html>
