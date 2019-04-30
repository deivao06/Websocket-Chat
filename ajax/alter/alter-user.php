<?php
require dirname(__DIR__) . '../../vendor/autoload.php';
use MyApp\DBcommands;

$commands = new DBcommands;

$update = $commands->updateUser($_POST['username'], $_POST['password'], $_POST['admin'], $_POST['id']);

if($update){
    echo json_encode([
        'error' => 0,
        'message' => 'Alterado com sucesso!'
    ]);
}else{
    echo json_encode([
        'error' => 1,
        'message' => 'Falha ao alterar!'
    ]);
}