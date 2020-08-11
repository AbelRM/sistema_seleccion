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

          <!-- Page Heading -->
            <!-- Content Row -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h5 class="mb-0 text-gray-800">MIS DATOS PROFESIONALES:</h5>
            </div>
            <div class="row d-flex justify-content-center">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-12 p-2 d-flex justify-content-center">
                                <div class="text-xs font-weight-bold text-danger  text-uppercase mb-1">Estudios superiores</div>
                                </div>
                                <div class="col-6 p-2 d-flex justify-content-center">
                                    <button class="btn btn btn-danger" data-toggle="modal" data-target="#estudios_superiores">+ <i class="fas fa-user-graduate"></i></button>
                                </div>
                                <div class="col-6 p-2 d-flex justify-content-center">
                                    <button class="btn btn btn-danger" data-toggle="modal" data-target="#ver_estudios_superiores"><i class="fas fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-12 p-2 d-flex justify-content-center">
                                <div class="text-xs font-weight-bold text-success  text-uppercase mb-1">Estudios Postgrado</div>
                                </div>
                                <div class="col-6 p-2 d-flex justify-content-center">
                                    <button class="btn btn btn-success" data-toggle="modal" data-target="#estudios_postgrado">+ <i class="fas fa-user-graduate"></i></button>
                                </div>
                                <div class="col-6 p-2 d-flex justify-content-center">
                                    <button class="btn btn btn-success" data-toggle="modal" data-target="#ver_estudios_postgrado"><i class="fas fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-12 p-2 d-flex justify-content-center">
                                <div class="text-xs font-weight-bold text-info  text-uppercase mb-1">Diplomados - cursos - seminarios</div>
                                </div>
                                <div class="col-6 p-2 d-flex justify-content-center">
                                    <button class="btn btn btn-info" data-toggle="modal" data-target="#cursos_diplomados">+ <i class="fas fa-list-ol"></i></button>
                                </div>
                                <div class="col-6 p-2 d-flex justify-content-center">
                                    <button class="btn btn btn-info" data-toggle="modal" data-target="#cursos_diplomados"><i class="fas fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-12 p-2 d-flex justify-content-center">
                                <div class="text-xs font-weight-bold text-warning  text-uppercase mb-1">Idiomas - computación</div>
                                </div>
                                <div class="col-6 p-2 d-flex justify-content-center">
                                    <button class="btn btn btn-warning" data-toggle="modal" data-target="#idioma_compu">+ <i class="fas fa-language"></i></button>
                                </div>
                                <div class="col-6 p-2 d-flex justify-content-center">
                                    <button class="btn btn btn-warning" data-toggle="modal" data-target="#idioma_compu"><i class="fas fa-eye"></i></button>
                                </div>
                            </div>
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
    <?php
        include 'conexion.php';
        $consulta="SELECT * FROM postulante where dni=$dni";
        $datos=mysqli_query($con,$consulta) or die(mysqli_error()); ;
        $row= mysqli_fetch_array($datos);
        $idpostulante=$row['idpostulante'];

        $consulta1="SELECT * FROM detalle_convocatoria where postulante_idpostulante=$idpostulante";
        $datos1=mysqli_query($con,$consulta1) or die(mysqli_error()); ;
        $row1= mysqli_fetch_array($datos1);
        $iddetalle_con=$row1['iddetalle_convocatoria'];

        $consulta2="SELECT * FROM datos_profesionales where datos_profesionales_detalles_con=$iddetalle_con";
        $datos2=mysqli_query($con,$consulta2) or die(mysqli_error()); ;
        $row2= mysqli_fetch_array($datos2);
    ?>
    <!--GUARDAR Profesion Modal-->
    <div class="modal fade bd-example-modal-lg" id="datos_profesionales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mis datos profesionales son:</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="procesos/guardar_datos_prof.php" method="POST">
            <div class="modal-body ">  
                <div class="form-row">
                    <input type="hidden" id="dni" name="dni" value="<?php echo $dni; ?>">
                    <input type="hidden" id="idpostulante" name="idpostulante" value="<?php echo $idpostulante; ?>">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Profesión</label>
                        <input type="text" class="form-control" id="profesion" name="profesion">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Fecha colegiatura</label>
                        <input type="date" class="form-control" id="fecha_cole" name="fecha_cole">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Lugar de colegiatura</label>
                        <input type="text" class="form-control" id="lugar_cole" name="lugar_cole">
                    </div>
                
                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Fecha de habilitación</label>
                        <input type="date" class="form-control" id="fech_habi" name="fech_habi">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputPassword4">N° de colegiatura</label>
                        <input type="text" class="form-control" id="num_cole" name="num_cole">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary" type="submit">Guardar</button>
            </div>
            </form>
        </div>
        </div>
    </div>

    <!--VER Profesion Modal-->
    <div class="modal fade bd-example-modal-lg" id="ver_datos_profesionales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Mis datos profesionales son:</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
        
            <form action="" method="POST">
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Profesión</label>
                        <input type="text" class="form-control" id="profesion" name="profesion" value="<?php echo $row2['profesion'];?>" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Fecha colegiatura</label>
                        <input type="date" class="form-control" id="fecha_cole" name="fecha_cole" value="<?php echo $row2['fecha_cole']; ?>" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Lugar de colegiatura</label>
                        <input type="text" class="form-control" id="lugar_cole" name="lugar_cole" value="<?php echo $row2['lugar_cole']; ?>" disabled>
                    </div>
                
                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Fecha de habilitación</label>
                        <input type="date" class="form-control" id="fech_habi" name="fech_habi" value="<?php echo $row2['fecha_habi']; ?>" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputPassword4">N° de colegiatura</label>
                        <input type="text" class="form-control" id="num_cole" name="num_cole" value="<?php echo $row2['nro_cole']; ?>" disabled>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Salir</button>
            </div>
            </form>
        </div>
        </div>
    </div>
    
    <!--GUARDAR Estudios superiores Modal-->
    <div class="modal fade bd-example-modal-xl" id="estudios_superiores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Estudios superiores</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="procesos/guardar_estudios_sup.php" method="POST">
                <div class="modal-body">
                    <div class="table-responsive">
                        <label>Estudios Superiores (Universitario - Tecnico)</label>
                        <input type="hidden" id="dni" name="dni" value="<?php echo $dni; ?>">
                        <input type="hidden" id="idpostulante" name="idpostulante" value="<?php echo $idpostulante; ?>">
                        <table class="table table-bordered" id="tabla-7">
                            <thead>
                            <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                <th scope="col">Centro Estudios</th>
                                <th scope="col">Especialidad</th>
                                <th scope="col">Fecha Inicio</th>
                                <th scope="col">Fecha Termino</th>
                                <th scope="col">Nivel Alcanzado</th>
                                <th scope="col">Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="fila-fija-7">
                                    <td><input type="text" name="centro_estu[]" class="form-control name_list" required/></td>
                                    <td><input type="text" name="especialidad[]"  class="form-control name_list" required/></td>
                                    <td><input type="date" name="fech_ini[]" class="form-control name_list" required/></td>
                                    <td><input type="date" name="fech_fin[]" class="form-control name_list" required/></td>
                                    <td>
                                        <select name="nivel[]" class="form-control" id="nivel[]" required>
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
                    <div class="row d-flex justify-content-center">
                        <div class="form-inline p-2">
                            <button id="adicional-7" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
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

    <!-- Ver superiores Modal-->

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
                                        <td><input type="text" name="centro_estu[]" class="form-control name_list" required/></td>
                                        <td><input type="text" name="especialidad[]"  class="form-control name_list" required/></td>
                                        <td>
                                            <select name="tipo_estu[]" class="form-control" id="tipo_estu[]" required>
                                                <option value="" disabled selected>Elegir</option>
                                                <option value="MAESTRIA">Maestria </option>
                                                <option value="DOCTORADO">Doctorado</option>
                                            </select>
                                        </td>
                                        <td><input type="date" name="fech_ini[]" class="form-control name_list" required/></td>
                                        <td><input type="date" name="fech_fin[]" class="form-control name_list" required/></td>
                                        <td>
                                            <select name="nivel[]" class="form-control" id="nivel[]" required>
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

        <!-- VER Estudios Postgrado Modal-->
        <div class="modal fade bd-example-modal-xl" id="ver_estudios_postgrado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Estudios Postgrado</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form>
                <div class="modal-body">
                    <div class="table-responsive">
                        <label>Estudios Postgrado (Maestrias - Doctorados)</label> 
                        <table class="table table-bordered" id="tabla-8">
                            <thead>
                            <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                <th scope="col-3">Centro Estudios</th>
                                <th scope="col-3">Especialidad</th>
                                <th scope="col-2">Fecha Inicio</th>
                                <th scope="col-2">Fecha Termino</th>
                                <th scope="col-1">Nivel Alcanzado</th>
                                <th scope="col-1">Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="fila-fija-8">
                                    <td><input type="text" name="centro_estu[]" class="form-control name_list" /></td>
                                    <td><input type="text" name="especialidad[]"  class="form-control name_list" /></td>
                                    <td><input type="date" name="fech_ini[]" class="form-control name_list"/></td>
                                    <td><input type="date" name="fech_fin[]" class="form-control name_list"/></td>
                                    <td>
                                        <select name="nivel[]" class="form-control" id="cargo">
                                            <option value="" disabled selected>Elegir</option>
                                            <option value="Magister">Magister</option>
                                            <option value="Doctorado">Doctorado</option>
                                            <option value="Egresado">Egresado</option>
                                            <option value="Estudiante">Estudiante</option>
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
                            <th scope="col">Especialidad</th>
                            <th scope="col">Horas</th>
                            <th scope="col">Fecha Inicio</th>
                            <th scope="col">Fecha Termino</th>
                            <th scope="col">Nivel Alcanzado</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="fila-fija-9">
                                <td><input type="text" name="centro_estu[]" class="form-control name_list" /></td>
                                <td><input type="text" name="materia[]"  class="form-control name_list" /></td>
                                <td><input type="text" name="horas[]" class="form-control name_list" /></td>
                                <td><input type="date" name="fech_ini[]" class="form-control name_list"/></td>
                                <td><input type="date" name="fech_fin[]" class="form-control name_list"/></td>
                                <td>
                                    <select name="nivel[]" class="form-control" id="cargo">
                                        <option value="" disabled selected>Elegir</option>
                                        <option value="EGRESADO">Egresado</option>
                                        <option value="ESTUDIANTE">Estudiante</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tipo[]" class="form-control" id="cargo">
                                        <option value="" disabled selected>Elegir...</option>
                                        <option value="DIPLOMADO">Diplomado</option>
                                        <option value="CURSO">Curso</option>
                                        <option value="SEMINARIO">Seminario</option>
                                    </select>
                                </td>
                                <td class="eliminar"><input type="button" class="btn btn-danger" value=" - "></td>
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

        <!-- Idiomas y curso computacion-->
        <div class="modal fade bd-example-modal-lg" id="idioma_compu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Idiomas / Computación</h5>              
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <form action="procesos/guardar_idiomas.php" method="POST">
                <div class="modal-body">
                    <div class="form-group row">
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
                                        <td><input type="text" name="idioma_comp[]" placeholder="Inglés, Portugues, Computación..." class="form-control name_list" /></td>
                                        <td>
                                            <select name="nivel[]" class="form-control">
                                                <option value="" disabled selected>Elegir</option>
                                                <option value="BASICO">Básico</option>
                                                <option value="INTERMEDIO">Intermedio</option>
                                                <option value="AVANZADO">Avanzado</option>
                                            </select>
                                        </td>
                                        <td class="eliminar"><input type="button" class="btn btn-danger" value=" - "></td>
                                    </tr>
                                </tdody>
                            </table>
                        </div> 
                    </div>
                    <div class="row d-flex justify-content-center">
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
