
<?php
include '../conexion.php';
// Update data into the database
if (isset($_POST['updateData4'])) {
  $dato_desencriptado = $_POST['dato_desencriptado'];
  $id_4puntos = $_POST['id_4puntos'];
  $dni = $_POST['dni4'];
  $verificar_archivo = $_FILES["archivos4"];

  if ($_FILES['archivos4']['name'] != null) {
    $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/expe4_laboral/';
    //datos del arhivo
    $nombre_archivo = $_FILES['archivos4']['name'];
    $tipo_archivo = $_FILES['archivos4']['type'];
    $tamano_archivo = $_FILES['archivos4']['size'];

    $query = mysqli_query($con, "SELECT * FROM expe_4puntos WHERE id_4puntos = $id_4puntos");
    $row = mysqli_fetch_array($query);
    $antiguo_nombre = $row['archivos'];
    //BORRAR ARCHIVO
    unlink($micarpeta . $antiguo_nombre);
    //ACTUALIZAR NOMBRE
    $nombre_archivo = "new_" . $id_4puntos . ".pdf";

    $lugar = $_POST['lugar4'];
    $cargo = $_POST['cargo4'];
    $fech_inicio = $_POST['fecha_inicio4'];
    $fech_fin = $_POST['fecha_fin4'];

    /// VALORES AÑOS, MESES Y DIAS ///
    $fechainicial = new DateTime($fech_inicio);
    $fechaactual = new DateTime($fech_fin);
    $diferencia = $fechainicial->diff($fechaactual);
    $años = $diferencia->format('%Y');
    $meses = $diferencia->format('%m');
    $dias = $diferencia->format('%d');

    //compruebo si las características del archivo son las que deseo
    if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
      echo '<script> alert("Sobre pasa la capacidad máxima de 3 MB.");
        history.go(-1);</script>';
    } else {
      if (move_uploaded_file($_FILES['archivos4']['tmp_name'], $micarpeta . $nombre_archivo)) {

        $sql = "UPDATE expe_4puntos SET 
        lugar='" . $lugar . "', cargo='" . $cargo . "',fecha_inicio='" . $fech_inicio . "', fecha_fin='" . $fech_fin . "', anios='" . $años . "', meses='" . $meses . "', dias='" . $dias . "', archivos='" . $nombre_archivo . "' WHERE id_4puntos='" . $id_4puntos . "'";
        $result = mysqli_query($con, $sql);
        if ($result) {
          unlink($antiguo_nombre);
          echo '<script> alert("Guardado exitosamente"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
          // header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
        }
      } else {
        echo '<script> alert("Error al guardar el archivo."); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      }
    }
  } else {
    echo "No hay datos";
    $lugar = $_POST['lugar4'];
    $cargo = $_POST['cargo4'];
    $fech_inicio = $_POST['fecha_inicio4'];
    $fech_fin = $_POST['fecha_fin4'];

    /// VALORES AÑOS, MESES Y DIAS ///
    $fechainicial = new DateTime($fech_inicio);
    $fechaactual = new DateTime($fech_fin);
    $diferencia = $fechainicial->diff($fechaactual);
    $años = $diferencia->format('%Y');
    $meses = $diferencia->format('%m');
    $dias = $diferencia->format('%d');

    $sql = "UPDATE expe_4puntos SET 
    lugar='" . $lugar . "', cargo='" . $cargo . "',fecha_inicio='" . $fech_inicio . "', fecha_fin='" . $fech_fin . "', anios='" . $años . "', meses='" . $meses . "', dias='" . $dias . "' WHERE id_4puntos='" . $id_4puntos . "'";

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
} elseif (isset($_POST['updateData3'])) {
  $dato_desencriptado = $_POST['dato_desencriptado'];
  $id_3puntos = $_POST['id_3puntos'];
  $dni = $_POST['dni3'];
  $verificar_archivo = $_FILES["archivos3"];

  if ($_FILES['archivos3']['name'] != null) {
    echo "Tiene datos La variable";
    $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/expe3_laboral/';
    //datos del arhivo
    $nombre_archivo = $_FILES['archivos4']['name'];
    $tipo_archivo = $_FILES['archivos4']['type'];
    $tamano_archivo = $_FILES['archivos4']['size'];

    $query = mysqli_query($con, "SELECT * FROM expe_3puntos WHERE id_3puntos = $id_3puntos");
    $row = mysqli_fetch_array($query);
    $antiguo_nombre = $row['archivos'];
    //BORRAR ARCHIVO
    unlink($micarpeta . $antiguo_nombre);
    //ACTUALIZAR NOMBRE
    $nombre_archivo = "new_" . $id_3puntos . ".pdf";

    $lugar = $_POST['lugar3'];
    $cargo = $_POST['cargo3'];
    $fech_inicio = $_POST['fecha_inicio3'];
    $fech_fin = $_POST['fecha_fin3'];

    /// VALORES AÑOS, MESES Y DIAS ///
    $fechainicial = new DateTime($fech_inicio);
    $fechaactual = new DateTime($fech_fin);
    $diferencia = $fechainicial->diff($fechaactual);
    $años = $diferencia->format('%Y');
    $meses = $diferencia->format('%m');
    $dias = $diferencia->format('%d');

    //compruebo si las características del archivo son las que deseo
    if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
      echo '<script> alert("Sobre pasa la capacidad máxima de 3 MB.");
            history.go(-1);</script>';
    } else {
      if (move_uploaded_file($_FILES['archivos3']['tmp_name'], $micarpeta . $antiguo_nombre)) {
        $sql = "UPDATE expe_3puntos SET 
        lugar='" . $lugar . "', cargo='" . $cargo . "',fecha_inicio='" . $fech_inicio . "', fecha_fin='" . $fech_fin . "', anios='" . $años . "', meses='" . $meses . "', dias='" . $dias . "', archivos='" . $antiguo_nombre . "'
        WHERE id_3puntos='" . $id_3puntos . "'";
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
        echo '<script> alert("Error al guardar el archivo."); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      }
    }
  } else {
    echo "No hay datos";
    $lugar = $_POST['lugar3'];
    $cargo = $_POST['cargo3'];
    $fech_inicio = $_POST['fecha_inicio3'];
    $fech_fin = $_POST['fecha_fin3'];

    /// VALORES AÑOS, MESES Y DIAS ///
    $fechainicial = new DateTime($fech_inicio);
    $fechaactual = new DateTime($fech_fin);
    $diferencia = $fechainicial->diff($fechaactual);
    $años = $diferencia->format('%Y');
    $meses = $diferencia->format('%m');
    $dias = $diferencia->format('%d');

    $sql = "UPDATE expe_3puntos SET 
    lugar='" . $lugar . "', cargo='" . $cargo . "',fecha_inicio='" . $fech_inicio . "', fecha_fin='" . $fech_fin . "', anios='" . $años . "', meses='" . $meses . "', dias='" . $dias . "' WHERE id_3puntos='" . $id_3puntos . "'";

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
} elseif (isset($_POST['updateData1'])) {
  $dato_desencriptado = $_POST['dato_desencriptado'];
  $id_1puntos = $_POST['id_1puntos'];
  $dni = $_POST['dni1'];
  $verificar_archivo = $_FILES["archivos1"];

  if ($_FILES['archivos1']['name'] != null) {
    echo "Tiene datos La variable";
    $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/expe1_laboral/';
    //datos del arhivo
    $nombre_archivo = $_FILES['archivos1']['name'];
    $tipo_archivo = $_FILES['archivos1']['type'];
    $tamano_archivo = $_FILES['archivos1']['size'];

    $query = mysqli_query($con, "SELECT * FROM expe_1puntos WHERE id_1puntos = $id_1puntos");
    $row = mysqli_fetch_array($query);
    $antiguo_nombre = $row['archivos'];
    //BORRAR ARCHIVO
    unlink($micarpeta . $antiguo_nombre);
    //ACTUALIZAR NOMBRE
    $nombre_archivo = "new_" . $id_1puntos . ".pdf";

    $lugar = $_POST['lugar1'];
    $cargo = $_POST['cargo1'];
    $fech_inicio = $_POST['fecha_inicio1'];
    $fech_fin = $_POST['fecha_fin1'];

    /// VALORES AÑOS, MESES Y DIAS ///
    $fechainicial = new DateTime($fech_inicio);
    $fechaactual = new DateTime($fech_fin);
    $diferencia = $fechainicial->diff($fechaactual);
    $años = $diferencia->format('%Y');
    $meses = $diferencia->format('%m');
    $dias = $diferencia->format('%d');

    //compruebo si las características del archivo son las que deseo
    if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
      echo '<script> alert("Sobre pasa la capacidad máxima de 3 MB.");
            history.go(-1);</script>';
    } else {
      if (move_uploaded_file($_FILES['archivos1']['tmp_name'], $micarpeta . $antiguo_nombre)) {
        $sql = "UPDATE expe_1puntos SET 
        lugar='" . $lugar . "', cargo='" . $cargo . "',fecha_inicio='" . $fech_inicio . "', fecha_fin='" . $fech_fin . "', anios='" . $años . "', meses='" . $meses . "', dias='" . $dias . "', archivos='" . $antiguo_nombre . "'
        WHERE id_1puntos='" . $id_1puntos . "'";
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
        echo '<script> alert("Error al guardar el archivo."); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      }
    }
  } else {
    echo "No hay datos";
    $lugar = $_POST['lugar1'];
    $cargo = $_POST['cargo1'];
    $fech_inicio = $_POST['fecha_inicio1'];
    $fech_fin = $_POST['fecha_fin1'];

    /// VALORES AÑOS, MESES Y DIAS ///
    $fechainicial = new DateTime($fech_inicio);
    $fechaactual = new DateTime($fech_fin);
    $diferencia = $fechainicial->diff($fechaactual);
    $años = $diferencia->format('%Y');
    $meses = $diferencia->format('%m');
    $dias = $diferencia->format('%d');

    $sql = "UPDATE expe_1puntos SET 
    lugar='" . $lugar . "', cargo='" . $cargo . "',fecha_inicio='" . $fech_inicio . "', fecha_fin='" . $fech_fin . "', anios='" . $años . "', meses='" . $meses . "', dias='" . $dias . "' WHERE id_1puntos='" . $id_1puntos . "'";

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
} elseif (isset($_POST['updateData5'])) {
  $dato_desencriptado = $_POST['dato_desencriptado'];
  $id_4puntos = $_POST['edit_id_4puntos_tipo2'];
  $dni = $_POST['dni4_tipo2'];
  $verificar_archivo = $_FILES["archivos4_tipo2"];

  if ($_FILES['archivos4_tipo2']['name'] != null) {
    $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/expe4_laboral/';
    //datos del arhivo
    $nombre_archivo = $_FILES['archivos4_tipo2']['name'];
    $tipo_archivo = $_FILES['archivos4_tipo2']['type'];
    $tamano_archivo = $_FILES['archivos4_tipo2']['size'];

    $query = mysqli_query($con, "SELECT * FROM expe_4puntos WHERE id_4puntos = $id_4puntos");
    $row = mysqli_fetch_array($query);
    $antiguo_nombre = $row['archivos'];
    //BORRAR ARCHIVO
    unlink($micarpeta . $antiguo_nombre);
    //ACTUALIZAR NOMBRE
    $nombre_archivo = "new_" . $id_4puntos . ".pdf";

    $lugar = $_POST['lugar4_tipo2'];
    $cargo = $_POST['cargo4_tipo2'];
    $fech_inicio = $_POST['fecha_inicio4_tipo2'];
    $fech_fin = $_POST['fecha_fin4_tipo2'];

    /// VALORES AÑOS, MESES Y DIAS ///
    $fechainicial = new DateTime($fech_inicio);
    $fechaactual = new DateTime($fech_fin);
    $diferencia = $fechainicial->diff($fechaactual);
    $años = $diferencia->format('%Y');
    $meses = $diferencia->format('%m');
    $dias = $diferencia->format('%d');

    //compruebo si las características del archivo son las que deseo
    if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
      echo '<script> alert("Sobre pasa la capacidad máxima de 3 MB.");
            history.go(-1);</script>';
    } else {
      if (move_uploaded_file($_FILES['archivos4_tipo2']['tmp_name'], $micarpeta . $nombre_archivo)) {

        $sql = "UPDATE expe_4puntos SET 
        lugar='" . $lugar . "', cargo='" . $cargo . "',fecha_inicio='" . $fech_inicio . "', fecha_fin='" . $fech_fin . "', anios='" . $años . "', meses='" . $meses . "', dias='" . $dias . "', archivos='" . $nombre_archivo . "'
        WHERE id_4puntos='" . $id_4puntos . "'";
        $result = mysqli_query($con, $sql);
        if ($result) {
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
        } else {
          echo '<script> alert("Error al guardar"); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
        }
      } else {
        echo '<script> alert("Error al guardar el archivo."); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      }
    }
  } else {
    $lugar = $_POST['lugar4_tipo2'];
    $cargo = $_POST['cargo4_tipo2'];
    $fech_inicio = $_POST['fecha_inicio4_tipo2'];
    $fech_fin = $_POST['fecha_fin4_tipo2'];

    /// VALORES AÑOS, MESES Y DIAS ///
    $fechainicial = new DateTime($fech_inicio);
    $fechaactual = new DateTime($fech_fin);
    $diferencia = $fechainicial->diff($fechaactual);
    $años = $diferencia->format('%Y');
    $meses = $diferencia->format('%m');
    $dias = $diferencia->format('%d');

    $sql = "UPDATE expe_4puntos SET 
    lugar='" . $lugar . "', cargo='" . $cargo . "',fecha_inicio='" . $fech_inicio . "', fecha_fin='" . $fech_fin . "', anios='" . $años . "', meses='" . $meses . "', dias='" . $dias . "' WHERE id_4puntos='" . $id_4puntos . "'";

    $result = mysqli_query($con, $sql);
    if ($result) {
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
    } else {
      echo '<script> alert("Error al guardar"); </script>';
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
    }
  }
}
