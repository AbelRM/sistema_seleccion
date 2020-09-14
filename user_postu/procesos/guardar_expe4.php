<?php
  // Insert the content of connection.php file
  include('../conexion.php');
  
  // Insert data into the database
  if(ISSET($_POST['insertData']))
  {
    $dato_desencriptado = $_POST['dni_encriptado'];
    $dni = $_POST['dni'];
    $idpostulante = $_POST['postulante'];

    // Recibo los datos de la imagen
    $nombre_archivo = $_FILES['archivo']['name'];
    $tipo_archivo = $_FILES['archivo']['type'];
    $tamano_archivo = $_FILES['archivo']['size'];
    $ruta = $_FILES['archivo']['tmp_name'];
    
    
    $lugar_4exp = $_POST['lugar_4exp'];
    $cargo_funciones_4exp = $_POST['cargo_funciones_4exp'];
    $fecha_ini_4exp = $_POST['fecha_ini_4exp'];
    $fecha_fin_4exp = $_POST['fecha_fin_4exp'];

    /// VALORES AÑOS, MESES Y DIAS ///
    $fechainicial = new DateTime($fecha_ini_4exp);
    $fechaactual = new DateTime($fecha_fin_4exp);

    $diferencia = $fechainicial->diff($fechaactual); 

    $años=$diferencia->format('%Y');
    $meses=$diferencia->format('%m');
    $dias=$diferencia->format('%d');

    $sql = "INSERT INTO expe_4puntos (lugar,cargo,fecha_inicio,fecha_fin,anios,meses, 
    dias, archivos,expe_4puntos_idpostulante) 
    VALUES('$lugar_4exp','$cargo_funciones_4exp','$fecha_ini_4exp', '$fecha_fin_4exp','$años','$meses',
    '$dias','$nombre_archivo','$idpostulante')";  
    $result = mysqli_query($con, $sql);

    // $consulta = mysqli_query("SELECT @@identity AS id_4puntos");
    // if($row = mysqli_fetch_row($consulta)){
    //   $ultimo_id = trim($row[0]);
    // }

    if($result){
      $destino =$_SERVER['DOCUMENT_ROOT']. "/sistema_seleccion/user_postu/archivos/" . $dni . "/";
      // $path = "sample/path/newfolder";
      if (!file_exists($destino)) {
        $destino = mkdir($destino, 0777, true);
      }
      if (!strpos($tipo_archivo, "pdf")) {
        echo "Solo se permite archivos PDF";
      }
      if (! ($tamano_archivo <= 3000000)){
        echo "El archivo excede el tamaño máximo de 3MB";
      }
      $new_nombre = "expe_4_$nombre_archivo";
      if (move_uploaded_file($ruta, $destino.$nombre_archivo)){
        echo '<script> alert("Guardado exitosamente"); </script>';
        header('Location: ../exp_laboral.php?dni='.$dato_desencriptado);

      } else {
        echo "Error al subir el archivo";
      }
    }else{
      echo '<script> alert("Error al guardar PRIMERA!"); </script>';
      // header('Location: ../formacion.php?dni='.$dni);
    }

    
  }
?>