<?php
require '../vendor/autoload.php';
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastrar</title>
        <link rel="shortcut icon" href="../misc/favicon.ico" />
    </head>
    <body>
        <p><strong>CADASTRAR</strong></p>
        <form name="register-form" method="post">
            <?= \Volnix\CSRF\CSRF::getHiddenInputString('verify-register') ?>
            <label for="">Usuario: </label>
            <input name="username-register" type="text" id="username-register" autocomplete="off" required><br><br>
            <label for="">Senha: </label>
            <input name="password-register" type="password" id="password-register" autocomplete="off" required><br><br>
            <button type="submit">Cadastrar</button>
            <a href="../index.php">Voltar</a>
        </form><br>
        <div id="response">
            
        </div>
    </body>
</html>
<script src="../js/jquery-3.4.0.min.js"></script>
<script src="../js/register.js"></script>
