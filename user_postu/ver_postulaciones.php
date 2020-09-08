<?php
  include 'conexion.php';
  include "funcs/mcript.php";
  session_start();
  if(empty($_SESSION['active'])){
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
    #total  {font-weight:bold;}
    .red    {border-color:red;}
    .green  {border-color:green;}
  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php     
      $dato_desencriptado = $_GET['dni'];
      $dni = $desencriptar($dato_desencriptado);

      $sql="SELECT * FROM usuarios where dni=$dni";
      $datos=mysqli_query($con,$sql) or die(mysqli_error()); ;
      $fila= mysqli_fetch_array($datos);
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
          <div class="row">

            <div class="col-lg-12">

              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">POSTULACION SELECCIONADA</h6>
                </div>
                <div class="card-body">    
                <?php 

                    $consulta="SELECT * FROM postulante where dni=$dni";
                    $datos=mysqli_query($con,$consulta) or die(mysqli_error()); ;
                    $row= mysqli_fetch_array($datos);
                    $idpostulante=$row['idpostulante'];

                    $idcon=$_GET['id'];
                    $detalle=$_GET['id'];
                    $sql="SELECT * FROM detalle_convocatoria 
                    inner join total_personal_req on detalle_convocatoria.personal_req_idpersonal=total_personal_req.idpersonal 
                    inner join convocatoria on detalle_convocatoria.convocatoria_idcon=convocatoria.idcon 
                    WHERE iddetalle_convocatoria=$detalle";

                    $result=mysqli_query($con,$sql);
                    $fila=mysqli_fetch_array($result);
                ?>
                <form method="POST" >
                  <input type="hidden" value="<?php echo $fila["num_con"]; ?>" name="id">
                  <div class="form-group">
                        <h6 class="m-0 font-weight-bold text-danger">Datos de la Postulacion</h6>
                        <hr class="sidebar-divider">
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4 col-sm-12">
                      <label for="disabled-input">Nro de Convocatoria</label>           
                      <input type="text" class="form-control"  name="tipo_con" value="<?php echo $fila["num_con"]; ?>" disabled="true">                                          
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                      <label for="disabled-input">Convocatoria</label>           
                      <input type="text" class="form-control"  name="tipo_con" value="<?php echo $fila["anio_con"]; ?>" disabled="true">                                          
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                      <label for="disabled-input">Cargo</label>           
                      <input type="text" class="form-control"  name="num_con" value="<?php echo $fila["cargo"]; ?>" disabled="true">                                          
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                      <label for="disabled-input">Boleta</label>           
                      <input type="text" class="form-control"  name="num_con" value="<?php echo $fila["boleta"]; ?>" disabled="true">  
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                      <label for="disabled-input">Fecha de Inscripcion</label>           
                      <input type="text" class="form-control"  name="fech_ini" value="<?php echo $fila["fech_ini"]; ?>" disabled="true">                                          
                    </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; AMS, DIRESA - 2020</span>
          </div>
        </div>
      </footer>
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
  <script src="js/sb-admin-2.js"></script>
  <script src="js/sumar.js"></script>


</body>

</html>