function cambiar() {
  var pdrs = document.getElementById('file-upload').files[0].name;
  document.getElementById('info').innerHTML = pdrs;
}
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

//binds to onchange event of your input field
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
$('#merito_archivo').bind('change', function () {
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
  }
});

$(function() {
  $("#colegiatura_edit").on('change', function() {
    var selectValue = $(this).val();
    switch (selectValue) {
      case "NO":
        $("#nro_colegiatura_edit").prop('disabled', true);
        $("#fecha_colegiatura_edit").prop('disabled', true);
        $("#fech_habilitacion").prop('disabled', true);
        break;
      case "SI":
        $("#nro_colegiatura_edit").removeAttr('disabled');
        $("#fecha_colegiatura_edit").removeAttr('disabled');
        $("#fech_habilitacion").removeAttr('disabled');
        break;
    }
  }).change();
});

$(function() {
  $("#tipo_estudios_select").on('change', function() {
    var selectValue = $(this).val();
    switch (selectValue) {
      case "1":
        $("#div_nivel_estudio_tecnico").hide();
        $("#div_ciclo_actual").hide();
        $("#div_nivel_estudio_prof").hide();
        $("#div_carrera").hide();
        $("#div_serums").hide();
        $("#div_valor_quintil").hide();
        $("#div_tipo_profesional").hide();
        break;
      case "2":
        $("#div_nivel_estudio_tecnico").show();
        $("#div_ciclo_actual").hide();
        $("#div_nivel_estudio_prof").hide();
        $("#div_carrera").show();
        $("#div_serums").hide();
        $("#div_valor_quintil").hide();
        $("#div_tipo_profesional").hide();
        break;
      case "3":
        $("#div_nivel_estudio_tecnico").hide();
        $("#div_ciclo_actual").hide();
        $("#div_nivel_estudio_prof").show();
        $("#div_carrera").show();
        $("#div_serums").hide();
        $("#div_valor_quintil").hide();
        break;
    }
  }).change();
});


$(function() {
  $("#nivel_estudios_edit").on('change', function() {
    var selectValue = $(this).val();
    switch (selectValue) {
      case "ESTUDIANTE":
        $("#div_ciclo_actual").show();
        $("#div_tipo_profesional").hide();
        $("#div_serums").hide();
        $("#div_valor_quintil").hide();
        break;
      case "EGRESADO":
        $("#div_ciclo_actual").hide();
        $("#div_tipo_profesional").hide();
        $("#div_serums").hide();
        $("#div_valor_quintil").hide();
        break;
      case "BACHILLER":
        $("#div_ciclo_actual").hide();
        $("#div_tipo_profesional").hide();
        $("#div_serums").hide();
        $("#div_valor_quintil").hide();
        break;
      case "TITULADO":
        $("#div_ciclo_actual").hide();
        $("#div_tipo_profesional").show();
        $("#div_serums").hide();
        $("#div_valor_quintil").hide();
        break;
    }
  }).change();
});

function tipo_nivel_estudio_select(sel) {
  if (sel.value == "ESTUDIANTE") {
    div_ciclo_actual = document.getElementById("div_ciclo_actual");
    div_ciclo_actual.style.display = "block";
    div_tipo_profesional = document.getElementById("div_tipo_profesional");
    div_tipo_profesional.style.display = "none";
    div_serums = document.getElementById("div_serums");
    div_serums.style.display = "none";
    div_valor_quintil = document.getElementById("div_valor_quintil");
    div_valor_quintil.style.display = "none";

  } else if (sel.value == "EGRESADO") {
    div_ciclo_actual = document.getElementById("div_ciclo_actual");
    div_ciclo_actual.style.display = "none";
    div_tipo_profesional = document.getElementById("div_tipo_profesional");
    div_tipo_profesional.style.display = "none";
    div_serums = document.getElementById("div_serums");
    div_serums.style.display = "none";
    div_valor_quintil = document.getElementById("div_valor_quintil");
    div_valor_quintil.style.display = "none";
  } else if (sel.value == "BACHILLER") {
    div_ciclo_actual = document.getElementById("div_ciclo_actual");
    div_ciclo_actual.style.display = "none";
    div_tipo_profesional = document.getElementById("div_tipo_profesional");
    div_tipo_profesional.style.display = "none";
    div_serums = document.getElementById("div_serums");
    div_serums.style.display = "none";
    div_valor_quintil = document.getElementById("div_valor_quintil");
    div_valor_quintil.style.display = "none";

  } else if (sel.value == "TITULADO") {
    div_ciclo_actual = document.getElementById("div_ciclo_actual");
    div_ciclo_actual.style.display = "none";
    div_tipo_profesional = document.getElementById("div_tipo_profesional");
    div_tipo_profesional.style.display = "block";

  }
}

function tipo_profesional_select(sel) {
  if (sel.value == "vacio") {
    div_div_serums = document.getElementById("div_serums");
    div_div_serums.style.display = "none";
    div_div_valor_quintil = document.getElementById("div_valor_quintil");
    div_div_valor_quintil.style.display = "none";

  } else if (sel.value == "administrativo") {
    div_div_serums = document.getElementById("div_serums");
    div_div_serums.style.display = "none";
    div_div_valor_quintil = document.getElementById("div_valor_quintil");
    div_div_valor_quintil.style.display = "none";

  } else if (sel.value == "asistencial") {
    div_div_serums = document.getElementById("div_serums");
    div_div_serums.style.display = "block";
    div_div_valor_quintil = document.getElementById("div_valor_quintil");
    div_div_valor_quintil.style.display = "block";

  }
}

//ACTUALIZAR FORMACION

$(function() {
  $("#tipo_prof").on('change', function() {
    var selectValue = $(this).val();
    switch (selectValue) {
      case "administrativo":
        $("#div_serums").hide();
        $("#div_valor_quintil").hide();
        break;
      case "asistencial":
        $("#div_serums").show();
        $("#div_valor_quintil").show();
    }
  }).change();
});


//CRUD DELETE

$(document).ready(function() {
  $('.deleteBtn').on('click', function() {

    $('#deleteModal').modal('show');

    // Get the table row data.
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
      return $(this).text();
    }).get();

    console.log(data);

    $('#deleteId').val(data[0]);

  });
});