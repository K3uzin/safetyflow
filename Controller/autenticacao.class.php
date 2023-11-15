<?php

class Autenticacao {
    
    public static function verificarPermissaoAdmin($conexao) {
        session_start();

        if (!isset($_SESSION["user_matricula"])) {
            header("Location: login.php");
            exit();
        }

        $user_matricula = $_SESSION["user_matricula"];

        $query = "SELECT isAdmin FROM usuario WHERE matricula = $user_matricula";
        $result = $conexao->query($query);

        if ($result->num_rows == 1) {
            $data = mysqli_fetch_assoc($result);
            return $data['isAdmin'] == 1; // Verifica se o usuário é um administrador (isAdmin = 1)
        }

        return false;
    }
}

?>
