<?php 
    include '../conexion.php';
    $dni=$_POST['dni'];
    $idpostulante=$_POST['idpostulante'];

    $titulo_tecnico=$_POST['titulo_tecnico'];

    $resultado=$con->query("SELECT * FROM datos_profesionales WHERE postulante_idpostulante=$idpostulante");
    
    if (mysqli_num_rows($resultado)>0) {
        $sql2="UPDATE datos_profesionales SET titulo_instituto = '$titulo_instituto' WHERE postulante_idpostulante = $idpostulante ";
        $datos2=mysqli_query($con,$sql2) or die(mysqli_error());
        if ($datos2 == 1) {
            header('Location: ../formacion.php?dni='.$dni);
        }else{
            echo "ERROR";
        }
       
    }else{
        $sql="INSERT INTO datos_profesionales (titulo_instituto,postulante_idpostulante) 
        VALUES ('".$titulo_instituto."','".$idpostulante."')";
        $datos=mysqli_query($con,$sql) or die(mysqli_error());

        if ($datos == 1) {
            header('Location: ../formacion.php?dni='.$dni);
        }else{
            echo '<script>
            alert("ERROR AL GUARDAR");
            window.location = "guardar_prof_salud.php?dni=".$dni;
            </script>';
        }
    }
    mysqli_close($con);
?>