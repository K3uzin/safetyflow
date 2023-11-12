<?php
    require '../Model/conexao.php'; // Verifique se o caminho está correto
    require_once '../Controller/usuario.class.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Usuário</title>
</head>
<body>
    <h1>Cadastro de Usuário</h1>
    
    <form method="POST" action="../Controller/recebe_cadastro.php">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        
        <label for="matricula">Matrícula:</label>
        <input type="text" id="matricula" name="matricula" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>
        
        <label for="isAdmin">Administrador:</label>
        <select id="isAdmin" name="isAdmin" required>
            <option value="0">Não</option>
            <option value="1">Sim</option>
        </select><br><br>
        <label for="area_responsavel" class="form-label required-label">Área Responsável: </label>
        <select id="area_responsavel" name="area_responsavel" required="">
                                <option value="">Escolha...</option>
                                <option value="1">Manutenção</option>
                                <option value="2">Engenharia</option>
                                <option value="3">Produção</option>
                                <option value="4">Qualidade</option>
                                <option value="5">Recursos Humanos</option>
                                <option value="6">Segurança do Trabalho</option>
                                <option value="7">Meio Ambiente</option>
                            </select>
        <label for="setor_desvio" required-label">Setor</label>
        <select id="setor" name="setor" required="">
            <option value="">Escolha...</option>
            <option value="1">Administrativa</option>
            <option value="2">Hidro</option>
            <option value="3">Cremes</option>
            <option value="4">Estojo</option>
            <option value="5">Qualidade</option>
            <option value="6">Logística</option>
        </select><br><br>
        
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
