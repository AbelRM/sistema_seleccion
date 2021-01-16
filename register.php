<?php

require 'conexion.php';
//require 'funcs/funcs.php';

$errors = array();

//Aqui va el código PHP del Vídeo

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Registro de sistema de postulacion DIRESA TACNA</title>

  <!-- Custom fonts for this template-->
  <link rel="icon" type="image/png" href="public/img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="public/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-4 d-none d-lg-flex justify-content-center">
            <img src="public/img/register.png" style="max-width: 100%; margin: auto;" alt="Imagen de formulario registro">
          </div>
          <div class="col-lg-8">
            <div class="p-4">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">CREAR CUENTA</h1>
              </div>
              <form id="form" action="procesos/guardar_user.php" class="needs-validation user" method="POST">
                <div class="form-group row">
                  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                    <label for="nombres">(*) Nombres</label>
                    <input type="text" style="padding: inherit; text-transform: uppercase;" class="form-control form-control-user" id="nombres" name="nombres" required>
                    <div class="valid-feedback">Nombres correctos</div>
                    <div class="invalid-feedback">Colocar nombres completos!</div>
                  </div>
                  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                    <label for="ape_pat">(*) Apellido paterno</label>
                    <input type="text" style="padding: inherit; text-transform: uppercase;" class="form-control form-control-user" id="ape_pat" name="ape_pat" required>
                  </div>
                  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                    <label for="ape_mat">(*) Apellido materno</label>
                    <input type="text" style="padding: inherit; text-transform: uppercase;" class="form-control form-control-user" id="ape_mat" name="ape_mat" required>
                  </div>
                  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                    <label for="ape_mat">Tipo de documento</label>
                    <select style="padding: inherit;" name="tipo_documento" class="form-control form-control-user" onChange="pagoOnChange(this)" required>
                      <option value="">Elegir...</option>
                      <option value="DNI">D.N.I.</option>
                      <option value="C.E.">Carnet Extranjeria</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-6 mb-2 mb-sm-0" id="mostrar_div" style="display:none;">
                    <label for="dni" id="nCuenta" style="display:block;">D.N.I.</label>
                    <label for="carnet" id="nTargeta" style="display:none;">Carnet de Extranjería</label>
                    <input type="text" style="padding: inherit;" class="form-control form-control-user" id="dni" name="dni">
                  </div>
                  <div class="col-md-5 col-sm-6 mb-2 mb-sm-0">
                    <label for="correo">(*) Correo electronico</label>
                    <input type="email" style="padding: inherit;" class="form-control form-control-user" id="correo" name="correo" required>
                    <div class="valid-feedback">Correo válido</div>
                    <div class="invalid-feedback">Correo no válido!</div>
                  </div>
                  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                    <label for="celular">(*) Nro. Celular</label>
                    <input type="text" style="padding: inherit;" class="form-control form-control-user" id="celular" name="celular" maxlength="9" required>
                    <div class="valid-feedback">Nro. celular válido</div>
                    <div class="invalid-feedback">No deje espacios ni "-"</div>
                  </div>
                  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                    <label for="clave">(*) Contraseña (8 mínimo)</label>
                    <input type="password" style="padding: inherit;" class="form-control form-control-user" id="clave" name="clave" required="true" required><span class="help-block"></span>
                  </div>
                  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                    <label for="confi_clave">(*) Confirmar contraseña</label>
                    <input type="password" style="padding: inherit;" class="form-control form-control-user" id="confi_clave" name="confi_clave" required="true" required><span class="help-block"></span>
                    <label id="mensaje_error" class="control-label col-md-12 text-danger" style="display: block;">Las constraseñas si coinciden</label>
                  </div>
                </div>
                <div class="form-group d-flex justify-content-center">
                  <div class="g-recaptcha" data-sitekey="6LcAvMQZAAAAABpMCKbjwzzFlH4IK5OCjePzxkh7"></div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary">Registrar</button>
                </div>

              </form>

              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.php">¿Olvidaste tu contraseña?</a>
              </div>
              <div class="text-center">
                <a class="small" href="index.php">Ya tienes una cuenta? Ingresa!</a>
              </div>
            </div>
          </div>
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
  <!-- <script src="https://www.google.com/recaptcha/api.js?render=6LeVwMQZAAAAABWIaLf9mZZAoV1sJvF9aYTRzexH"></script> -->
  <script src="public/js/sb-admin-2.min.js"></script>
  <!-- <script src="public/js/validacion.js"></script> -->
  <!-- <script>
    $('#form').submit(function(event) {
      event.preventDefault();
      /*Cambia 6LcZu9QUAAAAACaj-WBiVIQUlr94vfCC8DUpIanS por tu clave de sitio web*/
      grecaptcha.ready(function() {
        grecaptcha.execute('6LeVwMQZAAAAABWIaLf9mZZAoV1sJvF9aYTRzexH', {
          action: 'registro'
        }).then(function(token) {
          $('#form').prepend('<input type="hidden" name="token_2" value="' + token + '">');
          $('#form').prepend('<input type="hidden" name="action" value="registro">');
          $('#form').unbind('submit').submit();
        });;
      });
    });
  </script> -->
  <script>
    $(document).ready(function() {
      $('#mensaje_error').hide();
    });
    var cambioDePass = function() {
      var cont = $('#clave').val();
      var cont2 = $('#confi_clave').val();
      if (cont == cont2) {
        $('#mensaje_error').hide();
        $('#mensaje_error').attr("class", "control-label col-md-12 text-success");
        $('#mensaje_error').show();
        $('#mensaje_error').html("Las constraseñas si coinciden");
      } else {
        $('#mensaje_error').attr("class", "control-label col-md-12 text-danger");
        $('#mensaje_error').html("Las constraseñas no coinciden");
        $('#mensaje_error').show();
      }
    }
    $("#clave").on('keyup', cambioDePass);
    $("#confi_clave").on('keyup', cambioDePass);
  </script>
  <script>
    function pagoOnChange(sel) {
      if (sel.value == "DNI") {
        div_mostrar = document.getElementById("mostrar_div");
        div_mostrar.style.display = "block";
        divC = document.getElementById("nCuenta");
        divC.style.display = "block";
        max = document.getElementById("dni");
        max.setAttribute("maxlength", "8");


        divT = document.getElementById("nTargeta");
        divT.style.display = "none";

      } else if (sel.value == "C.E.") {
        div_mostrar = document.getElementById("mostrar_div");
        div_mostrar.style.display = "block";
        divC = document.getElementById("nCuenta");
        divC.style.display = "none";

        divT = document.getElementById("nTargeta");
        divT.style.display = "block";

        max = document.getElementById("dni");
        max.setAttribute("maxlength", "9");
      }
    }
  </script>
</body>

</html>