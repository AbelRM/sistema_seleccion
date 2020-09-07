<?php
  // Insert the content of connection.php file
  include('../conexion.php');
  
  // Insert data into the database
  if(ISSET($_POST['editar'])){
    $colegiatura_validar = $_POST['colegiatura_edit'];
    
    $dni = $_POST['dni'];
    $idformacion = $_POST['idformacion'];
    if($colegiatura_validar=='NO'){ 
        echo $colegiatura_validar;
        $tipo_estudios = $_POST['tipo_estudios_edit'];
        $nivel_estudios = $_POST['nivel_estudios_edit'];
        $centro_estudios = $_POST['centro_estudios'];
        $carrera = $_POST['carrera'];
        $colegiatura = $_POST['colegiatura_edit'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];

        $sql = "UPDATE formacion_acad SET tipo_estudios_id='".$tipo_estudios."', nivel_estudios='".$nivel_estudios."',centro_estudios='".$centro_estudios."',
        carrera='".$carrera."',colegiatura='".$colegiatura."',fecha_inicio='".$fecha_inicio."',fecha_fin='".$fecha_fin."'
        WHERE id_formacion='".$idformacion."' ";

        $result = mysqli_query($con, $sql);

        if($result)
        {
            header("Location: ../formacion.php?dni=$dni");
        }
        else
        {
            echo '<script> alert("Error al actualizar, verifique!"); </script>';
        }
    }else{
        $tipo_estudios = $_POST['tipo_estudios_edit'];
        $nivel_estudios = $_POST['nivel_estudios_edit'];
        $centro_estudios = $_POST['centro_estudios'];
        $carrera = $_POST['carrera'];
        $colegiatura = $_POST['colegiatura_edit'];
        $nro_colegiatura = $_POST['nro_colegiatura_edit'];
        $fecha_colegiatura = $_POST['fecha_colegiatura_edit'];
        $lugar_colegiatura = $_POST['lugar_colegiatura_edit'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
    
        $sql = "UPDATE formacion_acad SET tipo_estudios_id='".$tipo_estudios."', nivel_estudios='".$nivel_estudios."',centro_estudios='".$centro_estudios."',
        carrera='".$carrera."',colegiatura='".$colegiatura."',nro_colegiatura='".$nro_colegiatura."',nro_colegiatura='".$nro_colegiatura."',
        fech_habilitacion='".$fecha_colegiatura."',lugar_colegiatura='".$lugar_colegiatura."',fecha_inicio='".$fecha_inicio."',fecha_fin='".$fecha_fin."'
        WHERE id_formacion='".$idformacion."' ";
    
        $result = mysqli_query($con, $sql);
    
        if($result)
        {
            header("Location: ../formacion.php?dni=$dni");
        }
        else
        {
            echo '<script> alert("Error al actualizar, verifique!"); </script>';
        }
    }

  }

?>