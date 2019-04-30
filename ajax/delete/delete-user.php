<?php
require dirname(__DIR__) . '../../vendor/autoload.php';
use MyApp\DBcommands;

$commands = new DBcommands;

$delete = $commands->delete($_GET['id']);

if($delete){
    header('location:../../admin.php');
}else{
    echo "FALHA AO DELETAR";
}