<div class="modal fade" id="adenda" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">

            <div class="col-lg-11">
                    <div class="card-header py-3" >
                        <h6 class="m-0 font-weight-bold text-primary">CONVOCATORIA</h6>
                    </div>
            </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            
            </div>
            <div class="modal-body">
                
                <form action="procesos/agregar_adenda.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                
            
        <div class="row">

                <div class="col-lg-12">

                    
                    <div class="card-body">
                        <form action="">
                        <div class="form-group">
                            <h6 class="m-0 font-weight-bold text-danger">Datos de la convocatoria</h6>
                            <hr class="sidebar-divider">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="inputState">Tipo de concurso</label>
                                <input type="text" class="form-control">
                                
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="inputEmail4">N° de convocatoria</label>
                                <input type="text" class="form-control" placeholder="001-2020">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="inputEmail4">Direccion Ejecutiva</label>
                                <input type="text" class="form-control" placeholder="Ubicación">
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="inputEmail4">Desde</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="inputEmail4">Hasta</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <h6 class="m-0 font-weight-bold text-danger">Porcentaje de la convocatoria</h6>
                            <hr class="sidebar-divider">
                        </div>
                        <div class="form-row" id="contenido">
                            <div class="col-md-12">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-6 col-form-label">% DE EVALUACION CURRICULAR:</label>
                                <div class="col-sm-2">
                                <input type="text" class="form-control" id="curricular">
                                </div>
                                <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-6 col-form-label">% DE EVALUACION DE ENTREVISTA:</label>
                                <div class="col-sm-2">
                                <input type="text" class="form-control" id="entrevista">
                                </div>
                                <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-6 col-form-label">% DE EVALUACION DE EXÁMEN ESCRITO:</label>
                                <div class="col-sm-2">
                                <input type="text" class="form-control" id="escrito" >
                                </div>
                                <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-6 col-form-label">% DE EVALUACION POR DISCAPACIDAD:</label>
                                <div class="col-sm-2">
                                <input type="text" class="form-control" id="por_discapacidad" >
                                </div>
                                <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-6 col-form-label">% DE EVALUACIONPOR DISCAPACIDAD:</label>
                                <div class="col-sm-2">
                                <input type="text" class="form-control" id="por_discapacidad" >
                                </div>
                                <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-6 col-form-label">% DE EVALUACION DE LIC. MILITAR:</label>
                                <div class="col-sm-2">
                                <input type="text" class="form-control" id="militar" >
                                </div>
                                <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                            </div>
                            
                            <hr class="sidebar-divider">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-6 col-form-label">TOTAL DEL PORCENTAJE:</label>
                                <div class="col-sm-2">
                                <input type="text" class="form-control" id="total" disabled="true">
                                </div>
                                <label for="staticEmail" class="col-sm-4 col-form-label">%</label>
                            </div>               
                            </div>

                        </div>
                        
                </form>  
                        
                    </div>
                    </div>

                </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                                
                    </form>
            </div>
        </div>
    </div>
</div>