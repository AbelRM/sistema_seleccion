<?php
    // Insert the content of connection.php file
    include('../conexion.php');
    
    // Delete data from the database
    if(ISSET($_POST['deleteData']))
    {
        $dato_desencriptado= $_POST['dato_desencriptado'];
        //$dni =$_POST['dni'];
        $idestudios = $_POST['idestudios']; 
        echo "$idestudios";
 
        $sql = "DELETE FROM estudios_superiores WHERE idestudios='$idestudios'";
        $result = mysqli_query($con, $sql);
 
        if($result){
            echo '<script> alert("Registro eliminado!"); </script>';
            //header("Location: ../capacitacion.php?dni=$dato_desencriptado");
            //header('Location: ../capacitacion.php?dni='$dato_desencriptado);
        }else{
            echo '<script> alert("ERROR al eliminar registro."); </script>';
        }
    }
?>