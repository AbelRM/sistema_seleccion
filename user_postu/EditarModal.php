<!-- EDITAR REGISTRO -->
<div class="modal fade" id="edit_<?php echo $row['id_formacion']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Actualizar Formación académica</h5>
            <button class="close" data-dismiss="modal"><span>×</span></button>
          </div>
          <div class="modal-body">
          <?php
            $id_formacion = $row['id_formacion'];
            $consulta_form = "SELECT * FROM formacion_acad 
            inner join tipo_estudios ON formacion_acad.tipo_estudios_id=tipo_estudios.id_tipo_estudios 
            WHERE id_formacion = $id_formacion";
            $query=mysqli_query($con, $consulta_form);
            $row= MySQLI_fetch_array($query)
          ?>
          <form action="procesos/actualizar_formacion.php" autocomplete="off" method="POST">
            <div class="row"> 
              <input type="hidden" name="dni" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="idformacion" value="<?php echo $id_formacion ?>">
              <div class="col-md-6 col-sm-12 form-group">
                <?php $tipo_estudio_edit = $row['tipo_estudios_id'] ?>
                <label for="title">(*) Tipo estudio</label>
                <select class="form-control" name="tipo_estudios_edit" id="tipo_estudios_edit" required>
                  <option value="0" disabled>Seleccione:</option>
                  <?php
                    $query = $con -> query ("SELECT * FROM tipo_estudios");
                    while ($valores = mysqli_fetch_array($query)) {
                      echo '<option value="'.$valores['id_tipo_estudios'].'">'.$valores['tipo_estudios'].'</option>';
                    }
                  ?>
                </select>
              </div>
              <div class="col-md-6 col-sm-12 form-group">
                <?php $nivel_estudio = $row['nivel_estudios'] ?>
                <label for="title">(*) Nivel estudios</label>
                <select name="nivel_estudios_edit" id="nivel_estudios_edit" class="form-control">
                  <option value="ESTUDIANTE">Estudiante</option>
                  <option value="EGRESADO">Egresado</option>
                  <option value="BACHILLER">Bachiller</option>
                  <option value="TITULADO">Titulado</option>
                </select>
              </div>
              <div class="col-md-12 col-sm-12 form-group">
                <label for="title">(*) Centro estudios</label>
                <input type="text" name="centro_estudios" class="form-control" value="<?php echo $row['centro_estudios'] ?>" required>
              </div>
              <div class="col-md-12 col-sm-12 form-group">
                <label for="title">(*) Carrera</label>
                <input type="text" name="carrera" class="form-control" value="<?php echo $row['carrera'] ?>" required>
              </div>
              <div class="col-md-6 col-sm-12 form-group">
                <?php $colegiatura_edit = $row['colegiatura'] ?>
                <label for="title">(*) Colegiatura</label>
                <select name="colegiatura_edit" id="colegiatura_edit" class="form-control">
                  <option value="NO">NO</option>
                  <option value="SI">SI</option>
                </select>
              </div>
              <div class="col-md-6 col-sm-12 form-group">
                <label for="title">(*) N° Colegiatura</label>
                <input type="text" name="nro_colegiatura_edit" id="nro_colegiatura_edit"  class="form-control" value="<?php 
                if(is_null($row['nro_colegiatura'])){echo "-";}else{echo $row['nro_colegiatura'];}?>" disabled>
              </div>
              <div class="col-md-6 col-sm-12 form-group">
                <label for="title">(*) Fecha última habilitación</label>
                <input type="date" name="fecha_colegiatura_edit" id="fecha_colegiatura_edit" class="form-control" value="<?php 
                if(is_null($row['fech_habilitacion'])){echo "yyyy-MM-dd";}else{echo $row['fech_habilitacion'];}?>" disabled>
              </div>
              <div class="col-md-6 col-sm-12 form-group">
                <label for="title">(*) Lugar Colegiatura</label>
                <input type="text" name="lugar_colegiatura_edit" id="lugar_colegiatura_edit" class="form-control" value="<?php 
                if(is_null($row['lugar_colegiatura'])){echo "-";}else{echo $row['lugar_colegiatura'];}?>" disabled>
              </div>
              <div class="col-md-6 col-sm-12 form-group">
                <label for="title">(**) Fecha Inicio</label>
                <input type="date" name="fecha_inicio" class="form-control" value="<?php echo $row['fecha_inicio'] ?>" required>
              </div>
              <div class="col-md-6 col-sm-12 form-group">
                <label for="title">(**) Fecha Término</label>
                <input type="date" name="fecha_fin" class="form-control" value="<?php echo $row['fecha_fin'] ?>" required>
              </div>
            </div>
            <div class="form-group">
              <p>(*) Indica un campo obligatorio.</p>
              <p>(**) En el campo "FECHA" debe indicar la fecha de obtención del "NIVEL DE ESTUDIOS" que está registrando. 
              En el caso de estudiante, debe indicar la fecha del ciclo culminado que está registrando.</p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" name="editar" class="btn btn-success">Actualizar!</a>
          </div>
          </form>
      </div>
  </div>
</div>