<?php 
 $cnx = conectar();
$res = mysql_query("SELECT id,cabecera FROM agenda ORDER BY fecha DESC,id DESC") or die (mysql_error());


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
?>