<?php

include '../conexion.php';
date_default_timezone_set('America/Lima');
$date = date('Y-m-d H:i:s');
// Update data into the database
if (isset($_POST['updateCurso'])) {
  $dato_desencriptado = $_POST['dato_desencriptado'];
  $idpostulante = $_POST['idpostulante'];
  $practicas_idcon = $_POST['practicas_idcon'];
  $practicante_req = $_POST['practicante_req'];

  $idcursos = $_POST['idcursos_extra'];
  $validacion = $_POST['validacion'];
  $observaciones = $_POST['observaciones_curso'];

  $sql = "UPDATE cursos_extra SET curso_validacion='" . $validacion . "',observaciones_selec='$observaciones',dni_update_curso_comi='" . $dato_desencriptado . "',fech_update_curso_comi = '$date' WHERE idcursos_extra='" . $idcursos . "' ";

  $result = mysqli_query($con, $sql);

  if ($result) {
    header("Location: ../detalles_postulante_prac.php?idpostulante=$idpostulante&practicas_idcon=$practicas_idcon&practicante_req=$practicante_req&dni=$dato_desencriptado#cursos");
  } else {
    echo '<script> alert("Error al actualizar, verifique!"); </script>';
  }
} elseif (isset($_POST['updateFormacion'])) {
  $dato_desencriptado = $_POST['dato_desencriptado_form'];
  $idpostulante = $_POST['idpostulante_form'];
  $practicas_idcon = $_POST['practicas_idcon_form'];
  $practicante_req = $_POST['practicante_req_form'];

  $idformacion_acad_prac = $_POST['idformacion_acad_prac'];
  $validacion_formacion = $_POST['validacion_formacion'];
  $observaciones = $_POST['observaciones'];

  $sql = "UPDATE formacion_acad_prac SET formacion_validacion='" . $validacion_formacion . "',observaciones_selec = '$observaciones',dni_update_formac_comi='" . $dato_desencriptado . "', fech_update_formac_comi = '$date' WHERE idformacion_acad_prac='" . $idformacion_acad_prac . "' ";

  $result = mysqli_query($con, $sql);

  if ($result) {
    header("Location: ../detalles_postulante_prac.php?idpostulante=$idpostulante&practicas_idcon=$practicas_idcon&practicante_req=$practicante_req&dni=$dato_desencriptado");
  } else {
    echo '<script> alert("Error al actualizar, verifique!"); </script>';
  }
} elseif (isset($_POST['updateIdioma'])) {
  $dato_desencriptado = $_POST['dato_desencriptado'];
  $idpostulante = $_POST['idpostulante'];
  $practicas_idcon = $_POST['practicas_idcon'];
  $practicante_req = $_POST['practicante_req'];

  $ididiomas_comp = $_POST['ididiomas_comp'];
  $validacion_idioma = $_POST['validacion_idioma'];
  $observaciones = $_POST['observaciones_idioma'];

  $sql = "UPDATE idiomas_comp SET idioma_validacion='" . $validacion_idioma . "',observaciones_selec = '$observaciones',dni_update_idioma_comi='" . $dato_desencriptado . "', fech_update_idioma_comi = '$date' WHERE ididiomas_comp='" . $ididiomas_comp . "' ";

  $result = mysqli_query($con, $sql);

  if ($result) {
    header("Location: ../detalles_postulante_prac.php?idpostulante=$idpostulante&practicas_idcon=$practicas_idcon&practicante_req=$practicante_req&dni=$dato_desencriptado#idioma");
  } else {
    echo '<script> alert("Error al actualizar, verifique!"); </script>';
  }
} elseif (isset($_POST['updateFormacionCAS'])) {
  $dato_desencriptado = $_POST['dato_desencriptado_form'];
  $idpostulante = $_POST['idpostulante_form'];
  $idcon = $_POST['idcon_form'];
  $idpersonal = $_POST['idpersonal'];

  $idformacion_cas = $_POST['idformacion_cas'];
  $validacion_formacion = $_POST['validacion_formacion'];
  $observaciones = $_POST['observaciones'];

  $sql = "UPDATE formacion_acad SET formacion_validacion='" . $validacion_formacion . "', observaciones_selec='$observaciones', dni_update_formac_selec='$dato_desencriptado', fech_update_formac_selec = '$date' WHERE id_formacion='" . $idformacion_cas . "' ";

  $result = mysqli_query($con, $sql);

  if ($result) {
    header("Location: ../detalles_postulante_cas.php?idpostulante=$idpostulante&idcon=$idcon&idpersonal=$idpersonal&dni=$dato_desencriptado");
  } else {
    echo '<script> alert("Error al actualizar, verifique!"); </script>';
  }
} elseif (isset($_POST['updatePostgradoCAS'])) {
  $dato_desencriptado = $_POST['dato_desencriptado_form'];
  $idpostulante = $_POST['idpostulante_form'];
  $idcon = $_POST['idcon_form'];
  $idpersonal = $_POST['idpersonal'];

  $id_postgrado = $_POST['id_postgrado'];
  $postgrado_validacion = $_POST['postgrado_validacion'];
  $observaciones = $_POST['observaciones_postgrado'];

  $sql = "UPDATE maestria_doc SET postgrado_validacion='" . $postgrado_validacion . "', observaciones_selec='$observaciones', dni_update_formac_selec='$dato_desencriptado', fech_update_formac_selec = '$date' WHERE idmaestria_doc='" . $idformaid_postgradocion_cas . "' ";

  $result = mysqli_query($con, $sql);

  if ($result) {
    header("Location: ../detalles_postulante_cas.php?idpostulante=$idpostulante&idcon=$idcon&idpersonal=$idpersonal&dni=$dato_desencriptado");
  } else {
    echo '<script> alert("Error al actualizar, verifique!"); </script>';
  }
} elseif (isset($_POST['updateCursoCAS'])) {
  $dato_desencriptado = $_POST['dato_desencriptado'];
  $idpostulante = $_POST['idpostulante'];
  $idcon = $_POST['idcon'];
  $idpersonal = $_POST['idpersonal'];

  $idcursos_extra = $_POST['idcursos_extra'];
  $validacion = $_POST['validacion'];
  $observaciones = $_POST['observaciones_curso'];

  $sql = "UPDATE cursos_extra SET curso_validacion='" . $validacion . "', observaciones_selec='$observaciones', dni_update_curso_selec='$dato_desencriptado', fech_update_curso_selec = '$date' WHERE idcursos_extra='" . $idcursos_extra . "' ";

  $result = mysqli_query($con, $sql);

  if ($result) {
    header("Location: ../detalles_postulante_cas.php?idpostulante=$idpostulante&idcon=$idcon&idpersonal=$idpersonal&dni=$dato_desencriptado");
  } else {
    echo '<script> alert("Error al actualizar, verifique!"); </script>';
  }
} elseif (isset($_POST['updateIdiomaCAS'])) {
  $dato_desencriptado = $_POST['dato_desencriptado'];
  $idpostulante = $_POST['idpostulante'];
  $idcon = $_POST['idcon'];
  $idpersonal = $_POST['idpersonal'];

  $ididiomas_comp = $_POST['ididiomas_comp'];
  $validacion = $_POST['validacion_idioma'];
  $observaciones = $_POST['observaciones_idioma'];

  $sql = "UPDATE idiomas_comp SET idioma_validacion='" . $validacion . "', observaciones_selec='$observaciones', dni_update_idioma_selec='$dato_desencriptado', fech_update_idioma_selec = '$date' WHERE ididiomas_comp='" . $ididiomas_comp . "' ";

  $result = mysqli_query($con, $sql);

  if ($result) {
    header("Location: ../detalles_postulante_cas.php?idpostulante=$idpostulante&idcon=$idcon&idpersonal=$idpersonal&dni=$dato_desencriptado");
  } else {
    echo '<script> alert("Error al actualizar, verifique!"); </script>';
  }
} elseif (isset($_POST['updateExpCAS'])) {
  $dato_desencriptado = $_POST['dato_desencriptado'];
  $idpostulante = $_POST['idpostulante'];
  $idcon = $_POST['idcon'];
  $idpersonal = $_POST['idpersonal'];

  $id_expe4 = $_POST['id_expe4'];
  $validacion = $_POST['expe_validacion'];
  $observaciones = $_POST['observaciones_exp'];

  $sql = "UPDATE expe_4puntos SET expe_validacion='" . $validacion . "', observaciones_selec='$observaciones', dni_update_exp_selec='$dato_desencriptado', fech_update_exp_selec = '$date' WHERE id_4puntos='" . $id_expe4 . "' ";

  $result = mysqli_query($con, $sql);

  if ($result) {
    header("Location: ../detalles_postulante_cas.php?idpostulante=$idpostulante&idcon=$idcon&idpersonal=$idpersonal&dni=$dato_desencriptado");
  } else {
    echo '<script> alert("Error al actualizar, verifique!"); </script>';
  }
}
