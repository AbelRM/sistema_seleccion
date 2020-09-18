<?php
// Insert the content of connection.php file
include('../conexion.php');
// Insert data into the database
if (isset($_POST['insertData4'])) {
  $dato_desencriptado = $_POST['dni_encriptado4'];
  $dni = $_POST['dni4'];
  $idpostulante = $_POST['postulante4'];
  $tipo_expe4 = $_POST['tipo_expe4'];

  $lugar_4exp = $_POST['lugar_4exp'];
  $cargo_funciones_4exp = $_POST['cargo_funciones_4exp'];
  $fecha_ini_4exp = $_POST['fecha_ini_4exp'];
  $fecha_fin_4exp = $_POST['fecha_fin_4exp'];

  $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/expe4_laboral/';
  if (!file_exists($micarpeta)) {
    mkdir($micarpeta, 0777, true);
  }
  //datos del arhivo
  $nombre_archivo = $_FILES['archivo']['name'];
  $tipo_archivo = $_FILES['archivo']['type'];
  $tamano_archivo = $_FILES['archivo']['size'];

  $query = mysqli_query($con, "SELECT * FROM expe_4puntos WHERE expe_4puntos_idpostulante = $idpostulante");
  $result = mysqli_num_rows($query);
  if ($result <= 0) {
    $i = 1;
    $new_nombre = "expe4_laboral_" . $i . ".pdf";
  } else {
    $row = mysqli_fetch_array($query);
    $idformacion = $row['id_4puntos'];
    $i = $idformacion + 1;
    $new_nombre = "expe4_laboral_" . $i . ".pdf";
  }
  /// VALORES AÑOS, MESES Y DIAS ///
  $fechainicial = new DateTime($fecha_ini_4exp);
  $fechaactual = new DateTime($fecha_fin_4exp);
  $diferencia = $fechainicial->diff($fechaactual);
  $años = $diferencia->format('%Y');
  $meses = $diferencia->format('%m');
  $dias = $diferencia->format('%d');

  //compruebo si las características del archivo son las que deseo
  if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
    echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Solo se permiten archivos .pdf<br><li>se permiten archivos de 3 Mb máximo.</td></tr></table>";
  } else {
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $micarpeta . $new_nombre)) {
      $sql = "INSERT INTO expe_4puntos (lugar,cargo,fecha_inicio,fecha_fin,anios,meses,dias,archivos,tipo_expe,expe_4puntos_idpostulante) 
          VALUES('$lugar_4exp','$cargo_funciones_4exp', '$fecha_ini_4exp','$fecha_fin_4exp','$años','$meses','$dias','$new_nombre','$tipo_expe4','$idpostulante')";
      $result = mysqli_query($con, $sql);
      if ($result) {
        echo '<script> alert("Guardado exitosamente"); </script>';
        header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
      } else {
        echo '<script> alert("Error al guardar"); </script>';
        header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
      }
    } else {
      echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
      header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
    }
  }
} elseif (isset($_POST['insertData3'])) {
  $dato_desencriptado = $_POST['dni_encriptado3'];
  $dni = $_POST['dni3'];
  $idpostulante = $_POST['postulante3'];
  $tipo_expe3 = $_POST['tipo_expe3'];

  $lugar_3exp = $_POST['lugar_3exp'];
  $cargo_funciones_3exp = $_POST['cargo_funciones_3exp'];
  $fecha_ini_3exp = $_POST['fecha_ini_3exp'];
  $fecha_fin_3exp = $_POST['fecha_fin_3exp'];

  $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/expe3_laboral/';
  if (!file_exists($micarpeta)) {
    mkdir($micarpeta, 0777, true);
  }
  //datos del arhivo
  $nombre_archivo = $_FILES['archivo']['name'];
  $tipo_archivo = $_FILES['archivo']['type'];
  $tamano_archivo = $_FILES['archivo']['size'];

  $query = mysqli_query($con, "SELECT * FROM expe_3puntos WHERE expe_3puntos_idpostulante = $idpostulante");
  $result = mysqli_num_rows($query);
  if ($result <= 0) {
    $i = 1;
    $new_nombre = "expe3_laboral_" . $i . ".pdf";
  } else {
    $row = mysqli_fetch_array($query);
    $idformacion = $row['id_3puntos'];
    $i = $idformacion + 1;
    $new_nombre = "expe3_laboral_" . $i . ".pdf";
  }

  /// VALORES AÑOS, MESES Y DIAS ///
  $fechainicial = new DateTime($fecha_ini_3exp);
  $fechaactual = new DateTime($fecha_fin_3exp);
  $diferencia = $fechainicial->diff($fechaactual);
  $años = $diferencia->format('%Y');
  $meses = $diferencia->format('%m');
  $dias = $diferencia->format('%d');

  //compruebo si las características del archivo son las que deseo
  if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
    echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Solo se permiten archivos .pdf<br><li>se permiten archivos de 3 Mb máximo.</td></tr></table>";
  } else {
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $micarpeta . $new_nombre)) {
      $sql = "INSERT INTO expe_3puntos (lugar,cargo,fecha_inicio,fecha_fin,anios,meses,dias,archivos,tipo_expe,expe_3puntos_idpostulante) 
          VALUES('$lugar_3exp','$cargo_funciones_3exp', '$fecha_ini_3exp','$fecha_fin_3exp','$años','$meses','$dias','$new_nombre','$tipo_expe3','$idpostulante')";
      $result = mysqli_query($con, $sql);
      if ($result) {
        echo '<script> alert("Guardado exitosamente"); </script>';
        header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
      } else {
        echo '<script> alert("Error al guardar"); </script>';
        header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
      }
    } else {
      echo 'Ocurrió algún error al subir el fichero. No pudo guardarse.';
      header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
    }
  }
} elseif (isset($_POST['insertData1'])) {
  $dato_desencriptado = $_POST['dni_encriptado'];
  $dni = $_POST['dni'];
  $idpostulante = $_POST['postulante'];
  $tipo_expe1 = $_POST['tipo_expe1'];

  $lugar_3exp = $_POST['lugar_1exp'];
  $cargo_funciones_1exp = $_POST['cargo_funciones_1exp'];
  $fecha_ini_1exp = $_POST['fecha_ini_1exp'];
  $fecha_fin_1exp = $_POST['fecha_fin_1exp'];

  $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/expe1_laboral/';
  if (!file_exists($micarpeta)) {
    mkdir($micarpeta, 0777, true);
  }
  //datos del arhivo
  $nombre_archivo = $_FILES['archivo']['name'];
  $tipo_archivo = $_FILES['archivo']['type'];
  $tamano_archivo = $_FILES['archivo']['size'];

  $query = mysqli_query($con, "SELECT * FROM expe_1puntos WHERE expe_1puntos_idpostulante = $idpostulante");
  $result = mysqli_num_rows($query);
  if ($result <= 0) {
    $i = 1;
    $new_nombre = "expe1_laboral_" . $i . ".pdf";
  } else {
    $row = mysqli_fetch_array($query);
    $idformacion = $row['id_3puntos'];
    $i = $idformacion - 1;
    $new_nombre = "expe1_laboral_" . $i . ".pdf";
  }

  /// VALORES AÑOS, MESES Y DIAS ///
  $fechainicial = new DateTime($fecha_ini_1exp);
  $fechaactual = new DateTime($fecha_fin_1exp);
  $diferencia = $fechainicial->diff($fechaactual);
  $años = $diferencia->format('%Y');
  $meses = $diferencia->format('%m');
  $dias = $diferencia->format('%d');

  //compruebo si las características del archivo son las que deseo
  if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
    echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Solo se permiten archivos .pdf<br><li>se permiten archivos de 3 Mb máximo.</td></tr></table>";
  } else {
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $micarpeta . $new_nombre)) {
      $sql = "INSERT INTO expe_1puntos (lugar,cargo,fecha_inicio,fecha_fin,anios,meses,dias,archivos,tipo_expe,expe_1puntos_idpostulante) 
          VALUES('$lugar_1exp','$cargo_funciones_1exp', '$fecha_ini_1exp','$fecha_fin_1exp','$años','$meses','$dias','$new_nombre','$tipo_expe1','$idpostulante')";
      $result = mysqli_query($con, $sql);
      if ($result) {
        echo '<script> alert("Guardado exitosamente"); </script>';
        header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
      } else {
        echo '<script> alert("Error al guardar"); </script>';
        header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
      }
    } else {
      echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
      header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
    }
  }
} else {
  echo "ERROR NO ENTRA";
}
