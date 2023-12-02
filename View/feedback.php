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
    <title>Feedback</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Public/Css/feedback.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <div class="feedback-container text-center">
                <form method="POST" action="feedback.php">
                    <div class="form-group">
                        <label for="nota" class="mb-0">Avaliação</label>
                        <div class="rating">
                        <input type="radio" id="star1" name="nota" value="1" />
                        <label for="star1" class="star">&#9733;</label>
                        <input type="radio" id="star2" name="nota" value="2" />
                        <label for="star2" class="star">&#9733;</label>
                        <input type="radio" id="star3" name="nota" value="3" />
                        <label for="star3" class="star">&#9733;</label>
                        <input type="radio" id="star4" name="nota" value="4" />
                        <label for="star4" class="star">&#9733;</label>
                        <input type="radio" id="star5" name="nota" value="5" />
                        <label for="star5" class="star">&#9733;</label>

                        </div>
                    </div>

                    <div class="form-group comentario-group">
                        <label for="comentario" class="mb-0">Comentário</label>
                        <textarea class="form-control mb-0" id="comentario" name="comentario" rows="5"></textarea>
                    </div>

                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="text-center logo-container">
                <img src="../Public/Img/logo.png" alt="Logo" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<?php
if ($feedback_check) {
    $feedback->fetch_feedback_usuario($usuario, $conexao);
    echo "Seu feedback mais recente: <br>";
    echo "Avaliação: " . $feedback->get_nota() . "<br>";
    echo "Comentário: " . $feedback->get_comentario() . "<br>";
    echo "Data de postagem: " . $feedback->get_data_postagem() . "<br>";
}
?>
<script> 
document.addEventListener("DOMContentLoaded", function() {
    const stars = document.querySelectorAll(".star");
    const notaInput = document.querySelector("input[name='nota']");

    stars.forEach((star, index) => {
        star.addEventListener("click", () => {
            // Atualize o valor do campo de entrada oculto
            notaInput.value = index + 1;

            // Remove a classe "filled" de todas as estrelas
            stars.forEach(s => s.classList.remove("filled"));

            // Marque a estrela clicada e todas as estrelas anteriores
            for (let i = 0; i <= index; i++) {
                stars[i].classList.add("filled");
            }
        });
    });
});

</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
