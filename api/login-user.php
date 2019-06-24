<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE");
header("Access-Control-Max-Age: 86400");
header("Content-type: application/json");

require __DIR__ . '/../bootstrap.php';
use MyApp\Auth;

$auth = new Auth;
$authorize = $auth->Authorize();

if ($authorize) {
    print json_encode([
        "error" => 0,
        "message" => "Logou"
    ]);
} else {
    print json_encode([
        "error" => 1,
        "message" => "Usuário ou senha incorretos!"
    ]);
};
