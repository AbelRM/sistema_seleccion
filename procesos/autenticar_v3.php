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
    //CONSULTA PARA SACAR EL IDPOSTULANTE
    $prueba="SELECT * FROM postulante where dni=$dni";
    $datos=mysqli_query($con,$prueba); 
    $fila= mysqli_fetch_array($datos);
    $idpostulante=$fila['idpostulante'];
    echo $idpostulante;
    
    $resultado=$con->query("SELECT EXISTS (SELECT * FROM familia_post WHERE postulante_idpostulante=$idpostulante);");
    $row=mysqli_fetch_row($resultado);
        if ($row[0]=="1") {                 
            //Aqui colocas el código que tu deseas realizar cuando el dato existe en la base de datos
            header("Location: ../user_postu/index.php?dni=$dni");
        }else{
            //Aqui colocas el código que tu deseas realizar cuando el dato NO existe en la base de datos
            echo $idpostulante;
            header("Location: ../user_postu/form_wizard/index.php?dni=$dni");
        } 
   
}else{
?>
    <script languaje="javascript">
        alert("Nombre de usuario y/o contraseña son incorrecto");
        location.href = "../index.php";
    </script>
<?php    
}
?>