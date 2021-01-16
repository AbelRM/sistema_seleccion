<?php
	include '../conexion.php';

	$dni=$_POST['dni'];
	$password=$_POST['clave'];


	$sql="SELECT * FROM user WHERE dni='".$dni."' AND clave='".$password."' ";
	$result=$con->query($sql);

	$sql1=mysqli_query($con,"select * from tipo_user");
	$rw=mysqli_fetch_array($sql1);

	$tipo=$rw['tipo_user'];

	if ($result->num_rows > 0 AND $tipo=='ADMINISTRADOR') {
		while ( $row=$result->fetch_assoc()) {
			# code...
			session_start();
			$_SESSION['dni']=$row["dni"];
			header("Location: ../user_admi/index.php?dni=$dni");
		}
	} else {

		if ($result->num_rows > 0 AND $tipo=='POSTULANTE') {
			# code...
			while ( $row=$result->fetch_assoc()) {
			# code...
			session_start();
			$_SESSION['dni']=$row["dni"];
			header("Location: ../user_postu/index.php?dni=$dni");
		}

		}

		else {
		header("Location: ../index.php?estado=errlogin"); #aumentar: ?estado=errlogin		
		}

	}
	$con->close();

?>