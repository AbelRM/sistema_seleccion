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
              
              <form action="procesos/guardar_user.php" method="POST" class="user">
                <div class="form-group row">
                  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                    <label for="exampleInputEmail1">Nombres</label>
                    <input type="text" style="padding: inherit;" class="form-control form-control-user" id="nombres" name="nombres" >
                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                  </div>
                  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                    <label for="exampleInputEmail1">Apellido paterno</label>
                    <input type="text" style="padding: inherit;" class="form-control form-control-user" id="ape_pat" name="ape_pat" >
                  </div>
                  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                    <label for="exampleInputEmail1">Apellido materno</label>
                    <input type="text" style="padding: inherit;" class="form-control form-control-user" id="ape_mat" name="ape_mat">
                  </div>
                  <div class="col-md-2 col-sm-6 mb-2 mb-sm-0">
                    <label for="exampleInputEmail1">DNI</label>
                    <input type="text" style="padding: inherit;" maxlength="8"  class="form-control form-control-user" id="dni" name="dni">
                  </div>
                  <div class="col-md-5 col-sm-6 mb-2 mb-sm-0">
                    <label for="exampleInputEmail1">Correo electronico</label>
                    <input type="email" style="padding: inherit;" class="form-control form-control-user" id="correo" name="correo">
                  </div>
                  <div class="col-md-5 col-sm-6 mb-2 mb-sm-0">
                    <label for="exampleInputEmail1">Nro. Celular</label>
                    <input type="text" style="padding: inherit;" class="form-control form-control-user" id="celular" name="celular" maxlength="9">
                  </div>
                  <div class="col-md-6 col-sm-6 mb-2 mb-sm-0">
                    <label for="exampleInputEmail1">Contraseña</label>
                    <input type="password" style="padding: inherit;" class="form-control form-control-user" id="clave" name="clave" required="true"><span class="help-block"></span>
                  </div>
                  <div class="col-md-6 col-sm-6 mb-2 mb-sm-0">
                    <label for="exampleInputEmail1">Confirmar ontraseña</label>
                    <input type="password" style="padding: inherit;" class="form-control form-control-user" id="confi_clave" name="confi_clave" required="true"><span class="help-block"></span>
                    <label id="mensaje_error" class="control-label col-md-12 text-danger" style="display: block;">Las constraseñas si coinciden</label>
                  </div>
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
  <script src="public/js/sb-admin-2.min.js"></script>
  <script>
    $(document).ready(function () {
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
</body>

</html>
