
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
    $fecha_ini_4exp = $_POST['udpate_fecha_inicio'];
    $fecha_fin_4exp = $_POST['udpate_fecha_fin'];

    /// VALORES ENTEROS ///
    $fechaentero_1 = strtotime($fecha_ini_4exp);
    $fechaentero_2 = strtotime($fecha_fin_4exp);
    // MES
    $mes_ini = date("m", $fechaentero_1);
    $mes_fin = date("m", $fechaentero_2);
    //DIA
    $dia_ini = date("d", $fechaentero_1);
    $dia_fin = date("d", $fechaentero_2);
    // echo $dia_ini . '<br>';
    // echo $dia_fin . '<br>';
    $code = 0;
    if ($mes_ini == 2 and $mes_fin == 2) {
      // $dia_ini = date("d", $fechaentero_1);
      $dia_fin = date("d", $fechaentero_2);
      if ($dia_fin == 28) {
        $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp . "+ 4 days"));
      } elseif ($dia_fin == 29) {
        $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 3 days"));
      }
    } elseif ($mes_ini == 2) {
      $dia_fin = date("d", $fechaentero_2);
      if ($dia_fin == 30) {
        $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp . "+ 2 days"));
      } elseif ($dia_fin == 31) {
        $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 1 days"));
      } else {
        $new_fechafin = $fecha_fin_4exp;
        $code = 1;
      }
    } elseif ($mes_ini == 1) {
      $dia_fin = date("d", $fechaentero_2);
      if ($dia_fin == 30) {
        $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp . "+ 2 days"));
      } elseif ($dia_fin == 31) {
        $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 1 days"));
      } else {
        $new_fechafin = $fecha_fin_4exp;
        $code = 1;
      }
    } elseif (($mes_ini == 4 or $mes_ini == 6 or $mes_ini == 9 or $mes_ini == 1) and $dia_fin == 31) {
      $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 1 days"));
    } elseif (($mes_ini == 1  or $mes_ini == 5 or $mes_ini == 7 or $mes_ini == 8 or $mes_ini == 10 or $mes_ini == 12) and   $dia_fin == 31) {
      $new_fechafin = $fecha_fin_4exp;
    } elseif ($mes_ini == 3 and $dia_fin == 31) {
      $new_fechafin = $fecha_fin_4exp;
      $code = 2;
    } elseif ($dia_ini == 31 and $dia_fin == 30) {
      $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 1 days"));
    } elseif (($mes_ini == 4 or $mes_ini == 6 or $mes_ini == 9 or $mes_ini == 1) and $dia_fin == 30) {
      $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 2 days"));
    } else {
      $code = 1;
      $new_fechafin = $fecha_fin_4exp;
    }

    $fechainicial = new DateTime($fecha_ini_4exp);
    $fechaactual = new DateTime($new_fechafin);
    $diferencia = $fechainicial->diff($fechaactual);
    $anios = $diferencia->format('%Y');
    $meses = $diferencia->format('%m');
    if ($code == 1) {
      $dias = $diferencia->format('%d');
      $dias = $dias + 1;
    } elseif ($code == 2) {
      $dias = $diferencia->format('%d');
      $dias = $dias - 1;
    } else {
      $dias = $diferencia->format('%d');
    }
    //compruebo si las características del archivo son las que deseo
    if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
      echo '<script> alert("El archivo sobre pasa los 3MB permitidos o no es de extensión PDF."); </script>';
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
    } else {
      if (move_uploaded_file($_FILES['archivos4']['tmp_name'], $micarpeta . $nombre_archivo)) {
        if ($udpate_tipo_comprobante = 'Contrato') {
          $sql = "UPDATE expe_4puntos SET lugar_trab_general='" . $update_lugar_gene . "',lugar_especifico='" . $update_lugar_espec . "', cargo='" . $cargo . "',fecha_inicio='" . $fecha_ini_4exp . "', fecha_fin='" . $fecha_fin_4exp . "', anios='" . $anios . "', meses='" . $meses . "', dias='" . $dias . "',archivos='" . $nombre_archivo . "',tipo_comprobante='" . $udpate_tipo_comprobante . "',nro_contrato='" . $udpate_nro_contrato . "' WHERE id_4puntos='" . $id_4puntos . "'";

          $result = mysqli_query($con, $sql);
          if ($result) {
            echo "<script type=\"text/javascript\">history.go(-1);</script>";
          } else {
            echo '<script> alert("Error al guardar"); </script>';
            echo "<script type=\"text/javascript\">history.go(-1);</script>";
          }
        } else {
          $sql = "UPDATE expe_4puntos SET lugar_trab_general='" . $update_lugar_gene . "',lugar_especifico='" . $update_lugar_espec . "', cargo='" . $cargo . "',fecha_inicio='" . $fecha_ini_4exp . "', fecha_fin='" . $fecha_fin_4exp . "', anios='" . $anios . "', meses='" . $meses . "', dias='" . $dias . "',archivos='" . $nombre_archivo . "', tipo_comprobante='" . $udpate_tipo_comprobante . "', fech_emision='" . $udpate_fecha_boleta . "',monto_boleta='" . $udpate_boleta . "' WHERE id_4puntos='" . $id_4puntos . "'";

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
    $fecha_ini_4exp = $_POST['udpate_fecha_inicio'];
    $fecha_fin_4exp = $_POST['udpate_fecha_fin'];

    /// VALORES ENTEROS ///
    $fechaentero_1 = strtotime($fecha_ini_4exp);
    $fechaentero_2 = strtotime($fecha_fin_4exp);
    // MES
    $mes_ini = date("m", $fechaentero_1);
    $mes_fin = date("m", $fechaentero_2);
    //DIA
    $dia_ini = date("d", $fechaentero_1);
    $dia_fin = date("d", $fechaentero_2);
    // echo $dia_ini . '<br>';
    // echo $dia_fin . '<br>';
    $code = 0;
    if ($mes_ini == 2 and $mes_fin == 2) {
      // $dia_ini = date("d", $fechaentero_1);
      $dia_fin = date("d", $fechaentero_2);
      if ($dia_fin == 28) {
        $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp . "+ 4 days"));
      } elseif ($dia_fin == 29) {
        $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 3 days"));
      }
    } elseif ($mes_ini == 2) {
      $dia_fin = date("d", $fechaentero_2);
      if ($dia_fin == 30) {
        $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp . "+ 2 days"));
      } elseif ($dia_fin == 31) {
        $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 1 days"));
      } else {
        $new_fechafin = $fecha_fin_4exp;
        $code = 1;
      }
    } elseif ($mes_ini == 1) {
      $dia_fin = date("d", $fechaentero_2);
      if ($dia_fin == 30) {
        $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp . "+ 2 days"));
      } elseif ($dia_fin == 31) {
        $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 1 days"));
      } else {
        $new_fechafin = $fecha_fin_4exp;
        $code = 1;
      }
    } elseif (($mes_ini == 4 or $mes_ini == 6 or $mes_ini == 9 or $mes_ini == 11) and $dia_fin == 31) {
      $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 1 days"));
    } elseif (($mes_ini == 1  or $mes_ini == 5 or $mes_ini == 7 or $mes_ini == 8 or $mes_ini == 10 or $mes_ini == 12) and   $dia_fin == 31) {
      $new_fechafin = $fecha_fin_4exp;
    } elseif ($mes_ini == 3 and $dia_fin == 31) {
      $new_fechafin = $fecha_fin_4exp;
      $code = 2;
    } elseif ($dia_ini == 31 and $dia_fin == 30) {
      $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 1 days"));
    } elseif (($mes_ini == 4 or $mes_ini == 6 or $mes_ini == 9 or $mes_ini == 1) and $dia_fin == 30) {
      $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 2 days"));
    } else {
      $code = 1;
      $new_fechafin = $fecha_fin_4exp;
    }

    $fechainicial = new DateTime($fecha_ini_4exp);
    $fechaactual = new DateTime($new_fechafin);
    $diferencia = $fechainicial->diff($fechaactual);
    $anios = $diferencia->format('%Y');
    $meses = $diferencia->format('%m');
    if ($code == 1) {
      $dias = $diferencia->format('%d');
      $dias = $dias + 1;
    } elseif ($code == 2) {
      $dias = $diferencia->format('%d');
      $dias = $dias - 1;
    } else {
      $dias = $diferencia->format('%d');
    }

    if ($udpate_tipo_comprobante = 'Contrato') {
      $sql = "UPDATE expe_4puntos SET lugar_trab_general='" . $update_lugar_gene . "',lugar_especifico='" . $update_lugar_espec . "', cargo='" . $cargo . "',fecha_inicio='" . $fecha_ini_4exp . "', fecha_fin='" . $fecha_fin_4exp . "', anios='" . $anios . "', meses='" . $meses . "', dias='" . $dias . "',tipo_comprobante='" . $udpate_tipo_comprobante . "',nro_contrato='" . $udpate_nro_contrato . "' WHERE id_4puntos='" . $id_4puntos . "'";

      $result = mysqli_query($con, $sql);
      if ($result) {
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      } else {
        echo '<script> alert("Error al guardar"); </script>';
        echo "<script type=\"text/javascript\">history.go(-1);</script>";
      }
    } else {
      $sql = "UPDATE expe_4puntos SET lugar_trab_general='" . $update_lugar_gene . "',lugar_especifico='" . $update_lugar_espec . "', cargo='" . $cargo . "',fecha_inicio='" . $fecha_ini_4exp . "', fecha_fin='" . $fecha_fin_4exp . "', anios='" . $anios . "', meses='" . $meses . "', dias='" . $dias . "',tipo_comprobante='" . $udpate_tipo_comprobante . "', fech_emision='" . $udpate_fecha_boleta . "',monto_boleta='" . $udpate_boleta . "' WHERE id_4puntos='" . $id_4puntos . "'";

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
  echo '<script> alert("Error al ingresar el bucle."); </script>';
  echo "<script type=\"text/javascript\">history.go(-1);</script>";
}
