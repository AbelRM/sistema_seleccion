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
}
