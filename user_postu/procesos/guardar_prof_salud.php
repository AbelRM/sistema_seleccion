<?php 

    include '../conexion.php';
    $dni=$_POST['dni'];
    //$idpostulante= $_POST['idpostulante'];
    $idpostulante=$_POST['idpostulante'];
    $profesion = strtoupper($_POST['profesion']);
    $lugar_colegiatura = strtoupper($_POST['lugar_colegiatura']);
    $fecha_cole= $_POST['fecha_cole'];
    $fech_habi = $_POST['fech_habi'];
    $nro_colegiatura = $_POST['nro_colegiatura'];

    $titulo_profesional=$_POST['titulo_profesional'];
    $titulo_especialidad=$_POST['titulo_especialidad'];
    $egresado_especialidad=$_POST['egresado_especialidad'];
    $grado_maestria=$_POST['grado_maestria'];
    $constancia_egre_maestria=$_POST['constancia_egre_maestria'];
    $grado_doctorado=$_POST['grado_doctorado'];
    $constancia_egre_doctorado=$_POST['constancia_egre_doctorado'];

    $resultado=$con->query("SELECT EXISTS (SELECT * FROM datos_profesionales WHERE postulante_idpostulante=$idpostulante);");
    $row=mysqli_fetch_row($resultado);
    if ($row[0]=="1") {
        $sql="INSERT INTO datos_profesionales (profesion,fecha_cole,lugar_cole,fecha_habi,nro_cole,titulo_profesional,titulo_especialidad, 
        egresado_especialidad, grado_maestria, constancia_egre_maestria,grado_doctorado,constancia_egre_doctorado,postulante_idpostulante) 
        VALUES ('".$profesion."','".$fecha_cole."','".$lugar_colegiatura."','".$fech_habi."','".$nro_colegiatura."','".$titulo_profesional."','".$titulo_especialidad."',
        '".$egresado_especialidad."','".$grado_maestria."','".$constancia_egre_maestria."','".$grado_doctorado."','".$constancia_egre_doctorado."','".$idpostulante."')";
        $datos=mysqli_query($con,$sql) or die(mysqli_error());

        if ($datos == 1) {
            header('Location: ../formacion.php?dni='.$dni);
        }else{
            echo '<script>
            alert("ERROR AL GUARDAR");
            window.location.href;
            </script>';
        }
    }else{
        $sql2="UPDATE datos_profesionales SET profesión = '$profesion',fecha_cole = '$fecha_cole',lugar_cole = '$lugar_colegiatura',fecha_habi = '$fecha_habi',
        nro_cole = '$nro_colegiatura',titulo_profesional = '$titulo_profesional',titulo_especialidad = '$titulo_especialidad',egresado_especialidad = '$egresado_especialidad',
        grado_maestria = '$grado_maestria',constancia_egre_maestria = '$constancia_egre_maestria',grado_doctorado = '$grado_doctorado',constancia_egre_doctorado = '$constancia_egre_doctorado'
        WHERE postulante_idpostulante = $idpostulante";
        $datos2=mysqli_query($con,$sql2) or die(mysqli_error());
        if ($datos2 == 1) {
            header('Location: ../formacion.php?dni='.$dni);
        }else{
            echo "ERROR";
        }
    }
    mysqli_close($con);
?>