<?php
    include('../conexion.php');
    if(ISSET($_POST['deleteData1']))
    {
        $id = $_POST['idcargo']; 
        $dni = $_POST['dni'];
        $sql = "DELETE FROM cargo WHERE idcargo='$id'";
        $result = mysqli_query($con, $sql);
 
        header('Location: ../cargos.php?dni='.$dni);
        mysqli_close($con);

    }
?>