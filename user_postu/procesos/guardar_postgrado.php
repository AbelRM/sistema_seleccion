<?php
    include_once('../conexion.php');
    $dni=$_POST['dni'];
    $idpostulante= $_POST['idpostulante']; 
    $iddetalle_con=$_POST['iddetalle_convocatoria']; 
    //////////////////////// PRESIONAR EL BOTÓN //////////////////////////
    if(isset($_POST['insertar']))
    {
        $items1 = ($_POST['centro_estu']);
        $items2 = ($_POST['especialidad']);
        $items3 = ($_POST['tipo_estu']);
        $items4 = ($_POST['fech_ini']);
        $items5 = ($_POST['fech_fin']);
        $items6 = ($_POST['nivel']); 
    
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
            $centro_estu=(( $item1 !== false) ? $item1 : ", &nbsp;");
            $especialidad=(( $item2 !== false) ? $item2 : ", &nbsp;");
            $tipo=(( $item3 !== false) ? $item3 : ", &nbsp;");
            $fech_ini=(( $item4 !== false) ? $item4 : ", &nbsp;");
            $fech_fin=(( $item5 !== false) ? $item5 : ", &nbsp;");
            $nivel=(( $item6 !== false) ? $item6 : ", &nbsp;");

            //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
            $valores='("'.$centro_estu.'","'.$especialidad.'","'.$tipo.'","'.$fech_ini.'","'.$fech_fin.'","'.$nivel.'","'.$idpostulante.'"),';

            //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
            $valoresQ= substr($valores, 0, -1);
            
            ///////// QUERY DE INSERCIÓN ////////////////////////////
            // include_once('conexion.php');
            $sql = "INSERT INTO maestria_doc (centro_estu, especialidad, tipo_estu, fech_ini, fech_fin, nivel, idpostulante_postulante) 
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
    //$dato_encriptado = $encriptar($dni);
    header('Location: ../capacitacion.php?dni='.$dni);
?>