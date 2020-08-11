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
                  <h6 class="m-0 font-weight-bold text-primary">AGREGAR DATOS PERSONAL REQUERIDO</h6>
                </div>
                <div class="card-body">
                  <form action="" method="POST">
                    <div class="form-group">
                        <h6 class="m-0 font-weight-bold text-danger">Datos de la convocatoria</h6>
                        <hr class="sidebar-divider">
                    </div>
                    <div class="form-group">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
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
                                <tr>
                                  <td><input type="text" name="name[]" placeholder="CANTIDAD" class="form-control name_list" /></td>
                                  <td>
                                    <select name="cargo" class="form-control" id="cargo">
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
                                  <td><input type="text" name="name[]" placeholder="Ejemplo: 2000" class="form-control name_list" /></td>
                                  <td><input type="text" name="name[]" placeholder="RECURSOS ORDINARIOS" class="form-control name_list" /></td>
                                  <td><input type="text" name="name[]" placeholder="Ejemplo: 002" class="form-control name_list" /></td>
                                  <td><button type="button" name="add" id="add" class="btn btn-primary"> + </button></td>
                                </tr>
                            </tdody>
                        </table>
                      </div>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">SIGUIENTE</button>
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

  <script>
    $(document).ready(function(){
        var i = 1;
        $('#add').click(function () {
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'">' +
              '<td><input type="text" name="name[]" placeholder="CANTIDAD" class="form-control name_list" /></td>' +
              '<td><input type="text" name="name[]" placeholder="CARGO" class="form-control name_list" /></td>' +
              '<td><input type="text" name="name[]" placeholder="Ejemplo: 2000" class="form-control name_list" /></td>' +
              '<td><input type="text" name="name[]" placeholder="RECURSOS ORDINARIOS" class="form-control name_list" /></td>' +
              '<td><input type="text" name="name[]" placeholder="Ejemplo: 002" class="form-control name_list" /></td>' +
              '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>' +
              '</tr>');
        });
        
        $(document).on('click', '.btn_remove', function () {
            var id = $(this).attr('id');
            $('#row'+ id).remove();
        });
    });
  </script>

</body>

</html>