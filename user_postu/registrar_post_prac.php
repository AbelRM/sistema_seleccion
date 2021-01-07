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

  <title>REGISTRAR POSTULACIÓN DE PRACTICAS - SISTEMA SELECCIÓN DIRESA TACNA</title>


  <!-- Custom fonts for this template -->
  <link rel="icon" type="image/png" href="img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="vendor/sweetalert2.min.css">

  <!-- <link rel="stylesheet" type="text/css" href="vendor/sweetalert/sweetalert2.min.css">
  <script type="text/javascript" src="vendor/sweetalert/sweetalert2.min.js"></script> -->
  <!-- <script type="text/javascript" src="vendor/jquery.min.js"></script> -->

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

    $sql3 = "SELECT * FROM postulante where dni=$dato_desencriptado";
    $datos2 = mysqli_query($con, $sql3) or die(mysqli_error($datos2));;
    $fila2 = mysqli_fetch_array($datos2);
    $idpostulante =  $fila2['idpostulante'];

    $idpracticas = $_GET['idpracticas'];
    $sql4 = "SELECT * FROM practicas where idpracticas=$idpracticas";
    $datos3 = mysqli_query($con, $sql4) or die(mysqli_error($datos3));;
    $fila3 = mysqli_fetch_array($datos3);

    $idpracticantes_req = $_GET['idpracticantes_req'];

    $sql5 = "SELECT * FROM practicantes_req INNER JOIN ubicacion ON practicantes_req.practicantes_req_idubicacion= ubicacion.iddireccion  WHERE idpracticantes_req='$idpracticantes_req'";
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
              <h6 class="m-0 font-weight-bold text-primary">RESUMEN DE MI POSTULACIÓN PARA PRACTICANTE</h6>
            </div>
            <div class="card-body">
              <form id="frmajax" method="POST">

                <div class="form-group row d-flex justify-content-center">
                  <div class="col-md-12">
                    <h6 class="m-0 font-weight-bold text-danger">Datos de la convocatoria.</h6>
                    <hr class="sidebar-divider">
                  </div>
                  <label class="col-lg-2 col-md-4 col-sm-4  col-form-label text-success">Fecha de inscripción:</label>
                  <div class="col-lg-3 col-md-4 col-sm-4">
                    <input type="text" class="form-control" value="<?php date_default_timezone_set('America/Lima');
                                                                    echo $hoy = date('Y-m-d H:i:s'); ?>" disabled>
                  </div>
                </div>
                <div class="form-group row">
                  <input type="hidden" class="form-control" name="dni" value="<?php echo $dni; ?>">
                  <input type="hidden" class="form-control" name="idcon" value="<?php echo $idpracticas; ?>">
                  <input type="hidden" class="form-control" name="idpostulante" value="<?php echo $idpostulante; ?>">
                  <input type="hidden" class="form-control" name="idpersonal" value="<?php echo $idpracticantes_req; ?>">

                  <div class="col-md-2 col-sm-6">
                    <label for="disabled-input">Nro de convocatoria</label>
                    <input type="text" class="form-control" value="<?php echo $fila3['num_convoc'] . "-" . $fila3['anio_convoc'] ?>" disabled>
                  </div>
                  <div class="col-md-2 col-sm-6">
                    <label for="disabled-input">Fecha de inicio</label>
                    <input type="text" class="form-control" value="<?php echo $fila3['fech_inicio'] ?>" disabled>
                  </div>
                  <div class="col-md-2 col-sm-6">
                    <label for="disabled-input">Fecha término</label>
                    <input type="text" class="form-control" value="<?php echo $fila3['fech_termino'] ?>" disabled>
                  </div>
                  <div class="col-md-2 col-sm-6">
                    <label for="disabled-input">% Eva. curricular</label>
                    <input type="text" class="form-control" value="<?php echo $fila3['porcen_eva_cu'] ?>%" disabled>
                  </div>
                  <div class="col-md-2 col-sm-6">
                    <label for="disabled-input">% Eva. entrevista</label>
                    <input type="text" class="form-control" value="<?php echo $fila3['porce_entrevista'] ?>%" disabled>
                  </div>
                  <div class="col-md-2 col-sm-6">
                    <label for="disabled-input">Estado convocatoria</label>
                    <input type="text" class="form-control" value="<?php echo $fila3['estado_con'] ?>" disabled>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h6 class="m-0 font-weight-bold text-danger">Datos del practicante requerido.</h6>
                    <hr class="sidebar-divider">
                  </div>
                  <hr class="sidebar-divider d-none d-md-block">
                  <div class="col-md-2 col-sm-12 form-group">
                    <label for="disabled-input">Tipo practicante:</label>
                    <input type="text" style="font-size:13px" class="form-control" value="<?php echo $fila4['tipo_practicante'] ?>" disabled>
                  </div>
                  <div class="col-md-2 col-sm-12 form-group">
                    <label for="disabled-input">Nivel estudio:</label>
                    <input type="text" style="font-size:13px" class="form-control" value="<?php echo $fila4['nivel_estudio'] ?>" disabled>
                  </div>
                  <div class="col-md-4 col-sm-12 form-group">
                    <label for="disabled-input">Carrera profesional:</label>
                    <input type="text" style="font-size:13px" class="form-control" value="<?php echo $fila4['carrera_prof'] ?>" disabled>
                  </div>
                  <div class="col-md-2 col-sm-12 form-group">
                    <label for="disabled-input">Cantidad requerida:</label>
                    <input type="text" class="form-control" value="<?php echo $fila4['cantidad_req'] ?>" disabled>
                  </div>
                  <div class="col-md-2 col-sm-12 form-group">
                    <label for="disabled-input">Remuneración:</label>
                    <input type="text" class="form-control" value="<?php echo $fila4['remuneracion'] ?>" disabled>
                  </div>
                  <div class="col-md-3 col-sm-12 form-group">
                    <label for="disabled-input">Fuente Financ.</label>
                    <input type="text" style="font-size:13px" class="form-control" value="<?php echo $fila4['fuente_finac'] ?>" disabled>
                  </div>
                  <div class="col-md-1 col-sm-12 form-group">
                    <label for="disabled-input">Meta</label>
                    <input type="text" class="form-control" value="<?php echo $fila4['meta'] ?>" disabled>
                  </div>
                  <div class="col-md-12 col-sm-12 form-group">
                    <label for="disabled-input">Dirección ejecutora</label>
                    <input type="text" style="font-size: 13px;" class="form-control" value="<?php echo $fila4['direccion_ejec'] . " - " . $fila4['equipo_ejec'] ?>" disabled>
                  </div>
                </div>
                <hr class="sidebar-divider d-none d-md-block">
                <div class="form-group row">
                  <div class="col-md-3 d-flex justify-content-start m-2">
                    <a href="cargo_prac.php?idpracticas=<?php echo $idpracticas ?>&dni=<?php echo $dni ?>" type="button" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-circle-left"></i> Retroceder</a>
                  </div>
                  <div class="col-md-6 d-flex justify-content-center m-2">
                    <button id="button1" class="btn btn-info btn-lg"><i class="fas fa-briefcase"></i> POSTULAR</button>
                  </div>
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
  <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
  <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
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
  <script src="vendor/sweetalert2.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->

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
      $('#button1').click(function() {
        var datos = $('#frmajax').serialize();
        $.ajax({
          type: "POST",
          url: "procesos/guardar_postulacion_prac.php",
          data: datos,
          success: function(r) {
            console.log("Mensaje: ", r);
            const respuesta = JSON.parse(r);
            console.log("JSON: ", respuesta);
            console.log("Mi r: ", respuesta.r);
            if (respuesta.r == 1) {
              Swal.fire({
                title: 'REGISTRADO CORRECTAMENTE',
                text: respuesta.mensaje,
                icon: 'success',
                confirmButtonText: 'Aceptar'
              }).then(function() {
                window.location = "mispostulaciones_prac.php?dni=" + respuesta.dni;
              });
            } else {
              Swal.fire({
                title: 'ERROR AL POSTULAR',
                text: respuesta.mensaje,
                icon: 'error',
                confirmButtonText: 'Aceptar',
              });
            }
          }
        });

        return false;
      });
    });
  </script>

</body>

</html>