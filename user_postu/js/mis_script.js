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



$('#expe_archivo_tipo2').bind('change', function () {
  //this.files[0].size gets the size of your file.
  var peso = (this.files[0].size);
  if (peso <= 3000000) {
    document.getElementById('peso_archivo_valido_tipo2').innerHTML = "Archivo válido";
    document.getElementById("peso_archivo_valido_tipo2").style.display = "block";
    document.getElementById("peso_archivo_no_tipo2").style.display = "none";
    // alert("Archivo valido");
  } else {
    document.getElementById('peso_archivo_no_tipo2').innerHTML = "El archivo sobre pasa los 3Mb máximos";
    document.getElementById("peso_archivo_valido_tipo2").style.display = "none";
    document.getElementById("peso_archivo_no_tipo2").style.display = "block";
    document.getElementById("expe_archivo_tipo2").value = '';
    // alert("Archivo NO valido");
  }
  // alert(this.files[0].size);
});
$('#expe_archivo3_tipo2').bind('change', function () {

  //this.files[0].size gets the size of your file.
  var peso = (this.files[0].size);
  if (peso <= 3000000) {
    document.getElementById("peso_archivo_valido3_tipo2").innerHTML = "Archivo válido";
    document.getElementById("peso_archivo_valido3_tipo2").style.display = "block";
    document.getElementById("peso_archivo_no3_tipo2").style.display = "none";
    // alert("Archivo valido");
  } else {
    document.getElementById("peso_archivo_no3_tipo2").innerHTML = "El archivo sobre pasa los 3Mb máximos";
    document.getElementById("peso_archivo_valido3_tipo2").style.display = "none";
    document.getElementById("peso_archivo_no3_tipo2").style.display = "block";
    document.getElementById("expe_archivo3_tipo2").value = '';
    // alert("Archivo NO valido");
  }
  // alert(this.files[0].size);
});
$('#expe_archivo1_tipo2').bind('change', function () {
  //this.files[0].size gets the size of your file.
  var peso = (this.files[0].size);
  if (peso <= 3000000) {
    document.getElementById('peso_archivo_valido1_tipo2').innerHTML = "Archivo válido";
    document.getElementById("peso_archivo_valido1_tipo2").style.display = "block";
    document.getElementById("peso_archivo_no1_tipo2").style.display = "none";
    // alert("Archivo valido");
  } else {
    document.getElementById('peso_archivo_no1_tipo2').innerHTML = "El archivo sobre pasa los 3Mb máximos";
    document.getElementById("peso_archivo_valido1_tipo2").style.display = "none";
    document.getElementById("peso_archivo_no1_tipo2").style.display = "block";
    document.getElementById("expe_archivo1_tipo2").value = '';
    // alert("Archivo NO valido");
  }
  // alert(this.files[0].size);
});



$('#expe_archivo4_tipo2').bind('change', function () {
  //this.files[0].size gets the size of your file.
  var peso = (this.files[0].size);
  if (peso <= 3000000) {
    document.getElementById('peso_archivo_valido4_tipo2').innerHTML = "Archivo válido";
    document.getElementById("peso_archivo_valido4_tipo2").style.display = "block";
    document.getElementById("peso_archivo_no4_tipo2").style.display = "none";
    // alert("Archivo valido");
  } else {
    document.getElementById('peso_archivo_no4_tipo2').innerHTML = "El archivo sobre pasa los 3Mb máximos";
    document.getElementById("peso_archivo_valido4_tipo2").style.display = "none";
    document.getElementById("peso_archivo_no4_tipo2").style.display = "block";
    document.getElementById("expe_archivo4_tipo2").value = '';
    // alert("Archivo NO valido");
  }
  // alert(this.files[0].size);
});


//PARA TIPO COMPROBANTE//
/////////////////////////
    div_nro_contrato = document.getElementById("div_nro_contrato");
    div_nro_contrato.style.display = "none";
    div_boleta_pago = document.getElementById("div_boleta_pago");
    div_boleta_pago.style.display = "none";
    div_fecha_boleta = document.getElementById("div_fecha_boleta");
    div_fecha_boleta.style.display = "none";

    function tipo_comprobante_select(sel) {
      if (sel.value == "Contrato") {
        div_nro_contrato = document.getElementById("div_nro_contrato");
        div_nro_contrato.style.display = "block";
        div_boleta_pago = document.getElementById("div_boleta_pago");
        div_boleta_pago.style.display = "none";
        div_fecha_boleta = document.getElementById("div_fecha_boleta");
        div_fecha_boleta.style.display = "none";

      } else if (sel.value == "Boleta") {
        div_nro_contrato = document.getElementById("div_nro_contrato");
        div_nro_contrato.style.display = "none";
        div_boleta_pago = document.getElementById("div_boleta_pago");
        div_boleta_pago.style.display = "block";
        div_fecha_boleta = document.getElementById("div_fecha_boleta");
        div_fecha_boleta.style.display = "block";

      }
    }

    div_nro_contrato_expe1 = document.getElementById("div_nro_contrato_expe1");
    div_nro_contrato_expe1.style.display = "none";
    div_boleta_pago_expe1 = document.getElementById("div_boleta_pago_expe1");
    div_boleta_pago_expe1.style.display = "none";
    div_fecha_boleta_expe1 = document.getElementById("div_fecha_boleta_expe1");
    div_fecha_boleta_expe1.style.display = "none";

    function tipo_comprobante_expe1_select(sel) {
      if (sel.value == "Contrato") {
        div_nro_contrato_expe1 = document.getElementById("div_nro_contrato_expe1");
        div_nro_contrato_expe1.style.display = "block";
        div_boleta_pago_expe1 = document.getElementById("div_boleta_pago_expe1");
        div_boleta_pago_expe1.style.display = "none";
        div_fecha_boleta_expe1 = document.getElementById("div_fecha_boleta_expe1");
        div_fecha_boleta_expe1.style.display = "none";

      } else if (sel.value == "Boleta") {
        div_nro_contrato_expe1 = document.getElementById("div_nro_contrato_expe1");
        div_nro_contrato_expe3.style.display = "none";
        div_boleta_pago_expe1 = document.getElementById("div_boleta_pago_expe1");
        div_boleta_pago_expe1.style.display = "block";
        div_fecha_boleta_expe1 = document.getElementById("div_fecha_boleta_expe1");
        div_fecha_boleta_expe1.style.display = "block";

      }
    }

    div_nro_contrato_expe3 = document.getElementById("div_nro_contrato_expe3");
    div_nro_contrato_expe3.style.display = "none";
    div_boleta_pago_expe3 = document.getElementById("div_boleta_pago_expe3");
    div_boleta_pago_expe3.style.display = "none";
    div_fecha_boleta_expe3 = document.getElementById("div_fecha_boleta_expe3");
    div_fecha_boleta_expe3.style.display = "none";


    function tipo_comprobante_expe3_select(sel) {
      if (sel.value == "Contrato") {
        div_nro_contrato_expe3 = document.getElementById("div_nro_contrato_expe3");
        div_nro_contrato_expe3.style.display = "block";
        div_boleta_pago_expe3 = document.getElementById("div_boleta_pago_expe3");
        div_boleta_pago_expe3.style.display = "none";
        div_fecha_boleta_expe3 = document.getElementById("div_fecha_boleta_expe3");
        div_fecha_boleta_expe3.style.display = "none";

      } else if (sel.value == "Boleta") {
        div_nro_contrato_expe3 = document.getElementById("div_nro_contrato_expe3");
        div_nro_contrato_expe3.style.display = "none";
        div_boleta_pago_expe3 = document.getElementById("div_boleta_pago_expe3");
        div_boleta_pago_expe3.style.display = "block";
        div_fecha_boleta_expe3 = document.getElementById("div_fecha_boleta_expe3");
        div_fecha_boleta_expe3.style.display = "block";

      }
    }

    div_nro_contrato_tip2 = document.getElementById("div_nro_contrato_tip2");
    div_nro_contrato_tip2.style.display = "none";
    div_fecha_boleta_tip2 = document.getElementById("div_fecha_boleta_tip2");
    div_fecha_boleta_tip2.style.display = "none";
    div_boleta_pago_tip2 = document.getElementById("div_boleta_pago_tip2");
    div_boleta_pago_tip2.style.display = "none";

    function tipo_comprobante_tip2_select(sel) {
      if (sel.value == "Contrato") {
        div_nro_contrato_tip2 = document.getElementById("div_nro_contrato_tip2");
        div_nro_contrato_tip2.style.display = "block";
        div_fecha_boleta_tip2 = document.getElementById("div_fecha_boleta_tip2");
        div_fecha_boleta_tip2.style.display = "none";
        div_boleta_pago_tip2 = document.getElementById("div_boleta_pago_tip2");
        div_boleta_pago_tip2.style.display = "none";

      } else if (sel.value == "Boleta") {
        div_nro_contrato_tip2 = document.getElementById("div_nro_contrato_tip2");
        div_nro_contrato_tip2.style.display = "none";
        div_fecha_boleta_tip2 = document.getElementById("div_fecha_boleta_tip2");
        div_fecha_boleta_tip2.style.display = "block";
        div_boleta_pago_tip2 = document.getElementById("div_boleta_pago_tip2");
        div_boleta_pago_tip2.style.display = "block";

      }
    }

    div_nro_contrato_tip2_expe3 = document.getElementById("div_nro_contrato_tip2_expe3");
    div_nro_contrato_tip2_expe3.style.display = "none";
    div_fecha_boleta_tip2_expe3 = document.getElementById("div_fecha_boleta_tip2_expe3");
    div_fecha_boleta_tip2_expe3.style.display = "none";
    div_boleta_pago_tip2_expe3 = document.getElementById("div_boleta_pago_tip2_expe3");
    div_boleta_pago_tip2_expe3.style.display = "none";

    function tipo_comprobante_tip2_expe3_select(sel) {
      if (sel.value == "Contrato") {
        div_nro_contrato_tip2_expe3 = document.getElementById("div_nro_contrato_tip2_expe3");
        div_nro_contrato_tip2_expe3.style.display = "block";
        div_fecha_boleta_tip2_expe3 = document.getElementById("div_fecha_boleta_tip2_expe3");
        div_fecha_boleta_tip2_expe3.style.display = "none";
        div_boleta_pago_tip2_expe3 = document.getElementById("div_boleta_pago_tip2_expe3");
        div_boleta_pago_tip2_expe3.style.display = "none";

      } else if (sel.value == "Boleta") {
        div_nro_contrato_tip2_expe3 = document.getElementById("div_nro_contrato_tip2_expe3");
        div_nro_contrato_tip2_expe3.style.display = "none";
        div_fecha_boleta_tip2_expe3 = document.getElementById("div_fecha_boleta_tip2_expe3");
        div_fecha_boleta_tip2_expe3.style.display = "block";
        div_boleta_pago_tip2_expe3 = document.getElementById("div_boleta_pago_tip2_expe3");
        div_boleta_pago_tip2_expe3.style.display = "block";

      }
    }

    div_nro_contrato_tip1_expe_1 = document.getElementById("div_nro_contrato_tip1_expe_1");
    div_nro_contrato_tip1_expe_1.style.display = "none";
    div_fecha_boleta_tip1_expe_1 = document.getElementById("div_fecha_boleta_tip1_expe_1");
    div_fecha_boleta_tip1_expe_1.style.display = "none";
    div_boleta_pago_tip1_expe_1 = document.getElementById("div_boleta_pago_tip1_expe_1");
    div_boleta_pago_tip1_expe_1.style.display = "none";

    function tipo_comprobante_tip1_expe_1_select(sel) {
      if (sel.value == "Contrato") {
        div_nro_contrato_tip1_expe_1 = document.getElementById("div_nro_contrato_tip1_expe_1");
        div_nro_contrato_tip1_expe_1.style.display = "block";
        div_fecha_boleta_tip1_expe_1 = document.getElementById("div_fecha_boleta_tip1_expe_1");
        div_fecha_boleta_tip1_expe_1.style.display = "none";
        div_boleta_pago_tip1_expe_1 = document.getElementById("div_boleta_pago_tip1_expe_1");
        div_boleta_pago_tip1_expe_1.style.display = "none";

      } else if (sel.value == "Boleta") {
        div_nro_contrato_tip1_expe_1 = document.getElementById("div_nro_contrato_tip1_expe_1");
        div_nro_contrato_tip1_expe_1.style.display = "none";
        div_fecha_boleta_tip1_expe_1 = document.getElementById("div_fecha_boleta_tip1_expe_1");
        div_fecha_boleta_tip1_expe_1.style.display = "block";
        div_boleta_pago_tip1_expe_1 = document.getElementById("div_boleta_pago_tip1_expe_1");
        div_boleta_pago_tip1_expe_1.style.display = "block";

      }
    }

  //ACTUALIZAR EXPERIENCIA LABORAL//
  // $(function() {
  //   $("#edit_tipo_comprobante_exp4_tip2").on('change', function() {
  //     var selectValue = $(this).val();
  //     switch (selectValue) {
  //       case "Contrato":
  //         $("#div_nro_contrato").show();
  //         $("#div_fecha_boleta").hide();
  //         $("#div_boleta_pago").hide();
  //         break;
  //       case "Boleta":
  //         $("#div_nro_contrato").hide();
  //         $("#div_fecha_boleta").show();
  //         $("#div_boleta_pago").show();
  //         break;
  //     }
  //   }).change();
  // });
