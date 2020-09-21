<?php
  // Insert the content of connection.php file
  include('../conexion.php');
  
  // Insert data into the database
  if(ISSET($_POST['insertData3']))     
    {
    
      $dato_desencriptado = $_POST['dni_encriptado'];  
      $dni = $_POST['dni'];
      echo $dni;
      $idpostulante = $_POST['postulante'];

          $idioma = $_POST['idioma'];
          $nivel = $_POST['nivel'];

      $micarpeta =$_SERVER['DOCUMENT_ROOT']. '/sistema_seleccion/user_postu/archivos/' . $dni . '/Idiomas_Computacion/';
      if (!file_exists($micarpeta)) {
        mkdir($micarpeta, 0777, true);
      }

      $nombre_archivo = $_FILES['archivo']['name'];
      $tipo_archivo = $_FILES['archivo']['type'];
      $tamano_archivo = $_FILES['archivo']['size'];

      $query = mysqli_query($con, "SELECT * FROM idiomas_comp  WHERE ididiomas_comp = $idpostulante");
      $result = mysqli_num_rows($query);
      if ($result <= 0) {
        $i = 1;
        $new_nombre = "estudios_" . $i . ".pdf";
      } else {
        $row = mysqli_fetch_array($query);
        $idformacion = $row['ididiomas_comp'];
        $i = $idformacion;
        $new_nombre = "estudios_" . $i . ".pdf";
      }

      if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 3000000))) {
        echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Solo se permiten archivos .pdf<br><li>se permiten archivos de 3 Mb máximo.</td></tr></table>";
      } else {
        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $micarpeta . $new_nombre)) {
          
          $idioma = $_POST['idioma'];
          $nivel = $_POST['nivel'];

            $sql = "INSERT INTO idiomas_comp (idioma_comp,nivel,idpostulante_postulante,archivo) 
            VALUES('$idioma','$nivel','$idpostulante','$new_nombre')";  

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
      $micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/Idiomas_Computacion/';
      if (!file_exists($micarpeta)) {
        mkdir($micarpeta, 0777, true);
      }
      //Datos del arhivo
      $nombre_archivo = $_FILES['archivo']['name'];
      $tipo_archivo = $_FILES['archivo']['type'];
      $tamano_archivo = $_FILES['archivo']['size'];
      //Generar nombre de archivo
      $query = mysqli_query($con, "SELECT * FROM idiomas_comp  WHERE ididiomas_comp = $idpostulante");
      $result = mysqli_num_rows($query);

      if ($result <= 0) {
        $i = 1;
        $new_nombre = "estudios_" . $i . ".pdf";
      } else {
        $row = mysqli_fetch_array($query);
        $idformacion = $row['ididiomas_comp'];
        $i = $idformacion;
        $new_nombre = "estudios_" . $i . ".pdf";
      }
      //compruebo si las características del archivo son las que deseo
      if (!(strpos($tipo_archivo, "pdf") && ($tamano_archivo <= 2000000))) {
        echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Solo se permiten archivos .pdf<br><li>se permiten archivos de 3 Mb máximo.</td></tr></table>";
      } else {
        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $micarpeta . $new_nombre)) {
          
          $idioma = $_POST['idioma'];
          $nivel = $_POST['nivel'];

          $sql = "INSERT INTO idiomas_comp (idioma_comp,nivel,idpostulante_postulante,archivo) 
          VALUES('$idioma','$nivel','$idpostulante','$new_nombre')";  

          $result = mysqli_query($con, $sql);
          if ($result) {
            echo '<script> alert("Guardado exitosamente"); </script>';
            header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
          } else {
            echo '<script> alert("Error al guardar PRIMERA!"); </script>';
            header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
          }
        }
         else 
        {
          echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
          header('Location: ../capacitacion.php?dni=' . $dato_desencriptado);
        }
      }
    }
?>