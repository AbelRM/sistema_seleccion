<?php 

    include "../conexion.php";
    $dni=$_POST['dni'];
    $cargo = $_POST['cargo'];
    $tipo = $_POST['tipo'];

    $sql= "INSERT INTO cargo (cargo, tipo_cargo_id) 
    VALUES ('".$cargo."','".$tipo."')";

    $result=mysqli_query($con,$sql);

header('Location: ../cargos.php?dni='.$dni);
mysqli_close($con);
