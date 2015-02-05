function redirige(operacion)
{
	
	//alert (operacion);

	var rads = document.getElementsByName("noticia");
    var idNoticia;
	for (i=0; i < rads.length; i++)
	{
		if (rads[i].checked)
			idNoticia = rads[i].value;
    }
    

		if (idNoticia == undefined)
			alert ("Seleccione noticia");
		else
		{

  // alert(operacion + " : " + idNoticia);  
  switch (operacion)
  {

  	case "ver":
  	document.location.href= "agenda_ver.php?id=" + idNoticia + "";
  	break;
  	case "editar":
  	document.location.href= "agenda_editar.php?id=" + idNoticia + "";
  	break;
  	case "borrar":
  	document.location.href= "agenda_borrar.php?id=" + idNoticia + "";
  	break;

  }  
}
}
