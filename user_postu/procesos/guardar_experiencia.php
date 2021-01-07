<?php
// Insert the content of connection.php file
include('../conexion.php');
// Insert data into the database
if (isset($_POST['insertData4'])) {
  $dato_desencriptado = $_POST['dni_encriptado4'];
  $dni = $_POST['dni4'];
  $idpostulante = $_POST['postulante4'];
  $tipo_comprobante = $_POST['tipo_comprobante_exp4_tip1'];
  $tipo_constancia_exp4_tip1 = $_POST['tipo_constancia_exp4_tip1'];
  
  $nombre_lugar_gene = intval($_POST['nombre_lugar_gene']);
  $nombre_lugar_espec = strtoupper($_POST['nombre_lugar_espec']);
  $cargo_funciones_4exp = strtoupper($_POST['cargo_funciones_4exp']);
  $fecha_ini_4exp = $_POST['fecha_ini_4exp'];
  $fecha_fin_4exp = $_POST['fecha_fin_4exp'];
  $expe_validacion = 'VALIDO';

  $micarpeta = '../archivos/' . $dni . '/expe_laboral/';
  if (!file_exists($micarpeta)) {
    mkdir($micarpeta, 0777, true);
  }
  //datos del arhivo
  $nombre_archivo = $_FILES['archivo']['name'];
  $tipo_archivo = $_FILES['archivo']['type'];
  $tamano_archivo = $_FILES['archivo']['size'];

  $query = mysqli_query($con, "SELECT MAX(id_4puntos) AS id FROM expe_4puntos WHERE expe_puntos_idpostulante = '$idpostulante'");
  if ($row = mysqli_fetch_row($query)) {
    $id = trim($row[0]);
  }
  $result = mysqli_num_rows($query);
  if ($result <= 0) {
    $i = 1;
    $new_nombre = "exp_tip_" . $i . ".pdf";
  } else {
    $i = $id + 1;
    $new_nombre = "exp_tip_" . $i . ".pdf";
  }

  /// VALORES AÑOS, MESES Y DIAS ///
  $fechainicial = new DateTime($fecha_ini_4exp);
  $fechaactual = new DateTime($fecha_fin_4exp);
  $diferencia = $fechainicial->diff($fechaactual);
  $años = $diferencia->format('%Y');
  $meses = $diferencia->format('%m');
  $dias = $diferencia->format('%d');
  $dias = $dias + 1;
  //compruebo si las características del archivo son las que deseo
  if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
    echo '<script> alert("El archivo excede los 3 MB máximos permitidos."); </script>';
    echo "<script type=\"text/javascript\">history.go(-1);</script>";
  } else {
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $micarpeta . $new_nombre)) {
      if ($tipo_comprobante == 'Contrato') {
        $nro_contrato = $_POST['nro_contrato'];
        $sql = "INSERT INTO expe_4puntos (lugar_trab_general,lugar_especifico,cargo,fecha_inicio,fecha_fin,anios,meses,dias,archivos,expe_puntos_idpostulante, 
        tipo_comprobante,nro_contrato,expe_validacion) 
          VALUES('$nombre_lugar_gene','$nombre_lugar_espec','$cargo_funciones_4exp', '$fecha_ini_4exp','$fecha_fin_4exp','$años','$meses','$dias','$new_nombre',
          '$idpostulante','$tipo_comprobante','$nro_contrato','$expe_validacion')";
        $result = mysqli_query($con, $sql);
        if ($result) {
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
        } else {
          echo '<script> alert("Error al agregar experiencia."); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
        }
      } elseif ($tipo_comprobante == 'Constancia/Certificado') {
        $fech_emision = $_POST['fecha_boleta'];
        $monto_boleta = $_POST['boleta'];
        $sql = "INSERT INTO expe_4puntos (lugar_trab_general,lugar_especifico,cargo,fecha_inicio,fecha_fin,anios,meses,dias,archivos,expe_puntos_idpostulante, 
        tipo_comprobante,fech_emision,monto_boleta,expe_validacion) 
          VALUES('$nombre_lugar_gene','$nombre_lugar_espec','$cargo_funciones_4exp', '$fecha_ini_4exp','$fecha_fin_4exp','$años','$meses','$dias','$new_nombre',
          '$idpostulante','$tipo_comprobante','$fech_emision','$monto_boleta','$expe_validacion')";
        $result = mysqli_query($con, $sql);
        if ($result) {
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
        } else {
          // echo "Error al agregar experiencia";
          echo '<script> alert("Error al agregar experiencia."); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
        }
      } else {
        $sql = "INSERT INTO expe_4puntos (lugar_trab_general,lugar_especifico,cargo,fecha_inicio,fecha_fin,anios,meses,dias,archivos,expe_puntos_idpostulante, 
        tipo_comprobante,tipo_constancia,fech_emision,monto_boleta,expe_validacion) 
          VALUES('$nombre_lugar_gene','$nombre_lugar_espec','$cargo_funciones_4exp', '$fecha_ini_4exp','$fecha_fin_4exp','$años','$meses','$dias','$new_nombre',
          '$idpostulante','$tipo_comprobante','$fech_emision','$monto_boleta','$expe_validacion')";
        $result = mysqli_query($con, $sql);
        if ($result) {
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
        } else {
          // echo "Error al agregar experiencia";
          echo '<script> alert("Error al agregar experiencia."); </script>';
          echo "<script type=\"text/javascript\">history.go(-1);</script>";
        } 
      }
    } else {
      // echo "Error al agregar archivo";
      echo '<script> alert("Error al guardar el archivo."); </script>';
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
    }
  }
} else {
  // echo "Error al agregar ingresar al sistema.";
  echo '<script> alert("Error al guardar."); </script>';
  echo "<script type=\"text/javascript\">history.go(-1);</script>";
}
