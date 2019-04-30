<?php
    require dirname(__DIR__) . '/vendor/autoload.php';
    use MyApp\DBcommands;

    $commands = new DBcommands;

    $user = $commands->selectWhereId($_GET['id']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Alterar</title>
    </head>
    <body>
        <p><strong>ALTERAR</strong></p>
        <form name="alter-form" method="post">
            <label for="">Usuario: </label>
            <input name="username" type="text" id="username" autocomplete="off" value="<?= $user[0]['name'] ?>"><br><br>
            <label for="">Senha: </label>
            <input name="password" type="password" id="password" autocomplete="off" value="<?= $user[0]['pass'] ?>"><br><br>
            <label for="">ADMIN: </label>
            <input name="admin" type="text" id="admin" autocomplete="off" value="<?= $user[0]['admin'] ?>"><br><br>
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            <button type="submit">Alterar</button>
            <a href="../admin.php">Voltar</a>
        </form><br>
        <div id="response">
            
        </div>
    </body>
</html>
<script src="../js/jquery-3.4.0.min.js"></script>
<script src="../js/admin.js"></script>