<?php
    session_start();
    require __DIR__ . '/bootstrap.php';

    if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == true){
        header("Location: chat.php");
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
        /*body{*/
        /*    background-image: url("/misc/235940-descubra-as-melhores-estrategias-nutricionais-para-gado-de-corte-933x508.jpg");*/
        /*    background-size: cover;*/
        /*}*/
    </style>
    <body style="padding: 10px">
        <div class="container-fluid" style="padding-top: 25px;">
            <div class="row">
                <div class="col-md-2">
                    <nav>
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a class="nav-link nav-bar-stack active" href="index.php"><i class="fa fa-sign-in-alt"></i> Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-bar-stack" href="register.php"><i class="fa fa-clipboard-check"></i> Cadastrar</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <form name="login-form">
                                <div class="form-group">
                                    <h5><label>Nome de Usuário</label></h5>
                                    <input type="text" name="username" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <h5><label>Senha</label></h5>
                                    <input type="password" name="password" class="form-control" autocomplete="off">
                                </div>
                                <button type="submit" class="btn btn-primary">Logar</button>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div id="login-response"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script src="misc/bootstrap/js/bootstrap.min.js"></script>
<script src="js/jquery-3.4.0.min.js"></script>
<script src="js/login.js"></script>