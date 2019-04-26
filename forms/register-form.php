<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastrar</title>
    </head>
    <body>
        <p><strong>CADASTRAR</strong></p>
        <form name="register-form" method="post">
            <label for="">Usuario: </label>
            <input name="username-register" type="text" id="username-register"><br><br>
            <label for="">Senha: </label>
            <input name="password-register" type="password" id="password-register"><br><br>
            <button type="submit">Cadastrar</button>
            <a href="../index.php">Voltar</a>
        </form><br>
        <div id="response">
            
        </div>
    </body>
</html>
<script src="../js/jquery-3.4.0.min.js"></script>
<script src="../js/register.js"></script>
