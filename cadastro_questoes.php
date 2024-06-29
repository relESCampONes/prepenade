<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login_professor.php");
    exit();
}

include('config.php');

// Obtém o nome de usuário da sessão
$usuario = $_SESSION['usuario'];

// Consulta ao banco de dados para verificar se o usuário está na tabela específica
$sql = "SELECT * FROM professores WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se o usuário foi encontrado na tabela
if ($result->num_rows == 0) {
    // Usuário não encontrado na tabela, redireciona para a página de login
    header("Location: login_professor.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Questão</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .container {
            width: 600px;
            margin: 0 auto;
            padding: 25px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 20px;
        }
        input[type="text"], textarea {
            max-width: 100%;
            padding: 10px;
            margin-top: 3px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 20px;
            margin-top: 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastrar Questão</h1>
        <form action="processa_cadastro.php" method="post">
            <label for="pergunta">Pergunta:</label>
            <textarea name="pergunta" id="pergunta" required></textarea>

            <label for="alternativa_a">Alternativa A:</label>
            <input type="text" name="alternativa_a" id="alternativa_a" required>

            <label for="alternativa_b">Alternativa B:</label>
            <input type="text" name="alternativa_b" id="alternativa_b" required>

            <label for="alternativa_c">Alternativa C:</label>
            <input type="text" name="alternativa_c" id="alternativa_c" required>

            <label for="alternativa_d">Alternativa D:</label>
            <input type="text" name="alternativa_d" id="alternativa_d" required>

            <label for="alternativa_e">Alternativa E:</label>
            <input type="text" name="alternativa_e" id="alternativa_e" required>

            <label for="alternativa_correta">Alternativa Correta (A, B, C, D, E):</label>
            <input type="text" name="alternativa_correta" id="alternativa_correta" maxlength="1" required>

            <label for="motivo">Motivo:</label>
            <textarea name="motivo" id="motivo"></textarea>

            <button type="submit">Cadastrar Questão</button>
        </form>
    </div>
</body>
</html>