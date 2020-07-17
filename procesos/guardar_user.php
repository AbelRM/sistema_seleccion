<?php
    require '../conexion.php';
	
    $nombres = $_POST['nombres'];
    $ape_pat = $_POST['ape_pat'];
    $ape_mat = $_POST['ape_mat'];
    $dni = $_POST['dni'];
    $correo = $_POST['correo'];
    $celular = $_POST['celular'];
	$clave = $_POST['clave'];
	$confi_clave = $_POST['confi_clave'];

	$sql= "INSERT INTO user (dni,nombres,ape_pat,ape_mat,celular,correo,clave,confi_clave,tipo_user_idtipo) 
    VALUES ('".$dni."','".$nombres."','".$ape_pat."','".$ape_mat."','".$celular."','".$correo."','".$clave."','".$confi_clave."','1')";

    if ($con->query($sql) == TRUE) {
        $idcon=mysqli_insert_id($con);
        // echo $idcon;
        header('Location: ../index.php');
    } else {
        echo "Error: ".$sql. "<br>".$con->error;
    }

    $con->close();
	
?>