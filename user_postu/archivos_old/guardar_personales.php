<?php
    include '../conexion.php';
    
    $dni_post=$_POST['dni_post'];
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
    $distrito = $_POST['distrito_id'];
    //$direccion=$_POST['direccion'];

    $sql = "UPDATE postulante SET fech_nac = '".$fech_nac."',estado_civil='".$civil."',sexo = '".$sexo."', celular_emer ='".$num_emer."',parentesco_emer='".$nomb_parent."',ruc ='".$ruc."',num_cuenta = '".$cuenta_banc."',
    discapacidad = '".$discapacidad."', tipo_discap = '".$tip_discapacidad."',tipo_sangre = '".$tip_sangre."', alergias = '".$alergias."',suspension_cuarta = '".$cuarta."',seguro = '".$pension."',distrito_iddistrito = '".$distrito."' WHERE dni='".$dni_post."' ";
    mysqli_query ($con, $sql);   

    $prueba="SELECT * FROM postulante where dni=$dni_post";
    $datos=mysqli_query($con,$prueba) or die(mysqli_error()); 
    $fila= mysqli_fetch_array($datos);
    $idpostulante=$fila['idpostulante'];

    if ($con->query($sql) === TRUE) {
        echo $idpostulante;
        header('Location: ../form_wizard/index.php?postulante_idpostulante='.$idpostulante.'&dni='.$dni_post);

        // header('Location: ../datos_domicilio.php?postulante_idpostulante='.$idpostulante.'&dni='.$dni_post);

    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }


   ?>