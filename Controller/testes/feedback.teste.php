
<?php
require_once '../feedback.class.php';

class FeedbackTest {

    private $funcao;
    private $cenario;
    private $status_banco;

    public function set_feedback($conexao, $cenario) {
        // Cenario de sucesso
        if ($cenario == 0) {
            $this->funcao = 'set_feedback';
            $this->cenario = $cenario;
            echo "<br><br> Cenario de sucesso da função set_feedback. O cenario<br> 
                é considerado um sucesso completo se houver a inserção correta dos dados <br>
                no banco de dados e não seja detectado nenhum erro ou warning durante a execução da função<br><br>";
            $feedback = new Feedback;
            $nota = 5;
            $comentario = 'muito bom servico';
            $usuario = 1;
            $feedback->set_feedback($nota, $comentario, $usuario, $conexao);
            var_dump($feedback);
            
            $this->status_banco = 'inserção bem sucedida';
        }
        // Cenario de fracasso (usuario nao cadastrado)
        if ($cenario == 1) {
            $this->funcao = 'set_feedback';
            $this->cenario = $cenario;
            echo "Cenario de fracasso da função set_feedback. Este cenario será considerado um sucesso<br>
                caso durante sua execução ocorra a interrupção do mesmo, pelo fato do usuario informado não ser valido<br>
                ou não estar presente no banco de dados<br><br>";
            $feedback = new Feedback;
            $nota = 5;
            $comentario = null;
            $usuario = 10;
            $feedback->set_feedback($nota, $comentario, $usuario, $conexao);
            
            $this->status_banco = 'não relevante';
        }
    }

    public function update_feedback($conexao, $cenario) {
        // Cenario de sucesso
        if ($cenario == 0) {
            $this->funcao = 'update_feedback';
            $this->cenario = $cenario;
            echo "<br><br> Cenario de sucesso da função update_feedback. O cenario<br> 
                é considerado um sucesso completo se houver a atualização correta dos dados <br>
                no banco de dados e não seja detectado nenhum erro ou warning durante a execução da função<br><br>";
            $feedback = new Feedback;
            $nota = 3;
            $comentario = 'serviço ok';
            $usuario = 1;
            $feedback->update_feedback($usuario, $nota, $comentario, $conexao);
            var_dump($feedback);
            
            $this->status_banco = 'atualização bem sucedida';
        }
        // Cenario de fracasso (usuario não castrado)
        if ($cenario == 1) {
            $this->funcao = 'update_feedback';
            $this->cenario = $cenario;
            echo "Cenario de fracasso da função update_feedback. Este cenario será considerado um sucesso<br>
                caso durante sua execução ocorra a interrupção do mesmo, pelo fato do usuario informado não ser valido<br>
                ou não ter dado feedback ainda<br><br>";
            $feedback = new Feedback;
            $nota = 5;
            $comentario = 'premiun';
            $usuario = 100;
            $feedback->update_feedback($usuario, $nota, $comentario, $conexao);
            var_dump($feedback);
            
            $this->status_banco = 'não relevante';
        }
        // Cenario de fracasso (usuario não deu feedback ainda)
        if ($cenario == 2) {
            $this->funcao = 'update_feedback';
            $this->cenario = $cenario;
            echo "Cenario de fracasso da função update_feedback. Este cenario será considerado um sucesso<br>
                caso durante sua execução ocorra a interrupção do mesmo, pelo fato do usuario não ter dado feedback ainda<br><br>";
            $feedback = new Feedback;
            $nota = 5;
            $comentario = 'premiun';
            $usuario = 2;
            $feedback->update_feedback($usuario, $nota, $comentario, $conexao);
            var_dump($feedback);
            
            $this->status_banco = 'não relevante';
        }
    }

    public function fetch_feedback_usuario($conexao, $cenario) {
        // Cenario de sucesso
        if ($cenario == 0) {
            $this->funcao = 'fetch_feedback_usuario';
            $this->cenario = $cenario;
            echo "Cenario de sucesso da função fetch_feedback_usuario. Este cenario será considerado um sucesso<br>
                caso os dados do feedback do usuario X sejam devidamente extraidos do banco de dados<br>
                de forma que não ocorra nenhum erro ou warning durante a execução da mesma e haja consistência nos dados extraidos.<br>";
            $feedback = new Feedback;
            $usuario = 1;
            $feedback->fetch_feedback_usuario($usuario, $conexao);
            var_dump($feedback);
            $this->status_banco = 'não relevante';
        }
        // Cenario de fracasso (usuario não cadastrado)
        if ($cenario == 1) {
            $this->funcao = 'fetch_feedback_usuario';
            $this->cenario = $cenario;
            echo "Cenario de fracasso da função fetch_feedback_usuario. Este cenario será considerado um sucesso<br>
                caso durante a execução do mesmo, o processo seja interrompido devido ao fato de que o usuario a qual<br>
                os dados deverão ser extraidos é invalido ou não existente no banco de dados<br>";
            $feedback = new Feedback;
            $usuario = 10;
            $feedback->fetch_feedback_usuario($usuario, $conexao);
            var_dump($feedback);
            $this->status_banco = 'não relevante';
        }
        // Cenario de fracasso (usuario não deu feedback)
        if ($cenario == 2) {
            $this->funcao = 'fetch_feedback_usuario';
            $this->cenario = $cenario;
            echo "Cenario de fracasso da função fetch_feedback_usuario. Este cenario será considerado um sucesso<br>
                caso durante a execução do mesmo, o processo seja interrompido devido ao fato de não haver nenhum feedback dado<br>
                pelo usuario a qual os dados deverão ser extraidos<br>";
            $feedback = new Feedback;
            $usuario = 2;
            $feedback->fetch_feedback_usuario($usuario, $conexao);
            var_dump($feedback);
            $this->status_banco = 'não relevante';
        }
    }

    public function get_feedback_avg_nota($conexao, $cenario) {
        // Cenario de sucesso
        if ($cenario == 0) {
            $this->funcao = 'get_feedback_avg_nota';
            $this->cenario = $cenario;
            echo "Cenario de sucesso da função get_feedback_avg_nota. Este cenario será considerado um sucesso<br>
                caso a média das notas dos feedbacks seja corretamente calculada e não apresente nenhum tipo de erro ou warning durante a execução.<br>";
            $nota1 = 4;
            $comentario1 = 'muito bom servico';
            $usuario1 = 3;

            $nota2 = 4;
            $comentario2 = 'satisfeito';
            $usuario2 = 4;

            $nota3 = 1;
            $comentario3 = 'horrivel';
            $usuario3 = 5;

            $feedback = new Feedback;

            $feedback->set_feedback($nota1, $comentario1, $usuario1, $conexao);
            $feedback->set_feedback($nota2, $comentario2, $usuario2, $conexao);
            $feedback->set_feedback($nota3, $comentario3, $usuario3, $conexao);

            $avg_feedback_nota = $feedback->get_feedback_avg_nota($conexao);

            echo "Resultado esperado = 3 ";
            var_dump($avg_feedback_nota);
            $this->status_banco = 'não relevante';
        }
    }

    public function get_all_feedback($conexao, $cenario) {
        // Cenario de sucesso
        if ($cenario == 0) {
            $this->funcao = 'get_all_feedback';
            $this->cenario = $cenario;
            echo "Cenario de sucesso da função get_all_feedback. Este cenario será considerado um sucesso<br>
                caso todos os feedbacks sejam corretamente recuperados do banco de dados e não apresentem nenhum tipo de erro ou warning durante a execução.<br>";
            $feedback = new Feedback;
            $feedback_data = $feedback->get_all_feedback($conexao);

            $m = count($feedback_data);
            $x = 0;
            while ($x < $m) {
                $feedback_i = $feedback_data[$x];
                echo 'Nota = ' . $feedback_i['nota'] . ' | ';
                echo 'Comentario = ' . $feedback_i['comentario'] . ' | ';
                echo 'Usuario = ' . $feedback_i['usuario_matricula'] . '<br>';
                $x++;
            }
            $this->status_banco = 'não relevante';
        }
    }

    public function get_feedback_by_data($conexao, $cenario) {
        // Cenario de sucesso
        if ($cenario == 0) {
            $this->funcao = 'get_feedback_by_data';
            $this->cenario = $cenario;
            echo "Cenario de sucesso da função get_feedback_by_data. Este cenario será considerado um sucesso<br>
                caso os feedbacks no intervalo de datas sejam corretamente recuperados do banco de dados e não apresentem nenhum tipo de erro ou warning durante a execução.<br>";
            $feedback = new Feedback;
            $data_postagem_i = '2023-10-01';
            $data_postagem_f = '2023-10-30';
            $feedback_data = $feedback->get_feedback_by_data($data_postagem_i, $data_postagem_f, $conexao);

            $m = count($feedback_data);
            $x = 0;
            while ($x < $m) {
                $feedback_i = $feedback_data[$x];
                echo 'Nota = ' . $feedback_i['nota'] . ' | ';
                echo 'Comentario = ' . $feedback_i['comentario'] . ' | ';
                echo 'Usuario = ' . $feedback_i['usuario_matricula'] . '<br>';
                $x++;
            }
            $this->status_banco = 'não relevante';
        }
    }
}
?>
