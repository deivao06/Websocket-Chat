<?php
session_start();
require 'bootstrap.php';
if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == true){
    $_SESSION = [];
    session_destroy();
    header("Location: index.php");
}
