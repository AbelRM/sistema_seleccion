
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" constent="">
  <meta name="author" content="">

  <title>Sistema de postulación DIRESA - TACNA</title>

  <!-- Custom fonts for this template-->
  <link rel="icon" type="image/png" href="public/img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="public/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-12 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-3">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-flex justify-content-center"  >
                <img src="public/img/postulante_2.png" style="max-width: 100%; margin: auto;" alt="Imagen del postulante">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bienvenido al SISTEMA DE SELECCIÓN!</h1>
                  </div>
                  <div class="mb-4 d-flex justify-content-center">
                    <img src="public/img/logo_diresa.png" alt="Logo de diresa" style="max-width: 100%; height: auto;">
                  </div>
                  
                  <form action="procesos/autenticar_v6.php" method="POST" class="user">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="dni" name="dni" placeholder="Ingrese su DNI..." required pattern="[A-Za-z0-9_-]{1,15}">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="clave" name="clave" placeholder="Contraseña..." required pattern="[A-Za-z0-9_-]{1,15}">
                    </div>
                    <div class="form-group">
                    <?php echo isset($alert) ? $alert : '';?>
                    </div>
                    <div class="form-group row d-flex justify-content-center">
                      <button type="submit" class="btn btn-primary btn-user btn-block">Iniciar sesión</button>
                    </div>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.php">Recupera tu contraseña</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.php">Crear cuenta!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/popper.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="public/js/wizard.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="public/js/sb-admin-2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <!-- <script src="public/js/alerta.js"></script> -->

</body>

</html>
