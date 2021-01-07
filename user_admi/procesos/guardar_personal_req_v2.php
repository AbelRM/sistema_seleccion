<?php
// Insert the content of connection.php file
include_once('../conexion.php');

$dni = $_POST['dni'];
// Insert data into the database
if (isset($_POST['agregar_personal'])) {
  $idcon = $_POST['idconvocatoria'];
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
    $idpersonal = trim($row[0]);
  }

  if ($result) {
    $reque_tipo_estudios = $_POST['formacion_requerida'];
    $nivel_estudios = $_POST['nivel_estudios'];
    $ciclo_actual = $_POST['ciclo_actual'];
    $colegiatura = $_POST['colegiatura'];
    $habilitaicon = $_POST['habilitacion'];
    $serums = $_POST['serums'];

    $reque_tipo_estudios_max = $_POST['formacion_requerida_max'];
    $nivel_estudios_max = $_POST['nivel_estudios_max'];
    $ciclo_actual_max = $_POST['ciclo_actual_max'];
    $colegiatura_max = $_POST['colegiatura_max'];
    $habilitacion_max = $_POST['habilitacion_max'];
    $serums_max = $_POST['serums_max'];

    $tipo_experiencia = $_POST['tipo_experiencia'];
    $cantidad_experiencia = $_POST['cantidad_experiencia'];
    $licencia_conducir = $_POST['licencia_conducir'];

    $sql = "INSERT INTO requerimientos (reque_tipo_estudios,nivel_estudio,ciclo_actual,colegiatura,habilitacion,serums,tipo_experiencia,cantidad_experiencia,licencia_conducir,reque_id_personal,reque_tipo_estudios_max,nivel_estudio_max,ciclo_actual_max,colegiatura_max,habilitacion_max,serums_max) 
        VALUES('" . $reque_tipo_estudios . "','" . $nivel_estudios . "','" . $ciclo_actual . "','" . $colegiatura . "','" . $habilitaicon . "','" . $serums . "','" . $tipo_experiencia . "','" . $cantidad_experiencia . "','" . $licencia_conducir . "','" . $idpersonal . "','" . $reque_tipo_estudios_max . "','" . $nivel_estudios_max . "','" . $ciclo_actual_max . "','" . $colegiatura_max . "','" . $habilitacion_max . "','" . $serums_max . "')";
    $resultado = mysqli_query($con, $sql);
    if ($resultado) {
      header('Location: ../agregar_personal_req_v2.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
    } else {
      echo '<script> alert("Error al guardar el requerimiento"); 
          window.history.back(-1);</script>';
    }
  } else {
    echo '<script> alert("Error al guardar el personal requerido"); 
          window.history.back(-1);</script>';
  }
} elseif (isset($_POST['agregar_practicante'])) {
  $practicas_idcon = $_POST['practicas_idcon'];
  $tipo_practicante = $_POST['tipo_practicante'];
  if ($tipo_practicante == 'PRE-PROFESIONAL') {
    $cantidad = $_POST['cantidad'];
    $remuneracion = $_POST['remuneracion'];
    $fuente_finac = $_POST['fuente_finac'];
    $meta = $_POST['meta'];
    $carrera = strtoupper($_POST['carrera']);
    $ubicacion = $_POST['chosen-unique'];
    $nivel_estudiante = $_POST['nivel_estudiante'];
    $ciclo_minimo = $_POST['ciclo_minimo'];
    $sql = "INSERT INTO practicantes_req (tipo_practicante,cantidad_req,remuneracion,fuente_finac,meta,carrera_prof,conv_idpracticas,practicantes_req_idubicacion,nivel_estudio,ciclo_requerido) 
    VALUES('" . $tipo_practicante . "','" . $cantidad . "','" . $remuneracion . "','" . $fuente_finac . "','" . $meta . "','" . $carrera . "','" . $practicas_idcon . "','" . $ubicacion . "','" . $nivel_estudiante . "','" . $ciclo_minimo . "')";
    $resultado = mysqli_query($con, $sql);
    if ($resultado) {
      header('Location: ../agregar_pract_req.php?practicas_idcon=' . $practicas_idcon . '&dni=' . $dni);
    } else {
      echo '<script> alert("Error al guardar el racticante, verifique los datos ingresados."); 
          window.history.back(-1);</script>';
    }
  } elseif ($tipo_practicante == 'PROFESIONAL') {
    $cantidad = $_POST['cantidad'];
    $remuneracion = $_POST['remuneracion'];
    $fuente_finac = $_POST['fuente_finac'];
    $meta = $_POST['meta'];
    $carrera = strtoupper($_POST['carrera']);
    $ubicacion = $_POST['chosen-unique'];
    $nivel_egresado = $_POST['nivel_egresado'];
    $sql = "INSERT INTO practicantes_req (tipo_practicante,cantidad_req,remuneracion,fuente_finac,meta,carrera_prof,conv_idpracticas,practicantes_req_idubicacion,nivel_estudio) 
    VALUES('" . $tipo_practicante . "','" . $cantidad . "','" . $remuneracion . "','" . $fuente_finac . "','" . $meta . "','" . $carrera . "','" . $practicas_idcon . "','" . $ubicacion . "','" . $nivel_egresado . "')";
    $resultado = mysqli_query($con, $sql);
    if ($resultado) {
      header('Location: ../agregar_pract_req.php?practicas_idcon=' . $practicas_idcon . '&dni=' . $dni);
    } else {
      echo '<script> alert("Error al guardar el racticante, verifique los datos ingresados."); 
          window.history.back(-1);</script>';
    }
  }
} elseif (isset($_POST['insertPersoReq'])) {
  $idcon = $_POST['idconvocatoria'];
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
    $idpersonal = trim($row[0]);
  }

  if ($result) {
    $reque_tipo_estudios = $_POST['formacion_requerida'];
    $nivel_estudios = $_POST['nivel_estudios'];
    $ciclo_actual = $_POST['ciclo_actual'];
    $colegiatura = $_POST['colegiatura'];
    $habilitaicon = $_POST['habilitacion'];
    $serums = $_POST['serums'];

    $reque_tipo_estudios_max = $_POST['formacion_requerida_max'];
    $nivel_estudios_max = $_POST['nivel_estudios_max'];
    $ciclo_actual_max = $_POST['ciclo_actual_max'];
    $colegiatura_max = $_POST['colegiatura_max'];
    $habilitacion_max = $_POST['habilitacion_max'];
    $serums_max = $_POST['serums_max'];

    $tipo_experiencia = $_POST['tipo_experiencia'];
    $cantidad_experiencia = $_POST['cantidad_experiencia'];
    $licencia_conducir = $_POST['licencia_conducir'];

    $sql = "INSERT INTO requerimientos (reque_tipo_estudios,nivel_estudio,ciclo_actual,colegiatura,habilitacion,serums,tipo_experiencia,cantidad_experiencia,licencia_conducir,reque_id_personal,reque_tipo_estudios_max,nivel_estudio_max,ciclo_actual_max,colegiatura_max,habilitacion_max,serums_max) 
        VALUES('" . $reque_tipo_estudios . "','" . $nivel_estudios . "','" . $ciclo_actual . "','" . $colegiatura . "','" . $habilitaicon . "','" . $serums . "','" . $tipo_experiencia . "','" . $cantidad_experiencia . "','" . $licencia_conducir . "','" . $idpersonal . "','" . $reque_tipo_estudios_max . "','" . $nivel_estudios_max . "','" . $ciclo_actual_max . "','" . $colegiatura_max . "','" . $habilitacion_max . "','" . $serums_max . "')";
    $resultado = mysqli_query($con, $sql);
    if ($resultado) {
      header('Location: ../editar_convocatoria_cas.php?idcon=' . $idcon . '&dni=' . $dni . '#profile');
    } else {
      echo '<script> alert("Error al guardar el requerimiento"); 
          window.history.back(-1);</script>';
    }
  } else {
    echo '<script> alert("Error al guardar el personal requerido"); 
          window.history.back(-1);</script>';
  }
}
