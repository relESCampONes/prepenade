<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login_aluno.php");
    exit();
}

include('config.php');

// Obtém o nome de usuário da sessão
$usuario = $_SESSION['usuario'];

// Consulta ao banco de dados para verificar se o usuário está na tabela específica
$sql = "SELECT * FROM alunos WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se o usuário foi encontrado na tabela
if ($result->num_rows == 0) {
    // Usuário não encontrado na tabela, redireciona para a página de login
    header("Location: login_aluno.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home 1</title>
    <link rel="stylesheet" href="/home.css">
</head>
<body>
    <header>
        <a href="/home1.php" class="logo">PrepEnade</a>
        <nav>
            <ul class="nav_links">
                <li><a href="/simulados1.php">Simulados</a></li>
                <li><a href="/questoes1.php">Questões</a></li>
            </ul>
        </nav>
        <form method="post" action="logout.php">
            <button type="submit">Sair</button>
        </form>
    </header>
</body>
</html>

<?php $conn->close(); ?>