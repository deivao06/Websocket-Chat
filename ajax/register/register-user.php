<?php
require dirname(__DIR__) . '../../vendor/autoload.php';
use MyApp\DBcommands;

$commands = new DBcommands;

$verify = $commands->verifyRegister($_POST['username-register']);

if($verify == true){
    $insert = $commands->insert($_POST['username-register'], $_POST['password-register']);
}else{
    echo json_encode([
        'message' => 'Usuário ja existente!',
        'error' => 1
    ]);
    exit;
}

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
