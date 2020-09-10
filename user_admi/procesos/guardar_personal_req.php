<?php
  // Insert the content of connection.php file
  include('../conexion.php');
  
  // Insert data into the database
  if(ISSET($_POST['insertData']))
  {
      $idconvocatoria = $_POST['idconvocatoria'];
      $dni = $_POST['dni'];

      $cantidad = $_POST['cantidad'];
      $cargo = $_POST['cargo'];
      $remuneracion = $_POST['remuneracion'];
      $fuente_finac = $_POST['fuente_finac'];
      $meta = $_POST['meta'];
      $ubicacion = $_POST['chosen-unique'];
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_fin = $_POST['fecha_fin'];

      $sql = "INSERT INTO personal_req (cantidad,remuneracion,fuente_finac,carrera,colegiatura,fecha_inicio, fecha_fin, postulante_id) 
      VALUES('$tipo_estudios','$nivel_estudios','$centro_estudios', '$carrera','$colegiatura','$fecha_inicio','$fecha_fin','$idpostulante')";  
          
      $result = mysqli_query($con, $sql);
      if($result){
          echo '<script> alert("Guardado exitosamente"); </script>';
          header('Location: ../formacion.php?dni='.$dni);
      }else{
          echo '<script> alert("Error al guardar PRIMERA!"); </script>';
      }
  }

  header('Location: ../agregar_comision.php?convocatoria_idcon='.$idcon.'&dni='.$dni);
?>