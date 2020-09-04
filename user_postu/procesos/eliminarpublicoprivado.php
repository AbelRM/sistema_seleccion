<?php
    
    include('../conexion.php');
    $url= $_POST['url'];
    //$dni =$_POST['dni'];
    $id = $_POST['id3']; 
    if(ISSET($_POST['deleteData3']))
    {
        $sql = "DELETE FROM expe_1puntos WHERE id_1puntos='".$id."' ";
        $result = mysqli_query($con, $sql);
 
        if($result){
            echo '<script> alert("Registro eliminado!"); </script>';
            header("Location: ../exp_laboral.php?dni=$url");
            //header('Location: ../capacitacion.php?dni='$dato_desencriptado);
        }else{
            echo '<script> alert("ERROR al eliminar registro."); </script>';
        }
    }
?>