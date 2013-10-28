<?php
$logout=true;
include("../includes/config.php");
include("../includes/funciones.php");
include("secure.php");

?>
<html>
<head>
<title>salir</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="500" height="200" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" class="cabeceraBold">Salir</td>
  </tr>
  <tr>
    <td class="texto">Ha salido del sistema con &eacute;xito</td>
  </tr>
  <tr>
    <td height="30" align="center" class="pie"><a href="index.php?login=true">ingresar de nuevo.</a></td>
  </tr>
</table>
</body>
</html>
