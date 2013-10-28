<?php
include("../includes/config.php");
include("../includes/funciones.php");
include("secure.php");

if(isset($_POST['submit'])){

        //borramos el registro.
        //nos conectamos a la bd.
        $cnx = conectar ();
        //consulta sql.
        $sql = "DELETE FROM agenda WHERE id=".$_POST['id'];
        $res = mysql_query($sql) or die (mysql_error());
        //actualizamos el xml de agenda.
        //actualizarXmlAgenda();
        //cerramos la conexión.
        mysql_close($cnx);
        //mensaje de exito.
        $titulo = "Registro Eliminado";
        $mensaje = "El registro ha sido Eliminado";
        $link = "<a href='index.php'>regresar</a>";
        include("mensajes.php");
        exit;
}

if(empty($_GET['id'])){
        header("Location: index.php");
}
?>

<html>
<head>
<title>agenda_eliminar</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="form1">
  <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" class="cabeceraBold">        Eliminar Registro</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>
        <input name="id" type="hidden" id="id" value="<?php echo $_GET['id'];?>">
      </td>
    </tr>
    <tr>
      <td>
        
        ¿Eliminar registro : <?php echo $_GET['cabecera'];?> ?<br>
      </td>
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