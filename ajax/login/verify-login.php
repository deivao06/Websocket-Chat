<?php
require dirname(__DIR__) . '../../vendor/autoload.php';
session_start();
use MyApp\DBcommands;

$commands = new DBcommands;

$verifyLogin = $commands->verifyLogin($_POST['username'],  $_POST['password']);

if($verifyLogin == true){
    $_SESSION['logged'] = true;
    $_SESSION['name'] = $_POST['username'];
    $_SESSION['userId'] = $verifyLogin['id'];

    print json_encode([
        'error' => 0,
        'message' => 'Usuário Encontrado!'
    ]);
}elseif($verifyLogin == 'logged'){
    print json_encode([
        'error' => 1,
        'message' => 'Usuário ja está logado!'
    ]);
}else{
    print json_encode([
        'error' => 1,
        'message' => 'Usuário Inexistente!'
    ]);
}
