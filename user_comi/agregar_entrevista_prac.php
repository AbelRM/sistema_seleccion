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

  <title>Agregar puntaje entrevista postulante PRACTICNATE - DIRESA TACNA</title>

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
    $idpostulante = $_GET['idpostulante'];
    $idpracticas = $_GET['practicas_idcon'];
    $idpracticantes_req = $_GET['practicante_req'];


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
              <h6 class="m-0 font-weight-bold text-primary">AGREGAR PUNTAJES DE LA ENTREVISTA LABORAL PARA PRACTICANTE</h6>
            </div>
            <div class="card-body">
              <?php
              $sql = "SELECT * FROM postulante where idpostulante=$idpostulante";
              $datos = mysqli_query($con, $sql);
              $fila = mysqli_fetch_array($datos);
              $dni_postulante = $fila['dni'];
              $sql_2 = "SELECT * FROM practicas  where idpracticas=$idpracticas";
              $datos_2 = mysqli_query($con, $sql_2);
              $fila_2 = mysqli_fetch_array($datos_2);
              $sql_3 = "SELECT * FROM practicantes_req  where idpracticantes_req=$idpracticantes_req";
              $datos_3 = mysqli_query($con, $sql_3);
              $fila_3 = mysqli_fetch_array($datos_3);
              $sql_4 = "SELECT * FROM detalle_conv_prac WHERE idpracticas_conv='$idpracticas' AND practicantel_req_idpracticantes_req='$idpracticantes_req' AND detalle_prac_idpostulante='$idpostulante'";
              $datos_4 = mysqli_query($con, $sql_4);
              $fila_4 = mysqli_fetch_array($datos_4);
              $iddetalle_conv_prac = $fila_4['iddetalle_conv_prac'];
              $estado_entrevista = $fila_4['estado_entrevista'];
              ?>
              <div class="form-group">
                <h6 class="m-0 font-weight-bold text-danger">DATOS DEL POSTULANTE</h6>
                <hr class="sidebar-divider">
              </div>
              <div class="form-row">
                <div class="form-group col-md-2 col-sm-12">
                  <label for="inputEmail4">D.N.I.</label>
                  <input type="text" class="form-control" value="<?php echo $dni_postulante ?>" disabled="true">
                </div>
                <div class="form-group col-md-4 col-sm-6">
                  <label for="inputEmail4">Nombres completos</label>
                  <input type="text" class="form-control" style="text-transform: uppercase;" value="<?php echo $fila['nombres'] . " " . $fila['ape_pat'] . " " . $fila['ape_mat'] ?>" disabled="true">
                </div>
                <div class="form-group col-md-2 col-sm-6">
                  <label for="inputEmail4">Nº Convocatoria</label>
                  <input type="text" class="form-control" value="<?php echo $fila_2['num_convoc'] . " - " . $fila_2['anio_convoc'] ?>" disabled="true">
                </div>
                <div class="form-group col-md-2 col-sm-6">
                  <label for="inputEmail4">Tipo de practicante</label>
                  <input type="text" class="form-control" value="<?php echo $fila_3['tipo_practicante'] ?>" disabled="true">
                </div>
                <div class="form-group col-md-2 col-sm-6">
                  <label for="inputEmail4">Nivel estudio req.</label>
                  <input type="text" class="form-control" value="<?php echo $fila_3['nivel_estudio'] ?>" disabled="true">
                </div>

              </div>
              <div class="form-group">
                <h6 class="m-0 font-weight-bold text-danger">FICHA DE EVALUACIÓN DE ENTREVISTA PERSONAL</h6>
                <hr class="sidebar-divider">
              </div>
              <?php
              $mensaje = '';
              if ($estado_entrevista == 'NO AGREGADO') {
                $mensaje = "<h5 class='text-danger font-weight-bold'><i class='far fa-hand-point-right'></i> Falta agregar los puntos de la entrevista al postulante.</h5>";
                $aspecto_personal = NULL;
                $seguridad_estabilidad = NULL;
                $etica = NULL;
                $competencias = NULL;
                $conoc_academico = NULL;
                $puntaje_total = NULL;
              } else {
                $detalle_conv_prac_identrevista_prac = $fila_4['detalle_conv_prac_identrevista_prac'];

                $consul_entre = mysqli_query($con, "SELECT * FROM entrevista_prac WHERE id_entrevista_prac = '$detalle_conv_prac_identrevista_prac'");
                $fila_5 = mysqli_fetch_array($consul_entre);
                $aspecto_personal = $fila_5['aspecto_personal'];
                $seguridad_estabilidad = $fila_5['seguridad_estabilidad'];
                $etica = $fila_5['etica'];
                $competencias = $fila_5['competencias'];
                $conoc_academico = $fila_5['conoc_academico'];
                $puntaje_total = $fila_5['puntaje_total_entre'];

                $mensaje = "<h5 class='text-success font-weight-bold'><i class='far fa-hand-point-right'></i> Usted ya agregó los puntos de la entrevista.</h5>.";
              }
              ?>
              <div class="row d-flex justify-content-center">
                <?php echo $mensaje; ?>
              </div>
              <form action="procesos/agregar_entrevista.php" method="post">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>N°</th>
                        <th colspan='2'>Factores de evaluación</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <input type="hidden" name="iddetalle_conv_prac" value="<?php echo $iddetalle_conv_prac ?>">
                      <input type="hidden" name="dni_comision" value="<?php echo $dni ?>">
                      <input type="hidden" name="idpracticas" value="<?php echo $idpracticas ?>">
                      <input type="hidden" name="idpracticantes_req" value="<?php echo $idpracticantes_req ?>">
                      <tr>
                        <td style="font-weight:900;">1</td>
                        <td colspan='2' style="font-size: 14px;">
                          <small style="font-weight:900; font-size: 14px;">ASPECTO PERSONAL <small style="font-weight:900; font-size: 14px" class="text-danger">(Máximo 2 puntos)</small>: </small><br>
                          <small style="font-weight:700; font-size: 14px;">Mide la presencia, la naturalidad en el vestir, higiene y la limpieza.</small>
                        </td>
                        <td colspan='2' style="font-size: 14px; font-weight:900;">
                          <input type="number" class="form-control text-center valor" name="aspec_perso" value="<?php if ($aspecto_personal == NULL) {
                                                                                                                } else {
                                                                                                                  echo $aspecto_personal;
                                                                                                                } ?>">
                        </td>
                      </tr>
                      <tr>
                        <td style="font-weight:900;">2</td>
                        <td colspan='2' style="font-size: 14px;">
                          <small style="font-weight:900; font-size: 14px;">SEGURIDAD Y ESTABILIDAD EMOCIONAL <small style="font-weight:900; font-size: 14px" class="text-danger">(Máximo 2 puntos)</small>: </small><br>
                          <small style="font-weight:700; font-size: 14px;">Mide el grado de seguridad y serenidad del postulante para expresar sus ideas, aplomo para adaptarse a determinadas circunstancias.</small>
                        </td>
                        <td colspan='2' style="font-size: 14px; font-weight:900;">
                          <input type="number" class="form-control text-center valor" name="segu_estab" value="<?php if ($seguridad_estabilidad == NULL) {
                                                                                                                } else {
                                                                                                                  echo $seguridad_estabilidad;
                                                                                                                } ?>">
                        </td>
                      </tr>
                      <tr>
                        <td style="font-weight:900;">3</td>
                        <td colspan='2' style="font-size: 14px;">
                          <small style="font-weight:900; font-size: 14px;">ETICA <small style="font-weight:900; font-size: 14px" class="text-danger">(Máximo 2 puntos)</small>: </small><br>
                          <small style="font-weight:700; font-size: 14px;">Establecer los valores y normas de conducta que debe regir y orientar la conducta de toda persona.</small>
                        </td>
                        <td colspan='2' style="font-size: 14px; font-weight:900;">
                          <input type="number" class="form-control text-center valor" name="etica" value="<?php if ($etica == NULL) {
                                                                                                          } else {
                                                                                                            echo $etica;
                                                                                                          } ?>">
                        </td>
                      </tr>
                      <tr>
                        <td style="font-weight:900;">4</td>
                        <td colspan='2' style="font-size: 14px;">
                          <small style="font-weight:900; font-size: 14px;">COMPETENCIAS <small style="font-weight:900; font-size: 14px" class="text-danger">(Máximo 5 puntos):</small> </small><br>
                          <small style="font-weight:700; font-size: 14px;">Habilidades, capacidades y conocimientos que la persona tiene para cumplir eficientemente determinada tarea.</small>
                        </td>
                        <td colspan='2' style="font-size: 14px; font-weight:900;">
                          <input type="number" class="form-control text-center valor" name="compet" value="<?php if ($competencias == NULL) {
                                                                                                            } else {
                                                                                                              echo $competencias;
                                                                                                            } ?>">
                        </td>
                      </tr>
                      <tr>
                        <td style="font-weight:900;">5</td>
                        <td colspan='2' style="font-size: 14px;">
                          <small style="font-weight:900; font-size: 14px;">CONOCIMIENTO ACADEMICO Y CULTURAL GENERAL <small style="font-weight:900; font-size: 14px" class="text-danger">(Máximo 9 puntos)</small>: </small><br>
                          <small style="font-weight:700; font-size: 14px;">Es el conjunto de información acumulada mediante el aprendizaje académico.</small>
                        </td>
                        <td colspan='2' style="font-size: 14px; font-weight:900;">
                          <input type="number" class="form-control text-center valor" name="cono_cult" value="<?php if ($conoc_academico == NULL) {
                                                                                                              } else {
                                                                                                                echo $conoc_academico;
                                                                                                              } ?>">
                        </td>
                      </tr>
                      <tr>
                        <td colspan='3' style="font-weight:900;">
                          <div class="d-flex justify-content-end">RESULTADO FINAL <small style="font-weight:900; font-size: 14px" class="text-danger"> (Máximo 20 puntos)</small></div>
                        </td>
                        <td colspan='2' style="font-size: 14px; font-weight:900;" class="d-flex justify-content-center">
                          <input type="number" class="form-control text-center" name="resultado" id="total" disabled value="<?php if ($puntaje_total == NULL) {
                                                                                                                            } else {
                                                                                                                              echo $puntaje_total;
                                                                                                                            } ?>">
                        </td>
                      </tr>
                      <tr>
                        <td colspan='3' style="font-weight:900;"></td>
                        <td colspan='2' style="font-size: 14px; font-weight:900;" class="d-flex justify-content-center">
                          <button class="btn btn-primary" type="submit" name="agregar_entre_prac"> AGREGAR</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </form>

              <div class="row d-flex justify-content-center m-3">
                <a href="listado_postu_prac.php?idpracticas=<?php echo $idpracticas ?>&idpracticantes_req=<?php echo $idpracticantes_req ?>&dni=<?php echo $dni ?>#profile" type="button" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i></i> Retroceder</a>
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
  <script src="js/suma_entrevista.js"></script>

</body>

</html>