<?php

include '../conexion.php';


$dni = $_POST['dni'];
$idcon = intval($_POST['idcon']);
$idpostulante = intval($_POST['idpostulante']);
$personal_req = intval($_POST['idpersonal']);
// $boleta=$_POST['boleta'];
date_default_timezone_set('America/Lima');
$date = date('Y-m-d H:i:s');
$responder = array();

$consul_convocatoria = "SELECT * FROM convocatoria WHERE idcon = '$idcon'";
$resul = MYSQLI_query($con, $consul_convocatoria);
$arr_conv = mysqli_fetch_array($resul);
$tipo_conv = $arr_conv['tipo_con'];

$personal_req_consulta = "SELECT * FROM personal_req INNER JOIN cargo ON personal_req.cargo_idcargo = cargo.idcargo INNER JOIN ubicacion 
ON personal_req.personal_req_idubicacion = ubicacion.iddireccion WHERE idpersonal='$personal_req'";
$resultado = MYSQLI_query($con, $personal_req_consulta);
$row_2 = mysqli_fetch_array($resultado);
$cargo = $row_2['cargo'];

$select_1 = "SELECT * FROM formacion_acad WHERE formacion_idpostulante ='$idpostulante' ";
$resultado_1 = MYSQLI_query($con, $select_1);
$row = mysqli_fetch_array($resultado_1);
$tipo_estudios_id = $row['tipo_estudios_id'];

$select_2 = "SELECT * FROM requerimientos WHERE reque_id_personal ='$personal_req' ";
$resultado_2 = MYSQLI_query($con, $select_2);
$rw = mysqli_fetch_array($resultado_2);
$reque_tipo_estudios = $rw['reque_tipo_estudios'];
$reque_tipo_estudios_max = $rw['reque_tipo_estudios_max'];
$tipo_experiencia = $rw['tipo_experiencia'];
//NIVEL ESTUDIO
$nivel_estudio_req = $rw['nivel_estudio'];
$nivel_estudio_max = $rw['nivel_estudio_max'];

$consul_postu = mysqli_query($con, "SELECT * FROM postulante WHERE idpostulante='$idpostulante'");
$arreglo = mysqli_fetch_array($consul_postu);
$id_convocatoria = $arreglo['id_convocatoria'];
$id_practicas = $arreglo['id_practicas'];



if (isset($id_convocatoria)) {
  $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Usted ya está participando en alguna convocatoria CAS, espere a que termine el proceso de la misma.");
  echo json_encode($responder, JSON_UNESCAPED_UNICODE);
} elseif (isset($id_practicas)) {
  $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Usted ya está participando en alguna convocatoria de PRACTICAS, espere a que termine el proceso de la 
  misma.");
  echo json_encode($responder, JSON_UNESCAPED_UNICODE);
} else {
  if ($reque_tipo_estudios == 1) {
    if ($tipo_estudios_id == $reque_tipo_estudios) {
      if ($tipo_experiencia == 'anios') {
        $cantidad_experiencia = $rw['cantidad_experiencia'];
        $total_anios_requerido = $cantidad_experiencia * 365;
        //se cambio a uno solo (expe)
        $experiencia = "SELECT * FROM expe_4puntos 
        WHERE expe_puntos_idpostulante = '$idpostulante'";
        $resultado = MYSQLI_query($con, $experiencia);
        $total_dias = 0; // total declarado antes del bucle

        while ($array = mysqli_fetch_array($resultado)) {
          $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
        }

        $expe_meses = "SELECT * FROM expe_4puntos 
        WHERE expe_puntos_idpostulante = '$idpostulante'";
        $resul_meses = MYSQLI_query($con, $expe_meses);
        $total_meses = 0; // total declarado antes del bucle
        while ($array = mysqli_fetch_array($resul_meses)) {
          $total_meses = $total_meses + $array['meses']; // Sumar variable $total + resultado de la consulta
        }
        $total_meses = $total_meses * 31;

        $expe_anios = "SELECT * FROM expe_4puntos 
        WHERE expe_puntos_idpostulante = '$idpostulante'";
        $resul_anios = MYSQLI_query($con, $expe_anios);
        $total_anios = 0; // total declarado antes del bucle
        while ($array = mysqli_fetch_array($resul_anios)) {
          $total_anios = $total_anios + $array['anios']; // Sumar variable $total + resultado de la consulta
        }
        $total_anios = $total_anios * 365;

        $total_total_dias = $total_dias + $total_meses + $total_anios;

        if ($total_total_dias >= $total_anios_requerido) {
          if ($cargo = 'Chofer' || $cargo = 'Piloto de ambulancia') {
            $licencia_conducir = $row['brevete'];
            if ($licencia_conducir == 'A-IIb' || $licencia_conducir == 'A-IIIa' || $licencia_conducir == 'A-IIIb' || $licencia_conducir == 'A-IIIc') {
              $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,tipo_convocatoria,
              estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) 
              VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
              $result = MYSQLI_query($con, $sql);
              $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
              if ($row = mysqli_fetch_row($query)) {
                $id = trim($row[0]);
              }
              if ($result) {
                $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' 
                WHERE idpostulante='" . $idpostulante . "'";
                $resultado = MYSQLI_query($con, $actualizar);

                header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
                exit();
              } else {
                $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación.");
                echo json_encode($responder, JSON_UNESCAPED_UNICODE);
              }
            } else {
              $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el tipo de licencia de conducir mínimo requerida: A-IIb.");
              echo json_encode($responder, JSON_UNESCAPED_UNICODE);
            }
          } else {
            $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,
            tipo_convocatoria,estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) 
            VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
            $result = MYSQLI_query($con, $sql);
            $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
            if ($row = mysqli_fetch_row($query)) {
              $id = trim($row[0]);
            }
            if ($result) {
              $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' 
              WHERE idpostulante='" . $idpostulante . "'";

              header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
              exit();
            } else {
              $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación.");
              echo json_encode($responder, JSON_UNESCAPED_UNICODE);
            }
            mysqli_close($con);
          }
        } else {
          // No cumple con el tiempo de experiencia laboral mínimo requerido.
          $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => 'No cumple con el tiempo de experiencia mínimo requerido.');
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        }
      } elseif ($tipo_experiencia == 'meses') {
        $cantidad_experiencia = $rw['cantidad_experiencia'];
        $total_anios_requerido = $cantidad_experiencia * 30;

        $experiencia = "SELECT * FROM expe_4puntos 
        WHERE expe_puntos_idpostulante = '$idpostulante'";
        $resultado = MYSQLI_query($con, $experiencia);
        $total_dias = 0; // total declarado antes del bucle

        while ($array = mysqli_fetch_array($resultado)) {
          $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
        }

        $expe_meses = "SELECT * FROM expe_4puntos 
        WHERE expe_puntos_idpostulante = '$idpostulante'";
        $resul_meses = MYSQLI_query($con, $expe_meses);
        $total_meses = 0; // total declarado antes del bucle
        while ($array = mysqli_fetch_array($resul_meses)) {
          $total_meses = $total_meses + $array['meses']; // Sumar variable $total + resultado de la consulta
        }
        $total_meses = $total_meses * 31;

        $expe_anios = "SELECT * FROM expe_4puntos 
        WHERE expe_puntos_idpostulante = '$idpostulante'";
        $resul_anios = MYSQLI_query($con, $expe_anios);
        $total_anios = 0; // total declarado antes del bucle
        while ($array = mysqli_fetch_array($resul_anios)) {
          $total_anios = $total_anios + $array['anios']; // Sumar variable $total + resultado de la consulta
        }
        $total_anios = $total_anios * 365;

        $total_total_dias = $total_dias + $total_meses + $total_anios;

        if ($total_total_dias >= $total_anios_requerido) {
          if ($cargo = 'Chofer' || $cargo = 'Piloto de ambulancia') {
            $licencia_conducir = $rw['licencia_conducir'];
            if ($licencia_conducir == 'A-IIb' || $licencia_conducir == 'A-IIIa' || $licencia_conducir == 'A-IIIb' || $licencia_conducir == 'A-IIIc') {
              $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,tipo_convocatoria,
              estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) 
                VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
              $result = MYSQLI_query($con, $sql);
              $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
              if ($row = mysqli_fetch_row($query)) {
                $id = trim($row[0]);
              }
              if ($result) {
                $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                $resultado = MYSQLI_query($con, $actualizar);

                header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
                exit();
              } else {
                $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar postulación.");
                echo json_encode($responder, JSON_UNESCAPED_UNICODE);
              }
              mysqli_close($con);
            } else {
              $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple el tipo licencia de conducir requerido");
              echo json_encode($responder, JSON_UNESCAPED_UNICODE);
            }
          } else {
            $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,tipo_convocatoria,estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) 
            VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
            $result = MYSQLI_query($con, $sql);
            $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
            if ($row = mysqli_fetch_row($query)) {
              $id = trim($row[0]);
            }
            if ($result) {
              $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
              $resultado = MYSQLI_query($con, $actualizar);

              header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
              exit();
            } else {
              $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar postulación.");
              echo json_encode($responder, JSON_UNESCAPED_UNICODE);
            }
          }
        } else {
          $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el tiempo de experiencia laboral mínimo requerido.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        }
      }
    } else {
      $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con los estudios requeridos.");
      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
    }
  } elseif ($reque_tipo_estudios == 2 || $reque_tipo_estudios_max == 2) {
    if ($tipo_estudios_id == $reque_tipo_estudios || $tipo_estudios_id == $reque_tipo_estudios_max) {
      //nivel estudios postulante
      $nivel_estudio = $row['nivel_estudios'];
      //nivel estudio requerido
      $nivel_estudio_req = $rw['nivel_estudio'];
      $nivel_estudio_max = $rw['nivel_estudio_max'];
      if ($nivel_estudio == $nivel_estudio_req || $nivel_estudio == $nivel_estudio_max) {
        if ($nivel_estudio == "TITULADO TECNICO") {
          if ($tipo_experiencia == 'anios') {
            $cantidad_experiencia = $rw['cantidad_experiencia'];
            $total_anios_requerido = $cantidad_experiencia * 365;

            $experiencia = "SELECT * FROM expe_4puntos WHERE expe_puntos_idpostulante = '$idpostulante'";
            $resultado = MYSQLI_query($con, $experiencia);
            $total_dias = 0; // total declarado antes del bucle

            while ($array = mysqli_fetch_array($resultado)) {
              $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
            }

            $expe_meses = "SELECT * FROM expe_4puntos WHERE expe_puntos_idpostulante = '$idpostulante'";
            $resul_meses = MYSQLI_query($con, $expe_meses);
            $total_meses = 0; // total declarado antes del bucle
            while ($array = mysqli_fetch_array($resul_meses)) {
              $total_meses = $total_meses + $array['meses']; // Sumar variable $total + resultado de la consulta
            }
            $total_meses = $total_meses * 31;

            $expe_anios = "SELECT * FROM expe_4puntos  WHERE expe_puntos_idpostulante = '$idpostulante'";
            $resul_anios = MYSQLI_query($con, $expe_anios);
            $total_anios = 0; // total declarado antes del bucle
            while ($array = mysqli_fetch_array($resul_anios)) {
              $total_anios = $total_anios + $array['anios']; // Sumar variable $total + resultado de la consulta
            }
            $total_anios = $total_anios * 365;

            $total_total_dias = $total_dias + $total_meses + $total_anios;

            if ($total_total_dias >= $total_anios_requerido) {
              $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,tipo_convocatoria,estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
              $result = MYSQLI_query($con, $sql);
              $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
              if ($row = mysqli_fetch_row($query)) {
                $id = trim($row[0]);
              }
              if ($result) {
                $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                $resultado = MYSQLI_query($con, $actualizar);

                header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
                exit();
              } else {
                $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación.");
                echo json_encode($responder, JSON_UNESCAPED_UNICODE);
              }
            } else {
              $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el tiempo de experiencia laboral mínimo requerido");
              echo json_encode($responder, JSON_UNESCAPED_UNICODE);
            }
          } elseif ($tipo_experiencia == 'meses') {
            $cantidad_experiencia = $rw['cantidad_experiencia'];
            $total_anios_requerido = $cantidad_experiencia * 30;

            $experiencia = "SELECT * FROM expe_4puntos WHERE expe_puntos_idpostulante = '$idpostulante'";
            $resultado = MYSQLI_query($con, $experiencia);
            $total_dias = 0; // total declarado antes del bucle

            while ($array = mysqli_fetch_array($resultado)) {
              $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
            }

            $expe_meses = "SELECT * FROM expe_4puntos WHERE expe_puntos_idpostulante = '$idpostulante'";
            $resul_meses = MYSQLI_query($con, $expe_meses);
            $total_meses = 0; // total declarado antes del bucle
            while ($array = mysqli_fetch_array($resul_meses)) {
              $total_meses = $total_meses + $array['meses']; // Sumar variable $total + resultado de la consulta
            }
            $total_meses = $total_meses * 31;

            $expe_anios = "SELECT * FROM expe_4puntos WHERE expe_puntos_idpostulante = '$idpostulante'";
            $resul_anios = MYSQLI_query($con, $expe_anios);
            $total_anios = 0; // total declarado antes del bucle
            while ($array = mysqli_fetch_array($resul_anios)) {
              $total_anios = $total_anios + $array['anios']; // Sumar variable $total + resultado de la consulta
            }
            $total_anios = $total_anios * 365;

            $total_total_dias = $total_dias + $total_meses + $total_anios;

            if ($total_total_dias >= $total_anios_requerido) {
              $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,tipo_convocatoria,estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) 
                VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
              $result = MYSQLI_query($con, $sql);
              $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
              if ($row = mysqli_fetch_row($query)) {
                $id = trim($row[0]);
              }
              if ($result) {
                $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                $resultado = MYSQLI_query($con, $actualizar);

                header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
                exit();
              } else {
                $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación.");
                echo json_encode($responder, JSON_UNESCAPED_UNICODE);
              }
              mysqli_close($con);
            } else {
              $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el tiempo de experiencia laboral mínimo requerido.");
              echo json_encode($responder, JSON_UNESCAPED_UNICODE);
            }
          }
        } elseif ($nivel_estudio == "ESTUDIANTE") {
          //ciclo actual postulante
          $ciclo_actual = $row['ciclo_actual'];
          if ($ciclo_actual == "XII" || $ciclo_actual == "XIII" || $ciclo_actual == "IX" || $ciclo_actual == "X") {
            if ($tipo_experiencia == 'anios') {
              $cantidad_experiencia = $rw['cantidad_experiencia'];
              $total_anios_requerido = $cantidad_experiencia * 365;

              //se cambio a uno solo (expe)
              $experiencia = "SELECT * FROM expe_4puntos WHERE expe_puntos_idpostulante = '$idpostulante'";
              $resultado = MYSQLI_query($con, $experiencia);
              $total_dias = 0; // total declarado antes del bucle

              while ($array = mysqli_fetch_array($resultado)) {
                $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
              }

              $expe_meses = "SELECT * FROM expe_4puntos WHERE expe_puntos_idpostulante = '$idpostulante'";
              $resul_meses = MYSQLI_query($con, $expe_meses);
              $total_meses = 0; // total declarado antes del bucle
              while ($array = mysqli_fetch_array($resul_meses)) {
                $total_meses = $total_meses + $array['meses']; // Sumar variable $total + resultado de la consulta
              }
              $total_meses = $total_meses * 31;

              $expe_anios = "SELECT * FROM expe_4puntos WHERE expe_puntos_idpostulante = '$idpostulante'";
              $resul_anios = MYSQLI_query($con, $expe_anios);
              $total_anios = 0; // total declarado antes del bucle
              while ($array = mysqli_fetch_array($resul_anios)) {
                $total_anios = $total_anios + $array['anios']; // Sumar variable $total + resultado de la consulta
              }
              $total_anios = $total_anios * 365;

              $total_total_dias = $total_dias + $total_meses + $total_anios;

              if ($total_total_dias >= $total_anios_requerido) {
                $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,tipo_convocatoria,estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) 
                VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
                $result = MYSQLI_query($con, $sql);
                $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
                if ($row = mysqli_fetch_row($query)) {
                  $id = trim($row[0]);
                }
                if ($result) {
                  $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                  $resultado = MYSQLI_query($con, $actualizar);

                  header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
                  exit();
                } else {
                  $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación.");
                  echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                }
              } else {
                $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con los años de experiencia laboral mínimos requeridos.");
                echo json_encode($responder, JSON_UNESCAPED_UNICODE);
              }
            } elseif ($tipo_experiencia == 'meses') {
              $cantidad_experiencia = $rw['cantidad_experiencia'];
              $total_anios_requerido = $cantidad_experiencia * 30;

              //se cambio a uno solo (expe)
              $experiencia = "SELECT * FROM expe_4puntos WHERE expe_puntos_idpostulante = '$idpostulante'";
              $resultado = MYSQLI_query($con, $experiencia);
              $total_dias = 0; // total declarado antes del bucle

              while ($array = mysqli_fetch_array($resultado)) {
                $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
              }

              $expe_meses = "SELECT * FROM expe_4puntos WHERE expe_puntos_idpostulante = '$idpostulante'";
              $resul_meses = MYSQLI_query($con, $expe_meses);
              $total_meses = 0; // total declarado antes del bucle
              while ($array = mysqli_fetch_array($resul_meses)) {
                $total_meses = $total_meses + $array['meses']; // Sumar variable $total + resultado de la consulta
              }
              $total_meses = $total_meses * 31;

              $expe_anios = "SELECT * FROM expe_4puntos WHERE expe_puntos_idpostulante = '$idpostulante'";
              $resul_anios = MYSQLI_query($con, $expe_anios);
              $total_anios = 0; // total declarado antes del bucle
              while ($array = mysqli_fetch_array($resul_anios)) {
                $total_anios = $total_anios + $array['anios']; // Sumar variable $total + resultado de la consulta
              }
              $total_anios = $total_anios * 365;

              $total_total_dias = $total_dias + $total_meses + $total_anios;

              if ($total_total_dias >= $total_anios_requerido) {
                $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,tipo_convocatoria,estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) 
                VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
                $result = MYSQLI_query($con, $sql);
                $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
                if ($row = mysqli_fetch_row($query)) {
                  $id = trim($row[0]);
                }
                if ($result) {
                  $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                  $resultado = MYSQLI_query($con, $actualizar);

                  header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
                  exit();
                } else {
                  $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación.");
                  echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                }
              } else {
                $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con los meses de experiencia laboral mínimos requeridos.");
                echo json_encode($responder, JSON_UNESCAPED_UNICODE);
              }
            }
          } else {
            echo "No cumple con el ciclo requerido.";
          }
        } elseif ($nivel_estudio == "EGRESADO") {
          if ($tipo_experiencia == 'anios') {
            $cantidad_experiencia = $rw['cantidad_experiencia'];
            $total_anios_requerido = $cantidad_experiencia * 365;

            //se cambio a uno solo (expe)
            $experiencia = "SELECT * FROM expe_4puntos WHERE expe_puntos_idpostulante = '$idpostulante'";
            $resultado = MYSQLI_query($con, $experiencia);
            $total_dias = 0; // total declarado antes del bucle

            while ($array = mysqli_fetch_array($resultado)) {
              $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
            }

            $expe_meses = "SELECT * FROM expe_4puntos WHERE expe_puntos_idpostulante = '$idpostulante'";
            $resul_meses = MYSQLI_query($con, $expe_meses);
            $total_meses = 0; // total declarado antes del bucle
            while ($array = mysqli_fetch_array($resul_meses)) {
              $total_meses = $total_meses + $array['meses']; // Sumar variable $total + resultado de la consulta
            }
            $total_meses = $total_meses * 31;

            $expe_anios = "SELECT * FROM expe_4puntos WHERE expe_puntos_idpostulante = '$idpostulante'";
            $resul_anios = MYSQLI_query($con, $expe_anios);
            $total_anios = 0; // total declarado antes del bucle
            while ($array = mysqli_fetch_array($resul_anios)) {
              $total_anios = $total_anios + $array['anios']; // Sumar variable $total + resultado de la consulta
            }
            $total_anios = $total_anios * 365;

            $total_total_dias = $total_dias + $total_meses + $total_anios;
            if ($total_total_dias >= $total_anios_requerido) {
              $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,tipo_convocatoria,estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) 
            VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
              $result = MYSQLI_query($con, $sql);
              $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
              if ($row = mysqli_fetch_row($query)) {
                $id = trim($row[0]);
              }
              if ($result) {
                $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                $resultado = MYSQLI_query($con, $actualizar);

                header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
                exit();
              } else {
                $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación.");
                echo json_encode($responder, JSON_UNESCAPED_UNICODE);
              }
              mysqli_close($con);
            } else {
              $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el tiempo de experiencia laboral mínimo requerido.");
              echo json_encode($responder, JSON_UNESCAPED_UNICODE);
            }
          } elseif ($tipo_experiencia == 'meses') {
            $cantidad_experiencia = $rw['cantidad_experiencia'];
            $total_anios_requerido = $cantidad_experiencia * 30;

            //se cambio a uno solo (expe)
            $experiencia = "SELECT * FROM expe_4puntos 
            WHERE expe_puntos_idpostulante = '$idpostulante'";
            $resultado = MYSQLI_query($con, $experiencia);
            $total_dias = 0; // total declarado antes del bucle

            while ($array = mysqli_fetch_array($resultado)) {
              $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
            }

            $expe_meses = "SELECT * FROM expe_4puntos 
            WHERE expe_puntos_idpostulante = '$idpostulante'";
            $resul_meses = MYSQLI_query($con, $expe_meses);
            $total_meses = 0; // total declarado antes del bucle
            while ($array = mysqli_fetch_array($resul_meses)) {
              $total_meses = $total_meses + $array['meses']; // Sumar variable $total + resultado de la consulta
            }
            $total_meses = $total_meses * 31;

            $expe_anios = "SELECT * FROM expe_4puntos 
            WHERE expe_puntos_idpostulante = '$idpostulante'";
            $resul_anios = MYSQLI_query($con, $expe_anios);
            $total_anios = 0; // total declarado antes del bucle
            while ($array = mysqli_fetch_array($resul_anios)) {
              $total_anios = $total_anios + $array['anios']; // Sumar variable $total + resultado de la consulta
            }
            $total_anios = $total_anios * 365;

            $total_total_dias = $total_dias + $total_meses + $total_anios;

            if ($total_total_dias >= $total_anios_requerido) {
              $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,tipo_convocatoria,estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
              $result = MYSQLI_query($con, $sql);
              $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
              if ($row = mysqli_fetch_row($query)) {
                $id = trim($row[0]);
              }
              if ($result) {
                $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                $resultado = MYSQLI_query($con, $actualizar);

                header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
                exit();
              } else {
                $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación.");
                echo json_encode($responder, JSON_UNESCAPED_UNICODE);
              }
              mysqli_close($con);
            } else {
              $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el tiempo de experiencia laboral mínimo requerido.");
              echo json_encode($responder, JSON_UNESCAPED_UNICODE);
            }
          }
        } elseif ($nivel_estudio == "BACHILLER") {
          $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con los estudios requeridos.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        } else {
          $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con la formación requerida.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        }
      } else {
        $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con la formación requerida.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      }
    } else {
      $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con los estudios requeridos.");
      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
    }
  } elseif ($reque_tipo_estudios == 3) {
    if ($tipo_estudios_id == $reque_tipo_estudios) {
      $nivel_estudio = $row['nivel_estudios'];
      $nivel_estudio_req = $rw['nivel_estudio'];
      $nivel_estudio_max = $rw['nivel_estudio_max'];
      if ($nivel_estudio == "ESTUDIANTE" || $nivel_estudio_max == "ESTUDIANTE") {
        if ($nivel_estudio == $nivel_estudio_req || $nivel_estudio == $nivel_estudio_max) {
          $ciclo_actual = $row['ciclo_actual'];
          $ciclo_actual_req = $rw['ciclo_actual'];
          if ($ciclo_actual == $ciclo_actual_req) {
            if ($tipo_experiencia == 'anios') {
              $cantidad_experiencia = $rw['cantidad_experiencia'];
              $total_anios_requerido = $cantidad_experiencia * 365;

              //se cambio a uno solo (expe)
              $experiencia = "SELECT * FROM expe_4puntos WHERE expe_puntos_idpostulante = '$idpostulante'";
              $resultado = MYSQLI_query($con, $experiencia);
              $total_dias = 0; // total declarado antes del bucle

              while ($array = mysqli_fetch_array($resultado)) {
                $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
              }

              $expe_meses = "SELECT * FROM expe_4puntos WHERE expe_puntos_idpostulante = '$idpostulante'";
              $resul_meses = MYSQLI_query($con, $expe_meses);
              $total_meses = 0; // total declarado antes del bucle
              while ($array = mysqli_fetch_array($resul_meses)) {
                $total_meses = $total_meses + $array['meses']; // Sumar variable $total + resultado de la consulta
              }
              $total_meses = $total_meses * 31;

              $expe_anios = "SELECT * FROM expe_4puntos WHERE expe_puntos_idpostulante = '$idpostulante'";
              $resul_anios = MYSQLI_query($con, $expe_anios);
              $total_anios = 0; // total declarado antes del bucle
              while ($array = mysqli_fetch_array($resul_anios)) {
                $total_anios = $total_anios + $array['anios']; // Sumar variable $total + resultado de la consulta
              }
              $total_anios = $total_anios * 365;

              $total_total_dias = $total_dias + $total_meses + $total_anios;

              if ($total_total_dias >= $total_anios_requerido) {
                $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,
                    tipo_convocatoria,estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) 
                    VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
                $result = MYSQLI_query($con, $sql);
                $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
                if ($row = mysqli_fetch_row($query)) {
                  $id = trim($row[0]);
                }
                if ($result) {
                  $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' 
                  WHERE idpostulante='" . $idpostulante . "'";
                  $resultado = MYSQLI_query($con, $actualizar);

                  header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
                  exit();
                } else {
                  $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación.");
                  echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                }
              } else {
                $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el tiempo de experiencia laboral mínimo requerido.");
                echo json_encode($responder, JSON_UNESCAPED_UNICODE);
              }
            } elseif ($tipo_experiencia == 'meses') {
              $cantidad_experiencia = $rw['cantidad_experiencia'];
              $total_anios_requerido = $cantidad_experiencia * 30;

              //se cambio a uno solo (expe)
              $experiencia = "SELECT * FROM expe_4puntos 
                WHERE expe_puntos_idpostulante = '$idpostulante'";
              $resultado = MYSQLI_query($con, $experiencia);
              $total_dias = 0; // total declarado antes del bucle

              while ($array = mysqli_fetch_array($resultado)) {
                $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
              }

              $expe_meses = "SELECT * FROM expe_4puntos 
                WHERE expe_puntos_idpostulante = '$idpostulante'";
              $resul_meses = MYSQLI_query($con, $expe_meses);
              $total_meses = 0; // total declarado antes del bucle
              while ($array = mysqli_fetch_array($resul_meses)) {
                $total_meses = $total_meses + $array['meses']; // Sumar variable $total + resultado de la consulta
              }
              $total_meses = $total_meses * 31;

              $expe_anios = "SELECT * FROM expe_4puntos 
                WHERE expe_puntos_idpostulante = '$idpostulante'";
              $resul_anios = MYSQLI_query($con, $expe_anios);
              $total_anios = 0; // total declarado antes del bucle
              while ($array = mysqli_fetch_array($resul_anios)) {
                $total_anios = $total_anios + $array['anios']; // Sumar variable $total + resultado de la consulta
              }
              $total_anios = $total_anios * 365;

              $total_total_dias = $total_dias + $total_meses + $total_anios;
              if ($total_total_dias >= $total_anios_requerido) {
                $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,tipo_convocatoria,estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) 
                VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
                $result = MYSQLI_query($con, $sql);
                $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
                if ($row = mysqli_fetch_row($query)) {
                  $id = trim($row[0]);
                }
                if ($result) {
                  $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                  $resultado = MYSQLI_query($con, $actualizar);

                  header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
                  exit();
                } else {
                  $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación.");
                  echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                }
              } else {
                $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el tiempo de experiencia laboral mínimo requerido.");
                echo json_encode($responder, JSON_UNESCAPED_UNICODE);
              }
            }
          } elseif ($ciclo_actual == "XI" || $ciclo_actual == "XII" || $ciclo_actual == "XIII" || $ciclo_actual == "IX" || $ciclo_actual == "X") {
            if ($tipo_experiencia == 'anios') {
              $cantidad_experiencia = $rw['cantidad_experiencia'];
              $total_anios_requerido = $cantidad_experiencia * 365;

              //se cambio a uno solo (expe)
              $experiencia = "SELECT * FROM expe_4puntos 
                WHERE expe_puntos_idpostulante = '$idpostulante'";
              $resultado = MYSQLI_query($con, $experiencia);
              $total_dias = 0; // total declarado antes del bucle

              while ($array = mysqli_fetch_array($resultado)) {
                $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
              }

              $expe_meses = "SELECT * FROM expe_4puntos 
                WHERE expe_puntos_idpostulante = '$idpostulante'";
              $resul_meses = MYSQLI_query($con, $expe_meses);
              $total_meses = 0; // total declarado antes del bucle
              while ($array = mysqli_fetch_array($resul_meses)) {
                $total_meses = $total_meses + $array['meses']; // Sumar variable $total + resultado de la consulta
              }
              $total_meses = $total_meses * 31;

              $expe_anios = "SELECT * FROM expe_4puntos 
                WHERE expe_puntos_idpostulante = '$idpostulante'";
              $resul_anios = MYSQLI_query($con, $expe_anios);
              $total_anios = 0; // total declarado antes del bucle
              while ($array = mysqli_fetch_array($resul_anios)) {
                $total_anios = $total_anios + $array['anios']; // Sumar variable $total + resultado de la consulta
              }
              $total_anios = $total_anios * 365;

              $total_total_dias = $total_dias + $total_meses + $total_anios;

              if ($total_total_dias >= $total_anios_requerido) {
                $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,tipo_convocatoria,estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) 
                VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
                $result = MYSQLI_query($con, $sql);
                $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
                if ($row = mysqli_fetch_row($query)) {
                  $id = trim($row[0]);
                }
                if ($result) {
                  $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                  $resultado = MYSQLI_query($con, $actualizar);

                  header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
                  exit();
                } else {
                  $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación.");
                  echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                }
                mysqli_close($con);
              } else {
                $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el tiempo de experiencia laboral mínimo requerido.");
                echo json_encode($responder, JSON_UNESCAPED_UNICODE);
              }
            } elseif ($tipo_experiencia == 'meses') {
              $cantidad_experiencia = $rw['cantidad_experiencia'];
              $total_anios_requerido = $cantidad_experiencia * 30;

              //se cambio a uno solo (expe)
              $experiencia = "SELECT * FROM expe_4puntos 
                WHERE expe_puntos_idpostulante = '$idpostulante'";
              $resultado = MYSQLI_query($con, $experiencia);
              $total_dias = 0; // total declarado antes del bucle

              while ($array = mysqli_fetch_array($resultado)) {
                $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
              }

              $expe_meses = "SELECT * FROM expe_4puntos 
                WHERE expe_puntos_idpostulante = '$idpostulante'";
              $resul_meses = MYSQLI_query($con, $expe_meses);
              $total_meses = 0; // total declarado antes del bucle
              while ($array = mysqli_fetch_array($resul_meses)) {
                $total_meses = $total_meses + $array['meses']; // Sumar variable $total + resultado de la consulta
              }
              $total_meses = $total_meses * 31;

              $expe_anios = "SELECT * FROM expe_4puntos 
                WHERE expe_puntos_idpostulante = '$idpostulante'";
              $resul_anios = MYSQLI_query($con, $expe_anios);
              $total_anios = 0; // total declarado antes del bucle
              while ($array = mysqli_fetch_array($resul_anios)) {
                $total_anios = $total_anios + $array['anios']; // Sumar variable $total + resultado de la consulta
              }
              $total_anios = $total_anios * 365;

              $total_total_dias = $total_dias + $total_meses + $total_anios;

              if ($total_total_dias >= $total_anios_requerido) {
                $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,tipo_convocatoria,estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) 
                VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
                $result = MYSQLI_query($con, $sql);
                $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
                if ($row = mysqli_fetch_row($query)) {
                  $id = trim($row[0]);
                }
                if ($result) {
                  $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                  $resultado = MYSQLI_query($con, $actualizar);

                  header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
                  exit();
                } else {
                  $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación.");
                  echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                }
                mysqli_close($con);
              } else {
                $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el tiempo de experiencia laboral mínimo requerido.");
                echo json_encode($responder, JSON_UNESCAPED_UNICODE);
              }
            }
          } else {
            $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el ciclo requerido.");
            echo json_encode($responder, JSON_UNESCAPED_UNICODE);
          }
        } else {
          $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con la formación academica requerida.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        }
      } elseif ($nivel_estudio == 'EGRESADO' || $nivel_estudio ==  'BACHILLER') {
        if ($nivel_estudio == $nivel_estudio_req || $nivel_estudio == $nivel_estudio_max) {
          if ($tipo_experiencia == 'anios') {
            $cantidad_experiencia = $rw['cantidad_experiencia'];
            $total_anios_requerido = $cantidad_experiencia * 365;

            //se cambio a uno solo (expe)
            $experiencia = "SELECT * FROM expe_4puntos 
                WHERE expe_puntos_idpostulante = '$idpostulante'";
            $resultado = MYSQLI_query($con, $experiencia);
            $total_dias = 0; // total declarado antes del bucle

            while ($array = mysqli_fetch_array($resultado)) {
              $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
            }

            $expe_meses = "SELECT * FROM expe_4puntos 
                WHERE expe_puntos_idpostulante = '$idpostulante'";
            $resul_meses = MYSQLI_query($con, $expe_meses);
            $total_meses = 0; // total declarado antes del bucle
            while ($array = mysqli_fetch_array($resul_meses)) {
              $total_meses = $total_meses + $array['meses']; // Sumar variable $total + resultado de la consulta
            }
            $total_meses = $total_meses * 31;

            $expe_anios = "SELECT * FROM expe_4puntos 
                WHERE expe_puntos_idpostulante = '$idpostulante'";
            $resul_anios = MYSQLI_query($con, $expe_anios);
            $total_anios = 0; // total declarado antes del bucle
            while ($array = mysqli_fetch_array($resul_anios)) {
              $total_anios = $total_anios + $array['anios']; // Sumar variable $total + resultado de la consulta
            }
            $total_anios = $total_anios * 365;

            $total_total_dias = $total_dias + $total_meses + $total_anios;

            if ($total_total_dias >= $total_anios_requerido) {
              $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,tipo_convocatoria,estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) 
                VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
              $result = MYSQLI_query($con, $sql);
              $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
              if ($row = mysqli_fetch_row($query)) {
                $id = trim($row[0]);
              }
              if ($result) {
                $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                $resultado = MYSQLI_query($con, $actualizar);

                header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
                exit();
              } else {
                $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación.");
                echo json_encode($responder, JSON_UNESCAPED_UNICODE);
              }
              mysqli_close($con);
            } else {
              $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el tiempo de experiencia laboral requerido.");
              echo json_encode($responder, JSON_UNESCAPED_UNICODE);
            }
          } elseif ($tipo_experiencia == 'meses') {
            $cantidad_experiencia = $rw['cantidad_experiencia'];
            $total_anios_requerido = $cantidad_experiencia * 30;

            //se cambio a uno solo (expe)
            $experiencia = "SELECT * FROM expe_4puntos 
                WHERE expe_puntos_idpostulante = '$idpostulante'";
            $resultado = MYSQLI_query($con, $experiencia);
            $total_dias = 0; // total declarado antes del bucle

            while ($array = mysqli_fetch_array($resultado)) {
              $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
            }

            $expe_meses = "SELECT * FROM expe_4puntos 
                WHERE expe_puntos_idpostulante = '$idpostulante'";
            $resul_meses = MYSQLI_query($con, $expe_meses);
            $total_meses = 0; // total declarado antes del bucle
            while ($array = mysqli_fetch_array($resul_meses)) {
              $total_meses = $total_meses + $array['meses']; // Sumar variable $total + resultado de la consulta
            }
            $total_meses = $total_meses * 31;

            $expe_anios = "SELECT * FROM expe_4puntos 
                WHERE expe_puntos_idpostulante = '$idpostulante'";
            $resul_anios = MYSQLI_query($con, $expe_anios);
            $total_anios = 0; // total declarado antes del bucle
            while ($array = mysqli_fetch_array($resul_anios)) {
              $total_anios = $total_anios + $array['anios']; // Sumar variable $total + resultado de la consulta
            }
            $total_anios = $total_anios * 365;

            $total_total_dias = $total_dias + $total_meses + $total_anios;

            if ($total_total_dias >= $total_anios_requerido) {
              $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,tipo_convocatoria,estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) 
                VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
              $result = MYSQLI_query($con, $sql);
              $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
              if ($row = mysqli_fetch_row($query)) {
                $id = trim($row[0]);
              }
              if ($result) {
                $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                $resultado = MYSQLI_query($con, $actualizar);

                header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
                exit();
              } else {
                $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación.");
                echo json_encode($responder, JSON_UNESCAPED_UNICODE);
              }
            } else {
              $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el tiempo de experiencia laboral mínimo requerido.");
              echo json_encode($responder, JSON_UNESCAPED_UNICODE);
            }
          }
        } else {
          $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con la formación academica requerida.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        }
      } elseif ($nivel_estudio == 'TITULADO') {
        if ($nivel_estudio == $nivel_estudio_req || $nivel_estudio == $nivel_estudio_max) {
          $colegiatura = $row['colegiatura'];
          $colegiatura_req = $rw['colegiatura'];
          if ($colegiatura == 'SI') {
            $fech_habilitacion = $row['fech_habilitacion'];
            if (!empty($fech_habilitacion)) {
              $fecha_actual = strtotime($date);
              $fecha_entrada = strtotime($fech_habilitacion);
              if ($fecha_entrada >= $fecha_actual) {
                $serums = $row['serums'];
                $serums_req = $rw['serums'];
                if ($serums_req == $serums) {
                  if ($tipo_experiencia == 'anios') {
                    $cantidad_experiencia = $rw['cantidad_experiencia'];
                    $total_anios_requerido = $cantidad_experiencia * 365;

                    //se cambio a uno solo (expe)
                    $experiencia = "SELECT * FROM expe_4puntos 
                        WHERE expe_puntos_idpostulante = '$idpostulante'";
                    $resultado = MYSQLI_query($con, $experiencia);
                    $total_dias = 0; // total declarado antes del bucle

                    while ($array = mysqli_fetch_array($resultado)) {
                      $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
                    }

                    $expe_meses = "SELECT * FROM expe_4puntos 
                        WHERE expe_puntos_idpostulante = '$idpostulante'";
                    $resul_meses = MYSQLI_query($con, $expe_meses);
                    $total_meses = 0; // total declarado antes del bucle
                    while ($array = mysqli_fetch_array($resul_meses)) {
                      $total_meses = $total_meses + $array['meses']; // Sumar variable $total + resultado de la consulta
                    }
                    $total_meses = $total_meses * 31;

                    $expe_anios = "SELECT * FROM expe_4puntos 
                        WHERE expe_puntos_idpostulante = '$idpostulante'";
                    $resul_anios = MYSQLI_query($con, $expe_anios);
                    $total_anios = 0; // total declarado antes del bucle
                    while ($array = mysqli_fetch_array($resul_anios)) {
                      $total_anios = $total_anios + $array['anios']; // Sumar variable $total + resultado de la consulta
                    }
                    $total_anios = $total_anios * 365;

                    $total_total_dias = $total_dias + $total_meses + $total_anios;

                    if ($total_total_dias >= $total_anios_requerido) {
                      $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,tipo_convocatoria,estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) 
                        VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
                      $result = MYSQLI_query($con, $sql);
                      $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
                      if ($row = mysqli_fetch_row($query)) {
                        $id = trim($row[0]);
                      }
                      if ($result) {
                        $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                        $resultado = MYSQLI_query($con, $actualizar);

                        header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
                        exit();
                      } else {
                        $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación.");
                        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                      }
                      mysqli_close($con);
                    } else {
                      $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el tiempo de experiencia laboral mínimo requerido.");
                      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                    }
                  } elseif ($tipo_experiencia == 'meses') {
                    $cantidad_experiencia = $rw['cantidad_experiencia'];
                    $total_anios_requerido = $cantidad_experiencia * 30;

                    //se cambio a uno solo (expe)
                    $experiencia = "SELECT * FROM expe_4puntos 
                        WHERE expe_puntos_idpostulante = '$idpostulante'";
                    $resultado = MYSQLI_query($con, $experiencia);
                    $total_dias = 0; // total declarado antes del bucle

                    while ($array = mysqli_fetch_array($resultado)) {
                      $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
                    }

                    $expe_meses = "SELECT * FROM expe_4puntos 
                        WHERE expe_puntos_idpostulante = '$idpostulante'";
                    $resul_meses = MYSQLI_query($con, $expe_meses);
                    $total_meses = 0; // total declarado antes del bucle
                    while ($array = mysqli_fetch_array($resul_meses)) {
                      $total_meses = $total_meses + $array['meses']; // Sumar variable $total + resultado de la consulta
                    }
                    $total_meses = $total_meses * 31;

                    $expe_anios = "SELECT * FROM expe_4puntos 
                        WHERE expe_puntos_idpostulante = '$idpostulante'";
                    $resul_anios = MYSQLI_query($con, $expe_anios);
                    $total_anios = 0; // total declarado antes del bucle
                    while ($array = mysqli_fetch_array($resul_anios)) {
                      $total_anios = $total_anios + $array['anios']; // Sumar variable $total + resultado de la consulta
                    }
                    $total_anios = $total_anios * 365;

                    $total_total_dias = $total_dias + $total_meses + $total_anios;

                    if ($total_total_dias >= $total_anios_requerido) {
                      $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,tipo_convocatoria,estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) 
                        VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
                      $result = MYSQLI_query($con, $sql);
                      $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
                      if ($row = mysqli_fetch_row($query)) {
                        $id = trim($row[0]);
                      }
                      if ($result) {
                        $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                        $resultado = MYSQLI_query($con, $actualizar);

                        header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
                        exit();
                      } else {
                        $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación.");
                        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                      }
                    } else {
                      $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el tiempo de experiencia laboral mínimo requerido.");
                      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                    }
                  }
                } else {
                  $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el serums requerido.");
                  echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                }
              } else {
                $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "La fecha de habilitación profesional está vencida.");
                echo json_encode($responder, JSON_UNESCAPED_UNICODE);
              }
            } else {
              $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No tiene habilitación profesional.");
              echo json_encode($responder, JSON_UNESCAPED_UNICODE);
            }
          } else {
            $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con la colegiatura requerida.");
            echo json_encode($responder, JSON_UNESCAPED_UNICODE);
          }
        } else {
          $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con la formación academica requerida.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        }
      } else {
        $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el nivel de estudio requerido.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      }
    } elseif ($tipo_estudios_id == $reque_tipo_estudios_max) {
      if ($nivel_estudio_max == 'TITULADO') {
        if ($nivel_estudio == $nivel_estudio_req || $nivel_estudio == $nivel_estudio_max) {
          $colegiatura_max = $row['colegiatura_max'];
          $habilitacion_max = $rw['habilitacion_max'];
          $serums_max = $rw['serums_max'];
          if ($colegiatura_max == 'SI') {
            $fech_habilitacion = $row['fech_habilitacion'];
            if (!empty($fech_habilitacion)) {
              $fecha_actual = strtotime($date);
              $fecha_entrada = strtotime($fech_habilitacion);
              if ($fecha_entrada >= $fecha_actual) {
                $serums = $row['serums'];
                $serums_req = $rw['serums'];
                if ($serums_req == $serums) {
                  if ($tipo_experiencia == 'anios') {
                    $cantidad_experiencia = $rw['cantidad_experiencia'];
                    $total_anios_requerido = $cantidad_experiencia * 365;

                    //se cambio a uno solo (expe)
                    $experiencia = "SELECT * FROM expe_4puntos 
                            WHERE expe_puntos_idpostulante = '$idpostulante'";
                    $resultado = MYSQLI_query($con, $experiencia);
                    $total_dias = 0; // total declarado antes del bucle

                    while ($array = mysqli_fetch_array($resultado)) {
                      $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
                    }

                    $expe_meses = "SELECT * FROM expe_4puntos 
                            WHERE expe_puntos_idpostulante = '$idpostulante'";
                    $resul_meses = MYSQLI_query($con, $expe_meses);
                    $total_meses = 0; // total declarado antes del bucle
                    while ($array = mysqli_fetch_array($resul_meses)) {
                      $total_meses = $total_meses + $array['meses']; // Sumar variable $total + resultado de la consulta
                    }
                    $total_meses = $total_meses * 31;

                    $expe_anios = "SELECT * FROM expe_4puntos 
                            WHERE expe_puntos_idpostulante = '$idpostulante'";
                    $resul_anios = MYSQLI_query($con, $expe_anios);
                    $total_anios = 0; // total declarado antes del bucle
                    while ($array = mysqli_fetch_array($resul_anios)) {
                      $total_anios = $total_anios + $array['anios']; // Sumar variable $total + resultado de la consulta
                    }
                    $total_anios = $total_anios * 365;

                    $total_total_dias = $total_dias + $total_meses + $total_anios;

                    if ($total_total_dias >= $total_anios_requerido) {
                      $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,tipo_convocatoria,estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) 
                            VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
                      $result = MYSQLI_query($con, $sql);
                      $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
                      if ($row = mysqli_fetch_row($query)) {
                        $id = trim($row[0]);
                      }
                      if ($result) {
                        $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                        $resultado = MYSQLI_query($con, $actualizar);

                        header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
                        exit();
                      } else {
                        $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación.");
                        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                      }
                      mysqli_close($con);
                    } else {
                      $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el tiempo de experiencia laboral mínimo requerido.");
                      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                    }
                  } elseif ($tipo_experiencia == 'meses') {
                    $cantidad_experiencia = $rw['cantidad_experiencia'];
                    $total_anios_requerido = $cantidad_experiencia * 30;

                    //se cambio a uno solo (expe)
                    $experiencia = "SELECT * FROM expe_4puntos 
                            WHERE expe_puntos_idpostulante = '$idpostulante'";
                    $resultado = MYSQLI_query($con, $experiencia);
                    $total_dias = 0; // total declarado antes del bucle

                    while ($array = mysqli_fetch_array($resultado)) {
                      $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
                    }

                    $expe_meses = "SELECT * FROM expe_4puntos 
                            WHERE expe_puntos_idpostulante = '$idpostulante'";
                    $resul_meses = MYSQLI_query($con, $expe_meses);
                    $total_meses = 0; // total declarado antes del bucle
                    while ($array = mysqli_fetch_array($resul_meses)) {
                      $total_meses = $total_meses + $array['meses']; // Sumar variable $total + resultado de la consulta
                    }
                    $total_meses = $total_meses * 31;

                    $expe_anios = "SELECT * FROM expe_4puntos 
                            WHERE expe_puntos_idpostulante = '$idpostulante'";
                    $resul_anios = MYSQLI_query($con, $expe_anios);
                    $total_anios = 0; // total declarado antes del bucle
                    while ($array = mysqli_fetch_array($resul_anios)) {
                      $total_anios = $total_anios + $array['anios']; // Sumar variable $total + resultado de la consulta
                    }
                    $total_anios = $total_anios * 365;

                    $total_total_dias = $total_dias + $total_meses + $total_anios;

                    if ($total_total_dias >= $total_anios_requerido) {
                      $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion,tipo_convocatoria,estado_eva_curri_cas,estado_entrevista_cas,estado_conv_cas) 
                            VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "','" . $tipo_conv . "','NO AGREGADO','NO AGREGADO','APTO')";
                      $result = MYSQLI_query($con, $sql);
                      $query = mysqli_query($con, "SELECT MAX(iddetalle_convocatoria) AS id FROM detalle_convocatoria");
                      if ($row = mysqli_fetch_row($query)) {
                        $id = trim($row[0]);
                      }
                      if ($result) {
                        $actualizar = "UPDATE postulante SET id_convocatoria='" . $idcon . "', post_id_personal_req='" . $personal_req . "' WHERE idpostulante='" . $idpostulante . "'";
                        $resultado = MYSQLI_query($con, $actualizar);

                        header('Location: calcular_puntaje_cas.php?idcon=' . $idcon . '&idpersonal=' . $personal_req . '&idpostulante=' . $idpostulante . '&iddetalle_convocatoria=' . $id . '&dni=' . $dni);
                        exit();
                      } else {
                        $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al guardar la postulación.");
                        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                      }
                    } else {
                      $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el tiempo de experiencia laboral mínimo requerido.");
                      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                    }
                  }
                } else {
                  $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con el serums requerido.");
                  echo json_encode($responder, JSON_UNESCAPED_UNICODE);
                }
              } else {
                $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "La fecha de habilitación profesional está vencida.");
                echo json_encode($responder, JSON_UNESCAPED_UNICODE);
              }
            } else {
              $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No tiene habilitación profesional requerida.");
              echo json_encode($responder, JSON_UNESCAPED_UNICODE);
            }
          } else {
            $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con la colegiatura requerida.");
            echo json_encode($responder, JSON_UNESCAPED_UNICODE);
          }
        } else {
          $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con la formación academica requerida.");
          echo json_encode($responder, JSON_UNESCAPED_UNICODE);
        }
      } else {
        $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple los estudios de formación requeridos.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      }
    } else {
      $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No cumple con los estudios de formación requeridos");
      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
    }
  }
}
