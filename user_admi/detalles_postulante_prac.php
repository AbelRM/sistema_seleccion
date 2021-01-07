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

  <title>DETALLES DEL POSTULANTE PARA EVALUACIÓN CURRICULAR - DIRESA TACNA</title>

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
              <h6 class="m-0 font-weight-bold text-primary">DETALLES DEL POSTULANTE (CURSOS Y EXPERIENCIA LABORAL)</h6>
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
              $sql_4 = "SELECT * FROM formacion_acad_prac where formacion_acad_prac_idpostulante=$idpostulante";
              $datos_4 = mysqli_query($con, $sql_4);
              $fila_4 = mysqli_fetch_array($datos_4);
              ?>
              <div class="form-group">
                <h6 class="m-0 font-weight-bold text-danger">Datos del postulante</h6>
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
              </div>
              <div class="form-group">
                <h6 class="m-0 font-weight-bold text-danger">Formación academica</h6>
                <hr class="sidebar-divider">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <h6 class="m-0 font-weight-bold text-primary">Formación academica requerida para practicante</h6>
                    <hr class="sidebar-divider">
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6 col-sm-6">
                      <label for="inputEmail4" style="font-size: 13px;">Tipo estudios requerido</label>
                      <input type="text" class="form-control" style="text-transform: uppercase;" value="<?php echo $fila_3['tipo_practicante'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                      <label for="inputEmail4" style="font-size: 13px;">Nivel estudio requerido</label>
                      <input type="text" class="form-control" value="<?php echo $fila_3['nivel_estudio'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-12 col-sm-6">
                      <label for="inputEmail4">Carrera requerida</label>
                      <input type="text" class="form-control" style="font-size: 13px;" value="<?php echo $fila_3['carrera_prof'] ?>" disabled="true">
                    </div>
                  </div>

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <h6 class="m-0 font-weight-bold text-success">Formación academica del postulante</h6>
                    <hr class="sidebar-divider">
                  </div>
                  <form action="procesos/actualizar_validacion.php" method="POST">
                    <div class="form-row">
                      <input type="hidden" name="dato_desencriptado_form" value="<?php echo $dato_desencriptado ?>">
                      <input type="hidden" name="idpostulante_form" value="<?php echo $idpostulante ?>">
                      <input type="hidden" name="practicas_idcon_form" value="<?php echo $idpracticas ?>">
                      <input type="hidden" name="practicante_req_form" value="<?php echo $idpracticantes_req ?>">
                      <input type="hidden" name="idformacion_acad_prac" value="<?php echo $fila_4['idformacion_acad_prac'] ?>">
                      <div class="form-group col-md-6 col-sm-12">
                        <label for="inputEmail4" style="font-size: 13px;">Tipo estudios del postulante:</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" value="<?php echo $fila_4['tipo_estudios'] ?>" disabled="true">
                      </div>
                      <div class="form-group col-md-6 col-sm-6">
                        <label for="inputEmail4" style="font-size: 13px;">Nivel estudio del postulante:</label>
                        <input type="text" class="form-control" value="<?php echo $fila_4['nivel_estudios'] ?>" disabled="true">
                      </div>
                      <div class="form-group col-md-12 col-sm-6">
                        <label for="inputEmail4">Carrera del postulante:</label>
                        <input type="text" class="form-control" style="font-size: 13px;" value="<?php echo $fila_4['carrera'] ?>" disabled="true">
                      </div>
                      <div class="form-group col-md-6 col-sm-6">
                        <label for="inputEmail4">Ver archivo de formacion:</label><br>
                        <a href="ver_formacion_prac.php?id=<?php echo $fila_4['idformacion_acad_prac'] ?>&dni_postulante=<?php echo $dni_postulante ?>&dni=<?php echo $dni ?>" target=" _blank"><i class="fas fa-file-pdf"></i> <?php echo $fila_4['archivo']; ?></a>
                      </div>
                      <div class="form-group col-md-6 col-sm-12">
                        <label for="validacion_formacion">Validación de la formación:</label>
                        <?php $validacion_formacion = $fila_4['formacion_validacion'] ?>
                        <select name="validacion_formacion" id="validacion_formacion" class="form-control">
                          <option value="VALIDO">VÁLIDO</option>
                          <option value="NO VALIDO">NO VÁLIDO</option>
                          <option value="OBSERVADO">OBSERVADO</option>
                        </select>
                      </div>
                      <div class="form-group col-md-12 col-sm-12">
                        <label for="observaciones_selec">Observaciones</label>
                        <textarea class="form-control" name="observaciones" id="observaciones_selec" value="<?php echo $fila_4['observaciones_selec'] ?>" placeholder="Especificar la razon del cambio en la validación..." rows="3"></textarea>
                      </div>
                      <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                        <button class="btn btn-success" name="updateFormacion" type="submit"><i class="fa fa-edit"></i> Actualizar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- SE ESTA MOSTRANDO LA PARTE DE PERSONAL REQUERIDO -->
              <div class="form-group">
                <h6 class="m-0 font-weight-bold text-danger">Lista de Capacitaciones registradas</h6>
                <hr class="sidebar-divider">
              </div>
              <div class="table-responsive" id="cursos">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="display:none">id</th>
                      <th>Nº</th>
                      <th>Datos de la capacitación</th>
                      <th>Horas</th>
                      <th>Fecha Inicio</th>
                      <th>Fecha Termino</th>
                      <th>Tipo</th>
                      <th>Ver archivo</th>
                      <th>Validación</th>
                      <th>Observaciones</th>
                      <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $consulta_form = "SELECT * FROM cursos_extra WHERE curso_extra_idpostulante = $idpostulante";
                    $query = mysqli_query($con, $consulta_form);
                    $i = 1;
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                      <tr>
                        <td style="display:none"><?php echo $row['idcursos_extra'] ?></td>
                        <td style="font-size: 14px;"><?php echo $i ?></td>
                        <td style="font-size: 14px;">
                          <small style="font-weight:700; font-size: 13px;">Materia:</small><br><?php echo $row['materia'] ?><br>
                          <small style="font-weight:700; font-size: 13px;">Centro de estudios:</small><br><?php echo $row['centro_estu'] ?>

                        </td>
                        <td style="font-size: 14px;"><?php echo $row['horas'] ?></td>
                        <td style="font-size: 14px;"><?php echo $row['fech_ini'] ?></td>
                        <td style="font-size: 14px;"><?php echo $row['fech_fin'] ?></td>
                        <td style="font-size: 14px;"><?php echo $row['tipo'] ?></td>
                        <td style="font-size: 14px;">
                          <a href="ver_diplomado.php?id=<?php echo $row['idcursos_extra'] ?>&dni_postulante=<?php echo $dni_postulante ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><i class="fas fa-file-pdf"></i> <?php echo $row['archivo']; ?></a>
                        </td>
                        <td style="font-size: 14px;"><?php echo $row['curso_validacion'] ?></td>
                        <td style="font-size: 14px;"><?php echo $row['observaciones_selec'] ?></td>
                        <td class="d-flex justify-content-center">
                          <button class="btn btn-success btn-sm m-1 updateBtn"><i class="fa fa-edit"></i></button>
                        </td>
                      </tr>
                    <?php
                      $i++;
                    }
                    ?>
                  </tbody>

                </table>
              </div>
              <!-- SE ESTA MOSTRANDO LA PARTE DE PERSONAL REQUERIDO -->
              <div class="form-group">
                <h6 class="m-0 font-weight-bold text-danger">Lista de Idiomas - Computación - Liderazgo</h6>
                <hr class="sidebar-divider">
              </div>
              <div class="table-responsive" id="idioma">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="display:none">id</th>
                      <th>Nº</th>
                      <th>Idioma / Computación / Liderazgo</th>
                      <th>Centro de estudios</th>
                      <th>Nivel alcanzado</th>
                      <th>Ver archivo</th>
                      <th>Validación</th>
                      <th>Observaciones</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $idioma_compu = "SELECT * FROM sistema_seleccion.idiomas_comp WHERE idpostulante_postulante = '$idpostulante'";
                    $resultado = MYSQLI_query($con, $idioma_compu);
                    $i = 1;
                    while ($rw = mysqli_fetch_array($resultado)) {
                    ?>
                      <tr>
                        <td style="display:none"><?php echo $rw['ididiomas_comp'] ?></td>
                        <td style="font-size: 14px;"><?php echo $i ?></td>
                        <td style="font-size: 14px;"><?php echo $rw['idioma_comp'] ?></td>
                        <td style="font-size: 14px;"><?php echo $rw['lugar_estudio'] ?></td>
                        <td style="font-size: 14px;"><?php echo $rw['nivel'] ?></td>
                        <td style="font-size: 14px;">
                          <a href="ver_comp_idioma.php?id=<?php echo $rw['ididiomas_comp'] ?>&dni_postulante=<?php echo $dni_postulante ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><i class="fas fa-file-pdf"></i> <?php echo $rw['archivo']; ?></a>
                        </td>
                        <td style="font-size: 14px;"><?php echo $rw['idioma_validacion'] ?></td>
                        <td style="font-size: 14px;"><?php echo $rw['observaciones_selec'] ?></td>
                        <td class="d-flex justify-content-center">
                          <button class="btn btn-success btn-sm updateBtn_2"><i class="fa fa-edit"></i></button>
                        </td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>

                </table>
              </div>
              <div class="row d-flex justify-content-center m-3">
                <div class="col-6 d-flex justify-content-center">
                  <a href=" listado_postu_prac.php?idpracticas=<?php echo $idpracticas ?>&idpracticantes_req=<?php echo $idpracticantes_req ?>&dni=<?php echo $dni ?>#home" type="button" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i></i> Retroceder</a>
                </div>

                <div class="col-6 d-flex justify-content-center">
                  <a href="listado_postu_prac.php?&idpracticas=<?php echo $idpracticas ?>&idpracticantes_req=<?php echo $idpracticantes_req ?>&dni=<?php echo $dni ?>#home" class="btn btn-success" type="button"><i class="fas fa-check-circle"></i> Validar cambios</a>
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
  <!-- Actualizar Diplomados - ESTE ES-->
  <div class="modal fade" id="actualizar_curso" tabindex="-1" aria-labelledby="actualizar_curso" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Actualizar validación de cursos</h5>
          <button class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <form action="procesos/actualizar_validacion.php" method="POST">
          <div class="modal-body">
            <div class="row">
              <input type="hidden" name="dato_desencriptado" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="idpostulante" value="<?php echo $idpostulante ?>">
              <input type="hidden" name="practicas_idcon" value="<?php echo $idpracticas ?>">
              <input type="hidden" name="practicante_req" value="<?php echo $idpracticantes_req ?>">

              <input type="hidden" name="idcursos_extra" id="idcursos_extra">
              <input type="hidden" name="dni3" value="<?php echo $dni ?>">

              <!-- <div class="col-md-4 col-sm-12 form-group">
                <label for="title">Tipo curso</label>
                <input type="text" id="tipo" class="form-control" disabled>

              </div>
              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">Nombre del curso:</label>
                <input type="text" id="materia" class="form-control" disabled>
              </div> -->
              <div class="col-md-12 col-sm-12 form-group">
                <label for="validacion">Validación del curso:</label>
                <select name="validacion" id="validacion_curso" class="form-control">
                  <option value="VALIDO">VÁLIDO</option>
                  <option value="NO VALIDO">NO VÁLIDO</option>
                  <option value="OBSERVADO">OBSERVADO</option>
                </select>
              </div>
              <div class="form-group col-md-12 col-sm-12">
                <label for="observaciones_curso">Observaciones del curso</label>
                <textarea class="form-control" name="observaciones_curso" id="observaciones_curso" placeholder="Especificar la razon del cambio en la validación..." rows="3"></textarea>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-secondary m-1" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary m-1" name="updateCurso">Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Actualizar idioma - ESTE ES-->
  <div class="modal fade" id="actualizar_idioma" tabindex="-1" aria-labelledby="actualizar_idioma" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Actualizar validación</h5>
          <button class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <form action="procesos/actualizar_validacion.php" method="POST">
          <div class="modal-body">

            <div class="row">
              <input type="hidden" name="dato_desencriptado" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="idpostulante" value="<?php echo $idpostulante ?>">
              <input type="hidden" name="practicas_idcon" value="<?php echo $idpracticas ?>">
              <input type="hidden" name="practicante_req" value="<?php echo $idpracticantes_req ?>">

              <input type="hidden" name="ididiomas_comp" id="ididiomas_comp">
              <input type="hidden" name="dni3" value="<?php echo $dni ?>">
              <?php
              // $consul_form = "SELECT * FROM formacion_acad_prac where formacion_acad_prac_idpostulante=$idpostulante";
              // $datos_4 = mysqli_query($con, $consul_form);
              // $fila_4 = mysqli_fetch_array($datos_4);
              ?>
              <div class=" col-md-12 col-sm-12 form-group">
                <label for="validacion_idioma">Validación:</label>
                <select name="validacion_idioma" id="validacion_idioma" class="form-control">
                  <option value="VALIDO">VÁLIDO</option>
                  <option value="NO VALIDO">NO VÁLIDO</option>
                  <option value="OBSERVADO">OBSERVADO</option>
                </select>
              </div>
              <div class="form-group col-md-12 col-sm-12">
                <label for="observaciones_idioma">Observaciones del Idioma/Compu.</label>
                <textarea class="form-control" name="observaciones_idioma" id="" placeholder="Especificar la razon del cambio en la validación..." rows="3"></textarea>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-secondary m-1" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary m-1" name="updateIdioma">Actualizar</button>
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
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="vendor/sweetalert2.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#button1').click(function() {
        var datos = $('#frmajax').serialize();
        $.ajax({
          type: "POST",
          url: "procesos/calcular_puntaje_prac.php",
          data: datos,
          success: function(r) {
            console.log("Mensaje: ", r);
            const respuesta = JSON.parse(r);
            console.log("JSON: ", respuesta);
            console.log("Mi r: ", respuesta.r);
            if (respuesta.r == 1) {
              Swal.fire({
                title: 'SE CALCULÓ CORRECTAMENTE',
                text: respuesta.mensaje,
                icon: 'success',
                confirmButtonText: 'Aceptar'
              }).then(function() {
                window.location = "listado_postu_prac.php?idpracticas=" + respuesta.idpracticas + "&idpracticantes_req=" + respuesta.idpracticantes_req + "&dni=" + respuesta.dni;
              });
            } else {
              Swal.fire({
                title: 'ERROR AL CALCULAR, VERIFIQUE DATOS.',
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
  <script>
    $(document).ready(function() {
      $('.updateBtn').on('click', function() {
        $('#actualizar_curso').modal('show');

        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);
        $('#idcursos_extra').val(data[0]);
        $('#num').val(data[1]);
        $('#centro_estudi').val(data[2]);
        $('#horas').val(data[3]);
        $('#fecha_inic').val(data[4]);
        $('#fecha_fin').val(data[5]);
        $('#tipo').val(data[6]);
        $('#archivos').val(data[7]);
        $('#validacion_curso').val(data[8]);
        $('#observaciones_curso').val(data[9]);
      });

      $('.updateBtn_2').on('click', function() {

        $('#actualizar_idioma').modal('show');

        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);
        $('#ididiomas_comp').val(data[0]);
        $('#num').val(data[1]);
        $('#idioma_comp').val(data[2]);
        $('#lugar').val(data[3]);
        $('#nivel').val(data[4]);
        $('#archivos').val(data[5]);
        $('#validacion_idioma').val(data[6]);
      });
    });
    $(document).ready(function() {
      $('#validacion_formacion > option[value="<?php echo $validacion_formacion ?>"]').attr('selected', 'selected');
    });
  </script>
</body>

</html>