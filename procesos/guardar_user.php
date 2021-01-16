<?php
require '../conexion.php';
require '../funcs/funcs.php';

// define("RECAPTCHA_V3_SECRET_KEY", '6LeVwMQZAAAAAHefDg1_0gUgPLg08Oto7rYLKSaF');

$nombres = $con->real_escape_string(strtoupper($_POST['nombres']));
$ape_pat = $con->real_escape_string(strtoupper($_POST['ape_pat']));
$ape_mat = $con->real_escape_string(strtoupper($_POST['ape_mat']));
$dni = $con->real_escape_string($_POST['dni']);
$correo = $con->real_escape_string($_POST['correo']);
$celular = $con->real_escape_string($_POST['celular']);
$clave = $con->real_escape_string($_POST['clave']);
$confi_clave = $con->real_escape_string($_POST['confi_clave']);
$tipo_documento = $con->real_escape_string($_POST['tipo_documento']);
$recuperar_contra = 0;

if (isNull($nombres, $ape_pat, $ape_mat, $correo, $celular, $clave, $confi_clave, $tipo_documento)) {
  $errors[] = "Debe llenar todos los campos";
}
if (!isEmail($correo)) {
  $errors[] = "Dirección de correo inválida";
}

if ($clave != $confi_clave) {
  echo '<script>
          alert("La CONTRASEÑA ingresada no es igual a CONFIRMAR CONTRASEÑA, intente de nuevo.");
          window.location = "../register.php";
        </script>';
}

// $pass_hash=hashPassword($clave);
date_default_timezone_set('America/Lima');
$creacion_user = date('Y-m-d H:i:s');
$token = generateToken();


$token_2 = $_POST['token_2'];
$action = $_POST['action'];


$sql = "INSERT INTO user (dni,nombres,ape_pat,ape_mat,celular,correo,clave,confi_clave,token,recuperar_contra,creacion_user,tipo_dni,ultima_sesion,tipo_user_idtipo) 
        VALUES ('" . $dni . "','" . $nombres . "','" . $ape_pat . "','" . $ape_mat . "','" . $celular . "','" . $correo . "',MD5('" . $clave . "'),MD5('" . $confi_clave . "'),
        '" . $token . "','" . $recuperar_contra . "','" . $creacion_user . "','" . $tipo_documento . "','" . $creacion_user . "','1')";
$verificar_dni = mysqli_query($con, "SELECT * FROM user WHERE dni='$dni' AND correo='$correo' ");
if (mysqli_num_rows($verificar_dni) > 0) {
  echo '<script>
          alert("El usuario con el DNI o correo ya existe, intente de nuevo.");
          window.location = "../register.php";
        </script>';
  $con->close();
} else {
  if ($con->query($sql) == TRUE) {
    $iduser = mysqli_insert_id($con);
    $sql2 = "INSERT INTO postulante (dni,nombres,ape_pat,ape_mat,celular,correo,tipo_documento) 
                VALUES ('" . $dni . "','" . $nombres . "','" . $ape_pat . "','" . $ape_mat . "','" . $celular . "','" . $correo . "','" . $tipo_documento . "')";
    if ($con->query($sql2) == TRUE) {
      header('Location: ../index.php');
    } else {
      $con->close();
      echo '<script>
              alert("Error al ingresar los datos, intente de nuevo.");
              window.location = "../register.php";
            </script>';
    }
  }
}
