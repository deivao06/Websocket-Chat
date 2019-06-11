<?php
session_start();
require __DIR__ . '/../../bootstrap.php';

use MyApp\UserCommands;


if ( !\Volnix\CSRF\CSRF::validate($_POST, 'verify-register') ) {
    echo json_encode([
        'error' => 1,
        'message' => 'Use o FORMULÁRIO, Obrigado.'
    ]);
    exit;
}

if (verifyIfUsernameExists($_POST['register-username'])){
    print json_encode([
        "error" => 1,
        "message" => "Usuário ja existe!"
    ]);
    exit;
}

$register = false;
if ((isset($_POST['register-username']) && trim($_POST['register-username']) != "") || isset($_POST['register-password']) && trim($_POST['register-password']) != ""){
    $user = new UserCommands;
    $register = $user->registerUser($_POST['register-username'], $_POST['register-password']);
}else{
    print json_encode([
        "error" => 1,
        "message" => "Preencha todos os campos!"
    ]);
    exit;
}

if ($register){
    print json_encode([
       "error" => 0,
       "message" => "Cadastrado com Sucesso!"
    ]);
    exit;
}else{
    print json_encode([
        "error" => 1,
        "message" => "Falha ao Cadastrar"
    ]);
    exit;
}

