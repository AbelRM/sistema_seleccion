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

  <title>SB Admin 2 - Tables</title>

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

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DIRECCION EJECUTIVA</h6>
            </div>
            <?php
            include '../conexion.php';
            include 'modal_ver_convocatoria.php';
            ?>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                      <th>N°</th>
                      <th>Direccion Ejecutiva</th>
                      <th>Equipo Ejecutivo</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <?php
                 
                      $sql = "SELECT * FROM direccion_ejec INNER JOIN equipo_ejec ON equipo_ejec.idequipo = direccion_ejec.equipo_ejec_idequipo";
                     
                      $query=mysqli_query($con, $sql);
                      while ($row= MySQLI_fetch_array($query))
                      {
                      ?>
                      <tr>
                        <td><?php echo $row['iddireccion'] ?></td>
                        <td style="font-size: 16px;"><?php echo $row['direccion_ejec'] ?></td>
                        <td style="font-size: 14px;"><?php echo $row['equipo_ejec'] ?></td>
                        <td>
                          <a href="modificar_personalreq.php?id=<?php echo $row['iddireccion']?>&dni=<?php echo $dato_desencriptado?>"><button type="button" class="btn btn-success" id="editar" style="margin: 1px;"><i class="fa fa-pen"></i></button></a>
                          <button type="button" class="btn btn-danger m-1  deleteBtn"> <i class="fas fa-trash-alt"></i></button>
                        </td>
                      </tr>
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

   <!-- Eliminar PERSONAL -->
   <div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
      <div class="modal-content"> 
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar Direccion Ejecutiva</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="procesos/eliminardireccion.php" method="POST">
          <div class="modal-body">

            <input type="hidden" name="iddireccion" id="iddireccion">
            <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
            <h4>¿Desea eliminar el registro?</h4>
 
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
          <button type="submit" class="btn btn-danger" name="deleteData1">SI</button>
        </div>
 
        </form>
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
    $(document).ready(function () {
      $('.deleteBtn').on('click', function(){
 
        $('#deleteModal').modal('show');
        
        // Get the table row data.
        $tr = $(this).closest('tr');
 
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
 
        console.log(data);
 
        $('#iddireccion').val(data[0]);
 
        });
    });
  </script>

</body>

</html>