<?php
session_start();
unset($_SESSION['usuario']);
unset($_SESSION['clave']);
//$_SESSION = array();
session_destroy();
$sessionPath = session_get_cookie_params(); 
setcookie(session_name(), "", 0, $sessionPath["path"], $sessionPath["domain"]); 
?>