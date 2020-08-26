<?php
    include '../conexion.php';
    $dni=$_POST['dni'];
    $iddetalle_conv=$_POST['iddetalle_conv'];
    //////////////////////// PRESIONAR EL BOTÓN //////////////////////////
    if(isset($_POST['insertar']))
    {
        $items1 = ($_POST['lugar']);
        $items2 = ($_POST['cargo']);
        $items3 = ($_POST['fecha_inicio']);
        $items4 = ($_POST['fecha_termino']);
    
        ///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 4 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
        while(true) {

            //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
            $item1 = current($items1);
            $item2 = current($items2);
            $item3 = current($items3);
            $item4 = current($items4);
            
            ////// ASIGNARLOS A VARIABLES ///////////////////
            $lugar=(( $item1 !== false) ? $item1 : ", &nbsp;");
            $cargo=(( $item2 !== false) ? $item2 : ", &nbsp;");
            $fecha_ini=(( $item3 !== false) ? $item3 : ", &nbsp;");
            $fecha_fin=(( $item4 !== false) ? $item4 : ", &nbsp;");

            /// VALORES AÑOS, MESES Y DIAS ///
            $fechainicial = new DateTime($fecha_ini);
            $fechaactual = new DateTime($fecha_fin);

            $diferencia = $fechainicial->diff($fechaactual); 

            $años=$diferencia->format('%Y');
            $meses=$diferencia->format('%m');
            $dias=$diferencia->format('%d');

            //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
            $valores='("'.$lugar.'","'.$cargo.'","'.$fecha_ini.'","'.$fecha_fin.'","'.$años.'","'.$meses.'","'.$dias.'","'.$iddetalle_conv.'"),';

            //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
            $valoresQ= substr($valores, 0, -1);
            
            ///////// QUERY DE INSERCIÓN ////////////////////////////
            $sql = "INSERT INTO expe_4puntos (lugar,cargo,fecha_inicio,fecha_fin,anios,meses,dias,expe_4puntos_detalle_con) 
            VALUES $valoresQ";

            $sqlRes=$con->query($sql) or mysqli_error($con);
        
            // Up! Next Value
            $item1 = next( $items1 );
            $item2 = next( $items2 );
            $item3 = next( $items3 );
            $item4 = next( $items4 );
            
            // Check terminator
            if($item1 === false && $item2 === false && $item3 === false && $item4 === false) break;

        }

    }
    header('Location: ../exp_laboral.php?dni='.$dni);

?>