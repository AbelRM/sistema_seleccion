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
        ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- Content Row -->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title text-danger text-center font-weight-bold">BIENVENIDO AL SISTEMA DE SELECCIÓN - DIRESA TACNA!</h5>
                  <p class="card-text">Para tener una buena experiencia en el ingreso de datos para su postulación, debe seguir los siguientes pasos:</p>
                  <dl class="row">
                    <dt class="col-sm-1 text-center">1.</dt>
                    <dd class="col-sm-11">Click en "Mis convocatorias"</dd>

                    <dt class="col-sm-1 text-center">2.</dt>
                    <dd class="col-sm-11">Ahora elegir "Postular", allí del listado deberá buscar y elegir el "N° CONVOCATORIA" que usted va a postular.</dd>

                    <dt class="col-sm-1 text-center">3.</dt>
                    <dd class="col-sm-11">Una vez elegido y haber hecho el proceso de postulación, el sistema le permitirá llenar sus datos personales como académicos según el puesto elegido.</dd>

                    <dt class="col-sm-1 text-center">4.</dt>
                    <dd class="col-sm-11">Todos los datos ingresados deben ser validados una vez pase los filtros de evaluación de curriculum vitae y entrevista, en caso se compruebe datos falsos será betado de toda convocatoria.</dd>
                  </dl>
                  <div class="row d-flex justify-content-center">
                    <a href="nueva_convocatoria.php?dni=<?php echo $dato_desencriptado ?>" class="btn btn-primary">EMPEZAR!</a>
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

</body>

</html>
