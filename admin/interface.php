<?php
$documentLocation = $_SERVER['PHP_SELF'];
if ( $_SERVER['QUERY_STRING'] ) {
	$documentLocation .= "?" . $_SERVER['QUERY_STRING'];
}

?>
<html><head>
<title></title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<SCRIPT LANGUAGE="JavaScript">
<!--
function checkData() {
	var f1 = document.forms[0];
	var wm = "Ocurrieron los siguientes Errores :\n\r\n";
	var noerror = 1;
	var t1 = f1.usuario_digitado;
	if (t1.value == "" || t1.value == " ") {
		wm += "Digite su nombre de Usuario\r\n";
		noerror = 0;
	}
	var t1 = f1.clave_digitada;
	if (t1.value == "" || t1.value == " ") {
		wm += "Digite la contraseña\r\n";
		noerror = 0;
	}
	if (noerror == 0) {
		//alert(wm);
		//return false;
		document.getElementById("mensaje").innerHTML = wm;
	}
	else 
	{
      
	  f1.submit();
	}
}
//-->
</SCRIPT>
<link href="../estilos.css" rel="stylesheet" type="text/css">
</head>

<body onLoad="document.form1.usuario_digitado.focus()" ><center>
<form name="form1" action='<?PHP echo $documentLocation?>' METHOD="post"> 
<!-- onSubmit="return checkData()"> -->

<TABLE WIDTH="500" CELLPADDING="0" cellspacing="0" BACKGROUND="">
            <TR> 
              <TD height="30" COLSPAN="2" ALIGN="left" class="cabeceraBold">Ingreso de Usuarios</TD>
            </TR>
            <TR> 
              <TD height="24" COLSPAN="2" ALIGN="center" class="textoBold"> <I><NOBR>
                
			
			
			<div id = "mensaje">
              <?php
              
              // revisa si hay mensajes de error.
			      if (isset($message))
				      echo $message;			 
			  ?>
 			</div>
                </NOBR></I> </TD>
            </TR>
            <tr> 
              <td ALIGN="right" VALIGN="bottom"> <table width="500" cellpadding=4 cellspacing=1 BACKGROUND="">
                  <tr> 
                    <td align="right" class="textoBold">usuario: </td>
                    <td> <INPUT TYPE="text" NAME="usuario_digitado" VALUE="<?php
                       if (isset ($_SESSION['usuario']))
                       	     echo trim($_SESSION['usuario']);
                       	 else echo "";
                    ?>"></td>
                  </tr>
                  <tr> 
                    <td align="right" class="textoBold">contraseña: </td>
                    <td> <INPUT TYPE="password" NAME="clave_digitada"></td>
                  </tr>
                  <tr> 
                    <td>&nbsp;</td>
                    <td align="right"><input name="Submit" type="button" value="Submit" onClick="return checkData();"></td>
                  </tr>
                </table></td>
            </tr>
		            <TR> 
              <TD height="30" COLSPAN="2" ALIGN="left" class="pie">&nbsp;</TD>
            </TR>	
    </table>
</form>
</center>
</body></html>
