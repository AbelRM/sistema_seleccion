<?php
include '../conexion.php';
// Update data into the database
if (isset($_POST['updateData4'])) {
  $dato_desencriptado = $_POST['dato_desencriptado'];
  $idestudios = $_POST['id_4puntos'];
  $dni = $_POST['dni4'];

  $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/expe4_laboral/';
  //datos del arhivo
  $nombre_archivo = $_FILES['archivos4']['name'];
  $tipo_archivo = $_FILES['archivos4']['type'];
  $tamano_archivo = $_FILES['archivos4']['size'];

  $lugar = $_POST['lugar1'];
  $cargo = $_POST['cargo'];
  $fech_inicio = $_POST['fecha_inicio'];
  $fech_fin = $_POST['fecha_fin'];

  /// VALORES AÑOS, MESES Y DIAS ///
  $fechainicial = new DateTime($fech_inicio);
  $fechaactual = new DateTime($fech_fin);
  $diferencia = $fechainicial->diff($fechaactual);
  $años = $diferencia->format('%Y');
  $meses = $diferencia->format('%m');
  $dias = $diferencia->format('%d');

  $sql = "UPDATE expe_4puntos SET 
  lugar='" . $lugar . "', cargo='" . $cargo . "',fecha_inicio='" . $fech_inicio . "', fecha_fin='" . $fech_fin . "', anios='" . $años . "', meses='" . $meses . "', dias='" . $dias . "', archivos='" . $fin . "'
  WHERE id_4puntos='" . $idestudios . "'";

  $result = mysqli_query($con, $sql);

  if ($result) {
    header("Location: ../exp_laboral.php?dni=$dato_desencriptado");
  } else {
    echo '<script> alert("Error al actualizar, verifique!"); </script>';
  }
}
