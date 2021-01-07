<?php
include '../conexion.php';
require('fpdf/fpdf.php');
date_default_timezone_set('America/Lima');
$date = date('Y-m-d');
$anio = date('Y');


$namejurado1 = 'Med. RENAN ALEJANDRO NEIRA ZEGARRA';
$cargojurado1 = 'Pdte. Comisión Concurso de Provisión y Ascensos';
$namejurado2 = 'CPC.LUIS ALBERTO NUÑEZ PAUCA';
$cargojurado2 = 'Director Ejecutivo de Administración';
$namejurado3 = 'Abog. ELBA DEL CARMEN PIMENTEL JAVIER';
$cargojurado3 = 'Directora Ejecutiva de Gestión y Desarrollo de RR.HH.';

class PDF extends FPDF
{
  //Cabecera de página
  function Header()
  {
    $this->SetFont('Arial', 'B', 8); //idetificar el tipo de letro, fuete, tipo de fuente, tamaño
    $this->Image('logo.png', 10, 6, 28, 17, 'PNG'); //traer una imagen 10=x,13=y
    $this->Cell(170, 4, utf8_decode("DIRECCION REGIONAL DE SALUD TACNA"), 0, 0, 'C');
    $this->Ln(4); //salto de linea
    $this->Cell(170, 4, utf8_decode("DIREC. EJEC. DE GESTIÓN Y DESARROLLO DE RECURSOS HUMANOS"), 0, 0, 'C');
    $this->Ln(10); //salto de linea

  }
}
//CONSULTA
// $idpostulante = $_GET['idpostulante'];
$idpracticas = $_GET['idpracticas'];
$idpracticantes_req = $_GET['idpracticantes_req'];
$consulta = mysqli_query($con, "SELECT * FROM sistema_seleccion.detalle_conv_prac INNER JOIN sistema_seleccion.practicas 
ON detalle_conv_prac.idpracticas_conv = practicas.idpracticas 
INNER JOIN sistema_seleccion.practicantes_req ON detalle_conv_prac.practicantel_req_idpracticantes_req = practicantes_req.idpracticantes_req INNER JOIN ubicacion ON practicantes_req.practicantes_req_idubicacion = ubicacion.iddireccion
WHERE detalle_conv_prac.idpracticas_conv ='$idpracticas' AND practicantel_req_idpracticantes_req='$idpracticantes_req' AND estado_conv_prac ='APTO'");
$arr = mysqli_fetch_array($consulta);
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 11); //b=negrita, 11 tamaño
$pdf->Cell(190, 10, 'RESULTADOS DE LA CONVOCATORIA DE MADALIDADES FORMATIVAS DE', 0, 0, 'C');
$pdf->Ln(5); //salto de linea
$pdf->Cell(190, 10, ' SERVICIOS: PRACTICAS - ' . ' ' . $anio, 0, 0, 'C');
$pdf->Ln(15); //SALTO DE LINEA
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 10, utf8_decode("RESULTADO FINAL"), 0, 0, 'C');
$pdf->Ln(1);
$pdf->Cell(190, 10, utf8_decode("_________________"), 0, 0, 'C');
$pdf->Ln(15);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(190, 6, utf8_decode("UBICACION:" . ' ' . $arr['direccion_ejec']), 1, 0, '');
$pdf->Ln(6);
$pdf->Cell(95, 6, utf8_decode("CARRERA REQUERIDA:" . ' ' . $arr['carrera_prof']), 1, 0, '');
$pdf->Cell(95, 6, utf8_decode("TIPO PRACTICANTE:" . ' ' . $arr['tipo_practicante']), 1, 0, '');
$pdf->Ln(6);
$pdf->Cell(5, 6, utf8_decode("N°"), 1, 0, 'C');
$pdf->Cell(85, 6, utf8_decode("APELLIDOS Y NOMBRES"), 1, 0, 'C');
$pdf->Cell(30, 6, utf8_decode("ORDEN MERITO"), 1, 0, 'C');
$pdf->Cell(25, 6, utf8_decode("ESTADO"), 1, 0, 'C');
$pdf->Cell(45, 6, utf8_decode("OBSERVACIONES"), 1, 0, 'C');
$pdf->Ln(6);
$pdf->SetFont('Arial', '', 9);
$consulta_2 = mysqli_query($con, "SELECT * FROM sistema_seleccion.detalle_conv_prac INNER JOIN sistema_seleccion.practicas 
ON detalle_conv_prac.idpracticas_conv = practicas.idpracticas 
INNER JOIN sistema_seleccion.practicantes_req ON detalle_conv_prac.practicantel_req_idpracticantes_req = practicantes_req.idpracticantes_req INNER JOIN ubicacion ON practicantes_req.practicantes_req_idubicacion = ubicacion.iddireccion INNER JOIN postulante ON detalle_conv_prac.detalle_prac_idpostulante = postulante.idpostulante 
WHERE detalle_conv_prac.idpracticas_conv ='$idpracticas' AND practicantel_req_idpracticantes_req='$idpracticantes_req' AND estado_conv_prac ='APTO'");
$item = 0;
while ($ar = mysqli_fetch_array($consulta_2)) {
  $item = $item + 1;
  $pdf->Cell(5, 6, $item, 1, 0, 'C');
  $pdf->Cell(85, 6, strtoupper($ar['ape_pat'] . ' ' . $ar['ape_mat'] . ', ' . $ar['nombres']), 1, 0, 'C');
  $pdf->Cell(30, 6, utf8_decode($ar['puntaje_total_total']), 1, 0, 'C');
  $pdf->Cell(25, 6, utf8_decode($ar['estado_conv_prac']), 1, 0, 'C');
  $pdf->Cell(45, 6, utf8_decode($ar['observaciones_detalle_prac']), 1, 0, 'C');
  $pdf->Ln(6);
}

$pdf->Cell(180, 10, 'TACNA, ' . date('d-m-y') . '', 0, 0, 'R');
$pdf->Ln(15); //salto de linea


$pdf->Output();
