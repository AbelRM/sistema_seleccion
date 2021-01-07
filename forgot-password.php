<?php
require 'conexion.php';
require 'funcs/funcs.php';

$errors = array();
if (!empty($_POST)) {
  $email = $mysqli->real_escape_string($_POST['email']);
  if (!isEmail($email)) {
    $errors[] = "Debe ingresar un correo válido registrado";
    if (emailExiste($email)) {
      $consul = mysqli_query($con, "SELECT * FROM user WHERE correo = '$email'");
      $rw = mysqli_fetch_array($consul);
      $id_user = $rw['iduser'];
      $nombres = $rw['nombres'];
      $token = $rw['token'];
      $update = mysqli_query($con, "UPDATE user SET token_password = '$token', recuperar_contra=1 WHERE iduser = '$id_user'");
      if ($update) {
        $url = 'http://' . $_SERVER["SERVER_NAME"] . 'cambiar_pass.php?iduser=' . $id_user . '&token=' . $token;

        $asunto = 'Recuperar contraseña - Sistema selección DIRESA TACNA';
        $cuerpo = 'Hola $nombres: <br><br>Se ha solicitado un reinicio de contraseña para su cuenta personal en el Sistema de selección DIRESA TACNA.<br><br>Para restaurar la contraseña da clic al siguiente enlace: <a href="$url">Ingresar al link</a>';
        if (enviarEmail($email, $nombres, $asunto, $cuerpo)) {
          echo "Se envio correctamente, verifique en la bandeja de entrada de su correo electronico<br>";
          echo "<a href='index.php'>Iniciar sesión</a>";
        } else {
          $errors[] = "No se envio el correo electronico.";
        }
      } else {
        $errors[] = "No se pudo actualizar los datos del usuario";
      }
    } else {
      $errors[] = "El correo no existe";
    }
  }
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

  <title>Recuperar contraseña - Sistema selección DIRESA</title>

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

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-flex justify-content-center">
                <img src="public/img/email.png" style="max-width: 100%; margin: auto;" alt="Imagen de recuperar contraseña">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">¿Olvidaste tu contraseña?</h1>
                    <p class="mb-4">Para recuperar tu contraseña introduce tu correo electrónico registrado al crear tu cuenta en el Sistema de selección DIRESA TACNA.</p>
                  </div>
                  <form class="user" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="email" aria-describedby="emailHelp" placeholder="Ingresa tu correo registrado...">
                    </div>
                    <button class="btn btn-primary btn-user btn-block" type="submit">
                      Restaurar
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a href="register.php">Crear una cuenta!</a>
                  </div>
                  <div class="text-center">
                    <a href="index.php">Si ya cuentas con una cuenta? Conéctate!</a>
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
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="public/js/sb-admin-2.min.js"></script>

</body>

</html>