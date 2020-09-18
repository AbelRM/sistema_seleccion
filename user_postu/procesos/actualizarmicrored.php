<?php
include '../conexion.php';

if (isset($_POST['updateData4'])) {
  $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/expe4_laboral/';
  //datos del arhivo
  $nombre_archivo = $_FILES['archivo']['name'];
  $tipo_archivo = $_FILES['archivo']['type'];
  $tamano_archivo = $_FILES['archivo']['size'];

  $dato_desencriptado = $_POST['dato_desencriptado'];
  $idestudios = $_POST['id_4puntos'];
  $lugar = $_POST['lugar1'];
  $cargo = $_POST['cargo'];
  $inicio = $_POST['fecha_inicio'];
  $fin = $_POST['fecha_fin'];

  $sql = "UPDATE expe_4puntos SET lugar='" . $lugar . "', cargo='" . $cargo . "',fecha_inicio='" . $inicio . "', fecha_fin='" . $fin . "'WHERE id_4puntos='" . $idestudios . "'";

  $result = mysqli_query($con, $sql);

  if ($result) {
    header("Location: ../exp_laboral.php?dni=$dato_desencriptado");
    // echo '<script> alert("Datos guardados exitosamente."); 
    // window.location.href = "capacitacion.php?dni=".$dato_desencriptado;
    // </script>';
  } else {
    echo '<script> alert("Error al actualizar, verifique!"); </script>';
  }
}
