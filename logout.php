<?php
// Initialize the session
session_start();
 
// Unset all of the session and cookie variables
setcookie("loggedin", null, -1);
setcookie("id", null, -1);
setcookie("username", null, -1);
setcookie("firstname", null, -1);
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to home page
header("location: home.php");
exit;
?>