<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM professores WHERE usuario='$usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($senha, $row['senha'])) {
            session_start();
            $_SESSION['usuario'] = $usuario;
            header("Location: home2.php");
        } else {
            echo "<span style='color:white'>Invalid password.</span>";
        }
    } else {
        echo "<span style='color:white'>No user found with that username.</span>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login do Professor</title>
    <link rel="stylesheet" href="/login.css">
</head>
<body>
    <div class="center">
        <h1>Login</h1>
        <form method="post" action="">
            <div class="txt_field">
                <input type="text" name="usuario" required>
                <span></span>
                <label>Usuário</label>
            </div>
            <div class="txt_field">
                <input type="password" name="senha" required>
                <span></span>
                <label>Senha</label>
            </div>
            <input type="submit" value="Login">
    </form>
</body>
</html>