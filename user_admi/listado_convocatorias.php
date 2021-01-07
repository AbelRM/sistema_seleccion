<?php
include 'conexion.php';
include "funcs/mcript.php";
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

  <title>Listado de convocatorias CAS - DIRESA TACNA</title>

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
    $dato_desencriptado = $_GET['dni'];
    // $dni = $desencriptar($dato_desencriptado);

    $sql = "SELECT * FROM usuarios where dni=$dni";
    $datos = mysqli_query($con, $sql) or die(mysqli_error($datos));;
    $fila = mysqli_fetch_array($datos);
    include 'menu.php';
    ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include 'nav.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">LISTADO DE CONVOCATORIAS</h6>
            </div>
            <div class="card-body">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                    <div class="font-weight-bold">Listado convocatoria C.A.S.</div>
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                    <div class="font-weight-bold">Listado convocatoria praticantes</div>
                  </a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th style="display: none;">id</th>
                          <th>N°</th>
                          <th>N° convocatoria</th>
                          <th>Fecha Inicio</th>
                          <th>Fecha Fin</th>
                          <th>Estado convocatoria</th>
                          <th>Acciones</th>

                        </tr>
                      </thead>

                      <tbody>
                        <?php
                        $sql = "SELECT * FROM convocatoria";
                        $i = 1;
                        $query = mysqli_query($con, $sql);
                        while ($row = MySQLI_fetch_array($query)) {
                        ?>
                          <tr>
                            <td style="display: none;"><?php echo $row['idcon'] ?></td>
                            <td><?php echo $i ?></td>
                            <td style="font-size: 14px;"><?php echo $row['num_con'] . '-' . $row['anio_con'] ?></td>
                            <td style="font-size: 14px;"><?php echo $row['fech_ini'] ?></td>
                            <td style="font-size: 14px;"><?php echo $row['fech_term'] ?></td>
                            <td style="font-size: 14px;"><?php echo $row['estado'] ?></td>
                            <td>
                              <div class="row d-flex justify-content-center">
                                <div class="col-6"><a href="verconvocatoria.php?id=<?php echo $row['idcon'] ?>&dni=<?php echo $dato_desencriptado ?>"><button type="button" class="btn btn-warning"><i class="fa fa-eye"></i></button></a></div>
                                <div class="col-6"><a href="editar_convocatoria_cas.php?idcon=<?php echo $row['idcon'] ?>&dni=<?php echo $dato_desencriptado ?>"><button type="button" class="btn btn-success"><i class="fa fa-edit"></i></button></a></div>
                              </div>
                          </tr>
                        <?php
                          $i++;
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable_2" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th style="display: none;">id</th>
                          <th>N°</th>
                          <th>N° convocatoria</th>
                          <th>Fecha Inicio</th>
                          <th>Fecha Fin</th>
                          <th>Estado convocatoria</th>
                          <th>Acciones</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        $sql = "SELECT * FROM practicas";
                        $i = 1;
                        $query = mysqli_query($con, $sql);
                        while ($row = MySQLI_fetch_array($query)) {
                        ?>
                          <tr>
                            <td style="display: none;"><?php echo $row['idpracticas'] ?></td>
                            <td><?php echo $i ?></td>
                            <td style="font-size: 14px;"><?php echo $row['num_convoc'] . '-' . $row['anio_convoc'] ?></td>
                            <td style="font-size: 14px;"><?php echo $row['fech_inicio'] ?></td>
                            <td style="font-size: 14px;"><?php echo $row['fech_termino'] ?></td>
                            <td style="font-size: 14px;"><?php echo $row['estado_con'] ?></td>

                            <td>
                              <div class="row d-flex justify-content-center">
                                <a href="verconvocprac.php?practicas_idcon=<?php echo $row['idpracticas'] ?>&dni=<?php echo $dato_desencriptado ?>"><button type="button" class="btn btn-warning" id="editar" style="margin: 1px;"><i class="fa fa-eye"></i></button></a>
                              </div>
                            </td>
                          </tr>
                        <?php
                          $i++;
                        }
                        ?>
                      </tbody>
                    </table>
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
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/tradu_tabla.js"></script>
  <script>
    $('#myTab a').click(function(e) {
      e.preventDefault();
      $(this).tab('show');
    });

    // store the currently selected tab in the hash value 
    $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
      var id = $(e.target).attr("href").substr(1);
      window.location.hash = id;
    });

    // on load of the page: switch to the currently selected tab 
    var hash = window.location.hash;
    $('#myTab a[href="' + hash + '"]').tab('show');
  </script>

</body>

</body>

</html>