<?php 

include '../conexion.php';

$id=$_POST['id'];
$dato_desencriptado=$_POST['dni'];

$cargo=$_POST['cargo'];
$tipo=$_POST['tipo'];


$sql= "UPDATE cargo SET  cargo='$cargo', tipo_cargo_id='$tipo' WHERE idcargo='$id'";   

$result=mysqli_query($con,$sql);



header('Location: ../cargos.php?dni='.$dato_desencriptado);
mysqli_close($con);  
?>