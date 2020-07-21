<?php
session_start();

$dni = $_POST['dni'];
$password = $_POST['clave'];

include '../conexion.php';
// se asume conexion en $conn incluido desde conexion.php, ejemlo:
// $conn= mysqli_connect("server", "mi_usuario", "mi_contraseña", "mi_bd");

// añadiría un limit 1 a la consulta pues solo esperamos un registro
$consulta = mysqli_query ($con, "SELECT * FROM usuarios WHERE dni = '$dni' AND clave = '$password'");  
$consulta_2= mysqli_query ($con, "SELECT * FROM usuarios WHERE dni = '$dni' AND tipo_user = 'POSTULANTE'"); 

$encri=base64_encode($dni);
// esto válida si la consulta se ejecuto correctamente o no
// pero en ningún caso válida si devolvió algún registro
if(!$consulta){ 

?>
    <script languaje="javascript">
        alert("Nombre de usuario y/o contraseña incorrecto");
        location.href = "../index.php";
    </script>
<?php
} 
//este else sobra
elseif($consulta_2) {   
    header("Location: ../user_postu/index.php?dni=$encri");       

} else {
    header("Location: ../user_admi/index.php?dni=$encri");

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