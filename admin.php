<?php
require 'vendor/autoload.php';
use MyApp\DBcommands;

session_start();
if(!$_SESSION['logged']){
    header('location: index.php');
}

$commands = new DBcommands;

$validate = $commands->selectWhereId($_SESSION['userId']);
$admin = $validate['admin'];

if($admin == 0){
    header('location: chat.php');
}

$users = $commands->selectAll();
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="shortcut icon" href="misc/favicon.ico" />
</head>
<body>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Admin</th>
            <th>Options</th>
        <?php foreach($users as $user) { ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['name'] ?></td>
    
                <td><?= $user['pass'] ?></td>
                <td><?= $user['admin'] ?></td>
                <td>
                    <a href="forms/alter-form.php?id=<?= $user['id'] ?>" class="alter">Alterar</a>
                    <a href="ajax/delete/delete-user.php?id=<?= $user['id'] ?>" class="delete">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
<script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
