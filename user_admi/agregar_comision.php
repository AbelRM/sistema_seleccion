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
                  Perfil
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Opciones
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Actividad
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar sesión
                </a>
              </div>
            </li>

          </ul>

        </nav>
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
                    $sql="SELECT * FROM convocatoria where idcon=$idcon";
                    $datos=mysqli_query($con,$sql);
                    $fila= mysqli_fetch_array($datos);
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
                    <div class="form-group col-md-6 col-sm-12">
                      <label for="inputEmail4">Dirección ejecutora</label>
                      <input type="text" class="form-control" value="<?php echo $fila['direccion_ejec_iddireccion'] ?>" disabled="true">
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
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      $idcon = $_GET['convocatoria_idcon'];
                      include_once('conexion.php');
                      $sql="SELECT * FROM total_personal_req where convocatoria_idcon=$idcon";
                      $result=mysqli_query($con,$sql);
                      while($row=mysqli_fetch_array($result)){   
                    ?>
                    <tr>
                        <td style="font-size: 16px;"><?php echo $row['cantidad'] ?></td>
                        <td style="font-size: 14px;"><?php echo $row['cargo'] ?></td>
                        <td style="font-size: 14px;"><?php echo $row['remuneracion'] ?></td>
                      
                    </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                    
                  </table>

                  <form method="POST" action="procesos/guardar_comision.php">
                    <?php
                      $idcon = $_GET['convocatoria_idcon'];
                      include_once('conexion.php');
                      $sql="SELECT * FROM convocatoria where idcon=$idcon";
                      $datos=mysqli_query($con,$sql);
                      $fila_2= mysqli_fetch_array($datos);
                      echo $idcon;
                    ?>
                    <div class="form-group">
                        <h6 class="m-0 font-weight-bold text-danger">Datos del personal requerido</h6>
                        <hr class="sidebar-divider">
                    </div>
                    <div class="form-group">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="tabla">
                            <thead>
                              <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                <th scope="col">Cargo</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Área usuaria</th>
                                <th scope="col">Acciones</th>
                              </tr>
                            </thead>
                            <tbody>
                                <tr class="fila-fija">
                                  <td>
                                    <select class="form-control name_list" name="cargo_funcio[]" id="cargo_funcio[]">
                                      <option value="" disabled selected>Elegir</option>
                                      <option value="PRESIDENTE">Presidente</option>
                                      <option value="MIEMBRO">Miembro</option>
                                    </select>
                                  </td>
                                  <td><input type="text" name="nombre[]" id="nombre[]"  placeholder="Nombres completos" class="form-control name_list" /></td>
                                  <td><input type="text" name="apellidos[]" id="apellidos[]" placeholder="Apellidos completos" class="form-control name_list" /></td>
                                  <td><input type="text" name="area_user[]" id="area_user[]" placeholder="Area usuario que proviene" class="form-control name_list" /></td>
                                  <td class="eliminar"><input type="button" class="btn btn-danger" value=" - "></td>
                                </tr>
                            </tdody>
                        </table>
                      </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                      <input type="hidden" id="idcon" name="idcon" value="<?php echo $idcon; ?>">
                      <div class="form-inline p-2">
                          <button id="adicional" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                      </div>
                      <div class="form-inline p-2">
                          <input type="submit" name="insertar_2" class="btn btn-primary" value="GUARDAR"/>
                      </div>
                    </div>
                    <!-- <div class="row d-flex justify-content-end">
                      <a class="btn btn-danger" role="button" href="resumen_convocatoria.php?convocatoria_idcon=<?php echo $idcon; ?>">Siguente</a>
                    </div> -->
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

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.js"></script>
  <script>
    $(function(){
        // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
        $("#adicional").on('click', function(){
            $("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
        });
        
        // Evento que selecciona la fila y la elimina 
        $(document).on("click",".eliminar",function(){
            var parent = $(this).parents().get(0);
            $(parent).remove();
        });
    });
  </script>

</body>

</html>