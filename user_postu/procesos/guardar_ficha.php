<?php

include '../conexion.php';
$idpostulante = $_POST['idpostulante'];
$dni_post = $_POST['dni_post'];

// DATOS PERSONALES
$fech_nac = $_POST['fech_nac'];
$civil = $_POST['civil'];
$sexo = $_POST['sexo'];
$num_emer = $_POST['num_emer'];
$nomb_parent = $_POST['nomb_parent'];
$ruc = $_POST['ruc'];
$cuarta = $_POST['cuarta'];
$cuenta_banc = $_POST['cuenta_banc'];
$discapacidad = $_POST['discapacidad'];
$tip_discapacidad = $_POST['tip_discapacidad'];
$tip_sangre = $_POST['tip_sangre'];
$alergias = $_POST['alergias'];
$pais = $_POST['pais'];
$cuenta_banc = $_POST['cuenta_banc'];
$discapacidad = $_POST['discapacidad'];
$tip_discapacidad = $_POST['tip_discapacidad'];
$tip_sangre = $_POST['tip_sangre'];
$alergias = $_POST['alergias'];
$pais = $_POST['pais'];
$servicio_militar = $_POST['servicio_militar'];
$deportista_calif = $_POST['deportista_calif'];

$pension = $_POST['pension'];
if ($pension = 'NINGUNA') {
  $pertenecer_pension = $_POST['pertenecer_pension'];
  if ($pertenecer_pension = 'AFP') {
    $nombre_afp_pregunta = $_POST['nombre_afp_pregunta'];

    $sql = "UPDATE postulante SET estado_civil='" . $civil . "', sexo = '" . $sexo . "', fech_nac = '" . $fech_nac . "', num_cuenta = '" . $cuenta_banc . "',  celular_emer ='" . $num_emer . "',parentesco_emer='" . $nomb_parent . "',ruc ='" . $ruc . "',
     discapacidad = '" . $discapacidad . "', tipo_discap = '" . $tip_discapacidad . "',tipo_sangre = '" . $tip_sangre . "', alergias = '" . $alergias . "',suspension_cuarta = '" . $cuarta . "',seguro = '" . $pension . "', pertenecer_seguro = '" . $pertenecer_pension . "',
     nombre_afp = '" . $nombre_afp_pregunta . "',pais = '" . $pais . "' ,servicio_militar = '" . $servicio_militar . "', 
     deportista_calificado = '" . $deportista_calif . "' WHERE dni='" . $dni_post . "' ";
    $datos = mysqli_query($con, $sql);
  } else {
    $sql = "UPDATE postulante SET estado_civil='" . $civil . "', sexo = '" . $sexo . "', fech_nac = '" . $fech_nac . "', num_cuenta = '" . $cuenta_banc . "',  celular_emer ='" . $num_emer . "',parentesco_emer='" . $nomb_parent . "',ruc ='" . $ruc . "',
     discapacidad = '" . $discapacidad . "', tipo_discap = '" . $tip_discapacidad . "',tipo_sangre = '" . $tip_sangre . "', alergias = '" . $alergias . "',suspension_cuarta = '" . $cuarta . "',seguro = '" . $pension . "', pertenecer_seguro = '" . $pertenecer_pension . "',
     pais = '" . $pais . "' ,servicio_militar = '" . $servicio_militar . "', 
     deportista_calificado = '" . $deportista_calif . "' WHERE dni='" . $dni_post . "' ";
    $datos = mysqli_query($con, $sql);
  }
} elseif ($pension = 'AFP') {
  $nombre_afp = $_POST['nombre_afp'];
  $codigo_cussp = $_POST['codigo_cussp'];
  $sql = "UPDATE postulante SET estado_civil='" . $civil . "', sexo = '" . $sexo . "', fech_nac = '" . $fech_nac . "', num_cuenta = '" . $cuenta_banc . "',  celular_emer ='" . $num_emer . "',parentesco_emer='" . $nomb_parent . "',ruc ='" . $ruc . "',
     discapacidad = '" . $discapacidad . "', tipo_discap = '" . $tip_discapacidad . "',tipo_sangre = '" . $tip_sangre . "', alergias = '" . $alergias . "', suspension_cuarta = '" . $cuarta . "',seguro = '" . $pension . "', pertenecer_seguro = '" . $pertenecer_pension . "',
     nombre_afp = '" . $nombre_afp_pregunta . "',pais = '" . $pais . "' ,servicio_militar = '" . $servicio_militar . "', 
     deportista_calificado = '" . $deportista_calif . "' WHERE dni='" . $dni_post . "' ";
  $datos = mysqli_query($con, $sql);
} else {
  $nombre_afp = $_POST['nombre_afp'];
  $codigo_cussp = $_POST['codigo_cussp'];

  $sql = "UPDATE postulante SET estado_civil='" . $civil . "', sexo = '" . $sexo . "', fech_nac = '" . $fech_nac . "', num_cuenta = '" . $cuenta_banc . "',  celular_emer ='" . $num_emer . "',parentesco_emer='" . $nomb_parent . "',ruc ='" . $ruc . "',
     discapacidad = '" . $discapacidad . "', tipo_discap = '" . $tip_discapacidad . "',tipo_sangre = '" . $tip_sangre . "', alergias = '" . $alergias . "', suspension_cuarta = '" . $cuarta . "',seguro = '" . $pension . "', pais = '" . $pais . "' ,servicio_militar = '" . $servicio_militar . "', deportista_calificado = '" . $deportista_calif . "' WHERE dni='" . $dni_post . "' ";
  $datos = mysqli_query($con, $sql);
}


//DATOS DOMICILIO
$tipo_via = $_POST['tipo_via'];
$nomb_via = $_POST['nomb_via'];
$tipo_zona = $_POST['tipo_zona'];
$nomb_zona = $_POST['nomb_zona'];
$numero = $_POST['numero'];
$manzana = $_POST['manzana'];
$lote = $_POST['lote'];
$referencia = $_POST['referencia'];
$distrito1 = $_POST['distrito_id1'];

$sql2 = "INSERT INTO domicilio_post (tip_via, nomb_via,tip_zona, nomb_zona, referencia, numero, manzana, lote, postulante_idpostulante,distrito_idistrito) 
        VALUES ('" . $tipo_via . "', '" . $nomb_via . "', '" . $tipo_zona . "', '" . $nomb_zona . "', '" . $referencia . "','" . $numero . "','" . $manzana . "','" . $lote . "','" . $idpostulante . "' ,'" . $distrito1 . "')";
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
    $sql4 = "INSERT INTO encuesta (respuesta1, respuesta2, respuesta3, respuesta4, respuesta5, respuesta6, respuesta7, respuesta8, respuesta9, respuesta10, respuesta11, respuesta12, respuesta13, respuesta14, postulanteID) 
          VALUES ('" . $pre1 . "', '" . $pre2 . "', '" . $pre3 . "', '" . $pre4 . "', '" . $pre5 . "', '" . $pre6 . "','" . $pre7 . "','" . $pre8 . "','" . $pre9 . "','" . $pre10 . "','" . $pre11 . "','" . $pre12 . "','" . $pre13 . "','" . $pre14 . "','" . $idpostulante . "')";
    $datos3 = mysqli_query($con, $sql4);

    if ($datos3 == 1) {
      $familiares_lab = $_POST['familiares_lab'];
      if ($familiares_lab == 'SI') {
        $true = 'true';
        $items1 = ($_POST['nombre']);
        $items2 = ($_POST['apellidos']);
        $items3 = ($_POST['dni']);
        $items4 = ($_POST['parentesco']);

        ///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 5 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
        while ($true == true) {

          //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
          $item1 = current($items1);
          $item2 = current($items2);
          $item3 = current($items3);
          $item4 = current($items4);

          ////// ASIGNARLOS A VARIABLES ///////////////////
          $nombre = (($item1 !== false) ? $item1 : ", &nbsp;");
          $apellidos = (($item2 !== false) ? $item2 : ", &nbsp;");
          $dni = (($item3 !== false) ? $item3 : ", &nbsp;");
          $parentesco = (($item4 !== false) ? $item4 : ", &nbsp;");

          //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
          $valores = '("' . $nombre . '","' . $apellidos . '","' . $dni . '","' . $parentesco . '","' . $idpostulante . '","' . $familiares_lab . '"),';

          //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
          $valoresQ = substr($valores, 0, -1);

          ///////// QUERY DE INSERCIÓN ////////////////////////////
          // include_once('conexion.php');
          $sql3 = "INSERT INTO familia_post (nombre, apellidos, fech_nac, dni, parentesco, labora, postulante_idpostulante, familiar_trabajando) 
                    VALUES $valoresQ";

          $sqlRes = $con->query($sql3) or mysqli_error($con);

          // Up! Next Value
          $item1 = next($items1);
          $item2 = next($items2);
          $item3 = next($items3);
          $item4 = next($items4);

          // Check terminator
          if ($item1 === false && $item2 === false && $item3 === false && $item4 === false) break;
        }
        session_start();
        header('Location: ../index.php?dni=' . $dni_post);
      } else {
        $sql3 = "INSERT INTO familia_post (postulante_idpostulante, familiar_trabajando) VALUES ('" . $idpostulante . "', '" . $familiares_lab . "')";
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
