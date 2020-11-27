<?php

include '../conexion.php';

$id_con = $_POST['id'];
$dato_desencriptado = $_POST['dni'];

$numerocon = $_POST['num_con'];
$tipocon = $_POST['tipo_con'];
$aniocon = $_POST['anio_con'];
$fechini = $_POST['fech_ini'];
$fechterm = $_POST['fech_term'];
$porcenevacu = $_POST['porcen_eva_cu'];
$porceentrevista = $_POST['porce_entrevista'];
$porcediscapacidad = $_POST['porce_discapacidad'];
$porcemilitar = $_POST['porce_sermilitar'];
$porceexaescrito = $_POST['porce_exa_escrito'];
$estado = $_POST['estado'];

$sql = "UPDATE convocatoria SET num_con='$numerocon',anio_con='$aniocon', tipo_con='$tipocon',fech_ini='$fechini',fech_term='$fechterm', 
porcen_eva_cu='$porcenevacu',porce_entrevista='$porceentrevista', porce_discapacidad='$porcediscapacidad',porce_sermilitar='$porcemilitar',
porce_exa_escrito='$porceexaescrito', estado='$estado' WHERE idcon='$id_con'";

$result = mysqli_query($con, $sql);

if ($result) {
  header('Location: ../modificar_personalreq.php?dni=' . $dato_desencriptado . '&id=' . $id_con);
} else {
  echo '<script> alert("Error al guardar"); </script>';
  echo "<script type=\"text/javascript\">history.go(-1);</script>";
}
