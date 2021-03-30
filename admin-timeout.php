<?php
$timeout = 900;
//logout admin after 15 minuets.
if(time() - $_SESSION['admin-time'] > $timeout){
    unset($_SESSION['admin']);
    header('Location: admin-login.php');
}