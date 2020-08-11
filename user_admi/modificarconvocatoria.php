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
      include 'menu.html';
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
        <?php 
                include 'conexion.php';?>
          <!-- <h1 class="h3 mb-4 text-gray-800">Blank Page</h1> -->
          <div class="row">

            <div class="col-lg-12">

              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">CONVOCATORIA SELECCIONADA</h6>
                </div>
                <div class="card-body">    
                <?php 
                    $idcon=$_GET['id'];
                    
                    $sql="SELECT * FROM convocatoria WHERE idcon='".$idcon."' ";
                    $result=mysqli_query($con,$sql);
                    
                    //$fila=mysqli_fetch_array($result);

                  while ($rw=mysqli_fetch_array($result))
                     {
                          $tipo_con=$rw['tipo_con'];
                          $num_con=$rw['num_con'];
                          $añocon=$rw['año_con'];
                          $dir_ejec=$rw['direccion_ejec_iddireccion'];
                          $fech_ini=$rw['fech_ini']; 
                          $fech_term=$rw['fech_term'];
                          $porcen_eva_cu=$rw['porcen_eva_cu'];
                          $porce_entrevista=$rw['porce_entrevista'];
                          $porce_exa_escrito=$rw['porce_exa_escrito'];
                          $porce_discapacidad=$rw['porce_discapacidad'];
                          $porce_sermilitar=$rw['porce_sermilitar'];                       
                    }
                    ?>

                 <form action="procesos/modificarconvoca.php" method="POST">
                    <input type="hidden" value="<?php echo $idcon; ?>" name="id">
                        <div class="form-group">
                             <h6 class="m-0 font-weight-bold text-danger">Datos de la convocatoria</h6>
                             <hr class="sidebar-divider">
                        </div>
                        
                        <div class="form-row">

                            <div class="form-group col-md-4 col-sm-12">
                                <label for="disabled-input" class=" form-control-label" >Tipo de concurso</label>           
                                <input type="text" class="form-control"  name="tipo_con" value="<?php echo $tipo_con; ?>" >                                          
                             </div>

                             <div class="form-group col-md-4 col-sm-12">
                                <label for="disabled-input" class=" form-control-label" >N° de convocatoria</label>           
                                <input type="text" class="form-control"  name="num_con" value="<?php echo $num_con; ?>" >                                          
                             </div>

                             <div class="form-group col-md-4 col-sm-12">
                                <label for="disabled-input" class=" form-control-label" >Año</label>           
                                <input type="text" class="form-control"  name="año_con" value="<?php echo $añocon; ?>">                                          
                             </div>

                             <div class="form-group col-md-6 col-sm-12">
                                <label for="disabled-input" class=" form-control-label">Direccion Ejecutiva</label>           
                                <input type="text" class="form-control"  name="direccion_ejec_iddireccion" value="<?php echo $dir_ejec; ?>">                                          
                             </div>

                             <div class="form-group col-md-3 col-sm-12">
                                <label for="disabled-input" class=" form-control-label" >Desde</label>           
                                <input type="date" class="form-control"  name="fech_ini" value="<?php echo $fech_ini; ?>" >                                          
                             </div>

                             <div class="form-group col-md-3 col-sm-12">
                                <label for="disabled-input" class=" form-control-label">Hasta</label>           
                                <input type="date" class="form-control"  name="fech_term" value="<?php echo $fech_term; ?>" >                                          
                             </div>
                         </div>

                        <div class="form-group">
                                        <h6 class="m-0 font-weight-bold text-danger">Porcentaje de la convocatoria</h6>
                                        <hr class="sidebar-divider">
                                    </div>

                                <div class="form-row" id="contenido">
                                    <div class="col-md-12">
                                        
                                    <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-6 col-form-label">% DE EVALUACION CURRICULAR:</label>
                                            <div class="col-sm-1">
                                            <input type="text" class="form-control" id="porcen_eva_cu" value="<?php echo $porcen_eva_cu; ?>" >
                                            </div>
                                            <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                                        </div>

                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-6 col-form-label">% DE EVALUACION DE ENTREVISTA:</label>
                                            <div class="col-sm-1">
                                            <input type="text" class="form-control" id="porce_entrevista" value="<?php echo $porce_entrevista; ?>"> 
                                            </div>
                                            <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                                        </div>

                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-6 col-form-label">% DE EVALUACION DE EXÁMEN ESCRITO:</label>
                                            <div class="col-sm-1">
                                            <input type="text" class="form-control" id="porce_exa_escrito" value="<?php echo $porce_exa_escrito; ?>"> 
                                            </div>
                                            <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                                        </div>

                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-6 col-form-label">% DE EVALUACION POR DISCAPACIDAD:</label>
                                            <div class="col-sm-1">
                                            <input type="text" class="form-control" id="porce_discapacidad" value="<?php echo $porce_discapacidad; ?>">
                                            </div>
                                            <label for="staticEmail" class="col-sm-4 col-form-label">%</label> 
                                        </div>
             

                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-6 col-form-label">% DE EVALUACION DE LIC. MILITAR:</label>
                                            <div class="col-sm-1">
                                            <input type="text" class="form-control" id="porce_sermilitar" value="<?php echo $porce_sermilitar; ?>">
                                            </div>
                                            <label for="staticEmail" class="col-sm-4 col-form-label">%</label>       
                                        </div>
                                                  
                                    </div>



                        </div>  

                         <div class="text-right">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-plus"></i> Guardar
                                        </button>
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

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.js"></script>
  <script src="js/sumar.js"></script>


</body>

</html>