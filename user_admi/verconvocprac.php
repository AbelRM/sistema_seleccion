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

  <title>VER CONVOCATORIA DE PRACTICANTES - SISTEMA SELECCION (DIRESA-TACNA)</title>

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
    $practicas_idcon = $_GET['practicas_idcon'];
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
                  <h6 class="m-0 font-weight-bold text-primary">CONVOCATORIA DE PRÁCTICAS SELECCIONADA</h6>
                </div>
                <div class="card-body">
                  <?php

                  $sql = "SELECT * FROM practicas WHERE idpracticas='" . $practicas_idcon . "' ";
                  $result = mysqli_query($con, $sql);
                  $fila = mysqli_fetch_array($result);
                  ?>
                  <form method="POST">
                    <input type="hidden" value="<?php echo $fila["con_con"]; ?>" name="id">
                    <div class="form-group">
                      <h6 class="m-0 font-weight-bold text-danger">Datos de la convocatoria</h6>
                      <hr class="sidebar-divider">
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-3 col-sm-12">
                        <label for="disabled-input">N° de convocatoria</label>
                        <input type="text" class="form-control" name="num_con" value="<?php echo $fila["num_convoc"] . "-" . $fila["anio_convoc"]; ?>" disabled="true">
                      </div>

                      <div class="form-group col-md-3 col-sm-12">
                        <label for="disabled-input">Desde</label>
                        <input type="text" class="form-control" name="fech_ini" value="<?php echo $fila["fech_inicio"]; ?>" disabled="true">
                      </div>

                      <div class="form-group col-md-3 col-sm-12">
                        <label for="disabled-input">Hasta</label>
                        <input type="text" class="form-control" name="fech_term" value="<?php echo $fila["fech_termino"]; ?>" disabled="true">
                      </div>

                      <div class="form-group col-md-3 col-sm-12">
                        <label for="disabled-input">Estado convocatoria</label>
                        <input type="text" class="form-control" name="num_con" value="<?php echo $fila["estado_con"]; ?>" disabled="true">
                      </div>
                    </div>

                    <div class="form-group">
                      <h6 class="m-0 font-weight-bold text-danger">Porcentaje de la convocatoria</h6>
                      <hr class="sidebar-divider">
                    </div>
                    <div class="form-row" id="contenido">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-6 col-form-label">% DE EVALUACION CURRICULAR:</label>
                          <div class="col-sm-1">
                            <input type="text" class="form-control" id="porcen_eva_cu" value="<?php echo $fila["porcen_eva_cu"]; ?>" disabled="true">
                          </div>
                          <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                        </div>

                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-6 col-form-label">% DE EVALUACION DE ENTREVISTA:</label>
                          <div class="col-sm-1">
                            <input type="text" class="form-control" id="porce_entrevista" value="<?php echo $fila["porce_entrevista"]; ?>" disabled="true">
                          </div>
                          <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <h6 class="m-0 font-weight-bold text-danger">Datos de los practicantes requerido</h6>
                      <hr class="sidebar-divider">
                    </div>
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Tipo practicante</th>
                          <th>Cantidad</th>
                          <th>Carrera</th>
                          <th>Fuente financiamiento</th>
                          <th>Meta</th>
                          <th>Remuneración</th>
                          <th>Dirección ejecutora</th>
                          <th>Estudios</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $consulta_form = "SELECT * FROM practicantes_req INNER JOIN ubicacion ON practicantes_req.practicantes_req_idubicacion= ubicacion.iddireccion WHERE conv_idpracticas = $practicas_idcon";
                        $query = mysqli_query($con, $consulta_form);

                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                          <tr>
                            <td style="font-size: 14px;"><?php echo $row['tipo_practicante'] ?></td>
                            <td style="font-size: 14px;"><?php echo $row['cantidad_req'] ?></td>
                            <td style="font-size: 14px;"><?php echo $row['carrera_prof'] ?></td>
                            <td style="font-size: 14px;"><?php echo $row['fuente_finac'] ?></td>
                            <td style="font-size: 14px;"><?php echo $row['meta'] ?></td>
                            <td style="font-size: 14px;"><?php echo $row['remuneracion'] ?></td>
                            <td style="font-size: 14px;"><?php echo $row['direccion_ejec'] . " - " . $row['equipo_ejec'] ?></td>
                            <td style="font-size: 14px;">
                              Nivel estudio: <?php echo $row['nivel_estudio'] ?><br>
                              Ciclo estudio: <?php echo $row['ciclo_requerido'] ?>
                            </td>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                    <div class="form-group">
                      <h6 class="m-0 font-weight-bold text-danger">Datos de la comisión asignada</h6>
                      <hr class="sidebar-divider">
                    </div>
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Cargo</th>
                          <th>Nombres</th>
                          <th>Área usuaria</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql2 = "SELECT * FROM comision_pract where practicas_idcon=$practicas_idcon";
                        $result2 = mysqli_query($con, $sql2);
                        while ($fila2 = mysqli_fetch_array($result2)) {
                        ?>
                          <tr>
                            <td style="font-size: 14px; text-transform: uppercase;"><?php echo $fila2['cargo_funcio'] ?></td>
                            <td style="font-size: 14px; text-transform: uppercase;"><?php echo $fila2['nombre'] . " " . $fila2['apellidos'] ?></td>
                            <td style="font-size: 14px; text-transform: uppercase;"><?php echo $fila2['area_user'] ?></td>

                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                    <div class="row d-flex justify-content-end">
                      <a href="listado_convoc_prac.php?dni=<?php echo $dni ?>" type="button" class="btn btn-secondary">Regresar</a>
                    </div>
                  </form>
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
      <script src="js/sb-admin-2.js"></script>
      <script src="js/sumar.js"></script>


</body>

</html>