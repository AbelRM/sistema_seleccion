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

  <title>Listado de personal requerido - DIRESA TACNA</title>

  <!-- Custom fonts for this template -->
  <link rel="icon" type="image/png" href="img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="vendor/sweetalert2.min.css">

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
    //include 'modal_ver_convocatoria.php';
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
              <h6 class="m-0 font-weight-bold text-primary">PRACTICANTE REQUERIDO DE LA CONVOCATORIA</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                      <th>N°</th>
                      <th style="display: none;">id</th>
                      <th>Cargo</th>
                      <th>Financiero</th>
                      <th>Dirección ejecutora</th>
                      <th>Requerimietos</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $idpracticas = $_GET['idpracticas'];
                    $sql = "SELECT * FROM practicantes_req INNER JOIN ubicacion ON practicantes_req.practicantes_req_idubicacion= ubicacion.iddireccion INNER JOIN carrera ON practicantes_req.id_carrera_req = carrera.idcarrera WHERE conv_idpracticas = $idpracticas";
                    $query = mysqli_query($con, $sql);
                    $i = 1;
                    if (mysqli_num_rows($query) > 0) {
                      while ($row = mysqli_fetch_array($query)) {
                        $idpersonal = $row['idpracticantes_req'];
                    ?>
                        <tr style="background-color: #8287e061;">
                          <td style="font-size: 14px; font-weight:900; text-align: center"><?php echo $i ?></td>
                          <td style="font-size: 12px; display:none"><?php echo $idpersonal ?></td>
                          <td style="font-size: 12px;">
                            <small style="font-weight:700; font-size: 14px;">Tipo practicante: </small><?php echo $row['tipo_practicante'] ?><br>
                            <small style="font-weight:700; font-size: 14px;">Carrera requerida: </small><?php echo $row['nomb_carrera'] ?><br>
                            <small style="font-weight:700; font-size: 14px;">Cantidad requerida: </small><?php echo $row['cantidad_req'] ?>
                          </td>
                          <td style="font-size: 12px;">
                            <small style="font-weight:700; font-size: 14px;">Fuente finac.: </small><?php echo $row['fuente_finac'] ?><br>
                            <small style="font-weight:700; font-size: 14px;">Meta: </small><?php echo $row['meta'] ?>
                            <small style="font-weight:700; font-size: 14px;">Remuneracion: </small>S/.<?php echo $row['remuneracion'] ?>
                          </td>
                          <td style="font-size: 12px;">
                            <small style="font-weight:700; font-size: 14px;">Dirección Ejecutora: </small><?php echo $row['direccion_ejec'] . " - " . $row['equipo_ejec'] ?>
                          </td>
                          <td style="font-size: 12px;">
                            <small style="font-weight:700; font-size: 14px;">Nivel estudio: </small><?php echo $row['nivel_estudio'] ?><br>
                            <?php
                            if ($row['nivel_estudio'] == 'ESTUDIANTE') {
                              echo '<small style="font-weight:700; font-size: 14px;">Ciclo requerido: </small>' . $row['ciclo_requerido'];
                            } else {
                            }
                            ?>
                          </td>
                          <td>
                            <form id="frmajax" method="POST">
                              <?php
                              $consul_postu = "SELECT * FROM postulante where dni=$dato_desencriptado";
                              $datos2 = mysqli_query($con, $consul_postu) or die(mysqli_error($datos2));;
                              $fila2 = mysqli_fetch_array($datos2);

                              $idpostulante = $fila2['idpostulante'];
                              ?>
                              <input type="hidden" class="form-control" name="dni" value="<?php echo $dni; ?>">
                              <input type="hidden" class="form-control" name="idcon" value="<?php echo $idpracticas; ?>">
                              <input type="hidden" class="form-control" name="idpostulante" value="<?php echo $idpostulante; ?>">
                              <input type="hidden" class="form-control" name="idpersonal" value="<?php echo $idpersonal; ?>">
                              <button id="button1" class="btn btn-info btn-lg"><i class="fas fa-briefcase"></i> POSTULAR</button>
              </div>
              </form>

              </td>
              </tr>
          <?php
                        $i++;
                      }
                    } else {
                      echo "<tr><td colspan='6' class='text-center text-danger font-weight-bold' >NO HAY PERSONAL REQUERIDO</td></tr>";
                    }
          ?>
          </tbody>
          </table>
            </div>
            <div class="row d-flex justify-content-center m-3">
              <a href="lista_conv_pract.php?dni=<?php echo $dni ?>" type="button" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i> Retroceder</a>
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
  <script src="vendor/sweetalert2.js"></script>
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