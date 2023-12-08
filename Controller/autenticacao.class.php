<?php

class Autenticacao {
    
    public static function verificarPermissaoAdmin($conexao) {
        session_start();
        //exit(var_dump($_SESSION));
        if (!isset($_SESSION["user_matricula"])) {
            header("Location: ../View/login.php");
            exit();
        }

        $user_matricula = $_SESSION["user_matricula"];

        // Utilizando prepared statement para evitar injeção de SQL
        $query = "SELECT isAdmin FROM usuario WHERE matricula = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bind_param("s", $user_matricula);
        $stmt->execute();
        $stmt->bind_result($isAdmin);

        if ($stmt->fetch()) {
            return $isAdmin == 1; // Verifica se o usuário é um administrador (isAdmin = 1)
        }

        $stmt->close();

        return false;
    }
}


?>
