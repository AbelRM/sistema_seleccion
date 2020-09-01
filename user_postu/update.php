<?php

// Insert the content of connection.php file
include('conexion.php');

// Update data into the database
if(ISSET($_POST['updateData']))
{   
    $dato_desencriptado= $_POST['dato_desencriptado'];
    $idestudios = $_POST['idestudios'];
    $centro_estu = $_POST['centro_estu'];
    $especialidad = $_POST['especialidad'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $nivel = $_POST['nivel'];

    $sql = "UPDATE estudios_superiores SET centro_estu='".$centro_estu."', especialidad='".$especialidad."', fech_ini='".$fecha_inicio."', 
    fech_fin='".$fecha_fin."', nivel='".$nivel."' WHERE idestudios='".$idestudios."' ";

    $result = mysqli_query($con, $sql);

    if($result)
    {
        header("Location: capacitacion.php?dni=$dato_desencriptado");
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