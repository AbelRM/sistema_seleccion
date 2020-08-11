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

  <!-- Select-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>



  
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php 
      include 'menu.html';
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
                  <h6 class="m-0 font-weight-bold text-primary">NUEVA CONVOCATORIA</h6>
                </div>
                <div class="card-body">
                  <form action="procesos/guardar_nueva_convo.php" method="POST" >
                    <div class="form-group">
                        <h6 class="m-0 font-weight-bold text-danger">Datos de la convocatoria</h6>
                        <hr class="sidebar-divider">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-2 col-md-4 col-sm-12">
                            <label for="inputState">Tipo de concurso</label>
                            <select name="tipo_con" id="tipo_con" class="form-control">
                                <option selected>Elegir...</option>
                                <option value="C.A.S.">C.A.S.</option>
                                <option value="P.E. 276">Provisión Externa 276</option>
                                <option value="PRACTICANTE">Practicante</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-2 col-md-4 col-sm-6">
                            <label for="inputEmail4">N° de convocatoria</label>
                            <input type="text" class="form-control" name="num_con" id="num_con" placeholder="001">
                        </div>
                        <div class="form-group col-lg-2 col-md-4 col-sm-6">
                            <label for="inputEmail4">Año de convocatoria</label>
                            <input type="text" class="form-control" name="anio_con" id="anio_con" placeholder="2020">
                        </div>
                        <div class="form-group col-lg-3 col-md-4 col-sm-6">
                            <label for="inputEmail4">Fecha de inicio</label>
                            <input type="date" name="fech_ini" id="fech_ini" class="form-control">
                        </div>
                        <div class="form-group col-lg-3 col-md-4 col-sm-6">
                            <label for="inputEmail4">Fecha de fin</label>
                            <input type="date" name="fech_fin" id="fech_fin" class="form-control">
                        </div>
                        <div class="form-group col-lg-2 col-md-4 col-sm-12">
                            <label for="inputState">Estado convocatoria</label>
                            <select name="estado" id="estado" class="form-control">
                                <option value="ACTIVO" >ACTIVO</option>
                                <option value="FINALIZADO">FINALIZADO</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label for="inputEmail4" class="form-control-label" >Ubicación del lugar a elaborar</label>
                            <select name="ubicacion" class="form-control oficina"   id="ubicacion" >
                              
                                <?php
                                  include_once('conexion.php');
                                  $sql = mysqli_query($con,"SELECT * from ubicacion") or die("Problemas en consulta").mysqli_error();
                                  while ($registro=mysqli_fetch_array($sql)) {
                                    echo "<option value=\"".$registro['iddireccion']."\">".$registro['direccion_ejec']." - ".$registro['equipo_ejec']."</option>";
                                  }
                                  // mysqli_close($con);
                                ?>
                            </select>
                      
                        </div>
                       
                    </div>
                    <div class="form-group">
                        <h6 class="m-0 font-weight-bold text-danger">Porcentajes de la convocatoria</h6>
                        <hr class="sidebar-divider">
                    </div>
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-6 col-form-label">% CURRICULAR:</label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control sumar" name="curricular" id="curricular" >
                          </div>
                          <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                        </div>
                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-6 col-form-label">% ENTREVISTA:</label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control sumar" name="entrevista" id="entrevista" >
                          </div>
                          <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                        </div>
                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-6 col-form-label">% EXÁMEN ESCRITO:</label>
                          <div class="col-sm-2">
                            <input type="text" name="escrito" class="form-control sumar" id="escrito" value="0" >
                          </div>
                          <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                        </div>
                        <hr class="sidebar-divider">
                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-6 col-form-label">TOTAL DEL PORCENTAJE:</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="total" disabled="true">
                          </div>
                          <label for="staticEmail" class="col-sm-3 col-form-label">%</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-6 col-form-label">% POR DISCAPACIDAD:</label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" name="por_discapacidad" id="por_discapacidad" value="15">
                          </div>
                          <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                        </div>
                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-6 col-form-label">% LIC. MILITAR:</label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" name="militar" id="militar" value="10">
                          </div>
                          <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-row d-flex justify-content-end">
                        <button type="submit" class="btn btn-danger">SIGUIENTE</button>
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
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.js"></script>
        <script src="js/sumar.js"></script>

        <script>
      jQuery(document).ready(function($){
    $(document).ready(function() {
        $('.oficina').select2();
    });
});
        </script>


</body>

</html>