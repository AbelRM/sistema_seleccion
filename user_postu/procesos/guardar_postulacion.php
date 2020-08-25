<?php 

include '../conexion.php';

$dni=$_POST['dni'];
$idcon=$_POST['idcon'];
$idpostulante=$_POST['idpostulante'];
$personal_req=$_POST['idpersonal'];
$boleta=$_POST['boleta'];
// $fecha_postulacion=$_POST['fecha_postulacion'];
$date = date('Y-m-d');

$sql="INSERT INTO detalle_convocatoria (convocatoria_idcon,postulante_idpostulante,personal_req_idpersonal,boleta,fecha_postulacion) 
VALUES ('".$idcon."','".$idpostulante."','".$personal_req."','".$boleta."','".$date."')";

$result = MYSQLI_query($con, $sql); 

if ($result) {
    header('Location: ../mispostulaciones.php?dni='.$dni);
}else{
    echo "ERROR DE INGRESO";
}
mysqli_close($con);
?>