<?php
    include '../conexion.php';
    $idpostulante=$_POST['id_postulante'];
    $dni_post=$_POST['dni_post'];

    $tipo_via = $_POST['tipo_via'];
    $nomb_via = $_POST['nomb_via'];
    $num_via = $_POST['num_via'];
    $tipo_zona = $_POST['tipo_zona'];
    $nomb_zona = $_POST['nomb_zona'];
    $num_zona = $_POST['num_zona'];
    $referencia = $_POST['referencia'];
    $distrito = $_POST['distrito_id'];
    $manzana=$_POST['manzana'];
    $lote=$_POST['lote'];


    $sql = "INSERT INTO domicilio_post (tip_via, nomb_via, num_via,tip_zona, nomb_zona, num_zona, referencia, manzana, lote, postulante_idpostulante, distrito_idistrito) 
    VALUES ('".$tipo_via."', '".$nomb_via."', '".$num_via."', '".$tipo_zona."', '".$nomb_zona."', '".$num_zona."','".$referencia."','".$manzana."','".$lote."','".$idpostulante."','".$distrito."')";
    mysqli_query ($con, $sql);   

    if ($con->query($sql) === TRUE) {
        
        header('Location: ../datos_familia.php?postulante_idpostulante='.$idpostulante.'&dni='.$dni_post);

    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

?>