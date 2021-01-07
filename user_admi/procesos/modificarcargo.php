<?php

include '../conexion.php';

$id = $_POST['idcargo'];
$dato_desencriptado = $_POST['dni_modif'];

$cargo = $_POST['edit_cargo'];
$tipo = $_POST['edit_tipo'];


$sql = "UPDATE cargo SET  cargo='$cargo', tipo_cargo_id='$tipo' WHERE idcargo='$id'";

$result = mysqli_query($con, $sql);



header('Location: ../cargos.php?dni=' . $dato_desencriptado);
mysqli_close($con);
