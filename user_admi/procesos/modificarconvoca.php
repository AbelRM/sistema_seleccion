<?php 

include '../conexion.php';

$id_con=$_POST['id'];

$numerocon=strtoupper($_POST['num_con']);
$tipocon=strtoupper($_POST['tipo_con']);
$añocon=strtoupper($_POST['año_con']);
$fechini=$_POST['fech_ini'];
$fechterm=$_POST['fech_term'];
$porcenevacu=$_POST['porcen_eva_cu'];
$porceentrevista=$_POST['porcen_entrevista'];
$porcediscapacidad=$_POST['porce_discapacidad'];
$porcemilitar=$_POST['porce_sermilitar'];
$porceexaescrito=$_POST['porce_exa_escrito'];
$direcejec=$_POST['direccion_ejec_iddireccion'];

$sql= "UPDATE convocatoria SET  num_con='$numerocon',
                                tipo_con='$tipocon',
                                año_con='$añocon',
                                fech_ini='$fechini',  
                                fech_term='$fechterm', 
                                porcen_eva_cu='$porcenevacu',
                                porcen_entrevista='$porceentrevista',
                                porce_discapacidad='$porcediscapacidad',
                                porce_sermilitar='$porcemilitar',
                                porce_exa_escrito='$porceexaescrito',
                                direccion_ejec_iddireccion='$direcejec' WHERE idcon='$id_con'";   

$result=mysqli_query($con,$sql);



header('Location: ../listado_convocatorias.php');
mysqli_close($con);  
?>
