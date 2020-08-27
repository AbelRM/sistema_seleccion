"use strict";

$("#id_tipo_cargo").on('change', function () {
  $('.formulario').hide();
  $('#' + this.value).show();
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