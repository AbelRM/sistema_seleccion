<?php
    include_once('../conexion.php');
    $idcon = $_POST['idcon'];
    $dni = $_POST['dni'];
    //////////////////////// PRESIONAR EL BOTÓN //////////////////////////
    if(isset($_POST['insertar']))
    {
        $items1 = ($_POST['cantidad']);
        $items2 = ($_POST['cargo']);
        $items3 = ($_POST['remuneracion']);
        $items4 = ($_POST['fuente_finac']);
        $items5 = ($_POST['meta']);
    
    ///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 5 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
        while(true) {

            //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
            $item1 = current($items1);
            $item2 = current($items2);
            $item3 = current($items3);
            $item4 = current($items4);
            $item5 = current($items5);
            
            ////// ASIGNARLOS A VARIABLES ///////////////////
            $cantidad=(( $item1 !== false) ? $item1 : ", &nbsp;");
            $cargo=(( $item2 !== false) ? $item2 : ", &nbsp;");
            $remuneracion=(( $item3 !== false) ? $item3 : ", &nbsp;");
            $fuente_finac=(( $item4 !== false) ? $item4 : ", &nbsp;");
            $meta=(( $item5 !== false) ? $item5 : ", &nbsp;");

            //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
            $valores='("'.$cantidad.'","'.$remuneracion.'","'.$fuente_finac.'","'.$meta.'","'.$cargo.'","'.$idcon.'"),';

            //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
            $valoresQ= substr($valores, 0, -1);
            
            ///////// QUERY DE INSERCIÓN ////////////////////////////
            // include_once('conexion.php');
            $sql = "INSERT INTO personal_req (cantidad, remuneracion, fuente_finac, meta, cargo_idcargo, convocatoria_idcon) 
            VALUES $valoresQ";

            $sqlRes=$con->query($sql) or mysqli_error($con);

            // Up! Next Value
            $item1 = next( $items1 );
            $item2 = next( $items2 );
            $item3 = next( $items3 );
            $item4 = next( $items4 );
            $item5 = next( $items5 );
            
            // Check terminator
            if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false) break;

        }
    }
    header('Location: ../agregar_comision.php?convocatoria_idcon='.$idcon.'&dni='.$dni);
?>