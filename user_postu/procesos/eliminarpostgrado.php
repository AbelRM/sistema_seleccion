<?php
    
    include('../conexion.php');
    $url= $_POST['url'];
    //$dni =$_POST['dni'];
    $id = $_POST['id1']; 

   
    if(ISSET($_POST['deleteData1']))
    {
        $sql = "DELETE FROM maestria_doc WHERE idmaestria_doc='".$id."' ";
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