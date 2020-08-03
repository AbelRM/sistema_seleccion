<?php
    include_once('../conexion.php');
    $dni=$_POST['dni'];
    $idpostulante= $_POST['idpostulante'];
    //////////////////////// PRESIONAR EL BOTÓN //////////////////////////
    if(isset($_POST['insertar']))
    {
        $items1 = ($_POST['centro_estu']);
        $items2 = ($_POST['materia']);
        $items3 = ($_POST['horas']);
        $items4 = ($_POST['fech_ini']);
        $items5 = ($_POST['fech_fin']);
        $items6 = ($_POST['nivel']);
        $items7 = ($_POST['tipo']);
    
    ///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 5 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
        while(true) {

            //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
            $item1 = current($items1);
            $item2 = current($items2);
            $item3 = current($items3);
            $item4 = current($items4);
            $item5 = current($items5);
            $item6 = current($items6);
            $item7 = current($items7);
            
            ////// ASIGNARLOS A VARIABLES ///////////////////
            $centro_estu=(( $item1 !== false) ? $item1 : ", &nbsp;");
            $materia=(( $item2 !== false) ? $item2 : ", &nbsp;");
            $horas=(( $item3 !== false) ? $item3 : ", &nbsp;");
            $fech_ini=(( $item4 !== false) ? $item4 : ", &nbsp;");
            $fech_fin=(( $item5 !== false) ? $item5 : ", &nbsp;");
            $nivel=(( $item6 !== false) ? $item6 : ", &nbsp;");
            $tipo=(( $item7 !== false) ? $item7 : ", &nbsp;");
            

            //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
            $valores='("'.$centro_estu.'","'.$materia.'" ,"'.$horas.'","'.$fech_ini.'","'.$fech_fin.'","'.$nivel.'" ,"'.$tipo.'","'.$idpostulante.'"),';

            //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
            $valoresQ= substr($valores, 0, -1);
            
            ///////// QUERY DE INSERCIÓN ////////////////////////////
            // include_once('conexion.php');
            $sql = "INSERT INTO cursos_extra (centro_estu, materia, horas, fech_ini, fech_fin, tipo, nivel, postulante_idpostulante) 
            VALUES $valoresQ";

            $sqlRes=$con->query($sql) or mysqli_error($con);

            // Up! Next Value
            $item1 = next( $items1 );
            $item2 = next( $items2 );
            $item3 = next( $items3 );
            $item4 = next( $items4 );
            $item5 = next( $items5 );
            $item6 = next( $items6 );
            $item7 = next( $items7 );
            
            // Check terminator
            if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false && $item7 === false) break;

        }
    }
    header('Location: ../mis_cursos.php?dni='.$dni);
?>