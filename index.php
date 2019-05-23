<?php
require 'vendor/autoload.php';
session_start();
if(!empty($_SESSION['logged'])){
    header('location: chat.php');
}
include 'forms/login-form.php';
?>