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

// Consulta ao banco de dados para obter os simulados
$sql = "SELECT * FROM simulados";
$result = $conn->query($sql);

// Verifica se um ID foi enviado para exclusão
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Prepara a consulta para excluir a questão
    $sql = "DELETE FROM simulados WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);

    // Executa a exclusão
    if ($stmt->execute()) {
        echo "Simulado deletado com sucesso, recarregue a página para que a mesmo não seja exibida mais na tabela.";
    } else {
        echo "Erro ao deletar a simulado: " . $conn->error;
    }
}

// function limitarTexto($texto, $limite) {
//     if (strlen($texto) > $limite) {
//         return substr($texto, 0, $limite) . '...';
//     } else {
//         return $texto;
//     }
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulados</title>
    <link rel="stylesheet" href="/professores.css">
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
            <h1>Simulados</h1>
            <a href="/cadastro_simulado.php" class="btn1a"><button class="btn1">Cadastrar</button></a>
        </div>
        <div>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Tema</th>
                    <th class="visualizar">Visualizar</th>
                    <th class="acoes">Ações</th>
                </tr>

                <?php
                if ($result->num_rows > 0) {
                    // Saída de dados de cada linha
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row["id"]. "</td>
                            <td>" . $row["tema"]. "</td>"
                            ;
                        // echo "<td class='visualizar'>
                        //     <form method='post' action='simulado.php'>
                        //         <a href='/simulado.php'>
                        //         <button type='submit' class='btn2'><img src='https://icons8.com/icon/4910/view' alt='view-file'></button>
                        //         </a>
                        //     </form>";
                        // // </td></tr>";
                        echo "<td class='visualizar'>
                            <form method='post' action='simulado.php'>
                                <button type='submit' class='btn2'><img src='https://img.icons8.com/ios/50/view-file.png' alt='Exluir'></button>
                            </form>";
                        echo "<td class='acoes'>
                            <form method='post' action='simulados.php'>
                                <input type='hidden' name='delete_id' value='" . $row["id"] . "'>
                                <button type='submit' class='btn2'><img src='https://cdn-icons-png.flaticon.com/512/54/54324.png' alt='Exluir'></button>
                            </form>
                        </td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='10   '>Nenhum simulado encontrado</td></tr>";
                }
                ?>

            </table>
        </div>
    </main>
</body>
</html>

<?php $conn->close(); ?>