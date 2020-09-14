<?php
  // Insert the content of connection.php file
  include('../conexion.php');
  
  // Insert data into the database
  if(ISSET($_POST['insertData3']))
    {
    
      $dato_desencriptado = $_POST['dni_encriptado'];
      $dni = $_POST['dni'];
      $idpostulante = $_POST['postulante'];

     // Recibo los datos de la imagen
      $nombre_archivo = $_FILES['archivo2']['name'];
      $tipo_archivo = $_FILES['archivo2']['type'];
      $tamano_archivo = $_FILES['archivo2']['size'];
      
      $destino =$_SERVER['DOCUMENT_ROOT']. "/sistema_seleccion/user_postu/archivos/" . $dni . "/";
      // $path = "sample/path/newfolder"; 
      if (!file_exists($destino)) {
        $destino = mkdir($destino, 0777, true);
      }elseif (!strpos($tipo_archivo, "pdf")) {
        echo "Solo se permite archivos PDF o JPEG";
      }elseif (! ($tamano_archivo < 5000000)){
        echo "El archivo excede el tamaño máximo de 1MB";
      }elseif (move_uploaded_file($_FILES['archivo2']['tmp_name'], $destino.$nombre_archivo))
      {
       
            $idioma = $_POST['idioma'];
            $nivel = $_POST['nivel'];

 

            $sql = "INSERT INTO idiomas_comp (idioma_comp,nivel,idpostulante_postulante,archivo) 
            VALUES('$idioma','$nivel','$idpostulante','$nombre_archivo')";  
                
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