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

// Consulta ao banco de dados para obter as questões
$sql = "SELECT * FROM simulados";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulado</title>
    <link rel="stylesheet" href="/simulado.css">
</head>
<body>
    <header>
        <a href="/home2.php" class="logo">PrepEnade</a>
        <nav>
            <ul class="nav_links">
                <li><a href="/simulados.php">Simulados</a></li>
                <li><a href="/questoes.php">Questões</a></li>
                <li><a href="/professores.php">Professores</a></li>
            </ul>
        </nav>
        <form method="post" action="logout.php">
            <button type="submit">Sair</button>
        </form>
    </header>
    <main class="center">
        <div class="linha">
            <!-- <h1>Simulado</h1> -->
            <?php
            $row = $result->fetch_assoc();
            echo "<h1> " . $row["tema"]. "</h1><br>";
            ?>

        </div>
        <div class="conteudo" >
            <?php
            $sql = "SELECT * FROM questoes";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Saída de dados de cada linha
                while($row = $result->fetch_assoc()) {
                    echo "<div class='pergunta'>
                            <p>Pergunta: " . $row["pergunta"] . "</p><br>
                            <ul class='simul'>
                                <li>a) " . $row["alternativa_a"] . "</li><br>
                                <li>b) " . $row["alternativa_b"] . "</li><br>
                                <li>c) " . $row["alternativa_c"] . "</li><br>
                                <li>d) " . $row["alternativa_d"] . "</li><br>
                                <li>e) " . $row["alternativa_e"] . "</li><br>
                                <li style='color: red;'>Resposta: " . $row["alternativa_correta"] . "</li><br>
                            </ul>
                        </div>";
                }
            } else {
                echo "<p>Nenhuma questão encontrada</p>";
            }
            ?>
        </div>
    </main>
</body>
</html>

<?php $conn->close(); ?>