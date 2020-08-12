<?php
    include_once('../conexion.php');
    $dni=$_POST['dni'];
    $idpostulante= $_POST['idpostulante'];
    //////////////////////// PRESIONAR EL BOTÓN //////////////////////////
    if(isset($_POST['insertar']))
    {
        $items1 = ($_POST['idioma_comp']);
        $items2 = ($_POST['nivel']);
    
    ///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 5 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
        while(true) {

            //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
            $item1 = current($items1);
            $item2 = current($items2);
            
            ////// ASIGNARLOS A VARIABLES ///////////////////
            $idioma_comp=(( $item1 !== false) ? $item1 : ", &nbsp;");
            $nivel=(( $item2 !== false) ? $item2 : ", &nbsp;");

            //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
            $valores='("'.$idioma_comp.'","'.$nivel.'","'.$idpostulante.'"),';

            //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
            $valoresQ= substr($valores, 0, -1);
            
            ///////// QUERY DE INSERCIÓN ////////////////////////////
            // include_once('conexion.php');
            $sql = "INSERT INTO idiomas_comp (idioma_comp, nivel, idpostulante_postulante) 
            VALUES $valoresQ";

            $sqlRes=$con->query($sql) or mysqli_error($con);

            // Up! Next Value
            $item1 = next( $items1 );
            $item2 = next( $items2 );
            
            // Check terminator
            if($item1 === false && $item2 === false) break;

        }
    }
    header('Location: ../capacitacion.php?dni='.$dni);