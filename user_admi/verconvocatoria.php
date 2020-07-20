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
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Valerie Luna</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
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
                    $sql="SELECT * FROM full_convocatoria WHERE idcon='".$idcon."' ";
                    $result=mysqli_query($con,$sql);
                    $fila=mysqli_fetch_array($result);

                    // while ($rw=mysqli_fetch_array($result))
                    // {
                    //       $tipo_con=$rw['tipo_con'];
                    //       $num_con=$rw['num_con'];
                    //       $dir_ejec=$rw['direccion_ejec_iddireccion'];
                    //       $fech_ini=$rw['fech_ini'];
                    //       $fech_term=$rw['fech_term'];
                    //       $porcen_eva_cu=$rw['porcen_eva_cu'];
                    //       $porce_entrevista=$rw['porce_entrevista'];
                    //       $porce_exa_escrito=$rw['porce_exa_escrito'];
                    //       $porce_discapacidad=$rw['porce_discapacidad'];
                    //       $porce_sermilitar=$rw['porce_sermilitar'];                       
                    // }
                ?>
                 <form method="POST" >
                    <input type="hidden" value="<?php echo $fila["con_con"]; ?>" name="id">
                        <div class="form-group">
                             <h6 class="m-0 font-weight-bold text-danger">Datos de la convocatoria</h6>
                             <hr class="sidebar-divider">
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-3 col-sm-12">
                                <label for="disabled-input">Tipo de concurso</label>           
                                <input type="text" class="form-control"  name="tipo_con" value="<?php echo $fila["tipo_con"]; ?>" disabled="true">                                          
                             </div>

                             <div class="form-group col-md-3 col-sm-12">
                                <label for="disabled-input">N° de convocatoria</label>           
                                <input type="text" class="form-control"  name="num_con" value="<?php echo $fila["num_con"]; ?>" disabled="true">                                          
                             </div>

                             <div class="form-group col-md-6 col-sm-12">
                                <label for="disabled-input">Direccion Ejecutiva</label>           
                                <input type="text" class="form-control"  name="direccion_ejec_iddireccion" value="<?php echo $fila['direccion_ejec']." ".$fila['equipo_ejec'];  ?>" disabled="true">                                          
                             </div>

                             <div class="form-group col-md-3 col-sm-12">
                                <label for="disabled-input">Desde</label>           
                                <input type="text" class="form-control"  name="fech_ini" value="<?php echo $fila["fech_ini"]; ?>" disabled="true">                                          
                             </div>

                             <div class="form-group col-md-3 col-sm-12">
                                <label for="disabled-input">Hasta</label>           
                                <input type="text" class="form-control"  name="fech_term" value="<?php echo $fila["fech_term"]; ?>" disabled="true">                                          
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
                                            <input type="text" class="form-control" id="porcen_eva_cu" value="<?php echo $fila["porcen_eva_cu"]; ?>" >
                                            </div>
                                            <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                                        </div>

                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-6 col-form-label">% DE EVALUACION DE ENTREVISTA:</label>
                                            <div class="col-sm-1">
                                            <input type="text" class="form-control" id="porce_entrevista" value="<?php echo $fila["porce_entrevista"]; ?>"> 
                                            </div>
                                            <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                                        </div>

                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-6 col-form-label">% DE EVALUACION DE EXÁMEN ESCRITO:</label>
                                            <div class="col-sm-1">
                                            <input type="text" class="form-control" id="porce_exa_escrito" value="<?php echo $fila["porce_exa_escrito"]; ?>"> 
                                            </div>
                                            <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                                        </div>

                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-6 col-form-label">% DE EVALUACION POR DISCAPACIDAD:</label>
                                            <div class="col-sm-1">
                                            <input type="text" class="form-control" id="porce_discapacidad" value="<?php echo $fila["porce_discapacidad"]; ?>">
                                            </div>
                                            <label for="staticEmail" class="col-sm-4 col-form-label">%</label> 
                                        </div>
             

                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-6 col-form-label">% DE EVALUACION DE LIC. MILITAR:</label>
                                            <div class="col-sm-1">
                                            <input type="text" class="form-control" id="porce_sermilitar" value="<?php echo $fila["porce_sermilitar"]; ?>">
                                            </div>
                                            <label for="staticEmail" class="col-sm-4 col-form-label">%</label> 
                                        </div>
                                        
                                   <!--  <hr class="sidebar-divider">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-6 col-form-label">TOTAL DEL PORCENTAJE:</label>
                                            <div class="col-sm-1">
                                            <input type="text" class="form-control" id="total" disabled="true">
                                            </div>
                                            <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                                        </div>   -->             
                                    </div>

                        </div>
                      <div class="row">
                        <div class="col-md-6 col-sm-12" >
                          <div class="form-group">
                            <h6 class="m-0 font-weight-bold text-danger">Comision</h6>
                            <hr class="sidebar-divider">
                            <div class="card-body">
                            
                              <div class="table-responsive">
                                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>Cargo</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        
                                        </tr>
                                    </thead>


                                    <?php
                                                  
                                        $sql = "SELECT * FROM comision";

                                        $query=mysqli_query($con, $sql);

                                        while ($row= MySQLI_fetch_array($query)){
                                            $idcomisionn=$row['idcomision'];
                                            $cargo_funcio=$row['cargo_funcio'];
                                            $nombre=$row['nombre'];
                                            $apellidos=$row['apellidos'];
                                    ?>

                                            <tr>
                                            <td><?php echo $cargo_funcio;?></td>
                                            <td><?php echo $nombre;?></td>
                                            <td><?php echo $apellidos;?></td>
                                            <?php
                                            }
                                            ?>	
                                    <tbody>
                                    </tbody>
                                  </table>
                              </div>

                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="form-group">
                                        <h6 class="m-0 font-weight-bold text-danger">Personal Requerido</h6>
                                        <hr class="sidebar-divider">
                                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                    <th>Cantidad</th>
                                    <th>Cargo</th>
                                    
                                    </tr>
                                </thead>
                                

                                <?php
          
                                    $sql = " SELECT * FROM Personal_req ";

                                    $query=mysqli_query($con, $sql);

                                    while ($row= MySQLI_fetch_array($query)){
                                        $cantidad=$row['cantidad'];
                                        $cargo=$row['cargo_idcargo'];
                                 ?>

                                        <tr>
                                        <td><?php echo $cantidad;?></td>
                                        <td><?php echo $cargo;?></td>
                                        <?php
                                        }
                                        ?>	
                                <tbody>
                                </tbody>
                                </table>
                            </div>
                            </div>
                          </div>                      
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