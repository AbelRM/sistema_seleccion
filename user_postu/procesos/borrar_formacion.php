<?php
    // Insert the content of connection.php file
    include('../conexion.php');
    
    // Delete data from the database
    if(ISSET($_POST['deleteData']))
    {
        $id = $_POST['deleteId']; 
        $dni = $_POST['dni'];
        $sql = "DELETE FROM formacion_acad WHERE id_formacion='$id'";
        $result = mysqli_query($con, $sql);
 
        if($result){
            header("Location: ../formacion.php?dni=$dni");
        }else{
            echo '<script> alert("No se puede borrar."); </script>';
        }
    }
?>