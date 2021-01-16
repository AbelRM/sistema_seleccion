<?php
session_start();
include "funcs/mcript.php";
$mensaje = '';

if (!empty($_SESSION['active'])) {
  $dni = $_POST['dni'];
  header("Location: user_postu/index.php?dni=$dni");
} else {
  if (empty($_POST['dni']) || empty($_POST['clave'])) {
    $mensaje = 'Ingrese su usuario y su contraseña!';
  } else {
    require_once "conexion.php";

    $dni = mysqli_real_escape_string($con, $_POST['dni']);
    $clave = md5(mysqli_real_escape_string($con, $_POST['clave']));

    date_default_timezone_set('America/Lima');
    $ultima_sesion = date('Y-m-d H:i:s', time());

    // $captcha = $_POST['g-recaptcha-response'];
    // $secret = '6LcAvMQZAAAAAGu1OUSSvdIyp5Y-Gd-AgzvJbb1e';

    $query = mysqli_query($con, "SELECT * FROM usuarios WHERE dni='$dni' AND clave='$clave'");
    $result = mysqli_num_rows($query);
    if ($result > 0) {
      $data = mysqli_fetch_array($query);

      $query2 = mysqli_query($con, "SELECT * FROM usuarios WHERE dni='$dni' AND tipo_user='ESTUDIANTE' ");
      $resultado = mysqli_num_rows($query2);

      $actualizar = "UPDATE user SET ultima_sesion = '$ultima_sesion' WHERE dni = '$dni' ";
      $act_query = mysqli_query($con, $actualizar);

      if ($resultado > 0) {
        $prueba = "SELECT * FROM postulante where dni=$dni";
        $datos = mysqli_query($con, $prueba);
        $fila = mysqli_fetch_array($datos);
        $idpostulante = $fila['idpostulante'];

        $resultado = $con->query("SELECT EXISTS (SELECT * FROM familia_post WHERE postulante_idpostulante=$idpostulante);");
        $row = mysqli_fetch_row($resultado);

        if ($row[0] == "1") {
          $idpostulante = $fila['idpostulante'];
          $_SESSION['active'] = true;
          $_SESSION['idUser'] = $data['iduser'];
          $_SESSION['dni'] = $data['dni'];
          $_SESSION['correo'] = $data['correo'];
          $_SESSION['rol'] = $data['tipo_user'];

          // Como usar las funciones para encriptar y desencriptar.
          //$dato = "Esta es información importante";

          //Encripta información:
          $encriptado = SED::encryption($dni);

          //Desencripta información:
          //$dato_desencriptado = $desencriptar($dato_encriptado);


          header("Location: user_postu/index.php?dni=$encriptado");
        } else {
          $encriptado = SED::encryption($dni);
          header("Location: user_postu/ficha_wizard.php?dni=$encriptado");
        }
      } else {
        $encriptado = SED::encryption($dni);

        $query3 = mysqli_query($con, "SELECT * FROM usuarios WHERE dni='$dni' AND tipo_user='ADMINISTRADOR' ");
        $resultado2 = mysqli_num_rows($query3);
        if ($resultado2 > 0) {
          $data2 = mysqli_fetch_array($query3);
          $_SESSION['active'] = true;
          $_SESSION['idUser'] = $data2['iduser'];
          $_SESSION['dni'] = $data2['dni'];
          $_SESSION['correo'] = $data2['correo'];
          $_SESSION['rol'] = $data2['tipo_user'];
          header("Location: user_admi/index.php?dni=$dni");
        } else {
          $query4 = mysqli_query($con, "SELECT * FROM usuarios WHERE dni='$dni' AND tipo_user='COMISION' ");
          $resultado4 = mysqli_num_rows($query4);
          if ($resultado4 > 0) {
            $data3 = mysqli_fetch_array($query4);
            $_SESSION['active'] = true;
            $_SESSION['idUser'] = $data3['iduser'];
            $_SESSION['dni'] = $data3['dni'];
            $_SESSION['correo'] = $data3['correo'];
            $_SESSION['rol'] = $data3['tipo_user'];

            header("Location: user_comi/index.php?dni=$dni");
          } else {
            echo "error de usuario";
          }
        }
      }
    } else {
      session_destroy();
      $mensaje = 'Usuario y/o contraseña incorrecta';
    }
    // if (!$captcha) {

    //   $mensaje = 'Conexión inestable, por favor verifica el captcha';
    // } else {
    //   $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");

    //   $arr = json_decode($response, TRUE);

    //   if ($arr['success']) {
    //     if ($result > 0) {
    //       $data = mysqli_fetch_array($query);

    //       $query2 = mysqli_query($con, "SELECT * FROM usuarios WHERE dni='$dni' AND tipo_user='ESTUDIANTE' ");
    //       $resultado = mysqli_num_rows($query2);

    //       $actualizar = "UPDATE user SET ultima_sesion = '$ultima_sesion' WHERE dni = '$dni' ";
    //       $act_query = mysqli_query($con, $actualizar);

    //       if ($resultado > 0) {
    //         $prueba = "SELECT * FROM postulante where dni=$dni";
    //         $datos = mysqli_query($con, $prueba);
    //         $fila = mysqli_fetch_array($datos);
    //         $idpostulante = $fila['idpostulante'];

    //         $resultado = $con->query("SELECT EXISTS (SELECT * FROM familia_post WHERE postulante_idpostulante=$idpostulante);");
    //         $row = mysqli_fetch_row($resultado);

    //         if ($row[0] == "1") {
    //           $idpostulante = $fila['idpostulante'];
    //           $_SESSION['active'] = true;
    //           $_SESSION['idUser'] = $data['iduser'];
    //           $_SESSION['dni'] = $data['dni'];
    //           $_SESSION['correo'] = $data['correo'];
    //           $_SESSION['rol'] = $data['tipo_user'];

    //           // Como usar las funciones para encriptar y desencriptar.
    //           //$dato = "Esta es información importante";

    //           //Encripta información:
    //           // $dato_encriptado = $encriptar($dni);

    //           //Desencripta información:
    //           //$dato_desencriptado = $desencriptar($dato_encriptado);


    //           header("Location: user_postu/index.php?dni=$dni");
    //         } else {
    //           // $dato_encriptado = $encriptar($dni);
    //           header("Location: user_postu/ficha_wizard.php?dni=$dni");
    //         }
    //       } else {
    //         // $dato_encriptado = $encriptar($dni);

    //         $query3 = mysqli_query($con, "SELECT * FROM usuarios WHERE dni='$dni' AND tipo_user='ADMINISTRADOR' ");
    //         $resultado2 = mysqli_num_rows($query3);
    //         if ($resultado2 > 0)
    //           $data2 = mysqli_fetch_array($query);
    //         $_SESSION['active'] = true;
    //         $_SESSION['idUser'] = $data2['iduser'];
    //         $_SESSION['dni'] = $data2['dni'];
    //         $_SESSION['correo'] = $data2['correo'];
    //         $_SESSION['rol'] = $data2['tipo_user'];
    //         header("Location: user_admi/index.php?dni=$dni");
    //       }
    //     } else {
    //       session_destroy();
    //       $mensaje = 'Usuario y/o contraseña incorrecta';
    //     }
    //   } else {
    //     $mensaje = 'Error al comprobar Captcha';
    //   }
    // }
  }
}
?>

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
  <link rel="stylesheet" href="public/plugins/sweetAlert/dist/sweetalert2.css">
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
              <div class="col-lg-6 d-none d-lg-flex justify-content-center">
                <img src="public/img/postulante_2.png" style="max-width: 100%; margin: auto;" alt="Imagen del postulante">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="mb-4 d-flex justify-content-center">
                    <img src="public/img/diresa.png" alt="Logo de diresa" style="max-width: 70%; height: auto;">
                  </div>
                  <div class="form-group text-danger font-weight-bold text-center">
                    <?php if (!empty($mensaje)) : ?>
                      <p><?= $mensaje ?></p>
                    <?php endif; ?>
                  </div>
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="user">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="dni" name="dni" placeholder="Ingrese su DNI..." maxlength="9" required pattern="[A-Za-z0-9_-]{1,15}">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="clave" name="clave" placeholder="Contraseña..." required pattern="[A-Za-z0-9_-]{1,15}">
                    </div>
                    <div class="form-group d-flex justify-content-center">
                      <!--<div class="g-recaptcha" data-sitekey="6LcAvMQZAAAAABpMCKbjwzzFlH4IK5OCjePzxkh7"></div>-->
                      <?php //echo isset($alert) ? $alert : '';
                      ?>
                    </div>
                    <div class="form-group d-flex justify-content-center">
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
  <script src="public/js/alerta.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script src="public/plugins/sweetAlert/dist/sweetalert2.js"></script>

</body>

</html>