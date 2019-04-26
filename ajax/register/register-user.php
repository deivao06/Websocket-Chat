<?php
require dirname(__DIR__) . '../../vendor/autoload.php';
use MyApp\DBcommands;

$commands = new DBcommands;

$insert = $commands->insert($_POST['username-register'], $_POST['password-register']);

if($insert){
    echo json_encode([
        'message' => 'Cadastrado com sucesso!',
        'error' => 0
    ]);
}else{
    echo json_encode([
        'message' => 'Erro ao cadastrar!',
        'error' => 1
    ]);
}



