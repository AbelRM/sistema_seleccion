<?php

include('../conexion.php');
$url = $_POST['url'];
$idpostulante = $_POST['idpostulante'];

if (isset($_POST['deleteData'])) {
  $id = $_POST['id'];
  $consulta = "DELETE FROM detalle_conv_prac WHERE iddetalle_conv_prac='$id'";
  $resultado = mysqli_query($con, $consulta);

  if ($resultado) {
    $sql = "UPDATE postulante SET id_practicas = NULL, post_id_practicantes_req = NULL WHERE idpostulante='$idpostulante' ";
    $result = mysqli_query($con, $sql);
    if ($result) {
      header("Location: ../mispostulaciones_prac.php?dni=$url");
    } else {
      echo '<script> alert("ERROR al actualzar postulante."); </script>';
    }
  } else {
    echo '<script> alert("ERROR al eliminar registro."); </script>';
  }
} elseif (isset($_POST['deletePostu'])) {
    
  $id = $_POST['id'];
  $consul_detalle = "SELECT * FROM detalle_convocatoria WHERE iddetalle_convocatoria = '$id'";
  $result_detalle = mysqli_query($con, $consul_detalle);
  $array= mysqli_fetch_array($result_detalle);
  $id_eva_curri_cas = $array['id_eva_curri_cas'];
  $consulta = "DELETE FROM detalle_convocatoria WHERE iddetalle_convocatoria='$id'";
  $resultado = mysqli_query($con, $consulta);

  if ($resultado) {
    $sql = "UPDATE postulante SET id_convocatoria = NULL , post_id_personal_req = NULL WHERE idpostulante='$idpostulante' ";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $consulta_dele = "DELETE FROM evaluacion_curri_cas WHERE id_eva_curricular='$id_eva_curri_cas'";
        $resultado_dele = mysqli_query($con, $consulta_dele);
        header("Location: ../mispostulaciones_prac.php?dni=$url");
    } else {
      echo '<script> alert("ERROR al actualzar postulante."); </script>';
    }
  } else {
    echo '<script> alert("ERROR al eliminar registro."); </script>';
  }
}
