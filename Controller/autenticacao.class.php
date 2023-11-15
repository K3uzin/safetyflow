<?php

class Autenticacao {
    
    public static function verificarPermissaoAdmin($conexao) {
        session_start();

        if (!isset($_SESSION["matricula"])) {
            header("Location: login.php");
            exit();
        }

        $user_matricula = $_SESSION["matricula"];

        $query = "SELECT isAdmin FROM usuario WHERE matricula = $matricula";
        $result = $conexao->query($query);

        if ($result->num_rows == 1) {
            $data = mysqli_fetch_assoc($result);
            return $data['isAdmin'] == 1; // Verifica se o usuário é um administrador (isAdmin = 1)
        }

        return false;
    }
}

?>
