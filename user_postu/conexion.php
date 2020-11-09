<?php
$hostname = "localhost";
//$hostname="192.160.0.75";
$username = "root";
$password = "123456";
$dbname = "sistema_seleccion";
// $root='3306';

$con = mysqli_connect($hostname, $username, $password, $dbname);

if (!$con) {
  echo "<p>Error de conexion</p>";
} else {
  //echo "Conexión exitosa";
}
// mysqli_close($con);
