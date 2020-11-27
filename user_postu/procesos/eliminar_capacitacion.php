<?php

include('../conexion.php');
$url = $_POST['url'];
//$dni =$_POST['dni'];


if (isset($_POST['deleteData1'])) {
  $id = $_POST['id1'];

  $consulta = "SELECT * FROM maestria_doc  WHERE idmaestria_doc='$id'";
  $resultado = mysqli_query($con, $consulta);
  $row = MySQLI_fetch_array($resultado);
  $archivo = $row['archivo'];
  $ruta = "../archivos/" . $url . "/Postgrado/";
  unlink($ruta . $archivo);

  $sql = "DELETE FROM maestria_doc WHERE idmaestria_doc='" . $id . "' ";
  $result = mysqli_query($con, $sql);

  if ($result) {
    echo '<script> alert("Registro eliminado!"); </script>';
    header("Location: ../capacitacion.php?dni=$url");
    //header('Location: ../capacitacion.php?dni='$dato_desencriptado);
  } else {
    echo '<script> alert("ERROR al eliminar registro."); </script>';
  }
} elseif (isset($_POST['deleteData2'])) {
  $id = $_POST['id2'];
  $consulta = "SELECT * FROM cursos_extra  WHERE idcursos_extra='$id'";
  $resultado = mysqli_query($con, $consulta);
  $row = MySQLI_fetch_array($resultado);
  $archivo = $row['archivo'];
  $ruta = "../archivos/" . $url . "/Diplomados/";
  unlink($ruta . $archivo);

  $sql = "DELETE FROM cursos_extra WHERE idcursos_extra='" . $id . "' ";
  $result = mysqli_query($con, $sql);

  if ($result) {
    echo '<script> alert("Registro eliminado!"); </script>';
    header("Location: ../capacitacion.php?dni=$url");
  } else {
    echo '<script> alert("ERROR al eliminar registro."); </script>';
  }
} elseif (isset($_POST['deleteData3'])) {
  $id = $_POST['id3'];

  $consulta = "SELECT * FROM idiomas_comp  WHERE ididiomas_comp='$id'";
  $resultado = mysqli_query($con, $consulta);
  $row = MySQLI_fetch_array($resultado);
  $archivo = $row['archivo'];
  $ruta = "../archivos/" . $url . "/Idiomas_Computacion/";
  unlink($ruta . $archivo);

  $sql = "DELETE FROM idiomas_comp WHERE ididiomas_comp='" . $id . "' ";
  $result = mysqli_query($con, $sql);

  if ($result) {
    echo "Elimnado correctamente";
  } else {
    echo "Error al eliminar el dato";
  }
}
