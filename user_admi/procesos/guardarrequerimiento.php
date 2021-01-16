<?php 

    include "../conexion.php";
    $dni=$_POST['dni'];
    $requerimiento = $_POST['requerimiento'];
    $valor = $_POST['valor'];

    $sql= "INSERT INTO requerimientos (condicion, valor_condicion) 
    VALUES ('".$requerimiento."','".$valor."')";

    $result=mysqli_query($con,$sql);
    
header('Location: ../requisitos.php?dni='.$dni);
mysqli_close($con);  
?>