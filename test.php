<?php
    echo "<h1>Hello World!</h1>";
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login do Aluno</title>
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