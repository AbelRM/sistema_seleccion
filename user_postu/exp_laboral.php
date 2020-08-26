<?php
  include 'conexion.php';
  session_start();
  if(empty($_SESSION['active'])){
    header("Location: ../index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistema de postulación DIRESA - TACNA</title>

  <!-- Custom fonts for this template-->
  <link rel="icon" type="image/png" href="img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <link href="css/estilos.css" rel="stylesheet">

</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">  
    <?php     
        $dni = $_GET['dni'];
        include_once('conexion.php');
        $sql="SELECT * FROM usuarios where dni=$dni";
        $datos=mysqli_query($con,$sql) or die(mysqli_error()); ;
        $fila= mysqli_fetch_array($datos);
        include 'menu.php';
      
    ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php
            include_once 'nav.php';
        ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <?php
                include 'conexion.php';
        
                $sql2="SELECT * FROM postulante WHERE dni=$dni";
                $datos2=mysqli_query($con,$sql2) or die(mysqli_error()); ;
                $fila2= mysqli_fetch_array($datos2);
                $idpostulante=$fila2['idpostulante'];

                $primero = mysqli_num_rows(mysqli_query($con,"SELECT * FROM detalle_convocatoria WHERE postulante_idpostulante=$idpostulante"));
                if($primero==0){
                   
                }else{
                    $sql3="SELECT MAX(iddetalle_convocatoria) AS id FROM sistema_seleccion.detalle_convocatoria
                    WHERE postulante_idpostulante=$idpostulante";
                    $datos3=mysqli_query($con,$sql3) or die(mysqli_error());
                    $row3 = mysqli_fetch_row($datos3);
                    $id = trim($row3[0]);
                }

                $segundo = mysqli_num_rows(mysqli_query($con,"SELECT * FROM detalle_convocatoria WHERE postulante_idpostulante=$idpostulante"));
                if($segundo==0){
                    
                }else{
                    $sql4="SELECT * from detalle_convocatoria 
                    inner join total_personal_req on detalle_convocatoria.personal_req_idpersonal=total_personal_req.idpersonal 
                    inner join convocatoria on detalle_convocatoria.convocatoria_idcon=convocatoria.idcon WHERE iddetalle_convocatoria=$id";
                    $datos4=mysqli_query($con,$sql4) or die(mysqli_error());
                    $fila4= mysqli_fetch_array($datos4);
                    $iddetalle_conv=$fila4['iddetalle_convocatoria'];
                    $idtipo = $fila4['idtipo'];
                }
            ?>
          <!-- Page Heading -->
            <!-- Content Row -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h5 class="mb-0 text-gray-800">MI EXPERIENCIA LABORAL:</h5>
            </div>
            <div class="form-group">
                <p class="font-weight-bold" style="color:#000; font-size:16px">NOTA: Todos los datos que ingrese deben ser 
                <span style="color:red;">verídicos</span>, en caso de contrario será 
                <span style="color:red;">betado de las futuras postulaciones</span> para DIRESA - TACNA.</p>
            </div>
            <div class="form-row d-flex justify-content-center">
                <div class="form-group col-md-6">
                    <select name="select" id="inputSelect" class="form-control custom-select">
                        <option selected disabled >Elegir la opción reomendada para usted...</option>
                        <?php
                            $total = mysqli_num_rows(mysqli_query($con,"SELECT * from detalle_convocatoria WHERE iddetalle_convocatoria=$id"));
                            if($total==0){
                                $sql = mysqli_query($con,"SELECT * from tipo_cargo") or die("Problemas en consulta").mysqli_error();
                                while ($registro=mysqli_fetch_array($sql)) {
                                echo "<option value=\"tipo-".$registro['idtipo']."\">".$registro['tipo_cargo']."</option>";
                                }
                            }else{
                                $sql = mysqli_query($con,"SELECT * from tipo_cargo WHERE idtipo=$idtipo") or die("Problemas en consulta").mysqli_error();
                                while ($registro=mysqli_fetch_array($sql)) {
                                echo "<option value=\"tipo-".$registro['idtipo']."\">".$registro['tipo_cargo']."</option>";
                                }
                            }
                        ?>
                    </select>
                </div> 
            </div>

            <!-- FORMULARIO MICRORED -->
            <div id="tipo-1" class="divOculto">
                <div class="form-row p-2 d-flex justify-content-center">
                    <div class="card border-primary">
                        <div class="card-header header-formulario">
                            <h5 class="titulo-card">Experiencia laboral en MICROREDES!</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  class="table table-bordered">  
                                <thead>
                                    <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                                        <th>N°</th>
                                        <th>Lugar de trabajo</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Término</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql6 = "SELECT * FROM expe_4puntos WHERE expe_4puntos_detalle_con = $iddetalle_conv";
                                        $query6=mysqli_query($con, $sql6);
                                        if(mysqli_num_rows($query6)>0){
                                            while ($row= MySQLI_fetch_array($query6))
                                            
                                            {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['id_4puntos'];?></td>
                                                    <td><?php echo $row['lugar']; ?></td>
                                                    <td style="font-size: 16px;"><?php echo $row['fecha_inicio'] ?></td>
                                                    <td style="font-size: 16px;"><?php echo $row['fecha_fin'] ?></td>
                                                </tr>
                                            <?php
                                            
                                            }
                                    }else{
                                        
                                        echo "<tr>
                                        <td colspan='5' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td>
                                        </tr>";
                                    }
                                    ?>
                                </tbody>
                                </table>
                            </div>
                          <form action="procesos/guardar_expe4.php" method="POST">
                            <div class="table-responsive">
                                <!-- <label>En esta sección solo se llenará las experiencias laborales realizadas en microredes</label>  -->
                                <table class="table table-bordered" id="tabla-1">
                                    <thead>
                                        <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                            <th scope="col">Lugar de trabajo</th>
                                            <th scope="col">Fecha Inicio</th>
                                            <th scope="col">Fecha Termino</th>
                                            <th scope="col-1">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="fila-fija-1">
                                            <td>
                                                <select name="lugar[]" class="form-control" id="lugar">
                                                    <option value="" disabled selected>Elegir</option>
                                                    <option value="Microred Tarata">Microred Tarata</option>
                                                    <option value="Microred Candarave">Microred Candarave</option>
                                                    <option value="Microred Alto Andino">Microred Alto Andino</option>
                                                    <option value="Microred Frontera">Microred Frontera</option>
                                                    <option value="Microred Jorge Basadre">Microred Jorge Basadre</option>
                                                </select>
                                            </td>
                                            <td><input type="date" name="fecha_inicio[]" class="form-control name_list" /></td>
                                            <td><input type="date" name="fecha_termino[]" class="form-control name_list"/></td>
                                            <td class="eliminar"><button type="button" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button></td>
                                        </tr>
                                    </tdody>
                                </table>
                            </div>
                            <input type="hidden" name="dni" value="<?php echo $dni; ?>">
                            <input type="hidden" name="iddetalle_conv" value="<?php echo $iddetalle_conv; ?>">
                            <div class="row d-flex justify-content-end">
                                <div class="form-inline p-2">
                                    <button id="adicional-1" name="adicional" type="button" class="btn btn-warning">AGREGAR FILA (+)</button>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="form-inline p-2">
                                    <button  name="insertar" type="submit" class="btn btn-primary">GUARDAR!</button>
                                </div>
                            </div>
                          </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- FORMULARIO MICROREDES DIRESA TACNA -->
            <div id="tipo-2" class="divOculto">
                <div class="form-row p-2 d-flex justify-content-center">
                    <div class="card border-primary">
                        <div class="card-header header-formulario">
                            <h5 class="titulo-card">Experiencia laboral en MICROREDES de TACNA!</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  class="table table-bordered">  
                                <thead>
                                    <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                                        <th>N°</th>
                                        <th>Lugar de trabajo</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Término</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql7 = "SELECT * FROM expe_3puntos WHERE expe_3puntos_detalle_con = $iddetalle_conv";

                                        $query7=mysqli_query($con, $sql7);
                                        if(mysqli_num_rows($query7)>0){
                                            while ($row7= MySQLI_fetch_array($query7))
                                        {
                                        ?>
                                            <tr>
                                                <td><?php echo $row7['id_3puntos'] ?></td>
                                                <td><?php echo $row7['lugar'] ?></td>
                                                <td style="font-size: 16px;"><?php echo $row7['fecha_inicio'] ?></td>
                                                <td style="font-size: 16px;"><?php echo $row7['fecha_fin'] ?></td>
                                            </tr>
                                        <?php
                                        }
                                     }else{
                                        echo "<tr>
                                        <td colspan='5' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td>
                                        </tr>";
                                    }
                                    ?>
                                </tbody>
                                </table>
                            </div>
                          <form action="procesos/guardar_expe3.php" method="POST">        
                            <div class="table-responsive">
                                <!-- <label>En esta sección solo se llenará las experiencias laborales realizadas en microredes de TACNA!</label>  -->
                                <table class="table table-bordered" id="tabla-2">
                                    <thead>
                                        <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                            <th scope="col">Lugar de trabajo</th>
                                            <th scope="col">Fecha Inicio</th>
                                            <th scope="col">Fecha Termino</th>
                                            <th scope="col-1">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="fila-fija-2">
                                            <td><input type="text" name="lugar[]" class="form-control name_list" /></td>
                                            <td><input type="date" name="fecha_inicio[]" class="form-control name_list" /></td>
                                            <td><input type="date" name="fecha_termino[]" class="form-control name_list"/></td>
                                            <td class="eliminar"><button type="button" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button></td>
                                        </tr>
                                    </tdody>
                                </table>
                            </div>
                            <input type="hidden" name="dni" value="<?php echo $dni; ?>">
                            <input type="hidden" name="iddetalle_conv" value="<?php echo $iddetalle_conv; ?>">
                            <div class="row d-flex justify-content-end">
                                <div class="form-inline p-2">
                                    <button id="adicional-2" name="adicional" type="button" class="btn btn-warning">AGREGAR FILA (+)</button>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="form-inline p-2">
                                    <button name="insertar2" type="submit" class="btn btn-primary">GUARDAR!</button>
                                </div>
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FORMULARIO SECTOR PUBLICO O PRIVADO DENTRO O FUERA DE TACNA -->
            <div id="tipo-3" class="divOculto">
                <div class="form-row p-2 d-flex justify-content-center">
                    <div class="card border-primary">
                        <div class="card-header header-formulario">
                            <h5 class="titulo-card">Experiencia laboral en el sector público o privado DENTRO O FUERA de TACNA!</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  class="table table-bordered">  
                                <thead>
                                    <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                                        <th>N°</th>
                                        <th>Lugar de trabajo</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Término</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql8 = "SELECT * FROM expe_1puntos WHERE expe_1puntos_detalle_con = $iddetalle_conv";

                                        $query8=mysqli_query($con, $sql8);
                                        if(mysqli_num_rows($query8)>0){
                                            while ($row= MySQLI_fetch_array($query8))
                                        {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['id_1puntos'] ?></td>
                                                <td><?php echo $row['lugar'] ?></td>
                                                <td style="font-size: 16px;"><?php echo $row['fecha_inicio'] ?></td>
                                                <td style="font-size: 16px;"><?php echo $row['fecha_fin'] ?></td>
                                            </tr>
                                        <?php
                                        }
                                    }else{
                                        
                                        echo "<tr>
                                        <td colspan='5' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td>
                                        </tr>";
                                    }
                                    ?>
                                </tbody>
                                </table>
                            </div>
                          <form action="procesos/guardar_expe1.php" method="POST">  
                            <div class="table-responsive">
                                <!-- <label>En esta sección solo se llenará las experiencias laborales realizadas en microredes de TACNA!</label>  -->
                                <table class="table table-bordered" id="tabla-3">
                                    <thead>
                                        <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                            <th scope="col">Lugar de trabajo</th>
                                            <th scope="col">Fecha Inicio</th>
                                            <th scope="col">Fecha Termino</th>
                                            <th scope="col-1">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="fila-fija-3">
                                            <td><input style="font-size: 14px;" type="text" name="lugar[]" class="form-control name_list" /></td>
                                            <td><input type="date" name="fecha_inicio[]" class="form-control name_list" /></td>
                                            <td><input type="date" name="fecha_termino[]" class="form-control name_list"/></td>
                                            <td class="eliminar"><button type="button" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button></td>
                                        </tr>
                                    </tdody>
                                </table>
                            </div>
                            <input type="hidden" name="dni" value="<?php echo $dni; ?>">
                            <input type="hidden" name="iddetalle_conv" value="<?php echo $iddetalle_conv; ?>">
                            <div class="row d-flex justify-content-end">
                                <div class="form-inline p-2">
                                    <button id="adicional-3" name="adicional" type="button" class="btn btn-warning">AGREGAR FILA (+)</button>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="form-inline p-2">
                                    <button  name="insertar" type="submit" class="btn btn-primary">GUARDAR!</button>
                                </div>
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FORMULARIO SERVICIOS EN LA DIRESA TACNA -->
            <div id="tipo-4" class="divOculto">
                <div class="form-row p-2">
                    <div class="card border-success">
                        <div class="card-header header-formulario-danger">
                            <h5 class="titulo-card">Servicios en la DIRESA TACNA!</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  class="table table-bordered">  
                                <thead>
                                    <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                                        <th>N°</th>
                                        <th>Lugar de trabajo</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Término</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql9 = "SELECT * FROM expe_4puntos WHERE expe_4puntos_detalle_con = $iddetalle_conv";

                                        $query9=mysqli_query($con, $sql9);
                                        if(mysqli_num_rows($query9)>0){
                                            while ($row9= MySQLI_fetch_array($query9))
                                            {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row9['iddetalle_convocatoria'] ?></td>
                                                    <td><?php echo $row9['lugar'] ?></td>
                                                    <td style="font-size: 16px;"><?php echo $row9['fecha_inicio'] ?></td>
                                                    <td style="font-size: 16px;"><?php echo $row9['fecha_fin'] ?></td>
                                                </tr>
                                            <?php
                                            }
                                    }else{
                                        
                                        echo "<tr>
                                        <td colspan='5' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td>
                                        </tr>";
                                    }
                                    ?>
                                </tbody>
                                </table>
                            </div>
                          <form action="procesos/guardar_expe4.php" method="POST"> 
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tabla-4">
                                    <thead>
                                        <tr class="bg-success" style="text-align:center; font-size:0.813em;">
                                            <th scope="col">Lugar de trabajo</th>
                                            <th scope="col">Fecha Inicio</th>
                                            <th scope="col">Fecha Termino</th>
                                            <th scope="col-1">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="fila-fija-4">
                                            <td><input style="font-size:14px;" type="text" name="lugar[]" class="form-control name_list" /></td>
                                            <td><input type="date" name="fech_ini[]" class="form-control name_list" /></td>
                                            <td><input type="date" name="fech_fin[]" class="form-control name_list"/></td>
                                            <td class="eliminar"><button type="button" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button></td>
                                        </tr>
                                    </tdody>
                                </table>

                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="form-inline p-2">
                                    <button id="adicional-4" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <div class="form-inline p-2">
                                    <button name="insertar" type="submit" class="btn btn-primary">GUARDAR!</button>
                                </div>
                            </div>
                          <form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FORMULARIO EXP. EN SECTOR PUBLICO O PRIVADO DENTRO DE TACNA -->
            <div id="tipo-5" class="divOculto">
                <div class="form-row p-2">
                    <div class="card border-success">
                        <div class="card-header">
                            <h5 class="titulo-card">Experiencia en el sector público y privado DENTRO de TACNA!!</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  class="table table-bordered">  
                                <thead>
                                    <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                                        <th>N°</th>
                                        <th>Lugar de trabajo</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Término</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql10 = "SELECT * FROM expe_4puntos WHERE expe_4puntos_detalle_con = $iddetalle_conv";

                                        $query10=mysqli_query($con, $sql10);
                                        if(mysqli_num_rows($query10)>0){
                                            while ($row10= MySQLI_fetch_array($query10))
                                            {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row10['iddetalle_convocatoria'] ?></td>
                                                    <td><?php echo $row10['lugar']?></td>
                                                    <td style="font-size: 16px;"><?php echo $row10['fecha_inicio'] ?></td>
                                                    <td style="font-size: 16px;"><?php echo $row10['fecha_fin'] ?></td>
                                                </tr>
                                            <?php
                                            }
                                    }else{
                                        
                                        echo "<tr>
                                        <td colspan='5' class='text-center text-danger' >NO HAY DATOS AUN REGISTRADOS</td>
                                        </tr>";
                                    }
                                    ?>
                                </tbody>
                                </table>
                            </div>
                          <form action="procesos/guardar_expe3.php" method="POST">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tabla-5">
                                    <thead>
                                        <tr class="bg-success" style="text-align:center; font-size:0.813em;">
                                            <th scope="col">Lugar de trabajo</th>
                                            <th scope="col">Fecha Inicio</th>
                                            <th scope="col">Fecha Termino</th>
                                            <th scope="col-1">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="fila-fija-5">
                                            <td><input type="text" name="lugar[]" class="form-control name_list" /></td>
                                            <td><input type="date" name="fech_ini[]" class="form-control name_list" /></td>
                                            <td><input type="date" name="fech_fin[]" class="form-control name_list"/></td>
                                            <td class="eliminar"><button type="button" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button></td>
                                        </tr>
                                    </tdody>
                                </table>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <div class="form-inline p-2">
                                    <button id="adicional-5" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="form-inline p-2">
                                    <button  name="insertar" type="button" class="btn btn-primary">GUARDAR!</button>
                                </div>
                            </div>
                          <form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FORMULARIO EXP. EN SECTOR PUBLICO O PRIVADO FUERA DE TACNA -->
            <div id="tipo-6" class="divOculto">
                <div class="form-row p-2">
                    <div class="card border-success">
                        <div class="card-header">
                            <h5 class="titulo-card">Experiencia en el sector público y privado FUERA de TACNA!</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  class="table table-bordered">  
                                <thead>
                                    <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                                        <th>N°</th>
                                        <th>Lugar de trabajo</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Término</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql6 = "SELECT * FROM expe_4puntos WHERE expe_4puntos_detalle_con = $iddetalle_conv";

                                        $query6=mysqli_query($con, $sql6);
                                        if(mysqli_num_rows($query6)>0){
                                            while ($row= MySQLI_fetch_array($query6))
                                            {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['iddetalle_convocatoria'] ?></td>
                                                    <td><?php echo $row['lugar'] ?></td>
                                                    <td style="font-size: 16px;"><?php echo $row['fecha_inicio'] ?></td>
                                                    <td style="font-size: 16px;"><?php echo $row['fecha_fin'] ?></td>
                                                </tr>
                                            <?php
                                            }
                                    }else{
                                        
                                        echo "<tr>
                                        <td colspan='5' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td>
                                        </tr>";
                                    }
                                    ?>
                                </tbody>
                                </table>
                            </div>
                          <form action="procesos/guardar_expe1.php" method="POST">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tabla-6">
                                    <thead>
                                        <tr class="bg-success" style="text-align:center; font-size:0.813em;">
                                            <th scope="col">Lugar de trabajo</th>
                                            <th scope="col">Fecha Inicio</th>
                                            <th scope="col">Fecha Termino</th>
                                            <th scope="col-1">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="fila-fija-6">
                                            <td><input type="text" name="lugar[]" class="form-control name_list" /></td>
                                            <td><input type="date" name="fech_ini[]" class="form-control name_list" /></td>
                                            <td><input type="date" name="fech_fin[]" class="form-control name_list"/></td>
                                            <td class="eliminar"><button type="button" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button></td>
                                        </tr>
                                    </tdody>
                                </table>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <div class="form-inline p-2">
                                    <button id="adicional-6" name="adicional" type="button" class="btn btn-warning">AGREGAR FILA (+)</button>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="form-inline p-2">
                                    <button  name="insertar" type="submit" class="btn btn-primary">GUARDAR!</button>
                                </div>
                            </div>
                          <form>
                        </div>
                    </div>
                </div>
            </div>
        <!-- /.container-fluid -->
        </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include 'footer.php'; ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="cerrarsesion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">¿Desea cerrar sesión?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
            <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="procesos/cerrar_sesion.php">Cerrar sesión</a>
            </div>
        </div>
        </div>
    </div>
    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script>
        $(function() {
            $("#inputSelect").on('change', function() {
            var selectValue = $(this).val();
            switch (selectValue) {
                case "tipo-1":
                    $("#tipo-1").show();
                    $("#tipo-2").show();
                    $("#tipo-3").show();
                    $("#tipo-4").hide();
                    $("#tipo-5").hide();
                    $("#tipo-6").hide();
                break;

                case "tipo-2":
                    $("#tipo-4").show();
                    $("#tipo-5").show();
                    $("#tipo-6").show();
                    $("#tipo-1").hide();
                    $("#tipo-2").hide();
                    $("#tipo-3").hide();
                break;
            }
            }).change();
        });
    </script>
    <script>
         $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-1").on('click', function(){
                $("#tabla-1 tbody tr:eq(0)").clone().removeClass('fila-fija-1').appendTo("#tabla-1").find("input[type=text],input[type=date]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-2").on('click', function(){
                $("#tabla-2 tbody tr:eq(0)").clone().removeClass('fila-fija-2').appendTo("#tabla-2").find("input[type=text],input[type=date]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-3").on('click', function(){
                $("#tabla-3 tbody tr:eq(0)").clone().removeClass('fila-fija-3').appendTo("#tabla-3").find("input[type=text],input[type=date]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-4").on('click', function(){
                $("#tabla-4 tbody tr:eq(0)").clone().removeClass('fila-fija-4').appendTo("#tabla-4").find("input[type=text],input[type=date]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-5").on('click', function(){
                $("#tabla-5 tbody tr:eq(0)").clone().removeClass('fila-fija-5').appendTo("#tabla-5").find("input[type=text],input[type=date]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-6").on('click', function(){
                $("#tabla-6 tbody tr:eq(0)").clone().removeClass('fila-fija-6').appendTo("#tabla-6").find("input[type=text],input[type=date]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
    </script>
</body>

</html>
