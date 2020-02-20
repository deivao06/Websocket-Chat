<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE");

require __DIR__ . '/../bootstrap.php';
use MyApp\Auth;

$auth =  new Auth;
$login = $auth->Login($_POST['username'], $_POST['password']);

if ($login){
    print json_encode([
        "error" => 0,
        "message" => $login
    ]);
}else{
    print json_encode([
        "error" => 1,
        "message" => "Usuário ou senha incorretos!"
    ]);
}
