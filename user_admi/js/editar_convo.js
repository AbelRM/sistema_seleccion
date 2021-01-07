
$(document).ready(function() {
  $("#nombre_cargo_espec").on('change', function() {
    var selectValue = $(this).val();
    switch (selectValue) {
      case "PROFESIONAL DE LA SALUD":
        $("#div_prof_salud").show();
        $("#div_otros_prof").hide();
        $("#div_asist_admi").hide();
        $("#div_tec_enfer").hide();
        $("#div_tec_admin").hide();
        $("#div_tec_info").hide();
        $("#div_tec_sec").hide();
        $("#div_aux_admin").hide();
        $("#div_chofer").hide();
        break;
      case "OTROS PROFESIONALES":
        $("#div_prof_salud").hide();
        $("#div_otros_prof").show();
        $("#div_asist_admi").hide();
        $("#div_tec_enfer").hide();
        $("#div_tec_admin").hide();
        $("#div_tec_info").hide();
        $("#div_tec_sec").hide();
        $("#div_aux_admin").hide();
        $("#div_chofer").hide();
        break;
      case "ASISTENTE ADMINISTRATIVO":
        $("#div_prof_salud").hide();
        $("#div_otros_prof").hide();
        $("#div_asist_admi").show();
        $("#div_tec_enfer").hide();
        $("#div_tec_admin").hide();
        $("#div_tec_info").hide();
        $("#div_tec_sec").hide();
        $("#div_aux_admin").hide();
        $("#div_chofer").hide();
        break;
      case "TECNICO EN ENFERMERIA":
        $("#div_prof_salud").hide();
        $("#div_otros_prof").hide();
        $("#div_asist_admi").hide();
        $("#div_tec_enfer").show();
        $("#div_tec_admin").hide();
        $("#div_tec_info").hide();
        $("#div_tec_sec").hide();
        $("#div_aux_admin").hide();
        $("#div_chofer").hide();
        break;
      case "TECNICO ADMINISTRATIVO":
        $("#div_prof_salud").hide();
        $("#div_otros_prof").hide();
        $("#div_asist_admi").hide();
        $("#div_tec_enfer").hide();
        $("#div_tec_admin").show();
        $("#div_tec_info").hide();
        $("#div_tec_sec").hide();
        $("#div_aux_admin").hide();
        $("#div_chofer").hide();
        break;
      case "TECNICO EN INFORMATICA - COMPUTACION":
        $("#div_prof_salud").hide();
        $("#div_otros_prof").hide();
        $("#div_asist_admi").show();
        $("#div_tec_enfer").hide();
        $("#div_tec_admin").hide();
        $("#div_tec_info").hide();
        $("#div_tec_sec").hide();
        $("#div_aux_admin").hide();
        $("#div_chofer").hide();
        break;
      case "AUXILIAR ADMINISTRATIVO":
        $("#div_prof_salud").hide();
        $("#div_otros_prof").hide();
        $("#div_asist_admi").show();
        $("#div_tec_enfer").hide();
        $("#div_tec_admin").hide();
        $("#div_tec_info").hide();
        $("#div_tec_sec").hide();
        $("#div_aux_admin").hide();
        $("#div_chofer").hide();
        break;
      case "SECRETARIA":
        $("#div_prof_salud").hide();
        $("#div_otros_prof").hide();
        $("#div_asist_admi").hide();
        $("#div_tec_enfer").hide();
        $("#div_tec_admin").show();
        $("#div_tec_info").hide();
        $("#div_tec_sec").hide();
        $("#div_aux_admin").hide();
        $("#div_chofer").hide();
        break;
      case "CHOFER":
        $("#div_prof_salud").hide();
        $("#div_otros_prof").hide();
        $("#div_asist_admi").hide();
        $("#div_tec_enfer").hide();
        $("#div_tec_admin").hide();
        $("#div_tec_info").hide();
        $("#div_tec_sec").hide();
        $("#div_aux_admin").hide();
        $("#div_chofer").show();
        break;
      case "VIGILANTE":
        $("#div_prof_salud").hide();
        $("#div_otros_prof").hide();
        $("#div_asist_admi").hide();
        $("#div_tec_enfer").hide();
        $("#div_tec_admin").hide();
        $("#div_tec_info").hide();
        $("#div_tec_sec").hide();
        $("#div_aux_admin").hide();
        $("#div_chofer").show();
        break;
      case "TRABAJADOR DE LIMPIEZA":
        $("#div_prof_salud").hide();
        $("#div_otros_prof").hide();
        $("#div_asist_admi").hide();
        $("#div_tec_enfer").hide();
        $("#div_tec_admin").hide();
        $("#div_tec_info").hide();
        $("#div_tec_sec").hide();
        $("#div_aux_admin").hide();
        $("#div_chofer").show();
        break;
      case "TRABAJADOR DE SERVICIOS":
        $("#div_prof_salud").hide();
        $("#div_otros_prof").hide();
        $("#div_asist_admi").hide();
        $("#div_tec_enfer").hide();
        $("#div_tec_admin").hide();
        $("#div_tec_info").hide();
        $("#div_tec_sec").hide();
        $("#div_aux_admin").hide();
        $("#div_chofer").show();
        break;
    }
  }).change();
  $("#select_formacion_requerida").on('change', function() {
    var selectValue = $(this).val();
    switch (selectValue) {
      case "1":
        $("#div_nivel_estudio_prof").hide();
        $("#div_ciclo_actual").hide();
        $("#div_colegiatura").hide();
        $("#div_habilitacion").hide();
        $("#div_serums").hide();
        break;
      case "2":
        $("#div_nivel_estudio_prof").show();
        $("#div_ciclo_actual").hide();
        $("#div_colegiatura").hide();
        $("#div_habilitacion").hide();
        $("#div_serums").hide();
        break;
      case "3":
        $("#div_nivel_estudio_prof").show();
        $("#div_ciclo_actual").hide();
        $("#div_colegiatura").hide();
        $("#div_habilitacion").hide();
        $("#div_serums").hide();
        break;
    }
  }).change();
  $("#select_nivel_estu").on('change', function() {
    var selectValue = $(this).val();
    switch (selectValue) {
      case "ESTUDIANTE":
        $("#div_ciclo_actual").show();
        $("#div_colegiatura").hide();
        $("#div_habilitacion").hide();
        $("#div_serums").hide();
        break;
      case "EGRESADO":
        $("#div_ciclo_actual").hide();
        $("#div_colegiatura").hide();
        $("#div_habilitacion").hide();
        $("#div_serums").hide();
        break;
      case "BACHILLER":
        $("#div_ciclo_actual").hide();
        $("#div_colegiatura").hide();
        $("#div_habilitacion").hide();
        $("#div_serums").hide();
        break;
      case "TITULADO":
        $("#div_ciclo_actual").hide();
        $("#div_colegiatura").show();
        $("#div_habilitacion").show();
        $("#div_serums").show();
        break;
    }
  }).change();

  $("#select_formacion_requerida_max").on('change', function() {
    var selectValue = $(this).val();
    switch (selectValue) {
      case "1":
        $("#div_nivel_estudio_prof_max").hide();
        $("#div_ciclo_actual_max").hide();
        $("#div_colegiatura_max").hide();
        $("#div_habilitacion_max").hide();
        $("#div_serums_max").hide();
        break;
      case "2":
        $("#div_nivel_estudio_prof_max").show();
        $("#div_ciclo_actual_max").hide();
        $("#div_colegiatura_max").hide();
        $("#div_habilitacion_max").hide();
        $("#div_serums_max").hide();
        break;
      case "3":
        $("#div_nivel_estudio_prof_max").show();
        $("#div_ciclo_actual_max").hide();
        $("#div_colegiatura_max").hide();
        $("#div_habilitacion_max").hide();
        $("#div_serums_max").hide();
        break;
    }
  }).change();

  $("#select_nivel_estudio_select_max").on('change', function() {
    var selectValue = $(this).val();
    switch (selectValue) {
      case "ESTUDIANTE":
        $("#div_ciclo_actual_max").show();
        $("#div_colegiatura_max").hide();
        $("#div_habilitacion_max").hide();
        $("#div_serums_max").hide();

        break;
      case "EGRESADO":
        $("#div_ciclo_actual_max").hide();
        $("#div_colegiatura_max").hide();
        $("#div_habilitacion_max").hide();
        $("#div_serums_max").hide();
        break;
      case "BACHILLER":
        $("#div_ciclo_actual_max").hide();
        $("#div_colegiatura_max").hide();
        $("#div_habilitacion_max").hide();
        $("#div_serums_max").hide();
        break;
      case "TITULADO":
        $("#div_ciclo_actual_max").hide();
        $("#div_colegiatura_max").show();
        $("#div_habilitacion_max").show();
        $("#div_serums_max").show();
        break;
    }
  }).change();
});