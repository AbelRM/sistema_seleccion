<?php 

include '../conexion.php';

$titulo_profesional=$_POST['titulo_profesional'];
$titulo_especialidad=$_POST['titulo_especialidad'];
$egresado_especialidad=$_POST['egresado_especialidad'];
$grado_maestria=$_POST['grado_maestria'];
$constancia_egre_maestria=$_POST['constancia_egre_maestria'];
$grado_doctorado=$_POST['grado_doctorado'];
$constancia_egre_doctorado=$_POST['constancia_egre_doctorado'];

$sql="INSERT INTO datos_profesionales (convocatoria_idcon,postulante_idpostulante,personal_req_idpersonal,boleta,fech_inscripcion) 
VALUES ('".$idcon."','".$idpostulante."','".$personal_req."','".$boleta."','".$fech_inscripcion."')";

$result = MYSQLI_query($con, $sql); 

if ($result) {
    header('Location: ../mispostulaciones.php?dni='.$dni);
}else{
    echo "ERROR DE INGRESO";
}
mysqli_close($con);
?>