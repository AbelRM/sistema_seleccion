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

      $centro_estudios = $_POST['centro_estudios'];
      $especialidad = $_POST['especialidad'];
      $tipo = $_POST['tipo'];
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_fin = $_POST['fecha_fin'];
      $nivel = $_POST['nivel_estudios'];

      $micarpeta =$_SERVER['DOCUMENT_ROOT']. '/sistema_seleccion/user_postu/archivos/' . $dni . '/Postgrado/';
      if (!file_exists($micarpeta)) {
        mkdir($micarpeta, 0777, true);
      }

      $nombre_archivo = $_FILES['archivo1']['name'];
      $tipo_archivo = $_FILES['archivo1']['type'];
      $tamano_archivo = $_FILES['archivo1']['size'];

      $query = mysqli_query($con, "SELECT * FROM maestria_doc WHERE idmaestria_doc = $idpostulante");
      $result = mysqli_num_rows($query);
      if ($result <= 0) {
        $i = 1;
        $new_nombre = "maestria_" . $i . ".pdf";
      } else {
        $row = mysqli_fetch_array($query);
        $idformacion = $row['idmaestria_doc'];
        $i = $idformacion;
        $new_nombre = "maestria_" . $i . ".pdf";
      }

      if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
        echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Solo se permiten archivos .pdf<br><li>se permiten archivos de 3 Mb máximo.</td></tr></table>";
      } else {
        if (move_uploaded_file($_FILES['archivo1']['tmp_name'], $micarpeta . $new_nombre)) {
          
          $centro_estudios = $_POST['centro_estudios'];
          $especialidad = $_POST['especialidad'];
          $tipo = $_POST['tipo'];
          $fecha_inicio = $_POST['fecha_inicio'];
          $fecha_fin = $_POST['fecha_fin'];
          $nivel = $_POST['nivel_estudios'];

            $sql = "INSERT INTO maestria_doc (centro_estu,especialidad,tipo_estu,fech_ini,fech_fin,nivel,archivo, idpostulante_postulante) 
            VALUES('$centro_estudios','$especialidad','$tipo','$fecha_inicio','$fecha_fin','$nivel','$new_nombre', '$idpostulante')";  

          $result = mysqli_query($con, $sql);
          if ($result) {
            echo '<script> alert("Guardado exitosamente"); </script>';
            header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
          } else {
            echo '<script> alert("Error al guardar PRIMERA!"); </script>';
            header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
          }
        } else {
          echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
        }
      }
      }  
      else {
      //Crear carpeta
      $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/Postgrado/';
      if (!file_exists($micarpeta)) {
        mkdir($micarpeta, 0777, true);
      }
      //Datos del arhivo
      $nombre_archivo = $_FILES['archivo']['name'];
      $tipo_archivo = $_FILES['archivo']['type'];
      $tamano_archivo = $_FILES['archivo']['size'];
      //Generar nombre de archivo
      $query = mysqli_query($con, "SELECT * FROM maestria_doc WHERE idmaestria_doc = $idpostulante");
      $result = mysqli_num_rows($query);

      if ($result <= 0) {
        $i = 1;
        $new_nombre = "maestria_" . $i . ".pdf";
      } else {
        $row = mysqli_fetch_array($query);
        $idformacion = $row['idmaestria_doc'];
        $i = $idformacion;
        $new_nombre = "maestria_" . $i . ".pdf";
      }
      //compruebo si las características del archivo son las que deseo
      if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 2000000))) {
        echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Solo se permiten archivos .pdf<br><li>se permiten archivos de 3 Mb máximo.</td></tr></table>";
      } else {
        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $micarpeta . $new_nombre)) {
          $tipo_estudios = $_POST['tipo_estudios'];
          $nivel_estudios = $_POST['nivel_estudios'];
          $centro_estudios = $_POST['centro_estudios'];
          $carrera = $_POST['carrera'];
          $colegiatura = $_POST['colegiatura'];
          $fecha_inicio = $_POST['fecha_inicio'];
          $fecha_fin = $_POST['fecha_fin'];

            $sql = "INSERT INTO maestria_doc (centro_estu,especialidad,tipo_estu,fech_ini,fech_fin,nivel,archivo, idpostulante_postulante) 
            VALUES('$centro_estudios','$especialidad','$tipo','$fecha_inicio','$fecha_fin','$nivel','$new_nombre', '$idpostulante')";  
            

          $result = mysqli_query($con, $sql);
          if ($result) {
            echo '<script> alert("Guardado exitosamente"); </script>';
            header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
          } else {
            echo '<script> alert("Error al guardar PRIMERA!"); </script>';
            header('Location: ../capacitacion.php?dni=' . $dni);
          }
        }
         else 
        {
          echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
          header('Location: ../capacitacion.php?dni=' . $dni);
        }
      }
    }
?>