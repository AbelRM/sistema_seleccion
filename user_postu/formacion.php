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

  <title>Sistema de postulación DIRESA - TACNA</title>

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
    // $dato_desencriptado = $_GET['dni'];
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
        <?php
        include_once 'nav.php';
        ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?php
          include 'conexion.php';

          $sql2 = "SELECT * FROM postulante WHERE dni=$dni";
          $datos2 = mysqli_query($con, $sql2) or die(mysqli_error($datos2));;
          $fila2 = mysqli_fetch_array($datos2);
          $idpostulante = $fila2['idpostulante'];

          // $sql3="SELECT MAX(iddetalle_convocatoria) AS id FROM sistema_seleccion.detalle_convocatoria
          // WHERE postulante_idpostulante=$idpostulante";
          // $datos3=mysqli_query($con,$sql3) or die(mysqli_error());
          // $row3 = mysqli_fetch_row($datos3);
          // $id = trim($row3[0]);

          // $sql4="SELECT * from detalle_convocatoria 
          // inner join total_personal_req on detalle_convocatoria.personal_req_idpersonal=total_personal_req.idpersonal 
          // inner join convocatoria on detalle_convocatoria.convocatoria_idcon=convocatoria.idcon WHERE iddetalle_convocatoria=$id";
          // $datos4=mysqli_query($con,$sql4) or die(mysqli_error());
          // $fila4= mysqli_fetch_array($datos4);
          // $iddetalle_conv=$fila4['iddetalle_convocatoria'];
          // $idtipo = $fila4['idtipo'];
          ?>
          <!-- Page Heading -->
          <!-- Content Row -->
          <div class="card border-success">
            <div class="card-header">
              <div class="row">
                <div class="col-md-6">
                  <h5 class="titulo-card">Mi formación académica:</h5>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                  <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Nuevo</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <h6 style="font-weight: 700;">Se recomienda registrar solo un registro, acorde al puesto a postular.</h6>
                <table class="table table-bordered">
                  <thead>
                    <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                      <th>N°</th>
                      <th>Tipo estudios</th>
                      <th>Nivel estudios</th>
                      <th>Carrera</th>
                      <th>Fecha Inicio</th>
                      <th>Fecha Término</th>
                      <th>Archivo</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    $consulta_form = "SELECT * FROM formacion_acad inner join tipo_estudios 
                    ON formacion_acad.tipo_estudios_id=tipo_estudios.id_tipo_estudios 
                          WHERE formacion_idpostulante = $idpostulante";
                    $query = mysqli_query($con, $consulta_form);
                    if (mysqli_num_rows($query) > 0) {
                      while ($row = MySQLI_fetch_array($query)) {
                    ?>
                        <tr>
                          <td style="font-size: 12px;"><?php echo $row['id_formacion'] ?></td>
                          <td style="font-size: 12px;"><?php echo $row['tipo_estudios'] ?></td>
                          <td style="font-size: 12px;"><?php echo $row['nivel_estudios'] ?></td>
                          <td style="font-size: 12px;"><?php echo $row['carrera'] ?></td>
                          <td style="font-size: 12px;"><?php echo $row['fecha_inicio'] ?></td>
                          <td style="font-size: 12px;"><?php echo $row['fecha_fin'] ?></td>

                          <td><a href="ver_pdf.php?id=<?php echo $row['id_formacion'] ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><?php echo $row['archivo']; ?></a></td>
                          <td class="d-flex justify-content-center">
                            <a type="button" href="editarformacion.php?idformacion=<?php echo $row['id_formacion'] ?>&dni=<?php echo $dato_desencriptado ?>" class="btn btn-success btn-sm m-1">
                              <i class="fa fa-edit"></i> Editar</a>
                            <button type="button" class="btn btn-danger btn-sm m-1 deleteBtn"> <i class="fas fa-trash-alt"></i></button>
                          </td>
                        </tr>
                    <?php
                      }
                    } else {
                      echo "<tr><td colspan='8' class='text-center text-danger font-weight-bold' >NO HAY DATOS REGISTRADOS</td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
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

    <!-- ADD NUEVOS DATOS -->
    <div class="modal fade" id="addModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Nuevos datos profesionales</h5>
            <button class="close" data-dismiss="modal">
              <span>×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="procesos/guardar_formacion.php" enctype="multipart/form-data" autocomplete="off" method="POST">
              <div class="row">
                <input type="hidden" name="dni_encriptado" value="<?php echo $dato_desencriptado ?>">
                <input type="hidden" name="dni" value="<?php echo $dni ?>">
                <input type="hidden" name="postulante" value="<?php echo $idpostulante ?>">
                <div class="col-md-12 col-sm-12 form-group">
                  <p class="text-danger font-weight-bolder">(*) Indica un campo obligatorio.</p>
                  <p class="text-danger font-weight-bolder">(**) En el campo "FECHA" debe indicar la fecha de obtención del "NIVEL DE ESTUDIOS" que está registrando. En el caso de estudiante, debe indicar la fecha del ciclo culminado que está registrando.</p>
                </div>
                <div class="col-md-6 col-sm-12 form-group">
                  <label for="title">(*) Tipo estudio</label>
                  <select class="form-control" name="tipo_estudios" onChange="tipo_estudios_select(this)" required>
                    <option value="0">Seleccione:</option>
                    <?php
                    $query = $con->query("SELECT * FROM tipo_estudios");
                    while ($valores = mysqli_fetch_array($query)) {
                      echo '<option value="' . $valores['id_tipo_estudios'] . '">' . $valores['tipo_estudios'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="col-md-6 col-sm-12 form-group" id="div_nivel_estudio_tecnico">
                  <label for="title">(*) Nivel estudios</label>
                  <select name="nivel_estudios_tec" id="nivel_estudios_tec" class="form-control">
                    <option value="TITULADO">Titulado</option>
                    <option value="EGRESADO">Egresado</option>
                  </select>
                </div>
                <div class="col-md-6 col-sm-12 form-group" id="div_nivel_estudio_prof">
                  <label for="title">(*) Nivel estudios</label>
                  <select name="nivel_estudios_prof" onChange="tipo_nivel_estudio_select(this)" class="form-control">
                    <option value="">Elegir...</option>
                    <option value="ESTUDIANTE">Estudiante</option>
                    <option value="EGRESADO">Egresado</option>
                    <option value="BACHILLER">Bachiller</option>
                    <option value="TITULADO">Titulado</option>
                  </select>
                </div>
                <div class="col-md-6 col-sm-12 form-group" id="div_ciclo_actual">
                  <label for="title">(*) Ciclo actual</label>
                  <select name="ciclo_actual" class="form-control">
                    <option value="VII">VII</option>
                    <option value="VIII">VIII</option>
                    <option value="IX">IX</option>
                    <option value="X">X</option>
                  </select>
                </div>
                <div class="col-md-3 col-sm-12 form-group" id="div_fecha_inicio">
                  <label for="title">(**) Fecha Inicio</label>
                  <input type="date" name="fecha_inicio" class="form-control">
                </div>
                <div class="col-md-3 col-sm-12 form-group" id="div_fecha_fin">
                  <label for="title">(**) Fecha Término</label>
                  <input type="date" name="fecha_fin" class="form-control">
                </div>
                <div class="col-md-6 col-sm-12 form-group" id="div_centro_estudios">
                  <label for="title">(*) Centro estudios</label>
                  <input type="text" style="text-transform:uppercase; font-size:13px" name="centro_estudios" class="form-control" placeholder="Nombre centro estudios" required>
                </div>
                <div class="col-md-6 col-sm-12 form-group" id="div_carrera">
                  <label for="title">(*) Carrera</label>
                  <input type="text" name="carrera" style="text-transform:uppercase; font-size:13px" class="form-control" placeholder="Nombre de la carrera">
                </div>
                <div class="col-md-2 col-sm-12 form-group" id="div_colegiatura">
                  <label for="title">(*) Colegiatura</label>
                  <select name="colegiatura" id="colegiatura_new" class="form-control">
                    <option value="NO">NO</option>
                    <option value="SI">SI</option>
                  </select>
                </div>
                <div class="col-md-3 col-sm-12 form-group" id="div_nro_colegiatura" disabled>
                  <label for="title">(*) N° Colegiatura</label>
                  <input type="text" name="nro_colegiatura" id="nro_colegiatura_new" class="form-control" placeholder="N° colegiatura" maxlength="50" disabled>
                </div>
                <div class="col-md-3 col-sm-12 form-group" id="div_fech_colegiatura" disabled>
                  <label for="title">(*) Fecha Colegiatura</label>
                  <input type="date" name="fech_colegiatura" id="fech_colegiatura_new" class="form-control" disabled>
                </div>
                <div class="col-md-3 col-sm-12 form-group" id="div_fech_habilitacion">
                  <label for="title">(*) Fecha Habilitación</label>
                  <input type="date" name="fech_habilitacion" id="fech_habilitacion" class="form-control" disabled>
                </div>

                <div class="col-md-6 col-sm-12 form-group" id="archivo">
                  <label for="title">(*) Archivo para validar formación académica ingresada.</label>
                  <input type="file" name="archivo" accept=".pdf" id="expe_archivo" required />
                  <div id="peso_archivo_valido" class="font-weight-bolder text-primary"></div>
                  <div id="peso_archivo_no" class="font-weight-bolder text-danger"></div>
                  <!-- <div class="row">
                    <label for="title">(*) Elegir Archivo (No mayor a 2MB)</label>
                  </div>
                  <div class="row">
                    <div class="col-4 pf-0">
                      <label for="file-upload" class="subir"><i class="fas fa-cloud-upload-alt"></i> Elegir</label>
                      <input id="file-upload" onchange='cambiar()' name="archivo" type="file" accept=".pdf" style='display: none;' required />
                    </div>
                    <div class="col-8 p-0">
                      <div id="info" class="font-weight-bold"></div>
                    </div>
                    <div id="peso_archivo_valido" class="font-weight-bolder text-primary"></div>
                    <div id="peso_archivo_no" class="font-weight-bolder text-danger"></div>
                  </div> -->
                </div>

                <div class="col-md-3 col-sm-12 form-group" id="div_tipo_profesional">
                  <label for="title">(*) Tipo profesional</label>
                  <select name="tipo_prof" id="tipo_prof" class="form-control" onChange="tipo_profesional_select(this)" required>
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
                <div class="col-md-3 col-sm-12 form-group">
                  <label for="title">(*) Licencia de conducir</label>
                  <select name="licencia_conducir" id="licencia_conducir" class="form-control">
                    <option value="Ninguna">Ninguna</option>
                    <option value="A-I">A-I</option>
                    <option value="A-IIa">A-IIa</option>
                    <option value="A-IIb">A-IIb</option>
                    <option value="A-IIIa">A-IIIa</option>
                    <option value="A-IIIb">A-IIIb</option>
                    <option value="A-IIIc">A-IIIc</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary" type="submit" name="insertData">Guardar</button>
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
            <h5 class="modal-title" id="exampleModalLabel">Eliminar registro de Formación</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form action="procesos/borrar_formacion.php" method="POST">

            <div class="modal-body">

              <input type="hidden" name="deleteId" id="deleteId">
              <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="dni_base" value="<?php echo $dni ?>">
              <h4>¿Desea eliminar el registro de formación?</h4>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
              <button type="submit" class="btn btn-danger" name="deleteData">SI</button>
            </div>

          </form>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/funciones.js"></script>
    <script src="js/script_formacion.js"></script>

    <script>
      $(function() {
        $("#colegiatura_new").on('change', function() {
          var selectValue = $(this).val();
          switch (selectValue) {
            case "NO":
              $("#nro_colegiatura_new").prop('disabled', true);
              $("#fech_colegiatura_new").prop('disabled', true);
              $("#fech_habilitacion").prop('disabled', true);
              break;
            case "SI":
              $("#nro_colegiatura_new").removeAttr('disabled');
              $("#fech_colegiatura_new").removeAttr('disabled');
              $("#fech_habilitacion").removeAttr('disabled');
              break;
          }
        }).change();
      });
    </script>
    <script>
      function tipo_estudios_select(sel) {
        if (sel.value == "1") {
          div_nivel_estudio_tecnico = document.getElementById("div_nivel_estudio_tecnico");
          div_nivel_estudio_tecnico.style.display = "none";
          div_nivel_estudio_prof = document.getElementById("div_nivel_estudio_prof");
          div_nivel_estudio_prof.style.display = "none";

          div_ciclo_actual = document.getElementById("div_ciclo_actual");
          div_ciclo_actual.style.display = "none";
          div_centro_estudios = document.getElementById("div_centro_estudios");
          div_centro_estudios.style.display = "block";
          div_carrera = document.getElementById("div_carrera");
          div_carrera.style.display = "none";
          div_colegiatura = document.getElementById("div_colegiatura");
          div_colegiatura.style.display = "none";
          div_nro_colegiatura = document.getElementById("div_nro_colegiatura");
          div_nro_colegiatura.style.display = "none";
          div_fech_colegiatura = document.getElementById("div_fech_colegiatura");
          div_fech_colegiatura.style.display = "none";
          div_fech_habilitacion = document.getElementById("div_fech_habilitacion");
          div_fech_habilitacion.style.display = "none";
          div_fecha_inicio = document.getElementById("div_fecha_inicio");
          div_fecha_inicio.style.display = "block";
          div_fecha_fin = document.getElementById("div_fecha_fin");
          div_fecha_fin.style.display = "block";
          div_tipo_profesional = document.getElementById("div_tipo_profesional");
          div_tipo_profesional.style.display = "none";
          div_div_serums = document.getElementById("div_serums");
          div_div_serums.style.display = "none";
          div_div_valor_quintil = document.getElementById("div_valor_quintil");
          div_div_valor_quintil.style.display = "none";
          // max = document.getElementById("dni");
          // max.setAttribute("maxlength", "8");
        } else if (sel.value == "2") {
          div_nivel_estudio_tecnico = document.getElementById("div_nivel_estudio_tecnico");
          div_nivel_estudio_tecnico.style.display = "block";
          div_nivel_estudio_prof = document.getElementById("div_nivel_estudio_prof");
          div_nivel_estudio_prof.style.display = "none";
          div_ciclo_actual = document.getElementById("div_ciclo_actual");
          div_ciclo_actual.style.display = "none";
          div_centro_estudios = document.getElementById("div_centro_estudios");
          div_centro_estudios.style.display = "block";
          div_carrera = document.getElementById("div_carrera");
          div_carrera.style.display = "block";
          div_colegiatura = document.getElementById("div_colegiatura");
          div_colegiatura.style.display = "none";
          div_nro_colegiatura = document.getElementById("div_nro_colegiatura");
          div_nro_colegiatura.style.display = "none";
          div_fech_colegiatura = document.getElementById("div_fech_colegiatura");
          div_fech_colegiatura.style.display = "none";
          div_fech_habilitacion = document.getElementById("div_fech_habilitacion");
          div_fech_habilitacion.style.display = "none";
          div_fecha_inicio = document.getElementById("div_fecha_inicio");
          div_fecha_inicio.style.display = "block";
          div_fecha_fin = document.getElementById("div_fecha_fin");
          div_fecha_fin.style.display = "block";
          div_tipo_profesional = document.getElementById("div_tipo_profesional");
          div_tipo_profesional.style.display = "none";
          div_div_serums = document.getElementById("div_serums");
          div_div_serums.style.display = "none";
          div_div_valor_quintil = document.getElementById("div_valor_quintil");
          div_div_valor_quintil.style.display = "none";
        } else if (sel.value == "3") {
          div_nivel_estudio_tecnico = document.getElementById("div_nivel_estudio_tecnico");
          div_nivel_estudio_tecnico.style.display = "none";
          div_nivel_estudio_prof = document.getElementById("div_nivel_estudio_prof");
          div_nivel_estudio_prof.style.display = "block";
          div_ciclo_actual = document.getElementById("div_ciclo_actual");
          div_ciclo_actual.style.display = "none";
          div_centro_estudios = document.getElementById("div_centro_estudios");
          div_centro_estudios.style.display = "block";
          div_carrera = document.getElementById("div_carrera");
          div_carrera.style.display = "block";
          div_colegiatura = document.getElementById("div_colegiatura");
          div_colegiatura.style.display = "block";
          div_nro_colegiatura = document.getElementById("div_nro_colegiatura");
          div_nro_colegiatura.style.display = "block";
          div_fech_colegiatura = document.getElementById("div_fech_colegiatura");
          div_fech_colegiatura.style.display = "block";
          div_fech_habilitacion = document.getElementById("div_fech_habilitacion");
          div_fech_habilitacion.style.display = "block";
          div_fecha_inicio = document.getElementById("div_fecha_inicio");
          div_fecha_inicio.style.display = "block";
          div_fecha_fin = document.getElementById("div_fecha_fin");
          div_fecha_fin.style.display = "block";
          div_tipo_profesional = document.getElementById("div_tipo_profesional");
          div_tipo_profesional.style.display = "block";
          div_div_serums = document.getElementById("div_serums");
          div_div_serums.style.display = "none";
          div_div_valor_quintil = document.getElementById("div_valor_quintil");
          div_div_valor_quintil.style.display = "none";
        }
      }
    </script>
    <script>
      function tipo_profesional_select(sel) {
        if (sel.value == "vacio") {
          div_div_serums = document.getElementById("div_serums");
          div_div_serums.style.display = "none";
          div_div_valor_quintil = document.getElementById("div_valor_quintil");
          div_div_valor_quintil.style.display = "none";

        } else if (sel.value == "administrativo") {
          div_div_serums = document.getElementById("div_serums");
          div_div_serums.style.display = "none";
          div_div_valor_quintil = document.getElementById("div_valor_quintil");
          div_div_valor_quintil.style.display = "none";

        } else if (sel.value == "asistencial") {
          div_div_serums = document.getElementById("div_serums");
          div_div_serums.style.display = "block";
          div_div_valor_quintil = document.getElementById("div_valor_quintil");
          div_div_valor_quintil.style.display = "block";

        }
      }

      function tipo_nivel_estudio_select(sel) {
        if (sel.value == "ESTUDIANTE") {
          div_ciclo_actual = document.getElementById("div_ciclo_actual");
          div_ciclo_actual.style.display = "block";
          div_tipo_profesional = document.getElementById("div_tipo_profesional");
          div_tipo_profesional.style.display = "none";

        } else if (sel.value == "EGRESADO") {
          div_ciclo_actual = document.getElementById("div_ciclo_actual");
          div_ciclo_actual.style.display = "none";
          div_tipo_profesional = document.getElementById("div_tipo_profesional");
          div_tipo_profesional.style.display = "none";
        } else if (sel.value == "BACHILLER") {
          div_ciclo_actual = document.getElementById("div_ciclo_actual");
          div_ciclo_actual.style.display = "none";
          div_tipo_profesional = document.getElementById("div_tipo_profesional");
          div_tipo_profesional.style.display = "none";
        } else if (sel.value == "TITULADO") {
          div_ciclo_actual = document.getElementById("div_ciclo_actual");
          div_ciclo_actual.style.display = "none";
          div_tipo_profesional = document.getElementById("div_tipo_profesional");
          div_tipo_profesional.style.display = "block";

        }
      }
    </script>

</body>

</html>