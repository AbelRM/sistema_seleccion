<?php
include 'conexion.php';
include '../funcs/mcript.php';
session_start();
if (empty($_SESSION['active'])) {
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

  <title>INGRESO DE DATOS PARA PROFESIONALES - SISTEMA DE SELECCIÓN DIRESA TACNA</title>

  <!-- Custom fonts for this template -->
  <link rel="icon" type="image/png" href="img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php
    $dni = $_GET['dni'];
    $dato_desencriptado = SED::decryption($dni);

    $sql2 = "SELECT * FROM usuarios where dni=$dato_desencriptado";
    $datos = mysqli_query($con, $sql2) or die(mysqli_error($datos));;
    $fila = mysqli_fetch_array($datos);
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
          <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">INGRESO DE DATOS PROFESIONALES</h6>
            </div>
            <div class="card-body">

              <div class="row d-flex justify-content-center m-2">
                <div class="col-lg-4 col-md-8 col-sm-12">
                  <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12 p-2 d-flex justify-content-center">
                          <h5 class="font-weight-bold text-success text-uppercase mb-1 text-center">Estudios de formación</h5>
                        </div>
                        <div class="col-md-12 p-2">
                          <div class="col-md-12 d-2 d-flex justify-content-center">
                            <a href="formacion.php?dni=<?php echo $dni ?>" type="button" class="btn btn-success"><i class="far fa-hand-pointer"></i> Elegir</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-8 col-sm-12">
                  <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12 p-2 d-flex justify-content-center">
                          <h5 class="font-weight-bold text-warning text-uppercase mb-1 text-center">Capacitaciones</h5>
                        </div>
                        <div class="col-md-12 d-2 d-flex justify-content-center">
                          <a href="capacitacion.php?dni=<?php echo $dni ?>" type="button" class="btn btn-warning"><i class="far fa-hand-pointer"></i> Elegir</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-8 col-sm-12">
                  <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12 p-2 d-flex justify-content-center">
                          <h5 class="font-weight-bold text-info text-uppercase mb-1 text-center">Experiencia laboral</h5>
                        </div>
                        <div class="col-md-12 d-2 d-flex justify-content-center">
                          <a href="exp_laboral.php?dni=<?php echo $dni ?>" type="button" class="btn btn-info"><i class="far fa-hand-pointer"></i> Elegir</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row d-flex justify-content-center m-3">
                <a href="elegir_tipo_convoc.php?dni=<?php echo $dni ?>" type="button" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i> Retroceder</a>
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
          <h5 class="modal-title" id="exampleModalLabel">¿Deseas cerrar sesión?</h5>
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
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>