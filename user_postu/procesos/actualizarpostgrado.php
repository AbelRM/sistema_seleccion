<?php

include '../conexion.php';

// Update data into the database
if(ISSET($_POST['updateData1']))
{   
    $dato_desencriptado= $_POST['dato_desencriptado'];
    $idestudios = $_POST['idmaestria_doc'];
    $centro_estu = $_POST['centro_estudios'];
    $especialidad = $_POST['especialidades'];
    $fecha_inicio = $_POST['fech_ini'];
    $fecha_fin = $_POST['fech_fin'];
    $nivel = $_POST['nivel1'];

    $sql = "UPDATE maestria_doc SET centro_estu='".$centro_estu."', especialidad='".$especialidad."', fech_ini='".$fecha_inicio."', 
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