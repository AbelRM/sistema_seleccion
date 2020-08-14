<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>VER CONVOCATORIA - SISTEMA SELECCION (DIRESA-TACNA)</title>

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
      include 'conexion.php';
      $dni=$_GET['dni'];
      $idcon=$_POST['id'];
      $sql="SELECT * FROM full_convocatoria WHERE idcon='".$idcon."' ";
      $result=mysqli_query($con,$sql);
      $fila=mysqli_fetch_array($result);
      include 'menu.php';
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
          <!-- <h1 class="h3 mb-4 text-gray-800">Blank Page</h1> -->
          <div class="row">

            <div class="col-lg-12">

              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">CONVOCATORIA SELECCIONADA</h6>
                </div>
                <div class="card-body">    
                  
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
                      <input type="text" class="form-control" name="num_con" value="<?php echo $fila["num_con"]."-".$fila["año_con"];?>" disabled="true">                                          
                    </div>
                    
                    <div class="form-group col-md-3 col-sm-12">
                      <label for="disabled-input">Desde</label>           
                      <input type="text" class="form-control" name="fech_ini" value="<?php echo $fila["fech_ini"]; ?>" disabled="true">                                          
                    </div>

                    <div class="form-group col-md-3 col-sm-12">
                      <label for="disabled-input">Hasta</label>           
                      <input type="text" class="form-control" name="fech_term" value="<?php echo $fila["fech_term"]; ?>" disabled="true">                                          
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                      <label for="disabled-input">Direccion Ejecutiva</label>           
                      <input type="text" class="form-control" name="direccion_ejec_iddireccion" value="<?php echo $fila['direccion_ejec']." - ".$fila['equipo_ejec'];  ?>" disabled="true">                                          
                    </div>
                  </div>
                  <div class="form-group">
                    <h6 class="m-0 font-weight-bold text-danger">Porcentaje de la convocatoria</h6>
                    <hr class="sidebar-divider">
                  </div>
                  <div class="form-row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="staticEmail" class="col-sm-6 col-form-label">% CURRICULAR:</label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control sumar" value="<?php echo $fila['porcen_eva_cu']; ?>" disabled="true">
                        </div>
                        <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                      </div>
                      <div class="form-group row">
                        <label for="staticEmail" class="col-sm-6 col-form-label">% ENTREVISTA:</label>
                        <div class="col-sm-2">
                        <input type="text" class="form-control sumar" value="<?php echo $fila['porce_entrevista']; ?>" disabled="true">
                        </div>
                        <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                      </div>
                      <div class="form-group row">
                        <label for="staticEmail" class="col-sm-6 col-form-label">% EXÁMEN ESCRITO:</label>
                        <div class="col-sm-2">
                        <input type="text" class="form-control sumar" value="<?php echo $fila['porce_exa_escrito']; ?>" disabled="true">
                        </div>
                        <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                      </div>
                      <hr class="sidebar-divider">
                      <div class="form-group row">
                        <label for="staticEmail" class="col-sm-6 col-form-label">TOTAL DEL PORCENTAJE:</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" value="100" disabled="true">
                        </div>
                        <label for="staticEmail" class="col-sm-3 col-form-label">%</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="staticEmail" class="col-sm-6 col-form-label">% POR DISCAPACIDAD:</label>
                        <div class="col-sm-2">
                        <input type="text" class="form-control sumar" value="<?php echo $fila['porce_discapacidad']; ?>" disabled="true">
                        </div>
                        <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                      </div>
                      <div class="form-group row">
                        <label for="staticEmail" class="col-sm-6 col-form-label">% LIC. MILITAR:</label>
                        <div class="col-sm-2">
                        <input type="text" class="form-control sumar" value="<?php echo $fila['porce_sermilitar']; ?>" disabled="true">
                        </div>
                        <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-12" >
                      <div class="form-group">
                        <h6 class="m-0 font-weight-bold text-danger">Comisión</h6>
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
                              <tbody>
                                <?php    
                                  $sql = "SELECT * FROM comision where convocatoria_idcon='".$idcon."' ";
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
                                  <th>Cargo</th>
                                  <th>Cantidad</th>
                                  <th>Remuneración</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
        
                                $sql = " SELECT * FROM Personal_req INNER JOIN cargo ON cargo.idcargo = Personal_req.cargo_idcargo Where idpersonal='".$idcon."'";

                                $query=mysqli_query($con, $sql);

                                while ($row= MySQLI_fetch_array($query)){
                                    $cantidad=$row['cantidad'];
                                    $remuneracion=$row['remuneracion'];
                                    $fuente=$row['fuente_finac'];
                                    $meta=$row['meta'];
                                    $cargo=$row['cargo'];

                                ?>
                                  <tr>
                                  <td><?php echo $cantidad;?></td>
                                  <td><?php echo $remuneracion;?></td>
                                  <td><?php echo $fuente;?></td>
                                  <td><?php echo $meta;?></td>
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
                  <div class="d-flex justify-content-end">
                    <a class="btn btn-danger" role="button" href="listado_convocatorias.php?dni=<?php echo $dni ?>">Atrás</a>
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
          <h5 class="modal-title" id="exampleModalLabel">¿Deseas cerrar sesión?</h5>
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