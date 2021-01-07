<?php

include '../conexion.php';

date_default_timezone_set('America/Lima');
$date = date('Y-m-d H:i:s');

// Update data into the database
if (isset($_POST['agregar_entre_prac'])) {
  $dato_desencriptado = $_POST['dni_comision'];
  $idpracticas = $_POST['idpracticas'];
  $idpracticantes_req = $_POST['idpracticantes_req'];

  $iddetalle_conv_prac = intval($_POST['iddetalle_conv_prac']);
  $aspec_perso = $_POST['aspec_perso'];
  $segu_estab = $_POST['segu_estab'];
  $etica = $_POST['etica'];
  $compet = $_POST['compet'];
  $cono_cult = $_POST['cono_cult'];

  $consul_detalle = MYSQLI_query($con, "SELECT * FROM detalle_conv_prac WHERE iddetalle_conv_prac = '$iddetalle_conv_prac'");
  $rw = MySQLI_fetch_array($consul_detalle);
  $estado_entrevista = $rw['estado_entrevista'];
  $puntos_total_cv = $rw['puntos_total_cv'];
  if ($estado_entrevista == 'NO AGREGADO') {
    $puntaje_entrevista = $aspec_perso + $segu_estab + $etica + $compet + $cono_cult;

    $sql = "INSERT INTO entrevista_prac (aspecto_personal, seguridad_estabilidad, etica, competencias, conoc_academico, puntaje_total_entre) VALUES ('$aspec_perso', '$segu_estab', '$etica', '$compet', '$cono_cult', '$puntaje_entrevista')";
    $result = mysqli_query($con, $sql);

    $query = mysqli_query($con, "SELECT MAX(id_entrevista_prac) AS id FROM entrevista_prac");
    if ($row = mysqli_fetch_row($query)) {
      $id = trim($row[0]);
    }
    $puntaje_total_cv_entre = $puntos_total_cv + $puntaje_entrevista;
    $puntaje_total_cv_entre_prom = $puntaje_total_cv_entre / 2;

    if ($puntaje_total_cv_entre_prom >= 13) {
      if ($result) {
        $update = "UPDATE detalle_conv_prac SET estado_entrevista='AGREGADO',detalle_conv_prac_identrevista_prac ='$id',puntaje_entrevista='$puntaje_entrevista',puntaje_total_cv_entre='$puntaje_total_cv_entre',puntaje_total_total='$puntaje_total_cv_entre_prom',dni_comision_update='$dato_desencriptado',fech_update_comision='$date',estado_conv_prac='APTO',observaciones_detalle_prac='' WHERE iddetalle_conv_prac = '$iddetalle_conv_prac'";
        $resultado = mysqli_query($con, $update);
        if ($resultado) {
          header("Location: ../listado_postu_prac.php?idpracticas=$idpracticas&idpracticantes_req=$idpracticantes_req&dni=$dato_desencriptado#profile");
        } else {
          echo '<script> alert("Error al actualizar, verifique!"); </script>';
        }
      } else {
        echo '<script> alert("Error al actualizar, verifique!"); </script>';
      }
    } else {
      if ($result) {
        $update = "UPDATE detalle_conv_prac SET estado_entrevista='AGREGADO',detalle_conv_prac_identrevista_prac ='$id',puntaje_entrevista='$puntaje_entrevista',puntaje_total_cv_entre='$puntaje_total_cv_entre',puntaje_total_total='$puntaje_total_cv_entre_prom',dni_comision_update='$dato_desencriptado',fech_update_comision='$date',estado_conv_prac='NO APTO',observaciones_detalle_prac='No llega al promedio' WHERE iddetalle_conv_prac = '$iddetalle_conv_prac'";
        $resultado = mysqli_query($con, $update);
        if ($resultado) {
          header("Location: ../listado_postu_prac.php?idpracticas=$idpracticas&idpracticantes_req=$idpracticantes_req&dni=$dato_desencriptado#profile");
        } else {
          echo '<script> alert("Error al actualizar, verifique!"); </script>';
        }
      } else {
        echo '<script> alert("Error al actualizar, verifique!"); </script>';
      }
    }
  } else {
    $id_entrevista_prac = $rw['detalle_conv_prac_identrevista_prac'];
    $puntaje_entrevista = $aspec_perso + $segu_estab + $etica + $compet + $cono_cult;

    $sql = "UPDATE entrevista_prac SET aspecto_personal ='$aspec_perso', seguridad_estabilidad='$segu_estab', etica='$etica', competencias='$compet', conoc_academico='$cono_cult', puntaje_total_entre='$puntaje_entrevista'";
    $result = mysqli_query($con, $sql);
    $puntaje_total_cv_entre = $puntos_total_cv + $puntaje_entrevista;
    $puntaje_total_cv_entre_prom = $puntaje_total_cv_entre / 2;
    if ($puntaje_total_cv_entre_prom >= 13) {
      if ($result) {
        $update = "UPDATE detalle_conv_prac SET estado_entrevista='AGREGADO',puntaje_entrevista='$puntaje_entrevista',puntaje_total_cv_entre='$puntaje_total_cv_entre',puntaje_total_total='$puntaje_total_cv_entre_prom',dni_comision_update='$dato_desencriptado',fech_update_comision='$date',estado_conv_prac='APTO',observaciones_detalle_prac='' WHERE iddetalle_conv_prac = '$iddetalle_conv_prac'";
        $resultado = mysqli_query($con, $update);
        if ($resultado) {
          header("Location: ../listado_postu_prac.php?idpracticas=$idpracticas&idpracticantes_req=$idpracticantes_req&dni=$dato_desencriptado#profile");
        } else {
          echo '<script> alert("Error al actualizar, verifique!"); </script>';
        }
      } else {
        echo '<script> alert("Error al actualizar, verifique!"); </script>';
      }
    } else {
      if ($result) {
        $update = "UPDATE detalle_conv_prac SET estado_entrevista='AGREGADO',puntaje_entrevista='$puntaje_entrevista',puntaje_total_cv_entre='$puntaje_total_cv_entre',puntaje_total_total='$puntaje_total_cv_entre_prom',dni_comision_update='$dato_desencriptado',fech_update_comision='$date',estado_conv_prac='NO APTO',observaciones_detalle_prac='No llega al promedio' WHERE iddetalle_conv_prac = '$iddetalle_conv_prac'";
        $resultado = mysqli_query($con, $update);
        if ($resultado) {
          header("Location: ../listado_postu_prac.php?idpracticas=$idpracticas&idpracticantes_req=$idpracticantes_req&dni=$dato_desencriptado#profile");
        } else {
          echo '<script> alert("Error al actualizar, verifique!"); </script>';
        }
      } else {
        echo '<script> alert("Error al actualizar, verifique!"); </script>';
      }
    }
  }
}
