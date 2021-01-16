<?php
include('../conexion.php');
if (isset($_POST['deleteData'])) {
  $deleteId = $_POST['deleteId'];
  $idcon = $_POST['idconvocatoria'];
  $dni = $_POST['dni'];

  $sql = "DELETE FROM requerimientos WHERE reque_id_personal='$deleteId'";
  $result = mysqli_query($con, $sql);

  $sql = "DELETE FROM personal_req WHERE idpersonal='$deleteId'";
  $result = mysqli_query($con, $sql);

  header('Location: ../agregar_personal_req_v2.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
  mysqli_close($con);
} elseif (isset($_POST['eliminar_practica'])) {
  $deleteId = $_POST['deleteId'];
  echo $deleteId;
  $practicas_idcon = $_POST['practicas_idcon'];
  $dni = $_POST['dni'];
  $sql = "DELETE FROM practicantes_req WHERE idpracticantes_req='$deleteId'";
  $result = mysqli_query($con, $sql);

  header('Location: ../agregar_pract_req.php?practicas_idcon=' . $practicas_idcon . '&dni=' . $dni);
  mysqli_close($con);
} elseif (isset($_POST['deleteReqe'])) {
  $deleteId = $_POST['deleteReq'];
  $idcon = $_POST['idconvocatoria'];
  $dni = $_POST['dni'];
  $sql = "DELETE FROM requerimientos WHERE id_requerimientos='$deleteId'";
  $result = mysqli_query($con, $sql);
  if ($result) {
    header('Location: ../agregar_personal_req_v2.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
    mysqli_close($con);
  } else {
    echo "$deleteId";
  }
}
