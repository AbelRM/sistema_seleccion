<?php
  include 'conexion.php';
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

  <title>Sistema de postulación DIRESA - TACNA</title>

  <!-- Custom fonts for this template-->
  <link rel="icon" type="image/png" href="img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">  

    <?php     
      include 'conexion.php';
      
      $dni = $_GET['dni'];
      //$descrip=base64_decode($dni);
      include_once('conexion.php');
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
        <?php
            include_once 'nav.php';
        ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- FICHA PARA ACTUALIZAR -->
            <div class="row justify-content-center">
                <div class="col-12 text-center ">
                    <div class="card border-primary mb-3" >
                        <div class="card-header">
                            <h4 id="heading">FICHA ÚNICA DE DATOS</h4>
                        </div>
                        <div class="card-body">
                            <form id="msform" method="post" action="procesos/actualizar_ficha.php">
                                <!-- progressbar -->
                                <div class="row p-2">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <ul id="progressbar">
                                            <li class="active" id="user"><strong></strong></li>
                                            <li id="home"><strong></strong></li>
                                            <li id="student"><strong></strong></li>
                                            <li id="confirm"><strong></strong></li> 
                                        </ul>
                                    </div>
                                </div>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">DATOS PERSONALES COMPLEMENTARIOS:</h2>
                                            </div>
                                        </div>
                                        <?php     
                                            include 'conexion.php';
                                            $dni = $_GET['dni'];
                                            //$descrip=base64_decode($dni);
                                            include_once('conexion.php');
                                            $sql="SELECT * FROM postulante where dni=$dni";
                                            $datos=mysqli_query($con,$sql) or die(mysqli_error());
                                            $fila= mysqli_fetch_array($datos);
                                            $idpostulante=$fila['idpostulante'];
                                            $distrito=$fila['distrito_iddistrito'];
                                            
                                        ?>
                                        <div class="form-group row">
                                            <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                                <label>Nombres</label> 
                                                <input class="form-control form-control-user" type="text" value="<?php echo $fila['nombres']." ".$fila['ape_pat']." ".$fila['ape_mat']; ?>" disabled="true"/> 
                                            </div>
                                            <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                                <label>D.N.I.</label> 
                                                <input class="form-control form-control-user" value="<?php echo $fila['dni'] ?>" disabled/> 
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                                <label>Fecha de nacimiento</label> 
                                                <input class="form-control form-control-user" value="<?php echo $fila['fech_nac'] ?>" disabled/> 
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                                <label>Sexo</label> 
                                                <select class="form-control" name="sexo" id="sexo">
                                                    <option selected><?php echo $fila['sexo'] ?></option>
                                                    <option value="MASCULINO">MASCULINO</option>
                                                    <option value="FEMENINO">FEMENINO</option>
                                                </select> 
                                            </div>
                                            
                                            <?php
                                                include "conexion.php";
                                                $total="SELECT * FROM total_lugar WHERE iddistrito=$distrito";
                                                $respuesta=mysqli_query($con,$total) or die(mysqli_error());
                                                $row2= mysqli_fetch_array($respuesta);

                                            ?>
                                            <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                                <label for="name1">Departamento nacimiento</label>
                                                <input class="form-control form-control-user" type="text" value="<?php echo $row2['departamento']?>" disabled="true"/>
                                            </div>

                                            <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                                <label for="name1">Provincia nacimiento</label>
                                                <input class="form-control form-control-user" type="text" value="<?php echo $row2['provincia']?>" disabled="true"/>                                 
                                            </div>
                                            <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                                <label for="exampleInputEmail1">Distrito nacimiento</label>
                                                <input class="form-control form-control-user" type="text" value="<?php echo $row2['distrito']?>" disabled="true"/>
                                            </div>

                                            <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                                <label for="exampleInputEmail1">Celular</label>
                                                <input class="form-control form-control-user" type="text" value="<?php echo $fila['celular']?>"/>
                                            </div>

                                            <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                                <label for="exampleInputEmail1">Correo</label>
                                                <input class="form-control form-control-user" type="text" value="<?php echo $fila['correo']?>"/>
                                            </div>
                                            
                                            <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                                <label>Estado civil</label> 
                                                <select class="form-control" name="civil" id="civil">
                                                    <option selected><?php echo $fila['estado_civil'] ?></option>
                                                    <option value="SOLTERO(A)">Soltero(a)</option>
                                                    <option value="CASADO(A)">Casado(a)</option>
                                                    <option value="VIUDO(A)">Viudo(a)</option>
                                                    <option value="DIVORCIADO(A)">Divorciado(a)</option>
                                                    <option value="CONVIVIENTE">Conviviente</option>
                                                </select> 
                                            </div>
                                            
                                            <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                                <label>Cel. emergencia</label> 
                                                <input class="form-control form-control-user" type="text" name="num_emer" id="num_emer" value="<?php echo $fila['celular_emer'] ?>" /> 
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                                <label>Parentesco</label> 
                                                <input class="form-control form-control-user" placeholder="Nombre familiar" type="text" name="nomb_parent" id="nomb_parent" value="<?php echo $fila['parentesco_emer'] ?>"/> 
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                                <label>R.U.C.</label> 
                                                <input class="form-control form-control-user" type="text" name="ruc" id="ruc" value="<?php echo $fila['ruc'] ?>"/> 
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                                <label>N° cuenta bancaria</label> 
                                                <input class="form-control form-control-user" placeholder="Banco de la Nación" type="text" name="cuenta_banc" id="cuenta_banc" value="<?php echo $fila['num_cuenta'] ?>"/> 
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                                <label>Suspensión de 4ta.</label> 
                                                <select class="form-control" name="cuarta" id="cuarta">
                                                    <option select><?php echo $fila['suspension_cuarta'] ?></option>
                                                    <option value="NO" selected>NO</option>
                                                    <option value="SI">SI</option>
                                                </select> 
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                                <label>Tipo de pensión</label> 
                                                <select class="form-control" name="pension" id="pension">
                                                    <option select><?php echo $fila['seguro'] ?></option>
                                                    <option value="NINGUNA" selected>Ninguna</option>
                                                    <option value="ONP">ONP</option>
                                                    <option value="SPP">SPP</option>
                                                </select> 
                                            </div>
                                            <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                                <label>Discapacidad</label> 
                                                <select class="form-control" name="discapacidad" id="discapacidad">
                                                    <option select><?php echo $fila['discapacidad'] ?></option>
                                                    <option value="NO" selected>NO</option>
                                                    <option value="SI">SI</option>
                                                    
                                                </select>  
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                                <label>Tipo de discapacidad</label> 
                                                <select class="form-control" name="tip_discapacidad" id="tip_discapacidad">
                                                    <option select><?php echo $fila['tipo_discap'] ?></option>
                                                    <option value="NINGUNA" select>Ninguna</option>
                                                    <option value="FISICA">Físicas</option>
                                                    <option value="SENSORIAL">Sensoriales</option>
                                                    <option value="MENTAL">Mentales</option>
                                                    <option value="INTELECTUAL">Intelectuales</option>
                                                </select>  
                                            </div>
                                            <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                                <label>Grupo sanguineo</label> 
                                                <select class="form-control" name="tip_sangre" id="tip_sangre">
                                                    <option selected><?php echo $fila['tipo_sangre'] ?></option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="0+">0+</option>
                                                    <option value="0-">0-</option>
                                                </select>  
                                            </div>
                                            <div class="col-md-5 col-sm-6 mb-2 mb-sm-0">
                                                <label>Enfermedades/Alergias</label> 
                                                <input class="form-control form-control-user" type="text" placeholder="Separado por comas" name="alergias" id="alergias" value="<?php echo $fila['alergias'] ?>"/> 
                                            </div>
                                        </div> 
                                    </div>
                                    <input type="button" name="next" class="next action-button" value="Siguiente" />
                                </fieldset>

                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">DOMICILIO:</h2>
                                            </div>
                                        </div>
                                        <?php     
                                            include 'conexion.php';
                                            $dni = $_GET['dni'];
                                            //$descrip=base64_decode($dni);
                                            include_once('conexion.php');
                                            $sql2="SELECT * FROM domicilio_post where postulante_idpostulante=$idpostulante";
                                            $datos2=mysqli_query($con,$sql2) or die(mysqli_error()); ;
                                            $fila2= mysqli_fetch_array($datos2);

                                        ?>               
                                        <div class="form-group row">

                                            <input type="hidden" id="dni_post" name="dni_post" value="<?php echo $fila['dni']; ?>"/>

                                            <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                                <label for="exampleInputEmail1">Tipo de Via</label>
                                                <select class="form-control form-control-user" name="tipo_via" id="tipo_via">
                                                <option selected><?php echo $fila2['tip_via'] ?></option>
                                                <option value="AVENIDA">Avenida</option>
                                                <option value="JIRON">Jiron</option>
                                                <option value="CALLE">Calle</option>
                                                <option value="PASAJE">Pasaje</option>
                                                <option value="ALAMEDA">Alameda</option>
                                                <option value="MALECON">Malecon</option>
                                                <option value="OVALO">Ovalo</option>
                                                <option value="PASAJE">Pasaje</option>
                                                <option value="PARQUE">Parque</option>
                                                <option value="PLAZA">Plaza</option>
                                                <option value="CARRETERA">Carretera</option>
                                                <option value="TROCHA">Trocha</option>
                                                </select>
                                            </div>
                                            <div class="col-md-7 col-sm-6 mb-2 mb-sm-0">
                                                <label>Nombre de via</label> 
                                                <input class="form-control form-control-user" type="text" name="nomb_via" id="nomb_via" value="<?php echo $fila2['nomb_via']?>"/> 
                                            </div>
                                            
                                            <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                                <label>Número</label> 
                                                <input class="form-control form-control-user" type="text" name="num_via" id="num_via" value="<?php echo $fila2['num_via']?>"/> 
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                                <label for="exampleInputEmail1">Tipo de Zona</label>
                                                <select class="form-control form-control-user" name="tipo_zona" id="tipo_zona">
                                                <option selected><?php echo $fila2['tip_zona'] ?></option>
                                                <option value="AVENIDA">Urbanizacion</option>
                                                <option value="JIRON">Pueblo Joven</option>
                                                <option value="CALLE">Unidad vecinal</option>
                                                <option value="PASAJE">Conjunto habitacional</option>
                                                <option value="ALAMEDA">Asentamiento humano</option>
                                                <option value="MALECON">Cooperativa</option>
                                                <option value="OVALO">Residencial</option>
                                                <option value="PASAJE">Zona industrial</option>
                                                <option value="PARQUE">Grupo</option>
                                                <option value="PLAZA">Caserio</option>
                                                <option value="CARRETERA">Fundo</option>
                                                </select>
                                                <br>
                                            </div>

                                            <div class="col-md-7 col-sm-6 mb-2 mb-sm-0">
                                                <label>Nombre de la zona</label> 
                                                <input class="form-control form-control-user" type="text" name="nomb_zona" id="nomb_zona" value="<?php echo $fila2['num_zona']?>"/> 
                                            </div>

                                            <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                                <label>Número</label> 
                                                <input class="form-control form-control-user" type="text" name="num_zona" id="num_zona" value="<?php echo $fila2['num_zona']?>"/> 
                                            </div>
                                            <div class="col-md-2 col-sm-2 mb-2 mb-sm-0">
                                                <label>Número</label> 
                                                <input class="form-control form-control-user" type="text" name="numero" id="numero" value="<?php echo $fila2['numero']?>"/> 
                                            </div>
                                            <div class="col-md-2 col-sm-2 mb-2 mb-sm-0">
                                                <label>Mz.</label> 
                                                <input class="form-control form-control-user" type="text" name="manzana" id="manzana" value="<?php echo $fila2['manzana']?>"/> 
                                            </div>
                                            <div class="col-md-2 col-sm-2 mb-2 mb-sm-0">
                                                <label>Lt.</label> 
                                                <input class="form-control form-control-user" type="text" name="lote" id="lote" value="<?php echo $fila2['lote']?>"/> 
                                            </div>

                                            <div class="col-md-6 col-sm-6 mb-2 mb-sm-0">
                                                <label>Referencia</label> 
                                                <input class="form-control form-control-user" type="text" name="referencia" id="referencia" value="<?php echo $fila2['referencia']?>"/> 
                                            </div>
                                        </div>   
                                    </div>
                                    <input type="button" name="next" class="next action-button" value="Siguiente"/>
                                    <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                                </fieldset>

                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">DATOS FAMILIARES:</h2>
                                            </div>
                                        </div>
                                        <?php     
                                            include 'conexion.php';
                                            $dni = $_GET['dni'];
                                            //$descrip=base64_decode($dni);
                                            include_once('conexion.php');
                                            $sql3="SELECT * FROM familia_post where postulante_idpostulante=$idpostulante";
                                            $datos3=mysqli_query($con,$sql3) or die(mysqli_error()); ;
                                            $fila3= mysqli_fetch_array($datos3);

                                        ?> 
                                        <div class="form-group">
                                            <div class="table-responsive">
                                                <label>Los familiares agregados son aquellos que viven actualmente con usted, caso contrario colocar uno de referencia.</label>
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
                                                    <?php
                                                        
                                                        include_once('conexion.php');
                                                        $tabla="SELECT * FROM familia_post where postulante_idpostulante=$idpostulante";
                                                        $result=mysqli_query($con,$tabla);
                                                        while($row=mysqli_fetch_array($result)){   
                                                        ?>
                                                        <tr>
                                                            <td style="font-size: 16px;"><?php echo $row['nombre'] ?></td>
                                                            <td style="font-size: 14px;"><?php echo $row['apellidos'] ?></td>
                                                            <td style="font-size: 14px;"><?php echo $row['fech_nac'] ?></td>
                                                            <td style="font-size: 14px;"><?php echo $row['dni'] ?></td>
                                                            <td style="font-size: 14px;"><?php echo $row['parentesco'] ?></td>
                                                            <td style="font-size: 14px;"><?php echo $row['labora'] ?></td>
                                                            <td class="eliminar"><input type="button" class="btn btn-danger" value=" - "></td>
                                                            
                                                        </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                        <!-- <tr class="fila-fija">
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
                                                        </tr> -->
                                                    </tdody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- <div class="row d-flex justify-content-center">
                                            <div class="form-inline p-2">
                                                <button id="adicional" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                                            </div>
                                        </div> -->
                                    </div>
                                    <input type="button" name="insertar" class="next action-button" value="Siguiente" /> 
                                    <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                                </fieldset>
                                
                                <fieldset>
                                    <div class="form-card">
                                        <h3 class="purple-text text-center"><strong>ESTAMOS A PUNTO DE ACTUALIZAR !</strong></h3> <br>
                                        <div class="row justify-content-center">
                                            <div class="col-6"> 
                                                <img src="img/confirmacion.png" alt="Imagen de confirmación" style="width: 100%; height: auto;"> 
                                            </div>
                                        </div> <br><br>
                                        <div class="row justify-content-center">
                                            <div class="col-6 text-center">
                                                <h5 class="purple-text text-center">Presione ACTUALIZAR si esta seguro de haber actualizado su información!</h5>
                                                <!-- <h6 class="red-text">NOTA: No se olvide luego llenar sus datos profesionales y experiencia laboral.</h6> -->
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" name="next" class="next action-button" value="Actualizar"/>
                                    <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                                </fieldset>
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
          <a class="btn btn-primary" href="procesos/cerrar_sesion.php">Cerrar sesión</a>
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
  <script src="js/sb-admin-2.min.js"></script>
  <script src="js/wizard.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>