<?php
// Insert the content of connection.php file
include_once('../conexion.php');

// Insert data into the database
if (isset($_POST['insert'])) {
  $idcon = $_POST['idconvocatoria'];
  $dni = $_POST['dni'];

  $cantidad = $_POST['cantidad'];
  $cargo = $_POST['cargo'];
  $remuneracion = $_POST['remuneracion'];
  $fuente_finac = $_POST['fuente_finac'];
  $meta = $_POST['meta'];
  $ubicacion = $_POST['chosen-unique'];

  $sql = "INSERT INTO personal_req (cantidad,remuneracion,fuente_finac,meta,cargo_idcargo,convocatoria_idcon,personal_req_idubicacion) 
      VALUES('" . $cantidad . "','" . $remuneracion . "','" . $fuente_finac . "','" . $meta . "','" . $cargo . "','" . $idcon . "','" . $ubicacion . "')";

  $result = mysqli_query($con, $sql);
  $rs = mysqli_query($con, "SELECT @@identity AS id");
  if ($row = mysqli_fetch_row($rs)) {
    $id_requerimiento = trim($row[0]);
  }
  // $id_requerimiento = mysqli_insert_id($con);

  if ($result) {

    $items1 = ($_POST['requerimientos']);
    $items2 = ($_POST['nivel_priori']);

    ///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 5 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
    while (true) {

      //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
      $item1 = current($items1);
      $item2 = current($items2);

      ////// ASIGNARLOS A VARIABLES ///////////////////
      $requerimientos = (($item1 !== false) ? $item1 : ", &nbsp;");
      $nivel_priori = (($item2 !== false) ? $item2 : ", &nbsp;");

      //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
      $valores = '("' . $id_requerimiento . '","' . $requerimientos . '","' . $nivel_priori . '"),';

      //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
      $valoresQ = substr($valores, 0, -1);

      ///////// QUERY DE INSERCIÓN ////////////////////////////
      // include_once('conexion.php');
      $sql = "INSERT INTO detalle_requerimientos (detalle_req_idpersonal_req, detalle_req_idrequerimientos,nivel_prioridad) 
          VALUES $valoresQ";

      $sqlRes = $con->query($sql) or mysqli_error($con);

      // Up! Next Value
      $item1 = next($items1);
      $item2 = next($items2);


      // Check terminator
      if ($item1 === false && $item2 === false) break;
    }
    echo "Agrego correctamnete";
  } else {
    echo '<script> alert("Error al guardar PRIMERA!"); 
          window.history.back(-1);</script>';
  }
}

 // header('Location: ../agregar_comision.php?convocatoria_idcon='.$idcon.'&dni='.$dni);
      // header('Location: ../agregar_personal_req_v2.php?dni='.$dni);
