<?php

include '../conexion.php';
$idpostulante = $_POST['idpostulante'];
$dni_post = $_POST['dni_post'];

// DATOS PERSONALES
$fech_nac = $_POST['fech_nac'];
$pais = $_POST['pais'];
$civil = $_POST['civil'];
$sexo = $_POST['sexo'];
$num_emer = $_POST['num_emer'];
$nomb_parent = strtoupper($_POST['nomb_parent']);
$ruc = $_POST['ruc'];
$cuarta = $_POST['cuarta'];
$cuenta_banc = $_POST['cuenta_banc'];
$discapacidad = $_POST['discapacidad'];
$tip_discapacidad = $_POST['tip_discapacidad'];
$tip_sangre = $_POST['tip_sangre'];
$alergias = strtoupper($_POST['alergias']);
$servicio_militar = $_POST['servicio_militar'];
$deportista_calif = $_POST['deportista_calif'];

$pension = $_POST['pension'];
if ($pension = 'NINGUNA') {
  $pertenecer_pension = $_POST['pertenecer_pension'];
  if ($pertenecer_pension = 'AFP') {
    $nombre_afp_pregunta = $_POST['nombre_afp_pregunta'];

    $sql = "UPDATE postulante SET estado_civil='" . $civil . "', sexo = '" . $sexo . "', fech_nac = '" . $fech_nac . "', num_cuenta = '" . $cuenta_banc . "',  celular_emer ='" . $num_emer . "',parentesco_emer='" . $nomb_parent . "',ruc ='" . $ruc . "',
     discapacidad = '" . $discapacidad . "', tipo_discap = '" . $tip_discapacidad . "',tipo_sangre = '" . $tip_sangre . "', alergias = '" . $alergias . "',suspension_cuarta = '" . $cuarta . "',seguro = '" . $pension . "', desea_pertenecer_seguro = '" . $pertenecer_pension . "',
     nombre_afp = '" . $nombre_afp_pregunta . "',pais = '" . $pais . "' ,servicio_militar = '" . $servicio_militar . "', 
     deportista_calificado = '" . $deportista_calif . "' WHERE idpostulante='" . $idpostulante . "' ";
    $datos = mysqli_query($con, $sql);
  } else {
    $sql = "UPDATE postulante SET estado_civil='" . $civil . "', sexo = '" . $sexo . "', fech_nac = '" . $fech_nac . "', num_cuenta = '" . $cuenta_banc . "',  celular_emer ='" . $num_emer . "',parentesco_emer='" . $nomb_parent . "',ruc ='" . $ruc . "',
     discapacidad = '" . $discapacidad . "', tipo_discap = '" . $tip_discapacidad . "',tipo_sangre = '" . $tip_sangre . "', alergias = '" . $alergias . "',suspension_cuarta = '" . $cuarta . "',seguro = '" . $pension . "', desea_pertenecer_seguro = '" . $pertenecer_pension . "',
     pais = '" . $pais . "' ,servicio_militar = '" . $servicio_militar . "', 
     deportista_calificado = '" . $deportista_calif . "' WHERE idpostulante='" . $idpostulante . "' ";
    $datos = mysqli_query($con, $sql);
  }
} elseif ($pension = 'AFP') {
  $nombre_afp = $_POST['nombre_afp'];
  $codigo_cussp = $_POST['codigo_cussp'];
  $sql = "UPDATE postulante SET estado_civil='" . $civil . "', sexo = '" . $sexo . "', fech_nac = '" . $fech_nac . "', num_cuenta = '" . $cuenta_banc . "',  celular_emer ='" . $num_emer . "',parentesco_emer='" . $nomb_parent . "',ruc ='" . $ruc . "',
     discapacidad = '" . $discapacidad . "', tipo_discap = '" . $tip_discapacidad . "', tipo_sangre = '" . $tip_sangre . "', alergias = '" . $alergias . "', suspension_cuarta = '" . $cuarta . "',seguro = '" . $pension . "', nombre_afp = '" . $nombre_afp . "',
     codigo_cussp = '" . $codigo_cussp . "', pais = '" . $pais . "' ,servicio_militar = '" . $servicio_militar . "', 
     deportista_calificado = '" . $deportista_calif . "' WHERE idpostulante='" . $idpostulante . "' ";
  $datos = mysqli_query($con, $sql);
} else {
  $nombre_afp = $_POST['nombre_afp'];
  $codigo_cussp = $_POST['codigo_cussp'];

  $sql = "UPDATE postulante SET estado_civil='" . $civil . "', sexo = '" . $sexo . "', fech_nac = '" . $fech_nac . "', num_cuenta = '" . $cuenta_banc . "',  celular_emer ='" . $num_emer . "',parentesco_emer='" . $nomb_parent . "',ruc ='" . $ruc . "',
     discapacidad = '" . $discapacidad . "', tipo_discap = '" . $tip_discapacidad . "',tipo_sangre = '" . $tip_sangre . "', alergias = '" . $alergias . "', suspension_cuarta = '" . $cuarta . "',seguro = '" . $pension . "', pais = '" . $pais . "' ,servicio_militar = '" . $servicio_militar . "', deportista_calificado = '" . $deportista_calif . "' WHERE idpostulante='" . $idpostulante . "' ";
  $datos = mysqli_query($con, $sql);
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

$sql2 = "UPDATE domicilio_post SET tip_via='" . $tipo_via . "', nomb_via='" . $nomb_via . "',tip_zona='" . $tipo_zona . "', nomb_zona='" . $nomb_zona . "', referencia='" . $referencia . "', numero='" . $numero . "', manzana='" . $manzana . "', lote='" . $lote . "' WHERE idpostulante='" . $idpostulante . "' ";

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
          $sql3 = "UPDATE familia_post (nombre, apellidos, dni, parentesco, postulante_idpostulante, familiar_trabajando, cargo, area) VALUES $valoresQ";

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
        header('Location: ../index.php?dni=' . $dni_post);
      } else {
        $sql3 = "UPDATE familia_post SET familiar_trabajando='" . $familiares_lab . "' WHERE postulanteID= '" . $idpostulante . "'";
        $datos4 = mysqli_query($con, $sql3);
        session_start();
        header('Location: ../index.php?dni=' . $dni_post);
      }
    } else {
      echo "error declaracion";
      // echo '<script> alert("Error al guardar la declaración jurada."); 
      //               window.history.back(-1);</script>';
    }
  } else {
    echo "error domicilio";
    // echo '<script> alert("Error al guardar datos del domicilio"); 
    //                 window.history.back(-1);</script>';
  }
} else {
  echo "error datos postulante";
  // echo '<script> alert("Error al guardar datos postulante."); 
  //                   window.history.back(-1);</script>';
}
$con->close();
