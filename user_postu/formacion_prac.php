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

  <title>FORMACIÓN ACADEMICA - SISTEMA SELECCIÓN DIRESA - TACNA</title>

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
          $sql2 = "SELECT * FROM postulante WHERE dni=$dato_desencriptado";
          $datos2 = mysqli_query($con, $sql2) or die(mysqli_error($datos2));;
          $fila2 = mysqli_fetch_array($datos2);
          $idpostulante = $fila2['idpostulante'];
          ?>
          <!-- Page Heading -->
          <!-- Content Row -->
          <div class="card border-success">
            <div class="card-header">
              <div class="row">
                <div class="col-md-6">
                  <h5 class="titulo-card font-weight-bold">MI FORMACIÓN ACADEMICA:</h5>
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
                      <th style="display: none;">idformacion_prac</th>
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
                    $consulta_form = "SELECT * FROM formacion_acad_prac WHERE formacion_acad_prac_idpostulante = $idpostulante";
                    $query = mysqli_query($con, $consulta_form);
                    if (mysqli_num_rows($query) > 0) {
                      $i = 1;
                      while ($row = MySQLI_fetch_array($query)) {
                    ?>
                        <tr>
                          <td style="display:none"><?php echo $row['idformacion_acad_prac'] ?></td>
                          <td style="font-size: 12px;"><?php echo $i ?></td>
                          <td style="font-size: 12px;"><?php echo $row['tipo_estudios'] ?></td>
                          <td style="font-size: 12px;"><?php echo $row['nivel_estudios'] ?></td>
                          <td style="font-size: 12px;"><?php echo $row['carrera'] ?></td>
                          <td style="font-size: 12px;"><?php echo $row['fecha_inicio'] ?></td>
                          <td style="font-size: 12px;"><?php echo $row['fecha_fin'] ?></td>
                          <td><a href="ver_formacion_prac.php?id=<?php echo $row['idformacion_acad_prac'] ?>&dni=<?php echo $dni ?>" target="_blank"><?php echo $row['archivo']; ?></a></td>
                          <td class="d-flex justify-content-center">
                            <a type="button" href="editarformacion_prac.php?idformacion_prac=<?php echo $row['idformacion_acad_prac'] ?>&dni=<?php echo $dni ?>" class="btn btn-success btn-sm m-1">
                              <i class="fa fa-edit"></i> Editar</a>
                            <button type="button" class="btn btn-danger btn-sm m-1 deleteBtn"> <i class="fas fa-trash-alt"></i></button>
                          </td>
                        </tr>
                    <?php
                        $i++;
                      }
                    } else {
                      echo "<tr><td colspan='8' class='text-center text-danger font-weight-bold' >NO HAY DATOS REGISTRADOS</td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="row d-flex justify-content-center m-3">
                <a href="ingreso_datos_prac.php?dni=<?php echo $dni ?>" type="button" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i> Retroceder</a>
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
                <div class="col-md-3 col-sm-12 form-group">
                  <label for="title">(*) Tipo estudio</label>
                  <label class="form-control" value="UNIVERSITARIO">UNIVERSITARIO</label>
                </div>
                <div class="col-md-3 col-sm-12 form-group" id="div_nivel_estudio_prof">
                  <label for="title">(*) Nivel estudios</label>
                  <select name="nivel_estudios_prof" onChange="tipo_nivel_estudio_select(this)" class="form-control">
                    <option value="">Elegir...</option>
                    <option value="ESTUDIANTE">Estudiante</option>
                    <option value="EGRESADO">Egresado</option>
                  </select>
                </div>
                <div class="col-md-3 col-sm-12 form-group" id="div_ciclo_actual">
                  <label for="title">(*) Ciclo actual</label>
                  <select name="ciclo_actual" class="form-control">
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
                  <input type="date" name="fecha_inicio" class="form-control">
                </div>
                <div class="col-md-3 col-sm-12 form-group" id="div_fecha_fin">
                  <label for="title">(**) Fecha Término</label>
                  <input type="date" name="fecha_fin" class="form-control">
                </div>
                <div class="col-md-6 col-sm-12 form-group" id="div_centro_estudios">
                  <label for="title">(*) Nombre de universidad</label>
                  <input type="text" style="text-transform:uppercase; font-size:12px" name="centro_estudios" class="form-control" placeholder="Nombre de la universidad" required>
                </div>
                <div class="col-md-6 col-sm-12 form-group" id="div_carrera">
                  <label for="title">(*) Carrera profesional (Nombre completo)</label>
                  <input type="text" name="carrera" style="text-transform:uppercase; font-size:12px" class="form-control" placeholder="Nombre de la carrera profesional">
                </div>
                <div class="col-md-6 col-sm-12 form-group" id="archivo">
                  <label for="title">(*) Archivo para validar formación académica ingresada.</label>
                  <input type="file" name="archivo" accept=".pdf" id="expe_archivo" required />
                  <div id="peso_archivo_valido" class="font-weight-bolder text-primary"></div>
                  <div id="peso_archivo_no" class="font-weight-bolder text-danger"></div>
                </div>
                <div class="col-md-12">
                  <h6 class="m-0 font-weight-bold text-success">Elegir el orden de mérito (caso contrario no elegir ninguna opcion).</h6>
                  <hr class="sidebar-divider">
                </div>
                <div class="col-md-4 col-sm-12 form-group">
                  <label for="title">(*) Tipo de orden de mérito</label>
                  <select name="orden_merito" class="form-control">
                    <option value="NINGUNO">Elegir...</option>
                    <option value="TERCIO SUPERIOR">Tercio Superior</option>
                    <option value="QUINTO SUPERIOR">Quinto Superior</option>
                  </select>
                </div>
                <div class="col-md-6 col-sm-12 form-group" id="archivo">
                  <label for="title">(*) Archivo para validar orden de mérito.</label>
                  <input type="file" name="archivo_merito" accept=".pdf" id="merito_archivo" />
                  <div id="peso_archivo_valido_2" class="font-weight-bolder text-primary"></div>
                  <div id="peso_archivo_no_2" class="font-weight-bolder text-danger"></div>
                </div>
              </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Salir</button>
                <button class="btn btn-primary" type="submit" name="formacion_prac"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
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
              <input type="hidden" name="dni" value="<?php echo $dni ?>">
              <input type="hidden" name="dni_base" value="<?php echo $dato_desencriptado ?>">
              <h4>¿Desea eliminar el registro de formación?</h4>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
              <button type="submit" class="btn btn-danger" name="borrar_prac">SI</button>
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
      div_ciclo_actual = document.getElementById("div_ciclo_actual");
      div_ciclo_actual.style.display = "none";

      function tipo_nivel_estudio_select(sel) {
        if (sel.value == "ESTUDIANTE") {
          div_ciclo_actual = document.getElementById("div_ciclo_actual");
          div_ciclo_actual.style.display = "block";
        } else if (sel.value == "EGRESADO") {
          div_ciclo_actual = document.getElementById("div_ciclo_actual");
          div_ciclo_actual.style.display = "none";
        }
      }
    </script>

</body>

</html>