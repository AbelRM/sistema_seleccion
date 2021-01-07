<?php


$dni = $_POST['dni'];
$password = $_POST['clave'];

include '../conexion.php';
// se asume conexion en $conn incluido desde conexion.php, ejemlo:
// $conn= mysqli_connect("server", "mi_usuario", "mi_contraseña", "mi_bd");

// añadiría un limit 1 a la consulta pues solo esperamos un registro
$consulta = mysqli_query ($con, "SELECT * FROM usuarios WHERE dni = '$dni' AND clave = '$password'") or die(mysqli_error());
$consulta_2= mysqli_query ($con, "SELECT * FROM usuarios WHERE dni = '$dni' AND tipo_user = 'POSTULANTE'") or die(mysqli_error()); 

if(mysqli_num_rows($consulta) > 0) {
    if(mysqli_num_rows($consulta_2) > 0) {
        session_start();
        $_SESSION['dni']="$dni";
        header("Location: ../user_postu/index.php?dni=$dni");    
        exit();
    }else{
        session_start();
        $_SESSION['dni']="$dni";
        header("Location: ../user_admi/index.php?dni=$dni");  
        exit();
    }
}else{
?>
    <script languaje="javascript">
        alert("Nombre de usuario y/o contraseña incorrecto");
        location.href = "../index.php";
    </script>
<?php
}
?>