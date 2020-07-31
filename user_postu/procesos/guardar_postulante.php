<?php 

include '../conexion.php';


$idcon=$_POST['idcon'];
$postulante=$_POST['dnipos'];
$cargo=$_POST['idcargo'];
$recibo=$_POST['reciboid'];
$date=$_POST['dateid']; 

$sql="INSERT INTO detalle_convocatoria (convocatoria_idcon,postulante_idpostulante,cargo_idcargo,recibo,fecha_inscripcion) 
VALUES ('".$idcon."','".$postulante."','".$cargo."','".$recibo."','$date')";

$result = MYSQLI_query($con, $sql); 

if (!$result) {
    echo "gggggggggggggg";
}else{
    

    header('Location: ../listarpostulante.php?dni='.$postulante);
}


mysqli_close($con);
?>