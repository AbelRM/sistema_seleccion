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

  <title>AGREGAR COMISION - SISTEMA SELECCION (DIRESA-TACNA)</title>

  <!-- Custom fonts for this template-->
  <link rel="icon" type="image/png" href="img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <link rel="stylesheet" href="css/style.css">

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
                  <h6 class="m-0 font-weight-bold text-primary">AGREGAR DATOS DE LA COMISIÓN </h6>
                </div>
                <div class="card-body">
                  <?php
                  $idcon = $_GET['convocatoria_idcon'];
                  include_once('conexion.php');
                  $sql = "SELECT * FROM convocatoria where idcon=$idcon";
                  $datos = mysqli_query($con, $sql);
                  $fila = mysqli_fetch_array($datos);
                  ?>
                  <div class="form-group">
                    <h6 class="m-0 font-weight-bold text-danger">Datos de la convocatoria</h6>
                    <hr class="sidebar-divider">
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-3 col-sm-12">
                      <label for="inputEmail4">Número de convocatoria</label>
                      <input type="text" class="form-control" value="<?php echo $fila['num_con'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-3 col-sm-12">
                      <label for="inputEmail4">Tipo de convocatoria</label>
                      <input type="text" class="form-control" value="<?php echo $fila['tipo_con'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-3 col-sm-6">
                      <label for="inputEmail4">Fecha de inicio</label>
                      <input type="date" class="form-control" value="<?php echo $fila['fech_ini'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-3 col-sm-6">
                      <label for="inputEmail4">Fecha de fin</label>
                      <input type="date" class="form-control" value="<?php echo $fila['fech_term'] ?>" disabled="true">
                    </div>
                  </div>
                  <!-- SE ESTA MOSTRANDO LA PARTE DE PERSONAL REQUERIDO -->
                  <div class="form-group">
                    <h6 class="m-0 font-weight-bold text-danger">Datos del personal requerido</h6>
                    <hr class="sidebar-divider">
                  </div>
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Cantidad</th>
                        <th>Cargo</th>
                        <th>Remuneración</th>
                        <th>Dirección ejecutora</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $idcon = $_GET['convocatoria_idcon'];
                      include_once('conexion.php');
                      $sql = "SELECT * FROM personal_req INNER JOIN ubicacion 
                      ON personal_req.personal_req_idubicacion = ubicacion.iddireccion INNER JOIN cargo 
                      ON personal_req.cargo_idcargo = cargo.idcargo
                      WHERE convocatoria_idcon='$idcon'";
                      $result = mysqli_query($con, $sql);
                      while ($row = mysqli_fetch_array($result)) {
                      ?>
                        <tr>
                          <td style="font-size: 16px;"><?php echo $row['cantidad'] ?></td>
                          <td style="font-size: 14px;"><?php echo $row['cargo'] ?></td>
                          <td style="font-size: 14px;"><?php echo $row['remuneracion'] ?></td>
                          <td style="font-size: 14px;"><?php echo $row['direccion_ejec'] . " - " . $row['equipo_ejec'] ?></td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>

                  </table>

                  <form method="POST" action="procesos/guardar_comision.php">
                    <?php
                    $idcon = $_GET['convocatoria_idcon'];
                    $sql = "SELECT * FROM convocatoria where idcon=$idcon";
                    $datos = mysqli_query($con, $sql);
                    $fila_2 = mysqli_fetch_array($datos);
                    ?>
                    <div class="form-group">
                      <h6 class="m-0 font-weight-bold text-danger">Datos de la comisión</h6>
                      <hr class="sidebar-divider">
                    </div>
                    <div class="form-group row">
                      <div class="col-md-12 d-flex justify-content-end">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Nuevo</a>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                            <th style="display:none;">id</th>
                            <th>N°</th>
                            <th>Tipo de cargo</th>
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <th>Area usuaria</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $consulta_form = "SELECT * FROM comision WHERE convocatoria_idcon = '$idcon'";
                          $query = mysqli_query($con, $consulta_form);

                          if (mysqli_num_rows($query) > 0) {
                            $i = 1;
                            while ($row = MySQLI_fetch_array($query)) {
                          ?>
                              <tr style="text-align:center;">
                                <td style=" font-size: 12px; display:none;"><?php echo $row['idcomision'] ?></td>
                                <td style="font-size: 12px;"><?php echo $i ?></td>
                                <td style="font-size: 12px;"><?php echo $row['cargo_funcio'] ?></td>
                                <td style="font-size: 12px;"><?php echo $row['nombre'] ?></td>
                                <td style="font-size: 12px;"><?php echo $row['apellidos'] ?></td>
                                <td style="font-size: 12px;"><?php echo $row['area_user'] ?></td>
                                <td style="font-size: 12px; display:none;"><?php echo $row['otro_area_user'] ?></td>
                                <td class="d-flex justify-content-center">
                                  <button type="button" class="btn btn-success btn-sm m-1 updateBtn"><i class="fa fa-edit"></i></button>
                                  <button type="button" class="btn btn-danger btn-sm m-1 deleteBtn"><i class="fas fa-trash-alt"></i></button>
                                </td>
                              </tr>
                          <?php
                              $i++;
                            }
                          } else {
                            echo "<tr><td colspan='7' class='text-center text-danger font-weight-bold' >NO HAY DATOS DE LA COMISIÓN</td></tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                      <a href="resumen_convocatoria.php?convocatoria_idcon=<?php echo $idcon ?>&dni=<?php echo $dato_desencriptado ?>" type="button" class="btn btn-primary">Finalizar <i class="fas fa-arrow-circle-right"></i></a>
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
          <h5 class="modal-title">Agregar datos de la comisión</h5>
          <button class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <div class="modal-body">
          <form action="procesos/guardar_comision.php" autocomplete="off" method="POST">
            <div class="row">
              <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="idconvocatoria" value="<?php echo $idcon ?>">
              <div class="col-md-3 col-sm-12 form-group">
                <label for="title">Cargo en la comisión</label>
                <select style="font-size:12px;" name="cargo" class="form-control" required>
                  <option value="" disabled selected>Elegir</option>
                  <option value="Presidente">Presidente</option>
                  <option value="Miembro">Miembro</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">(*) Nombres</label>
                <input style="font-size:13px;" type="text" name="nombres" class="form-control" required />
              </div>
              <div class="col-md-5 col-sm-12 form-group">
                <label for="title">(*) Apellidos</label>
                <input style="font-size:13px;" type="text" name="apellidos" class="form-control" required />
              </div>
              <div class="col-md-6 col-sm-12 form-group">
                <label for="title">Área usuaria</label>
                <select style="font-size:12px;" name="area_usuaria" onChange="area_usuaria_select(this)" class="form-control" required>
                  <option value="">Elegir...</option>
                  <option value="Director Ejecutivo de Administracion">Director Ejecutivo de Administracion</option>
                  <option value="Director Ejecutivo de Gestión y Desarrollo de RR.HH.">Director Ejecutivo de Gestión y Desarrollo de RR.HH.</option>
                  <option value="Otro">Otra área usuaria</option>
                </select>
              </div>
              <div class="col-md-6 col-sm-12 form-group" id="div_otro">
                <label for="title">Otra área usuaria</label>
                <input style="font-size:13px;" type="text" name="otro_area" class="form-control" />
              </div>
            </div>
            <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-secondary">Salir</button>
              <button type="submit" name="agregar_comision" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- EDIT DATOS -->
  <div class="modal fade" id="editModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Agregar datos de la comisión</h5>
          <button class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <div class="modal-body">
          <form action="procesos/guardar_comision.php" autocomplete="off" method="POST">
            <div class="row">
              <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="idconvocatoria" value="<?php echo $idcon ?>">
              <input type="hidden" name="idcomision" id="idcomision">
              <div class="col-md-3 col-sm-12 form-group">
                <label for="title">Cargo en la comisión</label>
                <select style="font-size:12px;" name="cargo_update" id="cargo_funcio" class="form-control" required>
                  <option value="" disabled selected>Elegir</option>
                  <option value="Presidente">Presidente</option>
                  <option value="Miembro">Miembro</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">(*) Nombres</label>
                <input style="font-size:13px;" type="text" name="nombres_update" id="nombres" class="form-control" required />
              </div>
              <div class="col-md-5 col-sm-12 form-group">
                <label for="title">(*) Apellidos</label>
                <input style="font-size:13px;" type="text" name="apellidos_update" id="apellidos" class="form-control" required />
              </div>
              <div class="col-md-6 col-sm-12 form-group">
                <label for="title">Área usuaria</label>
                <select style="font-size:12px;" name="area_usuaria_update" id="area_user" class="form-control" required>
                  <option value="">Elegir...</option>
                  <option value="Director Ejecutivo de Administracion">Director Ejecutivo de Administracion</option>
                  <option value="Director Ejecutivo de Gestión y Desarrollo de RR.HH.">Director Ejecutivo de Gestión y Desarrollo de RR.HH.</option>
                  <option value="Otro">Otra área usuaria</option>
                </select>
              </div>
              <div class="col-md-6 col-sm-12 form-group" id="div_otro_update">
                <label for="title">Otra área usuaria</label>
                <input style="font-size:13px;" type="text" name="otro_area_update" id="otra_area_user" class="form-control" />
              </div>
            </div>
            <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-secondary">Salir</button>
              <button type="submit" name="actualizar_comision" class="btn btn-primary">Actualizar</button>
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
        <form action="procesos/guardar_comision.php" method="POST">

          <div class="modal-body">

            <input type="hidden" name="idcomision_delete" id="idcomision_delete">
            <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
            <input type="hidden" name="idconvocatoria" value="<?php echo $idcon ?>">
            <h4>¿Desea eliminar el registro de formación?</h4>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
            <button type="submit" class="btn btn-danger" name="deleteComision">SI</button>
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
  <script>
    div_div_serums = document.getElementById("div_otro");
    div_div_serums.style.display = "none";

    function area_usuaria_select(sel) {
      if (sel.value == "Director Ejecutivo de Administracion") {
        div_div_serums = document.getElementById("div_otro");
        div_div_serums.style.display = "none";
      } else if (sel.value == "Director Ejecutivo de Gestión y Desarrollo de RR.HH.") {
        div_div_serums = document.getElementById("div_otro");
        div_div_serums.style.display = "none";
      } else if (sel.value == "Otro") {
        div_div_serums = document.getElementById("div_otro");
        div_div_serums.style.display = "block";
      }
    }
    //CRUD EDIT
    $(document).ready(function() {
      $('.updateBtn').on('click', function() {

        $('#editModal').modal('show');

        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);

        $('#idcomision').val(data[0]);
        $('#num').val(data[1]);
        $('#cargo_funcio').val(data[2]);
        $('#nombres').val(data[3]);
        $('#apellidos').val(data[4]);
        $('#area_user').val(data[5]);
        $('#otra_area_user').val(data[6]);
      });
    });
    //CRUD DELETE

    $(document).ready(function() {
      $('.deleteBtn').on('click', function() {
        $('#deleteModal').modal('show');
        // Get the table row data.
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();
        console.log(data);
        $('#idcomision_delete').val(data[0]);
        $('#num').val(data[1]);

      });
    });

    $(function() {
      $("#area_user").on('change', function() {
        var selectValue = $(this).val();
        switch (selectValue) {
          case "Director Ejecutivo de Administracion":
            $("#div_otro_update").hide();
            break;
          case "Director Ejecutivo de Gestión y Desarrollo de RR.HH.":
            $("#div_otro_update").hide();
            break;
          case "Otro":
            $("#div_otro_update").show();
            break;
        }
      }).change();
    });
  </script>

</body>

</html>