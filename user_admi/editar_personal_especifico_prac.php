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

  <title>Editar practicante requerido - SISTEMA SELECCION (DIRESA-TACNA)</title>

  <!-- Custom fonts for this template-->
  <link rel="icon" type="image/png" href="img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/lib/chosen/chosen.css">

</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php
    $dni = $_GET['dni'];
    $dato_desencriptado = $_GET['dni'];
    // $dni = $desencriptar($dato_desencriptado);

    $sql = "SELECT * FROM usuarios where dni=$dni";
    $datos = mysqli_query($con, $sql) or die(mysqli_error($datos));
    $buscar = mysqli_fetch_array($datos);
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
          <!-- <h1 class="h3 mb-4 text-gray-800">Blank Page</h1> -->
          <div class="row">
            <div class="col-lg-12">
              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">ACTUALIZAR DATOS PRACTICANTE REQUERIDO SELECCIONADO</h6>
                </div>
                <div class="card-body">
                  <?php
                  $practicas_idcon = $_GET['practicas_idcon'];
                  $idpracticantes_req = $_GET['idpracticantes_req'];
                  $sql = "SELECT * FROM practicantes_req INNER JOIN ubicacion ON practicantes_req.practicantes_req_idubicacion= ubicacion.iddireccion INNER JOIN carrera ON practicantes_req.id_carrera_req = carrera.idcarrera  WHERE idpracticantes_req = '$idpracticantes_req'";
                  $query = mysqli_query($con, $sql);
                  $array = mysqli_fetch_array($query);
                  ?>
                  <form action="procesos/modificar_convoca.php" autocomplete="off" method="POST">
                    <div class="row">
                      <div class="col-md-12 font-weight-bolder">
                        <p class="text-danger">(*) Indica un campo obligatorio.</p>
                      </div>
                      <div class="col-md-12">
                        <h6 class="m-0 font-weight-bold text-danger">Datos del practicante requerido</h6>
                        <hr class="sidebar-divider">
                      </div>
                      <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
                      <input type="hidden" name="practicas_idcon" value="<?php echo $practicas_idcon ?>">
                      <input type="hidden" name="idpracticantes_req" value="<?php echo $idpracticantes_req ?>">
                      <div class="form-group col-md-3 col-sm-12">
                        <?php $tipo_practicante = $array['tipo_practicante']; ?>
                        <label for="inputState">Tipo de practicante</label>
                        <select name="tipo_practicante" style="font-size:13px;" id="tipo_practicante" class=" form-control" autofocus required>
                          <option value="PRE-PROFESIONAL">PRE-PROFESIONAL</option>
                          <option value="PROFESIONAL">PROFESIONAL</option>
                        </select>
                      </div>
                      <div class="col-md-3 col-sm-12 form-group">
                        <label for="title">Cantidad requerida</label>
                        <input style="font-size:13px;" type="number" name="cantidad" value="<?php echo $array['cantidad_req'] ?>" class="form-control" required />
                      </div>
                      <div class="col-md-6 col-sm-12 form-group">
                        <?php $carrera = $array['id_carrera_req']; ?>
                        <label for="title">Carrera requerida</label>
                        <select name="carrera" id="carrera" class="form-control" required>
                          <?php
                          $sql = "SELECT * FROM carrera";
                          $res = mysqli_query($con, $sql) or die("Problemas en consulta") . mysqli_error($res);
                          while ($rw = mysqli_fetch_array($res)) {
                            echo "<option value=" . $rw["idcarrera"] . ">" . $rw["nomb_carrera"] . "</option> ";
                          }
                          ?>
                        </select>
                      </div>
                      <div class="col-md-3 col-sm-12 form-group">
                        <label for="title">(*) Remuneración</label>
                        <input style="font-size:13px;" type="text" name="remuneracion" value="<?php echo $array['remuneracion'] ?>" class="form-control name_list" />
                      </div>
                      <div class="col-md-3 col-sm-12 form-group">
                        <?php $fuente_finac = $array['fuente_finac']; ?>
                        <label for="title">(*) Fuente Financ.</label>
                        <select style="font-size:13px;" class="form-control" name="fuente_finac" id="fuente_finac" required>
                          <option value="R. ORDINARIOS">R. ORDINARIOS</option>
                          <option value="R. DIRECTAMENTE RECAUDADOS">R. D. RECAUDADOS</option>
                          <option value="CANON SOBRE CANON">CANON SOBRE CANON</option>
                          <option value="R. DETERMINADOSS">R. DETERMINADOS</option>
                        </select>
                      </div>
                      <div class="col-md-3 col-sm-12 form-group">
                        <label for="title">(*) Meta</label>
                        <input style="font-size:13px;" type="text" name="meta" value="<?php echo $array['meta'] ?>" class="form-control" required />
                      </div>
                      <div class="col-md-12 col-sm-12 form-group">
                        <?php $ubicacion = $array['practicantes_req_idubicacion']; ?>
                        <?php
                        $ubicacion_consul = "SELECT * FROM ubicacion WHERE iddireccion= '$ubicacion'";
                        $res = mysqli_query($con, $ubicacion_consul);
                        $arr = mysqli_fetch_array($res);
                        $direccion_ejec = $arr['direccion_ejec'];
                        $equipo_ejec = $arr['equipo_ejec'];
                        ?>

                        <label for="title">(*) Ubicación del practicante requerido (si no se va hacer cambios, dejar tal y como esta)</label>
                        <h6 class="text-success font-weight-bold">Opcion elegida: <?php echo $direccion_ejec . " - " . $equipo_ejec; ?></h6>
                        <select name="chosen-unique" id="ubicacion" class="chosen1" data-placeholder="Elige la ubicación del personal requerido">
                          <option value=""></option>
                          <?php
                          $sql = "SELECT * FROM ubicacion";
                          $res = mysqli_query($con, $sql) or die("Problemas en consulta") . mysqli_error($res);
                          while ($rw = mysqli_fetch_array($res)) {
                            echo "<option value=" . $rw["iddireccion"] . ">" . $rw["direccion_ejec"] . " - " . $rw["equipo_ejec"] . "</option> ";
                          }
                          ?>
                        </select>
                      </div>
                      <div class="col-md-12 form-group">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Definir la formación académica requerida:</h6>
                      </div>
                      <div class="col-md-4 col-sm-12 form-group" id="div_nivel_estudio_est">
                        <label for="title">(*) Nivel estudios</label>
                        <input style="font-size:13px;" type="text" name="nivel_estudiante" value="ESTUDIANTE" class="form-control name_list" />
                      </div>
                      <div class="col-md-4 col-sm-12 form-group" id="div_nivel_estudio_egre">
                        <label for="title">(*) Nivel estudios</label>
                        <input style="font-size:13px;" type="text" name="nivel_egresado" value="EGRESADO" class="form-control name_list" />
                      </div>
                      <div class="col-md-4 col-sm-12 form-group" id="div_ciclo_actual">
                        <label for="title">(*) Ciclo mínimo requerido</label>
                        <select name="ciclo_minimo" class="form-control">
                          <option value="VI" selected>VI</option>
                          <option value="VII">VII</option>
                          <option value="VIII">VIII</option>
                          <option value="IX">IX</option>
                          <option value="X">X</option>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <a href="editar_convocatoria_cas.php?idcon=<?php echo $idcon ?>&dni=<?php echo $dni ?>#profile" type="button" class="btn btn-secondary">Retroceder</a>
                      <button type="submit" name="updatePracReq" class="btn btn-primary">Actualizar</button>
                    </div>
                  </form>
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


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.js"></script>
  <script src="js/lib/chosen/chosen.jquery.min.js"></script>
  <script>
    jQuery(document).ready(function() {
      jQuery(".chosen1").chosen({
        disable_search_threshold: 10,
        no_results_text: "Oops, no ha sido encontrado!",
        width: "100%"
      });
    });

    $(document).ready(function() {
      $('#tipo_practicante > option[value="<?php echo $tipo_practicante ?>"]').attr('selected', 'selected');
      $('#carrera > option[value="<?php echo $carrera ?>"]').attr('selected', 'selected');
      $('#fuente_finac > option[value="<?php echo $fuente_finac ?>"]').attr('selected', 'selected');
      $('#ubicacion > option[value="<?php echo $ubicacion ?>"]').attr('selected', 'selected');
    });
  </script>
  <script>
    $(function() {
      $("#tipo_practicante").on('change', function() {
        var selectValue = $(this).val();
        switch (selectValue) {
          case "PRE-PROFESIONAL":
            $("#div_nivel_estudio_est").show();
            $("#div_nivel_estudio_egre").hide();
            $("#div_ciclo_actual").show();
            break;
          case "PROFESIONAL":
            $("#div_nivel_estudio_est").hide();
            $("#div_nivel_estudio_egre").show();
            $("#div_ciclo_actual").hide();
            break;
        }
      }).change();
    });
  </script>

</body>

</html>