<?php

include('../conexion.php');
// $url= $_POST['url'];
//$dni =$_POST['dni'];
if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $sql = "DELETE FROM familia_post WHERE idfamilia='" . $id . "' ";
  $result = mysqli_query($con, $sql);

  if ($result) {
    echo '<script> alert("Registro eliminado."); </script>';
    // header("Location: ../exp_laboral.php?dni=$url");
    //header('Location: ../capacitacion.php?dni='$dato_desencriptado);
  } else {
    echo '<script> alert("ERROR al eliminar registro."); </script>';
  }
}
