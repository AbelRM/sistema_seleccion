<?php
include_once('../conexion.php');
$idcon = $_POST['idcon'];
$dni = $_POST['dni'];
//////////////////////// PRESIONAR EL BOTÓN //////////////////////////         
if (isset($_POST['insertar_2'])) {
  $items1 = ($_POST['cargo_funcio']);
  $items2 = ($_POST['nombre']);
  $items3 = ($_POST['apellidos']);
  $items4 = ($_POST['area_user']);
  // echo $idcon;
  ///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 5 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
  while (true) {

    //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
    $item1 = current($items1);
    $item2 = current($items2);
    $item3 = current($items3);
    $item4 = current($items4);

    ////// ASIGNARLOS A VARIABLES ///////////////////
    $cargo_funcio = (($item1 !== false) ? $item1 : ", &nbsp;");
    $nombre = (($item2 !== false) ? $item2 : ", &nbsp;");
    $apellidos = (($item3 !== false) ? $item3 : ", &nbsp;");
    $area_user = (($item4 !== false) ? $item4 : ", &nbsp;");

    //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
    $valores = '("' . $cargo_funcio . '",strtoupper("' . $nombre . '"),strtoupper("' . $apellidos . '"),strtoupper("' . $area_user . '"),"' . $idcon . '"),';

    //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
    $valoresQ = substr($valores, 0, -1);

    ///////// QUERY DE INSERCIÓN ////////////////////////////
    // include_once('conexion.php');
    $sql = "INSERT INTO comision (cargo_funcio, nombre, apellidos,area_user, convocatoria_idcon) 
            VALUES $valoresQ";

    $sqlRes = $con->query($sql) or mysqli_error($con);

    // Up! Next Value
    $item1 = next($items1);
    $item2 = next($items2);
    $item3 = next($items3);
    $item4 = next($items4);

    // Check terminator
    if ($item1 === false && $item2 === false && $item3 === false && $item4 === false) break;
  }
}

header('Location: ../resumen_convocatoria.php?convocatoria_idcon=' . $idcon . '&dni=' . $dni);
