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

  <title>DETALLES POSTULANTE PARA EVALUACION - DIRESA TACNA</title>

  <!-- Custom fonts for this template -->
  <link rel="icon" type="image/png" href="img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="vendor/sweetalert/sweetalert2.min.css">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php
    $dni = $_GET['dni'];
    $dato_desencriptado = $_GET['dni'];
    // $dni = $desencriptar($dato_desencriptado);
    $idpostulante = $_GET['idpostulante'];
    $idcon = $_GET['idcon'];
    $idpersonal = $_GET['idpersonal'];

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

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DETALLES DEL POSTULANTE (FORMACIÓN, CURSOS Y EXPERIENCIA LABORAL)</h6>
            </div>

            <div class="card-body">
              <?php
              $sql = "SELECT * FROM postulante where idpostulante='$idpostulante'";
              $datos = mysqli_query($con, $sql);
              $fila = mysqli_fetch_array($datos);
              $dni_postulante = $fila['dni'];

              $sql_2 = "SELECT * FROM convocatoria WHERE idcon='$idcon'";
              $datos_2 = mysqli_query($con, $sql_2);
              $fila_2 = mysqli_fetch_array($datos_2);

              $sql_3 = "SELECT * FROM personal_req INNER JOIN cargo_full ON personal_req.cargo_idcargo= cargo_full.idcargo WHERE idpersonal='$idpersonal'";
              $datos_3 = mysqli_query($con, $sql_3);
              $fila_3 = mysqli_fetch_array($datos_3);
              $nomb_cargo_espec = $fila_3['nomb_cargo_espec'];

              $sql_4 = "SELECT * FROM requerimientos INNER JOIN tipo_estudios 
              ON requerimientos.reque_tipo_estudios = tipo_estudios.id_tipo_estudios WHERE reque_id_personal='$idpersonal'";
              $datos_4 = mysqli_query($con, $sql_4);
              $fila_4 = mysqli_fetch_array($datos_4);

              $consul_detalle_conv = mysqli_query($con, "SELECT * FROM detalle_convocatoria WHERE convocatoria_idcon='$idcon' AND postulante_idpostulante = '$idpostulante' AND personal_req_idpersonal = '$idpersonal'");
              $arreglo = mysqli_fetch_array($consul_detalle_conv);
              $iddetalle_convocatoria = $arreglo['iddetalle_convocatoria'];

              ?>
              <!-- FORMACION PERSONAL -->
              <div class="form-group">
                <h6 class="m-0 font-weight-bold text-primary">Datos del postulante</h6>
                <hr class="sidebar-divider">
              </div>
              <div class="form-row">
                <div class="form-group col-md-2 col-sm-12">
                  <label for="inputEmail4">D.N.I.</label>
                  <input type="text" class="form-control" value="<?php echo $dni_postulante ?>" disabled="true">
                </div>
                <div class="form-group col-md-4 col-sm-6">
                  <label for="inputEmail4">Nombres completos</label>
                  <input type="text" class="form-control" style="text-transform: uppercase;" value="<?php echo $fila['nombres'] . " " . $fila['ape_pat'] . " " . $fila['ape_mat'] ?>" disabled="true">
                </div>
                <div class="form-group col-md-2 col-sm-6">
                  <label for="inputEmail4">Nº Convocatoria</label>
                  <input type="text" class="form-control" value="<?php echo $fila_2['num_con'] . " - " . $fila_2['anio_con'] ?>" disabled="true">
                </div>
                <div class="form-group col-md-2 col-sm-6">
                  <label for="inputEmail4">Tipo convocatoria</label>
                  <input type="text" class="form-control" value="<?php echo $fila_2['tipo_con'] ?>" disabled="true">
                </div>
                <div class="form-group col-md-2 col-sm-6">
                  <label for="inputEmail4">Cargo solicitado</label>
                  <input type="text" class="form-control" value="<?php echo $fila_3['cargo'] ?>" disabled="true">
                </div>
              </div>
              <!-- FORMACION ACADEMICA -->
              <div class="form-group">
                <h6 class="m-0 font-weight-bold text-primary">Formación academica profesional</h6>
                <hr class="sidebar-divider">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-row">
                    <div class="form-group col-md-6 col-sm-6">
                      <label for="inputEmail4" style="font-size: 14px;">Cargo especifico</label>
                      <select class="form-control" name="id_cargo_especifico" id="id_cargo_especifico">
                        <?php
                        $query = $con->query("SELECT * FROM tipo_cargo_espec WHERE nomb_cargo_espec = '$nomb_cargo_espec'");
                        while ($valores = mysqli_fetch_array($query)) {
                          echo '<option value="' . $valores['idtipo_cargo_espec'] . '">' . $valores['nomb_cargo_espec'] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                      <label for="inputEmail4" style="font-size: 14px;">Cargo requerido</label>
                      <input type="text" class="form-control" style="font-size: 14px;" value="<?php echo $fila_3['cargo'] ?>" disabled="true">
                    </div>
                  </div>
                  <div class="form-group">
                    <h6 class="m-0 font-weight-bold text-warning">Formación academica requerida MÍNIMA para CAS</h6>
                    <hr class="sidebar-divider">
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4 col-sm-6" id="div_tipo_estudio_min">
                      <label for="inputEmail4">Tipo estudio</label>
                      <input type="text" class="form-control" style="font-size: 13px;" value="<?php echo $fila_4['tipo_estudios'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-4 col-sm-6" id="div_nivel_estudio_min">
                      <label for="inputEmail4">Nivel estudio</label>
                      <input type="text" class="form-control" style="font-size: 13px;" value="<?php echo $fila_4['nivel_estudio'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-4 col-sm-6" id="div_ciclo_req_min">
                      <label for="inputEmail4">Ciclo requerido</label>
                      <input type="text" class="form-control" style="font-size: 13px;" value="<?php echo $fila_4['ciclo_actual'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-4 col-sm-6" id="div_colegiatura_min">
                      <label for="inputEmail4">Colegiatura</label>
                      <input type="text" class="form-control" style="font-size: 13px;" value="<?php echo $fila_4['colegiatura'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-4 col-sm-6" id="div_habilitacion_min">
                      <label for="inputEmail4">Habilatación</label>
                      <input type="text" class="form-control" style="font-size: 13px;" value="<?php echo $fila_4['habilitacion'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-4 col-sm-6" id="div_serums_min">
                      <label for="inputEmail4">SERUMS</label>
                      <input type="text" class="form-control" style="font-size: 13px;" value="<?php echo $fila_4['serums'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-4 col-sm-6" id="div_lic_condu">
                      <label for="inputEmail4">Licencia conducir</label>
                      <input type="text" class="form-control" style="font-size: 13px;" value="<?php echo $fila_4['licencia_conducir'] ?>" disabled="true">
                    </div>
                  </div>
                  <div class="form-group">
                    <h6 class="m-0 font-weight-bold text-success">Formación academica requerida MÁXIMA para CAS</h6>
                    <hr class="sidebar-divider">
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4 col-sm-6" id="div_tipo_estudio_max">
                      <label for="inputEmail4">Tipo estudio máximo</label>
                      <input type="text" class="form-control" style="font-size: 13px;" value="<?php echo $fila_4['tipo_estudios'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-4 col-sm-6" id="div_nivel_estudio_max">>
                      <label for="inputEmail4">Nivel estudio máximo</label>
                      <input type="text" class="form-control" style="font-size: 13px;" value="<?php echo $fila_4['nivel_estudio'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-4 col-sm-6" id="div_ciclo_req_max">
                      <label for="inputEmail4">Ciclo requerido máximo</label>
                      <input type="text" class="form-control" style="font-size: 13px;" value="<?php echo $fila_4['ciclo_actual'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-4 col-sm-6" id="div_colegiatura_max">
                      <label for="inputEmail4">Colegiatura</label>
                      <input type="text" class="form-control" style="font-size: 13px;" value="<?php echo $fila_4['colegiatura'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-4 col-sm-6" id="div_habilitacion_max">
                      <label for="inputEmail4">Habilatación</label>
                      <input type="text" class="form-control" style="font-size: 13px;" value="<?php echo $fila_4['habilitacion'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-4 col-sm-6" id="div_serums_max">
                      <label for="inputEmail4">SERUMS</label>
                      <input type="text" class="form-control" style="font-size: 13px;" value="<?php echo $fila_4['serums'] ?>" disabled="true">
                    </div>
                    <div class="form-group col-md-4 col-sm-6" id="div_lic_condu_max">
                      <label for="inputEmail4">Licencia conducir</label>
                      <input type="text" class="form-control" style="font-size: 13px;" value="<?php echo $fila_4['licencia_conducir'] ?>" disabled="true">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <h6 class="m-0 font-weight-bold text-success">Formacion academica del postulante</h6>
                    <hr class="sidebar-divider">
                  </div>
                  <?php
                  $consul_form_cas = mysqli_query($con, "SELECT * FROM formacion_acad INNER JOIN tipo_estudios 
                  ON formacion_acad.tipo_estudios_id = tipo_estudios.id_tipo_estudios WHERE formacion_idpostulante='$idpostulante'");
                  $fila_form = mysqli_fetch_array($consul_form_cas);
                  ?>
                  <form action="procesos/actualizar_validacion.php" method="POST">
                    <div class="form-row">
                      <input type="hidden" name="dato_desencriptado_form" value="<?php echo $dato_desencriptado ?>">
                      <input type="hidden" name="idpostulante_form" value="<?php echo $idpostulante ?>">
                      <input type="hidden" name="idcon_form" value="<?php echo $idcon ?>">
                      <input type="hidden" name="idpersonal" value="<?php echo $idpersonal ?>">
                      <input type="hidden" name="idformacion_cas" value="<?php echo $fila_form['id_formacion'] ?>">

                      <div class="form-group col-md-4 col-sm-12" id="div_tipo_estudio_post">
                        <label for="tipo_estudios" style="font-size: 13px;">Tipo estudios postulante:</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" value="<?php echo $fila_form['tipo_estudios'] ?>" disabled="true">
                      </div>
                      <div class="form-group col-md-4 col-sm-12" id="div_nivel_estudio_post">
                        <label for="nivel_estudio" style="font-size: 13px;">Nivel estudio postulante:</label>
                        <input type="text" class="form-control" value="<?php echo $fila_form['nivel_estudios'] ?>" disabled="true">
                      </div>
                      <div class="form-group col-md-4 col-sm-12" id="div_ciclo_req_post">
                        <label for="ciclo_postulante">Ciclo del postulante:</label>
                        <input type="text" class="form-control" style="font-size: 13px;" value="<?php echo $fila_form['ciclo_actual'] ?>" disabled="true">
                      </div>
                      <div class="form-group col-md-12 col-sm-12" id="div_carrera_post">
                        <label for="carrera_postulante">Carrera del postulante:</label>
                        <input type="text" class="form-control" style="font-size: 13px;" value="<?php echo $fila_form['carrera'] ?>" disabled="true">
                      </div>
                      <div class="form-group col-md-4 col-sm-12" id="div_colegiatura_post">
                        <label for="inputEmail4" style="font-size: 13px;">Colegiatura postulante:</label>
                        <input type="text" class="form-control" value="<?php echo $fila_form['colegiatura'] ?>" disabled="true">
                      </div>
                      <!-- <div class="form-group col-md-4 col-sm-12">
                        <label for="inputEmail4" style="font-size: 13px;">Fecha colegiatura:</label>
                        <input type="text" class="form-control" value="<?php echo $fila_form['fech_colegiatura'] ?>" disabled="true">
                      </div> -->
                      <div class="form-group col-md-4 col-sm-12" id="div_habilitacion_post">
                        <label for="inputEmail4" style="font-size: 13px;">Fecha habilitacion:</label>
                        <input type="text" class="form-control" value="<?php echo $fila_form['fech_habilitacion'] ?>" disabled="true">
                      </div>
                      <div class="form-group col-md-4 col-sm-12" id="div_serums_post">
                        <label for="inputEmail4" style="font-size: 13px;">SERUMS:</label>
                        <input type="text" class="form-control" value="<?php echo $fila_form['serums'] ?>" disabled="true">
                      </div>
                      <div class="form-group col-md-4 col-sm-12" id="div_lic_condu_post">
                        <label for="inputEmail4" style="font-size: 13px;">Licencia conducir:</label>
                        <input type="text" class="form-control" value="<?php echo $fila_form['brevete'] ?>" disabled="true">
                      </div>
                      <div class="form-group col-md-4 col-sm-12">

                      </div>
                      <div class="form-group col-md-6 col-sm-6">
                        <label for="inputEmail4">Ver archivo de formacion:</label><br>
                        <a href="ver_formacion_cas.php?id=<?php echo $fila_form['id_formacion'] ?>&dni_postulante=<?php echo $dni_postulante ?>&dni=<?php echo $dni ?>" target=" _blank"><i class="fas fa-file-pdf"></i> <?php echo $fila_form['archivo']; ?></a>
                      </div>
                      <div class="form-group col-md-6 col-sm-12">
                        <label for="validacion_formacion">Validación de la formación:</label>
                        <?php $validacion_formacion = $fila_form['formacion_validacion'] ?>
                        <select name="validacion_formacion" id="validacion_formacion" class="form-control">
                          <option value="VALIDO">VÁLIDO</option>
                          <option value="NO VALIDO">NO VÁLIDO</option>
                          <option value="OBSERVADO">OBSERVADO</option>
                        </select>
                      </div>
                      <div class="form-group col-md-12 col-sm-12">
                        <label for="observaciones_selec">Observaciones</label>
                        <textarea class="form-control" name="observaciones" id="observaciones_selec" value="<?php echo $fila_4['observaciones_selec'] ?>" placeholder="Especificar la razon del cambio en la validación..." rows="3"></textarea>
                      </div>
                      <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                        <button class="btn btn-success" name="updateFormacionCAS" type="submit"><i class="fa fa-edit"></i> Actualizar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- POSTRAGRADO -->
              <div class="form-group">
                <h6 class="m-0 font-weight-bold text-primary">Lista de POSTGRADOS registrados</h6>
                <hr class="sidebar-divider">
              </div>
              <div class="table-responsive">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="display:none">id</th>
                      <th>Nº</th>
                      <th>Datos Postgrado</th>
                      <th>Tipo de estudio</th>
                      <th>Nivel alcanzado</th>
                      <th>Fecha del Postgrado</th>
                      <th>Ver archivo</th>
                      <th>Validación</th>
                      <th>Observaciones</th>
                      <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $consulta_post = "SELECT * FROM maestria_doc WHERE idpostulante_postulante = '$idpostulante'";
                    $query = mysqli_query($con, $consulta_post);
                    $i = 1;
                    if (mysqli_num_rows($query) > 0) {
                      while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                          <td style="display:none"><?php echo $row['idmaestria_doc'] ?></td>
                          <td style="font-size: 14px;"><?php echo $i ?></td>
                          <td style="font-size: 12px;">
                            <small style="font-weight:700; font-size: 12px;">Centro de estudios:</small><br><?php echo $row['centro_estu'] ?><br>
                            <small style="font-weight:700; font-size: 12px;">Especialidad:</small><br><?php echo $row['especialidad'] ?>
                          </td>
                          <td style="font-size: 12px;"><?php echo $row['tipo_estu'] ?></td>
                          <td style="font-size: 12px;"><?php echo $row['nivel'] ?></td>
                          <td style="font-size: 13px;">
                            <small style="font-weight:700; font-size: 13px;">Fecha Inicio:</small><br><?php echo $row['fech_ini'] ?><br>
                            <small style="font-weight:700; font-size: 13px;">Fecha Termino:</small><br><?php echo $row['fech_fin'] ?>
                          </td>
                          <td style="font-size: 12px;">
                            <a href="ver_postgrado.php?id=<?php echo $row['idmaestria_doc'] ?>&dni_postulante=<?php echo $dni_postulante ?>&dni=<?php echo $dni ?>" target="_blank"><i class="fas fa-file-pdf"></i> <?php echo $row['archivo']; ?></a>
                          </td>
                          <td style="font-size: 12px;"><?php echo $row['postgrado_validacion'] ?></td>
                          <td style="font-size: 12px;"><?php echo $row['observaciones_selec'] ?></td>
                          <td>
                            <div class="row d-flex justify-content-center">
                              <button class="btn btn-success btn-sm m-1 updateBtnPost"><i class="fa fa-edit"></i></button>
                            </div>
                          </td>
                        </tr>
                    <?php
                        $i++;
                      }
                    } else {
                      echo "<tr><td colspan='10' class='text-center text-danger font-weight-bold' >NO HAY CURSOS POSTGRADO REGISTRADOS POR EL POSTULANTE</td></tr>";
                    }
                    ?>
                  </tbody>

                </table>
              </div>
              <!-- CAPACITACIONES -->
              <div class="form-group">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Capacitaciones registradas</h6>
                <hr class="sidebar-divider">
              </div>
              <div class="table-responsive">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="display:none">id</th>
                      <th>Nº</th>
                      <th>Datos del curso</th>
                      <th>Horas</th>
                      <th>Fecha del curso</th>
                      <th>Tipo</th>
                      <th>Ver archivo</th>
                      <th>Validación</th>
                      <th>Observación</th>
                      <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $consulta_form = "SELECT * FROM cursos_extra WHERE curso_extra_idpostulante = $idpostulante";
                    $query = mysqli_query($con, $consulta_form);
                    $i = 1;
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                      <tr>
                        <td style="display:none"><?php echo $row['idcursos_extra'] ?></td>
                        <td style="font-size: 12px;"><?php echo $i ?></td>
                        <td style="font-size: 13px;">
                          <small style="font-weight:700; font-size: 13px;">Materia:</small><br><?php echo $row['materia'] ?><br>
                          <small style="font-weight:700; font-size: 13px;">Centro de estudios:</small><br><?php echo $row['centro_estu'] ?>
                        </td>
                        <td style="font-size: 12px;"><?php echo $row['horas'] ?></td>
                        <td style="font-size: 12px;">
                          <small style="font-weight:700; font-size: 12px;">Fecha Inicio:</small><br><?php echo $row['fech_ini'] ?><br>
                          <small style="font-weight:700; font-size: 12px;">Fecha Termino:</small><br><?php echo $row['fech_fin'] ?>
                        </td>
                        <td style="font-size: 12px;"><?php echo $row['tipo'] ?></td>
                        <td style="font-size: 12px;">
                          <a href="ver_diplomado.php?id=<?php echo $row['idmaestria_doc'] ?>&dni_postulante=<?php echo $dni_postulante ?>&dni=<?php echo $dni ?>" target="_blank"><i class="fas fa-file-pdf"></i> <?php echo $row['archivo']; ?></a>
                        </td>
                        <td style="font-size: 12px;"><?php echo $row['curso_validacion'] ?></td>
                        <td style="font-size: 12px;"><?php echo $row['observaciones_selec'] ?></td>
                        <td>
                          <div class="row d-flex justify-content-center">
                            <button class="btn btn-success btn-sm m-1 updateBtn"><i class="fa fa-edit"></i></button>
                          </div>
                        </td>
                      </tr>
                    <?php
                      $i++;
                    }
                    ?>
                  </tbody>

                </table>
              </div>
              <!-- IDIOMA - COMPUTACION -->
              <div class="form-group">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Idiomas - Computación</h6>
                <hr class="sidebar-divider">
              </div>
              <div class="table-responsive">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="display:none">id</th>
                      <th>Nº</th>
                      <th>Idioma o Computación</th>
                      <th>Centro de estudios</th>
                      <th>Nivel alcanzado</th>
                      <th>Ver archivo</th>
                      <th>Validación</th>
                      <th>Observaciones</th>
                      <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $idioma_compu = "SELECT * FROM sistema_seleccion.idiomas_comp WHERE idpostulante_postulante = '$idpostulante'";
                    $resultado = MYSQLI_query($con, $idioma_compu);
                    $i = 1;
                    while ($rw = mysqli_fetch_array($resultado)) {
                    ?>
                      <tr>
                        <td style="display:none"><?php echo $rw['ididiomas_comp'] ?></td>
                        <td style="font-size: 14px;"><?php echo $i ?></td>
                        <td style="font-size: 13px;"><?php echo $rw['idioma_comp'] ?></td>
                        <td style="font-size: 13px;"><?php echo $rw['lugar_estudio'] ?></td>
                        <td style="font-size: 13px;"><?php echo $rw['nivel'] ?></td>
                        <td style="font-size: 14px;">
                          <a href="ver_diplomado.php?id=<?php echo $rw['idcursos_extra'] ?>dni_postulante=<?php echo $dni_postulante ?>&dni=<?php echo $dni ?>" target="_blank"><i class="fas fa-file-pdf"></i> <?php echo $rw['archivo']; ?></a>
                        </td>
                        <td style="font-size: 13px;"><?php echo $rw['idioma_validacion'] ?></td>
                        <td style="font-size: 13px;"><?php echo $rw['observaciones_selec'] ?></td>
                        <td>
                          <div class="row d-flex justify-content-center">
                            <button class="btn btn-success btn-sm updateBtn_2"><i class="fa fa-edit"></i></button>
                          </div>
                        </td>
                      </tr>
                    <?php
                      $i++;
                    }
                    ?>
                  </tbody>

                </table>
              </div>
              <!-- EXPERIENCIA LABORAL -->
              <div class="form-group">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Experiencia laboral registrada</h6>
                <hr class="sidebar-divider">

                <div class="table-responsive">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th style="display:none">id</th>
                        <th>Nº</th>
                        <th>Lugar de laboración</th>
                        <th>Cargo / Actividad</th>
                        <th>Fecha de contrato</th>
                        <th>Tipo comprobante</th>
                        <th>Ver archivo</th>
                        <th>Validación</th>
                        <th>Observaciones</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $experiencia = "SELECT * FROM sistema_seleccion.expe_4puntos INNER JOIN sistema_seleccion.lugar_trabajo_gene 
                      ON expe_4puntos.lugar_trab_general = lugar_trabajo_gene.idlugar_trabajo_gene WHERE expe_puntos_idpostulante = '$idpostulante'";
                      $resultado = MYSQLI_query($con, $experiencia);
                      $i = 1;
                      if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_array($resultado)) {
                      ?>
                          <tr>
                            <td style="display:none"><?php echo $row['id_4puntos'] ?></td>
                            <td style="font-size: 14px;"><?php echo $i ?></td>
                            <td style="font-size: 13px;">
                              <small style="font-weight:700; font-size: 13px;">Lugar General:</small><br><?php echo $row['nombre_general'] ?><br>
                              <small style="font-weight:700; font-size: 13px;">Lugar Específico:</small><br><?php echo $row['lugar_especifico'] ?>
                            </td>
                            <td style="font-size: 12px;"><?php echo $row['cargo'] ?></td>
                            <td style="font-size: 12px;">
                              <small style="font-weight:700; font-size: 13px;">Fecha de Inicio:</small><br><?php echo $row['fecha_inicio'] ?><br>
                              <small style="font-weight:700; font-size: 13px;">Fecha de Término:</small><br><?php echo $row['fecha_fin'] ?>
                            </td>
                            <td style="font-size: 12px;"><?php echo $row['tipo_comprobante'] ?></td>
                            <td style="font-size: 14px;">
                              <a href="ver_expe4.php?id=<?php echo $row['id_4puntos'] ?>&dni_postulante=<?php echo $dni_postulante ?>&dni=<?php echo $dni ?>" target="_blank"><i class="fas fa-file-pdf"></i> <?php echo $row['archivos']; ?></a>
                            </td>
                            <td style="font-size: 12px;"><?php echo $row['expe_validacion'] ?></td>
                            <td style="font-size: 12px;"><?php echo $row['observaciones_selec'] ?></td>
                            <td>
                              <div class="row d-flex justify-content-center">
                                <button class="btn btn-success btn-sm updateExp"><i class="fa fa-edit"></i></button>
                              </div>
                            </td>
                          </tr>
                      <?php
                          $i++;
                        }
                      } else {
                        echo "<tr><td colspan='10' class='text-center text-danger font-weight-bold' >NO HAY EXPERIENCIA REGISTRADA POR EL POSTULANTE</td></tr>";
                      }

                      ?>
                    </tbody>

                  </table>
                </div>

              </div>

              <div class="row">
                <div class="col-6 d-flex justify-content-center">
                  <a href="listado_postu_cas.php?&idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dni ?>#entrevista" class="btn btn-secondary" type="button"><i class="fas fa-arrow-circle-left"></i> Retroceder</a>
                </div>
                <div class="col-6 d-flex justify-content-center">
                  <a href="listado_postu_cas.php?&idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dni ?>#entrevista" class="btn btn-success" type="button"><i class="fas fa-check-circle"></i> Validar cambios</a>
                  <!-- <form id="frmajax" method="POST">
                    <input type="hidden" name="dni_comision" value="<?php echo $dato_desencriptado ?>">
                    <input type="hidden" name="idpostulante" value="<?php echo $idpostulante ?>">
                    <input type="hidden" name="idcon" value="<?php echo $idcon ?>">
                    <input type="hidden" name="idpersonal" value="<?php echo $idpersonal ?>">
                    <input type="hidden" name="iddetalle_convocatoria" value="<?php echo $iddetalle_convocatoria ?>">
                    <button class="btn btn-primary m-1" type="submit" id="button_puntaje"><i class="fas fa-calculator"></i> Calcular puntaje</button>
                  </form> -->
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

  <!-- Actualizar posgrado - ESTE ES-->
  <div class="modal fade" id="actualizar_postgrado" tabindex="-1" aria-labelledby="actualizar_idioma" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Actualizar validación</h5>
          <button class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <form action="procesos/actualizar_validacion.php" method="POST">
          <div class="modal-body">

            <div class="row">
              <input type="hidden" name="dato_desencriptado" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="idpostulante" value="<?php echo $idpostulante ?>">
              <input type="hidden" name="idcon" value="<?php echo $idcon ?>">
              <input type="hidden" name="idpersonal" value="<?php echo $idpersonal ?>">

              <input type="hidden" name="id_postgrado" id="id_postgrado">
              <input type="hidden" name="dni_postulante" value="<?php echo $dni ?>">
              <?php
              // $consul_form = "SELECT * FROM formacion_acad_prac where formacion_acad_prac_idpostulante=$idpostulante";
              // $datos_4 = mysqli_query($con, $consul_form);
              // $fila_4 = mysqli_fetch_array($datos_4);
              ?>
              <div class=" col-md-12 col-sm-12 form-group">
                <label for="validacion_idioma">Validación:</label>
                <select name="postgrado_validacion" id="postgrado_validacion" class="form-control">
                  <option value="VALIDO">VÁLIDO</option>
                  <option value="NO VALIDO">NO VÁLIDO</option>
                  <option value="OBSERVADO">OBSERVADO</option>
                </select>
              </div>
              <div class="form-group col-md-12 col-sm-12">
                <label for="observaciones_idioma">Observaciones del Postgrado</label>
                <textarea class="form-control" name="observaciones_postgrado" id="observaciones_postgrado" placeholder="Especificar la razon del cambio en la validación..." rows="3"></textarea>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-secondary m-1" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary m-1" name="updatePostgradoCAS">Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Actualizar Diplomados - ESTE ES-->
  <div class="modal fade" id="actualizar_curso" tabindex="-1" aria-labelledby="actualizar_curso" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Actualizar validación de cursos</h5>
          <button class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <form action="procesos/actualizar_validacion.php" method="POST">
          <div class="modal-body">
            <div class="row">
              <input type="hidden" name="dato_desencriptado" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="idpostulante" value="<?php echo $idpostulante ?>">
              <input type="hidden" name="idcon" value="<?php echo $idcon ?>">
              <input type="hidden" name="idpersonal" value="<?php echo $idpersonal ?>">

              <input type="hidden" name="idcursos_extra" id="idcursos_extra">
              <input type="hidden" name="dni_postulante" value="<?php echo $dni ?>">
              <!-- <div class="col-md-4 col-sm-12 form-group">
                <label for="title">Tipo curso</label>
                <input type="text" id="tipo" class="form-control" disabled>

              </div>
              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">Nombre del curso:</label>
                <input type="text" id="materia" class="form-control" disabled>
              </div> -->
              <div class="col-md-12 col-sm-12 form-group">
                <label for="validacion">Validación del curso:</label>
                <select name="validacion" id="validacion_curso" class="form-control">
                  <option value="VALIDO">VÁLIDO</option>
                  <option value="NO VALIDO">NO VÁLIDO</option>
                  <option value="OBSERVADO">OBSERVADO</option>
                </select>
              </div>
              <div class="form-group col-md-12 col-sm-12">
                <label for="observaciones_curso">Observaciones del curso</label>
                <textarea class="form-control" name="observaciones_curso" id="observaciones_curso" placeholder="Especificar la razon del cambio en la validación..." rows="3"></textarea>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-secondary m-1" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary m-1" name="updateCursoCAS">Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Actualizar idioma - ESTE ES-->
  <div class="modal fade" id="actualizar_idioma" tabindex="-1" aria-labelledby="actualizar_idioma" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Actualizar validación</h5>
          <button class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <form action="procesos/actualizar_validacion.php" method="POST">
          <div class="modal-body">

            <div class="row">
              <input type="hidden" name="dato_desencriptado" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="idpostulante" value="<?php echo $idpostulante ?>">
              <input type="hidden" name="idcon" value="<?php echo $idcon ?>">
              <input type="hidden" name="idpersonal" value="<?php echo $idpersonal ?>">

              <input type="hidden" name="ididiomas_comp" id="ididiomas_comp">
              <input type="hidden" name="dni_postulante" value="<?php echo $dni ?>">

              <div class=" col-md-12 col-sm-12 form-group">
                <label for="validacion_idioma">Validación:</label>
                <select name="validacion_idioma" id="validacion_idioma" class="form-control">
                  <option value="VALIDO">VÁLIDO</option>
                  <option value="NO VALIDO">NO VÁLIDO</option>
                  <option value="OBSERVADO">OBSERVADO</option>
                </select>
              </div>
              <div class="form-group col-md-12 col-sm-12">
                <label for="observaciones_idioma">Observaciones del Idioma/Compu.</label>
                <textarea class="form-control" name="observaciones_idioma" id="observaciones_idioma" placeholder="Especificar la razon del cambio en la validación..." rows="3"></textarea>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-secondary m-1" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary m-1" name="updateIdiomaCAS">Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Actualizar idioma - ESTE ES-->
  <div class="modal fade" id="actualizar_exp" tabindex="-1" aria-labelledby="actualizar_exp" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Actualizar validación</h5>
          <button class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <form action="procesos/actualizar_validacion.php" method="POST">
          <div class="modal-body">

            <div class="row">
              <input type="hidden" name="dato_desencriptado" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="idpostulante" value="<?php echo $idpostulante ?>">
              <input type="hidden" name="idcon" value="<?php echo $idcon ?>">
              <input type="hidden" name="idpersonal" value="<?php echo $idpersonal ?>">

              <input type="hidden" name="id_expe4" id="id_expe4">
              <input type="hidden" name="dni_postulante" value="<?php echo $dni ?>">

              <div class=" col-md-12 col-sm-12 form-group">
                <label for="validacion_idioma">Validación:</label>
                <select name="expe_validacion" id="expe_validacion" class="form-control">
                  <option value="VALIDO">VÁLIDO</option>
                  <option value="NO VALIDO">NO VÁLIDO</option>
                  <option value="OBSERVADO">OBSERVADO</option>
                </select>
              </div>
              <div class="form-group col-md-12 col-sm-12">
                <label for="observaciones_idioma">Observaciones del Idioma/Compu.</label>
                <textarea class="form-control" name="observaciones_exp" id="observaciones_exp" placeholder="Especificar la razon del cambio en la validación..." rows="3"></textarea>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-secondary m-1" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary m-1" name="updateExp">Actualizar</button>
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
  <script src="vendor/sweetalert/sweetalert2.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
  <script src="js/detalles_post_cas.js"></script>
  <script>
    $(document).ready(function() {
      $('.updateBtn').on('click', function() {
        $('#actualizar_curso').modal('show');
        // Get the table row data.
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);
        $('#idcursos_extra').val(data[0]);
        $('#num').val(data[1]);
        $('#centro_estudi').val(data[2]);
        $('#horas').val(data[3]);
        $('#fecha_inic').val(data[4]);
        $('#tipo').val(data[5]);
        $('#archivos').val(data[6]);
        $('#validacion_curso').val(data[7]);
        $('#observaciones_curso').val(data[8]);
      });

      $('.updateBtn_2').on('click', function() {
        $('#actualizar_idioma').modal('show');
        // Get the table row data.
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();
        console.log(data);
        $('#ididiomas_comp').val(data[0]);
        $('#num').val(data[1]);
        $('#idioma_comp').val(data[2]);
        $('#lugar').val(data[3]);
        $('#nivel').val(data[4]);
        $('#archivos').val(data[5]);
        $('#validacion_idioma').val(data[6]);
        $('#observaciones_idioma').val(data[7]);
      });

      $('.updateBtnPost').on('click', function() {
        $('#actualizar_postgrado').modal('show');

        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);
        $('#id_postgrado').val(data[0]);
        $('#num').val(data[1]);
        $('#centro_estudi').val(data[2]);
        $('#tipo').val(data[3]);
        $('#nivel').val(data[4]);
        $('#fecha_inic').val(data[5]);
        $('#archivos').val(data[6]);
        $('#postgrado_validacion').val(data[7]);
        $('#observaciones_postgrado').val(data[8]);
      });

      $('.updateExp').on('click', function() {
        $('#actualizar_exp').modal('show');

        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);
        $('#id_expe4').val(data[0]);
        $('#num').val(data[1]);
        $('#lugar').val(data[2]);
        $('#cargo').val(data[3]);
        $('#fecha_contrato').val(data[4]);
        $('#tipo_comprobante').val(data[5]);
        $('#archivos').val(data[6]);
        $('#expe_validacion').val(data[7]);
        $('#observaciones_exp').val(data[8]);
      });

    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#button_puntaje').click(function() {
        var datos = $('#frmajax').serialize();
        $.ajax({
          type: "POST",
          url: "procesos/calcular_puntaje_cas.php",
          data: datos,
          success: function(r) {
            console.log("Mensaje: ", r);
            const respuesta = JSON.parse(r);
            console.log("JSON: ", respuesta);
            console.log("Mi r: ", respuesta.r);
            if (respuesta.r == 1) {
              Swal.fire({
                title: 'PUNTAJE CALCULADO',
                text: respuesta.mensaje,
                icon: 'success',
                confirmButtonText: 'Aceptar'
              }).then(function() {
                window.location = "listado_postu_cas.php?idcon=" + respuesta.idcon + "&idpersonal=" + respuesta.idpersonal + "&dni=" + respuesta.dni + "#totales";
              });
            } else {
              Swal.fire({
                title: 'ERROR AL CALCULAR',
                text: respuesta.mensaje,
                icon: 'error',
                confirmButtonText: 'Aceptar',
              });
            }
          }
        });
        return false;
      });
    });
  </script>

</body>

</html>s