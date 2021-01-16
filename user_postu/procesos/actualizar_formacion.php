<?php
// Insert the content of connection.php file
include('../conexion.php');

// Insert data into the database
if (isset($_POST['editar'])) {
  $colegiatura_validar = $_POST['colegiatura_edit'];

  $dni = $_POST['dni'];
  $dni_descrip = $_POST['dni_descrip'];
  $idformacion = $_POST['idformacion'];

  $tipo_estudios = $_POST['tipo_estudios_edit'];
  if ($tipo_estudios == '1') {
    if (!empty($_FILES['archivos1']['name'])) {
      $centro_estudios = strtoupper($_POST['centro_estudios']);
      $colegiatura = $_POST['colegiatura_edit'];
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_fin = $_POST['fecha_fin'];
      $licencia_conducir = $_POST['licencia_conducir'];
      $serums = $_POST['serums'];
      $nivel_estudios = '';
      $carrera = '';

      //crear carpeta
      $micarpeta = '../archivos/' . $dni_descrip . '/formacion/';
      //datos del arhivo
      $nombre_archivo = $_FILES['archivos1']['name'];
      $tipo_archivo = $_FILES['archivos1']['type'];
      $tamano_archivo = $_FILES['archivos1']['size'];

      $query = mysqli_query($con, "SELECT * FROM formacion_acad WHERE id_formacion = $idformacion");
      $row = mysqli_fetch_array($query);
      $antiguo_nombre = $row['archivo'];
      //BORRAR ARCHIVO
      unlink($micarpeta . $antiguo_nombre);
      //ACTUALIZAR NOMBRE
      $nombre_archivo = "new_" . $idformacion . ".pdf";

      //compruebo si las características del archivo son las que deseo
      if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
        echo '<script> alert("El archivo sobre pasa los 3MB permitidos o no es de extensión PDF."); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      } else {
        if (move_uploaded_file($_FILES['archivos1']['tmp_name'], $micarpeta . $nombre_archivo)) {

          $sql = "UPDATE formacion_acad SET tipo_estudios_id = '$tipo_estudios', centro_estudios = '$centro_estudios',nivel_estudios = '$nivel_estudios',carrera = '$carrera',colegiatura = '$colegiatura_validar',fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin',archivo = '$nombre_archivo', brevete ='$licencia_conducir' WHERE id_formacion='$idformacion'";
          $result = mysqli_query($con, $sql);
          if ($result) {
            header('Location: ../formacion.php?dni=' . $dni);
          } else {
            echo '<script> alert("Error al guardar los datos"); </script>';
            header('Location: ../formacion.php?dni=' . $dni);
          }
        } else {
          echo '<script> alert("Ocurrió algún error al subir el fichero. No pudo guardarse."); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
        }
      }
    } else {
      $centro_estudios = strtoupper($_POST['centro_estudios']);
      $colegiatura = $_POST['colegiatura_edit'];
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_fin = $_POST['fecha_fin'];
      $licencia_conducir = $_POST['licencia_conducir'];
      $serums = $_POST['serums'];
      $nivel_estudios = '';
      $carrera = '';

      $sql = "UPDATE formacion_acad SET tipo_estudios_id = '$tipo_estudios', centro_estudios = '$centro_estudios',nivel_estudios = '$nivel_estudios',carrera = '$carrera',colegiatura = '$colegiatura_validar',fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin', brevete ='$licencia_conducir' WHERE id_formacion='$idformacion'";
      $result = mysqli_query($con, $sql);
      if ($result) {
        header('Location: ../formacion.php?dni=' . $dni);
      } else {
        echo '<script> alert("Error al guardar los datos"); </script>';
        header('Location: ../formacion.php?dni=' . $dni);
      }
    }
  } elseif ($tipo_estudios == '2') {
    if (!empty($_FILES['archivos1']['name'])) {
      $nivel_estudios_tec = $_POST['nivel_estudios_tec'];
      $centro_estudios = strtoupper($_POST['centro_estudios']);
      $carrera = strtoupper($_POST['carrera']);
      $colegiatura = $_POST['colegiatura_edit'];
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_fin = $_POST['fecha_fin'];
      $licencia_conducir = $_POST['licencia_conducir'];
      $serums = $_POST['serums'];

      //crear carpeta
      $micarpeta = '../archivos/' . $dni_descrip . '/formacion/';
      //datos del arhivo
      $nombre_archivo = $_FILES['archivos1']['name'];
      $tipo_archivo = $_FILES['archivos1']['type'];
      $tamano_archivo = $_FILES['archivos1']['size'];

      $query = mysqli_query($con, "SELECT * FROM formacion_acad WHERE id_formacion = '$idformacion'");
      $row = mysqli_fetch_array($query);
      $antiguo_nombre = $row['archivo'];
      //BORRAR ARCHIVO
      unlink($micarpeta . $antiguo_nombre);
      //ACTUALIZAR NOMBRE
      $nombre_archivo = "new_" . $idformacion . ".pdf";

      //compruebo si las características del archivo son las que deseo
      if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
        echo '<script> alert("Ocurrió algún error al subir el fichero. No pudo guardarse."); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      } else {
        if (move_uploaded_file($_FILES['archivos1']['tmp_name'], $micarpeta . $nombre_archivo)) {
          $sql = "UPDATE formacion_acad SET tipo_estudios_id = '$tipo_estudios',nivel_estudios='$nivel_estudios_tec', centro_estudios = '$centro_estudios', 
          carrera = '$carrera', colegiatura = '$colegiatura',fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin', archivo ='$nombre_archivo', brevete ='$licencia_conducir' 
          WHERE id_formacion='$idformacion'";
          $result = mysqli_query($con, $sql);
          if ($result) {
            header('Location: ../formacion.php?dni=' . $dni);
          } else {
            echo '<script> alert("Error al guardar"); </script>';
            header('Location: ../formacion.php?dni=' . $dni);
          }
        } else {
          echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
          header('Location: ../formacion.php?dni=' . $dni);
        }
      }
    } else {
      $nivel_estudios_tec = $_POST['nivel_estudios_tec'];
      $centro_estudios = strtoupper($_POST['centro_estudios']);
      $carrera = strtoupper($_POST['carrera']);
      $colegiatura = $_POST['colegiatura_edit'];
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_fin = $_POST['fecha_fin'];
      $licencia_conducir = $_POST['licencia_conducir'];
      $serums = $_POST['serums'];
      $sql = "UPDATE formacion_acad SET tipo_estudios_id = '$tipo_estudios',nivel_estudios='$nivel_estudios_tec', centro_estudios = '$centro_estudios', 
      carrera = '$carrera', colegiatura = '$colegiatura',fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin', brevete ='$licencia_conducir' WHERE id_formacion='$idformacion'";
      $result = mysqli_query($con, $sql);
      if ($result) {
        echo '<script> alert("Guardado exitosamente"); </script>';
        // header('Location: ../formacion.php?dni=' . $dni);
      } else {
        echo '<script> alert("Error al guardar los datos"); </script>';
        // header('Location: ../formacion.php?dni=' . $dni);
      }
    }
  } elseif ($tipo_estudios == '3') {
    if (!empty($_FILES['archivos1']['name'])) {
      $colegiatura_validar = $_POST['colegiatura_edit'];
      $licencia_conducir = $_POST['licencia_conducir'];
      $serums = $_POST['serums'];

      $micarpeta = '../archivos/' . $dni_descrip . '/formacion/';
      //datos del arhivo
      $nombre_archivo = $_FILES['archivos1']['name'];
      $tipo_archivo = $_FILES['archivos1']['type'];
      $tamano_archivo = $_FILES['archivos1']['size'];

      $query = mysqli_query($con, "SELECT * FROM formacion_acad WHERE id_formacion = '$idformacion'");
      $row = mysqli_fetch_array($query);
      $antiguo_nombre = $row['archivo'];
      //BORRAR ARCHIVO
      unlink($micarpeta . $antiguo_nombre);
      //ACTUALIZAR NOMBRE
      $nombre_archivo = "new_" . $idformacion . ".pdf";

      //compruebo si las características del archivo son las que deseo
      if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
        echo '<script> alert("Ocurrió algún error al subir el fichero. No pudo guardarse."); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      } else {
        if (move_uploaded_file($_FILES['archivos1']['tmp_name'], $micarpeta . $new_nombre)) {
          $tipo_estudios = $_POST['tipo_estudios'];
          $nivel_estudios = $_POST['nivel_estudios_edit'];
          $centro_estudios = strtoupper($_POST['centro_estudios']);
          $carrera = strtoupper($_POST['carrera']);
          $colegiatura = $_POST['colegiatura_edit'];
          $fecha_inicio = $_POST['fecha_inicio'];
          $fecha_fin = $_POST['fecha_fin'];
          if ($nivel_estudios == 'ESTUDIANTE') {
            $ciclo_actual = $_POST['ciclo_actual'];
            $sql = "UPDATE formacion_acad SET tipo_estudios_id = '$tipo_estudios',nivel_estudios = '$nivel_estudios',ciclo_actual = '$ciclo_actual',centro_estudios = '$centro_estudios',carrera = '$carrera',colegiatura = '$colegiatura',fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin',archivo = '$nombre_archivo', brevete ='$licencia_conducir', serums='$serums' WHERE id_formacion='$idformacion'";

            $result = mysqli_query($con, $sql);
            if ($result) {
              header('Location: ../formacion.php?dni=' . $dni);
            } else {
              echo '<script> alert("Error al guardar la información"); </script>';
              header('Location: ../formacion.php?dni=' . $dni);
            }
          } elseif ($nivel_estudios == 'EGRESADO' || $nivel_estudios == 'BACHILLER') {
            $sql = "UPDATE formacion_acad SET tipo_estudios_id = '$tipo_estudios',nivel_estudios = '$nivel_estudios',centro_estudios = '$centro_estudios',carrera = '$carrera',colegiatura = '$colegiatura',fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin',archivo = '$nombre_archivo', brevete ='$licencia_conducir', serums='$serums' WHERE id_formacion='$idformacion'";

            $result = mysqli_query($con, $sql);
            if ($result) {
              header('Location: ../formacion.php?dni=' . $dni);
            } else {
              echo '<script> alert("Error al actualizar la información."); </script>';
              header('Location: ../formacion.php?dni=' . $dni);
            }
          } elseif ($nivel_estudios == 'TITULADO') {
            if ($colegiatura == 'SI') {
              $nro_colegiatura_edit = $_POST['nro_colegiatura_edit'];
              $fecha_colegiatura_edit = $_POST['fecha_colegiatura_edit'];
              $fech_habilitacion = $_POST['fech_habilitacion'];
              $tipo_profesional = $_POST['tipo_prof'];
              if ($tipo_profesional == 'administrativo') {
                $sql = "UPDATE formacion_acad SET tipo_estudios_id = '$tipo_estudios',nivel_estudios = '$nivel_estudios',centro_estudios = '$centro_estudios',carrera = '$carrera',colegiatura = '$colegiatura_validar',nro_colegiatura = '$nro_colegiatura_edit', fech_colegiatura='$fecha_colegiatura_edit',fech_habilitacion='$fech_habilitacion',fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin', archivo = '$nombre_archivo', brevete ='$licencia_conducir', tipo_profesional='$tipo_profesional', serums='$serums' WHERE id_formacion='$idformacion'";

                $result = mysqli_query($con, $sql);
                if ($result) {
                  header('Location: ../formacion.php?dni=' . $dni);
                } else {
                  echo '<script> alert("Error al guardar PRIMERA!"); </script>';
                  header('Location: ../formacion.php?dni=' . $dni);
                }
              } else {
                $serums = $_POST['serums'];
                $quintil = $_POST['quintil'];
                $sql = "UPDATE formacion_acad SET tipo_estudios_id = '$tipo_estudios',nivel_estudios = '$nivel_estudios',centro_estudios = '$centro_estudios',carrera = '$carrera',colegiatura = '$colegiatura_validar',nro_colegiatura = '$nro_colegiatura_edit', fech_colegiatura='$fecha_colegiatura_edit',fech_habilitacion='$fech_habilitacion',fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin', archivo = '$nombre_archivo', brevete ='$licencia_conducir',tipo_profesional='$tipo_profesional',serums='$serums',valor_quintil='$quintil' WHERE id_formacion='$idformacion'";

                $result = mysqli_query($con, $sql);
                if ($result) {
                  header('Location: ../formacion.php?dni=' . $dni);
                } else {
                  echo '<script> alert("Error al guardar PRIMERA!"); </script>';
                  header('Location: ../formacion.php?dni=' . $dni);
                }
              }
            } else {
              if ($tipo_profesional == 'administrativo') {
                $sql = "UPDATE formacion_acad SET tipo_estudios_id = '$tipo_estudios',nivel_estudios = '$nivel_estudios',centro_estudios = '$centro_estudios',carrera = '$carrera',colegiatura = '$colegiatura', fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin', archivo = '$nombre_archivo', brevete ='$licencia_conducir', tipo_profesional='$tipo_profesional', serums='$serums' WHERE id_formacion='$idformacion'";

                $result = mysqli_query($con, $sql);
                if ($result) {
                  header('Location: ../formacion.php?dni=' . $dni);
                } else {
                  echo '<script> alert("Error al guardar PRIMERA!"); </script>';
                  header('Location: ../formacion.php?dni=' . $dni);
                }
              } else {
                $serums = $_POST['serums'];
                $quintil = $_POST['quintil'];
                $sql = "UPDATE formacion_acad SET tipo_estudios_id = '$tipo_estudios',nivel_estudios = '$nivel_estudios',centro_estudios = '$centro_estudios',carrera = '$carrera',colegiatura = '$colegiatura', fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin', archivo = '$nombre_archivo', brevete ='$licencia_conducir', tipo_profesional='$tipo_profesional', serums='$serums',valor_quintil='$quintil' WHERE id_formacion='$idformacion'";

                $result = mysqli_query($con, $sql);
                if ($result) {
                  header('Location: ../formacion.php?dni=' . $dni);
                } else {
                  echo '<script> alert("Error al guardar PRIMERA!"); </script>';
                  header('Location: ../formacion.php?dni=' . $dni);
                }
              }
            }
          }
        } else {
          echo '<script> alert("Ocurrió algún error al subir el fichero. No pudo guardarse."); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
        }
      }
    } else {
      $colegiatura_validar = $_POST['colegiatura_edit'];
      $licencia_conducir = $_POST['licencia_conducir'];
      $serums = $_POST['serums'];

      $tipo_estudios = $_POST['tipo_estudios_edit'];
      $nivel_estudios = $_POST['nivel_estudios_edit'];
      $centro_estudios = strtoupper($_POST['centro_estudios']);
      $carrera = strtoupper($_POST['carrera']);
      $colegiatura = $_POST['colegiatura_edit'];
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_fin = $_POST['fecha_fin'];

      if ($nivel_estudios == 'ESTUDIANTE') {
        $ciclo_actual = $_POST['ciclo_actual'];
        $sql = "UPDATE formacion_acad SET tipo_estudios_id = '$tipo_estudios',nivel_estudios = '$nivel_estudios',ciclo_actual = '$ciclo_actual',centro_estudios = '$centro_estudios',carrera = '$carrera',colegiatura = '$colegiatura',fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin', brevete ='$licencia_conducir', serums='$serums' WHERE id_formacion='$idformacion'";

        $result = mysqli_query($con, $sql);
        if ($result) {
          header('Location: ../formacion.php?dni=' . $dni);
        } else {
          echo '<script> alert("Error al guardar los datos"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
        }
      } elseif ($nivel_estudios == 'EGRESADO' || $nivel_estudios == 'BACHILLER') {
        $sql = "UPDATE formacion_acad SET tipo_estudios_id = '$tipo_estudios',nivel_estudios = '$nivel_estudios',centro_estudios = '$centro_estudios',carrera = '$carrera',colegiatura = '$colegiatura',fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin', brevete ='$licencia_conducir', serums='$serums' WHERE id_formacion='$idformacion'";

        $result = mysqli_query($con, $sql);
        if ($result) {
          header('Location: ../formacion.php?dni=' . $dni);
        } else {
          echo '<script> alert("Error al guardar los datos"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
        }
      } elseif ($nivel_estudios == 'TITULADO') {
        if ($colegiatura == 'SI') {
          $nro_colegiatura_edit = $_POST['nro_colegiatura_edit'];
          $fecha_colegiatura_edit = $_POST['fecha_colegiatura_edit'];
          $fech_habilitacion = $_POST['fech_habilitacion'];
          $tipo_profesional = $_POST['tipo_prof'];
          if ($tipo_profesional == 'administrativo') {
            $sql = "UPDATE formacion_acad SET tipo_estudios_id = '$tipo_estudios',nivel_estudios = '$nivel_estudios',centro_estudios = '$centro_estudios',carrera = '$carrera',colegiatura = '$colegiatura_validar',nro_colegiatura = '$nro_colegiatura_edit', fech_colegiatura='$fecha_colegiatura_edit',fech_habilitacion='$fech_habilitacion',fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin', brevete ='$licencia_conducir', tipo_profesional='$tipo_profesional', serums='$serums' WHERE id_formacion='$idformacion'";

            $result = mysqli_query($con, $sql);
            if ($result) {
              header('Location: ../formacion.php?dni=' . $dni);
            } else {
              echo '<script> alert("Error al guardar los datos"); </script>';
              echo "<script type=\"text/javascript\">history.go(-1);</script>";
            }
          } else {
            $serums = $_POST['serums'];
            $quintil = $_POST['quintil'];
            $sql = "UPDATE formacion_acad SET tipo_estudios_id = '$tipo_estudios',nivel_estudios = '$nivel_estudios',centro_estudios = '$centro_estudios',carrera = '$carrera',colegiatura = '$colegiatura_validar',nro_colegiatura = '$nro_colegiatura_edit', fech_colegiatura='$fecha_colegiatura_edit',fech_habilitacion='$fech_habilitacion',fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin', archivo = '$nombre_archivo', brevete ='$licencia_conducir',tipo_profesional='$tipo_profesional',serums='$serums',valor_quintil='$quintil' WHERE id_formacion='$idformacion'";

            $result = mysqli_query($con, $sql);
            if ($result) {
              header('Location: ../formacion.php?dni=' . $dni);
            } else {
              echo '<script> alert("Error al guardar los datos"); </script>';
              echo "<script type=\"text/javascript\">history.go(-1);</script>";
            }
          }
        } else {
          if ($tipo_profesional == 'administrativo') {
            $sql = "UPDATE formacion_acad SET tipo_estudios_id = '$tipo_estudios',nivel_estudios = '$nivel_estudios',centro_estudios = '$centro_estudios',carrera = '$carrera',colegiatura = '$colegiatura', fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin', archivo = '$nombre_archivo', brevete ='$licencia_conducir', tipo_profesional='$tipo_profesional', serums='$serums' WHERE id_formacion='$idformacion'";

            $result = mysqli_query($con, $sql);
            if ($result) {
              header('Location: ../formacion.php?dni=' . $dni);
            } else {
              echo '<script> alert("Error al guardar los datos"); </script>';
              echo "<script type=\"text/javascript\">history.go(-1);</script>";
            }
          } else {
            $serums = $_POST['serums'];
            $quintil = $_POST['quintil'];
            $sql = "UPDATE formacion_acad SET tipo_estudios_id = '$tipo_estudios',nivel_estudios = '$nivel_estudios',centro_estudios = '$centro_estudios',carrera = '$carrera',colegiatura = '$colegiatura', fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin', archivo = '$nombre_archivo', brevete ='$licencia_conducir', tipo_profesional='$tipo_profesional', serums='$serums',valor_quintil='$quintil' WHERE id_formacion='$idformacion'";

            $result = mysqli_query($con, $sql);
            if ($result) {
              header('Location: ../formacion.php?dni=' . $dni);
            } else {
              echo '<script> alert("Error al guardar los datos"); </script>';
              echo "<script type=\"text/javascript\">history.go(-1);</script>";
            }
          }
        }
      }
    }
  }
} elseif (isset($_POST['editar_prac'])) {
  $dni = $_POST['dni'];
  $dni_descrip = $_POST['dni_encriptado'];
  $idformacion = $_POST['id_formacion'];

  $tipo_estudios = 'UNIVERSITARIO';
  $nivel_estudios_prof = $_POST['nivel_estudios_prof'];
  $ciclo_actual = $_POST['ciclo_actual'];
  $fecha_inicio = $_POST['fecha_inicio'];
  $fecha_fin = $_POST['fecha_fin'];
  $centro_estudios = strtoupper($_POST['centro_estudios']);
  $carrera = strtoupper($_POST['carrera']);
  $orden_merito = $_POST['orden_merito'];

  if (!empty($_FILES['archivo']['name'])) {
    if (!empty($_FILES['archivo_merito']['name'])) {
      //crear carpeta
      $micarpeta = '../archivos/' . $dni_descrip . '/formacion_prac/';
      //datos del arhivo
      $nombre_archivo = $_FILES['archivo']['name'];
      $tipo_archivo = $_FILES['archivo']['type'];
      $tamano_archivo = $_FILES['archivo']['size'];

      $query = mysqli_query($con, "SELECT * FROM formacion_acad_prac WHERE idformacion_acad_prac = $idformacion");
      $row = mysqli_fetch_array($query);
      $antiguo_nombre = $row['archivo'];
      $antiguo_nombre_merito = $row['archivo_merito'];
      //BORRAR ARCHIVO
      unlink($micarpeta . $antiguo_nombre);
      unlink($micarpeta . $antiguo_nombre_merito);
      //ACTUALIZAR NOMBRE
      $nombre_archivo = "new_" . $idformacion . "_prac.pdf";
      $nombre_archivo_merito = "new_" . $idformacion . "_merito.pdf";

      //compruebo si las características del archivo son las que deseo
      if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
        echo '<script> alert("El archivo sobrepasa los 3 MB máximos."); 
          window.history.back(-1);</script>';
      } else {
        if (move_uploaded_file($_FILES['archivos1']['tmp_name'], $micarpeta . $nombre_archivo)) {
          if (move_uploaded_file($_FILES['archivo_merito']['tmp_name'], $micarpeta . $nombre_archivo_merito)) {
            $sql = "UPDATE formacion_acad_prac SET tipo_estudios = '$tipo_estudios',nivel_estudios='$nivel_estudios_prof', centro_estudios = '$centro_estudios',ciclo_actual = '$ciclo_actual',id_carrera = '$carrera',fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin',archivo = '$nombre_archivo',orden_merito='$orden_merito',archivo_merito='$nombre_archivo_merito' WHERE idformacion_acad_prac='$idformacion'";
            $result = mysqli_query($con, $sql);
            if ($result) {
              header('Location: ../formacion_prac.php?dni=' . $dni);
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
      $nombre_archivo_merito = '';
      //crear carpeta
      $micarpeta = '../archivos/' . $dni_descrip . '/formacion/';
      //datos del arhivo
      $nombre_archivo = $_FILES['archivos']['name'];
      $tipo_archivo = $_FILES['archivos']['type'];
      $tamano_archivo = $_FILES['archivos']['size'];

      $query = mysqli_query($con, "SELECT * FROM formacion_acad_prac WHERE idformacion_acad_prac = $idformacion");
      $row = mysqli_fetch_array($query);
      $antiguo_nombre = $row['archivo'];
      //BORRAR ARCHIVO
      unlink($micarpeta . $antiguo_nombre);
      //ACTUALIZAR NOMBRE
      $nombre_archivo = "new_" . $idformacion . ".pdf";

      //compruebo si las características del archivo son las que deseo
      if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
        echo '<script> alert("El archivo sobrepasa los 3 MB máximos."); 
          window.history.back(-1);</script>';
      } else {
        if (move_uploaded_file($_FILES['archivos']['tmp_name'], $micarpeta . $nombre_archivo)) {
          $sql = "UPDATE formacion_acad_prac SET tipo_estudios = '$tipo_estudios',nivel_estudios='$nivel_estudios_prof', centro_estudios = '$centro_estudios',ciclo_actual = '$ciclo_actual',id_carrera = '$carrera',fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin',archivo = '$nombre_archivo',orden_merito='$orden_merito',archivo_merito='$nombre_archivo_merito' WHERE idformacion_acad_prac='$idformacion'";
          $result = mysqli_query($con, $sql);
          if ($result) {
            header('Location: ../formacion_prac.php?dni=' . $dni);
          } else {
            echo '<script> alert("Error al guardar los datos"); </script>';
            echo "<script type=\"text/javascript\">history.go(-1);</script>";
          }
        } else {
          echo '<script> alert("Ocurrió algún error al subir el fichero. No pudo guardarse."); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
        }
      }
    }
  } elseif (!empty($_FILES['archivo_merito']['name'])) {
    //crear carpeta
    $micarpeta = '../archivos/' . $dni_descrip . '/formacion_prac/';
    //datos del arhivo
    $nombre_archivo = $_FILES['archivo_merito']['name'];
    $tipo_archivo = $_FILES['archivo_merito']['type'];
    $tamano_archivo = $_FILES['archivo_merito']['size'];

    $query = mysqli_query($con, "SELECT * FROM formacion_acad_prac WHERE idformacion_acad_prac = $idformacion");
    $row = mysqli_fetch_array($query);
    $antiguo_nombre_merito = $row['archivo_merito'];
    //BORRAR ARCHIVO
    unlink($micarpeta . $antiguo_nombre_merito);
    //ACTUALIZAR NOMBRE
    $nombre_archivo_merito = "new_" . $idformacion . "_merito.pdf";

    //compruebo si las características del archivo son las que deseo
    if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
      echo '<script> alert("El archivo sobrepasa los 3 MB máximos."); 
          window.history.back(-1);</script>';
    } else {
      if (move_uploaded_file($_FILES['archivo_merito']['tmp_name'], $micarpeta . $nombre_archivo_merito)) {
        $sql = "UPDATE formacion_acad_prac SET tipo_estudios = '$tipo_estudios',nivel_estudios='$nivel_estudios_prof', centro_estudios = '$centro_estudios',ciclo_actual = '$ciclo_actual',id_carrera = '$carrera',fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin',orden_merito='$orden_merito',archivo_merito='$nombre_archivo_merito' WHERE idformacion_acad_prac='$idformacion'";
        $result = mysqli_query($con, $sql);
        if ($result) {
          header('Location: ../formacion_prac.php?dni=' . $dni);
        } else {
          echo '<script> alert("Error al guardar los datos"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
        }
      } else {
        echo '<script> alert("Ocurrió algún error al subir el fichero de formación. No pudo guardarse."); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      }
    }
  } else {
    $sql = "UPDATE formacion_acad_prac SET tipo_estudios = '$tipo_estudios',nivel_estudios='$nivel_estudios_prof', centro_estudios = '$centro_estudios',ciclo_actual = '$ciclo_actual',id_carrera = '$carrera',fecha_inicio='$fecha_inicio',fecha_fin = '$fecha_fin',orden_merito='$orden_merito' WHERE idformacion_acad_prac='$idformacion'";
    $result = mysqli_query($con, $sql);
    if ($result) {
      header('Location: ../formacion_prac.php?dni=' . $dni);
    } else {
      echo '<script> alert("Error al guardar los datos"); </script>';
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
    }
  }
}
