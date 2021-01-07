 $(document).ready(function() {
    $('#tipo_nivel_estudio > option[value="<?php echo $nivel_estudio ?>"]').attr('selected', 'selected');
    $('#ciclo_actual > option[value="<?php echo $ciclo_actual ?>"]').attr('selected', 'selected');
    $('#orden_merito > option[value="<?php echo $orden_merito ?>"]').attr('selected', 'selected');
 });

 $(function() {
  $("#tipo_nivel_estudio").on('change', function() {
    var selectValue = $(this).val();
    switch (selectValue) {
      case "ESTUDIANTE":
        $("#div_ciclo_actual").show();
        break;
      case "EGRESADO":
        $("#div_ciclo_actual").hide();
        break;
    }
  }).change();
});

//binds to onchange event of your input field
$('#file-upload').bind('change', function() {
  //this.files[0].size gets the size of your file.
  var peso = (this.files[0].size);
  if (peso <= 3000000) {
    document.getElementById('peso_archivo_valido').innerHTML = "Archivo válido";
    document.getElementById("peso_archivo_valido").style.display = "block";
    document.getElementById("peso_archivo_no").style.display = "none";
  } else {
    document.getElementById('peso_archivo_no').innerHTML = "El archivo sobre pasa los 3Mb máximos";
    document.getElementById("peso_archivo_valido").style.display = "none";
    document.getElementById("peso_archivo_no").style.display = "block";
    document.getElementById("info").value = '';
    document.getElementById("file-upload").value = '';

  }
  // alert(this.files[0].size);
});
$('#merito_archivo').bind('change', function() {
  var peso = (this.files[0].size);
  if (peso <= 3000000) {
    document.getElementById('peso_archivo_valido_2').innerHTML = "Archivo válido";
    document.getElementById("peso_archivo_valido_2").style.display = "block";
    document.getElementById("peso_archivo_no_2").style.display = "none";
  } else {
    document.getElementById('peso_archivo_no_2').innerHTML = "El archivo sobre pasa los 3Mb máximos";
    document.getElementById("peso_archivo_valido_2").style.display = "none";
    document.getElementById("peso_archivo_no_2").style.display = "block";
    document.getElementById("expe1_archivo_2").value = '';
    document.getElementById("merito_archivo").value = '';
  }
});