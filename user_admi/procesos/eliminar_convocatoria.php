<?php
include('../conexion.php');

if (isset($_POST['deleteData'])) {
  $url = $_POST['dni_url'];
  $dni_base = $_POST['dni_base_4'];
  $id = $_POST['id_convocatoria'];

  $elimComision = "DELETE FROM comision WHERE convocatoria_idcon='" . $id . "' ";
  $resultado = mysqli_query($con, $elimComision);

  $select = "SELECT * FROM personal_req WHERE convocatoria_idcon = '$id'";
  $resultado_1 = mysqli_query($con, $select);
  $row = mysqli_fetch_array($resultado_1);


  $elimPersonal = "DELETE FROM comision WHERE convocatoria_idcon='" . $id . "' ";
  $resultado = mysqli_query($con, $elimComision);

  $sql = "DELETE FROM convocatoria WHERE id_4puntos='" . $id . "' ";
  $result = mysqli_query($con, $sql);

  unlink($ruta . $archivo);
  if ($result) {

    echo "<script type=\"text/javascript\">history.go(-1);</script>";
    // header("Location: ../exp_laboral.php?dni=$url");
  } else {
    echo '<script> alert("ERROR al eliminar registro."); </script>';
    echo "<script type=\"text/javascript\">history.go(-1);</script>";
  }
}
