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

  <title>AGREGAR PRACTICANTES REQUERIDOS - SISTEMA SELECCION (DIRESA-TACNA)</title>

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
    $practicas_idcon = $_GET['practicas_idcon'];
    // $dni = $desencriptar($da1to_desencriptado);

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
                  <h6 class="m-0 font-weight-bold text-primary">AGREGAR DATOS DE LOS PRACTICANTES REQUERIDOS</h6>
                </div>
                <div class="card-body">
                  <?php
                  $sql = "SELECT * FROM practicas where idpracticas=$practicas_idcon";
                  $datos = mysqli_query($con, $sql);
                  $fila = mysqli_fetch_array($datos);

                  // $datos_2 = mysqli_query($con, "SELECT * FROM convocatoria INNER JOIN ubicacion
                  //   ON convocatoria.direccion_ejec_iddireccion = ubicacion.iddireccion WHERE idcon=$idcon");
                  // $fila_2 = mysqli_fetch_array($datos_2);
                  ?>
                  <div class="form-group">
                    <h6 class="m-0 font-weight-bold text-danger">Datos de la convocatoria</h6>
                    <hr class="sidebar-divider">
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-3 col-sm-12">
                      <label for="inputEmail4">N° de convocatoria</label>
                      <input type="text" class="form-control" value="<?php echo $fila['num_convoc'] . "-" . $fila['anio_convoc'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-3 col-sm-6">
                      <label for="inputEmail4">Fecha de inicio</label>
                      <input type="date" class="form-control" value="<?php echo $fila['fech_inicio'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-3 col-sm-6">
                      <label for="inputEmail4">Fecha de fin</label>
                      <input type="date" class="form-control" value="<?php echo $fila['fech_termino'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-3 col-sm-6">
                      <label for="inputEmail4">Estado convocatoria</label>
                      <input type="text" class="form-control" value="<?php echo $fila['estado_con'] ?>" disabled="true">
                    </div>
                  </div>
                  <form method="POST" action="procesos/guardar_personal_req.php">
                    <div class="form-group">
                      <h6 class="m-0 font-weight-bold text-danger">Datos del practicante requerido</h6>
                      <hr class="sidebar-divider">
                    </div>
                    <div class="form-group row">
                      <div class="col-md-12 d-flex justify-content-end">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Nuevo</a>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <tbody>
                          <?php
                          $consulta_form = "SELECT * FROM practicantes_req INNER JOIN ubicacion ON practicantes_req.practicantes_req_idubicacion= ubicacion.iddireccion INNER JOIN carrera ON practicantes_req.id_carrera_req = carrera.idcarrera  WHERE conv_idpracticas = '$practicas_idcon'";
                          $query = mysqli_query($con, $consulta_form);

                          if (mysqli_num_rows($query) > 0) {
                            $i = 1;
                            while ($row = MySQLI_fetch_array($query)) {
                              $idpracticantes_req = $row['idpracticantes_req'];
                          ?>
                              <thead>
                                <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                                  <th style="display:none;">id</th>
                                  <th>N°</th>
                                  <th>Tipo practicante</th>
                                  <th>Cantidad</th>
                                  <th>Remuneración</th>
                                  <th>Fuente Finac.</th>
                                  <th>Meta</th>
                                  <th>Carrera profesional</th>
                                  <th>Acciones</th>
                                </tr>
                              </thead>
                              <tr>
                                <td style="font-size: 12px; display:none;"><?php echo $idpracticantes_req ?></td>
                                <td style="font-size: 12px;"><?php echo $i ?></td>
                                <td style="font-size: 12px;"><?php echo $row['tipo_practicante'] ?></td>
                                <td style="font-size: 12px;"><?php echo $row['cantidad_req'] ?></td>
                                <td style="font-size: 12px;"><?php echo $row['remuneracion'] ?></td>
                                <td style="font-size: 12px;"><?php echo $row['fuente_finac'] ?></td>
                                <td style="font-size: 12px;"><?php echo $row['meta'] ?></td>
                                <td style="font-size: 12px;"><?php echo $row['nomb_carrera'] ?></td>
                                <td class="d-flex justify-content-center">
                                  <a type="button" href="editar_personal_especifico_prac.php?practicas_idcon=<?php echo $practicas_idcon ?>&idpracticantes_req=<?php echo $idpracticantes_req ?>&dni=<?php echo $dato_desencriptado ?>" class="btn btn-success btn-sm m-1">
                                    <i class="fa fa-edit"></i> Editar</a>
                                  <button type="button" class="btn btn-danger btn-sm m-1 deleteBtn"> <i class="fas fa-trash-alt"></i></button>
                                </td>
                              </tr>
                          <?php
                              $i++;
                            }
                          } else {
                            echo "<tr><td colspan='7' class='text-center text-danger font-weight-bold' >NO HAY DATOS REGISTRADOS</td></tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </form>
                </div>
                <div class="card-footer d-flex justify-content-end">
                  <a href="agregar_comision_prac.php?practicas_idcon=<?php echo $practicas_idcon ?>&dni=<?php echo $dato_desencriptado ?>" type="button" class="btn btn-primary">Siguiente</a>
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

  <!-- ADD NUEVOS DATOS -->
  <div class="modal fade" id="addModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Nuevo practicante requerido</h5>
          <button class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <div class="modal-body">
          <form action="procesos/guardar_personal_req_v2.php" autocomplete="off" method="POST">
            <div class="row">
              <div class="form-group font-weight-bolder">
                <p class="text-danger">(*) Indica un campo obligatorio.</p>
              </div>
              <div class="col-md-12">
                <h6 class="m-0 font-weight-bold text-danger">Datos del practicante requerido</h6>
                <hr class="sidebar-divider">
              </div>
              <input type="hidden" name="dni" value="<?php echo $dni ?>">
              <input type="hidden" name="practicas_idcon" value="<?php echo $practicas_idcon ?>">
              <div class="form-group col-md-3 col-sm-12">
                <label for="inputState">Tipo de practicante</label>
                <select name="tipo_practicante" style="font-size:13px;" onChange="tipo_practicante_select(this)" class=" form-control" autofocus required>
                  <option selected>Elegir...</option>
                  <option value="PRE-PROFESIONAL">PRE-PROFESIONAL</option>
                  <option value="PROFESIONAL">PROFESIONAL</option>
                </select>
              </div>
              <div class="col-md-3 col-sm-12 form-group">
                <label for="title">Cantidad requerida</label>
                <input style="font-size:13px;" type="number" name="cantidad" class="form-control name_list" required />
              </div>
              <div class="col-md-6 col-sm-12 form-group">
                <label for="title">Carrera requerida</label>
                <select name="carrera" class="form-control" required>
                  <option value="">Elegir...</option>
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
                <input style="font-size:13px;" type="text" name="remuneracion" value="930" class="form-control name_list" />
              </div>
              <div class="col-md-3 col-sm-12 form-group">
                <label for="title">(*) Fuente Financ.</label>
                <select style="font-size:13px;" class="form-control" name="fuente_finac" required>
                  <option value="R. ORDINARIOS">R. ORDINARIOS</option>
                  <option value="R. DIRECTAMENTE RECAUDADOS">R. D. RECAUDADOS</option>
                  <option value="CANON SOBRE CANON">CANON SOBRE CANON</option>
                  <option value="R. DETERMINADOSS">R. DETERMINADOS</option>
                </select>
              </div>
              <div class="col-md-3 col-sm-12 form-group">
                <label for="title">(*) Meta</label>
                <input style="font-size:13px;" type="text" name="meta" placeholder="Ejemplo: 002" class="form-control name_list" required />
              </div>
              <div class="col-md-12 col-sm-12 form-group">
                <label for="title">(*) Ubicación del practicante requerido</label>
                <select name="chosen-unique" class="chosen1" data-placeholder="Elige la ubicación del personal requerido" required>
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
              <button type="submit" name="agregar_practicante" class="btn btn-primary">Agregar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- DELETE MODAL -->
  <div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar registro de practicante requerido</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="procesos/borrar_personal_req.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="deleteId" id="deleteId">
            <input type="hidden" name="practicas_idcon" value="<?php echo $practicas_idcon ?>">
            <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
            <h4>¿Desea eliminar el registro de formación?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
            <button type="submit" class="btn btn-danger" name="eliminar_practica">SI</button>
          </div>

        </form>
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
    $(document).ready(function() {
      $('.deleteBtn').on('click', function() {

        $('#deleteModal').modal('show');

        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);

        $('#deleteId').val(data[0]);

      });
    });
  </script>
  <script>
    jQuery(document).ready(function() {
      jQuery(".chosen1").chosen({
        disable_search_threshold: 10,
        no_results_text: "Oops, no ha sido encontrado!",
        width: "100%"
      });
    });
  </script>
  <script>
    div_experiencia_meses = document.getElementById("div_nivel_estudio_est");
    div_experiencia_meses.style.display = "none";
    div_experiencia_años = document.getElementById("div_nivel_estudio_egre");
    div_experiencia_años.style.display = "none";
    div_experiencia_años = document.getElementById("div_ciclo_actual");
    div_experiencia_años.style.display = "none";

    function tipo_practicante_select(sel) {
      if (sel.value == "PRE-PROFESIONAL") {
        div_experiencia_meses = document.getElementById("div_nivel_estudio_est");
        div_experiencia_meses.style.display = "block";
        div_experiencia_años = document.getElementById("div_ciclo_actual");
        div_experiencia_años.style.display = "block";
        div_experiencia_años = document.getElementById("div_nivel_estudio_egre");
        div_experiencia_años.style.display = "none";
      } else if (sel.value == "PROFESIONAL") {
        div_experiencia_meses = document.getElementById("div_nivel_estudio_est");
        div_experiencia_meses.style.display = "none";
        div_experiencia_años = document.getElementById("div_ciclo_actual");
        div_experiencia_años.style.display = "none";
        div_experiencia_años = document.getElementById("div_nivel_estudio_egre");
        div_experiencia_años.style.display = "block";
      }
    }
  </script>

</body>

</html>