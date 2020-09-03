<?php
  include 'conexion.php';
  include 'funcs/mcript.php';
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
        $dato_desencriptado = $_GET['dni'];
        $dni = $desencriptar($dato_desencriptado);
        
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

            $consulta="SELECT * FROM postulante where dni=$dni";
            $datos=mysqli_query($con,$consulta) or die(mysqli_error()); ;
            $row= mysqli_fetch_array($datos);
            $idpostulante=$row['idpostulante'];

            $consulta1="SELECT * FROM detalle_convocatoria where postulante_idpostulante=$idpostulante";
            $datos1=mysqli_query($con,$consulta1) or die(mysqli_error()); ;
            $row1= mysqli_fetch_array($datos1);
            $iddetalle_con=$row1['iddetalle_convocatoria'];

            $consulta2="SELECT * FROM datos_profesionales where postulante_idpostulante=$idpostulante";
            $datos2=mysqli_query($con,$consulta2) or die(mysqli_error()); ;
            $row2= mysqli_fetch_array($datos2);
        ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
            <!-- Content Row -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h5 class="mb-0 text-gray-800">MIS DATOS ACADÉMICOS:</h5>
            </div>
            <div class="row">
                <div class="col-10 p-0">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                            <div class="col-xl-12 col-md-12 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 p-2 d-flex justify-content-center">
                                                <h3 class="text-xs font-weight-bold text-danger text-uppercase mb-1">Estudios superiores</h3>
                                            </div>
                                            <div class="col-md-12 p-2">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">  
                                                        <thead>
                                                            <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                                                                <th>N°</th>
                                                                <th>Centro de estudios</th>
                                                                <th>Especialidad</th>
                                                                <th>Fecha Inicio</th>
                                                                <th>Fecha Término</th>
                                                                <th>Nivel</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $sql1 = "SELECT * FROM estudios_superiores WHERE idpostulante_postulante = $idpostulante";
                                                                $query1=mysqli_query($con, $sql1);
                                                                if(mysqli_num_rows($query1)>0){
                                                                    while ($row1= MySQLI_fetch_array($query1))
                                                                    {
                                                                    ?>
                                                                        <tr>
                                                                            <td style="font-size: 12px;"><?php echo $row1['idestudios'];?></td>
                                                                            <td style="font-size: 12px;"><?php echo $row1['centro_estu']; ?></td>
                                                                            <td style="font-size: 12px;"><?php echo $row1['especialidad']; ?></td>
                                                                            <td style="font-size: 12px;"><?php echo $row1['fech_ini'] ?></td>
                                                                            <td style="font-size: 12px;"><?php echo $row1['fech_fin'] ?></td>
                                                                            <td style="font-size: 12px;"><?php echo $row1['nivel'] ?></td>
                                                                            <td class="d-flex justify-content-center">
                                                                                <button class="btn btn-success btn-sm m-1 updateBtn"><i class="fa fa-edit"></i></button>
                                                                                <button class="btn btn-danger btn-sm m-1 deleteBtn"><i class="fa fa-times-circle"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                    
                                                                    }
                                                            }else{
                                                                echo "<tr>
                                                                <td colspan='7' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td>
                                                                </tr>";
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-12 p-2">
                                                <form action="procesos/guardar_estudios_sup.php" method="POST">
                                                    <div class="table-responsive">
                                                        <label>Estudios Superiores (Universitario - Tecnico)</label>
                                                        <input type="hidden" id="idpostulante" name="idpostulante" value="<?php echo $idpostulante; ?>">
                                                        <input type="hidden" id="url" name="url" value="<?php echo $dato_desencriptado; ?>">
                                                        <table class="table table-bordered" id="tabla-7">
                                                            <thead>
                                                                <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                                                    <th scope="col">Centro Estudios</th>
                                                                    <th scope="col">Especialidad</th>
                                                                    <th scope="col">Fecha Inicio</th>
                                                                    <th scope="col">Fecha Término</th>
                                                                    <th scope="col">Nivel</th>
                                                                    <th scope="col">Acción</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="fila-fija-7">
                                                                    <td><input style="font-size: 12px;" type="text" name="centro_estu[]" class="form-control name_list" required/></td>
                                                                    <td><input style="font-size: 12px;" type="text" name="especialidad[]"  class="form-control name_list" required/></td>
                                                                    <td><input style="font-size: 12px;" type="date" name="fech_ini[]" class="form-control name_list" required/></td>
                                                                    <td><input style="font-size: 12px;" type="date" name="fech_fin[]" class="form-control name_list" required/></td>
                                                                    <td>
                                                                        <select style="font-size: 12px;" name="nivel[]" class="form-control" id="nivel[]" required>
                                                                            <option value="" disabled selected>Elegir</option>
                                                                            <option value="MAGISTER">Magister</option>
                                                                            <option value="DOCTORADO">Doctorado</option>
                                                                            <option value="EGRESADO">Egresado</option>
                                                                            <option value="ESTUDIANTE">Estudiante</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="eliminar"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                                                                </tr>
                                                            </tdody>
                                                        </table>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 d-flex justify-content-center">
                                                            <button id="adicional-7" name="adicional" type="button" class="btn btn-warning m-1"> AGREGAR FILA (+) </button>
                                                        </div>
                                                        <div class="col-md-12 d-flex justify-content-end">
                                                            <button class="btn btn-secondary m-1" type="button">Cancelar</button>
                                                            <button class="btn btn-primary m-1" name="insertar" type="submit" >Guardar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                            <div class="col-xl-12 col-md-12 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row ">
                                            <div class="col-12 p-2 d-flex justify-content-center">
                                            <div class="text-xs font-weight-bold text-success  text-uppercase mb-1">Estudios Postgrado</div>
                                            </div>
                                            <div class="col-6 p-2 d-flex justify-content-center">
                                                <button class="btn btn btn-success" data-toggle="modal" data-target="#estudios_postgrado">AGREGAR <i class="fas fa-user-graduate"></i></button>
                                            </div>
                                            <div class="col-6 p-2 d-flex justify-content-center">
                                                <button class="btn btn btn-success" data-toggle="modal" data-target="#ver_estudios_postgrado"><i class="fas fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                            <div class="col-xl-12 col-md-12 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row ">
                                            <div class="col-12 p-2 d-flex justify-content-center">
                                            <div class="text-xs font-weight-bold text-info  text-uppercase mb-1">Diplomados - cursos - seminarios</div>
                                            </div>
                                            <div class="col-6 p-2 d-flex justify-content-center">
                                                <button class="btn btn btn-info" data-toggle="modal" data-target="#cursos_diplomados">AGREGAR <i class="fas fa-list-ol"></i></button>
                                            </div>
                                            <div class="col-6 p-2 d-flex justify-content-center">
                                                <button class="btn btn btn-info" data-toggle="modal" data-target="#ver_cursos_diplomados"><i class="fas fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                            <div class="col-xl-12 col-md-12 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row ">
                                            <div class="col-12 p-2 d-flex justify-content-center">
                                            <div class="text-xs font-weight-bold text-warning  text-uppercase mb-1">Idiomas - Computación</div>
                                            </div>
                                            <div class="col-6 p-2 d-flex justify-content-center">
                                                <button class="btn btn btn-warning" data-toggle="modal" data-target="#idiomas">AGREGAR <i class="fas fa-list-ol"></i></button>
                                            </div>
                                            <div class="col-6 p-2 d-flex justify-content-center">
                                                <button class="btn btn btn-warning" data-toggle="modal" data-target="#ver_idiomas"><i class="fas fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2 p-0">
                    <div class="list-group" id="list-tab" role="tablist" style="font-size:12px;">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Estudios Superiores</a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Estudios Postgrado</a>
                        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Diplomados - Cursos</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Idioma - Computación</a>
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
    <div class="modal fade" id="updateModal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Edit Record</h5>
                    <button class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form action="update.php" method="POST">
                        <input type="hidden" name="dato_desencriptado" id="dato_desencriptado" value="<?php echo $dato_desencriptado ?>" >
                        <input type="hidden" name="idestudios" id="idestudios" >
                        <div class="form-group">
                        <label for="title">Centro de estudios</label>
                        <input type="text" name="centro_estu" id="centro_estu" class="form-control" placeholder="Enter first name" maxlength="50"
                            required>
                        </div>
                        <div class="form-group">
                        <label for="title">Especialidad</label>
                        <input type="text" name="especialidad" id="especialidad" class="form-control" placeholder="Enter last name" maxlength="50"
                            required>
                        </div>
                        <div class="form-group">
                        <label for="title">Fecha Inicio</label>
                        <input type="text" name="fecha_inicio" id="fecha_inicio" class="form-control" placeholder="Enter address" maxlength="50"
                            required>
                        </div>
                        <div class="form-group">
                        <label for="title">Fecha término</label>
                        <input type="text" name="fecha_fin" id="fecha_fin" class="form-control" placeholder="Enter skills" maxlength="50" required>
                        </div>
                        <div class="form-group">
                        <label for="title">Nivel</label>
                        <select class="form-control" id="nivel" name="nivel">
                            <!-- <option value="" disabled selected>Elegir</option> -->
                            <option value="MAGISTER">Magister</option>
                            <option value="DOCTORADO">Doctorado</option>
                            <option value="EGRESADO">Egresado</option>
                            <option value="ESTUDIANTE">Estudiante</option>
                        </select>    
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="updateData">Actualizar!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- !-- DELETE MODAL -->
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" >Eliminar registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form action="procesos/delete4.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="url" id="url" value="<?php echo $dato_desencriptado;?>">
                        <input type="hidden" name="id" id="id">
                        <h4>¿Desea eliminar el dato seleccionado?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" name="deleteData">Si</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
     <!-- VER estudios superiores Modal-->
     <div class="modal fade bd-example-modal-xl" id="ver_estudios_superiores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Estudios Superiores (Universitario - Tecnico)</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable_estu_sup" width="100%" cellspacing="0">
                            <thead>
                                <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                <th>N°</th>
                                <th>Centro de estudios</th>
                                <th>Especialidad</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Nivel</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $consulta3 = "SELECT * FROM estudios_superiores WHERE idpostulante_postulante = $idpostulante";

                                $query=mysqli_query($con, $consulta3);
                                while ($row3= MySQLI_fetch_array($query))
                                {
                                ?>
                                <tr id="<?php echo $row3['idestudios']?>">
                                    <td><?php echo $row3['idestudios'] ?></td>
                                    <td style="font-size: 16px;"><?php echo $row3['centro_estu'] ?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['especialidad']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['fech_ini']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['fech_fin']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['nivel']; ?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Salir</button>
                </div>
            </div>
        </div>
    </div>

    <!--GUARDAR Estudios Postgrado Modal-->
    <div class="modal fade bd-example-modal-xl" id="estudios_postgrado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Estudios Postgrado</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="procesos/guardar_postgrado.php" method="POST">
                <div class="modal-body">
                    <div class="table-responsive">
                        <label>Estudios Postgrado (Maestrias - Doctorados)</label>
                        <input type="hidden" id="dni" name="dni" value="<?php echo $dni; ?>">
                        <input type="hidden" id="idpostulante" name="idpostulante" value="<?php echo $idpostulante; ?>">
                        <input type="hidden" id="iddetalle_convocatoria" name="iddetalle_convocatoria" value="<?php echo $iddetalle_con; ?>">
                        <table class="table table-bordered" id="tabla-8">
                            <thead>
                            <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                <th  scope="col">Centro Estudios</th>
                                <th  scope="col">Especialidad</th>
                                <th  scope="col">Tipo Estudios</th>
                                <th  scope="col">Fecha Inicio</th>
                                <th  scope="col">Fecha Termino</th>
                                <th  scope="col">Nivel Alcanzado</th>
                                <th  scope="col">Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="fila-fija-8">
                                    <td><input style="width: 200px;font-size: 12px;" type="text" name="centro_estu[]" class="form-control name_list" required/></td>
                                    <td><input style="width: 200px;font-size: 12px;" type="text" name="especialidad[]"  class="form-control name_list" required/></td>
                                    <td>
                                        <select style="font-size: 12px;" name="tipo_estu[]" class="form-control" id="tipo_estu[]" required>
                                            <option selected>Elegir</option>
                                            <option value="MAESTRIA">Maestria </option>
                                            <option value="DOCTORADO">Doctorado</option>
                                        </select>
                                    </td>
                                    <td><input style="width: 150px;font-size: 12px;" type="date" name="fech_ini[]" class="form-control name_list" required/></td>
                                    <td><input style="width: 150px;font-size: 12px;" type="date" name="fech_fin[]" class="form-control name_list" required/></td>
                                    <td>
                                        <select style="font-size: 12px;" name="nivel[]" class="form-control" id="nivel[]" required>
                                            <option selected>Elegir</option>
                                            <option value="MAGISTER">Magister</option>
                                            <option value="DOCTORADO">Doctorado</option>
                                            <option value="EGRESADO">Egresado</option>
                                            <option value="ESTUDIANTE">Estudiante</option>
                                        </select>
                                    </td>
                                    <td class="eliminar"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                                </tr>
                            </tdody>
                        </table>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="form-inline p-2">
                            <button id="adicional-8" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" name="insertar" type="submit" >Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- VER Estudioa Postgrado-->
    <div class="modal fade bd-example-modal-xl" id="ver_estudios_postgrado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Estudios Superiores (Maestrias - Doctorados)</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="procesos/guardar_diplomados.php" method="POST">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                <th>N°</th>
                                <th>Centro de estudios</th> 
                                <th>Especialidad</th> 
                                <th>Tipo</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Nivel</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                //$dni = $_GET['dni'];
                                
                                $consulta3 = "SELECT * FROM maestria_doc WHERE idpostulante_postulante = $idpostulante";

                                $query=mysqli_query($con, $consulta3);
                                while ($row3= MySQLI_fetch_array($query))
                                {
                                ?>
                                <tr>
                                    <td><?php echo $row3['idmaestria_doc'] ?></td>
                                    <td style="font-size: 16px;"><?php echo $row3['centro_estu'] ?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['especialidad']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['tipo_estu']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['fech_ini']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['fech_fin']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['nivel']; ?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Salir</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- GUARDAR Cursos y diplomados Modal-->
    <div class="modal fade bd-example-modal-xl" id="cursos_diplomados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cursos, diplomados y/o seminarios</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="procesos/guardar_diplomados.php" method="POST">  
                <div class="modal-body">
                    <div class="table-responsive">
                        <label>Diplomados - Cursos - Seminarios</label> 
                        <input type="hidden" id="dni" name="dni" value="<?php echo $dni; ?>">
                        <input type="hidden" id="idpostulante" name="idpostulante" value="<?php echo $idpostulante; ?>">
                        <table class="table table-bordered" id="tabla-9">
                            <thead>
                            <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                <th scope="col">Centro Estudios</th>
                                <th scope="col">Nombre de la especialidad</th>
                                <th scope="col">Horas</th>
                                <th scope="col">Fecha Inicio</th>
                                <th scope="col">Fecha Termino</th>
                                <th scope="col">Nivel Alcanzado</th>
                                <th scope="col">Tipo de estudios</th>
                                <th scope="col">Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="fila-fija-9">
                                    <td><input style="font-size: 12px;" type="text" name="centro_estu[]" class="form-control name_list" required /></td>
                                    <td><input style="font-size: 12px;" type="text" name="materia[]"  class="form-control name_list" required/></td>
                                    <td><input style="width: 62px;font-size: 12px;" type="text" name="horas[]" class="form-control name_list" required/></td>
                                    <td><input style="width: 168px;font-size: 12px;" type="date" name="fech_ini[]" class="form-control name_list" required/></td>
                                    <td><input style="width: 168px;font-size: 12px;" type="date" name="fech_fin[]" class="form-control name_list" required/></td>
                                    <td>
                                        <select style="font-size: 12px;" name="nivel[]" class="form-control" id="cargo" required>
                                            <option value="" disabled selected>Elegir</option>
                                            <option value="EGRESADO">Egresado</option>
                                            <option value="ESTUDIANTE">Estudiante</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select style="font-size: 12px;" name="tipo[]" class="form-control" id="cargo" required>
                                            <option value="" disabled selected>Elegir...</option>
                                            <option value="DIPLOMADO">Diplomado</option>
                                            <option value="CURSO">Curso</option>
                                            <option value="SEMINARIO">Seminario</option>
                                        </select>
                                    </td>
                                    <td class="eliminar"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                                </tr>
                            </tdody>
                        </table>
                    </div> 
                    <div class="row d-flex justify-content-center">
                        <input type="hidden" id="idcon" name="idcon" value="<?php echo $fila['idcon']; ?>">
                        <div class="form-inline p-2">
                            <button id="adicional-9" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                        </div>
                    </div>   
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" name="insertar" type="submit" >Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- VER Cursos y diplomados Modal-->
    <div class="modal fade bd-example-modal-xl" id="ver_cursos_diplomados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cursos, diplomados y/o seminarios</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="procesos/guardar_diplomados.php" method="POST">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                <th>N°</th>
                                <th>Centro de estudios</th>
                                <th>Nombre de materia</th>
                                <th>Horas</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Tipo</th>
                                <th>Nivel</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $dni = $_GET['dni'];
                                
                                $consulta3 = "SELECT * FROM cursos_extra WHERE postulante_idpostulante = $idpostulante";

                                $query=mysqli_query($con, $consulta3);
                                while ($row3= MySQLI_fetch_array($query))
                                {
                                ?>
                                <tr>
                                    <td><?php echo $row3['idcursos_extra'] ?></td>
                                    <td style="font-size: 16px;"><?php echo $row3['centro_estu'] ?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['materia']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['horas']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['fech_ini']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['fech_fin']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['tipo']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['nivel']; ?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Salir</button>
                </div>
                </form>
            </div>
        </div>
    </div>

   <!-- GUARDAR Idiomas y computacion-->
    <div class="modal fade bd-example-modal-xl" id="idiomas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Idiomas - Computación</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="procesos/guardar_idiomas.php" method="POST">  
                <div class="modal-body">
                    <div class="table-responsive">
                        <input type="hidden" id="dni" name="dni" value="<?php echo $dni; ?>">
                        <input type="hidden" id="idpostulante" name="idpostulante" value="<?php echo $idpostulante; ?>">
                        <table class="table table-bordered" id="tabla-10">
                            <thead>
                                <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                    <th scope="col">Idioma/Computación</th>
                                    <th scope="col">Nivel</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="fila-fija-10">
                                    <td><input type="text" name="idioma_comp[]" placeholder="Inglés, Portugues, Computación..." class="form-control name_list text-uppercase" /></td>
                                    <td>
                                        <select name="nivel[]" class="form-control">
                                            <option value="" disabled selected>Elegir</option>
                                            <option value="BASICO">Básico</option>
                                            <option value="INTERMEDIO">Intermedio</option>
                                            <option value="AVANZADO">Avanzado</option>
                                        </select>
                                    </td>
                                    <td class="eliminar"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                                </tr>
                            </tdody>
                        </table>
                    </div>  
                    <div class="row d-flex justify-content-center">
                        <input type="hidden" id="idcon" name="idcon" value="<?php echo $fila['idcon']; ?>">
                        <div class="form-inline p-2">
                            <button id="adicional-10" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                        </div>
                    </div>   
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" name="insertar" type="submit" >Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- VER Cursos y diplomados Modal-->
    <div class="modal fade bd-example-modal-xl" id="ver_idiomas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cursos, diplomados y/o seminarios</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                    <th>N°</th>
                                    <th scope="col">Idioma/Computación</th>
                                    <th scope="col">Nivel</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $dni = $_GET['dni'];
                                
                                $consulta4 = "SELECT * FROM idiomas_comp WHERE idpostulante_postulante = $idpostulante";

                                $query=mysqli_query($con, $consulta4);
                                while ($row4= MySQLI_fetch_array($query))
                                {
                                ?>
                                <tr>
                                    <td><?php echo $row4['ididiomas_comp'] ?></td>
                                    <td style="font-size: 16px;"><?php echo $row4['idioma_comp'] ?></td>
                                    <td style="font-size: 14px;"><?php echo $row4['nivel']?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Salir</button>
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

    <!-- Page level custom scripts -->
    <script src="js/bootstrable.js"></script>

    <!-- alertas -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script>
        $(document).ready(function() {
            //Select para mostrar e esconder divs
            $('#SelectOptions').on('change',function(){
                var SelectValue='.'+$(this).val();
                $('.grupo-formularios div').hide();
                $(SelectValue).toggle();
            });
        });
    </script>
    <script>
    $(document).ready(function () {
        $('.updateBtn').on('click', function(){

            $('#updateModal').modal('show');
    
            // Get the table row data.
            $tr = $(this).closest('tr');
    
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
    
            console.log(data);
    
            $('#idestudios').val(data[0]);
            $('#centro_estu').val(data[1]);
            $('#especialidad').val(data[2]);
            $('#fecha_inicio').val(data[3]);
            $('#fecha_fin').val(data[4]);  
            $('#nivel').val(data[5]);  
        });
    });

    $(document).ready(function () {
        $('.deleteBtn').on('click', function(){
    
            $('#deleteModal').modal('show');
            // Get the table row data.
            $tr = $(this).closest('tr');
    
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
    
            console.log(data);
            $('#id').val(data[0]);
        });
    });
    </script>

    <script>
         $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-1").on('click', function(){
                $("#tabla-1 tbody tr:eq(0)").clone().removeClass('fila-fija-1').appendTo("#tabla-1").find("input[type=text]").val("");
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
                $("#tabla-2 tbody tr:eq(0)").clone().removeClass('fila-fija-2').appendTo("#tabla-2").find("input[type=text]").val("");
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
                $("#tabla-3 tbody tr:eq(0)").clone().removeClass('fila-fija-3').appendTo("#tabla-3").find("input[type=text]").val("");
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
                $("#tabla-4 tbody tr:eq(0)").clone().removeClass('fila-fija-4').appendTo("#tabla-4").find("input[type=text]").val("");
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
                $("#tabla-5 tbody tr:eq(0)").clone().removeClass('fila-fija-5').appendTo("#tabla-5").find("input[type=text]").val("");
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
                $("#tabla-6 tbody tr:eq(0)").clone().removeClass('fila-fija-6').appendTo("#tabla-6").find("input[type=text]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-7").on('click', function(){
                $("#tabla-7 tbody tr:eq(0)").clone().removeClass('fila-fija-7').appendTo("#tabla-7").find("input[type=text]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-8").on('click', function(){
                $("#tabla-8 tbody tr:eq(0)").clone().removeClass('fila-fija-8').appendTo("#tabla-8").find("input[type=text]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-9").on('click', function(){
                $("#tabla-9 tbody tr:eq(0)").clone().removeClass('fila-fija-9').appendTo("#tabla-9").find("input[type=text]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-10").on('click', function(){
                $("#tabla-10 tbody tr:eq(0)").clone().removeClass('fila-fija-10').appendTo("#tabla-10").find("input[type=text]").val("");
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
