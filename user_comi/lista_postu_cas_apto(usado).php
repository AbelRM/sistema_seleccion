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

  <title>Listado de postulantes APTOS con resultados - DIRESA TACNA</title>

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

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">LISTADO DE POSTULANTES CAS APTOS CON PUNTAJE</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="display: none;">id_detalle_conv_prac</th>
                      <th>N°</th>
                      <th>Datos postulante</th>
                      <th>Puntajes detallados</th>
                      <th>Puntaje Total CV</th>
                      <th>Estados</th>
                      <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM sistema_seleccion.detalle_convocatoria inner join sistema_seleccion.postulante 
                    on detalle_convocatoria.postulante_idpostulante=postulante.idpostulante
                    Inner join sistema_seleccion.personal_req 
                    on detalle_convocatoria.personal_req_idpersonal=personal_req.idpersonal 
                    inner join sistema_seleccion.convocatoria on detalle_convocatoria.convocatoria_idcon=convocatoria.idcon
                    INNER JOIN sistema_seleccion.evaluacion_curri_cas ON detalle_convocatoria.id_eva_curri_cas=evaluacion_curri_cas.id_eva_curricular
                    WHERE detalle_convocatoria.convocatoria_idcon = '$idcon' AND personal_req_idpersonal = '$idpersonal' AND estado_conv_cas = 'APTO'";
                    $i = 1;
                    $query = mysqli_query($con, $sql);
                    while ($row = MySQLI_fetch_array($query)) {
                    ?>
                      <tr>
                        <td style="display: none;"><?php echo $row['iddetalle_conv_prac'] ?></td>
                        <td><?php echo $i ?></td>
                        <td style="font-size: 12px;">
                          <small style="font-weight:700; font-size: 12px;">DNI: </small><?php echo $row['dni'] ?><br>
                          <small style="font-weight:700; font-size: 12px;">Nombre: </small><?php echo $row['nombres'] . ' ' . $row['ape_pat'] . ' ' . $row['ape_mat']  ?>
                        </td>
                        <td style="font-size: 14px;">
                          <small style="font-weight:700; font-size: 14px;">Puntaje Formación:</small><br><?php echo $row['punt_total_forma'] ?> Puntos<br>
                          <small style="font-weight:700; font-size: 14px;">Puntaje Capacitaciones</small><br><?php echo $row['punt_total_cursos'] ?> Puntos<br>
                          <small style="font-weight:700; font-size: 14px;">Puntaje Exp. laboral total</small><br><?php echo $row['punt_total_expe'] ?> Puntos
                        </td>
                        <td style="font-size: 14px;"><?php echo $row['puntaje_total_total'] ?> Puntos</td>
                        <td style="font-size: 14px;">
                          <small style="font-weight:700; font-size: 14px;">Estado postulante: </small><?php echo $row['estado_conv_cas'] ?><br>
                          <small style="font-weight:700; font-size: 14px;">Estado CV: </small><?php echo $row['estado_eva_curri_cas'] ?><br>
                          <small style="font-weight:700; font-size: 14px;">Estado entrevista: </small><?php echo $row['estado_entrevista_cas'] ?><br>
                        </td>
                        <td>
                          <a href="agregar_entrevista_cas.php?idpostulante=<?php echo $row['idpostulante'] ?>&idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>"><button type="button" class="btn btn-primary btn-sm"><i class="far fa-plus-square"></i> Entrevista</button></a>
                        </td>
                      </tr>
                    <?php
                      $i++;
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="row d-flex justify-content-center m-3">
                <a href="elegir_conv_cal.php?dni=<?php echo $dni ?>" type="button" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i></i> Retroceder</a>
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


</body>

</html>