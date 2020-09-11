<?php

include '../conexion.php';

// Update data into the database
if(ISSET($_POST['updateData2']))
{   
  
    $dato_desencriptado= $_POST['dato_desencriptado'];
    $id = $_POST['iduser'];
    $nombre = $_POST['nombres'];
    $apellido_pat = $_POST['ape_pat'];
    $apellido_mat = $_POST['ape_mat'];
    $correo = $_POST['correo'];
    $celular = $_POST['celular'];   

    $sql = "UPDATE usuarios SET  nombres='".$nombre."',ape_pat='".$apellido_pat."', ape_mat='".$apellido_mat."', 
    correo='".$correo."', celular='".$celular."' WHERE iduser='".$id."' ";

    $result = mysqli_query($con, $sql);  

    if($result)
    {
        header("Location: ../index.php?dni=$dato_desencriptado");
    }
    else
    {
        echo '<script> alert("Error al actualizar, verifique!"); </script>';
    }
}
?>