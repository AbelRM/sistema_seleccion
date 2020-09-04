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
        include 'funcs/mcript.php';
        
        $dato_desencriptado = $_GET['dni'];
        $dni = $desencriptar($dato_desencriptado);
        
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
            <div class="form-row d-flex justify-content-center">
                
							<div class="form-group col-md-6">
								<select name="select" id="inputSelect" class="form-control custom-select">
									<!-- <option selected disabled >ELEGIR LA OPCIÓN RECOMENDADA PARA USTED...</option> -->
									<?php
											$sql = mysqli_query($con,"SELECT * from tipo_cargo WHERE idtipo=$idtipo") or die("Problemas en consulta").mysqli_error();
											while ($registro=mysqli_fetch_array($sql)) {
											echo "<option value=\"tipo-".$registro['idtipo']."\">".$registro['tipo_cargo']."</option>";
											}
									?>
								</select>
							</div> 
            </div>
            <div class="grupo-form">
                <div id="tipo-1" class="divOculto">
                    <div class="form-row d-flex justify-content-center m-2">
                        <div class="col-lg-6 col-md-8">
                            <div class="card border-primary" style="font-size:13px;">
                                <div class="card-header header-formulario">
                                    <h5 class="card-title">DATOS GUARDADOS</h5>
                                </div>
                                <div class="card-body text-primary">
                                    <div class="form-group" style="color:red; font-size:16px; text-align:center;">
                                    <?php
                                        $resultado=$con->query("SELECT * FROM datos_profesionales WHERE postulante_idpostulante=$idpostulante");
                                        $nodatos=0;
                                        if (mysqli_num_rows($resultado)>0) {
                                            $nodatos=1;
                                            // $datos5=mysqli_query($con,$resultado);
                                            $fila5= mysqli_fetch_array($resultado);
                                            
                                        }else{
                                            $nodatos=0;
                                            echo "NO HAY DATOS GUARDADOS AÚN!";
                                        }
                                        ?>
                                    </div>
                                    <div class="form-row">

                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">Profesión</label>
                                            <input type="text" style="font-size:12px;" class="form-control" value="<?php if($nodatos==0){echo"SIN DATOS";}else{echo $fila5['profesion'];}?>" disabled>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">Fecha colegiatura</label>
                                            <input type="date" class="form-control" value="<?php echo $fila5['fecha_cole']?>" disabled >
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">Lugar colegiatura</label>
                                            <input type="text" style="font-size:12px;" class="form-control" value="<?php if($nodatos==0){echo"SIN DATOS";}else{echo $fila5['lugar_cole'];}?>" disabled >
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">Fecha de habilitación</label>
                                            <input type="date" class="form-control" value="<?php echo $fila5['fecha_habi'] ?>" disabled>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">N° colegiatura</label>
                                            <input type="text" style="font-size:12px;" class="form-control" value="<?php if($nodatos==0){echo"SIN DATOS";}else{echo $fila5['nro_cole'];}?>" disabled>
                                        </div>

                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Título profesional universitario</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                                <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['titulo_profesional'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Título de Especialidad</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                            <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['titulo_especialidad'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Egresado de especialidad</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                            <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['egresado_especialidad'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Grado de Maestría</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                            <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['grado_maestria'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Constancia de Egresado de Maestría</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                            <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['constancia_egre_maestria'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Grado de Doctorado</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                            <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['grado_doctorado'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Constancia de Egresado de Doctorado</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                            <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['constancia_egre_doctorado'];}?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-8" id="editar">
                            <div class="card border-primary" style="font-size:13px;">
                                <div class="card-header header-formulario">
                                    <h5 class="card-title">PROFESIONALES DE LA SALUD</h5>
                                </div>
                                <form action="procesos/guardar_prof_salud.php" method="POST">
                                    <div class="card-body text-primary">
                                        <?php

                                            $sql6="SELECT * FROM datos_profesionales WHERE postulante_idpostulante=$idpostulante";
                                            $datos6=mysqli_query($con,$sql6);
                                            if($con->query($sql6) == TRUE){
                                                $fila6= mysqli_fetch_array($datos6);
                                            }else{
                                                echo "NO HAY DATOS GUARDADOS AÚN!";
                                            }
                                        ?>
                                        <div class="form-row" >
                                            <input type="hidden" id="dni" name="dni" value="<?php echo $dni; ?>">
                                            <input type="hidden" id="idpostulante" name="idpostulante" value="<?php echo $idpostulante; ?>">
                                            <div class="col-md-6 form-group">
                                                <label for="exampleFormControlInput1">Profesión</label>
                                                <input type="text" class="form-control text-uppercase" style="font-size:13px" name="profesion" id="profesion" value="<?php if($nodatos==0){echo" ";}else{echo $fila5['profesion'];}?>"  required>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="exampleFormControlInput1">Fecha colegiatura</label>
                                                <input type="date" class="form-control" name="fecha_cole" id="fecha_cole"  value="<?php if($nodatos==0){echo" ";}else{echo $fila5['fecha_cole'];}?>">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="exampleFormControlInput1">Lugar colegiatura</label>
                                                <input type="text" class="form-control text-uppercase" style="font-size:13px" name="lugar_colegiatura" id="lugar_colegiatura" value="<?php if($nodatos==0){echo" ";}else{echo $fila5['lugar_cole'];}?>">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="exampleFormControlInput1">Fecha de habilitación</label>
                                                <input type="date" class="form-control" name="fecha_habi" id="fecha_habi" value="<?php if($nodatos==0){echo" ";}else{echo $fila5['fecha_habi'];}?>">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="exampleFormControlInput1">N° colegiatura</label>
                                                <input type="text" class="form-control" name="nro_colegiatura" id="nro_colegiatura" value="<?php if($nodatos==0){echo" ";}else{echo $fila5['nro_cole'];}?>">
                                            </div>

                                            <div class="col-9">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Título profesional universitario</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check form-check-inline">
                                                    <?php
                                                        //$valor_titulo = $fila6['titulo_profesional'];
                                                        //$resultado = "<option value='".$valor_titulo."' selected='selected'>‌";
                                                    ?>
                                                    <select name="titulo_profesional" id="titulo_profesion" class="form-control">
                                                        <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_profesional'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_profesional'];}?></option>
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
                                                    <select name="titulo_especialidad" id="titulo_especialidad" onchange="especialidad(this.value);" class="form-control">
                                                        <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_especialidad'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_especialidad'];}?></option>
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
                                                    <select name="egresado_especialidad" id="egresado_especialidad" onchange="egre_especialidad(this.value);" class="form-control">
                                                        <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['egresado_especialidad'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['egresado_especialidad'];}?></option>
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
                                                    <select name="grado_maestria" id="grado_maestria" onchange="maestria(this.value);" class="form-control">
                                                        <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['grado_maestria'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['grado_maestria'];}?></option>
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
                                                    <select name="constancia_egre_maestria" id="constancia_egre_maestria" onchange="egre_maestria(this.value);" class="form-control">
                                                        <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['constancia_egre_maestria'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['constancia_egre_maestria'];}?></option>
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
                                                    <select name="grado_doctorado" id="grado_doctorado" onchange="doctorado(this.value);" class="form-control">
                                                        <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['grado_doctorado'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['grado_doctorado'];}?></option>
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
                                                    <select name="constancia_egre_doctorado" id="constancia_egre_doctorado" onchange="egre_doctorado(this.value);" class="form-control">
                                                        <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['constancia_egre_doctorado'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['constancia_egre_doctorado'];}?></option>
                                                        <option value="NO">NO</option>
                                                        <option value="SI">SI</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row d-flex justify-content-center">
                                            <button class="btn btn-primary" type="submit">GUARDAR!</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tipo-2" class="divOculto">
                    <div class="form-row d-flex justify-content-center m-2">
                        <div class="col-lg-6 col-md-">
                            <div class="card border-danger" style="font-size:13px;">
                                <div class="card-header header-formulario-danger">
                                    <h5 class="card-title">DATOS GUARDADOS</h5>
                                </div>
                                <div class="card-body text-primary">
                                    <div class="form-group" style="color:red; font-size:16px; text-align:center;">
                                    <?php
                                        $resultado=$con->query("SELECT * FROM datos_profesionales WHERE postulante_idpostulante=$idpostulante");
                                        $nodatos=0;
                                        if (mysqli_num_rows($resultado)>0) {
                                            $nodatos=1;
                                            $fila5= mysqli_fetch_array($resultado);
                                            
                                        }else{
                                            $nodatos=0;
                                            echo "NO HAY DATOS GUARDADOS AÚN!";
                                        }
                                        ?>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">Profesión</label>
                                            <input type="text" style="font-size:12px;" class="form-control" value="<?php if($nodatos==0){echo"SIN DATOS";}else{echo $fila5['profesion'];}?>" disabled>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">Fecha colegiatura</label>
                                            <input type="date" class="form-control" value="<?php echo $fila5['fecha_cole']?>" disabled >
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">Lugar colegiatura</label>
                                            <input type="text" style="font-size:12px;" class="form-control" value="<?php if($nodatos==0){echo"SIN DATOS";}else{echo $fila5['lugar_cole'];}?>" disabled >
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">Fecha de habilitación</label>
                                            <input type="date" class="form-control" value="<?php echo $fila5['fecha_habi'] ?>" disabled>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">N° colegiatura</label>
                                            <input type="text" style="font-size:12px;" class="form-control" value="<?php if($nodatos==0){echo"SIN DATOS";}else{echo $fila5['nro_cole'];}?>" disabled>
                                        </div>

                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Título profesional universitario</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                                <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['titulo_profesional'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Grado de bachiller</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                                <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['grado_bachiller'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Título de Especialidad</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                            <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['titulo_especialidad'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Egresado de especialidad</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                            <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['egresado_especialidad'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Grado de Maestría</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                            <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['grado_maestria'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Constancia de Egresado de Maestría</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                            <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['constancia_egre_maestria'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Grado de Doctorado</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                            <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['grado_doctorado'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Constancia de Egresado de Doctorado</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                            <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['constancia_egre_doctorado'];}?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
													<div class="card border-danger" style="font-size:13px;">
														<div class="card-header header-formulario-danger">
																<h5 class="card-title">OTROS PROFESIONALES</h5>
														</div>
														<form action="procesos/guardar_otros_prof.php" method="POST">
															<div class="card-body">
																<?php
																		$sql6="SELECT * FROM datos_profesionales WHERE postulante_idpostulante=$idpostulante";
																		$datos6=mysqli_query($con,$sql6);
																		if($con->query($sql6) == TRUE){
																				$fila6= mysqli_fetch_array($datos6);
																		}else{
																				echo "NO HAY DATOS GUARDADOS AÚN!";
																		}
																?>
																<div class="form-row" >
																	<input type="hidden" id="dni" name="dni" value="<?php echo $dato_desencriptado; ?>">
																	<input type="hidden" id="idpostulante" name="idpostulante" value="<?php echo $idpostulante; ?>">
																	<div class="col-md-6 form-group">
																			<label for="exampleFormControlInput1">Profesión</label>
																			<input type="text" style="font-size:12px;" class="form-control text-uppercase" style="font-size:13px" name="profesion" id="profesion" value="<?php if($nodatos==0){echo" ";}else{echo $fila5['profesion'];}?>"  required>
																	</div>
																	<div class="col-md-6 form-group">
																			<label for="exampleFormControlInput1">Fecha colegiatura</label>
																			<input type="date" class="form-control" name="fecha_cole" id="fecha_cole"  value="<?php if($nodatos==0){echo" ";}else{echo $fila5['fecha_cole'];}?>">
																	</div>
																	<div class="col-md-6 form-group">
																			<label for="exampleFormControlInput1">Lugar colegiatura</label>
																			<input type="text" style="font-size:12px;" class="form-control text-uppercase" style="font-size:13px" name="lugar_colegiatura" id="lugar_colegiatura" value="<?php if($nodatos==0){echo" ";}else{echo $fila5['lugar_cole'];}?>">
																	</div>
																	<div class="col-md-6 form-group">
																			<label for="exampleFormControlInput1">Fecha de habilitación</label>
																			<input type="date" class="form-control" name="fecha_habi" id="fecha_habi" value="<?php if($nodatos==0){echo" ";}else{echo $fila5['fecha_habi'];}?>">
																	</div>
																	<div class="col-md-6 form-group">
																			<label for="exampleFormControlInput1">N° colegiatura</label>
																			<input type="text" style="font-size:12px;" class="form-control" name="nro_colegiatura" id="nro_colegiatura" value="<?php if($nodatos==0){echo" ";}else{echo $fila5['nro_cole'];}?>">
																	</div>

																	<div class="col-9">
																			<div class="form-group">
																					<label class="font-weight-bold">Título profesional universitario</label>
																			</div>
																	</div>
																	<div class="col-3">
																			<div class="form-check form-check-inline">
																					<select name="titulo_profesional" id="titulo_profesional" class="form-control" onchange="titulo(this.value);">
																							<option value="">Elegir...</option>
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
																					<select name="grado_bachiller" id="grado_bachiller" onchange="bachiller(this.value);" class="form-control">
																							<option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['grado_bachiller'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_profesional'];}?></option>
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
																					<select name="titulo_especialidad" id="titulo_especialidad" onchange="especialidad(this.value);" class="form-control">
																							<option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_especialidad'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_especialidad'];}?></option>
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
																					<select name="egresado_especialidad" id="egresado_especialidad" onchange="egre_especialidad(this.value);" class="form-control">
																							<option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['egresado_especialidad'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['egresado_especialidad'];}?></option>
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
																					<select name="grado_maestria" id="grado_maestria" onchange="maestria(this.value);" class="form-control">
																							<option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['grado_maestria'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['grado_maestria'];}?></option>
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
																					<select name="constancia_egre_maestria" id="constancia_egre_maestria" onchange="egre_maestria(this.value);" class="form-control">
																							<option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['constancia_egre_maestria'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['constancia_egre_maestria'];}?></option>
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
																					<select name="grado_doctorado" id="grado_doctorado" onchange="doctorado(this.value);" class="form-control">
																							<option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['grado_doctorado'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['grado_doctorado'];}?></option>
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
																					<select name="constancia_egre_doctorado" id="constancia_egre_doctorado" onchange="egre_doctorado(this.value);" class="form-control">
																							<option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['constancia_egre_doctorado'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['constancia_egre_doctorado'];}?></option>
																							<option value="NO">NO</option>
																							<option value="SI">SI</option>
																					</select>
																			</div>
																	</div>
																</div>
																<div class="form-row d-flex justify-content-center">
																		<button class="btn btn-primary" type="submit">GUARDAR!</button>
																</div>
															</div>
														</form>
												</div>
											</div>                    
                    </div>
                </div>
                <div id="tipo-3" class="divOculto">
                    <div class="form-row d-flex justify-content-center m-2">
                        <div class="col-lg-6 col-md-8">
                            <div class="card border-primary" style="font-size:13px;">
                                <div class="card-header header-formulario-danger">
                                    <h5 class="card-title">DATOS GUARDADOS</h5>
                                </div>
                                <div class="card-body text-primary">
                                    <div class="form-group" style="color:red; font-size:16px; text-align:center;">
                                    <?php
                                        $resultado=$con->query("SELECT * FROM datos_profesionales WHERE postulante_idpostulante=$idpostulante");
                                        $nodatos=0;
                                        if (mysqli_num_rows($resultado)>0) {
                                            $nodatos=1;
                                            $fila5= mysqli_fetch_array($resultado);
                                            
                                        }else{
                                            $nodatos=0;
                                            echo "NO HAY DATOS GUARDADOS AÚN!";
                                        }
                                        ?>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">Profesión</label>
                                            <input type="text" style="font-size:12px;" class="form-control" value="<?php if($nodatos==0){echo"SIN DATOS";}else{echo $fila5['profesion'];}?>" disabled>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">Fecha colegiatura</label>
                                            <input type="date" class="form-control" value="<?php echo $fila5['fecha_cole']?>" disabled >
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">Lugar colegiatura</label>
                                            <input type="text" style="font-size:12px;" class="form-control" value="<?php if($nodatos==0){echo"SIN DATOS";}else{echo $fila5['lugar_cole'];}?>" disabled >
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">Fecha de habilitación</label>
                                            <input type="date" class="form-control" value="<?php echo $fila5['fecha_habi'] ?>" disabled>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="exampleFormControlInput1">N° colegiatura</label>
                                            <input type="text" style="font-size:12px;" class="form-control" value="<?php if($nodatos==0){echo"SIN DATOS";}else{echo $fila5['nro_cole'];}?>" disabled>
                                        </div>

                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Título profesional universitario</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                                <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['titulo_profesional'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Grado de bachiller</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                                <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['grado_bachiller'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Título de Especialidad</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                            <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['titulo_especialidad'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Egresado de especialidad</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                            <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['egresado_especialidad'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Grado de Maestría</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                            <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['grado_maestria'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Constancia de Egresado de Maestría</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                            <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['constancia_egre_maestria'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Grado de Doctorado</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                            <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['grado_doctorado'];}?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label class="font-weight-normal"><i class="fas fa-angle-right"></i> Constancia de Egresado de Doctorado</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                            <input type="text" class="form-control" value="<?php if($nodatos==0){echo"-";}else{echo $fila5['constancia_egre_doctorado'];}?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-8">
                            <div class="card border-danger" style="font-size:13px;">
                                <div class="card-header header-formulario-danger">
                                    <h5 class="card-title">ASISTENTE ADMINISTRATIVO</h5>
                                </div>
                                <form action="procesos/guardar_prof_admin.php" method="POST">
                                    <div class="card-body text-danger">
                                        <?php
                                            $sql6="SELECT * FROM datos_profesionales WHERE postulante_idpostulante=$idpostulante";
                                            $datos6=mysqli_query($con,$sql6);
                                            if($con->query($sql6) == TRUE){
                                                $fila6= mysqli_fetch_array($datos6);
                                            }else{
                                                echo "NO HAY DATOS GUARDADOS AÚN!";
                                            }
                                        ?>
                                        <div class="form-row" >
                                            <input type="hidden" id="dni" name="dni" value="<?php echo $dni; ?>">
                                            <input type="hidden" id="idpostulante" name="idpostulante" value="<?php echo $idpostulante; ?>">
                                            <div class="col-md-6 form-group">
                                                <label for="exampleFormControlInput1">Profesión</label>
                                                <input type="text" class="form-control text-uppercase" style="font-size:13px" name="profesion" id="profesion" value="<?php if($nodatos==0){echo" ";}else{echo $fila5['profesion'];}?>"  required>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="exampleFormControlInput1">Fecha colegiatura</label>
                                                <input type="date" class="form-control" name="fecha_cole" id="fecha_cole"  value="<?php if($nodatos==0){echo" ";}else{echo $fila5['fecha_cole'];}?>">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="exampleFormControlInput1">Lugar colegiatura</label>
                                                <input type="text" class="form-control text-uppercase" style="font-size:13px" name="lugar_colegiatura" id="lugar_colegiatura" value="<?php if($nodatos==0){echo" ";}else{echo $fila5['lugar_cole'];}?>">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="exampleFormControlInput1">Fecha de habilitación</label>
                                                <input type="date" class="form-control" name="fecha_habi" id="fecha_habi" value="<?php if($nodatos==0){echo" ";}else{echo $fila5['fecha_habi'];}?>">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="exampleFormControlInput1">N° colegiatura</label>
                                                <input type="text" class="form-control" name="nro_colegiatura" id="nro_colegiatura" value="<?php if($nodatos==0){echo" ";}else{echo $fila5['nro_cole'];}?>">
                                            </div>

                                            <div class="col-9">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Título profesional universitario</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check form-check-inline">
                                                    <select name="titulo_profesional" id="titulo_profesional" class="form-control" onchange="titulo(this.value);">
                                                        <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_profesional'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_profesional'];}?></option>
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
                                                    <select name="grado_bachiller" id="grado_bachiller" onchange="bachiller(this.value);" class="form-control">
                                                        <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['grado_bachiller'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_profesional'];}?></option>
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
                                                    <select name="titulo_especialidad" id="titulo_especialidad" onchange="especialidad(this.value);" class="form-control">
                                                        <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_especialidad'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_especialidad'];}?></option>
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
                                                    <select name="egresado_especialidad" id="egresado_especialidad" onchange="egre_especialidad(this.value);" class="form-control">
                                                        <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['egresado_especialidad'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['egresado_especialidad'];}?></option>
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
                                                    <select name="grado_maestria" id="grado_maestria" onchange="maestria(this.value);" class="form-control">
                                                        <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['grado_maestria'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['grado_maestria'];}?></option>
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
                                                    <select name="constancia_egre_maestria" id="constancia_egre_maestria" onchange="egre_maestria(this.value);" class="form-control">
                                                        <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['constancia_egre_maestria'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['constancia_egre_maestria'];}?></option>
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
                                                    <select name="grado_doctorado" id="grado_doctorado" onchange="doctorado(this.value);" class="form-control">
                                                        <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['grado_doctorado'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['grado_doctorado'];}?></option>
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
                                                    <select name="constancia_egre_doctorado" id="constancia_egre_doctorado" onchange="egre_doctorado(this.value);" class="form-control">
                                                        <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['constancia_egre_doctorado'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['constancia_egre_doctorado'];}?></option>
                                                        <option value="NO">NO</option>
                                                        <option value="SI">SI</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row d-flex justify-content-center">
                                            <button class="btn btn-primary" type="submit">GUARDAR!</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tipo-4" class="divOculto">
                    <div class="form-row d-flex justify-content-center m-2">
                        <div class="col-md-8">
                            <div class="card border-danger">
                                <div class="card-header">
                                    <h5 class="titulo-card">TÉCNICO EN ENFERMERIA</h5>
                                </div>
                                <form action="procesos/guardar_tecnico.php" method="POST">
                                <div class="card-body">
                                    <div class="form-group" style="color:red; font-size:16px; text-align:center;">
                                        <?php
                                        $resultado=$con->query("SELECT * FROM datos_profesionales WHERE postulante_idpostulante=$idpostulante");
                                        $nodatos=0;
                                        if (mysqli_num_rows($resultado)>0) {
                                            $nodatos=1;
                                            $fila5= mysqli_fetch_array($resultado);
                                            
                                        }else{
                                            $nodatos=0;
                                            echo "NO HAY DATOS GUARDADOS AÚN!";
                                        }
                                        ?>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Título de Instituto Superior Tecnológico (acreditado)</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select name="titulo_instituto" id="titulo_instituto" class="form-control">
                                                    <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_instituto'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_instituto'];}?></option>
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row d-flex justify-content-center">
                                        <button class="btn btn-primary" type="submit">GUARDAR!</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tipo-5" class="divOculto">
                    <div class="form-row d-flex justify-content-center m-2">
                        <div class="col-md-8">
                            <div class="card border-danger">
                                <div class="card-header">
                                    <h5 class="titulo-card">TÉCNICO ADMINISTRATIVO</h5>
                                </div>
                                <form action="procesos/guardar_tecnico_admin.php" method="POST">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Egresado Universitario</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select name="egresado_uni" id="egresado_uni" class="form-control">
                                                <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['egresado_universitario'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['egresado_universitario'];}?></option>
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
                                                <select name="titulo_tecnico" id="titulo_tecnico" class="form-control">
                                                    <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_instituto'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_instituto'];}?></option>
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
                <div id="tipo-6" class="divOculto">
                    <div class="form-row d-flex justify-content-center m-2">
                        <div class="col-md-8">
                            <div class="card border-danger">
                                <div class="card-header">
                                    <h5 class="titulo-card">TÉCNICO ADMINISTRATIVO</h5>
                                </div>
                                <form action="procesos/guardar_tecnico_admin.php" method="POST">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Egresado Universitario</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select name="egresado_uni" id="egresado_uni" class="form-control">
                                                <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['egresado_universitario'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['egresado_universitario'];}?></option>
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
                                                <select name="titulo_tecnico" id="titulo_tecnico" class="form-control">
                                                    <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_instituto'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_instituto'];}?></option>
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
                <div id="tipo-7" class="divOculto">
                    <div class="form-row d-flex justify-content-center m-2">
                        <div class="col-md-8">
                            <div class="card border-danger">
                                <div class="card-header">
                                    <h5 class="titulo-card">SECRETARIA</h5>
                                </div>
                                <form action="procesos/guardar_secretaria.php" method="POST">
                                <div class="card-body">
                                    <div class="form-group" style="color:red; font-size:16px; text-align:center;">
                                        <?php
                                        $resultado=$con->query("SELECT * FROM datos_profesionales WHERE postulante_idpostulante=$idpostulante");
                                        $nodatos=0;
                                        if (mysqli_num_rows($resultado)>0) {
                                            $nodatos=1;
                                            $fila5= mysqli_fetch_array($resultado);
                                            
                                        }else{
                                            $nodatos=0;
                                            echo "NO HAY DATOS GUARDADOS AÚN!";
                                        }
                                        ?>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Título de Instituto Superior Tecnológico (acreditado)</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select name="titulo_instituto" id="titulo_instituto" class="form-control">
                                                    <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_instituto'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_instituto'];}?></option>
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row d-flex justify-content-center">
                                        <button class="btn btn-primary" type="submit">GUARDAR!</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tipo-8" class="divOculto">
                    <div class="form-row formulario d-flex justify-content-center m-2">
                        <div class="col-md-8">
                            <div class="card border-danger">
                                <div class="card-header">
                                    <h5 class="titulo-card">TÉCNICO EN INFORMÁTICA</h5>
                                </div>
                                <form action="procesos/guardar_tecnico_v2.php" method="POST">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Egresado Universitario</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select name="egresado_uni" id="egresado_uni" class="form-control">
                                                <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['egresado_universitario'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['egresado_universitario'];}?></option>
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
                                                <select name="titulo_tecnico" id="titulo_tecnico" class="form-control">
                                                    <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_instituto'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['titulo_instituto'];}?></option>
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
                <div id="tipo-9" class="divOculto">
                    <div class="form-row d-flex justify-content-center m-2">
                        <div class="col-md-8">
                            <div class="card border-danger">
                                <div class="card-header">
                                    <h5 class="titulo-card">AUXILIAR ADMINISTRATIVO</h5>
                                </div>
                                <form action="procesos/guardar_secundaria.php" method="POST">
                                <div class="card-body">
                                    <div class="form-group" style="color:red; font-size:16px; text-align:center;">
                                        <?php
                                        $resultado=$con->query("SELECT * FROM datos_profesionales WHERE postulante_idpostulante=$idpostulante");
                                        $nodatos=0;
                                        if (mysqli_num_rows($resultado)>0) {
                                            $nodatos=1;
                                            $fila5= mysqli_fetch_array($resultado);
                                            
                                        }else{
                                            $nodatos=0;
                                            echo "NO HAY DATOS GUARDADOS AÚN!";
                                        }
                                        ?>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Secundaria completa</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select name="secundaria_comple" id="secundaria_comple" class="form-control">
                                                    <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['secundaria_comple'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['secundaria_comple'];}?></option>
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row d-flex justify-content-center">
                                        <button class="btn btn-primary" type="submit">GUARDAR!</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tipo-10" class="divOculto">
                    <div class="form-row d-flex justify-content-center m-2">
                        <div class="col-md-8">
                            <div class="card border-danger ">
                                <div class="card-header">
                                    <h5 class="titulo-card">CHOFER</h5>
                                </div>
                                <form action="procesos/guardar_secundaria.php" method="POST">
                                <div class="card-body">
                                    <div class="form-group" style="color:red; font-size:16px; text-align:center;">
                                        <?php
                                        $resultado=$con->query("SELECT * FROM datos_profesionales WHERE postulante_idpostulante=$idpostulante");
                                        $nodatos=0;
                                        if (mysqli_num_rows($resultado)>0) {
                                            $nodatos=1;
                                            $fila5= mysqli_fetch_array($resultado);
                                            
                                        }else{
                                            $nodatos=0;
                                            echo "NO HAY DATOS GUARDADOS AÚN!";
                                        }
                                        ?>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Secundaria completa</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select name="secundaria_comple" id="secundaria_comple" class="form-control">
                                                    <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['secundaria_comple'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['secundaria_comple'];}?></option>
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
                <div id="tipo-11" class="divOculto">
                    <div class="form-row d-flex justify-content-center m-2">
                        <div class="col-md-8">
                            <div class="card border-danger ">
                                <div class="card-header">
                                    <h5 class="titulo-card">VIGILANTE</h5>
                                </div>
                                <form action="procesos/guardar_secundaria.php" method="POST">
                                <div class="card-body">
                                    <div class="form-group" style="color:red; font-size:16px; text-align:center;">
                                        <?php
                                        $resultado=$con->query("SELECT * FROM datos_profesionales WHERE postulante_idpostulante=$idpostulante");
                                        $nodatos=0;
                                        if (mysqli_num_rows($resultado)>0) {
                                            $nodatos=1;
                                            $fila5= mysqli_fetch_array($resultado);
                                            
                                        }else{
                                            $nodatos=0;
                                            echo "NO HAY DATOS GUARDADOS AÚN!";
                                        }
                                        ?>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Secundaria completa</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select name="secundaria_comple" id="secundaria_comple" class="form-control">
                                                    <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['secundaria_comple'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['secundaria_comple'];}?></option>
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
                <div id="tipo-12" class="divOculto">
                    <div class="form-row d-flex justify-content-center m-2">
                        <div class="col-md-8">
                            <div class="card border-danger ">
                                <div class="card-header">
                                    <h5 class="titulo-card">TRABJADOR DE LIMPIEZA</h5>
                                </div>
                                <form action="procesos/guardar_secundaria.php" method="POST">
                                <div class="card-body">
                                    <div class="form-group" style="color:red; font-size:16px; text-align:center;">
                                        <?php
                                        $resultado=$con->query("SELECT * FROM datos_profesionales WHERE postulante_idpostulante=$idpostulante");
                                        $nodatos=0;
                                        if (mysqli_num_rows($resultado)>0) {
                                            $nodatos=1;
                                            $fila5= mysqli_fetch_array($resultado);
                                            
                                        }else{
                                            $nodatos=0;
                                            echo "NO HAY DATOS GUARDADOS AÚN!";
                                        }
                                        ?>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Secundaria completa</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select name="secundaria_comple" id="secundaria_comple" class="form-control">
                                                    <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['secundaria_comple'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['secundaria_comple'];}?></option>
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
                <div id="tipo-13" class="divOculto">
                    <div class="form-row d-flex justify-content-center m-2">
                        <div class="col-md-8">
                            <div class="card border-danger ">
                                <div class="card-header">
                                    <h5 class="titulo-card">TRABAJADOR DE SERVICIOS</h5>
                                </div>
                                <form action="procesos/guardar_secundaria.php" method="POST">
                                <div class="card-body">
                                    <div class="form-group" style="color:red; font-size:16px; text-align:center;">
                                        <?php
                                        $resultado=$con->query("SELECT * FROM datos_profesionales WHERE postulante_idpostulante=$idpostulante");
                                        $nodatos=0;
                                        if (mysqli_num_rows($resultado)>0) {
                                            $nodatos=1;
                                            $fila5= mysqli_fetch_array($resultado);
                                            
                                        }else{
                                            $nodatos=0;
                                            echo "NO HAY DATOS GUARDADOS AÚN!";
                                        }
                                        ?>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Secundaria completa</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-check-inline">
                                                <select name="secundaria_comple" id="secundaria_comple" class="form-control">
                                                    <option value="<?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['secundaria_comple'];}?>" selected><?php if($nodatos==0){echo"Elegir...";}else{echo $fila5['secundaria_comple'];}?></option>
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
    <script>
        var abc = '<?php echo $valor_titulo ?>';
        console.log(abc); 
        $("#tituloProfesional> option[value='abc']").attr("selected",true);
    </script>

    <script src="js/funciones.js"></script>

</body>

</html>
