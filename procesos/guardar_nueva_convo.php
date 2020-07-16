<?php 

    include '../conexion.php';
    $tipo_con = $_POST['tipo_con'];
    $convocatoria = $_POST['convocatoria'];
    $ubicacion = $_POST['ubicacion'];
    $fech_ini = $_POST['fech_ini'];
    $fech_fin = $_POST['fech_fin'];
    $curricular = $_POST['curricular'];
    $entrevista = $_POST['entrevista'];
    $escrito = $_POST['escrito'];
    $por_discapacidad = $_POST['por_discapacidad'];
    $militar = $_POST['militar'];

    $sql= "INSERT INTO convocatoria (num_con,tipo_con,fech_ini,fech_term,porcen_eva_cu,porce_entrevista,porce_discapacidad,porce_sermilitar,porce_exa_escrito,direc_ejectiva_iddireccion) 
    VALUES ('".$convocatoria."','".$tipo_con."','".$fech_ini."','".$fech_fin."','".$curricular."','".$entrevista."','".$por_discapacidad."','".$militar."','".$escrito."','".$ubicacion."')";

    if ($con->query($sql) == TRUE) {
        $idcon=mysqli_insert_id($con);
        // echo $idcon;
        header('Location: ../agregar_personal_req.php?convocatoria_idcon='.$idcon);
    } else {
        echo "Error: ".$sql. "<br>".$con->error;
    }

    $con->close();

?>