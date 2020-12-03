<?php
include('../conexion.php');

// Insert data into the database
if (isset($_POST['insertData'])) {

  $dato_desencriptado = $_POST['dni_encriptado'];
  $dni = $_POST['dni'];
  $idpostulante = $_POST['postulante'];

  $centro_estudios = $_POST['centro_estudios'];
  $especialidad = $_POST['especialidad'];
  $nivel = $_POST['nivel_estudios'];
  $fecha_inicio = $_POST['fecha_inicio'];
  $fecha_fin = $_POST['fecha_fin'];

  $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/Superiores/';
  if (!file_exists($micarpeta)) {
    mkdir($micarpeta, 0777, true);
  }

  $nombre_archivo = $_FILES['archivo']['name'];
  $tipo_archivo = $_FILES['archivo']['type'];
  $tamano_archivo = $_FILES['archivo']['size'];

  $query = mysqli_query($con, "SELECT * FROM estudios_superiores WHERE idpostulante_postulante = $idpostulante");
  $result = mysqli_num_rows($query);
  if ($result <= 0) {
    $i = 1;
    $new_nombre = "estudios_" . $i . ".pdf";
  } else {
    $row = mysqli_fetch_array($query);
    $idformacion = $row['idestudios'];
    $i = $idformacion;
    $new_nombre = "estudios_" . $i . ".pdf";
  }

  if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
    echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Solo se permiten archivos .pdf<br><li>se permiten archivos de 3 Mb máximo.</td></tr></table>";
  } else {
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $micarpeta . $new_nombre)) {

      $sql = "INSERT INTO estudios_superiores (centro_estu,especialidad,fech_ini,fech_fin,nivel,archivo,idpostulante_postulante) 
            VALUES('$centro_estudios','$especialidad','$fecha_inicio','$fecha_fin','$nivel','$new_nombre','$idpostulante')";

      $result = mysqli_query($con, $sql);
      if ($result) {
        // echo '<script> alert("Guardado exitosamente"); </script>';
        // echo "<script type=\"text/javascript\">history.go(-1);</script>"
        header('Location: ../capacitacion.php?dni=' . $dato_desencriptado . '&list-messages');
      } else {
        echo '<script> alert("Error al guardar información."); </script>';
        header('Location: ../capacitacion.php?dni=' . $dato_desencriptado . '&list-messages');
      }
    } else {
      echo '<script> alert("Error al guardar el archivo"); </script>';
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
    }
  }
} elseif (isset($_POST['insert_postgrado'])) {
  $dato_desencriptado = $_POST['dni_encriptado'];
  $dni = $_POST['dni'];
  $idpostulante = $_POST['postulante'];

  $centro_estudios = strtoupper($_POST['centro_estudios']);
  $especialidad = strtoupper($_POST['especialidad']);
  $tipo = $_POST['tipo'];
  $fecha_inicio = $_POST['fecha_inicio'];
  $fecha_fin = $_POST['fecha_fin'];
  $nivel = $_POST['nivel_estudios'];

  $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/Postgrado/';
  if (!file_exists($micarpeta)) {
    mkdir($micarpeta, 0777, true);
  }

  $nombre_archivo = $_FILES['archivo1']['name'];
  $tipo_archivo = $_FILES['archivo1']['type'];
  $tamano_archivo = $_FILES['archivo1']['size'];

  $query = mysqli_query($con, "SELECT MAX(idmaestria_doc) AS id FROM maestria_doc WHERE idpostulante_postulante = $idpostulante");
  if ($row = mysqli_fetch_row($query)) {
    $id = trim($row[0]);
  }
  $result = mysqli_num_rows($query);
  if ($result <= 0) {
    $i = 1;
    $new_nombre = "postgrado_" . $i . ".pdf";
  } else {
    $i = $id + 1;
    echo $i;
    $new_nombre = "postgrado_" . $i . ".pdf";
  }


  if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
    echo '<script> alert("El archivo excede el tamaño de 3 MB."); </script>';
    echo "<script type=\"text/javascript\">history.go(-1);</script>";
  } else {
    if (move_uploaded_file($_FILES['archivo1']['tmp_name'], $micarpeta . $new_nombre)) {

      $sql = "INSERT INTO maestria_doc (centro_estu,especialidad,tipo_estu,fech_ini,fech_fin,nivel,archivo, idpostulante_postulante) 
            VALUES('$centro_estudios','$especialidad','$tipo','$fecha_inicio','$fecha_fin','$nivel','$new_nombre', '$idpostulante')";

      $result = mysqli_query($con, $sql);
      if ($result) {
        // echo '<script> alert("Guardado exitosamente"); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      } else {
        // echo '<script> alert("Error al guardar la informacion"); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      }
    } else {
      // echo '<script> alert("Error al guardar el archivo"); </script>';
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
    }
  }
} elseif (isset($_POST['insert_diplomado'])) {
  $dato_desencriptado = $_POST['dni_encriptado'];
  $dni = $_POST['dni'];
  $idpostulante = $_POST['postulante'];

  $centro_estudios = strtoupper($_POST['centro_estudios']);
  $materia = strtoupper($_POST['materia']);
  $tipo = $_POST['tipo'];
  $horas = $_POST['horas'];
  $fecha_inicio = $_POST['fecha_inicio'];
  $fecha_fin = $_POST['fecha_fin'];

  $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/Diplomados/';
  if (!file_exists($micarpeta)) {
    mkdir($micarpeta, 0777, true);
  }

  $nombre_archivo = $_FILES['archivo']['name'];
  $tipo_archivo = $_FILES['archivo']['type'];
  $tamano_archivo = $_FILES['archivo']['size'];

  $query = mysqli_query($con, "SELECT MAX(idcursos_extra) AS id FROM cursos_extra WHERE curso_extra_idpostulante = $idpostulante");
  if ($row = mysqli_fetch_row($query)) {
    $id = trim($row[0]);
  }
  $result = mysqli_num_rows($query);
  if ($result <= 0) {
    $i = 1;
    $new_nombre = "cursos_" . $i . ".pdf";
  } else {
    $i = $id + 1;
    echo $i;
    $new_nombre = "cursos_" . $i . ".pdf";
  }

  if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
    echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Solo se permiten archivos .pdf<br><li>se permiten archivos de 3 Mb máximo.</td></tr></table>";
  } else {
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $micarpeta . $new_nombre)) {

      $sql = "INSERT INTO cursos_extra (centro_estu,materia,horas,fech_ini,fech_fin,tipo,archivo, curso_extra_idpostulante) 
            VALUES('$centro_estudios','$materia','$horas','$fecha_inicio','$fecha_fin','$tipo','$new_nombre', '$idpostulante')";

      $result = mysqli_query($con, $sql);
      if ($result) {
        header('Location: ../capacitacion.php?dni=' . $dato_desencriptado . '#list-messages');
        // echo "<script type=\"text/javascript\">history.go(-1);</script>";
      } else {
        // echo '<script> alert("Error al guardar la información."); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      }
    } else {
      // echo '<script> alert("Error al guardar el archivo."); </script>';
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
    }
  }
} elseif (isset($_POST['insert_idioma'])) {
  $dato_desencriptado = $_POST['dni_encriptado'];
  $dni = $_POST['dni'];
  $idpostulante = $_POST['postulante'];

  $idioma = $_POST['idioma'];
  $centro_estudios_idio = $_POST['centro_estudios_idio'];
  $nivel = $_POST['nivel'];

  $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/Idiomas_Computacion/';
  if (!file_exists($micarpeta)) {
    mkdir($micarpeta, 0777, true);
  }

  $nombre_archivo = $_FILES['archivo']['name'];
  $tipo_archivo = $_FILES['archivo']['type'];
  $tamano_archivo = $_FILES['archivo']['size'];

  $query = mysqli_query($con, "SELECT MAX(ididiomas_comp) AS id FROM idiomas_comp WHERE idpostulante_postulante = $idpostulante");
  if ($row = mysqli_fetch_row($query)) {
    $id = trim($row[0]);
  }
  $result = mysqli_num_rows($query);
  if ($result <= 0) {
    $i = 1;
    $new_nombre = "idiomas_comp_" . $i . ".pdf";
  } else {
    $i = $id + 1;
    echo $i;
    $new_nombre = "idiomas_comp_" . $i . ".pdf";
  }

  if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
    echo '<script> alert("El archivo pesa más de 3 MB."); </script>';
    echo "<script type=\"text/javascript\">history.go(-1);</script>";
  } else {
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $micarpeta . $new_nombre)) {

      $sql = "INSERT INTO idiomas_comp (idioma_comp,lugar_estudio,nivel,archivo,idpostulante_postulante) 
            VALUES('$idioma','$centro_estudios_idio','$nivel','$new_nombre','$idpostulante')";

      $result = mysqli_query($con, $sql);
      if ($result) {

        // echo '<script> alert("Guardado exitosamente"); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
        // header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
      } else {
        // echo '<script> alert("Error al guardar la información."); </script>';
        echo "error";
        // echo "<script type=\"text/javascript\">history.go(-1);</script>";
      }
    } else {
      // echo '<script> alert("Error al guardar el archivo."); </script>';
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
    }
  }
}
