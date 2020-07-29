<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>AGREGAR PERSONAL REQUERIDO - SISTEMA SELECCION (DIRESA-TACNA)</title>

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

          <!-- Topbar Search -->
         

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
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
                  <h6 class="m-0 font-weight-bold text-primary">AGREGAR DATOS PERSONAL REQUERIDO</h6>
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
                  <form method="POST" action="procesos/guardar_personal_req.php">
                    <div class="form-group">
                        <h6 class="m-0 font-weight-bold text-danger">Datos del personal requerido</h6>
                        <hr class="sidebar-divider">
                    </div>
                    <div class="form-group">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="tabla">
                            <thead>
                              <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                <th scope="col">CANTIDAD</th>
                                <th scope="col">CARGO</th>
                                <th scope="col">REMUNERACIÓN S/.</th>
                                <th scope="col">FUENTE FINANCIAMIENTO</th>
                                <th scope="coL">META</th>
                                <th scope="col">ACCIONES</th>
                              </tr>
                            </thead>
                            <tbody>
                                <tr class="fila-fija">
                                  <td><input type="text" name="cantidad[]" placeholder="CANTIDAD" class="form-control name_list" /></td>
                                  <td>
                                    <select name="cargo[]" class="form-control" id="cargo">
                                      <option value="" disabled selected>Elegir</option>
                                      <?php
                                        include_once('conexion.php');
                                        $sql = mysqli_query($con,"SELECT * from cargo") or die("Problemas en consulta").mysqli_error();
                                        while ($registro=mysqli_fetch_array($sql)) {
                                          echo "<option value=\"".$registro['idcargo']."\">".$registro['cargo']."</option>";
                                        }
                                      ?>
                                    </select>
                                  </td>
                                  <td><input type="text" name="remuneracion[]" placeholder="Ejemplo: 2000" class="form-control name_list" /></td>
                                  <td><input type="text" name="fuente_finac[]" placeholder="RECURSOS ORDINARIOS" class="form-control name_list" /></td>
                                  <td><input type="text" name="meta[]" placeholder="Ejemplo: 002" class="form-control name_list" /></td>
                                  <td class="eliminar"><input type="button" class="btn btn-danger" value=" - "></td>
                                </tr>
                            </tdody>
                        </table>
                      </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                      <input type="hidden" id="idcon" name="idcon" value="<?php echo $fila['idcon']; ?>">
                      <div class="form-inline p-2">
                          <button id="adicional" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                      </div>
                      <div class="form-inline p-2">
                          <input type="submit" name="insertar" class="btn btn-primary" value="GUARDAR"/>
                      </div>
                    </div>
                    <!-- <div class="row d-flex justify-content-end">
                      <a class="btn btn-danger" role="button" href="agregar_comision.php?convocatoria_idcon=<?php echo $idcon; ?>">Siguente</a>
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

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <a class="btn btn-primary" href="../index.php">Cerrar sesión</a>
        </div>
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