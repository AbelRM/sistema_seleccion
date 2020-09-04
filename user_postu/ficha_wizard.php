<?php
include "conexion.php";  
session_start();

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
    <link href="css/estilos.css" rel="stylesheet">
    
</head>
<body class="bg-gradient-primary">
    <?php   
        include 'funcs/mcript.php';
        
        $dato_desencriptado = $_GET['dni'];
        $dni = $desencriptar($dato_desencriptado);  
        
        $sql2="SELECT * FROM user where dni=$dni";
        $datos=mysqli_query($con,$sql2) or die(mysqli_error()); ;
        $fila= mysqli_fetch_array($datos); 
        // include 'menu.php';
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 text-center p-0 mt-3 mb-2">
                <div class="card px-4 pt-4 mt-3 mb-3" style="padding: 30px;">
                    <div class="row">
                        <div class="col-10">
                            <h2 id="heading">FICHA ÚNICA DE DATOS</h2>
                            <p>Para la contratación de personal dispuesto en el Decreto de Urgencia N° 029-2020</p>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#logoutModal">Cerrar sesión</button>
                        </div>
                    </div>
                    <form id="msform" method="post" action="procesos/guardar_ficha.php">  
                        <!-- progressbar -->
                        <div class="row p-2">
                            <div class="col-lg-2 col-md-2 col-sm-12 p-1">
                                <img src="img/logo_diresa.png" style="width:100%; height:auto;" alt="">
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 p-1">
                                <ul id="progressbar">
                                    <li class="active" id="user"><strong></strong></li>
                                    <li id="home"><strong></strong></li>
                                    <li id="student"><strong></strong></li>
                                    <li id="confirm"><strong></strong></li> 
                                </ul>
                            </div>
                        </div>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">DATOS PERSONALES COMPLEMENTARIOS:</h2>
                                    </div>
                                </div>
                                <div class="form-group row">
    
                                    <div class="col-md-5 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Nombres</label> 
                                        <input class="form-control form-control-user" type="text" value="<?php echo $fila['nombres']." ".$fila['ape_pat']." ".$fila['ape_mat']; ?>" disabled="true"/> 
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Fecha de nacimiento</label> 
                                        <input class="form-control form-control-user" type="date" id="fech_nac" name="fech_nac" required/> 
                                    </div>
                                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Pais</label> 
                                        <select class="form-control" name="pais" id="pais" required>
                                            <option selected>Elegir...</option>
                                            <option value="PERU">PERU</option>
                                            <option value="ECUADOR">ECUADOR</option>
                                            <option value="CHILE">CHILE</option>
                                            <option value="BRASIL">BRASIL</option>
                                            <option value="BOLIVIA">BOLIVIA</option>
                                            <option value="URUGUAY">URUGUAY</option>
                                            <option value="ARGENTINA">ARGENTINA</option>
                                            <option value="PARAGUAY">PARAGUAY</option>
                                            <option value="VENEZUELA">VENEZUELA</option>
                                            <option value="COLOMBIA">COLOMBIA</option>
                                        </select> 
                                    </div>
                                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Estado civil</label> 
                                        <select class="form-control" name="civil" id="civil" required>
                                            <option selected>Elegir...</option>
                                            <option value="SOLTERO(A)">Soltero(a)</option>
                                            <option value="CASADO(A)">Casado(a)</option>
                                            <option value="VIUDO(A)">Viudo(a)</option>
                                            <option value="DIVORCIADO(A)">Divorciado(a)</option>
                                            <option value="CONVIVIENTE">Conviviente</option>
                                        </select> 
                                    </div>
                                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Sexo</label> 
                                        <select class="form-control" name="sexo" id="sexo" required>
                                            <option selected>Elegir...</option>
                                            <option value="MASCULINO">Masculino</option>
                                            <option value="FEMENINO">Femenino</option>
                                        </select> 
                                    </div>

                                    
                                    
                                  <!--  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder" for="name1">Departamento nacimiento</label>
                                        <select id="departamento_id" class="form-control" name="departamento_id" required>
                                            <option value="">-- SELECCIONE --</option>
                                            <?php foreach($countries as $c):?>
                                                <option value="<?php echo $c->iddepartamento; ?>"><?php echo $c->departamento; ?></option>
                                            <?php endforeach; ?>
                                        </select> 
                                    </div>

                                    <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder" for="name1">Provincia nacimiento</label>
                                        <select id="provincia_id" class="form-control" name="provincia_id" required>
                                            <option value="">-- SELECCIONE --</option>
                                        </select>                                 
                                    </div>


                                    <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder" for="exampleInputEmail1">Distrito nacimiento</label>
                                        <select id="distrito_id" class="form-control" name="distrito_id" required>
                                            <option value="">-- SELECCIONE --</option>        
                                        </select>
                                    </div> -->
                                    
                                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Cel. emergencia</label> 
                                        <input class="form-control form-control-user" type="text" name="num_emer" id="num_emer" maxlength="9"  required/> 
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Parentesco</label> 
                                        <input class="form-control form-control-user" placeholder="Nombre familiar" type="text" name="nomb_parent" id="nomb_parent"/> 
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">R.U.C.</label> 
                                        <input class="form-control form-control-user" type="text" name="ruc" id="ruc" maxlength="11" /> 
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">N° cuenta bancaria</label> 
                                        <input class="form-control form-control-user" placeholder="Banco de la Nación" type="text" name="cuenta_banc" id="cuenta_banc" maxlength="16"  required/> 
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Suspensión de 4ta.</label> 
                                        <select class="form-control" name="cuarta" id="cuarta">
                                            <option value="NO" selected>NO</option>
                                            <option value="SI">SI</option>
                                        </select> 
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Tipo de pensión</label> 
                                        <select class="form-control custom-select" name="pension" id="inputSelect">
                                            <option value="NINGUNA" selected>Ninguna</option>
                                            <option value="ONP">ONP</option>
                                            <option value="AFP">AFP</option>
                                        </select> 
                                    </div>
                                    <div id="AFP" class="divOculto col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Nombre de la AFP:</label> 
                                        <input type="text" name="nombre_afp" class="form-control">
                                    </div>
                                    <div id="AFP-2" class="divOculto col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Código CUSSP (opcional):</label> 
                                        <input type="text" name="codigo_cussp" class="form-control" >
                                    </div>
                                    <div id="NINGUNA" class="divOculto col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">¿A cuál te gustaria pertenecer?</label> 
                                        <select class="form-control custom-select" name="pertenecer_pension" id="pertenecer_pension">
                                            <option value="ONP" selected>ONP</option>
                                            <option value="AFP">AFP</option>
                                        </select>
                                    </div>
                                    <div id="opcion-AFP" class="divOculto col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Nombre de la AFP:</label> 
                                        <input type="text" name="nombre_afp_pregunta" class="form-control">
                                    </div>

                                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Discapacidad</label> 
                                        <select class="form-control" name="discapacidad" id="discapacidad">
                                            <option value="NO" selected>NO</option>
                                            <option value="SI">SI</option>
                                        </select>  
                                    </div>
                                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Tipo  discapacidad</label> 
                                        <select class="form-control" name="tip_discapacidad" id="tip_discapacidad">
                                            <option value="NINGUNA" select>Ninguna</option>
                                            <option value="FISICA">Físicas</option>
                                            <option value="SENSORIAL">Sensoriales</option>
                                            <option value="MENTAL">Mentales</option>
                                            <option value="INTELECTUAL">Intelectuales</option>
                                        </select>  
                                    </div>
                                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Grupo sanguineo</label> 
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
                                        <label class="font-weight-bolder">Enfermedades/Alergias</label> 
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

                                    <input type="hidden" id="dni_post" name="dni_post" value="<?php echo $fila['dni']; ?>"/>

                                    <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder" for="name2">Departamento nacimiento</label>
                                        <select id="departamento_id1" class="form-control" name="departamento_id1" required>
                                            <option value="">-- SELECCIONE --</option>
                                            <?php foreach($countries as $c):?>
                                                <option value="<?php echo $c->iddepartamento; ?>"><?php echo $c->departamento; ?></option>
                                            <?php endforeach; ?>
                                        </select> 
                                    </div>

                                    <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder" for="name2">Provincia nacimiento</label>
                                        <select id="provincia_id1" class="form-control" name="provincia_id1" required>
                                            <option value="">-- SELECCIONE --</option>
                                        </select>                                 
                                    </div>


                                    <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder" for="exampleInputEmail1">Distrito nacimiento</label>
                                        <select id="distrito_id1" class="form-control" name="distrito_id1" required>
                                            <option value="">-- SELECCIONE --</option>        
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder" for="exampleInputEmail1">Tipo de Via</label>
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
                                        <label class="font-weight-bolder">Nombre de via</label> 
                                        <input class="form-control form-control-user" type="text" name="nomb_via" id="nomb_via" placeholder="Via"/> 
                                    </div>
                                    
                                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Número</label> 
                                        <input class="form-control form-control-user" type="text" name="num_via" id="num_via" placeholder="Número"/> 
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder" for="exampleInputEmail1">Tipo de Zona</label>
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
                                        <label class="font-weight-bolder">Nombre de la zona</label> 
                                        <input class="form-control form-control-user" type="text" name="nomb_zona" id="nomb_zona" placeholder="Zona"/> 
                                    </div>

                                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Número</label> 
                                        <input class="form-control form-control-user" type="text" name="num_zona" id="num_zona" placeholder="Número"/> 
                                    </div>
                                    <div class="col-md-2 col-sm-2 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Número</label> 
                                        <input class="form-control form-control-user" type="text" name="numero" id="numero"/> 
                                    </div>
                                    <div class="col-md-2 col-sm-2 mb-2 mb-sm-0">  
                                        <label class="font-weight-bolder">Mz.</label> 
                                        <input class="form-control form-control-user" type="text" name="manzana" id="manzana"/> 
                                    </div>
                                    <div class="col-md-2 col-sm-2 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Lt.</label> 
                                        <input class="form-control form-control-user" type="text" name="lote" id="lote"/> 
                                    </div>

                                    <div class="col-md-6 col-sm-6 mb-2 mb-sm-0">
                                        <label class="font-weight-bolder">Referencia</label> 
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
                                        <label>Los familiares agregados son aquellos que viven actualmente con usted, caso contrario colocar uno de referencia.</label>
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
                                        <button id="adicional" name="adicional" type="button" class="btn btn-warning"> AGREGAR FILA (+) </button>
                                    </div>
                                    <!-- <div class="form-inline p-2">
                                        <input type="submit" name="insertar_1" class="btn btn-primary" value="GUARDAR"/>
                                    </div> -->
                                </div>
                            </div>
                            <input type="submit" name="insertar" class="next action-button" value="Siguiente" /> 
                            <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                        </fieldset>

                        <fieldset>
                        
                            <div class="row">
                                        <div class="col-12">
                                            <h2 class="fs-title">DECLARACIÓN JURADA DE IMPEDIMENTOS E INCOMPATIBILIDADES:</h2>
                                        </div>
                            </div> 
                            
                            <table class="table table-bordered">
                                
                                    <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.95em;">
                                    <th scope="col">N°</th>
                                    <th scope="col">Pregunta</th>
                                    <th scope="col">Respuesta</th>
                                    </tr>
                                </thead>

                                <tbody align="left">
                                    <tr>

                                    <th scope="row">1</th>
                                    <td >
                                        <h6 class="font-weight-bolder">Declaro bajo juramento lo siguiente:</h6>
                                        <label>Registra antecedentes policiales:</label> 
                                    </td>
                                    <td>
                                        <select class="form-control " name="pension" id="inputSelect">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                        </select>
                                    </td>
                                
                                    </tr>

                                    <tr>
                                    <th scope="row">2</th>
                                    <td>
                                        <label>Registra antecedentes penales:</label>
                                    </td>
                                    <td>
                                        <select class="form-control " name="pension" id="inputSelect">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                        </select>
                                    </td>
                                
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                            <td >
                                                <label>Registra antecedentes judiciales:</label>
                                            </td>
                                            <td>
                                                <select class="form-control " name="pension" id="inputSelect">
                                                            <option value="NO">NO</option>
                                                            <option value="SI">SI</option>
                                                </select>
                                            </td>
                                    </tr>

                                    <tr>
                                        <th scope="row">4</th>
                                            <td>
                                                <label>Tener inhabilitación vigente para prestar servicios al estado conforme al registro nacional de sanciones contra servidores civiles (RNSCC):</label>
                                            </td>
                                            <td>
                                                <select class="form-control " name="pension" id="inputSelect">
                                                            <option value="NO">NO</option>
                                                            <option value="SI">SI</option>
                                                </select>
                                            </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                            <td>
                                                <label>Estar inscrito en le registro de deudores alimentarios morosos (REDAM):</label>
                                            </td>
                                            <td>
                                                <select class="form-control " name="pension" id="inputSelect">
                                                            <option value="NO">NO</option>
                                                            <option value="SI">SI</option>
                                                </select>
                                            </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">6</th>
                                            <td>
                                                <label>Estar inscrito en el registro nacional de abogados sancionados por mala practica profesional (RNS) (En caso corresponda):</label>
                                            </td>
                                            <td>
                                                <select class="form-control " name="pension" id="inputSelect">
                                                            <option value="NO">NO</option>
                                                            <option value="SI">SI</option>
                                                </select>
                                            </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">7</th>
                                            <td>
                                                <label>Estar inscrito en la relacion de proveedores sancionados por el tribunal de contrataciones del estado de sancion vigente:</label>
                                            </td>
                                            <td>
                                                <select class="form-control " name="pension" id="inputSelect">
                                                            <option value="NO">NO</option>
                                                            <option value="SI">SI</option>
                                                </select>
                                            </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">8</th>
                                            <td>
                                                <label>Estar inscrito en el registro de deudores de reparaciones civiles (REDERECI) y por lo tanto no contar con ninguno de los impedimentos establecidos en le articulo 5 de la Ley 30353 (Ley que crea el REDERECI) para acceder el ejercicio de la función pública y contratacion del estado:</label>
                                            </td>
                                            <td>
                                                <select class="form-control " name="pension" id="inputSelect">
                                                            <option value="NO">NO</option>
                                                            <option value="SI">SI</option>
                                                </select>
                                            </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">9</th>
                                            <td>
                                                <label>Estar inscrito en la relacion de proveedores sancionados por el tribunal de contrataciones del estado de sancion vigente:</label>
                                            </td>
                                            <td>
                                                <select class="form-control " name="pension" id="inputSelect">
                                                            <option value="NO">NO</option>
                                                            <option value="SI">SI</option>
                                                </select>
                                            </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">10</th>
                                            <td>
                                                <label>Tener impedimento, icompatibilidad o estar incurso en alguna prohibición o restricción para ser postor o contratista y/o para postular, acceder o ejercer el servicio, función o cargo convocado por el MVCS:</label>
                                            </td>
                                            <td>
                                                <select class="form-control " name="pension" id="inputSelect">
                                                            <option value="NO">NO</option>
                                                            <option value="SI">SI</option>
                                                </select>
                                            </td>
                                    </tr>

                                    <tr>
                                        <th scope="row">11</th>
                                            <td>
                                                <label>Ser conyugue conviviente o pariente hasta el segundo grado de consanguinidad o afinidad de las personas señaladas en los literales a) AL g) del articulo 11 del texto unico ordenado de la Ley de contrataciones del estado:</label>
                                            </td>
                                            <td>
                                                <select class="form-control " name="pension" id="inputSelect">
                                                            <option value="NO">NO</option>
                                                            <option value="SI">SI</option>
                                                </select>
                                            </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">12</th>
                                            <td>
                                                <label>Percibir simultaneamente remuneración, pensión y honorarios por concepto de locación de servicios asesorias o consultorias
                                                o cualquier otra doble percepción o ingreso del estado, salvo por el ejercicio de la función docente efectiva y la percepción 
                                                de dietas por participación en uno de los directorios de entidades o empresas estatales o en tribunales administrativos o en 
                                                otros órganos colegiados:</label>
                                            </td>
                                            <td>
                                                <select class="form-control " name="pension" id="inputSelect">
                                                            <option value="NO">NO</option>
                                                            <option value="SI">SI</option>
                                                </select>
                                            </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">13</th>
                                            <td>
                                                <label>Percibir simultaneamente remuneración, pensión y honorarios por concepto de locación de servicios asesorias o consultorias
                                                o cualquier otra doble percepción o ingreso del estado, salvo por el ejercicio de la función docente efectiva y la percepción 
                                                de dietas por participación en uno de los directorios de entidades o empresas estatales o en tribunales administrativos o en 
                                                otros órganos colegiados:</label>
                                            </td>
                                            <td>
                                                <select class="form-control " name="pension" id="inputSelect">
                                                            <option value="NO">NO</option>
                                                            <option value="SI">SI</option>
                                                </select>
                                            </td>
                                    </tr>

                                </tbody>

                            </table>
                            
                            <input type="button" name="next" class="next action-button" value="Siguiente" /> <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                        </fieldset>
                        
                        <fieldset>
                            <div class="form-card">
                                <h3 class="purple-text text-center"><strong>YA CASI TERMINAMOS !</strong></h3> <br>
                                <div class="row justify-content-center">
                                    <div class="col-6"> 
                                        <img src="img/confirmacion.png" alt="Imagen de confirmación" style="width: 100%; height: auto;"> 
                                    </div>
                                </div> <br><br>
                                <div class="row justify-content-center">
                                    <div class="col-6 text-center">
                                        <h5 class="purple-text text-center">Presione FINALIZAR si esta seguro de haber concluido!</h5>
                                        <h6 class="red-text">NOTA: No se olvide luego llenar sus datos profesionales y experiencia laboral.</h6>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" name="next" class="next action-button" value="Finalizar"/>
                            <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                        </fieldset>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/wizard.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.js"></script>
    
    <script>
    $(function() {
        $("#inputSelect").on('change', function() {
        var selectValue = $(this).val();
        switch (selectValue) {
            case "AFP":
                $("#AFP").show();
                $("#AFP-2").show();
                $("#NINGUNA").hide();
            break;

            case "ONP":
                $("#AFP").hide();
                $("#AFP-2").hide();
                $("#NINGUNA").hide();
            break;
            case "ONP":
                $("#AFP").hide();
                $("#AFP-2").hide();
                $("#NINGUNA").hide();
            break;

            case "NINGUNA":
                $("#NINGUNA").show();
                $("#AFP").hide();
                $("#AFP-2").hide();
            break;
        }
        }).change();
        $("#pertenecer_pension").on('change', function() {
        var selectValue = $(this).val();
        switch (selectValue) {
            case "AFP":
                $("#opcion-AFP").show();
            break;

            case "ONP":
                $("#opcion-AFP").hide();
            break;
        }
        }).change();
    });
    </script>


    <script>
        $(function(){
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional").on('click', function(){
                $("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla").find("input[type=text]").val("");
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
                $.get("distrito.php","provincia_idprovincia="+$("#provincia_id1").val(), function(data){
                    $("#distrito_id1").html(data);
                    console.log(data);
                });
            });
        });
    </script>

</body>
</html>
