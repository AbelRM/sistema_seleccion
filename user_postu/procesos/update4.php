<?php
    // Insert the content of connection.php file
    include('../conexion.php');
 
    // Update data into the database
    if(ISSET($_POST['updateData']))
    {   
        $dni = $_POST['dni'];
        $id = $_POST['updateId'];
        $lugar = $_POST['lugar_trabajo'];
        $cargo = $_POST['cargo_trabajo'];
        $fecha_inicio = $_POST['fecha_inicio_tra'];
        $fecha_fin = $_POST['fecha_fin_tra'];

         /// VALORES AÑOS, MESES Y DIAS ///
         $fechainicial = new DateTime($fecha_inicio);
         $fechaactual = new DateTime($fecha_fin);

         $diferencia = $fechainicial->diff($fechaactual); 

         $años=$diferencia->format('%Y');
         $meses=$diferencia->format('%m');
         $dias=$diferencia->format('%d');
 
        $sql = "UPDATE expe_4puntos SET lugar='$lugar',
                                        cargo='$cargo', 
                                        fecha_inicio='$fecha_inicio',
                                        fecha_fin='$fecha_fin',
                                        anios='$años',
                                        meses='$meses',
                                        dias='$dias'
                                        WHERE id_4puntos='$id'";
 
        $result = mysqli_query($con, $sql);
 
        if($result)
        {
            echo '<script> alert("Datos actualizados correctamente."); </script>';
            header('Location: ../exp_laboral.php?dni='.$dni);
        }
        else
        {
            echo '<script> alert("ERROR, no se pudo actualizar!"); </script>';
        }
    }
?>