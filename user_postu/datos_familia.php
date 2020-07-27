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
        include 'conexion.php';
        
        $dni = $_GET['dni'];
        $idpostulante=$_GET['postulante_idpostulante'];
        //$descrip=base64_decode($dni);
        $sql2="SELECT * FROM usuarios where dni=$dni";
        $datos=mysqli_query($con,$sql2) or die(mysqli_error()); ;
        $fila= mysqli_fetch_array($datos);
        include 'menu.php';
        
        //include 'modal_ver_convocatoria.php';
    ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $fila['nombres']." ".$fila['ape_pat']; ?></span>
                <img class="img-profile rounded-circle" src="img/user.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Mi perfil
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
          <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DATOS DE LA FAMLIA</h6>
            </div>
            <div class="card-body">
                <form action="procesos/guardar_familia.php" method="POST">
                    <div class="form-card">
                    
                        <div class="form-group">
                            <div class="table-responsive">
                              <input type="hidden" id="dni_post" name="dni_post" value="<?php echo $dni; ?>"/>
                              <input type="hidden" id="id_postulante" name="id_postulante" value="<?php echo $idpostulante; ?>"/>

                              <label style="color:red; font-size:18px;">Los familiares agregados son aquellos que viven actualmente con usted, caso contrario colocar uno de referencia.</label>
                                <table class="table table-bordered" id="tabla">
                                    <thead>
                                    <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                        <th scope="col">Nombres</th>
                                        <th scope="col">Apellidos</th>
                                        <th scope="col">Fecha Nacimiento</th>
                                        <th scope="col">N° DNI</th>
                                        <th scope="col">Parentesco</th>
                                        <th scope="col">Entidad que labora</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="fila-fija">
                                            <td><input type="text" name="nombre[]" placeholder="Nombres" class="form-control name_list" /></td>
                                            <td><input type="text" name="apellidos[]" placeholder="Apellidos completos" class="form-control name_list"/></td>
                                            <td><input type="date" name="fecha_nac[]" class="form-control name_list" /></td>
                                            <td><input type="text" name="dni[]" maxlength="8" class="form-control name_list" /></td>
                                            <td>
                                                <select name="parentesco[]" class="form-control">
                                                    <option value="" disabled selected>Elegir</option>
                                                    <option value="PADRE">Padre</option>
                                                    <option value="MADRE">Madre</option>
                                                    <option value="HERMANO(A)">Hermano(a)</option>
                                                    <option value="TIO(A)">Tio(a)</option>
                                                    <option value="ABUELO(A)">Abuelo(a)</option>
                                                </select>
                                            </td>
                                            <td><input type="text" name="entidad[]" placeholder="Nombre entidad que elabora" class="form-control name_list" /></td>
                                            <td class="eliminar"><input type="button" class="btn btn-danger" value=" - "></td>
                                        </tr>
                                    </tdody>
                                </table>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="form-inline p-2">
                                <button id="adicional" name="adicional" type="button" class="btn btn-warning"> Agregar fila (+) </button>
                            </div>
                            <div class="form-inline p-2">
                                <input type="submit" name="insertar" class="btn btn-dark" value="Finalizar"/>
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

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
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
