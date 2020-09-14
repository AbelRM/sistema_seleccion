<?php
    
    include('../conexion.php');
    $url= $_POST['dni_url'];
    $dni_base =$_POST['dni_base'];
    $id = $_POST['id1']; 
    if(ISSET($_POST['deleteData1']))
    {
        $consulta = "SELECT * FROM expe_4puntos  WHERE id_4puntos='$id'";  
        $resultado = mysqli_query($con, $consulta);
        $row= MySQLI_fetch_array($resultado);
        $archivo = $row['archivos'];
        $ruta = "../archivos/".$dni_base."/";

        $sql = "DELETE FROM expe_4puntos WHERE id_4puntos='".$id."' ";
        $result = mysqli_query($con, $sql);

        unlink($ruta.$archivo);
        if($result){
            echo '<script> alert("Registro eliminado!"); </script>';
            header("Location: ../exp_laboral.php?dni=$url");
            //header('Location: ../capacitacion.php?dni='$dato_desencriptado);
        }else{
            echo '<script> alert("ERROR al eliminar registro."); </script>';
        }
    }
?>