<?php

include '../conexion.php';

$mensaje = '';
$dni = $_POST['dni'];
$idcon = $_POST['idcon'];
$idpostulante = $_POST['idpostulante'];
$personal_req = $_POST['idpersonal'];
// $boleta=$_POST['boleta'];
date_default_timezone_set('America/Lima');
$date = date('Y-m-d');

$personal_req_consulta = "SELECT * FROM sistema_seleccion.personal_req INNER JOIN sistema_seleccion.cargo
                    ON personal_req.cargo_idcargo = cargo.idcargo INNER JOIN sistema_seleccion.ubicacion 
                    ON personal_req.personal_req_idubicacion = ubicacion.iddireccion WHERE idpersonal='$personal_req'";
$resultado = MYSQLI_query($con, $personal_req_consulta);
$row_2 = mysqli_fetch_array($resultado);
$cargo = $row_2['cargo'];

$select_1 = "SELECT * FROM sistema_seleccion.formacion_acad WHERE formacion_idpostulante ='$idpostulante' ";
$resultado_1 = MYSQLI_query($con, $select_1);
$row = mysqli_fetch_array($resultado_1);
$tipo_estudios_id = $row['tipo_estudios_id'];

$select_2 = "SELECT * FROM sistema_seleccion.requerimientos WHERE reque_id_personal ='$personal_req' ";
$resultado_2 = MYSQLI_query($con, $select_2);
$rw = mysqli_fetch_array($resultado_2);
$reque_tipo_estudios = $rw['reque_tipo_estudios'];
$reque_tipo_estudios_max = $rw['reque_tipo_estudios_max'];
$tipo_experiencia = $rw['tipo_experiencia'];


if ($reque_tipo_estudios == '1') {
  if ($tipo_estudios_id == $reque_tipo_estudios) {
    if ($tipo_experiencia == 'anios') {
      $cantidad_experiencia = $rw['cantidad_experiencia'];
      $total_anios_requerido = $cantidad_experiencia * 365;

      $experiencia = "SELECT * FROM sistema_seleccion.expe_4puntos 
      where expe_4puntos_idpostulante = '$idpostulante' UNION
      SELECT * FROM sistema_seleccion.expe_3puntos 
      where expe_3puntos_idpostulante = '$idpostulante' UNION
      SELECT * FROM sistema_seleccion.expe_1puntos
      where expe_1puntos_idpostulante = '$idpostulante'";
      $resultado = MYSQLI_query($con, $experiencia);
      $total_dias = 0; // total declarado antes del bucle

      while ($array = mysqli_fetch_array($resultado)) {
        $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
      }

      $suma_meses = "SELECT SUM(meses) AS meses_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
      $cantidad_meses = mysqli_query($con, $suma_meses);
      $array_2 = mysqli_fetch_array($cantidad_meses);
      $total_meses = $array_2['meses_total'];

      $total_meses = $total_meses * 31;

      $suma_anios = "SELECT SUM(anios) AS anios_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
      $cantidad_anios = mysqli_query($con, $suma_anios);
      $array_3 = mysqli_fetch_array($cantidad_anios);
      $total_anios = $array_3['anios_total'];

      $total_anios = $total_anios * 365;

      $total_total_dias = $total_dias + $total_meses + $total_anios;

      if ($total_total_dias >= $total_anios_requerido) {
        if ($cargo = 'Chofer' || $cargo = 'Piloto de ambulancia') {
          $licencia_conducir = $row['brevete'];
          echo $licencia_conducir;
          if ($licencia_conducir == 'A-IIb' || $licencia_conducir == 'A-IIIa' || $licencia_conducir == 'A-IIIb' || $licencia_conducir == 'A-IIIc') {
            $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
            VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

            $result = MYSQLI_query($con, $sql);
            if ($result) {
              echo "Se acepto tu postulación.";
              // header('Location: ../mispostulaciones.php?dni=' . $dni);
            } else {
              echo "Error al guardar la postulación.";
              // echo '<script> alert("Error al guardar la postulación."); 
              // window.history.back(-1);</script>';
            }
            mysqli_close($con);
          } else {
            echo "No cumple con el tipo de licencia de conducir mínimo requerida: A-IIb";
            // echo '<script> alert("No cumple con el tipo de licencia de conducir mínimo requerida: A-IIb"); 
            //   window.history.back(-1);</script>';
          }
        } else {
          $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
            VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

          $result = MYSQLI_query($con, $sql);
          if ($result) {
            echo "Se acepto tu postulación.";
            // header('Location: ../mispostulaciones.php?dni=' . $dni);
          } else {
            echo "Error al guardar la postulación.";
            // echo '<script> alert("Error al guardar la postulación."); 
            //   window.history.back(-1);</script>';
          }
          mysqli_close($con);
        }
      } else {
        echo "No cumple con el tiempo de experiencia laboral mínimo requerido.";
        // echo '<script> alert("No cumple con el tiempo de experiencia laboral requerdo."); 
        // window.history.back(-1);</script>';
      }
    } elseif ($tipo_experiencia == 'meses') {
      $cantidad_experiencia = $rw['cantidad_experiencia'];
      $total_anios_requerido = $cantidad_experiencia * '30';

      $experiencia = "SELECT * FROM sistema_seleccion.expe_4puntos 
      where expe_4puntos_idpostulante = '$idpostulante' UNION
      SELECT * FROM sistema_seleccion.expe_3puntos 
      where expe_3puntos_idpostulante = '$idpostulante' UNION
      SELECT * FROM sistema_seleccion.expe_1puntos
      where expe_1puntos_idpostulante = '$idpostulante'";
      $resultado = MYSQLI_query($con, $experiencia);
      $total_dias = 0; // total declarado antes del bucle

      while ($array = mysqli_fetch_array($resultado)) {
        $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
      }

      $suma_meses = "SELECT SUM(meses) AS meses_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
      $cantidad_meses = mysqli_query($con, $suma_meses);
      $array_2 = mysqli_fetch_array($cantidad_meses);
      $total_meses = $array_2['meses_total'];

      $total_meses = $total_meses * 31;

      $suma_anios = "SELECT SUM(anios) AS anios_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
      $cantidad_anios = mysqli_query($con, $suma_anios);
      $array_3 = mysqli_fetch_array($cantidad_anios);
      $total_anios = $array_3['anios_total'];

      $total_anios = $total_anios * 365;

      $total_total_dias = $total_dias + $total_meses + $total_anios;

      if ($total_total_dias >= $total_anios_requerido) {
        if ($cargo = 'Chofer' || $cargo = 'Piloto de ambulancia') {
          $licencia_conducir = $rw['licencia_conducir'];
          if ($licencia_conducir == 'A-IIb' || $licencia_conducir == 'A-IIIa' || $licencia_conducir == 'A-IIIb' || $licencia_conducir == 'A-IIIc') {
            $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
            VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

            $result = MYSQLI_query($con, $sql);
            if ($result) {
              echo "Se acepto tu postulación.";
              // header('Location: ../mispostulaciones.php?dni=' . $dni);
            } else {
              echo "Error al guardar postulación";
              // echo '<script> alert("Error al guardar la postulación."); 
              // window.history.back(-1);</script>';
            }
            mysqli_close($con);
          } else {
            echo "No cumple el tipo licencia de conducir mínimo requerido.";
          }
        } else {
          $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
            VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

          $result = MYSQLI_query($con, $sql);
          if ($result) {
            echo "Se acepto tu postulación.";
            // header('Location: ../mispostulaciones.php?dni=' . $dni);
          } else {
            echo "Error al guardar postulación";
            // echo '<script> alert("Error al guardar la postulación."); 
            //   window.history.back(-1);</script>';
          }
          mysqli_close($con);
        }
      } else {
        echo "No cumple con el tiempo de experiencia laboral mínimo requerido.";
      }
    }
  } else {
    echo "No cumple con los estudios mínimos requeridos.";
  }
} elseif ($reque_tipo_estudios == '2') {
  if ($tipo_estudios_id == $reque_tipo_estudios) {
    $nivel_estudio = $row['nivel_estudios'];
    $nivel_estudio_req = $rw['nivel_estudio'];
    if ($nivel_estudio == "TITULADO") {
      if ($tipo_experiencia == 'anios') {
        $cantidad_experiencia = $rw['cantidad_experiencia'];
        $total_anios_requerido = $cantidad_experiencia * '365';

        $experiencia = "SELECT * FROM sistema_seleccion.expe_4puntos 
        where expe_4puntos_idpostulante = '$idpostulante' UNION
        SELECT * FROM sistema_seleccion.expe_3puntos 
        where expe_3puntos_idpostulante = '$idpostulante' UNION
        SELECT * FROM sistema_seleccion.expe_1puntos
        where expe_1puntos_idpostulante = '$idpostulante'";
        $resultado = MYSQLI_query($con, $experiencia);
        $total_dias = 0; // total declarado antes del bucle

        while ($array = mysqli_fetch_array($resultado)) {
          $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
        }

        $suma_meses = "SELECT SUM(meses) AS meses_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
        $cantidad_meses = mysqli_query($con, $suma_meses);
        $array_2 = mysqli_fetch_array($cantidad_meses);
        $total_meses = $array_2['meses_total'];

        $total_meses = $total_meses * 31;

        $suma_anios = "SELECT SUM(anios) AS anios_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
        $cantidad_anios = mysqli_query($con, $suma_anios);
        $array_3 = mysqli_fetch_array($cantidad_anios);
        $total_anios = $array_3['anios_total'];

        $total_anios = $total_anios * 365;

        $total_total_dias = $total_dias + $total_meses + $total_anios;

        if ($total_total_dias >= $total_anios_requerido) {
          $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
              VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

          $result = MYSQLI_query($con, $sql);
          if ($result) {
            echo "Se realizó con éxito registrar la postulación.";
          } else {
            echo "Error al guardar la postulación.";
          }
          mysqli_close($con);
        } else {
          echo "No cumple con el tiempo de experiencia laboral mínimo requerido.";
        }
      } elseif ($tipo_experiencia == 'meses') {
        $cantidad_experiencia = $rw['cantidad_experiencia'];
        $total_anios_requerido = $cantidad_experiencia * '30';

        $experiencia = "SELECT * FROM sistema_seleccion.expe_4puntos 
        where expe_4puntos_idpostulante = '$idpostulante' UNION
        SELECT * FROM sistema_seleccion.expe_3puntos 
        where expe_3puntos_idpostulante = '$idpostulante' UNION
        SELECT * FROM sistema_seleccion.expe_1puntos
        where expe_1puntos_idpostulante = '$idpostulante'";
        $resultado = MYSQLI_query($con, $experiencia);
        $total_dias = 0; // total declarado antes del bucle

        while ($array = mysqli_fetch_array($resultado)) {
          $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
        }

        $suma_meses = "SELECT SUM(meses) AS meses_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
        $cantidad_meses = mysqli_query($con, $suma_meses);
        $array_2 = mysqli_fetch_array($cantidad_meses);
        $total_meses = $array_2['meses_total'];

        $total_meses = $total_meses * 31;

        $suma_anios = "SELECT SUM(anios) AS anios_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
        $cantidad_anios = mysqli_query($con, $suma_anios);
        $array_3 = mysqli_fetch_array($cantidad_anios);
        $total_anios = $array_3['anios_total'];

        $total_anios = $total_anios * 365;

        $total_total_dias = $total_dias + $total_meses + $total_anios;

        if ($total_total_dias >= $total_anios_requerido) {
          $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
              VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

          $result = MYSQLI_query($con, $sql);
          if ($result) {
            echo "Se realizó con éxito registrar la postulación.";
          } else {
            echo "Error al guardar la postulación.";
          }
          mysqli_close($con);
        } else {
          echo "No cumple con el tiempo de experiencia laboral mínimo requerido.";
        }
      }
    } else {
      echo "No cumple con ser TITULADO técnico.";
    }
  } elseif ($tipo_estudios_id == $reque_tipo_estudios_max) {
    $nivel_estudio_max = $rw['nivel_estudio_max'];
    if ($nivel_estudio_max == "ESTUDIANTE") {
      $ciclo_actual = $row['ciclo_actual'];
      if ($ciclo_actual == "XIII" || $ciclo_actual == "IX" || $ciclo_actual == "X") {
        if ($tipo_experiencia == 'anios') {
          $cantidad_experiencia = $rw['cantidad_experiencia'];
          $total_anios_requerido = $cantidad_experiencia * '365';

          $experiencia = "SELECT * FROM sistema_seleccion.expe_4puntos 
          WHERE expe_4puntos_idpostulante = '$idpostulante' UNION
          SELECT * FROM sistema_seleccion.expe_3puntos 
          WHERE expe_3puntos_idpostulante = '$idpostulante' UNION
          SELECT * FROM sistema_seleccion.expe_1puntos
          WHERE expe_1puntos_idpostulante = '$idpostulante'";
          $resultado = MYSQLI_query($con, $experiencia);
          $total_dias = 0; // total declarado antes del bucle

          while ($array = mysqli_fetch_array($resultado)) {
            $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
          }

          $suma_meses = "SELECT SUM(meses) AS meses_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
          $cantidad_meses = mysqli_query($con, $suma_meses);
          $array_2 = mysqli_fetch_array($cantidad_meses);
          $total_meses = $array_2['meses_total'];

          $total_meses = $total_meses * 31;

          $suma_anios = "SELECT SUM(anios) AS anios_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
          $cantidad_anios = mysqli_query($con, $suma_anios);
          $array_3 = mysqli_fetch_array($cantidad_anios);
          $total_anios = $array_3['anios_total'];

          $total_anios = $total_anios * 365;

          $total_total_dias = $total_dias + $total_meses + $total_anios;

          if ($total_total_dias >= $total_anios_requerido) {
            $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
              VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

            $result = MYSQLI_query($con, $sql);
            if ($result) {
              echo "Postulación registrada correctamente.";
            } else {
              echo "Error al guardar la postulación.";
            }
            mysqli_close($con);
          } else {
            echo "No cumple con los años de experiencia laboral mínimos requeridos.";
          }
        } elseif ($tipo_experiencia == 'meses') {
          $cantidad_experiencia = $rw['cantidad_experiencia'];
          $total_anios_requerido = $cantidad_experiencia * '30';

          $experiencia = "SELECT * FROM sistema_seleccion.expe_4puntos 
          WHERE expe_4puntos_idpostulante = '$idpostulante' UNION
          SELECT * FROM sistema_seleccion.expe_3puntos 
          WHERE expe_3puntos_idpostulante = '$idpostulante' UNION
          SELECT * FROM sistema_seleccion.expe_1puntos
          WHERE expe_1puntos_idpostulante = '$idpostulante'";
          $resultado = MYSQLI_query($con, $experiencia);
          $total_dias = 0; // total declarado antes del bucle

          while ($array = mysqli_fetch_array($resultado)) {
            $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
          }

          $suma_meses = "SELECT SUM(meses) AS meses_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
          $cantidad_meses = mysqli_query($con, $suma_meses);
          $array_2 = mysqli_fetch_array($cantidad_meses);
          $total_meses = $array_2['meses_total'];

          $total_meses = $total_meses * 31;

          $suma_anios = "SELECT SUM(anios) AS anios_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
          $cantidad_anios = mysqli_query($con, $suma_anios);
          $array_3 = mysqli_fetch_array($cantidad_anios);
          $total_anios = $array_3['anios_total'];

          $total_anios = $total_anios * 365;

          $total_total_dias = $total_dias + $total_meses + $total_anios;

          if ($total_total_dias >= $total_anios_requerido) {
            $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
              VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

            $result = MYSQLI_query($con, $sql);
            if ($result) {
              echo "Postulación registrada correctamente.";
            } else {
              echo "Error al guardar la postulación.";
            }
            mysqli_close($con);
          } else {
            echo "No cumple con los meses de experiencia laboral mínimos requeridos.";
          }
        }
      } else {
        echo "No cumple con el ciclo mínimo requerido.";
      }
    } elseif ($nivel_estudio_max == "EGRESADO") {
      if ($tipo_experiencia == 'anios') {
        $cantidad_experiencia = $rw['cantidad_experiencia'];
        $total_anios_requerido = $cantidad_experiencia * '365';

        $experiencia = "SELECT * FROM sistema_seleccion.expe_4puntos 
        WHERE expe_4puntos_idpostulante = '$idpostulante' UNION
        SELECT * FROM sistema_seleccion.expe_3puntos 
        WHERE expe_3puntos_idpostulante = '$idpostulante' UNION
        SELECT * FROM sistema_seleccion.expe_1puntos
        WHERE expe_1puntos_idpostulante = '$idpostulante'";
        $resultado = MYSQLI_query($con, $experiencia);
        $total_dias = 0; // total declarado antes del bucle

        while ($array = mysqli_fetch_array($resultado)) {
          $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
        }

        $suma_meses = "SELECT SUM(meses) AS meses_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
        $cantidad_meses = mysqli_query($con, $suma_meses);
        $array_2 = mysqli_fetch_array($cantidad_meses);
        $total_meses = $array_2['meses_total'];

        $total_meses = $total_meses * 31;

        $suma_anios = "SELECT SUM(anios) AS anios_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
        $cantidad_anios = mysqli_query($con, $suma_anios);
        $array_3 = mysqli_fetch_array($cantidad_anios);
        $total_anios = $array_3['anios_total'];

        $total_anios = $total_anios * 365;

        $total_total_dias = $total_dias + $total_meses + $total_anios;

        if ($total_total_dias >= $total_anios_requerido) {
          $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
              VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

          $result = MYSQLI_query($con, $sql);
          if ($result) {
            echo "Se realizó con éxito registrar la postulación.";
          } else {
            echo "Error al guardar la postulación.";
          }
          mysqli_close($con);
        } else {
          echo "No cumple con el tiempo de experiencia laboral mínimo requerido.";
        }
      } elseif ($tipo_experiencia == 'meses') {
        $cantidad_experiencia = $rw['cantidad_experiencia'];
        $total_anios_requerido = $cantidad_experiencia * '30';

        $experiencia = "SELECT * FROM sistema_seleccion.expe_4puntos 
        WHERE expe_4puntos_idpostulante = '$idpostulante' UNION
        SELECT * FROM sistema_seleccion.expe_3puntos 
        WHERE expe_3puntos_idpostulante = '$idpostulante' UNION
        SELECT * FROM sistema_seleccion.expe_1puntos
        WHERE expe_1puntos_idpostulante = '$idpostulante'";
        $resultado = MYSQLI_query($con, $experiencia);
        $total_dias = 0; // total declarado antes del bucle

        while ($array = mysqli_fetch_array($resultado)) {
          $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
        }

        $suma_meses = "SELECT SUM(meses) AS meses_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
        $cantidad_meses = mysqli_query($con, $suma_meses);
        $array_2 = mysqli_fetch_array($cantidad_meses);
        $total_meses = $array_2['meses_total'];

        $total_meses = $total_meses * 31;

        $suma_anios = "SELECT SUM(anios) AS anios_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
        $cantidad_anios = mysqli_query($con, $suma_anios);
        $array_3 = mysqli_fetch_array($cantidad_anios);
        $total_anios = $array_3['anios_total'];

        $total_anios = $total_anios * 365;

        $total_total_dias = $total_dias + $total_meses + $total_anios;

        if ($total_total_dias >= $total_anios_requerido) {
          $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
              VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

          $result = MYSQLI_query($con, $sql);
          if ($result) {
            echo "Se realizó con éxito registrar la postulación.";
          } else {
            echo "Error al guardar la postulación.";
          }
          mysqli_close($con);
        } else {
          echo "No cumple con el tiempo de experiencia laboral mínimo requerido.";
        }
      }
    } elseif ($nivel_estudio_max == "BACHILLER") {
      echo "No cumple con los estudios requeridos.";
    } else {
      echo "No cumple con los estudios mínimos requeridos.";
    }
  } {
    echo "No cumple con los estudios mínimos requeridos.";
  }
} elseif ($reque_tipo_estudios == '3') {
  if ($tipo_estudios_id == $reque_tipo_estudios) {
    $nivel_estudio = $row['nivel_estudios'];
    $nivel_estudio_req = $rw['nivel_estudio'];
    $nivel_estudio_max = $rw['nivel_estudio_max'];
    if ($nivel_estudio == "ESTUDIANTE" || $nivel_estudio_max == "ESTUDIANTE") {
      if ($nivel_estudio = $nivel_estudio_req) {
        $ciclo_actual = $row['ciclo_actual'];
        $ciclo_actual_req = $rw['ciclo_actual'];
        if ($ciclo_actual == $ciclo_actual_req) {
          if ($tipo_experiencia == 'anios') {
            $cantidad_experiencia = $rw['cantidad_experiencia'];
            $total_anios_requerido = $cantidad_experiencia * '365';

            $experiencia = "SELECT * FROM sistema_seleccion.expe_4puntos 
            where expe_4puntos_idpostulante = '$idpostulante' UNION
            SELECT * FROM sistema_seleccion.expe_3puntos 
            where expe_3puntos_idpostulante = '$idpostulante' UNION
            SELECT * FROM sistema_seleccion.expe_1puntos
            where expe_1puntos_idpostulante = '$idpostulante'";
            $resultado = MYSQLI_query($con, $experiencia);
            $total_dias = 0; // total declarado antes del bucle

            while ($array = mysqli_fetch_array($resultado)) {
              $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
            }

            $suma_meses = "SELECT SUM(meses) AS meses_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
            $cantidad_meses = mysqli_query($con, $suma_meses);
            $array_2 = mysqli_fetch_array($cantidad_meses);
            $total_meses = $array_2['meses_total'];

            $total_meses = $total_meses * 31;

            $suma_anios = "SELECT SUM(anios) AS anios_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
            $cantidad_anios = mysqli_query($con, $suma_anios);
            $array_3 = mysqli_fetch_array($cantidad_anios);
            $total_anios = $array_3['anios_total'];

            $total_anios = $total_anios * 365;

            $total_total_dias = $total_dias + $total_meses + $total_anios;
            if ($total_total_dias >= $total_anios_requerido) {
              $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
              VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

              $result = MYSQLI_query($con, $sql);
              if ($result) {
                echo "Postulación registrada correctamente.";
              } else {
                echo "Error al guardar la postulación.";
              }
              mysqli_close($con);
            } else {
              echo "No cumple con el tiempo de experiencia laboral mínimo requerido.";
            }
          } elseif ($tipo_experiencia == 'meses') {
            $cantidad_experiencia = $rw['cantidad_experiencia'];
            $total_anios_requerido = $cantidad_experiencia * '30';

            $experiencia = "SELECT * FROM sistema_seleccion.expe_4puntos 
            where expe_4puntos_idpostulante = '$idpostulante' UNION
            SELECT * FROM sistema_seleccion.expe_3puntos 
            where expe_3puntos_idpostulante = '$idpostulante' UNION
            SELECT * FROM sistema_seleccion.expe_1puntos
            where expe_1puntos_idpostulante = '$idpostulante'";
            $resultado = MYSQLI_query($con, $experiencia);
            $total_dias = 0; // total declarado antes del bucle

            while ($array = mysqli_fetch_array($resultado)) {
              $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
            }

            $suma_meses = "SELECT SUM(meses) AS meses_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
            $cantidad_meses = mysqli_query($con, $suma_meses);
            $array_2 = mysqli_fetch_array($cantidad_meses);
            $total_meses = $array_2['meses_total'];

            $total_meses = $total_meses * 31;

            $suma_anios = "SELECT SUM(anios) AS anios_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
            $cantidad_anios = mysqli_query($con, $suma_anios);
            $array_3 = mysqli_fetch_array($cantidad_anios);
            $total_anios = $array_3['anios_total'];

            $total_anios = $total_anios * 365;

            $total_total_dias = $total_dias + $total_meses + $total_anios;

            if ($total_total_dias >= $total_anios_requerido) {
              $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
              VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

              $result = MYSQLI_query($con, $sql);
              if ($result) {
                echo "Postulación registrada correctamente.";
              } else {
                echo "Error al guardar la postulación.";
              }
              mysqli_close($con);
            } else {
              echo "No cumple con el tiempo de experiencia laboral mínimo requerido.";
            }
          }
        } elseif ($ciclo_actual == "IX" || $ciclo_actual == "X") {
          if ($tipo_experiencia == 'anios') {
            $cantidad_experiencia = $rw['cantidad_experiencia'];
            $total_anios_requerido = $cantidad_experiencia * '365';

            $experiencia = "SELECT * FROM sistema_seleccion.expe_4puntos 
            where expe_4puntos_idpostulante = '$idpostulante' UNION
            SELECT * FROM sistema_seleccion.expe_3puntos 
            where expe_3puntos_idpostulante = '$idpostulante' UNION
            SELECT * FROM sistema_seleccion.expe_1puntos
            where expe_1puntos_idpostulante = '$idpostulante'";
            $resultado = MYSQLI_query($con, $experiencia);
            $total_dias = 0; // total declarado antes del bucle

            while ($array = mysqli_fetch_array($resultado)) {
              $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
            }

            $suma_meses = "SELECT SUM(meses) AS meses_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
            $cantidad_meses = mysqli_query($con, $suma_meses);
            $array_2 = mysqli_fetch_array($cantidad_meses);
            $total_meses = $array_2['meses_total'];

            $total_meses = $total_meses * 31;

            $suma_anios = "SELECT SUM(anios) AS anios_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
            $cantidad_anios = mysqli_query($con, $suma_anios);
            $array_3 = mysqli_fetch_array($cantidad_anios);
            $total_anios = $array_3['anios_total'];

            $total_anios = $total_anios * 365;

            $total_total_dias = $total_dias + $total_meses + $total_anios;

            if ($total_total_dias >= $total_anios_requerido) {
              $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
              VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

              $result = MYSQLI_query($con, $sql);
              if ($result) {
                echo "Postulación registrada correctamente.";
              } else {
                echo "Error al guardar la postulación.";
              }
              mysqli_close($con);
            } else {
              echo "No cumple con el tiempo de experiencia laboral mínimo requerido.";
            }
          } elseif ($tipo_experiencia == 'meses') {
            $cantidad_experiencia = $rw['cantidad_experiencia'];
            $total_anios_requerido = $cantidad_experiencia * '30';

            $experiencia = "SELECT * FROM sistema_seleccion.expe_4puntos 
            WHERE expe_4puntos_idpostulante = '$idpostulante' UNION
            SELECT * FROM sistema_seleccion.expe_3puntos 
            WHERE expe_3puntos_idpostulante = '$idpostulante' UNION
            SELECT * FROM sistema_seleccion.expe_1puntos
            WHERE expe_1puntos_idpostulante = '$idpostulante'";
            $resultado = MYSQLI_query($con, $experiencia);
            $total_dias = 0; // total declarado antes del bucle

            while ($array = mysqli_fetch_array($resultado)) {
              $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
            }

            $suma_meses = "SELECT SUM(meses) AS meses_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
            $cantidad_meses = mysqli_query($con, $suma_meses);
            $array_2 = mysqli_fetch_array($cantidad_meses);
            $total_meses = $array_2['meses_total'];

            $total_meses = $total_meses * 31;

            $suma_anios = "SELECT SUM(anios) AS anios_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
            $cantidad_anios = mysqli_query($con, $suma_anios);
            $array_3 = mysqli_fetch_array($cantidad_anios);
            $total_anios = $array_3['anios_total'];

            $total_anios = $total_anios * 365;

            $total_total_dias = $total_dias + $total_meses + $total_anios;

            if ($total_total_dias >= $total_anios_requerido) {
              $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
              VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

              $result = MYSQLI_query($con, $sql);
              if ($result) {
                echo "Postulación registrada correctamente.";
              } else {
                echo "Error al guardar la postulación.";
              }
              mysqli_close($con);
            } else {
              echo "No cumple con el tiempo de experiencia laboral mínimo requerido.";
            }
          }
        } else {
          echo "No cumple con el ciclo mínimo requerido";
        }
      }
    } elseif ($nivel_estudio == 'EGRESADO' || $nivel_estudio ==  'BACHILLER') {
      if ($tipo_experiencia == 'anios') {
        $cantidad_experiencia = $rw['cantidad_experiencia'];
        $total_anios_requerido = $cantidad_experiencia * '365';

        $experiencia = "SELECT * FROM sistema_seleccion.expe_4puntos 
        where expe_4puntos_idpostulante = '$idpostulante' UNION
        SELECT * FROM sistema_seleccion.expe_3puntos 
        where expe_3puntos_idpostulante = '$idpostulante' UNION
        SELECT * FROM sistema_seleccion.expe_1puntos
        where expe_1puntos_idpostulante = '$idpostulante'";
        $resultado = MYSQLI_query($con, $experiencia);
        $total_dias = 0; // total declarado antes del bucle

        while ($array = mysqli_fetch_array($resultado)) {
          $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
        }

        $suma_meses = "SELECT SUM(meses) AS meses_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
        $cantidad_meses = mysqli_query($con, $suma_meses);
        $array_2 = mysqli_fetch_array($cantidad_meses);
        $total_meses = $array_2['meses_total'];

        $total_meses = $total_meses * 31;

        $suma_anios = "SELECT SUM(anios) AS anios_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
        $cantidad_anios = mysqli_query($con, $suma_anios);
        $array_3 = mysqli_fetch_array($cantidad_anios);
        $total_anios = $array_3['anios_total'];

        $total_anios = $total_anios * 365;

        $total_total_dias = $total_dias + $total_meses + $total_anios;

        if ($total_total_dias >= $total_anios_requerido) {
          $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
              VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

          $result = MYSQLI_query($con, $sql);
          if ($result) {
            header('Location: ../mispostulaciones.php?dni=' . $dni);
          } else {
            echo "Error al guardar la postulación.";
          }
          mysqli_close($con);
        } else {
          echo '<script> alert("No cumple con el tiempo de experiencia laboral requerdo."); 
              window.history.back(-1);</script>';
        }
      } elseif ($tipo_experiencia == 'meses') {
        $cantidad_experiencia = $rw['cantidad_experiencia'];
        $total_anios_requerido = $cantidad_experiencia * '30';

        $experiencia = "SELECT * FROM sistema_seleccion.expe_4puntos 
        where expe_4puntos_idpostulante = '$idpostulante' UNION
        SELECT * FROM sistema_seleccion.expe_3puntos 
        where expe_3puntos_idpostulante = '$idpostulante' UNION
        SELECT * FROM sistema_seleccion.expe_1puntos
        where expe_1puntos_idpostulante = '$idpostulante'";
        $resultado = MYSQLI_query($con, $experiencia);
        $total_dias = 0; // total declarado antes del bucle

        while ($array = mysqli_fetch_array($resultado)) {
          $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
        }

        $suma_meses = "SELECT SUM(meses) AS meses_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
        $cantidad_meses = mysqli_query($con, $suma_meses);
        $array_2 = mysqli_fetch_array($cantidad_meses);
        $total_meses = $array_2['meses_total'];

        $total_meses = $total_meses * 31;

        $suma_anios = "SELECT SUM(anios) AS anios_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
        $cantidad_anios = mysqli_query($con, $suma_anios);
        $array_3 = mysqli_fetch_array($cantidad_anios);
        $total_anios = $array_3['anios_total'];

        $total_anios = $total_anios * 365;

        $total_total_dias = $total_dias + $total_meses + $total_anios;

        if ($total_total_dias >= $total_anios_requerido) {
          $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
              VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

          $result = MYSQLI_query($con, $sql);
          if ($result) {
            header('Location: ../mispostulaciones.php?dni=' . $dni);
          } else {
            echo '<script> alert("Error al guardar la postulación."); 
              window.history.back(-1);</script>';
          }
          mysqli_close($con);
        } else {
          echo '<script> alert("No cumple con el tiempo de experiencia laboral requerdo."); 
              window.history.back(-1);</script>';
        }
      }
    } elseif ($nivel_estudio == 'TITULADO') {
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
                $experiencia = "SELECT * FROM sistema_seleccion.expe_4puntos 
                where expe_4puntos_idpostulante = '$idpostulante' UNION
                SELECT * FROM sistema_seleccion.expe_3puntos 
                where expe_3puntos_idpostulante = '$idpostulante' UNION
                SELECT * FROM sistema_seleccion.expe_1puntos
                where expe_1puntos_idpostulante = '$idpostulante'";
                $resultado = MYSQLI_query($con, $experiencia);
                $total_dias = 0; // total declarado antes del bucle

                while ($array = mysqli_fetch_array($resultado)) {
                  $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
                }

                $suma_meses = "SELECT SUM(meses) AS meses_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
                $cantidad_meses = mysqli_query($con, $suma_meses);
                $array_2 = mysqli_fetch_array($cantidad_meses);
                $total_meses = $array_2['meses_total'];

                $total_meses = $total_meses * 31;

                $suma_anios = "SELECT SUM(anios) AS anios_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
                $cantidad_anios = mysqli_query($con, $suma_anios);
                $array_3 = mysqli_fetch_array($cantidad_anios);
                $total_anios = $array_3['anios_total'];

                $total_anios = $total_anios * 365;

                $total_total_dias = $total_dias + $total_meses + $total_anios;

                if ($total_total_dias >= $total_anios_requerido) {
                  $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
                  VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

                  $result = MYSQLI_query($con, $sql);
                  if ($result) {
                    echo "Postulación registrada correctamente.";
                  } else {
                    echo "Error al guardar la postulación.";
                  }
                  mysqli_close($con);
                } else {
                  echo "No cumple con el tiempo de experiencia laboral mínimo requerido.";
                }
              } elseif ($tipo_experiencia == 'meses') {
                $cantidad_experiencia = $rw['cantidad_experiencia'];
                $total_anios_requerido = $cantidad_experiencia * '30';

                $experiencia = "SELECT * FROM sistema_seleccion.expe_4puntos 
                where expe_4puntos_idpostulante = '$idpostulante' UNION
                SELECT * FROM sistema_seleccion.expe_3puntos 
                where expe_3puntos_idpostulante = '$idpostulante' UNION
                SELECT * FROM sistema_seleccion.expe_1puntos
                where expe_1puntos_idpostulante = '$idpostulante'";
                $resultado = MYSQLI_query($con, $experiencia);
                $total_dias = 0; // total declarado antes del bucle

                while ($array = mysqli_fetch_array($resultado)) {
                  $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
                }

                $suma_meses = "SELECT SUM(meses) AS meses_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
                $cantidad_meses = mysqli_query($con, $suma_meses);
                $array_2 = mysqli_fetch_array($cantidad_meses);
                $total_meses = $array_2['meses_total'];

                $total_meses = $total_meses * 31;

                $suma_anios = "SELECT SUM(anios) AS anios_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
                $cantidad_anios = mysqli_query($con, $suma_anios);
                $array_3 = mysqli_fetch_array($cantidad_anios);
                $total_anios = $array_3['anios_total'];

                $total_anios = $total_anios * 365;

                $total_total_dias = $total_dias + $total_meses + $total_anios;

                if ($total_total_dias >= $total_anios_requerido) {
                  $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
                  VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

                  $result = MYSQLI_query($con, $sql);
                  if ($result) {
                    echo "Postulación registrada correctamente.";
                  } else {
                    echo "Error al guardar la postulación.";
                  }
                  mysqli_close($con);
                } else {
                  echo "No cumple con el tiempo de experiencia laboral mínimo requerido.";
                }
              }
            } else {
              echo "No cumple con el serums requerido.";
            }
          } else {
            echo "La fecha de habilitación profesional está vencida.";
          }
        } else {
          echo "No tiene habilitación profesional.";
        }
      } else {
        "No cumple con la colegiatura.";
      }
    } else {
      echo "No cumple con el tiempo de experiencia laboral mínimo requerido.";
    }
  } elseif ($tipo_estudios_id == $reque_tipo_estudios_max) {
    if ($nivel_estudio_max == 'TITULADO') {
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
                $experiencia = "SELECT * FROM sistema_seleccion.expe_4puntos 
                where expe_4puntos_idpostulante = '$idpostulante' UNION
                SELECT * FROM sistema_seleccion.expe_3puntos 
                where expe_3puntos_idpostulante = '$idpostulante' UNION
                SELECT * FROM sistema_seleccion.expe_1puntos
                where expe_1puntos_idpostulante = '$idpostulante'";
                $resultado = MYSQLI_query($con, $experiencia);
                $total_dias = 0; // total declarado antes del bucle

                while ($array = mysqli_fetch_array($resultado)) {
                  $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
                }

                $suma_meses = "SELECT SUM(meses) AS meses_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
                $cantidad_meses = mysqli_query($con, $suma_meses);
                $array_2 = mysqli_fetch_array($cantidad_meses);
                $total_meses = $array_2['meses_total'];

                $total_meses = $total_meses * 31;

                $suma_anios = "SELECT SUM(anios) AS anios_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
                $cantidad_anios = mysqli_query($con, $suma_anios);
                $array_3 = mysqli_fetch_array($cantidad_anios);
                $total_anios = $array_3['anios_total'];

                $total_anios = $total_anios * 365;

                $total_total_dias = $total_dias + $total_meses + $total_anios;

                if ($total_total_dias >= $total_anios_requerido) {
                  $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
                  VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

                  $result = MYSQLI_query($con, $sql);
                  if ($result) {
                    echo "Postulación registrada correctamente.";
                  } else {
                    echo "Error al guardar la postulación.";
                  }
                  mysqli_close($con);
                } else {
                  echo "No cumple con el tiempo de experiencia laboral mínimo requerido.";
                }
              } elseif ($tipo_experiencia == 'meses') {
                $cantidad_experiencia = $rw['cantidad_experiencia'];
                $total_anios_requerido = $cantidad_experiencia * '30';

                $experiencia = "SELECT * FROM sistema_seleccion.expe_4puntos 
                where expe_4puntos_idpostulante = '$idpostulante' UNION
                SELECT * FROM sistema_seleccion.expe_3puntos 
                where expe_3puntos_idpostulante = '$idpostulante' UNION
                SELECT * FROM sistema_seleccion.expe_1puntos
                where expe_1puntos_idpostulante = '$idpostulante'";
                $resultado = MYSQLI_query($con, $experiencia);
                $total_dias = 0; // total declarado antes del bucle

                while ($array = mysqli_fetch_array($resultado)) {
                  $total_dias = $total_dias + $array['dias']; // Sumar variable $total + resultado de la consulta
                }

                $suma_meses = "SELECT SUM(meses) AS meses_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
                $cantidad_meses = mysqli_query($con, $suma_meses);
                $array_2 = mysqli_fetch_array($cantidad_meses);
                $total_meses = $array_2['meses_total'];

                $total_meses = $total_meses * 31;

                $suma_anios = "SELECT SUM(anios) AS anios_total FROM total_expe WHERE expe_4puntos_idpostulante = '$idpostulante'";
                $cantidad_anios = mysqli_query($con, $suma_anios);
                $array_3 = mysqli_fetch_array($cantidad_anios);
                $total_anios = $array_3['anios_total'];

                $total_anios = $total_anios * 365;

                $total_total_dias = $total_dias + $total_meses + $total_anios;

                if ($total_total_dias >= $total_anios_requerido) {
                  $sql = "INSERT INTO detalle_convocatoria (convocatoria_idcon, postulante_idpostulante, personal_req_idpersonal, fecha_postulacion) 
                  VALUES ('" . $idcon . "','" . $idpostulante . "','" . $personal_req . "','" . $date . "')";

                  $result = MYSQLI_query($con, $sql);
                  if ($result) {
                    echo "Postulación registrada correctamente.";
                  } else {
                    echo "Error al guardar la postulación.";
                  }
                  mysqli_close($con);
                } else {
                  echo "No cumple con el tiempo de experiencia laboral mínimo requerido.";
                }
              }
            } else {
              echo "No cumple con el serums requerido.";
            }
          } else {
            echo "La fecha de habilitación profesional está vencida.";
          }
        } else {
          echo "No tiene habilitación profesional.";
        }
      } else {
        echo "No cumple con la colegiatura.";
      }
    } else {
      echo "No cumple con el tiempo de experiencia laboral mínimo requerido.";
    }
  } else {
    echo "No cumple con los estudios de formación requeridos.";
  }
}
