<?php 

include '../conexion.php';

$dni=$_POST['dni'];
$idcon=$_POST['idcon'];
$idpostulante=$_POST['idpostulante'];
$personal_req=$_POST['idpersonal'];
$boleta=$_POST['boleta'];
$date=$_POST['dateid']; 
$tipo_cargo=$_POST['tipo_cargo'];

$sql="INSERT INTO detalle_convocatoria (convocatoria_idcon,postulante_idpostulante,personal_req_idpersonal,boleta,fecha_inscripcion,tipo_cargo) 
VALUES ('".$idcon."','".$idpostulante."','".$personal_req."','".$boleta."','".$date."','".$tipo_cargo."')";

$result = MYSQLI_query($con, $sql); 

if ($result) {
    header('Location: ../mispostulaciones.php?dni='.$dni);
}else{
    echo "ERROR DE INGRESO";
}
mysqli_close($con);
?>