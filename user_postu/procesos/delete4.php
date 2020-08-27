<?php
    // Insert the content of connection.php file
    include('../conexion.php');
    
    // Delete data from the database
    if(ISSET($_POST['deleteData']))
    {
        $dni =$_POST['dni'];
        $id = $_POST['deleteId']; 
 
        $sql = "DELETE FROM expe_4puntos WHERE id_4puntos='$id'";
        $result = mysqli_query($con, $sql);
 
        if($result){
            echo '<script> alert("Registro eliminado!"); </script>';
            header('Location: ../exp_laboral.php?dni='.$dni);
        }else{
            echo '<script> alert("ERROR al eliminar registro."); </script>';
        }
    }
?>