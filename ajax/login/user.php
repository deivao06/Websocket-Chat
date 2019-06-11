<?php
session_start();
require __DIR__ . '/../../bootstrap.php';

use MyApp\UserCommands;

$login = login($_POST['username'], $_POST['password']);

if($login){

    $_SESSION['username'] = $login['name'];
    $_SESSION['isLogged'] = true;
    $_SESSION['isAdmin'] = $login['admin'];

    print json_encode([
        "error" => 0
    ]);
}else{
    print json_encode([
        "error" => 1,
        "message" => "Usuário ou senha incorretos!"
    ]);
};