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
  <link href="css/estilos.css" rel="stylesheet">

</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php
    include 'funcs/mcript.php';

    $dato_desencriptado = $_GET['dni'];
    $dni = $desencriptar($dato_desencriptado);

    $sql = "SELECT * FROM usuarios where dni=$dni";
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
          include 'conexion.php';

          $sql2 = "SELECT * FROM postulante WHERE dni=$dni";
          $datos2 = mysqli_query($con, $sql2) or die(mysqli_error($datos2));;
          $fila2 = mysqli_fetch_array($datos2);
          $idpostulante = $fila2['idpostulante'];

          // $primero = mysqli_num_rows(mysqli_query($con,"SELECT * FROM detalle_convocatoria WHERE postulante_idpostulante=$idpostulante"));
          // if($primero==0){
          //     echo "PRIMERO DEBE POSTULAR, para que el sistema le ayude";
          // }else{
          //   $sql3="SELECT MAX(iddetalle_convocatoria) AS id FROM sistema_seleccion.detalle_convocatoria
          //   WHERE postulante_idpostulante=$idpostulante";
          //   $datos3=mysqli_query($con,$sql3) or die(mysqli_error());
          //   $row3 = mysqli_fetch_row($datos3);
          //   $id = trim($row3[0]);
          // }

          // $segundo = mysqli_num_rows(mysqli_query($con,"SELECT * FROM detalle_convocatoria WHERE postulante_idpostulante=$idpostulante"));
          // if($segundo==0){
          //     echo "PRIMERO DEBE POSTULAR";
          // }else{
          //     $sql4="SELECT * from detalle_convocatoria 
          //     inner join total_personal_req on detalle_convocatoria.personal_req_idpersonal=total_personal_req.idpersonal 
          //     inner join convocatoria on detalle_convocatoria.convocatoria_idcon=convocatoria.idcon WHERE iddetalle_convocatoria=$id";
          //     $datos4=mysqli_query($con,$sql4) or die(mysqli_error());
          //     $fila4= mysqli_fetch_array($datos4);
          //     $iddetalle_conv=$fila4['iddetalle_convocatoria'];
          //     $idtipo = $fila4['idtipo'];
          // }
          ?>
          <!-- Page Heading -->
          <!-- Content Row -->
          <div class="card">
            <h5 class="card-header font-weight-bold">MI EXPERIENCIA LABORAL:</h5>
            <div class="card-body">
              <div class="form-row d-flex justify-content-center">
                <div class="form-group col-lg-6 col-md-12">
                  <select name="select" id="inputSelect" class="form-control custom-select">
                    <!-- <option selected disabled >Elegir la opción reomendada para usted...</option> -->
                    <?php
                    // $total = mysqli_num_rows(mysqli_query($con,"SELECT * from detalle_convocatoria WHERE iddetalle_convocatoria=$id"));
                    $sql = mysqli_query($con, "SELECT * from tipo_cargo") or die("Problemas en consulta") . mysqli_error($sql);
                    while ($registro = mysqli_fetch_array($sql)) {
                      echo "<option value=\"tipo-" . $registro['tipo-exp'] . "\">" . $registro['tipo_cargo'] . "</option>";
                    }
                    // if($total==0){
                    //   $sql = mysqli_query($con,"SELECT * from tipo_cargo") or die("Problemas en consulta").mysqli_error();
                    //   while ($registro=mysqli_fetch_array($sql)) {
                    //   echo "<option value=\"tipo-".$registro['idtipo']."\">".$registro['tipo_cargo']."</option>";
                    //   }
                    // }else{
                    //   $sql = mysqli_query($con,"SELECT * from tipo_cargo WHERE idtipo=$idtipo") or die("Problemas en consulta").mysqli_error();
                    //   while ($registro=mysqli_fetch_array($sql)) {
                    //   echo "<option value=\"tipo-".$registro['tipo-exp']."\">".$registro['tipo_cargo']."</option>";
                    //   }
                    // }
                    ?>
                  </select>
                </div>
              </div>

              <div id="tipo-1" class="divOculto">
                <div class="row ">
                  <div class="col-md-12 form-group">
                    <p style="color: #212529">Se considera a los Profesionales de la Salud (Unicamente los que laboren en el campo asistencial de la Salud Pública)</p>
                    <ul class="lista-base">
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
                  <div class="col-md-12 form-group">
                    <p style="color: #212529">Se considera a los Técnicos y Auxiliares asistenciales de salud que desarrollan funciones en los servicios de:</p>
                    <ul class="lista-base">
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
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">MICROREDES</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Microredes DIRESA</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Pública/privada</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="form-row p-2 d-flex justify-content-center">
                      <div class="card border-primary">
                        <div class="card-header header-formulario">
                          <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                              <h5 class="titulo-card" style="font-size: 16px;">Experiencia laboral en MICROREDES RURALES</h5>
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
                                  <th>Lugar de trabajo</th>
                                  <th>Cargo/Función desempeñada</th>
                                  <th>Fecha Inicio</th>
                                  <th>Fecha Término</th>
                                  <th>Archivo</th>
                                  <th>Tipo comprobante</th>
                                  <th style="display: none">nro_contrato</th>
                                  <th style="display: none">fecha_emision</th>
                                  <th style="display: none">monto_boleta</th>
                                  <th>Acciones</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $sql6 = "SELECT * FROM expe_4puntos WHERE expe_4puntos_idpostulante = $idpostulante && tipo_expe = '1'";
                                $query6 = mysqli_query($con, $sql6);
                                if (mysqli_num_rows($query6) > 0) {
                                  $i = 1;
                                  while ($row6 = MySQLI_fetch_array($query6)) {
                                ?>
                                    <tr>
                                      <td style="font-size: 12px; display: none"><?php echo $row6['id_4puntos']; ?></td>
                                      <td style="font-size: 12px;"><?php echo $i ?></td>
                                      <td style="font-size: 12px;"><?php echo $row6['lugar']; ?></td>
                                      <td style="font-size: 12px;"><?php echo $row6['cargo']; ?></td>
                                      <td style="font-size: 12px;"><?php echo $row6['fecha_inicio'] ?></td>
                                      <td style="font-size: 12px;"><?php echo $row6['fecha_fin'] ?></td>
                                      <td><a href="ver_pdf_expe4.php?id=<?php echo $row6['id_4puntos'] ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><?php echo $row6['archivos']; ?></a></td>
                                      <td style="display: none;"><?php echo $row6['tipo_comprobante'] ?></td>
                                      <td style="display: none;"><?php echo $row6['nro_contrato'] ?></td>
                                      <td style="display: none;"><?php echo $row6['fech_emision'] ?></td>
                                      <td style="display: none;"><?php echo $row6['monto_boleta'] ?></td>
                                      <td class="d-flex justify-content-center">
                                        <button class="btn btn-success btn-sm m-1 updateBtn1"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm m-1 deleteBtn1"><i class="fa fa-times-circle"></i></button>
                                      </td>
                                    </tr>
                                <?php
                                    $i++;
                                  }
                                } else {
                                  echo "<tr><td colspan='7' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td></tr>";
                                }
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="form-row p-2 d-flex justify-content-center">
                      <div class="card border-primary">
                        <div class="card-header header-formulario">
                          <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                              <h5 class="titulo-card" style="font-size: 16px;">DIRESA, Red de Salud y Hospital en TACNA</h5>
                            </div>
                            <div class="col-md-4 d-flex justify-content-end">
                              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#expe3_2"><i class="fas fa-plus"></i> Nuevo</a>
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
                                  <th>Lugar de trabajo</th>
                                  <th>Cargo/Función desempeñada</th>
                                  <th>Fecha Inicio</th>
                                  <th>Fecha Término</th>
                                  <th>Archivo</th>
                                  <th>Tipo comprobante</th>
                                  <th>Acciones</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $sql7 = "SELECT * FROM expe_3puntos WHERE expe_3puntos_idpostulante = $idpostulante && tipo_expe = '1'";

                                $query7 = mysqli_query($con, $sql7);
                                if (mysqli_num_rows($query7) > 0) {
                                  $i = 1;
                                  while ($row7 = MySQLI_fetch_array($query7)) {
                                ?>
                                    <tr>
                                      <td style="font-size: 12px; display: none"><?php echo $row7['id_3puntos']; ?></td>
                                      <td style="font-size: 12px;"><?php echo $i ?></td>
                                      <td style="font-size: 12px;"><?php echo $row7['lugar'] ?></td>
                                      <td style="font-size: 12px;"><?php echo $row7['cargo'] ?></td>
                                      <td style="font-size: 12px;"><?php echo $row7['fecha_inicio'] ?></td>
                                      <td style="font-size: 12px;"><?php echo $row7['fecha_fin'] ?></td>
                                      <td><a href="ver_pdf_expe3.php?id=<?php echo $row7['id_3puntos'] ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><?php echo $row7['archivos']; ?></a></td>
                                      <td style="font-size: 12px;"><?php echo $row7['tipo_comprobante'] ?></td>
                                      <td class="d-flex justify-content-center">
                                        <button class="btn btn-success btn-sm m-1 updateBtn2"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm m-1 deleteBtn2"><i class="fa fa-times-circle"></i></button>
                                      </td>
                                    </tr>
                                <?php
                                    $i++;
                                  }
                                } else {
                                  echo "<tr><td colspan='7' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td></tr>";
                                }
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="form-row p-2 d-flex justify-content-center">
                      <div class="card border-primary">
                        <div class="card-header header-formulario">
                          <div class="row">
                            <div class="col-md-9 d-flex align-items-center">
                              <h5 class="titulo-card" style="font-size: 16px;">En sector PÚBLICO/PRIVADO - DENTRO/FUERA de TACNA</h5>
                            </div>
                            <div class="col-md-3 d-flex justify-content-end">
                              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#expe1"><i class="fas fa-plus"></i> Nuevo</a>
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
                                  <th>Lugar de trabajo</th>
                                  <th>Cargo/Función desempeñada</th>
                                  <th>Fecha Inicio</th>
                                  <th>Fecha Término</th>
                                  <th>Archivos</th>
                                  <th>Tipo comprobante</th>
                                  <th>Acciones</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $sql8 = "SELECT * FROM expe_1puntos WHERE expe_1puntos_idpostulante = $idpostulante && tipo_expe = '1'";

                                $query8 = mysqli_query($con, $sql8);
                                if (mysqli_num_rows($query8) > 0) {
                                  $i = 1;
                                  while ($row8 = MySQLI_fetch_array($query8)) {
                                ?>
                                    <tr>
                                      <td style="font-size: 12px; display: none"><?php echo $row8['id_1puntos']; ?></td>
                                      <td style="font-size: 12px;"><?php echo $i ?></td>
                                      <td style="font-size: 12px;"><?php echo $row8['lugar'] ?></td>
                                      <td style="font-size: 12px;"><?php echo $row8['cargo'] ?></td>
                                      <td style="font-size: 12px;"><?php echo $row8['fecha_inicio'] ?></td>
                                      <td style="font-size: 12px;"><?php echo $row8['fecha_fin'] ?></td>
                                      <td><a href="ver_pdf_expe1.php?id=<?php echo $row8['id_1puntos'] ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><?php echo $row8['archivos']; ?></a></td>
                                      <td style="font-size: 12px;"><?php echo $row8['tipo_comprobante'] ?></td>
                                      <td class="d-flex justify-content-center">
                                        <button class="btn btn-success btn-sm m-1 updateBtn3"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm m-1 deleteBtn3"><i class="fa fa-times-circle"></i></button>
                                      </td>
                                    </tr>
                                <?php
                                    $i++;
                                  }
                                } else {
                                  echo "<tr><td colspan='7' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td></tr>";
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

              <div id="tipo-2" class="divOculto">
                <div class="row ">
                  <div class="col-md-4 form-group">
                    <p style="color: #212529">Se considera a Otros profesionales:</p>
                    <ul class="lista-base">
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
                  <div class="col-md-4 form-group">
                    <p style="color: #212529">Se considera a los Técnicos y Auxiliares:</p>
                    <ul class="lista-base">
                      <li class="lista-item m-1"><a href="#" class="texto-lista">Tec. Administrativo</a></li>
                      <li class="lista-item m-1"><a href="#" class="texto-lista">Tec. Comunicaciones</a></li>
                      <li class="lista-item m-1"><a href="#" class="texto-lista">Tec. Informática</a></li>
                      <li class="lista-item m-1"><a href="#" class="texto-lista">Secretaria</a></li>
                      <li class="lista-item m-1"><a href="#" class="texto-lista">Aux. administrativo, contable, etc.</a></li>
                    </ul>
                  </div>
                  <div class="col-md-4 form-group">
                    <p style="color: #212529">Se considera a los Auxiliares asistenciales:</p>
                    <ul class="lista-base">
                      <li class="lista-item m-1"><a href="#" class="texto-lista">Chofer</a></li>
                      <li class="lista-item m-1"><a href="#" class="texto-lista">Chofer de Ambulancia</a></li>
                      <li class="lista-item m-1"><a href="#" class="texto-lista">Vigilante</a></li>
                      <li class="lista-item m-1"><a href="#" class="texto-lista">Trabajador de Limpieza</a></li>
                      <li class="lista-item m-1"><a href="#" class="texto-lista">Servicios (gasfitero, electricista, etc.)</a></li>
                    </ul>
                  </div>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home2-tab" data-toggle="tab" href="#home2" role="tab" aria-controls="home2" aria-selected="true">DIRESA - TACNA</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile2-tab" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile2" aria-selected="false">Pública/privada DENTRO de TACNA</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="contact2-tab" data-toggle="tab" href="#contact2" role="tab" aria-controls="contact2" aria-selected="false">Pública/privada FUERA de TACNA</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent2">
                  <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home2-tab">
                    <div class="form-row p-2 d-flex justify-content-center">
                      <div class="card">
                        <div class="card-header header-formulario-danger">
                          <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                              <h5 class="titulo-card" style="font-size: 16px;">Experiencia en la DIRESA TACNA</h5>
                            </div>
                            <div class="col-md-4 d-flex justify-content-end">
                              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#agregar_tipo2"><i class="fas fa-plus"></i> Nuevo</a>
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
                                  <th>Lugar de trabajo</th>
                                  <th>Cargo/Función desempeñada</th>
                                  <th>Fecha Inicio</th>
                                  <th>Fecha Término</th>
                                  <th>Tipo comprobante</th>
                                  <th style="display: none">nro_contrato</th>
                                  <th style="display: none">fecha_emision</th>
                                  <th style="display: none">monto_boleta</th>
                                  <th>Archivos</th>
                                  <th>Acciones</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $sql9 = "SELECT * FROM expe_4puntos WHERE expe_4puntos_idpostulante = $idpostulante && tipo_expe = '2' ";
                                $query9 = mysqli_query($con, $sql9);
                                if (mysqli_num_rows($query9) > 0) {
                                  $i = 1;
                                  while ($row9 = MySQLI_fetch_array($query9)) {
                                ?>
                                    <tr>
                                      <td style="font-size: 12px; display: none"><?php echo $row9['id_4puntos']; ?></td>
                                      <td style="font-size: 12px;"><?php echo $i ?></td>
                                      <td style="font-size: 12px;"><?php echo $row9['lugar'] ?></td>
                                      <td style="font-size: 12px;"><?php echo $row9['cargo'] ?></td>
                                      <td style="font-size: 12px;"><?php echo $row9['fecha_inicio'] ?></td>
                                      <td style="font-size: 12px;"><?php echo $row9['fecha_fin'] ?></td>
                                      <td style="display: none;"><?php echo $row9['nro_contrato'] ?></td>
                                      <td style="display: none;"><?php echo $row9['fech_emision'] ?></td>
                                      <td style="display: none;"><?php echo $row9['monto_boleta'] ?></td>
                                      <td><a href="ver_pdf_expe4.php?id=<?php echo $row9['id_4puntos'] ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><?php echo $row9['archivos']; ?></a></td>
                                      <td><?php echo $row9['tipo_comprobante'] ?></td>

                                      <td class="d-flex justify-content-center">
                                        <button class="btn btn-success btn-sm m-1 updateBtn4"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm m-1 deleteBtn4"><i class="fa fa-times-circle"></i></button>
                                      </td>
                                    </tr>
                                <?php
                                    $i++;
                                  }
                                } else {
                                  echo "<tr><td colspan='7' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td></tr>";
                                }
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile2-tab">
                    <div class="form-row p-2 d-flex justify-content-center">
                      <div class="card">
                        <div class="card-header header-formulario-danger">
                          <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                              <h5 class="titulo-card" style="font-size: 16px;">Experiencia PÚBLICA/PRIVADA DENTRO de TACNA</h5>
                            </div>
                            <div class="col-md-4 d-flex justify-content-end">
                              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#agregar3_tipo2"><i class="fas fa-plus"></i> Nuevo</a>
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
                                  <th>Lugar de trabajo</th>
                                  <th>Cargo/Función desempeñada</th>
                                  <th>Fecha Inicio</th>
                                  <th>Fecha Término</th>
                                  <th>Archivos</th>
                                  <th>Tipo comprobante</th>
                                  <th>Acciones</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $sql10 = "SELECT * FROM expe_3puntos WHERE expe_3puntos_idpostulante = $idpostulante && tipo_expe = '2'";
                                $query10 = mysqli_query($con, $sql10);
                                if (mysqli_num_rows($query10) > 0) {
                                  $i = 1;
                                  while ($row10 = MySQLI_fetch_array($query10)) {
                                ?>
                                    <tr>
                                      <td style="font-size: 12px; display: none"><?php echo $row10['id_3puntos']; ?></td>
                                      <td style="font-size:12px;"><?php echo $i ?></td>
                                      <td style="font-size:12px;"><?php echo $row10['lugar'] ?></td>
                                      <td style="font-size:12px;"><?php echo $row10['cargo'] ?></td>
                                      <td style="font-size:12px;"><?php echo $row10['fecha_inicio'] ?></td>
                                      <td style="font-size:12px;"><?php echo $row10['fecha_fin'] ?></td>
                                      <td><a href="ver_pdf_expe3.php?id=<?php echo $row10['id_3puntos'] ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><?php echo $row10['archivos']; ?></a></td>
                                      <td style="font-size: 12px;"><?php echo $row10['tipo_comprobante'] ?></td>
                                      <td class="d-flex justify-content-center">
                                        <button class="btn btn-success btn-sm m-1 updateBtn2"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm m-1 deleteBtn2"><i class="fa fa-times-circle"></i></button>
                                      </td>
                                    </tr>
                                <?php
                                    $i++;
                                  }
                                } else {
                                  echo "<tr><td colspan='7' class='text-center text-danger' >NO HAY DATOS AUN REGISTRADOS</td></tr>";
                                }
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="contact2" role="tabpanel" aria-labelledby="contact2-tab">
                    <div class="form-row p-2 d-flex justify-content-center">
                      <div class="card">
                        <div class="card-header header-formulario-danger">
                          <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                              <h5 class="titulo-card" style="font-size: 16px;">Experiencia PÚBLICA/PRIVADA FUERA de TACNA</h5>
                            </div>
                            <div class="col-md-4 d-flex justify-content-end">
                              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#agregar1_tipo2"><i class="fas fa-plus"></i> Nuevo</a>
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
                                  <th>Lugar de trabajo</th>
                                  <th>Cargo/Función desempeñada</th>
                                  <th>Fecha Inicio</th>
                                  <th>Fecha Término</th>
                                  <th>Archivos</th>
                                  <th>Tipo comprobante</th>
                                  <th>Acciones</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $sql11 = "SELECT * FROM expe_1puntos WHERE expe_1puntos_idpostulante = $idpostulante && tipo_expe = '2'";

                                $query11 = mysqli_query($con, $sql11);
                                if (mysqli_num_rows($query11) > 0) {
                                  $i = 1;
                                  while ($row11 = MySQLI_fetch_array($query11)) {
                                ?>
                                    <tr>
                                      <td style="font-size: 12px; display: none"><?php echo $row11['id_1puntos']; ?></td>
                                      <td style="font-size: 12px;"><?php echo $i ?></td>
                                      <td style="font-size: 12px;"><?php echo $row11['lugar'] ?></td>
                                      <td style="font-size: 12px;"><?php echo $row11['cargo'] ?></td>
                                      <td style="font-size: 12px;"><?php echo $row11['fecha_inicio'] ?></td>
                                      <td style="font-size: 12px;"><?php echo $row11['fecha_fin'] ?></td>
                                      <td><a href="ver_pdf_expe1.php?id=<?php echo $row11['id_1puntos'] ?>&dni=<?php echo $dato_desencriptado ?>" target="_blank"><?php echo $row11['archivos']; ?></a></td>
                                      <td style="font-size: 12px;"><?php echo $row11['tipo_comprobante'] ?></td>
                                      <td class="d-flex justify-content-center">
                                        <button class="btn btn-success btn-sm m-1 updateBtn3"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm m-1 deleteBtn3"><i class="fa fa-times-circle"></i></button>
                                      </td>
                                    </tr>
                                <?php
                                    $i++;
                                  }
                                } else {
                                  echo "<tr><td colspan='7' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td></tr>";
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

  <!-- ADD NUEVOS DATOS  EXPE 4 - TIPO 1-->
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
          <form action="procesos/guardar_experiencia.php" enctype="multipart/form-data" autocomplete="off" method="POST">
            <div class="row">
              <input type="hidden" name="dni_encriptado4" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="dni4" value="<?php echo $dni ?>">
              <input type="hidden" name="postulante4" value="<?php echo $idpostulante ?>">
              <input type="hidden" name="tipo_expe4" value="1">

              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">(*) Lugar de trabajo</label>
                <select name="lugar_4exp" class="form-control" id="lugar">
                  <option disabled selected>Elegir</option>
                  <option value="Microred Tarata">Microred Tarata</option>
                  <option value="Microred Candarave">Microred Candarave</option>
                  <option value="Microred Alto Andino">Microred Alto Andino</option>
                  <option value="Microred Frontera">Microred Frontera</option>
                  <option value="Microred Jorge Basadre">Microred Jorge Basadre</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_centro_estudios">
                <label for="title">(*) Cargo/Funciones</label>
                <input type="text" name="cargo_funciones_4exp" style="text-transform:uppercase; font-size:13px" class="form-control" placeholder="Nombre de cargo" maxlength="100" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_carrera">
                <label for="title">(*) Fecha de Inicio</label>
                <input type="date" name="fecha_ini_4exp" class="form-control" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_nro_colegiatura">
                <label for="title">(*) Fecha de Término</label>
                <input type="date" name="fecha_fin_4exp" id="nro_colegiatura_new" class="form-control" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_tipo_comprobante">
                <label for="title">(*) Tipo de comprobante</label>
                <select name="tipo_comprobante_exp4_tip1" class="form-control" onChange="tipo_comprobante_select(this)">
                  <option value="">Elegir...</option>
                  <option value="Contrato">Contrato</option>
                  <option value="Boleta">Boleta de pago</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_nro_contrato">
                <label for="title">(*)Nro Contrato</label>
                <input type="text" name="nro_contrato" class="form-control">
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_fecha_boleta">
                <label for="title">(*)Fecha emisión</label>
                <input type="date" name="fecha_boleta" class="form-control">
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_boleta_pago">
                <label for="title">(*)Monto de boleta (Mayor a S./425.00)</label>
                <input type="number" name="boleta" class="form-control">
              </div>
              <div class="col-md-8 col-sm-12 form-group" id="archivo">
                <label for="title">(*) Subir Contrato o boleta</label>
                <input type="file" name="archivo" accept=".pdf" id="expe_archivo" required />
                <div id="peso_archivo_valido" class="font-weight-bolder text-primary"></div>
                <div id="peso_archivo_no" class="font-weight-bolder text-danger"></div>
              </div>
            </div>
            <div class="form-group">
              <p>(*) Indica un campo obligatorio.</p>
              <p>(**) En el campo "FECHA" debe indicar la fecha de INICIO y TÉRMINO según el contrato, en caso de colocar fechas erroneas será
                quitado de la lista .</p>
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
  <div class="modal fade" id="actualizarmicroredes">
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
            <input type="hidden" name="dni4" value="<?php echo $dni ?>">
            <input type="hidden" name="numero4" id="numero4">

            <div class="form-group">
              <label for="title">Lugar de Trabajo</label>
              <select class="form-control" name="lugar4" id="lugar4">
                <option value="Microred Tarata">Microred Tarata</option>
                <option value="Microred Candarave">Microred Candarave</option>
                <option value="Microred Alto Andino">Microred Alto Andino</option>
                <option value="Microred Frontera">Microred Frontera</option>
                <option value="Microred Jorge Basadre">Microred Jorge Basadre</option>
              </select>
            </div>
            <div class="form-group">
              <label for="title">Cargo/Funcion desempeñada </label>
              <input type="text" name="cargo4" id="cargo4" class="form-control">
            </div>
            <div class="form-group">
              <label for="title">Fecha Inicio</label>
              <input type="date" name="fecha_inicio4" id="fecha_inicio4" class="form-control">
            </div>
            <div class="form-group">
              <label for="title">Fecha Término</label>
              <input type="date" name="fecha_fin4" id="fecha_fin4" class="form-control">
            </div>
            <div class="col-md-4 col-sm-12 form-group" id="div_tipo_comprobante">
              <label for="title">(*) Tipo de comprobante</label>
              <select name="tipo_comprobante_exp4_tip1" class="form-control" onChange="tipo_comprobante_select(this)">
                <option value="Contrato">Contrato</option>
                <option value="Boleta">Boleta de pago</option>
              </select>
            </div>
            <div class="col-md-4 col-sm-12 form-group" id="div_nro_contrato">
              <label for="title">(*)Nro Contrato</label>
              <input type="text" name="nro_contrato" class="form-control">
            </div>
            <div class="col-md-4 col-sm-12 form-group" id="div_fecha_boleta">
              <label for="title">(*)Fecha emisión</label>
              <input type="date" name="fecha_boleta" class="form-control">
            </div>
            <div class="col-md-4 col-sm-12 form-group" id="div_boleta_pago">
              <label for="title">(*)Monto de boleta (Mayor a S./425.00)</label>
              <input type="number" name="boleta" class="form-control">
            </div>
            <div class="form-group">
              <label for="title">Archivo de constancia (Dejar en blanco si no desea actualizar)</label>
              <input type="file" name="archivos4" id="archivos4" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="updateData4">Actualizar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- !-- MODAL ELIMINAR MICROREDES -->
  <div class="modal fade" id="eliminarmicroredes">
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


  <!-- ADD NUEVOS DATOS  EXPE 3 - TIPO 1-->
  <div class="modal fade" id="expe3_2">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Nueva experiencia laboral</h5>
          <button class="close" data-dismiss="modal">
            <span>×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="procesos/guardar_experiencia.php" enctype="multipart/form-data" autocomplete="off" method="POST">
            <div class="row">
              <input type="hidden" name="dni_encriptado3" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="dni3" value="<?php echo $dni ?>">
              <input type="hidden" name="postulante3" value="<?php echo $idpostulante ?>">
              <input type="hidden" name="tipo_expe3" value="1">

              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">(*) Lugar de trabajo</label>
                <input type="text" name="lugar_3exp" style="text-transform:uppercase; font-size:13px" class="form-control" placeholder="Nombre de cargo" maxlength="100" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">(*) Cargo/Funciones</label>
                <input type="text" name="cargo_funciones_3exp" style="text-transform:uppercase; font-size:13px" class="form-control" placeholder="Nombre de cargo" maxlength="100" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">(*) Fecha de Inicio</label>
                <input type="date" name="fecha_ini_3exp" class="form-control" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">(*) Fecha de Término</label>
                <input type="date" name="fecha_fin_3exp" class="form-control" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_tipo_comprobante">
                <label for="title">(*) Tipo de comprobante</label>
                <select name="tipo_comprobante_exp3_tip1" class="form-control" onChange="tipo_comprobante_expe3_select(this)">
                  <option value="">Elegir...</option>
                  <option value="Contrato">Contrato</option>
                  <option value="Boleta">Boleta de pago</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_nro_contrato_expe3">
                <label for="title">(*)Nro Contrato</label>
                <input type="text" name="nro_contrato" class="form-control">
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_fecha_boleta_expe3">
                <label for="title">(*)Fecha emisión </label>
                <input type="date" name="fecha_boleta" class="form-control">
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_boleta_pago_expe3">
                <label for="title">(*)Boleta de pago (Mayor a S./425.00)</label>
                <input type="number" name="boleta" class="form-control">
              </div>

              <div class="col-md-8 col-sm-12 form-group" id="archivo">
                <label for="title">(*) Subir Contrato o boleta</label>
                <input type="file" name="archivo" accept=".pdf" id="expe_archivo_3" required />
                <div id="peso_archivo_valido_3" class="font-weight-bolder text-primary"></div>
                <div id="peso_archivo_no_3" class="font-weight-bolder text-danger"></div>
              </div>
            </div>
            <div class="form-group">
              <p>(*) Indica un campo obligatorio.</p>
              <p>(**) En el campo "FECHA" debe indicar la fecha de INICIO y TÉRMINO según el contrato, en caso de colocar fechas erroneas será
                quitado de la lista .</p>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="insertData3">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Actualizar MICROREDES DIRESA DE  TACNA-->
  <div class="modal fade" id="actualizarmicrotacna">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title">Modificar</h5>
          <button class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <div class="modal-body">
          <form action="procesos/actualizar_experiencia.php" enctype="multipart/form-data" autocomplete="off" method="POST">
            <input type="hidden" name="dato_desencriptado" value="<?php echo $dato_desencriptado ?>">
            <input type="hidden" name="id_3puntos" id="id_3puntos">
            <input type="hidden" name="dni3" value="<?php echo $dni ?>">
            <input type="hidden" name="numero3" id="numero3">

            <div class="form-group">
              <label for="title">Lugar de Trabajo </label>
              <input type="text" name="lugar3" id="lugar3" class="form-control" placeholder="(*) Lugar de trabajo" maxlength="50">
            </div>
            <div class="form-group">
              <label for="title">Cargo/Funcion desempeñada </label>
              <input type="text" name="cargo3" id="cargo3" class="form-control" placeholder="(*) Cargo o función" maxlength="50">
            </div>
            <div class="form-group">
              <label for="title">Fecha Inicio</label>
              <input type="date" name="fecha_inicio3" id="fecha_inicio3" class="form-control">
            </div>
            <div class="form-group">
              <label for="title">Fecha Fin </label>
              <input type="date" name="fecha_fin3" id="fecha_fin3" class="form-control">
            </div>
            <div class="form-group">
              <label for="title">Archivo de constancia (Dejar en blanco si no desea actualizar)</label>
              <input type="file" name="archivos3" id="archivos3" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="updateData3">Actualizar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Eliminar MICROREDES DIRESA DE  TACNA-->
  <div class="modal fade" id="eliminarmicroredes2">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">Eliminar registro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <form action="procesos/eliminar_experiencia.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="dni_url_3" value="<?php echo $dato_desencriptado; ?>">
            <input type="hidden" name="id3" id="id3">
            <input type="hidden" name="dni_base_3" value="<?php echo $dni ?>">
            <h4>¿Desea eliminar el dato seleccionado?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" name="deleteData3">Si</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- ADD NUEVOS DATOS  EXPE 1 - TIPO 1-->
  <div class="modal fade" id="expe1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Nueva experiencia laboral</h5>
          <button class="close" data-dismiss="modal">
            <span>×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="procesos/guardar_experiencia.php" enctype="multipart/form-data" autocomplete="off" method="POST">
            <div class="row">
              <input type="hidden" name="dni_encriptado" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="dni" value="<?php echo $dni ?>">
              <input type="hidden" name="postulante" value="<?php echo $idpostulante ?>">
              <input type="hidden" name="tipo_expe" value="1">

              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">(*) Lugar de trabajo</label>
                <input type="text" name="lugar_1exp" style="text-transform:uppercase; font-size:13px" class="form-control" placeholder="Nombre de cargo" maxlength="100" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">(*) Cargo/Funciones</label>
                <input type="text" name="cargo_funciones_1exp" style="text-transform:uppercase; font-size:13px" class="form-control" placeholder="Nombre de cargo" maxlength="100" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">(*) Fecha de Inicio</label>
                <input type="date" name="fecha_ini_1exp" class="form-control" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">(*) Fecha de Término</label>
                <input type="date" name="fecha_fin_1exp" class="form-control" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_tipo_comprobante">
                <label for="title">(*) Tipo de comprobante</label>
                <select name="tipo_comprobante_exp1_tip1" class="form-control" onChange="tipo_comprobante_expe1_select(this)">
                  <option value="">Elegir...</option>
                  <option value="Contrato">Contrato</option>
                  <option value="Boleta">Boleta de pago</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_nro_contrato_expe1">
                <label for="title">(*)Nro Contrato</label>
                <input type="text" name="nro_contrato" class="form-control">
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_fecha_boleta_expe1">
                <label for="title">(*)Fecha emisión </label>
                <input type="date" name="fecha_boleta" class="form-control">
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_boleta_pago_expe1">
                <label for="title">(*)Boleta de pago (Mayor a S./425.00)</label>
                <input type="number" name="boleta" class="form-control">
              </div>
              <div class="col-md-8 col-sm-12 form-group">
                <label for="title">(*) Subir contrato o boleta</label>
                <input type="file" name="archivo" accept=".pdf" id="expe_archivo_1" required />
                <div id="peso_archivo_valido_1" class="font-weight-bolder text-primary"></div>
                <div id="peso_archivo_no_1" class="font-weight-bolder text-danger"></div>
              </div>
              <div class="form-group">
                <p>(*) Indica un campo obligatorio.</p>
                <p>(**) En el campo "FECHA" debe indicar la fecha de INICIO y TÉRMINO según el contrato, en caso de colocar fechas erroneas será
                  quitado de la lista .</p>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="insertData1">Guardar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Actualizar MICROREDES DENTRO O FUERA de TACNA-->
  <div class="modal fade" id="actualizarpublicoprivado">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title">Modificar experiencia</h5>
          <button class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <div class="modal-body">
          <form action="procesos/actualizar_experiencia.php" enctype="multipart/form-data" autocomplete="off" method="POST">
            <input type="hidden" name="dato_desencriptado" value="<?php echo $dato_desencriptado ?>">
            <input type="hidden" name="id_1puntos" id="id_1puntos">
            <input type="hidden" name="dni1" value="<?php echo $dni ?>">
            <input type="hidden" name="numero1" id="numero1">

            <div class="form-group">
              <label for="title">Lugar de Trabajo </label>
              <input type="text" name="lugar1" id="lugar1" class="form-control" placeholder="(*) Lugar de trabajo" maxlength="45">
            </div>
            <div class="form-group">
              <label for="title">Cargo/Funcion desempeñada </label>
              <input type="text" name="cargo1" id="cargo1" class="form-control" placeholder="(*) Cargo/funciones" maxlength="45">
            </div>
            <div class="form-group">
              <label for="title">Fecha Inicio</label>
              <input type="date" name="fecha_inicio1" id="fecha_inicio1" class="form-control">
            </div>
            <div class="form-group">
              <label for="title">Fecha Fin </label>
              <input type="date" name="fecha_fin1" id="fecha_fin1" class="form-control">
            </div>
            <div class="form-group">
              <label for="title">Archivo de constancia (Dejar en blanco si no desea actualizar)</label>
              <input type="file" name="archivos1" id="archivos1" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="updateData1">Actualizar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- !-- MODAL ELIMINAR MICROREDES DENTRO O FUERA de TACNA -->
  <div class="modal fade" id="eliminarpublicoprivado">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">Eliminar registro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <form action="procesos/eliminar_experiencia.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="dni_url_1" value="<?php echo $dato_desencriptado; ?>">
            <input type="hidden" name="id1" id="id1">
            <input type="hidden" name="dni_base_1" value="<?php echo $dni ?>">
            <h4>¿Desea eliminar el dato seleccionado?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" name="deleteData1">Si</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- ADD NUEVOS DATOS  EXPE 4 - TIPO 2-->
  <div class="modal fade" id="agregar_tipo2">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Nueva experiencia laboral</h5>
          <button class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <div class="modal-body">
          <form action="procesos/guardar_experiencia.php" enctype="multipart/form-data" autocomplete="off" method="POST">
            <div class="row">
              <input type="hidden" name="dni_encriptado" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="dni" value="<?php echo $dni ?>">
              <input type="hidden" name="postulante" value="<?php echo $idpostulante ?>">
              <input type="hidden" name="tipo_expe" value="2">

              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">(*) Lugar de trabajo</label>
                <input type="text" name="lugar_4exp_tip2" class="form-control" style="text-transform:uppercase; font-size:13px" placeholder="(*) Lugar de trabajo" maxlength="45" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_centro_estudios">
                <label for="title">(*) Cargo/Funciones</label>
                <input type="text" name="cargo_funciones_4exp_tip2" style="text-transform:uppercase; font-size:13px" class="form-control" placeholder="(*) Nombre de cargo" maxlength="45" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_carrera">
                <label for="title">(*) Fecha de Inicio</label>
                <input type="date" name="fecha_ini_4exp_tip2" class="form-control" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_nro_colegiatura">
                <label for="title">(*) Fecha de Término</label>
                <input type="date" name="fecha_fin_4exp_tip2" class="form-control" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_tipo_comprobante">
                <label for="title">(*) Tipo de comprobante</label>
                <select name="tipo_comprobante_exp4_tip2" class="form-control" onChange="tipo_comprobante_tip2_select(this)">
                  <option value="">Elegir...</option>
                  <option value="Contrato">Contrato</option>
                  <option value="Boleta">Boleta de pago</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_nro_contrato_tip2">
                <label for=" title">(*)Nro Contrato</label>
                <input type="text" name="nro_contrato" class="form-control">
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_fecha_boleta_tip2">
                <label for="title">(*)Fecha emisión </label>
                <input type="date" name="fecha_boleta" class="form-control">
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_boleta_pago_tip2">
                <label for="title">(*)Boleta de pago (Mayor a S./425.00)</label>
                <input type="number" name="boleta" class="form-control">
              </div>
              <div class="col-md-8 col-sm-12 form-group" id="archivo">
                <label for="title">(*) Subir contrato o boleta</label>
                <input type="file" name="archivos_tipo2" accept=".pdf" id="expe_archivo_tipo2" required />
                <div id="peso_archivo_valido_tipo2" class="font-weight-bolder text-primary"></div>
                <div id="peso_archivo_no_tipo2" class="font-weight-bolder text-danger"></div>
              </div>
            </div>
            <div class="form-group">
              <p>(*) Indica un campo obligatorio.</p>
              <p>(**) En el campo "FECHA" debe indicar la fecha de INICIO y TÉRMINO según el contrato, en caso de colocar fechas erroneas será
                quitado de la lista .</p>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="insertData4_tipo2">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Actualizar Experiencia Laboral MICROREDES-->
  <div class="modal fade" id="actualizar_tipo2">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title">Modificar Experiencia Laboral</h5>
          <button class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <div class="modal-body">
          <form action="procesos/actualizar_experiencia.php" enctype="multipart/form-data" autocomplete="off" method="POST">
            <input type="hidden" name="dato_desencriptado" value="<?php echo $dato_desencriptado ?>">
            <input type="hidden" name="edit_id_4puntos_tipo2" id="edit_id_4puntos_tipo2">
            <input type="hidden" name="dni4_tipo2" value="<?php echo $dni ?>">
            <input type="hidden" name="numero4_tipo2" id="numero4_tipo2">
            <div class="form-group">
              <label for="title">Lugar de Trabajo</label>
              <input type="text" name="lugar4_tipo2" id="lugar4_tipo2" class="form-control" placeholder="(*) Lugar de trabajo" maxlength="45">
            </div>
            <div class="form-group">
              <label for="title">Cargo/Funcion desempeñada </label>
              <input type="text" name="cargo4_tipo2" id="cargo4_tipo2" class="form-control" placeholder="(*) Cargo/funciones" maxlength="45">
            </div>
            <div class="form-group">
              <label for="title">Fecha Inicio</label>
              <input type="date" name="fecha_inicio4_tipo2" id="fecha_inicio4_tipo2" class="form-control">
            </div>
            <div class="form-group">
              <label for="title">Fecha Término</label>
              <input type="date" name="fecha_fin4_tipo2" id="fecha_fin4_tipo2" class="form-control">
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12" id="div_tipo_comprobante">
                <label for="title">(*) Tipo de comprobante</label>
                <select name="tipo_comprobante_exp4_tip2" id="edit_tipo_comprobante_exp4_tip2" class="form-control">
                  <option value="">Elegir...</option>
                  <option value="Contrato">Contrato</option>
                  <option value="Boleta">Boleta de pago</option>
                </select>
              </div>
              <div class="col-md-6 col-sm-12" id="div_nro_contrato">
                <label for="title">(*)Nro Contrato</label>
                <input type="text" name="edit_nro_contrato_exp4_tip2" id="edit_nro_contrato_exp4_tip2" class="form-control">
              </div>
              <div class="col-md-6 col-sm-12 form-group" id="div_fecha_boleta">
                <label for="title">(*)Fecha emisión</label>
                <input type="date" name="fecha_boleta" id="edit_fecha_boleta_exp4_tip2" class="form-control">
              </div>
              <div class="col-md-6 col-sm-12 form-group" id="div_boleta_pago">
                <label for="title">(*)Monto de boleta (Mayor a S./425.00)</label>
                <input type="number" name="boleta" id="edit_boleta_exp4_tip2" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label for="title">Archivo de constancia (Dejar en blanco si no desea actualizar)</label>
              <input type="file" name="archivos4_tipo2" accept=".pdf" id="expe_archivo4_tipo2" />
              <div id="peso_archivo_valido4_tipo2" class="font-weight-bolder text-primary"></div>
              <div id="peso_archivo_no4_tipo2" class="font-weight-bolder text-danger"></div>
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="updateData5">Actualizar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- !-- MODAL ELIMINAR MICROREDES -->
  <div class="modal fade" id="eliminar_tipo2">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">Eliminar registro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <form action="procesos/eliminar_experiencia.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="dato_desencriptado" value="<?php echo $dato_desencriptado; ?>">
            <input type="hidden" name="dni4_tipo2" value="<?php echo $dni; ?>">
            <input type="hidden" name="id_4puntos_tipo2" id="id_4puntos_tipo2">
            <h4>¿Desea eliminar el dato seleccionado?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" name="deleteData5">Si</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- ADD NUEVOS DATOS  EXPE 3 - TIPO 2-->
  <div class="modal fade" id="agregar3_tipo2">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Nueva experiencia laboral</h5>
          <button class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <div class="modal-body">
          <form action="procesos/guardar_experiencia.php" enctype="multipart/form-data" autocomplete="off" method="POST">
            <div class="row">
              <input type="hidden" name="dni_encriptado" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="dni" value="<?php echo $dni ?>">
              <input type="hidden" name="postulante" value="<?php echo $idpostulante ?>">
              <input type="hidden" name="tipo_expe" value="2">

              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">(*) Lugar de trabajo</label>
                <input type="text" name="lugar_3exp_tip2" class="form-control" placeholder="(*) Lugar de trabajo" maxlength="45" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_centro_estudios">
                <label for="title">(*) Cargo/Funciones</label>
                <input type="text" name="cargo_funciones_3exp_tip2" class="form-control" placeholder="(*) Nombre de cargo" maxlength="45" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_carrera">
                <label for="title">(*) Fecha de Inicio</label>
                <input type="date" name="fecha_ini_3exp_tip2" class="form-control" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_nro_colegiatura">
                <label for="title">(*) Fecha de Término</label>
                <input type="date" name="fecha_fin_3exp_tip2" class="form-control" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_tipo_comprobante">
                <label for="title">(*) Tipo de comprobante</label>
                <select name="tipo_comprobante_exp3_tip2" class="form-control" onChange="tipo_comprobante_tip2_expe3_select(this)">
                  <option value="">Elegir...</option>
                  <option value="Contrato">Contrato</option>
                  <option value="Boleta">Boleta de pago</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_nro_contrato_tip2_expe3">
                <label for="title">(*)Nro Contrato</label>
                <input type="text" name="nro_contrato" class="form-control">
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_fecha_boleta_tip2_expe3">
                <label for="title">(*)Fecha emisión </label>
                <input type="date" name="fecha_boleta" class="form-control">
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_boleta_pago_tip2_expe3">
                <label for="title">(*)Boleta de pago (Mayor a S./425.00)</label>
                <input type="number" name="boleta" class="form-control">
              </div>
              <div class="col-md-8 col-sm-12 form-group" id="archivo">
                <label for="title">(*) Subir contrato o boleta</label>
                <input type="file" name="archivos3_tipo2" accept=".pdf" id="expe_archivo3_tipo2" required />
                <div id="peso_archivo_valido3_tipo2" class="font-weight-bolder text-primary"></div>
                <div id="peso_archivo_no3_tipo2" class="font-weight-bolder text-danger"></div>
              </div>
            </div>
            <div class="form-group">
              <p>(*) Indica un campo obligatorio.</p>
              <p>(**) En el campo "FECHA" debe indicar la fecha de INICIO y TÉRMINO según el contrato, en caso de colocar fechas erroneas será
                quitado de la lista .</p>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="insertData3_tipo2">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- ADD NUEVOS DATOS  EXPE 1 - TIPO 2-->
  <div class="modal fade" id="agregar1_tipo2">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Nueva experiencia laboral</h5>
          <button class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <div class="modal-body">
          <form action="procesos/guardar_experiencia.php" enctype="multipart/form-data" autocomplete="off" method="POST">
            <div class="row">
              <input type="hidden" name="dni_encriptado" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="dni" value="<?php echo $dni ?>">
              <input type="hidden" name="postulante" value="<?php echo $idpostulante ?>">
              <input type="hidden" name="tipo_expe" value="2">

              <div class="col-md-4 col-sm-12 form-group">
                <label for="title">(*) Lugar de trabajo</label>
                <input type="text" name="lugar_1exp_tip2" class="form-control" placeholder="(*) Lugar de trabajo" maxlength="45" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_centro_estudios">
                <label for="title">(*) Cargo/Funciones</label>
                <input type="text" name="cargo_funciones_1exp_tip2" class="form-control" placeholder="(*) Nombre de cargo" maxlength="45" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_carrera">
                <label for="title">(*) Fecha de Inicio</label>
                <input type="date" name="fecha_ini_1exp_tip2" class="form-control" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_nro_colegiatura">
                <label for="title">(*) Fecha de Término</label>
                <input type="date" name="fecha_fin_1exp_tip2" class="form-control" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_tipo_comprobante">
                <label for="title">(*) Tipo de comprobante</label>
                <select name="tipo_comprobante_exp1_tip2" onChange="tipo_comprobante_tip1_expe_1_select(this)" class="form-control">
                  <option value="">Elegir...</option>
                  <option value="Contrato">Contrato</option>
                  <option value="Boleta">Boleta de pago</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_nro_contrato_tip1_expe_1">
                <label for="title">(*)Nro Contrato</label>
                <input type="text" name="nro_contrato" class="form-control">
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_fecha_boleta_tip1_expe_1">
                <label for="title">(*)Fecha emisión </label>
                <input type="date" name="fecha_boleta" class="form-control">
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_boleta_pago_tip1_expe_1">
                <label for="title">(*)Monto de boleta (Mayor a S./425.00)</label>
                <input type="number" name="boleta" class="form-control">
              </div>
              <div class="col-md-8 col-sm-12 form-group" id="archivo">
                <label for="title">(*) Subir contrato o boleta</label>
                <input type="file" name="archivos1_tipo2" accept=".pdf" id="expe_archivo1_tipo2" required />
                <div id="peso_archivo_valido1_tipo2" class="font-weight-bolder text-primary"></div>
                <div id="peso_archivo_no1_tipo2" class="font-weight-bolder text-danger"></div>
              </div>
            </div>
            <div class="form-group">
              <p>(*) Indica un campo obligatorio.</p>
              <p>(**) En el campo "FECHA" debe indicar la fecha de INICIO y TÉRMINO según el contrato, en caso de colocar fechas erroneas será
                quitado de la lista .</p>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="insertData1_tipo2">Guardar</button>
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
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  <script src="js/mis_script.js"></script>
  <script src="js/sweetalert2.all.min.js"></script>
  <script>
    function alerta_aceptar() {
      Swal.fire("Se agrego correctamente.");
    }
  </script>
  <!-- Script para la seleccion -->
  <script>
    $(function() {
      $("#inputSelect").on('change', function() {
        var selectValue = $(this).val();
        switch (selectValue) {
          case "tipo-1":
            $("#tipo-1").show();
            $("#tipo-2").hide();
            break;
          case "tipo-2":
            $("#tipo-1").hide();
            $("#tipo-2").show();
            break;
        }
      }).change();
    });
  </script>
  <!-- Primer crud de tipo 1 - expe 4 -->
  <script>
    $(document).ready(function() {
      $('.updateBtn1').on('click', function() {

        $('#actualizarmicroredes').modal('show');

        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);
        $('#id_4puntos').val(data[0]);
        $('#numero4').val(data[1]);
        $('#lugar4').val(data[2]);
        $('#cargo4').val(data[3]);
        $('#fecha_inicio4').val(data[4]);
        $('#fecha_fin4').val(data[5]);
        $('#archivos4').val(data[6]);

      });
    });

    $(document).ready(function() {
      $('.deleteBtn1').on('click', function() {

        $('#eliminarmicroredes').modal('show');
        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);
        $('#id4').val(data[0]);
      });
    });
  </script>
  <!-- Primer crud de tipo 1 - expe 3 -->
  <script>
    $(document).ready(function() {
      $('.updateBtn2').on('click', function() {

        $('#actualizarmicrotacna').modal('show');

        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);
        $('#id_3puntos').val(data[0]);
        $('#numero3').val(data[1]);
        $('#lugar3').val(data[2]);
        $('#cargo3').val(data[3]);
        $('#fecha_inicio3').val(data[4]);
        $('#fecha_fin3').val(data[5]);
        $('#archivos3').val(data[6]);

      });
    });

    $(document).ready(function() {
      $('.deleteBtn2').on('click', function() {

        $('#eliminarmicroredes2').modal('show');
        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);
        $('#id3').val(data[0]);
      });
    });
  </script>
  <!-- Primer crud de tipo 1 - expe 1 -->
  <script>
    $(document).ready(function() {
      $('.updateBtn3').on('click', function() {
        $('#actualizarpublicoprivado').modal('show');
        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();
        console.log(data);
        $('#id_1puntos').val(data[0]);
        $('#numero1').val(data[1]);
        $('#lugar1').val(data[2]);
        $('#cargo1').val(data[3]);
        $('#fecha_inicio1').val(data[4]);
        $('#fecha_fin1').val(data[5]);
        $('#archivos1').val(data[6]);

      });
    });

    $(document).ready(function() {
      $('.deleteBtn3').on('click', function() {

        $('#eliminarpublicoprivado').modal('show');
        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);
        $('#id1').val(data[0]);
      });
    });
  </script>

  <!-- Primer crud de tipo 2 - expe 4 -->
  <script>
    $(document).ready(function() {
      $('.updateBtn4').on('click', function() {

        $('#actualizar_tipo2').modal('show');

        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);
        $('#edit_id_4puntos_tipo2').val(data[0]);
        $('#numero4_tipo2').val(data[1]);
        $('#lugar4_tipo2').val(data[2]);
        $('#cargo4_tipo2').val(data[3]);
        $('#fecha_inicio4_tipo2').val(data[4]);
        $('#fecha_fin4_tipo2').val(data[5]);
        $('#expe_archivo4_tipo2').val(data[6]);
        $('#edit_tipo_comprobante_exp4_tip2').val(data[7]);
        $('#edit_nro_contrato_exp4_tip2').val(data[8]);
        $('#edit_fecha_boleta_exp4_tip2').val(data[9]);
        $('#edit_boleta_exp4_tip2').val(data[10]);
      });
    });

    $(document).ready(function() {
      $('.deleteBtn4').on('click', function() {

        $('#eliminar_tipo2').modal('show');
        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);
        $('#edit_id_4puntos_tipo2').val(data[0]);
      });
    });
  </script>

</body>

</html>