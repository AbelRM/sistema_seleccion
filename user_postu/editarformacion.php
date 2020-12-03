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
    include 'funcs/mcript.php';
    $dni = $_GET['dni'];
    $dato_desencriptado = $_GET['dni'];
    // $dni = $desencriptar($dato_desencriptado);

    $sql = "SELECT * FROM usuarios where dni=$dni";
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

          $sql2 = "SELECT * FROM postulante WHERE dni=$dni";
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
              $id_formacion = $_GET['idformacion'];
              $consulta_form = "SELECT * FROM formacion_acad 
                inner join tipo_estudios ON formacion_acad.tipo_estudios_id=tipo_estudios.id_tipo_estudios 
                WHERE id_formacion = $id_formacion";
              $query = mysqli_query($con, $consulta_form);
              $row = MySQLI_fetch_array($query)
              ?>
              <form action="procesos/actualizar_formacion.php" enctype="multipart/form-data" autocomplete="off" method="POST">
                <div class="row">
                  <div class="form-group text-danger font-weight-bold">
                    <p>(*) Indica un campo obligatorio.</p>
                    <p>(**) En el campo "FECHA" debe indicar la fecha de obtención del "NIVEL DE ESTUDIOS" que está registrando.
                      En el caso de estudiante, debe indicar la fecha del ciclo culminado que está registrando.</p>
                  </div>
                  <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
                  <input type="hidden" name="dni_descrip" value="<?php echo $dni ?>">
                  <input type="hidden" name="idformacion" value="<?php echo $id_formacion ?>">
                  <div class="col-md-3 col-sm-12 form-group">
                    <?php $tipo_estudio_edit = $row['tipo_estudios_id'] ?>
                    <label for="title">(*) Tipo estudio</label>
                    <select class="form-control" name="tipo_estudios_edit" id="tipo_estudios_select" required>
                      <option value="0" disabled>Seleccione:</option>
                      <?php
                      $query = $con->query("SELECT * FROM tipo_estudios");
                      while ($valores = mysqli_fetch_array($query)) {
                        echo '<option value="' . $valores['id_tipo_estudios'] . '">' . $valores['tipo_estudios'] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-12 form-group" id="div_nivel_estudio_tecnico">
                    <label for="title">(*) Nivel estudios</label>
                    <select name="nivel_estudios_tec" id="nivel_estudios_tec" class="form-control">
                      <option value="TITULADO TECNICO">Titulado técnico</option>
                      <option value="EGRESADO TECNICO">Egresado técnico</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-12 form-group" id="div_nivel_estudio_prof">
                    <?php $nivel_estudio = $row['nivel_estudios'] ?>
                    <!-- onChange="tipo_nivel_estudio_select(this)" -->
                    <label for="title">(*) Nivel estudios</label>
                    <select name="nivel_estudios_edit" id="nivel_estudios_edit" class="form-control">
                      <option value="">Elegir...</option>
                      <option value="ESTUDIANTE">Estudiante</option>
                      <option value="EGRESADO">Egresado</option>
                      <option value="BACHILLER">Bachiller</option>
                      <option value="TITULADO">Titulado</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-12 form-group" id="div_ciclo_actual">
                    <label for="title">(*) Ciclo actual</label>
                    <select name="ciclo_actual" class="form-control">
                      <option value="VII">VII</option>
                      <option value="VIII">VIII</option>
                      <option value="IX">IX</option>
                      <option value="X">X</option>
                    </select>
                  </div>
                  <div class="col-md-6 col-sm-12 form-group">
                    <label for="title">(*) Centro estudios</label>
                    <input type="text" name="centro_estudios" style="text-transform:uppercase; font-size:13px" class="form-control" value="<?php echo $row['centro_estudios'] ?>" required>
                  </div>
                  <div class="col-md-6 col-sm-12 form-group" id="div_carrera">
                    <label for="title">(*) Carrera</label>
                    <input type="text" name="carrera" style="text-transform:uppercase; font-size:13px" class="form-control" value="<?php echo $row['carrera'] ?>">
                  </div>
                  <div class="col-md-3 col-sm-12 form-group">
                    <?php $colegiatura_edit = $row['colegiatura'] ?>
                    <label for="title">(*) Colegiatura</label>
                    <select name="colegiatura_edit" id="colegiatura_edit" class="form-control">
                      <option value="NO">NO</option>
                      <option value="SI">SI</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-12 form-group">
                    <label for="title">(*) N° Colegiatura</label>
                    <input type="text" name="nro_colegiatura_edit" id="nro_colegiatura_edit" class="form-control" value="<?php
                                                                                                                          if (is_null($row['nro_colegiatura'])) {
                                                                                                                            echo "-";
                                                                                                                          } else {
                                                                                                                            echo $row['nro_colegiatura'];
                                                                                                                          } ?>">
                  </div>
                  <div class="col-md-3 col-sm-12 form-group">
                    <label for="title">(*) Fecha colegiatura</label>
                    <input type="date" name="fecha_colegiatura_edit" id="fecha_colegiatura_edit" class="form-control" value="<?php
                                                                                                                              if (is_null($row['fech_colegiatura'])) {
                                                                                                                                echo "yyyy-MM-dd";
                                                                                                                              } else {
                                                                                                                                echo $row['fech_colegiatura'];
                                                                                                                              } ?>">
                  </div>
                  <div class="col-md-3 col-sm-12 form-group">
                    <label for="title">(*) última fecha habilitación</label>
                    <input type="date" name="fech_habilitacion" id="fech_habilitacion" class="form-control" value="<?php
                                                                                                                    if (is_null($row['fech_habilitacion'])) {
                                                                                                                      echo "yyyy-MM-dd";
                                                                                                                    } else {
                                                                                                                      echo $row['fech_habilitacion'];
                                                                                                                    } ?>">
                  </div>
                  <div class="col-md-3 col-sm-12 form-group">
                    <label for="title">(**) Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control" value="<?php echo $row['fecha_inicio'] ?>" required>
                  </div>
                  <div class="col-md-3 col-sm-12 form-group">
                    <label for="title">(**) Fecha Término</label>
                    <input type="date" name="fecha_fin" class="form-control" value="<?php echo $row['fecha_fin'] ?>" required>
                  </div>
                  <div class="col-md-6 col-sm-12 form-group">
                    <label for="title">Archivo (Dejar en blanco si no desea actualizar)</label>
                    <input type="file" name="archivos1" accept=".pdf" id="expe1_archivo">
                    <div id="peso_archivo_valido" class="font-weight-bolder text-primary"></div>
                    <div id="peso_archivo_no" class="font-weight-bolder text-danger"></div>
                  </div>
                  <div class="col-md-3 col-sm-12 form-group">
                    <?php $brevete_edit = $row['brevete'] ?>
                    <label for="title">(*) Licencia de conducir</label>
                    <select name="licencia_conducir" id="licencia_conducir_editar" class="form-control">
                      <option value="Ninguna">Ninguna</option>
                      <option value="A-I">A-I</option>
                      <option value="A-IIa">A-IIa</option>
                      <option value="A-IIb">A-IIb</option>
                      <option value="A-IIIa">A-IIIa</option>
                      <option value="A-IIIb">A-IIIb</option>
                      <option value="A-IIIc">A-IIIc</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-12 form-group" id="div_tipo_profesional">
                    <?php $tipo_prof = $row['tipo_profesional'] ?>
                    <label for="title">(*) Tipo profesional</label>
                    <select name="tipo_prof" id="tipo_prof" class="form-control">
                      <option value="vacio" selected>Elegir...</option>
                      <option value="administrativo">Administrativo</option>
                      <option value="asistencial">Asistencial</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-12 form-group" id="div_serums">
                    <label for="title">(*) ¿Hizo SERUMS?</label>
                    <select name="serums" id="serums" class="form-control">
                      <option value="NO">NO</option>
                      <option value="SI">SI</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-12 form-group" id="div_valor_quintil">
                    <label for="title">(*) ¿Valor de Quintil?</label>
                    <select name="quintil" id="quintil" class="form-control">
                      <option value="">Elegir...</option>
                      <option value="15">1</option>
                      <option value="10">2</option>
                      <option value="15">3</option>
                      <option value="2">4</option>
                      <option value="0">5</option>
                    </select>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <a href="formacion.php?dni=<?php echo $dato_desencriptado  ?>" type="button" class="btn btn-default">Cancelar</a>
              <button type="submit" name="editar" class="btn btn-success">Actualizar</a>
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
  <script src="js/funciones.js"></script>
  <script>
    $(document).ready(function() {
      $('#nivel_estudios_edit > option[value="<?php echo $nivel_estudio ?>"]').attr('selected', 'selected');
      $('#tipo_estudios_select > option[value="<?php echo $tipo_estudio_edit ?>"]').attr('selected', 'selected');
      $('#colegiatura_edit > option[value="<?php echo $colegiatura_edit ?>"]').attr('selected', 'selected');
      $('#licencia_conducir_editar > option[value="<?php echo $brevete_edit ?>"]').attr('selected', 'selected');
      $('#tipo_prof > option[value="<?php echo $tipo_prof ?>"]').attr('selected', 'selected');
    });
  </script>
  <script src="js/script_formacion.js"></script>
</body>

</html>