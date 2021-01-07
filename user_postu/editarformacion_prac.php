<?php
include 'conexion.php';
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

  <title>Editar formación DIRESA - TACNA</title>

  <!-- Custom fonts for this template-->
  <link rel="icon" type="image/png" href="img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <link href="css/estilos.css" rel="stylesheet">

</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php
    include '../funcs/mcript.php';
    $dni = $_GET['dni'];
    $dato_desencriptado = SED::decryption($dni);

    $sql = "SELECT * FROM usuarios where dni=$dato_desencriptado";
    $datos = mysqli_query($con, $sql) or die(mysqli_error($sql2));;
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
          <?php
          include 'conexion.php';

          $sql2 = "SELECT * FROM postulante WHERE dni=$dato_desencriptado";
          $datos2 = mysqli_query($con, $sql2) or die(mysqli_error($sql2));;
          $fila2 = mysqli_fetch_array($datos2);
          $idpostulante = $fila2['idpostulante'];
          ?>
          <!-- Page Heading -->
          <!-- Content Row -->
          <div class="card border-success">
            <div class="card-header bg-success">
              <div class="row">
                <div class="col-md-6">
                  <h5 class="titulo-card text-white">Mis datos profesionales</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              <?php
              $id_formacion = $_GET['idformacion_prac'];
              $consulta_form = "SELECT * FROM formacion_acad_prac WHERE idformacion_acad_prac = $id_formacion";
              $query = mysqli_query($con, $consulta_form);
              $row = MySQLI_fetch_array($query)
              ?>
              <form action="procesos/actualizar_formacion.php" enctype="multipart/form-data" autocomplete="off" method="POST">
                <div class="row">
                  <input type="hidden" name="dni_encriptado" value="<?php echo $dato_desencriptado ?>">
                  <input type="hidden" name="dni" value="<?php echo $dni ?>">
                  <input type="hidden" name="id_formacion" value="<?php echo $id_formacion ?>">
                  <div class="col-md-12 col-sm-12 form-group">
                    <p class="text-danger font-weight-bolder">(*) Indica un campo obligatorio.</p>
                    <p class="text-danger font-weight-bolder">(**) En el campo "FECHA" debe indicar la fecha de obtención del "NIVEL DE ESTUDIOS" que está registrando. En el caso de estudiante, debe indicar la fecha del ciclo culminado que está registrando.</p>
                  </div>
                  <div class="col-md-3 col-sm-12 form-group">
                    <label for="title">(*) Tipo estudio</label>
                    <label class="form-control" value="UNIVERSITARIO">UNIVERSITARIO</label>
                  </div>
                  <div class="col-md-3 col-sm-12 form-group" id="div_nivel_estudio_prof">
                    <?php $nivel_estudio = $row['nivel_estudios'] ?>
                    <label for="title">(*) Nivel estudios</label>
                    <select name="nivel_estudios_prof" id="tipo_nivel_estudio" class="form-control">
                      <option value="">Elegir...</option>
                      <option value="ESTUDIANTE">Estudiante</option>
                      <option value="EGRESADO">Egresado</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-12 form-group" id="div_ciclo_actual">
                    <?php $ciclo_actual = $row['ciclo_actual'] ?>
                    <label for="title">(*) Ciclo actual</label>
                    <select name="ciclo_actual" id="ciclo_actual" class="form-control">
                      <option value="NINGUNO">Elegir...</option>
                      <option value="VI">VI</option>
                      <option value="VII">VII</option>
                      <option value="VIII">VIII</option>
                      <option value="IX">IX</option>
                      <option value="X">X</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-12 form-group" id="div_fecha_inicio">
                    <label for="title">(**) Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control" value="<?php echo $row['fecha_inicio'] ?>">
                  </div>
                  <div class="col-md-3 col-sm-12 form-group" id="div_fecha_fin">
                    <label for="title">(**) Fecha Término</label>
                    <input type="date" name="fecha_fin" class="form-control" value="<?php echo $row['fecha_fin'] ?>">
                  </div>
                  <div class="col-md-6 col-sm-12 form-group" id="div_centro_estudios">
                    <label for="title">(*) Nombre de universidad</label>
                    <input type="text" style="text-transform:uppercase; font-size:12px" name="centro_estudios" class="form-control" placeholder="Nombre de la universidad" value="<?php echo $row['centro_estudios'] ?>" required>
                  </div>
                  <div class="col-md-6 col-sm-12 form-group" id="div_carrera">
                    <label for="title">(*) Carrera profesional (Nombre completo)</label>
                    <input type="text" name="carrera" style="text-transform:uppercase; font-size:12px" class="form-control" placeholder="Nombre de la carrera profesional" value="<?php echo $row['carrera'] ?>">
                  </div>
                  <div class="col-md-10 col-sm-12 form-group" id="archivo">
                    <label for="title">(*) Archivo para validar formación (Dejar en blanco en caso no desea actualizar).</label>
                    <input type="file" name="archivo" accept=".pdf" id="file-upload" />
                    <div id="peso_archivo_valido" class="font-weight-bolder text-primary"></div>
                    <div id="peso_archivo_no" class="font-weight-bolder text-danger"></div>
                  </div>
                  <div class="col-md-12">
                    <h6 class="m-0 font-weight-bold text-success">Elegir el orden de mérito (caso contrario no elegir ninguna opcion).</h6>
                    <hr class="sidebar-divider">
                  </div>
                  <div class="col-md-4 col-sm-12 form-group">
                    <?php $orden_merito = $row['orden_merito'] ?>
                    <label for="title">(*) Tipo de orden de mérito</label>
                    <select name="orden_merito" id="orden_merito" class="form-control">
                      <option value="NINGUNO">Elegir...</option>
                      <option value="TERCIO SUPERIOR">Tercio Superior</option>
                      <option value="QUINTO SUPERIOR">Quinto Superior</option>
                    </select>
                  </div>
                  <div class="col-md-8 col-sm-12 form-group" id="archivo">
                    <label for="title">(*) Archivo para validar orden de mérito (Dejar en blanco en caso no desea actualizar).</label>
                    <input type="file" name="archivo_merito" accept=".pdf" id="merito_archivo" />
                    <div id="peso_archivo_valido_2" class="font-weight-bolder text-primary"></div>
                    <div id="peso_archivo_no_2" class="font-weight-bolder text-danger"></div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <a href="formacion_prac.php?dni=<?php echo $dni  ?>" type="button" class="btn btn-secondary">Cancelar</a>
              <button type="submit" name="editar_prac" class="btn btn-success">Actualizar</a>
            </div>
            </form>
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
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  <script src="js/actualizar_form_prac.js"></script>
  <script>
    $(document).ready(function() {
      $('#tipo_nivel_estudio > option[value="<?php echo $nivel_estudio ?>"]').attr('selected', 'selected');
      $('#ciclo_actual > option[value="<?php echo $ciclo_actual ?>"]').attr('selected', 'selected');
      $('#orden_merito > option[value="<?php echo $orden_merito ?>"]').attr('selected', 'selected');
    });

    $(function() {
      $("#tipo_nivel_estudio").on('change', function() {
        var selectValue = $(this).val();
        switch (selectValue) {
          case "ESTUDIANTE":
            $("#div_ciclo_actual").show();
            break;
          case "EGRESADO":
            $("#div_ciclo_actual").hide();
            break;
        }
      }).change();
    });

    //binds to onchange event of your input field
    $('#file-upload').bind('change', function() {
      //this.files[0].size gets the size of your file.
      var peso = (this.files[0].size);
      if (peso <= 3000000) {
        document.getElementById('peso_archivo_valido').innerHTML = "Archivo válido";
        document.getElementById("peso_archivo_valido").style.display = "block";
        document.getElementById("peso_archivo_no").style.display = "none";
      } else {
        document.getElementById('peso_archivo_no').innerHTML = "El archivo sobre pasa los 3Mb máximos";
        document.getElementById("peso_archivo_valido").style.display = "none";
        document.getElementById("peso_archivo_no").style.display = "block";
        document.getElementById("info").value = '';
        document.getElementById("file-upload").value = '';

      }
      // alert(this.files[0].size);
    });
    $('#merito_archivo').bind('change', function() {
      var peso = (this.files[0].size);
      if (peso <= 3000000) {
        document.getElementById('peso_archivo_valido_2').innerHTML = "Archivo válido";
        document.getElementById("peso_archivo_valido_2").style.display = "block";
        document.getElementById("peso_archivo_no_2").style.display = "none";
      } else {
        document.getElementById('peso_archivo_no_2').innerHTML = "El archivo sobre pasa los 3Mb máximos";
        document.getElementById("peso_archivo_valido_2").style.display = "none";
        document.getElementById("peso_archivo_no_2").style.display = "block";
        document.getElementById("expe1_archivo_2").value = '';
        document.getElementById("merito_archivo").value = '';
      }
    });
  </script>
</body>

</html>