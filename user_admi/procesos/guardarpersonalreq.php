<?php 

    include "../conexion.php";
    $dni=$_POST['dni'];
    $direccion = $_POST['direccion'];
    $equipo = $_POST['equipo'];

    $sql= "INSERT INTO direccion_ejec (direccion_ejec, equipo_ejec_idequipo) 
    VALUES ('".$direccion."','".$equipo."')";

    $result=mysqli_query($con,$sql);

header('Location: ../direccion_ejec.php?dni='.$dni);
mysqli_close($con);  
?>