<?php
require('fpdf/fpdf.php');
include '../../funcs/mcript.php';
$idpostulante = $_GET['idpostulante'];
$idcon = $_GET['idcon'];
$idpersonal = $_GET['idpersonal'];
$dni = $_GET['dni'];
$dato_desencriptado = SED::decryption($dni);

class PDF extends FPDF
{
  // Cabecera de página
  function Header()
  {

    // $this->Image('img/iconodiresa.png',10,8,33);
    $this->Image('../img/logo_diresa.png', 8, 8, 40, 20);
    $this->SetFont('Arial', 'B', 16);
    // Movernos a la derecha
    $this->Cell(70);
    // Título
    $this->Cell(70, 20, 'FICHA DETALLES DEL POSTULANTE', 0, 0, 'C');
    // Salto de línea
    $this->Ln(20);
    // $this->Cell(30,10,'Datos Personales',0,0);
    //$this->Ln(10);
    //$this->Cell(30,10,'Datos Familiares:',0,0);
  }

  // Pie de página
  function Footer()
  {
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial', 'I', 8);
    // Número de página
    $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
  }
}

require '../conexion.php';

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(180, 7, 'DATOS POSTULANTE:', 1, 0, 'L', 0);
$pdf->Ln(7);
$consulta6 = "SELECT * FROM postulante  where idpostulante='$idpostulante'";
$datos6 = mysqli_query($con, $consulta6) or die(mysqli_error($datos6));;
$fila6 = mysqli_fetch_array($datos6);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(140, 7, 'NOMBRE: ' . strtoupper($fila6['nombres'] . ", " . $fila6['ape_pat'] . " " . $fila6['ape_mat']), 1, 0, '', 0);
$pdf->Cell(40, 7, 'DNI:  ' . $fila6['dni'], 1, 0, 'L', 0);

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(180, 7, 'DATOS CONVOCATORIA:', 1, 0, 'L', 0);
$pdf->Ln(7);
$consulta6 = "SELECT * FROM detalle_convocatoria INNER JOIN convocatoria ON detalle_convocatoria.convocatoria_idcon=convocatoria.idcon INNER JOIN personal_req ON detalle_convocatoria.personal_req_idpersonal=personal_req.idpersonal INNER JOIN cargo ON personal_req.cargo_idcargo = cargo.idcargo INNER JOIN ubicacion ON personal_req.personal_req_idubicacion = ubicacion.iddireccion WHERE detalle_convocatoria.convocatoria_idcon='$idcon' AND personal_req_idpersonal='$idpersonal' AND postulante_idpostulante='$idpostulante'";
$datos6 = mysqli_query($con, $consulta6) or die(mysqli_error($datos6));;
$fila6 = mysqli_fetch_array($datos6);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 7, utf8_decode('Nº convocatoria: '), 1, 0, '', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(20, 7, utf8_decode($fila6['num_con'] . " - " . $fila6['anio_con']), 1, 0, '', 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 7, 'Tipo convocatoria:  ', 1, 0, '', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 7, $fila6['tipo_con'], 1, 0, '', 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(15, 7, utf8_decode('Cargo: '), 1, 0, '', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, utf8_decode($fila6['cargo']), 1, 0, '', 0);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(33, 7, utf8_decode('Dirección ejecutora:'), 1, 0, '', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(147, 7, utf8_decode($fila6['direccion_ejec']), 1, 0, '', 0);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(33, 7, 'Equipo ejecutor:', 1, 0, '', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(147, 7, utf8_decode($fila6['equipo_ejec']), 1, 0, '', 0);

$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(180, 7, 'DATOS PROFESIONAL REQUERIDO:', 1, 0, 'L', 0);
$pdf->Ln(7);
$pdf->Cell(30, 7, utf8_decode('Cargo requerido:'), 1, 0, 'C', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(150, 7, utf8_decode($fila6['cargo']), 1, 1, '', 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(180, 7, utf8_decode('Requerimietos mínimos:'), 1, 1, 'C', 0);
$sql6 = "SELECT * FROM requerimientos where reque_id_personal='$idpersonal'";
$datos6 = mysqli_query($con, $sql6) or die(mysqli_error($datos6));;
$fila6 = mysqli_fetch_array($datos6);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 7, 'Tipo profesional:  ', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 10);
if ($fila6['reque_tipo_estudios'] == 1) {
  $pdf->Cell(50, 7, 'SECUNDARIA', 1, 0, 'L', 0);
} elseif ($fila6['reque_tipo_estudios'] == 2) {
  $pdf->Cell(50, 7, 'TECNICO SUPERIOR', 1, 0, 'L', 0);
} else {
  $pdf->Cell(50, 7, 'UNIVERSITARIO', 1, 0, 'L', 0);
}
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 7, 'Nivel estudio:', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 7, $fila6['nivel_estudio'], 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 7, 'Ciclo actual:  ', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 7, $fila6['ciclo_actual'], 1, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 7, 'Colegiatura:  ', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 7, $fila6['colegiatura'], 1, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 7, 'Habilitacion:  ', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(15, 7, $fila6['habilitacion'], 1, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 7, 'Serums:  ', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 7, $fila6['serums'], 1, 0, 'L', 0);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(180, 7, utf8_decode('Requerimietos máximos:'), 1, 0, 'C', 0);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 7, 'Tipo profesional max:  ', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 10);
if ($fila6['reque_tipo_estudios_max'] == 1) {
  $pdf->Cell(50, 7, 'SECUNDARIA', 1, 0, 'L', 0);
} elseif ($fila6['reque_tipo_estudios_max'] == 2) {
  $pdf->Cell(50, 7, 'TECNICO SUPERIOR', 1, 0, 'L', 0);
} else {
  $pdf->Cell(50, 7, 'UNIVERSITARIO', 1, 0, 'L', 0);
}
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 7, 'Nivel estudio max:', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 7, $fila6['nivel_estudio_max'], 1, 0, 'L', 0);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 7, 'Ciclo actual max:  ', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 7, $fila6['ciclo_actual_max'], 1, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 7, 'Colegiatura max:  ', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 7, $fila6['colegiatura_max'], 1, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 7, 'Habilitacion max:  ', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(15, 7, $fila6['habilitacion_max'], 1, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 7, 'Serums max:  ', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 7, $fila6['serums_max'], 1, 0, 'L', 0);

$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(180, 7, 'DATOS PROFESIONAL DEL POSTULANTE:', 1, 0, 'L', 0);
$pdf->Ln(7);
$consul_form = "SELECT * FROM formacion_acad INNER JOIN tipo_estudios ON formacion_acad.tipo_estudios_id = tipo_estudios.id_tipo_estudios WHERE formacion_idpostulante='$idpostulante'";
$resul_form = mysqli_query($con, $consul_form) or die(mysqli_error($resul_form));;
$array_form = mysqli_fetch_array($resul_form);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(35, 7, 'Tipo de estudios:  ', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(40, 7, $array_form['tipo_estudios'], 1, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 7, 'Nivel estudio:  ', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(40, 7, $array_form['nivel_estudios'], 1, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 7, 'Ciclo actual:  ', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(10, 7, $array_form['ciclo_actual'], 1, 0, 'L', 0);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(40, 7, 'Centro de estudios:', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(140, 7, $array_form['centro_estudios'], 1, 0, 'L', 0);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(40, 7, 'Carrera:', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(140, 7, $array_form['carrera'], 1, 0, 'L', 0);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 7, 'Colegiatura', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(10, 7, $array_form['colegiatura'], 1, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(15, 7, utf8_decode('Nº cole.'), 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 7, $array_form['nro_colegiatura'], 1, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 7, 'Fecha cole.', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 7, $array_form['fech_colegiatura'], 1, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 7, 'Fecha habilitacion', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 7, $array_form['fech_habilitacion'], 1, 0, 'L', 0);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 7, 'SERUMS', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(10, 7, $array_form['serums'], 1, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(15, 7, 'Quintil', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 7, $array_form['quintil'], 1, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 7, 'Valor quin.', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 7, $array_form['valor_quintil'], 1, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 7, 'Brevete', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 7, $array_form['brevete'], 1, 0, 'L', 0);

$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(180, 10, utf8_decode('¿La formación academica registrada va acorde a los requerimientos mínimos requeridos?'), 0, 1, 'C', 0);
$pdf->Cell(30, 10, utf8_decode('¿VALIDO?'), 1, 0, 'C', 0);
$pdf->Cell(10, 10, '', 1, 0, 'L', 0);
$pdf->Cell(30, 10, utf8_decode('¿NO VALIDO?'), 1, 0, 'C', 0);
$pdf->Cell(10, 10, '', 1, 0, 'L', 0);
$pdf->Cell(35, 10, 'OBSERVACIONES', 1, 0, 'C', 0);
$pdf->Cell(65, 10, '', 1, 0, 'L', 0);

$pdf->AddPage('L');
$pdf->Ln(15);
$pdf->Cell(280, 10, 'ESTUDIOS POSTGRADO (Maestria - Doctorado - Especialidades):', 1, 0, 'L', 0);
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 8);
// $pdf->Cell(40, 10, 'Centro de Estudios', 1, 0, 'C', 0);
$pdf->Cell(5, 10, utf8_decode('Nº'), 1, 0, 'C', 0);
$pdf->Cell(20, 10, 'Tipo', 1, 0, 'C', 0);
$pdf->Cell(120, 10, 'Nombre de estudios', 1, 0, 'C', 0);
$pdf->Cell(20, 10, 'Fecha Inicio', 1, 0, 'C', 0);
$pdf->Cell(20, 10, 'Fecha Fin', 1, 0, 'C', 0);
$pdf->Cell(20, 10, 'Nivel', 1, 0, 'C', 0);
$pdf->Cell(15, 10, utf8_decode('¿Válido?'), 1, 0, 'C', 0);
$pdf->Cell(60, 10, utf8_decode('Observaciones'), 1, 1, 'C', 0);
$pdf->SetFont('Arial', '', 8);
$consulta = "SELECT * FROM maestria_doc where idpostulante_postulante='$idpostulante'";
$resultado = $con->query($consulta);
$i = 1;
while ($row = $resultado->fetch_assoc()) {
  $pdf->Cell(5, 10, $i, 1, 0, 'C', 0);
  $pdf->Cell(20, 10, $row['tipo_estu'], 1, 0, 'C', 0);
  $pdf->Cell(120, 5, 'Lugar estudio: ' .  utf8_decode($row['centro_estu']), 1, 0, '', 0);
  $pdf->Cell(20, 10, $row['fech_ini'], 1, 0, 'C', 0);
  $pdf->Cell(20, 10, $row['fech_fin'], 1, 0, 'C', 0);
  $pdf->Cell(20, 10, $row['nivel'], 1, 0, 'C', 0);
  $pdf->Cell(15, 10, '', 1, 0, 'C', 0);
  $pdf->Cell(60, 10, '', 1, 0, 'C', 0);
  $pdf->Ln(5);
  $pdf->Cell(5, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(20, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(120, 5, 'Estudio: ' . utf8_decode($row['especialidad']), 1, 0, '', 0);
  $pdf->Cell(20, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(20, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(20, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(15, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(60, 5, '', 0, 1, 'C', 0);
  $i++;
}
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(280, 10, 'CAPACITACIONES (Diplomados - Cursos - Taller):', 1, 0, 'L', 0);
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 8);
// $pdf->Cell(35, 10, 'Centro de Estudios', 1, 0, 'C', 0);
$pdf->Cell(5, 10, utf8_decode('Nº'), 1, 0, 'C', 0);
$pdf->Cell(150, 10, 'Datos del curso', 1, 0, 'C', 0);
$pdf->Cell(20, 10, 'Tipo', 1, 0, 'C', 0);
$pdf->Cell(10, 10, 'Horas', 1, 0, 'C', 0);
$pdf->Cell(20, 10, 'Fecha Inicio', 1, 0, 'C', 0);
$pdf->Cell(20, 10, 'Fecha Fin', 1, 0, 'C', 0);
$pdf->Cell(15, 10, utf8_decode('¿Válido?'), 1, 0, 'C', 0);
$pdf->Cell(40, 10, utf8_decode('Observaciones'), 1, 1, 'C', 0);
$consulta = "SELECT * FROM cursos_extra WHERE curso_extra_idpostulante = $idpostulante";
$resultado = $con->query($consulta);
$i = 1;
while ($row = $resultado->fetch_assoc()) {
  $pdf->SetFont('Arial', '', 8);
  $pdf->Cell(5, 10, $i, 1, 0, 'C', 0);
  $pdf->Cell(150, 5, 'Centro de estudios: ' . $row['centro_estu'], 1, 0, '', 0);
  $pdf->Cell(20, 10, $row['tipo'], 1, 0, 'C', 0);
  $pdf->Cell(10, 10, $row['horas'], 1, 0, 'C', 0);
  $pdf->Cell(20, 10, $row['fech_ini'], 1, 0, 'C', 0);
  $pdf->Cell(20, 10, $row['fech_fin'], 1, 0, 'C', 0);
  $pdf->Cell(15, 10, '', 1, 0, 'C', 0);
  $pdf->Cell(40, 10, '', 1, 0, 'C', 0);
  $pdf->Ln(5);
  $pdf->Cell(5, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(150, 5, 'Materia: ' . $row['materia'], 1, 0, '', 0);
  $pdf->Cell(20, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(10, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(20, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(20, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(15, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(40, 5, '', 0, 1, 'C', 0);
  $i++;
}

$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(250, 10, 'CURSOS DE IDIOMA O COMPUTACION (OFIMATICA):', 1, 0, 'L', 0);
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(5, 10, utf8_decode('Nº'), 1, 0, 'C', 0);
$pdf->Cell(70, 10, 'Idioma - Computo', 1, 0, 'C', 0);
$pdf->Cell(70, 10, 'Lugar de estudio', 1, 0, 'C', 0);
$pdf->Cell(30, 10, 'Nivel', 1, 0, 'C', 0);
$pdf->Cell(15, 10, utf8_decode('¿Válido?'), 1, 0, 'C', 0);
$pdf->Cell(60, 10, utf8_decode('Observaciones'), 1, 1, 'C', 0);
$consulta = "SELECT * FROM idiomas_comp WHERE idpostulante_postulante = '$idpostulante'";
$resultado = $con->query($consulta);
$i = 1;
while ($row = $resultado->fetch_assoc()) {
  $pdf->SetFont('Arial', '', 8);
  $pdf->Cell(5, 10, $i, 1, 0, 'C', 0);
  $pdf->Cell(70, 10, $row['idioma_comp'], 1, 0, '', 0);
  $pdf->Cell(70, 10, $row['lugar_estudio'], 1, 0, '', 0);
  $pdf->Cell(30, 10, $row['nivel'], 1, 0, 'C', 0);
  $pdf->Cell(15, 10, utf8_decode(''), 1, 0, 'C', 0);
  $pdf->Cell(60, 10, utf8_decode(''), 1, 1, 'C', 0);
  $i++;
}

$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(277, 10, 'EXPERIENCIA LABORAL DEL POSTULANTE (De la mas antigua a la actual):', 1, 0, 'L', 0);
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(5, 10, utf8_decode('Nº'), 1, 0, 'C', 0);
$pdf->Cell(120, 10, 'Institucion/Empresa', 1, 0, 'C', 0);
$pdf->Cell(20, 10, 'Fecha Inicio', 1, 0, 'C', 0);
$pdf->Cell(20, 10, 'Fecha Fin', 1, 0, 'C', 0);
$pdf->Cell(10, 10, utf8_decode('Años'), 1, 0, 'C', 0);
$pdf->Cell(12, 10, utf8_decode('Meses'), 1, 0, 'C', 0);
$pdf->Cell(10, 10, utf8_decode('Días'), 1, 0, 'C', 0);
$pdf->Cell(25, 10, utf8_decode('Tipo comprobante'), 1, 0, 'C', 0);
$pdf->Cell(15, 10, utf8_decode('¿Válido?'), 1, 0, 'C', 0);
$pdf->Cell(40, 10, utf8_decode('Observaciones'), 1, 1, 'C', 0);
$consulta = "SELECT * FROM expe_4puntos inner join lugar_trabajo_gene ON expe_4puntos.lugar_trab_general = lugar_trabajo_gene.idlugar_trabajo_gene WHERE expe_puntos_idpostulante = '$idpostulante'";
$resultado = $con->query($consulta);
$i = 1;
while ($row = $resultado->fetch_assoc()) {
  $pdf->SetFont('Arial', '', 8);
  $pdf->Cell(5, 15, $i, 1, 0, 'C', 0);
  $pdf->Cell(120, 5, 'Nomb. general: ' .  $row['nombre_general'], 1, 0, '', 0);
  $pdf->Cell(20, 15, $row['fecha_inicio'], 1, 0, 'C', 0);
  $pdf->Cell(20, 15, $row['fecha_fin'], 1, 0, 'C', 0);
  $pdf->Cell(10, 15, $row['anios'], 1, 0, 'C', 0);
  $pdf->Cell(12, 15, $row['meses'], 1, 0, 'C', 0);
  $pdf->Cell(10, 15, $row['dias'], 1, 0, 'C', 0);
  $pdf->Cell(25, 15, $row['tipo_comprobante'], 1, 0, 'C', 0);
  $pdf->Cell(15, 15, utf8_decode(''), 1, 0, 'C', 0);
  $pdf->Cell(40, 15, utf8_decode(''), 1, 0, 'C', 0);
  $pdf->Ln(5);
  $pdf->Cell(5, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(120, 5, 'Nomb. especifico: ' . $row['lugar_especifico'], 1, 0, '', 0);
  $pdf->Cell(20, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(20, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(10, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(12, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(10, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(25, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(15, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(40, 5, utf8_decode(''), 0, 0, 'C', 0);
  $pdf->Ln(5);
  $pdf->Cell(5, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(120, 5, 'Cargo: ' . utf8_decode($row['cargo']), 1, 0, '', 0);
  $pdf->Cell(20, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(20, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(10, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(12, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(10, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(25, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(15, 5, '', 0, 0, 'C', 0);
  $pdf->Cell(40, 5, utf8_decode(''), 0, 1, 'C', 0);
  $i++;
}

$pdf->Output();
