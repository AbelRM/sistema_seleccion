<?php
    // Insert the content of connection.php file
    include('../conexion.php');
    
    // Delete data from the database
    if(ISSET($_POST['deleteData']))
    {
        $id = $_POST['deleteId']; 
        $dni = $_POST['dni'];
        $dni_base = $_POST['dni_base'];
        $consulta = "SELECT * FROM formacion_acad  WHERE id_formacion='$id'";  
        $resultado = mysqli_query($con, $consulta);
        $row= MySQLI_fetch_array($resultado);
        $archivo = $row['archivo'];
        $ruta = "../archivos/".$dni_base."/formacion/";

        $sql = "DELETE FROM formacion_acad WHERE id_formacion='$id'";
        
        $result = mysqli_query($con, $sql);
        unlink($ruta.$archivo);
 
        if($result){
            header("Location: ../formacion.php?dni=$dni");
        }else{
            echo '<script> alert("No se puede borrar."); </script>';
        }
    }
