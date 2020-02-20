<?php
header("Access-Control-Allow-Origin: *");
require __DIR__ . '/../bootstrap.php';

use MyApp\UserCommands;

$userCommands = new UserCommands;
$users = $userCommands->all();

print json_encode($users);
