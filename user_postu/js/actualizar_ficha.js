
    // $(function() {
    //   $("#pertenecer_pension").on('change', function() {
    //     var selectValue = $(this).val();
    //     switch (selectValue) {
    //       case "ONP":
    //         $("#div_opcion_nomb_afp").hide();
    //         break;
    //       case "AFP":
    //         $("#div_opcion_nomb_afp").show();
    //         break;

    //     }
    //   }).change();
    // });

    // $(function() {
    //   $("#familiares_lab").on('change', function() {
    //     var selectValue = $(this).val();
    //     switch (selectValue) {
    //       case "NO":
    //         $("#tabla_div").hide();
    //         break;
    //       case "SI":
    //         $("#tabla_div").show();
    //         break;
    //     }
    //   }).change();
    // });

    function pagoOnChange(sel) {
      if (sel.value=="NO"){
           divC = document.getElementById("tabla_div");
           divC.style.display = "none";
      }else{
           divT = document.getElementById("tabla_div");
           divT.style.display = "block";
      }
}

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