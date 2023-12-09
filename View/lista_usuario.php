<?php
require '../Model/conexao.php';
require_once '../controller/autenticacao.class.php';
require_once '../controller/usuario.class.php';

session_start();

// Verifica se o usuário logado é administrador
$isAdmin = Autenticacao::verificarPermissaoAdmin($mysqli);

// Realiza a consulta para obter os usuários com informações de setor e área
$query = "SELECT u.matricula, u.nome, u.email, u.isAdmin, s.nome_setor as setor_nome, a.nome_area as area_nome
          FROM usuario u
          INNER JOIN setor s ON u.setor = s.id_setor
          LEFT JOIN area_responsavel a ON u.area_responsavel = a.id_area";
$result = $mysqli->query($query);

// Verifica se existem usuários
if ($result && $result->num_rows > 0) {
    // Exibe a tabela de usuários
    echo "<table border='1'>
            <tr>
                <th>Matrícula</th>
                <th>Nome</th>
                <th>Email</th>
                <th>isAdmin</th>
                <th>Setor</th>
                <th>Área Responsável</th>";

    // Exibe as colunas adicionais para usuários administradores
    if ($isAdmin) {
        echo "<th>Ações</th>";
    }

    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['matricula']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['email']}</td>
                <td>";

        // Verifica se a chave 'isAdmin' está definida antes de exibi-la
        if (isset($row['isAdmin'])) {
            echo $row['isAdmin'];
        }

        echo "</td>
                <td>{$row['setor_nome']}</td>
                <td>{$row['area_nome']}</td>";

        // Exibe as ações apenas para usuários administradores
        if ($isAdmin) {
            echo "<td>
                      <a href='editar_usuario.php?matricula={$row['matricula']}'>Editar</a> | 
                      <a href='excluir_usuario.php?matricula={$row['matricula']}'>Excluir</a>
                  </td>";
        }

        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Nenhum usuário encontrado.";
}

// Fecha a conexão com o banco de dados
$mysqli->close();
?>
