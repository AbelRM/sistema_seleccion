<div class="modal fade" id="perfil">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title">Modificar Datos Personales</h5>
        <button class="close" data-dismiss="modal"><span>×</span></button>
      </div>

      <?php
      $dni = $_GET['dni'];
      $dato_desencriptado = $_GET['dni'];
      // $dni = $desencriptar($dato_desencriptado);

      $sql = "SELECT * FROM usuarios where dni=$dni";
      $datos = mysqli_query($con, $sql) or die(mysqli_error($datos));
      $fila = mysqli_fetch_array($datos);
      ?>
      <div class="modal-body">
        <form action="procesos/modificarperfil.php" method="POST">
          <input type="hidden" name="dato_desencriptado" id="dato_desencriptado" value="<?php echo $dato_desencriptado ?>">
          <input type="hidden" name="iduser" id="iduser" value="<?php echo $fila["iduser"]; ?>">
          <div class="form-group">
            <label for="title">Nombre</label>
            <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $fila["nombres"]; ?>">
          </div>
          <div class="form-group">
            <label for="title">Apellido Paterno</label>
            <input type="text" class="form-control" id="ape_pat" name="ape_pat" value="<?php echo $fila["ape_pat"]; ?>">
          </div>
          <div class="form-group">
            <label for="title">Apellido Materno</label>
            <input type="text" class="form-control" id="ape_mat" name="ape_mat" value="<?php echo $fila["ape_mat"]; ?>">
          </div>
          <div class="form-group">
            <label for="title">DNI</label>
            <input type="text" class="form-control" id="dni" name="dni" value="<?php echo $fila["dni"]; ?>" disabled="true">
          </div>
          <div class="form-group">
            <label for="title">Correo </label>
            <input type="text" class="form-control" id="correo" name="correo" value="<?php echo $fila["correo"]; ?>">
          </div>
          <div class="form-group">
            <label for="title">Celular </label>
            <input type="text" class="form-control" id="celular" name="celular" value="<?php echo $fila["celular"]; ?>">
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="updateData2">Actualizar!</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>