<?php
include 'conexion.php';
include "funcs/mcript.php";
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
    $dni = $_GET['dni'];
    $dato_desencriptado = $_GET['dni'];
    // $dni = $desencriptar($dato_desencriptado);

    $sql = "SELECT * FROM usuarios where dni=$dni";
    $datos = mysqli_query($con, $sql) or die(mysqli_error($datos));
    $buscar = mysqli_fetch_array($datos);
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
                  $sql = "SELECT * FROM convocatoria where idcon=$idcon";
                  $datos = mysqli_query($con, $sql);
                  $fila = mysqli_fetch_array($datos);

                  $datos_2 = mysqli_query($con, "SELECT * FROM convocatoria INNER JOIN ubicacion
                    ON convocatoria.direccion_ejec_iddireccion = ubicacion.iddireccion WHERE idcon=$idcon");
                  $fila_2 = mysqli_fetch_array($datos_2);
                  ?>
                  <div class="form-group">
                    <h6 class="m-0 font-weight-bold text-danger">Datos de la convocatoria</h6>
                    <hr class="sidebar-divider">
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-3 col-sm-12">
                      <label for="inputEmail4">N° de convocatoria</label>
                      <input type="text" class="form-control" value="<?php echo $fila['num_con'] . "-" . $fila['anio_con'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-3 col-sm-12">
                      <label for="inputEmail4">Tipo de convocatoria</label>
                      <input type="text" class="form-control" value="<?php echo $fila['tipo_con'] ?>" disabled="true">
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
                      <table class="table table-bordered">
                        <tbody>
                          <?php
                          $consulta_form = "SELECT * FROM personal_req INNER JOIN cargo_full ON personal_req.cargo_idcargo = cargo_full.idcargo WHERE convocatoria_idcon = $idcon";
                          $query = mysqli_query($con, $consulta_form);

                          if (mysqli_num_rows($query) > 0) {
                            $i = 1;
                            while ($row = MySQLI_fetch_array($query)) {
                              $idpersonal = $row['idpersonal'];
                          ?>
                              <thead>
                                <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                                  <th style="display:none;">id</th>
                                  <th>N°</th>
                                  <th>Cargo</th>
                                  <th>Cantidad</th>
                                  <th>Remuneración</th>
                                  <th>Fuente Financiamiento</th>
                                  <th>Meta</th>

                                  <th>Acciones</th>
                                </tr>
                              </thead>
                              <tr style="text-align:center;">
                                <td style=" font-size: 12px; display:none;"><?php echo $idpersonal ?></td>
                                <td style="font-size: 12px;"><?php echo $i ?></td>
                                <td style="font-size: 12px;"><?php echo $row['cargo'] ?></td>
                                <td style="font-size: 12px;"><?php echo $row['cantidad'] ?></td>
                                <td style="font-size: 12px;"><?php echo $row['remuneracion'] ?></td>
                                <td style="font-size: 12px;"><?php echo $row['fuente_finac'] ?></td>
                                <td style="font-size: 12px;"><?php echo $row['meta'] ?></td>

                                <td class="d-flex justify-content-center">
                                  <a type="button" href="editar_personal_especifico.php?idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" class="btn btn-success btn-sm m-1">
                                    <i class="fa fa-edit"></i> Editar</a>
                                  <button type="button" class="btn btn-danger btn-sm m-1 deleteBtn"> <i class="fas fa-trash-alt"></i></button>
                                </td>
                              </tr>
                              <?php
                              $select = "SELECT * FROM sistema_seleccion.requerimientos INNER JOIN sistema_seleccion.tipo_estudios
                              ON requerimientos.reque_tipo_estudios=tipo_estudios.id_tipo_estudios  WHERE reque_id_personal ='$idpersonal' ";
                              $consulta = mysqli_query($con, $select);
                              $num_fil_req = mysqli_num_rows($consulta);
                              if ($num_fil_req > 0) {
                              ?>
                                <thead>
                                  <tr class="bg-secondary" style="text-align:center; color:#000; font-size:0.813em;">
                                    <th style="display:none;">id</th>
                                    <th></th>
                                    <th>Tipo de estudios</th>
                                    <th>Nivel de estudios</th>
                                    <th>Tipo experiencia</th>
                                    <th>Cantidad exp.</th>
                                    <th>Acciones</th>
                                  </tr>
                                </thead>
                                <?php
                                $ii = 1;

                                while ($row = mysqli_fetch_array($consulta)) {
                                ?>
                                  <tr>
                                    <td style="font-size: 12px; display: none;"><?php echo $row['id_requerimientos'] ?></td>
                                    <td style="font-size: 12px;"><?php //echo $ii 
                                                                  ?></td>
                                    <td style="font-size: 12px;"><?php echo $row['tipo_estudios'] ?></td>
                                    <td style="font-size: 12px;"><?php echo $row['nivel_estudio'] ?></td>
                                    <td style="font-size: 12px;"><?php echo $row['tipo_experiencia'] ?></td>
                                    <td style="font-size: 12px;"><?php echo $row['cantidad_experiencia'] ?></td>
                                    <td class="d-flex justify-content-center">
                                      <a type="button" href="editarformacion.php?idformacion=<?php echo $row['id_requerimientos'] ?>&dni=<?php echo $dato_desencriptado ?>" class="btn btn-success btn-sm m-1">
                                        <i class="fa fa-edit"></i> Editar</a>
                                      <button type="button" class="btn btn-danger btn-sm m-1 deleteReque"> <i class="fas fa-trash-alt"></i></button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="font-size: 12px; display: none;"><?php echo $row['id_requerimientos'] ?></td>
                                    <td style="font-size: 12px;"></td>
                                    <td style="font-size: 12px;"><?php echo $row['tipo_estudios'] ?></td>
                                    <td style="font-size: 12px;"><?php echo $row['nivel_estudio_max'] ?></td>
                                    <td style="font-size: 12px;"><?php echo $row['tipo_experiencia'] ?></td>
                                    <td style="font-size: 12px;"><?php echo $row['cantidad_experiencia'] ?></td>

                                  </tr>
                              <?php
                                  $ii++;
                                }
                              } else {
                                echo "<tr><td colspan='7' class='text-center text-danger font-weight-bold' >NO HAY REQUERIMIENTOS AGREGADOS PARA ESTE PERSONAL REQUERIDO</td></tr>";
                              }
                              ?>

                          <?php
                              $i++;
                            }
                          } else {
                            echo "<tr><td colspan='7' class='text-center text-danger font-weight-bold' >NO HAY DATOS REGISTRADOS</td></tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </form>
                </div>
                <div class="card-footer d-flex justify-content-end">
                  <a href="agregar_comision.php?convocatoria_idcon=<?php echo $idcon ?>&dni=<?php echo $dato_desencriptado ?>" type="button" class="btn btn-primary">Siguiente <i class="fas fa-arrow-circle-right"></i></a>
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
          <form action="procesos/guardar_personal_req_v2.php" autocomplete="off" method="POST">
            <div class="row">
              <!-- <div class="form-group font-weight-bolder">
                <p class="text-danger">(*) Indica un campo obligatorio.</p>
              </div> -->
              <div class="col-md-12">
                <h6 class="m-0 font-weight-bold text-danger">Datos del personal requeridos</h6>
                <hr class="sidebar-divider">
              </div>
              <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="idconvocatoria" value="<?php echo $idcon ?>">
              <div class="col-md-3 col-sm-12 form-group">
                <label for="title">Cantidad requerida</label>
                <input style="font-size:13px;" type="number" name="cantidad" class="form-control name_list" required />
              </div>
              <div class="col-md-3 col-sm-12 form-group">
                <label for="title">(*) Cargo</label>
                <select style="font-size:12px;" name="cargo" class="form-control" required>
                  <option value="" disabled selected>Elegir</option>
                  <?php
                  include_once('conexion.php');
                  $sql = mysqli_query($con, "SELECT * from cargo") or die("Problemas en consulta") . mysqli_error($sql);
                  while ($registro = mysqli_fetch_array($sql)) {
                    echo "<option value=\"" . $registro['idcargo'] . "\">" . $registro['cargo'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-3 col-sm-12 form-group">
                <label for="title">(*) Remuneración</label>
                <input style="font-size:13px;" type="text" name="remuneracion" placeholder="Ejemplo: 2000" class="form-control name_list" required />
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
                  $sql = "SELECT * FROM ubicacion";
                  $res = mysqli_query($con, $sql) or die("Problemas en consulta") . mysqli_error($res);
                  while ($rw = mysqli_fetch_array($res)) {
                    echo "<option value=" . $rw["iddireccion"] . ">" . $rw["direccion_ejec"] . " - " . $rw["equipo_ejec"] . "</option> ";
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-12">
                <h6 class="m-0 font-weight-bold text-danger">Elegir los requerimientos básicos</h6>
                <hr class="sidebar-divider">
              </div>
              <div class="col-md-12 form-group">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Definir la formación académica MÍNIMA aceptada:</h6>
              </div>
              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">(*) Formación Academica</label>
                <select name="formacion_requerida" class="form-control" onChange="tipo_estudios_select(this)" required>
                  <option value="0">Seleccione:</option>
                  <?php
                  $query = $con->query("SELECT * FROM tipo_estudios");
                  while ($valores = mysqli_fetch_array($query)) {
                    echo '<option value="' . $valores['id_tipo_estudios'] . '">' . $valores['tipo_estudios'] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_nivel_estudio_tecnico">
                <label for="title">(*) Nivel estudios técnico</label>
                <select name="nivel_estudios_tec" class="form-control">
                  <option value="TITULADO">Titulado</option>
                  <option value="EGRESADO">Egresado</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_nivel_estudio_prof">
                <label for="title">(*) Nivel estudios profesional</label>
                <select name="nivel_estudios_prof" onChange="tipo_nivel_estudio_select(this)" class="form-control">
                  <option value="">Elegir...</option>
                  <option value="ESTUDIANTE">Estudiante</option>
                  <option value="EGRESADO">Egresado</option>
                  <option value="BACHILLER">Bachiller</option>
                  <option value="TITULADO">Titulado</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_ciclo_actual">
                <label for="title">(*) Ciclo mínimo requerido</label>
                <select name="ciclo_actual" class="form-control">
                  <option value="NINGUNO">Elegir</option>
                  <option value="VIII">VIII</option>
                  <option value="IX">IX</option>
                  <option value="X">X</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_colegiatura">
                <label for="title">(*) Colegiatura </label>
                <select name="colegiatura" class="form-control">
                  <option value="NO">NO</option>
                  <option value="SI">SI</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_habilitacion">
                <label for="title">(*) Habilitación Profesional</label>
                <select name="habilitacion" class="form-control">
                  <option value="NO">NO</option>
                  <option value="SI">SI</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_serums">
                <label for="title">(*) SERUMS </label>
                <select name="serums" class="form-control">
                  <option value="NO">NO</option>
                  <option value="SI">SI</option>
                </select>
              </div>
              <div class="col-md-12">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Definir la formación académica MÁXIMA aceptada</h6>
              </div>
              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">(*) Formación Academica</label>
                <select name="formacion_requerida_max" class="form-control" onChange="tipo_estudios_select_max(this)" required>
                  <option value="0">Seleccione:</option>
                  <?php
                  $query = $con->query("SELECT * FROM tipo_estudios");
                  while ($valores = mysqli_fetch_array($query)) {
                    echo '<option value="' . $valores['id_tipo_estudios'] . '">' . $valores['tipo_estudios'] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_nivel_estudio_tecnico_max">
                <label for="title">(*) Nivel estudios</label>
                <select name="nivel_estudios_tec_max" class="form-control">
                  <option value="TITULADO">Titulado</option>
                  <option value="EGRESADO">Egresado</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_nivel_estudio_prof_max">
                <label for="title">(*) Nivel estudios</label>
                <select name="nivel_estudios_prof_max" onChange="tipo_nivel_estudio_select_max(this)" class="form-control">
                  <option value="">Elegir...</option>
                  <option value="ESTUDIANTE">Estudiante</option>
                  <option value="EGRESADO">Egresado</option>
                  <option value="BACHILLER">Bachiller</option>
                  <option value="TITULADO">Titulado</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_ciclo_actual_max">
                <label for="title">(*) Ciclo mínimo requerido</label>
                <select name="ciclo_actual_max" class="form-control">
                  <option value="NINGUNO">Elegir...</option>
                  <option value="VIII">VIII</option>
                  <option value="IX">IX</option>
                  <option value="X">X</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_colegiatura_max">
                <label for="title">(*) Colegiatura</label>
                <select name="colegiatura_max" class="form-control">
                  <option value="NO">NO</option>
                  <option value="SI">SI</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_habilitacion_max">
                <label for="title">(*) Habilitación Profesional</label>
                <select name="habilitacion_max" class="form-control">
                  <option value="NO">NO</option>
                  <option value="SI">SI</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_serums_max">
                <label for="title">(*) SERUMS </label>
                <select name="serums_max" class="form-control">
                  <option value="NO">NO</option>
                  <option value="SI">SI</option>
                </select>
              </div>
              <div class="col-md-12">
                <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Definir la experiencia laboral MÍNIMA y otros.</h6>
              </div>
              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">(*) Experiencia laboral MÍNIMA</label>
                <select name="tipo_experiencia" class="form-control" onChange="tipo_experiencia_select(this)">
                  <option value="">Elegir...</option>
                  <option value="anios">AÑOS</option>
                  <option value="meses">MESES</option>
                  <option value="sin experiencia">SIN EXPERIENCIA</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_experiencia_meses">
                <label for="title">(*) Tiempo experiencia en MESES</label>
                <input type="number" name="cantidad_meses" class="form-control">
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_experiencia_años">
                <label for="title">(*) Tiempo experiencia en AÑOS</label>
                <input type="number" name="cantidad_anios" class="form-control">
              </div>
              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">(*) Licencia de conducir </label>
                <select name="licencia_conducir" id="licencia_conducir" class="form-control">
                  <option value="Ninguna">Ninguna</option>
                  <option value="A-IIb">A-IIb</option>
                  <option value="A-IIIa">A-IIIa</option>
                  <option value="A-IIIb">A-IIIb</option>
                  <option value="A-IIIc">A-IIIc</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" name="agregar_personal" class="btn btn-primary">Guardar</button>
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
          <h5 class="modal-title" id="exampleModalLabel">Eliminar registro de personal requerido</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="procesos/borrar_personal_req.php" method="POST">

          <div class="modal-body">
            <input type="hidden" name="deleteId" id="deleteId">
            <input type="hidden" name="idconvocatoria" value="<?php echo $idcon ?>">
            <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
            <h4>¿Desea eliminar el registro del personal requerido?</h4>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
            <button type="submit" class="btn btn-danger" name="deleteData">SI</button>
          </div>

        </form>
      </div>
    </div>
  </div>

  <!-- DELETE MODAL -->
  <div class="modal fade" id="deleteModalReq">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar requerimientos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="procesos/borrar_personal_req.php" method="POST">

          <div class="modal-body">

            <input type="hidden" name="deleteReq" id="deleteReq">
            <input type="hidden" name="idconvocatoria" value="<?php echo $idcon ?>">
            <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
            <h4>¿Desea eliminar el registro de formación?</h4>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
            <button type="submit" class="btn btn-danger" name="deleteReqe">SI</button>
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
    $(document).ready(function() {
      $('.deleteBtn').on('click', function() {

        $('#deleteModal').modal('show');

        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);

        $('#deleteId').val(data[0]);

      });
      $('.deleteReque').on('click', function() {

        $('#deleteModalReq').modal('show');

        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);

        $('#deleteReq').val(data[0]);

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
    div_experiencia_meses = document.getElementById("div_experiencia_meses");
    div_experiencia_meses.style.display = "none";
    div_experiencia_años = document.getElementById("div_experiencia_años");
    div_experiencia_años.style.display = "none";

    function tipo_experiencia_select(sel) {
      if (sel.value == "anios") {
        div_experiencia_meses = document.getElementById("div_experiencia_meses");
        div_experiencia_meses.style.display = "none";
        div_experiencia_años = document.getElementById("div_experiencia_años");
        div_experiencia_años.style.display = "block";
      } else if (sel.value == "meses") {
        div_experiencia_meses = document.getElementById("div_experiencia_meses");
        div_experiencia_meses.style.display = "block";
        div_experiencia_años = document.getElementById("div_experiencia_años");
        div_experiencia_años.style.display = "none";
      } else if (sel.value == "sin experiencia") {
        div_experiencia_meses = document.getElementById("div_experiencia_meses");
        div_experiencia_meses.style.display = "none";
        div_experiencia_años = document.getElementById("div_experiencia_años");
        div_experiencia_años.style.display = "none";

      }
    }
    //FORMACION MINIMA
    function tipo_estudios_select(sel) {
      if (sel.value == "1") {
        div_nivel_estudio_tecnico = document.getElementById("div_nivel_estudio_tecnico");
        div_nivel_estudio_tecnico.style.display = "none";
        div_nivel_estudio_prof = document.getElementById("div_nivel_estudio_prof");
        div_nivel_estudio_prof.style.display = "none";
        div_ciclo_actual = document.getElementById("div_ciclo_actual");
        div_ciclo_actual.style.display = "none";
        div_colegiatura = document.getElementById("div_colegiatura");
        div_colegiatura.style.display = "none";
        div_habilitacion = document.getElementById("div_habilitacion");
        div_habilitacion.style.display = "none";
        div_serums = document.getElementById("div_serums");
        div_serums.style.display = "none";
      } else if (sel.value == "2") {
        div_nivel_estudio_tecnico = document.getElementById("div_nivel_estudio_tecnico");
        div_nivel_estudio_tecnico.style.display = "block";
        div_nivel_estudio_prof = document.getElementById("div_nivel_estudio_prof");
        div_nivel_estudio_prof.style.display = "none";
        div_ciclo_actual = document.getElementById("div_ciclo_actual");
        div_ciclo_actual.style.display = "none";
        div_colegiatura = document.getElementById("div_colegiatura");
        div_colegiatura.style.display = "none";
        div_habilitacion = document.getElementById("div_habilitacion");
        div_habilitacion.style.display = "none";
        div_serums = document.getElementById("div_serums");
        div_serums.style.display = "none";
      } else if (sel.value == "3") {
        div_nivel_estudio_tecnico = document.getElementById("div_nivel_estudio_tecnico");
        div_nivel_estudio_tecnico.style.display = "none";
        div_nivel_estudio_prof = document.getElementById("div_nivel_estudio_prof");
        div_nivel_estudio_prof.style.display = "block";
        div_ciclo_actual = document.getElementById("div_ciclo_actual");
        div_ciclo_actual.style.display = "none";
        div_colegiatura = document.getElementById("div_colegiatura");
        div_colegiatura.style.display = "block";
        div_habilitacion = document.getElementById("div_habilitacion");
        div_habilitacion.style.display = "block";
        div_serums = document.getElementById("div_serums");
        div_serums.style.display = "block";
      }
    }

    function tipo_nivel_estudio_select(sel) {
      if (sel.value == "ESTUDIANTE") {
        div_ciclo_actual = document.getElementById("div_ciclo_actual");
        div_ciclo_actual.style.display = "block";
        div_colegiatura = document.getElementById("div_colegiatura");
        div_colegiatura.style.display = "none";
        div_habilitacion = document.getElementById("div_habilitacion");
        div_habilitacion.style.display = "none";
        div_serums = document.getElementById("div_serums");
        div_serums.style.display = "none";

      } else if (sel.value == "EGRESADO" || sel.value == "EGRESADO" || sel.value == "BACHILLER") {
        div_ciclo_actual = document.getElementById("div_ciclo_actual");
        div_ciclo_actual.style.display = "none";
        div_colegiatura = document.getElementById("div_colegiatura");
        div_colegiatura.style.display = "none";
        div_habilitacion = document.getElementById("div_habilitacion");
        div_habilitacion.style.display = "none";
        div_serums = document.getElementById("div_serums");
        div_serums.style.display = "none";
      } else if (sel.value == "TITULADO") {
        div_ciclo_actual = document.getElementById("div_ciclo_actual");
        div_ciclo_actual.style.display = "none";
        div_colegiatura.style.display = "block";
        div_habilitacion = document.getElementById("div_habilitacion");
        div_habilitacion.style.display = "block";
        div_serums = document.getElementById("div_serums");
        div_serums.style.display = "block";
      }
    }
    //FORMACION MAXIMA
    function tipo_estudios_select_max(sel) {
      if (sel.value == "1") {
        div_nivel_estudio_tecnico_max = document.getElementById("div_nivel_estudio_tecnico_max");
        div_nivel_estudio_tecnico_max.style.display = "none";
        div_nivel_estudio_prof_max = document.getElementById("div_nivel_estudio_prof_max");
        div_nivel_estudio_prof_max.style.display = "none";
        div_ciclo_actual_max = document.getElementById("div_ciclo_actual_max");
        div_ciclo_actual_max.style.display = "none";
        div_colegiatura_max = document.getElementById("div_colegiatura_max");
        div_colegiatura_max.style.display = "none";
        div_habilitacion_max = document.getElementById("div_habilitacion_max");
        div_habilitacion_max.style.display = "none";
        div_serums_max = document.getElementById("div_serums_max");
        div_serums_max.style.display = "none";
      } else if (sel.value == "2") {
        div_nivel_estudio_tecnico_max = document.getElementById("div_nivel_estudio_tecnico_max");
        div_nivel_estudio_tecnico_max.style.display = "block";
        div_nivel_estudio_prof_max = document.getElementById("div_nivel_estudio_prof_max");
        div_nivel_estudio_prof_max.style.display = "none";
        div_ciclo_actual_max = document.getElementById("div_ciclo_actual_max");
        div_ciclo_actual_max.style.display = "none";
        div_colegiatura_max = document.getElementById("div_colegiatura_max");
        div_colegiatura_max.style.display = "none";
        div_habilitacion_max = document.getElementById("div_habilitacion_max");
        div_habilitacion_max.style.display = "none";
        div_serums_max = document.getElementById("div_serums_max");
        div_serums_max.style.display = "none";
      } else if (sel.value == "3") {
        div_nivel_estudio_tecnico_max = document.getElementById("div_nivel_estudio_tecnico_max");
        div_nivel_estudio_tecnico_max.style.display = "none";
        div_nivel_estudio_prof_max = document.getElementById("div_nivel_estudio_prof_max");
        div_nivel_estudio_prof_max.style.display = "block";
        div_ciclo_actual_max = document.getElementById("div_ciclo_actual_max");
        div_ciclo_actual_max.style.display = "none";
        div_colegiatura_max = document.getElementById("div_colegiatura_max");
        div_colegiatura_max.style.display = "none";
        div_habilitacion_max = document.getElementById("div_habilitacion_max");
        div_habilitacion_max.style.display = "none";
        div_serums_max = document.getElementById("div_serums_max");
        div_serums_max.style.display = "none";
        div_colegiatura_max = document.getElementById("div_colegiatura_max");
        div_colegiatura_max.style.display = "block";
        div_habilitacion_max = document.getElementById("div_habilitacion_max");
        div_habilitacion_max.style.display = "block";
        div_serums_max = document.getElementById("div_serums_max");
        div_serums_max.style.display = "block";
      }
    }

    function tipo_nivel_estudio_select_max(sel) {
      if (sel.value == "ESTUDIANTE") {
        div_ciclo_actual_max = document.getElementById("div_ciclo_actual_max");
        div_ciclo_actual_max.style.display = "block";
        div_colegiatura_max = document.getElementById("div_colegiatura_max");
        div_colegiatura_max.style.display = "none";
        div_habilitacion_max = document.getElementById("div_habilitacion_max");
        div_habilitacion_max.style.display = "none";
        div_serums_max = document.getElementById("div_serums_max");
        div_serums_max.style.display = "none";

      } else if (sel.value == "EGRESADO" || sel.value == "EGRESADO" || sel.value == "BACHILLER") {
        div_ciclo_actual_max = document.getElementById("div_ciclo_actual_max");
        div_ciclo_actual_max.style.display = "none";
        div_colegiatura_max = document.getElementById("div_colegiatura_max");
        div_colegiatura_max.style.display = "none";
        div_habilitacion_max = document.getElementById("div_habilitacion_max");
        div_habilitacion_max.style.display = "none";
        div_serums_max = document.getElementById("div_serums_max");
        div_serums_max.style.display = "none";
      } else if (sel.value == "TITULADO") {
        div_ciclo_actual_max = document.getElementById("div_ciclo_actual_max");
        div_ciclo_actual_max.style.display = "none";
        div_colegiatura_max = document.getElementById("div_colegiatura_max");
        div_colegiatura_max.style.display = "block";
        div_habilitacion_max = document.getElementById("div_habilitacion_max");
        div_habilitacion_max.style.display = "block";
        div_serums_max = document.getElementById("div_serums_max");
        div_serums_max.style.display = "block";
      }
    }
  </script>

</body>

</html>