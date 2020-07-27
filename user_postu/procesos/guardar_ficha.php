<?php

    include '../conexion.php';
   
    $dni_post=$_POST['dni_post'];
    // DATOS PERSONALES
    $fech_nac = $_POST['fech_nac'];
    $civil = $_POST['civil'];
    $sexo = $_POST['sexo'];
    $num_emer= $_POST['num_emer'];
    $nomb_parent = $_POST['nomb_parent'];
    $ruc = $_POST['ruc'];
    $cuarta= $_POST['cuarta'];
    $pension= $_POST['pension'];
    $cuenta_banc = $_POST['cuenta_banc'];
    $discapacidad = $_POST['discapacidad'];
    $tip_discapacidad = $_POST['tip_discapacidad'];
    $tip_sangre = $_POST['tip_sangre'];
    $alergias = $_POST['alergias'];
    $distrito = $_POST['distrito_id'];
    $direccion=$_POST['direccion'];
    //DATOS DOMICILIO
    $tipo_via = $_POST['tipo_via'];
    $nomb_via = $_POST['nomb_via'];
    $num_via = $_POST['num_via'];
    $tipo_zona = $_POST['tipo_zona'];
    $nomb_zona = $_POST['nomb_zona'];
    $num_zona = $_POST['num_zona'];
    $referencia = $_POST['referencia'];
    $distrito1 = $_POST['distrito_id1'];
    
    $sql = "UPDATE postulante SET fech_nac = '".$fech_nac."',estado_civil='".$civil."',sexo = '".$sexo."', celular_emer ='".$num_emer."',parentesco_emer='".$nomb_parent."',ruc ='".$ruc."',num_cuenta = '".$cuenta_banc."',
     discapacidad = '".$discapacidad."', tipo_discap = '".$tip_discapacidad."',tipo_sangre = '".$tip_sangre."', alergias = '".$alergias."',suspension_cuarta = '".$cuarta."',seguro = '".$pension."',direccion = '".$direccion."',distrito_iddistrito = '".$distrito."' WHERE dni='".$dni_post."' ";
    
    $prueba="SELECT * FROM postulante where dni=$dni_post";
    $datos=mysqli_query($con,$prueba) or die(mysqli_error()); 
    $fila= mysqli_fetch_array($datos);
    $idpostulante=$fila['idpostulante'];

    $sql2 = "INSERT INTO domicilio_post (tip_via, nomb_via, num_via,tip_zona, nomb_zona, num_zona, referencia, postulante_idpostulante, distrito_iddistrito) 
    VALUES ('".$tipo_via."', '".$nomb_via."', '".$num_via."', '".$tipo_zona."', '".$nomb_zona."', '".$num_zona."','".$referencia."','".$idpostulante."','".$distrito1."')";

    if ($con->query($sql) === TRUE) {
        echo $idpostulante;
        echo "se agrego el primer sql";
       
        if($con->query($sql2) === TRUE){
            
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
                    $nombre(( $item1 !== false) ? $item1 : ", &nbsp;");
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
                    $sql3 = "INSERT INTO familia_post (nombre, apellidos, fech_nac, dni, parentesco, labora, postulante_idpostulante) 
                    VALUES $valoresQ";
        
                    $sqlRes=$con->query($sql3) or mysqli_error($con);
        
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
            header('Location: ../agregar_comision.php?convocatoria_idcon='.$idcon);
        }
        
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    // $conn->close();

?>