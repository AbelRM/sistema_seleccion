<?php

include '../conexion.php';

// Update data into the database
   
    $dato_desencriptado= $_POST['dato_desencriptado'];
    $id = $_POST['iduser'];
    $dni = $_POST['dni'];
    $nombre = $_POST['nombres'];
    $apellido_pat = $_POST['ape_pat'];
    $apellido_mat = $_POST['ape_mat'];
    $correo = $_POST['correo'];
    $celular = $_POST['celular'];   

    $sql = "UPDATE usuarios SET dni='".$dni."', nombres='".$nombre."',ape_pat='".$apellido_pat."', ape_mat='".$apellido_mat."', 
    correo='".$correo."', celular='".$celular."' WHERE iduser='".$id."' ";

    $result = mysqli_query($con, $sql);

    if($result)
    {
        header("Location: ../capacitacion.php?dni=$dato_desencriptado");
    }
    else
    {
        echo '<script> alert("Error al actualizar, verifique!"); </script>';
    }
?>