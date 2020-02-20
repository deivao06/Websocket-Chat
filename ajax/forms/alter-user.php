<?php
session_start();
require __DIR__ . '/../../bootstrap.php';
use MyApp\UserCommands;
$userCommands = new UserCommands;
$user = $userCommands->searchById($_POST['userId']);
?>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <form name="alter-user">
                <input type="hidden" name="user-id" value="<?= $user["id"] ?>">
                <div class="form-group">
                    <h5><label>Nome de Usuário</label></h5>
                    <input type="text" name="alter-username" class="form-control" autocomplete="off" value="<?= $user["name"] ?>">
                </div>
                <div class="form-group">
                    <h5><label>Senha</label></h5>
                    <input type="password" name="alter-password" class="form-control" autocomplete="off" value="<?= $user["pass"] ?>">
                </div>
                <div class="form-group">
                    <h5><label>Admin</label></h5>
                    <input type="text" name="alter-admin" class="form-control" autocomplete="off" value="<?= $user["admin"] ?>">
                </div>
                <button type="submit" class="btn btn-primary">Alterar</button>
            </form>
        </div>
        <div class="card-footer">
            <div id="alter-response" style="margin: 0"></div>
        </div>
    </div>
</div>