<?php
session_start();
require 'bootstrap.php';

use MyApp\UserCommands;

if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 0){
    header("Location: index.php");
    exit;
}
$userCommands = new UserCommands;
$users = $userCommands->all();

?>
<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <title>GADOZAP</title>
    <link rel="stylesheet" href="misc/bootstrap/css/bootstrap.min.css">
    <link href="misc/fontawesome/css/all.css" rel="stylesheet">
</head>
<style>
    .nav-bar-stack {
        background: white;
    }
    body{
        background-image: url("/misc/235940-descubra-as-melhores-estrategias-nutricionais-para-gado-de-corte-933x508.jpg");
        background-size: cover;
    }
</style>
<body style="padding: 10px">
    <div class="container-fluid" style="padding-top: 25px;">
        <div class="row">
            <div class="col-md-2" style="margin-bottom: 10px">
                <a class="btn btn-danger" href="logout.php"><i class="fa fa-power-off"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <nav>
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link nav-bar-stack" href="chat.php"><i class="fa fa-comment"></i> Chat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-bar-stack active" href="admin.php"><i class="fa fa-user-cog"></i> Admin</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-5">
                <table class="table text-center table-bordered table-hover table-light table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nome</th>
                            <th>Senha</th>
                            <th>Admin</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user){;?>
                            <tr>
                                <td><?= $user['name'] ?></td>
                                <td><?= $user['pass'] ?></td>
                                <td><?= $user['admin'] ?></td>
                                <td>
                                    <a class="alter-user" href="alter-user.php"><i class="fa btn btn-dark fa-user-check"></i></a>
                                    <a  class="delete-user" href="delete-user.php"><i class="fa btn btn-dark fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<script src="misc/bootstrap/js/bootstrap.min.js"></script>
<script src="js/jquery-3.4.0.min.js"></script>