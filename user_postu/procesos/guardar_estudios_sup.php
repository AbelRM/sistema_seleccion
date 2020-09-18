<?php
  // Insert the content of connection.php file
  include('../conexion.php');
  
  // Insert data into the database
  if(ISSET($_POST['insertData']))
    {
    
      $dato_desencriptado = $_POST['dni_encriptado'];  
      $dni = $_POST['dni'];
      echo $dni;
      $idpostulante = $_POST['postulante'];

     // Recibo los datos de la imagen
      $nombre_archivo = $_FILES['archivo']['name'];
      $tipo_archivo = $_FILES['archivo']['type'];
      $tamano_archivo = $_FILES['archivo']['size'];

      $destino =$_SERVER['DOCUMENT_ROOT']. '/sistema_seleccion/user_postu/archivos/' . $dni . '/capacitacion/';

      if (!file_exists($destino)) {  
        $destino = mkdir($destino, 0777, true);
      }elseif (!strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000)) {
        echo "La extension o el tamaño de los archivos no es correcta";
      }elseif (move_uploaded_file($_FILES['archivo']['tmp_name'], $destino.$nombre_archivo))
      {
            $centro_estudios = $_POST['centro_estudios'];
            $especialidad = $_POST['especialidad'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = $_POST['fecha_fin'];
            $nivel = $_POST['nivel_estudios'];

            $sql = "INSERT INTO estudios_superiores (centro_estu,especialidad,fech_ini,fech_fin,nivel,idpostulante_postulante,archivo) 
            VALUES('$centro_estudios','$especialidad','$fecha_inicio','$fecha_fin','$nivel','$idpostulante','$nombre_archivo')";  
                
            $result = mysqli_query($con, $sql);
            if($result){
            echo '<script> alert("Guardado exitosamente"); </script>';
            header('Location: ../capacitacion.php?dni='.$dato_desencriptado);
            }else
            {
            echo '<script> alert("Error al guardar PRIMERA!"); </script>';
            // header('Location: ../formacion.php?dni='.$dni);
            }
      } 
    }
?>