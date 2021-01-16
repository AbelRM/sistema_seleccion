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

  <title>Listado de postulantes para practicante - DIRESA TACNA</title>

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
    $idpracticas = $_GET['idpracticas'];
    $idpracticantes_req = $_GET['idpracticantes_req'];


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
            <?php
            $consul_prac_req = "SELECT * FROM practicantes_req inner join practicas
            on practicantes_req.conv_idpracticas=practicas.idpracticas
            WHERE conv_idpracticas = '$idpracticas' AND idpracticantes_req = '$idpracticantes_req'";
            $query = mysqli_query($con, $consul_prac_req);
            $rw_prac_req = MySQLI_fetch_array($query);
            ?>
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">LISTADO DE POSTULANTES DE LA CONVOCATORIA DE PRACTICAS Nº <?php echo $rw_prac_req['num_convoc'] . ' - ' . $rw_prac_req['anio_convoc'] . ' / ' . $rw_prac_req['tipo_practicante'] ?></h6>
            </div>
            <div class="card-body">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                    <div class="font-weight-bold">Evaluacion Curricular</div>
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                    <div class="font-weight-bold">Evaluación Entrevista</div>
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
                    <div class="font-weight-bold">Reporte Final</div>
                  </a> </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="row m-2">
                    <div class="col-md-4 col-sm-12 d-flex justify-content-center">
                      <a href="reportes_diresa/relacion_postulantes_prac.php?&idpracticas=<?php echo $idpracticas ?>&idpracticantes_req=<?php echo $idpracticantes_req ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-primary btn-sm m-1"><i class="far fa-file-pdf"></i> Reporte Postulantes</button></a>
                    </div>
                    <div class="col-md-4 col-sm-12 d-flex justify-content-center">
                      <a href="reportes_diresa/resultado_curricular_aptos_prac.php?idpracticas=<?php echo $idpracticas ?>&idpracticantes_req=<?php echo $idpracticantes_req ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-success btn-sm m-1"><i class="far fa-file-pdf"></i> Reporte Eva. Curricular Aptos</button></a>
                    </div>
                    <div class="col-md-4 col-sm-12 d-flex justify-content-center">
                      <a href="reportes_diresa/resultado_curricular_total_prac.php?idpracticas=<?php echo $idpracticas ?>&idpracticantes_req=<?php echo $idpracticantes_req ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-danger btn-sm m-1"><i class="far fa-file-pdf"></i> Reporte Eva. Curricular Total</button></a>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th style="display: none;">id</th>
                          <th>N°</th>
                          <th>Datos postulante</th>
                          <th>Nº convocatoria</th>
                          <th>Datos personal req.</th>
                          <th>Estados</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM postulante INNER JOIN practicas 
                        ON postulante.id_practicas = practicas.idpracticas INNER JOIN practicantes_req 
                        ON postulante.post_id_practicantes_req = practicantes_req.idpracticantes_req INNER JOIN detalle_conv_prac ON detalle_conv_prac.detalle_prac_idpostulante = postulante.idpostulante INNER JOIN formacion_acad_prac ON formacion_acad_prac.formacion_acad_prac_idpostulante = postulante.idpostulante
                        WHERE id_practicas = '$idpracticas' AND post_id_practicantes_req = '$idpracticantes_req'";
                        $i = 1;
                        $query = mysqli_query($con, $sql);
                        while ($row = MySQLI_fetch_array($query)) {
                        ?>
                          <tr>
                            <td style="display: none;"><?php echo $row['idpostulante'] ?></td>
                            <td><?php echo $i ?></td>
                            <td style="font-size: 14px;">
                              <small style="font-weight:700; font-size: 13px;">DNI: </small><?php echo $row['dni'] ?><br>
                              <small style="font-weight:700; font-size: 13px;">Postulante:</small><br><?php echo $row['nombres'] . ' ' . $row['ape_pat'] . ' ' . $row['ape_mat']  ?><br>
                              <small style="font-weight:700; font-size: 13px;">Carrera postulante:</small><br><?php echo $row['carrera'] ?>
                            </td>
                            <td style="font-size: 14px;"><?php echo $row['num_convoc'] . ' - ' . $row['anio_convoc'] ?></td>
                            <td style="font-size: 14px;">
                              <small style="font-weight:700; font-size: 13px;">Tipo practicante req.: </small><br><?php echo $row['tipo_practicante'] ?><br>
                              <small style="font-weight:700; font-size: 13px;">Carrera requerida:</small><br><?php echo $row['carrera_prof'] ?>
                            </td>
                            <td style="font-size: 14px;">
                              <small style="font-weight:700; font-size: 13px;">Estado curricular:</small><br><?php echo $row['estado_conv_prac'] ?><br>
                              <small style="font-weight:700; font-size: 13px;">Estado entrevista:</small><br><?php echo $row['estado_entrevista'] ?>
                            </td>
                            <td>
                              <a href="detalles_postulante_prac.php?idpostulante=<?php echo $row['idpostulante'] ?>&practicas_idcon=<?php echo $idpracticas ?>&practicante_req=<?php echo $idpracticantes_req ?>&dni=<?php echo $dato_desencriptado ?>"><button type="button" class="btn btn-success btn-sm"><i class="fas fa-search-plus"></i> Evaluar CV</button></a>
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
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <ul class="nav nav-tabs m-3" id="myTab_2" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="aptos-tab" data-toggle="tab" href="#aptos" role="tab" aria-controls="aptos" aria-selected="true">
                        <div class="font-weight-bold">LISTA DE APTOS CON PUNTAJE</div>
                      </a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a class="nav-link" id="totales-tab" data-toggle="tab" href="#totales" role="tab" aria-controls="totales" aria-selected="false">
                        <div class="font-weight-bold">LISTA TOTAL CON PUNTAJE</div>
                      </a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="aptos" role="tabpanel" aria-labelledby="aptos-tab">
                      <div class="row m-2">
                        <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                          <a href="reportes_diresa/resultado_cv_entre_prac_aptos.php?idpracticas=<?php echo $idpracticas ?>&idpracticantes_req=<?php echo $idpracticantes_req ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank">
                          <button type="button" class="btn btn-primary btn-sm m-1"><i class="far fa-file-pdf"></i> Reporte Resultado Entrevista APTOS</button>
                        </a>
                        </div>
                      </div>
                      <div class="table-responsive m-2">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th style="display: none;">id_detalle_conv_prac</th>
                              <th>N°</th>
                              <th>D.N.I.</th>
                              <th>Postulante</th>
                              <th>Puntajes detallados</th>
                              <th>Puntaje Total</th>
                              <th>Estado</th>
                              <th>Acción</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql = "SELECT * FROM detalle_conv_prac inner join postulante 
                            on detalle_conv_prac.detalle_prac_idpostulante=postulante.idpostulante
                            Inner join practicantes_req 
                            on detalle_conv_prac.practicantel_req_idpracticantes_req=practicantes_req.idpracticantes_req 
                            inner join practicas on detalle_conv_prac.idpracticas_conv=practicas.idpracticas  WHERE idpracticas_conv = '$idpracticas' AND practicantel_req_idpracticantes_req = '$idpracticantes_req' AND estado_conv_prac = 'APTO'";
                            $i = 1;
                            $query = mysqli_query($con, $sql);
                            while ($row = MySQLI_fetch_array($query)) {
                            ?>
                              <tr>
                                <td style="display: none;"><?php echo $row['iddetalle_conv_prac'] ?></td>
                                <td><?php echo $i ?></td>
                                <td style="font-size: 14px;"><?php echo $row['dni'] ?></td>
                                <td style="font-size: 14px;"><?php echo $row['nombres'] . ' ' . $row['ape_pat'] . ' ' . $row['ape_mat']  ?></td>
                                <td style="font-size: 14px;">
                                  <div class="row">
                                    <div class="col-6">
                                      <small style="font-weight:700; font-size: 14px;">Puntaje Formación = </small><?php echo $row['puntos_form'] ?><br>
                                      <small style="font-weight:700; font-size: 14px;">Puntaje Cursos = </small><?php echo $row['puntos_cursos'] ?><br>
                                      <small style="font-weight:700; font-size: 14px;">Puntaje Mérito = </small><?php echo $row['puntos_ubi'] ?>
                                    </div>
                                    <div class="col-6">
                                      <small style="font-weight:700; font-size: 14px;">Puntaje Computación = </small><?php echo $row['puntos_comp'] ?><br>
                                      <small style="font-weight:700; font-size: 14px;">Puntaje Idioma = </small><?php echo $row['puntos_idioma'] ?><br>
                                      <small style="font-weight:700; font-size: 14px;">Puntaje Ética = </small><?php echo $row['puntos_lider'] ?>
                                    </div>
                                  </div>
                                </td>
                                <td style="font-size: 14px;"><?php echo $row['puntos_total_cv'] ?> puntos</td>
                                <td style="font-size: 14px;">
                                  <small style="font-weight:700; font-size: 14px;">Estado postulante: </small><?php echo $row['estado_conv_prac'] ?><br>
                                  <small style="font-weight:700; font-size: 14px;">Estado entrevista: </small><?php echo $row['estado_entrevista'] ?><br>
                                </td>
                                <td>
                                  <a href="agregar_entrevista_prac.php?idpostulante=<?php echo $row['detalle_prac_idpostulante'] ?>&practicas_idcon=<?php echo $idpracticas ?>&practicante_req=<?php echo $idpracticantes_req ?>&dni=<?php echo $dato_desencriptado ?>"><button type="button" class="btn btn-primary btn-sm m-1"><i class="fas fa-search-plus"></i> Entrevista</button></a>
                                  <a href="reportes_diresa/ficha_entrevista_personal_prac.php?idpostulante=<?php echo $row['detalle_prac_idpostulante'] ?>&practicas_idcon=<?php echo $idpracticas ?>&practicante_req=<?php echo $idpracticantes_req ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-info btn-sm m-1"><i class="far fa-file-pdf"></i> Reporte Entrevista</button></a>
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
                    <div class="tab-pane fade" id="totales" role="tabpanel" aria-labelledby="totales-tab">
                      <div class="row m-2">
                        <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                          <a href="reportes_diresa/resultado_cv_entre_prac_total.php?idpracticas=<?php echo $idpracticas ?>&idpracticantes_req=<?php echo $idpracticantes_req ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-primary btn-sm m-1"><i class="far fa-file-pdf"></i> Reporte Resultado Entrevista TOTAL</button></a>
                        </div>
                      </div>
                      <div class="table-responsive m-2">
                        <table class="table table-bordered" id="dataTable_2" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th style="display: none;">id_detalle_conv_prac</th>
                              <th>N°</th>
                              <th>Datos postulante</th>
                              <th>Puntajes detallados</th>
                              <th>Puntaje Curricular</th>
                              <th>Estado</th>
                              <th>Acción</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql = "SELECT * FROM detalle_conv_prac inner join postulante 
                            on detalle_conv_prac.detalle_prac_idpostulante=postulante.idpostulante
                            Inner join practicantes_req 
                            on detalle_conv_prac.practicantel_req_idpracticantes_req=practicantes_req.idpracticantes_req 
                            inner join practicas on detalle_conv_prac.idpracticas_conv=practicas.idpracticas  WHERE idpracticas_conv = '$idpracticas' AND practicantel_req_idpracticantes_req = '$idpracticantes_req'";
                            $i = 1;
                            $query = mysqli_query($con, $sql);
                            while ($row = MySQLI_fetch_array($query)) {
                            ?>
                              <tr>
                                <td style="display: none;"><?php echo $row['iddetalle_conv_prac'] ?></td>
                                <td><?php echo $i ?></td>
                                <td style="font-size: 14px;">
                                  <small style="font-weight:700; font-size: 14px;">DNI: </small><?php echo $row['dni'] ?><br>
                                  <small style="font-weight:700; font-size: 14px;">Postulante: </small><?php echo $row['nombres'] . ' ' . $row['ape_pat'] . ' ' . $row['ape_mat']  ?>
                                </td>
                                <td style="font-size: 14px;">
                                  <div class="row">
                                    <div class="col-6">
                                      <small style="font-weight:700; font-size: 14px;">Formación = </small><?php echo $row['puntos_form'] ?><br>
                                      <small style="font-weight:700; font-size: 14px;">Cursos = </small><?php echo $row['puntos_cursos'] ?><br>
                                      <small style="font-weight:700; font-size: 14px;">Mérito = </small><?php echo $row['puntos_ubi'] ?>
                                    </div>
                                    <div class="col-6">
                                      <small style="font-weight:700; font-size: 14px;">Computación = </small><?php echo $row['puntos_comp'] ?><br>
                                      <small style="font-weight:700; font-size: 14px;">Idioma = </small><?php echo $row['puntos_idioma'] ?><br>
                                      <small style="font-weight:700; font-size: 14px;">Ética = </small><?php echo $row['puntos_lider'] ?>
                                    </div>
                                  </div>
                                </td>
                                <td style="font-size: 14px;">
                                  <small style="font-weight:700; font-size: 14px;">Total Curricular: </small><?php echo $row['puntos_total_cv'] ?><br>
                                  <small style="font-weight:700; font-size: 14px;">Total Entrevita: </small><?php echo $row['puntaje_entrevista'] ?><br>
                                  <small style="font-weight:700; font-size: 14px;">Total CV + Entrevista: </small><br><?php echo $row['puntos_total_cv'] ?><br>
                                  <small style="font-weight:700; font-size: 14px;">Prom. CV + Entrevista: </small><br><?php echo $row['puntaje_total_total'] ?>
                                </td>
                                <td style="font-size: 14px;"><?php echo $row['estado_conv_prac'] ?></td>
                                <td>
                                  <a href="mas_detalles_postulante_prac.php?idpostulante=<?php echo $row['detalle_prac_idpostulante'] ?>&practicas_idcon=<?php echo $idpracticas ?>&practicante_req=<?php echo $idpracticantes_req ?>&dni=<?php echo $dato_desencriptado ?>"><button type="button" class="btn btn-success btn-sm"><i class="fas fa-search-plus"></i> Evaluar CV</button></a><br>
                                  <!-- <a href="agregar_entrevista_prac.php?idpostulante=<?php echo $row['detalle_prac_idpostulante'] ?>&practicas_idcon=<?php echo $idpracticas ?>&practicante_req=<?php echo $idpracticantes_req ?>&dni=<?php echo $dato_desencriptado ?>"><button type="button" class="btn btn-primary btn-sm m-1"><i class="fas fa-search-plus"></i> Entrevista</button></a><br>
                                  <a href="reportes_diresa/ficha_entrevista_personal_prac.php?idpostulante=<?php echo $row['detalle_prac_idpostulante'] ?>&practicas_idcon=<?php echo $idpracticas ?>&practicante_req=<?php echo $idpracticantes_req ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-info btn-sm m-1"><i class="far fa-file-pdf"></i> Reporte Entrevista</button></a> -->
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
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                  <div class="row m-2">
                    <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                      <a href="reportes_diresa/resultado_final_v1_prac.php?idpracticas=<?php echo $idpracticas ?>&idpracticantes_req=<?php echo $idpracticantes_req ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><button type="button" class="btn btn-primary btn-sm m-1"><i class="far fa-file-pdf"></i> Reporte Resultado Final APTOS</button></a>
                    </div>
                  </div>
                  <div class="table-responsive m-2">
                    <table class="table table-bordered" id="dataTable_3" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th style="display: none;">id_detalle_conv_prac</th>
                          <th>N°</th>
                          <th>Datos postulante</th>
                          <th>Puntajes Curricular</th>
                          <th>Puntaje Entrevista</th>
                          <th>Estado</th>
                          <th>Acción</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM detalle_conv_prac inner join postulante 
                            on detalle_conv_prac.detalle_prac_idpostulante=postulante.idpostulante
                            Inner join practicantes_req 
                            on detalle_conv_prac.practicantel_req_idpracticantes_req=practicantes_req.idpracticantes_req 
                            inner join practicas on detalle_conv_prac.idpracticas_conv=practicas.idpracticas INNER JOIN entrevista_prac ON detalle_conv_prac.detalle_conv_prac_identrevista_prac = entrevista_prac.id_entrevista_prac WHERE idpracticas_conv = '$idpracticas' AND practicantel_req_idpracticantes_req = '$idpracticantes_req' AND estado_conv_prac = 'APTO'";
                        $i = 1;
                        $query = mysqli_query($con, $sql);
                        while ($row = MySQLI_fetch_array($query)) {
                        ?>
                          <tr>
                            <td style="display: none;"><?php echo $row['iddetalle_conv_prac'] ?></td>
                            <td><?php echo $i ?></td>
                            <td style="font-size: 12px;">
                              <small style="font-weight:700; font-size: 12px;">DNI: </small><?php echo $row['dni'] ?><br>
                              <small style="font-weight:700; font-size: 12px;">Postulante: </small><br><?php echo $row['nombres'] . ' ' . $row['ape_pat'] . ' ' . $row['ape_mat']  ?>
                            </td>
                            <td style="font-size: 12px;">
                              <div class="row">
                                <div class="col-6">
                                  <small style="font-weight:700; font-size: 12px;">Puntaje Formación = </small><?php echo $row['puntos_form'] ?><br>
                                  <small style="font-weight:700; font-size: 12px;">Puntaje Cursos = </small><?php echo $row['puntos_cursos'] ?><br>
                                  <small style="font-weight:700; font-size: 12px;">Puntaje Mérito = </small><?php echo $row['puntos_ubi'] ?>
                                </div>
                                <div class="col-6">
                                  <small style="font-weight:700; font-size: 12px;">Puntaje Computación = </small><?php echo $row['puntos_comp'] ?><br>
                                  <small style="font-weight:700; font-size: 12px;">Puntaje Idioma = </small><?php echo $row['puntos_idioma'] ?><br>
                                  <small style="font-weight:700; font-size: 12px;">Puntaje Ética = </small><?php echo $row['puntos_lider'] ?><br>
                                  <small style="font-weight:700; font-size: 12px;">Puntaje Curricular Total = </small><?php echo $row['puntos_total_cv'] ?>
                                </div>
                              </div>
                            </td>
                            <td style="font-size: 12px;">
                              <small style="font-weight:700; font-size: 12px;">Aspecto Personal = </small><?php echo $row['aspecto_personal'] ?><br>
                              <small style="font-weight:700; font-size: 12px;">Seguridad y estabilidad = </small><?php echo $row['seguridad_estabilidad'] ?><br>
                              <small style="font-weight:700; font-size: 12px;">Etica = </small><?php echo $row['etica'] ?><br>
                              <small style="font-weight:700; font-size: 12px;">Competencias = </small><?php echo $row['competencias'] ?><br>
                              <small style="font-weight:700; font-size: 12px;">Conocimiento = </small><?php echo $row['conoc_academico'] ?><br>
                              <small style="font-weight:700; font-size: 12px;">Puntaje Entrevista Total = </small><br><?php echo $row['puntaje_total_entre'] ?>
                            </td>
                            <td style="font-size: 12px;">
                              <small style="font-weight:700; font-size: 12px;">Estado postulante: </small><?php echo $row['estado_conv_prac'] ?><br>
                              <small style="font-weight:700; font-size: 12px;">Estado entrevista: </small><?php echo $row['estado_entrevista'] ?><br>
                            </td>
                            <td>
                              <a href="agregar_entrevista_prac.php?idpostulante=<?php echo $row['detalle_prac_idpostulante'] ?>&practicas_idcon=<?php echo $idpracticas ?>&practicante_req=<?php echo $idpracticantes_req ?>&dni=<?php echo $dato_desencriptado ?>"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-search-plus"></i> Entrevista</button></a>
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
                <a href="elegir_conv_cal.php?dni=<?php echo $dni ?>#profile" type="button" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i></i> Retroceder</a>
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
  </script>
  <script>
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