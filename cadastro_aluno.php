<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO alunos (usuario, senha) VALUES ('$usuario', '$senha')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login_aluno.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro do Aluno</title>
    <link rel="stylesheet" href="/cadastro.css">
</head>
<body>
    <div class="center">
        <h1>Cadastre-se</h1>
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
            <input type="submit" value="Cadastrar">
        </form>
    </div>
</body>
</html>