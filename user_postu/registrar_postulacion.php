<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Registrar postulación DIRESA TACNA</title>


  <!-- Custom fonts for this template -->
  <link rel="icon" type="image/png" href="img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <script type="text/javascript" src="vendor/sweetalert/sweetalert2.min.js"></script>
  <script type="text/javascript" src="vendor/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="vendor/sweetalert/sweetalert2.min.css">
  <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php
    include 'conexion.php';

    include 'funcs/mcript.php';

    $dato_desencriptado = $_GET['dni'];
    $dni = $desencriptar($dato_desencriptado);

    $sql2 = "SELECT * FROM usuarios where dni=$dni";
    $datos = mysqli_query($con, $sql2) or die(mysqli_error($datos));;
    $fila = mysqli_fetch_array($datos);

    $sql3 = "SELECT * FROM postulante where dni=$dni";
    $datos2 = mysqli_query($con, $sql3) or die(mysqli_error($datos2));;
    $fila2 = mysqli_fetch_array($datos2);

    $idpos =  $fila2['idpostulante'];

    $idcon = $_GET['idcon'];
    $sql4 = "SELECT * FROM convocatoria where idcon=$idcon";
    $datos3 = mysqli_query($con, $sql4) or die(mysqli_error($datos3));;
    $fila3 = mysqli_fetch_array($datos3);
    $idconn =  $fila3['tipo_con'];

    $idpersonal = $_GET['idcargo'];

    // $sql5 = "SELECT * FROM convocatoria INNER JOIN ubicacion
    //                 ON convocatoria.direccion_ejec_iddireccion = ubicacion.iddireccion WHERE idcon=$idcon";
    // $datos4 = mysqli_query($con, $sql5) or die(mysqli_error($datos4));;
    // $fila4 = mysqli_fetch_array($datos4);
    // $idpersonal = $fila4['idpersonal'];

    $sql5 = "SELECT * FROM sistema_seleccion.personal_req INNER JOIN sistema_seleccion.cargo
                    ON personal_req.cargo_idcargo = cargo.idcargo INNER JOIN sistema_seleccion.ubicacion 
                    ON personal_req.personal_req_idubicacion = ubicacion.iddireccion WHERE idpersonal='$idpersonal'";
    $datos4 = mysqli_query($con, $sql5) or die(mysqli_error($datos4));;
    $fila4 = mysqli_fetch_array($datos4);

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
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">RESUMEN DE MI POSTULACIÓN</h6>
            </div>
            <div class="card-body">
              <?php
              $dni = $_GET['dni'];
              $idcargo = $_GET['idcargo'];
              $idcon = $_GET['idcon'];
              ?>
              <form action="procesos/guardar_postulacion.php" method="POST">
                <div class="form-group row d-flex justify-content-center">
                  <label class="col-lg-2 col-md-4 col-form-label text-success">Fecha de inscripción:</label>
                  <div class="col-lg-3 col-md-4">
                    <input type="text" class="form-control" value="<?php echo $hoy = date('Y-m-d'); ?>" disabled>
                  </div>
                </div>
                <div class="form-group row">
                  <input type="hidden" class="form-control" name="dni" id="dni" value="<?php echo $dni; ?>">
                  <input type="hidden" class="form-control" name="idcon" id="idcon" value="<?php echo $idcon; ?>">
                  <input type="hidden" class="form-control" name="idpostulante" id="idpostulante" value="<?php echo $idpos; ?>">
                  <input type="hidden" class="form-control" name="idpersonal" id="idpersonal" value="<?php echo $idpersonal; ?>">
                  <div class="col-md-2 col-sm-6">
                    <label for="disabled-input">Tipo de convocatoria</label>
                    <input type="text" class="form-control" name="idconn" id="idconn" value="<?php echo $fila3['tipo_con'] ?>" disabled>
                  </div>
                  <div class="col-md-2 col-sm-6">
                    <label for="disabled-input">Nro de convocatoria</label>
                    <input type="text" class="form-control" value="<?php echo $fila3['num_con'] . "-" . $fila3['anio_con'] ?>" disabled>
                  </div>
                  <div class="col-md-2 col-sm-6">
                    <label for="disabled-input">Fecha de inicio</label>
                    <input type="text" class="form-control" value="<?php echo $fila3['fech_ini'] ?>" disabled>
                  </div>
                  <div class="col-md-2 col-sm-6">
                    <label for="disabled-input">Fecha término</label>
                    <input type="text" class="form-control" value="<?php echo $fila3['fech_term'] ?>" disabled>
                  </div>
                  <div class="col-md-2 col-sm-6">
                    <label for="disabled-input">Estado</label>
                    <input type="text" class="form-control" value="<?php echo $fila3['estado'] ?>" disabled>
                  </div>
                </div>
                <hr class="sidebar-divider d-none d-md-block">
                <div class="row">
                  <div class="col-md-3 col-sm-12 form-group">
                    <label for="disabled-input">Cargo a postular:</label>
                    <input type="text" class="form-control" value="<?php echo $fila4['cargo'] ?>" disabled>
                  </div>
                  <div class="col-md-2 col-sm-12 form-group">
                    <label for="disabled-input">Cantidad requerida:</label>
                    <input type="text" class="form-control" value="<?php echo $fila4['cantidad'] ?>" disabled>
                  </div>
                  <div class="col-md-3 col-sm-12 form-group">
                    <label for="disabled-input">Remuneración del cargo:</label>
                    <input type="text" class="form-control" value="<?php echo $fila4['remuneracion'] ?>" disabled>
                  </div>
                  <div class="col-md-3 col-sm-12 form-group">
                    <label for="disabled-input">Fuente</label>
                    <input type="text" class="form-control" value="<?php echo $fila4['fuente_finac'] ?>" disabled>
                  </div>
                  <div class="col-md-1 col-sm-12 form-group">
                    <label for="disabled-input">Meta</label>
                    <input type="text" class="form-control" value="<?php echo $fila4['meta'] ?>" disabled>
                  </div>
                  <div class="col-md-12 col-sm-12 form-group">
                    <label for="disabled-input">Dirección ejecutra</label>
                    <input type="text" style="font-size: 14px;" class="form-control" value="<?php echo $fila4['direccion_ejec'] . " - " . $fila4['equipo_ejec'] ?>" disabled>
                  </div>
                </div>
                <hr class="sidebar-divider d-none d-md-block">
                <div class="form-group row">
                  <!-- <div class="col-md-6 col-sm-12">
                    <img src="img/boleta.jpg" style="width:100%; height:auto;" alt="Boleta de ejemplo para el llenado del código">
                  </div> -->
                  <!-- <div class="col-md-6 col-sm-6"> -->
                  <!-- <div class="row"> -->

                  <div class="col-12 m-2 d-flex justify-content-center">
                    <button type="submit" id="button1" class="btn btn-info btn-lg"><i class="fas fa-briefcase"></i> POSTULAR!</button>
                  </div>
                  <!-- </div> -->
                  <!-- </div> -->
                </div>

              </form>
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
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

  <script>
    jQuery(document).ready(function() {
      jQuery(".standardSelect").chosen({
        disable_search_threshold: 10,
        no_results_text: "Oops, nothing found!",
        width: "100%"
      });
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function() {


      $("#button1").click(function() {
        swal({
          title: 'Registro con exito!',
          //text:"Hola, estamos probando Sweet Alert 2",
          type: 'success',
          timer: 10000
        })

      });

      $("#button2").click(function() {
        swal({
          title: 'Boton 2!',
          text: "Esta es la opcion 2",
          type: 'warning',
          showConfirmButton: false,
          timer: 1000
        })

      });

      $("#button3").click(function() {
        swal({
          title: 'Boton 3!',
          text: "Esta es la opcion 3",
          type: 'error',
          showConfirmButton: false,
          timer: 1000,
          position: 'bottom-end'
        })
      });

    })
  </script>

</body>

</html>