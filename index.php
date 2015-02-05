<?php
include("../includes/config.php");

include("../includes/funciones.php");
include("secure.php");

//$cnx = conectar();
//$res = mysql_query("SELECT id,cabecera FROM agenda ORDER BY fecha DESC,id DESC") or die (mysql_error());
?>

<html>
<head>
<title>Noticias fresquitas</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../includes/scripts.js"></script>
</head>

<body>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="cabeceraBold"></td>
    <td width="300" height="30" class="cabeceraBold">Cabecera</td>
    <td colspan="3" align="center" class="cabeceraBold"></td>
  </tr>
 
  
<?php // include ("../includes/muestraRegistros.php");
  if (!isset($_GET['pagina']))
      muestraRegistrosRadio(1);
  else 
      muestraRegistrosRadio($_GET['pagina']);
  
?>
<tr><td  align="center" height="30" colspan="5" > <?php barraPaginador(); ?></td></tr>
  <tr> 
    <td height="30" colspan="4" class="pie"><a href="agenda_agregar.php">Agregar
    registro</a></td>






    <td height="30" align="right" class="pie"> <a href="salir.php?logout=true">salir</a></td>
  </tr>	

</table>
</body>
</html>
