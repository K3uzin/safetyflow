<?php
    require_once "../Model/conexao.php";
    require_once "../controller/feedback.class.php";
    
    $feedback_check = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["nota"]) && isset($_POST["comentario"])){
            
            $nota = $_POST["nota"];
            $comentario  = $_POST["comentario"];
            $usuario = 1;
            $query = "SELECT * from feedback where usuario_matricula = $usuario";
            $result = $mysqli->query($query);
            if ($result->num_rows > 0){
                
                $feedback = new feedback;
                $feedback->update_feedback($usuario,$nota,$comentario,$mysqli);
                $feedback_check = true;
            }else{
                
                $feedback = new feedback;
                $feedback->set_feedback($nota,$comentario,$usuario,$mysqli);
            }
           
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>feedback</title>
</head>
<body>
<form method="POST" action="feedback.php">
    <label for="nota">nota</label>
    <input type="text" id="nota" name="nota"><br><br>
    
    <label for="comentario">comentario</label>
    <input type="text" id="comentario" name="comentario">
    
    <input type="submit" value="enviar">
</form>
    <?php
    if ($feedback_check){
        
        $feedback->fetch_feedback_usuario($usuario,$mysqli);
        echo "seu ultimo feedback: <br>";
        echo "nota: ".$feedback->get_nota()."<br>";
        echo "comentario: ".$feedback->get_comentario()."<br>";
        echo "data da postagem: ".$feedback->get_data_postagem()."<br>";

    }
    ?>
</body>
</html>
