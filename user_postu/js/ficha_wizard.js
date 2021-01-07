$(function() {
  $("#inputSelect").on('change', function() {
    var selectValue = $(this).val();
    switch (selectValue) {
      case "AFP":
        $("#AFP").show();
        $("#AFP-2").show();
        $("#NINGUNA").hide();
        break;

      case "ONP":
        $("#AFP").hide();
        $("#AFP-2").hide();
        $("#NINGUNA").hide();
        break;
      case "ONP":
        $("#AFP").hide();
        $("#AFP-2").hide();
        $("#NINGUNA").hide();
        break;

      case "NINGUNA":
        $("#NINGUNA").show();
        $("#AFP").hide();
        $("#AFP-2").hide();
        break;
    }
  }).change();
  
  $("#pertenecer_pension").on('change', function() {
    var selectValue = $(this).val();
    switch (selectValue) {
      case "AFP":
        $("#opcion-AFP").show();
        break;

      case "ONP":
        $("#opcion-AFP").hide();
        break;
    }
  }).change();
});

$(function() {
  // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
  $("#adicional").on('click', function() {
    $("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla").find("input[type=text]").val("");
  });

  // Evento que selecciona la fila y la elimina 
  $(document).on("click", ".eliminar", function() {
    var parent = $(this).parents().get(0);
    $(parent).remove();
  });
});

function familiares_lab_select(sel) {
  if (sel.value == "NO") {
    tabla = document.getElementById("tabla_div");
    tabla.style.display = "none";
    boton_agregar = document.getElementById("boton_agregar");
    boton_agregar.style.display = "none";

  } else if (sel.value == "SI") {
    tabla = document.getElementById("tabla_div");
    tabla.style.display = "block";
    boton_agregar = document.getElementById("boton_agregar");
    boton_agregar.style.display = "block";

  }
}