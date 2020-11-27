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

  <title>NUEVA CONVOCATORIA - SISTEMA SELECCION (DIRESA-TACNA)</title>

  <!-- Custom fonts for this template-->
  <link rel="icon" type="image/png" href="img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <style>
    #total {
      font-weight: bold;
    }

    .red {
      border-color: red;
    }

    .green {
      border-color: green;
    }
  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php
    $dni = $_GET['dni'];
    $dato_desencriptado = $_GET['dni'];
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
        <?php include 'nav.php' ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="row">

            <div class="col-lg-12">

              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Modificar Personal requerido</h6>
                </div>

                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-md-12 d-flex justify-content-end">
                      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Nuevo</a>
                    </div>
                  </div>
                  <form action="procesos/modificarpersonalreq.php" method="POST">
                    <input type="hidden" value="<?php echo $id; ?>" name="id">
                    <input type="hidden" value="<?php echo $dato_desencriptado; ?>" name="dni">

                    <div class="row">
                      <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                          <h6 class="m-0 font-weight-bold text-danger">Personal requerido</h6>
                          <hr class="sidebar-divider">
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-bordered">
                                <thead>
                                  <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                    <th>N°</th>
                                    <th style="display: none;">id</th>
                                    <th>Cargo</th>
                                    <th>Financiero</th>
                                    <th>Dirección ejecutora</th>
                                    <th>Acciones</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $dni = $_GET['dni'];
                                  $idcon = $_GET['id'];
                                  include_once('conexion.php');
                                  $sql = "SELECT * FROM sistema_seleccion.personal_req INNER JOIN sistema_seleccion.ubicacion 
                                  ON personal_req.personal_req_idubicacion = ubicacion.iddireccion INNER JOIN sistema_seleccion.cargo 
                                  ON personal_req.cargo_idcargo = cargo.idcargo
                                  WHERE convocatoria_idcon='$idcon'";
                                  $query = mysqli_query($con, $sql);
                                  $i = 1;
                                  if (mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                      $idpersonal = $row['idpersonal'];
                                  ?>
                                      <tr style="background-color: #8287e061;">
                                        <td style="font-size: 14px; font-weight:900; text-align: center"><?php echo $i ?></td>
                                        <td style="font-size: 12px; display:none"><?php echo $idpersonal ?></td>
                                        <td style="font-size: 12px;">
                                          <small style="font-weight:700; font-size: 14px;">Cargo requerido: </small><?php echo $row['cargo'] ?><br>
                                          <small style="font-weight:700; font-size: 14px;">Cantidad requerida: </small><?php echo $row['cantidad'] ?>
                                        </td>
                                        <td style="font-size: 12px;">
                                          <small style="font-weight:700; font-size: 14px;">Fuente finac.: </small><?php echo $row['fuente_finac'] ?><br>
                                          <small style="font-weight:700; font-size: 14px;">Meta: </small><?php echo $row['meta'] ?><br>
                                          <small style="font-weight:700; font-size: 14px;">Remuneracion: </small>S/.<?php echo $row['remuneracion'] ?>
                                        </td>
                                        <td style="font-size: 12px;">
                                          <small style="font-weight:700; font-size: 14px;">Dirección Ejecutora: </small><?php echo $row['direccion_ejec'] . " - " . $row['equipo_ejec'] ?>
                                        </td>
                                        <td>
                                          <a href="editar_personal_especifico.php?idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dni ?>&idcon=<?php echo $idcon ?>">
                                            <button type="button" class="btn btn-primary" id="editar" style="margin: 1px;"><i class="fa fa-pencil-alt"></i> Editar</button>
                                          </a>
                                        </td>
                                      </tr>
                                      <?php
                                      $select = "SELECT * FROM requerimientos INNER JOIN tipo_estudios 
                                      ON requerimientos.reque_tipo_estudios = tipo_estudios.id_tipo_estudios WHERE reque_id_personal ='$idpersonal'";
                                      $consulta = mysqli_query($con, $select);
                                      ?>
                                      <thead>
                                        <tr>
                                          <th style="display:none;">id</th>
                                          <th></th>
                                          <th colspan='4' style="color:#000; background:#85879666; font-size:0.813em;">Requerimientos mínimos</th>
                                        </tr>
                                      </thead>
                                      <?php
                                      $ii = 1;
                                      while ($rw = mysqli_fetch_array($consulta)) {
                                      ?>
                                        <tr>
                                          <td style=" font-size: 12px; display: none;"><?php echo $rw['id_requerimientos'] ?></td>
                                          <td style="font-size: 12px;"></td>
                                          <td style="font-size: 12px;">
                                            <small style="font-weight:700; font-size: 14px;">Tipo estudio: </small><?php echo $rw['tipo_estudios'] ?><br>
                                            <small style="font-weight:700; font-size: 14px;">Nivel estudio: </small><?php echo $rw['nivel_estudio'] ?>
                                          </td>
                                          <td style="font-size: 12px;">
                                            <small style="font-weight:700; font-size: 14px;">Cantidad experiencia: </small><br><?php echo $rw['cantidad_experiencia'] ?>
                                            <?php if ($rw['nivel_estudio'] = 'anios') {
                                              echo "AÑO (S)";
                                            } else {
                                              echo "MES (ES)";
                                            }  ?>
                                          </td>
                                          <td style="font-size: 12px;">
                                            <small style="font-weight:700; font-size: 14px;">Colegiatura: </small><?php echo $rw['colegiatura'] ?><br>
                                            <small style="font-weight:700; font-size: 14px;">Habilitación: </small><?php echo $rw['habilitacion'] ?><br>
                                            <small style="font-weight:700; font-size: 14px;">Serums: </small><?php echo $rw['serums'] ?><br>
                                            <small style="font-weight:700; font-size: 14px;">Licencia de conducir: </small><?php echo $rw['licencia_conducir'] ?>
                                          </td>
                                        </tr>
                                      <?php
                                        $ii++;
                                      }
                                      ?>
                                  <?php
                                      $i++;
                                    }
                                  } else {
                                    echo "<tr><td colspan='6' class='text-center text-danger font-weight-bold' >NO HAY PERSONAL REQUERIDO</td></tr>";
                                  }
                                  ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="text-right">
                      <a type="submit" href="listado_convocatorias?dni=<?php echo $dni; ?>" class="btn btn-light">Salir</a>
                      <button type="submit" class="btn btn-success">Siguiente <i class="fa fa-arrow-right"></i></button>
                    </div>
                  </form>
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
              <h5 class="modal-title">Nuevo personal requerido</h5>
              <button class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
              <form action="procesos/guardar_personal_req_v2.php" autocomplete="off" method="POST">
                <div class="row">
                  <!-- <div class="form-group font-weight-bolder">
                <p class="text-danger">(*) Indica un campo obligatorio.</p>
              </div> -->
                  <div class="col-md-12">
                    <h6 class="m-0 font-weight-bold text-danger">Datos del personal requeridos</h6>
                    <hr class="sidebar-divider">
                  </div>
                  <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
                  <input type="hidden" name="idconvocatoria" value="<?php echo $idcon ?>">
                  <div class="col-md-3 col-sm-12 form-group">
                    <label for="title">Cantidad requerida</label>
                    <input style="font-size:13px;" type="number" name="cantidad" class="form-control name_list" required />
                  </div>
                  <div class="col-md-3 col-sm-12 form-group">
                    <label for="title">(*) Cargo</label>
                    <select style="font-size:12px;" name="cargo" class="form-control" required>
                      <option value="" disabled selected>Elegir</option>
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
                    <input style="font-size:13px;" type="text" name="remuneracion" placeholder="Ejemplo: 2000" class="form-control name_list" required />
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
                  <div class="col-md-9 col-sm-12 form-group">
                    <label for="title">(*) Ubicación del personal requerido</label>
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
                  <div class="col-md-12">
                    <h6 class="m-0 font-weight-bold text-danger">Elegir los Requesitos básicos</h6>
                    <hr class="sidebar-divider">
                  </div>
                  <div class="col-md-4 col-sm-12 form-group">
                    <label for="title">(*) Formación Academica</label>
                    <select name="formacion_requerida" class="form-control" onChange="tipo_estudios_select(this)" required>
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
                      <option value="" selected>Elegir...</option>
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
                  <button type="submit" name="insert" class="btn btn-primary">Guardar</button>
                </div>
              </form>
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
      <script src="js/sb-admin-2.js"></script>
      <script src="js/lib/chosen/chosen.jquery.min.js"></script>
      <script src="js/sumar.js"></script>
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


</body>

</html>