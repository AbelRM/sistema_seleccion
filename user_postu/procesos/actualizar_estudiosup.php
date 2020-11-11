<?php
include '../conexion.php';

if (isset($_POST['updateData1'])) {
  $dato_desencriptado = $_POST['dato_desencriptado'];
  $idestudios = $_POST['idestudios'];
  $dni = $_POST['dni1'];
  $verificar_archivo = $_FILES["archivos1"];

  if ($_FILES['archivos1']['name'] != null) {
    echo "Tiene datos La variable";

    $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/Superiores/';
    //datos del arhivo
    $nombre_archivo = $_FILES['archivos1']['name'];
    $tipo_archivo = $_FILES['archivos1']['type'];
    $tamano_archivo = $_FILES['archivos1']['size'];

    $query = mysqli_query($con, "SELECT * FROM estudios_superiores WHERE idestudios = $idestudios");
    $row = mysqli_fetch_array($query);
    $antiguo_nombre = $row['archivo'];

    $centro_estu = $_POST['centro_estu'];
    $especialidad = $_POST['especialida'];
    $fecha_inicio = $_POST['fecha_i'];
    $fecha_fin = $_POST['fecha_f'];
    $nivel = $_POST['nivel_estu'];

    //compruebo si las características del archivo son las que deseo
    if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
      echo '<script> alert("El archivo sobrepasa los 3MB máximos."); 
        window.history.back(-1);</script>';
    } else {
      if (move_uploaded_file($_FILES['archivos1']['tmp_name'], $micarpeta . $antiguo_nombre)) {

        $sql = "UPDATE estudios_superiores SET centro_estu='" . $centro_estu . "', especialidad='" . $especialidad . "', fech_ini='" . $fecha_inicio . "', fech_fin='" . $fecha_fin . "', nivel='" . $nivel . "', archivo='" . $antiguo_nombre . "' WHERE idestudios='" . $idestudios . "' ";

        $sql = "UPDATE expe_4puntos SET lugar='" . $lugar . "', cargo='" . $cargo . "',fecha_inicio='" . $fech_inicio . "', fecha_fin='" . $fech_fin . "', anios='" . $años . "', meses='" . $meses . "', dias='" . $dias . "', archivos='" . $antiguo_nombre . "' WHERE id_4puntos='" . $id_4puntos . "'";
        $result = mysqli_query($con, $sql);

        $result = mysqli_query($con, $sql);
        if ($result) {
          echo '<script> alert("Guardado exitosamente"); </script>';
          header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar"); </script>';
          header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
        }
      } else {
        echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
        header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
      }
    }
  } else {
    echo "No hay datos";
    $centro_estu = $_POST['centro_estu'];
    $especialidad = $_POST['especialida'];
    $fecha_inicio = $_POST['fecha_i'];
    $fecha_fin = $_POST['fecha_f'];
    $nivel = $_POST['nivel_estu'];

    $sql = "UPDATE estudios_superiores SET centro_estu='" . $centro_estu . "', especialidad='" . $especialidad . "', fech_ini='" . $fecha_inicio . "', 
    fech_fin='" . $fecha_fin . "', nivel='" . $nivel . "' WHERE idestudios='" . $idestudios . "' ";

    $result = mysqli_query($con, $sql);
    if ($result) {
      echo '<script> alert("Guardado exitosamente"); </script>';
      header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
    } else {
      echo '<script> alert("Error al guardar"); </script>';
      header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
    }
  }
} elseif (isset($_POST['updateData2'])) {
  $dato_desencriptado = $_POST['dato_desencriptado'];
  $id_maestria = $_POST['idmaestria_doc'];
  $dni = $_POST['dni2'];
  $verificar_archivo = $_FILES["archivos2"];

  if ($_FILES['archivos2']['name'] != null) {
    echo "Tiene datos La variable";
    $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/Postgrado/';
    //datos del arhivo
    $nombre_archivo = $_FILES['archivos2']['name'];
    $tipo_archivo = $_FILES['archivos2']['type'];
    $tamano_archivo = $_FILES['archivos2']['size'];

    $query = mysqli_query($con, "SELECT * FROM maestria_doc WHERE idmaestria_doc = $id_maestria");
    $row = mysqli_fetch_array($query);
    $antiguo_nombre = $row['archivo'];
    // $new_nombre = "nuevo_" . $antiguo_nombre;

    $centro_estu = $_POST['centro_estudi'];
    $especialidad = $_POST['especialidades'];
    $tipoest = $_POST['tipo_estu'];
    $fecha_inicio = $_POST['fecha_inic'];
    $fecha_fin = $_POST['fecha_fi'];
    $nivel = $_POST['nivel1'];

    //compruebo si las características del archivo son las que deseo
    if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
      echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Solo se permiten archivos .pdf<br><li>se permiten archivos de 3 Mb máximo.</td></tr></table>";
    } else {
      if (move_uploaded_file($_FILES['archivos2']['tmp_name'], $micarpeta . $antiguo_nombre)) {

        $sql = "UPDATE maestria_doc SET centro_estu='" . $centro_estu . "', especialidad='" . $especialidad . "',tipo_estu='" . $tipoest . "', fech_ini='" . $fecha_inicio . "', 
        fech_fin='" . $fecha_fin . "', nivel='" . $nivel . "',archivos='" . $antiguo_nombre . "' WHERE idmaestria_doc='" . $idestudios . "' ";

        $result = mysqli_query($con, $sql);
        if ($result) {
          echo '<script> alert("Guardado exitosamente"); </script>';
          header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar"); </script>';
          header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
        }
      } else {
        echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
        header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
      }
    }
  } else {
    echo "No hay datos";

    $centro_estu = $_POST['centro_estudi'];
    $especialidad = $_POST['especialidades'];
    $tipoest = $_POST['tipo_estu'];
    $fecha_inicio = $_POST['fecha_inic'];
    $fecha_fin = $_POST['fecha_fi'];
    $nivel = $_POST['nivel1'];

    $sql = "UPDATE maestria_doc SET centro_estu='" . $centro_estu . "', especialidad='" . $especialidad . "',tipo_estu='" . $tipoest . "', fech_ini='" . $fecha_inicio . "', 
    fech_fin='" . $fecha_fin . "', nivel='" . $nivel . "' WHERE idmaestria_doc='" . $id_maestria . "' ";

    $result = mysqli_query($con, $sql);
    if ($result) {
      echo '<script> alert("Guardado exitosamente"); </script>';
      header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
    } else {
      echo '<script> alert("Error al guardar"); </script>';
      header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
    }
  }
} elseif (isset($_POST['updateData3'])) {
  $dato_desencriptado = $_POST['dato_desencriptado'];
  $idcursos = $_POST['idcursos_extra'];
  $dni = $_POST['dni3'];
  $verificar_archivo = $_FILES["archivos3"];

  if ($_FILES['archivos3']['name'] != null) {
    echo "Tiene datos La variable";
    $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/Diplomados/';
    //datos del arhivo
    $nombre_archivo = $_FILES['archivos3']['name'];
    $tipo_archivo = $_FILES['archivos3']['type'];
    $tamano_archivo = $_FILES['archivos3']['size'];

    $query = mysqli_query($con, "SELECT * FROM cursos_extra WHERE idcursos_extra = $idcursos");
    $row = mysqli_fetch_array($query);
    $antiguo_nombre = $row['archivo'];

    $centro_estu = $_POST['centro_estud'];
    $materia = $_POST['materia1'];
    $horas = $_POST['horas1'];
    $fecha_inicio = $_POST['fech_inic1'];
    $fecha_fin = $_POST['fech_fin1'];
    $tipo = $_POST['tip'];

    //compruebo si las características del archivo son las que deseo
    if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
      echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Solo se permiten archivos .pdf<br><li>se permiten archivos de 3 Mb máximo.</td></tr></table>";
    } else {
      if (move_uploaded_file($_FILES['archivos3']['tmp_name'], $micarpeta . $antiguo_nombre)) {

        $sql = "UPDATE cursos_extra SET centro_estu='" . $centro_estu . "', materia='" . $materia . "',horas='" . $horas . "', fech_ini='" . $fecha_inicio . "', fech_fin='" . $fecha_fin . "', tipo='" . $tipo . "', archivo='" . $antiguo_nombre . "' WHERE idcursos_extra='" . $idcursos . "' ";

        $result = mysqli_query($con, $sql);
        if ($result) {
          echo '<script> alert("Guardado exitosamente"); </script>';
          header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar"); </script>';
          header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
        }
      } else {
        echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
        header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
      }
    }
  } else {
    echo "No hay datos";

    $centro_estu = $_POST['centro_estud'];
    $materia = $_POST['materia1'];
    $horas = $_POST['horas1'];
    $fecha_inicio = $_POST['fech_inic1'];
    $fecha_fin = $_POST['fech_fin1'];
    $tipo = $_POST['tip'];

    $sql = "UPDATE cursos_extra SET centro_estu='" . $centro_estu . "', materia='" . $materia . "',horas='" . $horas . "', fech_ini='" . $fecha_inicio . "', 
    fech_fin='" . $fecha_fin . "', tipo='" . $tipo . "' WHERE idcursos_extra='" . $idcursos . "' ";


    $result = mysqli_query($con, $sql);
    if ($result) {
      echo '<script> alert("Guardado exitosamente"); </script>';
      header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
    } else {
      echo '<script> alert("Error al guardar"); </script>';
      header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
    }
  }
} elseif (isset($_POST['updateData4'])) {
  $dato_desencriptado = $_POST['dato_desencriptado'];
  $dni = $_POST['dni4'];
  $verificar_archivo = $_FILES["archivos4"];
  $ididiomas = $_POST['ididiomas_comp'];

  if ($_FILES['archivos4']['name'] != null) {
    echo "Tiene datos La variable";
    $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/Idiomas_Computacion/';
    //datos del arhivo
    $nombre_archivo = $_FILES['archivos4']['name'];
    $tipo_archivo = $_FILES['archivos4']['type'];
    $tamano_archivo = $_FILES['archivos4']['size'];

    $query = mysqli_query($con, "SELECT * FROM idiomas_comp WHERE ididiomas_comp = $ididiomas");
    $row = mysqli_fetch_array($query);
    $antiguo_nombre = $row['archivos'];

    $idiomas = $_POST['idioma_comp'];
    $nivel = $_POST['nivel4'];

    //compruebo si las características del archivo son las que deseo
    if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
      echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Solo se permiten archivos .pdf<br><li>se permiten archivos de 3 Mb máximo.</td></tr></table>";
    } else {
      if (move_uploaded_file($_FILES['archivos4']['tmp_name'], $micarpeta . $antiguo_nombre)) {

        $sql = "UPDATE idiomas_comp SET idioma_comp='" . $idiomas . "', nivel='" . $nivel . "',archivo='" . $antiguo_nombre . "' WHERE ididiomas_comp='" . $ididiomas . "' ";

        $result = mysqli_query($con, $sql);
        if ($result) {
          echo '<script> alert("Guardado exitosamente"); </script>';
          header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar"); </script>';
          header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
        }
      } else {
        echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
        header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
      }
    }
  } else {
    echo "No hay datos";
    $idiomas = $_POST['idioma_comp'];
    $nivel = $_POST['nivel4'];

    $sql = "UPDATE idiomas_comp SET idioma_comp='" . $idiomas . "', nivel='" . $nivel . "' WHERE ididiomas_comp='" . $ididiomas . "' ";

    $result = mysqli_query($con, $sql);
    if ($result) {
      echo '<script> alert("Guardado exitosamente"); </script>';
      header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
    } else {
      echo '<script> alert("Error al guardar"); </script>';
      header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
    }
  }
}
