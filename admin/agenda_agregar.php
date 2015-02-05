<?php
include("../includes/config.php");
include("../includes/funciones.php");
include("secure.php");

if(isset($_POST['submit'])){
	$error = false;
	// si hay imagen.
	if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
		//revisamos que sea jpg
		if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/pjpeg"){
			//nombre de la imagen
			$foto = time().".jpg";
			//movemos la imagen.
			move_uploaded_file($_FILES['imagen']['tmp_name'], "../fotografias/".$foto);
		}else{
			$error = true;
			$errormsg = "Formato no válido para archivo de imagen";
		     echo $errormsg;
		}
	} else {
		//imagen no se pudo subir o no seleccionaron.
		$error=true;
		$errormsg = "Error al cargar imagen: " . $_FILES['imagen']['name'];
	    echo $errormsg;
	}//fin file upload.
		
	//continuamos con el insert.
	//si hay error no hay imagen.
	if($error){
		$foto = "N/A";
	}
	//quitamos los enter ya que en flash se ven dobles.
	$noticia = str_replace("\r","",$_POST['texto']);
	//fecha
	$fecha = $_POST['aa'].$_POST['mm'].$_POST['dd'];
	$campos = "cabecera,texto,fecha,foto,seccion";
	$valores = "'".$_POST['cabecera']."','$noticia','$fecha','$foto','2'";
	//nos conectamos a la bd.
	$cnx = conectar();
	$res = mysql_query("INSERT INTO agenda ($campos) VALUES($valores)") or die (mysql_error());
	//actualizamos el xml de agenda.
	//actualizarXmlAgenda();
	//cerramos la conexión.
	mysql_close($cnx);
	//mensaje de exito.
	$titulo = "Registro Ingresado";
	$mensaje = "El registro ha sido ingresado";
	$link = "<a href='index.php'>regresar</a>";
	include("mensajes.php");
	exit;
}

?>

<html>
<head>
<title>agenda_agregar</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
</head>

<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form1">
  <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" class="cabeceraBold">Insertar noticia en la agenda.</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><span class="textoBold">Cabecera:</span><br>
        <input name="cabecera" type="text" id="cabecera" size="40">
      </td>
    </tr>
    <tr>
      <td><span class="textoBold">Texto:</span><br>
        <textarea name="texto" cols="40" rows="6" id="texto"></textarea>
      </td>
    </tr>
    <tr>
      <td><span class="textoBold">Fecha:</span><br>
          <?php
			makeNumList(1,31,"dd",date("d"));
		?>
      -
      <?php 
			$m = (($m =(date("n") -1))<10)?("0".$m):($m);
			makeMesList("mm",$m);
		?>
      -
      <?php
			makeNumList(date("Y") -2,6,"aa",date("Y"));
		?>
      </td>
    </tr>
    <tr>
      <td><span class="textoBold">Foto:</span>        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
      <br>
      <input name="imagen" type="file" id="imagen"></td>
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
</body>
</html>
