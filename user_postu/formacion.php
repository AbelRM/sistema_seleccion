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
            <div class="form-row d-flex justify-content-center">
                <div class="form-group col-md-6">
                    <label for="inputState">Elegir categoría</label>
                    <select name="SelectOptions" id="SelectOptions" class="form-control">
                        <option selected>Elegir...</option>
                        <option value="titulos-1" style="color:red; font-weight:600;">PROFESIONAL DE LA SALUD</option>
                        <option value="titulos-2" style="color:#1cc88a; font-weight:600;">OTROS PROFESIONALES</option>
                        <option value="titulos-3" style="color:#1cc88a; font-weight:600;">ASISTENTE ADMINISTRATIVO</option>
                        <option value="titulos-4" style="color:red; font-weight:600;">TÉCNICO EN ENFERMERIA</option>
                        <option value="titulos-5" style="color:#1cc88a; font-weight:600;">TÉCNICO ADMINISTRATIVO</option>
                        <option value="formulario-2" style="color:#1cc88a; font-weight:600;">TÉCNICO EN COMUNICACIONES</option>
                        <option value="formulario-2" style="color:#1cc88a; font-weight:600;">SECRETARIA</option>
                        <option value="formulario-2" style="color:#1cc88a; font-weight:600;">TÉCNICO EN INFORMÁTICA</option>
                        <option value="formulario-2" style="color:#1cc88a; font-weight:600;">CHOFER</option>
                        <option value="formulario-2" style="color:#1cc88a; font-weight:600;">VIGILANTE</option>
                        <option value="formulario-2" style="color:#1cc88a; font-weight:600;">TRABAJADOR DE LIMPIEZA</option>
                        <option value="formulario-2" style="color:#1cc88a; font-weight:600;">TRABAJADOR DE SERVICIOS</option>
                    </select>
                </div>
            </div>
            <div class="grupo-formularios">
                <!-- FORMULARIO MICRORED -->
                <div class="form-row titulos d-flex justify-content-center m-2">
                    <div class="col-md-8">
                        <div class="card border-danger titulos">
                            <div class="card-header titulos">
                                <h5 class="titulo-card">Título y/o grado alcanzado (PROFESIONALES DE LA SALUD)</h5>
                            </div>
                            <div class="card-body titulos">
                                <div class="form-row">
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Título profesional universitario</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Título de Especialidad</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Egresado de especialidad</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Grado de Maestría (acreditado *)</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Constancia de Egresado de Maestría</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Grado de Doctorado (acreditado *)</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Constancia de Egresado de Doctorado (acreditad)</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row titulos-3 d-flex justify-content-center m-2">
                    <div class="col-md-8">
                        <div class="card border-danger titulos-1">
                            <div class="card-header titulos-1">
                                <h5 class="titulo-card">Título y/o grado alcanzado (ASISTENTE ADMINISTRATIVO)</h5>
                            </div>
                            <div class="card-body titulos-1">
                                <div class="form-row">
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Título profesional universitario</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Título de Especialidad</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Egresado de especialidad</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Grado de Maestría (acreditado *)</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Constancia de Egresado de Maestría</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Grado de Doctorado (acreditado *)</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Constancia de Egresado de Doctorado (acreditad)</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row titulos-2 d-flex justify-content-center m-2">
                    <div class="col-md-8">
                        <div class="card border-danger titulos-2">
                            <div class="card-header titulos-2">
                                <h5 class="titulo-card">Título y/o grado alcanzado (OTROS PROFESIONALES)</h5>
                            </div>
                            <div class="card-body titulos-2">
                                <div class="form-row">
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Título profesional universitario</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Título de Especialidad</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Grado de Bachiller</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Egresado de especialidad</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Grado de Maestría (acreditado *)</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Constancia de Egresado de Maestría</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Grado de Doctorado (acreditado *)</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Constancia de Egresado de Doctorado (acreditad)</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row titulos-4 d-flex justify-content-center m-2">
                    <div class="col-md-8">
                        <div class="card border-danger titulos-1">
                            <div class="card-header titulos-1">
                                <h5 class="titulo-card">TÉCNICO EN ENFERMERIA</h5>
                            </div>
                            <div class="card-body titulos-1">
                                <div class="form-row">
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Título de Instituto Superior Tecnológico (acreditado)</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row titulos-5 d-flex justify-content-center m-2">
                    <div class="col-md-8">
                        <div class="card border-danger titulos-1">
                            <div class="card-header titulos-1">
                                <h5 class="titulo-card">TÉCNICO ADMINISTRATIVO</h5>
                            </div>
                            <div class="card-body titulos-1">
                                <div class="form-row">
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Egresado Universitario</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Título de Instituto Superior Tecnológico</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row titulos-1 d-flex justify-content-center m-2">
                    <div class="col-md-8">
                        <div class="card border-danger titulos-1">
                            <div class="card-header titulos-1">
                                <h5 class="titulo-card">AUXILIAR ADMINISTRATIVO</h5>
                            </div>
                            <div class="card-body titulos-1">
                                <div class="form-row">
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Secundaria completa</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row titulos-1 d-flex justify-content-center m-2">
                    <div class="col-md-8">
                        <div class="card border-danger titulos-1">
                            <div class="card-header titulos-1">
                                <h5 class="titulo-card">AUXILIAR ADMINISTRATIVO</h5>
                            </div>
                            <div class="card-body titulos-1">
                                <div class="form-row">
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Secundaria completa</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                            <select class="form-control">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
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




</body>

</html>
