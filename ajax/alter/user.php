<?php
session_start();
require __DIR__ . '/../../bootstrap.php';

use MyApp\UserCommands;

$userCommands = new UserCommands;

$update = $userCommands->updateUser($_POST['user-id'], $_POST['alter-username'], $_POST['alter-password'], $_POST['alter-admin']);
if ($update){
    print json_encode([
       "error" => 0,
       "message" => "Alterado com sucesso"
    ]);
}else{
    print json_encode([
        "error" => 0,
        "message" => "Falha ao alterar"
    ]);
}