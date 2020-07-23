<?php

    include 'conexion.php';
    // DATOS PERSONALES
    $fech_nac = $_POST['fech_nac'];
    $civil = $_POST['civil'];
    $sexo = $_POST['sexo'];
    $num_emer= $_POST['num_emer'];
    $nomb_parent = $_POST['nomb_parent'];
    $ruc = $_POST['ruc'];
    $cuarta= $_POST['cuarta'];
    $pension= $_POST['pension'];
    $cuenta_banc = $_POST['cuenta_banc'];
    $discapacidad = $_POST['discapacidad'];
    $tip_discapacidad = $_POST['tip_discapacidad'];
    $tip_sangre = $_POST['tip_sangre'];
    $alergias = $_POST['alergias'];
    //DATOS DOMICILIO
    $tipo_via = $_POST['tipo_via'];
    $nomb_via = $_POST['nomb_via'];
    $num_via = $_POST['num_via'];
    $tipo_zona = $_POST['tipo_zona'];
    $nomb_zona = $_POST['nomb_zona'];
    $num_zona = $_POST['num_zona'];
    $civil = $_POST['civil'];
    $sexo = $_POST['sexo'];
    $civil = $_POST['civil'];
    $sexo = $_POST['sexo'];

    $sql = "UPDATE postulante 
    SET fech_nac = '".$fech_nac."',civil='".$civil."',sexo = ".$sexo."',num_emer ='".$num_emer."',nomb_parent='".$nomb_parent."',ruc ='".$ruc."',cuenta_banc = '".$cuenta_banc."', discapacidad = '".$discapacidad."', tip_discapacidad = '".$tip_discapacidad."',
    tip_discapacidad = '".$tip_discapacidad."',tip_sangre = '".$tip_sangre."', alergias = '".$alergias."',cuarta = '".$cuarta."',pension = '".$pension."' ";
    
    if ($conn->query($sql) === TRUE) {
        
        echo "Se guardo correctamente";
    
        header('Location: proyectos.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    // $conn->close();

?>