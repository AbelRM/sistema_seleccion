<?php
  // Insert the content of connection.php file
  include('../conexion.php');
  
  // Insert data into the database
  if(ISSET($_POST['insertData']))
  {
    $colegiatura_validar = $_POST['colegiatura'];
    echo $colegiatura_validar;
    if($colegiatura_validar=='NO'){
      $dni = $_POST['dni'];
      $idpostulante = $_POST['postulante'];
      $tipo_estudios = $_POST['tipo_estudios'];
      $nivel_estudios = $_POST['nivel_estudios'];
      $centro_estudios = $_POST['centro_estudios'];
      $carrera = $_POST['carrera'];
      $colegiatura = $_POST['colegiatura'];
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_fin = $_POST['fecha_fin'];

      $sql = "INSERT INTO formacion_acad (tipo_estudios_id,nivel_estudios,centro_estudios,carrera,colegiatura,fecha_inicio, fecha_fin, postulante_id) 
      VALUES('$tipo_estudios','$nivel_estudios','$centro_estudios', '$carrera','$colegiatura','$fecha_inicio','$fecha_fin','$idpostulante')";  
          
      $result = mysqli_query($con, $sql);
      if($result){
          echo '<script> alert("Guardado exitosamente"); </script>';
          header('Location: ../formacion.php?dni='.$dni);
      }else{
          echo '<script> alert("Error al guardar PRIMERA!"); </script>';
      }
    }else{
      $dni = $_POST['dni'];
      $idpostulante = $_POST['postulante'];
      $tipo_estudios = $_POST['tipo_estudios'];
      $nivel_estudios = $_POST['nivel_estudios'];
      $centro_estudios = $_POST['centro_estudios'];
      $carrera = $_POST['carrera'];
      $colegiatura = $_POST['colegiatura'];
      $nro_colegiatura = $_POST['nro_colegiatura'];
      $fecha_colegiatura = $_POST['fecha_colegiatura'];
      $lugar_colegiatura = $_POST['lugar_colegiatura'];
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_fin = $_POST['fecha_fin'];

      $sql = "INSERT INTO formacion_acad (tipo_estudios_id,nivel_estudios,centro_estudios,carrera,colegiatura,nro_colegiatura,fech_habilitacion,
      lugar_colegiatura,fecha_inicio, fecha_fin, postulante_id) 
      VALUES('$tipo_estudios','$nivel_estudios','$centro_estudios', $carrera','$colegiatura','$nro_colegiatura','$fecha_colegiatura','$lugar_colegiatura',
      '$fecha_inicio','$fecha_fin','$idpostulante')";  
          
      $result = mysqli_query($con, $sql);
      if($result){
          echo '<script> alert("Guardado exitosamente"); </script>';
          header('Location: ../formacion.php?dni='.$dni);
      }else{
          echo '<script> alert("Error al guardar SEGUNDA!"); </script>';
      }
    }
  }
?>