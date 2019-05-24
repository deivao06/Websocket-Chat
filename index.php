<?php 
    require 'bootstrap.php';
?>
<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <title>GADOZAP</title>
</head>
<body style="padding: 10px">
    <nav>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" href="#">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>   
        </ul>
    </nav>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-4">
                <form>
                    <div class="form-group">
                        <h5><label>Usuário</label></h5>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <h5><label>Senha</label></h5>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<script src="misc/bootstrap/js/bootstrap.min.js"></script>