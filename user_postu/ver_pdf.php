<?php
include 'conexion.php';
session_start();
if (empty($_SESSION['active'])) {
  header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ver PDF agregado - DIRESA TACNA</title>
</head>

<body>
  <?php
  include 'conexion.php';
  include 'funcs/mcript.php';
  $dato_desencriptado = $_GET['dni'];
  $dni = $desencriptar($dato_desencriptado);
  $sql = "SELECT * FROM formacion_acad WHERE id_formacion=" . $_GET['id'];
  $query = mysqli_query($con, $sql);
  if ($datos = MySQLI_fetch_array($query)) {
    if ($datos['archivo'] == "") { ?>
      <p>No hay archivos agregados</p>
    <?php } else { ?>
      <iframe src="archivos/<?php echo $dni ?>/formacion/<?php echo $datos['archivo']; ?>" width="800px" height="600px"></iframe>

  <?php }
  } ?>
</body>

</html>