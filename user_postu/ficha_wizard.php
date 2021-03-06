<?php
include "conexion.php";
session_start();

$query = $con->query("select * from departamento");
$countries = array();
while ($r = $query->fetch_object()) {
  $countries[] = $r;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="Formulario tipo Wizard para las convocatorias de DIRESA TACNA">
  <meta name="author" content="Abel Maquera">
  <title>Ficha única de datos - DIRESA TACNA</title>
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
  include '../funcs/mcript.php';
  $dni = $_GET['dni'];
  $dato_desencriptado = SED::decryption($dni);
  // $dato_desencriptado = $_GET['dni'];
  // // $dni = $desencriptar($dato_desencriptado);

  $sql2 = "SELECT * FROM user where dni=$dato_desencriptado";
  $datos = mysqli_query($con, $sql2) or die(mysqli_error($datos));;
  $fila = mysqli_fetch_array($datos);
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
          <form id="msform" method="POST">
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
                  <li id="list"><strong></strong></li>
                  <li id="confirm"><strong></strong></li>
                </ul>
              </div>
            </div>
            <?php
            $sql1 = "SELECT * FROM postulante where dni=$dato_desencriptado";
            $datos1 = mysqli_query($con, $sql1) or die(mysqli_error($datos1));
            $fila1 = mysqli_fetch_array($datos1);
            $idpostulante = $fila1['idpostulante'];
            ?>
            <fieldset>
              <div class="form-card">
                <div class="row">
                  <div class="col-7">
                    <h2 class="fs-title">DATOS PERSONALES COMPLEMENTARIOS:</h2>
                    <p class="text-danger font-weight-bolder">Los que contengan este simbolo (*) son datos que no pueden dejarse vacios.</p>
                  </div>
                </div>
                <div class="form-group row">

                  <div class="col-md-5 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">Nombres</label>
                    <input class="form-control form-control-user" type="text" value="<?php echo $fila['nombres'] . " " . $fila['ape_pat'] . " " . $fila['ape_mat']; ?>" disabled="true" />
                  </div>
                  <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">(*) Fecha de nacimiento</label>
                    <input class="form-control form-control-user" type="date" id="fech_nac" name="fech_nac" required />
                  </div>
                  <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">(*) Pais</label>
                    <select class="form-control" name="pais" required>
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
                    <label class="font-weight-bolder">(*) Estado civil</label>
                    <select class="form-control" name="civil">
                      <option selected>Elegir...</option>
                      <option value="SOLTERO(A)">Soltero(a)</option>
                      <option value="CASADO(A)">Casado(a)</option>
                      <option value="VIUDO(A)">Viudo(a)</option>
                      <option value="DIVORCIADO(A)">Divorciado(a)</option>
                      <option value="CONVIVIENTE">Conviviente</option>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">(*) Sexo</label>
                    <select class="form-control" name="sexo" required>
                      <option selected>Elegir...</option>
                      <option value="MASCULINO">Masculino</option>
                      <option value="FEMENINO">Femenino</option>
                    </select>
                  </div>

                  <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">(*) Cel. emergencia</label>
                    <input class="form-control form-control-user" type="text" name="num_emer" maxlength="9" />
                  </div>
                  <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">(*) Contacto de emergencia</label>
                    <input class="form-control form-control-user" placeholder="Nombre familiar" type="text" name="nomb_parent" id="nomb_parent" style="text-transform: uppercase;" />
                  </div>
                  <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">(*) R.U.C.</label>
                    <input class="form-control form-control-user" type="number" name="ruc" maxlength="11" />
                  </div>
                  <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">N° cuenta CCI</label>
                    <input class="form-control form-control-user" placeholder="Banco de la Nación" type="number" name="cuenta_banc" maxlength="16" />
                  </div>
                  <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">Suspensión de 4ta.</label>
                    <select class="form-control" name="cuarta">
                      <option value="NO" selected>NO</option>
                      <option value="SI">SI</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">(*) Tipo de pensión</label>
                    <select class="form-control custom-select" name="pension" id="inputSelect">
                      <option value="NINGUNA">Ninguna</option>
                      <option value="ONP">ONP</option>
                      <option value="AFP">AFP</option>
                    </select>
                  </div>
                  <!-- aqui -->
                  <div id="AFP" class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">(*) Nombre de la AFP:</label>
                    <input type="text" name="nombre_afp" class="form-control" style="text-transform: uppercase; font-size: 13px;">
                  </div>
                  <!-- aqui -->
                  <div id="AFP-2" class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">Código CUSSP (opcional):</label>
                    <input type="text" name="codigo_cussp" class="form-control">
                  </div>
                  <!-- aqui -->
                  <div id="NINGUNA" class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">(*) ¿A cuál pertenecerias?</label>
                    <select class="form-control custom-select" name="pertenecer_pension" id="pertenecer_pension">
                      <option value="ONP">ONP</option>
                      <option value="AFP">AFP</option>
                    </select>
                  </div>
                  <!-- aqui -->
                  <div id="opcion-AFP" class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">Nombre AFP que pertenecería:</label>
                    <input type="text" name="nombre_afp_pregunta" class="form-control" style="text-transform: uppercase; font-size: 13px;">
                  </div>

                  <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">Discapacidad</label>
                    <select class="form-control" name="discapacidad">
                      <option value="NO" selected>NO</option>
                      <option value="SI">SI</option>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">Tipo discapacidad</label>
                    <select class="form-control" name="tip_discapacidad">
                      <option value="NINGUNA" select>Ninguna</option>
                      <option value="FISICA">Físicas</option>
                      <option value="SENSORIAL">Sensoriales</option>
                      <option value="MENTAL">Mentales</option>
                      <option value="INTELECTUAL">Intelectuales</option>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">(*) Grupo sanguineo</label>
                    <select class="form-control" name="tip_sangre">
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
                  <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">Servicio militar Completo</label>
                    <select class="form-control" name="servicio_militar" id="servicio_militar">
                      <option value="NO">NO</option>
                      <option value="SI">SI</option>
                    </select>
                  </div>
                  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">¿Deportista calificado?</label>
                    <select class="form-control" name="deportista_calif">
                      <option value="NO">NO</option>
                      <option value="20">Nivel 1 - Participado en juegos olimpicos...</option>
                      <option value="16">Nivel 2 - Participado en panamericanos...</option>
                      <option value="12">Nivel 3 - Participado en sudamericanos (Oro o Plata)</option>
                      <option value="8">Nivel 4 - Participado en sudamericanos (Bronce)</option>
                      <option value="4">Nivel 5 - Participado en Bolivarianos (Bronce)</option>
                    </select>
                  </div>
                  <div class="col-md-6 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">Enfermedades / Alergias</label>
                    <input class="form-control form-control-user" type="text" placeholder="Separado por comas" name="alergias" style="text-transform: uppercase; font-size: 13px;" />
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
                    <p class="text-danger font-weight-bolder">Los que contengan este simbolo (*) son datos que no pueden dejarse vacios.</p>
                  </div>
                </div>
                <div class="form-group row">
                  <input type="hidden" id="dni_post" name="dni_post" value="<?php echo $fila['dni']; ?>" />
                  <input type="hidden" id="idpostulante" name="idpostulante" value="<?php echo $idpostulante ?>" />

                  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder" for="name2">(*) Departamento </label>
                    <select id="departamento_id1" class="form-control" name="departamento_id1" required>
                      <option value="">-- SELECCIONE --</option>
                      <?php foreach ($countries as $c) : ?>
                        <option value="<?php echo $c->iddepartamento; ?>"><?php echo $c->departamento; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder" for="name2">(*) Provincia</label>
                    <select id="provincia_id1" class="form-control" name="provincia_id1" required>
                      <option value="">-- SELECCIONE --</option>
                    </select>
                  </div>

                  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder" for="exampleInputEmail1">(*) Distrito</label>
                    <select id="distrito_id1" class="form-control" name="distrito_id1" required>
                      <option value="">-- SELECCIONE --</option>
                    </select>
                  </div>

                  <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder" for="exampleInputEmail1">Tipo de Via</label>
                    <select class="form-control form-control-user" name="tipo_via">
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
                  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">Nombre de la via</label>
                    <input class="form-control form-control-user" type="text" name="nomb_via" placeholder="Nombre de via" style="text-transform: uppercase; font-size: 14px;" />
                  </div>
                  <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder" for="exampleInputEmail1">Tipo de Zona</label>
                    <select class="form-control form-control-user" name="tipo_zona" id="tipo_zona">
                      <option value="Urbanizacion">Urbanizacion</option>
                      <option value="Pueblo Joven">Pueblo Joven</option>
                      <option value="Unidad Vecinal">Unidad vecinal</option>
                      <option value="Conjunto habitacional">Conjunto habitacional</option>
                      <option value="Asentamiento humano">Asentamiento humano</option>
                      <option value="Cooperativa">Cooperativa</option>
                      <option value="Residencial">Residencial</option>
                      <option value="Zona Industrial">Zona industrial</option>
                      <option value="Grupo">Grupo</option>
                      <option value="Caserio">Caserio</option>
                      <option value="Asociacion">Asociacion</option>
                      <option value="Fundo">Fundo</option>
                      <option value="Comité">Comité</option>
                      <option value="Otros">Otros</option>
                    </select>
                    <br>
                  </div>
                  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">Nombre de la zona</label>
                    <input class="form-control form-control-user" type="text" name="nomb_zona" id="nomb_zona" placeholder="Nombre de la zona" style="text-transform: uppercase; font-size: 14px;" />
                  </div>
                  <div class="col-md-2 col-sm-2 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">Número #</label>
                    <input class="form-control form-control-user" style="text-transform: uppercase; font-size: 14px;" type="text" name="numero" />
                  </div>
                  <div class="col-md-2 col-sm-2 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">Mz.</label>
                    <input class="form-control form-control-user" style="text-transform: uppercase; font-size: 14px;" type="text" name="manzana" />
                  </div>
                  <div class="col-md-2 col-sm-2 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">Lt.</label>
                    <input class="form-control form-control-user" style="text-transform: uppercase; font-size: 14px;" type="text" name="lote" />
                  </div>
                  <div class="col-md-6 col-sm-6 mb-2 mb-sm-0">
                    <label class="font-weight-bolder">(*) Referencia</label>
                    <input class="form-control form-control-user" type="text" name="referencia" style="text-transform: uppercase; font-size: 13px;" placeholder="Indicar Avenida/Calle y/o Institucion cercana" />
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
                    <h2 class="fs-title">DATOS FAMILIARES:</h2>
                  </div>
                </div>

                <div class="col-md-6 col-sm-12 form-group">
                  <label class="font-weight-bolder" for="title">¿Tiene familiares que laboran en la DIRESA - TACNA?</label>
                  <select class="form-control" name="familiares_lab" onChange="familiares_lab_select(this)" required>
                    <option value="0">Seleccione:</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                </div>

                <div class="form-group" id="tabla_div" style="display:none">
                  <div class="table-responsive">

                    <table class="table table-bordered" id="tabla">
                      <thead>
                        <tr class="bg-danger" style="text-align:center; font-size:0.813em;">
                          <th scope="col">Nombres</th>
                          <th scope="col">Apellidos</th>
                          <th scope="col">N° DNI</th>
                          <th scope="col">Parentesco</th>
                          <th scope="col">Cargo</th>
                          <th scope="col">Dirección/Oficina</th>
                          <th scope="col">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="fila-fija">
                          <td><input type="text" name="nombre[]" style="text-transform: uppercase;" placeholder="Nombres" class="form-control name_list" /></td>
                          <td><input type="text" name="apellidos[]" style="text-transform: uppercase;" placeholder="Apellidos completos" class="form-control name_list" /></td>
                          <td><input type="text" name="dni[]" maxlength="8" class="form-control name_list" /></td>
                          <td>
                            <select name="parentesco[]" class="form-control">
                              <option value="" disabled selected>Elegir</option>
                              <option value="PADRE">Padre</option>
                              <option value="MADRE">Madre</option>
                              <option value="HERMANO(A)">Hermano(a)</option>
                              <option value="TIO(A)">Tio(a)</option>
                              <option value="ABUELO(A)">Abuelo(a)</option>
                              <option value="PRIMO(A)">Primo(a)</option>
                            </select>
                          </td>
                          <td><input type="text" style="text-transform: uppercase;" name="cargo[]" class="form-control name_list" /></td>
                          <td><input type="text" style="text-transform: uppercase;" name="area[]" class="form-control name_list" /></td>
                          <td class="eliminar"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                        </tr>
                        </tdody>
                    </table>
                  </div>
                </div>

                <div class="row d-flex justify-content-center" style="display:none">
                  <div class="form-inline p-2" style="display:none" id="boton_agregar">
                    <button id="adicional" name="adicional" type="button" class="btn btn-warning"><i class="fa fa-plus"></i> Fila</button>
                  </div>
                </div>
              </div>
              <input type="button" name="next" class="next action-button" value="Siguiente" />
              <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
            </fieldset>

            <fieldset>
              <div class="form-card">
                <div class="row">
                  <div class="col-12">
                    <h2 class="fs-title">DECLARACIÓN JURADA DE IMPEDIMENTOS E INCOMPATIBILIDADES:</h2>
                  </div>
                  <div class="col-12">
                    <h6 class="font-weight-bolder">Declaro bajo juramento lo siguiente:</h6>
                  </div>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.95em;">
                      <th scope="col">N°</th>
                      <th scope="col">Pregunta</th>
                      <th scope="col">Respuesta</th>
                    </tr>
                  </thead>

                  <tbody align="left">
                    <tr>

                      <th scope="row">1</th>
                      <td>
                        <label>Registra antecedentes policiales:</label>
                      </td>
                      <td>
                        <select class="form-control custom-select" name="pregunta1" id="pregunta1">
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
                        <select class="form-control custom-select" name="pregunta2" id="pregunta2">
                          <option value="NO">NO</option>
                          <option value="SI">SI</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>
                        <label>Registra antecedentes judiciales:</label>
                      </td>
                      <td>
                        <select class="form-control " name="pregunta3" id="pregunta3">
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
                        <select class="form-control " name="pregunta4" id="pregunta4">
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
                        <select class="form-control " name="pregunta5" id="pregunta5">
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
                        <select class="form-control " name="pregunta6" id="pregunta6">
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
                        <select class="form-control " name="pregunta7" id="pregunta7">
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
                        <select class="form-control " name="pregunta8" id="pregunta8">
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
                        <select class="form-control " name="pregunta9" id="pregunta9">
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
                        <select class="form-control " name="pregunta10" id="pregunta10">
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
                        <select class="form-control " name="pregunta11" id="pregunta11">
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
                        <select class="form-control " name="pregunta12" id="pregunta12">
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
                        <select class="form-control " name="pregunta13" id="pregunta13">
                          <option value="NO">NO</option>
                          <option value="SI">SI</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">14</th>
                      <td>
                        <label>Sentencia Condenatoria por delito doloso</label>
                      </td>
                      <td>
                        <select class="form-control " name="pregunta14" id="pregunta14">
                          <option value="NO">NO</option>
                          <option value="SI">SI</option>
                        </select>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <input type="button" class="next action-button" value="Siguiente" />
              <input type="button" name="previous" class="previous action-button-previous" value="Atrás" />
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
                  <div class="col-8 text-center">
                    <h5 class="purple-text text-center">Presione FINALIZAR si esta seguro de haber concluido, caso contrario presione "Atrás" para verificar sus datos personales.</h5>
                    <h6 class="red-text">NOTA: No se olvide luego llenar su formación académica, capacitaciones y experiencia laboral.</h6>
                  </div>
                </div>
              </div>
              <div class="row justify-content-center">
                <button id="finalizar" class="btn btn-danger btn-lg">Finalizar</button>
              </div>
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
  <script src="js/ficha_wizard.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $("#departamento_id").change(function() {
        $.get("provincia.php", "departamento_iddepartamento=" + $("#departamento_id").val(), function(data) {
          $("#provincia_id").html(data);
          console.log(data);
        });
      });

      $("#provincia_id").change(function() {
        $.get("distrito.php", "provincia_idprovincia=" + $("#provincia_id").val(), function(data) {
          $("#distrito_id").html(data);
          console.log(data);
        });
      });
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $("#departamento_id1").change(function() {
        $.get("provincia.php", "departamento_iddepartamento=" + $("#departamento_id1").val(), function(data) {
          $("#provincia_id1").html(data);
          console.log(data);
        });
      });

      $("#provincia_id1").change(function() {
        $.get("distrito.php", "provincia_idprovincia=" + $("#provincia_id1").val(), function(data) {
          $("#distrito_id1").html(data);
          console.log(data);
        });
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#finalizar').click(function() {
        var datos = $('#msform').serialize();
        $.ajax({
          type: "POST",
          url: "procesos/guardar_ficha.php",
          data: datos,
          success: function(r) {
            console.log("Mensaje: ", r);
            const respuesta = JSON.parse(r);
            if (respuesta.r == 1) {
              Swal.fire({
                title: 'Te has registrado correctamente',
                text: 'Ahora vuelve a INICIAR SESIÓN para confirmar su usuario.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
              }).then(function() {
                window.location = "../index.php";
              });

            } else {
              Swal.fire({
                title: 'Error al registrar',
                text: respuesta.mensaje,
                icon: 'error',
                confirmButtonText: 'Aceptar',
              });
            }
          }
        });

        return false;
      });
    });
  </script>
</body>

</html>