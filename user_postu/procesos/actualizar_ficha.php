<?php

    include '../conexion.php';
    include '../funcs/mcript.php';
   
    $dni_post=$_POST['dni_post'];
    $idpostulante=$_POST['idpostulante'];
    // DATOS PERSONALES
    $pais = $_POST['pais'];
    $sexo = $_POST['sexo'];
    $celular= $_POST['celular'];
    $correo = $_POST['correo'];
    $estadocivil = $_POST['estado_civil'];
    $celular_emer= $_POST['celular_emer'];
    $parentesco_emer= $_POST['parentesco_emer'];
    $ruc = $_POST['ruc'];
    $num_cuenta = $_POST['num_cuenta'];  
    $cuarta = $_POST['cuarta'];
    $pension = $_POST['pension'];
    $discapacidad = $_POST['discapacidad'];
    $tip_discapacidad = $_POST['tip_discapacidad']; 
    $tip_sangre = $_POST['tip_sangre']; 
    $alergias = $_POST['alergias'];  
    //$direccion=$_POST['direccion'];
    //DATOS DOMICILIO
    $tipo_via = $_POST['tipo_via'];
    $nomb_via = $_POST['nomb_via'];
    $num_via = $_POST['num_via'];
    $tipo_zona = $_POST['tipo_zona'];
    $nomb_zona = $_POST['nomb_zona'];
    $num_zona = $_POST['num_zona'];
    $numero = $_POST['numero'];
    $manzana = $_POST['manzana'];
    $lote = $_POST['lote'];
    $referencia = $_POST['referencia'];
   // $distrito = $_POST['distrito'];
    
    $sql = "UPDATE postulante SET pais='".$pais."',sexo='".$sexo."',celular = '".$celular."', correo ='".$correo."',estado_civil='".$estadocivil."',celular_emer='".$celular_emer."',parentesco_emer ='".$parentesco_emer."',ruc = '".$ruc."',
     num_cuenta = '".$num_cuenta."', suspension_cuarta = '".$cuarta."',discapacidad = '".$discapacidad."', tipo_discap = '".$tip_discapacidad."',tipo_sangre = '".$tip_sangre."',alergias = '".$alergias."' WHERE dni='".$dni_post."' ";
    $datos=mysqli_query($con,$sql);



    if ($datos == 1) {
        // $prueba="SELECT * FROM postulante where dni=$dni_post";
        // $datos=mysqli_query($con,$prueba) or die(mysqli_error()); 
        // $fila= mysqli_fetch_array($datos);
        // $idpostulante=$fila['idpostulante'];

        $sql2 = "UPDATE domicilio_post SET tip_via='".$tipo_via."', nomb_via='".$nomb_via."', num_via='".$num_via."',tip_zona='".$tipo_zona."',
        nomb_zona='".$nomb_zona."',num_zona='".$num_zona."', referencia = '".$referencia."',numero ='".$numero."', manzana ='".$manzana."', 
        lote ='".$lote."'  WHERE postulante_idpostulante='".$idpostulante."'";
        $datos2=mysqli_query($con,$sql2);    

        $dato_encriptado = $encriptar($dni_post);
        header('Location: ../ver_ficha.php?dni='.$dato_encriptado);
    } 
    else {
        echo "ERROR AL ACTUALIZAR";
        $dato_encriptado = $encriptar($dni_post);
        header('Location: ../index.php?dni='.$dato_encriptado); 
    }
    $con->close();

?>