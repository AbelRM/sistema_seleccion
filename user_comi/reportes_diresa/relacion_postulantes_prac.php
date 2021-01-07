<?php
include '../conexion.php';
require('fpdf/fpdf.php');

$n_convo = 'valor';
$año_actual = '2019';
$cargo = 'Especialidad que está postulando';
$ubicacion = 'Direccion ejecutiva nivel 1';

class PDF extends FPDF
{
  //Cabecera de página
  function Header()
  {
    $this->SetFont('Arial', 'B', 8); //idetificar el tipo de letro, fuete, tipo de fuente, tamaño
    $this->Image('logo.png', 10, 6, 23, 14, 'PNG'); //traer una imagen 10=x,13=y
    $this->Cell(20, 6, '', 0); //nos crea las celdas donde colocas la info:largo,ancho, ,bordes
    $this->Cell(150, 4, utf8_decode("DIRECCION REGIONAL DE SALUD TACNA"), 0, 0, 'C');
    $this->Ln(4); //salto de linea
    $this->Cell(20, 6, '', 0);
    $this->Cell(150, 4, utf8_decode("DIREC. EJEC. DE GESTIÓN Y DESARROLLO DE RECURSOS HUMANOS"), 0, 0, 'C');
    $this->Ln(4); //salto de linea
    $this->Cell(20, 6, '', 0);
    $this->Cell(150, 4, utf8_decode("EQUIPO DE TRABAJO DE DESARROLLO DE RECURSOS HUMANOS"), 0, 0, 'C');
    $this->Ln(10); //salto de linea

  }
}
$idpracticas = $_GET['idpracticas'];
$idpracticantes_req = $_GET['idpracticantes_req'];
$consulta = mysqli_query($con, "SELECT * FROM detalle_conv_prac INNER JOIN practicas 
ON detalle_conv_prac.idpracticas_conv = practicas.idpracticas 
INNER JOIN practicantes_req ON detalle_conv_prac.practicantel_req_idpracticantes_req = practicantes_req.idpracticantes_req INNER JOIN ubicacion ON practicantes_req.practicantes_req_idubicacion = ubicacion.iddireccion
WHERE detalle_conv_prac.idpracticas_conv ='$idpracticas' AND practicantel_req_idpracticantes_req = '$idpracticantes_req'");
$arr = mysqli_fetch_array($consulta);
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 11); //b=negrita, 11 tamaño
$pdf->Cell(190, 10, utf8_decode('CONVOCATORIA DE MODALIDAD FORMATIVA Nº' . ' ' . $arr['num_convoc'] . ' - ' . $arr['anio_convoc']), 0, 0, 'C');
$pdf->Ln(1); //salto de linea
$pdf->Cell(190, 10, '___________________________________________________', 0, 0, 'C');
$pdf->Ln(12); //SALTO DE LINEA
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(190, 10, utf8_decode("RELACIÓN DE POSTULANTES"), 0, 0, 'C');
$pdf->Ln(10);
$pdf->Cell(50, 5, utf8_decode("TIPO DE PRACTICA:"), 0, 0, '');
$pdf->Cell(100, 5, utf8_decode($arr['tipo_practicante']), 0, 0, '');
$pdf->Ln(5);
$pdf->Cell(50, 5, utf8_decode("CARRERA REQUERIDA:"), 0, 0, '');
$pdf->Cell(100, 5, utf8_decode($arr['carrera_prof']), 0, 0, '');
$pdf->Ln(5);
$pdf->Cell(50, 5, utf8_decode("UBICACION"), 0, 0, '');
$pdf->Cell(100, 5, utf8_decode($arr['direccion_ejec']), 0, 0, '');
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 8, utf8_decode("N°"), 1, 0, 'C');
$pdf->Cell(95, 8, 'APELLIDOS Y NOMBRES', 1, 0, 'C');
$pdf->Cell(35, 8, 'D.N.I.', 1, 0, 'C');
$pdf->Cell(35, 8, utf8_decode("TELÉFONO"), 1, 0, 'C');
$pdf->Ln(8); //salto de linea
$pdf->SetFont('Arial', '', 8);

//CONSULTA
$consulta = mysqli_query($con, "SELECT * FROM detalle_conv_prac INNER JOIN postulante 
ON detalle_conv_prac.detalle_prac_idpostulante = postulante.idpostulante 
WHERE detalle_conv_prac.idpracticas_conv ='$idpracticas' AND practicantel_req_idpracticantes_req = '$idpracticantes_req'");

$item = 0;
while ($arr = mysqli_fetch_array($consulta)) {
  $item = $item + 1;
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(10, 8, $item, 1, 0, 'C');
  $pdf->Cell(95, 8, strtoupper($arr['ape_pat'] . ' ' . $arr['ape_mat'] . ', ' . $arr['nombres']), 1, 0, 'C');
  $pdf->Cell(35, 8, $arr['dni'], 1, 0, 'C');
  $pdf->Cell(35, 8, $arr['celular'], 1, 0, 'C');
  $pdf->Ln(8); //salto de linea
  $pdf->SetFont('Arial', '', 8);
}

$pdf->Cell(175, 10, 'TACNA, ' . date('d-m-y') . '', 0, 0, 'R');
$pdf->Ln(15); //salto de linea


$pdf->Output();
