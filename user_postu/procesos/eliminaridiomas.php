<?php
    
    include('../conexion.php');
    $url= $_POST['url'];
    //$dni =$_POST['dni'];
    $id = $_POST['id3']; 

   
    if(ISSET($_POST['deleteData3']))
    {
        $sql = "DELETE FROM idiomas_comp WHERE ididiomas_comp='".$id."' ";
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