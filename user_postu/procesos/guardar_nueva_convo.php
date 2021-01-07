<?php 

    include '../conexion.php';
    $tipo_con = $_POST['tipo_con'];
    $num_con = $_POST['num_con'];
    $anio_con= $_POST['anio_con'];
    $ubicacion = $_POST['ubicacion'];
    $fech_ini = $_POST['fech_ini'];
    $fech_fin = $_POST['fech_fin'];
    $curricular = $_POST['curricular'];
    $entrevista = $_POST['entrevista'];
    $escrito = $_POST['escrito'];
    $por_discapacidad = $_POST['por_discapacidad'];
    $militar = $_POST['militar'];

    $sql= "INSERT INTO convocatoria (num_con,año_con,tipo_con,fech_ini,fech_term,porcen_eva_cu,porce_entrevista,porce_discapacidad,porce_sermilitar,porce_exa_escrito,direccion_ejec_iddireccion) 
    VALUES ('".$num_con."','".$anio_con."','".$tipo_con."','".$fech_ini."','".$fech_fin."','".$curricular."','".$entrevista."','".$por_discapacidad."','".$militar."','".$escrito."','".$ubicacion."')";

    if ($con->query($sql) == TRUE) {
        $idcon=mysqli_insert_id($con);
        // echo $idcon;
        header('Location: ../agregar_personal_req_v2.php?convocatoria_idcon='.$idcon);
    } else {
        echo "Error: ".$sql. "<br>".$con->error;
    }

    $con->close();

?>