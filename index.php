<?php
require __DIR__ . '/boostrap.php';

if(!empty($_SESSION['logged'])){
    header('location: chat.php');
}
include 'forms/login-form.php';
?>