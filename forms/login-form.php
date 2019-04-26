<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <p><strong>LOGIN</strong></p>
        <form name="login-form" action="../ajax/login/verify-login.php" method="post">
            <label for="">Usuario: </label>
            <input name="username" type="text" id="username"><br><br>
            <label for="">Senha: </label>
            <input name="password" type="password" id="password"><br><br>
            <button type="submit">Login</button>
            <a href="forms/register-form.php">Cadastrar</a>
        </form><br>
    </body>
</html>