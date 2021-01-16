<?php

include '../conexion.php';

// echo "VALOR ENVIADO";
$dni = $_GET['dni'];

$idcon = intval($_GET['idcon']);
$idpersonal = intval($_GET['idpersonal']);
$idpostulante = intval($_GET['idpostulante']);
$iddetalle_convocatoria = intval($_GET['iddetalle_convocatoria']);

// $tipo_convocatoria = 'PRACTICANTE';
date_default_timezone_set('America/Lima');
$date = date('Y-m-d H:i:s');

$consul_personal_req = MYSQLI_query($con, "SELECT * FROM personal_req INNER JOIN cargo_full ON personal_req.cargo_idcargo = cargo_full.idcargo 
WHERE idpersonal ='$idpersonal'");
$ar = mysqli_fetch_array($consul_personal_req);
$nomb_cargo_espec = $ar['nomb_cargo_espec'];
// if ($consul_personal_req) {
//   $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => $idpersonal);
//   echo json_encode($responder, JSON_UNESCAPED_UNICODE);
// } else {
//   $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => $idpersonal);
//   echo json_encode($responder, JSON_UNESCAPED_UNICODE);
// }

$consul_formac = MYSQLI_query($con, "SELECT * FROM formacion_acad INNER JOIN tipo_estudios ON formacion_acad.tipo_estudios_id = tipo_estudios.id_tipo_estudios WHERE formacion_idpostulante ='$idpostulante'");
$rw = mysqli_fetch_array($consul_formac);
$formacion_validacion = $rw['formacion_validacion'];
$tipo_estudios = $rw['tipo_estudios'];
$nivel_estudios = $rw['nivel_estudios'];

$consult_detalle_conv = mysqli_query($con, "SELECT * FROM detalle_convocatoria WHERE iddetalle_convocatoria='$iddetalle_convocatoria'");
$ar_detalle_con = mysqli_fetch_array($consult_detalle_conv);

$responder = array();

if ($formacion_validacion == 'VALIDO') {
  if ($nomb_cargo_espec == 'PROFESIONAL DE LA SALUD') {
    //FORMACION
    if ($nivel_estudios == 'TITULADO') {
      $puntaje_nivel_estu = 45;
    } else {
      $puntaje_nivel_estu = 0;
      $actualizar_post = "UPDATE detalle_convocatoria SET estado_conv_cas='NO APTO (No cumple con la formación)', id_eva_curri_cas='$id' WHERE iddetalle_convocatoria='$iddetalle_convocatoria'";
      $resultado_post = MYSQLI_query($con, $actualizar_post);
      if ($resultado_post) {
        $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "NO APTO: No cumple con el TITULO requerido.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      } else {
        $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al actualizar la tabla detalle convocatoria.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      }
    }
    //POSTGRADO
    $consul_maestria = MYSQLI_query($con, "SELECT * FROM maestria_doc WHERE idpostulante_postulante ='$idpersonal' AND postgrado_validacion = 'VALIDO'");
    $ar_maestria = mysqli_fetch_array($consul_maestria);
    $fil_maestria = mysqli_num_rows($consul_maestria);
    if ($fil_maestria > 0) {
      $tipo_estu = $ar_maestria['tipo_estu'];
      $nivel = $ar_maestria['nivel'];
      if ($tipo_estu == 'ESPECIALIDAD') {
        if ($nivel == 'ACREDITADO') {
          $puntaje_espec_acre = 4;
          $puntaje_espec_egre = 0;
        } elseif ($nivel == 'EGRESADO') {
          $puntaje_espec_egre = 1;
          $puntaje_espec_acre = 0;
        }
      } else {
        $puntaje_espec_acre = 0;
        $puntaje_espec_egre = 0;
      }

      if ($tipo_estu == 'MAESTRIA') {
        if ($nivel == 'ACREDITADO') {
          $puntaje_maestria_acre = 2;
          $puntaje_maestria_egre = 0;
        } elseif ($nivel == 'EGRESADO') {
          $puntaje_maestria_egre = 1;
          $puntaje_maestria_acre = 0;
        }
      } else {
        $puntaje_maestria_acre = 0;
        $puntaje_maestria_egre = 0;
      }

      if ($tipo_estu == 'DOCTORADO') {
        if ($nivel == 'ACREDITADO') {
          $puntaje_doc_acre = 4;
          $puntaje_doc_egre = 0;
        } elseif ($nivel == 'EGRESADO') {
          $puntaje_doc_egre = 2;
          $puntaje_doc_acre = 0;
        }
      } else {
        $puntaje_doc_acre = 0;
        $puntaje_doc_egre = 0;
      }
    } else {
      $puntaje_espec_acre = 0;
      $puntaje_espec_egre = 0;
      $puntaje_maestria_acre = 0;
      $puntaje_maestria_egre = 0;
      $puntaje_doc_acre = 0;
      $puntaje_doc_egre = 0;
    }
    $puntos_total_form = $puntaje_nivel_estu + $puntaje_espec_acre + $puntaje_espec_egre + $puntaje_maestria_acre + $puntaje_maestria_egre + $puntaje_doc_acre + $puntaje_doc_egre;
    //CURSOS
    $consul_cursos = MYSQLI_query($con, "SELECT * FROM cursos_extra WHERE curso_extra_idpostulante ='$idpostulante' AND curso_validacion='VALIDO'");;
    $fil_cursos = mysqli_num_rows($consul_cursos);
    if ($fil_cursos > 0) {
      $horas_total_80 = 0;
      $puntos_total_3_menos = 0;
      $puntos_total_3_6 = 0;
      $puntos_total_6_9 = 0;
      $puntos_total_9_mas = 0;
      while ($ar_cursos = mysqli_fetch_array($consul_cursos)) {
        $horas = $ar_cursos['horas'];

        if ($horas >= 1 && $horas < 80) {
          $horas_total_80 = $horas_total_80 + $horas;
        }

        if ($horas >= 80 && $horas < 240) {
          $puntos_total_3_menos = $puntos_total_3_menos + 1;
        }

        if ($horas >= 240 && $horas < 480) {
          $puntos_total_3_6 = $puntos_total_3_6 + 1.5;
        }

        if ($horas >= 480 && $horas < 720) {
          $puntos_total_6_9 = $puntos_total_6_9 + 2;
        }

        if ($horas >= 720) {
          $puntos_total_9_mas = $puntos_total_9_mas + 2.5;
        }
      }
      if ($horas_total_80 >= 200) {
        $puntaje_cursillos = 1;
      } else {
        $puntaje_cursillos = $horas_total_80 / 200;
      }
      $puntos_total_cursos = $puntaje_cursillos + $puntos_total_3_menos + $puntos_total_3_6 + $puntos_total_6_9 + $puntos_total_9_mas;
    } else {
      $puntos_total_cursos = 0;
    }
    $consul_idioma = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante ='$idpostulante' AND idioma_validacion='VALIDO'");
    $fil_idioma = mysqli_num_rows($consul_idioma);
    if ($fil_idioma > 0 && $fil_idioma <= 2) {
      $puntos_idioma_comp = $fil_idioma;
    } elseif ($fil_idioma > 2) {
      $puntos_idioma_comp = 2;
    } else {
      $puntos_idioma_comp = 0;
    }
    $puntos_total_cursos_idioma = $puntos_total_cursos + $puntos_idioma_comp;
    if ($puntos_total_cursos_idioma >= 20) {
      $puntos_total_cursos = 20;
    }

    //EXPERIENCIA LABORAL
    $consul_expe = MYSQLI_query($con, "SELECT * FROM expe_4puntos INNER JOIN lugar_trabajo_gene 
    ON expe_4puntos.lugar_trab_general = lugar_trabajo_gene.idlugar_trabajo_gene WHERE expe_puntos_idpostulante ='$idpostulante' AND expe_validacion='VALIDO'");
    $fil_expe = mysqli_num_rows($consul_expe);
    if ($fil_expe > 0) {
      $anios_t = 0;
      $meses_t = 0;
      $dias_t = 0;
      $anios_3 = 0;
      $meses_3 = 0;
      $dias_3 = 0;
      $anios_1 = 0;
      $meses_1 = 0;
      $dias_1 = 0;
      while ($ar_expe = mysqli_fetch_array($consul_expe)) {
        $anios = $ar_expe['anios'];
        $meses = $ar_expe['meses'];
        $dias = $ar_expe['dias'];
        $idlugar_trabajo_gene = $ar_expe['idlugar_trabajo_gene'];

        if ($idlugar_trabajo_gene == 1 or $idlugar_trabajo_gene == 2 or $idlugar_trabajo_gene == 3 or $idlugar_trabajo_gene == 4 or $idlugar_trabajo_gene == 5) {
          $anios_t = $anios_t + $anios;
          $meses_t = $meses_t + $meses;
          $dias_t = $dias_t + $dias;
        } elseif ($idlugar_trabajo_gene == 6 or $idlugar_trabajo_gene == 7 or $idlugar_trabajo_gene == 8 or $idlugar_trabajo_gene == 9 or $idlugar_trabajo_gene == 10 or $idlugar_trabajo_gene == 11) {
          $anios_3 = $anios_3 + $anios;
          $meses_3 = $meses_3 + $meses;
          $dias_3 = $dias_3 + $dias;
        } elseif ($idlugar_trabajo_gene == 12) {
          $anios_1 = $anios_1 + $anios;
          $meses_1 = $meses_1 + $meses;
          $dias_1 = $dias_1 + $dias;
        }
      }
      //4 PUNTOS
      $anios_4_total = $anios_t * 4;
      $meses_4_total = $meses_t * 0.33;
      $dias_4_total = $dias_t * 0.011;
      $suma_4_total = $anios_4_total + $meses_4_total + $dias_4_total;
      //3 PUNTOS
      $anios_3_total = $anios_3 * 3;
      $meses_3_total = $meses_3 * 0.25;
      $dias_3_total = $dias_3 * 0.0083;
      $suma_3_total = $anios_3_total + $meses_3_total + $dias_3_total;
      //1 PUNTOS
      $anios_1_total = $anios_1 * 1;
      $meses_1_total = $meses_1 * 0.083;
      $dias_1_total = $dias_1 * 0.0028;
      $suma_1_total = $anios_1_total + $meses_1_total + $dias_1_total;
      //SUMA TOTAL
      $puntos_total_expe = $suma_4_total + $suma_3_total + $suma_1_total;
      if ($puntos_total_expe >= 25) {
        $puntos_total_expe = 25;
      }
    } else {
      $anios_4_total = 0;
      $meses_4_total = 0;
      $dias_4_total = 0;
      $suma_4_total = $anios_4_total + $meses_4_total + $dias_4_total;
      $anios_3_total = 0;
      $meses_3_total = 0;
      $dias_3_total = 0;
      $suma_3_total = $anios_3_total + $meses_3_total + $dias_3_total;
      $anios_1_total = 0;
      $meses_1_total = 0;
      $dias_1_total = 0;
      $suma_1_total = $anios_1_total + $meses_1_total + $dias_1_total;
      $puntos_total_cursos = 0;
    }
    //PUNTAJE TOTAL CV
    $puntaje_total = $puntos_total_form + $puntos_total_cursos_idioma + $puntos_total_cursos + $puntos_total_expe;
    if ($puntaje_total >= 55) {
      $estado_convocatoria = "APTO";
      $observaciones = "";
    } else {
      $estado_convocatoria = "NO APTO";
      $observaciones = "No sobrepaso el puntaje mínimo";
    }
    //PROCESO GUARDAR
    $consul_detalle_con = MYSQLI_query($con, "SELECT * FROM detalle_convocatoria WHERE iddetalle_convocatoria ='$iddetalle_convocatoria'");
    $ar_detalle_con = mysqli_fetch_array($consul_detalle_con);
    $estado_eva_curri_cas = $ar_detalle_con['estado_eva_curri_cas'];

    if ($estado_eva_curri_cas == 'NO AGREGADO') {
      $sql = "INSERT INTO evaluacion_curri_cas (titulo_prof, titulo_espec, egre_espec, grado_maestria, egre_maestria, grado_doctorado, egre_doctorado,
      punt_total_forma, curso_max_tres, curso_tres_seis, curso_seis_nueve, curso_nueve_mas, cursillos, punt_total_cursos, idioma_compu, 
      expe_laboral_cuatro, expe_laboral_tres, expe_laboral_uno, punt_total_expe,puntaje_total_total) VALUES ('$puntaje_nivel_estu', '$puntaje_espec_acre', 
      '$puntaje_espec_egre','$puntaje_maestria_acre','$puntaje_maestria_egre','$puntaje_doc_acre','$puntaje_doc_egre','$puntos_total_form','$puntos_total_3_menos',
      '$puntos_total_3_6','$puntos_total_6_9','$puntos_total_9_mas', '$puntaje_cursillos','$puntos_total_cursos_idioma','$puntos_idioma_comp','$suma_4_total', 
      '$suma_3_total', '$suma_1_total', '$puntos_total_expe','$puntaje_total')";
      $result = mysqli_query($con, $sql);
      //GUARDAR ULTIMO ID REGISTRADO
      $query = mysqli_query($con, "SELECT MAX(id_eva_curricular) AS id FROM evaluacion_curri_cas");
      if ($row = mysqli_fetch_row($query)) {
        $id = trim($row[0]);
      }
      if ($result) {
        $actualizar_post = "UPDATE detalle_convocatoria SET estado_eva_curri_cas='AGREGADO', id_eva_curri_cas='$id', estado_conv_cas ='$estado_convocatoria',observaciones_detalle_cas='$observaciones' WHERE iddetalle_convocatoria='$iddetalle_convocatoria'";
        $resultado_post = MYSQLI_query($con, $actualizar_post);
        if ($resultado_post) {
          $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se calculó correctamente los puntos de la calificación curricular.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        } else {
          $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo calcular correctamente los puntos de la calificación curricular.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        }
      } else {
        $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo agregar correctamente los valores en la tabla de evaluacion curricular.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      }
    } else {
      $id_eva_curri_cas = $ar_detalle_con['id_eva_curri_cas'];
      $sql = "UPDATE evaluacion_curri_cas SET titulo_prof = '$puntaje_nivel_estu', titulo_espec = '$puntaje_espec_acre', egre_espec = '$puntaje_espec_egre', grado_maestria = '$puntaje_maestria_acre', egre_maestria = '$puntaje_maestria_egre', grado_doctorado = '$puntaje_doc_acre', egre_doctorado = '$puntaje_doc_egre' ,punt_total_forma = '$puntos_total_form', curso_max_tres = '$puntos_total_3_menos', curso_tres_seis = '$puntos_total_3_6', curso_seis_nueve = '$puntos_total_6_9', curso_nueve_mas = '$puntos_total_9_mas', cursillos = '$puntaje_cursillos', punt_total_cursos = '$puntos_total_cursos_idioma', idioma_compu = '$puntos_idioma_comp', expe_laboral_cuatro = '$suma_4_total', expe_laboral_tres = '$suma_3_total', expe_laboral_uno = '$suma_1_total', punt_total_expe = '$puntos_total_expe', puntaje_total_total = '$puntaje_total' WHERE id_eva_curricular = '$id_eva_curri_cas'";
      $result = mysqli_query($con, $sql);
      if ($result) {
        $actualizar_post = "UPDATE detalle_convocatoria SET estado_conv_cas = '$estado_convocatoria',observaciones_detalle_cas = '$observaciones' WHERE iddetalle_convocatoria='$iddetalle_convocatoria'";
        $resultado_post = MYSQLI_query($con, $actualizar_post);
        $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se actualizó correctamente los puntos de la calificación curricular.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      } else {
        $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo actualizar correctamente los puntos de la calificación curricular.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      }
    }
  } elseif ($nomb_cargo_espec == 'OTROS PROFESIONALES') {
    //FORMACION
    if ($nivel_estudios == 'TITULADO') {
      $puntaje_nivel_estu = 45;
    } elseif ($nivel_estudios == 'BACHILLER') {
      $puntaje_nivel_estu = 43;
    } else {
      $puntaje_nivel_estu = 0;
      $responder =  array('r' => 0, 'dni' => $dni, 'idpostulante' => $idpostulante, 'idcon' => $idcon, 'idpersonal' => $idpersonal, 'mensaje' => "No cumple con el TITULO o BACHILLER requerido.");
      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
    }
    //POSTGRADO
    $consul_maestria = MYSQLI_query($con, "SELECT * FROM maestria_doc WHERE idpostulante_postulante ='$idpersonal' AND postgrado_validacion = 'VALIDO'");
    $ar_maestria = mysqli_fetch_array($consul_maestria);
    $fil_maestria = mysqli_num_rows($consul_maestria);
    if ($fil_maestria > 0) {
      $tipo_estu = $ar_maestria['tipo_estu'];
      $nivel = $ar_maestria['nivel'];
      if ($tipo_estu == 'ESPECIALIDAD') {
        if ($nivel == 'ACREDITADO') {
          $puntaje_espec_acre = 4;
          $puntaje_espec_egre = 0;
        } elseif ($nivel == 'EGRESADO') {
          $puntaje_espec_egre = 1;
          $puntaje_espec_acre = 0;
        }
      } else {
        $puntaje_espec_acre = 0;
        $puntaje_espec_egre = 0;
      }

      if ($tipo_estu == 'MAESTRIA') {
        if ($nivel == 'ACREDITADO') {
          $puntaje_maestria_acre = 2;
          $puntaje_maestria_egre = 0;
        } elseif ($nivel == 'EGRESADO') {
          $puntaje_maestria_egre = 1;
          $puntaje_maestria_acre = 0;
        }
      } else {
        $puntaje_maestria_acre = 0;
        $puntaje_maestria_egre = 0;
      }

      if ($tipo_estu == 'DOCTORADO') {
        if ($nivel == 'ACREDITADO') {
          $puntaje_doc_acre = 4;
          $puntaje_doc_egre = 0;
        } elseif ($nivel == 'EGRESADO') {
          $puntaje_doc_egre = 2;
          $puntaje_doc_acre = 0;
        }
      } else {
        $puntaje_doc_acre = 0;
        $puntaje_doc_egre = 0;
      }
    } else {
      $puntaje_espec_acre = 0;
      $puntaje_espec_egre = 0;
      $puntaje_maestria_acre = 0;
      $puntaje_maestria_egre = 0;
      $puntaje_doc_acre = 0;
      $puntaje_doc_egre = 0;
    }
    $puntos_total_form = $puntaje_nivel_estu + $puntaje_espec_acre + $puntaje_espec_egre + $puntaje_maestria_acre + $puntaje_maestria_egre + $puntaje_doc_acre + $puntaje_doc_egre;
    //CURSOS
    $consul_cursos = MYSQLI_query($con, "SELECT * FROM cursos_extra WHERE curso_extra_idpostulante ='$idpostulante' AND curso_validacion='VALIDO'");;
    $fil_cursos = mysqli_num_rows($consul_cursos);
    if ($fil_cursos > 0) {
      $horas_total_80 = 0;
      $puntos_total_3_menos = 0;
      $puntos_total_3_6 = 0;
      $puntos_total_6_9 = 0;
      $puntos_total_9_mas = 0;
      while ($ar_cursos = mysqli_fetch_array($consul_cursos)) {
        $horas = $ar_cursos['horas'];

        if ($horas >= 1 && $horas < 80) {
          $horas_total_80 = $horas_total_80 + $horas;
        }

        if ($horas >= 80 && $horas < 240) {
          $puntos_total_3_menos = $puntos_total_3_menos + 1;
        }

        if ($horas >= 240 && $horas < 480) {
          $puntos_total_3_6 = $puntos_total_3_6 + 1.5;
        }

        if ($horas >= 480 && $horas < 720) {
          $puntos_total_6_9 = $puntos_total_6_9 + 2;
        }

        if ($horas >= 720) {
          $puntos_total_9_mas = $puntos_total_9_mas + 2.5;
        }
      }
      if ($horas_total_80 >= 200) {
        $puntaje_cursillos = 1;
      } else {
        $puntaje_cursillos = $horas_total_80 / 200;
      }
      $puntos_total_cursos = $puntaje_cursillos + $puntos_total_3_menos + $puntos_total_3_6 + $puntos_total_6_9 + $puntos_total_9_mas;
    } else {
      $puntos_total_cursos = 0;
    }
    $consul_idioma = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante ='$idpostulante' AND idioma_validacion='VALIDO'");
    $fil_idioma = mysqli_num_rows($consul_idioma);
    if ($fil_idioma > 0 && $fil_idioma <= 2) {
      $puntos_idioma_comp = $fil_idioma;
    } elseif ($fil_idioma > 2) {
      $puntos_idioma_comp = 2;
    } else {
      $puntos_idioma_comp = 0;
    }
    $puntos_total_cursos_idioma = $puntos_total_cursos + $puntos_idioma_comp;
    if ($puntos_total_cursos_idioma >= 20) {
      $puntos_total_cursos = 20;
    }

    //EXPERIENCIA LABORAL
    $consul_expe = MYSQLI_query($con, "SELECT * FROM expe_4puntos INNER JOIN lugar_trabajo_gene 
    ON expe_4puntos.lugar_trab_general = lugar_trabajo_gene.idlugar_trabajo_gene WHERE expe_puntos_idpostulante ='$idpostulante' AND expe_validacion='VALIDO'");
    $fil_expe = mysqli_num_rows($consul_expe);
    if ($fil_expe > 0) {
      $anios_t = 0;
      $meses_t = 0;
      $dias_t = 0;
      $anios_3 = 0;
      $meses_3 = 0;
      $dias_3 = 0;
      $anios_1 = 0;
      $meses_1 = 0;
      $dias_1 = 0;
      while ($ar_expe = mysqli_fetch_array($consul_expe)) {
        $anios = $ar_expe['anios'];
        $meses = $ar_expe['meses'];
        $dias = $ar_expe['dias'];
        $idlugar_trabajo_gene = $ar_expe['idlugar_trabajo_gene'];

        if ($idlugar_trabajo_gene == 13 or $idlugar_trabajo_gene == 14 or $idlugar_trabajo_gene == 15) {
          $anios_t = $anios_t + $anios;
          $meses_t = $meses_t + $meses;
          $dias_t = $dias_t + $dias;
        } elseif ($idlugar_trabajo_gene == 16) {
          $anios_3 = $anios_3 + $anios;
          $meses_3 = $meses_3 + $meses;
          $dias_3 = $dias_3 + $dias;
        } elseif ($idlugar_trabajo_gene == 17) {
          $anios_1 = $anios_1 + $anios;
          $meses_1 = $meses_1 + $meses;
          $dias_1 = $dias_1 + $dias;
        }
      }
      //4 PUNTOS
      $anios_4_total = $anios_t * 4;
      $meses_4_total = $meses_t * 0.33;
      $dias_4_total = $dias_t * 0.011;
      $suma_4_total = $anios_4_total + $meses_4_total + $dias_4_total;
      //3 PUNTOS
      $anios_3_total = $anios_3 * 3;
      $meses_3_total = $meses_3 * 0.25;
      $dias_3_total = $dias_3 * 0.0083;
      $suma_3_total = $anios_3_total + $meses_3_total + $dias_3_total;
      //1 PUNTOS
      $anios_1_total = $anios_1 * 1;
      $meses_1_total = $meses_1 * 0.083;
      $dias_1_total = $dias_1 * 0.0028;
      $suma_1_total = $anios_1_total + $meses_1_total + $dias_1_total;
      //SUMA TOTAL
      $puntos_total_expe = $suma_4_total + $suma_3_total + $suma_1_total;
      if ($puntos_total_expe >= 25) {
        $puntos_total_expe = 25;
      }
    } else {
      $anios_4_total = 0;
      $meses_4_total = 0;
      $dias_4_total = 0;
      $suma_4_total = $anios_4_total + $meses_4_total + $dias_4_total;
      $anios_3_total = 0;
      $meses_3_total = 0;
      $dias_3_total = 0;
      $suma_3_total = $anios_3_total + $meses_3_total + $dias_3_total;
      $anios_1_total = 0;
      $meses_1_total = 0;
      $dias_1_total = 0;
      $suma_1_total = $anios_1_total + $meses_1_total + $dias_1_total;
      $puntos_total_cursos = 0;
    }
    //PUNTAJE TOTAL CV
    $puntaje_total = $puntos_total_form + $puntos_total_cursos_idioma + $puntos_total_cursos + $puntos_total_expe;
    if ($puntaje_total >= 55) {
      $estado_convocatoria = "APTO";
      $observaciones = "";
    } else {
      $estado_convocatoria = "NO APTO";
      $observaciones = "No sobrepaso el puntaje mínimo";
    }
    //PROCESO GUARDAR
    $consul_detalle_con = MYSQLI_query($con, "SELECT * FROM detalle_convocatoria WHERE iddetalle_convocatoria ='$iddetalle_convocatoria'");
    $ar_detalle_con = mysqli_fetch_array($consul_detalle_con);
    $estado_eva_curri_cas = $ar_detalle_con['estado_eva_curri_cas'];
    if ($estado_eva_curri_cas == 'NO AGREGADO') {
      if ($puntaje_nivel_estu == 45) {
        $sql = "INSERT INTO evaluacion_curri_cas (titulo_prof, titulo_espec, egre_espec, grado_maestria, egre_maestria, grado_doctorado, egre_doctorado,
        punt_total_forma, curso_max_tres, curso_tres_seis, curso_seis_nueve, curso_nueve_mas, cursillos, punt_total_cursos, idioma_compu, expe_laboral_cuatro, 
        expe_laboral_tres, expe_laboral_uno, punt_total_expe, puntaje_total_total) VALUES ('$puntaje_nivel_estu', '$puntaje_espec_acre', '$puntaje_espec_egre',
        '$puntaje_maestria_acre','$puntaje_maestria_egre','$puntaje_doc_acre','$puntaje_doc_egre','$puntos_total_form','$puntos_total_3_menos','$puntos_total_3_6',
        '$puntos_total_6_9','$puntos_total_9_mas', '$puntaje_cursillos','$puntos_total_cursos_idioma','$puntos_idioma_comp','$suma_4_total', '$suma_3_total', 
        '$suma_1_total', '$puntos_total_expe','$puntaje_total')";
        $result = mysqli_query($con, $sql);
        //GUARDAR ULTIMO ID REGISTRADO
        $query = mysqli_query($con, "SELECT MAX(id_eva_curricular) AS id FROM evaluacion_curri_cas");
        if ($row = mysqli_fetch_row($query)) {
          $id = trim($row[0]);
        }
        if ($result) {
          $actualizar_post = "UPDATE detalle_convocatoria SET estado_eva_curri_cas='AGREGADO', id_eva_curri_cas='$id', estado_conv_cas = '$estado_convocatoria',observaciones_detalle_cas = '$observaciones' WHERE iddetalle_convocatoria='$iddetalle_convocatoria'";
          $resultado_post = MYSQLI_query($con, $actualizar_post);
          if ($resultado_post) {
            $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se calculó correctamente los puntos de la calificación curricular.");
            echo json_encode($responder, JSON_UNESCAPED_UNICODE);
          } else {
            $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo calcular correctamente los puntos de la calificación curricular.");
            echo json_encode($responder, JSON_UNESCAPED_UNICODE);
          }
        }
      } else {
        $sql = "INSERT INTO evaluacion_curri_cas (titulo_espec, egre_espec, grado_maestria, egre_maestria, grado_doctorado, egre_doctorado,bachiller, punt_total_forma, curso_max_tres, curso_tres_seis, curso_seis_nueve, curso_nueve_mas, cursillos, punt_total_cursos, idioma_compu, expe_laboral_cuatro, expe_laboral_tres, expe_laboral_uno, punt_total_expe, puntaje_total_total) VALUES ('$puntaje_espec_acre', '$puntaje_espec_egre','$puntaje_maestria_acre','$puntaje_maestria_egre','$puntaje_doc_acre','$puntaje_doc_egre','$puntaje_nivel_estu', '$puntos_total_form','$puntos_total_3_menos','$puntos_total_3_6','$puntos_total_6_9','$puntos_total_9_mas', '$puntaje_cursillos','$puntos_total_cursos_idioma','$puntos_idioma_comp','$suma_4_total', '$suma_3_total', '$suma_1_total', '$puntos_total_expe','$puntaje_total')";
        $result = mysqli_query($con, $sql);
        //GUARDAR ULTIMO ID REGISTRADO
        $query = mysqli_query($con, "SELECT MAX(id_eva_curricular) AS id FROM evaluacion_curri_cas");
        if ($row = mysqli_fetch_row($query)) {
          $id = trim($row[0]);
        }
        if ($result) {
          $actualizar_post = "UPDATE detalle_convocatoria SET estado_eva_curri_cas='AGREGADO', id_eva_curri_cas='$id', estado_conv_cas = '$estado_convocatoria',observaciones_detalle_cas = '$observaciones' WHERE iddetalle_convocatoria='$iddetalle_convocatoria'";
          $resultado_post = MYSQLI_query($con, $actualizar_post);
          if ($resultado_post) {
            $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se calculó correctamente los puntos de la calificación curricular.");
            echo json_encode($responder, JSON_UNESCAPED_UNICODE);
          } else {
            $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "No se pudo calcular correctamente los puntos de la calificación curricular.");
            echo json_encode($responder, JSON_UNESCAPED_UNICODE);
          }
        } else {
          $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo guardar los valores en la tabla de evaluacion curricular");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        }
      }
    } else {
      $id_eva_curri_cas = $ar_detalle_con['id_eva_curri_cas'];
      if ($puntaje_nivel_estu == 45) {
        $sql = "UPDATE evaluacion_curri_cas SET titulo_prof = '$puntaje_nivel_estu', titulo_espec = '$puntaje_espec_acre', egre_espec = '$puntaje_espec_egre', grado_maestria = '$puntaje_maestria_acre', egre_maestria = '$puntaje_maestria_egre', grado_doctorado = '$puntaje_doc_acre', egre_doctorado = '$puntaje_doc_egre' ,punt_total_forma = '$puntos_total_form', curso_max_tres = '$puntos_total_3_menos', curso_tres_seis = '$puntos_total_3_6', curso_seis_nueve = '$puntos_total_6_9', curso_nueve_mas = '$puntos_total_9_mas', cursillos = '$puntaje_cursillos', punt_total_cursos = '$puntos_total_cursos_idioma', idioma_compu = '$puntos_idioma_comp', expe_laboral_cuatro = '$suma_4_total', expe_laboral_tres = '$suma_3_total', expe_laboral_uno = '$suma_1_total', punt_total_expe = '$puntos_total_expe', puntaje_total_total = '$puntaje_total' WHERE id_eva_curricular = '$id_eva_curri_cas'";
        $result = mysqli_query($con, $sql);
        if ($result) {
          $actualizar_post = "UPDATE detalle_convocatoria SET estado_conv_cas = '$estado_convocatoria',observaciones_detalle_cas = '$observaciones' WHERE iddetalle_convocatoria='$iddetalle_convocatoria'";
          $resultado_post = MYSQLI_query($con, $actualizar_post);
          $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se actualizó correctamente los puntos de la calificación curricular.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        } else {
          $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo actualizar correctamente los puntos de la calificación curricular.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        }
      } else {
        $sql = "UPDATE evaluacion_curri_cas SET titulo_espec = '$puntaje_espec_acre', egre_espec = '$puntaje_espec_egre', grado_maestria = '$puntaje_maestria_acre', egre_maestria = '$puntaje_maestria_egre', grado_doctorado = '$puntaje_doc_acre', egre_doctorado = '$puntaje_doc_egre', bachiller = '$puntaje_nivel_estu', punt_total_forma = '$puntos_total_form', curso_max_tres = '$puntos_total_3_menos', curso_tres_seis = '$puntos_total_3_6', curso_seis_nueve = '$puntos_total_6_9', curso_nueve_mas = '$puntos_total_9_mas', cursillos = '$puntaje_cursillos', punt_total_cursos = '$puntos_total_cursos_idioma', idioma_compu = '$puntos_idioma_comp', expe_laboral_cuatro = '$suma_4_total', expe_laboral_tres = '$suma_3_total', expe_laboral_uno = '$suma_1_total', punt_total_expe = '$puntos_total_expe', puntaje_total_total = '$puntaje_total' WHERE id_eva_curricular = '$id_eva_curri_cas'";
        $result = mysqli_query($con, $sql);
        if ($result) {
          $actualizar_post = "UPDATE detalle_convocatoria SET estado_conv_cas = '$estado_convocatoria',observaciones_detalle_cas = '$observaciones' WHERE iddetalle_convocatoria='$iddetalle_convocatoria'";
          $resultado_post = MYSQLI_query($con, $actualizar_post);
          $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se actualizó correctamente los puntos de la calificación curricular.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        } else {
          $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo actualizar correctamente los puntos de la calificación curricular.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        }
      }
    }
  } elseif ($nomb_cargo_espec == 'ASISTENTE ADMINISTRATIVO') {
    //FORMACION
    if ($nivel_estudios == 'BACHILLER') {
      $puntaje_nivel_estu = 48;
    } else {
      $puntaje_nivel_estu = 0;
      $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el BACHILLER requerido.");
      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
    }
    //POSTGRADO
    $consul_maestria = MYSQLI_query($con, "SELECT * FROM maestria_doc WHERE idpostulante_postulante ='$idpersonal' AND postgrado_validacion = 'VALIDO'");
    $ar_maestria = mysqli_fetch_array($consul_maestria);
    $fil_maestria = mysqli_num_rows($consul_maestria);
    if ($fil_maestria > 0) {
      $tipo_estu = $ar_maestria['tipo_estu'];
      $nivel = $ar_maestria['nivel'];

      $puntaje_espec_acre = 0;
      $puntaje_espec_egre = 0;

      if ($tipo_estu == 'MAESTRIA') {
        if ($nivel == 'ACREDITADO') {
          $puntaje_maestria_acre = 2;
          $puntaje_maestria_egre = 0;
        } elseif ($nivel == 'EGRESADO') {
          $puntaje_maestria_egre = 1;
          $puntaje_maestria_acre = 0;
        }
      } else {
        $puntaje_maestria_acre = 0;
        $puntaje_maestria_egre = 0;
      }

      $puntaje_doc_acre = 0;
      $puntaje_doc_egre = 0;
    } else {
      $puntaje_espec_acre = 0;
      $puntaje_espec_egre = 0;
      $puntaje_maestria_acre = 0;
      $puntaje_maestria_egre = 0;
      $puntaje_doc_acre = 0;
      $puntaje_doc_egre = 0;
    }
    $puntos_total_form = $puntaje_nivel_estu + $puntaje_espec_acre + $puntaje_espec_egre + $puntaje_maestria_acre + $puntaje_maestria_egre + $puntaje_doc_acre + $puntaje_doc_egre;
    //CURSOS
    $consul_cursos = MYSQLI_query($con, "SELECT * FROM cursos_extra WHERE curso_extra_idpostulante ='$idpostulante' AND curso_validacion='VALIDO'");;
    $fil_cursos = mysqli_num_rows($consul_cursos);
    if ($fil_cursos > 0) {
      $horas_total_40 = 0;
      $horas_total_80 = 0;
      $puntos_total_3_menos = 0;
      $puntos_total_3_6 = 0;
      $puntos_total_6_9 = 0;
      $puntos_total_9_mas = 0;
      while ($ar_cursos = mysqli_fetch_array($consul_cursos)) {
        $horas = $ar_cursos['horas'];

        if ($horas >= 1 && $horas < 41) {
          $horas_total_40 = $horas_total_40 + $horas;
        }

        if ($horas >= 80 && $horas < 240) {
          $puntos_total_3_menos = $puntos_total_3_menos + 2;
        }

        if ($horas >= 240 && $horas < 480) {
          $puntos_total_3_6 = $puntos_total_3_6 + 3.5;
        }

        if ($horas >= 480 && $horas < 720) {
          $puntos_total_6_9 = $puntos_total_6_9 + 5;
        }

        if ($horas >= 720) {
          $puntos_total_9_mas = $puntos_total_9_mas + 6.5;
        }
      }
      if ($horas_total_40 >= 200) {
        $puntaje_cursillos = 5;
      } else {
        $puntaje_cursillos = $horas_total_80 / 40;
      }
      $puntos_total_cursos = $puntaje_cursillos + $puntos_total_3_menos + $puntos_total_3_6 + $puntos_total_6_9 + $puntos_total_9_mas;
    } else {
      $puntos_total_cursos = 0;
    }
    $consul_idioma = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante ='$idpostulante' AND idioma_validacion='VALIDO'");
    $fil_idioma = mysqli_num_rows($consul_idioma);
    if ($fil_idioma > 0 && $fil_idioma <= 2) {
      $puntos_idioma_comp = $fil_idioma * 2.5;
    } elseif ($fil_idioma > 2) {
      $puntos_idioma_comp = 5;
    } else {
      $puntos_idioma_comp = 0;
    }
    $puntos_total_cursos_idioma = $puntos_total_cursos + $puntos_idioma_comp;
    if ($puntos_total_cursos_idioma >= 30) {
      $puntos_total_cursos = 30;
    }

    //EXPERIENCIA LABORAL
    $consul_expe = MYSQLI_query($con, "SELECT * FROM expe_4puntos INNER JOIN lugar_trabajo_gene 
    ON expe_4puntos.lugar_trab_general = lugar_trabajo_gene.idlugar_trabajo_gene WHERE expe_puntos_idpostulante ='$idpostulante' AND expe_validacion='VALIDO'");
    $fil_expe = mysqli_num_rows($consul_expe);
    if ($fil_expe > 0) {
      $anios_t = 0;
      $meses_t = 0;
      $dias_t = 0;
      $anios_3 = 0;
      $meses_3 = 0;
      $dias_3 = 0;
      $anios_1 = 0;
      $meses_1 = 0;
      $dias_1 = 0;
      while ($ar_expe = mysqli_fetch_array($consul_expe)) {
        $anios = $ar_expe['anios'];
        $meses = $ar_expe['meses'];
        $dias = $ar_expe['dias'];
        $idlugar_trabajo_gene = $ar_expe['idlugar_trabajo_gene'];

        if ($idlugar_trabajo_gene == 13 or $idlugar_trabajo_gene == 14 or $idlugar_trabajo_gene == 15) {
          $anios_t = $anios_t + $anios;
          $meses_t = $meses_t + $meses;
          $dias_t = $dias_t + $dias;
        } elseif ($idlugar_trabajo_gene == 16) {
          $anios_3 = $anios_3 + $anios;
          $meses_3 = $meses_3 + $meses;
          $dias_3 = $dias_3 + $dias;
        } elseif ($idlugar_trabajo_gene == 17) {
          $anios_1 = $anios_1 + $anios;
          $meses_1 = $meses_1 + $meses;
          $dias_1 = $dias_1 + $dias;
        }
      }
      //4 PUNTOS
      $anios_4_total = $anios_t * 4;
      $meses_4_total = $meses_t * 0.33;
      $dias_4_total = $dias_t * 0.011;
      $suma_4_total = $anios_4_total + $meses_4_total + $dias_4_total;
      //3 PUNTOS
      $anios_3_total = $anios_3 * 3;
      $meses_3_total = $meses_3 * 0.25;
      $dias_3_total = $dias_3 * 0.0083;
      $suma_3_total = $anios_3_total + $meses_3_total + $dias_3_total;
      //1 PUNTOS
      $anios_1_total = $anios_1 * 1;
      $meses_1_total = $meses_1 * 0.083;
      $dias_1_total = $dias_1 * 0.0028;
      $suma_1_total = $anios_1_total + $meses_1_total + $dias_1_total;
      //SUMA TOTAL
      $puntos_total_cursos = $suma_4_total + $suma_3_total + $suma_1_total;
      if ($puntos_total_cursos >= 20) {
        $puntos_total_cursos = 20;
      }
    } else {
      $anios_4_total = 0;
      $meses_4_total = 0;
      $dias_4_total = 0;
      $suma_4_total = $anios_4_total + $meses_4_total + $dias_4_total;
      $anios_3_total = 0;
      $meses_3_total = 0;
      $dias_3_total = 0;
      $suma_3_total = $anios_3_total + $meses_3_total + $dias_3_total;
      $anios_1_total = 0;
      $meses_1_total = 0;
      $dias_1_total = 0;
      $suma_1_total = $anios_1_total + $meses_1_total + $dias_1_total;
      $puntos_total_cursos = 0;
    }
    //PUNTAJE TOTAL CV
    $puntaje_total = $puntos_total_form + $puntos_total_cursos_idioma + $puntos_total_cursos;
    if ($puntaje_total >= 55) {
      $estado_convocatoria = "APTO";
      $observaciones = "";
    } else {
      $estado_convocatoria = "NO APTO";
      $observaciones = "No sobrepaso el puntaje mínimo";
    }
    //PROCESO GUARDAR
    $consul_detalle_con = MYSQLI_query($con, "SELECT * FROM detalle_convocatoria WHERE iddetalle_convocatoria ='$iddetalle_convocatoria'");
    $ar_detalle_con = mysqli_fetch_array($consul_detalle_con);
    $estado_eva_curri_cas = $ar_detalle_con['estado_eva_curri_cas'];
    if ($estado_eva_curri_cas == 'NO AGREGADO') {
      $sql = "INSERT INTO evaluacion_curri_cas (titulo_espec, egre_espec, grado_maestria, egre_maestria, grado_doctorado, egre_doctorado,bachiller,punt_total_forma, curso_max_tres, curso_tres_seis, curso_seis_nueve, curso_nueve_mas, cursillos, punt_total_cursos, idioma_compu, expe_laboral_cuatro, expe_laboral_tres, expe_laboral_uno, punt_total_expe,puntaje_total_total) VALUES ('$puntaje_espec_acre', '$puntaje_espec_egre','$puntaje_maestria_acre','$puntaje_maestria_egre','$puntaje_doc_acre','$puntaje_doc_egre','$puntaje_nivel_estu','$puntos_total_form','$puntos_total_3_menos','$puntos_total_3_6','$puntos_total_6_9','$puntos_total_9_mas', '$puntaje_cursillos','$puntos_total_cursos_idioma','$puntos_idioma_comp','$suma_4_total', '$suma_3_total', '$suma_1_total', '$puntos_total_expe','$puntaje_total')";
      $result = mysqli_query($con, $sql);
      //GUARDAR ULTIMO ID REGISTRADO
      $query = mysqli_query($con, "SELECT MAX(id_eva_curricular) AS id FROM evaluacion_curri_cas");
      if ($row = mysqli_fetch_row($query)) {
        $id = trim($row[0]);
      }
      if ($result) {
        $actualizar_post = "UPDATE detalle_convocatoria SET estado_eva_curri_cas='AGREGADO', id_eva_curri_cas='$id', estado_conv_cas = '$estado_convocatoria',observaciones_detalle_cas = '$observaciones' WHERE iddetalle_convocatoria='$iddetalle_convocatoria'";
        $resultado_post = MYSQLI_query($con, $actualizar_post);
        if ($resultado_post) {
          $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se calculó correctamente los puntos de la calificación curricular.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        } else {
          $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo calcular correctamente los puntos de la calificación curricular.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        }
      } else {
        $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo agregar los datos a la tabla de evaluacion curricular.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      }
    } else {
      $id_eva_curri_cas = $ar_detalle_con['id_eva_curri_cas'];
      $sql = "UPDATE evaluacion_curri_cas SET titulo_prof = '$puntaje_nivel_estu', titulo_espec = '$puntaje_espec_acre', egre_espec = '$puntaje_espec_egre', grado_maestria = '$puntaje_maestria_acre', egre_maestria = '$puntaje_maestria_egre', grado_doctorado = '$puntaje_doc_acre', egre_doctorado = '$puntaje_doc_egre' ,bachiller = '$puntaje_nivel_estu', punt_total_forma = '$puntos_total_form', curso_max_tres = '$puntos_total_3_menos', curso_tres_seis = '$puntos_total_3_6', curso_seis_nueve = '$puntos_total_6_9', curso_nueve_mas = '$puntos_total_9_mas', cursillos = '$puntaje_cursillos', punt_total_cursos = '$puntos_total_cursos_idioma', idioma_compu = '$puntos_idioma_comp', expe_laboral_cuatro = '$suma_4_total', expe_laboral_tres = '$suma_3_total', expe_laboral_uno = '$suma_1_total', punt_total_expe = '$puntos_total_expe',puntaje_total_total = '$puntaje_total' WHERE id_eva_curricular = '$id_eva_curri_cas'";
      $result = mysqli_query($con, $sql);
      if ($result) {
        $actualizar_post = "UPDATE detalle_convocatoria SET estado_conv_cas = '$estado_convocatoria',observaciones_detalle_cas = '$observaciones' WHERE iddetalle_convocatoria='$iddetalle_convocatoria'";
        $resultado_post = MYSQLI_query($con, $actualizar_post);
        $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se actualizó correctamente los puntos de la calificación curricular.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      } else {
        $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo actualizar correctamente los puntos de la calificación curricular.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      }
    }
  } elseif ($nomb_cargo_espec == 'TECNICO EN ENFERMERIA') {
    //FORMACION
    if ($nivel_estudios == 'TITULADO TECNICO') {
      $puntaje_nivel_estu = 50;
    } else {
      $puntaje_nivel_estu = 0;
      $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el TITULO DE TÉCNICO requerido.");
      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
    }
    //POSTGRADO
    $consul_maestria = MYSQLI_query($con, "SELECT * FROM maestria_doc WHERE idpostulante_postulante ='$idpersonal' AND postgrado_validacion = 'VALIDO'");
    $ar_maestria = mysqli_fetch_array($consul_maestria);
    $fil_maestria = mysqli_num_rows($consul_maestria);
    if ($fil_maestria > 0) {
      $puntaje_espec_acre = 0;
      $puntaje_espec_egre = 0;

      $puntaje_maestria_acre = 0;
      $puntaje_maestria_egre = 0;

      $puntaje_doc_acre = 0;
      $puntaje_doc_egre = 0;
    } else {
      $puntaje_espec_acre = 0;
      $puntaje_espec_egre = 0;
      $puntaje_maestria_acre = 0;
      $puntaje_maestria_egre = 0;
      $puntaje_doc_acre = 0;
      $puntaje_doc_egre = 0;
    }
    $puntos_total_form = $puntaje_nivel_estu + $puntaje_espec_acre + $puntaje_espec_egre + $puntaje_maestria_acre + $puntaje_maestria_egre + $puntaje_doc_acre + $puntaje_doc_egre;
    //CURSOS
    $consul_cursos = MYSQLI_query($con, "SELECT * FROM cursos_extra WHERE curso_extra_idpostulante ='$idpostulante' AND curso_validacion='VALIDO'");;
    $fil_cursos = mysqli_num_rows($consul_cursos);
    if ($fil_cursos > 0) {
      $horas_total_40 = 0;
      $horas_total_80 = 0;
      $puntos_total_3_menos = 0;
      $puntos_total_3_6 = 0;
      $puntos_total_6_9 = 0;
      $puntos_total_9_mas = 0;
      while ($ar_cursos = mysqli_fetch_array($consul_cursos)) {
        $horas = $ar_cursos['horas'];

        if ($horas >= 1 && $horas < 41) {
          $horas_total_40 = $horas_total_40 + $horas;
        }

        if ($horas >= 80 && $horas < 240) {
          $puntos_total_3_menos = $puntos_total_3_menos + 2;
        }

        if ($horas >= 240 && $horas < 480) {
          $puntos_total_3_6 = $puntos_total_3_6 + 4;
        }

        if ($horas >= 480 && $horas < 720) {
          $puntos_total_6_9 = $puntos_total_6_9 + 6;
        }

        if ($horas >= 720) {
          $puntos_total_9_mas = $puntos_total_9_mas + 8;
        }
      }
      if ($horas_total_40 >= 200) {
        $puntaje_cursillos = 5;
      } else {
        $puntaje_cursillos = $horas_total_80 / 40;
      }
      $puntos_total_cursos = $puntaje_cursillos + $puntos_total_3_menos + $puntos_total_3_6 + $puntos_total_6_9 + $puntos_total_9_mas;
    } else {
      $puntos_total_cursos = 0;
    }
    $consul_idioma = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante ='$idpostulante' AND idioma_validacion='VALIDO'");
    $fil_idioma = mysqli_num_rows($consul_idioma);
    if ($fil_idioma > 0 && $fil_idioma <= 2) {
      $puntos_idioma_comp = $fil_idioma * 2.5;
    } elseif ($fil_idioma > 2) {
      $puntos_idioma_comp = 5;
    } else {
      $puntos_idioma_comp = 0;
    }
    $puntos_total_cursos_idioma = $puntos_total_cursos + $puntos_idioma_comp;
    if ($puntos_total_cursos_idioma >= 30) {
      $puntos_total_cursos = 30;
    }
    //EXPERIENCIA LABORAL
    $consul_expe = MYSQLI_query($con, "SELECT * FROM expe_4puntos INNER JOIN lugar_trabajo_gene 
    ON expe_4puntos.lugar_trab_general = lugar_trabajo_gene.idlugar_trabajo_gene WHERE expe_puntos_idpostulante ='$idpostulante' AND expe_validacion='VALIDO'");
    $fil_expe = mysqli_num_rows($consul_expe);
    if ($fil_expe > 0) {
      $anios_t = 0;
      $meses_t = 0;
      $dias_t = 0;
      $anios_3 = 0;
      $meses_3 = 0;
      $dias_3 = 0;
      $anios_1 = 0;
      $meses_1 = 0;
      $dias_1 = 0;
      while ($ar_expe = mysqli_fetch_array($consul_expe)) {
        $anios = $ar_expe['anios'];
        $meses = $ar_expe['meses'];
        $dias = $ar_expe['dias'];
        $idlugar_trabajo_gene = $ar_expe['idlugar_trabajo_gene'];

        if ($idlugar_trabajo_gene == 1 or $idlugar_trabajo_gene == 2 or $idlugar_trabajo_gene == 3 or $idlugar_trabajo_gene == 4 or   $idlugar_trabajo_gene == 5) {
          $anios_t = $anios_t + $anios;
          $meses_t = $meses_t + $meses;
          $dias_t = $dias_t + $dias;
        } elseif ($idlugar_trabajo_gene == 6 or $idlugar_trabajo_gene == 7 or $idlugar_trabajo_gene == 8 or $idlugar_trabajo_gene == 9 or $idlugar_trabajo_gene == 10 or $idlugar_trabajo_gene == 11) {
          $anios_3 = $anios_3 + $anios;
          $meses_3 = $meses_3 + $meses;
          $dias_3 = $dias_3 + $dias;
        } elseif ($idlugar_trabajo_gene == 12) {
          $anios_1 = $anios_1 + $anios;
          $meses_1 = $meses_1 + $meses;
          $dias_1 = $dias_1 + $dias;
        }
      }
      //4 PUNTOS
      $anios_4_total = $anios_t * 4;
      $meses_4_total = $meses_t * 0.33;
      $dias_4_total = $dias_t * 0.011;
      $suma_4_total = $anios_4_total + $meses_4_total + $dias_4_total;
      //3 PUNTOS
      $anios_3_total = $anios_3 * 3;
      $meses_3_total = $meses_3 * 0.25;
      $dias_3_total = $dias_3 * 0.0083;
      $suma_3_total = $anios_3_total + $meses_3_total + $dias_3_total;
      //1 PUNTOS
      $anios_1_total = $anios_1 * 1;
      $meses_1_total = $meses_1 * 0.083;
      $dias_1_total = $dias_1 * 0.0028;
      $suma_1_total = $anios_1_total + $meses_1_total + $dias_1_total;
      //SUMA TOTAL
      $puntos_total_expe = $suma_4_total + $suma_3_total + $suma_1_total;
      if ($puntos_total_expe >= 20) {
        $puntos_total_expe = 20;
      }
    } else {
      $anios_4_total = 0;
      $meses_4_total = 0;
      $dias_4_total = 0;
      $suma_4_total = $anios_4_total + $meses_4_total + $dias_4_total;
      $anios_3_total = 0;
      $meses_3_total = 0;
      $dias_3_total = 0;
      $suma_3_total = $anios_3_total + $meses_3_total + $dias_3_total;
      $anios_1_total = 0;
      $meses_1_total = 0;
      $dias_1_total = 0;
      $suma_1_total = $anios_1_total + $meses_1_total + $dias_1_total;
      $puntos_total_expe = 0;
    }
    //PUNTAJE TOTAL CV
    $puntaje_total = $puntos_total_form + $puntos_total_cursos_idioma + $puntos_total_cursos + $puntos_total_expe;
    if ($puntaje_total >= 55) {
      $estado_convocatoria = "APTO";
      $observaciones = "";
    } else {
      $estado_convocatoria = "NO APTO";
      $observaciones = "No sobrepaso el puntaje mínimo";
    }
    //PROCESO GUARDAR
    $consul_detalle_con = MYSQLI_query($con, "SELECT * FROM detalle_convocatoria WHERE iddetalle_convocatoria ='$iddetalle_convocatoria'");
    $ar_detalle_con = mysqli_fetch_array($consul_detalle_con);
    $estado_eva_curri_cas = $ar_detalle_con['estado_eva_curri_cas'];
    if ($estado_eva_curri_cas == 'NO AGREGADO') {
      $sql = "INSERT INTO evaluacion_curri_cas (titulo_espec, egre_espec, grado_maestria, egre_maestria, grado_doctorado, egre_doctorado,titulo_tecno,
      punt_total_forma, curso_max_tres, curso_tres_seis, curso_seis_nueve, curso_nueve_mas, cursillos, punt_total_cursos, idioma_compu, expe_laboral_cuatro, 
      expe_laboral_tres, expe_laboral_uno, punt_total_expe,puntaje_total_total) VALUES ('$puntaje_espec_acre', '$puntaje_espec_egre','$puntaje_maestria_acre',
      '$puntaje_maestria_egre','$puntaje_doc_acre','$puntaje_doc_egre','$puntaje_nivel_estu','$puntos_total_form','$puntos_total_3_menos','$puntos_total_3_6',
      '$puntos_total_6_9','$puntos_total_9_mas', '$puntaje_cursillos','$puntos_total_cursos_idioma','$puntos_idioma_comp','$suma_4_total', '$suma_3_total', 
      '$suma_1_total', '$puntos_total_expe','$puntaje_total')";
      $result = mysqli_query($con, $sql);
      //GUARDAR ULTIMO ID REGISTRADO
      $query = mysqli_query($con, "SELECT MAX(id_eva_curricular) AS id FROM evaluacion_curri_cas");
      if ($row = mysqli_fetch_row($query)) {
        $id = trim($row[0]);
      }
      if ($result) {
        $actualizar_post = "UPDATE detalle_convocatoria SET estado_eva_curri_cas='AGREGADO', id_eva_curri_cas='$id', estado_conv_cas = '$estado_convocatoria',observaciones_detalle_cas = '$observaciones' WHERE iddetalle_convocatoria='$iddetalle_convocatoria'";
        $resultado_post = MYSQLI_query($con, $actualizar_post);
        $responder =  array('r' => 1, 'dni' => $dni,  'mensaje' => "Se calculó correctamente los puntos de la calificación curricular.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      } else {
        $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo calcular correctamente los puntos de la calificación curricular.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      }
    } else {
      $id_eva_curri_cas = $ar_detalle_con['id_eva_curri_cas'];
      $sql = "UPDATE evaluacion_curri_cas SET  titulo_espec = '$puntaje_espec_acre', egre_espec = '$puntaje_espec_egre', grado_maestria = '$puntaje_maestria_acre', egre_maestria = '$puntaje_maestria_egre', grado_doctorado = '$puntaje_doc_acre', egre_doctorado = '$puntaje_doc_egre' ,titulo_tecno = '$puntaje_nivel_estu', punt_total_forma = '$puntos_total_form', curso_max_tres = '$puntos_total_3_menos', curso_tres_seis = '$puntos_total_3_6', curso_seis_nueve = '$puntos_total_6_9', curso_nueve_mas = '$puntos_total_9_mas', cursillos = '$puntaje_cursillos', punt_total_cursos = '$puntos_total_cursos_idioma', idioma_compu = '$puntos_idioma_comp', expe_laboral_cuatro = '$suma_4_total', expe_laboral_tres = '$suma_3_total', expe_laboral_uno = '$suma_1_total', punt_total_expe = '$puntos_total_expe', puntaje_total_total = '$puntaje_total' WHERE id_eva_curricular = '$id_eva_curri_cas'";
      $result = mysqli_query($con, $sql);
      if ($result) {
        $actualizar_post = "UPDATE detalle_convocatoria SET estado_conv_cas = '$estado_convocatoria',observaciones_detalle_cas = '$observaciones' WHERE iddetalle_convocatoria='$iddetalle_convocatoria'";
        $resultado_post = MYSQLI_query($con, $actualizar_post);
        $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se actualizó correctamente los puntos de la calificación curricular.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      } else {
        $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo actualizar correctamente los puntos de la calificación curricular.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      }
    }
  } elseif ($nomb_cargo_espec == 'TECNICO EN INFORMATICA - COMPUTACION' or $nomb_cargo_espec == 'SECRETARIA' or $nomb_cargo_espec == 'TECNICO ADMINISTRATIVO') {
    //FORMACION
    if ($nivel_estudios == 'TITULADO TECNICO') {
      $puntaje_nivel_estu = 50;
    } elseif ($nivel_estudios == 'EGRESADO') {
      $puntaje_nivel_estu = 48;
    } else {
      $puntaje_nivel_estu = 0;
      $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el TÍTULO TÉCNICO o EGRESADO requerido.");
      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
    }
    //POSTGRADO
    $consul_maestria = MYSQLI_query($con, "SELECT * FROM maestria_doc WHERE idpostulante_postulante ='$idpersonal' AND postgrado_validacion = 'VALIDO'");
    $ar_maestria = mysqli_fetch_array($consul_maestria);
    $fil_maestria = mysqli_num_rows($consul_maestria);
    if ($fil_maestria > 0) {
      $puntaje_espec_acre = 0;
      $puntaje_espec_egre = 0;

      $puntaje_maestria_acre = 0;
      $puntaje_maestria_egre = 0;

      $puntaje_doc_acre = 0;
      $puntaje_doc_egre = 0;
    } else {
      $puntaje_espec_acre = 0;
      $puntaje_espec_egre = 0;
      $puntaje_maestria_acre = 0;
      $puntaje_maestria_egre = 0;
      $puntaje_doc_acre = 0;
      $puntaje_doc_egre = 0;
    }
    $puntos_total_form = $puntaje_nivel_estu + $puntaje_espec_acre + $puntaje_espec_egre + $puntaje_maestria_acre + $puntaje_maestria_egre + $puntaje_doc_acre + $puntaje_doc_egre;
    //CURSOS
    $consul_cursos = MYSQLI_query($con, "SELECT * FROM cursos_extra WHERE curso_extra_idpostulante ='$idpostulante' AND curso_validacion='VALIDO'");;
    $fil_cursos = mysqli_num_rows($consul_cursos);
    if ($fil_cursos > 0) {
      $horas_total_40 = 0;
      $horas_total_80 = 0;
      $puntos_total_3_menos = 0;
      $puntos_total_3_6 = 0;
      $puntos_total_6_9 = 0;
      $puntos_total_9_mas = 0;
      while ($ar_cursos = mysqli_fetch_array($consul_cursos)) {
        $horas = $ar_cursos['horas'];

        if ($horas >= 1 && $horas < 41) {
          $horas_total_40 = $horas_total_40 + $horas;
        }

        if ($horas >= 80 && $horas < 240) {
          $puntos_total_3_menos = $puntos_total_3_menos + 2;
        }

        if ($horas >= 240 && $horas < 480) {
          $puntos_total_3_6 = $puntos_total_3_6 + 4;
        }

        if ($horas >= 480 && $horas < 720) {
          $puntos_total_6_9 = $puntos_total_6_9 + 6;
        }

        if ($horas >= 720) {
          $puntos_total_9_mas = $puntos_total_9_mas + 8;
        }
      }
      if ($horas_total_40 >= 200) {
        $puntaje_cursillos = 5;
      } else {
        $puntaje_cursillos = $horas_total_80 / 40;
      }
      $puntos_total_cursos = $puntaje_cursillos + $puntos_total_3_menos + $puntos_total_3_6 + $puntos_total_6_9 + $puntos_total_9_mas;
    } else {
      $puntos_total_cursos = 0;
    }
    $consul_idioma = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante ='$idpostulante' AND idioma_validacion='VALIDO'");
    $fil_idioma = mysqli_num_rows($consul_idioma);
    if ($fil_idioma > 0 && $fil_idioma <= 2) {
      $puntos_idioma_comp = $fil_idioma * 2.5;
    } elseif ($fil_idioma > 2) {
      $puntos_idioma_comp = 5;
    } else {
      $puntos_idioma_comp = 0;
    }
    $puntos_total_cursos_idioma = $puntos_total_cursos + $puntos_idioma_comp;
    if ($puntos_total_cursos_idioma >= 30) {
      $puntos_total_cursos = 30;
    }
    //EXPERIENCIA LABORAL
    $consul_expe = MYSQLI_query($con, "SELECT * FROM expe_4puntos INNER JOIN lugar_trabajo_gene 
    ON expe_4puntos.lugar_trab_general = lugar_trabajo_gene.idlugar_trabajo_gene WHERE expe_puntos_idpostulante ='$idpostulante' AND expe_validacion='VALIDO'");
    $fil_expe = mysqli_num_rows($consul_expe);
    if ($fil_expe > 0) {
      $anios_t = 0;
      $meses_t = 0;
      $dias_t = 0;
      $anios_3 = 0;
      $meses_3 = 0;
      $dias_3 = 0;
      $anios_1 = 0;
      $meses_1 = 0;
      $dias_1 = 0;
      while ($ar_expe = mysqli_fetch_array($consul_expe)) {
        $anios = $ar_expe['anios'];
        $meses = $ar_expe['meses'];
        $dias = $ar_expe['dias'];
        $idlugar_trabajo_gene = $ar_expe['idlugar_trabajo_gene'];

        if ($idlugar_trabajo_gene == 13 or $idlugar_trabajo_gene == 14 or $idlugar_trabajo_gene == 15) {
          $anios_t = $anios_t + $anios;
          $meses_t = $meses_t + $meses;
          $dias_t = $dias_t + $dias;
        } elseif ($idlugar_trabajo_gene == 16) {
          $anios_3 = $anios_3 + $anios;
          $meses_3 = $meses_3 + $meses;
          $dias_3 = $dias_3 + $dias;
        } elseif ($idlugar_trabajo_gene == 17) {
          $anios_1 = $anios_1 + $anios;
          $meses_1 = $meses_1 + $meses;
          $dias_1 = $dias_1 + $dias;
        }
      }
      //4 PUNTOS
      $anios_4_total = $anios_t * 4;
      $meses_4_total = $meses_t * 0.33;
      $dias_4_total = $dias_t * 0.011;
      $suma_4_total = $anios_4_total + $meses_4_total + $dias_4_total;
      //3 PUNTOS
      $anios_3_total = $anios_3 * 3;
      $meses_3_total = $meses_3 * 0.25;
      $dias_3_total = $dias_3 * 0.0083;
      $suma_3_total = $anios_3_total + $meses_3_total + $dias_3_total;
      //1 PUNTOS
      $anios_1_total = $anios_1 * 1;
      $meses_1_total = $meses_1 * 0.083;
      $dias_1_total = $dias_1 * 0.0028;
      $suma_1_total = $anios_1_total + $meses_1_total + $dias_1_total;
      //SUMA TOTAL
      $puntos_total_expe = $suma_4_total + $suma_3_total + $suma_1_total;
      if ($puntos_total_expe >= 20) {
        $puntos_total_expe = 20;
      }
    } else {
      $anios_4_total = 0;
      $meses_4_total = 0;
      $dias_4_total = 0;
      $suma_4_total = $anios_4_total + $meses_4_total + $dias_4_total;
      $anios_3_total = 0;
      $meses_3_total = 0;
      $dias_3_total = 0;
      $suma_3_total = $anios_3_total + $meses_3_total + $dias_3_total;
      $anios_1_total = 0;
      $meses_1_total = 0;
      $dias_1_total = 0;
      $suma_1_total = $anios_1_total + $meses_1_total + $dias_1_total;
      $puntos_total_cursos = 0;
    }
    //PUNTAJE TOTAL CV
    $puntaje_total = $puntos_total_form + $puntos_total_cursos_idioma + $puntos_total_cursos + $puntos_total_expe;
    if ($puntaje_total >= 55) {
      $estado_convocatoria = "APTO";
      $observaciones = "";
    } else {
      $estado_convocatoria = "NO APTO";
      $observaciones = "No sobrepaso el puntaje mínimo";
    }
    //PROCESO GUARDAR
    $consul_detalle_con = MYSQLI_query($con, "SELECT * FROM detalle_convocatoria WHERE iddetalle_convocatoria ='$iddetalle_convocatoria'");
    $ar_detalle_con = mysqli_fetch_array($consul_detalle_con);
    $estado_eva_curri_cas = $ar_detalle_con['estado_eva_curri_cas'];
    if ($estado_eva_curri_cas == 'NO AGREGADO') {
      if ($puntaje_nivel_estu == 50) {
        $sql = "INSERT INTO evaluacion_curri_cas (titulo_espec, egre_espec, grado_maestria, egre_maestria, grado_doctorado, egre_doctorado,titulo_tecno,
        punt_total_forma, curso_max_tres, curso_tres_seis, curso_seis_nueve, curso_nueve_mas, cursillos, punt_total_cursos, idioma_compu, expe_laboral_cuatro, 
        expe_laboral_tres, expe_laboral_uno, punt_total_expe,puntaje_total_total) VALUES ('$puntaje_espec_acre','$puntaje_espec_egre','$puntaje_maestria_acre',
        '$puntaje_maestria_egre','$puntaje_doc_acre','$puntaje_doc_egre','$puntaje_nivel_estu','$puntos_total_form','$puntos_total_3_menos','$puntos_total_3_6',
        '$puntos_total_6_9','$puntos_total_9_mas', '$puntaje_cursillos','$puntos_total_cursos_idioma','$puntos_idioma_comp','$suma_4_total', '$suma_3_total', 
        '$suma_1_total', '$puntos_total_expe','$puntaje_total')";
        $result = mysqli_query($con, $sql);
        //GUARDAR ULTIMO ID REGISTRADO
        $query = mysqli_query($con, "SELECT MAX(id_eva_curricular) AS id FROM evaluacion_curri_cas");
        if ($row = mysqli_fetch_row($query)) {
          $id = trim($row[0]);
        }
        if ($result) {
          $actualizar_post = "UPDATE detalle_convocatoria SET estado_eva_curri_cas='AGREGADO', id_eva_curri_cas='$id', estado_conv_cas = '$estado_convocatoria',observaciones_detalle_cas = '$observaciones' WHERE iddetalle_convocatoria='$iddetalle_convocatoria'";
          $resultado_post = MYSQLI_query($con, $actualizar_post);
          if ($resultado_post) {
            $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se calculó correctamente los puntos de la calificación curricular.");
            echo json_encode($responder, JSON_UNESCAPED_UNICODE);
          } else {
            $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo calcular correctamente los puntos de la calificación curricular.");
            echo json_encode($responder, JSON_UNESCAPED_UNICODE);
          }
        } else {
          $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al insertar los datos en la tabla evaluacion curricular cas.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        }
      } else {
        $sql = "INSERT INTO evaluacion_curri_cas (titulo_espec,egre_espec, grado_maestria, egre_maestria, grado_doctorado, egre_doctorado,egresado_univ,punt_total_forma, curso_max_tres, curso_tres_seis, curso_seis_nueve, curso_nueve_mas, cursillos, punt_total_cursos, idioma_compu, expe_laboral_cuatro, expe_laboral_tres, expe_laboral_uno, punt_total_expe,puntaje_total_total) VALUES ('$puntaje_espec_acre','$puntaje_espec_egre','$puntaje_maestria_acre','$puntaje_maestria_egre','$puntaje_doc_acre','$puntaje_doc_egre','$puntaje_nivel_estu','$puntos_total_form','$puntos_total_3_menos','$puntos_total_3_6','$puntos_total_6_9','$puntos_total_9_mas', '$puntaje_cursillos','$puntos_total_cursos_idioma','$puntos_idioma_comp','$suma_4_total', '$suma_3_total', '$suma_1_total', '$puntos_total_expe','$puntaje_total')";
        $result = mysqli_query($con, $sql);
        //GUARDAR ULTIMO ID REGISTRADO
        $query = mysqli_query($con, "SELECT MAX(id_eva_curricular) AS id FROM evaluacion_curri_cas");
        if ($row = mysqli_fetch_row($query)) {
          $id = trim($row[0]);
        }
        if ($result) {
          $actualizar_post = "UPDATE detalle_convocatoria SET estado_eva_curri_cas='AGREGADO', id_eva_curri_cas='$id', estado_conv_cas = '$estado_convocatoria',observaciones_detalle_cas = '$observaciones' WHERE iddetalle_convocatoria='$iddetalle_convocatoria'";
          $resultado_post = MYSQLI_query($con, $actualizar_post);
          if ($resultado_post) {
            $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se actualizó correctamente los puntos de la calificación curricular.");
            echo json_encode($responder, JSON_UNESCAPED_UNICODE);
          } else {
            $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo actualizar correctamente los puntos de la calificación curricular.");
            echo json_encode($responder, JSON_UNESCAPED_UNICODE);
          }
        }
      }
    } else {
      $id_eva_curri_cas = $ar_detalle_con['id_eva_curri_cas'];
      if ($puntaje_nivel_estu == 50) {
        $sql = "UPDATE evaluacion_curri_cas SET titulo_espec = '$puntaje_espec_acre', egre_espec = '$puntaje_espec_egre', 
        grado_maestria = '$puntaje_maestria_acre', egre_maestria = '$puntaje_maestria_egre', grado_doctorado = '$puntaje_doc_acre', 
        egre_doctorado = '$puntaje_doc_egre', titulo_tecno = '$puntaje_nivel_estu', punt_total_forma = '$puntos_total_form', 
        curso_max_tres = '$puntos_total_3_menos', curso_tres_seis = '$puntos_total_3_6', curso_seis_nueve = '$puntos_total_6_9', 
        curso_nueve_mas = '$puntos_total_9_mas', cursillos = '$puntaje_cursillos', punt_total_cursos = '$puntos_total_cursos_idioma', 
        idioma_compu = '$puntos_idioma_comp', expe_laboral_cuatro = '$suma_4_total', expe_laboral_tres = '$suma_3_total', 
        expe_laboral_uno = '$suma_1_total', punt_total_expe = '$puntos_total_expe', puntaje_total_total = '$puntaje_total' WHERE id_eva_curricular = '$id_eva_curri_cas'";
        $result = mysqli_query($con, $sql);
        if ($result) {
          $actualizar_post = "UPDATE detalle_convocatoria SET estado_conv_cas = '$estado_convocatoria',observaciones_detalle_cas = '$observaciones' WHERE iddetalle_convocatoria='$iddetalle_convocatoria'";
          $resultado_post = MYSQLI_query($con, $actualizar_post);
          $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se actualizó correctamente los puntos de la calificación curricular.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        } else {
          $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo actualizar correctamente los puntos de la calificación curricular.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        }
      } else {
        $sql = "UPDATE evaluacion_curri_cas SET titulo_espec = '$puntaje_espec_acre', egre_espec = '$puntaje_espec_egre', grado_maestria = '$puntaje_maestria_acre', egre_maestria = '$puntaje_maestria_egre', grado_doctorado = '$puntaje_doc_acre', egre_doctorado = '$puntaje_doc_egre', egresado_univ = '$puntaje_nivel_estu', punt_total_forma = '$puntos_total_form', curso_max_tres = '$puntos_total_3_menos', curso_tres_seis = '$puntos_total_3_6', curso_seis_nueve = '$puntos_total_6_9', curso_nueve_mas = '$puntos_total_9_mas', cursillos = '$puntaje_cursillos', punt_total_cursos = '$puntos_total_cursos_idioma', idioma_compu = '$puntos_idioma_comp', expe_laboral_cuatro = '$suma_4_total', expe_laboral_tres = '$suma_3_total', expe_laboral_uno = '$suma_1_total', punt_total_expe = '$puntos_total_expe', puntaje_total_total = '$puntaje_total' WHERE id_eva_curricular = '$id_eva_curri_cas'";
        $result = mysqli_query($con, $sql);
        if ($result) {
          $actualizar_post = "UPDATE detalle_convocatoria SET estado_conv_cas = '$estado_convocatoria',observaciones_detalle_cas = '$observaciones' WHERE iddetalle_convocatoria='$iddetalle_convocatoria'";
          $resultado_post = MYSQLI_query($con, $actualizar_post);
          $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se actualizó correctamente los puntos de la calificación curricular.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        } else {
          $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo actualizó correctamente los puntos de la calificación curricular.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        }
      }
    }
  } elseif ($nomb_cargo_espec == 'CHOFER' or $nomb_cargo_espec == 'VIGILANTE' or $nomb_cargo_espec == 'TRABAJADOR DE LIMPIEZA' or $nomb_cargo_espec == 'TRABAJADOR DE SERVICIOS' or $nomb_cargo_espec == 'AUXILIAR ADMINISTRATIVO') {
    //FORMACION
    if ($tipo_estudios == 'SECUNDARIA') {
      $puntaje_nivel_estu = 50;
    } else {
      $puntaje_nivel_estu = 0;
      $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con SECUNDARIA COMPLETA requerido.");
      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
    }
    //POSTGRADO
    $consul_maestria = MYSQLI_query($con, "SELECT * FROM maestria_doc WHERE idpostulante_postulante ='$idpersonal' AND postgrado_validacion = 'VALIDO'");
    $ar_maestria = mysqli_fetch_array($consul_maestria);
    $fil_maestria = mysqli_num_rows($consul_maestria);
    if ($fil_maestria > 0) {
      $puntaje_espec_acre = 0;
      $puntaje_espec_egre = 0;

      $puntaje_maestria_acre = 0;
      $puntaje_maestria_egre = 0;

      $puntaje_doc_acre = 0;
      $puntaje_doc_egre = 0;
    } else {
      $puntaje_espec_acre = 0;
      $puntaje_espec_egre = 0;
      $puntaje_maestria_acre = 0;
      $puntaje_maestria_egre = 0;
      $puntaje_doc_acre = 0;
      $puntaje_doc_egre = 0;
    }
    $puntos_total_form = $puntaje_nivel_estu + $puntaje_espec_acre + $puntaje_espec_egre + $puntaje_maestria_acre + $puntaje_maestria_egre + $puntaje_doc_acre + $puntaje_doc_egre;
    //CURSOS
    $consul_cursos = MYSQLI_query($con, "SELECT * FROM cursos_extra WHERE curso_extra_idpostulante ='$idpostulante' AND curso_validacion='VALIDO'");;
    $fil_cursos = mysqli_num_rows($consul_cursos);
    if ($fil_cursos > 0) {
      $horas_total_40 = 0;
      $horas_total_80 = 0;
      $puntos_total_3_menos = 0;
      $puntos_total_3_6 = 0;
      $puntos_total_6_9 = 0;
      $puntos_total_9_mas = 0;
      while ($ar_cursos = mysqli_fetch_array($consul_cursos)) {
        $horas = $ar_cursos['horas'];

        if ($horas >= 1 && $horas < 41) {
          $horas_total_40 = $horas_total_40 + $horas;
        }

        if ($horas >= 80 && $horas < 240) {
          $puntos_total_3_menos = $puntos_total_3_menos + 2;
        }

        if ($horas >= 240 && $horas < 480) {
          $puntos_total_3_6 = $puntos_total_3_6 + 4;
        }

        if ($horas >= 480 && $horas < 720) {
          $puntos_total_6_9 = $puntos_total_6_9 + 6;
        }

        if ($horas >= 720) {
          $puntos_total_9_mas = $puntos_total_9_mas + 8;
        }
      }
      if ($horas_total_40 >= 200) {
        $puntaje_cursillos = 10;
      } else {
        $puntaje_cursillos = $horas_total_80 / 40;
      }
      $puntos_total_cursos = $puntaje_cursillos + $puntos_total_3_menos + $puntos_total_3_6 + $puntos_total_6_9 + $puntos_total_9_mas;
    } else {
      $puntaje_cursillos = 0;
      $puntos_total_3_menos = 0;
      $puntos_total_3_6 = 0;
      $puntos_total_6_9 = 0;
      $puntos_total_9_mas = 0;
      $puntos_total_cursos = 0;
    }
    $consul_idioma = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante ='$idpostulante' AND idioma_validacion='VALIDO'");
    $fil_idioma = mysqli_num_rows($consul_idioma);
    if ($fil_idioma > 0 && $fil_idioma <= 2) {
      $puntos_idioma_comp = $fil_idioma * 2.5;
    } elseif ($fil_idioma > 2) {
      $puntos_idioma_comp = 5;
    } else {
      $puntos_idioma_comp = 0;
    }
    $puntos_total_cursos_idioma = $puntos_total_cursos + $puntos_idioma_comp;
    if ($puntos_total_cursos_idioma >= 30) {
      $puntos_total_cursos = 30;
    }
    //EXPERIENCIA LABORAL
    $consul_expe = MYSQLI_query($con, "SELECT * FROM expe_4puntos INNER JOIN lugar_trabajo_gene 
    ON expe_4puntos.lugar_trab_general = lugar_trabajo_gene.idlugar_trabajo_gene WHERE expe_puntos_idpostulante ='$idpostulante' AND expe_validacion='VALIDO'");
    $fil_expe = mysqli_num_rows($consul_expe);
    if ($fil_expe > 0) {
      $anios_t = 0;
      $meses_t = 0;
      $dias_t = 0;
      $anios_3 = 0;
      $meses_3 = 0;
      $dias_3 = 0;
      $anios_1 = 0;
      $meses_1 = 0;
      $dias_1 = 0;
      while ($ar_expe = mysqli_fetch_array($consul_expe)) {
        $anios = $ar_expe['anios'];
        $meses = $ar_expe['meses'];
        $dias = $ar_expe['dias'];
        $idlugar_trabajo_gene = $ar_expe['idlugar_trabajo_gene'];

        if ($idlugar_trabajo_gene == 13 or $idlugar_trabajo_gene == 14 or $idlugar_trabajo_gene == 15) {
          $anios_t = $anios_t + $anios;
          $meses_t = $meses_t + $meses;
          $dias_t = $dias_t + $dias;
        } elseif ($idlugar_trabajo_gene == 16) {
          $anios_3 = $anios_3 + $anios;
          $meses_3 = $meses_3 + $meses;
          $dias_3 = $dias_3 + $dias;
        } elseif ($idlugar_trabajo_gene == 17) {
          $anios_1 = $anios_1 + $anios;
          $meses_1 = $meses_1 + $meses;
          $dias_1 = $dias_1 + $dias;
        }
      }
      //4 PUNTOS
      $anios_4_total = $anios_t * 4;
      $meses_4_total = $meses_t * 0.33;
      $dias_4_total = $dias_t * 0.011;
      $suma_4_total = $anios_4_total + $meses_4_total + $dias_4_total;
      //3 PUNTOS
      $anios_3_total = $anios_3 * 3;
      $meses_3_total = $meses_3 * 0.25;
      $dias_3_total = $dias_3 * 0.0083;
      $suma_3_total = $anios_3_total + $meses_3_total + $dias_3_total;
      //1 PUNTOS
      $anios_1_total = $anios_1 * 1;
      $meses_1_total = $meses_1 * 0.083;
      $dias_1_total = $dias_1 * 0.0028;
      $suma_1_total = $anios_1_total + $meses_1_total + $dias_1_total;
      //SUMA TOTAL
      $puntos_total_expe = $suma_4_total + $suma_3_total + $suma_1_total;
      if ($puntos_total_expe >= 20) {
        $puntos_total_expe = 20;
      }
    } else {
      $anios_4_total = 0;
      $meses_4_total = 0;
      $dias_4_total = 0;
      $suma_4_total = $anios_4_total + $meses_4_total + $dias_4_total;
      $anios_3_total = 0;
      $meses_3_total = 0;
      $dias_3_total = 0;
      $suma_3_total = $anios_3_total + $meses_3_total + $dias_3_total;
      $anios_1_total = 0;
      $meses_1_total = 0;
      $dias_1_total = 0;
      $suma_1_total = $anios_1_total + $meses_3_total + $dias_1_total;
      $puntos_total_expe = 0;
    }
    //PUNTAJE TOTAL CV
    $puntaje_total = $puntos_total_form + $puntos_total_cursos_idioma + $puntos_total_cursos + $puntos_total_expe;
    if ($puntaje_total >= 55) {
      $estado_convocatoria = "APTO";
      $observaciones = "";
    } else {
      $estado_convocatoria = "NO APTO";
      $observaciones = "No sobrepaso el puntaje mínimo";
    }
    //PROCESO GUARDAR
    $consul_detalle_con = MYSQLI_query($con, "SELECT * FROM detalle_convocatoria WHERE iddetalle_convocatoria ='$iddetalle_convocatoria'");
    $ar_detalle_con = mysqli_fetch_array($consul_detalle_con);
    $estado_eva_curri_cas = $ar_detalle_con['estado_eva_curri_cas'];
    if ($estado_eva_curri_cas == 'NO AGREGADO') {
      $sql = "INSERT INTO evaluacion_curri_cas (titulo_espec,egre_espec, grado_maestria, egre_maestria, grado_doctorado, egre_doctorado,
      sec_completa,punt_total_forma, curso_max_tres, curso_tres_seis, curso_seis_nueve, curso_nueve_mas, cursillos, punt_total_cursos, idioma_compu, 
      expe_laboral_cuatro, expe_laboral_tres, expe_laboral_uno, punt_total_expe,puntaje_total_total) VALUES ('$puntaje_espec_acre','$puntaje_espec_egre',
      '$puntaje_maestria_acre','$puntaje_maestria_egre','$puntaje_doc_acre','$puntaje_doc_egre','$puntaje_nivel_estu','$puntos_total_form','$puntos_total_3_menos',
      '$puntos_total_3_6','$puntos_total_6_9','$puntos_total_9_mas', '$puntaje_cursillos','$puntos_total_cursos_idioma','$puntos_idioma_comp','$suma_4_total', 
      '$suma_3_total', '$suma_1_total', '$puntos_total_expe','$puntaje_total')";
      $result = mysqli_query($con, $sql);
      //GUARDAR ULTIMO ID REGISTRADO
      $query = mysqli_query($con, "SELECT MAX(id_eva_curricular) AS id FROM evaluacion_curri_cas");
      if ($row = mysqli_fetch_row($query)) {
        $id = trim($row[0]);
      }
      if ($result) {
        $actualizar_post = "UPDATE detalle_convocatoria SET estado_eva_curri_cas='AGREGADO', id_eva_curri_cas='$id', estado_conv_cas = '$estado_convocatoria',observaciones_detalle_cas = '$observaciones' WHERE iddetalle_convocatoria='$iddetalle_convocatoria'";
        $resultado_post = MYSQLI_query($con, $actualizar_post);
        if ($resultado_post) {
          $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se calculó correctamente los puntos de la calificación curricular.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        } else {
          $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo calcular correctamente los puntos de la calificación curricular.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        }
      } else {
        $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al insertar datos de evaluacion curricular.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      }
    } else {
      $id_eva_curri_cas = $ar_detalle_con['id_eva_curri_cas'];
      $sql = "UPDATE evaluacion_curri_cas SET titulo_espec = '$puntaje_espec_acre', egre_espec = '$puntaje_espec_egre', grado_maestria = '$puntaje_maestria_acre', egre_maestria = '$puntaje_maestria_egre', grado_doctorado = '$puntaje_doc_acre', egre_doctorado = '$puntaje_doc_egre' ,sec_completa = '$puntaje_nivel_estu', punt_total_forma = '$puntos_total_form', curso_max_tres = '$puntos_total_3_menos', curso_tres_seis = '$puntos_total_3_6', curso_seis_nueve = '$puntos_total_6_9', curso_nueve_mas = '$puntos_total_9_mas', cursillos = '$puntaje_cursillos', punt_total_cursos = '$puntos_total_cursos_idioma', idioma_compu = '$puntos_idioma_comp', expe_laboral_cuatro = '$suma_4_total', expe_laboral_tres = '$suma_3_total', expe_laboral_uno = '$suma_1_total', punt_total_expe = '$puntos_total_expe', puntaje_total_total = '$puntaje_total' WHERE id_eva_curricular = '$id_eva_curri_cas'";
      $result = mysqli_query($con, $sql);
      if ($result) {
        $actualizar_post = "UPDATE detalle_convocatoria SET estado_conv_cas = '$estado_convocatoria',observaciones_detalle_cas = '$observaciones' WHERE iddetalle_convocatoria='$iddetalle_convocatoria'";
        $resultado_post = MYSQLI_query($con, $actualizar_post);
        if ($resultado_post) {
          $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se actualizó correctamente los puntos de la calificación curricular.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        } else {
          $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo actualizar la tabla detalle convocatoria.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        }
      } else {
        $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo actualizar correctamente los puntos de la calificación curricular.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      }
    }
  }
} else {
  $punt_total_forma = 0;

  $sql = "INSERT INTO evaluacion_curri_cas (punt_total_forma) VALUES ('$punt_total_forma')";
  $result = MYSQLI_query($con, $sql);

  $query = mysqli_query($con, "SELECT MAX(id_eva_curricular) AS id FROM evaluacion_curri_cas");
  if ($row = mysqli_fetch_row($query)) {
    $id = trim($row[0]);
  }

  if ($result) {
    $actualizar_detalle_con = "UPDATE detalle_convocatoria SET estado_eva_curri_cas='AGREGADO', id_eva_curri_cas='$id', estado_conv_cas = 'NO APTO', observaciones_detalle_cas='No cumple con la formación academica requeida' WHERE iddetalle_convocatoria='$iddetalle_convocatoria' ";
    $result_detalle = MYSQLI_query($con, $actualizar_detalle_con);
    if ($result_detalle) {
      $actualizar_post = "UPDATE postulante SET id_convocatoria='', post_id_personal_req='' WHERE idpostulante='$idpostulante'";
      $resultado_post = MYSQLI_query($con, $actualizar_post);

      $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "El postulante quedó eliminado por no cumplir con la formación requerida.");
      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
    } else {
      $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No se pudo editar la tabla detalle convocatoria.");
      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
    }
  } else {
    $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Hubo un error al actualizar los datos.");
    echo json_encode($responder, JSON_UNESCAPED_UNICODE);
  }
}
