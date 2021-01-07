<?php
    // Insert the content of connection.php file
    include('../conexion.php');
    $url= $_POST['url'];
    //$dni =$_POST['dni'];
    $id = $_POST['id']; 

    // Delete data from the database
    if(ISSET($_POST['deleteData']))
    {
        
 
        $sql = "DELETE FROM estudios_superiores WHERE idestudios='".$id."' ";
        $result = mysqli_query($con, $sql);
 
        if($result){
            echo '<script> alert("Registro eliminado!"); </script>';
            header("Location: ../capacitacion.php?dni=$url");
            //header('Location: ../capacitacion.php?dni='$dato_desencriptado);
        }else{
            echo '<script> alert("ERROR al eliminar registro."); </script>';
        }
    }
?>