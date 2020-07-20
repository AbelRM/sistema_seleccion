<?php 

include './conexion.php';

$id_con=$_POST['id'];

$numerocon=strtoupper($_POST['num_con']);
$tipocon=strtoupper($_POST['tipo_con']);
$fechini=$_POST['fech_ini'];
$fechterm=$_POST['fech_term'];
$porcenevacu=$_POST['porcen_eva_cu'];
$porceentrevista=$_POST['porcen_entrevista'];
$porcediscapacidad=$_POST['porce_discapacidad'];
$porcemilitar=$_POST['porce_sermilitar'];
$porceexaescrito=$_POST['porce_exa_escrito'];





$domic=strtoupper($_POST['domic']);
$cel=$_POST['cel'];
$correo=strtolower($_POST['correo']);

$sql= "UPDATE cas_registro SET nombres='$nombres',
                ape_pat='$ape_pat',
                ape_mat='$ape_mat',
                dni='$dni', 
                domic='$domic',
                cel='$cel',
                correo='$correo' WHERE id_cas='$id_cas'";   

$result=pg_query($con,$sql);

header('Location: ../cas.php');

// if ($result === TRUE) {
// 	header('Location: ../cas.php');
// } else {
// 	echo "Error: ".$sql. "<br>".$con->error;
// }

pg_close($con);  
?>