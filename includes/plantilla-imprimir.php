<?
if(empty($_GET['id'])){
	exit;
}
?>
<html>
<head>
<title>
<? echo $cabecera;?>
</title>

<link href="estilos.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#DDDDDD" marginwidth="0" marginheight="0" topmargin="0" leftmargin="00">
<table width="450" height="350" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr height="30">
    <td valign="top" class="cabecera"> <span class="cabeceraBold"><? echo $fecha;?></span><br>
    <? echo $cabecera;?></td>
  </tr>
  <tr>
    <td  valign="top" class="texto"><?echo $texto?><br></td>
  </tr>
  <? 
	if($foto != "N/A" && !empty($foto)){
			//hay foto.
	?>
  <tr>
    <td align="center"> <img src="fotografias/<?echo $foto;?>" alt="<? echo $cabecera?>"> </td>
  </tr>
	<?
	}//fin if de foto
	?>
  <tr height="30">
    <td valign="top" class="pie"> <a href="javascript:window.print()">imprimir
            esta noticia</a> | <a href="javascript:window.close()">cerrar
    ventana</a></td>
  </tr>
</table>
</body>

</html>
