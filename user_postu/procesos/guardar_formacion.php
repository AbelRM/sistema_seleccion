<?php
// Insert the content of connection.php file
include '../conexion.php';
$dato_desencriptado = $_POST['dni_encriptado'];
$dni = $_POST['dni'];
$idpostulante = $_POST['postulante'];

if (isset($_POST['insertData'])) {
  $tipo_estudios = $_POST['tipo_estudios'];
  if ($tipo_estudios == '1') {
    $centro_estudios = $_POST['centro_estudios'];
    $colegiatura = $_POST['colegiatura'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $licencia_conducir = $_POST['licencia_conducir'];
    $serums = $_POST['serums'];

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
        $sql = "INSERT INTO formacion_acad (tipo_estudios_id,centro_estudios,colegiatura,fecha_inicio,
          fecha_fin, formacion_idpostulante,archivo, brevete, serums) 
          VALUES('$tipo_estudios','$centro_estudios','$colegiatura','$fecha_inicio','$fecha_fin','$idpostulante','$new_nombre','$licencia_conducir','$serums')";

        $result = mysqli_query($con, $sql);
        if ($result) {
          // echo '<script> alert("Guardado exitosamente"); </script>';
          header('Location: ../formacion.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar los datos"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // echo '<script> alert("Error al guardar los datos"); </script>';
          // header('Location: ../formacion.php?dni=' . $dato_desencriptado);
        }
      } else {
        echo '<script> alert("Ocurrió algún error al subir el fichero. No pudo guardarse."); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
        // echo '<script> alert("Ocurrió algún error al subir el fichero. No pudo guardarse."); </script>';
        // header('Location: ../formacion.php?dni=' . $dato_desencriptado);
      }
    }
  } elseif ($tipo_estudios == '2') {
    $nivel_estudios_tec = $_POST['nivel_estudios_tec'];
    $centro_estudios = $_POST['centro_estudios'];
    $carrera = $_POST['carrera'];
    $colegiatura = $_POST['colegiatura'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $licencia_conducir = $_POST['licencia_conducir'];
    $serums = $_POST['serums'];

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
        $sql = "INSERT INTO formacion_acad (tipo_estudios_id,nivel_estudios,centro_estudios,carrera,colegiatura,fecha_inicio,fecha_fin, formacion_idpostulante,archivo,brevete,serums) 
          VALUES('$tipo_estudios','$nivel_estudios_tec','$centro_estudios','$carrera','$colegiatura,'$fecha_inicio','$fecha_fin','$idpostulante','$new_nombre','$licencia_conducir','$serums')";
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
        // echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
        // header('Location: ../formacion.php?dni=' . $dato_desencriptado);
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
            $sql = "INSERT INTO formacion_acad (tipo_estudios_id,nivel_estudios,ciclo_actual,centro_estudios,carrera,colegiatura,fecha_inicio,fecha_fin, formacion_idpostulante,archivo,brevete,serums) 
            VALUES('$tipo_estudios','$nivel_estudios','$ciclo_actual','$centro_estudios', '$carrera','$colegiatura_validar','$fecha_inicio',
            '$fecha_fin','$idpostulante','$new_nombre','$licencia_conducir','$serums')";

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
            $sql = "INSERT INTO formacion_acad (tipo_estudios_id,nivel_estudios,centro_estudios,carrera,colegiatura,fecha_inicio,fecha_fin, formacion_idpostulante,archivo,brevete,serums) 
            VALUES('$tipo_estudios','$nivel_estudios','$centro_estudios', '$carrera','$colegiatura_validar','$fecha_inicio',
            '$fecha_fin','$idpostulante','$new_nombre','$licencia_conducir','$serums')";

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
            // echo '<script> alert("No es ESTUDIANTE, EGRESADO O BACHILLER, elegir correctamente"); </script>';
            // header('Location: ../formacion.php?dni=' . $dato_desencriptado);
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
              $sql = "INSERT INTO formacion_acad (tipo_estudios_id,nivel_estudios,centro_estudios,carrera,colegiatura,nro_colegiatura,fech_colegiatura,fech_habilitacion,fecha_inicio,fecha_fin, formacion_idpostulante,archivo, brevete, tipo_profesional,serums, valor_quintil) 
              VALUES('$tipo_estudios','$nivel_estudios','$centro_estudios', '$carrera','$colegiatura_validar','$nro_colegiatura','$fech_colegiatura','$fech_habilitacion','$fecha_inicio',
              '$fecha_fin','$idpostulante','$new_nombre','$licencia_conducir','$tipo_prof','$serums','$quintil')";

              $result = mysqli_query($con, $sql);
              if ($result) {

                // echo '<script> alert("Guardado exitosamente"); </script>';
                header('Location: ../formacion.php?dni=' . $dato_desencriptado);
              } else {
                echo '<script> alert("Ocurrió algún error al guardar los datos."); </script>';
                echo "<script type=\"text/javascript\">history.go(-1);</script>";
                // echo '<script> alert("Error al guardar PRIMERA!"); </script>';
                // header('Location: ../formacion.php?dni=' . $dato_desencriptado);
              }
            } elseif ($tipo_prof == 'administrativo') {
              $serums = $_POST['serums'];
              $sql = "INSERT INTO formacion_acad (tipo_estudios_id,nivel_estudios,centro_estudios,carrera,colegiatura,nro_colegiatura,fech_colegiatura,fech_habilitacion,fecha_inicio,fecha_fin, formacion_idpostulante,archivo, brevete, tipo_profesional,serums) 
              VALUES('$tipo_estudios','$nivel_estudios','$centro_estudios', '$carrera','$colegiatura_validar','$nro_colegiatura','$fech_colegiatura','$fech_habilitacion','$fecha_inicio',
              '$fecha_fin','$idpostulante','$new_nombre','$licencia_conducir','$tipo_prof','$serums')";

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
}
