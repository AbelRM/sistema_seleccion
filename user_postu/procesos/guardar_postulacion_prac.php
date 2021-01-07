<?php

include '../conexion.php';

// echo "VALOR ENVIADO";
$dni = $_POST['dni'];

$idcon = intval($_POST['idcon']);
$idpostulante = intval($_POST['idpostulante']);
$personal_req = intval($_POST['idpersonal']);
$tipo_convocatoria = 'PRACTICANTE';
date_default_timezone_set('America/Lima');
$date = date('Y-m-d H:i:s');

$responder = array();

$select = "SELECT * FROM sistema_seleccion.postulante WHERE idpostulante ='$idpostulante' ";
$resul = MYSQLI_query($con, $select);
$array = mysqli_fetch_array($resul);
$id_convocatoria = $array['id_convocatoria'];
$id_practicas = $array['id_practicas'];

$select_1 = "SELECT * FROM sistema_seleccion.formacion_acad_prac WHERE formacion_acad_prac_idpostulante ='$idpostulante' ";
$resultado_1 = MYSQLI_query($con, $select_1);
$num_fil_form = mysqli_num_rows($resultado_1);
if ($num_fil_form > 0) {
  $row = mysqli_fetch_array($resultado_1);
  $tipo_estudios_post = $row['tipo_estudios'];
  $nivel_estudios_post = $row['nivel_estudios'];
  $select_2 = "SELECT * FROM sistema_seleccion.practicantes_req WHERE idpracticantes_req ='$personal_req' ";
  $resultado_2 = MYSQLI_query($con, $select_2);
  $rw = mysqli_fetch_array($resultado_2);
  $tipo_practicante = $rw['tipo_practicante'];
  $nivel_estudio_req = $rw['nivel_estudio'];

  $select_3 = "SELECT * FROM sistema_seleccion.detalle_conv_prac WHERE idpracticas_conv ='$idcon' AND detalle_prac_idpostulante = '$idpostulante' AND practicantel_req_idpracticantes_req = '$personal_req'";
  $resultado_3 = MYSQLI_query($con, $select_3);

  if (isset($id_practicas)) {
    $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Usted ya está participando en alguna convocatoria, espere a que termine el proceso de la misma.");
    echo json_encode($responder, JSON_UNESCAPED_UNICODE);
    // echo "Usted ya está participando en alguna convocatoria, espere a que termine el proceso de la misma.";
  } else {
    if (isset($id_practicas) or isset($id_convocatoria)) {
      $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Usted ya está participando en alguna convocatoria, espere a que termine el proceso de la misma.");
      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      // echo "Usted ya está participando en alguna convocatoria, espere a que termine el proceso de la misma.";
    } else {
      if (!isset($resultado_3)) {
        $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Ya se encuentra POSTULANDO a esta convocatoria.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        // echo "Ya se encuentra POSTULANDO a esta convocatoria.";
      } else {
        $responder = array();
        if ($tipo_practicante == 'PRE-PROFESIONAL') {
          if ($tipo_estudios_post == 'UNIVERSITARIO') {
            if ($nivel_estudios_post == 'ESTUDIANTE') {
              $ciclo_actual = $row['ciclo_actual'];
              $ciclo_requerido =  $rw['ciclo_requerido'];
              if ($ciclo_actual = $ciclo_requerido || $ciclo_actual == "VI" || $ciclo_actual == "VII" || $ciclo_actual == "VIII" || $ciclo_actual == "IX" || $ciclo_actual == "X") {
                //PUNTAJE CURSOS
                $consulta = MYSQLI_query($con, "SELECT * FROM cursos_extra WHERE curso_extra_idpostulante = '$idpostulante'");
                $num_cursos = mysqli_num_rows($consulta);
                if ($num_cursos >= 5) {
                  $puntos_cursos = 5;
                } else {
                  $puntos_cursos = $num_cursos;
                }
                //PUNTAJE FORMACION
                $consulta_2 = MYSQLI_query($con, "SELECT * FROM formacion_acad_prac WHERE formacion_acad_prac_idpostulante = '$idpostulante'");
                $row = mysqli_fetch_array($consulta_2);
                if ($row['nivel_estudios'] == 'EGRESADO') {
                  $puntos_formacion = 8;
                } else {
                  $puntos_formacion = 0;
                }
                //PUNNTAJE ORDEN DE MERITO 
                if ($row['orden_merito'] == 'QUINTO SUPERIOR') {
                  $puntos_ubi = 2;
                } elseif ($row['orden_merito'] == 'TERCIO SUPERIOR') {
                  $puntos_ubi = 1;
                } else {
                  $puntos_ubi = 0;
                }
                //PUNTAJE COMPUTO/INGLES
                $consulta_3 = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante='$idpostulante' AND idioma_comp = 'COMPUTACION / OFIMATICA'");
                $consulta_4 = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante='$idpostulante' AND idioma_comp = 'IDIOMA'");
                $consulta_5 = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante='$idpostulante' AND idioma_comp = 'MOTIVACION / LIDERAZGO'");

                if (mysqli_num_rows($consulta_3) > 0) {
                  $nro_comp = mysqli_num_rows($consulta_3);
                  $puntos_comp = 3;
                } else {
                  $puntos_comp = 0;
                }

                if (mysqli_num_rows($consulta_4) > 0) {
                  $nro_idi = mysqli_num_rows($consulta_4);
                  $puntos_idioma = 1;
                } else {
                  $puntos_idioma = 0;
                }

                if (mysqli_num_rows($consulta_5) > 0) {
                  $nro_lid = mysqli_num_rows($consulta_5);
                  $puntos_lider = 1;
                } else {
                  $puntos_lider = 0;
                }

                $totalPuntaje = $puntos_formacion + $puntos_cursos + $puntos_ubi + $puntos_comp + $puntos_idioma + $puntos_lider;
                if ($totalPuntaje >= 13) {
                  $estado_entrevista = 'NO AGREGADO';
                  $estado_conv_prac = 'APTO';

                  $sql = "INSERT INTO detalle_conv_prac (idpracticas_conv, detalle_prac_idpostulante, practicantel_req_idpracticantes_req, fecha_postulacion, tipo_convocatoria,puntos_form,puntos_cursos,puntos_ubi,puntos_comp,puntos_idioma,puntos_lider,puntos_total_cv,estado_entrevista,estado_conv_prac) VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_convocatoria . "','" . $puntos_formacion    . "','" . $puntos_cursos    . "','" . $puntos_ubi . "','" . $puntos_comp . "','" . $puntos_idioma . "','" . $puntos_lider . "','" . $totalPuntaje . "','" . $estado_entrevista . "','" . $estado_conv_prac . "')";

                  $result = MYSQLI_query($con, $sql);

                  if ($result) {
                    $actualizar = "UPDATE postulante SET id_practicas='" . $idcon . "', post_id_practicantes_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                    $resultado = MYSQLI_query($con, $actualizar);
                    if ($resultado) {
                      $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se registro correctamente");
                      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                    } else {
                      $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al actualizar postulante");
                      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                      // echo "Error al actualizar postulante";
                    }
                  } else {
                    $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación para practicante pre-profesional.");
                    echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                    // echo "Error al guardar la postulación para practicante pre-profesional.";
                  }
                } else {
                  $estado_entrevista = 'NO AGREGADO';
                  $estado_conv_prac = 'NO APTO';
                  $sql = "INSERT INTO detalle_conv_prac (idpracticas_conv, detalle_prac_idpostulante, practicantel_req_idpracticantes_req, fecha_postulacion, tipo_convocatoria,puntos_form,puntos_cursos,puntos_ubi,puntos_comp,puntos_idioma,puntos_lider,puntos_total_cv,estado_entrevista,estado_conv_prac) VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_convocatoria . "','" . $puntos_formacion    . "','" . $puntos_cursos    . "','" . $puntos_ubi . "','" . $puntos_comp . "','" . $puntos_idioma . "','" . $puntos_lider . "','" . $totalPuntaje . "','" . $estado_entrevista . "','" . $estado_conv_prac . "')";

                  $result = MYSQLI_query($con, $sql);

                  if ($result) {
                    $actualizar = "UPDATE postulante SET id_practicas='" . $idcon . "', post_id_practicantes_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                    $resultado = MYSQLI_query($con, $actualizar);
                    if ($resultado) {
                      $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se registro correctamente");
                      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                    } else {
                      $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al actualizar postulante");
                      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                      // echo "Error al actualizar postulante";
                    }
                  } else {
                    $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación para practicante pre-profesional.");
                    echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                    // echo "Error al guardar la postulación para practicante pre-profesional.";
                  }
                }
              } else {
                $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el ciclo mínimo requerido.");
                echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                // echo "No cumple con el ciclo mínimo requerido.";
              }
            } else {
              $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el nivel de estudios de ESTUDIANTE requerido.");
              echo json_encode($responder, JSON_UNESCAPED_UNICODE);
              // echo "No cumple con el nivel de estudios de ESTUDIANTE requerido.";
            }
          } else {
            $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el tipo de estudio requerido");
            echo json_encode($responder, JSON_UNESCAPED_UNICODE);
            // echo "No cumple con el tipo de estudio requerido.";
          }
        } elseif ($tipo_practicante == 'PROFESIONAL') {
          if ($tipo_estudios_post == 'UNIVERSITARIO') {
            if ($nivel_estudios_post == 'EGRESADO') {
              //PUNTAJE CURSOS
              $consulta = MYSQLI_query($con, "SELECT * FROM cursos_extra WHERE curso_extra_idpostulante = '$idpostulante'");
              $num_cursos = mysqli_num_rows($consulta);
              if ($num_cursos >= 5) {
                $puntos_cursos = 5;
              } else {
                $puntos_cursos = $num_cursos;
              }
              //PUNTAJE FORMACION
              $consulta_2 = MYSQLI_query($con, "SELECT * FROM formacion_acad_prac WHERE formacion_acad_prac_idpostulante = '$idpostulante'");
              $row = mysqli_fetch_array($consulta_2);
              if ($row['nivel_estudios'] == 'EGRESADO') {
                $puntos_formacion = 8;
              } else {
                $puntos_formacion = 0;
              }
              //PUNNTAJE ORDEN DE MERITO 
              if ($row['orden_merito'] == 'QUINTO SUPERIOR') {
                $puntos_ubi = 2;
              } elseif ($row['orden_merito'] == 'TERCIO SUPERIOR') {
                $puntos_ubi = 1;
              } else {
                $puntos_ubi = 0;
              }
              //PUNTAJE COMPUTO/INGLES
              $consulta_3 = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante='$idpostulante' AND idioma_comp = 'COMPUTACION / OFIMATICA'");
              $consulta_4 = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante='$idpostulante' AND idioma_comp = 'IDIOMA'");
              $consulta_5 = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante='$idpostulante' AND idioma_comp = 'MOTIVACION / LIDERAZGO'");

              if (mysqli_num_rows($consulta_3) > 0) {
                $nro_comp = mysqli_num_rows($consulta_3);
                $puntos_comp = 3;
              } else {
                $puntos_comp = 0;
              }

              if (mysqli_num_rows($consulta_4) > 0) {
                $nro_idi = mysqli_num_rows($consulta_4);
                $puntos_idioma = 1;
              } else {
                $puntos_idioma = 0;
              }

              if (mysqli_num_rows($consulta_5) > 0) {
                $nro_lid = mysqli_num_rows($consulta_5);
                $puntos_lider = 1;
              } else {
                $puntos_lider = 0;
              }

              $totalPuntaje = $puntos_formacion + $puntos_cursos + $puntos_ubi + $puntos_comp + $puntos_idioma + $puntos_lider;
              if ($totalPuntaje >= 13) {
                $estado_entrevista = 'NO AGREGADO';
                $estado_conv_prac = 'APTO';
                $sql = "INSERT INTO detalle_conv_prac (idpracticas_conv, detalle_prac_idpostulante, practicantel_req_idpracticantes_req, fecha_postulacion, tipo_convocatoria,puntos_form,puntos_cursos,puntos_ubi,puntos_comp,puntos_idioma,puntos_lider,puntos_total_cv,estado_entrevista,estado_conv_prac) VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_convocatoria . "','" . $puntos_formacion    . "','" . $puntos_cursos    . "','" . $puntos_ubi . "','" . $puntos_comp . "','" . $puntos_idioma . "','" . $puntos_lider . "','" . $totalPuntaje . "','" . $estado_entrevista . "','" . $estado_conv_prac . "')";

                $result = MYSQLI_query($con, $sql);
                if ($result) {
                  $actualizar = "UPDATE postulante SET id_practicas='" . $idcon . "', post_id_practicantes_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                  $resultado = MYSQLI_query($con, $actualizar);
                  if ($resultado) {
                    $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se registro correctamente");
                    echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                  } else {
                    $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al actualizar postulante.");
                    echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                    // echo "Error al actualizar postulante";
                  }
                } else {
                  $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación para practicante profesional.");
                  echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                }
              } else {
                $estado_entrevista = 'NO AGREGADO';
                $estado_conv_prac = 'NO APTO';
                $sql = "INSERT INTO detalle_conv_prac (idpracticas_conv, detalle_prac_idpostulante, practicantel_req_idpracticantes_req, fecha_postulacion, tipo_convocatoria,puntos_form,puntos_cursos,puntos_ubi,puntos_comp,puntos_idioma,puntos_lider,puntos_total_cv,estado_entrevista,estado_conv_prac) VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_convocatoria . "','" . $puntos_formacion    . "','" . $puntos_cursos    . "','" . $puntos_ubi . "','" . $puntos_comp . "','" . $puntos_idioma . "','" . $puntos_lider . "','" . $totalPuntaje . "','" . $estado_entrevista . "','" . $estado_conv_prac . "')";

                $result = MYSQLI_query($con, $sql);
                if ($result) {
                  $actualizar = "UPDATE postulante SET id_practicas='" . $idcon . "', post_id_practicantes_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                  $resultado = MYSQLI_query($con, $actualizar);
                  if ($resultado) {
                    $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se registro correctamente");
                    echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                  } else {
                    $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al actualizar postulante.");
                    echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                    // echo "Error al actualizar postulante";
                  }
                } else {
                  $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación para practicante profesional.");
                  echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                }
              }
            } else {
              $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el nivel de estudio EGRESADO requerido.");
              echo json_encode($responder, JSON_UNESCAPED_UNICODE);
              // echo "No cumple con el nivel de estudio EGRESADO requerido.";
            }
          } else {
            $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el tipo de estudios requeridos.");
            echo json_encode($responder, JSON_UNESCAPED_UNICODE);
          }
        } else {
          $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el tipo de practicante requerido.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        }
      }
    }
  }
} else {
  $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Usted no tiene formación de practicante.");
  echo json_encode($responder, JSON_UNESCAPED_UNICODE);
}
