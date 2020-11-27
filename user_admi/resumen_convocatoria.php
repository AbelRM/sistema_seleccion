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
                  <h6 class="m-0 font-weight-bold text-primary">RESUMEN DE LA CONVOCATORIA AGREGADA</h6>
                </div>
                <div class="card-body">
                  <?php
                  $idcon = $_GET['convocatoria_idcon'];

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
                      <input type="text" class="form-control" value="<?php echo $fila['num_con'] . "-" . $fila['anio_con']  ?>" disabled="true">
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
                      $sql = "SELECT * FROM sistema_seleccion.personal_req INNER JOIN sistema_seleccion.ubicacion 
                      ON personal_req.personal_req_idubicacion = ubicacion.iddireccion INNER JOIN sistema_seleccion.cargo 
                      ON personal_req.cargo_idcargo = cargo.idcargo
                      WHERE convocatoria_idcon='$idcon'";
                      $result = mysqli_query($con, $sql);
                      while ($fila = mysqli_fetch_array($result)) {
                      ?>
                        <tr>
                          <td style="font-size: 16px;"><?php echo $fila['cantidad'] ?></td>
                          <td style="font-size: 14px;"><?php echo $fila['cargo'] ?></td>
                          <td style="font-size: 14px;"><?php echo $fila['remuneracion'] ?></td>
                          <td style="font-size: 14px;"><?php echo $fila['direccion_ejec'] . " - " . $fila['equipo_ejec'] ?></td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                  <!-- SE ESTA MOSTRANDO LA PARTE DE LA COMISION ENCARGADA -->
                  <div class="form-group">
                    <h6 class="m-0 font-weight-bold text-danger">Datos de la comisión asignada</h6>
                    <hr class="sidebar-divider">
                  </div>
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Cargo</th>
                        <th>Nombres</th>
                        <th>Área usuaria</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $idcon = $_GET['convocatoria_idcon'];
                      include_once('conexion.php');
                      $sql2 = "SELECT * FROM comision where convocatoria_idcon=$idcon";
                      $result2 = mysqli_query($con, $sql2);
                      while ($fila2 = mysqli_fetch_array($result2)) {
                      ?>
                        <tr>
                          <td style="font-size: 16px;"><?php echo $fila2['cargo_funcio'] ?></td>
                          <td style="font-size: 14px;"><?php echo $fila2['nombre'] . " " . $fila2['apellidos'] ?></td>
                          <td style="font-size: 14px;"><?php echo $fila2['area_user'] ?></td>

                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                  <div class="form-group d-flex justify-content-center">
                    <a class="btn btn-danger" data-toggle="modal" data-target="#confirmacion">FINALIZAR</a>
                  </div>
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
  <div class="modal fade" id="confirmacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="mySmallModalLabel">SE CREO CORRECTAMENTE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row justify-content-center">
              <img src="img/check.gif" alt="Visto bueno a la acción" width="130" height="100">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a type="button" class="btn btn-danger" href="listado_convocatorias.php?dni=<?php echo $dato_desencriptado ?>">ACEPTAR</a>
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
  <script>
    $(function() {
      // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
      $("#adicional").on('click', function() {
        $("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
      });

      // Evento que selecciona la fila y la elimina 
      $(document).on("click", ".eliminar", function() {
        var parent = $(this).parents().get(0);
        $(parent).remove();
      });
    });
  </script>

</body>

</html>