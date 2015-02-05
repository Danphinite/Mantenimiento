<?php
function validarUsuario($usr, $clave)
{
  $conexion = conectar();
  $consulta = "SELECT * FROM usuarios WHERE usuario = '$usr'";
  $datos = mysql_query($consulta, $conexion); 
  $numRegistros = mysql_num_rows($datos);
  if  ($numRegistros != 0) // usuario existe
  {
     $registro = mysql_fetch_array($datos);
     if ($registro['clave'] == $_SESSION['clave'])
	 {
        // echo "Acceso concedido";
		 return true;
	 } 
  } 
  //echo "Acceso denegado";
  return false;
}
/***
función conectar
que = se conecta a mysql y devuelve el identificador de conexión
***/
function conectar(){
	global $HOSTNAME,$USERNAME,$PASSWORD,$DATABASE;
	$idcnx = mysql_connect($HOSTNAME, $USERNAME, $PASSWORD) or DIE(mysql_error());
	mysql_select_db($DATABASE, $idcnx);
	return $idcnx;
}
// FUNCIONES DEL PAGINADOR ...

function muestraRegistros($p){
	global $NRPP;
	 $cnx = conectar();
	$regInicio= ($p - 1) * $NRPP;
	$res = mysql_query("SELECT id,cabecera FROM agenda  ORDER BY id  LIMIT $regInicio ,$NRPP") or die (mysql_error());
		if (mysql_num_rows($res) > 0) {
			//si hay resultados.
			while(list($id,$cabecera) = mysql_fetch_array($res)){
			?>
	 <tr>
	   <td class="texto"><?php echo $id;?></td>
	   <td class="texto"><?php echo $cabecera;?></td>
	   <td align="center" class="pie"><a href="agenda_ver.php?id=<?php echo $id;?>">ver</a></td>
	   <td align="center" class="pie"><a href="agenda_editar.php?id=<?php echo $id;?>">editar</a></td>
	   <td align="center" class="pie"><a href="agenda_borrar.php?id=<?php echo $id;?>&cabecera=<?php echo $cabecera;?>">borrar</a></td>
	 </tr>
			<?php
			}//fin del while
		}else{
			//no hay resultados
			?>
	 <tr>
	   <td colspan="5" align="center">No hay datos</td>
	 </tr>
			<?php
		}//fin del if/else de resultados	
}
function muestraRegistrosRadio($p){
	global $NRPP;
	 $cnx = conectar();
	$regInicio= ($p - 1) * $NRPP;
	$res = mysql_query("SELECT id,cabecera FROM agenda  ORDER BY id  LIMIT $regInicio ,$NRPP") or die (mysql_error());
		if (mysql_num_rows($res) > 0) {
			
			echo "<FORM method=\"POST\">"; 
			//si hay resultados.
			while(list($id,$cabecera) = mysql_fetch_array($res)){
			?>
	 <tr>
	   
	   <td class="texto"><?php echo "<INPUT TYPE='RADIO' id=\"$id\" NAME='noticia' VALUE='$id'>";
                  ?></TD>
                  <td class="texto"><LABEL FOR=<?php echo "\"$id\" >$cabecera </LABEL> </td>";?>

	                  
	   	 </tr>
			<?php
			}//fin del while
			echo "</FORM>";
			?>
                <A HREF="#" id="ver"    onclick ="redirige(this.id);"> Ver </A>
                <A HREF="#" id="editar" onclick ="redirige(this.id);"> Editar </A>
                <A HREF="#" id="borrar" onclick ="redirige(this.id);"> Borrar </A>
			<?php
		}else{
			//no hay resultados
			?>
	 <tr>
	   <td colspan="5" align="center">No hay datos</td>
	 </tr>
			<?php
		}//fin del if/else de resultados	
}

function barraPaginador() {
	global $NRPP;
	 $cnx = conectar();	
		$res = mysql_query("SELECT id FROM agenda ") or die (mysql_error());
		$NP = mysql_num_rows($res) / $NRPP;
		$resto = mysql_num_rows($res) % $NRPP;

		if ($resto != 0)
			$NP++;
		//echo "Num paginas $NP";
		for ($i=1;$i<=$NP;$i++){
			echo "<A HREF='".$_SERVER['PHP_SELF']."?pagina=".$i."'>". ($i) ."</A>&nbsp;&nbsp;";
			
		}
		
}
// FIN DE FUNCIONES DEL PAGINADOR ...
/**
función generar_xml
genera el archivo directoio.xml
**/
function generar_xml() {
	//nombre del xml.
	$nombreFichero = "directorio.xml";
	//sql para el xml ( todo los datos )
	$sqlFichero = "SELECT * FROM directorio";
	//resultado de consulta de fichero.
	$resFichero = mysql_query($sqlFichero) or die("No se puedo actualizar fichero xml");
	//revisamos si hay datos.
	if(mysql_num_rows($resFichero) > 0){
		$salida = "<datos>\n";
		//parseamos la información guardándola en $salida.
		while($fila = mysql_fetch_array($resFichero)){
			$salida .= "\t<registro ";
			$salida.="id='".$fila['id']."'";
			$salida.=" nombre='".utf8_encode($fila['nombre'])."'";
			$salida.=" apellido='".utf8_encode($fila['apellido'])."'";
			$salida.=" nick='".utf8_encode($fila['nick'])."'";
			$salida.=" email='".$fila['email']."'";
			$salida.=" url='".$fila['url']."'/>\n";
		}
		//cerramos la etiqueta principal
		$salida.="</datos>";
		//creación del fichero.
		//lo abrimos
		$fp = fopen($nombreFichero,"w");
		//escribimos el contenido de $salida en el.
		fwrite($fp,$salida);
		//cerramos el archivo
		fclose($fp);
	}else{
		//si no hay datos borramos el xml.
		unlink($nombreFichero);
	}
}
$meses = array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 //list box con los meses.
function makeMesList($nombre,$selected){
 	global $meses;
 	$poner ="";
	if(!isSet($selected)){$poner = "selected";}
	echo"\n\t<select name=\"$nombre\" >\n\t<option value=\"00\" $poner>Seleccione</option>\n";
	for ($n=0; $n<sizeof($meses);$n++){
		$poner = ($n < 10)?($poner = "0".$n):($poner = $n);
		$current=($poner==$selected)?(" selected"):("");
		echo"\t\t<option value=\"$poner\" $current>".$meses[$n]."</option>\n";
	}
	echo "\n\t</select>";
}//fin makeMesList

 //list box con números.
function makeNumList($from,$cuantos,$nombre,$selected){
	echo"\n\t<select name=\"$nombre\">\n\t";
	for ($n=$from; $n<($from+$cuantos);$n++){
		$poner = ($n < 10)?($poner = "0".$n):($poner = $n);
		$current=($poner==$selected)?(" selected"):("");
		echo"\t\t<option value=\"$poner\" $current>$poner</option>\n";
	}
	echo "\t</select>";
}//fin makeNumList

function  formatFecha($fecha){
	global $meses;
	$mes =substr($fecha, 4, 2);
	settype($mes,"integer");
	return ($meses[$mes].date( " d,Y", mktime(0,0,0,substr ($fecha, 4, 2),substr ($fecha, 6, 2),substr ($fecha, 0, 4)) ));
   
} // end func

//actualiza el xml de agenda.

function actualizarXmlAgenda(){
	//nombre del xml
	$agendaxml = "../agenda.xml";
	$res = mysql_query("SELECT id,cabecera,fecha,foto FROM agenda ORDER BY fecha DESC,id DESC")or die(mysql_error());
	if( mysql_num_rows ($res) > 0 ){
		$salida = "<agenda>\n";
		//organidor por fecha
		$cfecha = 0;
		while(list($id,$cabecera,$fecha,$foto) = mysql_fetch_array($res)){
			//revisamos si hay cambio de fecha.
			if($fecha != $cfecha){
				//si es la primer fecha.
				if($cfecha == 0){
					//es la primer etiqueta.
					$salida .= "\t<noticia dia='$fecha'>\n";
				}else{
					//no es la primer fecha, cerramos la etiqueta anterior y ponemos la nueva.
					$salida .="\t</noticia>\n\t<noticia dia='$fecha'>\n";
				}
				//actualizamos cfecha.
				$cfecha = $fecha;
			}//fin if de fecha.
			
			//datos normales.
			//revisamos si tiene o no imagen.
			$fotoUrl = ($foto == "" || $foto == "N/A")?("n/a"):("fotografias/$foto");
			$salida .= "\t\t<datos id='$id' cabecera='".utf8_encode($cabecera)."' foto='$fotoUrl' />\n";
		}//fin del while
		//fin del xml
		$salida .="\t</noticia>\n</agenda>";
		//abrimos el fichero.
		$fp = fopen($agendaxml,"w");
		//escribimos el contenido de $salida en el.
		fwrite($fp,$salida);
		//cerramos el fichero
		fclose($fp);
	}else{
		//no hay registros borramos la agenda
		//revisamos si el archivo existe
		if( is_file($agendaxml)){
			//si existe lo borramos
			unlink ($agendaxml);
		}
	}//fin if/else de resltados
} // end func
?>
