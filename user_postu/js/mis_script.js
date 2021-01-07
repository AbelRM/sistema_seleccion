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
