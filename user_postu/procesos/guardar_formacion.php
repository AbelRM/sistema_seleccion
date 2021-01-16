<?php
// Insert the content of connection.php file
include '../conexion.php';
$dato_desencriptado = $_POST['dni_encriptado'];
$dni = $_POST['dni'];
$idpostulante = $_POST['postulante'];

if (isset($_POST['insertData'])) {
  $tipo_estudios = $_POST['tipo_estudios'];
  $formacion_validacion = 'VALIDO';
  if ($tipo_estudios == '1') {
    $centro_estudios = strtoupper($_POST['centro_estudios']);
    $colegiatura = $_POST['colegiatura'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $licencia_conducir = $_POST['licencia_conducir'];
    $serums = $_POST['serums'];
    //crear carpeta
    $micarpeta = '../archivos/' . $dni . '/formacion/';
    if (!file_exists($micarpeta)) {
      mkdir($micarpeta, 0777, true);
    }
    //datos del arhivo
    $nombre_archivo = $_FILES['archivo']['name'];
    $tipo_archivo = $_FILES['archivo']['type'];
    $tamano_archivo = $_FILES['archivo']['size'];

    $query = mysqli_query($con, "SELECT * FROM formacion_acad WHERE formacion_idpostulante = $idpostulante");
    $result = mysqli_num_rows($query);
    if ($result <= 0) {
      $i = 1;
      $new_nombre = "formacion_" . $i . ".pdf";
    } else {
      $row = mysqli_fetch_array($query);
      $idformacion = $row['id_formacion'];
      $i = $idformacion;
      $new_nombre = "formacion_" . $i . ".pdf";
    }
    //compruebo si las características del archivo son las que deseo
    if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
      echo '<script> alert("El peso del archivo supera los 3MB."); </script>';
      header('Location: ../formacion.php?dni=' . $dato_desencriptado);
    } else {
      if (move_uploaded_file($_FILES['archivo']['tmp_name'], $micarpeta . $new_nombre)) {
        $sql = "INSERT INTO formacion_acad (tipo_estudios_id,centro_estudios,colegiatura,fecha_inicio,
          fecha_fin, formacion_idpostulante,archivo, brevete, serums, quintil,formacion_validacion) 
          VALUES('$tipo_estudios','$centro_estudios','$colegiatura','$fecha_inicio','$fecha_fin','$idpostulante','$new_nombre','$licencia_conducir','$serums','$serums','$formacion_validacion')";

        $result = mysqli_query($con, $sql);
        if ($result) {
          header('Location: ../formacion.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar los datos"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
        }
      } else {
        echo '<script> alert("Ocurrió algún error al subir el fichero. No pudo guardarse."); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      }
    }
  } elseif ($tipo_estudios == '2') {
    $nivel_estudios_tec = $_POST['nivel_estudios_tec'];
    $centro_estudios = strtoupper($_POST['centro_estudios']);
    $carrera = strtoupper($_POST['carrera']);
    $colegiatura = $_POST['colegiatura'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $licencia_conducir = $_POST['licencia_conducir'];
    $serums = $_POST['serums'];
    $quintil = 'NO';

    //crear carpeta
    $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/formacion/';
    if (!file_exists($micarpeta)) {
      mkdir($micarpeta, 0777, true);
    }
    //datos del arhivo
    $nombre_archivo = $_FILES['archivo']['name'];
    $tipo_archivo = $_FILES['archivo']['type'];
    $tamano_archivo = $_FILES['archivo']['size'];

    $query = mysqli_query($con, "SELECT * FROM formacion_acad WHERE formacion_idpostulante = $idpostulante");
    $result = mysqli_num_rows($query);
    if ($result <= 0) {
      $i = 1;
      $new_nombre = "formacion_" . $i . ".pdf";
    } else {
      $row = mysqli_fetch_array($query);
      $idformacion = $row['id_formacion'];
      $i = $idformacion;
      $new_nombre = "formacion_" . $i . ".pdf";
    }
    //compruebo si las características del archivo son las que deseo
    if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
      echo '<script> alert("El peso del archivo supera los 3MB."); </script>';
      header('Location: ../formacion.php?dni=' . $dato_desencriptado);
    } else {
      if (move_uploaded_file($_FILES['archivo']['tmp_name'], $micarpeta . $new_nombre)) {
        $sql = "INSERT INTO formacion_acad (tipo_estudios_id,nivel_estudios,centro_estudios,carrera,colegiatura,fecha_inicio,fecha_fin, formacion_idpostulante,archivo,
        brevete,serums,quintil,formacion_validacion) 
        VALUES('$tipo_estudios','$nivel_estudios_tec','$centro_estudios','$carrera','$colegiatura','$fecha_inicio','$fecha_fin','$idpostulante','$new_nombre',
        '$licencia_conducir','$serums','$quintil','$formacion_validacion')";
        $result = mysqli_query($con, $sql);
        if ($result) {
          // echo '<script> alert("Guardado exitosamente"); </script>';
          header('Location: ../formacion.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar los datos"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
        }
      } else {
        echo '<script> alert("Ocurrió algún error al subir el fichero. No pudo guardarse."); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      }
    }
  } elseif ($tipo_estudios == '3') {
    $colegiatura_validar = $_POST['colegiatura'];
    $licencia_conducir = $_POST['licencia_conducir'];
    $serums = $_POST['serums'];
    if ($colegiatura_validar == 'NO') {
      $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/formacion/';
      if (!file_exists($micarpeta)) {
        mkdir($micarpeta, 0777, true);
      }
      //datos del arhivo
      $nombre_archivo = $_FILES['archivo']['name'];
      $tipo_archivo = $_FILES['archivo']['type'];
      $tamano_archivo = $_FILES['archivo']['size'];

      $query = mysqli_query($con, "SELECT * FROM formacion_acad WHERE formacion_idpostulante = $idpostulante");
      $row = mysqli_fetch_array($query);
      if ($result <= 0) {
        $i = 1;
        $new_nombre = "formacion_" . $i . ".pdf";
      } else {
        $row = mysqli_fetch_array($query);
        $idformacion = $row['id_formacion'];
        $i = $idformacion;
        $new_nombre = "formacion_" . $i . ".pdf";
      }

      //compruebo si las características del archivo son las que deseo
      if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
        echo '<script> alert("Archivo muy pesado"); </script>';
        // header('Location: ../formacion.php?dni=' . $dato_desencriptado);
      } else {
        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $micarpeta . $new_nombre)) {
          $tipo_estudios = $_POST['tipo_estudios'];
          $nivel_estudios = $_POST['nivel_estudios_prof'];
          $centro_estudios = strtoupper($_POST['centro_estudios']);
          $carrera = strtoupper($_POST['carrera']);
          $colegiatura = $_POST['colegiatura'];
          $fecha_inicio = $_POST['fecha_inicio'];
          $fecha_fin = $_POST['fecha_fin'];

          if ($nivel_estudios == 'ESTUDIANTE') {
            $ciclo_actual = $_POST['ciclo_actual'];
            $sql = "INSERT INTO formacion_acad (tipo_estudios_id,nivel_estudios,ciclo_actual,centro_estudios,carrera,colegiatura,fecha_inicio,fecha_fin, formacion_idpostulante,archivo,brevete,serums,quintil,formacion_validacion) 
            VALUES('$tipo_estudios','$nivel_estudios','$ciclo_actual','$centro_estudios', '$carrera','$colegiatura_validar','$fecha_inicio',
            '$fecha_fin','$idpostulante','$new_nombre','$licencia_conducir','$serums','$serums','$formacion_validacion')";

            $result = mysqli_query($con, $sql);
            if ($result) {
              // echo '<script> alert("Guardado exitosamente"); </script>';
              header('Location: ../formacion.php?dni=' . $dato_desencriptado);
            } else {
              echo '<script> alert("Ocurrió algún error al subir el fichero. No pudo guardarse."); </script>';
              echo "<script type=\"text/javascript\">history.go(-1);</script>";
              // echo '<script> alert("Error al guardar PRIMERA"); </script>';
              // header('Location: ../formacion.php?dni=' . $dato_desencriptado);
            }
          } elseif ($nivel_estudios == 'EGRESADO' || $nivel_estudios == 'BACHILLER') {
            $sql = "INSERT INTO formacion_acad (tipo_estudios_id,nivel_estudios,centro_estudios,carrera,colegiatura,fecha_inicio,fecha_fin, formacion_idpostulante,archivo,
            brevete,serums,quintil,formacion_validacion) 
            VALUES('$tipo_estudios','$nivel_estudios','$centro_estudios', '$carrera','$colegiatura_validar','$fecha_inicio',
            '$fecha_fin','$idpostulante','$new_nombre','$licencia_conducir','$serums','$serums','$formacion_validacion')";

            $result = mysqli_query($con, $sql);
            if ($result) {
              // echo '<script> alert("Guardado exitosamente"); </script>';
              header('Location: ../formacion.php?dni=' . $dato_desencriptado);
            } else {
              echo '<script> alert("Error al guardar los datos"); </script>';
              echo "<script type=\"text/javascript\">history.go(-1);</script>";
            }
          } else {
            echo '<script> alert("No es ESTUDIANTE, EGRESADO O BACHILLER, elegir correctamente"); </script>';
            echo "<script type=\"text/javascript\">history.go(-1);</script>";
          }
        } else {
          echo '<script> alert("Ocurrió algún error al subir el fichero. No pudo guardarse."); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
        }
      }
    } else {
      //Crear carpeta
      $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/formacion/';
      if (!file_exists($micarpeta)) {
        mkdir($micarpeta, 0777, true);
      }
      //Datos del arhivo
      $nombre_archivo = $_FILES['archivo']['name'];
      $tipo_archivo = $_FILES['archivo']['type'];
      $tamano_archivo = $_FILES['archivo']['size'];
      //Generar nombre de archivo
      $query = mysqli_query($con, "SELECT * FROM formacion_acad WHERE formacion_idpostulante = $idpostulante");
      $result = mysqli_num_rows($query);
      if ($result <= 0) {
        $i = 1;
        $new_nombre = "formacion_" . $i . ".pdf";
      } else {
        $row = mysqli_fetch_array($query);
        $idformacion = $row['id_formacion'];
        $i = $idformacion;
        $new_nombre = "formacion_" . $i . ".pdf";
      }
      //compruebo si las características del archivo son las que deseo
      if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 2000000))) {
        echo '<script> alert("Ocurrió algún error al subir el fichero. No es PDF o supera los 2MB."); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      } else {
        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $micarpeta . $new_nombre)) {
          $tipo_estudios = $_POST['tipo_estudios'];
          $nivel_estudios = $_POST['nivel_estudios_prof'];
          $centro_estudios = $_POST['centro_estudios'];
          $carrera = $_POST['carrera'];
          $nro_colegiatura = $_POST['nro_colegiatura'];
          $fech_colegiatura = $_POST['fech_colegiatura'];
          $fech_habilitacion = $_POST['fech_habilitacion'];
          $fecha_inicio = $_POST['fecha_inicio'];
          $fecha_fin = $_POST['fecha_fin'];

          if ($nivel_estudios == 'TITULADO') {
            $tipo_prof = $_POST['tipo_prof'];
            if ($tipo_prof == 'asistencial') {
              $serums = $_POST['serums'];
              $quintil = $_POST['quintil'];
              $sql = "INSERT INTO formacion_acad (tipo_estudios_id,nivel_estudios,centro_estudios,carrera,colegiatura,nro_colegiatura,fech_colegiatura,fech_habilitacion,
              fecha_inicio,fecha_fin, formacion_idpostulante,archivo, brevete, tipo_profesional,serums,quintil, valor_quintil,formacion_validacion) 
              VALUES('$tipo_estudios','$nivel_estudios','$centro_estudios', '$carrera','$colegiatura_validar','$nro_colegiatura','$fech_colegiatura','$fech_habilitacion',
              '$fecha_inicio','$fecha_fin','$idpostulante','$new_nombre','$licencia_conducir','$tipo_prof','$serums','$serums','$quintil','$formacion_validacion')";

              $result = mysqli_query($con, $sql);
              if ($result) {
                header('Location: ../formacion.php?dni=' . $dato_desencriptado);
              } else {
                echo '<script> alert("Ocurrió algún error al guardar los datos."); </script>';
                echo "<script type=\"text/javascript\">history.go(-1);</script>";
              }
            } elseif ($tipo_prof == 'administrativo') {
              $serums = $_POST['serums'];
              $sql = "INSERT INTO formacion_acad (tipo_estudios_id,nivel_estudios,centro_estudios,carrera,colegiatura,nro_colegiatura,fech_colegiatura,fech_habilitacion,
              fecha_inicio,fecha_fin, formacion_idpostulante,archivo, brevete, tipo_profesional,serums,quintil,formacion_validacion) 
              VALUES('$tipo_estudios','$nivel_estudios','$centro_estudios', '$carrera','$colegiatura_validar','$nro_colegiatura','$fech_colegiatura','$fech_habilitacion',
              '$fecha_inicio',
              '$fecha_fin','$idpostulante','$new_nombre','$licencia_conducir','$tipo_prof','$serums','$serums','$formacion_validacion')";

              $result = mysqli_query($con, $sql);
              if ($result) {
                // echo '<script> alert("Guardado exitosamente"); </script>';
                header('Location: ../formacion.php?dni=' . $dato_desencriptado);
              } else {
                echo '<script> alert("Ocurrió algún error al guardar los datos"); </script>';
                echo "<script type=\"text/javascript\">history.go(-1);</script>";
                // echo '<script> alert("Error al guardar PRIMERA!"); </script>';
                // header('Location: ../formacion.php?dni=' . $dato_desencriptado);
              }
            } else {
            }
          } else {
            echo '<script> alert("Ocurrió algún error al guardar, no es TITULADO"); </script>';
            echo "<script type=\"text/javascript\">history.go(-1);</script>";
            // echo '<script> alert("No es TITULADO, elegir correctamente"); </script>';
            // header('Location: ../formacion.php?dni=' . $dato_desencriptado);
          }
        } else {
          echo '<script> alert("Ocurrió algún error al subir el fichero. No pudo guardarse."); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
          // header('Location: ../formacion.php?dni=' . $dato_desencriptado);
        }
      }
    }
  } else {
    echo '<script> alert("Ocurrió algún error al acceder al if"); </script>';
    echo "<script type=\"text/javascript\">history.go(-1);</script>";
  }
} elseif (isset($_POST['formacion_prac'])) {
  $tipo_estudios = 'UNIVERSITARIO';
  $nivel_estudios_prof = $_POST['nivel_estudios_prof'];
  $centro_estudios = strtoupper($_POST['centro_estudios']);
  $ciclo_actual = $_POST['ciclo_actual'];
  $carrera = strtoupper($_POST['carrera']);
  $fecha_inicio = $_POST['fecha_inicio'];
  $fecha_fin = $_POST['fecha_fin'];
  $orden_merito = $_POST['orden_merito'];
  $formacion_validacion = 'VALIDO';
  //crear carpeta
  $micarpeta = '../archivos/' . $dni . '/formacion_prac/';
  if (!file_exists($micarpeta)) {
    mkdir($micarpeta, 0777, true);
  }
  //datos del arhivo
  $nombre_archivo = $_FILES['archivo']['name'];
  $tipo_archivo = $_FILES['archivo']['type'];
  $tamano_archivo = $_FILES['archivo']['size'];

  $query = mysqli_query($con, "SELECT * FROM formacion_acad_prac WHERE formacion_acad_prac_idpostulante = '$idpostulante'");
  $result = mysqli_num_rows($query);
  if ($result <= 0) {
    $i = 1;
    $new_nombre = "formacion_prac_" . $i . ".pdf";
  } else {
    $row = mysqli_fetch_array($query);
    $idformacion = $row['idformacion_acad_prac'];
    $i = $idformacion;
    $new_nombre = "formacion_prac_" . $i . ".pdf";
  }

  //datos del archivo 2
  if ($orden_merito == 'NINGUNO') {
    $new_nombre_2 = '';
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $micarpeta . $new_nombre)) {
      $sql = "INSERT INTO formacion_acad_prac (tipo_estudios,nivel_estudios,ciclo_actual,centro_estudios,id_carrera,fecha_inicio,fecha_fin, formacion_acad_prac_idpostulante,archivo,orden_merito,archivo_merito,formacion_validacion) 
          VALUES('$tipo_estudios','$nivel_estudios_prof','$ciclo_actual','$centro_estudios','$carrera','$fecha_inicio','$fecha_fin','$idpostulante','$new_nombre','$orden_merito','$new_nombre_2','$formacion_validacion')";
      $result = mysqli_query($con, $sql);
      if ($result) {
        header('Location: ../formacion_prac.php?dni=' . $dato_desencriptado);
      } else {
        echo '<script> alert("Error al guardar los datos"); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      }
    } else {
      echo '<script> alert("Ocurrió algún error al subir el fichero de formación. No pudo guardarse."); </script>';
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
    }
  } else {
    $nombre_archivo_2 = $_FILES['archivo_merito']['name'];
    $tipo_archivo_2 = $_FILES['archivo_merito']['type'];
    $tamano_archivo_2 = $_FILES['archivo_merito']['size'];
    $query = mysqli_query($con, "SELECT * FROM formacion_acad_prac WHERE formacion_acad_prac_idpostulante = $idpostulante");
    $result = mysqli_num_rows($query);
    if ($result <= 0) {
      $i = 1;
      $new_nombre_2 = "formacion_prac_merito_" . $i . ".pdf";
    } else {
      $row = mysqli_fetch_array($query);
      $idformacion = $row['idformacion_acad_prac'];
      $i = $idformacion;
      $new_nombre_2 = "formacion_prac_merito_" . $i . ".pdf";
    }
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $micarpeta . $new_nombre)) {
      if (move_uploaded_file($_FILES['archivo_merito']['tmp_name'], $micarpeta . $new_nombre_2)) {
        $sql = "INSERT INTO formacion_acad_prac (tipo_estudios,nivel_estudios,ciclo_actual,centro_estudios,id_carrera,fecha_inicio,fecha_fin, formacion_acad_prac_idpostulante,archivo,orden_merito,archivo_merito,formacion_validacion) 
          VALUES('$tipo_estudios','$nivel_estudios_prof','$ciclo_actual','$centro_estudios','$carrera','$fecha_inicio','$fecha_fin','$idpostulante','$new_nombre','$orden_merito','$new_nombre_2','$formacion_validacion')";
        $result = mysqli_query($con, $sql);
        if ($result) {
          header('Location: ../formacion_prac.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar los datos"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
        }
      } else {
        echo '<script> alert("Ocurrió algún error al subir el fichero de mérito. No pudo guardarse."); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      }
    } else {
      echo '<script> alert("Ocurrió algún error al subir el fichero de formación. No pudo guardarse."); </script>';
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
    }
  }
} else {
  echo "Error al entrar al IF";
}
