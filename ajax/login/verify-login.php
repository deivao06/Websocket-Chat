<?php
require dirname(__DIR__) . '../../vendor/autoload.php';
session_start();
use MyApp\DBcommands;

$commands = new DBcommands;

$verifyLogin = $commands->verifyLogin($_POST['username'],  $_POST['password']);

if($verifyLogin){
    $_SESSION['logged'] = true;
    $_SESSION['userId'] = $verifyLogin['id'];

    print json_encode([
        'error' => 0,
        'message' => 'Usuário Encontrado!'
    ]);
}else{
    print json_encode([
        'error' => 1,
        'message' => 'Usuário Inexistente!'
    ]);
}
