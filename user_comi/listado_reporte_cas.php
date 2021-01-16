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

  <title>Listado de postulantes CAS - SISTEMA SELECCIÓN DIRESA TACNA</title>

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
    $idcon = $_GET['idcon'];
    $idpersonal = $_GET['idpersonal'];


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
          <?php
          $consul_tabla = "SELECT * FROM sistema_seleccion.personal_req Inner join sistema_seleccion.convocatoria ON personal_req.convocatoria_idcon = convocatoria.idcon INNER JOIN cargo_full ON personal_req.cargo_idcargo = cargo_full.idcargo WHERE convocatoria_idcon = '$idcon' AND idpersonal='$idpersonal'";
          $query = mysqli_query($con, $consul_tabla);
          $ar_tabla = MySQLI_fetch_array($query);
          ?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">LISTADO DE POSTULANTES DE LA CONVOCATORIA CAS Nº <?php echo $ar_tabla['num_con'] . ' - ' . $ar_tabla['anio_con'] . ' / ' . $ar_tabla['cargo'] ?></h6>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-2">
                  <div class="list-group" id="list-tab" role="tablist" style="font-size:12px;">
                    <a class="list-group-item list-group-item-action active" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Evaluacion Curricular</a>
                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Evaluación Entrevista</a>
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Reporte Final</a>
                  </div>
                </div>
                <div class="col-10">
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                      <div class="row">
                        <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                          <a href="reportes_diresa/relacion_postulantes.php?&idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-primary m-2"><i class="far fa-file-pdf"></i> Reporte Postulantes</button></a>
                        </div>
                        <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                          <a href="reportes_diresa/resultado_curricular_aptos.php?idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-success m-2"><i class="far fa-file-pdf"></i> Reporte Eva. Curricular Aptos</button></a>
                        </div>
                        <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                          <a href="reportes_diresa/resultado_curricular_no_aptos.php?idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-danger m-2"><i class="far fa-file-pdf"></i> Reporte Eva. Curricular Total</button></a>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                      <ul class="nav nav-tabs" id="myTab_2" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="aptos-tab" data-toggle="tab" href="#aptos" role="tab" aria-controls="aptos" aria-selected="true">
                            <div class="font-weight-bold">Lista de postulantes APTOS</div>
                          </a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="totales-tab" data-toggle="tab" href="#totales" role="tab" aria-controls="totales" aria-selected="false">
                            <div class="font-weight-bold">Lista de depostulantes TOTAL</div>
                          </a>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active m-3" id="aptos" role="tabpanel" aria-labelledby="aptos-tab" n>
                          <div class="row">
                            <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                              <a href="reportes_diresa/resultado_final_v1.php?idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-primary m-1"><i class="far fa-file-pdf"></i> Reporte Resultado Entrevista APTOS</button></a>
                            </div>
                            <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                              <a href="reportes_diresa/resultado_final_v2.php?idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-success m-1"><i class="far fa-file-pdf"></i> Reporte Resultado Entrevista TOTAL</button></a>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade m-3" id="totales" role="tabpanel" aria-labelledby="totales-tab">
                          <div class="row">
                            <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                              <a href="reportes_diresa/resultado_final_v1.php?idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-primary m-1"><i class="far fa-file-pdf"></i> Reporte Resultado Entrevista APTOS</button></a>
                            </div>
                            <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                              <a href="reportes_diresa/resultado_final_v2.php?idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-success m-1"><i class="far fa-file-pdf"></i> Reporte Resultado Entrevista TOTAL</button></a>
                            </div>
                          </div>
                        </div>
                      </div>


                    </div>
                    <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                      <div class="row">
                        <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                          <a href="reportes_diresa/resultado_final_v1.php?idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-primary m-1"><i class="far fa-file-pdf"></i> Reporte Resultado Final</button></a>
                        </div>
                        <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                          <a href="reportes_diresa/resultado_final_v2.php?idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-success m-1"><i class="far fa-file-pdf"></i> Reporte Resultado ASISTENCIAL</button></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row d-flex justify-content-center m-3">
                <a href="elegir_conv_total.php?dni=<?php echo $dni ?>#home" type="button" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i></i> Retroceder</a>
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
    $('#list-tab a').click(function(e) {
      e.preventDefault();
      $(this).tab('show');
    });

    // store the currently selected tab in the hash value 
    $("div.list-group > a").on("shown.bs.tab", function(e) {
      var id = $(e.target).attr("href").substr(1);
      window.location.hash = id;
    });

    // on load of the page: switch to the currently selected tab 
    var hash = window.location.hash;
    $('#list-tab a[href="' + hash + '"]').tab('show');
  </script>
</body>

</html>