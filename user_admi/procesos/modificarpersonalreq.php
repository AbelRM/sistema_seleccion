<?php 

include '../conexion.php';

$id=$_POST['id'];
$dato_desencriptado=$_POST['dni'];

$direccion=$_POST['direccion'];
$equipo=$_POST['equipo'];


$sql= "UPDATE direccion_ejec SET  direccion_ejec='$direccion', equipo_ejec_idequipo='$equipo' WHERE iddireccion='$id'";   

$result=mysqli_query($con,$sql);



header('Location: ../direccion_ejec.php?dni='.$dato_desencriptado);
mysqli_close($con);  
?>