<?php 

include '../conexion.php';

$id=$_POST['id'];
$dato_desencriptado=$_POST['dni'];

$direccion=$_POST['direccion'];
$equipo=$_POST['valor'];


$sql= "UPDATE requerimientos SET  condicion='$direccion', valor_condicion='$equipo' WHERE id_requerimientos='$id'";   

$result=mysqli_query($con,$sql);



header('Location: ../requisitos.php?dni='.$dato_desencriptado);
mysqli_close($con);  
?>