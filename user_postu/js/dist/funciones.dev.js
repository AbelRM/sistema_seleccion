"use strict";

// $("#id_tipo_cargo").on('change', function(){
//     $('.formulario').hide();
//     $('#' + this.value).show();
// });
$(function () {
  $("#inputSelect").on('change', function () {
    var selectValue = $(this).val();

    switch (selectValue) {
      case "tipo-1":
        $("#tipo-1").show();
        $("#tipo-2").hide();
        $("#tipo-3").hide();
        $("#tipo-4").hide();
        $("#tipo-5").hide();
        $("#tipo-6").hide();
        $("#tipo-7").hide();
        $("#tipo-8").hide();
        $("#tipo-9").hide();
        $("#tipo-10").hide();
        $("#tipo-11").hide();
        $("#tipo-12").hide();
        $("#tipo-13").hide();
        break;

      case "tipo-2":
        $("#tipo-1").hide();
        $("#tipo-2").show();
        $("#tipo-3").hide();
        $("#tipo-4").hide();
        $("#tipo-5").hide();
        $("#tipo-6").hide();
        $("#tipo-7").hide();
        $("#tipo-8").hide();
        $("#tipo-9").hide();
        $("#tipo-10").hide();
        $("#tipo-11").hide();
        $("#tipo-12").hide();
        $("#tipo-13").hide();
        break;

      case "tipo-3":
        $("#tipo-1").hide();
        $("#tipo-2").hide();
        $("#tipo-3").show();
        $("#tipo-4").hide();
        $("#tipo-5").hide();
        $("#tipo-6").hide();
        $("#tipo-7").hide();
        $("#tipo-8").hide();
        $("#tipo-9").hide();
        $("#tipo-10").hide();
        $("#tipo-11").hide();
        $("#tipo-12").hide();
        $("#tipo-13").hide();
        break;

      case "tipo-4":
        $("#tipo-1").hide();
        $("#tipo-2").hide();
        $("#tipo-3").hide();
        $("#tipo-4").show();
        $("#tipo-5").hide();
        $("#tipo-6").hide();
        $("#tipo-7").hide();
        $("#tipo-8").hide();
        $("#tipo-9").hide();
        $("#tipo-10").hide();
        $("#tipo-11").hide();
        $("#tipo-12").hide();
        $("#tipo-13").hide();
        break;

      case "tipo-5":
        $("#tipo-1").hide();
        $("#tipo-2").hide();
        $("#tipo-3").hide();
        $("#tipo-4").hide();
        $("#tipo-5").show();
        $("#tipo-6").hide();
        $("#tipo-7").hide();
        $("#tipo-8").hide();
        $("#tipo-9").hide();
        $("#tipo-10").hide();
        $("#tipo-11").hide();
        $("#tipo-12").hide();
        $("#tipo-13").hide();
        break;

      case "tipo-6":
        $("#tipo-1").hide();
        $("#tipo-2").hide();
        $("#tipo-3").hide();
        $("#tipo-4").hide();
        $("#tipo-5").hide();
        $("#tipo-6").show();
        $("#tipo-7").hide();
        $("#tipo-8").hide();
        $("#tipo-9").hide();
        $("#tipo-10").hide();
        $("#tipo-11").hide();
        $("#tipo-12").hide();
        $("#tipo-13").hide();
        break;

      case "tipo-7":
        $("#tipo-1").hide();
        $("#tipo-2").hide();
        $("#tipo-3").hide();
        $("#tipo-4").hide();
        $("#tipo-5").hide();
        $("#tipo-6").hide();
        $("#tipo-7").show();
        $("#tipo-8").hide();
        $("#tipo-9").hide();
        $("#tipo-10").hide();
        $("#tipo-11").hide();
        $("#tipo-12").hide();
        $("#tipo-13").hide();
        break;

      case "tipo-8":
        $("#tipo-1").hide();
        $("#tipo-2").hide();
        $("#tipo-3").hide();
        $("#tipo-4").hide();
        $("#tipo-5").hide();
        $("#tipo-6").hide();
        $("#tipo-7").hide();
        $("#tipo-8").show();
        $("#tipo-9").hide();
        $("#tipo-10").hide();
        $("#tipo-11").hide();
        $("#tipo-12").hide();
        $("#tipo-13").hide();
        break;

      case "tipo-9":
        $("#tipo-1").hide();
        $("#tipo-2").hide();
        $("#tipo-3").hide();
        $("#tipo-4").hide();
        $("#tipo-5").hide();
        $("#tipo-6").hide();
        $("#tipo-7").hide();
        $("#tipo-8").hide();
        $("#tipo-9").show();
        $("#tipo-10").hide();
        $("#tipo-11").hide();
        $("#tipo-12").hide();
        $("#tipo-13").hide();
        break;

      case "tipo-10":
        $("#tipo-1").hide();
        $("#tipo-2").hide();
        $("#tipo-3").hide();
        $("#tipo-4").hide();
        $("#tipo-5").hide();
        $("#tipo-6").hide();
        $("#tipo-7").hide();
        $("#tipo-8").hide();
        $("#tipo-9").hide();
        $("#tipo-10").show();
        $("#tipo-11").hide();
        $("#tipo-12").hide();
        $("#tipo-13").hide();
        break;

      case "tipo-11":
        $("#tipo-1").hide();
        $("#tipo-2").hide();
        $("#tipo-3").hide();
        $("#tipo-4").hide();
        $("#tipo-5").hide();
        $("#tipo-6").hide();
        $("#tipo-7").hide();
        $("#tipo-8").hide();
        $("#tipo-9").hide();
        $("#tipo-10").hide();
        $("#tipo-11").show();
        $("#tipo-12").hide();
        $("#tipo-13").hide();
        break;

      case "tipo-12":
        $("#tipo-1").hide();
        $("#tipo-2").hide();
        $("#tipo-3").hide();
        $("#tipo-4").hide();
        $("#tipo-5").hide();
        $("#tipo-6").hide();
        $("#tipo-7").hide();
        $("#tipo-8").hide();
        $("#tipo-9").hide();
        $("#tipo-10").hide();
        $("#tipo-11").hide();
        $("#tipo-12").show();
        $("#tipo-13").hide();
        break;

      case "tipo-13":
        $("#tipo-1").hide();
        $("#tipo-2").hide();
        $("#tipo-3").hide();
        $("#tipo-4").hide();
        $("#tipo-5").hide();
        $("#tipo-6").hide();
        $("#tipo-7").hide();
        $("#tipo-8").hide();
        $("#tipo-9").hide();
        $("#tipo-10").hide();
        $("#tipo-11").hide();
        $("#tipo-12").hide();
        $("#tipo-13").show();
        break;
    }
  }).change();
});

function titulo(value) {
  if (value == "SI" || value == true) {
    document.getElementById("grado_bachiller").disabled = true;
  } else if (value == "NO" || value == false) {
    document.getElementById("grado_bachiller").disabled = false;
  }
}

function bachiller(value) {
  if (value == "SI" || value == true) {
    document.getElementById("titulo_profesional").disabled = true;
  } else if (value == "NO" || value == false) {
    document.getElementById("titulo_profesional").disabled = false;
  }
}

function especialidad(value) {
  if (value == "SI" || value == true) {
    document.getElementById("egresado_especialidad").disabled = true;
  } else if (value == "NO" || value == false) {
    document.getElementById("egresado_especialidad").disabled = false;
  }
}

function egre_especialidad(value) {
  if (value == "SI" || value == true) {
    document.getElementById("titulo_especialidad").disabled = true;
  } else if (value == "NO" || value == false) {
    document.getElementById("titulo_especialidad").disabled = false;
  }
}

function maestria(value) {
  if (value == "SI" || value == true) {
    document.getElementById("constancia_egre_maestria").disabled = true;
  } else if (value == "NO" || value == false) {
    document.getElementById("constancia_egre_maestria").disabled = false;
  }
}

function egre_maestria(value) {
  if (value == "SI" || value == true) {
    document.getElementById("grado_maestria").disabled = true;
  } else if (value == "NO" || value == false) {
    document.getElementById("grado_maestria").disabled = false;
  }
}

function doctorado(value) {
  if (value == "SI" || value == true) {
    document.getElementById("constancia_egre_doctorado").disabled = true;
  } else if (value == "NO" || value == false) {
    document.getElementById("constancia_egre_doctorado").disabled = false;
  }
}

function egre_doctorado(value) {
  if (value == "SI" || value == true) {
    document.getElementById("grado_doctorado").disabled = true;
  } else if (value == "NO" || value == false) {
    document.getElementById("grado_doctorado").disabled = false;
  }
}