<?php
include_once('../conexion.php');

$dni = $_POST['dni'];
//////////////////////// PRESIONAR EL BOTÓN //////////////////////////         
if (isset($_POST['agregar_comision'])) {
  $idcon = $_POST['idconvocatoria'];

  $cargo = ($_POST['cargo']);
  $nombres = ($_POST['nombres']);
  $apellidos = ($_POST['apellidos']);
  $area_usuaria = ($_POST['area_usuaria']);

  if ($area_usuaria == 'Otro') {
    $otro_area = $_POST['otro_area'];
    $sql = "INSERT INTO comision (cargo_funcio, nombre, apellidos,area_user,otro_area_user, convocatoria_idcon) VALUES ('$cargo','$nombres','$apellidos','$area_usuaria','$otro_area','$idcon')";
    $sqlRes = $con->query($sql) or mysqli_error($con);
    if ($sqlRes) {
      header('Location: ../agregar_comision.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
    } else {
      echo '<script> alert("Error al guardar la comision"); 
          window.history.back(-1);</script>';
    }
  } else {
    $sql = "INSERT INTO comision (cargo_funcio, nombre, apellidos,area_user, convocatoria_idcon) VALUES ('$cargo','$nombres','$apellidos','$area_usuaria','$idcon')";

    $sqlRes = $con->query($sql) or mysqli_error($con);
    if ($sqlRes) {
      header('Location: ../agregar_comision.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
    } else {
      echo '<script> alert("Error al guardar la comision"); 
          window.history.back(-1);</script>';
    }
  }
} elseif (isset($_POST['agregar_comision_prac'])) {
  $idcon = $_POST['practicas_idcon'];

  $cargo = ($_POST['cargo']);
  $nombres = ($_POST['nombres']);
  $apellidos = ($_POST['apellidos']);
  $area_usuaria = ($_POST['area_usuaria']);

  if ($area_usuaria == 'Otro') {
    $otro_area = $_POST['otro_area'];
    $sql = "INSERT INTO comision_pract (cargo_funcio, nombre, apellidos,area_user,otro_area_user, practicas_idcon) VALUES ('$cargo','$nombres','$apellidos','$area_usuaria','$otro_area','$idcon')";
    $sqlRes = $con->query($sql) or mysqli_error($con);
    if ($sqlRes) {
      header('Location: ../agregar_comision_prac.php?practicas_idcon=' . $idcon . '&dni=' . $dni);
    } else {
      echo '<script> alert("Error al guardar la comision practicantes"); 
          window.history.back(-1);</script>';
    }
  } else {
    $sql = "INSERT INTO comision_pract (cargo_funcio, nombre, apellidos,area_user, practicas_idcon) VALUES ('$cargo','$nombres','$apellidos','$area_usuaria','$idcon')";

    $sqlRes = $con->query($sql) or mysqli_error($con);
    if ($sqlRes) {
      header('Location: ../agregar_comision_prac.php?practicas_idcon=' . $idcon . '&dni=' . $dni);
    } else {
      echo '<script> alert("Error al guardar la comision practicantes"); 
          window.history.back(-1);</script>';
    }
  }
} elseif (isset($_POST['actualizar_comision'])) {
  $idcon = $_POST['idconvocatoria'];
  $idcomision = $_POST['idcomision'];

  $cargo = ($_POST['cargo_update']);
  $nombres = ($_POST['nombres_update']);
  $apellidos = ($_POST['apellidos_update']);
  $area_usuaria = ($_POST['area_usuaria_update']);

  if ($area_usuaria == 'Otro') {
    $otro_area = $_POST['otro_area_update'];
    $sql = "UPDATE comision SET cargo_funcio='$cargo', nombre='$nombres', apellidos='$apellidos',area_user='$area_usuaria',otro_area_user='$otro_area',convocatoria_idcon='$idcon' WHERE idcomision = '$idcomision'";
    $sqlRes = $con->query($sql) or mysqli_error($con);
    if ($sqlRes) {
      header('Location: ../agregar_comision.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
    } else {
      echo '<script> alert("Error al actualizar la comision"); 
          window.history.back(-1);</script>';
    }
  } else {
    $sql = "INSERT INTO comision SET cargo_funcio='$cargo', nombre='$nombres', apellidos='$apellidos',area_user='$area_usuaria',convocatoria_idcon='$idcon' WHERE idcomision = '$idcomision'";

    $sqlRes = $con->query($sql) or mysqli_error($con);
    if ($sqlRes) {
      header('Location: ../agregar_comision.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
    } else {
      echo '<script> alert("Error al actualizar la comision"); 
          window.history.back(-1);</script>';
    }
  }
} elseif (isset($_POST['deleteComision'])) {
  $idcon = $_POST['idconvocatoria'];

  $idcomision = ($_POST['idcomision_delete']);

  $sql = "DELETE FROM comision WHERE idcomision = '$idcomision'";
  $sqlRes = $con->query($sql) or mysqli_error($con);
  if ($sqlRes) {
    echo $idcomision;
    // header('Location: ../agregar_comision.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
  } else {
    echo '<script> alert("Error al guardar la comision"); 
          window.history.back(-1);</script>';
  }
} elseif (isset($_POST['actualizar_comision_prac'])) {
  $idcon = $_POST['practicas_idcon'];
  $idcomision = $_POST['idcomision'];

  $cargo = ($_POST['cargo_update']);
  $nombres = ($_POST['nombres_update']);
  $apellidos = ($_POST['apellidos_update']);
  $area_usuaria = ($_POST['area_usuaria_update']);

  if ($area_usuaria == 'Otro') {
    $otro_area = $_POST['otro_area_update'];
    $sql = "UPDATE comision_pract SET cargo_funcio='$cargo', nombre='$nombres', apellidos='$apellidos',area_user='$area_usuaria',otro_area_user='$otro_area',practicas_idcon='$idcon' WHERE idcomision_pract='$idcomision'";
    $sqlRes = $con->query($sql) or mysqli_error($con);
    if ($sqlRes) {
      header('Location: ../agregar_comision_prac.php?practicas_idcon=' . $idcon . '&dni=' . $dni . '#tabla_comision');
    } else {
      echo '<script> alert("Error al actualizar la comision practicante"); 
          window.history.back(-1);</script>';
    }
  } else {
    $sql = "UPDATE comision_pract SET cargo_funcio='$cargo', nombre='$nombres', apellidos='$apellidos',area_user='$area_usuaria',practicas_idcon='$idcon' WHERE idcomision_pract='$idcomision'";

    $sqlRes = $con->query($sql) or mysqli_error($con);
    if ($sqlRes) {
      header('Location: ../agregar_comision_prac.php?practicas_idcon=' . $idcon . '&dni=' . $dni . '#tabla_comision');
    } else {
      echo '<script> alert("Error al actualizar la comision practicante"); 
          window.history.back(-1);</script>';
    }
  }
} elseif (isset($_POST['deleteComision_prac'])) {
  $idcon = $_POST['practicas_idcon'];

  $idcomision = ($_POST['idcomision_delete']);

  $sql = "DELETE FROM comision_pract WHERE idcomision_pract = '$idcomision'";
  $sqlRes = $con->query($sql) or mysqli_error($con);
  if ($sqlRes) {
    echo $idcomision;
    header('Location: ../agregar_comision.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni . '#tabla_comision');
  } else {
    echo '<script> alert("Error al guardar la comision"); 
          window.history.back(-1);</script>';
  }
}
