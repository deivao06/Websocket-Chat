<?php
session_start();
require __DIR__ . '/../../bootstrap.php';

use MyApp\UserCommands;
$userCommands = new UserCommands;

$delete = $userCommands->deleteUser($_POST['userId']);
if ($delete){
    print json_encode([
        "error" => 0,
        "message" => "Deletado com sucesso!"
    ]);
}else{
    print json_encode([
        "error" => 1,
        "message" => "Falha ao deletar!"
    ]);
}