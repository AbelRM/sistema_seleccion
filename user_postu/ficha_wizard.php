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
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 text-center p-0 mt-3 mb-2">
                <div class="card px-4 pt-4 mt-3 mb-3" style="padding: 30px;">
                    <h2 id="heading">FICHA ÚNICA DE DATOS</h2>
                    <p>Para la contratación de personal dispuesto en el Decreto de Urgencia N° 029-2020</p>
                    <form id="msform">
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="active" id="user"><strong></strong></li>
                            <li id="home"><strong></strong></li>
                            <li id="student"><strong></strong></li>
                            <li id="book"><strong></strong></li>
                            <li id="book"><strong></strong></li>
                            <li id="book"><strong></strong></li>
                            <li id="payment"><strong></strong></li>
                            <li id="work"><strong></strong></li>
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
                                        <input class="form-control form-control-user" type="text" name="fname" value="" disabled="true"/> 
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label>Fecha de nacimiento</label> 
                                        <input class="form-control form-control-user" type="date"   /> 
                                    </div>
                                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                        <label>Estado civil</label> 
                                        <select class="form-control" id="exampleFormControlSelect1">
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
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option selected>Elegir...</option>
                                            <option value="MASCULINO">Masculino</option>
                                            <option value="FEMENINO">Femenino</option>
                                        </select> 
                                    </div>
                                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                        <label>Cel. emergencia</label> 
                                        <input class="form-control form-control-user" type="text"/> 
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                                        <label>Parentesco</label> 
                                        <input class="form-control form-control-user" placeholder="Nombre familiar" type="text"/> 
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label>R.U.C.</label> 
                                        <input class="form-control form-control-user" type="text"/> 
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label>N° cuenta bancaria</label> 
                                        <input class="form-control form-control-user" placeholder="Banco de la Nación" type="text"/> 
                                    </div>
                                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                        <label>Discapacidad</label> 
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option selected>Elegir...</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                            
                                        </select>  
                                    </div>
                                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                        <label>Tipo de discapacidad</label> 
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option selected>Elegir...</option>
                                            <option value="FISICA">Físicas</option>
                                            <option value="SENSORIAL">Sensoriales</option>
                                            <option value="MENTAL">Mentales</option>
                                            <option value="INTELECTUAL">Intelectuales</option>
                                        </select>  
                                    </div>
                                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                        <label>Grupo sanguineo</label> 
                                        <select class="form-control" id="exampleFormControlSelect1">
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
                                        <input class="form-control form-control-user" type="text" name="fname" placeholder="Separado por comas"/> 
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
                                        <select class="form-control form-control-user" style="padding: inherit;" id="estado_civil">
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
                                        <input class="form-control form-control-user" type="text" name="fname" placeholder="Via"/> 
                                    </div>
                                    
                                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                        <label>Número</label> 
                                        <input class="form-control form-control-user" type="text" name="fname" placeholder="Número"/> 
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label for="exampleInputEmail1">Tipo de Zona</label>
                                        <select class="form-control form-control-user" style="padding: inherit;" id="estado_civil">
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
                                        <input class="form-control form-control-user" type="text" name="fname" placeholder="Zona"/> 
                                    </div>

                                    <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                                        <label>Número</label> 
                                        <input class="form-control form-control-user" type="text" name="fname" placeholder="Número"/> 
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label for="exampleInputEmail1">Departamento</label>
                                        <select class="form-control form-control-user" style="padding: inherit;" id="Departamento">
                                            <option value="AVENIDA">Tacna</option>
                                            <option value="JIRON">Moquegua</option>
                                            <option value="CALLE">Arequipa</option>
                                            <option value="PASAJE">Conjunto habitacional</option>
                                            <option value="ALAMEDA">Asentamiento humano</option>
                                            <option value="MALECON">Cooperativa</option>
                                            <option value="OVALO">Residencial</option>
                                            <option value="PASAJE">Zona industrial</option>
                                            <option value="PARQUE">Grupo</option>
                                            <option value="PLAZA">Caserio</option>
                                            <option value="CARRETERA">Fundo</option>
                                        </select> 
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label for="exampleInputEmail1">Provincia</label>
                                        <select class="form-control form-control-user" style="padding: inherit;" id="estado_civil">
                                        <option value="AVENIDA">Candarave</option>
                                        <option value="JIRON">Jorge Basadre</option>
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
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label for="exampleInputEmail1">Distrito</label>
                                        <select class="form-control form-control-user" style="padding: inherit;" id="estado_civil">
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
                    
                                    </div>

                                    <div class="col-md-12 col-sm-6 mb-2 mb-sm-0">
                                        <label> Referencia</label> 
                                        <input class="form-control form-control-user" type="text" name="fname" placeholder="Indicar Avenida/Calle y/o Institucion cercana"/> 
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
                                    <!-- <div class="col-5">
                                        <h2 class="steps">Seccion 2 - 4</h2>
                                    </div> -->
                                </div>
                                <div class="form-group row">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dynamic_field">
                                            <thead>
                                                <tr>
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
                                                <tr>
                                                    <td><input type="text" name="name[]" placeholder="Nombres" class="form-control name_list" /></td>
                                                    <td><input type="text" name="name[]" placeholder="Apellidos" class="form-control name_list" /></td>
                                                    <td><input type="date" name="name[]" placeholder="Fecha nacimiento" class="form-control name_list" /></td>
                                                    <td><input type="text"  name="name[]" placeholder="N° DNI" class="form-control name_list" maxlength="8" /></td>
                                                    <td><input type="text" name="name[]" placeholder="Parentesco" class="form-control name_list" /></td>
                                                    <td><input type="text" name="name[]" placeholder="Nombre entidad" class="form-control name_list" /></td>
                                                    <td><button type="button" name="add" id="add" class="btn btn-primary"> + </button></td>
                                                </tr>
                                            </tdody>
                                        </table>
                                        <!-- <input type="button" name="submit" id="submit" class="btn btn-success" value="GUARDAR" /> -->
                                    </div>
                                </div>
                            </div>
                            <input type="button" name="next" class="next action-button" value="Siguiente" /> 
                            <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                        </fieldset>
        
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">DATOS PROFESIONALES Y ACADÉMICOS I:</h2>
                                    </div>
                                    <!-- <div class="col-5">
                                        <h2 class="steps">Step 3 - 4</h2>
                                    </div> -->
                                </div>
                                <div class="form-group row">
    
                                    <div class="col-md-9 col-sm-6 mb-2 mb-sm-0">
                                        <label> Profesion</label> 
                                        <input class="form-control form-control-user" type="text" name="fname" placeholder="Indicar profesion"/> 
                                    </div>

                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label>Fecha de colegiatura</label> 
                                        <input class="form-control form-control-user" type="date" name="fname" placeholder="Fecha"/> 
                                    </div>

                                    <div class="col-md-6 col-sm-6 mb-2 mb-sm-0">
                                        <label>Lugar de colegiatura</label> 
                                        <input class="form-control form-control-user" type="text" name="fname" placeholder="Lugar"/> 
                                    </div>

                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label>Fecha de colegiatura habilitado</label> 
                                        <input class="form-control form-control-user" type="date" name="fname" placeholder="Fecha"/> 
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                                        <label>Número</label> 
                                        <input class="form-control form-control-user" type="text" name="fname" placeholder="Número"/> 
                                    </div>
                                </div> 
                            </div>
                            <input type="button" name="next" class="next action-button" value="Siguiente" /> <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                        </fieldset>

                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">DATOS PROFESIONALES Y ACADÉMICOS II:</h2>
                                    </div>
                                    <!-- <div class="col-5">
                                        <h2 class="steps">Seccion 2 - 4</h2>
                                    </div> -->
                                </div>                           

                                <div class="table-responsive">
                                    <label>Estudios Superiores (Universitario - Tecnico)</label> 
                                    <table class="table table-bordered" id="dynamic_field_5">
                                        <thead>
                                            <tr>
                                                <th scope="col">Centro Estudios</th>
                                                <th scope="col">Especialidad</th>
                                                <th scope="col">Fecha Inicio</th>
                                                <th scope="col">Fecha Termino</th>
                                                <th scope="col">Nivel Alcanzado</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="name_5[]" placeholder="Centro Estudios" class="form-control name_list" /></td>
                                                <td><input type="text" name="name_5[]" placeholder="Especialidad" class="form-control name_list" /></td>
                                                <td><input type="date" name="name_5[]" placeholder="Fecha Inicio" class="form-control name_list" /></td>
                                                <td><input type="date" name="name_5[]" placeholder="Fecha Termino" class="form-control name_list" /></td>
                                                <td>
                                                        
                                                    <select class="form-control name_list" name="name_5[]">
                                                        <option value="Magister">Magister</option>
                                                        <option value="Doctorado">Doctorado</option>
                                                        <option value="Egresado">Egresado</option>
                                                        <option value="Estudiante">Estudiante</option>
                                                      </select>
                                                </td>    
                                                <td><button type="button" name="add_5" id="add_5" class="btn btn-primary"> + </button></td>
                                            </tr>
                                        </tdody>
                                    </table>          
                                </div>

                                <div class="table-responsive">
                                    <label>Estudios Posgrado (Maestria - Doctorado)</label> 
                                    <table class="table table-bordered" id="dynamic_field_6">
                                        <thead>
                                            <tr>
                                                <th scope="col">Centro Estudios</th>
                                                <th scope="col">Especialidad</th>
                                                <th scope="col">Fecha Inicio</th>
                                                <th scope="col">Fecha Termino</th>
                                                <th scope="col">Nivel Alcanzado</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="name_6[]" placeholder="Centro Estudios" class="form-control name_list" /></td>
                                                <td><input type="text" name="name_6[]" placeholder="Especialidad" class="form-control name_list" /></td>
                                                <td><input type="date" name="name_6[]" placeholder="Fecha Inicio" class="form-control name_list" /></td>
                                                <td><input type="date" name="name_6[]" placeholder="Fecha Termino" class="form-control name_list" /></td>
                                                <td>
                                                        
                                                    <select class="form-control name_list" name="name_6[]">
                                                        <option value="Magister">Magister</option>
                                                        <option value="Doctorado">Doctorado</option>
                                                        <option value="Egresado">Egresado</option>
                                                        <option value="Estudiante">Estudiante</option>
                                                      </select>
                                                </td>    
                                                <td><button type="button" name="add_6" id="add_6" class="btn btn-primary"> + </button></td>
                                            </tr>
                                        </tdody>
                                    </table>
                                    
                                </div>

                            </div>
                            <input type="button" name="next" class="next action-button" value="Siguiente" /> <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                        </fieldset>

                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">DATOS PROFESIONALES Y ACADEMICOS III:</h2>
                                    </div>
                                    <!-- <div class="col-5">
                                        <h2 class="steps">Seccion 2 - 4</h2>
                                    </div> -->
                                </div>

                                <div class="table-responsive">
                                    <label>Especialización - Diplomados</label> 
                                    <table class="table table-bordered" id="dynamic_field_7">
                                        <thead>
                                            <tr>
                                                <th scope="col">Centro Estudios</th>
                                                <th scope="col">Especialidad</th>
                                                <th scope="col">Fecha Inicio</th>
                                                <th scope="col">Fecha Termino</th>
                                                <th scope="col">Nivel Alcanzado</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="name_7[]" placeholder="Centro Estudios" class="form-control name_list" /></td>
                                                <td><input type="text" name="name_7[]" placeholder="Especialidad" class="form-control name_list" /></td>
                                                <td><input type="date" name="name_7[]" placeholder="Fecha Inicio" class="form-control name_list" /></td>
                                                <td><input type="date" name="name_7[]" placeholder="Fecha Termino" class="form-control name_list" /></td>
                                                <td>
                                                        
                                                    <select class="form-control name_list" name="name_7[]">
                                                        <option value="Magister">Magister</option>
                                                        <option value="Doctorado">Doctorado</option>
                                                        <option value="Egresado">Egresado</option>
                                                        <option value="Estudiante">Estudiante</option>
                                                      </select>
                                                </td>  
                                                <td><button type="button" name="add_7" id="add_7" class="btn btn-primary"> + </button></td>
                                            </tr>
                                        </tdody>
                                    </table>             
                                </div>

                                <div class="form-group row">
                                    <label>Cursos - Seminarios</label> 
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dynamic_field_8">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Centro Estudios</th>
                                                    <th scope="col">Especialidad</th>
                                                    <th scope="col">Fecha Inicio</th>
                                                    <th scope="col">Fecha Termino</th>
                                                    <th scope="col">Nivel Alcanzado</th>
                                                    <th scope="col">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" name="name_8[]" placeholder="Centro Estudios" class="form-control name_list" /></td>
                                                    <td><input type="text" name="name_8[]" placeholder="Especialidad" class="form-control name_list" /></td>
                                                    <td><input type="date" name="name_8[]" placeholder="Fecha Inicio" class="form-control name_list" /></td>
                                                    <td><input type="date" name="name_8[]" placeholder="Fecha Termino" class="form-control name_list" /></td>                   
                                                    <td>
                                                        
                                                        <select class="form-control name_list" name="name_8[]">
                                                            <option value="Magister">Magister</option>
                                                            <option value="Doctorado">Doctorado</option>
                                                            <option value="Egresado">Egresado</option>
                                                            <option value="Estudiante">Estudiante</option>
                                                          </select>
                                                    </td>  
                                                    <td><button type="button" name="add_8" id="add_8" class="btn btn-primary"> + </button></td>
                                                </tr>
                                            </tdody>
                                        </table>
                                        <!-- <input type="button" name="submit" id="submit" class="btn btn-success" value="GUARDAR" /> -->
                                    </div>
                                </div>
                            </div>
                            
                            <input type="button" name="next" class="next action-button" value="Siguiente" /> <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                        </fieldset>

                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">IDIOMAS:</h2>
                                    </div>
                                    <!-- <div class="col-5">
                                        <h2 class="steps">Step 3 - 4</h2>
                                    </div> -->
                                </div>
                                <div class="form-group row">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dynamic_field_2">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Lenguaje extranjero</th>
                                                    <th scope="col">Nivel</th>
                                                    <th scope="col">Acción</th>
                                            
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" name="name_2[]" placeholder="Lenguaje" class="form-control name_list" /></td>
                                                    <td>
                                                        <!-- <input type="text" name="name[]" placeholder="Nivel" class="form-control name_list" /> -->
                                                        <select class="form-control name_list" name="name_2[]">
                                                            <option value="basico">NIVEL BASICO</option>
                                                            <option value="intermedio">NIVEL INTERMEDIO</option>
                                                            <option value="avanzado">NIVEL AVANZADO</option>
                                                          </select>

                                                    </td>
                                                    
                                                    <td><button type="button" name="add_2" id="add_2" class="btn btn-primary">Agregar + </button></td>
                                                </tr>
                                            </tdody>
                                        </table>
                                        <!-- <input type="button" name="submit" id="submit" class="btn btn-success" value="GUARDAR" /> -->
                                    </div>
                                </div>
                                
                            </div> 
                            <input type="button" name="next" class="next action-button" value="Siguiente" /> <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                        </fieldset>

                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">DATOS LABORALES:</h2>
                                    </div>
                                    <!-- <div class="col-5">
                                        <h2 class="steps">Step 3 - 4</h2>
                                    </div> -->
                                </div>

                                <div class="form-group row">
                                    <h5>Experiencia laboral</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dynamic_field_3">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Institucion/Empresa</th>
                                                    <th scope="col">Cargo - Actividad desempeñada</th>
                                                    <th scope="col">Fecha Inicio</th>
                                                    <th scope="col">Fecha Fin</th>
                                                    <th scope="col">Acción</th>
                                            
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" name="name_3[]" placeholder="Nombre" class="form-control name_list" /></td>
                                                    <td><input type="text" name="name_3[]" placeholder="Cargo" class="form-control name_list" /></td>
                                                    <td><input type="date" name="name_3[]" placeholder="Fecha Inicio" class="form-control name_list" /></td>
                                                    <td><input type="date"  name="name_3[]" placeholder="Fecha Fin" class="form-control name_list" /></td>
                                                    
                                                    <td><button type="button" name="add_3" id="add_3" class="btn btn-primary"> + </button></td>
                                                </tr>
                                            </tdody>
                                        </table>
                                        <!-- <input type="button" name="submit" id="submit" class="btn btn-success" value="GUARDAR" /> -->
                                    </div>
                                </div> 
                            
                                <div class="form-group row">
                                    <h5>Labores de docencia</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dynamic_field_4">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Centro de enseñanzas</th>
                                                    <th scope="col">Curso Dictado</th>
                                                    <th scope="col">Fecha Inicio</th>
                                                    <th scope="col">Fecha Fin</th>
                                                    <th scope="col">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" name="name_4[]" placeholder="Nombre" class="form-control name_list" /></td>
                                                    <td><input type="text" name="name_4[]" placeholder="Curso dictado" class="form-control name_list" /></td>
                                                    <td><input type="date" name="name_4[]" placeholder="Fecha Inicio" class="form-control name_list" /></td>
                                                    <td><input type="date"  name="name_4[]" placeholder="Fecha Fin" class="form-control name_list" /></td>
                                                    
                                                    <td><button type="button" name="add_4" id="add_4" class="btn btn-primary"> + </button></td>
                                                </tr>
                                            </tdody>
                                        </table>
                                        <!-- <input type="button" name="submit" id="submit" class="btn btn-success" value="GUARDAR" /> -->
                                    </div>
                                </div>
                            </div>
                            <input type="button" name="next" class="next action-button" value="Siguiente" /> <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
                        </fieldset>

                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="fs-title">DECLARACIÓN JURADA DE IMPEDIMENTOS E INCOMPATIBILIDADES:</h2>
                                    </div>
                                    <!-- <div class="col-5">
                                        <h2 class="steps">Step 3 - 4</h2>
                                    </div> -->
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
                        </fieldset>
                        
                        <fieldset>
                            <div class="form-card">
                                <h2 class="purple-text text-center"><strong>COMPLETADO !</strong></h2> <br>
                                <div class="row justify-content-center">
                                    <div class="col-6"> 
                                        <img src="img/confirmacion.png" alt="Imagen de confirmación" style="width: 100%; height: auto;"> 
                                    </div>
                                </div> <br><br>
                                <div class="row justify-content-center">
                                    <div class="col-6 text-center">
                                        <h5 class="purple-text text-center">Se ha registrado todo correctamente</h5>
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

        $(document).ready(function(){
            var i = 1;
    
            $('#add').click(function () {
                i++;
                $('#dynamic_field').append('<tr id="row'+i+'">' +
                    '<td><input type="text" name="name[]" placeholder="Nombres" class="form-control name_list" /></td>' +
                    '<td><input type="text" name="name[]" placeholder="Apellidos" class="form-control name_list" /></td>' +
                    '<td><input type="date" name="name[]" class="form-control name_list" /></td>' +
                    '<td><input type="text" name="name[]" placeholder="N° DNI" class="form-control name_list" maxlength="8" /></td>' +
                    '<td><input type="text" name="name[]" placeholder="Parentesco" class="form-control name_list" /></td>' +
                    '<td><input type="text" name="name[]" placeholder="Entidad donde labora" class="form-control name_list" /></td>' +
                    '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>' +
                    '</tr>');
            });
            
            $(document).on('click', '.btn_remove', function () {
                var id = $(this).attr('id');
               $('#row'+ id).remove();
            });
    
            // $('#submit').click(function(){
            //     $.ajax({
            //         url:"name.php",
            //         method:"POST",
            //         data:$('#add_name').serialize(),
            //         success:function(data)
            //         {
            //             alert(data);
            //             $('#add_name')[0].reset();
            //         }
            //     });
            // });
        });
    </script>

    <script>

        $(document).ready(function(){
            var i = 1;

            $('#add_2').click(function () {
                i++;
                $('#dynamic_field_2').append('<tr id="row'+i+'">' +
                    '<td><input type="text" name="name_2[]" placeholder="Nombres" class="form-control name_list" /></td>' +
                    '<td><select class="form-control name_list" name="name_2[]"><option value="basico">NIVEL BASICO</option><option value="intermedio">NIVEL INTERMEDIO</option> <option value="avanzado">NIVEL AVANZADO</option> </select></td>'+
                    '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>' +
                    '</tr>');
            });
            
            $(document).on('click', '.btn_remove', function () {
                var id = $(this).attr('id');
            $('#row'+ id).remove();
            });

            // $('#submit').click(function(){
            //     $.ajax({
            //         url:"name.php",
            //         method:"POST",
            //         data:$('#add_name').serialize(),
            //         success:function(data)
            //         {
            //             alert(data);
            //             $('#add_name')[0].reset();
            //         }
            //     });
            // });
        });
    </script>

    <script>

        $(document).ready(function(){
            var i = 1;

            $('#add_3').click(function () {
                i++;
                $('#dynamic_field_3').append('<tr id="row'+i+'">' +
                    '<td><input type="text" name="name_3[]" placeholder="Nombres" class="form-control name_list" /></td>' +
                    '<td><input type="text" name="name_3[]" placeholder="Cargo" class="form-control name_list" /></td>'+
                    '<td><input type="date" name="name_3[]" placeholder="Fecha Inicio" class="form-control name_list" /></td>'+
                    '<td><input type="date" name="name_3[]" placeholder="Fecha Fin" class="form-control name_list" /></td>'+
                    '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>' +
                    '</tr>');
            });
            
            $(document).on('click', '.btn_remove', function () {
                var id = $(this).attr('id');
            $('#row'+ id).remove();
            });

            // $('#submit').click(function(){
            //     $.ajax({
            //         url:"name.php",
            //         method:"POST",
            //         data:$('#add_name').serialize(),
            //         success:function(data)
            //         {
            //             alert(data);
            //             $('#add_name')[0].reset();
            //         }
            //     });
            // });
        });
    </script>

    <script>
        $(document).ready(function(){
            var i = 1;

            $('#add_4').click(function () {
                i++;
                $('#dynamic_field_4').append('<tr id="row'+i+'">' +
                    '<td><input type="text" name="name_4[]" placeholder="Nombre" class="form-control name_list" /></td>' +
                    '<td><input type="text" name="name_4[]" placeholder="Curso dictado" class="form-control name_list" /></td>'+
                    '<td><input type="date" name="name_4[]" placeholder="Fecha Inicio" class="form-control name_list" /></td>'+
                    '<td><input type="date" name="name_4[]" placeholder="Fecha Fin" class="form-control name_list" /></td>'+
                    '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>' +
                    '</tr>');
            });
            
            $(document).on('click', '.btn_remove', function () {
                var id = $(this).attr('id');
            $('#row'+ id).remove();
            });

            // $('#submit').click(function(){
            //     $.ajax({
            //         url:"name.php",
            //         method:"POST",
            //         data:$('#add_name').serialize(),
            //         success:function(data)
            //         {
            //             alert(data);
            //             $('#add_name')[0].reset();
            //         }
            //     });
            // });
        });
    </script>

    <script>
    $(document).ready(function(){
        var i = 1;
        $('#add_5').click(function () {
            i++;
            $('#dynamic_field_5').append('<tr id="row'+i+'">' +
                '<td><input type="text" name="name_5[]" placeholder="Centro Estudios" class="form-control name_list" /></td>'+
                '<td><input type="text" name="name_5[]" placeholder="Especialidad" class="form-control name_list" /></td>' +
                '<td><input type="date" name="name_5[]" placeholder="Fecha Inicio" class="form-control name_list" /></td>' +
                '<td><input type="date" name="name_5[]" placeholder="Fecha Termino" class="form-control name_list" /></td>' +
                '<td><select class="form-control name_list" name="name_5[]"><option value="Magister">Magister</option><option value="Doctorado">Doctorado</option> <option value="Egresado">Egresado</option> <option value="Estudiante">Estudiante</option> </select></td>'+
                '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>'+  '</tr>');
        });
        
        $(document).on('click', '.btn_remove', function () {
            var id = $(this).attr('id');
        $('#row'+ id).remove();
        });
 
    });
    </script>

    <script>
    $(document).ready(function(){
        var i = 1;
        $('#add_6').click(function () {
            i++;
            $('#dynamic_field_6').append('<tr id="row'+i+'">' +
                '<td><input type="text" name="name_6[]" placeholder="Centro Estudios" class="form-control name_list" /></td>'+
                '<td><input type="text" name="name_6[]" placeholder="Especialidad" class="form-control name_list" /></td>' +
                '<td><input type="date" name="name_6[]" placeholder="Fecha Inicio" class="form-control name_list" /></td>' +
                '<td><input type="date" name="name_6[]" placeholder="Fecha Termino" class="form-control name_list" /></td>' +
                '<td><select class="form-control name_list" name="name_6[]"><option value="Magister">Magister</option><option value="Doctorado">Doctorado</option> <option value="Egresado">Egresado</option> <option value="Estudiante">Estudiante</option> </select></td>'+
                '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>'+  '</tr>');
        });
        
        $(document).on('click', '.btn_remove', function () {
            var id = $(this).attr('id');
        $('#row'+ id).remove();
        });
 
    });
    </script>

<script>
    $(document).ready(function(){
        var i = 1;
        $('#add_7').click(function () {
            i++;
            $('#dynamic_field_7').append('<tr id="row'+i+'">' +
                '<td><input type="text" name="name_7[]" placeholder="Centro Estudios" class="form-control name_list" /></td>'+
                '<td><input type="text" name="name_7[]" placeholder="Especialidad" class="form-control name_list" /></td>' +
                '<td><input type="date" name="name_7[]" placeholder="Fecha Inicio" class="form-control name_list" /></td>' +
                '<td><input type="date" name="name_7[]" placeholder="Fecha Termino" class="form-control name_list" /></td>' +
                '<td><select class="form-control name_list" name="name_7[]"><option value="Magister">Magister</option><option value="Doctorado">Doctorado</option> <option value="Egresado">Egresado</option> <option value="Estudiante">Estudiante</option> </select></td>'+
                '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>'+  '</tr>');
        });
        
        $(document).on('click', '.btn_remove', function () {
            var id = $(this).attr('id');
        $('#row'+ id).remove();
        });
 
    });
    </script>

    <script>
    $(document).ready(function(){
        var i = 1;
        $('#add_8').click(function () {
            i++;
            $('#dynamic_field_8').append('<tr id="row'+i+'">' +
                '<td><input type="text" name="name_8[]" placeholder="Centro Estudios" class="form-control name_list" /></td>'+
                '<td><input type="text" name="name_8[]" placeholder="Especialidad" class="form-control name_list" /></td>' +
                '<td><input type="date" name="name_8[]" placeholder="Fecha Inicio" class="form-control name_list" /></td>' +
                '<td><input type="date" name="name_8[]" placeholder="Fecha Termino" class="form-control name_list" /></td>' +
                '<td><select class="form-control name_list" name="name_8[]"><option value="Magister">Magister</option><option value="Doctorado">Doctorado</option> <option value="Egresado">Egresado</option> <option value="Estudiante">Estudiante</option> </select></td>'+
                '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>'+  '</tr>');
        });
        
        $(document).on('click', '.btn_remove', function () {
            var id = $(this).attr('id');
        $('#row'+ id).remove();
        });
 
    });
    </script>


</body>
</html>
