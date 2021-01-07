
<?php
include '../conexion.php';
// Update data into the database
if (isset($_POST['updateData4'])) {
  $dato_desencriptado = $_POST['dato_desencriptado'];
  $id_4puntos = $_POST['id_4puntos'];
  $dni = $_POST['dni_update'];
  $verificar_archivo = $_FILES["archivos4"];
  $udpate_tipo_comprobante = $_POST['udpate_tipo_comprobante'];
  $udpate_nro_contrato = $_POST['udpate_nro_contrato'];
  $udpate_fecha_boleta = $_POST['udpate_fecha_boleta'];
  $udpate_boleta = $_POST['udpate_boleta'];

  $udpate_tipo_comprobante = $_POST['udpate_tipo_comprobante'];

  if ($_FILES['archivos4']['name'] != null) {
    $micarpeta = '../archivos/' . $dni . '/expe_laboral/';
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

    $update_lugar_gene = $_POST['update_lugar_gene'];
    $update_lugar_espec = strtoupper($_POST['update_lugar_espec']);
    $cargo = strtoupper($_POST['udpate_cargo']);
    $fech_inicio = $_POST['udpate_fecha_inicio'];
    $fech_fin = $_POST['udpate_fecha_fin'];

    /// VALORES AÑOS, MESES Y DIAS ///
    $fechainicial = new DateTime($fech_inicio);
    $fechaactual = new DateTime($fech_fin);
    $diferencia = $fechainicial->diff($fechaactual);
    $años = $diferencia->format('%Y');
    $meses = $diferencia->format('%m');
    $dias = $diferencia->format('%d');
    $dias = $dias + 1;
    //compruebo si las características del archivo son las que deseo
    if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
        echo '<script> alert("El archivo sobre pasa los 3MB permitidos o no es de extensión PDF."); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
    } else {
      if (move_uploaded_file($_FILES['archivos4']['tmp_name'], $micarpeta . $nombre_archivo)) {
        if ($udpate_tipo_comprobante = 'Contrato') {
          $sql = "UPDATE expe_4puntos SET lugar_trab_general='" . $update_lugar_gene . "',lugar_especifico='" . $update_lugar_espec . "', cargo='" . $cargo . "',fecha_inicio='" . $fech_inicio . "', fecha_fin='" . $fech_fin . "', anios='" . $años . "', meses='" . $meses . "', dias='" . $dias . "',archivos='" . $nombre_archivo . "',tipo_comprobante='" . $udpate_tipo_comprobante . "',nro_contrato='" . $udpate_nro_contrato . "' WHERE id_4puntos='" . $id_4puntos . "'";

          $result = mysqli_query($con, $sql);
          if ($result) {
            echo "<script type=\"text/javascript\">history.go(-1);</script>";
          } else {
            echo "<script type=\"text/javascript\">history.go(-1);</script>";
            header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
          }
        } else {
          $sql = "UPDATE expe_4puntos SET lugar_trab_general='" . $update_lugar_gene . "',lugar_especifico='" . $update_lugar_espec . "', cargo='" . $cargo . "',fecha_inicio='" . $fech_inicio . "', fecha_fin='" . $fech_fin . "', anios='" . $años . "', meses='" . $meses . "', dias='" . $dias . "',archivos='" . $nombre_archivo . "', tipo_comprobante='" . $udpate_tipo_comprobante . "', fech_emision='" . $udpate_fecha_boleta . "',monto_boleta='" . $udpate_boleta . "' WHERE id_4puntos='" . $id_4puntos . "'";

          $result = mysqli_query($con, $sql);
          if ($result) {
            echo "<script type=\"text/javascript\">history.go(-1);</script>";
          } else {
            echo '<script> alert("Error al guardar"); </script>';
            echo "<script type=\"text/javascript\">history.go(-1);</script>";
          }
        }
      } else {
        echo '<script> alert("Error al guardar el archivo."); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      }
    }
  } else {
    $update_lugar_gene = $_POST['update_lugar_gene'];
    $update_lugar_espec = strtoupper($_POST['update_lugar_espec']);
    $cargo = strtoupper($_POST['udpate_cargo']);
    $fech_inicio = $_POST['udpate_fecha_inicio'];
    $fech_fin = $_POST['udpate_fecha_fin'];

    /// VALORES AÑOS, MESES Y DIAS ///
    $fechainicial = new DateTime($fech_inicio);
    $fechaactual = new DateTime($fech_fin);
    $diferencia = $fechainicial->diff($fechaactual);
    $años = $diferencia->format('%Y');
    $meses = $diferencia->format('%m');
    $dias = $diferencia->format('%d');
    if ($udpate_tipo_comprobante = 'Contrato') {
      $sql = "UPDATE expe_4puntos SET lugar_trab_general='" . $update_lugar_gene . "',lugar_especifico='" . $update_lugar_espec . "', cargo='" . $cargo . "',fecha_inicio='" . $fech_inicio . "', fecha_fin='" . $fech_fin . "', anios='" . $años . "', meses='" . $meses . "', dias='" . $dias . "',tipo_comprobante='" . $udpate_tipo_comprobante . "',nro_contrato='" . $udpate_nro_contrato . "' WHERE id_4puntos='" . $id_4puntos . "'";

      $result = mysqli_query($con, $sql);
      if ($result) {
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      } else {
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
        header('Location: ../exp_laboral.php?dni=' . $dato_desencriptado);
      }
    } else {
      $sql = "UPDATE expe_4puntos SET lugar_trab_general='" . $update_lugar_gene . "',lugar_especifico='" . $update_lugar_espec . "', cargo='" . $cargo . "',fecha_inicio='" . $fech_inicio . "', fecha_fin='" . $fech_fin . "', anios='" . $años . "', meses='" . $meses . "', dias='" . $dias . "',tipo_comprobante='" . $udpate_tipo_comprobante . "', fech_emision='" . $udpate_fecha_boleta . "',monto_boleta='" . $udpate_boleta . "' WHERE id_4puntos='" . $id_4puntos . "'";

      $result = mysqli_query($con, $sql);
      if ($result) {
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      } else {
        echo '<script> alert("Error al guardar"); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      }
    }
  }
} else {
  echo "Error al ingresar al update.";
}
