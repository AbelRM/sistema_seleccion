<?php

include '../conexion.php';


$dato_desencriptado = $_POST['dni'];
$dni = $_POST['dni'];

if (isset($_POST['editar_conv'])) {
  $idcon = $_POST['idcon'];
  $numerocon = $_POST['num_con'];
  $tipocon = $_POST['tipo_con'];
  $aniocon = $_POST['anio_con'];
  $fechini = $_POST['fech_ini'];
  $fechterm = $_POST['fech_fin'];
  $porcenevacu = $_POST['curricular'];
  $porceentrevista = $_POST['entrevista'];
  $porcediscapacidad = $_POST['por_discapacidad'];
  $porcemilitar = $_POST['militar'];
  $porceexaescrito = $_POST['escrito'];
  $estado = 'ACTIVO';

  $sql = "UPDATE convocatoria SET num_con='$numerocon',anio_con='$aniocon', tipo_con='$tipocon',fech_ini='$fechini',fech_term='$fechterm', porcen_eva_cu='$porcenevacu',porce_entrevista='$porceentrevista', porce_discapacidad='$porcediscapacidad',porce_sermilitar='$porcemilitar', porce_exa_escrito='$porceexaescrito', estado='$estado' WHERE idcon='$idcon'";

  $result = mysqli_query($con, $sql);

  if ($result) {
    header('Location: ../modificar_personalreq.php?dni=' . $dato_desencriptado . '&idcon=' . $idcon);
  } else {
    echo '<script> alert("Error al guardar"); </script>';
    echo "<script type=\"text/javascript\">history.go(-1);</script>";
  }
} elseif (isset($_POST['updateRequerimiento'])) {
  $idcon = $_POST['idcon'];
  $idpersonal = $_POST['idpersonal'];

  $cantidad = $_POST['cantidad'];
  $cargo = $_POST['cargo'];
  $remuneracion = $_POST['remuneracion'];
  $fuente_finac = $_POST['fuente_finac'];
  $meta = $_POST['meta'];
  $direccion_ejecutora = $_POST['direccion'];
  $ubicacion_postu = $_POST['ubicacion'];


  $sql = "UPDATE personal_req SET cantidad='" . $cantidad . "', remuneracion='" . $remuneracion . "',fuente_finac='" . $fuente_finac . "',meta='" . $meta . "',cargo_idcargo='" . $cargo . "',convocatoria_idcon='" . $idcon . "',personal_req_idubicacion='" . $direccion_ejecutora . "',personal_req_ubicacion_postu='" . $ubicacion_postu . "' WHERE idpersonal = '$idpersonal'";
  $result = mysqli_query($con, $sql);

  if ($result) {
    $reque_tipo_estudios = $_POST['formacion_requerida'];
    if ($reque_tipo_estudios == 1) {
      $nivel_estudios = 'NINGUNO';
    } elseif ($reque_tipo_estudios == 2) {
      $nivel_estudios = $_POST['nivel_estudios_tec'];
    } elseif ($reque_tipo_estudios == 3) {
      $nivel_estudios = $_POST['nivel_estudios_prof'];
    }
    $ciclo_actual = $_POST['ciclo_actual'];
    $colegiatura = $_POST['colegiatura'];
    $habilitaicon = $_POST['habilitacion'];
    $serums = $_POST['serums'];

    $reque_tipo_estudios_max = $_POST['formacion_requerida_max'];
    if ($reque_tipo_estudios_max == 1) {
      $nivel_estudios_max = 'NINGUNO';
    } elseif ($reque_tipo_estudios_max == 2) {
      $nivel_estudios_max = $_POST['nivel_estudios_tec_max'];
    } elseif ($reque_tipo_estudios_max == 3) {
      $nivel_estudios_max = $_POST['nivel_estudios_max'];
    }
    $ciclo_actual_max = $_POST['ciclo_actual_max'];
    $colegiatura_max = $_POST['colegiatura_max'];
    $habilitacion_max = $_POST['habilitacion_max'];
    $serums_max = $_POST['serums_max'];

    $tipo_experiencia = $_POST['tipo_experiencia'];
    if ($tipo_experiencia == 'anios') {
      $cantidad_experiencia = $_POST['cantidad_anios'];
    } elseif ($tipo_experiencia == 'meses') {
      $cantidad_experiencia = $_POST['cantidad_meses'];
    } elseif ($tipo_experiencia == 'sin experiencia') {
      $cantidad_experiencia = 0;
    }
    $licencia_conducir = $_POST['licencia_conducir'];

    $sql = "UPDATE requerimientos SET reque_tipo_estudios='" . $reque_tipo_estudios . "',nivel_estudio='" . $nivel_estudios . "',ciclo_actual='" . $ciclo_actual . "',colegiatura='" . $colegiatura . "',habilitacion='" . $habilitaicon . "',serums='" . $serums . "',tipo_experiencia='" . $tipo_experiencia . "',cantidad_experiencia='" . $cantidad_experiencia . "',licencia_conducir='" . $licencia_conducir . "',reque_id_personal='" . $idpersonal . "',reque_tipo_estudios_max='" . $reque_tipo_estudios_max . "',nivel_estudio_max='" . $nivel_estudios_max . "',ciclo_actual_max='" . $ciclo_actual_max . "',colegiatura_max='" . $colegiatura_max . "',habilitacion_max='" . $habilitacion_max . "', serums_max='" . $serums_max . "' WHERE reque_id_personal = '$idpersonal'";
    $resultado = mysqli_query($con, $sql);
    if ($resultado) {
      header('Location: ../agregar_personal_req_v2.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
    } else {
      echo '<script> alert("Error al guardar el requerimiento"); 
          </script>';
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
    }
  } else {
    echo '<script> alert("Error al guardar el personal requerido"); 
          </script>';
    echo "<script type=\"text/javascript\">history.go(-1);</script>";
  }
} elseif (isset($_POST['insertComi'])) {
  $idcon = $_POST['idcon'];
  $cargo_funcio = $_POST['cargo_funcio'];
  $nombre_comi = $_POST['nombre_comi'];
  $apelli_comi = $_POST['apelli_comi'];
  $area_comi = $_POST['area_comi'];

  $sql = "INSERT INTO comision (cargo_funcio,nombre,apellidos,area_user,convocatoria_idcon) 
          VALUES('" . $cargo_funcio . "','" . $nombre_comi . "','" . $apelli_comi . "','" . $area_comi . "','" . $idcon . "')";
  $resultado = mysqli_query($con, $sql);
  if ($resultado) {
    header('Location: ../editar_convocatoria_cas.php?idcon=' . $idcon . '&dni=' . $dato_desencriptado . '#comision');
  } else {
    echo '<script> alert("Error al guardar"); </script>';
    echo "<script type=\"text/javascript\">history.go(-1);</script>";
  }
} elseif (isset($_POST['updatetComi'])) {
  $idcon = $_POST['idcon'];
  $idcomision = $_POST['idcomision'];
  $cargo_funcio = $_POST['cargo_funcio'];
  $nombre_comi = $_POST['nombre_comi'];
  $apelli_comi = $_POST['apelli_comi'];
  $area_comi = $_POST['area_comi'];

  $sql = "UPDATE comision SET cargo_funcio='$cargo_funcio',nombre='$nombre_comi',apellidos='$apelli_comi',area_user='$area_comi' WHERE idcomision='$idcomision'";
  $resultado = mysqli_query($con, $sql);
  if ($resultado) {
    header('Location: ../editar_convocatoria_cas.php?idcon=' . $idcon . '&dni=' . $dato_desencriptado . '#comision');
  } else {
    echo '<script> alert("Error al actualizar"); </script>';
    echo "<script type=\"text/javascript\">history.go(-1);</script>";
  }
} elseif (isset($_POST['deleteComi'])) {
  $idcon = $_POST['idcon'];
  $idcomision = $_POST['idcomi'];
  $sql = "DELETE FROM comision WHERE idcomision='$idcomision'";
  $resultado = mysqli_query($con, $sql);
  if ($resultado) {
    header('Location: ../editar_convocatoria_cas.php?idcon=' . $idcon . '&dni=' . $dato_desencriptado . '#comision');
  } else {
    echo '<script> alert("Error al Eliminar"); </script>';
    echo "<script type=\"text/javascript\">history.go(-1);</script>";
  }
} elseif (isset($_POST['updatePersonalreq'])) {
  $idcon = $_POST['idcon'];
  $cantidad = $_POST['cantidad'];
  $cargo = $_POST['cargo'];
  $remuneracion = $_POST['remuneracion'];
  $fuente_finac = $_POST['fuente_finac'];
  $meta = $_POST['meta'];
  $ubicacion = $_POST['ubicacion'];

  $sql = "UPDATE personal_req SET cantidad='$cantidad',remuneracion='$remuneracion',fuente_finac='$fuente_finac',meta='$meta',cargo_idcargo='$cargo',meta='$meta' WHERE idcomision='$idcomision'";
  $resultado = mysqli_query($con, $sql);
  if ($resultado) {
    header('Location: ../editar_convocatoria_cas.php?idcon=' . $idcon . '&dni=' . $dato_desencriptado . '#comision');
  } else {
    echo '<script> alert("Error al actualizar"); </script>';
    echo "<script type=\"text/javascript\">history.go(-1);</script>";
  }
} elseif (isset($_POST['updatePracReq'])) {
  $practicas_idcon = $_POST['practicas_idcon'];
  $idpracticantes_req = $_POST['idpracticantes_req'];

  $tipo_practicante = $_POST['tipo_practicante'];
  if ($tipo_practicante == 'PRE-PROFESIONAL') {
    $cantidad = $_POST['cantidad'];
    $remuneracion = $_POST['remuneracion'];
    $fuente_finac = $_POST['fuente_finac'];
    $meta = $_POST['meta'];
    $carrera = $_POST['carrera'];
    $ubicacion = $_POST['chosen-unique'];
    $nivel_estudiante = $_POST['nivel_estudiante'];
    $ciclo_minimo = $_POST['ciclo_minimo'];
    $sql = "UPDATE practicantes_req SET tipo_practicante='" . $tipo_practicante . "',cantidad_req='" . $cantidad . "',remuneracion='" . $remuneracion . "',fuente_finac='" . $fuente_finac . "',meta='" . $meta . "',id_carrera_req='" . $carrera . "',conv_idpracticas='" . $practicas_idcon . "',practicantes_req_idubicacion='" . $ubicacion . "',nivel_estudio='" . $nivel_estudiante . "',ciclo_requerido='" . $ciclo_minimo . "' WHERE idpracticantes_req= '$idpracticantes_req'";
    $resultado = mysqli_query($con, $sql);
    if ($resultado) {
      header('Location: ../agregar_pract_req.php?practicas_idcon=' . $practicas_idcon . '&dni=' . $dni);
    } else {
      echo '<script> alert("Error al actualziar los datos requeridos, verifique los datos ingresados."); 
          window.history.back(-1);</script>';
    }
  } elseif ($tipo_practicante == 'PROFESIONAL') {
    $cantidad = $_POST['cantidad'];
    $remuneracion = $_POST['remuneracion'];
    $fuente_finac = $_POST['fuente_finac'];
    $meta = $_POST['meta'];
    $carrera = $_POST['carrera'];
    $ubicacion = $_POST['chosen-unique'];
    $nivel_egresado = $_POST['nivel_egresado'];
    $sql = "UPDATE practicantes_req SET tipo_practicante='" . $tipo_practicante . "',cantidad_req='" . $cantidad . "',remuneracion='" . $remuneracion . "',fuente_finac='" . $fuente_finac . "',meta='" . $meta . "',id_carrera_req='" . $carrera . "',conv_idpracticas='" . $practicas_idcon . "',practicantes_req_idubicacion='" . $ubicacion . "',nivel_estudio='" . $nivel_egresado . "' WHERE idpracticantes_req = '$idpracticantes_req'";
    $resultado = mysqli_query($con, $sql);
    if ($resultado) {
      header('Location: ../agregar_pract_req.php?practicas_idcon=' . $practicas_idcon . '&dni=' . $dni);
    } else {
      echo '<script> alert("Error al actualizar los datos requeridos, verifique los datos ingresados."); 
          window.history.back(-1);</script>';
    }
  }
} else {
  echo "Error al ingresar";
}
