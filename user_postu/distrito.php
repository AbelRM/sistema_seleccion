<?php
include "conexion.php";

$query=$con->query("select * from distrito where provincia_idprovincia=$_GET[provincia_idprovincia]");
$states = array();
while($r=$query->fetch_object()){ $states[]=$r; }
if(count($states)>0){
print "<option value=''>-- SELECCIONE --</option>";
foreach ($states as $s) {
	print "<option value='$s->iddistrito'>$s->distrito</option>";
}
}else{
print "<option value=''>-- NO HAY DATOS --</option>";
}
?>