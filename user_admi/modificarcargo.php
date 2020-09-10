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
        <?php include 'nav.php' ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="row">

            <div class="col-lg-12">

              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Modificar Cargo</h6>
                </div>
                <div class="card-body">    
                <?php 
                    $idcargo=$_GET['id'];
                    
                    $sql="SELECT * FROM cargo INNER JOIN tipo_cargo ON tipo_cargo.idtipo = cargo.tipo_cargo_id WHERE idcargo='".$idcargo."' ";
                    $result=mysqli_query($con,$sql);

                  while ($rw=mysqli_fetch_array($result))
                     {
                          $cargo=$rw['cargo'];
                          $tipo=$rw['tipo_cargo'];                      
                    }
                    ?>

                    <form action="procesos/modificarcargo.php" method="POST">
                        <input type="hidden" value="<?php echo $idcargo; ?>" name="id">
                        <input type="hidden" value="<?php echo $dato_desencriptado; ?>" name="dni">
                        
                        <div class="form-row">
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="disabled-input" class=" form-control-label" >Cargo</label>           
                            <input type="text" class="form-control"  name="cargo" value="<?php echo $cargo; ?>" >                                          
                        </div>

                        <div class="form-poup col-md-8 col-sm-12">
                            <label for="disabled-input" class=" form-control-label" >Tipo de Cargo</label>           
                            <select name="tipo"  class="form-control" value="<?php echo $tipo; ?>">
                                                                <?php
                                                                $sql="SELECT * FROM tipo_cargo";
                                                                $res=mysqli_query($con,$sql);
                                                                while ($rw= mysqli_fetch_array($res)){
                                                                    echo "<option value=".$rw["idtipo"].">".$rw["tipo_cargo"]."</option> ";
                                                                } 
                                                                ?>
                            </select>                                            
                        </div>

                        </div>
                        <div class="text-right">
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>Guardar!</button>
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