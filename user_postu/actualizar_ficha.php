<?php
include 'conexion.php';
include 'funcs/mcript.php';
session_start();
if (empty($_SESSION['active'])) {
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

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php
    $dato_desencriptado = $_GET['dni'];
    $dni = $desencriptar($dato_desencriptado);

    $sql = "SELECT * FROM usuarios where dni=$dni";
    $datos = mysqli_query($con, $sql) or die(mysqli_error($datos));;
    $fila = mysqli_fetch_array($datos);

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
              <div class="card border-primary mb-3">
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
                          <li id="anexo"><strong></strong></li>
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
                        $sql = "SELECT * FROM postulante where dni=$dni";
                        $datos = mysqli_query($con, $sql) or die(mysqli_error($datos));
                        $fila = mysqli_fetch_array($datos);
                        $idpostulante = $fila['idpostulante'];
                        ?>

                        <div class="form-group row">
                          <div class="col-md-4 col-sm-6 mb-2 mb-sm-0 ">
                            <label class="font-weight-bolder">Nombres</label>
                            <input class="form-control form-control-user" type="text" value="<?php echo $fila['nombres'] . " " . $fila['ape_pat'] . " " . $fila['ape_mat']; ?>" disabled="true" />
                          </div>
                          <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">D.N.I.</label>
                            <input class="form-control form-control-user" value="<?php echo $fila['dni'] ?>" disabled />
                          </div>
                          <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">Fecha de nacimiento</label>
                            <input class="form-control form-control-user" value="<?php echo $fila['fech_nac'] ?>" disabled />
                          </div>

                          <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">Pais</label>
                            <select class="form-control" name="pais" id="pais">
                              <option selected><?php echo $fila['pais'] ?></option>
                              <option value="ECUADOR">ECUADOR</option>
                              <option value="PERU">PERU</option>
                              <option value="CHILE">CHILE</option>
                              <option value="BRASIL">BRASIL</option>
                              <option value="BOLIVIA">BOLIVIA</option>
                              <option value="URUGUAY">URUGUAY</option>
                              <option value="ARGENTINA">ARGENTINA</option>
                              <option value="PARAGUAY">PARAGUAY</option>
                              <option value="VENEZUELA">VENEZUELA</option>
                              <option value="COLOMBIA">COLOMBIA</option>
                            </select>
                          </div>
                          <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">Sexo</label>
                            <select class="form-control" name="sexo" id="sexo">
                              <option selected><?php echo $fila['sexo'] ?></option>
                              <option value="MASCULINO">MASCULINO</option>
                              <option value="FEMENINO">FEMENINO</option>
                            </select>
                          </div>

                          <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder" for="exampleInputEmail1">Celular</label>
                            <input class="form-control form-control-user" type="text" name="celular" id="celular" value="<?php echo $fila['celular'] ?>" maxlength="9" required />
                          </div>

                          <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder" for="exampleInputEmail1">Correo</label>
                            <input class="form-control form-control-user" type="text" name="correo" id="correo" value="<?php echo $fila['correo'] ?>" />
                          </div>

                          <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">Estado civil</label>
                            <select class="form-control" name="estado_civil" id="estado_civil">
                              <option selected><?php echo $fila['estado_civil'] ?></option>
                              <option value="SOLTERO(A)">Soltero(a)</option>
                              <option value="CASADO(A)">Casado(a)</option>
                              <option value="VIUDO(A)">Viudo(a)</option>
                              <option value="DIVORCIADO(A)">Divorciado(a)</option>
                              <option value="CONVIVIENTE">Conviviente</option>
                            </select>
                          </div>

                          <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">Cel. emergencia</label>
                            <input class="form-control form-control-user" type="text" name="celular_emer" id="celular_emer" value="<?php echo $fila['celular_emer'] ?>" maxlength="9" required />
                          </div>
                          <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">Parentesco</label>
                            <input class="form-control form-control-user" placeholder="Nombre familiar" type="text" name="parentesco_emer" id="parentesco_emer" value="<?php echo $fila['parentesco_emer'] ?>" />
                          </div>
                          <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">R.U.C.</label>
                            <input class="form-control form-control-user" type="text" name="ruc" id="ruc" value="<?php echo $fila['ruc'] ?>" maxlength="11" />
                          </div>
                          <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">N° cuenta bancaria</label>
                            <input class="form-control form-control-user" placeholder="Banco de la Nación" type="text" name="num_cuenta" id="num_cuenta" value="<?php echo $fila['num_cuenta'] ?>" maxlength="16" required />
                          </div>
                          <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">Suspensión de 4ta.</label>
                            <select class="form-control" name="cuarta" id="cuarta">
                              <option select><?php echo $fila['suspension_cuarta'] ?></option>
                              <option value="NO" selected>NO</option>
                              <option value="SI">SI</option>
                            </select>
                          </div>
                          <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">Tipo de pensión</label>
                            <select class="form-control custom-select" name="pension" id="inputSelect">
                              <option select><?php echo $fila['seguro'] ?></option>
                              <option value="ONP">ONP</option>
                              <option value="AFP">AFP</option>
                            </select>
                          </div>
                          <div id="AFP" class="divOculto col-md-3 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">Nombre de la AFP:</label>
                            <input type="text" name="nombre_afp" class="form-control">
                          </div>
                          <div id="AFP-2" class="divOculto col-md-3 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">Código CUSSP (opcional):</label>
                            <input type="text" name="codigo_cussp" class="form-control">
                          </div>
                          <div id="NINGUNA" class="divOculto col-md-3 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">¿A cuál te gustaria pertenecer?</label>
                            <select class="form-control custom-select" name="pertenecer_pension" id="pertenecer_pension">
                              <option value="ONP" selected>ONP</option>
                              <option value="AFP">AFP</option>
                            </select>
                          </div>
                          <div id="opcion-AFP" class="divOculto col-md-3 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">Nombre de la AFP:</label>
                            <input type="text" name="nombre_afp_pregunta" class="form-control">
                          </div>
                          <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">Discapacidad</label>
                            <select class="form-control" name="discapacidad" id="discapacidad">
                              <option select><?php echo $fila['discapacidad'] ?></option>
                              <option value="NO" selected>NO</option>
                              <option value="SI">SI</option>
                            </select>
                          </div>
                          <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">Tipo de discapacidad</label>
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
                            <label class="font-weight-bolder">Grupo sanguineo</label>
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

                          <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Servicio militar Completo</label> 
                                        <select class="form-control" name="servicio" id="servicio">
                                            <option selected><?php echo $fila['servicio_militar']?></option>
                                            <option value="NO">NO</option>
                                            <option value="SI">SI</option>
                                        </select>  
                                    </div>
                          <div class="col-md-5 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">Enfermedades/Alergias</label>
                            <input class="form-control form-control-user" type="text" placeholder="Separado por comas" name="alergias" id="alergias" value="<?php echo $fila['alergias'] ?>" />
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
                        $sql2 = "SELECT * FROM domicilio_post where postulante_idpostulante=$idpostulante";
                        $datos2 = mysqli_query($con, $sql2) or die(mysqli_error($datos2));
                        $fila2 = mysqli_fetch_array($datos2);
                        $distrito = $fila2['distrito_idistrito'];

                        ?>

                        <?php
                        $sql2 = "SELECT * FROM domicilio_post where postulante_idpostulante=$idpostulante";
                        $datos2 = mysqli_query($con, $sql2) or die(mysqli_error($datos2));
                        $fila2 = mysqli_fetch_array($datos2);
                        $distrito = $fila2['distrito_idistrito'];

                        $total = "SELECT * FROM total_lugar WHERE iddistrito=$distrito";
                        $respuesta = mysqli_query($con, $total) or die(mysqli_error($respuesta));
                        $row2 = mysqli_fetch_array($respuesta);
                        ?>

                        <div class="form-group row">

                          <input type="hidden" id="dni_post" name="dni_post" value="<?php echo $fila['dni']; ?>" />
                          <input type="hidden" id="idpostulante" name="idpostulante" value="<?php echo $idpostulante ?>" />

                          <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder" for="name1">Departamento</label>
                            <input class="form-control form-control-user" type="text" value="<?php echo $row2['departamento'] ?>" disabled="true" />
                          </div>

                          <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder" for="name1">Provincia</label>
                            <input class="form-control form-control-user" type="text" value="<?php echo $row2['provincia'] ?>" disabled="true" />
                          </div>
                          <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder" for="exampleInputEmail1">Distrito</label>
                            <input class="form-control form-control-user" type="text" name="distrito" value="<?php echo $row2['distrito'] ?>" disabled="true" />
                          </div>

                          <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder" for="exampleInputEmail1">Tipo de Via</label>
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
                            <label class="font-weight-bolder">Nombre de via</label>
                            <input class="form-control form-control-user" type="text" name="nomb_via" id="nomb_via" value="<?php echo $fila2['nomb_via'] ?>" />
                          </div>

                          <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">Número de Via</label>
                            <input class="form-control form-control-user" type="text" name="num_via" id="num_via" value="<?php echo $fila2['num_via'] ?>" />
                          </div>
                          <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder" for="exampleInputEmail1">Tipo de Zona</label>
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
                            <label class="font-weight-bolder">Nombre de la zona</label>
                            <input class="form-control form-control-user" type="text" name="nomb_zona" id="nomb_zona" value="<?php echo $fila2['nomb_zona'] ?>" />
                          </div>

                          <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">Número zona:</label>
                            <input class="form-control form-control-user" type="text" name="num_zona" id="num_zona" value="<?php echo $fila2['num_zona'] ?>" />
                          </div>
                          <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder"># Número:</label>
                            <input class="form-control form-control-user" type="text" name="numero" id="numero" value="<?php echo $fila2['numero'] ?>" />
                          </div>

                          <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">Mz.</label>
                            <input class="form-control form-control-user" type="text" name="manzana" id="manzana" value="<?php echo $fila2['manzana'] ?>" />
                          </div>
                          <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">Lt.</label>
                            <input class="form-control form-control-user" type="text" name="lote" id="lote" value="<?php echo $fila2['lote'] ?>" />
                          </div>

                          <div class="col-md-6 col-sm-6 mb-2 mb-sm-0">
                            <label class="font-weight-bolder">Referencia</label>
                            <input class="form-control form-control-user" type="text" name="referencia" id="referencia" value="<?php echo $fila2['referencia'] ?>" />
                          </div>
                        </div>
                      </div>
                      <input type="button" name="next" class="next action-button" value="Siguiente" />
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
                        $sql3 = "SELECT * FROM familia_post where postulante_idpostulante=$idpostulante";
                        $datos3 = mysqli_query($con, $sql3) or die(mysqli_error($datos3));;
                        $fila3 = mysqli_fetch_array($datos3);

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
                                $tabla = "SELECT * FROM familia_post where postulante_idpostulante=$idpostulante";
                                $result = mysqli_query($con, $tabla);
                                while ($row = mysqli_fetch_array($result)) {
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
                                </tdody>
                            </table>
                          </div>
                          
                        </div>
                      </div>
                      <input type="button" name="next" class="next action-button" value="Siguiente" />
                      <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />

                    </fieldset>

                    <fieldset>

                      <div class="row">
                                          <div class="col-12">
                                              <h2 class="fs-title">DECLARACIÓN JURADA DE IMPEDIMENTOS E INCOMPATIBILIDADES:</h2>
                                          </div>
                              </div> 
                                    <?php  
                                        $sql4="SELECT * FROM encuesta where postulanteID =$idpostulante";
                                        $datos4=mysqli_query($con,$sql4) or die(mysqli_error());
                                        $fila4= mysqli_fetch_array($datos4);
                                 
                                    ?>  
                           
                              <table class="table table-bordered">
                                  
                                      <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.95em;">
                                      <th scope="col">N°</th>
                                      <th scope="col">Pregunta</th>
                                      <th scope="col">Respuesta</th>
                                      </tr>
                                  </thead>

                                  <tbody align="left">
                                      <tr>

                                      <th scope="row">1</th>
                                      <td>
                                          <h6 class="font-weight-bolder">Declaro bajo juramento lo siguiente:</h6>
                                          <label>Registra antecedentes policiales:</label> 
                                      </td>
                                      <td>

                                            <select class="form-control" name="pregunta1" id="pregunta1">
                                                <option selected><?php echo $fila4['pregunta1']?></option>
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>

                                      </td>        </tr>
                                      <tr>
                                      <th scope="row">2</th>
                                      <td>
                                          <label>Registra antecedentes penales:</label>
                                      </td>
                                      <td>
                                          <select class="form-control" name="pregunta2" id="pregunta2">
                                                <option selected><?php echo $fila4['pregunta2']?></option>
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                          </select>
                                      </td>
                                      </tr>
                                      <tr>
                                          <th scope="row">3</th>
                                              <td >
                                                  <label>Registra antecedentes judiciales:</label>
                                              </td>
                                              <td>
                                                <select class="form-control" name="pregunta3" id="pregunta3">
                                                  <option selected><?php echo $fila4['pregunta3']?></option>
                                                  <option value="NO">NO</option>
                                                  <option value="SI">SI</option>
                                                 </select>
                                              </td>
                                      </tr>

                                      <tr>
                                          <th scope="row">4</th> 
                                              <td>
                                                  <label>Tener inhabilitación vigente para prestar servicios al estado conforme al registro nacional de sanciones contra servidores civiles (RNSCC):</label>
                                              </td>
                                              <td>
                                                <select class="form-control" name="pregunta4" id="pregunta4">
                                                  <option selected><?php echo $fila4['pregunta4']?></option>
                                                  <option value="NO">NO</option>
                                                  <option value="SI">SI</option>
                                                 </select>
                                              </td>
                                      </tr>
                                      <tr>
                                          <th scope="row">5</th>
                                              <td>
                                                  <label>Estar inscrito en le registro de deudores alimentarios morosos (REDAM):</label>
                                              </td>
                                              <td>
                                                  <select class="form-control " name="pregunta5" id="pregunta5">
                                                    <option selected><?php echo $fila4['pregunta5']?></option>
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                  </select>
                                              </td>
                                      </tr>
                                      <tr>
                                          <th scope="row">6</th>
                                              <td>
                                                  <label>Estar inscrito en el registro nacional de abogados sancionados por mala practica profesional (RNS) (En caso corresponda):</label>
                                              </td>
                                              <td>
                                                  <select class="form-control " name="pregunta6" id="pregunta6">
                                                      <option selected><?php echo $fila4['pregunta6']?></option>
                                                      <option value="NO">NO</option>
                                                      <option value="SI">SI</option>
                                                  </select>
                                              </td>
                                      </tr>
                                      <tr>
                                          <th scope="row">7</th>
                                              <td>
                                                  <label>Estar inscrito en la relacion de proveedores sancionados por el tribunal de contrataciones del estado de sancion vigente:</label>
                                              </td>
                                              <td>
                                                  <select class="form-control " name="pregunta7" id="pregunta7">
                                                        <option selected><?php echo $fila4['pregunta7']?></option>
                                                        <option value="NO">NO</option>
                                                        <option value="SI">SI</option>
                                                  </select>
                                              </td>
                                      </tr>
                                      <tr>
                                          <th scope="row">8</th>
                                              <td>
                                                  <label>Estar inscrito en el registro de deudores de reparaciones civiles (REDERECI) y por lo tanto no contar con ninguno de los impedimentos establecidos en le articulo 5 de la Ley 30353 (Ley que crea el REDERECI) para acceder el ejercicio de la función pública y contratacion del estado:</label>
                                              </td>
                                              <td>
                                                  <select class="form-control " name="pregunta8" id="pregunta8">
                                                          <option selected><?php echo $fila4['pregunta8']?></option>
                                                          <option value="NO">NO</option>
                                                          <option value="SI">SI</option>
                                                  </select>
                                              </td>
                                      </tr>
                                      <tr>
                                          <th scope="row">9</th>
                                              <td>
                                                  <label>Estar inscrito en la relacion de proveedores sancionados por el tribunal de contrataciones del estado de sancion vigente:</label>
                                              </td>
                                              <td>
                                                  <select class="form-control " name="pregunta9" id="pregunta9">
                                                            <option selected><?php echo $fila4['pregunta9']?></option>
                                                            <option value="NO">NO</option>
                                                            <option value="SI">SI</option>
                                                  </select>
                                              </td>
                                      </tr>
                                      <tr>
                                          <th scope="row">10</th>
                                              <td>
                                                  <label>Tener impedimento, icompatibilidad o estar incurso en alguna prohibición o restricción para ser postor o contratista y/o para postular, acceder o ejercer el servicio, función o cargo convocado por el MVCS:</label>
                                              </td>
                                              <td>
                                                  <select class="form-control " name="pregunta10" id="pregunta10">
                                                              <option selected><?php echo $fila4['pregunta10']?></option>
                                                              <option value="NO">NO</option>
                                                              <option value="SI">SI</option>
                                                  </select>
                                              </td>
                                      </tr>

                                      <tr>
                                          <th scope="row">11</th>
                                              <td>
                                                  <label>Ser conyugue conviviente o pariente hasta el segundo grado de consanguinidad o afinidad de las personas señaladas en los literales a) AL g) del articulo 11 del texto unico ordenado de la Ley de contrataciones del estado:</label>
                                              </td>
                                              <td>
                                                  <select class="form-control " name="pregunta11" id="pregunta11">
                                                              <option selected><?php echo $fila4['pregunta11']?></option>
                                                              <option value="NO">NO</option>
                                                              <option value="SI">SI</option>
                                                  </select>
                                              </td>
                                      </tr>
                                      <tr>
                                          <th scope="row">12</th>
                                              <td>
                                                  <label>Percibir simultaneamente remuneración, pensión y honorarios por concepto de locación de servicios asesorias o consultorias
                                                  o cualquier otra doble percepción o ingreso del estado, salvo por el ejercicio de la función docente efectiva y la percepción 
                                                  de dietas por participación en uno de los directorios de entidades o empresas estatales o en tribunales administrativos o en 
                                                  otros órganos colegiados:</label>
                                              </td>
                                              <td>
                                                  <select class="form-control " name="pregunta12" id="pregunta12">
                                                              <option selected><?php echo $fila4['pregunta12']?></option>
                                                              <option value="NO">NO</option>
                                                              <option value="SI">SI</option>
                                                  </select>
                                              </td>
                                      </tr>
                                      <tr>
                                          <th scope="row">13</th>
                                              <td>
                                                  <label>Percibir simultaneamente remuneración, pensión y honorarios por concepto de locación de servicios asesorias o consultorias
                                                  o cualquier otra doble percepción o ingreso del estado, salvo por el ejercicio de la función docente efectiva y la percepción 
                                                  de dietas por participación en uno de los directorios de entidades o empresas estatales o en tribunales administrativos o en 
                                                  otros órganos colegiados:</label>
                                              </td>
                                              <td>
                                                  <select class="form-control " name="pregunta13" id="pregunta13">
                                                  <option selected><?php echo $fila4['pregunta13']?></option>
                                                  <option value="NO">NO</option>
                                                  <option value="SI">SI</option>
                                                  </select>
                                              </td>
                                      </tr>

                                      <tr>
                                        <th scope="row">14</th>
                                            <td>
                                                <label>Sentencia Condenatoria por delito doloso</label>
                                            </td>
                                            <td>
                                                <select class="form-control " name="pregunta14" id="pregunta14">
                                                            <option selected><?php echo $fila4['pregunta14']?></option>
                                                            <option value="NO">NO</option>
                                                            <option value="SI">SI</option>
                                                </select>
                                            </td>
                                      </tr>

                                  </tbody>
                              </table>
                              <input type="submit" name="insertar" class="next action-button" value="Siguiente" /> 
                              <input type="button" name="previous" class="previous action-button-previous" value="Atrás"/>   
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
                      <input type="submit" name="next" class="next action-button" value="Actualizar" />
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

  <script>
    $(function() {
      $("#inputSelect").on('change', function() {
        var selectValue = $(this).val();
        switch (selectValue) {
          case "AFP":
            $("#AFP").show();
            $("#AFP-2").show();
            $("#NINGUNO ").hide();
            break;

          case "NINGUNA":
            $("#NINGUNA").show();
            $("#AFP").hide();
            $("#AFP-2").hide();
            break;
        }
      }).change();
      $("#pertenecer_pension").on('change', function() {
        var selectValue = $(this).val();
        switch (selectValue) {
          case "AFP":
            $("#opcion-AFP").show();
            break;

          case "ONP":
            $("#opcion-AFP").hide();
            break;
        }
      }).change();
    });
  </script>

</body>

</html>