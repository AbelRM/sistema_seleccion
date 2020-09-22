<?php
  include 'conexion.php';
  include 'funcs/mcript.php';
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

          $consulta="SELECT * FROM postulante where dni=$dni";
          $datos=mysqli_query($con,$consulta) or die(mysqli_error()); ;
          $row= mysqli_fetch_array($datos);
          $idpostulante=$row['idpostulante'];

          $consulta1="SELECT * FROM detalle_convocatoria where postulante_idpostulante=$idpostulante";
          $datos1=mysqli_query($con,$consulta1) or die(mysqli_error()); ;
          $row1= mysqli_fetch_array($datos1);
          $iddetalle_con=$row1['iddetalle_convocatoria'];

          $consulta2="SELECT * FROM datos_profesionales where postulante_idpostulante=$idpostulante";
          $datos2=mysqli_query($con,$consulta2) or die(mysqli_error()); ;
          $row2= mysqli_fetch_array($datos2);
        ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
            <!-- Content Row -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h5 class="mb-0 text-gray-800">MIS DATOS ACADÉMICOS:</h5>
            </div>
            <div class="row">
              <div class="col-10 p-0">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-end">
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Nuevo</a>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-md-12 p-2 d-flex justify-content-center">
                                            <h3 class="text-xs font-weight-bold text-danger text-uppercase mb-1">Estudios superiores</h3>
                                        </div>
                                        <div class="col-md-12 p-2">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">  
                                                    <thead>
                                                        <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                                                            <th>N°</th>
                                                            <th>Centro de estudios</th>
                                                            <th>Especialidad</th>
                                                            <th>Fecha Inicio</th>
                                                            <th>Fecha Término</th>
                                                            <th>Nivel</th>
                                                            <th>Archivo</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $sql1 = "SELECT * FROM estudios_superiores WHERE idpostulante_postulante = $idpostulante";
                                                            $query1=mysqli_query($con, $sql1);
                                                            if(mysqli_num_rows($query1)>0){
                                                                while ($row1= MySQLI_fetch_array($query1))
                                                                {
                                                                ?>
                                                                    <tr>
                                                                        <td style="font-size: 12px;"><?php echo $row1['idestudios'];?></td>
                                                                        <td style="font-size: 12px;"><?php echo $row1['centro_estu']; ?></td>
                                                                        <td style="font-size: 12px;"><?php echo $row1['especialidad']; ?></td>
                                                                        <td style="font-size: 12px;"><?php echo $row1['fech_ini'] ?></td>
                                                                        <td style="font-size: 12px;"><?php echo $row1['fech_fin'] ?></td>
                                                                        <td style="font-size: 12px;"><?php echo $row1['nivel'] ?></td>
                                                                        <td><a href="ver_estudiossup.php?id=<?php echo $row1['idestudios']?>&dni=<?php echo $dato_desencriptado ?>"><?php echo $row1['archivo']; ?></a></td>
                                                                        
                                                                        <td class="d-flex justify-content-center">
                                                                            <button class="btn btn-success btn-sm m-1 updateBtn"><i class="fa fa-edit"></i></button>
                                                                            <button class="btn btn-danger btn-sm m-1 deleteBtn"><i class="fa fa-times-circle"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                
                                                                }
                                                        }else{
                                                            echo "<tr>
                                                            <td colspan='7' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td>
                                                            </tr>";
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

                    <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-end">
                                       
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#postgrado"><i class="fas fa-plus"></i>Nuevo</button>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-md-12 p-2 d-flex justify-content-center">
                                            <h3 class="text-xs font-weight-bold text-success  text-uppercase mb-1">Estudios Postgrado</h3>
                                        </div>
                                        <div class="col-md-12 p-2">
                                            <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                                                    <th>N°</th>
                                                    <th>Centro de estudios</th> 
                                                    <th>Especialidad</th> 
                                                    <th>Tipo</th>
                                                    <th>Fecha Inicio</th>
                                                    <th>Fecha Fin</th>
                                                    <th>Nivel</th>
                                                    <th>Archivo</th>
                                                    <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        <?php  
                                                                                                     
                                                        $consulta3 = "SELECT * FROM maestria_doc WHERE idpostulante_postulante = $idpostulante";
                                                        $query=mysqli_query($con, $consulta3);
                                                        if(mysqli_num_rows($query)>0){
                                                        while ($row3= MySQLI_fetch_array($query))
                                                        {
                                                        ?>
                                                        <tr>
                                                            <td style="font-size: 12px;"><?php echo $row3['idmaestria_doc'] ?></td>
                                                            <td style="font-size: 12px;"><?php echo $row3['centro_estu'] ?></td> 
                                                            <td style="font-size: 12px;"><?php echo $row3['especialidad']?></td>    
                                                            <td style="font-size: 12px;"><?php echo $row3['tipo_estu']?></td>         
                                                            <td style="font-size: 12px;"><?php echo $row3['fech_ini']?></td>
                                                            <td style="font-size: 12px;"><?php echo $row3['fech_fin']?></td>
                                                            <td style="font-size: 12px;"><?php echo $row3['nivel']; ?></td>
                                                            <td><a href="verpostgrado.php?id=<?php echo $row3['idmaestria_doc']?>&dni=<?php echo $dato_desencriptado ?>"><?php echo $row3['archivo']; ?></a></td>
                                                            <td class="d-flex justify-content-center">
                                                            <button class="btn btn-success btn-sm m-1 updateBtn1"><i class="fa fa-edit"></i></button>
                                                            <button class="btn btn-danger btn-sm m-1 deleteBtn1"><i class="fa fa-times-circle"></i></button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                          }
                                                        }else{
                                                        echo "<tr>
                                                        <td colspan='7' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td>
                                                        </tr>";
                                                    }
                                                        ?> 
                                                </tbody>
                                            </table>
                                            </div>
                                        </div> 
                                       <!-- <div class="col-md-12"> 
                                        <form action="procesos/guardar_postgrado.php" method="POST">
                                            <div class="modal-body">
                                                <div class="table-responsive">
                                                    <label>Estudios Postgrado (Maestrias - Doctorados)</label>
                                                    <input type="hidden" id="dni" name="dni" value="<?php echo $dato_desencriptado; ?>">                                                     
                                                    <input type="hidden" id="idpostulante" name="idpostulante" value="<?php echo $idpostulante; ?>">
                                                    <table class="table table-bordered" id="tabla-8">
                                                        <thead>
                                                        <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                                            <th  scope="col">Centro Estudios</th>
                                                            <th  scope="col">Especialidad</th>
                                                            <th  scope="col">Tipo Estudios</th>
                                                            <th  scope="col">Fecha Inicio</th>
                                                            <th  scope="col">Fecha Termino</th>
                                                            <th  scope="col">Nivel Alcanzado</th>
                                                            <th  scope="col">Acción</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                          <tr class="fila-fija-7">
                                                            <td><input style="width: 200px;font-size: 12px;" type="text" name="centro_estu[]" class="form-control name_list" required/></td>
                                                            <td><input style="width: 200px;font-size: 12px;" type="text" name="especialidad[]"  class="form-control name_list" required/></td>
                                                            <td>
                                                              <select style="font-size: 12px;" name="tipo_estu[]" class="form-control" id="tipo_estu[]" required>
                                                                <option disabled>Elegir</option>
                                                                <option value="MAESTRIA">Maestria </option>
                                                                <option value="DOCTORADO">Doctorado</option>
                                                              </select>
                                                            </td>
                                                            <td><input style="width: 150px;font-size: 12px;" type="date" name="fech_ini[]" class="form-control name_list" required/></td>
                                                            <td><input style="width: 150px;font-size: 12px;" type="date" name="fech_fin[]" class="form-control name_list" required/></td>
                                                            <td>
                                                              <select style="font-size: 12px;" name="nivel[]" class="form-control" id="nivel[]" required>
                                                                <option disableds>Elegir</option>
                                                                <option value="MAGISTER">Magister</option>
                                                                <option value="DOCTORADO">Doctorado</option>
                                                                <option value="EGRESADO">Egresado</option>
                                                                <option value="ESTUDIANTE">Estudiante</option>
                                                              </select>
                                                            </td>
                                                            <td class="eliminar"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                                                          </tr>
                                                        </tdody>
                                                    </table>
                                                </div>
                                                <div class="row d-flex justify-content-center">
                                                    <div class="form-inline p-2">
                                                        <button id="adicional-8" name="adicional" type="button" class="btn btn-warning"> Agregar Fila (+) </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                                <button class="btn btn-primary" name="insertar" type="submit" >Guardar</button>
                                            </div>
                                        </form>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-end">
                                          
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#diplomados"><i class="fas fa-plus"></i>Nuevo</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 p-2 d-flex justify-content-center">
                                            <h3 class="text-xs font-weight-bold text-info  text-uppercase mb-1">Diplomados - cursos - seminarios</h3>
                                        </div>
                                        <div class="col-md-12 p-2">
                                            <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                              <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                                                <th>N°</th>
                                                <th>Centro de estudios</th>
                                                <th>Nombre de materia</th>
                                                <th>Horas</th>
                                                <th>Fecha Inicio</th>
                                                <th>Fecha Fin</th>
                                                <th>Tipo</th>
                                                <th>Archivo</th>
                                                <th>Acciones</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                              $consulta3 = "SELECT * FROM cursos_extra WHERE curso_extra_idpostulante = $idpostulante";
                                              $query=mysqli_query($con, $consulta3);
                                              if(mysqli_num_rows($query)>0){
                                              while ($row3= MySQLI_fetch_array($query))
                                              {
                                              ?>
                                              <tr>
                                                <td style="font-size: 12px;"><?php echo $row3['idcursos_extra'] ?></td>
                                                <td style="font-size: 12px;"><?php echo $row3['centro_estu'] ?></td>
                                                <td style="font-size: 12px;"><?php echo $row3['materia']?></td>
                                                <td style="font-size: 12px;"><?php echo $row3['horas']?></td>
                                                <td style="font-size: 12px;"><?php echo $row3['fech_ini']?></td>
                                                <td style="font-size: 12px;"><?php echo $row3['fech_fin']?></td>
                                                <td style="font-size: 12px;"><?php echo $row3['tipo']?></td>
                                                <td><a href="ver_diplomados.php?id=<?php echo $row3['idcursos_extra']?>&dni=<?php echo $dato_desencriptado ?>"><?php echo $row3['archivo']; ?></a></td>
                                                <td class="d-flex justify-content-center">
                                                  <button class="btn btn-success btn-sm m-1 updateBtn2"><i class="fa fa-edit"></i></button>
                                                  <button class="btn btn-danger btn-sm m-1 deletebtn2"><i class="fa fa-times-circle"></i></button>
                                                </td>
                                              </tr>
                                              <?php
                                              }
                                                }else{
                                                  echo "<tr>
                                                  <td colspan='9' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td>
                                                  </tr>";
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                            </div>
                                        </div>

                                      <!--  <div class="col-md-12">  
                                        <form action="procesos/guardar_diplomados.php" method="POST">   
                                            <div class="modal-body">
                                                <div class="table-responsive">
                                                    <label>Diplomados - Cursos - Seminarios</label> 
                                                    <input type="hidden" id="dni" name="dni" value="<?php echo $dato_desencriptado; ?>">
                                                    <input type="hidden" id="idpostulante" name="idpostulante" value="<?php echo $idpostulante; ?>">
                                                    <table class="table table-bordered" id="tabla-9">
                                                        <thead>
                                                        <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                                            <th scope="col">Centro Estudios</th>
                                                            <th scope="col">Nombre de la especialidad</th>
                                                            <th scope="col">Horas</th>
                                                            <th scope="col">Fecha Inicio</th>
                                                            <th scope="col">Fecha Termino</th>
                                                            <th scope="col">Nivel Alcanzado</th>
                                                            <th scope="col">Tipo de estudios</th>
                                                            <th scope="col">Acción</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="fila-fija-9">
                                                                <td><input style="font-size: 12px;" type="text" name="centro_estu[]" class="form-control name_list" required /></td>
                                                                <td><input style="font-size: 12px;" type="text" name="materia[]"  class="form-control name_list" required/></td>
                                                                <td><input style="font-size: 12px;" type="text" name="horas[]" class="form-control name_list" required/></td>
                                                                <td><input style="width: 140px; font-size: 12px;" type="date" name="fech_ini[]" class="form-control name_list" required/></td>
                                                                <td><input style="width: 140px; font-size: 12px;" type="date" name="fech_fin[]" class="form-control name_list" required/></td>
                                                                <td>
                                                                    <select style="font-size: 12px;" name="nivel[]" class="form-control" id="cargo" required>
                                                                        <option value="" disabled selected>Elegir</option>
                                                                        <option value="EGRESADO">Egresado</option>
                                                                        <option value="ESTUDIANTE">Estudiante</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select style="font-size: 12px;" name="tipo[]" class="form-control" id="cargo" required>
                                                                        <option value="" disabled selected>Elegir...</option>
                                                                        <option value="DIPLOMADO">Diplomado</option>
                                                                        <option value="CURSO">Curso</option>
                                                                        <option value="SEMINARIO">Seminario</option>
                                                                    </select>
                                                                </td>
                                                                <td class="eliminar"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                                                            </tr>
                                                        </tdody>
                                                    </table>
                                                </div> 
                                                <div class="row d-flex justify-content-center">
                                                    <input type="hidden" id="idcon" name="idcon" value="<?php echo $fila['idcon']; ?>">
                                                    <div class="form-inline p-2">
                                                        <button id="adicional-9" name="adicional" type="button" class="btn btn-warning"> Agregar Fila (+) </button>
                                                    </div>
                                                </div>   
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                                <button class="btn btn-primary" name="insertar" type="submit" >Guardar</button>
                                            </div>
                                        </form>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-end">
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#estcomp"><i class="fas fa-plus"></i> Nuevo</a>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-md-12 p-2 d-flex justify-content-center">
                                            <h3 class="text-xs font-weight-bold text-warning  text-uppercase mb-1">Idiomas - Computación</h3>
                                        </div>
                                        <div class="col-md-12 p-2">
                                            <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                  <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                                                    <th>N°</th>
                                                    <th scope="col">Idioma/Computación</th>
                                                    <th scope="col">Nivel</th>
                                                    <th scope="col">Archivo</th>
                                                    <th scope="col">Acciones</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $consulta4 = "SELECT * FROM idiomas_comp WHERE idpostulante_postulante = $idpostulante";

                                                    $query=mysqli_query($con, $consulta4);
                                                    if(mysqli_num_rows($query)>0){
                                                    while ($row4= MySQLI_fetch_array($query))
                                                    {
                                                    ?>
                                                    <tr>
                                                      <td style="font-size: 12px;"><?php echo $row4['ididiomas_comp'] ?></td>
                                                      <td style="font-size: 12px;"><?php echo $row4['idioma_comp'] ?></td>
                                                      <td style="font-size: 12px;"><?php echo $row4['nivel']?></td>
                                                      <td><a href="ver_idiomas.php?id=<?php echo $row4['ididiomas_comp']?>&dni=<?php echo $dato_desencriptado ?>"><?php echo $row4['archivo']; ?></a></td>
                                                      <td class="d-flex justify-content-center">
                                                      <button class="btn btn-success btn-sm m-1 updateBtn3"><i class="fa fa-edit"></i></button>
                                                      <button class="btn btn-danger btn-sm m-1 deleteBtn3"><i class="fa fa-times-circle"></i></button>
                                                    </td>
                                                        
                                                    </tr>
                                                    <?php
                                                    }
                                                      }else{
                                                        echo "<tr>
                                                        <td colspan='7' class='text-center text-danger' >NO HAY DATOS REGISTRADOS</td>
                                                        </tr>";
                                                      }
                                                    ?>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                     <!--   <div class="col-md-12"> 
                                            <form action="procesos/guardar_idiomas.php" method="POST">  
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <input type="hidden" id="dni" name="dni" value="<?php echo $dato_desencriptado; ?>">
                                                        <input type="hidden" id="idpostulante" name="idpostulante" value="<?php echo $idpostulante; ?>">
                                                      
                                                        <table class="table table-bordered" id="tabla-7">
                                                            <thead>
                                                              <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                                                <th scope="col">Idioma/Computación</th>
                                                                <th scope="col">Nivel</th>
                                                                <th scope="col">Acción</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="fila-fija-10">
                                                                    <td><input type="text" name="idioma_comp[]" placeholder="Inglés, Portugues, Computación..." class="form-control name_list text-uppercase" required/></td>
                                                                    <td>
                                                                      <select name="nivel[]" class="form-control" required>
                                                                        <option value="" disabled>Elegir</option>
                                                                        <option value="BASICO">Básico</option>
                                                                        <option value="INTERMEDIO">Intermedio</option>
                                                                        <option value="AVANZADO">Avanzado</option>
                                                                      </select>
                                                                    </td>
                                                                    <td class="eliminar"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                                                                </tr>
                                                            </tdody>
                                                        </table>
                                                    </div>  
                                                    <div class="row d-flex justify-content-center">
                                                        <input type="hidden" id="idcon" name="idcon" value="<?php echo $fila['idcon']; ?>">
                                                        <div class="form-inline p-2">
                                                            <button id="adicional-10" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                                                        </div>
                                                    </div>   
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                                    <button class="btn btn-primary" name="insertar" type="submit" >Guardar</button>
                                                </div>
                                            </form>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="col-2 p-0">
                <div class="list-group" id="list-tab" role="tablist" style="font-size:12px;">
                  <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Estudios Superiores</a>
                  <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Estudios Postgrado</a>
                  <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Diplomados - Cursos</a>
                  <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Idioma - Computación</a>
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

  <!--AGREGAR ESTUDIOS SUPERIORES -->
  <div class="modal fade" id="addModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Estudios Superiores (Universitario - Tecnico)</h5> 
          <button class="close" data-dismiss="modal">
            <span>×</span>
          </button>
        </div> 
        <div class="modal-body">      
          <form action="procesos/guardar_estudios_sup.php" enctype="multipart/form-data" autocomplete="off" method="POST">
            <div class="row"> 
              <input type="hidden" name="dni_encriptado" value="<?php echo $dato_desencriptado ?>">  
              <input type="hidden" name="dni" value="<?php echo $dni ?>">
              <input type="hidden" name="postulante" value="<?php echo $idpostulante ?>">

              <div class="col-md-6 col-sm-12 form-group" id="div_centro_estudios">
                <label for="title">(*) Centro estudios</label>
                <input type="text" id="centro_estudios" name="centro_estudios" class="form-control" placeholder="Nombre centro estudios" maxlength="100"
                required>
              </div>
              <div class="col-md-6 col-sm-12 form-group" id="div_centro_estudios">
                <label for="title">(*) Especialidad</label>
                <input type="text" id="especialidad" name="especialidad" class="form-control" placeholder="Especialidad" maxlength="100"
                required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_nivel_estudio">
                <label for="title">(*) Nivel estudios</label>
                <select name="nivel_estudios" id="nivel_estudios" class="form-control">
                        <option value="MAGISTER">Magister</option>
                        <option value="DOCTORADO">Doctorado</option>
                        <option value="EGRESADO">Egresado</option>
                        <option value="ESTUDIANTE">Estudiante</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_fecha_inicio">
                <label for="title">(**) Fecha Inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_fecha_fin">
                <label for="title">(**) Fecha Término</label>
                <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" required>
              </div>
              
              <div class="col-md-8 col-sm-12 form-group">
                <label for="title">(*) Subir Archivo</label>
                <input type="file" name="archivo" accept=".pdf" id="expe1_archivo" required />
                <div id="peso_archivo_valido" class="font-weight-bolder text-primary"></div>
                <div id="peso_archivo_no" class="font-weight-bolder text-danger"></div>
              </div>
              
            </div>
            <div class="form-group">
              <p>(*) Indica un campo obligatorio.</p>
              <p>(**) En el campo "FECHA" debe indicar la fecha de obtención del "NIVEL DE ESTUDIOS" que está registrando. 
              En el caso de estudiante, debe indicar la fecha del ciclo culminado que está registrando.</p>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="insertData">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

    <!--AGREGAR ESTUDIOS POSTGRADO-->
    <div class="modal fade" id="postgrado">
     <div class="modal-dialog modal-lg"> 
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Estudios Postgrado (Maestrias - Doctorados)</h5> 
          <button class="close" data-dismiss="modal">
            <span>×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="procesos/guardar_postgrado.php" enctype="multipart/form-data" autocomplete="off" method="POST">
            <div class="row"> 
              <input type="hidden" name="dni_encriptado" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="dni" value="<?php echo $dni ?>">
              <input type="hidden" name="postulante" value="<?php echo $idpostulante ?>">

              <div class="col-md-6 col-sm-12 form-group" id="div_centro_estudios">
                <label for="title">(*) Centro estudios</label>
                <input type="text" id="centro_estudios" name="centro_estudios" class="form-control" placeholder="Nombre centro estudios" maxlength="100"
                required>
              </div>
              <div class="col-md-6 col-sm-12 form-group" id="div_centro_estudios">
                <label for="title">(*) Especialidad</label>
                <input type="text" id="especialidad" name="especialidad" class="form-control" placeholder="Especialidad" maxlength="100"
                required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_nivel_estudio">
                <label for="title">(*) Tipo estudios</label>
                <select name="tipo" id="tipo" class="form-control">
                        <option value="MAESTRIA">Maestria</option>
                        <option value="DOCTORADO">Doctorado</option>
                </select>
              </div>

              <div class="col-md-4 col-sm-12 form-group" id="div_fecha_inicio">
                <label for="title">(**) Fecha Inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
              </div>
              <div class="col-md-4 col-sm-12 form-group" id="div_fecha_fin">
                <label for="title">(**) Fecha Término</label>
                <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" required>
              </div>

              <div class="col-md-4 col-sm-12 form-group" id="div_nivel_estudio">
                <label for="title">(*) Nivel estudios</label>
                <select name="nivel_estudios" id="nivel_estudios" class="form-control">
                        <option value="MAGISTER">Magister</option>
                        <option value="DOCTORADO">Doctorado</option>
                        <option value="EGRESADO">Egresado</option>
                        <option value="ESTUDIANTE">Estudiante</option>
                </select>
              </div>
              <div class="col-md-8 col-sm-12 form-group">
                <label for="title">(*) Subir Archivo</label><br>
                <input type="file" name="archivo1" accept=".pdf" id="expe2_archivo" required />
                <div id="peso_archivo_valido1" class="font-weight-bolder text-primary"></div>
                <div id="peso_archivo_no1" class="font-weight-bolder text-danger"></div>
              </div> 
              
            </div>
            <div class="form-group">
              <p>(*) Indica un campo obligatorio.</p>
              <p>(**) En el campo "FECHA" debe indicar la fecha de obtención del "NIVEL DE ESTUDIOS" que está registrando. 
              En el caso de estudiante, debe indicar la fecha del ciclo culminado que está registrando.</p>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="insertData">Guardar</button>
            </div>
          </form>
        </div>
      </div>
      </div>
    </div>

        <!--AGREGAR ESTUDIOS DIPLOMADOS-->
    <div class="modal fade" id="diplomados">
     <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Diplomados - cursos - seminarios</h5> 
          <button class="close" data-dismiss="modal">
            <span>×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="procesos/guardar_diplomados.php" enctype="multipart/form-data" autocomplete="off" method="POST">
            <div class="row"> 
              <input type="hidden" name="dni_encriptado" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="dni" value="<?php echo $dni ?>">
              <input type="hidden" name="postulante" value="<?php echo $idpostulante ?>">

              <div class="col-md-6 col-sm-12 form-group" id="div_centro_estudios">
                <label for="title">(*) Centro estudios</label>
                <input type="text" id="centro_estudios" name="centro_estudios" class="form-control" placeholder="Nombre centro estudios" maxlength="100"
                required>
              </div>
              <div class="col-md-6 col-sm-12 form-group" id="div_centro_estudios">
                <label for="title">(*) Nombre de la materia</label>
                <input type="text" id="materia" name="materia" class="form-control" placeholder="Materia" maxlength="100"
                required>
              </div>
              <div class="col-md-6 col-sm-12 form-group" id="div_nivel_estudio">
                <label for="title">(*) Nivel</label>
                <select name="tipo" id="tipo" class="form-control">
                        <option value="DIPLOMADO">Diplomado</option>
                        <option value="CURSO">Curso</option>
                        <option value="SEMINARIO">Seminario</option>
                </select>
              </div>
              <div class="col-md-3 col-sm-12 form-group" id="div_centro_estudios">
                <label for="title">(*) Horas</label>
                <input type="text" id="horas" name="horas" class="form-control" placeholder="Horas" maxlength="100"
                required>
              </div>

              <div class="col-md-6 col-sm-12 form-group" id="div_fecha_inicio">
                <label for="title">(**) Fecha Inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
              </div>
              <div class="col-md-6 col-sm-12 form-group" id="div_fecha_fin">
                <label for="title">(**) Fecha Término</label>
                <input type="date" id="fecha_fin" name="fecha_fi" class="form-control" required>
              </div>

              <div class="col-md-8 col-sm-12 form-group">
                <label for="title">(*) Subir Archivo</label>
                <input type="file" name="archivo" accept=".pdf" id="expe4_archivo" required />
                <div id="peso_archivo_valido3" class="font-weight-bolder text-primary"></div>
                <div id="peso_archivo_no3" class="font-weight-bolder text-danger"></div>
              </div> 
              
            </div>
            <div class="form-group">
              <p>(*) Indica un campo obligatorio.</p>
              <p>(**) En el campo "FECHA" debe indicar la fecha de obtención del "NIVEL DE ESTUDIOS" que está registrando. 
              En el caso de estudiante, debe indicar la fecha del ciclo culminado que está registrando.</p>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="insertData4">Guardar</button>
            </div>
          </form>
        </div>
      </div>
      </div>
    </div>

    <!--AGREGAR ESTUDIOS Estudios Computacion ingles -->
    <div class="modal fade" id="estcomp">
     <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Estudios Computación/Ingles</h5> 
          <button class="close" data-dismiss="modal">
            <span>×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="procesos/guardar_idiomas.php" enctype="multipart/form-data" autocomplete="off" method="POST">
            <div class="row"> 
              <input type="hidden" name="dni_encriptado" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="dni" value="<?php echo $dni ?>">
              <input type="hidden" name="postulante" value="<?php echo $idpostulante ?>">

              <div class="col-md-12 col-sm-12 form-group" id="div_centro_estudios">
                <label for="title">(*) Idioma Computacion</label>
                <input type="text" id="idioma" name="idioma" class="form-control" placeholder="Idioma/Computación" maxlength="100"
                required>
              </div>
              <div class="col-md-12 col-sm-12 form-group" id="div_nivel_estudio">
                <label for="title">(*) Nivel</label>
                <select name="nivel" id="nivel" class="form-control">
                        <option value="BASICO">Básico</option>
                        <option value="INTERMEDIO">Intermedio</option>
                        <option value="AVANZADO">Avanzado</option>
                </select>
              </div>

              <div class="col-md-8 col-sm-12 form-group">
                <label for="title">(*) Subir Archivo</label>
                <input type="file" name="archivo" accept=".pdf" id="expe3_archivo" required />
                <div id="peso_archivo_valido2" class="font-weight-bolder text-primary"></div>
                <div id="peso_archivo_no2" class="font-weight-bolder text-danger"></div>
              </div>   
            </div>
            <div class="form-group">
              <p>(*) Indica un campo obligatorio.</p>
              
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="insertData3">Guardar</button>
            </div>
          </form>
        </div>
      </div>
      </div>
    </div>
    <!-- Actualizar Estudios Superiores-->
    <div class="modal fade" id="updateModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Editar Estudio Superior</h5>
                    <button class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form action="procesos/actualizar_estudiosup.php" method="POST">
                      <div class="row"> 
                        <input type="hidden" name="dato_desencriptado" id="dato_desencriptado" value="<?php echo $dato_desencriptado ?>" >
                        <input type="hidden" name="idestudios" id="idestudios" >
                        <input type="hidden" name="dni1" value="<?php echo $dni ?>">
                        
                        <div class="col-md-6 col-sm-12 form-group">
                        <label for="title">Centro de estudios</label>
                        <input type="text" name="centro_estu" id="centro_estu" class="form-control" placeholder="Enter first name" maxlength="50">
                        </div>
                        <div class="col-md-6 col-sm-12 form-group">
                        <label for="title">Especialidad</label>
                        <input type="text" name="especialida" id="especialida" class="form-control" placeholder="Enter last name" maxlength="50">
                        </div>
                        <div class="col-md-6 col-sm-12 form-group">
                        <label for="title">Fecha Inicio</label>
                        <input type="date" name="fecha_i" id="fecha_i" class="form-control" placeholder="Enter address" maxlength="50">
                        </div>
                        <div class="col-md-6 col-sm-12 form-group">
                        <label for="title">Fecha término</label>
                        <input type="date" name="fecha_f" id="fecha_f" class="form-control" placeholder="Enter skills" maxlength="50" >
                        </div>
                        <div class="col-md-4 col-sm-12 form-group">
                        <label for="title">Nivel</label>
                        <select class="form-control" id="nivel_estu" name="nivel_estu">
                            <!-- <option value="" disabled selected>Elegir</option> -->
                            <option value="MAGISTER">Magister</option>
                            <option value="DOCTORADO">Doctorado</option>
                            <option value="EGRESADO">Egresado</option>
                            <option value="ESTUDIANTE">Estudiante</option>
                        </select>    
                        </div>
                        <div class="col-md-8 col-sm-12 form-group">
                          <label for="title">Archivo (Dejar en blanco si no desea actualizar)</label>
                          <input type="file" name="archivos1" id="archivos1" class="form-control">
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="updateData1">Actualizar!</button>
                        </div>

                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Actualizar Estudios Postgrado-->
    <div class="modal fade" id="actualizarpostgrado">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Editar Estudio Postgrado</h5>
                    <button class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form action="procesos/actualizar_estudiosup.php" method="POST">
                      <div class="row"> 
                        <input type="hidden" name="dato_desencriptado" id="dato_desencriptado" value="<?php echo $dato_desencriptado ?>" >
                        <input type="hidden" name="idmaestria_doc" id="idmaestria_doc" >
                        <input type="hidden" name="dni2" name="dni2" value="<?php echo $dni ?>">
                        
                        <div class="col-md-6 col-sm-12 form-group">
                        <label for="title">Centro de estudios</label>
                        <input type="text" name="centro_estudi" id="centro_estudi" class="form-control" placeholder="Enter first name" maxlength="50">
                        </div>
                        <div class="col-md-6 col-sm-12 form-group">
                        <label for="title">Especialidad</label>
                        <input type="text" name="especialidades" id="especialidades" class="form-control" placeholder="Enter last name" maxlength="50">
                        </div>
                        <div class="col-md-4 col-sm-12 form-group">
                        <label for="title">Tipo de Estudio</label>
                        <select class="form-control" id="tipo_estu" name="tipo_estu">
                            <option value="MAESTRIA">Maestria</option>
                            <option value="DOCTORADO">Doctorado</option>
                        </select>    
                        </div>
                        <div class="col-md-4 col-sm-12 form-group">
                        <label for="title">Fecha Inicio</label>
                        <input type="date" name="fecha_inic" id="fecha_inic" class="form-control" placeholder="Enter address" maxlength="50">
                        </div>
                        <div class="col-md-4 col-sm-12 form-group">
                        <label for="title">Fecha término</label>
                        <input type="date" name="fecha_fi" id="fecha_fi" class="form-control" placeholder="Enter skills" maxlength="50" >
                        </div>
                        <div class="col-md-4 col-sm-12 form-group">
                        <label for="title">Nivel</label>
                        <select class="form-control" id="nivel1" name="nivel1">
                            <!-- <option value="" disabled selected>Elegir</option> -->
                            <option value="MAGISTER">Magister</option>
                            <option value="DOCTORADO">Doctorado</option>
                            <option value="EGRESADO">Egresado</option>
                            <option value="ESTUDIANTE">Estudiante</option>
                        </select>    
                        </div>
                        <div class="col-md-8 col-sm-12 form-group">
                          <label for="title">Archivo (Dejar en blanco si no desea actualizar)</label>
                          <input type="file" name="archivos2" id="archivos2" class="form-control">
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="updateData2">Actualizar!</button>
                        </div>

                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- !-- MODAL ELIMINAR ESTUDIOS SUPERIORES  -->
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" >Eliminar registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form action="procesos/delete4.php" method="POST">        
                    <div class="modal-body">
                        <input type="hidden" name="url" id="url" value="<?php echo $dato_desencriptado;?>">
                        <input type="hidden" name="id" id="id">
                        <h4>¿Desea eliminar el dato seleccionado?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" name="deleteData">Si</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



        <!-- Actualizar Diplomados-->
    <div class="modal fade" id="actualizardiplomados">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Modificar Estudio Diplomado</h5>
                    <button class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body"> 
                    <form action="procesos/actualizar_estudiosup.php" method="POST"> 
                      <div class="row">  
                        <input type="hidden" name="dato_desencriptado" id="dato_desencriptado" value="<?php echo $dato_desencriptado ?>" >
                        <input type="hidden" name="idcursos_extra" id="idcursos_extra" >
                        <input type="hidden" name="dni3" name="dni3" value="<?php echo $dni ?>">
                        <div class="col-md-6 col-sm-12 form-group">
                        <label for="title">Centro de estudios</label>
                        <input type="text" name="centro_estud" id="centro_estud" class="form-control" placeholder="Enter first name" maxlength="50" >
                        </div>
                        <div class="col-md-6 col-sm-12 form-group">
                        <label for="title">Materia </label>
                        <input type="text" name="materia1" id="materia1" class="form-control" placeholder="Enter last name" maxlength="50" >
                        </div> 
                        <div class="col-md-4 col-sm-12 form-group">
                        <label for="title">Fecha Inicio </label>
                        <input type="date" name="fech_inic1" id="fech_inic1" class="form-control" placeholder="Horas" maxlength="50" >
                        </div> 
                        <div class="col-md-4 col-sm-12 form-group">
                        <label for="title">Fecha Fin </label>
                        <input type="date" name="fech_fin1" id="fech_fin1" class="form-control" placeholder="Horas" maxlength="50">
                        </div>
                        <div class="col-md-4 col-sm-12 form-group">
                        <label for="title">Horas </label>
                        <input type="text" name="horas1" id="horas1" class="form-control" placeholder="Horas" maxlength="50" >
                        </div>                 
                        <div class="col-md-4 col-sm-12 form-group">
                        <label for="title">Tipo </label>
                        <select class="form-control" id="tip" name="tip">
                            <option value="DIPLOMADO">Diplomado</option>
                            <option value="CURSO">Curso</option>
                            <option value="SEMINARIO">Seminario</option>
                        </select> 
                        </div>
                       
                        <div class="col-md-8 col-sm-12 form-group">
                          <label for="title">Archivo (Dejar en blanco si no desea actualizar)</label>
                          <input type="file" name="archivos3" id="archivos3" class="form-control">
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="updateData3">Actualizar!</button>
                       </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modificar Estudio Ingles/Computacion !-->                                                  
    <div class="modal fade" id="actualizaridiomas">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Modificar Estudio Ingles/Computacion</h5>
                    <button class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body"> 
                    <form action="procesos/actualizar_estudiosup.php" method="POST">  
                        <input type="hidden" name="dato_desencriptado" id="dato_desencriptado" value="<?php echo $dato_desencriptado ?>" >
                        <input type="hidden" name="ididiomas_comp" id="ididiomas_comp" >
                        <input type="hidden" name="dni4" name="dni4" value="<?php echo $dni ?>">
                        <div class="form-group">
                        <label for="title">Idiomas/Computacion</label>
                        <input type="text" name="idioma_comp" id="idioma_comp" class="form-control" placeholder="Enter first name" maxlength="50" >
                        </div>

                        <div class="form-group">
                        <label for="title">Nivel</label>
                        <select class="form-control" id="nivel4" name="nivel4">
                            <option value="BASICO">Basico</option>
                            <option value="INTERMEDIO">Intermedio</option>
                            <option value="AVANZADO">Avanzado</option>
                        </select>    
                        </div>
                        <div class="form-group">
                          <label for="title">Archivo (Dejar en blanco si no desea actualizar)</label>
                          <input type="file" name="archivos4" id="archivos4" class="form-control">
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="updateData4">Actualizar!</button>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- !-- MODAL ELIMINAR ESTUDIOS POSTGRADO  -->
    <div class="modal fade" id="eliminarpostgrado">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" >Eliminar registro Postgrado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form action="procesos/eliminarpostgrado.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="url" id="url" value="<?php echo $dato_desencriptado;?>">
                        <input type="hidden" name="id1" id="id1">
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

    <!-- !-- MODAL ELIMINAR DIPLOMADOS -->
    <div class="modal fade" id="eliminardiplomados">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" >Eliminar registro Diplomados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form action="procesos/eliminardiplomados.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="url" id="url" value="<?php echo $dato_desencriptado;?>">
                        <input type="hidden" name="id2" id="id2">
                        <h4>¿Desea eliminar el dato seleccionado?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" name="deleteData2">Si</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- !-- MODAL ELIMINAR IDIOMAS/COMPUTACION -->
    <div class="modal fade" id="eliminaridiomas">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" >Eliminar registro Idiomas/Computacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form action="procesos/eliminaridiomas.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="url" id="url" value="<?php echo $dato_desencriptado;?>">
                        <input type="hidden" name="id3" id="id3">
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

     <!-- VER estudios superiores Modal-->
     <div class="modal fade bd-example-modal-xl" id="ver_estudios_superiores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Estudios Superiores (Universitario - Tecnico)</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable_estu_sup" width="100%" cellspacing="0">
                            <thead>
                                <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                <th>N°</th>
                                <th>Centro de estudios</th>
                                <th>Especialidad</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Nivel</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $consulta3 = "SELECT * FROM estudios_superiores WHERE idpostulante_postulante = $idpostulante";

                                $query=mysqli_query($con, $consulta3);
                                while ($row3= MySQLI_fetch_array($query))
                                {
                                ?>
                                <tr id="<?php echo $row3['idestudios']?>">
                                    <td><?php echo $row3['idestudios'] ?></td>
                                    <td style="font-size: 16px;"><?php echo $row3['centro_estu'] ?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['especialidad']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['fech_ini']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['fech_fin']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['nivel']; ?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Salir</button>
                </div>
            </div>
        </div>
    </div>

    <!--GUARDAR Estudios Postgrado Modal-->
    <div class="modal fade bd-example-modal-xl" id="estudios_postgrado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Estudios Postgrado</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="procesos/guardar_postgrado.php" method="POST">
                <div class="modal-body">
                    <div class="table-responsive">
                        <label>Estudios Postgrado (Maestrias - Doctorados)</label>
                        <input type="hidden" id="dni" name="dni" value="<?php echo $dni; ?>">
                        <input type="hidden" id="idpostulante" name="idpostulante" value="<?php echo $idpostulante; ?>">
                        <input type="hidden" id="iddetalle_convocatoria" name="iddetalle_convocatoria" value="<?php echo $iddetalle_con; ?>">
                        <table class="table table-bordered" id="tabla-8">
                            <thead>
                            <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                <th  scope="col">Centro Estudios</th>
                                <th  scope="col">Especialidad</th>
                                <th  scope="col">Tipo Estudios</th>
                                <th  scope="col">Fecha Inicio</th>
                                <th  scope="col">Fecha Termino</th>
                                <th  scope="col">Nivel Alcanzado</th>
                                <th  scope="col">Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="fila-fija-8">
                                    <td><input style="width: 200px;font-size: 12px;" type="text" name="centro_estu[]" class="form-control name_list" required/></td>
                                    <td><input style="width: 200px;font-size: 12px;" type="text" name="especialidad[]"  class="form-control name_list" required/></td>
                                    <td>
                                        <select style="font-size: 12px;" name="tipo_estu[]" class="form-control" id="tipo_estu[]" required>
                                            <option selected>Elegir</option>
                                            <option value="MAESTRIA">Maestria </option>
                                            <option value="DOCTORADO">Doctorado</option>
                                        </select>
                                    </td>
                                    <td><input style="width: 150px;font-size: 12px;" type="date" name="fech_ini[]" class="form-control name_list" required/></td>
                                    <td><input style="width: 150px;font-size: 12px;" type="date" name="fech_fin[]" class="form-control name_list" required/></td>
                                    <td>
                                        <select style="font-size: 12px;" name="nivel[]" class="form-control" id="nivel[]" required>
                                            <option selected>Elegir</option>
                                            <option value="MAGISTER">Magister</option>
                                            <option value="DOCTORADO">Doctorado</option>
                                            <option value="EGRESADO">Egresado</option>
                                            <option value="ESTUDIANTE">Estudiante</option>
                                        </select>
                                    </td>
                                    <td class="eliminar"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                                </tr>
                            </tdody>
                        </table>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="form-inline p-2">
                            <button id="adicional-8" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" name="insertar" type="submit" >Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- VER Estudioa Postgrado-->
    <div class="modal fade bd-example-modal-xl" id="ver_estudios_postgrado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Estudios Superiores (Maestrias - Doctorados)</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="procesos/guardar_diplomados.php" method="POST">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                <th>N°</th>
                                <th>Centro de estudios</th> 
                                <th>Especialidad</th> 
                                <th>Tipo</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Nivel</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                //$dni = $_GET['dni'];
                                
                                $consulta3 = "SELECT * FROM maestria_doc WHERE idpostulante_postulante = $idpostulante";

                                $query=mysqli_query($con, $consulta3);
                                while ($row3= MySQLI_fetch_array($query))
                                {
                                ?>
                                <tr>
                                    <td><?php echo $row3['idmaestria_doc'] ?></td>
                                    <td style="font-size: 16px;"><?php echo $row3['centro_estu'] ?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['especialidad']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['tipo_estu']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['fech_ini']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['fech_fin']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['nivel']; ?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Salir</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- GUARDAR Cursos y diplomados Modal-->
    <div class="modal fade bd-example-modal-xl" id="cursos_diplomados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cursos, diplomados y/o seminarios</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="procesos/guardar_diplomados.php" method="POST">  
                <div class="modal-body">
                    <div class="table-responsive">
                        <label>Diplomados - Cursos - Seminarios</label> 
                        <input type="hidden" id="dni" name="dni" value="<?php echo $dni; ?>">
                        <input type="hidden" id="idpostulante" name="idpostulante" value="<?php echo $idpostulante; ?>">
                        <table class="table table-bordered" id="tabla-9">
                            <thead>
                            <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                <th scope="col">Centro Estudios</th>
                                <th scope="col">Nombre de la especialidad</th>
                                <th scope="col">Horas</th>
                                <th scope="col">Fecha Inicio</th>
                                <th scope="col">Fecha Termino</th>
                                <th scope="col">Nivel Alcanzado</th>
                                <th scope="col">Tipo de estudios</th>
                                <th scope="col">Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="fila-fija-9">
                                    <td><input style="font-size: 12px;" type="text" name="centro_estu[]" class="form-control name_list" required /></td>
                                    <td><input style="font-size: 12px;" type="text" name="materia[]"  class="form-control name_list" required/></td>
                                    <td><input style="width: 62px;font-size: 12px;" type="text" name="horas[]" class="form-control name_list" required/></td>
                                    <td><input style="width: 168px;font-size: 12px;" type="date" name="fech_ini[]" class="form-control name_list" required/></td>
                                    <td><input style="width: 168px;font-size: 12px;" type="date" name="fech_fin[]" class="form-control name_list" required/></td>
                                    <td>
                                        <select style="font-size: 12px;" name="nivel[]" class="form-control" id="cargo" required>
                                            <option value="" disabled selected>Elegir</option>
                                            <option value="EGRESADO">Egresado</option>
                                            <option value="ESTUDIANTE">Estudiante</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select style="font-size: 12px;" name="tipo[]" class="form-control" id="cargo" required>
                                            <option value="" disabled selected>Elegir...</option>
                                            <option value="DIPLOMADO">Diplomado</option>
                                            <option value="CURSO">Curso</option>
                                            <option value="SEMINARIO">Seminario</option>
                                        </select>
                                    </td>
                                    <td class="eliminar"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                                </tr>
                            </tdody>
                        </table>
                    </div> 
                    <div class="row d-flex justify-content-center">
                        <input type="hidden" id="idcon" name="idcon" value="<?php echo $fila['idcon']; ?>">
                        <div class="form-inline p-2">
                            <button id="adicional-9" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                        </div>
                    </div>   
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" name="insertar" type="submit" >Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- VER Cursos y diplomados Modal-->
    <div class="modal fade bd-example-modal-xl" id="ver_cursos_diplomados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cursos, diplomados y/o seminarios</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="procesos/guardar_diplomados.php" method="POST">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                <th>N°</th>
                                <th>Centro de estudios</th>
                                <th>Nombre de materia</th>
                                <th>Horas</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Tipo</th>
                                <th>Nivel</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                               // $dni = $_GET['dni'];
                                
                                $consulta3 = "SELECT * FROM cursos_extra WHERE postulante_idpostulante = $idpostulante";

                                $query=mysqli_query($con, $consulta3);
                                while ($row3= MySQLI_fetch_array($query))
                                {
                                ?>
                                <tr>
                                    <td><?php echo $row3['idcursos_extra'] ?></td>
                                    <td style="font-size: 16px;"><?php echo $row3['centro_estu'] ?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['materia']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['horas']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['fech_ini']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['fech_fin']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['tipo']?></td>
                                    <td style="font-size: 14px;"><?php echo $row3['nivel']; ?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Salir</button>
                </div>
                </form>
            </div>
        </div>
    </div>

   <!-- GUARDAR Idiomas y computacion-->
    <div class="modal fade bd-example-modal-xl" id="idiomas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Idiomas - Computación</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="procesos/guardar_idiomas.php" method="POST">  
                <div class="modal-body">
                    <div class="table-responsive">
                        <input type="hidden" id="dni" name="dni" value="<?php echo $dni; ?>">
                        <input type="hidden" id="idpostulante" name="idpostulante" value="<?php echo $idpostulante; ?>">
                        <table class="table table-bordered" id="tabla-10">
                            <thead>
                                <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                    <th scope="col">Idioma/Computación</th>
                                    <th scope="col">Nivel</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="fila-fija-10">
                                    <td><input type="text" name="idioma_comp[]" placeholder="Inglés, Portugues, Computación..." class="form-control name_list text-uppercase" /></td>
                                    <td>
                                        <select name="nivel[]" class="form-control">
                                            <option value="" disabled selected>Elegir</option>
                                            <option value="BASICO">Básico</option>
                                            <option value="INTERMEDIO">Intermedio</option>
                                            <option value="AVANZADO">Avanzado</option>
                                        </select>
                                    </td>
                                    <td class="eliminar"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                                </tr>
                            </tdody>
                        </table>
                    </div>  
                    <div class="row d-flex justify-content-center">
                        <input type="hidden" id="idcon" name="idcon" value="<?php echo $fila['idcon']; ?>">
                        <div class="form-inline p-2">
                            <button id="adicional-10" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                        </div>
                    </div>   
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" name="insertar" type="submit" >Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- VER Cursos y diplomados Modal-->
    <div class="modal fade bd-example-modal-xl" id="ver_idiomas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cursos, diplomados y/o seminarios</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                    <th>N°</th>
                                    <th scope="col">Idioma/Computación</th>
                                    <th scope="col">Nivel</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                //$dni = $_GET['dni'];
                                
                                $consulta4 = "SELECT * FROM idiomas_comp WHERE idpostulante_postulante = $idpostulante";

                                $query=mysqli_query($con, $consulta4);
                                while ($row4= MySQLI_fetch_array($query))
                                {
                                ?>
                                <tr>
                                    <td><?php echo $row4['ididiomas_comp'] ?></td>
                                    <td style="font-size: 16px;"><?php echo $row4['idioma_comp'] ?></td>
                                    <td style="font-size: 14px;"><?php echo $row4['nivel']?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Salir</button>
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

    <!-- Page level custom scripts -->
    <script src="js/bootstrable.js"></script>

    <!-- alertas -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script>
      $(document).ready(function() {
        //Select para mostrar e esconder divs
        $('#SelectOptions').on('change',function(){
          var SelectValue='.'+$(this).val();
          $('.grupo-formularios div').hide();
          $(SelectValue).toggle();
        });
      });
    </script>

    <script>
      $(document).ready(function () {
        $('.updateBtn').on('click', function(){

          $('#updateModal').modal('show');
  
          // Get the table row data.
          $tr = $(this).closest('tr');
  
          var data = $tr.children("td").map(function() {
              return $(this).text();
          }).get();
  
          console.log(data);
  
          $('#idestudios').val(data[0]);
          $('#centro_estu').val(data[1]);
          $('#especialida').val(data[2]);
          $('#fecha_i').val(data[3]);
          $('#fecha_f').val(data[4]);  
          $('#nivel_estu').val(data[5]);  
          $('#archivos1').val(data[6]); 
        });
      });

        $(document).ready(function () {
            $('.deleteBtn').on('click', function(){
        
                $('#deleteModal').modal('show');
                // Get the table row data.
                $tr = $(this).closest('tr');
        
                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();
        
                console.log(data);
                $('#id').val(data[0]);
            });
        });
    </script>

    <script>
        $(document).ready(function () {
          $('.updateBtn1').on('click', function(){

            $('#actualizarpostgrado').modal('show');
    
            // Get the table row data.
            $tr = $(this).closest('tr');
    
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
    
            console.log(data);
    
            $('#idmaestria_doc').val(data[0]);
            $('#centro_estudi').val(data[1]);
            $('#especialidades').val(data[2]);
            $('#tipo_estu').val(data[3]);
            $('#fecha_inic').val(data[4]);
            $('#fecha_fi').val(data[5]);  
            $('#nivel1').val(data[6]); 
            $('#archivos2').val(data[7]);
          
          });
        });

        $(document).ready(function () {
          $('.deleteBtn1').on('click', function(){
    
            $('#eliminarpostgrado').modal('show');
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

    <script>
        $(document).ready(function () {
          $('.updateBtn2').on('click', function(){

            $('#actualizardiplomados').modal('show');
    
            // Get the table row data.
            $tr = $(this).closest('tr');
    
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
    
            console.log(data);
    
            $('#idcursos_extra').val(data[0]);
            $('#centro_estud').val(data[1]);
            $('#materia1').val(data[2]);
            $('#horas1').val(data[3]);
            $('#fech_inic1').val(data[4]);
            $('#fech_fin1').val(data[5]);  
            $('#tip').val(data[6]);    
            $('#archivo3').val(data[7]);  
          
          });
        });

        $(document).ready(function () {
            $('.deletebtn2').on('click', function(){
            
                    $('#eliminardiplomados').modal('show');
                    // Get the table row data.
                    $tr = $(this).closest('tr');
            
                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();
            
                    console.log(data);
                    $('#id2').val(data[0]);
            });
        });
    </script>

    <script>
      $(document).ready(function () {
        $('.updateBtn3').on('click', function(){

          $('#actualizaridiomas').modal('show');
  
          // Get the table row data.
          $tr = $(this).closest('tr');
  
          var data = $tr.children("td").map(function() {
              return $(this).text();
          }).get();
  
          console.log(data);
        
          $('#ididiomas_comp').val(data[0]);
          $('#idioma_comp').val(data[1]);
          $('#nivel4').val(data[2]);
          $('#archivos4').val(data[3]);
      
        });
      });

      $(document).ready(function () {
        $('.deleteBtn3').on('click', function(){
    
          $('#eliminaridiomas').modal('show');
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

    <script>
         $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-1").on('click', function(){
                $("#tabla-1 tbody tr:eq(0)").clone().removeClass('fila-fija-1').appendTo("#tabla-1").find("input[type=text]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-2").on('click', function(){
                $("#tabla-2 tbody tr:eq(0)").clone().removeClass('fila-fija-2').appendTo("#tabla-2").find("input[type=text]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-3").on('click', function(){
                $("#tabla-3 tbody tr:eq(0)").clone().removeClass('fila-fija-3').appendTo("#tabla-3").find("input[type=text]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-4").on('click', function(){
                $("#tabla-4 tbody tr:eq(0)").clone().removeClass('fila-fija-4').appendTo("#tabla-4").find("input[type=text]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-5").on('click', function(){
                $("#tabla-5 tbody tr:eq(0)").clone().removeClass('fila-fija-5').appendTo("#tabla-5").find("input[type=text]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-6").on('click', function(){
                $("#tabla-6 tbody tr:eq(0)").clone().removeClass('fila-fija-6').appendTo("#tabla-6").find("input[type=text]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-7").on('click', function(){
                $("#tabla-7 tbody tr:eq(0)").clone().removeClass('fila-fija-7').appendTo("#tabla-7").find("input[type=text]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-8").on('click', function(){
                $("#tabla-8 tbody tr:eq(0)").clone().removeClass('fila-fija-8').appendTo("#tabla-8").find("input[type=text]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-9").on('click', function(){
                $("#tabla-9 tbody tr:eq(0)").clone().removeClass('fila-fija-9').appendTo("#tabla-9").find("input[type=text]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional-10").on('click', function(){
                $("#tabla-10 tbody tr:eq(0)").clone().removeClass('fila-fija-10').appendTo("#tabla-10").find("input[type=text]").val("");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
    </script>

    <script>
      //binds to onchange event of your input field
      $('#expe1_archivo').bind('change', function() {
        var peso = (this.files[0].size);
        if (peso <= 3000000) {
          document.getElementById('peso_archivo_valido').innerHTML = "Archivo válido";
          document.getElementById("peso_archivo_valido").style.display = "block";
          document.getElementById("peso_archivo_no").style.display = "none";
        } else {
          document.getElementById('peso_archivo_no').innerHTML = "El archivo sobre pasa los 3Mb máximos";
          document.getElementById("peso_archivo_valido").style.display = "none";
          document.getElementById("peso_archivo_no").style.display = "block";
          document.getElementById("expe1_archivo").value = '';
        }
      });
    </script>

    <script>
      //binds to onchange event of your input field
      $('#expe2_archivo').bind('change', function() {
        var peso = (this.files[0].size);
        if (peso <= 3000000) {
          document.getElementById('peso_archivo_valido1').innerHTML = "Archivo válido";
          document.getElementById("peso_archivo_valido1").style.display = "block";
          document.getElementById("peso_archivo_no1").style.display = "none";
        } else {
          document.getElementById('peso_archivo_no1').innerHTML = "El archivo sobre pasa los 3Mb máximos";
          document.getElementById("peso_archivo_valido1").style.display = "none";
          document.getElementById("peso_archivo_no1").style.display = "block";
          document.getElementById("expe1_archivo1").value = '';
        }
      });
    </script>
    <script>
      //binds to onchange event of your input field
      $('#expe3_archivo').bind('change', function() {
        var peso = (this.files[0].size);
        if (peso <= 3000000) {
          document.getElementById('peso_archivo_valido2').innerHTML = "Archivo válido";
          document.getElementById("peso_archivo_valido2").style.display = "block";
          document.getElementById("peso_archivo_no2").style.display = "none";
        } else {
          document.getElementById('peso_archivo_no2').innerHTML = "El archivo sobre pasa los 3Mb máximos";
          document.getElementById("peso_archivo_valido2").style.display = "none";
          document.getElementById("peso_archivo_no2").style.display = "block";
          document.getElementById("expe1_archivo2").value = '';
        }
      });
    </script>
    <script>
      //binds to onchange event of your input field
      $('#expe4_archivo').bind('change', function() {
        var peso = (this.files[0].size);
        if (peso <= 3000000) {
          document.getElementById('peso_archivo_valido3').innerHTML = "Archivo válido";
          document.getElementById("peso_archivo_valido3").style.display = "block";
          document.getElementById("peso_archivo_no3").style.display = "none";
        } else {
          document.getElementById('peso_archivo_no3').innerHTML = "El archivo sobre pasa los 3Mb máximos";
          document.getElementById("peso_archivo_valido3").style.display = "none";
          document.getElementById("peso_archivo_no3").style.display = "block";
          document.getElementById("expe1_archivo3").value = '';
        }
      });
    </script>


</body>

</html>

