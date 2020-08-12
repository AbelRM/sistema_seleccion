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
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <link href="css/estilos.css" rel="stylesheet">

</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">  
    <?php     
        $dni = $_GET['dni'];
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
            <?php
                include 'conexion.php';
        
                $sql2="SELECT * FROM postulante WHERE dni=$dni";
                $datos2=mysqli_query($con,$sql2) or die(mysqli_error()); ;
                $fila2= mysqli_fetch_array($datos2);
                $idpostulante=$fila2['idpostulante'];

                $sql3="SELECT MAX(iddetalle_convocatoria) AS id FROM sistema_seleccion.detalle_convocatoria
                WHERE postulante_idpostulante=$idpostulante";
                $datos3=mysqli_query($con,$sql3) or die(mysqli_error());
                $row3 = mysqli_fetch_row($datos3);
                $id = trim($row3[0]);

                $sql4="SELECT * from detalle_convocatoria 
                inner join total_personal_req on detalle_convocatoria.personal_req_idpersonal=total_personal_req.idpersonal 
                inner join convocatoria on detalle_convocatoria.convocatoria_idcon=convocatoria.idcon WHERE iddetalle_convocatoria=$id";
                $datos4=mysqli_query($con,$sql4) or die(mysqli_error());
                $fila4= mysqli_fetch_array($datos4);
                $iddetalle_conv=$fila4['iddetalle_convocatoria'];
                $idtipo = $fila4['idtipo'];


            ?>
          <!-- Page Heading -->
            <!-- Content Row -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h5 class="mb-0 text-gray-800">MIS DATOS PROFESIONALES:</h5>
            </div>
            <div class="form-group">
                <p class="font-weight-bold" style="color:#000; font-size:16px">NOTA: Todos los datos que ingrese deben ser 
                <span style="color:red;">verídicos</span>, en caso de contrario será 
                <span style="color:red;">betado de las futuras postulaciones</span> para DIRESA - TACNA.</p>
            </div>
            <div class="form-row d-flex justify-content-center">
                <?php
                    include_once('conexion.php');
                    $sql = mysqli_query($con,"SELECT * from tipo_cargo WHERE idtipo=$idtipo") or die("Problemas en consulta").mysqli_error();
                    $registro=mysqli_fetch_array($sql)
                ?>

                <p style="color:#000;">PARA SU CASO SELECCIONE <span class="font-weight-bold" style="color:red; font-size:22px;"><?php echo $registro['tipo_cargo'];?></span>  DE LA LISTA</p>
                <div class="form-group col-md-6">
                    <select name="id_tipo_cargo" id="id_tipo_cargo" class="form-control">
                        <option selected>Elegir...</option>
                        <option value="tipo-1" style="color:red; font-weight:600;">PROFESIONAL DE LA SALUD</option>
                        <option value="tipo-2" style="color:#1cc88a; font-weight:600;">OTROS PROFESIONALES</option>
                        <option value="tipo-3" style="color:#1cc88a; font-weight:600;">ASISTENTE ADMINISTRATIVO</option>
                        <option value="tipo-4" style="color:red; font-weight:600;">TÉCNICO EN ENFERMERIA</option>
                        <option value="tipo-5" style="color:#1cc88a; font-weight:600;">TÉCNICO ADMINISTRATIVO</option>
                        <option value="tipo-6" style="color:#1cc88a; font-weight:600;">TÉCNICO EN COMUNICACIONES</option>
                        <option value="tipo-7" style="color:#1cc88a; font-weight:600;">SECRETARIA</option>
                        <option value="tipo-8" style="color:#1cc88a; font-weight:600;">TÉCNICO EN INFORMÁTICA</option>
                        <option value="tipo-9" style="color:#1cc88a; font-weight:600;">AUXLIAR ADMINISTRATIVO</option>
                        <option value="tipo-10" style="color:#1cc88a; font-weight:600;">CHOFER</option>
                        <option value="tipo-10" style="color:#1cc88a; font-weight:600;">VIGILANTE</option>
                        <option value="tipo-10" style="color:#1cc88a; font-weight:600;">TRABAJADOR DE LIMPIEZA</option>
                        <option value="tipo-10" style="color:#1cc88a; font-weight:600;">TRABAJADOR DE SERVICIOS</option>
                    </select>
                </div>
            </div>
            <div class="grupo-form">
                <!-- FORMULARIO MICRORED -->
                <div id="tipo-1" class="formulario" style="display: none;">
                    <div class="form-row d-flex justify-content-center m-2">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="titulo-card">Título y/o grado alcanzado (PROFESIONALES DE LA SALUD)</h5>
                                </div>
                                <form action="procesos/guardar_prof_salud.php" method="POST">
                                    <div class="card-body">
                                        <div class="form-row">
                                            <input type="hidden" id="id_detalle_convocatoria" name="id_detalle_convocatoria" value="<?php echo $iddetalle_conv ?>">
                                            <div class="col-md-6 form-group">
                                                <label for="exampleFormControlInput1">Profesión</label>
                                                <input type="text" class="form-control" name="profesion" id="profesion" class="text-uppercase" >
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="exampleFormControlInput1">Fecha colegiatura</label>
                                                <input type="date" class="form-control" name="fech_colegiatura" id="fech_colegiatura" class="text-uppercase" >
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="exampleFormControlInput1">Lugar colegiatura</label>
                                                <input type="text" class="form-control" name="lugar_colegiatura" id="lugar_colegiatura" class="text-uppercase" >
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="exampleFormControlInput1">Fecha hasta la cual se encuentra habilitado</label>
                                                <input type="date" class="form-control" name="fech_hasta_colegiatura" id="fech_hasta_colegiatura" class="text-uppercase" >
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="exampleFormControlInput1">N° colegiatura</label>
                                                <input type="text" class="form-control" name="nro_colegiatura" id="nro_colegiatura" class="text-uppercase" >
                                            </div>

                                            <div class="col-9">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Título profesional universitario</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check form-check-inline">
                                                    <select name="titulo_profesional" class="form-control">
                                                        <option value="NO">NO</option>
                                                        <option value="SI">SI</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Título de Especialidad (SOLO ELEGIR UNO)</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check form-check-inline">
                                                    <select name="titulo_especialidad" class="form-control">
                                                        <option value="NO">NO</option>
                                                        <option value="SI">SI</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="form-group">
                                                    <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Egresado de especialidad</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check form-check-inline">
                                                    <select name="egresado_especialidad" class="form-control">
                                                        <option value="NO">NO</option>
                                                        <option value="SI">SI</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Grado de Maestría (acreditado - SOLO ELEGIR UNO *)</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check form-check-inline">
                                                    <select name="grado_maestria" class="form-control">
                                                        <option value="NO">NO</option>
                                                        <option value="SI">SI</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="form-group">
                                                    <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Constancia de Egresado de Maestría</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check form-check-inline">
                                                    <select name="constancia_egre_maestria" class="form-control">
                                                        <option value="NO">NO</option>
                                                        <option value="SI">SI</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Grado de Doctorado (acreditado - SOLO ELEGIR UNO *)</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check form-check-inline">
                                                    <select name="grado_doctorado" class="form-control">
                                                        <option value="NO">NO</option>
                                                        <option value="SI">SI</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="form-group">
                                                    <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Constancia de Egresado de Doctorado (acreditado *)</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check form-check-inline">
                                                    <select name="constancia_egre_doctorado" class="form-control">
                                                        <option value="NO">NO</option>
                                                        <option value="SI">SI</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tipo-2" class="formulario" style="display: none;">
                    <div class="form-row formulario d-flex justify-content-center m-2">
                        <div class="col-md-8">
                            <div class="card border-danger titulos-3">
                                <div class="card-header titulos-3">
                                    <h5 class="titulo-card">Título y/o grado alcanzado (OTROS PROFESIONALES)</h5>
                                </div>
                                <div class="card-body titulos-3">
                                    <div class="form-row">
                                        <input type="hidden" id="id_detalle_convocatoria" name="id_detalle_convocatoria" value="<?php echo $iddetalle_conv ?>">
                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">Profesión</label>
                                            <input type="text" class="form-control" name="profesion" id="profesion" class="text-uppercase" >
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">Fecha colegiatura</label>
                                            <input type="date" class="form-control" name="fech_colegiatura" id="fech_colegiatura" class="text-uppercase" >
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">Lugar colegiatura</label>
                                            <input type="text" class="form-control" name="lugar_colegiatura" id="lugar_colegiatura" class="text-uppercase" >
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">Fecha hasta la cual se encuentra habilitado</label>
                                            <input type="date" class="form-control" name="fech_hasta_colegiatura" id="fech_hasta_colegiatura" class="text-uppercase" >
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">N° colegiatura</label>
                                            <input type="text" class="form-control" name="nro_colegiatura" id="nro_colegiatura" class="text-uppercase" >
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Título profesional universitario</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Título de Especialidad</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Grado de Bachiller</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Egresado de especialidad</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Grado de Maestría (acreditado *)</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Constancia de Egresado de Maestría</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Grado de Doctorado (acreditado *)</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Constancia de Egresado de Doctorado (acreditad)</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tipo-3" class="formulario" style="display: none;">
                    <div class="form-row formulario d-flex justify-content-center m-2">
                        <div class="col-md-8">
                            <div class="card border-danger titulos-3">
                                <div class="card-header titulos-3">
                                    <h5 class="titulo-card">Título y/o grado alcanzado (ASISTENTE ADMINISTRATIVO)</h5>
                                </div>
                                <div class="card-body titulos-3">
                                    <div class="form-row">
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Título profesional universitario</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Título de Especialidad</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Grado de Bachiller</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Egresado de especialidad</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Grado de Maestría (acreditado *)</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Constancia de Egresado de Maestría</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Grado de Doctorado (acreditado *)</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Constancia de Egresado de Doctorado (acreditad)</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="tipo-4" class="formulario" style="display: none;">
                    <div class="form-row formulario d-flex justify-content-center m-2">
                        <div class="col-md-8 titulos-4">
                            <div class="card border-danger titulos-4">
                                <div class="card-header titulos-4">
                                    <h5 class="titulo-card">TÉCNICO EN ENFERMERIA</h5>
                                </div>
                                <div class="card-body titulos-4">
                                    <div class="form-row">
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Título de Instituto Superior Tecnológico (acreditado)</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tipo-5" class="formulario" style="display: none;">
                    <div class="form-row formulario d-flex justify-content-center m-2">
                        <div class="col-md-8 titulos-5">
                            <div class="card border-danger titulos-5">
                                <div class="card-header titulos-5">
                                    <h5 class="titulo-card">TÉCNICO ADMINISTRATIVO</h5>
                                </div>
                                <div class="card-body titulos-5">
                                    <div class="form-row titulos-5">
                                        <div class="col-9 titulos-5">
                                            <div class="form-group titulos-5">
                                                <label class="font-weight-bold">Egresado Universitario</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Título de Instituto Superior Tecnológico</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div id="tipo-6" class="formulario" style="display: none;">
                    <div class="form-row formulario d-flex justify-content-center m-2">
                        <div class="col-md-8 titulos-5">
                            <div class="card border-danger titulos-5">
                                <div class="card-header titulos-5">
                                    <h5 class="titulo-card">TÉCNICO EN COMUNICACIONES</h5>
                                </div>
                                <div class="card-body titulos-5">
                                    <div class="form-row titulos-5">
                                        <div class="col-9 titulos-5">
                                            <div class="form-group titulos-5">
                                                <label class="font-weight-bold">Egresado Universitario</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Título de Instituto Superior Tecnológico</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 

                <div id="tipo-7" class="formulario" style="display: none;">
                    <div class="form-row formulario d-flex justify-content-center m-2">
                        <div class="col-md-8 titulos-4">
                            <div class="card border-danger titulos-4">
                                <div class="card-header titulos-4">
                                    <h5 class="titulo-card">SECRETARIA</h5>
                                </div>
                                <div class="card-body titulos-4">
                                    <div class="form-row">
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Título de Instituto Superior Tecnológico (acreditado)</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tipo-8" class="formulario" style="display: none;">
                    <div class="form-row formulario d-flex justify-content-center m-2">
                        <div class="col-md-8 titulos-5">
                            <div class="card border-danger titulos-5">
                                <div class="card-header titulos-5">
                                    <h5 class="titulo-card">TÉCNICO EN INFORMÁTICA</h5>
                                </div>
                                <div class="card-body titulos-5">
                                    <div class="form-row titulos-5">
                                        <div class="col-9 titulos-5">
                                            <div class="form-group titulos-5">
                                                <label class="font-weight-bold">Egresado Universitario</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Título de Instituto Superior Tecnológico</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div id="tipo-9" class="formulario" style="display: none;">
                    <div class="form-row formulario d-flex justify-content-center m-2">
                        <div class="col-md-8 titulos-6">
                            <div class="card border-danger titulos-6">
                                <div class="card-header titulos-6">
                                    <h5 class="titulo-card">AUXILIAR ADMINISTRATIVO</h5>
                                </div>
                                <div class="card-body titulos-6">
                                    <div class="form-row">
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Secundaria completa</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tipo-10" class="formulario" style="display: none;">
                    <div class="form-row formulario d-flex justify-content-center m-2">
                        <div class="col-md-8 titulos-7">
                            <div class="card border-danger titulos-7">
                                <div class="card-header titulos-7">
                                    <h5 class="titulo-card">CHOFER - VIGILANTE - TRABJADOR DE LIMPIEZA - TRABAJADOR DE SERVICIOS</h5>
                                </div>
                                <div class="card-body titulos-7">
                                    <div class="form-row">
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Secundaria completa</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select class="form-control">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    
    <script type="text/javascript">
        $("#id_tipo_cargo").on('change', function(){
            $('.formulario').hide();
            $('#' + this.value).show();
        });
    </script>




</body>

</html>
