<?php
  // Insert the content of connection.php file
  include('../conexion.php');
  
  // Insert data into the database
  if(ISSET($_POST['insertData']))
  {
    $colegiatura_validar = $_POST['colegiatura'];
    if($colegiatura_validar=='NO'){
      $dato_desencriptado = $_POST['dni_encriptado'];
      $dni = $_POST['dni'];
      $idpostulante = $_POST['postulante'];

     // Recibo los datos de la imagen
      $nombre_archivo = $_FILES['archivo']['name'];
      $tipo_archivo = $_FILES['archivo']['type'];
      $tamano_archivo = $_FILES['archivo']['size'];
      // $ruta = $_FILES['archivo']['tmp_name'];
      
      $destino =$_SERVER['DOCUMENT_ROOT']. "/sistema_seleccion/user_postu/archivos/" . $dni . "/";
      // $path = "sample/path/newfolder";
      if (!file_exists($destino)) {
        $destino = mkdir($destino, 0777, true);
      }elseif (!strpos($tipo_archivo, "pdf")) {
        echo "Solo se permite archivos PDF o JPEG";
      }elseif (! ($tamano_archivo <= 5000000)){
        echo "El archivo excede el tamaño máximo de 1MB";
      }elseif (move_uploaded_file($_FILES['archivo']['tmp_name'], $destino.$nombre_archivo)){
        $titulo= $_POST['titulo'];
        $descri= $_POST['descripcion'];
        $tipo_estudios = $_POST['tipo_estudios'];
        $nivel_estudios = $_POST['nivel_estudios'];
        $centro_estudios = $_POST['centro_estudios'];
        $carrera = $_POST['carrera'];
        $colegiatura = $_POST['colegiatura'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];

        $sql = "INSERT INTO formacion_acad (tipo_estudios_id,nivel_estudios,centro_estudios,carrera,colegiatura,fecha_inicio, 
        fecha_fin, formacion_idpostulante,archivo) 
        VALUES('$tipo_estudios','$nivel_estudios','$centro_estudios', '$carrera','$colegiatura_validar','$fecha_inicio',
        '$fecha_fin','$idpostulante','$nombre_archivo')";  
            
        $result = mysqli_query($con, $sql);
        if($result){
          echo '<script> alert("Guardado exitosamente"); </script>';
          header('Location: ../formacion.php?dni='.$dato_desencriptado);
        }else{
          echo '<script> alert("Error al guardar PRIMERA!"); </script>';
          // header('Location: ../formacion.php?dni='.$dni);
        }
      } else {
        echo "Error";
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