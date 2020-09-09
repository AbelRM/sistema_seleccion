<?php 

    include "../conexion.php";
    $dni=$_POST['dni'];

    $tipo_con = $_POST['tipo_con'];
    $num_con = $_POST['num_con'];
    $anio_con= $_POST['anio_con'];
    $ubicacion = $_POST['chosen-unique'];
    $fech_ini = $_POST['fech_ini'];
    $fech_fin = $_POST['fech_fin'];
    $curricular = $_POST['curricular'];
    $entrevista = $_POST['entrevista'];
    $escrito = $_POST['escrito'];
    $por_discapacidad = $_POST['por_discapacidad'];
    $militar = $_POST['militar'];
    $estado = $_POST['estado'];

    $sql= "INSERT INTO convocatoria (num_con,anio_con,tipo_con,fech_ini,fech_term,porcen_eva_cu,porce_entrevista,porce_discapacidad,
    porce_sermilitar,porce_exa_escrito, estado,direccion_ejec_iddireccion) 
    VALUES ('".$num_con."','".$anio_con."','".$tipo_con."','".$fech_ini."','".$fech_fin."','".$curricular."','".$entrevista."',
    '".$por_discapacidad."','".$militar."','".$escrito."','".$estado."','".$ubicacion."')";

    if ($con->query($sql) == TRUE) {
        $idcon=mysqli_insert_id($con);
        // echo $idcon;
        header('Location: ../agregar_personal_req_v2.php?convocatoria_idcon='.$idcon.'&dni='.$dni);
    } else {
        echo "Error: ".$sql. "<br>".$con->error;
    }

    $con->close();

?>