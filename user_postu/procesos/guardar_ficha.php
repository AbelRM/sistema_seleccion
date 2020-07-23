<?php

    include 'conexion.php';
    
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


    $sql = "UPDATE postulante 
    SET fech_nac = '".$fech_nac."',civil='".$civil."',sexo = ".$sexo."',num_emer ='".$num_emer."',nomb_parent='".$nomb_parent."',ruc ='".$ruc."',cuenta_banc = '".$cuenta_banc."', discapacidad = '".$discapacidad."', tip_discapacidad = '".$tip_discapacidad."',
    tip_discapacidad = '".$tip_discapacidad."',tip_sangre = '".$tip_sangre."', alergias = '".$alergias."',cuarta = '".$cuarta."',pension = '".$pension."' ";
    
    if ($conn->query($sql) === TRUE) {
       // echo "Datos Modificados";
        echo "Se guardo correctamente";
    
        header('Location: proyectos.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    // $conn->close();

?>