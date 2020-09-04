<?php

include '../conexion.php';

// Update data into the database
if(ISSET($_POST['updateData3']))
{   
    $dato_desencriptado= $_POST['dato_desencriptado'];
    $idestudios = $_POST['id_1puntos'];
    $lugar = $_POST['lugar3'];
    $cargo = $_POST['cargo3'];
    $inicio = $_POST['fecha_inicio3'];
    $fin = $_POST['fecha_fin3']; 

    $sql = "UPDATE expe_1puntos SET lugar='".$lugar."', cargo='".$cargo."',fecha_inicio='".$inicio."', fecha_fin='".$fin."'WHERE id_1puntos='".$idestudios."'";

    $result = mysqli_query($con, $sql);

    if($result)
    {
        header("Location: ../exp_laboral.php?dni=$dato_desencriptado");
        // echo '<script> alert("Datos guardados exitosamente."); 
        // window.location.href = "capacitacion.php?dni=".$dato_desencriptado;
        // </script>';
    }
    else
    {
        echo '<script> alert("Error al actualizar, verifique!"); </script>';
    }
}
?>