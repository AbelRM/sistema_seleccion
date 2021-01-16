
<?php
$fecha_ini_4exp = "2020-12-01";
$fecha_fin_4exp = "2020-12-31";
/// VALORES ENTEROS ///
$fechaentero_1 = strtotime($fecha_ini_4exp);
$fechaentero_2 = strtotime($fecha_fin_4exp);
// MES
$mes_ini = date("m", $fechaentero_1);
$mes_fin = date("m", $fechaentero_2);
//DIA
$dia_ini = date("d", $fechaentero_1);
$dia_fin = date("d", $fechaentero_2);
$code = 0;
if ($mes_ini == 2 and $mes_fin == 2) {
  // $dia_ini = date("d", $fechaentero_1);
  $dia_fin = date("d", $fechaentero_2);
  if ($dia_fin == 28) {
    $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp . "+ 4 days"));
  } elseif ($dia_fin == 29) {
    $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 3 days"));
  }
} elseif ($mes_ini == 2) {
  $dia_fin = date("d", $fechaentero_2);
  if ($dia_fin == 30) {
    $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp . "+ 2 days"));
  } elseif ($dia_fin == 31) {
    $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 1 days"));
  } else {
    $new_fechafin = $fecha_fin_4exp;
    $code = 1;
  }
} elseif ($mes_ini == 1) {
  $dia_fin = date("d", $fechaentero_2);
  if ($dia_fin == 30) {
    $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp . "+ 2 days"));
  } elseif ($dia_fin == 31) {
    $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 1 days"));
  } elseif ($dia_fin == 28) {
    $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 4 days"));
  } elseif ($dia_fin == 29) {
    $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 3 days"));
  } else {
    $new_fechafin = $fecha_fin_4exp;
    $code = 1;
  }
} elseif ($mes_ini == $mes_fin) {
  echo "entro aaqui";
  $new_fechafin = $fecha_fin_4exp;
} elseif (($mes_ini == 4 or $mes_ini == 6 or $mes_ini == 9 or $mes_ini == 11) and $dia_fin == 31) {
  $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 1 days"));
} elseif (($mes_ini == 1  or $mes_ini == 5 or $mes_ini == 7 or $mes_ini == 8 or $mes_ini == 10 or $mes_ini == 12) and   $dia_fin == 31) {
  $new_fechafin = $fecha_fin_4exp;
} elseif ($mes_ini == 3 and $dia_fin == 31) {
  $new_fechafin = $fecha_fin_4exp;
  $code = 2;
} elseif ($dia_ini == 31 and $dia_fin == 30) {
  $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 1 days"));
} elseif (($mes_ini == 4 or $mes_ini == 6 or $mes_ini == 9 or $mes_ini == 1) and $dia_fin == 30) {
  $new_fechafin = date("Y-m-d", strtotime($fecha_fin_4exp  . "+ 2 days"));
} else {
  $code = 1;
  $new_fechafin = $fecha_fin_4exp;
}

$fechainicial = new DateTime($fecha_ini_4exp);
$fechaactual = new DateTime($new_fechafin);
$diferencia = $fechainicial->diff($fechaactual);
$años = $diferencia->format('%Y');
$meses = $diferencia->format('%m');
if ($code == 1) {
  $dias = $diferencia->format('%d');
  $dias = $dias + 1;
} elseif ($code == 2) {
  $dias = $diferencia->format('%d');
  $dias = $dias - 1;
} else {
  echo "y luego aqui";
  $dias = $diferencia->format('%d');
}

echo $años . '<br>';
echo $meses . '<br>';
echo $dias . '<br>';
