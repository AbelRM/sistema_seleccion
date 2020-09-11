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

  <title>AGREGAR PERSONAL REQUERIDO - SISTEMA SELECCION (DIRESA-TACNA)</title>

  <!-- Custom fonts for this template-->
  <link rel="icon" type="image/png" href="img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/lib/chosen/chosen.css">

</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php     
      $dato_desencriptado = $_GET['dni'];
      $dni = $desencriptar($dato_desencriptado);

      $sql="SELECT * FROM usuarios where dni=$dni";
      $datos=mysqli_query($con,$sql) or die(mysqli_error()); ;
      $buscar= mysqli_fetch_array($datos);
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

                    $datos_2=mysqli_query($con,"SELECT * FROM convocatoria INNER JOIN ubicacion
                    ON convocatoria.direccion_ejec_iddireccion = ubicacion.iddireccion WHERE idcon=$idcon");
                    $fila_2= mysqli_fetch_array($datos_2);
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
                      <input type="text" class="form-control" value="<?php echo $fila_2['direccion_ejec']?>" disabled="true">
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                      <label for="inputEmail4">Equipo ejecutor</label>
                      <input type="text" class="form-control" value="<?php echo $fila_2['equipo_ejec']?>" disabled="true">
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
                    <div class="form-group row">
                      <div class="col-md-12 d-flex justify-content-end">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Nuevo</a>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table  class="table table-bordered">  
                        <thead>
                          <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                            <th>N°</th>
                            <th>Cantidad</th>
                            <th>Remuneración</th>
                            <th>Fuente Finac.</th>
                            <th>Meta</th>
                            <th>Cargo</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $consulta_form = "SELECT * FROM total_personal_req WHERE convocatoria_idcon = $idcon";
                            $query=mysqli_query($con, $consulta_form);
                            if(mysqli_num_rows($query)>0){
                              while ($row= MySQLI_fetch_array($query))
                              {
                              ?>
                                <tr>
                                  <td style="font-size: 12px;"><?php echo $row['idpersonal'] ?></td>
                                  <td style="font-size: 12px;"><?php echo $row['cantidad'] ?></td>
                                  <td style="font-size: 12px;"><?php echo $row['remuneracion'] ?></td>
                                  <td style="font-size: 12px;"><?php echo $row['fuente_finac'] ?></td>
                                  <td style="font-size: 12px;"><?php echo $row['meta'] ?></td>
                                  <td style="font-size: 12px;"><?php echo $row['cargo'] ?></td>
                                  <td class="d-flex justify-content-center">
                                    <a type="button" href="editarformacion.php?idformacion=<?php echo $row['id_formacion']?>&dni=<?php echo $dato_desencriptado ?>" class="btn btn-success btn-sm m-1">
                                    <i class="fa fa-edit"></i> Editar</a>
                                    <button type="button" class="btn btn-danger btn-sm m-1 deleteBtn"> <i class="fas fa-trash-alt"></i></button>
                                  </td>
                                </tr>
                              <?php
                              }
                            }else{
                              echo "<tr>
                                <td colspan='7' class='text-center text-danger font-weight-bold' >NO HAY DATOS REGISTRADOS</td>
                              </tr>";
                            }
                          ?>
                        </tbody>
                      </table>
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

   <!-- ADD NUEVOS DATOS -->
   <div class="modal fade" id="addModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Nuevo personal requerido</h5>
          <button class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <div class="modal-body">
          <form action="procesos/guardar_personal_req.php" autocomplete="off" method="POST">
            <div class="row"> 
              <div class="form-group font-weight-bolder">
                <p class="text-danger">(*) Indica un campo obligatorio.</p>
              </div>
              <div class="col-md-12">
                <h6 class="m-0 font-weight-bold text-danger">Datos del personal requeridos</h6>
                <hr class="sidebar-divider">
              </div>
              <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="idconvocatoria" value="<?php echo $idcon ?>">
              <div class="col-md-3 col-sm-12 form-group">
                <label for="title">Cantidad requerida</label>
                <input style="font-size:13px;" type="number" name="cantidad" class="form-control name_list" required/>
              </div>
              <div class="col-md-3 col-sm-12 form-group">
                <label for="title">(*) Cargo</label>
                <select style="font-size:12px;" name="cargo" class="form-control" id="cargo" required>
                  <option value="" disabled selected>Elegir</option>
                  <?php
                    include_once('conexion.php');
                    $sql = mysqli_query($con,"SELECT * from cargo") or die("Problemas en consulta").mysqli_error();
                    while ($registro=mysqli_fetch_array($sql)) {
                      echo "<option value=\"".$registro['idcargo']."\">".$registro['cargo']."</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="col-md-3 col-sm-12 form-group">
                <label for="title">(*) Remuneración</label>
                <input style="font-size:13px;" type="text" name="remuneracion" placeholder="Ejemplo: 2000" class="form-control name_list" required/>
              </div>
              <div class="col-md-3 col-sm-12 form-group">
                <label for="title">(*) Fuente Financ.</label>
                <select style="font-size:13px;" class="form-control" name="fuente_finac" required>
                  <option value="R. ORDINARIOS">R. ORDINARIOS</option>
                  <option value="R. DIRECTAMENTE RECAUDADOS">R. D. RECAUDADOS</option>
                  <option value="CANON SOBRE CANON">CANON SOBRE CANON</option>
                  <option value="R. DETERMINADOSS">R. DETERMINADOS</option>
                </select>
              </div>
              <div class="col-md-3 col-sm-12 form-group">
                <label for="title">(*) Meta</label>
                <input style="font-size:13px;" type="text" name="meta" placeholder="Ejemplo: 002" class="form-control name_list" required />
              </div>
              <div class="col-md-9 col-sm-12 form-group">
                <label for="title">(*) Ubicación del personal requerido</label>
                <select name="chosen-unique" class="chosen1" data-placeholder="Elige la ubicación del personal requerido" required>
                  <option value=""></option>
                  <?php
                    $sql="SELECT * FROM ubicacion";
                    $res=mysqli_query($con,$sql) or die("Problemas en consulta").mysqli_error();
                    while ($rw= mysqli_fetch_array($res)){
                      echo "<option value=".$rw["iddireccion"].">".$rw["direccion_ejec"]." - ".$rw["equipo_ejec"]."</option> ";
                    } 
                  ?>
                </select>
              </div>
              <div class="col-md-12">
                <h6 class="m-0 font-weight-bold text-danger">Elegir los Requesitos básicos</h6>
                <hr class="sidebar-divider">
              </div>
              <div class="table-responsive">
                  <table class="table table-bordered" id="tabla-1">
                      <thead>
                          <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                              <th scope="col">Requerimiento</th>
                              <th scope="col">Nivel de Prioridad</th>
                              <th scope="col-1">Acción</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr class="fila-fija-1">
                            <td style="font-size:12px;">
                              <select name="requerimientos[]" class="form-control" id="lugar">
                                <option value="" disabled selected>Elegir</option>
                                <?php
                                  include_once('conexion.php');
                                  $sql = mysqli_query($con,"SELECT * from requerimientos") or die("Problemas en consulta").mysqli_error();
                                  while ($registro=mysqli_fetch_array($sql)) {
                                    echo "<option value=\"".$registro['id_requerimientos']."\">".$registro['condicion']."</option>";
                                  }
                                ?>
                              </select>
                            </td>
                            <td><input style="font-size:12px;" type="text" name="nivel_priori[]" class="form-control name_list" /></td>
                            <td class="eliminar"><button type="button" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button></td>
                          </tr>
                      </tdody>
                  </table>
              </div>
              <input type="hidden" name="dni" value="<?php echo $dato_desencriptado; ?>">
              <input type="hidden" name="idpostulante" value="<?php echo $idpostulante; ?>">
              <div class="col-12 d-flex justify-content-end p-2">
                <button id="adicional-1" name="adicional" type="button" class="btn btn-warning"><i class="far fa-plus-square"></i> Fila</button>
              </div>
              <div class="col-12 d-flex justify-content-center p-2">
                <button  name="insertar" type="submit" class="btn btn-primary">Guardar</button>
              </div>
          
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="insertData">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

   <!-- DELETE MODAL -->
   <div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar registro de Formación</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="procesos/borrar_formacion.php" method="POST">
 
          <div class="modal-body">
 
            <input type="hidden" name="deleteId" id="deleteId">
            <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
            <h4>¿Desea eliminar el registro de formación?</h4>
 
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
          <button type="submit" class="btn btn-danger" name="deleteData">SI</button>
        </div>
 
        </form>
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
  <script src="js/lib/chosen/chosen.jquery.min.js"></script>
  <script>
    $(function(){
        // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
        $("#adicional").on('click', function(){
            $("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla").find("input[type=text]").val("");
        });
        
        // Evento que selecciona la fila y la elimina 
        $(document).on("click",".eliminar",function(){
            var parent = $(this).parents().get(0);
            $(parent).remove();
        });
    });
  </script> 
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
 
        $('#deleteId').val(data[0]);
 
        });
    });
  </script>   
  <script>
		jQuery(document).ready(function() {
				jQuery(".chosen1").chosen({
						disable_search_threshold: 10,
						no_results_text: "Oops, no ha sido encontrado!",
						width: "100%"
				});
		});
	</script>    
  <script>
    $(function(){
      // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
      $("#adicional-1").on('click', function(){
          $("#tabla-1 tbody tr:eq(0)").clone().removeClass('fila-fija-1').appendTo("#tabla-1").find("input[type=text],input[type=date]").val("");
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