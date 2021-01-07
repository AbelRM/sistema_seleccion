<?php

include '../conexion.php';

// echo "VALOR ENVIADO";
$dni = $_POST['dni_comision'];

$practicas_idcon = intval($_POST['practicas_idcon']);
$idpostulante = intval($_POST['idpostulante']);
$personal_req = intval($_POST['practicante_req']);

// $tipo_convocatoria = 'PRACTICANTE';
date_default_timezone_set('America/Lima');
$date = date('Y-m-d H:i:s');

$consul_detalle_prac = MYSQLI_query($con, "SELECT * FROM detalle_conv_prac WHERE idpracticas_conv ='$practicas_idcon' AND detalle_prac_idpostulante ='$idpostulante' AND practicantel_req_idpracticantes_req ='$personal_req'");
$ar = mysqli_fetch_array($consul_detalle_prac);
$iddetalle_conv_prac = $ar['iddetalle_conv_prac'];
$puntos_total_cv = $ar['puntos_total_cv'];


$consul_formac = MYSQLI_query($con, "SELECT * FROM formacion_acad_prac WHERE formacion_acad_prac_idpostulante ='$idpostulante'");
$rw = mysqli_fetch_array($consul_formac);
$formacion_validacion = $rw['formacion_validacion'];
$nivel_estudios = $rw['nivel_estudios'];
$orden_merito = $rw['orden_merito'];
$responder = array();
if ($formacion_validacion == 'VALIDO') {
  $consul_cursos = MYSQLI_query($con, "SELECT * FROM cursos_extra WHERE curso_extra_idpostulante ='$idpostulante' AND curso_validacion='VALIDO'");
  $fil_cursos = mysqli_num_rows($consul_cursos);
  if ($fil_cursos > 0) {
    $consul_idioma = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante ='$idpostulante' AND idioma_validacion='VALIDO'");
    $fil_idioma = mysqli_num_rows($consul_idioma);
    if ($fil_idioma > 0) {
      //PUNTAJE FORMACION
      if ($nivel_estudios == 'ESTUDIANTE' || $nivel_estudios == 'EGRESADO') {
        $puntos_formacion = 8;
      } else {
        $puntos_formacion = 0;
      }
      //PUNNTAJE ORDEN DE MERITO 
      if ($orden_merito == 'QUINTO SUPERIOR') {
        $puntos_ubi = 2;
      } elseif ($orden_merito == 'TERCIO SUPERIOR') {
        $puntos_ubi = 1;
      } else {
        $puntos_ubi = 0;
      }
      //PUNTAJE CURSOS
      if ($fil_cursos >= 5) {
        $puntos_cursos = 5;
      } else {
        $puntos_cursos = $fil_cursos;
      }
      //PUNTAJE COMPUTO/INGLES
      $consulta_3 = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante='$idpostulante' AND idioma_comp = 'COMPUTACION / OFIMATICA' AND idioma_validacion='VALIDO'");
      $consulta_4 = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante='$idpostulante' AND idioma_comp = 'IDIOMA' AND idioma_validacion='VALIDO'");
      $consulta_5 = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante='$idpostulante' AND idioma_comp = 'MOTIVACION / LIDERAZGO' AND idioma_validacion='VALIDO'");

      if (mysqli_num_rows($consulta_3) > 0) {
        $nro_comp = mysqli_num_rows($consulta_3);
        if ($nro_comp >= 3) {
          $puntos_comp = 3;
        } else {
          $puntos_comp = $nro_comp;
        }
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

      $sql = "UPDATE detalle_conv_prac SET puntos_form = '" . $puntos_formacion . "',puntos_cursos='" . $puntos_cursos    . "',puntos_ubi='" . $puntos_ubi . "',puntos_comp='" . $puntos_comp . "',puntos_idioma='" . $puntos_idioma . "',puntos_lider='" . $puntos_lider . "', puntos_total_cv='" . $totalPuntaje . "',estado_entrevista = 'NO AGREGADO', dni_comision_update ='" . $dni . "', fech_update_comision ='" . $date . "', estado_conv_prac='APTO' ";
      $result = MYSQLI_query($con, $sql);

      if ($result) {
        $responder =  array('r' => 1, 'dni' => $dni, 'idpracticas' => $practicas_idcon, 'idpracticantes_req' => $personal_req, 'mensaje' => "Se registro correctamente");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      } else {
        $responder =  array('r' => 0, 'dni' => $dni, 'idpracticas' => $practicas_idcon, 'idpracticantes_req' => $personal_req, 'mensaje' => "Hubo un error al actualizar los datos.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      }
    } else {
      //PUNTAJE FORMACION
      if ($nivel_estudios == 'ESTUDIANTE' || $nivel_estudios == 'EGRESADO') {
        $puntos_formacion = 8;
      } else {
        $puntos_formacion = 0;
      }
      //PUNNTAJE ORDEN DE MERITO 
      if ($orden_merito == 'QUINTO SUPERIOR') {
        $puntos_ubi = 2;
      } elseif ($orden_merito == 'TERCIO SUPERIOR') {
        $puntos_ubi = 1;
      } else {
        $puntos_ubi = 0;
      }
      //PUNTAJE CURSOS
      if ($fil_cursos >= 5) {
        $puntos_cursos = 5;
      } else {
        $puntos_cursos = $fil_cursos;
      }
      //PUNTAJE COMPUTO, IDIOMA Y ETICA
      $puntos_comp = 0;

      $puntos_idioma = 0;

      $puntos_lider = 0;

      $totalPuntaje = $puntos_formacion + $puntos_cursos + $puntos_ubi + $puntos_comp + $puntos_idioma + $puntos_lider;

      $sql = "UPDATE detalle_conv_prac SET puntos_form = '" . $puntos_formacion . "',puntos_cursos='" . $puntos_cursos    . "',puntos_ubi='" . $puntos_ubi . "',puntos_comp='" . $puntos_comp . "',puntos_idioma='" . $puntos_idioma . "',puntos_lider='" . $puntos_lider . "', puntos_total_cv='" . $totalPuntaje . "',estado_entrevista = 'NO AGREGADO', dni_comision_update ='" . $dni . "', fech_update_comision ='" . $date . "',estado_conv_prac='APTO' ";
      $result = MYSQLI_query($con, $sql);

      if ($result) {
        $responder =  array('r' => 1, 'dni' => $dni, 'idpracticas' => $practicas_idcon, 'idpracticantes_req' => $personal_req, 'mensaje' => "Se registro correctamente");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      } else {
        $responder =  array('r' => 0, 'dni' => $dni, 'idpracticas' => $practicas_idcon, 'idpracticantes_req' => $personal_req, 'mensaje' => "Hubo un error al actualizar los datos.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      }
      // $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "No hay Idiomas y/o Computación que evaluar.");
      // echo json_encode($responder, JSON_UNESCAPED_UNICODE);
    }
  } else {
    //PUNTAJE FORMACION
    if ($nivel_estudios == 'ESTUDIANTE' || $nivel_estudios == 'EGRESADO') {
      $puntos_formacion = 8;
    } else {
      $puntos_formacion = 0;
    }
    //PUNNTAJE ORDEN DE MERITO 
    if ($orden_merito == 'QUINTO SUPERIOR') {
      $puntos_ubi = 2;
    } elseif ($orden_merito == 'TERCIO SUPERIOR') {
      $puntos_ubi = 1;
    } else {
      $puntos_ubi = 0;
    }
    //PUNTAJE CURSOS
    $puntos_cursos =  0;
    $consul_idioma = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante ='$idpostulante' AND idioma_validacion='VALIDO'");
    $fil_idioma = mysqli_num_rows($consul_idioma);
    if ($fil_idioma > 0) {
      //PUNTAJE COMPUTO/INGLES
      $consulta_3 = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante='$idpostulante' AND idioma_comp = 'COMPUTACION / OFIMATICA' AND idioma_validacion='VALIDO'");
      $consulta_4 = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante='$idpostulante' AND idioma_comp = 'IDIOMA' AND idioma_validacion='VALIDO'");
      $consulta_5 = MYSQLI_query($con, "SELECT * FROM idiomas_comp WHERE idpostulante_postulante='$idpostulante' AND idioma_comp = 'MOTIVACION / LIDERAZGO' AND idioma_validacion='VALIDO'");

      if (mysqli_num_rows($consulta_3) > 0) {
        $nro_comp = mysqli_num_rows($consulta_3);
        if ($nro_comp >= 3) {
          $puntos_comp = 3;
        } else {
          $puntos_comp = $nro_comp;
        }
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

      $sql = "UPDATE detalle_conv_prac SET puntos_form = '" . $puntos_formacion . "',puntos_cursos='" . $puntos_cursos    . "',puntos_ubi='" . $puntos_ubi . "',puntos_comp='" . $puntos_comp . "',puntos_idioma='" . $puntos_idioma . "',puntos_lider='" . $puntos_lider . "', puntos_total_cv='" . $totalPuntaje . "',estado_entrevista = 'NO AGREGADO', dni_comision_update ='" . $dni . "', fech_update_comision ='" . $date . "',estado_conv_prac='APTO' ";
      $result = MYSQLI_query($con, $sql);

      if ($result) {
        $responder =  array('r' => 1, 'dni' => $dni, 'idpracticas' => $practicas_idcon, 'idpracticantes_req' => $personal_req, 'mensaje' => "Se registro correctamente");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      } else {
        $responder =  array('r' => 0, 'dni' => $dni, 'idpracticas' => $practicas_idcon, 'idpracticantes_req' => $personal_req, 'mensaje' => "Hubo un error al actualizar los datos.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      }
    } else {
      $puntos_comp = 0;
      $puntos_idioma = 0;
      $puntos_lider = 0;
      $totalPuntaje = $puntos_formacion + $puntos_cursos + $puntos_ubi + $puntos_comp + $puntos_idioma + $puntos_lider;

      $sql = "UPDATE detalle_conv_prac SET puntos_form = '" . $puntos_formacion . "',puntos_cursos='" . $puntos_cursos    . "',puntos_ubi='" . $puntos_ubi . "',puntos_comp='" . $puntos_comp . "',puntos_idioma='" . $puntos_idioma . "',puntos_lider='" . $puntos_lider . "', puntos_total_cv='" . $totalPuntaje . "',estado_entrevista = 'NO AGREGADO', dni_comision_update ='" . $dni . "', fech_update_comision ='" . $date . "',estado_conv_prac='APTO' ";
      $result = MYSQLI_query($con, $sql);

      if ($result) {
        $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "Se registro correctamente");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      } else {
        $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Hubo un error al actualizar los datos.");
        echo json_encode($responder, JSON_UNESCAPED_UNICODE);
      }
    }
  }
} else {
  $puntos_formacion = 0;
  $puntos_total_cv = $puntos_total_cv - 8;
  $puntos_cursos = 0;
  $puntos_ubi = 0;
  $puntos_comp = 0;
  $puntos_idioma = 0;
  $puntos_lider = 0;
  $puntos_total_cv = 0;
  $sql = "UPDATE detalle_conv_prac SET puntos_form = '" . $puntos_formacion . "',puntos_cursos='" . $puntos_cursos    . "',puntos_ubi='" . $puntos_ubi . "',puntos_comp='" . $puntos_comp . "',puntos_idioma='" . $puntos_idioma . "',puntos_lider='" . $puntos_lider . "', puntos_total_cv='" . $puntos_total_cv . "',estado_entrevista = 'NO AGREGADO', dni_comision_update ='" . $dni . "', fech_update_comision ='" . $date . "', estado_conv_prac='NO APTO', observaciones_detalle_prac = 'No cumple con lo requerido'";
  $result = MYSQLI_query($con, $sql);

  if ($result) {
    $actualizar = "UPDATE postulante SET id_practicas=NULL, post_id_practicantes_req=NULL WHERE idpostulante='" . $idpostulante . "'";
    $resultado = MYSQLI_query($con, $actualizar);
    if ($resultado) {
      $responder =  array('r' => 1, 'dni' => $dni, 'mensaje' => "El postulante quedó eliminado por no cumplir con la formación.");
      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
    } else {
      $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Error al actualizar la tabla postulante.");
      echo json_encode($responder, JSON_UNESCAPED_UNICODE);
    }
  } else {
    $responder =  array('r' => 0, 'dni' => $dni, 'mensaje' => "Hubo un error al actualizar los datos.");
    echo json_encode($responder, JSON_UNESCAPED_UNICODE);
  }
}
