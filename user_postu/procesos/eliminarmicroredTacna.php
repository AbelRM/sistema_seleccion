<?php
    
    include('../conexion.php');
    $url= $_POST['url'];
    //$dni =$_POST['dni'];
    $id = $_POST['id2']; 
    if(ISSET($_POST['deleteData2']))
    {
        $sql = "DELETE FROM expe_3puntos WHERE id_3puntos='".$id."' ";
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