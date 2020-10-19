//binds to onchange event of your input field
 $(document).ready(function() {
      $('#nivel_estudios_edit > option[value="<?php echo $nivel_estudio ?>"]').attr('selected', 'selected');
      $('#tipo_estudios_edit > option[value="<?php echo $tipo_estudio_edit ?>"]').attr('selected', 'selected');
      $('#colegiatura_edit > option[value="<?php echo $colegiatura_edit ?>"]').attr('selected', 'selected');
    });

$('#expe1_archivo').bind('change', function () {
   var peso = (this.files[0].size);
   if (peso <= 3000000) {
     document.getElementById('peso_archivo_valido').innerHTML = "Archivo válido";
     document.getElementById("peso_archivo_valido").style.display = "block";
     document.getElementById("peso_archivo_no").style.display = "none";
   } else {
     document.getElementById('peso_archivo_no').innerHTML = "El archivo sobre pasa los 3Mb máximos";
     document.getElementById("peso_archivo_valido").style.display = "none";
     document.getElementById("peso_archivo_no").style.display = "block";
     document.getElementById("expe1_archivo").value = '';
   }
 });

  $(function() {
      $("#colegiatura_edit").on('change', function() {
        var selectValue = $(this).val();
        switch (selectValue) {
          case "NO":
            $("#nro_colegiatura_edit").prop('disabled', true);
            $("#fecha_colegiatura_edit").prop('disabled', true);
            $("#lugar_colegiatura_edit").prop('disabled', true);
            break;
          case "SI":
            $("#nro_colegiatura_edit").removeAttr('disabled');
            $("#fecha_colegiatura_edit").removeAttr('disabled');
            $("#lugar_colegiatura_edit").removeAttr('disabled');
            break;
        }
      }).change();
    });