<?php 
include_once('../conexion.php');
$idpostulante=$_POST['id_postulante'];
$dni_post=$_POST['dni_post'];

//////////////////////// PRESIONAR EL BOTÓN //////////////////////////
if(isset($_POST['insertar']))
{
    $items1 = ($_POST['nombre']);
    $items2 = ($_POST['apellidos']);
    $items3 = ($_POST['fecha_nac']);
    $items4 = ($_POST['dni']);
    $items5 = ($_POST['parentesco']);
    $items6 = ($_POST['entidad']);

///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 5 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
    while(true) {

        //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
        $item1 = current($items1);
        $item2 = current($items2);
        $item3 = current($items3);
        $item4 = current($items4);
        $item5 = current($items5);
        $item6 = current($items6);
        
        ////// ASIGNARLOS A VARIABLES ///////////////////
        $nombre=(( $item1 !== false) ? $item1 : ", &nbsp;");
        $apellidos=(( $item2 !== false) ? $item2 : ", &nbsp;");
        $fecha_nac=(( $item3 !== false) ? $item3 : ", &nbsp;");
        $dni=(( $item4 !== false) ? $item4 : ", &nbsp;");
        $parentesco=(( $item5 !== false) ? $item5 : ", &nbsp;");
        $labora=(( $item6 !== false) ? $item6 : ", &nbsp;");

        //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
        $valores='("'.$nombre.'","'.$apellidos.'","'.$fecha_nac.'","'.$dni.'","'.$parentesco.'","'.$labora.'","'.$idpostulante.'"),';

        //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
        $valoresQ= substr($valores, 0, -1);
        
        ///////// QUERY DE INSERCIÓN ////////////////////////////
        // include_once('conexion.php');
        $sql = "INSERT INTO familia_post (nombre, apellidos, fech_nac, dni, parentesco, labora, postulante_idpostulante) 
        VALUES $valoresQ";

        $sqlRes=$con->query($sql) or mysqli_error($con);

        // Up! Next Value
        $item1 = next( $items1 );
        $item2 = next( $items2 );
        $item3 = next( $items3 );
        $item4 = next( $items4 );
        $item5 = next( $items5 );
        $item6 = next( $items6 );
        
        // Check terminator
        if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false) break;

    }
}

if ($con->query($sql) === TRUE) {
    header('Location: ../index.php?dni='.$dni_post);

} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}


?>