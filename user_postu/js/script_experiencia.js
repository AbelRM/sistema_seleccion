$(document).ready(function() {
  $('.updateBtn1').on('click', function() {

    $('#actualizar_expe').modal('show');

    // Get the table row data.
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
      return $(this).text();
    }).get();

    console.log(data);
    $('#id_4puntos').val(data[0]);
    $('#numero4').val(data[1]);
    $('#id_lugar_espec').val(data[2]);
    $('#update_lugar_gene').val(data[3]);
    $('#update_lugar_espec').val(data[4]);
    $('#cargo4').val(data[5]);
    $('#fecha_inicio4').val(data[6]);
    $('#fecha_fin4').val(data[7]);
    
    $('#update_tipo_comprobante').val(data[8]);
    $('#update_nro_contrato').val(data[9]);
    $('#update_fecha_boleta').val(data[10]);
    $('#update_boleta').val(data[11]);
    $('#archivos4').val(data[12]);
  });
});

$(document).ready(function() {
  $('.deleteBtn1').on('click', function() {

    $('#eliminar_expe').modal('show');
    // Get the table row data.
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
      return $(this).text();
    }).get();

    console.log(data);
    $('#id4').val(data[0]);
  });
});

//binds to onchange event of your input field
$('#expe_archivo').bind('change', function () {
  //this.files[0].size gets the size of your file.
  var peso = (this.files[0].size);
  if (peso <= 3000000) {
    document.getElementById('peso_archivo_valido').innerHTML = "Archivo válido";
    document.getElementById("peso_archivo_valido").style.display = "block";
    document.getElementById("peso_archivo_no").style.display = "none";
    // alert("Archivo valido");
  } else {
    document.getElementById('peso_archivo_no').innerHTML = "El archivo sobre pasa los 3Mb máximos";
    document.getElementById("peso_archivo_valido").style.display = "none";
    document.getElementById("peso_archivo_no").style.display = "block";
    document.getElementById("expe_archivo").value = '';
    // alert("Archivo NO valido");
  }
  // alert(this.files[0].size);
});

$('#expe_archivo_3').bind('change', function () {
  //this.files[0].size gets the size of your file.
  var peso = (this.files[0].size);
  if (peso <= 3000000) {
    document.getElementById('peso_archivo_valido_3').innerHTML = "Archivo válido";
    document.getElementById("peso_archivo_valido_3").style.display = "block";
    document.getElementById("peso_archivo_no_3").style.display = "none";
    // alert("Archivo valido");
  } else {
    document.getElementById('peso_archivo_no_3').innerHTML = "El archivo sobre pasa los 3Mb máximos";
    document.getElementById("peso_archivo_valido_3").style.display = "none";
    document.getElementById("peso_archivo_no_3").style.display = "block";
    document.getElementById("expe_archivo_3").value = '';
    // alert("Archivo NO valido");
  }
  // alert(this.files[0].size);
});

$('#expe_archivo_1').bind('change', function () {
  //this.files[0].size gets the size of your file.
  var peso = (this.files[0].size);
  if (peso <= 3000000) {
    document.getElementById('peso_archivo_valido_1').innerHTML = "Archivo válido";
    document.getElementById("peso_archivo_valido_1").style.display = "block";
    document.getElementById("peso_archivo_no_1").style.display = "none";
    // alert("Archivo valido");
  } else {
    document.getElementById('peso_archivo_no_1').innerHTML = "El archivo sobre pasa los 3Mb máximos";
    document.getElementById("peso_archivo_valido_1").style.display = "none";
    document.getElementById("peso_archivo_no_1").style.display = "block";
    document.getElementById("expe_archivo_1").value = '';
    // alert("Archivo NO valido");
  }
  // alert(this.files[0].size);
});

div_msj_recibo = document.getElementById("div_msj_recibo");
div_msj_recibo.style.display = "none";
div_tipo_constancia = document.getElementById("div_tipo_constancia");
div_tipo_constancia.style.display = "none";
div_nro_contrato = document.getElementById("div_nro_contrato");
div_nro_contrato.style.display = "none";
div_boleta_pago = document.getElementById("div_boleta_pago");
div_boleta_pago.style.display = "none";
div_fecha_boleta = document.getElementById("div_fecha_boleta");
div_fecha_boleta.style.display = "none";

function tipo_comprobante_select(sel) {
  if (sel.value == "Contrato") {
      div_tipo_constancia = document.getElementById("div_tipo_constancia");
    div_tipo_constancia.style.display = "none";
    div_nro_contrato = document.getElementById("div_nro_contrato");
    div_nro_contrato.style.display = "block";
    div_boleta_pago = document.getElementById("div_boleta_pago");
    div_boleta_pago.style.display = "none";
    div_fecha_boleta = document.getElementById("div_fecha_boleta");
    div_fecha_boleta.style.display = "none";
    div_msj_recibo = document.getElementById("div_msj_recibo");
    div_msj_recibo.style.display = "none";

  } else if (sel.value == "Constancia/Certificado") {
    div_tipo_constancia = document.getElementById("div_tipo_constancia");
    div_tipo_constancia.style.display = "block";
    div_nro_contrato = document.getElementById("div_nro_contrato");
    div_nro_contrato.style.display = "none";
    div_boleta_pago = document.getElementById("div_boleta_pago");
    div_boleta_pago.style.display = "none";
    div_fecha_boleta = document.getElementById("div_fecha_boleta");
    div_fecha_boleta.style.display = "none";
    div_msj_recibo = document.getElementById("div_msj_recibo");
    div_msj_recibo.style.display = "none";
  } else if (sel.value == "Orden de servicio") {
    div_tipo_constancia = document.getElementById("div_tipo_constancia");
    div_tipo_constancia.style.display = "none";
    div_nro_contrato = document.getElementById("div_nro_contrato");
    div_nro_contrato.style.display = "none";
    div_boleta_pago = document.getElementById("div_boleta_pago");
    div_boleta_pago.style.display = "none";
    div_fecha_boleta = document.getElementById("div_fecha_boleta");
    div_fecha_boleta.style.display = "none";
    div_msj_recibo = document.getElementById("div_msj_recibo");
    div_msj_recibo.style.display = "block";
  }else if (sel.value == "Resolucion") {
    div_tipo_constancia = document.getElementById("div_tipo_constancia");
    div_tipo_constancia.style.display = "none";
    div_nro_contrato = document.getElementById("div_nro_contrato");
    div_nro_contrato.style.display = "none";
    div_boleta_pago = document.getElementById("div_boleta_pago");
    div_boleta_pago.style.display = "none";
    div_fecha_boleta = document.getElementById("div_fecha_boleta");
    div_fecha_boleta.style.display = "none";
    div_msj_recibo = document.getElementById("div_msj_recibo");
    div_msj_recibo.style.display = "none";
  }
}

function tipo_constancia_select(sel) {
  if (sel.value == "Constancia DIRESA") {
    div_boleta_pago = document.getElementById("div_boleta_pago");
    div_boleta_pago.style.display = "none";
    div_fecha_boleta = document.getElementById("div_fecha_boleta");
    div_fecha_boleta.style.display = "none";

  } else if (sel.value == "Constancia NO DIRESA") {
    div_boleta_pago = document.getElementById("div_boleta_pago");
    div_boleta_pago.style.display = "block";
    div_fecha_boleta = document.getElementById("div_fecha_boleta");
    div_fecha_boleta.style.display = "block";
  }
}

$(function() {
  $("#update_tipo_comprobante").on('change', function() {
    var selectValue = $(this).val();
    switch (selectValue) {
      case "Contrato":
        $("#div_tipo_constancia_update").hide();
        $("#div_nro_contrato_update").show();
        $("#div_fecha_boleta_update").hide();
        $("#div_boleta_pago_update").hide();
        $("#div_msj_recibo_update").hide();
        break;
      case "Constancia/Certificado":
        $("#div_tipo_constancia_update").show();
        $("#div_nro_contrato_update").hide();
        $("#div_fecha_boleta_update").show();
        $("#div_boleta_pago_update").show();
        $("#div_msj_recibo_update").hide();
        break;
      case "Orden de servicio":
        $("#div_tipo_constancia_update").show();
        $("#div_nro_contrato_update").hide();
        $("#div_fecha_boleta_update").hide();
        $("#div_boleta_pago_update").hide();
        $("#div_msj_recibo_update").show();
        break;
        case "Resolucion":
        $("#div_tipo_constancia_update").hide();
        $("#div_nro_contrato_update").hide();
        $("#div_fecha_boleta_update").hide();
        $("#div_boleta_pago_update").hide();
        $("#div_msj_recibo_update").hide();
        break;
    }
  }).change();
});

$(function() {
  $("#update_tipo_constancia").on('change', function() {
    var selectValue = $(this).val();
    switch (selectValue) {
      case "Constancia DIRESA":
        $("#div_fecha_boleta_update").hide();
        $("#div_boleta_pago_update").hide();
        break;
      case "Constancia NO DIRESA":
        $("#div_fecha_boleta_update").show();
        $("#div_boleta_pago_update").show();
        
        break;
    }
  }).change();
});

div_nombre_lugar_espec = document.getElementById("div_nombre_lugar_espec");
div_nombre_lugar_espec.style.display = "none";
$(function() {
  $("#nombre_lugar_gene").on('change', function() {
    var selectValue = $(this).val();
    switch (selectValue) {
      case "1":
        $("#div_nombre_lugar_espec").hide();
        break;
      case "2":
        $("#div_nombre_lugar_espec").hide();
        break;
      case "3":
        $("#div_nombre_lugar_espec").hide();
        break;
      case "4":
        $("#div_nombre_lugar_espec").hide();
        break;
      case "5":
        $("#div_nombre_lugar_espec").hide();
        break;
      case "6":
        $("#div_nombre_lugar_espec").hide();
        break;
      case "7":
        $("#div_nombre_lugar_espec").hide();
        break;
      case "8":
        $("#div_nombre_lugar_espec").hide();
        break;
      case "9":
        $("#div_nombre_lugar_espec").hide();
        break;
      case "10":
        $("#div_nombre_lugar_espec").hide();
        break;
      case "11":
        $("#div_nombre_lugar_espec").hide();
        break;
      case "12":
        $("#div_nombre_lugar_espec").show();
        break;
      case "13":
        $("#div_nombre_lugar_espec").hide();
        break;
      case "14":
        $("#div_nombre_lugar_espec").hide();
        break;
      case "15":
        $("#div_nombre_lugar_espec").hide();
        break;
      case "16":
        $("#div_nombre_lugar_espec").show();
        break;
      case "17":
        $("#div_nombre_lugar_espec").show();
        break;

    }
  }).change();
});

div_nombre_lugar_espec = document.getElementById("div_update_lugar_espec");
div_nombre_lugar_espec.style.display = "none";
$(function() {
  $("#id_lugar_espec").on('change', function() {
    var selectValue = $(this).val();
    switch (selectValue) {
      case "1":
        $("#div_update_lugar_espec").hide();
        break;
      case "2":
        $("#div_update_lugar_espec").hide();
        break;
      case "3":
        $("#div_update_lugar_espec").hide();
        break;
      case "4":
        $("#div_update_lugar_espec").hide();
        break;
      case "5":
        $("#div_update_lugar_espec").hide();
        break;
      case "6":
        $("#div_update_lugar_espec").hide();
        break;
      case "7":
        $("#div_update_lugar_espec").hide();
        break;
      case "8":
        $("#div_update_lugar_espec").hide();
        break;
      case "9":
        $("#div_update_lugar_espec").hide();
        break;
      case "10":
        $("#div_update_lugar_espec").hide();
        break;
      case "11":
        $("#div_update_lugar_espec").hide();
        break;
      case "12":
        $("#div_update_lugar_espec").show();
        break;
      case "13":
        $("#div_update_lugar_espec").hide();
        break;
      case "14":
        $("#div_update_lugar_espec").hide();
        break;
      case "15":
        $("#div_update_lugar_espec").hide();
        break;
      case "16":
        $("#div_update_lugar_espec").show();
        break;
      case "17":
        $("#div_update_lugar_espec").show();
        break;

    }
  }).change();
});