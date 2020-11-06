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
              <h6 class="m-0 font-weight-bold text-primary">CARGOS</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <tbody>
                    <?php
                    $dni = $_GET['dni'];
                    $idcon = $_GET['idcon'];
                    include_once('conexion.php');
                    $sql = "SELECT * FROM sistema_seleccion.personal_req INNER JOIN sistema_seleccion.ubicacion 
                      ON personal_req.personal_req_idubicacion = ubicacion.iddireccion INNER JOIN sistema_seleccion.cargo 
                      ON personal_req.cargo_idcargo = cargo.idcargo
                      WHERE convocatoria_idcon='$idcon'";
                    $query = mysqli_query($con, $sql);
                    $i = 1;
                    while ($row = mysqli_fetch_array($query)) {
                      $idpersonal = $row['idpersonal'];
                    ?>
                      <thead>
                        <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                          <th>N°</th>
                          <th style="display: none;">id</th>
                          <th>Cargo personal requerido</th>
                          <th>Cantidad</th>
                          <th>Remuneración</th>
                          <th>Dirección ejecutora</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tr>
                        <td style="font-size: 14px; text-align: center"><?php echo $i ?></td>
                        <td style="font-size: 14px; display:none"><?php echo $idpersonal ?></td>
                        <td style="font-size: 14px;"><?php echo $row['cargo'] ?></td>
                        <td style="font-size: 14px; text-align: center"><?php echo $row['cantidad'] ?></td>
                        <td style="font-size: 14px; text-align: center"><?php echo $row['remuneracion'] ?></td>
                        <td style="font-size: 14px;"><?php echo $row['direccion_ejec'] . " - " . $row['equipo_ejec'] ?></td>
                        <td>
                          <a href="registrar_postulacion.php?idcargo=<?php echo $idpersonal ?>&dni=<?php echo $dni ?>&idcon=<?php echo $idcon ?>">
                            <button type="button" class="btn btn-primary" id="editar" style="margin: 1px;"><i class="fa fa-pencil-alt"></i> Elegir</button></a>
                        </td>
                      </tr>
                      <?php
                      $select = "SELECT * FROM detalle_requerimientos INNER JOIN requerimientos 
                                ON detalle_requerimientos.detalle_req_idrequerimientos = requerimientos.id_requerimientos WHERE detalle_req_idpersonal_req ='$idpersonal' ";
                      $consulta = mysqli_query($con, $select);
                      ?>
                      <thead>
                        <tr class="bg-secondary" style="text-align:center; color:#000; font-size:0.813em;">
                          <th style="display:none;">id</th>
                          <th>N°</th>
                          <th>Condición</th>
                          <th>Nivel</th>
                        </tr>
                      </thead>
                      <?php
                      $ii = 1;
                      while ($row = mysqli_fetch_array($consulta)) {
                      ?>
                        <tr>
                          <td style="font-size: 12px; display: none;"><?php echo $row['id_detalle_req'] ?></td>
                          <td style="font-size: 12px;"><?php echo $ii ?></td>
                          <td style="font-size: 12px;"><?php echo $row['condicion'] ?></td>
                          <td style="font-size: 12px;"><?php echo $row['nom_nivel_prioridad'] ?></td>
                        </tr>
                      <?php
                        $ii++;
                      }
                      ?>
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