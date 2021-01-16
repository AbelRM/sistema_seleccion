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

  <title>EDITAR CONVOCATORIA CAS - SISTEMA SELECCION (DIRESA-TACNA)</title>

  <!-- Custom fonts for this template-->
  <link rel="icon" type="image/png" href="img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <style>
    #total {
      font-weight: bold;
    }

    .red {
      border-color: red;
    }

    .green {
      border-color: green;
    }
  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php
    $dni = $_GET['dni'];
    $dato_desencriptado = $_GET['dni'];
    // $dni = $desencriptar($dato_desencriptado);

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
        <?php include 'nav.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="row">

            <div class="col-lg-12">

              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">CONVOCATORIA CAS SELECCIONADA</h6>
                </div>
                <div class="card-body">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                        <div class="font-weight-bold">Datos convocatoria</div>
                      </a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                        <div class="font-weight-bold">Datos personal req.</div>
                      </a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a class="nav-link" id="comision-tab" data-toggle="tab" href="#comision" role="tab" aria-controls="comision" aria-selected="false">
                        <div class="font-weight-bold">Datos comisión</div>
                      </a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active m-2" id="home" role="tabpanel" aria-labelledby="home-tab">
                      <?php
                      $idcon = $_GET['idcon'];
                      $sql = "SELECT * FROM convocatoria WHERE idcon='" . $idcon . "' ";
                      $result = mysqli_query($con, $sql);
                      $fila = mysqli_fetch_array($result);
                      ?>
                      <form action="procesos/modificar_convoca.php" method="POST">
                        <div class="form-group">
                          <h6 class="m-0 font-weight-bold text-danger">Datos de la convocatoria CAS</h6>
                          <hr class="sidebar-divider">
                        </div>
                        <div class="form-row">
                          <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
                          <input type="hidden" name="idcon" value="<?php echo $idcon ?>">
                          <div class="form-group col-lg-2 col-md-4 col-sm-12">
                            <?php $tipo_convocatoria = $fila["tipo_con"]; ?>
                            <label for="inputState">Tipo de concurso</label>
                            <select name="tipo_con" id="tipo_con" class="form-control" required>
                              <option selected>Elegir...</option>
                              <option value="CAS-COVID">CAS-COVID</option>
                              <option value="CAS REGULAR">CAS REGULAR</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-2 col-md-4 col-sm-6">
                            <label for="inputEmail4">N° de convocatoria</label>
                            <input type="number" class="form-control" name="num_con" value="<?php echo $fila["num_con"] ?>" minlength="3" maxlength="3" placeholder="Ejm: 001" required>
                          </div>
                          <div class="form-group col-lg-2 col-md-4 col-sm-6">
                            <label for="anio_con">Año de convocatoria</label>
                            <input type="number" class="form-control" name="anio_con" value="<?php echo $fila["anio_con"] ?>" minlength="4" maxlength="4" placeholder="Ejm: 2020" required>
                          </div>
                          <div class="form-group col-lg-3 col-md-4 col-sm-6">
                            <label for="fech_ini">Fecha de inicio</label>
                            <input type="date" name="fech_ini" value="<?php echo $fila["fech_ini"] ?>" class="form-control" required>
                          </div>
                          <div class="form-group col-lg-3 col-md-4 col-sm-6">
                            <label for="fech_fin">Fecha de fin</label>
                            <input type="date" name="fech_fin" value="<?php echo $fila["fech_term"] ?>" class="form-control" required>
                          </div>
                          <input type="hidden" name="estado" value="ACTIVO">
                        </div>
                        <div class="form-group">
                          <h6 class="m-0 font-weight-bold text-danger">Porcentajes de la convocatoria</h6>
                          <hr class="sidebar-divider">
                        </div>
                        <div class="form-row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-6 col-form-label">% CURRICULAR:</label>
                              <div class="col-sm-2">
                                <input type="text" class="form-control sumar" name="curricular" value="<?php echo $fila["porcen_eva_cu"] ?>" required>
                              </div>
                              <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                            </div>
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-6 col-form-label">% ENTREVISTA:</label>
                              <div class="col-sm-2">
                                <input type="text" class="form-control sumar" name="entrevista" value="<?php echo $fila["porce_entrevista"] ?>" required>
                              </div>
                              <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                            </div>
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-6 col-form-label">% EXÁMEN ESCRITO:</label>
                              <div class="col-sm-2">
                                <input type="text" name="escrito" class="form-control sumar" value="<?php echo $fila["porce_exa_escrito"] ?>">
                              </div>
                              <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                            </div>
                            <hr class="sidebar-divider">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-6 col-form-label">TOTAL DEL PORCENTAJE:</label>
                              <div class="col-sm-3">
                                <input type="text" class="form-control" id="total" value="100" disabled="true">
                              </div>
                              <label for="staticEmail" class="col-sm-3 col-form-label">%</label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-6 col-form-label">% POR DISCAPACIDAD:</label>
                              <div class="col-sm-2">
                                <input type="text" class="form-control" name="por_discapacidad" id="por_discapacidad" value="15">
                              </div>
                              <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                            </div>
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-6 col-form-label">% LIC. MILITAR:</label>
                              <div class="col-sm-2">
                                <input type="text" class="form-control" name="militar" id="militar" value="10">
                              </div>
                              <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                            </div>
                          </div>
                        </div>
                        <div class="row m-3">
                          <div class="col-6">
                            <a href="listado_convocatorias.php?dni=<?php echo $dni ?>" type="button" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i> Retroceder</a>
                          </div>
                          <div class="col-6 d-flex justify-content-end">
                            <button type="submit" name="editar_conv" class="btn btn-danger">Actualizar <i class="fas fa-arrow-circle-right"></i></button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="tab-pane fade m-2" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                      <div class="row m-3">
                        <div class="col-md-12 d-flex justify-content-center">
                          <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Nuevo</a>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <thead>
                            <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                              <th>N°</th>
                              <th style="display: none;">id</th>
                              <th>Cargo</th>
                              <th>Financiero</th>
                              <th>Dirección ejecutora</th>
                              <th>Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $dni = $_GET['dni'];
                            $idcon = $_GET['idcon'];
                            $sql = "SELECT * FROM personal_req INNER JOIN ubicacion 
                                  ON personal_req.personal_req_idubicacion = ubicacion.iddireccion INNER JOIN cargo_full ON personal_req.cargo_idcargo = cargo_full.idcargo
                                  WHERE convocatoria_idcon='$idcon'";
                            $query = mysqli_query($con, $sql);
                            $i = 1;
                            if (mysqli_num_rows($query) > 0) {
                              while ($row = mysqli_fetch_array($query)) {
                                $idpersonal = $row['idpersonal'];
                            ?>
                                <tr style="background-color: #8287e061;">
                                  <td style="font-size: 14px; font-weight:900; text-align: center"><?php echo $i ?></td>
                                  <td style="font-size: 12px; display:none"><?php echo $idpersonal ?></td>
                                  <td style="font-size: 12px;">
                                    <small style="font-weight:700; font-size: 14px;">Cargo requerido: </small><?php echo $row['cargo'] ?><br>
                                    <small style="font-weight:700; font-size: 14px;">Cantidad requerida: </small><?php echo $row['cantidad'] ?>
                                  </td>
                                  <td style="font-size: 12px;">
                                    <small style="font-weight:700; font-size: 14px;">Fuente finac.: </small><?php echo $row['fuente_finac'] ?><br>
                                    <small style="font-weight:700; font-size: 14px;">Meta: </small><?php echo $row['meta'] ?><br>
                                    <small style="font-weight:700; font-size: 14px;">Remuneracion: </small>S/.<?php echo $row['remuneracion'] ?>
                                  </td>
                                  <td style="font-size: 12px;">
                                    <small style="font-weight:700; font-size: 14px;">Dirección Ejecutora: </small><?php echo $row['direccion_ejec'] . " - " . $row['equipo_ejec'] ?>
                                  </td>
                                  <td>
                                    <a href="editar_personal_especifico.php?idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dni ?>&idcon=<?php echo $idcon ?>">
                                      <button type="button" class="btn btn-primary btn-sm m-1"><i class="fa fa-pencil-alt"></i></button>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm m-1 deleteBtn"><i class="fas fa-trash-alt"></i></button>
                                  </td>
                                </tr>
                                <?php
                                $select = "SELECT * FROM requerimientos INNER JOIN tipo_estudios 
                                      ON requerimientos.reque_tipo_estudios = tipo_estudios.id_tipo_estudios WHERE reque_id_personal ='$idpersonal'";
                                $consulta = mysqli_query($con, $select);
                                ?>
                                <thead>
                                  <tr>
                                    <th style="display:none;">id</th>
                                    <th></th>
                                    <th colspan='4' style="color:#000; background:#85879666; font-size:0.813em;">Requerimientos mínimos</th>
                                  </tr>
                                </thead>
                                <?php
                                $ii = 1;
                                while ($rw = mysqli_fetch_array($consulta)) {
                                ?>
                                  <tr>
                                    <td style=" font-size: 12px; display: none;"><?php echo $rw['id_requerimientos'] ?></td>
                                    <td style="font-size: 12px;"></td>
                                    <td style="font-size: 12px;">
                                      <small style="font-weight:700; font-size: 14px;">Tipo estudio: </small><?php echo $rw['tipo_estudios'] ?><br>
                                      <small style="font-weight:700; font-size: 14px;">Nivel estudio: </small><?php echo $rw['nivel_estudio'] ?>
                                    </td>
                                    <td style="font-size: 12px;">
                                      <small style="font-weight:700; font-size: 14px;">Cantidad experiencia: </small><br><?php echo $rw['cantidad_experiencia'] ?>
                                      <?php if ($rw['tipo_experiencia'] = 'anios') {
                                        echo "AÑO (S)";
                                      } else {
                                        echo "MES (ES)";
                                      }  ?>
                                    </td>
                                    <td style="font-size: 12px;">
                                      <small style="font-weight:700; font-size: 14px;">Colegiatura: </small><?php echo $rw['colegiatura'] ?><br>
                                      <small style="font-weight:700; font-size: 14px;">Habilitación: </small><?php echo $rw['habilitacion'] ?><br>
                                      <small style="font-weight:700; font-size: 14px;">Serums: </small><?php echo $rw['serums'] ?><br>
                                      <small style="font-weight:700; font-size: 14px;">Licencia de conducir: </small><?php echo $rw['licencia_conducir'] ?>
                                    </td>
                                  </tr>
                                  <thead>
                                    <tr>
                                      <th style="display:none;">id</th>
                                      <th></th>
                                      <th colspan='4' style="color:#000; background:#85879666; font-size:0.813em;">Requerimientos máximos</th>
                                    </tr>
                                  </thead>
                                  <tr>
                                    <td style=" font-size: 12px; display: none;"><?php echo $rw['id_requerimientos'] ?></td>
                                    <td style="font-size: 12px;"></td>
                                    <td style="font-size: 12px;">
                                      <small style="font-weight:700; font-size: 14px;">Tipo estudio máx.: </small><?php echo $rw['tipo_estudios'] ?><br>
                                      <small style="font-weight:700; font-size: 14px;">Nivel estudio máx.: </small><?php echo $rw['nivel_estudio_max'] ?>
                                    </td>
                                    <td style="font-size: 12px;">
                                      <small style="font-weight:700; font-size: 14px;">Cantidad experiencia: </small><br><?php echo $rw['cantidad_experiencia'] ?>
                                      <?php if ($rw['tipo_experiencia'] = 'anios') {
                                        echo "AÑO (S)";
                                      } else {
                                        echo "MES (ES)";
                                      }  ?>
                                    </td>
                                    <td style="font-size: 12px;">
                                      <small style="font-weight:700; font-size: 14px;">Colegiatura máx.: </small><?php echo $rw['colegiatura_max'] ?><br>
                                      <small style="font-weight:700; font-size: 14px;">Habilitación máx.: </small><?php echo $rw['habilitacion_max'] ?><br>
                                      <small style="font-weight:700; font-size: 14px;">Serums máx.: </small><?php echo $rw['serums_max'] ?>
                                    </td>
                                  </tr>
                                <?php
                                  $ii++;
                                }
                                ?>
                            <?php
                                $i++;
                              }
                            } else {
                              echo "<tr><td colspan='6' class='text-center text-danger font-weight-bold' >NO HAY PERSONAL REQUERIDO</td></tr>";
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane fade m-2" id="comision" role="tabpanel" aria-labelledby="comision-tab">
                      <form method="POST" action="procesos/guardar_comision.php">
                        <?php
                        $idcon = $_GET['idcon'];
                        $sql = "SELECT * FROM convocatoria where idcon=$idcon";
                        $datos = mysqli_query($con, $sql);
                        $fila_2 = mysqli_fetch_array($datos);
                        ?>
                        <div class="row m-3">
                          <div class="col-md-12 d-flex justify-content-center">
                            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addComision"><i class="fas fa-plus"></i> Nuevo</a>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <h6 class="m-0 font-weight-bold text-danger">Datos de la comisión</h6>
                            <hr class="sidebar-divider">
                          </div>
                          <div class="col-12">
                            <table class="table table-bordered">
                              <thead>
                                <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                  <th>N°</th>
                                  <th style="display: none;">id</th>
                                  <th>Cargo</th>
                                  <th>Nombres</th>
                                  <th>Apellidos</th>
                                  <th>Area usuaria</th>
                                  <th>Acciones</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $idcon = $_GET['idcon'];
                                $sql = "SELECT * FROM comision WHERE convocatoria_idcon='$idcon'";
                                $query = mysqli_query($con, $sql);
                                $i = 1;
                                if (mysqli_num_rows($query) > 0) {
                                  while ($row = mysqli_fetch_array($query)) {
                                    $idcomision = $row['idcomision'];
                                ?>
                                    <tr>
                                      <td style="font-size: 14px; text-align: center"><?php echo $i ?></td>
                                      <td style="font-size: 14px; display:none"><?php echo $idcomision ?></td>
                                      <td style="font-size: 14px;"><?php echo $row['cargo_funcio'] ?></td>
                                      <td style="font-size: 14px;"><?php echo $row['nombre'] ?></td>
                                      <td style="font-size: 14px;"><?php echo $row['apellidos'] ?></td>
                                      <td style="font-size: 14px;"><?php echo $row['area_user'] ?></td>
                                      <td>
                                        <button type="button" class="btn btn-primary btn-sm editComision"><i class="fa fa-pencil-alt"></i> Editar</button>
                                        <button type="button" class="btn btn-danger btn-sm deleteComision"><i class="fa fa-pencil-alt"></i> Eliminar</button>
                                      </td>
                                    </tr>

                                <?php
                                    $i++;
                                  }
                                } else {
                                  echo "<tr><td colspan='6' class='text-center text-danger font-weight-bold' >NO HAY PERSONAL REQUERIDO</td></tr>";
                                }
                                ?>
                              </tbody>
                            </table>
                          </div>
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
                  <div class="col-md-12 col-sm-12 form-group">
                    <label for="title">(*) Dirección ejecutora del personal requerido</label>
                    <select name="direccion_ejecutora" class="select_direccion" data-placeholder="Elige la ubicación del personal requerido" required>
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
                  <div class="col-md-12 col-sm-12 form-group">
                    <label for="title">(*) Ubicación del personal requerido</label>
                    <select name="ubicacion_postu" class="select_ubicacion" data-placeholder="Elige la ubicación del personal requerido" required>
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
                      <option value="TITULADO TECNICO">Titulado Técnico</option>
                      <option value="EGRESADO TECNICO">Egresado Técnico</option>
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
                      <option value="">Elegir...</option>
                      <option value="TITULADO TECNICO">Titulado Técnico</option>
                      <option value="EGRESADO TECNICO">Egresado Técnico</option>
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

      <!-- ADD NUEVOS DATOS COMISION -->
      <div class="modal fade" id="addComision">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title">Nuevo personal de Comisión</h5>
              <button class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
              <form action="procesos/modificar_convoca.php" autocomplete="off" method="POST">
                <div class="row">
                  <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
                  <input type="hidden" name="idcon" value="<?php echo $idcon ?>">
                  <div class="col-md-2 col-sm-12 form-group">
                    <label for="title">(*) Cargo</label>
                    <select style="font-size:13px;" class="form-control" name="cargo_funcio">
                      <option value="" disabled selected>Elegir</option>
                      <option value="PRESIDENTE">Presidente</option>
                      <option value="MIEMBRO">Miembro</option>
                    </select>
                  </div>
                  <div class="col-md-5 col-sm-12 form-group">
                    <label for="title">(*) Nombres</label>
                    <input style="font-size:13px;" type="text" name="nombre_comi" placeholder="Nombres completos" class="form-control name_list" required />
                  </div>
                  <div class="col-md-5 col-sm-12 form-group">
                    <label for="title">(*) Apellidos</label>
                    <input style="font-size:13px;" type="text" name="apelli_comi" placeholder="Apellidos completos" class="form-control name_list" required />
                  </div>
                  <div class="col-md-6 col-sm-12 form-group">
                    <label for="title">(*) Area usuaria</label>
                    <input style="font-size:13px;" type="text" name="area_comi" placeholder="Área usuaria" class="form-control " required />
                  </div>
                </div>
                <div class="modal-footer">
                  <button data-dismiss="modal" class="btn btn-secondary">Salir</button>
                  <button type="submit" name="insertComi" class="btn btn-primary">Guardar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Editar comision -->
      <div class="modal fade" id="updateComision">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title">Editar personal de Comisión</h5>
              <button class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
              <form action="procesos/modificar_convoca.php" autocomplete="off" method="POST">
                <div class="row">
                  <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
                  <input type="hidden" name="idcon" value="<?php echo $idcon ?>">
                  <input type="hidden" name="idcomision" id="idcomision">
                  <div class="col-md-2 col-sm-12 form-group">
                    <label for="title">(*) Cargo</label>
                    <select style="font-size:13px;" class="form-control" name="cargo_funcio" id="cargo_funcio">
                      <option value="" disabled selected>Elegir</option>
                      <option value="PRESIDENTE">Presidente</option>
                      <option value="MIEMBRO">Miembro</option>
                    </select>
                  </div>
                  <div class="col-md-5 col-sm-12 form-group">
                    <label for="title">(*) Nombres</label>
                    <input style="font-size:13px;" type="text" name="nombre_comi" id="nombre_comi" class="form-control" required />
                  </div>
                  <div class="col-md-5 col-sm-12 form-group">
                    <label for="title">(*) Apellidos</label>
                    <input style="font-size:13px;" type="text" name="apelli_comi" id="apelli_comi" class="form-control" required />
                  </div>
                  <div class="col-md-6 col-sm-12 form-group">
                    <label for="title">(*) Area usuaria</label>
                    <input style="font-size:13px;" type="text" name="area_comi" id="area_comi" class="form-control " required />
                  </div>
                </div>
                <div class="modal-footer">
                  <button data-dismiss="modal" class="btn btn-secondary">Salir</button>
                  <button type="submit" name="updatetComi" class="btn btn-primary">Actualizar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Eliminar comision -->
      <div class="modal fade" id="deleteComision">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title">Nuevo personal de Comisión</h5>
              <button class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
              <form action="procesos/modificar_convoca.php" autocomplete="off" method="POST">
                <div class="row">
                  <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
                  <input type="hidden" name="idcon" value="<?php echo $idcon ?>">
                  <input type="hidden" name="idcomi" id="idcomi">
                  <h4>¿Desea eliminar el dato seleccionado?</h4>
                </div>
                <div class="modal-footer">
                  <button data-dismiss="modal" class="btn btn-secondary">Salir</button>
                  <button type="submit" name="deleteComi" class="btn btn-danger">Eliminar</button>
                </div>
              </form>
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
      <script src="js/lib/chosen/chosen.jquery.min.js"></script>
      <script src="js/sumar.js"></script>
      <script>
        jQuery(document).ready(function() {
          jQuery(".select_direccion").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, no ha sido encontrado!",
            width: "100%"
          });
          jQuery(".select_ubicacion").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, no ha sido encontrado!",
            width: "100%"
          });
        });
      </script>
      <script>
        $(document).ready(function() {
          $('#tipo_con > option[value="<?php echo $tipo_convocatoria ?>"]').attr('selected', 'selected');
        });
      </script>
      <script>
        $('#myTab a').click(function(e) {
          e.preventDefault();
          $(this).tab('show');
        });

        // store the currently selected tab in the hash value 
        $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
          var id = $(e.target).attr("href").substr(1);
          window.location.hash = id;
        });

        // on load of the page: switch to the currently selected tab 
        var hash = window.location.hash;
        $('#myTab a[href="' + hash + '"]').tab('show');
      </script>
      <script>
        $(document).ready(function() {
          $('.editComision').on('click', function() {

            $('#updateComision').modal('show');

            // Get the table row data.
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
              return $(this).text();
            }).get();

            console.log(data);
            $('#num').val(data[0]);
            $('#idcomision').val(data[1]);
            $('#cargo_funcio').val(data[2]);
            $('#nombre_comi').val(data[3]);
            $('#apelli_comi').val(data[4]);
            $('#area_comi').val(data[5]);
          });

          $('.deleteComision').on('click', function() {

            $('#deleteComision').modal('show');
            // Get the table row data.
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
              return $(this).text();
            }).get();

            console.log(data);
            $('#num').val(data[0]);
            $('#idcomi').val(data[1]);
          });
        });
      </script>

</body>

</html>