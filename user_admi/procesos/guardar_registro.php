<?php
    require '../conexion.php';
	
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $ruc = $_POST['ruc'];
    $fech_nac = $_POST['fech_nac'];
    $correo = $_POST['correo'];
    $departamento = $_POST['provincia'];
    $provincia = $_POST['provincia'];
    $distrito = $_POST['distrito'];
    $telefono = $_POST['telefono'];
    $celular = $_POST['celular'];
	$estado_civil = $_POST['estado_civil'];
	$hijos = isset($_POST['hijo']) ? $_POST['hijos'] : 0;
	$intereses = isset($_POST['intereses']) ? $_POST['intereses'] : null;
	
	$arrayIntereses = null;
	
	$num_array = count($intereses);
	$contador = 0;
	
	if($num_array>0){
		foreach ($intereses as $key => $value) {
			if ($contador != $num_array-1)
			$arrayIntereses .= $value.' ';
			else
			$arrayIntereses .= $value;
			$contador++;
		}
	}
	
	$sql = "INSERT INTO personas (nombre, correo, telefono, estado_civil, hijos, intereses) VALUES ('$nombre', '$email', '$telefono', '$estado_civil', '$hijos', '$arrayIntereses')";
	$resultado = $mysqli->query($sql);
?>