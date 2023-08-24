<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Funcionário</title>
</head>
<body>
    <h2>Cadastro de Funcionário</h2>
    <form action="recebe_cadastro.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" maxlength="6" required><br><br>
        
        <label for="setor">Setor:</label>
        <select id="setor" name="setor" required>
            <option value="1">Setor 1</option>
            <option value="2">Setor 2</option>
            <option value="3">Setor 3</option>
            <!-- Adicione mais opções de setores conforme necessário -->
        </select><br><br>
        
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
