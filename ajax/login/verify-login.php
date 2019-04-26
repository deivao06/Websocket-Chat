<?php
require dirname(__DIR__) . '../../vendor/autoload.php';
use MyApp\DBcommands;

$commands = new DBcommands;

$users = $commands->selectAll();

foreach($users as $user){
    if($user['name'] == $_POST['username'] && $user['pass'] == $_POST['password']){
        header("Location: ../../chat.php");
        exit();
    }else{
        header("Location: ../../index.php");
    }
}