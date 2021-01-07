<?php
	include "conexion.php";  
	$query=$con->query("select * from provincia where departamento_iddepartamento=$_GET[departamento_iddepartamento]");
	$states = array();
	while($r=$query->fetch_object()){ $states[]=$r; }
	if(count($states)>0){
	print "<option value=''>-- SELECCIONE --</option>";
	foreach ($states as $s) {
		print "<option value='$s->idprovincia'>$s->provincia</option>";
	}
	}else{
	print "<option value=''>-- NO HAY DATOS --</option>";
	}
?>