<?php
include 'conexion.php';
include 'funcs/mcript.php';
session_start();
if (empty($_SESSION['active'])) {
  header("Location: ../index.php");
}
?>
<?php
include "conexion.php";

$query = $con->query("select * from departamento");
$countries = array();
while ($r = $query->fetch_object()) {
  $countries[] = $r;
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

  <title>Listado</title>

  <!-- Custom fonts for this template -->
  <link rel="icon" type="image/png" href="img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php
    include 'funcs/mcript.php';

    $dato_desencriptado = $_GET['dni'];
    $dni = $desencriptar($dato_desencriptado);

    $sql2 = "SELECT * FROM usuarios where dni=$dni";
    $datos = mysqli_query($con, $sql2) or die(mysqli_error($datos));;
    $fila = mysqli_fetch_array($datos);
    include 'menu.php';

    //include 'modal_ver_convocatoria.php';
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

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DATOS PERSONALES</h6>
            </div>
            <div class="card-body">
              <form action="procesos/guardar_personales.php" method="post">
                <div class="form-card">

                  <input type="hidden" id="dni_post" name="dni_post" value="<?php echo $fila['dni']; ?>">

                  <div class="form-group row">
                    <div class="col-md-5 col-sm-6 mb-2 mb-sm-0">
                      <label>Nombres</label>
                      <input class="form-control form-control-user" type="text" value="<?php echo $fila['nombres'] . " " . $fila['ape_pat'] . " " . $fila['ape_mat']; ?>" disabled="true" />
                    </div>
                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                      <label>D.N.I.</label>
                      <input class="form-control form-control-user" type="text" value="<?php echo $fila['dni'] ?>" disabled="true" />
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                      <label>Fecha de nacimiento</label>
                      <input class="form-control form-control-user" value="<?php echo $fila['fech_nac'] ?>" disabled="true" />
                    </div>
                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                      <label>Estado civil</label>
                      <select class="form-control" name="civil" id="civil">
                        <option selected>Elegir...</option>
                        <option value="SOLTERO(A)">Soltero(a)</option>
                        <option value="CASADO(A)">Casado(a)</option>
                        <option value="VIUDO(A)">Viudo(a)</option>
                        <option value="DIVORCIADO(A)">Divorciado(a)</option>
                        <option value="CONVIVIENTE">Conviviente</option>
                      </select>
                    </div>
                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                      <label>Sexo</label>
                      <select class="form-control" name="sexo" id="sexo">
                        <option selected>Elegir...</option>
                        <option value="MASCULINO">Masculino</option>
                        <option value="FEMENINO">Femenino</option>
                      </select>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                      <label for="name1">Departamento</label>
                      <select id="departamento_id" class="form-control" name="departamento_id" required>
                        <option value="">-- SELECCIONE --</option>
                        <?php foreach ($countries as $c) : ?>
                          <option value="<?php echo $c->iddepartamento; ?>"><?php echo $c->departamento; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                      <label for="name1">Provincia</label>
                      <select id="provincia_id" class="form-control" name="provincia_id">
                        <option value="">-- SELECCIONE --</option>
                      </select>
                    </div>


                    <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                      <label for="exampleInputEmail1">Distrito</label>
                      <select id="distrito_id" class="form-control" name="distrito_id" required>
                        <option value="">-- SELECCIONE --</option>
                      </select>
                    </div>

                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                      <label>Cel. emergencia</label>
                      <input class="form-control form-control-user" type="text" name="num_emer" id="num_emer" />
                    </div>
                    <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                      <label>Parentesco</label>
                      <input class="form-control form-control-user" placeholder="Nombre familiar" type="text" name="nomb_parent" id="nomb_parent" />
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                      <label>R.U.C.</label>
                      <input class="form-control form-control-user" type="text" name="ruc" id="ruc" />
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                      <label>N° cuenta bancaria</label>
                      <input class="form-control form-control-user" placeholder="Banco de la Nación" type="text" name="cuenta_banc" id="cuenta_banc" />
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                      <label>Suspensión de 4ta.</label>
                      <select class="form-control" name="cuarta" id="cuarta">
                        <option value="NO" selected>NO</option>
                        <option value="SI">SI</option>
                      </select>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                      <label>Tipo de pensión</label>
                      <select class="form-control" name="pension" id="pension">
                        <option value="NINGUNA" selected>Ninguna</option>
                        <option value="ONP">ONP</option>
                        <option value="SPP">SPP</option>
                      </select>
                    </div>
                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                      <label>Discapacidad</label>
                      <select class="form-control" name="discapacidad" id="discapacidad">
                        <option value="NO" selected>NO</option>
                        <option value="SI">SI</option>

                      </select>
                    </div>
                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                      <label>Tipo de discapacidad</label>
                      <select class="form-control" name="tip_discapacidad" id="tip_discapacidad">
                        <option value="NINGUNA" select>Ninguna</option>
                        <option value="FISICA">Físicas</option>
                        <option value="SENSORIAL">Sensoriales</option>
                        <option value="MENTAL">Mentales</option>
                        <option value="INTELECTUAL">Intelectuales</option>
                      </select>
                    </div>
                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                      <label>Grupo sanguineo</label>
                      <select class="form-control" name="tip_sangre" id="tip_sangre">
                        <option selected>Elegir...</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="0+">0+</option>
                        <option value="0-">0-</option>
                      </select>
                    </div>
                    <div class="col-md-6 col-sm-6 mb-2 mb-sm-0">
                      <label>Enfermedades/Alergias</label>
                      <input class="form-control form-control-user" type="text" placeholder="Separado por comas" name="alergias" id="alergias" />
                    </div>
                  </div>
                </div>
                <div class="d-flex justify-content-end">
                  <button type="input" class="btn btn-dark">Siguiente</button>
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
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
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
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $("#departamento_id").change(function() {
        $.get("provincia.php", "departamento_iddepartamento=" + $("#departamento_id").val(), function(data) {
          $("#provincia_id").html(data);
          console.log(data);
        });
      });

      $("#provincia_id").change(function() {
        $.get("distrito.php", "provincia_idprovincia=" + $("#provincia_id").val(), function(data) {
          $("#distrito_id").html(data);
          console.log(data);
        });
      });
    });
  </script>

</body>

</html>