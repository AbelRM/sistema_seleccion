<?php

include '../conexion.php';

// Update data into the database
if(ISSET($_POST['updateData2']))
{   
    $dato_desencriptado= $_POST['dato_desencriptado'];
    $idcursos = $_POST['idcursos_extra'];
    $centro_estu = $_POST['centro_estud'];
    $materia = $_POST['materia'];
    $horas = $_POST['horas'];
    $fecha_inicio = $_POST['fech_inic'];
    $fecha_fin = $_POST['fech_fin1'];
    $tipo = $_POST['tipo1']; 
    $nivel = $_POST['nivel2'];   

    $sql = "UPDATE cursos_extra SET centro_estu='".$centro_estu."', materia='".$materia."',horas='".$horas."', fech_ini='".$fecha_inicio."', 
    fech_fin='".$fecha_fin."', tipo='".$tipo."', nivel='".$nivel."' WHERE idcursos_extra='".$idcursos."' ";

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