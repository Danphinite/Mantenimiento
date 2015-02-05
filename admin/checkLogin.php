<?php
session_start();
//var_dump($_POST);
if (isset($_POST['usuario_digitado'])) // se ha mandado el formulario 
{
   //echo "Hola check2";
   $_SESSION['usuario'] = $_POST['usuario_digitado'];
   $_SESSION['clave'] = $_POST['clave_digitada'];
   //echo $_SESSION['usuario'] . " , " . $_SESSION['clave'];
  if (!validarUsuario($_SESSION['usuario'],$_SESSION['clave']))
  {
  	  $message = "Acceso denegado";
      include("interface.php");
      exit();
  } 
}
else {
	   if (!isset($_SESSION['usuario']))
  // if (isset($_GET['login'])) // entrada del usuario
	    {
	     include("interface.php");
       exit();
      }
     }

?>
