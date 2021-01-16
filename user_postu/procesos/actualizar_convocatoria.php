<?php
include '../conexion.php';
date_default_timezone_set('America/Lima');
$date = date('Y-m-d');

$consulta = mysqli_query($con, "SELECT * FROM convocatoria");
while ($row = mysqli_fetch_array($consulta)) {
  $idcon = $row['idcon'];
  $fech_term = $row['fech_term'];
  if ($fech_term >= $date) {
    $update = mysqli_query($con, "UPDATE convocatoria SET estado = 'CONCLUYO' WHERE idcon ='$idcon'");
  }
}

//ACTUALIZACION DE PRACTICAS
$consulta_prac = mysqli_query($con, "SELECT * FROM practicas");
while ($rw = mysqli_fetch_array($consulta_prac)) {
  $idpracticas = $rw['idpracticas'];
  $fech_termino = $rw['fech_termino'];
  if ($fech_termino >= $date) {
    $update = mysqli_query($con, "UPDATE practicas SET estado_con = 'CONCLUYO' WHERE idpracticas ='$idpracticas'");
  }
}
