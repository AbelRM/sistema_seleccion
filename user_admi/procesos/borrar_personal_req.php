<?php
include('../conexion.php');
if (isset($_POST['deleteData'])) {
  $deleteId = $_POST['deleteId'];
  echo $deleteId;
  $idcon = $_POST['idconvocatoria'];
  $dni = $_POST['dni'];
  $sql = "DELETE FROM personal_req WHERE idpersonal='$deleteId'";
  $result = mysqli_query($con, $sql);

  header('Location: ../agregar_personal_req_v2.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
  mysqli_close($con);
}
