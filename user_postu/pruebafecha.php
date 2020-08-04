<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Listado</title>

  <!-- Custom fonts for this template -->
  <link rel="icon" type="image/png" href="img/icono_diresa.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

<div class="card-body"> 

        <form method="POST" action="">
        <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
            <div class="form-group">
                <label for="fecha">Fecha inicial:</label>
                <input required type="date" class="form-control" name="fecha1" placeholder="Ingrese fecha inicial" id="moda1" value="<?php if(isset($_POST["fecha1"])){ echo $_POST["fecha1"];}?>">
            </div>
            </div>
            
            <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
            <div class="form-group">
                <label for="fecha">Fecha actual:</label>
                <input required type="date" class="form-control" name="fecha2" placeholder="Ingrese fecha actual" id="moda2" value="<?php if(isset($_POST["fecha2"])){ echo $_POST["fecha2"];}?>">
            </div>
            </div>
                <input name="calculo" type="hidden" value="v">	
            <input class="btn btn-primary" type="submit" value="Calcular">
        </form>   



            <?php
            if(isset($_POST["calculo"])){
                
            $fecha1=$_POST["fecha1"];
            $fecha2=$_POST["fecha2"];

            $fechainicial = new DateTime($fecha1);
            //fecha inicial 
            $fechaactual = new DateTime($fecha2);
            //fecha de cierre 
            $diferencia = $fechainicial->diff($fechaactual); 

        ?>

      
          <div class="form-row">
                    <div class="form-group col-md-3 col-sm-12">
                      <label for="disabled-input">Años</label>           
                      <input type="text" class="form-control"   value="<?php echo $diferencia->format('%Y Años'); ?>" disabled="true">                                          
                    </div>

         </div>

         <div class="form-row">
                    <div class="form-group col-md-3 col-sm-12">
                      <label for="disabled-input">Meses</label>           
                      <input type="text" class="form-control"  value="<?php echo $diferencia->format('%m Meses'); ?>" disabled="true">                                          
                    </div>

         </div>

         <div class="form-row">
                    <div class="form-group col-md-3 col-sm-12">
                      <label for="disabled-input">Dias</label>           
                      <input type="text" class="form-control"   value="<?php echo $diferencia->format('%d Dias');?>" disabled="true">                                          
                    </div>

         </div>

    

        <?php
        }
        ?>
        </div>


<link type="text/css" href="css/jquery-ui-1.8.13.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript">
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
 dayNamesShort: ['Dom','Lun','Mar','Mi?','Juv','Vie','Sab'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
 weekHeader: 'Sm',
 dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '-100:+2',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
	$(function(){
		$('#moda1').datetimepicker({
			showSecond: true,
			timeFormat: 'hh:mm:ss'
		});

		$('#moda2').datetimepicker({
			showSecond: true,
			timeFormat: 'hh:mm:ss',
			stepHour: 2,
			stepMinute: 10,
			stepSecond: 10
		});
	});

</script>

</body>

</html>