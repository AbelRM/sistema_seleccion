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

  <script type="text/javascript" src="vendor/sweetalert/sweetalert2.min.js" ></script>
  <script type="text/javascript" src="vendor/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="vendor/sweetalert/sweetalert2.min.css">
  <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php   
        include 'conexion.php';
        
        include 'funcs/mcript.php';
        $dato_desencriptado = $_GET['dni'];
        $dni = $desencriptar($dato_desencriptado);

        $sql="SELECT * FROM usuarios where dni=$dni";
        $datos=mysqli_query($con,$sql) or die(mysqli_error()); ;
        $fila= mysqli_fetch_array($datos);

        $sql2="SELECT * FROM postulante where dni=$dni";
        $datos2=mysqli_query($con,$sql2) or die(mysqli_error()); ;
        $fila2= mysqli_fetch_array($datos2);
        $idpostulante=$fila2['idpostulante'];
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

          <!-- Page Heading -->
        
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">MIS CONVOCATORIAS</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                      <th>N° CONVOCATORIA</th>
                      <th>CARGO SELECCIONADO</th>
                      <th>BOLETA</th>
                      <th>FECHA INSCRIPCIÓN</th>
                      <th>ACCIONES</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                     <?php
                      $dni = $_GET['dni'];
                      
                      $sql3 = "SELECT * FROM detalle_convocatoria 
                      inner join total_personal_req on detalle_convocatoria.personal_req_idpersonal=total_personal_req.idpersonal 
                      inner join convocatoria on detalle_convocatoria.convocatoria_idcon=convocatoria.idcon 
                      WHERE postulante_idpostulante=$idpostulante";
                      $query=mysqli_query($con, $sql3);
                      while ($row= MySQLI_fetch_array($query))
                      {
                    ?>
                      <tr>
                        <td style="font-size: 16px;"><?php echo $row['num_con']."-".$row['anio_con'] ?></td>
                        <td style="font-size: 14px;"><?php echo $row['cargo']?></td>
                        <td style="font-size: 14px;"><?php echo $row['boleta']?></td>
                        <td style="font-size: 14px;"><?php echo $row['fecha_postulacion']?></td>

                        <td>
                          <a href="ver_postulaciones.php?id=<?php echo $row['iddetalle_convocatoria']?>&dni=<?php echo $dato_desencriptado?>"><button type="button" class="btn btn-primary" id="editar" style="margin: 1px;"><i class="fa fa-eye"></i> Ver</button></a>
                          <button type="button"  class="btn btn-primary delete_product"><i class="fa fa-eye"></i> Confirmar</button>
                         
                        </td>
                      </tr>
                    <?php
                      } 
                    ?>
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

  <script type="text/javascript">
        $(document).ready(function(){
        
        $(document).on('click', '.button1', function(){

          swal({
              title: "¿Deseas unirte al lado oscuro?",
              text: "Este paso marcará el resto de tu vida...",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "¡Claro!",
              cancelButtonText: "No, jamás",
              closeOnConfirm: false,
              closeOnCancel: false },

              function(isConfirm){
              if (isConfirm) {
              swal("¡Hecho!",
              "Ahora eres uno de los nuestros",
              "success");
              } else {
              swal("¡Gallina!",
              "Tu te lo pierdes...",
              "error");
              }
              });     
        });

    })
  </script>

  <script>
  $(document).ready(function(){
	fetch();

	$(document).on('click', '.delete_product', function(){
		var id = $(this).data('id');

		swal({
		  	title: 'Desea confirmar postulacion?',
		  	text: "No podrás modificar la postulacion!",
		  	type: 'warning',
		  	showCancelButton: true,
		  	confirmButtonColor: '#3085d6',
		  	cancelButtonColor: '#d33',
		  	confirmButtonText: 'Confirmar!',
		}).then((result) => {
		  	if (result.value){
		  		$.ajax({
			   		url: 'api.php?action=delete',
			    	type: 'POST',
			       	data: 'id='+id,
			       	dataType: 'json'
			    })
			    .done(function(response){
			     	swal('Deleted!', response.message, response.status);
					fetch();
			    })
			    .fail(function(){
			     	swal('Oops...', 'Something went wrong with ajax !', 'error');
			    });
		  	}

		})

	});
});
  </script>

</body>

</html>
