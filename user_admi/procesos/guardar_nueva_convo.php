<?php 

    include '../conexion.php';
    $tipo_con = $_POST['tipo_con'];
    $convocatoria = $_POST['convocatoria'];
    $ubicacion = $_POST['ubicacion'];
    $fech_ini = $_POST['fech_ini'];
    $fech_fin = $_POST['fech_fin'];
    $curricular = $_POST['curricular'];
    $entrevista = $_POST['entrevista'];
    $escrito = $_POST['escrito'];
    $por_discapacidad = $_POST['por_discapacidad'];
    $militar = $_POST['militar'];

    $sql= "INSERT INTO convocatoria (num_con,tipo_con,fech_ini,fech_term,porcen_eva_cu,porce_entrevista,porce_discapacidad,porce_sermilitar,porce_exa_escrito,direccion_ejec_iddireccion) 
    VALUES ('".$convocatoria."','".$tipo_con."','".$fech_ini."','".$fech_fin."','".$curricular."','".$entrevista."','".$por_discapacidad."','".$militar."','".$escrito."','".$ubicacion."')";

    if ($con->query($sql) == TRUE) {
        $idcon=mysqli_insert_id($con);
        // echo $idcon;
        header('Location: ../agregar_personal_req_v2.php?convocatoria_idcon='.$idcon);
    } else {
        //echo "Error: ".$sql. "<br>".$con->error;
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
  <link rel="icon" type="image/png" href="../img/icono_diresa.png" />
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body style="background-color: #65525270">
  <!-- <div class="container "> -->
    <div class="row d-flex justify-content-center m-5">
        <div class="card text-center">
            <div class="card-header">
                
            </div>
            <div class="card-body">
                <h5 class="card-title">ERROR AL CREAR CONVOCATORIA</h5>
                <p class="card-text">Ya existe el número de convocatoria.</p>
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
  <script src="../js/sb-admin-2.min.js"></script>
</body>
</html>
<?php
    }

    $con->close();

?>