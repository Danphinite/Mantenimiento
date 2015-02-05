<?php
include ("../includes/config.php");
include ("../includes/funciones.php");
//carpeta de imagenes
$imgpath = "../fotografias/";

//sube archivos

 if( isset($_POST['submit'])){

        if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
                //echo $_FILES['imagen']['type'];
                //revisamos que sea jpg
                if ($_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/pjpeg"
				    || $_FILES['imagen']['type'] == "image/jpg"){
                        $newName = time().".jpg";
                        if(!copy($_FILES['imagen']['tmp_name'], $imgpath.$_FILES['imagen']['name'])){
                                // no se puedo subir :S
                                $error=true;
                                $errormsg = "Error1 al cargar imagen: " . $_FILES['imagen']['name'];
                        }
                        //echo "$newName subido con exito";
                        //seguimos con el insert =)
                }else{
                        $error = true;
                        $errormsg = "Formato no válido para archivo de imagen";
                }
        } else {
                $error=true;
                if($_FILES['imagen']['name'] == ""){
                        $errormsg = "No seleccionó imagen";
                }else{
                        $errormsg = "al cargar imagen: " . $_FILES['imagen']['name'];
                }
        }//fin con o sin imagen
 }
?>

<html>
<head>
<title>galer&iacute;a de im&aacute;genes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<SCRIPT LANGUAGE="JavaScript">
<!--
function fillInfo(imgPath){
        window.opener.document.form1.foto.value = imgPath;
        window.opener.document.form1.foto2.value = imgPath;
        window.opener.document['form1']['imgDisplay'].src = '<?php echo $imgpath;?>' + imgPath;
}
//-->
</SCRIPT>
<link href="../estilos.css" rel="stylesheet" type="text/css">
</head>
<?php
//*****************
//lee el directorio y despliega todos los archivos.
//

$handle=opendir($imgpath);
$count=0;
?>

<table width="400" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
                <td height="30" colspan="3" align="center" class="cabeceraBold">Para seleccionar una imagen haga click sobre ella</td>
        </tr>
          <tr>
                <td>
                  <!-- tabla para las imagenes -->
                          <table width="400" border="0" cellspacing="0" cellpadding="0" align="center">
                                <tr>
<?php
        while ($file = readdir($handle)) {
                if ($file != "." && $file != "..") {
                        $fichero = $imgpath.$file;
                        $fileData = GetImageSize($fichero);
                        echo "\n<td align=\"center\" width =\"33%\" ><a href=\"javascript:;\"><img src=\"$fichero\"/ width=100 height =100 border=0 onClick=\"javascript:fillInfo('$file');\"></a><br>$file <br>(".$fileData[0]."x". $fileData[1].")</td>";
                        $count++;
                        if($count==3){
                                $count = 0;
                                echo "</tr><tr>";
                        }
                }
        }
        closedir($handle);
?>
                        </table>
                </td>
        </tr>
         <tr>
                <td height="30" class="pie"><a href="javascript:window.close()" >Cerrar ventana</a></td>
         </tr>
        <tr>
                <td>
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="form1" >
                                <table width="400" border="0" cellspacing="0" cellpadding="0" align="center">
                                        <tr>
                                                <td align="center" >
                                                        <div class="textoBold">
                                                        <?php
                                                                  if($error){
                                                                        echo "Error: ".$errormsg;
                                                                }
                                                        ?>
                                                          </div>
                                                          <br>si no esta la imagen que busca puede grabarla Al servidor<br>
                                                        <input type="hidden" name="max_file_size" value="1000000">
                                                        Subir imagen (solo .jpg*):<br> <input name="imagen" type="file" id="imagen">
                                                </td>
                                        </tr>
                                    <tr>
                                              <td align="center" ><input name="submit" type="submit" value="Subir"></td>
                                    </tr>
                                  </table>
                        </form>
                </td>
        </tr>
 </tr>
 <tr>
         <td height="30" class="pie"><a href="javascript:window.close()" >Cerrar ventana</a></td>
 </tr>
</table>
</body>
</html>