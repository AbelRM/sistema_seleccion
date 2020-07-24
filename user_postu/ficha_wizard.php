<?php
include "conexion.php";  
//$db =  connect();
$query=$con->query("select * from departamento");
$countries = array();
while($r=$query->fetch_object()){ $countries[]=$r; }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Formulario tipo Wizard para las convocatorias de DIRESA TACNA">
    <meta name="author" content="Abel Maquera">
    <title>Ficha única de datos</title>
    <!-- Custom fonts for this template-->
    <link rel="icon" type="image/png" href="img/icono_diresa.png" />
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-gradient-primary">
    <?php   
        include 'conexion.php';
        
        $dni = $_GET['dni'];
        //$descrip=base64_decode($dni);
        $sql2="SELECT * FROM user where dni=$dni";
        $datos=mysqli_query($con,$sql2) or die(mysqli_error()); ;
        $fila= mysqli_fetch_array($datos);
        // include 'menu.php';
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 text-center p-0 mt-3 mb-2">
                <div class="card px-4 pt-4 mt-3 mb-3" style="padding: 30px;">
                    <h2 id="heading">FICHA ÚNICA DE DATOS</h2>
                    <p>Para la contratación de personal dispuesto en el Decreto de Urgencia N° 029-2020</p>
                    <form id="msform" action="procesos/guardar_ficha.php">
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="active" id="user"><strong></strong></li>
                            <li id="home"><strong></strong></li>
                            <li id="student"><strong></strong></li>
                            <!-- <li id="book"><strong></strong></li>
                            <li id="book"><strong></strong></li>
                            <li id="book"><strong></strong></li>
                            <li id="payment"><strong></strong></li>
                            <li id="work"><strong></strong></li> -->
                            <li id="list"><strong></strong></li>
                        </ul>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">DATOS PERSONALES COMPLEMENTARIOS:</h2>
                                    </div>
                                </div>
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
                            <input type="button" name="next" class="next action-button" value="Siguiente" />
                        </fieldset>

                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">DOMICILIO:</h2>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
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
                                    <div class="col-md-7 col-sm-6 mb-2 mb-sm-0">
                                        <label>Nombre de via</label> 
                                        <input class="form-control form-control-user" type="text" name="nomb_via" id="nomb_via" placeholder="Via"/> 
                                    </div>
                                    
                                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                        <label>Número</label> 
                                        <input class="form-control form-control-user" type="text" name="num_via" id="num_via" placeholder="Número"/> 
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
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

                                    <div class="col-md-7 col-sm-6 mb-2 mb-sm-0">
                                        <label>Nombre de la zona</label> 
                                        <input class="form-control form-control-user" type="text" name="nomb_zona" id="nomb_zona" placeholder="Zona"/> 
                                    </div>

                                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                        <label>Número</label> 
                                        <input class="form-control form-control-user" type="text" name="num_zona" id="num_zona" placeholder="Número"/> 
                                    </div>

                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                            <label for="name2">Departamento actual</label>
                                            <select id="departamento_id1" class="form-control" name="departamento_id1" required>
                                              <option value="">-- SELECCIONE --</option>
                                              <?php foreach($countries as $c):?>
                                              <option value="<?php echo $c->iddepartamento; ?>"><?php echo $c->departamento; ?></option>
                                              <?php endforeach; ?>
                                            </select> 
                                     </div>

                                     <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label for="name2">Provincia actual</label>
                                        <select id="provincia_id1" class="form-control" name="provincia_id1" >
                                        <option value="">-- SELECCIONE --</option>
                                        </select>                                 
                                        </div>

                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label for="name2">Distrito actual</label>
                                        <select id="distrito_id1" class="form-control" name="distrito_id1" required>
                                        <option value="">-- SELECCIONE --</option>        
                                        </select>                                 
                                    </div>

                                    <div class="col-md-12 col-sm-6 mb-2 mb-sm-0">
                                        <label>Referencia</label> 
                                        <input class="form-control form-control-user" type="text" name="referencia" id="referencia" placeholder="Indicar Avenida/Calle y/o Institucion cercana"/> 
                                    </div>
                                </div>   
                            </div>
                            <input type="button" name="next" class="next action-button" value="Siguiente"/>
                            <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                        </fieldset>

                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">DATOS FAMILIARES:</h2>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="table-responsive">
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
                                                            <option value="ABUELO(A)">Abeulo(a)</option>
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
                                    <!-- <input type="hidden" id="idcon" name="idcon" value="<?php echo $fila['idcon']; ?>"> -->
                                    <div class="form-inline p-2">
                                        <button id="adicional" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                                    </div>
                                    <!-- <div class="form-inline p-2">
                                        <input type="submit" name="insertar_1" class="btn btn-primary" value="GUARDAR"/>
                                    </div> -->
                                </div>
                            </div>
                            <input type="button" name="next" class="next action-button" value="Siguiente" /> 
                            <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                        </fieldset>

                        <!-- <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">DATOS PROFESIONALES Y ACADÉMICOS I:</h2>
                                    </div>
                                </div>
                                <div class="form-group row">
    
                                    <div class="col-md-9 col-sm-6 mb-2 mb-sm-0">
                                        <label> Profesion</label> 
                                        <input class="form-control form-control-user" type="text" name="profesion" id="profesion" placeholder="Indicar profesion"/> 
                                    </div>

                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label>Fecha de colegiatura</label> 
                                        <input class="form-control form-control-user" type="date" name="fech_cole" id="fech_cole"/> 
                                    </div>

                                    <div class="col-md-6 col-sm-6 mb-2 mb-sm-0">
                                        <label>Lugar de colegiatura</label> 
                                        <input class="form-control form-control-user" type="text" name="lugar_cole" id="lugar_cole" placeholder="Lugar"/> 
                                    </div>

                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label>Fecha de colegiatura habilitado</label> 
                                        <input class="form-control form-control-user" type="date" name="fech_habi" id="fech_habi" /> 
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label>Número colegiatura</label> 
                                        <input class="form-control form-control-user" type="text" name="num_cole" id="num_cole" placeholder="Número colegiatura"/> 
                                    </div>
                                </div> 
                            </div>
                            <input type="button" name="next" class="next action-button" value="Siguiente" /> <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                        </fieldset> -->

                        <!-- ESTUDIOS SUPERIORES Y ESPECIALIZACIONES -->
                        <!-- <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">DATOS PROFESIONALES Y ACADÉMICOS II:</h2>
                                    </div>
                                </div> 
                                <div class="table-responsive">
                                    <label>Estudios Superiores (Universitario - Tecnico)</label> 
                                    <table class="table table-bordered" id="tabla-2">
                                        <thead>
                                        <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                            <th scope="col">Centro Estudios</th>
                                            <th scope="col">Especialidad</th>
                                            <th scope="col">Fecha Inicio</th>
                                            <th scope="col">Fecha Termino</th>
                                            <th scope="col">Nivel Alcanzado</th>
                                            <th scope="col">Acción</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="fila-fija-2">
                                                <td><input type="text" name="centro_estu[]" placeholder="Nombre de centro de estudios" class="form-control name_list" /></td>
                                                <td><input type="text" name="especialidad[]" placeholder="Especialidad" class="form-control name_list" /></td>
                                                <td><input type="date" name="fech_ini[]" class="form-control name_list"/></td>
                                                <td><input type="date" name="fech_fin[]" class="form-control name_list"/></td>
                                                <td>
                                                    <select name="nivel[]" class="form-control" id="cargo">
                                                        <option value="" disabled selected>Elegir</option>
                                                        <option value="Magister">Magister</option>
                                                        <option value="Doctorado">Doctorado</option>
                                                        <option value="Egresado">Egresado</option>
                                                        <option value="Estudiante">Estudiante</option>
                                                    </select>
                                                </td>
                                                <td class="eliminar"><input type="button" class="btn btn-danger" value=" - "></td>
                                            </tr>
                                        </tdody>
                                    </table>
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <div class="form-inline p-2">
                                        <button id="adicional-2" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <label>Estudios Posgrado (Maestria - Doctorado)</label> 
                                    <table class="table table-bordered" id="tabla-3">
                                        <thead>
                                        <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                            <th scope="col">Centro Estudios</th>
                                            <th scope="col">Especialidad</th>
                                            <th scope="col">Fecha Inicio</th>
                                            <th scope="col">Fecha Termino</th>
                                            <th scope="col">Nivel Alcanzado</th>
                                            <th scope="col">Acción</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="fila-fija-3">
                                                <td><input type="text" name="centro_estu[]" placeholder="Nombre de centro de estudios" class="form-control name_list" /></td>
                                                <td><input type="text" name="especialidad[]" placeholder="Especialidad" class="form-control name_list" /></td>
                                                <td><input type="date" name="fech_ini[]" class="form-control name_list"/></td>
                                                <td><input type="date" name="fech_fin[]" class="form-control name_list"/></td>
                                                <td>
                                                    <select name="nivel[]" class="form-control" id="cargo">
                                                        <option value="" disabled selected>Elegir</option>
                                                        <option value="Magister">Magister</option>
                                                        <option value="Doctorado">Doctorado</option>
                                                        <option value="Egresado">Egresado</option>
                                                        <option value="Estudiante">Estudiante</option>
                                                    </select>
                                                </td>
                                                <td class="eliminar"><input type="button" class="btn btn-danger" value=" - "></td>
                                            </tr>
                                        </tdody>
                                    </table>
                                </div> 
                                <div class="row d-flex justify-content-center">
                                    <div class="form-inline p-2">
                                        <button id="adicional-3" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                                    </div>
                                </div>                        

                            </div>
                            <input type="button" name="next" class="next action-button" value="Siguiente" /> <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                        </fieldset> -->
                        <!-- ESPECIALZIACION Y CURSOS -->
                        <!-- <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">DATOS PROFESIONALES Y ACADÉMICOS II:</h2>
                                    </div>
                                </div> 
                                <div class="table-responsive">
                                    <label>Especialización - Diplomados</label> 
                                    <table class="table table-bordered" id="tabla-4">
                                        <thead>
                                        <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                            <th scope="col">Centro Estudios</th>
                                            <th scope="col">Especialidad</th>
                                            <th scope="col">Fecha Inicio</th>
                                            <th scope="col">Fecha Termino</th>
                                            <th scope="col">Nivel Alcanzado</th>
                                            <th scope="col">Acción</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="fila-fija-4">
                                                <td><input type="text" name="centro_estu[]" placeholder="Nombre de centro de estudios" class="form-control name_list" /></td>
                                                <td><input type="text" name="especialidad[]" placeholder="Especialidad" class="form-control name_list" /></td>
                                                <td><input type="date" name="fech_ini[]" class="form-control name_list"/></td>
                                                <td><input type="date" name="fech_fin[]" class="form-control name_list"/></td>
                                                <td>
                                                    <select name="nivel[]" class="form-control" id="cargo">
                                                        <option value="" disabled selected>Elegir</option>
                                                        <option value="Magister">Magister</option>
                                                        <option value="Doctorado">Doctorado</option>
                                                        <option value="Egresado">Egresado</option>
                                                        <option value="Estudiante">Estudiante</option>
                                                    </select>
                                                </td>
                                                <td class="eliminar"><input type="button" class="btn btn-danger" value=" - "></td>
                                            </tr>
                                        </tdody>
                                    </table>
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <div class="form-inline p-2">
                                        <button id="adicional-4" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <label>Cursos - Seminarios</label> 
                                    <table class="table table-bordered" id="tabla-5">
                                        <thead>
                                        <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                            <th scope="col">Centro Estudios</th>
                                            <th scope="col">Especialidad</th>
                                            <th scope="col">Fecha Inicio</th>
                                            <th scope="col">Fecha Termino</th>
                                            <th scope="col">Nivel Alcanzado</th>
                                            <th scope="col">Acción</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="fila-fija-5">
                                                <td><input type="text" name="centro_estu[]" placeholder="Nombre de centro de estudios" class="form-control name_list" /></td>
                                                <td><input type="text" name="especialidad[]" placeholder="Especialidad" class="form-control name_list" /></td>
                                                <td><input type="date" name="fech_ini[]" class="form-control name_list"/></td>
                                                <td><input type="date" name="fech_fin[]" class="form-control name_list"/></td>
                                                <td>
                                                    <select name="nivel[]" class="form-control" id="cargo">
                                                        <option value="" disabled selected>Elegir</option>
                                                        <option value="Magister">Magister</option>
                                                        <option value="Doctorado">Doctorado</option>
                                                        <option value="Egresado">Egresado</option>
                                                        <option value="Estudiante">Estudiante</option>
                                                    </select>
                                                </td>
                                                <td class="eliminar"><input type="button" class="btn btn-danger" value=" - "></td>
                                            </tr>
                                        </tdody>
                                    </table>
                                </div> 
                                <div class="row d-flex justify-content-center">
                                    <input type="hidden" id="idcon" name="idcon" value="<?php echo $fila['idcon']; ?>">
                                    <div class="form-inline p-2">
                                        <button id="adicional-5" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                                    </div>
                                </div>   
                            </div>
                            <input type="button" name="next" class="next action-button" value="Siguiente" /> <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                        </fieldset> -->
            
                        <!-- IDIOMAS -->
                        <!-- <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">IDIOMAS:</h2>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="tabla-6">
                                            <thead>
                                                <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                                    <th scope="col">Lenguaje de extranjero</th>
                                                    <th scope="col">Nivel</th>
                                                    <th scope="col">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="fila-fija-6">
                                                    <td>
                                                        <select name="lenguaje[]" class="form-control" >
                                                            <option value="" disabled selected>Elegir</option>
                                                            <option value="INGLES">Inglés</option>
                                                            <option value="FRANCES">Frances</option>
                                                            <option value="AYMARA">Aymara</option>
                                                            <option value="QUECHUA">Quechua</option>
                                                            <option value="PORTUGUES">Portugues</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="nivel[]" class="form-control">
                                                            <option value="" disabled selected>Elegir</option>
                                                            <option value="BASICO">Básico</option>
                                                            <option value="INTERMEDIO">Intermedio</option>
                                                            <option value="AVANZADO">Avanzado</option>
                                                        </select>
                                                    </td>
                                                    <td class="eliminar"><input type="button" class="btn btn-danger" value=" - "></td>
                                                </tr>
                                            </tdody>
                                        </table>
                                    </div> 
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <div class="form-inline p-2">
                                        <button id="adicional-6" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                                    </div>
                                </div>
                            </div> 
                            <input type="button" name="next" class="next action-button" value="Siguiente" /> <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                        </fieldset> -->
                        <!-- EXPERIENCIA LABORAL -->
                        <!-- <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">DATOS LABORALES:</h2>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <span>Experiencia laboral</span>
                                    <table class="table table-bordered" id="tabla-7">
                                        <thead>
                                        <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                            <th scope="col">Institución / Empresa</th>
                                            <th scope="col">Cargo / Actividad </th>
                                            <th scope="col">Fecha inicio</th>
                                            <th scope="col">Fecha fin</th>
                                            <th scope="col">Acción</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="fila-fija-7">
                                                <td><input type="text" name="institucion[]" placeholder="Nombre de la empresa" class="form-control name_list" /></td>
                                                <td><input type="text" name="cargo[]" placeholder="Cargo o función" class="form-control name_list" /></td>
                                                <td><input type="date" name="fech_ini[]"  class="form-control name_list" /></td>
                                                <td><input type="date" name="fech_fin[]"  class="form-control name_list" /></td>
                                                <td class="eliminar"><input type="button" class="btn btn-danger" value=" - "></td>
                                            </tr>
                                        </tdody>
                                    </table>
                                </div> 
                                <div class="row d-flex justify-content-center">
                                    <input type="hidden" id="idcon" name="idcon" value="<?php echo $fila['idcon']; ?>">
                                    <div class="form-inline p-2">
                                        <button id="adicional-7" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <span>Labores de Docencia</span>
                                    <table class="table table-bordered" id="tabla-8">
                                        <thead>
                                        <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                                            <th scope="col">Centro de enseñanzas</th>
                                            <th scope="col">Curso dictado</th>
                                            <th scope="col">Fecha inicio</th>
                                            <th scope="col">Fecha fin</th>
                                            <th scope="col">Acción</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="fila-fija-8">
                                                <td><input type="text" name="centro_ense[]" placeholder="Nombre de la institución" class="form-control name_list" /></td>
                                                <td><input type="text" name="curso[]" placeholder="Curso dictado" class="form-control name_list" /></td>
                                                <td><input type="date" name="fech_ini[]"  class="form-control name_list" /></td>
                                                <td><input type="date" name="fech_fin[]"  class="form-control name_list" /></td>
                                                <td class="eliminar"><input type="button" class="btn btn-danger" value=" - "></td>
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
                            <input type="button" name="next" class="next action-button" value="Siguiente" /> <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                        </fieldset> -->

                        <!-- <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="fs-title">DECLARACIÓN JURADA DE IMPEDIMENTOS E INCOMPATIBILIDADES:</h2>
                                    </div>
                                </div>
                                <h6>Declaro bajo juramento lo siguiente:</h6>
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-12">
                                        <label>Registra antecedentes policiales:</label> 
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_1" id="radio_1" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_1" id="radio_2" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">NO</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label>Registra antecedentes penales:</label> 
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_2" id="radio_3" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_2" id="radio_4" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">NO</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12"> 
                                        <label>Registra antecedentes judiciales:</label> 
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_5" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_6" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">NO</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12"> 
                                        <label>Tener inhabilitación vigente para prestar servicios al estado conforme al registro nacional de sanciones contra servidores civiles (RNSCC):</label> 
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_5" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_6" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">NO</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12"> 
                                        <label>Estar inscrito en le registro de deudores alimentarios morosos (REDAM):</label> 
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_5" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_6" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">NO</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12"> 
                                        <label>Estar inscrito en el registro nacional de abogados sancionados por mala practica profesional (RNS) (En caso corresponda):</label> 
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_5" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_6" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">NO</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12"> 
                                        <label>Estar inscrito en la relacion de proveedores sancionados por el tribunal de contrataciones del estado de sancion vigente:</label> 
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_5" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_6" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">NO</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12"> 
                                        <label>Estar inscrito en el registro de deudores de reparaciones civiles (REDERECI) y por lo tanto no contar con ninguno de los impedimentos establecidos en le articulo 5 de la Ley 30353 (Ley que crea el REDERECI) para acceder el ejercicio de la función pública y contratacion del estado:</label> 
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_5" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_6" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">NO</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12"> 
                                        <label>Tener condena por terrorismo, apologia del delito de terrorismo y otros delitos, señalados en la Ley N° 30794:</label> 
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_5" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_6" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">NO</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12"> 
                                        <label>Tener impedimento, icompatibilidad o estar incurso en alguna prohibición o restricción para ser postor o contratista y/o para postular, acceder o ejercer el servicio, función o cargo convocado por el MVCS:</label> 
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_5" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_6" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">NO</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12"> 
                                        <label>Ser conyugue conviviente o pariente hasta el segundo grado de consanguinidad o afinidad de las personas señaladas en los literales a) AL g) del articulo 11 del texto unico ordenado de la Ley de contrataciones del estado:</label> 
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_5" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_6" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">NO</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12"> 
                                        <label>Percibir simultaneamente remuneración, pensión y honorarios por concepto de locación de servicios asesorias o consultorias
                                            o cualquier otra doble percepción o ingreso del estado, salvo por el ejercicio de la función docente efectiva y la percepción 
                                            de dietas por participación en uno de los directorios de entidades o empresas estatales o en tribunales administrativos o en 
                                            otros órganos colegiados:</label> 
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_5" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="item_3" id="radio_6" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">NO</label>
                                        </div>
                                    </div>
                                    
                                </div> 
                            </div>
                            <input type="button" name="next" class="next action-button" value="Siguiente" /> <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                        </fieldset> -->
                        
                        <fieldset>
                            <div class="form-card">
                                <h2 class="purple-text text-center"><strong>YA CASI TERMINAMOS !</strong></h2> <br>
                                <div class="row justify-content-center">
                                    <div class="col-6"> 
                                        <img src="img/confirmacion.png" alt="Imagen de confirmación" style="width: 100%; height: auto;"> 
                                    </div>
                                </div> <br><br>
                                <div class="row justify-content-center">
                                    <div class="col-6 text-center">
                                        <h5 class="purple-text text-center">Presione GUARDAR si esta seguro de haber concluido!</h5>
                                    </div>
                                </div>
                            </div>
                            <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/wizard.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.js"></script>
    <script>
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional").on('click', function(){
                $("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
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
                $("#tabla-2 tbody tr:eq(0)").clone().removeClass('fila-fija-2').appendTo("#tabla-2");
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
                $("#tabla-3 tbody tr:eq(0)").clone().removeClass('fila-fija-3').appendTo("#tabla-3");
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
                $("#tabla-4 tbody tr:eq(0)").clone().removeClass('fila-fija-4').appendTo("#tabla-4");
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
                $("#tabla-5 tbody tr:eq(0)").clone().removeClass('fila-fija-5').appendTo("#tabla-5");
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
                $("#tabla-6 tbody tr:eq(0)").clone().removeClass('fila-fija-6').appendTo("#tabla-6");
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
                $("#tabla-7 tbody tr:eq(0)").clone().removeClass('fila-fija-7').appendTo("#tabla-7");
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
                $("#tabla-8 tbody tr:eq(0)").clone().removeClass('fila-fija-8').appendTo("#tabla-8");
            });
            
            // Evento que selecciona la fila y la elimina 
            $(document).on("click",".eliminar",function(){
                var parent = $(this).parents().get(0);
                $(parent).remove();
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#departamento_id").change(function(){
                $.get("provincia.php","departamento_iddepartamento="+$("#departamento_id").val(), function(data){
                    $("#provincia_id").html(data);
                    console.log(data);
                });
            });

            $("#provincia_id").change(function(){
                $.get("distrito.php","provincia_idprovincia="+$("#provincia_id").val(), function(data){
                    $("#distrito_id").html(data);
                    console.log(data);
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#departamento_id1").change(function(){
                $.get("provincia.php","departamento_iddepartamento="+$("#departamento_id1").val(), function(data){
                    $("#provincia_id1").html(data);
                    console.log(data);
                });
            });

            $("#provincia_id1").change(function(){
                $.get("distrito.php","provincia_idprovincia"+$("#provincia_id1").val(), function(data){
                    $("#distrito_id1").html(data);
                    console.log(data);
                });
            });
        });
    </script>

</body>
</html>
