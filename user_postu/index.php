<?php
include 'conexion.php';
include 'funcs/mcript.php';
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

    $dni = $_GET['dni'];
    $dato_desencriptado = $_GET['dni'];
    // $dni = $desencriptar($dato_desencriptado);

    $sql = "SELECT * FROM usuarios where dni=$dni";
    $datos = mysqli_query($con, $sql) or die(mysqli_error($sql));;
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

          <!-- Content Row -->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title text-danger text-center font-weight-bold">BIENVENIDO AL SISTEMA DE SELECCIÓN - DIRESA TACNA!</h5>
                  <p class="card-text">Para tener una buena experiencia en el ingreso de datos para su postulación, debe seguir los siguientes pasos:</p>
                  <dl class="row">
                    <dt class="col-sm-1 text-center">1.</dt>
                    <dd class="col-sm-11">Si desea actualizar sus datos personales así como la declaración jurada podría ingresar a <span class="text-danger font-weight-bold">"Datos personales"</span> y seleccionar<span class="text-success font-weight-bold">"Actualizar ficha"</span>, o en caso desea generar la ficha en formato PDF, elegir la opción <span class="text-success font-weight-bold">"Ver ficha"</span>.</dd>
                    <dt class="col-sm-1 text-center">2.</dt>
                    <dd class="col-sm-11">Para poder postular debes antes llenar sus <span class="text-danger font-weight-bold">"Datos profesionales"</span> que comprende tres secciones <span class="text-success font-weight-bold">"Estudio de formación"</span>, <span class="text-success font-weight-bold">"Capacitaciones"</span> y <span class="text-success font-weight-bold">"Experiencia Laboral"</span>.
                      <ul>
                        <li type="square">En <span class="text-success font-weight-bold">"Estudios de formación"</span> solo se debe ingresar un dato porque este será comparado con el puesto al que usted desea postular, en caso desea postular para un posterior CAS debe dar clic al botón de <a type="button" class="btn btn-success btn-sm m-1"><i class="fa fa-edit"></i> Editar</a> para poder <span class="text-warning font-weight-bold">actualizar</span> su formación académica.</li>
                        <li type="square">Para <span class="text-success font-weight-bold">"Capacitaciones"</span> existen 3 sub secciones:
                          <div class="row">
                            <div class="col-4 d-flex justify-content-start">
                              <div class="list-group" id="list-tab" role="tablist" style="font-size:12px;">
                                <a class="list-group-item list-group-item-action active" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Estudios Postgrado</a>
                                <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Diplomados - Cursos</a>
                                <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Idioma - Computación</a>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li type="square">Y para la última sección de <span class="text-success font-weight-bold">"Experiencia Laboral"</span> existen dos opciones a elegir <span class="text-primary font-weight-bold">"PROFESIONAL Y TÉCNICO ASISTENCIAL DE SALUD"</span> y <span class="text-primary font-weight-bold">"OTROS PROFESIONALES, TÉCNICOS Y AUXILIARES"</span> que usted debe seleccionar según el grupo profesional que usted pertenece. Porque para cada tipo existen 3 sub secciones para llenar su experiencia laboral según el título que muestra.</li>
                      </ul>

                    </dd>
                    <dt class="col-sm-1 text-center">3.</dt>
                    <dd class="col-sm-11">Para poder postular a una convocatoria debe dar clic a la opción <span class="text-danger font-weight-bold">"Postular"</span>, allí de las dos opciones:
                      <ul>
                        <li type="square">La primera <span class="text-success font-weight-bold">"Postular aquí"</span> usted deberá seleccionar primero la convocatoria <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"></i> Postular</button> a postular, para posteriormente elegir el personal requerido a postular
                          <button type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil-alt"></i> Elegir</button> y por último, luego de verificar que estamos en la convocatoria elegida con el cargo seleccionado y tener los requerimientos requeridos, dar clic a <button class="btn btn-info btn-sm"><i class="fas fa-briefcase"></i> POSTULAR</button> para que el sistema evalue si cumples con lo requerido, en caso sea correcto te direccionará la sección de <span class="text-success font-weight-bold">"Mis postulaciones"</span>.</li>
                        <li type="square">En <span class="text-success font-weight-bold">"Mis postulaciones"</span> encontraré un listado de las convocatorias y el cargo seleccionado.</li>
                      </ul>
                    </dd>

                    <dt class="col-sm-1 text-center">4.</dt>
                    <dd class="col-sm-11">Todos los datos ingresados deben ser validados una vez pase los filtros de evaluación de curriculum vitae y entrevista, en caso se compruebe datos falsos será betado de toda convocatoria durante 1 año.</dd>
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