<?php
include("../includes/config.php");
include("../includes/funciones.php");
include("secure.php");
if(empty($_GET['id'])){
	//no hay id
	header ("Location: index.php");
	exit;
}else{
	//nos conectamos a la bd.
	$cnx = conectar();

	$res = mysql_query("SELECT cabecera,texto,fecha,foto FROM agenda WHERE id = ".$_GET['id']) or die("&output=error&msg=".mysql_error());
	if( mysql_num_rows($res) > 0 ){
		//si hay datos.
		list($cabecera,$texto,$fecha,$foto) = mysql_fetch_array($res);
		//formateamos la fecha.
		$fecha = formatFecha($fecha);
		//cambiamos los \n por <br> para html
		$texto = nl2br($texto);
	}else{
		//no hay datos.
		echo "error al buscar el registro.";
		exit;

	}
	//cerramos la conexion con mysql.
	mysql_close($cnx);
}
?>
<html>
<head>
<title>
<?php echo $cabecera;?>
</title>

<link href="../estilos.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="600" height="350" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr height="30">
    <td valign="top" class="cabecera"> <span class="cabeceraBold"><?php echo $fecha;?></span><br>
    <?php echo $cabecera;?></td>
  </tr>
  <tr>
    <td  valign="top" class="texto"><?php echo $texto?><br></td>
  </tr>
  <?php 
	if($foto != "N/A" && !empty($foto)){
			//hay foto.
	?>
  <tr>
    <td align="center"> <img src="../fotografias/<?php echo $foto;?>" alt="<?php echo $cabecera?>"> </td>
  </tr>
	<?php
	}//fin if de foto
	?>
  <tr height="30">
    <td valign="top" class="pie"><a href="index.php">regresar</a></td>
  </tr>
</table>
</body>

</html>
