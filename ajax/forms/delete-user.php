<?php
session_start();
require __DIR__ . '/../../bootstrap.php';
?>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <form name="delete-user">
                <div class="row-fluid">
                    <span>Deseja deletar usuário ?</span>
                </div>
                <input type="hidden" name="userId" value="<?= $_POST['userId'] ?>">
                <button type="button" class="btn btn-danger">Não</button>
                <button type="submit" class="btn btn-success">Sim</button>
            </form>
        </div>
        <div class="card-footer">
            <div id="delete-response" style="margin: 0"></div>
        </div>
    </div>
</div>
