<?php
require 'vendor/autoload.php';
session_start();
if($_SESSION['logged']){
    header('location: chat.php');
}
include 'forms/login-form.php';
?>