<?php
session_start();
require 'bootstrap.php';
if (!isset($_SESSION['isLogged']) || !$_SESSION['isLogged']){
    header("Location: index.php");
    exit;
}
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
    .message-block {
        min-height: 72vh;
        max-height: 72vh;
    }
    /*body{*/
    /*    background-image: url("/misc/235940-descubra-as-melhores-estrategias-nutricionais-para-gado-de-corte-933x508.jpg");*/
    /*    background-size: cover;*/
    /*}*/
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
                            <a class="nav-link nav-bar-stack active" href="chat.php"><i class="fa fa-comment"></i> Chat</a>
                        </li>
                        <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1){ ?>
                        <li class="nav-item">
                            <a class="nav-link nav-bar-stack" href="admin.php"><i class="fa fa-user-cog"></i> Admin</a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
                <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1){ ?>
                <br>
                <div class="card">
                    <div class="card-header text-center">
                        Users Online
                    </div>
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <div class="card-footer text-center">
                        Pessoas
                    </div>
                </div>
                <?php } ?>
                <br>
                <div class="alert" role="alert" id="status"></div>
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <div style="overflow: auto" class="form-control message-block" id="messages-area" rows="10"></div>
                </div>
                <form name="form-message">
                    <div class="form-row">
                        <div class="col-11">
                            <input type="hidden" name="username" id="user-name" value="<?= $_SESSION['username'] ?>">
                            <input type="text" class="form-control" name="message" id="user-message"
                                   placeholder="Digite a mensagem..." autocomplete="off">
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-comments"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<script src="misc/bootstrap/js/bootstrap.min.js"></script>
<script src="js/jquery-3.4.0.min.js"></script>
<script src="js/chat.js"></script>