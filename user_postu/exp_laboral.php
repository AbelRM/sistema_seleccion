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

  <title>Experiencia laboral del postulante CAS DIRESA - TACNA</title>

  <!-- Custom fonts for this template-->
  <link rel="icon" type="image/png" href="img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <link href="css/estilos.css" rel="stylesheet">

</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php
    include '../funcs/mcript.php';
    $dni = $_GET['dni'];
    $dato_desencriptado = SED::decryption($dni);

    $sql = "SELECT * FROM usuarios where dni=$dato_desencriptado";
    $datos = mysqli_query($con, $sql) or die(mysqli_error($datos));
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
          <?php
          $sql2 = "SELECT * FROM postulante WHERE dni=$dato_desencriptado";
          $datos2 = mysqli_query($con, $sql2) or die(mysqli_error($datos2));;
          $fila2 = mysqli_fetch_array($datos2);
          $idpostulante = $fila2['idpostulante'];
          ?>
          <!-- Page Heading -->
          <!-- Content Row -->
          <div class="card">
            <h5 class="card-header font-weight-bold">MI EXPERIENCIA LABORAL:</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                      <h5 class="text-center font-weight-bold">PERSONAL ASISTENCIAL</h5>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <p style="color: #212529">Profesionales de la Salud:</p>
                      <ul class="lista-base" style="color: #212529; font-size:12px">
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Médico Cirujano</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Químico Farmacéutico</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Obstetra</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Enfermero</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Médico Veterinario</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Biólogo</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Psicólogo</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Nutricionista</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Ing. Sanitario</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Asistente Social</a></li>
                      </ul>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <p style="color: #212529">Técnicos y Auxiliares asistenciales:</p>
                      <ul class="lista-base" style="color: #212529; font-size:12px">
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Enfermeria</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Obstetricia</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Laboratorio</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Farmacia</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Rayos X</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Médico Física y Rehabilitación</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Nutrición</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Odontología</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                      <h5 class="text-center font-weight-bold">PERSONAL NO ASISTENCIAL</h5>
                    </div>
                    <div class="col-md-12 col-sm-12">
                      <p style="color: #212529;">Otros profesionales:</p>
                      <ul class="lista-base" style="color: #212529; font-size:12px">
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Abogado</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Ing. Informático</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Ing. Civil</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Arquitecto</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Contador</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Administración</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Economía</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Ing. Industrial, etc.</a></li>
                      </ul>
                    </div>
                    <div class="col-md-12 col-sm-12">
                      <p style="color: #212529">Técnicos y Auxiliares:</p>
                      <ul class="lista-base" style="color: #212529; font-size:12px">
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Tec. Administrativo</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Tec. Comunicaciones</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Tec. Informática</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Secretaria</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Aux. administrativo, contable, etc.</a></li>
                      </ul>
                    </div>
                    <div class="col-md-12 col-sm-12">
                      <p style="color: #212529">Auxiliares asistenciales:</p>
                      <ul class="lista-base" style="color: #212529; font-size:12px">
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Chofer</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Chofer de Ambulancia</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Vigilante</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Trabajador de Limpieza</a></li>
                        <li class="lista-item m-1"><a href="#" class="texto-lista">Servicios (gasfitero, electricista, etc.)</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row p-2 d-flex justify-content-center">
                <div class="card border-primary">
                  <div class="card-header header-formulario">
                    <div class="row">
                      <div class="col-md-8 d-flex align-items-center">
                        <h5 class="titulo-card" style="font-size: 16px;">Listado de experiencias laborales registradas</h5>
                      </div>
                      <div class="col-md-4 d-flex justify-content-end">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Nuevo</a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                            <th style="display: none">id</th>
                            <th>N°</th>
                            <th style="display: none">id_lugar_gene</th>
                            <th>Lugar de trabajo general</th>
                            <th>Lugar de trabajo específico</th>
                            <th>Cargo/Función desempeñada</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Término</th>
                            <th>Tipo comprobante</th>
                            <th style="display: none">nro_contrato</th>
                            <th style="display: none">fecha_emision</th>
                            <th style="display: none">monto_boleta</th>
                            <th>Archivo</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql6 = "SELECT * FROM expe_4puntos INNER JOIN lugar_trabajo_gene ON expe_4puntos.lugar_trab_general = lugar_trabajo_gene.idlugar_trabajo_gene WHERE expe_puntos_idpostulante = $idpostulante";
                          $query6 = mysqli_query($con, $sql6);
                          if (mysqli_num_rows($query6) > 0) {
                            $i = 1;
                            while ($row6 = MySQLI_fetch_array($query6)) {
                          ?>
                              <tr>
                                <td style="font-size: 12px; display: none"><?php echo $row6['id_4puntos']; ?></td>
                                <td style="font-size: 12px;"><?php echo $i ?></td>
                                <td style="display: none;"><?php echo $row6['lugar_trab_general']; ?></td>
                                <td style="font-size: 12px;"><?php echo $row6['nombre_general']; ?></td>
                                <td style="font-size: 12px;"><?php echo $row6['lugar_especifico']; ?></td>
                                <td style="font-size: 12px;"><?php echo $row6['cargo']; ?></td>
                                <td style="font-size: 12px;"><?php echo $row6['fecha_inicio'] ?></td>
                                <td style="font-size: 12px;"><?php echo $row6['fecha_fin'] ?></td>

                                <td style="font-size: 12px;"><?php echo $row6['tipo_comprobante'] ?></td>
                                <td style="display: none;"><?php echo $row6['nro_contrato'] ?></td>
                                <td style="display: none;"><?php echo $row6['fech_emision'] ?></td>
                                <td style="display: none;"><?php echo $row6['monto_boleta'] ?></td>
                                <td><a href="ver_pdf_expe.php?id=<?php echo $row6['id_4puntos'] ?>&dni=<?php echo $dni ?>" target="_blank"><?php echo $row6['archivos']; ?></a></td>
                                <td>
                                  <div class="row d-flex justify-content-center">
                                    <button class="btn btn-success btn-sm m-1 updateBtn1"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm m-1 deleteBtn1"><i class="fa fa-times-circle"></i></button>
                                  </div>

                                </td>
                              </tr>
                          <?php
                              $i++;
                            }
                          } else {
                            echo "<tr><td colspan='9' class='text-center text-danger font-weight-bolder' >NO HAY EXPERIENCIA LABORAL REGISTRADA</td></tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row d-flex justify-content-center m-3">
                <a href="ingreso_datos_prof.php?dni=<?php echo $dni ?>" type="button" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i> Retroceder</a>
              </div>
            </div>
          </div>

          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
      </div>
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

  <!-- CERRAR SESION Modal-->
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

  <!-- ADD NUEVOS DATOS  EXPE  - TIPO 1-->
  <div class="modal fade" id="addModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Nueva experiencia laboral</h5>
          <button class="close" data-dismiss="modal">
            <span>×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12 col-sm-12">
            <p class="text-danger font-weight-bolder">- (*) Indica un campo obligatorio.</p>
            <p class="text-info font-weight-bolder">- ASISTENCIAL: Se considera personal asistencial todo aquel profesional, técnicos y auxiliares de la Salud.</p>
            <p class="text-success font-weight-bolder">- NO ASISTENCIAL: Es considerado a otros profesionales y técnicos e auxiliares de apoyo como choferes, vigilante, trabajador de limpieza y servicios varios.</p>
          </div>
          <form action="procesos/guardar_experiencia.php" enctype="multipart/form-data" autocomplete="off" method="POST">
            <div class="row">
              <input type="hidden" name="dni_encriptado4" value="<?php echo $dni ?>">
              <input type="hidden" name="dni4" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="postulante4" value="<?php echo $idpostulante ?>">

              <div class="col-md-12 col-sm-12">
                <label for="title">(*) Lugar de trabajo general</label>
                <select class="form-control color_lugar" name="nombre_lugar_gene" id="nombre_lugar_gene" required>
                  <option value="0" class="font-weigh-bold">Seleccione:</option>
                  <?php
                  $query = $con->query("SELECT * FROM lugar_trabajo_gene");
                  while ($valores = mysqli_fetch_array($query)) {
                    echo '<option value="' . $valores['idlugar_trabajo_gene'] . '">' . $valores['nombre_general'] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-6 col-sm-12" id="div_nombre_lugar_espec">
                <label for="title">(*) Lugar de trabajo especifico</label>
                <input type="text" name="nombre_lugar_espec" style="text-transform:uppercase; font-size:13px" class="form-control" placeholder="Nombre lugar trabajo">
              </div>
              <div class="col-md-6 col-sm-12" id="div_centro_estudios">
                <label for="title">(*) Cargo / Funciones</label>
                <input type="text" name="cargo_funciones_4exp" style="text-transform:uppercase; font-size:13px" class="form-control" placeholder="Nombre de cargo" maxlength="100" required>
              </div>
              <div class="col-md-4 col-sm-12" id="div_carrera">
                <label for="title">(*) Fecha de Inicio</label>
                <input type="date" name="fecha_ini_4exp" class="form-control" required>
              </div>
              <div class="col-md-4 col-sm-12" id="div_nro_colegiatura">
                <label for="title">(*) Fecha de Término</label>
                <input type="date" name="fecha_fin_4exp" id="nro_colegiatura_new" class="form-control" required>
              </div>
              <div class="col-md-4 col-sm-12" id="div_tipo_comprobante">
                <label for="title">(*) Tipo de comprobante</label>
                <select name="tipo_comprobante_exp4_tip1" class="form-control" onChange="tipo_comprobante_select(this)" required>
                  <option value="">Elegir...</option>
                  <option value="Contrato">Contrato</option>
                  <option value="Constancia/Certificado">Constancia / Certificado</option>
                  <option value="Orden de servicio">Orden de servicio</option>
                  <option value="Resolucion">Resolución (SERUMS)</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12" id="div_tipo_constancia">
                <label for="title">(*) Tipo de constancia</label>
                <select name="tipo_constancia_exp4_tip1" class="form-control" onChange="tipo_constancia_select(this)">
                  <option value="">Elegir...</option>
                  <option value="Constancia DIRESA">Constancia DIRESA</option>
                  <option value="Constancia NO DIRESA">Constancia NO DIRESA</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12" id="div_nro_contrato">
                <label for="title">(*)Nro Contrato</label>
                <input type="text" name="nro_contrato" class="form-control">
              </div>
              <div class="col-md-4 col-sm-12" id="div_fecha_boleta">
                <label for="title">(*)Fecha emisión boleta</label>
                <input type="date" name="fecha_boleta" class="form-control">
              </div>
              <div class="col-md-4 col-sm-12" id="div_boleta_pago">
                <label for="title">(*)Monto de boleta (Mayor a S./425.00)</label>
                <input type="number" name="boleta" class="form-control">
              </div>
              <div class="col-md-12 col-sm-12" id="div_msj_recibo">
                <label for="title" class="text-danger font-weight-bolder">NOTA: </label>
                <p class="text-danger font-weight-bolder">Adjuntar su Orden de servicio con su Recibo por honorarios.</p>
              </div>
              <div class="col-md-12 col-sm-12" id="archivo">
                <label for="title" class="text-primary font-weight-bolder">(*) Subir el archivo en el caso de:</label>
                <ul>
                  <li class="text-primary font-weight-bolder">Contrato: Archivo de tu contrato</li>
                  <li class="text-primary font-weight-bolder">Constancia / Certificado: Archivo de Constancia más boleta de pago.</li>
                  <li class="text-primary font-weight-bolder">Orden de servicio: Archivo de la Orden de servicio más recibo de honorarios.</li>
                  <li class="text-primary font-weight-bolder">Resolución: En caso de haber realizado SERUMS.</li>
                </ul>
                <input type="file" name="archivo" class="form-control" accept=".pdf" id="expe_archivo" required />
                <div id="peso_archivo_valido" class="font-weight-bolder text-primary"></div>
                <div id="peso_archivo_no" class="font-weight-bolder text-danger"></div>
              </div>
            </div>
            <div class="form-group pt-4">
              <p class="text-danger font-weight-bolder">(**) En el campo "FECHA" debe indicar la fecha de INICIO y TÉRMINO según el contrato, en caso de colocar fechas erroneas no será considerado.</p>
              <p class="text-danger font-weight-bolder">(**) En caso de subir archivos que no van acorde de la experiencia agregada no será considerado.</p>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="insertData4">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Actualizar Experiencia Laboral MICROREDES-->
  <div class="modal fade" id="actualizar_expe">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title">Modificar Experiencia Laboral</h5>
          <button class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <div class="modal-body">
          <form action="procesos/actualizar_experiencia.php" enctype="multipart/form-data" autocomplete="off" method="POST">
            <input type="hidden" name="dato_desencriptado" value="<?php echo $dato_desencriptado ?>">
            <input type="hidden" name="id_4puntos" id="id_4puntos">
            <input type="hidden" name="dni_update" value="<?php echo $dni ?>">

            <div class="form-group">
              <label for="title">Lugar de Trabajo general</label>
              <select class="form-control color_lugar" name="update_lugar_gene" id="id_lugar_espec" required>
                <option value="0">Seleccione:</option>
                <?php
                $query = $con->query("SELECT * FROM lugar_trabajo_gene");
                while ($valores = mysqli_fetch_array($query)) {
                  echo '<option value="' . $valores['idlugar_trabajo_gene'] . '">' . $valores['nombre_general'] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group" id="div_update_lugar_espec">
              <label for="update_lugar_espec">(*) Lugar de Trabajo especifico</label>
              <input type="text" name="update_lugar_espec" style="text-transform:uppercase; font-size:13px" id="update_lugar_espec" class="form-control">
            </div>
            <div class="form-group">
              <label for="cargo4">(*) Cargo/Funcion desempeñada</label>
              <input type="text" name="udpate_cargo" id="cargo4" style="text-transform:uppercase; font-size:13px" class="form-control">
            </div>
            <div class="form-group">
              <label for="udpate_fecha_inicio">(*) Fecha Inicio</label>
              <input type="date" name="udpate_fecha_inicio" id="fecha_inicio4" class="form-control">
            </div>
            <div class="form-group">
              <label for="udpate_fecha_fin">(*) Fecha Término</label>
              <input type="date" name="udpate_fecha_fin" id="fecha_fin4" class="form-control">
            </div>
            <div class="form-group">
              <label for="udpate_tipo_comprobante">(*) Tipo de comprobante</label>
              <select name="udpate_tipo_comprobante" id="update_tipo_comprobante" class="form-control">
                <option value="Contrato">Contrato</option>
                <option value="Constancia/Certificado">Constancia / Certificado</option>
                <option value="Orden de servicio">Orden de servicio</option>
                <option value="Resolucion">Resolución (SERUMS)</option>
              </select>
            </div>
            <div class="col-md-4 col-sm-12" id="div_tipo_constancia_update">
              <label for="title">(*) Tipo de constancia</label>
              <select name="tipo_comprobante_exp4_tip1" class="form-control" id="update_tipo_constancia">
                <option value="">Elegir...</option>
                <option value="Constancia DIRESA">Constancia DIRESA</option>
                <option value="Constancia NO DIRESA">Constancia NO DIRESA</option>
              </select>
            </div>
            <div class="form-group" id="div_nro_contrato_update">
              <label for="udpate_nro_contrato">(*) Nro Contrato</label>
              <input type="text" name="udpate_nro_contrato" style="text-transform:uppercase; font-size:13px" id="update_nro_contrato" class="form-control">
            </div>
            <div class="form-group" id="div_fecha_boleta_update">
              <label for="udpate_fecha_boleta">(*) Fecha emisión boleta</label>
              <input type="date" name="udpate_fecha_boleta" id="update_fecha_boleta" class="form-control">
            </div>
            <div class="form-group" id="div_boleta_pago_update">
              <label for="udpate_boleta">(*)Monto de boleta (Mayor a S./425.00)</label>
              <input type="number" name="udpate_boleta" id="update_boleta" style="text-transform:uppercase; font-size:13px" class="form-control">
            </div>
            <div class="col-md-12 col-sm-12" id="div_msj_recibo_update">
              <label for="title" class="text-danger font-weight-bolder">NOTA: </label>
              <p class="text-danger font-weight-bolder">Adjuntar su Orden de servicio con su Recibo por honorarios.</p>
            </div>
            <div class="form-group">
              <label for="archivos4" class="text-info font-weight-bolder">Archivo de constancia (Dejar en blanco si no desea actualizar)</label>
              <input type="file" name="archivos4" id="archivos4" class="form-control">
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary" name="updateData4">Actualizar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- !-- MODAL ELIMINAR MICROREDES -->
  <div class="modal fade" id="eliminar_expe">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">Eliminar registro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <form action="procesos/eliminar_experiencia.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="dni_url_4" value="<?php echo $dato_desencriptado; ?>">
            <input type="hidden" name="id4" id="id4">
            <input type="hidden" name="dni_base_4" value="<?php echo $dni ?>">
            <h4>¿Desea eliminar el dato seleccionado?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" name="deleteData4">Si</button>
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
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  <!-- <script src="js/mis_script.js"></script> -->
  <script src="js/sweetalert2.all.min.js"></script>
  <script src="js/script_experiencia.js"></script>

</body>

</html>