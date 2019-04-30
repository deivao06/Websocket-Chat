<?php
session_start();
require dirname(__DIR__) . '../../vendor/autoload.php';
use MyApp\DBcommands;

$commands = new DBcommands;

$verifyLogin = $commands->verifyLogin($_POST['username'],  $_POST['password']);

if($verifyLogin){
    $_SESSION['logged'] = true;
    $_SESSION['name'] = $_POST['username'];
    if($_POST['username'] == 'admin'){
        $_SESSION['admin'] = true;
    }
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
