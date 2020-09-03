<?php

include '../conexion.php';

// Update data into the database
if(ISSET($_POST['updateData3']))
{   
    $dato_desencriptado= $_POST['dato_desencriptado'];
    $ididiomas = $_POST['ididiomas_comp'];
    $idiomas = $_POST['idioma_comp'];
    $nivel = $_POST['nivel4'];
   

    $sql = "UPDATE idiomas_comp SET idioma_comp='".$idiomas."', nivel='".$nivel."' WHERE ididiomas_comp='".$ididiomas."' ";

    $result = mysqli_query($con, $sql);

    if($result)
    {
        header("Location: ../capacitacion.php?dni=$dato_desencriptado");
    }
    else
    {
        echo '<script> alert("Error al actualizar, verifique!"); </script>';
    }
}
?>