<?php
require 'vendor/autoload.php';

session_start();
if(!$_SESSION['logged']){
    header('location: index.php');
}

if(!$_SESSION['admin']){
    header('location: chat.php');
}
use MyApp\DBcommands;

$commands = new DBcommands;
$users = $commands->selectAll();

?>
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
<script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
