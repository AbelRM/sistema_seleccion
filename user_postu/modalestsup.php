    <!--AGREGAR ESTUDIOS POSTGRADO-->
    <div class="modal fade" id="estudiospostgrado">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Estudios Postgrado (Maestrias - Doctorados)</h5> 
          <button class="close" data-dismiss="modal">
            <span>×</span>
          </button>
        </div>
                <?php     
                    $dato_desencriptado = $_GET['dni'];
                    $dni = $desencriptar($dato_desencriptado);
                    
                    $sql="SELECT * FROM usuarios where dni=$dni";
                    $datos=mysqli_query($con,$sql) or die(mysqli_error()); 
                    $fila= mysqli_fetch_array($datos);  
                    
                    $consulta="SELECT * FROM postulante where dni=$dni";
                    $datos1=mysqli_query($con,$consulta) or die(mysqli_error()); ;
                    $row1= mysqli_fetch_array($datos1);
                    $idpostulante=$row1['idpostulante'];
                ?>
        <div class="modal-body">
          <form action="procesos/guardar_postgrado.php" enctype="multipart/form-data" autocomplete="off" method="POST">
            <div class="row"> 
              <input type="hidden" name="dni_encriptado" value="<?php echo $dato_desencriptado ?>">
              <input type="hidden" name="dni" value="<?php echo $dni ?>">
              <input type="hidden" name="postulante" value="<?php echo $idpostulante ?>">

              <div class="col-md-12 col-sm-12 form-group" id="div_centro_estudios">
                <label for="title">(*) Centro estudios</label>
                <input type="text" id="centro_estudios" name="centro_estudios" class="form-control" placeholder="Nombre centro estudios" maxlength="100"
                required>
              </div>
              <div class="col-md-12 col-sm-12 form-group" id="div_centro_estudios">
                <label for="title">(*) Especialidad</label>
                <input type="text" id="especialidad" name="especialidad" class="form-control" placeholder="Especialidad" maxlength="100"
                required>
              </div>
              <div class="col-md-12 col-sm-12 form-group" id="div_nivel_estudio">
                <label for="title">(*) Tipo estudios</label>
                <select name="tipo" id="tipo" class="form-control">
                        <option value="MAESTRIA">Maestria</option>
                        <option value="DOCTORADO">Doctorado</option>
                </select>
              </div>

              <div class="col-md-6 col-sm-12 form-group" id="div_fecha_inicio">
                <label for="title">(**) Fecha Inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
              </div>
              <div class="col-md-6 col-sm-12 form-group" id="div_fecha_fin">
                <label for="title">(**) Fecha Término</label>
                <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" required>
              </div>

              <div class="col-md-12 col-sm-12 form-group" id="div_nivel_estudio">
                <label for="title">(*) Nivel estudios</label>
                <select name="nivel_estudios" id="nivel_estudios" class="form-control">
                        <option value="MAGISTER">Magister</option>
                        <option value="DOCTORADO">Doctorado</option>
                        <option value="EGRESADO">Egresado</option>
                        <option value="ESTUDIANTE">Estudiante</option>
                </select>
              </div>

              <div class="col-md-12 col-sm-12 form-group" id="archivo">
                <div class="row">
                  <label for="title">(*) Elegir Archivo</label>
                </div>
                <div class="row">
                  <div class="col-4 pf-0">
                    <label for="file-upload" class="subir">
                      <i class="fas fa-cloud-upload-alt"></i> Elegir
                    </label>
                    <input id="file-upload" onchange='cambiar()' name="archivo" type="file" style='display: none;'/>
                  </div>
                  <div class="col-8 p-0">
                    <div id="info" class="font-weight-bold"></div>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="form-group">
              <p>(*) Indica un campo obligatorio.</p>
              <p>(**) En el campo "FECHA" debe indicar la fecha de obtención del "NIVEL DE ESTUDIOS" que está registrando. 
              En el caso de estudiante, debe indicar la fecha del ciclo culminado que está registrando.</p>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="insertData">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>