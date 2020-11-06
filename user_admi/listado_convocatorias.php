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
    $dato_desencriptado = $_GET['dni'];
    $dni = $desencriptar($dato_desencriptado);

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
            <?php
            include '../conexion.php';
            include 'modal_ver_convocatoria.php';
            ?>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="display: none;">id</th>
                      <th>N°</th>
                      <th>Tipo concurso</th>
                      <th>N° convocatoria</th>
                      <th>Fecha Inicio</th>
                      <th>Fecha Fin</th>
                      <th>Acciones</th>

                    </tr>
                  </thead>
                  <?php

                  $sql = "SELECT * FROM convocatoria";
                  $i = 1;
                  $query = mysqli_query($con, $sql);
                  while ($row = MySQLI_fetch_array($query)) {
                  ?>
                    <tr>
                      <td style="display: none;"><?php echo $row['idcon'] ?></td>
                      <td><?php echo $i ?></td>
                      <td style="font-size: 16px;"><?php echo $row['tipo_con'] ?></td>
                      <td style="font-size: 14px;"><?php echo $row['num_con'] . '-' . $row['anio_con'] ?></td>
                      <td style="font-size: 14px;"><?php echo $row['fech_ini'] ?></td>
                      <td style="font-size: 14px;"><?php echo $row['fech_term'] ?></td>
                      <td>
                        <a href="verconvocatoria.php?id=<?php echo $row['idcon'] ?>&dni=<?php echo $dato_desencriptado ?>"><button type="button" class="btn btn-warning" id="editar" style="margin: 1px;"><i class="fa fa-eye"></i></button></a>
                        <a href="modificarconvocatoria.php?idcon=<?php echo $row['idcon'] ?>&dni=<?php echo $dato_desencriptado ?>"><button type="button" class="btn btn-success" id="editar" style="margin: 1px;"><i class="fa fa-pen"></i></button></a>
                        <button class="btn btn-danger m-1 deleteBtn"><i class="fa fa-times-circle"></i></button>
                      </td>
                    </tr>
                  <?php
                    $i++;
                  }
                  ?>

                  <tbody>

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
  <!-- eliminar convocatoria -->
  <div class="modal fade" id="eliminarconvocatoria">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">Eliminar registro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <form action="procesos/eliminar_convocatoria.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="dni_url" value="<?php echo $dato_desencriptado; ?>">
            <input type="hidden" name="id_convocatoria" id="id_convocatoria">
            <input type="hidden" name="dni_base_4" value="<?php echo $dni ?>">
            <p>Si usted elimina una convocatoria, tambien se van a eliminar el personal requerido y la comisión de la misma. Si está seguro continue.</p>
            <h4>¿Desea eliminar la convocatoria?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" name="deleteData">Si</button>
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
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  <script>
    $(document).ready(function() {
      $('.deleteBtn').on('click', function() {

        $('#eliminarconvocatoria').modal('show');
        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);
        $('#id_convocatoria').val(data[0]);
      });
    });
  </script>

</body>

</html>