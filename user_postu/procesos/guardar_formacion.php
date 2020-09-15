<?php
// Insert the content of connection.php file
include('../conexion.php');

// Insert data into the database
if (isset($_POST['insertData'])) {
  $colegiatura_validar = $_POST['colegiatura'];
  if ($colegiatura_validar == 'NO') {
    $dato_desencriptado = $_POST['dni_encriptado'];
    $dni = $_POST['dni'];
    $idpostulante = $_POST['postulante'];
    echo $dni;

    // Recibo los datos de la imagen
    // $nombre_archivo = $_FILES['archivo']['name'];
    // $tipo_archivo = $_FILES['archivo']['type'];
    // $tamano_archivo = $_FILES['archivo']['size'];
    // $ruta = $_FILES['archivo']['tmp_name'];
    // $destino_base = $_SERVER['DOCUMENT_ROOT'] . "/sistema_seleccion/user_postu/archivos/" . $dni;
    // $destino = mkdir($destino_base, 0777, true);
    // $path = "sample/path/newfolder";

    //datos del arhivo
    $nombre_archivo = $_FILES['archivo']['name'];
    $tipo_archivo = $_FILES['archivo']['type'];
    $tamano_archivo = $_FILES['archivo']['size'];

    //compruebo si las características del archivo son las que deseo
    if (!((strpos($tipo_archivo, "pdf") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 3000000))) {
      echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .pdf<br><li>se permiten archivos de 3 Mb máximo.</td></tr></table>";
    } else {
      if (move_uploaded_file($_FILES['archivo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/sistema_seleccion/user_postu/archivos/" . $nombre_archivo)) {
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
        if ($result) {
          echo '<script> alert("Guardado exitosamente"); </script>';
          header('Location: ../formacion.php?dni=' . $dato_desencriptado);
        } else {
          echo '<script> alert("Error al guardar PRIMERA!"); </script>';
          // header('Location: ../formacion.php?dni='.$dni);
        }
      } else {
        echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
      }
    }
  }
}

      // if (!file_exists($destino_base)) {
      //   $destino_base = mkdir($destino_base, 0777, true);
      //   move_uploaded_file($ruta, $destino_base.$nombre_archivo);
      // }
      // if (!strpos($tipo_archivo, "pdf")) {
      //   echo "Solo se permite archivos PDF";
      // }
      // if (! ($tamano_archivo <= 3000000)){
      //   echo "El archivo excede el tamaño máximo de 3MB";
      // }
      // if (move_uploaded_file($ruta, $destino_base.$nombre_archivo))
      
     
    //   } else {
    //     echo "Error";
    //   }
    // }else{
    //   $dni = $_POST['dni'];
    //   $idpostulante = $_POST['postulante'];
    //   $tipo_estudios = $_POST['tipo_estudios'];
    //   $nivel_estudios = $_POST['nivel_estudios'];
    //   $centro_estudios = $_POST['centro_estudios'];
    //   $carrera = $_POST['carrera'];
    //   $colegiatura = $_POST['colegiatura'];
    //   $nro_colegiatura = $_POST['nro_colegiatura'];
    //   $fecha_colegiatura = $_POST['fecha_colegiatura'];
    //   $lugar_colegiatura = $_POST['lugar_colegiatura'];
    //   $fecha_inicio = $_POST['fecha_inicio'];
    //   $fecha_fin = $_POST['fecha_fin'];

    //   $sql = "INSERT INTO formacion_acad (tipo_estudios_id,nivel_estudios,centro_estudios,carrera,colegiatura,nro_colegiatura,fech_habilitacion,
    //   lugar_colegiatura,fecha_inicio, fecha_fin, postulante_id) 
    //   VALUES('$tipo_estudios','$nivel_estudios','$centro_estudios', $carrera','$colegiatura','$nro_colegiatura','$fecha_colegiatura','$lugar_colegiatura',
    //   '$fecha_inicio','$fecha_fin','$idpostulante')";  
          
    //   $result = mysqli_query($con, $sql);
    //   if($result){
    //       echo '<script> alert("Guardado exitosamente"); </script>';
    //       header('Location: ../formacion.php?dni='.$dni);
    //   }else{
    //       echo '<script> alert("Error al guardar SEGUNDA!"); </script>';
    //   }
    // }
