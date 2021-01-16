//AGREGAR POSTGRADO
div_registro_especialidad = document.getElementById("div_registro_especialidad");
div_registro_especialidad.style.display = "none";
 $('#expe2_archivo').bind('change', function () {
   var peso = (this.files[0].size);
   if (peso <= 3000000) {
     document.getElementById('peso_archivo_valido').innerHTML = "Archivo válido";
     document.getElementById("peso_archivo_valido").style.display = "block";
     document.getElementById("peso_archivo_no").style.display = "none";
   } else {
     document.getElementById('peso_archivo_no').innerHTML = "El archivo sobre pasa los 3Mb máximos";
     document.getElementById("peso_archivo_valido").style.display = "none";
     document.getElementById("peso_archivo_no").style.display = "block";
     document.getElementById("expe2_archivo").value = '';
   }
 });
 

 function tipo_estudios(sel) {
  if (sel.value == "MAESTRIA") {
    div_registro_especialidad = document.getElementById("div_registro_especialidad");
    div_registro_especialidad.style.display = "none";
  } else if (sel.value == "DOCTORADO") {
    div_registro_especialidad = document.getElementById("div_registro_especialidad");
    div_registro_especialidad.style.display = "none";
  } else if (sel.value == "ESPECIALIDAD") {
    div_registro_especialidad = document.getElementById("div_registro_especialidad");
    div_registro_especialidad.style.display = "block";
  } 
}

 //AGREGAR CURSOS - DIPLOMADOS
 $('#expe4_archivo').bind('change', function () {
   var peso = (this.files[0].size);
   if (peso <= 3000000) {
     document.getElementById('peso_archivo_valido2').innerHTML = "Archivo válido";
     document.getElementById("peso_archivo_valido2").style.display = "block";
     document.getElementById("peso_archivo_no2").style.display = "none";
   } else {
     document.getElementById('peso_archivo_no2').innerHTML = "El archivo sobre pasa los 3Mb máximos";
     document.getElementById("peso_archivo_valido2").style.display = "none";
     document.getElementById("peso_archivo_no2").style.display = "block";
     document.getElementById("expe4_archivo").value = '';
   }
 });

 //AGREGAR COMPUTACION
 $('#expe3_archivo').bind('change', function () {
   var peso = (this.files[0].size);
   if (peso <= 3000000) {
     document.getElementById('peso_archivo_valido3').innerHTML = "Archivo válido";
     document.getElementById("peso_archivo_valido3").style.display = "block";
     document.getElementById("peso_archivo_no4").style.display = "none";
   } else {
     document.getElementById('peso_archivo_no3').innerHTML = "El archivo sobre pasa los 3Mb máximos";
     document.getElementById("peso_archivo_valido3").style.display = "none";
     document.getElementById("peso_archivo_no3").style.display = "block";
     document.getElementById("expe3_archivo").value = '';
   }
 });

 //ACTUALIZAR POSTGRADO
 $('#archivos2').bind('change', function () {
   var peso = (this.files[0].size);
   if (peso <= 3000000) {
     document.getElementById('peso_archivo_valido4').innerHTML = "Archivo válido";
     document.getElementById("peso_archivo_valido4").style.display = "block";
     document.getElementById("peso_archivo_no4").style.display = "none";
   } else {
     document.getElementById('peso_archivo_no4').innerHTML = "El archivo sobre pasa los 3Mb máximos";
     document.getElementById("peso_archivo_valido4").style.display = "none";
     document.getElementById("peso_archivo_no4").style.display = "block";
     document.getElementById("archivos2").value = '';
   }
 });

//ACTUALIZAR DIPLOMADOS - CURSOS
 $('#archivos3').bind('change', function () {
   var peso = (this.files[0].size);
   if (peso <= 3000000) {
     document.getElementById('peso_archivo_valido5').innerHTML = "Archivo válido";
     document.getElementById("peso_archivo_valido5").style.display = "block";
     document.getElementById("peso_archivo_no5").style.display = "none";
   } else {
     document.getElementById('peso_archivo_no5').innerHTML = "El archivo sobre pasa los 3Mb máximos";
     document.getElementById("peso_archivo_valido5").style.display = "none";
     document.getElementById("peso_archivo_no5").style.display = "block";
     document.getElementById("archivos3").value = '';
   }
 });

 //ACTUALIZAR COMPUTACION
 $('#archivos4').bind('change', function () {
   var peso = (this.files[0].size);
   if (peso <= 3000000) {
     document.getElementById('peso_archivo_valido6').innerHTML = "Archivo válido";
     document.getElementById("peso_archivo_valido6").style.display = "block";
     document.getElementById("peso_archivo_no6").style.display = "none";
   } else {
     document.getElementById('peso_archivo_no6').innerHTML = "El archivo sobre pasa los 3Mb máximos";
     document.getElementById("peso_archivo_valido6").style.display = "none";
     document.getElementById("peso_archivo_no6").style.display = "block";
     document.getElementById("archivos4").value = '';
   }
 });



 $(document).ready(function() {
  $('.updateBtn').on('click', function() {

    $('#updateModal').modal('show');

    // Get the table row data.
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
      return $(this).text();
    }).get();

    console.log(data);
    $('#num').val(data[0]);
    $('#idestudios').val(data[1]);
    $('#centro_estu').val(data[2]);
    $('#especialida').val(data[3]);
    $('#fecha_i').val(data[4]);
    $('#fecha_f').val(data[5]);
    $('#nivel_estu').val(data[6]);
    $('#archivos1').val(data[7]);
  });
});

  $(document).ready(function() {
    $('.deleteBtn').on('click', function() {

      $('#deleteModal').modal('show');
      // Get the table row data.
      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#num').val(data[0]);
      $('#id').val(data[1]);
    });
  });

  $(document).ready(function() {
    $('.updateBtn1').on('click', function() {

      $('#actualizarpostgrado').modal('show');

      // Get the table row data.
      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#num').val(data[0]);
      $('#idmaestria_doc').val(data[1]);
      $('#centro_estudi').val(data[2]);
      $('#especialidades').val(data[3]);
      $('#tipo_estu').val(data[4]);
      $('#fecha_inic').val(data[5]);
      $('#fecha_fi').val(data[6]);
      $('#nivel1').val(data[7]);
      $('#archivos2').val(data[8]);

    });
  });

  $(document).ready(function() {
    $('.deleteBtn1').on('click', function() {

      $('#eliminarpostgrado').modal('show');
      // Get the table row data.
      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#num').val(data[0]);
      $('#id1').val(data[1]);
    });
  });

  $(document).ready(function() {
    $('.updateBtn2').on('click', function() {

      $('#actualizardiplomados').modal('show');

      // Get the table row data.
      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#num').val(data[0]);
      $('#idcursos_extra').val(data[1]);
      $('#centro_estud').val(data[2]);
      $('#materia1').val(data[3]);
      $('#horas1').val(data[4]);
      $('#fech_inic1').val(data[5]);
      $('#fech_fin1').val(data[6]);
      $('#tip').val(data[7]);
      $('#archivo3').val(data[8]);

    });
  });

  $(document).ready(function() {
    $('.deletebtn2').on('click', function() {

      $('#eliminardiplomados').modal('show');
      // Get the table row data.
      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#num').val(data[0]);
      $('#id2').val(data[1]);
    });
  });

  $(document).ready(function() {
    $('.updateBtn3').on('click', function() {

      $('#actualizaridiomas').modal('show');

      // Get the table row data.
      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#num').val(data[0]);
      $('#ididiomas_comp').val(data[1]);
      $('#select_idio_compu').val(data[2]);
      $('#lugar_estudio').val(data[3]);
      $('#nivel4').val(data[4]);
      $('#archivos4').val(data[5]);

    });
  });

  $(document).ready(function() {
    $('.deleteBtn3').on('click', function() {

      $('#eliminaridiomas').modal('show');
      // Get the table row data.
      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#num').val(data[0]);
      $('#id3').val(data[1]);
    });
  });