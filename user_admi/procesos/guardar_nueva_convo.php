<?php

include "../conexion.php";
$dni = $_POST['dni'];


if (isset($_POST['convoc_cas'])) {
  $tipo_con = $_POST['tipo_con'];
  $num_con = $_POST['num_con'];
  $anio_con = $_POST['anio_con'];
  // $ubicacion = $_POST['chosen-unique'];
  $fech_ini = $_POST['fech_ini'];
  $fech_fin = $_POST['fech_fin'];
  $curricular = $_POST['curricular'];
  $entrevista = $_POST['entrevista'];
  $escrito = $_POST['escrito'];
  $por_discapacidad = $_POST['por_discapacidad'];
  $militar = $_POST['militar'];
  $estado = $_POST['estado'];

  $sql = "INSERT INTO convocatoria (num_con,anio_con,tipo_con,fech_ini,fech_term,porcen_eva_cu,porce_entrevista,porce_discapacidad,
    porce_sermilitar,porce_exa_escrito, estado) 
    VALUES ('" . $num_con . "','" . $anio_con . "','" . $tipo_con . "','" . $fech_ini . "','" . $fech_fin . "','" . $curricular . "','" . $entrevista . "','" . $por_discapacidad . "','" . $militar . "','" . $escrito . "','" . $estado . "')";

  if ($con->query($sql) == TRUE) {
    $idcon = mysqli_insert_id($con);
    // echo $idcon;
    header('Location: ../agregar_personal_req_v2.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }

  $con->close();
} elseif (isset($_POST['convoc_pract'])) {
  $num_con = $_POST['num_con'];
  $anio_con = $_POST['anio_con'];
  // $ubicacion = $_POST['chosen-unique'];
  $fech_ini = $_POST['fech_ini'];
  $fech_fin = $_POST['fech_fin'];
  $curricular = $_POST['curricular'];
  $entrevista = $_POST['entrevista'];
  $estado = 'ACTIVO';

  $sql = "INSERT INTO practicas (num_convoc,anio_convoc,fech_inicio,fech_termino,porcen_eva_cu,porce_entrevista,estado_con) 
    VALUES ('" . $num_con . "','" . $anio_con . "','" . $fech_ini . "','" . $fech_fin . "','" . $curricular . "','" . $entrevista . "','" . $estado . "')";

  if ($con->query($sql) == TRUE) {
    $idcon_pract = mysqli_insert_id($con);
    // echo $idcon;
    header('Location: ../agregar_pract_req.php?practicas_idcon=' . $idcon_pract . '&dni=' . $dni);
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }
}
