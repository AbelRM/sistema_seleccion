<?php 
    include '../conexion.php';
    $dni=$_POST['dni'];
    $idpostulante=$_POST['idpostulante'];

    $secundaria_comple=$_POST['secundaria_comple'];

    $resultado=$con->query("SELECT * FROM datos_profesionales WHERE postulante_idpostulante=$idpostulante");
    
    if (mysqli_num_rows($resultado)>0) {
        $sql2="UPDATE datos_profesionales SET secundaria_comple = '$secundaria_comple' WHERE postulante_idpostulante = $idpostulante ";
        $datos2=mysqli_query($con,$sql2) or die(mysqli_error());
        if ($datos2 == 1) {
            header('Location: ../formacion.php?dni='.$dni);
        }else{
            echo "ERROR";
        }
       
    }else{
        $sql="INSERT INTO datos_profesionales (secundaria_comple,postulante_idpostulante) 
        VALUES ('".$secundaria_comple."','".$idpostulante."')";
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