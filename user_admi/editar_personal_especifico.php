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

  <title>AGREGAR PERSONAL REQUERIDO - SISTEMA SELECCION (DIRESA-TACNA)</title>

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
                  <h6 class="m-0 font-weight-bold text-primary">ACTUALIZAR DATOS PERSONAL REQUERIDO SELECCIONADO</h6>
                </div>
                <div class="card-body">
                  <?php
                  $idcon = $_GET['idcon'];
                  $idpersonal = $_GET['idpersonal'];
                  $sql = "SELECT * FROM sistema_seleccion.personal_req INNER JOIN sistema_seleccion.ubicacion 
                      ON personal_req.personal_req_idubicacion = ubicacion.iddireccion INNER JOIN sistema_seleccion.cargo 
                      ON personal_req.cargo_idcargo = cargo.idcargo
                      WHERE convocatoria_idcon='$idcon'";
                  $query = mysqli_query($con, $sql);
                  $row = mysqli_fetch_array($query);
                  ?>
                  <form action="procesos/actualizar_personal_especifico.php" autocomplete="off" method="POST">
                    <div class="row">
                      <div class="form-group font-weight-bolder">
                        <p class="text-danger">(*) Indica un campo obligatorio.</p>
                      </div>
                      <div class="col-md-12">
                        <h6 class="m-0 font-weight-bold text-danger">Datos del personal requeridos</h6>
                        <hr class="sidebar-divider">
                      </div>
                      <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
                      <input type="hidden" name="idconvocatoria" value="<?php echo $idcon ?>">
                      <div class="col-md-3 col-sm-12 form-group">
                        <label for="title">Cantidad requerida</label>
                        <input style="font-size:13px;" type="number" value="<?php echo $row['cantidad']; ?>" name="cantidad" class="form-control name_list" />
                      </div>
                      <div class="col-md-3 col-sm-12 form-group">
                        <?php $cargo = $row['idcargo']; ?>
                        <label for="title">(*) Cargo</label>
                        <select style="font-size:12px;" name="cargo" id="edit_cargo" class="form-control" required>
                          <?php
                          include_once('conexion.php');
                          $sql = mysqli_query($con, "SELECT * from cargo") or die("Problemas en consulta") . mysqli_error($sql);
                          while ($registro = mysqli_fetch_array($sql)) {
                            echo "<option value=\"" . $registro['idcargo'] . "\">" . $registro['cargo'] . "</option>";
                          }
                          ?>
                        </select>
                      </div>
                      <div class="col-md-3 col-sm-12 form-group">
                        <label for="title">(*) Remuneración</label>
                        <input style="font-size:13px;" type="text" name="remuneracion" value="<?php echo $row['remuneracion']; ?>" class="form-control name_list" required />
                      </div>
                      <div class="col-md-3 col-sm-12 form-group">
                        <?php $fuente = $row['fuente_finac']; ?>
                        <label for="title">(*) Fuente Financ.</label>
                        <select style="font-size:13px;" class="form-control" name="fuente_finac" id="edit_fuente_finac">
                          <option value="R. ORDINARIOS">R. ORDINARIOS</option>
                          <option value="R. DIRECTAMENTE RECAUDADOS">R. D. RECAUDADOS</option>
                          <option value="CANON SOBRE CANON">CANON SOBRE CANON</option>
                          <option value="R. DETERMINADOSS">R. DETERMINADOS</option>
                        </select>
                      </div>
                      <div class="col-md-3 col-sm-12 form-group">
                        <label for="title">(*) Meta</label>
                        <input style="font-size:13px;" type="number" name="meta" value="<?php echo $row['meta']; ?>" class="form-control name_list" required />
                      </div>
                      <div class="col-md-9 col-sm-12 form-group">
                        <?php $ubicacion = $row['iddireccion']; ?>
                        <label for="title">(*) Ubicación del personal requerido</label>
                        <select name="chosen-unique" class="chosen1" data-placeholder="Elige la ubicación del personal requerido" id="select_ubicacion_req">
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
                      <div class="col-md-12">
                        <h6 class="m-0 font-weight-bold text-danger">Elegir los Requesitos básicos</h6>
                        <hr class="sidebar-divider">
                      </div>
                      <?php
                      $select = "SELECT * FROM requerimientos INNER JOIN tipo_estudios 
                        ON requerimientos.reque_tipo_estudios = tipo_estudios.id_tipo_estudios WHERE reque_id_personal ='$idpersonal'";
                      $consulta = mysqli_query($con, $select);
                      $array = mysqli_fetch_array($consulta);
                      ?>
                      <div class="col-md-4 col-sm-12 form-group">
                        <?php $tipo_estudio = $array['id_tipo_estudios']; ?>
                        <label for="title">(*) Formación Academica</label>
                        <select name="formacion_requerida" class="form-control" id="select_formacion_requerida" required>
                          <option value="0">Seleccione:</option>
                          <?php
                          $query = $con->query("SELECT * FROM tipo_estudios");
                          while ($valores = mysqli_fetch_array($query)) {
                            echo '<option value="' . $valores['id_tipo_estudios'] . '">' . $valores['tipo_estudios'] . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                      <div class="col-md-4 col-sm-12 form-group" id="div_nivel_estudio_tecnico">
                        <label for="title">(*) Nivel estudios</label>
                        <select name="nivel_estudios_tec" id="nivel_estudios_tec" class="form-control">
                          <option value="TITULADO">Titulado</option>
                          <option value="EGRESADO">Egresado</option>
                        </select>
                      </div>
                      <div class="col-md-4 col-sm-12 form-group" id="div_nivel_estudio_prof">
                        <label for="title">(*) Nivel estudios</label>
                        <select name="nivel_estudios_prof" onChange="tipo_nivel_estudio_select(this)" class="form-control">
                          <option value="">Elegir...</option>
                          <option value="ESTUDIANTE">Estudiante</option>
                          <option value="EGRESADO">Egresado</option>
                          <option value="BACHILLER">Bachiller</option>
                          <option value="TITULADO">Titulado</option>
                        </select>
                      </div>
                      <div class="col-md-4 col-sm-12 form-group" id="div_ciclo_actual">
                        <label for="title">(*) Ciclo actual requerido</label>
                        <select name="ciclo_actual" class="form-control">
                          <option value="">Elegir</option>
                          <option value="VIII">VIII</option>
                          <option value="IX">IX</option>
                          <option value="X">X</option>
                        </select>
                      </div>
                      <div class="col-md-4 col-sm-12 form-group">
                        <label for="title">(*) Colegiatura </label>
                        <select name="colegiatura" class="form-control">
                          <option value="NO">NO</option>
                          <option value="SI">SI</option>
                        </select>
                      </div>

                      <div class="col-md-4 col-sm-12 form-group">
                        <label for="title">(*) Habilitación Profesional</label>
                        <select name="habilitacion" class="form-control">
                          <option value="NO">NO</option>
                          <option value="SI">SI</option>
                        </select>
                      </div>
                      <div class="col-md-4 col-sm-12 form-group">
                        <label for="title">(*) SERUMS </label>
                        <select name="serums" class="form-control">
                          <option value="NO">NO</option>
                          <option value="SI">SI</option>
                        </select>
                      </div>
                      <div class="col-md-4 col-sm-12 form-group">
                        <label for="title">(*) Experiencia laboral MÍNIMA</label>
                        <select name="tipo_experiencia" class="form-control" onChange="tipo_experiencia_select(this)">
                          <option value="">Elegir...</option>
                          <option value="anios">AÑOS</option>
                          <option value="meses">MESES</option>
                        </select>
                      </div>
                      <div class="col-md-4 col-sm-12 form-group" id="div_experiencia_meses">
                        <label for="title">(*) Tiempo experiencia en MESES</label>
                        <input type="number" name="cantidad_meses" class="form-control">
                      </div>
                      <div class="col-md-4 col-sm-12 form-group" id="div_experiencia_años">
                        <label for="title">(*) Tiempo experiencia en AÑOS</label>
                        <input type="number" name="cantidad_anios" class="form-control">
                      </div>
                      <div class="col-md-4 col-sm-12 form-group">
                        <label for="title">(*) Licencia de conducir </label>
                        <select name="licencia_conducir" id="licencia_conducir" class="form-control">
                          <option value="Ninguna">Ninguna</option>
                          <option value="A-IIb">A-IIb</option>
                          <option value="A-IIIa">A-IIIa</option>
                          <option value="A-IIIb">A-IIIb</option>
                          <option value="A-IIIc">A-IIIc</option>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="insert" class="btn btn-primary">Actualizar</button>
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
    $(function() {
      // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
      $("#adicional").on('click', function() {
        $("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla").find("input[type=text]").val("");
      });

      // Evento que selecciona la fila y la elimina 
      $(document).on("click", ".eliminar", function() {
        var parent = $(this).parents().get(0);
        $(parent).remove();
      });
    });
  </script>
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
    div_experiencia_meses = document.getElementById("div_experiencia_meses");
    div_experiencia_meses.style.display = "none";
    div_experiencia_años = document.getElementById("div_experiencia_años");
    div_experiencia_años.style.display = "none";

    function tipo_experiencia_select(sel) {
      if (sel.value == "anios") {
        div_experiencia_meses = document.getElementById("div_experiencia_meses");
        div_experiencia_meses.style.display = "none";
        div_experiencia_años = document.getElementById("div_experiencia_años");
        div_experiencia_años.style.display = "block";

      } else if (sel.value == "meses") {
        div_experiencia_meses = document.getElementById("div_experiencia_meses");
        div_experiencia_meses.style.display = "block";
        div_experiencia_años = document.getElementById("div_experiencia_años");
        div_experiencia_años.style.display = "none";

      }
    }

    function tipo_estudios_select(sel) {
      if (sel.value == "1") {

        div_nivel_estudio_tecnico = document.getElementById("div_nivel_estudio_tecnico");
        div_nivel_estudio_tecnico.style.display = "none";
        div_nivel_estudio_prof = document.getElementById("div_nivel_estudio_prof");
        div_nivel_estudio_prof.style.display = "none";
        div_ciclo_actual = document.getElementById("div_ciclo_actual");
        div_ciclo_actual.style.display = "none";

      } else if (sel.value == "2") {
        div_nivel_estudio_tecnico = document.getElementById("div_nivel_estudio_tecnico");
        div_nivel_estudio_tecnico.style.display = "block";
        div_nivel_estudio_prof = document.getElementById("div_nivel_estudio_prof");
        div_nivel_estudio_prof.style.display = "none";
        div_ciclo_actual = document.getElementById("div_ciclo_actual");
        div_ciclo_actual.style.display = "none";


      } else if (sel.value == "3") {
        div_nivel_estudio_tecnico = document.getElementById("div_nivel_estudio_tecnico");
        div_nivel_estudio_tecnico.style.display = "none";
        div_nivel_estudio_prof = document.getElementById("div_nivel_estudio_prof");
        div_nivel_estudio_prof.style.display = "block";
        div_ciclo_actual = document.getElementById("div_ciclo_actual");
        div_ciclo_actual.style.display = "none";

      }
    }

    function tipo_nivel_estudio_select(sel) {
      if (sel.value == "ESTUDIANTE") {
        div_ciclo_actual = document.getElementById("div_ciclo_actual");
        div_ciclo_actual.style.display = "block";

      } else if (sel.value == "EGRESADO" || sel.value == "EGRESADO" || sel.value == "BACHILLER" || sel.value == "TITULADO") {
        div_ciclo_actual = document.getElementById("div_ciclo_actual");
        div_ciclo_actual.style.display = "none";
      }
    }
  </script>
  <script>
    $(document).ready(function() {
      $('#edit_cargo > option[value="<?php echo $cargo ?>"]').attr('selected', 'selected');
      $('#edit_fuente_finac > option[value="<?php echo $fuente ?>"]').attr('selected', 'selected');
      $('#select_ubicacion_req > option[value="<?php echo $ubicacion ?>"]').attr('selected', 'selected');
      $('#select_formacion_requerida > option[value="<?php echo $tipo_estudio ?>"]').attr('selected', 'selected');


    });
  </script>
</body>

</html>