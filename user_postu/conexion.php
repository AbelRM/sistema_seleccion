<?php
$hostname="127.0.0.1";
//$hostname="192.160.0.75";
$username="root";
$password="123456";
$dbname="sistema_seleccion";

$con=mysqli_connect($hostname, $username, $password, $dbname);

if(!$con){
    echo "<p>Error de conexion</p>";
}
else{
	//echo "Conexión exitosa";
}
// mysqli_close($con);

?>