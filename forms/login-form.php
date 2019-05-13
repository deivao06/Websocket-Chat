<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="shortcut icon" href="../misc/favicon.ico" />
    </head>
    <body>
        <p><strong>LOGIN</strong></p>
        <form name="login-form" method="post">
            <label for="">Usuario: </label>
            <input name="username" type="text" id="username" autocomplete="off"><br><br>
            <label for="">Senha: </label>
            <input name="password" type="password" id="password" autocomplete="off"><br><br>
            <button type="submit">Login</button>
            <a href="forms/register-form.php">Cadastrar</a>
        </form><br>
        <div id="response">
            
        </div>
    </body>
</html>
<script src="../js/jquery-3.4.0.min.js"></script>
<script src="../js/login.js"></script>