<?php
session_start();

$dni = $_POST['dni'];
$password = $_POST['clave'];

include '../conexion.php';
// se asume conexion en $conn incluido desde conexion.php, ejemlo:
// $conn= mysqli_connect("server", "mi_usuario", "mi_contraseña", "mi_bd");

// añadiría un limit 1 a la consulta pues solo esperamos un registro
$consulta = mysqli_query ($con, "SELECT * FROM user WHERE dni = '$dni' AND clave = '$password'");  

// esto válida si la consulta se ejecuto correctamente o no
// pero en ningún caso válida si devolvió algún registro
if(!$consulta){ 
    echo "Usuario no existe " . $dni . " hubo un error ";
    echo mysqli_error($mysqli);
    // si la consulta falla es bueno evitar que el código se siga ejecutando
    exit;
} 
//este else sobra
else { 

    header("Location: ../user_admi/index.php?dni='.$dni");

} 

// validemos pues si se obtuvieron resultados 
// Obtenemos los resultados con mysqli_fetch_assoc
// si no hay resultados devolverá NULL que al convertir a boleano para ser evaluado en el if será FALSE
//if($user = mysqli_fetch_assoc($consulta)) {
    // el usuario y la pwd son correctas
//} else {
    // Usuario incorrecto o no existe
//}

?>