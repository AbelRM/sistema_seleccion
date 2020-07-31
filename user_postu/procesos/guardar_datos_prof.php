<?php 

    include '../conexion.php';
    $dni=$_POST['dni'];
    $idpostulante= $_POST['idpostulante'];
    $profesion = $_POST['profesion'];
    $lugar_cole = $_POST['lugar_cole'];
    $fecha_cole= $_POST['fecha_cole'];
    $fech_habi = $_POST['fech_habi'];
    $num_cole = $_POST['num_cole'];
    

    $sql= "INSERT INTO datos_profesionales (profesion,fecha_cole,lugar_cole,fecha_habi,nro_cole,postulante_idpostulante) 
    VALUES ('".$profesion."','".$fecha_cole."','".$lugar_cole."','".$fech_habi."','".$num_cole."','".$idpostulante."')";

    if ($con->query($sql) == TRUE) {
        $idcon=mysqli_insert_id($con);
        header('Location: ../mis_cursos.php?dni='.$dni);
    } else {
        echo "Error: ".$sql. "<br>".$con->error;
    }

    $con->close();

?>