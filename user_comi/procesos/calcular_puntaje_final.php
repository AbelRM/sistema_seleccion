<?php

include '../conexion.php';

// echo "VALOR ENVIADO";
$dni = $_POST['dni_comision'];
$dni_postulante = $_POST['dni_postulante'];

$idcon = intval($_POST['idcon']);
$idpersonal = intval($_POST['idpersonal']);
$idpostulante = intval($_POST['idpostulante']);
$iddetalle_convocatoria = intval($_POST['iddetalle_convocatoria']);

date_default_timezone_set('America/Lima');
$date = date('Y-m-d H:i:s');

$consul_detalle_cas = MYSQLI_query($con, "SELECT * FROM detalle_convocatoria INNER JOIN convocatoria ON detalle_convocatoria.convocatoria_idcon = convocatoria.idcon INNER JOIN postulante ON detalle_convocatoria.postulante_idpostulante = postulante.idpostulante INNER JOIN evaluacion_curri_cas ON detalle_convocatoria.id_eva_curri_cas = evaluacion_curri_cas.id_eva_curricular INNER JOIN entrevista_cas ON detalle_convocatoria.id_entrevista_cas = entrevista_cas.id_entrevista_cas WHERE iddetalle_convocatoria ='$iddetalle_convocatoria' AND estado_conv_cas = 'APTO'");
$ar = mysqli_fetch_array($consul_detalle_cas);
$estado_resultado_final = $ar['estado_resultado_final'];
$porcen_eva_cu = $ar['porcen_eva_cu'];
$porce_entrevista = $ar['porce_entrevista'];
$porce_exa_escrito = $ar['porce_exa_escrito'];
$porce_discapacidad = $ar['porce_discapacidad'];
$porce_sermilitar = $ar['porce_sermilitar'];

$deportista_calificado = $ar['deportista_calificado'];
$discapacidad = $ar['discapacidad'];
$servicio_militar = $ar['servicio_militar'];
$serums = $ar['serums'];
//puntajes
$puntaje_total_cv = $ar['puntaje_total_total'];
$puntaje_total_entre = $ar['puntaje_total'];

$responder = array();
if ($estado_resultado_final == 'NO AGREGADO') {
  //puntaje final curricular
  $new_porcen_eva_cu = $porcen_eva_cu / 100;
  $new_puntaje_total_cv = $puntaje_total_cv * $new_porcen_eva_cu;
  $new_puntaje_total_cv = round($new_puntaje_total_cv, 2);
  //puntaje final entrevista
  $new_porce_entrevista = $porce_entrevista / 100;
  $new_puntaje_total_entre = $puntaje_total_entre * $new_porce_entrevista;
  $new_puntaje_total_entre = round($new_puntaje_total_entre, 2);
  //TOTAL PUNTAJE CV + ENTREVISTA
  $puntaje_total_cv_entre = $new_puntaje_total_cv + $new_puntaje_total_entre;
  //discapacidad
  if ($discapacidad == 'SI') {
    $new_porce_discapacidad = $porce_discapacidad / 100;
    $puntaje_discapacidad = $puntaje_total_cv_entre * $new_porce_discapacidad;
    $puntaje_discapacidad = round($puntaje_discapacidad, 2);
    // $puntaje_total_discap = $puntaje_total_cv_entre + $puntaje_discapacidad;
  } else {
    $puntaje_discapacidad = 0;
  }
  //militar
  if ($servicio_militar == 'SI') {
    $new_porce_sermilitar = $porce_sermilitar / 100;
    $puntaje_militar = $puntaje_total_cv_entre * $new_porce_sermilitar;
    $puntaje_militar = round($puntaje_militar, 2);
    // $puntaje_total_mili = $puntaje_total_cv_entre + $puntaje_militar;
  } else {
    $puntaje_militar = 0;
  }
  //deportista
  if ($deportista_calificado == 20) {
    $new_deportista_calificado = $deportista_calificado / 100;
    $puntaje_deportista = $new_puntaje_total_cv * $new_deportista_calificado;
    $puntaje_deportista = round($puntaje_deportista, 2);
  } elseif ($deportista_calificado == 16) {
    $new_deportista_calificado = $deportista_calificado / 100;
    $puntaje_deportista = $new_puntaje_total_cv * $new_deportista_calificado;
    $puntaje_deportista = round($puntaje_deportista, 2);
  } elseif ($deportista_calificado == 12) {
    $new_deportista_calificado = $deportista_calificado / 100;
    $puntaje_deportista = $new_puntaje_total_cv * $new_deportista_calificado;
    $puntaje_deportista = round($puntaje_deportista, 2);
  } elseif ($deportista_calificado == 8) {
    $new_deportista_calificado = $deportista_calificado / 100;
    $puntaje_deportista = $new_puntaje_total_cv * $new_deportista_calificado;
    $puntaje_deportista = round($puntaje_deportista, 2);
  } elseif ($deportista_calificado == 4) {
    $new_deportista_calificado = $deportista_calificado / 100;
    $puntaje_deportista = $new_puntaje_total_cv * $new_deportista_calificado;
    $puntaje_deportista = round($puntaje_deportista, 2);
  } else {
    $puntaje_deportista = 0;
  }
  //SERUMS (QUINTIL)
  if ($serums == 15) {
    $new_serums = $serums / 100;
    $puntaje_serums = $puntaje_total_cv_entre * $new_serums;
    $puntaje_serums = round($puntaje_serums, 2);
  } elseif ($serums == 10) {
    $new_serums = $serums / 100;
    $puntaje_serums = $puntaje_total_cv_entre * $new_serums;
    $puntaje_serums = round($puntaje_serums, 2);
  } elseif ($serums == 5) {
    $new_serums = $serums / 100;
    $puntaje_serums = $puntaje_total_cv_entre * $new_serums;
    $puntaje_serums = round($puntaje_serums, 2);
  } elseif ($serums == 2) {
    $new_serums = $serums / 100;
    $puntaje_serums = $puntaje_total_cv_entre * $new_serums;
    $puntaje_serums = round($puntaje_serums, 2);
  } elseif ($serums == 0) {
    $new_serums = $serums / 100;
    $puntaje_serums = $puntaje_total_cv_entre * $new_serums;
    $puntaje_serums = round($puntaje_serums, 2);
  } else {
    $puntaje_serums = 0;
  }
  //TOTAL PARA RESULTADO FINAL
  $total_resultado_final = $puntaje_total_cv_entre + $puntaje_discapacidad + $puntaje_militar + $puntaje_deportista + $puntaje_serums;

  $insert_resul_final = MYSQLI_query($con, "INSERT INTO resultado_final (puntaje_cv, porcentaje_cv, ponderado_cv, puntaje_entre, porcentaje_entre, ponderado_entre, total_puntaje_1, discapacidad_porce, discapacidad, servicio_mili_porce, servicio_mili, deportista_calif_porce, deportista_calif, quintil_porcen, valor_quintil, puntaje_final_total) VALUES ('$puntaje_total_cv', '$porcen_eva_cu', '$new_puntaje_total_cv', '$puntaje_total_entre', '$porce_entrevista', '$new_puntaje_total_entre', '$puntaje_total_cv_entre', '$porce_discapacidad', '$puntaje_discapacidad', '$porce_sermilitar', '$puntaje_militar', '$deportista_calificado', '$puntaje_deportista','$serums','$puntaje_serums','$total_resultado_final'");
  //GUARDAR ULTIMO ID REGISTRADO
  $query = mysqli_query(
    $con,
    "SELECT MAX(idresultado_final) AS id FROM resultado_final"
  );
  if ($row = mysqli_fetch_row($query)) {
    $id = trim($row[0]);
  }
  if ($insert_resul_final) {
    $sql = "UPDATE detalle_convocatoria SET estado_resultado_final = 'AGREGADO', id_resultado_final='" . $id    . "', dni_comision_update_final='" . $dni . "', fech_update_comision_final ='" . $date . "' WHERE iddetalle_convocatoria = '$iddetalle_convocatoria' ";
    $result = MYSQLI_query($con, $sql);

    if ($result) {
      $responder =  array('r' => 1, 'dni' => $dni, 'idpostulante' => $idpostulante, 'idcon' => $idcon, 'idpersonal' => $idpersonal, 'mensaje' => "Se agregó correctamente los resultados finales.");
      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
    } else {
      $responder =  array('r' => 0, 'dni' => $dni, 'idpostulante' => $idpostulante, 'idcon' => $idcon, 'idpersonal' => $idpersonal, 'mensaje' => "Error al actualizar la tabla detalle convocatoria.");
      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
    }
  } else {
    $responder =  array('r' => 0, 'dni' => $dni, 'idpostulante' => $idpostulante, 'idcon' => $idcon, 'idpersonal' => $idpersonal, 'mensaje' => "Error al insertar datos en la tabla resultado final.");
    echo json_encode($responder, JSON_UNESCAPED_UNICODE);
  }
} else {
  $id_resultado_final = $ar['id_resultado_final'];
  //puntaje final curricular
  $new_porcen_eva_cu = $porcen_eva_cu / 100;
  $new_puntaje_total_cv = $puntaje_total_cv * $new_porcen_eva_cu;
  $new_puntaje_total_cv = round($new_puntaje_total_cv, 2);
  //puntaje final entrevista
  $new_porce_entrevista = $porce_entrevista / 100;
  $new_puntaje_total_entre = $puntaje_total_entre * $new_porce_entrevista;
  $new_puntaje_total_entre = round($new_puntaje_total_entre, 2);
  //TOTAL PUNTAJE CV + ENTREVISTA
  $puntaje_total_cv_entre = $new_puntaje_total_cv + $new_puntaje_total_entre;
  //discapacidad
  if ($discapacidad == 'SI') {
    $new_porce_discapacidad = $porce_discapacidad / 100;
    $puntaje_discapacidad = $puntaje_total_cv_entre * $new_porce_discapacidad;
    $puntaje_discapacidad = round($puntaje_discapacidad, 2);
    // $puntaje_total_discap = $puntaje_total_cv_entre + $puntaje_discapacidad;
  } else {
    $puntaje_discapacidad = 0;
  }
  //militar
  if ($servicio_militar == 'SI') {
    $new_porce_sermilitar = $porce_sermilitar / 100;
    $puntaje_militar = $puntaje_total_cv_entre * $new_porce_sermilitar;
    $puntaje_militar = round($puntaje_militar, 2);
    // $puntaje_total_mili = $puntaje_total_cv_entre + $puntaje_militar;
  } else {
    $puntaje_militar = 0;
  }
  //deportista
  if ($deportista_calificado == 20) {
    $new_deportista_calificado = $deportista_calificado / 100;
    $puntaje_deportista = $new_puntaje_total_cv * $new_deportista_calificado;
    $puntaje_deportista = round($puntaje_deportista, 2);
  } elseif ($deportista_calificado == 16) {
    $new_deportista_calificado = $deportista_calificado / 100;
    $puntaje_deportista = $new_puntaje_total_cv * $new_deportista_calificado;
    $puntaje_deportista = round($puntaje_deportista, 2);
  } elseif ($deportista_calificado == 12) {
    $new_deportista_calificado = $deportista_calificado / 100;
    $puntaje_deportista = $new_puntaje_total_cv * $new_deportista_calificado;
    $puntaje_deportista = round($puntaje_deportista, 2);
  } elseif ($deportista_calificado == 8) {
    $new_deportista_calificado = $deportista_calificado / 100;
    $puntaje_deportista = $new_puntaje_total_cv * $new_deportista_calificado;
    $puntaje_deportista = round($puntaje_deportista, 2);
  } elseif ($deportista_calificado == 4) {
    $new_deportista_calificado = $deportista_calificado / 100;
    $puntaje_deportista = $new_puntaje_total_cv * $new_deportista_calificado;
    $puntaje_deportista = round($puntaje_deportista, 2);
  } else {
    $puntaje_deportista = 0;
  }
  //SERUMS (QUINTIL)
  if ($serums == 15) {
    $new_serums = $serums / 100;
    $puntaje_serums = $puntaje_total_cv_entre * $new_serums;
    $puntaje_serums = round($puntaje_serums, 2);
  } elseif ($serums == 10) {
    $new_serums = $serums / 100;
    $puntaje_serums = $puntaje_total_cv_entre * $new_serums;
    $puntaje_serums = round($puntaje_serums, 2);
  } elseif ($serums == 5) {
    $new_serums = $serums / 100;
    $puntaje_serums = $puntaje_total_cv_entre * $new_serums;
    $puntaje_serums = round($puntaje_serums, 2);
  } elseif ($serums == 2) {
    $new_serums = $serums / 100;
    $puntaje_serums = $puntaje_total_cv_entre * $new_serums;
    $puntaje_serums = round($puntaje_serums, 2);
  } elseif ($serums == 0) {
    $new_serums = $serums / 100;
    $puntaje_serums = $puntaje_total_cv_entre * $new_serums;
    $puntaje_serums = round($puntaje_serums, 2);
  } else {
    $puntaje_serums = 0;
  }
  //TOTAL PARA RESULTADO FINAL
  $total_resultado_final = $puntaje_total_cv_entre + $puntaje_discapacidad + $puntaje_militar + $puntaje_deportista + $puntaje_serums;
  //INSERTAR EN RESULTADO FINAL
  $insert_resul_final = MYSQLI_query($con, "UPDATE resultado_final SET puntaje_cv='$puntaje_total_cv', porcentaje_cv='$porcen_eva_cu', ponderado_cv='$new_puntaje_total_cv', puntaje_entre='$puntaje_total_entre', porcentaje_entre='$porce_entrevista', ponderado_entre='$new_puntaje_total_entre', total_puntaje_1='$puntaje_total_cv_entre', discapacidad_porce='$porce_discapacidad', discapacidad='$puntaje_discapacidad', servicio_mili_porce='$porce_sermilitar', servicio_mili='$puntaje_militar', deportista_calif_porce ='$deportista_calificado', deportista_calif='$puntaje_deportista', quintil_porcen='$porcentaje_serums', valor_quintil='$puntaje_serums', puntaje_final_total='$total_resultado_final' WHERE idresultado_final = '$id_resultado_final'");

  if ($insert_resul_final) {
    $sql = "UPDATE detalle_convocatoria SET estado_resultado_final = 'AGREGADO', id_resultado_final='" . $id    . "', dni_comision_update_final='" . $dni . "', fech_update_comision_final ='" . $date . "' WHERE iddetalle_convocatoria = '$iddetalle_convocatoria' ";
    $result = MYSQLI_query($con, $sql);

    if ($result) {
      $responder =  array('r' => 1, 'dni' => $dni, 'idpostulante' => $idpostulante, 'idcon' => $idcon, 'idpersonal' => $idpersonal, 'mensaje' => "Se agregó correctamente los resultados finales.");
      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
    } else {
      $responder =  array('r' => 0, 'dni' => $dni, 'idpostulante' => $idpostulante, 'idcon' => $idcon, 'idpersonal' => $idpersonal, 'mensaje' => "Error al actualizar la tabla detalle convocatoria.");
      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
    }
  } else {
    $responder =  array('r' => 0, 'dni' => $dni, 'idpostulante' => $idpostulante, 'idcon' => $idcon, 'idpersonal' => $idpersonal, 'mensaje' => "Error al actualizar datos en la tabla resultado final.");
    echo json_encode($responder, JSON_UNESCAPED_UNICODE);
  }
}
