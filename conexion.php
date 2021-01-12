<?php
$hostname = "localhost";
//$hostname="192.160.0.75";
$username = "root";
$password = "";
$dbname = "siuuvupi_sistema_seleccion";
$root = '3306'; //VERIFICAR PUERTO

$con = mysqli_connect($hostname, $username, $password, $dbname);

if (!$con) {
  echo "<p>Error de conexion</p>";
} else {
  //   echo "Conexion exitosa";
}
// mysqli_close($con);
