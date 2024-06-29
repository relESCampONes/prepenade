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
    <title>Cadastrar Simulados</title>
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
        <h1>Cadastrar Simulado</h1>
        <form action="processa_cadastro_simulado.php" method="post">
            <label for="tema">Tema:</label>
            <textarea name="tema" id="tema" required></textarea>

            <!-- <label for="temaid">TemaId:</label> -->
            <!-- <input type="text" name="temaid" id="temaid" required> -->

            <button type="submit">Cadastrar Simulado</button>
        </form>
    </div>
</body>
</html>