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

  <title>ELEGIR CONVOCATORIA PARA EVALUAR - SISTEMA DE SELECCIÓN DIRESA TACNA</title>

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
    $dato_desencriptado = $_GET['dni'];
    // $dni = $desencriptar($dato_desencriptado);

    $sql2 = "SELECT * FROM usuarios where dni=$dni";
    $datos = mysqli_query($con, $sql2) or die(mysqli_error($datos));;
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
          <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

          <!-- DataTales Example -->

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">ELEGIR TIPO CONVOCATORIA PARA EVALUAR</h6>
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
                  <div class="table-responsive m-1">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="display: none;">id</th>
                          <th>N°</th>
                          <th>N° convocatoria</th>
                          <th colspan='2'>Fechas</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM convocatoria WHERE estado = 'ACTIVO'";
                        $i = 1;
                        $query = mysqli_query($con, $sql);
                        if (mysqli_num_rows($query) > 0) {
                          while ($row = mysqli_fetch_array($query)) {
                            $idcon = $row['idcon'];
                        ?>
                            <tr style="background-color: #D5837B;">
                              <td style="display: none;"><?php echo $row['idcon'] ?></td>
                              <td style="font-weight:900;"><?php echo $i ?></td>
                              <td style="font-size: 14px; font-weight:900;"><?php echo $row['num_con'] . '-' . $row['anio_con'] ?></td>
                              <td colspan='2' style="font-size: 14px; font-weight:900;">
                                <small style="font-weight:700; font-size: 14px;">Fecha Inicio: </small><?php echo $row['fech_ini'] ?><br>
                                <small style="font-weight:700; font-size: 14px;">Fecha Termino: </small><?php echo $row['fech_term'] ?>
                              </td>
                              <td colspan='2' style="font-size: 14px; font-weight:900;"><?php echo $row['estado'] ?></td>
                            </tr>
                            <?php
                            $sql_3 = "SELECT * FROM personal_req INNER JOIN cargo ON personal_req.cargo_idcargo = cargo.idcargo 
                            INNER JOIN ubicacion ON personal_req.personal_req_idubicacion = ubicacion.iddireccion WHERE convocatoria_idcon = '$idcon' ";
                            $resul = mysqli_query($con, $sql_3);
                            $fil_perso_req = mysqli_num_rows($resul);
                            if ($fil_perso_req > 0) {
                            ?>
                              <thead>
                                <tr>
                                  <th style="display:none;">id</th>
                                  <th></th>
                                  <th colspan='5' style="color:#000; background:#85879666; font-size:0.813em;">Personal requerido por la convocatoria</th>
                                </tr>
                              </thead>
                              <?php
                              $ii = 1;
                              while ($array = mysqli_fetch_array($resul)) {
                                $idpersonal = $array['idpersonal'];
                              ?>
                                <tr>
                                  <td style="font-size: 14px; text-align: center;"></td>
                                  <td style="font-size: 12px; display:none"><?php echo $array['idpersonal'] ?></td>
                                  <td style="font-size: 12px; background-color: #8287e021;">
                                    <small style="font-weight:700; font-size: 14px;">Cargo requerido: </small><br><small style="font-weight:800; font-size: 16px;" class="text-primary"><?php echo $array['cargo'] ?></small><br>
                                    <small style="font-weight:700; font-size: 14px;">Cantidad requerida: </small><?php echo $array['cantidad'] ?>
                                  </td>
                                  <td colspan='2' style="font-size: 12px; background-color: #8287e021;">
                                    <small style="font-weight:700; font-size: 14px;">Fuente finac.: </small><?php echo $array['fuente_finac'] ?><br>
                                    <small style="font-weight:700; font-size: 14px;">Meta: </small><?php echo $array['meta'] ?>
                                    <small style="font-weight:700; font-size: 14px;">Remuneracion: </small>S/.<?php echo $array['remuneracion'] ?>
                                  </td>
                                  <td style="font-size: 12px; background-color: #8287e021;">
                                    <small style="font-weight:700; font-size: 14px;">Dirección Ejecutora: </small><?php echo $array['direccion_ejec'] . " - " . $array['equipo_ejec'] ?>
                                  </td>

                                  <td style="font-size: 12px; background-color: #8287e021;">
                                    <a href="listado_postu_cas.php?idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dni ?>">
                                      <button type="button" class="btn btn-success btn-sm" style="margin: 1px;"><i class="fas fa-search-plus"></i> Ver postulantes</button>
                                    </a>
                                  </td>
                                </tr>
                              <?php
                                $ii++;
                              }
                              ?>
                        <?php
                              $i++;
                            } else {
                              echo "<tr><td colspan='6' class='text-center text-danger font-weight-bold' >NO HAY PERSONAL REQUERIDO PARA ESTA CONVOCATORIA</td></tr>";
                            }
                          }
                        } else {
                          echo "<tr><td colspan='6' class='text-center text-danger font-weight-bold' >NO HAY CONVOCATORIAS DE PRACTICANTES</td></tr>";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="table-responsive m-1">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th style="display: none;">id</th>
                          <th>N°</th>
                          <th>N° convocatoria</th>
                          <th colspan='2'>Fechas</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM practicas WHERE estado_con = 'ACTIVO'";
                        $query = mysqli_query($con, $sql);
                        $i = 1;
                        if (mysqli_num_rows($query) > 0) {
                          while ($row = mysqli_fetch_array($query)) {
                            $idpracticas = $row['idpracticas'];
                        ?>
                            <tr style="background-color: #D5837B;">
                              <td style="display: none;"><?php echo $row['idpracticas'] ?></td>
                              <td style="font-weight:900;"><?php echo $i ?></td>
                              <td style="font-size: 14px; font-weight:900;"><?php echo $row['num_convoc'] . '-' . $row['anio_convoc'] ?></td>
                              <td colspan='2' style="font-size: 14px; font-weight:900;">
                                <small style="font-weight:700; font-size: 14px;">Fecha Inicio: </small><?php echo $row['fech_inicio'] ?><br>
                                <small style="font-weight:700; font-size: 14px;">Fecha Termino: </small><?php echo $row['fech_termino'] ?>
                              </td>
                              <td colspan='2' style="font-size: 14px; font-weight:900;"><?php echo $row['estado_con'] ?></td>
                            </tr>
                            <?php
                            $sql_2 = "SELECT * FROM practicantes_req INNER JOIN ubicacion ON practicantes_req.practicantes_req_idubicacion= ubicacion.iddireccion 
                            WHERE conv_idpracticas = $idpracticas";
                            $consulta = mysqli_query($con, $sql_2);
                            ?>
                            <thead>
                              <tr>
                                <th style="display:none;">id</th>
                                <th></th>
                                <th colspan='5' style="color:#000; background:#85879666; font-size:0.813em;">Practicantes requerido por la convocatoria</th>
                              </tr>
                            </thead>
                            <?php
                            $ii = 1;
                            while ($rw = mysqli_fetch_array($consulta)) {
                              $idpracticantes_req = $rw['idpracticantes_req'];
                            ?>
                              <tr>
                                <td style="font-size: 14px; text-align: center;"></td>
                                <td style="font-size: 12px; display:none"><?php echo $idpracticantes_req ?></td>
                                <td style="font-size: 12px; background-color: #8287e021;">
                                  <small style="font-weight:700; font-size: 14px;">Tipo practicante: </small><?php echo $rw['tipo_practicante'] ?><br>
                                  <small style="font-weight:700; font-size: 14px;">Carrera requerida: </small><?php echo $rw['carrera_prof'] ?><br>
                                  <small style="font-weight:700; font-size: 14px;">Cantidad requerida: </small><?php echo $rw['cantidad_req'] ?>
                                </td>
                                <td style="font-size: 12px; background-color: #8287e021;">
                                  <small style="font-weight:700; font-size: 14px;">Fuente finac.: </small><?php echo $rw['fuente_finac'] ?><br>
                                  <small style="font-weight:700; font-size: 14px;">Meta: </small><?php echo $rw['meta'] ?>
                                  <small style="font-weight:700; font-size: 14px;">Remuneracion: </small>S/.<?php echo $rw['remuneracion'] ?>
                                </td>
                                <td style="font-size: 12px; background-color: #8287e021;">
                                  <small style="font-weight:700; font-size: 14px;">Dirección Ejecutora: </small><?php echo $rw['direccion_ejec'] . " - " . $rw['equipo_ejec'] ?>
                                </td>
                                <td style="font-size: 12px; background-color: #8287e021;">
                                  <small style="font-weight:700; font-size: 14px;">Nivel estudio: </small><?php echo $rw['nivel_estudio'] ?><br>
                                  <?php
                                  if ($rw['nivel_estudio'] == 'ESTUDIANTE') {
                                    echo '<small style="font-weight:700; font-size: 14px;">Ciclo requerido: </small>' . $rw['ciclo_requerido'];
                                  } else {
                                  }
                                  ?>
                                </td>
                                <td style="font-size: 12px; background-color: #8287e021;">
                                  <a href="listado_postu_prac.php?idpracticas=<?php echo $idpracticas ?>&idpracticantes_req=<?php echo $idpracticantes_req ?>&dni=<?php echo $dni ?>">
                                    <button type="button" class="btn btn-success btn-sm" id="editar" style="margin: 1px;"><i class="fas fa-search-plus"></i> Ver postulantes</button>
                                  </a>
                                </td>
                              </tr>
                            <?php
                              $ii++;
                            }
                            ?>
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
  <!-- <script src="js/tradu_tabla.js"></script> -->
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

</html>