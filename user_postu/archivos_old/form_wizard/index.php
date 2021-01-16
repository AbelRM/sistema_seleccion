<?php
  include "../conexion.php";  
  //$db =  connect();
  $query=$con->query("select * from departamento");
  $countries = array();
  while($r=$query->fetch_object()){ $countries[]=$r; }

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Formulario de registro de datos DIRESA</title>
  <link rel="icon" type="image/png" href="../img/icono_diresa.png" />
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <!-- <link href="../css/sb-admin-2.css" rel="stylesheet"> -->
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
    <?php   
        include '../conexion.php';
        
        $dni = $_GET['dni'];
        //$descrip=base64_decode($dni);
        $sql2="SELECT * FROM usuarios where dni=$dni";
        $datos=mysqli_query($con,$sql2) or die(mysqli_error()); ;
        $fila= mysqli_fetch_array($datos);
    ?>
	<div class="row">
		<section>
        <div class="wizard">
            <div class="row">
                <div class="col-xs-3">
                    <img src="../img/logo_diresa.png" style="width:100%; height:auto;" alt="Logo de DIRESA TACNA">
                </div>
                <div class="col-xs-9">
                    <div class="wizard-inner">
                        <div class="connecting-line"></div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                    <span class="round-tab">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </span>
                                </a>
                            </li>

                            <li role="presentation" class="disabled">
                                <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                                    <span class="round-tab">
                                        <i class="glyphicon glyphicon-list-alt"></i>
                                    </span>
                                </a>
                            </li>
                            <li role="presentation" class="disabled">
                                <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                                    <span class="round-tab">
                                        <i class="glyphicon glyphicon-home"></i>
                                    </span>
                                </a>
                            </li>

                            <li role="presentation" class="disabled">
                                <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                                    <span class="round-tab">
                                        <i class="glyphicon glyphicon-ok"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
           
            <div class="tab-content">
                <div class="tab-pane active" role="tabpanel" id="step1">
                    <form action="../procesos/guardar_personales.php" method="POST">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">DATOS PERSONALES</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-card">
                                    <input type="hidden" id="dni_post" name="dni_post" value="<?php echo $fila['dni']; ?>">
                                    <div class="form-group row">
                                        <div class="col-md-5 col-sm-6 mb-2 mb-sm-0">
                                            <label>Nombres</label> 
                                            <input class="form-control form-control-user" type="text" value="<?php echo $fila['nombres']." ".$fila['ape_pat']." ".$fila['ape_mat']; ?>" disabled="true"/> 
                                        </div>
                                        <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                            <label>Fecha de nacimiento</label> 
                                            <input class="form-control form-control-user" type="date" id="fech_nac" name="fech_nac"/> 
                                        </div>
                                        <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                            <label>Estado civil</label> 
                                            <select class="form-control" name="civil" id="civil">
                                                <option selected>Elegir...</option>
                                                <option value="SOLTERO(A)">Soltero(a)</option>
                                                <option value="CASADO(A)">Casado(a)</option>
                                                <option value="VIUDO(A)">Viudo(a)</option>
                                                <option value="DIVORCIADO(A)">Divorciado(a)</option>
                                                <option value="CONVIVIENTE">Conviviente</option>
                                            </select> 
                                        </div>
                                        <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                            <label>Sexo</label> 
                                            <select class="form-control" name="sexo" id="sexo">
                                                <option selected>Elegir...</option>
                                                <option value="MASCULINO">Masculino</option>
                                                <option value="FEMENINO">Femenino</option>
                                            </select> 
                                        </div>
                                        <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                            <label for="name1">Departamento</label>
                                            <select id="departamento_id" class="form-control" name="departamento_id" required>
                                                <option value="">-- SELECCIONE --</option>
                                                <?php foreach($countries as $c):?>
                                                    <option value="<?php echo $c->iddepartamento; ?>"><?php echo $c->departamento; ?></option>
                                                <?php endforeach; ?>
                                            </select> 
                                        </div>

                                        <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                            <label for="name1">Provincia</label>
                                            <select id="provincia_id" class="form-control" name="provincia_id" >
                                                <option value="">-- SELECCIONE --</option>
                                            </select>                                 
                                        </div>


                                        <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                            <label for="exampleInputEmail1">Distrito</label>
                                            <select id="distrito_id" class="form-control" name="distrito_id" required>
                                                <option value="">-- SELECCIONE --</option>        
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                            <label>Cel. emergencia</label> 
                                            <input class="form-control form-control-user" type="text" name="num_emer" id="num_emer"/> 
                                        </div>
                                        <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                            <label>Parentesco</label> 
                                            <input class="form-control form-control-user" placeholder="Nombre familiar" type="text" name="nomb_parent" id="nomb_parent"/> 
                                        </div>
                                        <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                            <label>R.U.C.</label> 
                                            <input class="form-control form-control-user" type="text" name="ruc" id="ruc"/> 
                                        </div>
                                        <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                            <label>N° cuenta bancaria</label> 
                                            <input class="form-control form-control-user" placeholder="Banco de la Nación" type="text" name="cuenta_banc" id="cuenta_banc"/> 
                                        </div>
                                        <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                            <label>Suspensión de 4ta.</label> 
                                            <select class="form-control" name="cuarta" id="cuarta">
                                                <option value="NO" selected>NO</option>
                                                <option value="SI">SI</option>
                                            </select> 
                                        </div>
                                        <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                            <label>Tipo de pensión</label> 
                                            <select class="form-control" name="pension" id="pension">
                                                <option value="NINGUNA" selected>Ninguna</option>
                                                <option value="ONP">ONP</option>
                                                <option value="SPP">SPP</option>
                                            </select> 
                                        </div>
                                        <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                            <label>Discapacidad</label> 
                                            <select class="form-control" name="discapacidad" id="discapacidad">
                                                <option value="NO" selected>NO</option>
                                                <option value="SI">SI</option>
                                                
                                            </select>  
                                        </div>
                                        <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                            <label>Tipo de discapacidad</label> 
                                            <select class="form-control" name="tip_discapacidad" id="tip_discapacidad">
                                                <option value="NINGUNA" select>Ninguna</option>
                                                <option value="FISICA">Físicas</option>
                                                <option value="SENSORIAL">Sensoriales</option>
                                                <option value="MENTAL">Mentales</option>
                                                <option value="INTELECTUAL">Intelectuales</option>
                                            </select>  
                                        </div>
                                        <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                            <label>Grupo sanguineo</label> 
                                            <select class="form-control" name="tip_sangre" id="tip_sangre">
                                                <option selected>Elegir...</option>
                                                <option value="AB+">AB+</option>
                                                <option value="AB-">AB-</option>
                                                <option value="A+">A+</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B-">B-</option>
                                                <option value="0+">0+</option>
                                                <option value="0-">0-</option>
                                            </select>  
                                        </div>
                                        <div class="col-md-6 col-sm-6 mb-2 mb-sm-0">
                                            <label>Enfermedades/Alergias</label> 
                                            <input class="form-control form-control-user" type="text" placeholder="Separado por comas" name="alergias" id="alergias"/> 
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="submit" class="btn btn-primary next-step">Guardar y continuar</button></li>
                        </ul>
                    </form>
                </div>
                <div class="tab-pane" role="tabpanel" id="step2">
                    <form action="../procesos/guardar_domicilio.php" method="POST">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">DATOS DEL DOMICILIO ACTUAL</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-card">
                                    <div class="form-group row">
                                        <input type="hidden" id="dni_post" name="dni_post" value="<?php echo $dni; ?>"/>
                                        <input type="hidden" id="id_postulante" name="id_postulante" value="<?php echo $idpostulante; ?>"/>

                                        <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                            <label for="exampleInputEmail1">Tipo de Via</label>
                                            <select class="form-control form-control-user" name="tipo_via" id="tipo_via">
                                            <option value="AVENIDA">Avenida</option>
                                            <option value="JIRON">Jiron</option>
                                            <option value="CALLE">Calle</option>
                                            <option value="PASAJE">Pasaje</option>
                                            <option value="ALAMEDA">Alameda</option>
                                            <option value="MALECON">Malecon</option>
                                            <option value="OVALO">Ovalo</option>
                                            <option value="PASAJE">Pasaje</option>
                                            <option value="PARQUE">Parque</option>
                                            <option value="PLAZA">Plaza</option>
                                            <option value="CARRETERA">Carretera</option>
                                            <option value="TROCHA">Trocha</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-6 mb-2 mb-sm-0">
                                            <label>Nombre de via</label> 
                                            <input class="form-control form-control-user" type="text" name="nomb_via" id="nomb_via" placeholder="Nombre de la via"/> 
                                        </div>
                                        
                                        <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                            <label>Número</label> 
                                            <input class="form-control form-control-user" type="text" name="num_via" id="num_via" placeholder="Número"/> 
                                        </div>
                                        <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                            <label>N° Manzana</label> 
                                            <input class="form-control form-control-user" type="text" name="manzana" id="manzana" placeholder="N° Mz."/> 
                                        </div>
                                        <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                            <label for="exampleInputEmail1">Tipo de Zona</label>
                                            <select class="form-control form-control-user" name="tipo_zona" id="tipo_zona">
                                            <option value="AVENIDA">Urbanizacion</option>
                                            <option value="JIRON">Pueblo Joven</option>
                                            <option value="CALLE">Unidad vecinal</option>
                                            <option value="PASAJE">Conjunto habitacional</option>
                                            <option value="ALAMEDA">Asentamiento humano</option>
                                            <option value="MALECON">Cooperativa</option>
                                            <option value="OVALO">Residencial</option>
                                            <option value="PASAJE">Zona industrial</option>
                                            <option value="PARQUE">Grupo</option>
                                            <option value="PLAZA">Caserio</option>
                                            <option value="CARRETERA">Fundo</option>
                                            </select>
                                            <br>
                                        </div>

                                        <div class="col-md-6 col-sm-6 mb-2 mb-sm-0">
                                            <label>Nombre de la zona</label> 
                                            <input class="form-control form-control-user" type="text" name="nomb_zona" id="nomb_zona" placeholder="Zona"/> 
                                        </div>

                                        <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                            <label>Número</label> 
                                            <input class="form-control form-control-user" type="text" name="num_zona" id="num_zona" placeholder="Número"/> 
                                        </div>
                                        <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                            <label>N° Lote</label> 
                                            <input class="form-control form-control-user" type="text" name="lote" id="lote" placeholder="N° Lt."/> 
                                        </div>

                                        <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                                <label for="name2">Departamento actual</label>
                                                <select id="departamento_id" class="form-control" name="departamento_id" required>
                                                    <option value="">-- SELECCIONE --</option>
                                                    <?php foreach($countries as $c):?>
                                                    <option value="<?php echo $c->iddepartamento; ?>"><?php echo $c->departamento; ?></option>
                                                    <?php endforeach; ?>
                                                </select> 
                                            </div>

                                            <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                            <label for="name2">Provincia actual</label>
                                            <select id="provincia_id" class="form-control" name="provincia_id" >
                                            <option value="">-- SELECCIONE --</option>
                                            </select>                                 
                                            </div>

                                        <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                            <label for="name2">Distrito actual</label>
                                            <select id="distrito_id" class="form-control" name="distrito_id" required>
                                            <option value="">-- SELECCIONE --</option>        
                                            </select>                                 
                                        </div>

                                        <div class="col-md-12 col-sm-6 mb-2 mb-sm-0">
                                            <label>Referencia</label> 
                                            <input class="form-control form-control-user" type="text" name="referencia" id="referencia" placeholder="Indicar Avenida/Calle y/o Institucion cercana"/> 
                                        </div>
                                    </div>   
                                </div>
                            </div>
                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Retroceder</button></li>
                            <li><button type="submit" class="btn btn-primary next-step">Guardar y continuar</button></li>
                        </ul>
                    </form>
                </div>
                <div class="tab-pane" role="tabpanel" id="step3">
                    <form action="procesos/guardar_familia.php" method="POST">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h3 class="panel-title">DATOS DE LA FAMLIA</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-card">
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <input type="hidden" id="dni_post" name="dni_post" value="<?php echo $dni; ?>"/>
                                            <input type="hidden" id="id_postulante" name="id_postulante" value="<?php echo $idpostulante; ?>"/>

                                            <label style="color:red; font-size:18px;">Los familiares agregados son aquellos que viven actualmente con usted, caso contrario colocar uno de referencia.</label>
                                            <table class="table table-bordered" id="tabla">
                                                <thead>
                                                <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                                    <th scope="col">Nombres</th>
                                                    <th scope="col">Apellidos</th>
                                                    <th scope="col">Fecha Nacimiento</th>
                                                    <th scope="col">N° DNI</th>
                                                    <th scope="col">Parentesco</th>
                                                    <th scope="col">Entidad que labora</th>
                                                    <th scope="col">Acción</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="fila-fija">
                                                        <td><input type="text" name="nombre[]" placeholder="Nombres" class="form-control name_list" /></td>
                                                        <td><input type="text" name="apellidos[]" placeholder="Apellidos completos" class="form-control name_list"/></td>
                                                        <td><input type="date" name="fecha_nac[]" class="form-control name_list" /></td>
                                                        <td><input type="text" name="dni[]" maxlength="8" class="form-control name_list" /></td>
                                                        <td>
                                                            <select name="parentesco[]" class="form-control">
                                                                <option value="" disabled selected>Elegir</option>
                                                                <option value="PADRE">Padre</option>
                                                                <option value="MADRE">Madre</option>
                                                                <option value="HERMANO(A)">Hermano(a)</option>
                                                                <option value="TIO(A)">Tio(a)</option>
                                                                <option value="ABUELO(A)">Abuelo(a)</option>
                                                            </select>
                                                        </td>
                                                        <td><input type="text" name="entidad[]" placeholder="Nombre entidad que elabora" class="form-control name_list" /></td>
                                                        <td class="eliminar"><input type="button" class="btn btn-danger" value=" - "></td>
                                                    </tr>
                                                </tdody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="form-inline p-2">
                                            <button id="adicional" name="adicional" type="button" class="btn btn-warning"> Agregar fila (+) </button>
                                        </div>
                                        <div class="form-inline p-2">
                                            <input type="submit" name="insertar" class="btn btn-dark" value="Finalizar"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Retroceder</button></li>
                            <li><button type="button" class="btn btn-default next-step">Skip</button></li>
                            <li><button type="button" class="btn btn-primary btn-info-full next-step">Guardar y continuar</button></li>
                        </ul>
                    </form>
                </div>
                
                <div class="tab-pane" role="tabpanel" id="complete">
                    <h3>Completado</h3>
                    <p>You have successfully completed all steps.</p>
                </div>
                <div class="clearfix"></div>
            </div>
            
        </div>
    </section>
   </div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
<!-- <script src="js/sb-admin-2.min.js"></script> -->
<script  src="./script.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#departamento_id").change(function(){
            $.get("../provincia.php","departamento_iddepartamento="+$("#departamento_id").val(), function(data){
                $("#provincia_id").html(data);
                console.log(data);
            });
        });

        $("#provincia_id").change(function(){
            $.get("../distrito.php","provincia_idprovincia="+$("#provincia_id").val(), function(data){
                $("#distrito_id").html(data);
                console.log(data);
            });
        });
    });
</script>


</body>
</html>
