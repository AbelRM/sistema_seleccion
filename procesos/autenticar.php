<?php
	include '../conexion.php';

	$dni=$_POST['dni'];
	$password=$_POST['clave'];


	$sql="SELECT * FROM admin WHERE dni='".$dni."' AND clave='".$password."' ";
	$result=$con->query($sql);

	$sql1=mysqli_query($con,"select * from tipo_user");
	$rw=mysqli_fetch_array($sql1);

	$tipo=$rw['tipo_user'];

	if ($result->num_rows > 0 AND $tipo=='ADMINISTRADOR') {
		while ( $row=$result->fetch_assoc()) {
			# code...
			session_start();
			$_SESSION['iduser']=$row["iduser"];
			header("Location: ../user_admi/index.php");
		}
	} else {

		if ($result->num_rows > 0 AND $tipo=='POSTULANTE') {
			# code...
			while ( $row=$result->fetch_assoc()) {
			# code...
			session_start();
			$_SESSION['iduser']=$row["iduser"];
			header("Location: ../user_postu/index.php");
		}

		}

		else {
		header("Location: ../index.php?estado=errlogin"); #aumentar: ?estado=errlogin		
		}

	}
	$con->close();

?>