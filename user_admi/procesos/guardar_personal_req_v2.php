<?php
// Insert the content of connection.php file
include_once('../conexion.php');

// Insert data into the database
if (isset($_POST['insert'])) {
  $idcon = $_POST['idconvocatoria'];
  $dni = $_POST['dni'];

  $cantidad = $_POST['cantidad'];
  $cargo = $_POST['cargo'];
  $remuneracion = $_POST['remuneracion'];
  $fuente_finac = $_POST['fuente_finac'];
  $meta = $_POST['meta'];
  $ubicacion = $_POST['chosen-unique'];

  $sql = "INSERT INTO personal_req (cantidad,remuneracion,fuente_finac,meta,cargo_idcargo,convocatoria_idcon,personal_req_idubicacion) 
      VALUES('" . $cantidad . "','" . $remuneracion . "','" . $fuente_finac . "','" . $meta . "','" . $cargo . "','" . $idcon . "','" . $ubicacion . "')";

  $result = mysqli_query($con, $sql);
  $rs = mysqli_query($con, "SELECT @@identity AS id");
  if ($row = mysqli_fetch_row($rs)) {
    $id_requerimiento = trim($row[0]);
  }
  echo $id_requerimiento;
  // $id_requerimiento = mysqli_insert_id($con);

  if ($result) {
    $reque_tipo_estudios = $_POST['formacion_requerida'];
    if ($reque_tipo_estudios == '1') {
      $colegiatura = $_POST['colegiatura'];
      $habilitaicon = $_POST['habilitacion'];
      $serums = $_POST['serums'];
      $tipo_experiencia = $_POST['tipo_experiencia'];
      $licencia_conducir = $_POST['licencia_conducir'];
      if ($tipo_experiencia = 'anios') {
        $cantidad_anios = $_POST['cantidad_anios'];
        $sql = "INSERT INTO requerimientos (reque_tipo_estudios,colegiatura,habilitacion,serums,tipo_experiencia,cantidad_experiencia,licencia_conducir,reque_id_personal) 
        VALUES('" . $reque_tipo_estudios . "','" . $colegiatura . "','" . $habilitaicon . "','" . $serums . "','" . $tipo_experiencia . "','" . $cantidad_anios . "','" . $licencia_conducir . "','" . $id_requerimiento . "')";
        $resultado = mysqli_query($con, $sql);
        if ($resultado) {
          echo "agregado con exito";
          header('Location: ../agregar_personal_req_v2.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
        } else {
          // echo "ERROR 1 ";
          echo '<script> alert("Error al guardar el requerimiento"); 
          window.history.back(-1);</script>';
        }
      } else {
        $cantidad_meses = $_POST['cantidad_meses'];
        $sql = "INSERT INTO requerimientos (reque_tipo_estudios,colegiatura,habilitacion,serums,tipo_experiencia,cantidad_experiencia,licencia_conducir,reque_id_personal) 
        VALUES('" . $reque_tipo_estudios . "','" . $colegiatura . "','" . $habilitaicon . "','" . $serums . "','" . $tipo_experiencia . "','" . $cantidad_meses . "','" . $licencia_conducir . "','" . $id_requerimiento . "')";
        $resultado = mysqli_query($con, $sql);
        if ($resultado) {
          echo "agregado con exito 1";
          header('Location: ../agregar_personal_req_v2.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
        } else {
          // echo "ERROR 1 . 2";
          echo '<script> alert("Error al guardar el requerimiento"); 
            window.history.back(-1);</script>';
        }
      }
    } elseif ($reque_tipo_estudios == '2') {
      $nivel_estudios_tec = $_POST['nivel_estudios_tec'];
      $colegiatura = $_POST['colegiatura'];
      $habilitaicon = $_POST['habilitacion'];
      $serums = $_POST['serums'];
      $tipo_experiencia = $_POST['tipo_experiencia'];
      $licencia_conducir = $_POST['licencia_conducir'];
      if ($tipo_experiencia == 'anios') {
        $cantidad_anios = $_POST['cantidad_anios'];
        $sql = "INSERT INTO requerimientos (reque_tipo_estudios,nivel_estudio,colegiatura,habilitacion,serums,tipo_experiencia,cantidad_experiencia,licencia_conducir,reque_id_personal) 
        VALUES('" . $reque_tipo_estudios . "','" . $nivel_estudios_tec . "','" . $colegiatura . "','" . $habilitaicon . "','" . $serums . "','" . $tipo_experiencia . "','" . $cantidad_anios . "','" . $licencia_conducir . "','" . $id_requerimiento . "')";
        $resultado = mysqli_query($con, $sql);
        if ($resultado) {
          echo "agregado con exito 2";
          header('Location: ../agregar_personal_req_v2.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
        } else {
          echo '<script> alert("Error al guardar el requerimiento"); 
          window.history.back(-1);</script>';
        }
      } else {
        $cantidad_meses = $_POST['cantidad_meses'];
        $sql = "INSERT INTO requerimientos (reque_tipo_estudios,nivel_estudio,colegiatura,habilitacion,serums,tipo_experiencia,cantidad_experiencia,licencia_conducir,reque_id_personal) 
        VALUES('" . $reque_tipo_estudios . "','" . $nivel_estudios_tec . "','" . $colegiatura . "','" . $habilitaicon . "','" . $serums . "','" . $tipo_experiencia . "','" . $cantidad_meses . "','" . $licencia_conducir . "','" . $id_requerimiento . "')";
        $resultado = mysqli_query($con, $sql);
        if ($resultado) {
          echo "ERROR 2";
          header('Location: ../agregar_personal_req_v2.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
        } else {
          echo '<script> alert("Error al guardar el requerimiento"); 
          window.history.back(-1);</script>';
        }
      }
    } elseif ($reque_tipo_estudios == '3') {
      $nivel_estudios_prof = $_POST['nivel_estudios_prof'];
      if ($nivel_estudios_prof = 'ESTUDIANTE') {
        $ciclo_actual = $_POST['ciclo_actual'];
        $colegiatura = $_POST['colegiatura'];
        $habilitaicon = $_POST['habilitacion'];
        $serums = $_POST['serums'];
        $tipo_experiencia = $_POST['tipo_experiencia'];
        $licencia_conducir = $_POST['licencia_conducir'];
        if ($tipo_experiencia = 'anios') {
          $cantidad_anios = $_POST['cantidad_anios'];
          $sql = "INSERT INTO requerimientos (reque_tipo_estudios,nivel_estudio,ciclo_actual,colegiatura,habilitacion,serums,tipo_experiencia,cantidad_experiencia,licencia_conducir,reque_id_personal) 
          VALUES('" . $reque_tipo_estudios . "','" . $nivel_estudios_prof . "','" . $ciclo_actual . "','" . $colegiatura . "','" . $habilitaicon . "','" . $serums . "','" . $tipo_experiencia . "','" . $cantidad_anios . "','" . $licencia_conducir . "','" . $id_requerimiento . "')";
          $resultado = mysqli_query($con, $sql);
          if ($resultado) {
            echo "ERROR 3";
            header('Location: ../agregar_personal_req_v2.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
          } else {
            echo '<script> alert("Error al guardar el requerimiento"); 
          window.history.back(-1);</script>';
          }
        } else {
          $cantidad_meses = $_POST['cantidad_meses'];
          $sql = "INSERT INTO requerimientos (reque_tipo_estudios,nivel_estudio,ciclo_actual,colegiatura,habilitacion,serums,tipo_experiencia,cantidad_experiencia,licencia_conducir,reque_id_personal) 
          VALUES('" . $reque_tipo_estudios . "','" . $nivel_estudios_prof . "','" . $ciclo_actual . "','" . $colegiatura . "','" . $habilitaicon . "','" . $serums . "','" . $tipo_experiencia . "','" . $cantidad_meses . "','" . $licencia_conducir . "','" . $id_requerimiento . "')";
          $resultado = mysqli_query($con, $sql);
          if ($resultado) {
            echo "ERROR 3";
            header('Location: ../agregar_personal_req_v2.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
          } else {
            echo '<script> alert("Error al guardar el requerimiento"); 
          window.history.back(-1);</script>';
          }
        }
      } else {
        $colegiatura = $_POST['colegiatura'];
        $habilitaicon = $_POST['habilitacion'];
        $serums = $_POST['serums'];
        $tipo_experiencia = $_POST['tipo_experiencia'];
        $licencia_conducir = $_POST['licencia_conducir'];
        if ($tipo_experiencia = 'anios') {
          $cantidad_anios = $_POST['cantidad_anios'];
          $sql = "INSERT INTO requerimientos (reque_tipo_estudios,nivel_estudio,,colegiatura,habilitacion,serums,tipo_experiencia,cantidad_experiencia,licencia_conducir,reque_id_personal) 
          VALUES('" . $reque_tipo_estudios . "','" . $nivel_estudios_prof . "','" . $colegiatura . "','" . $habilitaicon . "','" . $serums . "','" . $tipo_experiencia . "','" . $cantidad_anios . "','" . $licencia_conducir . "','" . $id_requerimiento . "')";
          $resultado = mysqli_query($con, $sql);
          if ($resultado) {
            echo "ERROR 3";
            header('Location: ../agregar_personal_req_v2.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
          } else {
            echo '<script> alert("Error al guardar el requerimiento"); 
          window.history.back(-1);</script>';
          }
        } else {
          $cantidad_meses = $_POST['cantidad_meses'];
          $sql = "INSERT INTO requerimientos (reque_tipo_estudios,nivel_estudio,colegiatura,habilitacion,serums,tipo_experiencia,cantidad_experiencia,licencia_conducir,reque_id_personal) 
          VALUES('" . $reque_tipo_estudios . "','" . $nivel_estudios_prof . "','" . $colegiatura . "','" . $habilitaicon . "','" . $serums . "','" . $tipo_experiencia . "','" . $cantidad_meses . "','" . $licencia_conducir . "','" . $id_requerimiento . "')";
          $resultado = mysqli_query($con, $sql);
          if ($resultado) {
            echo "ERROR 3";
            header('Location: ../agregar_personal_req_v2.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
          } else {
            echo '<script> alert("Error al guardar el requerimiento"); 
          window.history.back(-1);</script>';
          }
        }
      }
    }
  } else {
    // echo "error al guardar reque";
    echo '<script> alert("Error al guardar el personal requerido"); 
          window.history.back(-1);</script>';
  }
}
