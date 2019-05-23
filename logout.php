<?php
session_start();
setcookie('loginHash');
session_destroy();
header('location: index.php');