<?php
    include('../conexion.php');
    $url= $_POST['dni_url_2'];
    $dni_base =$_POST['dni_base_2'];
    $id = $_POST['id2']; 
    if(ISSET($_POST['deleteData2']))
    {
        $consulta = "SELECT * FROM expe_3puntos  WHERE id_3puntos='$id'";  
        $resultado = mysqli_query($con, $consulta);
        $row= MySQLI_fetch_array($resultado);
        $archivo = $row['archivos'];
        $ruta = "../archivos/".$dni_base."/";

        $sql = "DELETE FROM expe_3puntos WHERE id_3puntos='".$id."' ";
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