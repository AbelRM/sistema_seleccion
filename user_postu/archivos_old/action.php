<?php
include_once("conexion.php");
if ($_POST['action'] == 'edit' && $_POST['idestudios']) {	
	$updateField='';
	if(isset($_POST['centro_estudios'])) {
		$updateField.= "centro_estudios='".$_POST['centro_estudios']."'";
	} else if(isset($_POST['especialidad'])) {
		$updateField.= "especialidad='".$_POST['especialidad']."'";
	} else if(isset($_POST['fecha_inicio'])) {
		$updateField.= "fecha_inicio='".$_POST['fecha_inicio']."'";
    }else if(isset($_POST['fecha_fin'])) {
        $updateField.= "fecha_fin='".$_POST['fecha_fin']."'";
    }else if(isset($_POST['nivel'])) {
        $updateField.= "nivel='".$_POST['nivel']."'";
    }

	if($updateField && $_POST['idestudios']) {
		$sqlQuery = "UPDATE estudios_superiores SET $updateField WHERE idestudios='" . $_POST['idestudios'] . "'";	
		mysqli_query($con, $sqlQuery) or die("database error:". mysqli_error($con));	
		$data = array(
			"message"	=> "Datos actualizados!",	
			"status" => 1
		);
		echo json_encode($data);		
	}
}

if ($_POST['action'] == 'delete' && $_POST['id']) {
	$sqlQuery = "DELETE FROM estudios_superiores WHERE idestudios='" . $_POST['idestudios'] . "'";	
	mysqli_query($con, $sqlQuery) or die("database error:". mysqli_error($con));	
	$data = array(
		"message"	=> "Fila eliminada!",	
		"status" => 1
	);
	echo json_encode($data);	
}
?>