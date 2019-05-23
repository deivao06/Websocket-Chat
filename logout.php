<?php
session_start();
if(!empty($_POST)){
    if(isset($_COOKIE[$_POST['name']])){
        var_dump('teste');
        setcookie($_POST['name']);
    }
}
session_destroy();
header('location: index.php');