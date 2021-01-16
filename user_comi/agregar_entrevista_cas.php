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

  <title>Agregar puntaje entrevista postulante CAS - DIRESA TACNA</title>

  <!-- Custom fonts for this template -->
  <link rel="icon" type="image/png" href="img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="vendor/sweetalert2.min.css">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php
    $dni = $_GET['dni'];
    $dato_desencriptado = $_GET['dni'];
    // $dni = $desencriptar($dato_desencriptado);
    $idpostulante = $_GET['idpostulante'];
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
              <h6 class="m-0 font-weight-bold text-primary">AGREGAR PUNTAJES DE LA ENTREVISTA LABORAL PARA CAS</h6>
            </div>
            <div class="card-body">
              <?php
              $sql = "SELECT * FROM postulante where idpostulante=$idpostulante";
              $datos = mysqli_query($con, $sql);
              $fila = mysqli_fetch_array($datos);
              $dni_postulante = $fila['dni'];
              $sql_2 = "SELECT * FROM convocatoria where idcon=$idcon";
              $datos_2 = mysqli_query($con, $sql_2);
              $fila_2 = mysqli_fetch_array($datos_2);
              $sql_3 = "SELECT * FROM personal_req INNER JOIN cargo_full ON personal_req.cargo_idcargo = cargo_full.idcargo where idpersonal=$idpersonal";
              $datos_3 = mysqli_query($con, $sql_3);
              $fila_3 = mysqli_fetch_array($datos_3);
              $sql_4 = "SELECT * FROM detalle_convocatoria WHERE convocatoria_idcon='$idcon' AND personal_req_idpersonal='$idpersonal' AND postulante_idpostulante='$idpostulante'";
              $datos_4 = mysqli_query($con, $sql_4);
              $fila_4 = mysqli_fetch_array($datos_4);
              $iddetalle_convocatoria = $fila_4['iddetalle_convocatoria'];
              $estado_entrevista = $fila_4['estado_entrevista_cas'];
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
                  <input type="text" class="form-control" value="<?php echo $fila_2['num_con'] . " - " . $fila_2['anio_con'] ?>" disabled="true">
                </div>
                <div class="form-group col-md-2 col-sm-6">
                  <label for="inputEmail4">Cargo requerido</label>
                  <input type="text" class="form-control" value="<?php echo $fila_3['cargo'] ?>" disabled="true">
                </div>
                <div class="form-group col-md-2 col-sm-6">
                  <label for="inputEmail4">Cargo especifico</label>
                  <input type="text" class="form-control" value="<?php echo $fila_3['nomb_cargo_espec'] ?>" disabled="true">
                </div>

              </div>
              <div class="form-group">
                <h6 class="m-0 font-weight-bold text-danger">FICHA DE EVALUACIÓN DE ENTREVISTA PERSONAL</h6>
                <hr class="sidebar-divider">
              </div>
              <?php
              $mensaje = '';
              if ($estado_entrevista == 'NO AGREGADO') {
                $mensaje = "Falta agregar los puntos de la entrevista al postulante CAS";
                $aspecto_personal = NULL;
                $seguridad_estabilidad = NULL;
                $capacidad_persu = NULL;
                $capacidad_decisi = NULL;
                $conocimiento_gen = NULL;
                $puntaje_total = NULL;
              } else {
                $id_entrevista_cas = $fila_4['id_entrevista_cas'];
                $consul_entre = mysqli_query($con, "SELECT * FROM entrevista_cas WHERE id_entrevista_cas = '$id_entrevista_cas'");
                $fila_5 = mysqli_fetch_array($consul_entre);
                $aspecto_personal = $fila_5['aspecto_personal'];
                $seguridad_estabilidad = $fila_5['seguridad_estabilidad'];
                $capacidad_persu = $fila_5['capacidad_persu'];
                $capacidad_decisi = $fila_5['capacidad_decisi'];
                $conocimiento_gen = $fila_5['conocimiento_gen'];
                $puntaje_total = $fila_5['puntaje_total'];

                $mensaje = "Usted ya agregó los puntos de la entrevista.";
              }
              ?>
              <div class="row d-flex justify-content-center">
                <h5 class="font-weight-bold text-success"><i class="far fa-hand-point-right"></i> <?php echo $mensaje; ?></h5>
              </div>
              <form id="form_entrevista" method="POST">
                <div class="table-responsive" id="contenido">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>N°</th>
                        <th colspan='2'>Factores de evaluación</th>
                        <th>PUNTAJE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <input type="hidden" name="iddetalle_convocatoria" value="<?php echo $iddetalle_convocatoria ?>">
                      <input type="hidden" name="dni_comision" value="<?php echo $dni ?>">
                      <input type="hidden" name="idcon" value="<?php echo $idcon ?>">
                      <input type="hidden" name="idpersonal" value="<?php echo $idpersonal ?>">
                      <input type="hidden" name="idpostulante" value="<?php echo $idpostulante ?>">
                      <input type="hidden" name="dni_postulante" value="<?php echo $dni_postulante ?>">
                      <tr>
                        <td style="font-weight:900;">1</td>
                        <td colspan='2' style="font-size: 14px;">
                          <small style="font-weight:900; font-size: 14px;">ASPECTO PERSONAL <small style="font-weight:900; font-size: 14px" class="text-danger">(Máximo 20 puntos)</small>: </small><br>
                          <small style="font-weight:700; font-size: 14px;">Mide la presencia, la naturalidad en el vestir, higiene y la limpieza.</small>
                        </td>
                        <td colspan='2' style="font-size: 14px; font-weight:900;"><input type="number" autocomplete="off" class="form-control text-center valor" name="aspec_perso" id="valor_1" value="<?php if ($aspecto_personal == NULL) {
                                                                                                                                                                                      } else {
                                                                                                                                                                                        echo $aspecto_personal;
                                                                                                                                                                                      } ?>">
                        </td>
                      </tr>
                      <tr>
                        <td style="font-weight:900;">2</td>
                        <td colspan='2' style="font-size: 14px;">
                          <small style="font-weight:900; font-size: 14px;">SEGURIDAD Y ESTABILIDAD EMOCIONAL <small style="font-weight:900; font-size: 14px" class="text-danger">(Máximo 20 puntos)</small>: </small><br>
                          <small style="font-weight:700; font-size: 14px;">Mide el grado de seguridad y serenidad del postulante para expresar sus ideas, aplomo para adaptarse a determinadas circunstancias.</small>
                        </td>
                        <td colspan='2' style="font-size: 14px; font-weight:900;"><input type="number" autocomplete="off" class="form-control text-center valor" name="segu_estab" id="valor_2" value="<?php if ($seguridad_estabilidad == NULL) {
                                                                                                                                                                                    } else {
                                                                                                                                                                                      echo $seguridad_estabilidad;
                                                                                                                                                                                    } ?>">
                        </td>
                      </tr>
                      <tr>
                        <td style="font-weight:900;">3</td>
                        <td colspan='2' style="font-size: 14px;">
                          <small style="font-weight:900; font-size: 14px;">CAPACIDAD DE PERSUACION <small style="font-weight:900; font-size: 14px" class="text-danger">(Máximo 20 puntos)</small>: </small><br>
                          <small style="font-weight:700; font-size: 14px;">Mide la habilidad en la expresión oral y persuasión del postulante para emitir argumentos válidos a fin de lograr aceptación de sus ideas.</small>
                        </td>
                        <td colspan='2' style="font-size: 14px; font-weight:900;"><input type="number" autocomplete="off" class="form-control text-center valor" name="etica" id="valor_3" value="<?php if ($capacidad_persu == NULL) {
                                                                                                                                                                                } else {
                                                                                                                                                                                  echo $capacidad_persu;
                                                                                                                                                                                } ?>"></td>
                      </tr>
                      <tr>
                        <td style="font-weight:900;">4</td>
                        <td colspan='2' style="font-size: 14px;">
                          <small style="font-weight:900; font-size: 14px;">CAPACIDAD PARA TOMAR DECISIONES <small style="font-weight:900; font-size: 14px" class="text-danger">(Máximo 20 puntos):</small> </small><br>
                          <small style="font-weight:700; font-size: 14px;">Mide el grado de capacidad de análisis, raciocinio y habilidad para sacar conclusiones válidas y elegir la alternativa más adecuada con el fin conseguir resultados.</small>
                        </td>
                        <td colspan='2' style="font-size: 14px; font-weight:900;"><input type="number" autocomplete="off" class="form-control text-center valor" name="compet" id="valor_4" value="<?php if ($capacidad_decisi == NULL) {
                                                                                                                                                                                } else {
                                                                                                                                                                                  echo $capacidad_decisi;
                                                                                                                                                                                } ?>"></td>
                      </tr>
                      <tr>
                        <td style="font-weight:900;">5</td>
                        <td colspan='2' style="font-size: 14px;">
                          <small style="font-weight:900; font-size: 14px;">CONOCIMIENTO DE CULTURAL GENERAL <small style="font-weight:900; font-size: 14px" class="text-danger">(Máximo 20 puntos)</small>: </small><br>
                          <small style="font-weight:700; font-size: 14px;">Mide el grado de información general y adaptación al medio que lo rodea.</small>
                        </td>
                        <td colspan='2' style="font-size: 14px; font-weight:900;"><input type="number" autocomplete="off" class="form-control text-center valor" name="cono_cult" id="valor_5" value="<?php if ($conocimiento_gen == NULL) {
                                                                                                                                                                                    } else {
                                                                                                                                                                                      echo $conocimiento_gen;
                                                                                                                                                                                    } ?>"></td>
                      </tr>
                      <tr>
                        <td colspan='3'>
                          <small style="font-weight:900; font-size: 14px;" class="d-flex justify-content-end">TOTAL <small style="font-weight:900; font-size: 14px" class="text-danger"> (Máximo 100 puntos)</small>: </small>
                        </td>
                        <td colspan='2' style="font-size: 14px; font-weight:900;"><input type="number" class="form-control text-center" name="total_puntaje" id="total" disabled value="<?php if ($puntaje_total == NULL) {
                                                                                                                                                                                        } else {
                                                                                                                                                                                          echo $puntaje_total;
                                                                                                                                                                                        } ?>"></td>
                      </tr>
                      <tr>
                        <td colspan='3' style="font-weight:900;"></td>
                        <td colspan='2' style="font-size: 14px; font-weight:900;" class="d-flex justify-content-center">
                          <button class="btn btn-primary" type="submit" id="agregar_puntaje"><i class="far fa-plus-square"></i> Agregar</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </form>

              <div class="row d-flex justify-content-center m-3">
                <a href="listado_postu_cas.php?idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dni ?>#entrevista" type="button" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i></i> Retroceder</a>
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
  <script src="vendor/sweetalert2.js"></script>
  <script src="js/suma_entrevista.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
  <script type="text/javascript">
    $(document).ready(function() {
      $('#agregar_puntaje').click(function() {
        var datos = $('#form_entrevista').serialize();
        $.ajax({
          type: "POST",
          url: "procesos/agregar_entrevista_cas.php",
          data: datos,
          success: function(r) {
            console.log("Mensaje: ", r);
            const respuesta = JSON.parse(r);
            console.log("JSON: ", respuesta);
            console.log("Mi r: ", respuesta.r);
            if (respuesta.r == 1) {
              Swal.fire({
                title: 'ENTREVISTA AGREGADA',
                text: respuesta.mensaje,
                icon: 'success',
                confirmButtonText: 'Aceptar'
              }).then(function() {
                window.location = "listado_postu_cas.php?idcon=" + respuesta.idcon + "&idpersonal=" + respuesta.idpersonal + "&dni=" + respuesta.dni+"#entrevista";
              });
            } else {
              Swal.fire({
                title: 'ERROR AL CALCULAR',
                text: respuesta.mensaje,
                icon: 'error',
                confirmButtonText: 'Aceptar',
              });
            }
          }
        });
        return false;
      });
    });
  </script>

</body>

</html>