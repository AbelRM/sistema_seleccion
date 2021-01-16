<?php
    include('../conexion.php');
    if(ISSET($_POST['deleteData1']))
    {
        $id = $_POST['iddireccion']; 
        $dni = $_POST['dni'];
        $sql = "DELETE FROM direccion_ejec WHERE iddireccion='$id'";
        $result = mysqli_query($con, $sql);
 
        header('Location: ../direccion_ejec.php?dni='.$dni);
        mysqli_close($con);

    }
?>