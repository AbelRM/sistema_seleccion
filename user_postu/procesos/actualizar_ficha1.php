<?php

include '../conexion.php';
$idpostulante = $_POST['idpostulante'];
$dni_post = $_POST['dni_post'];

// DATOS PERSONALES
$fech_nac = $_POST['fech_nac']; //bien
$pais = $_POST['pais_editar']; //bien
$civil = $_POST['estado_civil_editar']; //bien
$sexo = $_POST['sexo_editar']; //bien
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

    $sql = "UPDATE postulante SET estado_civil='" . $civil . "', sexo = '" . $sexo . "',ruc ='" . $ruc . "', fech_nac = '" . $fech_nac . "', num_cuenta = '" . $cuenta_banc . "',  seguro = '" . $pension . "',suspension_cuarta = '" . $cuarta . "',celular_emer ='" . $num_emer . "',parentesco_emer='" . $nomb_parent . "', discapacidad = '" . $discapacidad . "', tipo_discap = '" . $tip_discapacidad . "',tipo_sangre = '" . $tip_sangre . "', alergias = '" . $alergias . "',pais = '" . $pais . "', servicio_militar = '" . $servicio_militar . "',  desea_pertenecer_seguro = '" . $pertenecer_pension . "', nombre_afp_desea = '" . $nombre_afp_pregunta . "' ,
     deportista_calificado = '" . $deportista_calif . "' WHERE idpostulante='" . $idpostulante . "' ";
    $datos = mysqli_query($con, $sql);
  } elseif ($pertenecer_pension = 'ONP') {
    $sql = "UPDATE postulante SET estado_civil='" . $civil . "', sexo = '" . $sexo . "',ruc ='" . $ruc . "', fech_nac = '" . $fech_nac . "', num_cuenta = '" . $cuenta_banc . "',  seguro = '" . $pension . "',suspension_cuarta = '" . $cuarta . "',celular_emer ='" . $num_emer . "',parentesco_emer='" . $nomb_parent . "', discapacidad = '" . $discapacidad . "', tipo_discap = '" . $tip_discapacidad . "',tipo_sangre = '" . $tip_sangre . "', alergias = '" . $alergias . "',pais = '" . $pais . "', servicio_militar = '" . $servicio_militar . "',  desea_pertenecer_seguro = '" . $pertenecer_pension . "', deportista_calificado = '" . $deportista_calif . "' WHERE idpostulante='" . $idpostulante . "' ";
    $datos = mysqli_query($con, $sql);
  } else {
    echo "Error al actualizar el tipo de pensión deseable.";
  }
} elseif ($pension == 'AFP') {
  $nombre_afp = $_POST['nombre_afp']; //bien
  $codigo_cussp = $_POST['codigo_cussp']; //bien
  $sql = "UPDATE postulante SET estado_civil='" . $civil . "', sexo = '" . $sexo . "',ruc ='" . $ruc . "', fech_nac = '" . $fech_nac . "', num_cuenta = '" . $cuenta_banc . "',  seguro = '" . $pension . "',suspension_cuarta = '" . $cuarta . "',celular_emer ='" . $num_emer . "',parentesco_emer='" . $nomb_parent . "', discapacidad = '" . $discapacidad . "', tipo_discap = '" . $tip_discapacidad . "',tipo_sangre = '" . $tip_sangre . "', alergias = '" . $alergias . "',pais = '" . $pais . "', servicio_militar = '" . $servicio_militar . "', nombre_afp = '" . $nombre_afp . "' ,codigo_cussp = '" . $codigo_cussp . "',
  deportista_calificado = '" . $deportista_calif . "' WHERE idpostulante='" . $idpostulante . "' ";
  $datos = mysqli_query($con, $sql);
} elseif ($pension == 'ONP') {
  //ONP
  $sql = "UPDATE postulante SET estado_civil='" . $civil . "', sexo = '" . $sexo . "',ruc ='" . $ruc . "', fech_nac = '" . $fech_nac . "', num_cuenta = '" . $cuenta_banc . "',  seguro = '" . $pension . "', suspension_cuarta = '" . $cuarta . "',celular_emer ='" . $num_emer . "',parentesco_emer='" . $nomb_parent . "', discapacidad = '" . $discapacidad . "', tipo_discap = '" . $tip_discapacidad . "',tipo_sangre = '" . $tip_sangre . "', alergias = '" . $alergias . "',pais = '" . $pais . "', servicio_militar = '" . $servicio_militar . "', 
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
        $consulta = "SELECT * FROM familia_post WHERE familiar_trabajando = 'SI' AND postulanteID = '$idpostulante'";
        $ejecutar = mysqli_query($con, $consulta);
        if ($ejecutar == 1) {
          foreach ($_POST['idfamilia'] as $ids) {
            $idfamilia = mysqli_real_escape_string($con, $_POST['idfamilia'][$ids]);
            $nombre = mysqli_real_escape_string($con, $_POST['nombre'][$ids]);
            $apellidos = mysqli_real_escape_string($con, $_POST['apellidos'][$ids]);
            $dni = mysqli_real_escape_string($con, $_POST['dni'][$ids]);
            $parentesco = mysqli_real_escape_string($con, $_POST['parentesco'][$ids]);
            $cargo = mysqli_real_escape_string($con, $_POST['cargo'][$ids]);
            $area = mysqli_real_escape_string($con, $_POST['area'][$ids]);

            $actualizar = $con->query("UPDATE familia_post SET nombre='$nombre', apellidos='$apellidos',dni='$dni', parentesco='$parentesco', familiar_trabajando = '$familiares_lab',cargo='$cargo', area='$area' WHERE idfamilia='$ids'");
          }
          if ($actualizar) {
            echo "Se actualizó correctamente los datos.";
          } else {
            echo "Hubo un error al actualizar, intente de nuevo.";
          }
        } else {
          $true = 'true';
          $items1 = ($_POST['nombre']);
          $items2 = ($_POST['apellidos']);
          $items3 = ($_POST['dni']);
          $items4 = ($_POST['parentesco']);
          $items5 = ($_POST['cargo']);
          $items6 = ($_POST['area']);

          ///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 5 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
          while ($true == true) {

            //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
            $item1 = current($items1);
            $item2 = current($items2);
            $item3 = current($items3);
            $item4 = current($items4);
            $item5 = current($items5);
            $item6 = current($items6);

            ////// ASIGNARLOS A VARIABLES ///////////////////
            $nombre = (($item1 !== false) ? $item1 : ", &nbsp;");
            $apellidos = (($item2 !== false) ? $item2 : ", &nbsp;");
            $dni = (($item3 !== false) ? $item3 : ", &nbsp;");
            $parentesco = (($item4 !== false) ? $item4 : ", &nbsp;");
            $cargo = (($item5 !== false) ? $item5 : ", &nbsp;");
            $area = (($item6 !== false) ? $item6 : ", &nbsp;");

            //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
            $valores = '("' . strtoupper($nombre) . '","' . strtoupper($apellidos) . '","' . $dni . '","' . $parentesco . '","' . $idpostulante . '","' . $familiares_lab . '","' . strtoupper($cargo) . '","' . strtoupper($area) . '"),';

            //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
            $valoresQ = substr($valores, 0, -1);

            ///////// QUERY DE INSERCIÓN ////////////////////////////
            // include_once('conexion.php');
            $sql3 = "INSERT INTO familia_post (nombre, apellidos, dni, parentesco, postulante_idpostulante, familiar_trabajando, cargo, area) VALUES $valoresQ";

            $sqlRes = $con->query($sql3) or mysqli_error($con);

            // Up! Next Value
            $item1 = next($items1);
            $item2 = next($items2);
            $item3 = next($items3);
            $item4 = next($items4);
            $item5 = next($items5);
            $item6 = next($items6);

            // Check terminator
            if ($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false) break;
          }
          session_start();
          if ($sqlRes) {
            echo $dni_post;
            // echo "Se agrego correctamente, continue.";
          } else {
            echo "Error al agregar datos familiares que laboren en la DIRESA.";
          }
          // header('Location: ../index.php?dni=' . $dni_post);
        }
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
      echo "Error al actualizar los datos de la DECLARACIÓN JURADA.";
      // echo '<script> alert("Error al guardar la declaración jurada."); 
      //               window.history.back(-1);</script>';
    }
  } else {
    echo "Error al actualizar los DATOS DE DOMICILIO.";
    // echo '<script> alert("Error al guardar datos del domicilio"); 
    //                 window.history.back(-1);</script>';
  }
} else {
  echo "Error al actualizar los DATOS PERSONALES.";
  // echo '<script> alert("Error al guardar datos postulante."); 
  //                   window.history.back(-1);</script>';
}
$con->close();
