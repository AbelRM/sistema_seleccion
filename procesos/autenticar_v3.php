<?php

require '../conexion.php';
session_start();

$dni=$_POST['dni'];
$clave=$_POST['clave'];

$q = "SELECT COUNT(*) AS contar from user where dni = '$dni' and clave='$clave' ";
$consulta=mysqli_query($con,$q);
$array=mysqli_fetch_array($consulta);

if($array['contar']>0){
    $_SESSION['dni']=$dni;
    header("Location: ../user_postu/index.php?dni=$dni");
}else{
?>
    <script languaje="javascript">
        alert("Nombre de usuario y/o contraseña incorrecto");
        location.href = "../index.php";
    </script>
<?php    
}
?>