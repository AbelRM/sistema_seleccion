<?php

include '../conexion.php';

// Update data into the database
if(ISSET($_POST['updateData1']))
{   
    $dato_desencriptado= $_POST['dato_desencriptado'];
    $idestudios = $_POST['id_4puntos'];
    $lugar = $_POST['lugar1'];
    $cargo = $_POST['cargo'];
    $inicio = $_POST['fecha_inicio'];
    $fin = $_POST['fecha_fin']; 

    $sql = "UPDATE expe_4puntos SET lugar='".$lugar."', cargo='".$cargo."',fecha_inicio='".$inicio."', fecha_fin='".$fin."'WHERE id_4puntos='".$idestudios."'";

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