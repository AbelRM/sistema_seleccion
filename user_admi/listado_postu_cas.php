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

  <title>Listado de postulantes CAS - SISTEMA SELECCIÓN DIRESA TACNA</title>

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
    $dni = $_GET['dni'];
    $dato_desencriptado = $_GET['dni'];
    // $dni = $desencriptar($dato_desencriptado);
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
          <?php
          $consul_tabla = "SELECT * FROM personal_req Inner join convocatoria ON personal_req.convocatoria_idcon = convocatoria.idcon 
          INNER JOIN cargo_full ON personal_req.cargo_idcargo = cargo_full.idcargo WHERE convocatoria_idcon = '$idcon' AND idpersonal='$idpersonal'";
          $query = mysqli_query($con, $consul_tabla);
          $ar_tabla = MySQLI_fetch_array($query);
          ?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">LISTADO DE POSTULANTES DE LA CONVOCATORIA CAS Nº <?php echo $ar_tabla['num_con'] . ' - ' . $ar_tabla['anio_con'] . ' / ' . $ar_tabla['cargo'] ?></h6>
            </div>
            <div class="card-body">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="curricular-tab" data-toggle="tab" href="#curricular" role="tab" aria-controls="curricular" aria-selected="true">
                    <div class="font-weight-bold">Evaluacion Curricular</div>
                  </a>
                </li>
                <!-- <li class="nav-item" role="presentation">
                  <a class="nav-link" id="conocimiento-tab" data-toggle="tab" href="#conocimiento" role="tab" aria-controls="conocimiento" aria-selected="false">
                    <div class="font-weight-bold">Evaluación Conocimiento</div>
                  </a>
                </li> -->
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="entrevista-tab" data-toggle="tab" href="#entrevista" role="tab" aria-controls="entrevista" aria-selected="false">
                    <div class="font-weight-bold">Evaluación Entrevista</div>
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="final-tab" data-toggle="tab" href="#final" role="tab" aria-controls="final" aria-selected="false">
                    <div class="font-weight-bold">Reporte Final</div>
                  </a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="curricular" role="tabpanel" aria-labelledby="curricular-tab">
                  <?php
                  $sql = "SELECT * FROM postulante INNER JOIN convocatoria 
                  ON postulante.id_convocatoria = convocatoria.idcon INNER JOIN personal_req 
                  ON postulante.post_id_personal_req = personal_req.idpersonal INNER JOIN cargo_full 
                  ON personal_req.cargo_idcargo = cargo_full.idcargo INNER JOIN detalle_convocatoria ON 
                  detalle_convocatoria.postulante_idpostulante = postulante.idpostulante
                  WHERE id_convocatoria = '$idcon' AND post_id_personal_req = '$idpersonal'";
                  $query = mysqli_query($con, $sql);
                  $row = MySQLI_fetch_array($query)
                  ?>
                  <div class="row m-2">
                    <div class="col-md-4 col-sm-12 d-flex justify-content-center">
                      <a href="reportes_diresa/relacion_postulantes.php?&idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-primary btn-sm m-1"><i class="far fa-file-pdf"></i> Reporte Postulantes</button></a>
                    </div>
                    <div class="col-md-4 col-sm-12 d-flex justify-content-center">
                      <a href="reportes_diresa/resultado_curricular_no_aptos.php?idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-danger btn-sm m-1"><i class="far fa-file-pdf"></i> Reporte Evaluación Curricular Total</button></a>
                    </div>
                    <div class="col-md-4 col-sm-12 d-flex justify-content-center">
                      <a href="reportes_diresa/resultado_curricular_aptos.php?idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-success btn-sm m-1"><i class="far fa-file-pdf"></i> Reporte Evaluación Curricular Aptos</button></a>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th style="display: none;">id</th>
                          <th>N°</th>
                          <th>Datos postulante</th>
                          <th>Datos convocatoria</th>
                          <th>Estado postulante</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        $query = mysqli_query($con, $sql);
                        while ($row = MySQLI_fetch_array($query)) {
                        ?>
                          <tr>
                            <td style="display: none;"><?php echo $row['idpostulante'] ?></td>
                            <td><?php echo $i ?></td>
                            <td style="font-size: 12px;">
                              <small style="font-weight:700; font-size: 12px;">DNI: </small><?php echo $row['dni'] ?><br>
                              <small style="font-weight:700; font-size: 12px;">Nombre: </small><?php echo $row['nombres'] . ' ' . $row['ape_pat'] . ' ' . $row['ape_mat']  ?>
                            </td>
                            <td style="font-size: 12px;">
                              <small style="font-weight:700; font-size: 12px;">Nro convocatoria: </small><?php echo $row['num_con'] . ' - ' . $row['anio_con'] . ' / ' . $row['tipo_con'] ?><br>
                              <small style="font-weight:700; font-size: 12px;">Cargo requerido: </small><?php echo $row['cargo'] ?><br>
                              <small style="font-weight:700; font-size: 12px;">Cargo especifico: </small><?php echo $row['nomb_cargo_espec'] ?>
                            </td>
                            <td style="font-size: 12px;">
                              <small style="font-weight:700; font-size: 12px;">Estado del postulante: </small><?php echo $row['estado_conv_cas'] ?><br>
                              <small style="font-weight:700; font-size: 12px;">Estado Eva. curricular: </small><?php echo $row['estado_eva_curri_cas'] ?><br>
                              <small style="font-weight:700; font-size: 12px;">Estado Entrevista: </small><?php echo $row['estado_entrevista_cas'] ?>
                            </td>
                            <td>
                              <a href="detalles_postulante_cas.php?idpostulante=<?php echo $row['idpostulante'] ?>&idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>"><button type="button" class="btn btn-success btn-sm"><i class="fas fa-search-plus"></i> Evaluar CV</button></a>
                            </td>
                          </tr>
                        <?php
                          $i++;
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- <div class="tab-pane fade" id="conocimiento" role="tabpanel" aria-labelledby="conocimiento-tab">
                  <h5>No hay examen de conocimiento para esta convocatoria</h5>
                </div> -->
                <div class="tab-pane fade" id="entrevista" role="tabpanel" aria-labelledby="entrevista-tab">
                  <div class="row m-2">
                    <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                      <a href="reportes_diresa/resultado_final_v1.php?idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-primary btn-sm m-1"><i class="far fa-file-pdf"></i> Reporte Resultado Entrevista APTOS</button></a>
                    </div>
                    <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                      <a href="reportes_diresa/resultado_final_v2.php?idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-success btn-sm m-1"><i class="far fa-file-pdf"></i> Reporte Resultado Entrevista TOTAL</button></a>
                    </div>
                  </div>
                  <?php
                  $sql = "SELECT * FROM detalle_convocatoria inner join postulante 
                  on detalle_convocatoria.postulante_idpostulante=postulante.idpostulante
                  Inner join personal_req 
                  on detalle_convocatoria.personal_req_idpersonal=personal_req.idpersonal 
                  inner join convocatoria on detalle_convocatoria.convocatoria_idcon=convocatoria.idcon
                  INNER JOIN evaluacion_curri_cas ON detalle_convocatoria.id_eva_curri_cas=evaluacion_curri_cas.id_eva_curricular
                  WHERE detalle_convocatoria.convocatoria_idcon = '$idcon' AND personal_req_idpersonal = '$idpersonal' AND estado_conv_cas = 'APTO'";
                  $query = mysqli_query($con, $sql);
                  $row = MySQLI_fetch_array($query);
                  ?>
                  <ul class="nav nav-tabs" id="myTab_2" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="aptos-tab" data-toggle="tab" href="#aptos" role="tab" aria-controls="aptos" aria-selected="true">
                        <div class="font-weight-bold">Lista de postulantes APTOS</div>
                      </a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a class="nav-link" id="totales-tab" data-toggle="tab" href="#totales" role="tab" aria-controls="totales" aria-selected="false">
                        <div class="font-weight-bold">Lista de depostulantes TOTAL</div>
                      </a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="aptos" role="tabpanel" aria-labelledby="aptos-tab">
                      <div class="table-responsive m-2">
                        <table class="table table-bordered" id="dataTable_2" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th style="display: none;"></th>
                              <th>N°</th>
                              <th>Datos postulante</th>
                              <th>Puntajes detallados</th>
                              <th>Puntaje Curricular</th>
                              <th>Estados</th>
                              <th>Acción</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql = "SELECT * FROM detalle_convocatoria inner join postulante 
                            on detalle_convocatoria.postulante_idpostulante=postulante.idpostulante
                            Inner join personal_req 
                            on detalle_convocatoria.personal_req_idpersonal=personal_req.idpersonal 
                            inner join convocatoria on detalle_convocatoria.convocatoria_idcon=convocatoria.idcon
                            INNER JOIN evaluacion_curri_cas ON detalle_convocatoria.id_eva_curri_cas=evaluacion_curri_cas.id_eva_curricular
                            WHERE detalle_convocatoria.convocatoria_idcon = '$idcon' AND personal_req_idpersonal = '$idpersonal' AND estado_conv_cas = 'APTO'";
                            $i = 1;
                            $query = mysqli_query($con, $sql);
                            while ($row = MySQLI_fetch_array($query)) {
                            ?>
                              <tr>
                                <td style="display: none;"><?php echo $row['iddetalle_convocatoria'] ?></td>
                                <td><?php echo $i ?></td>
                                <td style="font-size: 12px;">
                                  <small style="font-weight:700; font-size: 12px;">DNI: </small><?php echo $row['dni'] ?><br>
                                  <small style="font-weight:700; font-size: 12px;">Nombre: </small><br><?php echo $row['nombres'] . ' ' . $row['ape_pat'] . ' ' . $row['ape_mat']  ?>
                                </td>
                                <td style="font-size: 14px;">
                                  <small style="font-weight:700; font-size: 14px;">Puntaje Formación:</small><br><?php echo $row['punt_total_forma'] ?> Puntos<br>
                                  <small style="font-weight:700; font-size: 14px;">Puntaje Capacitaciones</small><br><?php echo $row['punt_total_cursos'] ?> Puntos<br>
                                  <small style="font-weight:700; font-size: 14px;">Puntaje Exp. laboral total</small><br><?php echo $row['punt_total_expe'] ?> Puntos
                                </td>
                                <td style="font-size: 14px;"><?php echo $row['puntaje_total_total'] ?> Puntos</td>
                                <td style="font-size: 14px;">
                                  <small style="font-weight:700; font-size: 14px;">Estado postulante: </small><?php echo $row['estado_conv_cas'] ?><br>
                                  <small style="font-weight:700; font-size: 14px;">Estado curricular: </small><?php echo $row['estado_eva_curri_cas'] ?><br>
                                  <small style="font-weight:700; font-size: 14px;">Estado entrevista: </small><?php echo $row['estado_entrevista_cas'] ?><br>
                                  <small style="font-weight:700; font-size: 14px;">Estado eval. final: </small><?php echo $row['estado_resultado_final'] ?><br>
                                </td>
                                <td>
                                  <!-- <a href="agregar_entrevista_cas.php?idpostulante=<?php echo $row['idpostulante'] ?>&idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>"><button type="button" class="btn btn-success btn-sm m-1"><i class="far fa-plus-square"></i> Entrevista</button></a> -->
                                  <a href="reportes_diresa/ficha_entrevista_personal.php?idpostulante=<?php echo $row['idpostulante'] ?>&idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-info btn-sm m-1"><i class="far fa-file-pdf"></i> Reporte Entrevista</button></a>
                                </td>
                              </tr>
                            <?php
                              $i++;
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane fade m-3" id="totales" role="tabpanel" aria-labelledby="totales-tab">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable_3" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th style="display: none;">id_detalle_conv_prac</th>
                              <th>N°</th>
                              <th>Datos postulante</th>
                              <th>Puntajes detallados</th>
                              <th>Puntaje</th>
                              <th>Estado</th>
                              <th>Acción</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql = "SELECT * FROM detalle_convocatoria inner join postulante 
                            on detalle_convocatoria.postulante_idpostulante=postulante.idpostulante
                            Inner join personal_req 
                            on detalle_convocatoria.personal_req_idpersonal=personal_req.idpersonal 
                            inner join convocatoria on detalle_convocatoria.convocatoria_idcon=convocatoria.idcon
                            INNER JOIN evaluacion_curri_cas ON detalle_convocatoria.id_eva_curri_cas=evaluacion_curri_cas.id_eva_curricular
                            WHERE detalle_convocatoria.convocatoria_idcon = '$idcon' AND personal_req_idpersonal = '$idpersonal'";
                            $i = 1;
                            $query = mysqli_query($con, $sql);
                            while ($row = MySQLI_fetch_array($query)) {
                            ?>
                              <tr>
                                <td style="display: none;"><?php echo $row['iddetalle_conv_prac'] ?></td>
                                <td><?php echo $i ?></td>
                                <td style="font-size: 12px;">
                                  <small style="font-weight:700; font-size: 12px;">DNI: </small><?php echo $row['dni'] ?><br>
                                  <small style="font-weight:700; font-size: 12px;">Nombre: </small><br><?php echo $row['nombres'] . ' ' . $row['ape_pat'] . ' ' . $row['ape_mat']  ?>
                                </td>
                                <td style="font-size: 12px;">
                                  <div class="row">
                                    <div class="col-6">
                                      <small style="font-weight:700; font-size: 12px;">Formación:</small><br><?php echo $row['punt_total_forma'] ?> Puntos<br>
                                      <small style="font-weight:700; font-size: 12px;">Idioma/Comput.</small><br><?php echo $row['idioma_compu'] ?> Puntos<br>
                                      <small style="font-weight:700; font-size: 12px;">Capacitaciones</small><br><?php echo $row['punt_total_cursos'] ?> Puntos

                                    </div>
                                    <div class="col-6">
                                      <small style="font-weight:700; font-size: 12px;">Exp. laboral total</small><br><?php echo $row['punt_total_expe'] ?> Puntos<br>
                                      <small style="font-weight:700; font-size: 12px;">Exp. laboral (4 puntos)</small><br><?php echo $row['expe_laboral_cuatro'] ?> Puntos<br>
                                      <small style="font-weight:700; font-size: 12px;">Exp. laboral (3 puntos)</small><br><?php echo $row['expe_laboral_tres'] ?> Puntos<br>
                                      <small style="font-weight:700; font-size: 12px;">Exp. laboral (1 puntos)</small><br><?php echo $row['expe_laboral_uno'] ?> Puntos<br>
                                    </div>
                                  </div>
                                </td>
                                <td style="font-size: 12px;"><?php echo $row['puntaje_total_total'] ?> Puntos</td>
                                <td style="font-size: 12px;">
                                  <small style="font-weight:700; font-size: 12px;">Estado postulante: </small><?php echo $row['estado_conv_cas'] ?><br>
                                  <small style="font-weight:700; font-size: 12px;">Estado curricular: </small><?php echo $row['estado_eva_curri_cas'] ?><br>
                                  <small style="font-weight:700; font-size: 12px;">Estado entrevista: </small><?php echo $row['estado_entrevista_cas'] ?><br>
                                  <small style="font-weight:700; font-size: 12px;">Estado eval. final: </small><?php echo $row['estado_resultado_final'] ?><br>
                                </td>
                                <td>
                                  <!-- <a href="agregar_entrevista_cas.php?idpostulante=<?php echo $row['idpostulante'] ?>&idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>"><button type="button" class="btn btn-success btn-sm m-1"><i class="far fa-plus-square"></i> Entrevista</button></a><br>
                                  <a href="reportes_diresa/ficha_entrevista_personal.php?idpostulante=<?php echo $row['idpostulante'] ?>&idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-info btn-sm m-1"><i class="far fa-file-pdf"></i> Reporte Entrevista</button></a><br> -->

                                  <a href="mas_detalles_postulante_cas.php?idpostulante=<?php echo $row['idpostulante'] ?>&idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>"><button type="button" class="btn btn-success btn-sm"><i class="fas fa-search-plus"></i> Evaluar CV</button></a>
                                </td>
                              </tr>
                            <?php
                              $i++;
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="final" role="tabpanel" aria-labelledby="final-tab">
                  <div class="row m-2">
                    <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                      <a href="reportes_diresa/resultado_final_v1.php?idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-primary btn-sm m-1"><i class="far fa-file-pdf"></i> Reporte Resultado Final</button></a>
                    </div>
                    <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                      <a href="reportes_diresa/resultado_final_v2.php?idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-success btn-sm m-1"><i class="far fa-file-pdf"></i> Reporte Resultado ASISTENCIAL</button></a>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable_4" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th style="display: none;">id_detalle_conv_prac</th>
                          <th>N°</th>
                          <th>Datos postulante</th>
                          <th>Puntajes convocatoria</th>
                          <th>Estados</th>
                          <th>Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM detalle_convocatoria inner join postulante 
                        on detalle_convocatoria.postulante_idpostulante=postulante.idpostulante
                        Inner join personal_req 
                        on detalle_convocatoria.personal_req_idpersonal=personal_req.idpersonal 
                        inner join convocatoria on detalle_convocatoria.convocatoria_idcon=convocatoria.idcon
                        INNER JOIN evaluacion_curri_cas ON detalle_convocatoria.id_eva_curri_cas=evaluacion_curri_cas.id_eva_curricular INNER JOIN entrevista_cas ON detalle_convocatoria.id_entrevista_cas = entrevista_cas.id_entrevista_cas INNER JOIN resultado_final ON detalle_convocatoria.id_resultado_final = resultado_final.idresultado_final
                        WHERE detalle_convocatoria.convocatoria_idcon = '$idcon' AND personal_req_idpersonal = '$idpersonal' AND estado_conv_cas = 'APTO'";
                        $i = 1;
                        $query = mysqli_query($con, $sql);
                        while ($row = MySQLI_fetch_array($query)) {
                        ?>
                          <tr>
                            <td style="display: none;"><?php echo $row['iddetalle_convocatoria'] ?></td>
                            <td><?php echo $i ?></td>
                            <td style="font-size: 12px;">
                              <small style="font-weight:700; font-size: 12px;">DNI: </small><?php echo $row['dni'] ?><br>
                              <small style="font-weight:700; font-size: 12px;">Nombre: </small><?php echo $row['nombres'] . ' ' . $row['ape_pat'] . ' ' . $row['ape_mat']  ?>
                            </td>
                            <td style="font-size: 14px;">
                              <small style="font-weight:700; font-size: 14px;">Puntaje Curricular: </small><?php echo $row['ponderado_cv'] ?> Puntos<br>
                              <small style="font-weight:700; font-size: 14px;">Puntaje Entrevista: </small><?php echo $row['ponderado_entre'] ?> Puntos<br>
                              <small style="font-weight:700; font-size: 14px;">Puntaje Final: </small><?php echo $row['puntaje_final_total'] ?>
                            </td>
                            <td style="font-size: 14px;">
                              <small style="font-weight:700; font-size: 14px;">Estado postulante: </small><?php echo $row['estado_conv_cas'] ?><br>
                              <small style="font-weight:700; font-size: 14px;">Estado curricular: </small><?php echo $row['estado_eva_curri_cas'] ?><br>
                              <small style="font-weight:700; font-size: 14px;">Estado entrevista: </small><?php echo $row['estado_entrevista_cas'] ?><br>
                              <small style="font-weight:700; font-size: 14px;">Estado resultado final: </small><?php echo $row['estado_resultado_final'] ?><br>
                            </td>
                            <td>
                              <a href="reportes_diresa/resultado_final_v2.php?idcon=<?php echo $idcon ?>&idpersonal=<?php echo $idpersonal ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-success btn-sm m-1"><i class="far fa-file-pdf"></i> Reporte puntaje</button></a>
                            </td>
                          </tr>
                        <?php
                          $i++;
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="row d-flex justify-content-center m-3">
                <a href="elegir_conv_cal.php?dni=<?php echo $dni ?>#home" type="button" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i></i> Retroceder</a>
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
  <script src="js/tradu_tabla.js"></script>
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

    //opcion 2
    $('#myTab_2 a').click(function(e) {
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
    $('#myTab_2 a[href="' + hash + '"]').tab('show');
  </script>
</body>

</html>