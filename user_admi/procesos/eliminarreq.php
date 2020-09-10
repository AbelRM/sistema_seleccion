<?php
    include('../conexion.php');
    if(ISSET($_POST['deleteData1']))
    {
        $id = $_POST['id_req']; 
        $dni = $_POST['dni'];
        $sql = "DELETE FROM requerimientos WHERE id_requerimientos='$id'";
        $result = mysqli_query($con, $sql);
 
        header('Location: ../requisitos.php?dni='.$dni);
        mysqli_close($con);

    }
?>