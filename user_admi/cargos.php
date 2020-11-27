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

  <title>LISTADO DE CARGOS - SISTEMA DE SELECCIÓN DIRESA TACNA</title>

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

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="row">
                <div class="col-md-6">
                  <h6 class="m-0 font-weight-bold text-primary">CARGO</h6>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevo_cargo"><i class="fas fa-plus"></i> Nuevo</button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                      <th>N°</th>
                      <th>Cargo</th>
                      <th style="display: none;">id_argo</th>
                      <th>Tipo Cargo</th>
                      <th>Acciones</th>

                    </tr>
                  </thead>
                  <?php

                  $sql = "SELECT * FROM cargo INNER JOIN tipo_cargo ON tipo_cargo.idtipo = cargo.tipo_cargo_id";

                  $query = mysqli_query($con, $sql);
                  while ($row = MySQLI_fetch_array($query)) {
                  ?>
                    <tr>
                      <td><?php echo $row['idcargo'] ?></td>
                      <td style="font-size: 14px;"><?php echo $row['cargo'] ?></td>
                      <td style="display:none;"><?php echo $row['tipo_cargo_id'] ?></td>
                      <td style="font-size: 14px;"><?php echo $row['tipo_cargo'] ?></td>
                      <td>
                        <!-- <a href="modificarcargo.php?id=<?php echo $row['idcargo'] ?>&dni=<?php echo $dato_desencriptado ?>"><button type="button" class="btn btn-success" id="editar" style="margin: 1px;"><i class="fa fa-pen"></i></button></a> -->
                        <button type="button" class="btn btn-success m-1 updateBtn"><i class="fa fa-pen"></i></button>
                        <button type="button" class="btn btn-danger m-1 deleteBtn"><i class="fas fa-trash-alt"></i></button>

                      </td>
                    </tr>
                  <?php
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

  <!--AGREGAR CARGO - ESTE SI-->
  <div class="modal fade" id="nuevo_cargo">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Nuevo cargo</h5>
          <button class="close" data-dismiss="modal">
            <span>×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="procesos/guardarcargo.php" class="needs-validation" method="POST">
            <div class="form-row">
              <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
              <div class="form-group col-md-5 col-sm-12">
                <label for="inputEmail4">Cargo</label>
                <input type="text" class="form-control" name="cargo" required>
              </div>

              <div class="form-poup col-md-7 col-sm-12">
                <label for="disabled-input" class=" form-control-label">Tipo de Cargo</label>
                <select name="tipo" class="form-control">
                  <?php
                  $sql = "SELECT * FROM tipo_cargo";
                  $res = mysqli_query($con, $sql);
                  while ($rw = mysqli_fetch_array($res)) {
                    echo "<option value=" . $rw["idtipo"] . ">" . $rw["tipo_cargo"] . "</option> ";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Agregar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!--MODIFICAR CARGO- ESTE SI-->
  <div class="modal fade" id="modificar_cargo">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Modificar cargo</h5>
          <button class="close" data-dismiss="modal">
            <span>×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="procesos/modificarcargo.php" class="needs-validation" method="POST">
            <div class="form-row">
              <input type="hidden" name="dni_modif" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="idcargop" id="idcargo">
              <div class="form-group col-md-5 col-sm-12">
                <label>Cargo</label>
                <input type="text" class="form-control" name="edit_cargo" id="cargo" required>
              </div>

              <div class="form-poup col-md-7 col-sm-12">
                <label class=" form-control-label">Tipo de Cargo</label>
                <select name="edit_tipo" id="tipo" class="form-control">
                  <?php
                  $sql = "SELECT * FROM tipo_cargo";
                  $res = mysqli_query($con, $sql);
                  while ($rw = mysqli_fetch_array($res)) {
                    echo "<option value=" . $rw["idtipo"] . ">" . $rw["tipo_cargo"] . "</option> ";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Actualizar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Eliminar cargo -->
  <div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar registro de Cargos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="procesos/borrar_cargo.php" method="POST">
          <div class="modal-body">

            <input type="hidden" name="idcargo" id="idcargo">
            <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
            <h4>¿Desea eliminar el registro de cargos?</h4>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
            <button type="submit" class="btn btn-danger" name="deleteData1">SI</button>
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
      $('.updateBtn').on('click', function() {

        $('#modificar_cargo').modal('show');

        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);
        $('#idcargo').val(data[0]);
        $('#cargo').val(data[1]);
        $('#tipo').val(data[2]);
      });
    });

    $(document).ready(function() {
      $('.deleteBtn').on('click', function() {

        $('#deleteModal').modal('show');

        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);

        $('#idcargo').val(data[0]);

      });
    });
  </script>

</body>

</html>