<?php
    require '../conexion.php';
	
    $nombres = $_POST['nombres'];
    $ape_pat = $_POST['ape_pat'];
    $ape_mat = $_POST['ape_mat'];
    $dni = $_POST['dni'];
    $correo = $_POST['correo'];
    $celular = $_POST['celular'];
	$clave = $_POST['clave'];
	$confi_clave = $_POST['confi_clave'];

	$sql= "INSERT INTO user (dni,nombres,ape_pat,ape_mat,celular,correo,clave,confi_clave,tipo_user_idtipo) 
    VALUES ('".$dni."','".$nombres."','".$ape_pat."','".$ape_mat."','".$celular."','".$correo."','".$clave."','".$confi_clave."','1')";

    if ($con->query($sql) == TRUE) {
        $iduser=mysqli_insert_id($con);
        // echo $idcon;
        header('Location: ../index.php');
    } else {
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
  <link rel="icon" type="image/png" href="../public/img/icono_diresa.png" />
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../public/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body style="background-color: #65525270">
  <!-- <div class="container "> -->
    <div class="row d-flex justify-content-center m-5">
        <div class="card text-center">
            <div class="card-header">
                
            </div>
            <div class="card-body">
                <h5 class="card-title">ERROR AL CREAR USUARIO</h5>
                <p class="card-text">Ya existe el usuario registrado con el mismo DNI.</p>
                <a href="../register.php" class="btn btn-danger">Regresar</a>
            </div>
            <div class="card-footer text-muted">
                
            </div>
        </div>
    </div>
  <!-- </div> -->

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../public/js/sb-admin-2.min.js"></script>
</body>

</html>
<?php
        //echo "Error: ".$sql. "<br>".$con->error;
        //echo "Error";
    }
    $con->close();
	
?>