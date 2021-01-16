<?php

include '../conexion.php';
$idpostulante = $_POST['idpostulante'];
$dni_post = $_POST['dni_post'];

// DATOS PERSONALES
$fech_nac = $_POST['fech_nac']; //bien
$pais = $_POST['pais_editar']; //bien
$civil = $_POST['estado_civil_editar']; //bien
$sexo = $_POST['sexo_editar']; //bien
$correo = $_POST['correo'];
$num_emer = $_POST['celular_emer']; //bien
$nomb_parent = strtoupper($_POST['parentesco_emer']); //bien
$ruc = $_POST['ruc']; //bien
$cuarta = $_POST['cuarta_editar']; //bien
$cuenta_banc = $_POST['num_cuenta']; //bien
$discapacidad = $_POST['discapacidad_editar']; //bien
$tip_discapacidad = $_POST['tip_discapacidad_editar']; //bien
$tip_sangre = $_POST['tip_sangre']; //bien
$alergias = strtoupper($_POST['alergias']); //bien
$servicio_militar = $_POST['servicio']; //bien
$deportista_calif = $_POST['deportista_calif']; //bien

$pension = $_POST['pension_editar'];
if ($pension == 'NINGUNA') {
  $pertenecer_pension = $_POST['pertenecer_pension']; //BIEN
  if ($pertenecer_pension == 'AFP') {
    $nombre_afp_pregunta = $_POST['nombre_afp_pregunta'];

    $sql = "UPDATE postulante SET estado_civil='" . $civil . "', sexo = '" . $sexo . "', correo='" . $correo . "' ,ruc ='" . $ruc . "', fech_nac = '" . $fech_nac . "', num_cuenta = '" . $cuenta_banc . "',  seguro = '" . $pension . "',suspension_cuarta = '" . $cuarta . "',celular_emer ='" . $num_emer . "',parentesco_emer='" . $nomb_parent . "', discapacidad = '" . $discapacidad . "', tipo_discap = '" . $tip_discapacidad . "',tipo_sangre = '" . $tip_sangre . "', alergias = '" . $alergias . "',pais = '" . $pais . "', servicio_militar = '" . $servicio_militar . "',  desea_pertenecer_seguro = '" . $pertenecer_pension . "', nombre_afp_desea = '" . $nombre_afp_pregunta . "' ,
     deportista_calificado = '" . $deportista_calif . "' WHERE idpostulante='" . $idpostulante . "' ";
    $datos = mysqli_query($con, $sql);
  } elseif ($pertenecer_pension = 'ONP') {
    $sql = "UPDATE postulante SET estado_civil='" . $civil . "', sexo = '" . $sexo . "', correo='" . $correo . "' ,ruc ='" . $ruc . "', fech_nac = '" . $fech_nac . "', num_cuenta = '" . $cuenta_banc . "',  seguro = '" . $pension . "',suspension_cuarta = '" . $cuarta . "',celular_emer ='" . $num_emer . "',parentesco_emer='" . $nomb_parent . "', discapacidad = '" . $discapacidad . "', tipo_discap = '" . $tip_discapacidad . "',tipo_sangre = '" . $tip_sangre . "', alergias = '" . $alergias . "',pais = '" . $pais . "', servicio_militar = '" . $servicio_militar . "',  desea_pertenecer_seguro = '" . $pertenecer_pension . "', deportista_calificado = '" . $deportista_calif . "' WHERE idpostulante='" . $idpostulante . "' ";
    $datos = mysqli_query($con, $sql);
  } else {
    echo "Error al actualizar el tipo de pensión deseable.";
  }
} elseif ($pension == 'AFP') {
  $nombre_afp = $_POST['nombre_afp']; //bien
  $codigo_cussp = $_POST['codigo_cussp']; //bien
  $sql = "UPDATE postulante SET estado_civil='" . $civil . "', sexo = '" . $sexo . "', correo='" . $correo . "' ,ruc ='" . $ruc . "', fech_nac = '" . $fech_nac . "', num_cuenta = '" . $cuenta_banc . "',  seguro = '" . $pension . "',suspension_cuarta = '" . $cuarta . "',celular_emer ='" . $num_emer . "',parentesco_emer='" . $nomb_parent . "', discapacidad = '" . $discapacidad . "', tipo_discap = '" . $tip_discapacidad . "',tipo_sangre = '" . $tip_sangre . "', alergias = '" . $alergias . "',pais = '" . $pais . "', servicio_militar = '" . $servicio_militar . "', nombre_afp = '" . $nombre_afp . "' ,codigo_cussp = '" . $codigo_cussp . "',
  deportista_calificado = '" . $deportista_calif . "' WHERE idpostulante='" . $idpostulante . "' ";
  $datos = mysqli_query($con, $sql);
} elseif ($pension == 'ONP') {
  //ONP
  $sql = "UPDATE postulante SET estado_civil='" . $civil . "', sexo = '" . $sexo . "', correo='" . $correo . "' ,ruc ='" . $ruc . "', fech_nac = '" . $fech_nac . "', num_cuenta = '" . $cuenta_banc . "',  seguro = '" . $pension . "', suspension_cuarta = '" . $cuarta . "',celular_emer ='" . $num_emer . "',parentesco_emer='" . $nomb_parent . "', discapacidad = '" . $discapacidad . "', tipo_discap = '" . $tip_discapacidad . "',tipo_sangre = '" . $tip_sangre . "', alergias = '" . $alergias . "',pais = '" . $pais . "', servicio_militar = '" . $servicio_militar . "', 
  deportista_calificado = '" . $deportista_calif . "' WHERE idpostulante='" . $idpostulante . "' ";
  $datos = mysqli_query($con, $sql);
} else {
  echo "No eligio correctamente el tipo de pensión que pertenece.";
}


//DATOS DOMICILIO
$tipo_via = $_POST['tipo_via'];
$nomb_via = strtoupper($_POST['nomb_via']);
$tipo_zona = $_POST['tipo_zona'];
$nomb_zona = strtoupper($_POST['nomb_zona']);
$numero = strtoupper($_POST['numero']);
$manzana = strtoupper($_POST['manzana']);
$lote = strtoupper($_POST['lote']);
$referencia = strtoupper($_POST['referencia']);
// $distrito1 = $_POST['distrito_id1'];

$sql2 = "UPDATE domicilio_post SET tip_via='" . $tipo_via . "', nomb_via='" . $nomb_via . "',tip_zona='" . $tipo_zona . "', nomb_zona='" . $nomb_zona . "', referencia='" . $referencia . "', numero='" . $numero . "', manzana='" . $manzana . "', lote='" . $lote . "' WHERE postulante_idpostulante='" . $idpostulante . "' ";

$datos2 = mysqli_query($con, $sql2);

//DATOS ENCUESTA
$pre1 = $_POST['pregunta1'];
$pre2 = $_POST['pregunta2'];
$pre3 = $_POST['pregunta3'];
$pre4 = $_POST['pregunta4'];
$pre5 = $_POST['pregunta5'];
$pre6 = $_POST['pregunta6'];
$pre7 = $_POST['pregunta7'];
$pre8 = $_POST['pregunta8'];
$pre9 = $_POST['pregunta9'];
$pre10 = $_POST['pregunta10'];
$pre11 = $_POST['pregunta11'];
$pre12 = $_POST['pregunta12'];
$pre13 = $_POST['pregunta13'];
$pre14 = $_POST['pregunta14'];

if ($datos == 1) {
  if ($datos2 == 1) {
    $sql4 = "UPDATE encuesta SET respuesta1='" . $pre1 . "', respuesta2='" . $pre2 . "', respuesta3='" . $pre3 . "', respuesta4='" . $pre4 . "', respuesta5='" . $pre5 . "', respuesta6='" . $pre6 . "', respuesta7='" . $pre7 . "', respuesta8='" . $pre8 . "', respuesta9='" . $pre9 . "', respuesta10='" . $pre10 . "', respuesta11='" . $pre11 . "', respuesta12='" . $pre12 . "', respuesta13='" . $pre13 . "', respuesta14='" . $pre14 . "' WHERE postulanteID= '" . $idpostulante . "' ";
    $datos3 = mysqli_query($con, $sql4);

    if ($datos3 == 1) {
      $familiares_lab = $_POST['familiares_lab'];
      if ($familiares_lab == 'SI') {
        // MODIFICACIN DE LOS DATOS DE LA FAMILIA


        // FIN DATOS DE LA FAMILIA
      } else {
        $sql3 = "UPDATE familia_post SET familiar_trabajando='" . $familiares_lab . "' WHERE postulante_idpostulante= '" . $idpostulante . "'";
        $datos4 = mysqli_query($con, $sql3);

        if ($datos4) {
          echo $dni_post;
          // echo "Se modifico correctamente, continue.";
        } else {
          echo "Error al actualizar la información de familiares laborando en la DIRESA TACNA.";
        }
        // header('Location: ../index.php?dni=' . $dni_post);
      }
    } else {
      // echo "Error al actualizar los datos de la DECLARACIÓN JURADA.";
      echo '<script> alert("Error al guardar la declaración jurada."); 
                    window.history.back(-1);</script>';
    }
  } else {
    // echo "Error al actualizar los DATOS DE DOMICILIO.";
    echo '<script> alert("Error al guardar datos del domicilio"); 
                    window.history.back(-1);</script>';
  }
} else {
  // echo "Error al actualizar los DATOS PERSONALES.";
  echo '<script> alert("Error al guardar datos postulante."); 
                    window.history.back(-1);</script>';
}
$con->close();
