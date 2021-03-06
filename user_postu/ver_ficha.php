<?php
include 'conexion.php';
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
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link href="css/estilos.css" rel="stylesheet">

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php
    include '../funcs/mcript.php';
    $dni = $_GET['dni'];
    $dato_desencriptado = SED::decryption($dni);

    include_once('conexion.php');
    $sql = "SELECT * FROM usuarios where dni=$dato_desencriptado";
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
              <div class="card border-primary mb-3 font-weight-bold" style="color:#000;">
                <div class="card-header header-formulario">
                  <h4 style="color:#fff">FICHA ÚNICA DE DATOS</h4>
                </div>

                <?php
                $sql = "SELECT * FROM postulante where dni=$dato_desencriptado";
                $datos = mysqli_query($con, $sql) or die(mysqli_error($datos));
                $fila = mysqli_fetch_array($datos);
                $idpostulante = $fila['idpostulante'];
                ?>
                <a href="reporteficha.php?idpostulante=<?php echo $idpostulante ?>&dni=<?php echo $dni ?>"><button type="button" class="btn btn-primary m-3"><i class="fa fa-book"></i>Generar ficha en PDF</button></a>
                <div class="card-body">
                  <?php

                  $sql = "SELECT * FROM postulante where dni=$dato_desencriptado";
                  $datos = mysqli_query($con, $sql) or die(mysqli_error($datos));
                  $fila = mysqli_fetch_array($datos);
                  $idpostulante = $fila['idpostulante'];
                  // $distrito=$fila['distrito_iddistrito'];

                  $sql2 = "SELECT * FROM domicilio_post where postulante_idpostulante=$idpostulante";
                  $datos2 = mysqli_query($con, $sql2) or die(mysqli_error($datos));;
                  $fila2 = mysqli_fetch_array($datos2);
                  $distrito = $fila2['distrito_idistrito'];

                  ?>

                  <h5 class="text-left font-weight-bold"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> DATOS PERSONALES:</h5>
                  <div class="form-group row">
                    <label class="col-md-2 col-form-label col-form-label-sm">Apellidos y Nombres:</label>
                    <div class="col-md-4">
                      <input class="form-control col-form-label-sm" type="text" value="<?php echo $fila['ape_pat'] . " " . $fila['ape_mat'] . " " . $fila['nombres']; ?>" disabled="true" />
                    </div>
                    <label class="col-md-1 col-form-label col-form-label-sm">DNI N°</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila['dni'] ?>" disabled="true">
                    </div>
                    <label class="col-md-1 col-form-label col-form-label-sm">Pais</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila['pais'] ?>" disabled="true">
                    </div>

                  </div>
                  <div class="form-group row">
                    <label class="col-md-2 col-form-label col-form-label-sm ">RUC N°</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila['ruc'] ?>" disabled="true">
                    </div>
                    <label class="col-md-2 col-form-label col-form-label-sm">Fecha de Nacimiento:</label>
                    <div class="col-md-2">
                      <input class="form-control form-control-user" value="<?php echo $fila['fech_nac'] ?>" disabled />
                    </div>
                    <label class="col-md-2 col-form-label col-form-label-sm">Teléfono Móvil:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila['celular'] ?>" disabled="true">
                    </div>
                  </div>
                  <?php
                  $total = "SELECT * FROM total_lugar WHERE iddistrito=$distrito";
                  $respuesta = mysqli_query($con, $total) or die(mysqli_error($respuesta));
                  $row2 = mysqli_fetch_array($respuesta);

                  ?>
                  <div class="form-group row">
                    <label class="col-md-2 col-form-label col-form-label-sm">Correo electrónico</label>
                    <div class="col-md-3">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila['correo'] ?>" disabled="true">
                    </div>
                    <label class="col-md-2 col-form-label col-form-label-sm">Grupo Sanguíneo:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila['tipo_sangre'] ?>" disabled="true">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-2 col-form-label col-form-label-sm">Régimen pensionario:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila['seguro'] ?>" disabled="true">
                    </div>
                    <label class="col-md-2 col-form-label col-form-label-sm">Nombre de la AFP:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila['nombre_afp'] ?>" disabled="true">
                    </div>
                    <label class="col-md-2 col-form-label col-form-label-sm">Código CUSSP:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila['codigo_cussp'] ?>" disabled="true">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label col-form-label-sm">Suspensión de renta 4ta. categoría:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila['suspension_cuarta'] ?>" disabled="true">
                    </div>
                  </div>
                  <h6 class="text-left" style="color:#d52a1a;">En caso de emergencia llamar a:</h6>
                  <div class="form-group row">
                    <label class="col-md-2 col-form-label col-form-label-sm">Parentesco:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila['parentesco_emer'] ?>" disabled="true">
                    </div>
                    <label class="col-md-3 col-form-label col-form-label-sm">Teléfono de contacto de emergencia:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila['celular_emer'] ?>" disabled="true">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-2 col-form-label col-form-label-sm">Estado Civil:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila['estado_civil'] ?>" disabled="true">
                    </div>
                    <label class="col-md-2 col-form-label col-form-label-sm">Discapacidad:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila['discapacidad'] ?>" disabled="true">
                    </div>
                    <label class="col-md-2 col-form-label col-form-label-sm">Tipo de discapacidad:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila['tipo_discap'] ?>" disabled="true">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-2 col-form-label col-form-label-sm">Servicio militar (Completo):</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila['servicio_militar'] ?>" disabled="true">
                    </div>
                    <label class="col-md-2 col-form-label col-form-label-sm">Deportista calificado:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila['deportista_calificado'] ?>" disabled="true">
                    </div>
                  </div>
                  <?php
                  $sql2 = "SELECT * FROM domicilio_post where postulante_idpostulante=$idpostulante";
                  $datos2 = mysqli_query($con, $sql2) or die(mysqli_error($datos2));;
                  $fila2 = mysqli_fetch_array($datos2);

                  ?>
                  <h5 class="text-left font-weight-bold"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> DOMICILIO:</h5>
                  <div class="form-group row">
                    <label class="col-md-2 col-form-label col-form-label-sm">Tipo de Vía:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila2['tip_via'] ?>" disabled="true">
                    </div>
                    <label class="col-md-2 col-form-label col-form-label-sm">Nombre de la vía:</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila2['nomb_via'] ?>" disabled="true">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-2 col-form-label col-form-label-sm">Tipo de Zona:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila2['tip_zona'] ?>" disabled="true">
                    </div>
                    <label class="col-md-2 col-form-label col-form-label-sm">Nombre de la zona:</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila2['nomb_zona'] ?>" disabled="true">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-2 col-form-label col-form-label-sm">(#) Numero:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila2['numero'] ?>" disabled="true">
                    </div>
                    <label class="col-md-2 col-form-label col-form-label-sm">Mz.:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila2['manzana'] ?>" disabled="true">
                    </div>
                    <label class="col-md-2 col-form-label col-form-label-sm">Lt.:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila2['lote'] ?>" disabled="true">
                    </div>
                  </div>
                  <h6 class="text-left" style="color:#d52a1a;">Ubicación Geográfica:</h6>
                  <div class="form-group row">
                    <label class="col-md-2 col-form-label col-form-label-sm">Departamento:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $row2['departamento'] ?>" disabled="true">
                    </div>
                    <label class="col-md-2 col-form-label col-form-label-sm">Provincia:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $row2['provincia'] ?>" disabled="true">
                    </div>
                    <label class="col-md-2 col-form-label col-form-label-sm">Distrito:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $row2['distrito'] ?>" disabled="true">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-2 col-form-label col-form-label-sm">Referencia:</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila2['referencia'] ?>" disabled="true">
                    </div>
                  </div>
                  <h5 class="text-left font-weight-bold"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> DATOS FAMILIARES:</h5>
                  <div class="form-group row">
                    <div class="col-md-12 col-sm-12 form-group">
                      <?php
                      $consulta = "SELECT * FROM familia_post WHERE postulante_idpostulante = $idpostulante";
                      $procesar = mysqli_query($con, $consulta);
                      $fila3 = MySQLI_fetch_array($procesar);
                      $familiar_trabajando = $fila3['familiar_trabajando'];
                      ?>
                      <label class="font-weight-bolder">¿Tiene familiares que laboran en la institución?</label>
                      <select class="form-control" name="familiares_lab" id="familiares_lab">
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row" id="div_tabla_familia">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                            <th>Apellidos y Nombres</th>
                            <th>DNI</th>
                            <th>Parentesco</th>
                            <th>Cargo</th>
                            <th>Dirección/Oficina</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql2 = "SELECT * FROM familia_post WHERE postulante_idpostulante = $idpostulante";
                          $query2 = mysqli_query($con, $sql2);
                          if (mysqli_num_rows($query2) > 0) {
                            while ($row2 = MySQLI_fetch_array($query2)) {
                          ?>
                              <tr>
                                <td style="font-size: 14px;"><?php echo $row2['apellidos'] . " " . $row2['nombre']; ?></td>
                                <td style="font-size: 14px;"><?php echo $row2['dni'] ?></td>
                                <td style="font-size: 14px;"><?php echo $row2['parentesco'] ?></td>
                                <td style="font-size: 14px;"><?php echo $row2['cargo'] ?></td>
                                <td style="font-size: 14px;"><?php echo $row2['area'] ?></td>
                              </tr>
                          <?php

                            }
                          } else {
                            echo "<tr><td colspan='5' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td></tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <?php
                  $sql5 = "SELECT * FROM datos_profesionales where postulante_idpostulante=$idpostulante";
                  $datos5 = mysqli_query($con, $sql5) or die(mysqli_error($datos5));;
                  $fila5 = mysqli_fetch_array($datos5);
                  ?>

                  <h5 class="text-left font-weight-bold"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> DATOS PROFESIONALES:</h5>
                  <div class="form-group row">
                    <label class="col-md-2 col-form-label col-form-label-sm">Profesion:</label>
                    <div class="col-md-4">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila5['profesion'] ?>" disabled="true">
                    </div>
                    <label class="col-md-2 col-form-label col-form-label-sm">Lugar colegiatura:</label>
                    <div class="col-md-4">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila5['lugar_cole'] ?>" disabled="true">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-2 col-form-label col-form-label-sm">Fecha de colegiatura:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila5['fecha_cole'] ?>" disabled="true">
                    </div>
                    <label class="col-md-2 col-form-label col-form-label-sm">Fecha hasta la cual se encuentra habilitado:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila5['fecha_habi'] ?>" disabled="true">
                    </div>
                    <label class="col-md-2 col-form-label col-form-label-sm">N° colegiatura:</label>
                    <div class="col-md-2">
                      <input type="text" class="form-control col-form-label-sm" value="<?php echo $fila5['nro_cole'] ?>" disabled="true">
                    </div>
                  </div>
                  <h6 class="text-left" style="color:#d52a1a;">Estudios Superiores (Universitario - Técnico):</h6>
                  <div class="form-group row">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                            <th>Centro de estudios</th>
                            <th>Especialidad</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha término</th>
                            <th>Nivel alcanzado</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

                          $sql3 = "SELECT * FROM estudios_superiores WHERE idpostulante_postulante = $idpostulante";
                          $query3 = mysqli_query($con, $sql3);
                          if (mysqli_num_rows($query3) > 0) {
                            while ($row3 = MySQLI_fetch_array($query3)) {
                          ?>
                              <tr>
                                <td style="font-size: 14px;"><?php echo $row3['centro_estu']; ?></td>
                                <td style="font-size: 14px;"><?php echo $row3['especialidad']; ?></td>
                                <td style="font-size: 14px;"><?php echo $row3['fech_ini'] ?></td>
                                <td style="font-size: 14px;"><?php echo $row3['fech_fin'] ?></td>
                                <td style="font-size: 14px;"><?php echo $row3['nivel'] ?></td>
                              </tr>
                          <?php
                            }
                          } else {
                            echo "<tr><td colspan='5' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td></tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <h6 class="text-left" style="color:#d52a1a;">Estudios Postgrado (Maestría - Doctorado):</h6>
                  <div class="form-group row">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                            <th>Centro de estudios</th>
                            <th>Especialidad</th>
                            <th>Tipo Estudios</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha término</th>
                            <th>Nivel alcanzado</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql4 = "SELECT * FROM maestria_doc WHERE idpostulante_postulante = $idpostulante";
                          $query4 = mysqli_query($con, $sql4);
                          if (mysqli_num_rows($query4) > 0) {
                            while ($row4 = MySQLI_fetch_array($query4)) {
                          ?>
                              <tr>
                                <td style="font-size: 14px;"><?php echo $row4['centro_estu']; ?></td>
                                <td style="font-size: 14px;"><?php echo $row4['especialidad']; ?></td>
                                <td style="font-size: 14px;"><?php echo $row4['tipo_estu']; ?></td>
                                <td style="font-size: 14px;"><?php echo $row4['fech_ini'] ?></td>
                                <td style="font-size: 14px;"><?php echo $row4['fech_fin'] ?></td>
                                <td style="font-size: 14px;"><?php echo $row4['nivel'] ?></td>
                              </tr>
                          <?php
                            }
                          } else {
                            echo "<tr><td colspan='6' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td></tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <h6 class="text-left" style="color:#d52a1a;">Especilización - Diplomados - Cursos:</h6>
                  <div class="form-group row">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                            <th>Centro de estudios</th>
                            <th>Especialidad</th>
                            <th>Horas</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha término</th>
                            <th>Tipo</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql5 = "SELECT * FROM cursos_extra WHERE curso_extra_idpostulante = $idpostulante";
                          $query5 = mysqli_query($con, $sql5);
                          if (mysqli_num_rows($query5) > 0) {
                            while ($row5 = MySQLI_fetch_array($query5)) {
                          ?>
                              <tr>
                                <td style="font-size: 14px;"><?php echo $row5['centro_estu']; ?></td>
                                <td style="font-size: 14px;"><?php echo $row5['materia']; ?></td>
                                <td style="font-size: 14px;"><?php echo $row5['horas']; ?></td>
                                <td style="font-size: 14px;"><?php echo $row5['fech_ini'] ?></td>
                                <td style="font-size: 14px;"><?php echo $row5['fech_fin'] ?></td>
                                <td style="font-size: 14px;"><?php echo $row5['tipo'] ?></td>
                              </tr>
                          <?php
                            }
                          } else {
                            echo "<tr><td colspan='7' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td></tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <h6 class="text-left" style="color:#d52a1a;">Idiomas - Cómputo:</h6>
                  <div class="form-group row d-flex justify-content-center">
                    <div class="col-6 ">
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <thead>
                            <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                              <th>Idioma - Cómputo</th>
                              <th>Nivel</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql4 = "SELECT * FROM idiomas_comp WHERE idpostulante_postulante = $idpostulante";
                            $query4 = mysqli_query($con, $sql4);
                            if (mysqli_num_rows($query4) > 0) {
                              while ($row4 = MySQLI_fetch_array($query4)) {
                            ?>
                                <tr>
                                  <td style="font-size: 14px;"><?php echo $row4['idioma_comp']; ?></td>
                                  <td style="font-size: 14px;"><?php echo $row4['nivel']; ?></td>
                                </tr>
                            <?php
                              }
                            } else {
                              echo "<tr>
                                            <td colspan='2' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td>
                                            </tr>";
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <h6 class="text-left" style="color:#d52a1a;">Experiencia laboral:</h6>
                  <div class="form-group row">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                            <th>Institución/Empresa</th>
                            <th>Cargo</th>
                            <th>Fecha inicio</th>
                            <th>Fecha termino</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql5 = "SELECT * FROM expe_4puntos INNER JOIN lugar_trabajo_gene ON expe_4puntos.lugar_trab_general = lugar_trabajo_gene.idlugar_trabajo_gene WHERE expe_puntos_idpostulante = '$idpostulante'";
                          $query5 = mysqli_query($con, $sql5);
                          if (mysqli_num_rows($query5) > 0) {
                            while ($row5 = MySQLI_fetch_array($query5)) {
                          ?>
                              <tr>
                                <td style="font-size: 14px;"><?php echo $row5['nombre_general']; ?></td>
                                <td style="font-size: 14px;"><?php echo $row5['cargo']; ?></td>
                                <td style="font-size: 14px;"><?php echo $row5['fecha_inicio']; ?></td>
                                <td style="font-size: 14px;"><?php echo $row5['fecha_fin']; ?></td>
                              </tr>
                          <?php
                            }
                          } else {
                            echo "<tr><td colspan='4' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td></tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
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
  <script>
    $(document).ready(function() {
      $('#familiares_lab > option[value="<?php echo $familiar_trabajando ?>"]').attr('selected', 'selected');
    });
  </script>

</body>

</html>