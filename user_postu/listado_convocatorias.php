<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Listado de convocatorias - DIRESA TACNA</title>

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
    include 'conexion.php';

    include 'funcs/mcript.php';
    $dni = $_GET['dni'];
    // $dato_desencriptado = $_GET['dni'];
    // $dni = $desencriptar($dato_desencriptado);

    $sql2 = "SELECT * FROM usuarios where dni=$dni";
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

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">LISTADO DE CONVOCATORIAS</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                      <th>N° CONVOCATORIA</th>
                      <th>TIPO</th>
                      <th>ESTADO</th>
                      <th>F. INICIO</th>
                      <th>F. TERMINO</th>
                      <th>ACCIONES</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $dni = $_GET['dni'];

                    $sql3 = "SELECT * FROM convocatoria";
                    $query = mysqli_query($con, $sql3);
                    while ($row = MySQLI_fetch_array($query)) {
                    ?>
                      <tr>
                        <td style="font-size: 16px;"><?php echo $row['num_con'] . "-" . $row['anio_con'] ?></td>
                        <td style="font-size: 14px;"><?php echo $row['tipo_con'] ?></td>
                        <td style="font-size: 14px;"><?php echo $row['estado'] ?></td>
                        <td style="font-size: 14px;"><?php echo $row['fech_ini'] ?></td>
                        <td style="font-size: 14px;"><?php echo $row['fech_term'] ?></td>
                        <td>
                          <a href="verconvocatoria.php?id=<?php echo $row['idcon'] ?>&dni=<?php echo $dato_desencriptado ?>"><button type="button" class="btn btn-primary" id="editar" style="margin: 1px;"><i class="fa fa-eye"></i> Ver</button></a>
                        </td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
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
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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