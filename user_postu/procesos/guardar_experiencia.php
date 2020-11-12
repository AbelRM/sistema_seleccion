<?php
// Insert the content of connection.php file
include('../conexion.php');
// Insert data into the database
if (isset($_POST['insertData4'])) {
  $dato_desencriptado = $_POST['dni_encriptado4'];
  $dni = $_POST['dni4'];
  $idpostulante = $_POST['postulante4'];
  $tipo_expe4 = $_POST['tipo_expe4'];
  $tipo_comprobante = $_POST['tipo_comprobante_exp4_tip1'];

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
    $new_nombre = "exp4_tip" . $tipo_expe4 . "_" . $i . ".pdf";
  } else {
    $row = mysqli_fetch_array($query);
    $idformacion = $row['id_4puntos'];
    $i = $idformacion + 1;
    $new_nombre = "exp4_tip" . $tipo_expe4 . "_" . $i . ".pdf";
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
    echo '<script> alert("El archivo excede los 3 MB máximos permitidos."); </script>';
    echo "<script type=\"text/javascript\">history.go(-1);</script>";
  } else {
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $micarpeta . $new_nombre)) {
      if ($tipo_comprobante == 'Contrato') {
        $nro_contrato = $_POST['nro_contrato'];
        $sql = "INSERT INTO expe_4puntos (lugar,cargo,fecha_inicio,fecha_fin,anios,meses,dias,archivos,tipo_expe,expe_4puntos_idpostulante, tipo_comprobante,nro_contrato) 
          VALUES('$lugar_4exp','$cargo_funciones_4exp', '$fecha_ini_4exp','$fecha_fin_4exp','$años','$meses','$dias','$new_nombre','$tipo_expe4','$idpostulante','$tipo_comprobante','$nro_contrato')";
        $result = mysqli_query($con, $sql);
        if ($result) {
          echo '<script> alert("Guardado exitosamente"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        }
      } else {
        $fech_emision = $_POST['fecha_boleta'];
        $monto_boleta = $_POST['boleta'];
        $sql = "INSERT INTO expe_4puntos (lugar,cargo,fecha_inicio,fecha_fin,anios,meses,dias,archivos,tipo_expe,expe_4puntos_idpostulante, tipo_comprobante,fech_emision,monto_boleta) 
          VALUES('$lugar_4exp','$cargo_funciones_4exp', '$fecha_ini_4exp','$fecha_fin_4exp','$años','$meses','$dias','$new_nombre','$tipo_expe4','$idpostulante','$tipo_comprobante','$fech_emision','$monto_boleta')";
        $result = mysqli_query($con, $sql);
        if ($result) {
          echo '<script> alert("Guardado exitosamente"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        }
      }
    } else {
      echo '<script> alert("Error al guardar el archivo."); </script>';
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
      // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
    }
  }
} elseif (isset($_POST['insertData3'])) {
  $dato_desencriptado = $_POST['dni_encriptado3'];
  $dni = $_POST['dni3'];
  $idpostulante = $_POST['postulante3'];
  $tipo_expe3 = $_POST['tipo_expe3'];
  $tipo_comprobante = $_POST['tipo_comprobante_exp3_tip1'];


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
    $new_nombre = "exp3_tip" . $tipo_expe3 . "_" . $i . ".pdf";
  } else {
    $row = mysqli_fetch_array($query);
    $idformacion = $row['id_3puntos'];
    $i = $idformacion + 1;
    $new_nombre = "exp3_tip" . $tipo_expe3 . "_" . $i . ".pdf";
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
    echo '<script> alert("El archivo excede los 3 MB máximos permitidos."); </script>';
    echo "<script type=\"text/javascript\">history.go(-1);</script>";
  } else {
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $micarpeta . $new_nombre)) {
      if ($tipo_comprobante == 'Contrato') {
        $nro_contrato = $_POST['nro_contrato'];
        $sql = "INSERT INTO expe_3puntos (lugar,cargo,fecha_inicio,fecha_fin,anios,meses,dias,archivos,tipo_expe,expe_3puntos_idpostulante, tipo_comprobante, nro_contrato) 
          VALUES('$lugar_3exp','$cargo_funciones_3exp', '$fecha_ini_3exp','$fecha_fin_3exp','$años','$meses','$dias','$new_nombre','$tipo_expe3','$idpostulante','$tipo_comprobante','$nro_contrato')";

        $result = mysqli_query($con, $sql);
        if ($result) {
          echo '<script> alert("Guardado exitosamente"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        }
      } else {
        $fech_emision = $_POST['fecha_boleta'];
        $monto_boleta = $_POST['boleta'];

        $sql = "INSERT INTO expe_3puntos (lugar,cargo,fecha_inicio,fecha_fin,anios,meses,dias,archivos,tipo_expe,expe_3puntos_idpostulante,tipo_comprobante, fech_emision, monto_boleta) 
          VALUES('$lugar_3exp','$cargo_funciones_3exp', '$fecha_ini_3exp','$fecha_fin_3exp','$años','$meses','$dias','$new_nombre','$tipo_expe3','$idpostulante','$tipo_comprobante','$fech_emision','$monto_boleta')";
        $result = mysqli_query($con, $sql);
        if ($result) {
          echo '<script> alert("Guardado exitosamente"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        }
      }
    } else {
      echo '<script> alert("Error al guardar el archivo."); </script>';
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
    }
  }
} elseif (isset($_POST['insertData1'])) {
  $dato_desencriptado = $_POST['dni_encriptado'];
  $dni = $_POST['dni'];
  $idpostulante = $_POST['postulante'];
  $tipo_expe1 = $_POST['tipo_expe1'];
  $tipo_comprobante = $_POST['tipo_comprobante_exp1_tip1'];


  $lugar_1exp = $_POST['lugar_1exp'];
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
    $new_nombre = "exp1_tip" . $tipo_expe1 . "_" . $i . ".pdf";
  } else {
    $row = mysqli_fetch_array($query);
    $idformacion = $row['id_3puntos'];
    $i = $idformacion - 1;
    $new_nombre = "exp1_tip" . $tipo_expe1 . "_" . $i . ".pdf";
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
    echo '<script> alert("El archivo excede los 3 MB máximos permitidos."); </script>';
    echo "<script type=\"text/javascript\">history.go(-1);</script>";
  } else {
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $micarpeta . $new_nombre)) {
      if ($tipo_comprobante == 'Contrato') {
        $nro_contrato = $_POST['nro_contrato'];
        $sql = "INSERT INTO expe_1puntos (lugar,cargo,fecha_inicio,fecha_fin,anios,meses,dias,archivos,tipo_expe,expe_1puntos_idpostulante, tipo_comprobante, nro_contrato) 
          VALUES('$lugar_1exp','$cargo_funciones_1exp', '$fecha_ini_1exp','$fecha_fin_1exp','$años','$meses','$dias','$new_nombre','$tipo_expe1','$idpostulante','$tipo_comprobante','$nro_contrato')";

        $result = mysqli_query($con, $sql);
        if ($result) {
          echo '<script> alert("Guardado exitosamente"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        }
      } else {
        $fech_emision = $_POST['fecha_boleta'];
        $monto_boleta = $_POST['boleta'];

        $sql = "INSERT INTO expe_1puntos (lugar,cargo,fecha_inicio,fecha_fin,anios,meses,dias,archivos,tipo_expe,expe_1puntos_idpostulante,tipo_comprobante, fech_emision, monto_boleta) 
          VALUES('$lugar_1exp','$cargo_funciones_1exp', '$fecha_ini_1exp','$fecha_fin_1exp','$años','$meses','$dias','$new_nombre','$tipo_expe1','$idpostulante','$tipo_comprobante','$fech_emision','$monto_boleta')";
        $result = mysqli_query($con, $sql);
        if ($result) {
          echo '<script> alert("Guardado exitosamente"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        }
      }
    } else {
      echo '<script> alert("Ocurrio un problema al guardar el archivo."); </script>';
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
    }
  }
} elseif (isset($_POST['insertData4_tipo2'])) {
  $dato_desencriptado = $_POST['dni_encriptado'];
  $dni = $_POST['dni'];
  $idpostulante = $_POST['postulante'];
  $tipo_expe = $_POST['tipo_expe'];
  $tipo_comprobante = $_POST['tipo_comprobante_exp4_tip2'];

  $lugar_4exp = strtoupper($_POST['lugar_4exp_tip2']);
  $cargo_funciones_4exp = strtoupper($_POST['cargo_funciones_4exp_tip2']);
  $fecha_ini_4exp = $_POST['fecha_ini_4exp_tip2'];
  $fecha_fin_4exp = $_POST['fecha_fin_4exp_tip2'];

  $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/expe4_laboral/';
  if (!file_exists($micarpeta)) {
    mkdir($micarpeta, 0777, true);
  }
  //datos del arhivo
  $nombre_archivo = $_FILES['archivos_tipo2']['name'];
  $tipo_archivo = $_FILES['archivos_tipo2']['type'];
  $tamano_archivo = $_FILES['archivos_tipo2']['size'];

  $query = mysqli_query($con, "SELECT * FROM expe_4puntos WHERE expe_4puntos_idpostulante = $idpostulante");
  $result = mysqli_num_rows($query);
  if ($result <= 0) {
    $i = 1;
    $new_nombre = "exp4_tip" . $tipo_expe . "_" . $i . ".pdf";
  } else {
    $row = mysqli_fetch_array($query);
    $idformacion = $row['id_4puntos'];
    $i = $idformacion + 1;
    $new_nombre = "exp4_tip" . $tipo_expe . "_" . $i . ".pdf";
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
    echo '<script> alert("El archivo excede los 3 MB máximos permitidos."); </script>';
    echo "<script type=\"text/javascript\">history.go(-1);</script>";
  } else {
    if (move_uploaded_file($_FILES['archivos_tipo2']['tmp_name'], $micarpeta . $new_nombre)) {
      if ($tipo_comprobante == 'Contrato') {
        $nro_contrato = $_POST['nro_contrato'];
        $sql = "INSERT INTO expe_4puntos (lugar,cargo,fecha_inicio,fecha_fin,anios,meses,dias,archivos,tipo_expe,expe_4puntos_idpostulante, tipo_comprobante, nro_contrato) 
          VALUES('$lugar_4exp','$cargo_funciones_4exp', '$fecha_ini_4exp','$fecha_fin_4exp','$años','$meses','$dias','$new_nombre','$tipo_expe','$idpostulante','$tipo_comprobante','$nro_contrato')";

        $result = mysqli_query($con, $sql);
        if ($result) {
          echo '<script> alert("Guardado exitosamente"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        }
      } else {
        $fech_emision = $_POST['fecha_boleta'];
        $monto_boleta = $_POST['boleta'];

        $sql = "INSERT INTO expe_4puntos (lugar,cargo,fecha_inicio,fecha_fin,anios,meses,dias,archivos,tipo_expe,expe_4puntos_idpostulante,tipo_comprobante, fech_emision, monto_boleta) 
          VALUES('$lugar_4exp','$cargo_funciones_4exp', '$fecha_ini_4exp','$fecha_fin_4exp','$años','$meses','$dias','$new_nombre','$tipo_expe','$idpostulante','$tipo_comprobante','$fech_emision','$monto_boleta')";
        $result = mysqli_query($con, $sql);
        if ($result) {
          echo '<script> alert("Guardado exitosamente"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        }
      }
    } else {
      echo "<script> alert(Ocurrió algún error al subir el fichero. No pudo guardarse.); </script>";
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
      // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
    }
  }
} elseif (isset($_POST['insertData3_tipo2'])) {
  $dato_desencriptado = $_POST['dni_encriptado'];
  $dni = $_POST['dni'];
  $idpostulante = $_POST['postulante'];
  $tipo_expe = $_POST['tipo_expe'];
  $tipo_comprobante = $_POST['tipo_comprobante_exp3_tip2'];


  $lugar_3exp = strtoupper($_POST['lugar_3exp_tip2']);
  $cargo_funciones_3exp = strtoupper($_POST['cargo_funciones_3exp_tip2']);
  $fecha_ini_3exp = $_POST['fecha_ini_3exp_tip2'];
  $fecha_fin_3exp = $_POST['fecha_fin_3exp_tip2'];

  $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/expe3_laboral/';
  if (!file_exists($micarpeta)) {
    mkdir($micarpeta, 0777, true);
  }
  //datos del arhivo
  $nombre_archivo = $_FILES['archivos3_tipo2']['name'];
  $tipo_archivo = $_FILES['archivos3_tipo2']['type'];
  $tamano_archivo = $_FILES['archivos3_tipo2']['size'];

  $query = mysqli_query($con, "SELECT * FROM expe_3puntos WHERE expe_3puntos_idpostulante = $idpostulante");
  $result = mysqli_num_rows($query);
  if ($result <= 0) {
    $i = 1;
    $new_nombre = "exp3_tip" . $tipo_expe . "_" . $i . ".pdf";
  } else {
    $row = mysqli_fetch_array($query);
    $idformacion = $row['id_3puntos'];
    $i = $idformacion + 1;
    $new_nombre = "exp3_tip" . $tipo_expe . "_" . $i . ".pdf";
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
    echo '<script> alert("El archivo excede los 3 MB máximos permitidos."); </script>';
    echo "<script type=\"text/javascript\">history.go(-1);</script>";
  } else {
    if (move_uploaded_file($_FILES['archivos3_tipo2']['tmp_name'], $micarpeta . $new_nombre)) {
      if ($tipo_comprobante == 'Contrato') {
        $nro_contrato = $_POST['nro_contrato'];
        $sql = "INSERT INTO expe_3puntos (lugar,cargo,fecha_inicio,fecha_fin,anios,meses,dias,archivos,tipo_expe,expe_3puntos_idpostulante, tipo_comprobante, nro_contrato) 
          VALUES('$lugar_3exp','$cargo_funciones_3exp', '$fecha_ini_3exp','$fecha_fin_3exp','$años','$meses','$dias','$new_nombre','$tipo_expe','$idpostulante','$tipo_comprobante','$nro_contrato')";

        $result = mysqli_query($con, $sql);
        if ($result) {
          echo '<script> alert("Guardado exitosamente"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        }
      } else {
        $fech_emision = $_POST['fecha_boleta'];
        $monto_boleta = $_POST['boleta'];

        $sql = "INSERT INTO expe_3puntos (lugar,cargo,fecha_inicio,fecha_fin,anios,meses,dias,archivos,tipo_expe,expe_3puntos_idpostulante,tipo_comprobante, fech_emision, monto_boleta) 
          VALUES('$lugar_3exp','$cargo_funciones_3exp', '$fecha_ini_3exp','$fecha_fin_3exp','$años','$meses','$dias','$new_nombre','$tipo_expe','$idpostulante','$tipo_comprobante','$fech_emision','$monto_boleta')";
        $result = mysqli_query($con, $sql);
        if ($result) {
          echo '<script> alert("Guardado exitosamente"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        }
      }
    } else {
      echo "<script> alert(Ocurrió algún error al subir el fichero. No pudo guardarse.); </script>";
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
      // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
    }
  }
} elseif (isset($_POST['insertData1_tipo2'])) {
  $dato_desencriptado = $_POST['dni_encriptado'];
  $dni = $_POST['dni'];
  $idpostulante = $_POST['postulante'];
  $tipo_expe = $_POST['tipo_expe'];
  $tipo_comprobante = $_POST['tipo_comprobante_exp1_tip2'];


  $lugar_1exp = strtoupper($_POST['lugar_1exp_tip2']);
  $cargo_funciones_1exp = strtoupper($_POST['cargo_funciones_1exp_tip2']);
  $fecha_ini_1exp = $_POST['fecha_ini_1exp_tip2'];
  $fecha_fin_1exp = $_POST['fecha_fin_1exp_tip2'];

  $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/expe1_laboral/';
  if (!file_exists($micarpeta)) {
    mkdir($micarpeta, 0777, true);
  }
  //datos del arhivo
  $nombre_archivo = $_FILES['archivos1_tipo2']['name'];
  $tipo_archivo = $_FILES['archivos1_tipo2']['type'];
  $tamano_archivo = $_FILES['archivos1_tipo2']['size'];

  $query = mysqli_query($con, "SELECT * FROM expe_1puntos WHERE expe_1puntos_idpostulante = $idpostulante");
  $result = mysqli_num_rows($query);
  if ($result <= 0) {
    $i = 1;
    $new_nombre = "exp1_tip" . $tipo_expe . "_" . $i . ".pdf";
  } else {
    $row = mysqli_fetch_array($query);
    $idformacion = $row['id_1puntos'];
    $i = $idformacion + 1;
    $new_nombre = "exp1_tip" . $tipo_expe . "_" . $i . ".pdf";
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
    echo '<script> alert("El archivo excede los 3 MB máximos permitidos."); </script>';
    echo "<script type=\"text/javascript\">history.go(-1);</script>";
  } else {
    if (move_uploaded_file($_FILES['archivos1_tipo2']['tmp_name'], $micarpeta . $new_nombre)) {
      if ($tipo_comprobante == 'Contrato') {
        $nro_contrato = $_POST['nro_contrato'];
        $sql = "INSERT INTO expe_1puntos (lugar,cargo,fecha_inicio,fecha_fin,anios,meses,dias,archivos,tipo_expe,expe_1puntos_idpostulante, tipo_comprobante, nro_contrato) 
          VALUES('$lugar_1exp','$cargo_funciones_1exp', '$fecha_ini_1exp','$fecha_fin_1exp','$años','$meses','$dias','$new_nombre','$tipo_expe','$idpostulante','$tipo_comprobante','$nro_contrato')";

        $result = mysqli_query($con, $sql);
        if ($result) {
          echo '<script> alert("Guardado exitosamente"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        }
      } else {
        $fech_emision = $_POST['fecha_boleta'];
        $monto_boleta = $_POST['boleta'];

        $sql = "INSERT INTO expe_1puntos (lugar,cargo,fecha_inicio,fecha_fin,anios,meses,dias,archivos,tipo_expe,expe_1puntos_idpostulante,tipo_comprobante, fech_emision, monto_boleta) 
          VALUES('$lugar_1exp','$cargo_funciones_1exp', '$fecha_ini_1exp','$fecha_fin_1exp','$años','$meses','$dias','$new_nombre','$tipo_expe','$idpostulante','$tipo_comprobante','$fech_emision','$monto_boleta')";
        $result = mysqli_query($con, $sql);
        if ($result) {
          echo '<script> alert("Guardado exitosamente"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        }
      }
    } else {
      echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
      // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
    }
  }
} else {
  echo '<script> alert("Error al guardar."); </script>';
  echo "<script type=\"text/javascript\">history.go(-1);</script>";
}
