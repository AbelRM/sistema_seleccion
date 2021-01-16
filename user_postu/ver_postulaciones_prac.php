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

  <title>VER POSTULACIÓN - SISTEMA SELECCION (DIRESA-TACNA)</title>

  <!-- Custom fonts for this template-->
  <link rel="icon" type="image/png" href="img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <style>
    #total {
      font-weight: bold;
    }

    .red {
      border-color: red;
    }

    .green {
      border-color: green;
    }
  </style>

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
          <div class="row">

            <div class="col-lg-12">

              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">POSTULACION PRACTICANTE SELECCIONADA</h6>
                </div>
                <div class="card-body">
                  <?php

                  $consulta = "SELECT * FROM postulante where dni=$dni";
                  $datos = mysqli_query($con, $consulta) or die(mysqli_error($datos));;
                  $row = mysqli_fetch_array($datos);
                  $idpostulante = $row['idpostulante'];

                  $idcon = $_GET['id'];
                  $detalle = $_GET['id'];
                  $sql = "SELECT * FROM detalle_conv_prac
                      inner join practicantes_req on detalle_conv_prac.practicantel_req_idpracticantes_req=practicantes_req.idpracticantes_req inner join practicas on detalle_conv_prac.idpracticas_conv=practicas.idpracticas
                      INNER JOIN ubicacion ON practicantes_req.practicantes_req_idubicacion = ubicacion.iddireccion
                      WHERE iddetalle_conv_prac='$detalle'";

                  $result = mysqli_query($con, $sql);
                  $fila = mysqli_fetch_array($result);
                  ?>

                  <input type="hidden" value="<?php echo $fila["num_con"]; ?>" name="id">

                  <div class="form-row">
                    <div class="form-group col-md-3 col-sm-12">
                      <label for="disabled-input">Fecha de Inscripción</label>
                      <input type="text" class="form-control" value="<?php echo $fila["fecha_postulacion"]; ?>" disabled="true">
                    </div>
                    <div class="col-md-12">
                      <h6 class="m-0 font-weight-bold text-danger">Datos de la convocatoria practicante seleccionada</h6>
                      <hr class="sidebar-divider">
                    </div>
                    <div class="form-group col-lg-3 col-md-4 col-sm-12">
                      <label for="disabled-input">Nro de Convocatoria</label>
                      <input type="text" class="form-control" value="<?php echo $fila["num_convoc"] . "-" . $fila["anio_convoc"]; ?>" disabled="true">
                    </div>
                    <div class="form-group col-lg-3 col-md-4 col-sm-12">
                      <label for="disabled-input">Fecha Inicio</label>
                      <input type="date" class="form-control" value="<?php echo $fila["fech_inicio"]; ?>" disabled="true">
                    </div>
                    <div class="form-group col-lg-3 col-md-4 col-sm-12">
                      <label for="disabled-input">Fecha termino</label>
                      <input type="date" class="form-control" value="<?php echo $fila["fech_termino"]; ?>" disabled="true">
                    </div>
                    <div class="form-group col-lg-3 col-md-4 col-sm-12">
                      <label for="disabled-input">% Eva. Curricular</label>
                      <input type="text" class="form-control" value="<?php echo $fila["porcen_eva_cu"]; ?>%" disabled="true">
                    </div>
                    <div class="col-md-12">
                      <h6 class="m-0 font-weight-bold text-danger">Datos del puesto seleccionado</h6>
                      <hr class="sidebar-divider">
                    </div>
                    <div class="form-group col-lg-2 col-md-4 col-sm-12">
                      <label for="disabled-input">Tipo practicante</label>
                      <input type="text" class="form-control" value="<?php echo $fila["tipo_practicante"]; ?>" disabled="true">
                    </div>
                    <div class="form-group col-lg-2 col-md-4 col-sm-12">
                      <label for="disabled-input">Nivel de estudio</label>
                      <input type="text" class="form-control" value="<?php echo $fila["nivel_estudio"]; ?>" disabled="true">
                    </div>
                    <div class="form-group col-lg-3 col-md-4 col-sm-12">
                      <label for="disabled-input">Carrera requerido</label>
                      <input type="text" class="form-control" value="<?php echo $fila["carrera_prof"]; ?>" disabled="true">
                    </div>
                    <div class="form-group col-lg-2 col-md-4 col-sm-12">
                      <label for="disabled-input">Cantidad</label>
                      <input type="text" class="form-control" value="<?php echo $fila["cantidad_req"]; ?>" disabled="true">
                    </div>
                    <div class="form-group col-lg-2 col-md-4 col-sm-12">
                      <label for="disabled-input">Remuneración</label>
                      <input type="text" class="form-control" value="S/. <?php echo $fila["remuneracion"]; ?>.00" disabled="true">
                    </div>
                    <div class="form-group col-lg-3 col-md-4 col-sm-12">
                      <label for="disabled-input">Fuente Finac.</label>
                      <input type="text" class="form-control" value="<?php echo $fila["fuente_finac"]; ?>" disabled="true">
                    </div>
                    <div class="form-group col-lg-2 col-md-4 col-sm-12">
                      <label for="disabled-input">Meta</label>
                      <input type="text" class="form-control" value="<?php echo $fila["meta"]; ?>" disabled="true">
                    </div>
                    <div class="form-group col-lg-10 col-md-10 col-sm-12">
                      <label for="disabled-input">Direccion - Equipo ejecutor</label>
                      <input type="text" class="form-control" value="<?php echo $fila["direccion_ejec"] . " - " . $fila["equipo_ejec"]; ?>" disabled="true">
                    </div>




                  </div>
                  <div class="row d-flex justify-content-center m-3">
                    <a href="mispostulaciones_prac.php?dni=<?php echo $dni ?>" type="button" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i></i> Retroceder</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.container-fluid -->
          </div>
          <!-- End of Main Content -->

          <!-- Footer -->
          <?php include 'footer.php' ?>
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
      <script src="js/sb-admin-2.js"></script>
      <script src="js/sumar.js"></script>


</body>

</html>