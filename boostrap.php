<?php
session_start();
require __DIR__ . '/vendor/autoload.php';

if ((new \MyApp\DBcommands)->verifyLogin() == false) {
    header('Location: logout.php');
}