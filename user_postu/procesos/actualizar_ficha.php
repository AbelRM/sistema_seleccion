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

      //DATOS ENCUESTA
      $pre1 = $_POST['pregunta1'];
      $pre2 = $_POST['pregunta2'];
      $pre3 = $_POST['pregunta3'];
      $pre4 = $_POST['pregunta4'];
      $pre5 = $_POST['pregunta5'];
      $pre6 = $_POST['pregunta6'];
      $pre7 = $_POST['pregunta7'];
      $pre8 = $_POST['pregunta8'];
      $pre9 = $_POST['pregunta9'];
      $pre10 = $_POST['pregunta10'];
      $pre11 = $_POST['pregunta11'];
      $pre12 = $_POST['pregunta12'];
      $pre13 = $_POST['pregunta13'];
      $pre14 = $_POST['pregunta14'];
    
    $sql = "UPDATE postulante SET pais='".$pais."',sexo='".$sexo."',celular = '".$celular."', correo ='".$correo."',estado_civil='".$estadocivil."',celular_emer='".$celular_emer."',parentesco_emer ='".$parentesco_emer."',ruc = '".$ruc."',
     num_cuenta = '".$num_cuenta."', suspension_cuarta = '".$cuarta."',discapacidad = '".$discapacidad."', tipo_discap = '".$tip_discapacidad."',tipo_sangre = '".$tip_sangre."',alergias = '".$alergias."' WHERE dni='".$dni_post."' ";
    $datos=mysqli_query($con,$sql);



    if ($datos == 1) {


        $sql2 = "UPDATE encuesta SET pregunta1='".$pre1."', pregunta2='".$pre2."', pregunta3='".$pre3."',pregunta3='".$pre4."',
        pregunta5='".$pre5."',pregunta6='".$pre6."', pregunta7 = '".$pre7."',pregunta8 ='".$pre8."', pregunta9 ='".$pre9."', 
        pregunta10 ='".$pre10."', pregunta11 ='".$pre11."',pregunta12 ='".$pre12."',pregunta13 ='".$pre13."' ,pregunta14 ='".$pre14."'  WHERE postulanteID='".$idpostulante."'";
        $datos2=mysqli_query($con,$sql2);    

        if ($datos2 == 1) {

                $sql3 = "UPDATE encuesta SET tip_via='".$tipo_via."', nomb_via='".$nomb_via."', num_via='".$num_via."',tip_zona='".$tipo_zona."',
                nomb_zona='".$nomb_zona."',num_zona='".$num_zona."', referencia = '".$referencia."',numero ='".$numero."', manzana ='".$manzana."', 
                lote ='".$lote."'  WHERE postulante_idpostulante='".$idpostulante."'";
                $datos3=mysqli_query($con,$sql3);  
                $dato_encriptado = $encriptar($dni_post);
                header('Location: ../ver_ficha.php?dni='.$dato_encriptado);

        }
        else
        {
             echo "ERROR AL ACTUALIZAR";
        $dato_encriptado = $encriptar($dni_post);
        header('Location: ../index.php?dni='.$dato_encriptado); 
        }
        $con->close();
    } 
     else 
    {
        echo "ERROR AL ACTUALIZAR";
        $dato_encriptado = $encriptar($dni_post);
        header('Location: ../index.php?dni='.$dato_encriptado); 
    }
    $con->close();

?>