<?php

include '../conexion.php';

// Update data into the database
if(ISSET($_POST['updateData2']))
{   
    $dato_desencriptado= $_POST['dato_desencriptado'];
    $idestudios = $_POST['id_3puntos'];
    $lugar = $_POST['lugar2'];
    $cargo = $_POST['cargo2'];
    $inicio = $_POST['fecha_inicio2'];
    $fin = $_POST['fecha_fin2']; 

    $sql = "UPDATE expe_3puntos SET lugar='".$lugar."', cargo='".$cargo."',fecha_inicio='".$inicio."', fecha_fin='".$fin."'WHERE id_3puntos='".$idestudios."'";

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