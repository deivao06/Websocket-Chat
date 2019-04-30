<?php
    session_start();
    $_SESSION['logged'] = false;
    
    include 'forms/login-form.php';
?>