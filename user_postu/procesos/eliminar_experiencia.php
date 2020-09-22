<?php
include('../conexion.php');

if (isset($_POST['deleteData4'])) {
  $url = $_POST['dni_url_4'];
  $dni_base = $_POST['dni_base_4'];
  $id = $_POST['id4'];

  $consulta = "SELECT * FROM expe_4puntos  WHERE id_4puntos='$id'";
  $resultado = mysqli_query($con, $consulta);
  $row = MySQLI_fetch_array($resultado);
  $archivo = $row['archivos'];
  $ruta = "../archivos/" . $dni_base . "/expe4_laboral/";

  $sql = "DELETE FROM expe_4puntos WHERE id_4puntos='" . $id . "' ";
  $result = mysqli_query($con, $sql);

  unlink($ruta . $archivo);
  if ($result) {
    echo '<script> alert("Registro eliminado!"); </script>';
    header("Location: ../exp_laboral.php?dni=$url");
  } else {
    echo '<script> alert("ERROR al eliminar registro."); </script>';
  }
} elseif (isset($_POST['deleteData3'])) {
  $url = $_POST['dni_url_3'];
  $dni_base = $_POST['dni_base_3'];
  $id = $_POST['id3'];

  $consulta = "SELECT * FROM expe_3puntos  WHERE id_3puntos='$id'";
  $resultado = mysqli_query($con, $consulta);
  $row = MySQLI_fetch_array($resultado);
  $archivo = $row['archivos'];
  $ruta = "../archivos/" . $dni_base . "/expe3_laboral/";

  $sql = "DELETE FROM expe_3puntos WHERE id_3puntos='" . $id . "' ";
  $result = mysqli_query($con, $sql);

  unlink($ruta . $archivo);
  if ($result) {
    echo '<script> alert("Registro eliminado"); </script>';
    header("Location: ../exp_laboral.php?dni=$url");
  } else {
    echo '<script> alert("ERROR al eliminar registro."); </script>';
  }
} elseif (isset($_POST['deleteData1'])) {
  $url = $_POST['dni_url_1'];
  $dni_base = $_POST['dni_base_1'];
  $id = $_POST['id1'];

  $consulta = "SELECT * FROM expe_1puntos  WHERE id_1puntos='$id'";
  $resultado = mysqli_query($con, $consulta);
  $row = MySQLI_fetch_array($resultado);
  $archivo = $row['archivos'];
  $ruta = "../archivos/" . $dni_base . "/expe1_laboral/";

  $sql = "DELETE FROM expe_1puntos WHERE id_1puntos='" . $id . "' ";
  $result = mysqli_query($con, $sql);

  unlink($ruta . $archivo);
  if ($result) {
    echo '<script> alert("Registro eliminado!"); </script>';
    header("Location: ../exp_laboral.php?dni=$url");
  } else {
    echo '<script> alert("ERROR al eliminar registro."); </script>';
  }
} elseif (isset($_POST['deleteData5'])) {
  $dato_desencriptado = $_POST['dato_desencriptado'];
  $dni_base = $_POST['dni4_tipo2'];
  echo $dni_base;
  $id = $_POST['id_4puntos_tipo2'];

  $consulta = "SELECT * FROM expe_4puntos  WHERE id_4puntos='$id'";
  $resultado = mysqli_query($con, $consulta);
  $row = MySQLI_fetch_array($resultado);
  $archivo = $row['archivos'];
  $ruta = $_SERVER['DOCUMENT_ROOT'] . "/sistema_seleccion/user_postu/archivos/" . $dni_base . "/expe4_laboral/";

  $sql = "DELETE FROM expe_4puntos WHERE id_4puntos='" . $id . "' ";
  $result = mysqli_query($con, $sql);

  unlink($ruta . $archivo);
  if ($result) {
    echo '<script> alert("Registro eliminado!"); </script>';
    // header("Location: ../exp_laboral.php?dni=$dato_desencriptado");
  } else {
    echo '<script> alert("ERROR al eliminar registro."); </script>';
  }
}
