<?php
include("../includes/config.php");
include("../includes/funciones.php");
include("secure.php");

//path de las imagenes
$imgpath = "../fotografias/";

if(isset($_POST['submit'])){
	//actualizamos el registro.
	
	//cambiamos los enter por nuevas lineas
	$noticia = str_replace("\r","",$_POST['texto']);
	//fecha
	$fecha = $_POST['aa'].$_POST['mm'].$_POST['dd'];
	$sql = "UPDATE agenda SET ";
	$sql .= "cabecera ='".$_POST['cabecera']."',texto='$noticia',fecha='$fecha',foto='".$_POST['foto']."'";
	$sql .= " ,seccion ='2' ";
	$sql .= "WHERE id= '".$_POST['id']."'";
	//print $sql;exit;
	//nos conectamos a la bd.
	$cnx = conectar();
	$res = mysql_query($sql) or die (mysql_error());
	
	//cerramos la conexión.
	mysql_close($cnx);		
	
	$titulo = "Registro Actualizado";
	$mensaje = "El registro ha sido Actualizado";
	$link = "<a href='index.php'>regresar</a>";
	include("mensajes.php");
	exit;
}

if(empty($_GET['id'])){
	header("Location: index.php");
}
$cnx = conectar();
$res = mysql_query ("SELECT * FROM agenda WHERE id =".$_GET['id']) or die (mysql_error());

?>

<html>
<head>
<title>agenda_editar</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<SCRIPT LANGUAGE="JavaScript">
<!--
var galeria = null;
function openImgManager() { //v2.0
	if(galeria && !galeria.closed) galeria.close(); 
	var left = screen.width - 465;
  	galeria = window.open('imgMngr.php','galeria','left='+left+',top=10,status=yes,scrollbars=yes,width=450,height=500');
}
function eliminarImagen(){
	document.forms[0]['foto'].value = "N/A";
//	var elem = getElementById("xxx");
//	elem.value="hola";
	document.forms[0].foto2.value = "N/A";
	document.forms[0].imgDisplay.src = "N/A";
	//document.forms[0].['imgDisplay'].src = "N/A";
	//document.forms[0].images[1].src = "N/A";
   // document.images[0].src = "N/A";
}
//-->
</SCRIPT>
<link href="../estilos.css" rel="stylesheet" type="text/css">
</head>

<?php
	if(mysql_num_rows($res)> 0) {
		//si hay datos
		list($id,$seccion,$cabecera,$texto,$fecha,$foto) = mysql_fetch_array($res);

?>

<body>
<form action="<?php echo $SERVER['PHP_SELF'];?>" method="post" name="form1">
  <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" class="cabeceraBold"><input type="hidden" name="id" value="<?php echo $id;?>">
			Editar noticia en la agenda.	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><span class="textoBold">Cabecera:</span><br>
        <input readonly name="cabecera" type="text" id="cabecera" size="40" value="<?php echo $cabecera;?>">
      </td>
    </tr>
    <tr>
      <td><span class="textoBold">Texto:</span><br>
        <textarea name="texto" cols="40" rows="6" id="texto"><?php echo $texto;?></textarea>
      </td>
    </tr>
    <tr>
      <td><span class="textoBold">Fecha:</span><br>
		<?php
			makeNumList(1,31,"dd",substr($fecha,6,2));
		?>
        - 
        <?php
			makeMesList("mm",substr($fecha,4,2));?>
        - 
		<?php
			makeNumList(date("Y") -2,6,"aa",substr($fecha,0,4));
		?>
      </td>
    </tr>
    <tr>
      <td><span class="textoBold">Foto</span><br>
	      <div align="center"><img name="imgDisplay"   src="<?php echo $imgpath.$foto;?>"><br>
	      <input  readonly type="text"  id="xxx" name="foto2" value="<?php echo $foto;?>">
	      <input  type="hidden" id="foto" name="foto" value="<?php echo $foto;?>">
	      <br><a href="javascript:;" onClick="eliminarImagen()">eliminar imagen</a>&nbsp;|&nbsp;<a href="javascript:;" onClick="openImgManager()">escoger imagen de galer&iacute;a </a> </div>
      </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><input name="submit" type="submit" id="submit" value="Enviar"></td>
    </tr>
    <tr>
      <td height="30" class="pie"><a href="index.php">regresar</a></td>
    </tr>	
  </table>
</form>
<?php
}else{
	//no hay datos
	echo "No hay registros que coincidan con el identificador";
}
mysql_close($cnx)
?>
</body>
</html>
