<?php
include '../conexion.php';
require('fpdf/fpdf.php');
date_default_timezone_set('America/Lima');
$date = date('Y-m-d');


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
    $this->Cell(290, 4, utf8_decode("DIRECCION REGIONAL DE SALUD TACNA"), 0, 0, 'C');
    $this->Ln(4); //salto de linea
    $this->Cell(290, 4, utf8_decode("DIREC. EJEC. DE GESTIÓN Y DESARROLLO DE RECURSOS HUMANOS"), 0, 0, 'C');
    $this->Ln(10); //salto de linea

  }
}
//CONSULTA
// $idpostulante = $_GET['idpostulante'];
$idcon = $_GET['idcon'];
$idpersonal = $_GET['idpersonal'];
$consulta = mysqli_query($con, "SELECT * FROM sistema_seleccion.detalle_convocatoria INNER JOIN sistema_seleccion.convocatoria 
ON detalle_convocatoria.convocatoria_idcon = convocatoria.idcon 
INNER JOIN sistema_seleccion.personal_req ON detalle_convocatoria.personal_req_idpersonal = personal_req.idpersonal INNER JOIN cargo_full ON personal_req.cargo_idcargo = cargo_full.idcargo INNER JOIN ubicacion ON personal_req.personal_req_idubicacion = ubicacion.iddireccion
WHERE detalle_convocatoria.convocatoria_idcon ='$idcon' AND personal_req_idpersonal = '$idpersonal' AND estado_conv_cas ='APTO'");
$arr = mysqli_fetch_array($consulta);
$porcen_eva_cu = $arr['porcen_eva_cu'];
$porce_entrevista = $arr['porce_entrevista'];
$pdf = new PDF();
$pdf->AddPage('L');
$pdf->SetFont('Arial', 'B', 11); //b=negrita, 11 tamaño
$pdf->Cell(290, 10, 'CONTRATOS ADMINISTRATIVOS DE SERVICIOS - CAS', 0, 0, 'C');
$pdf->Ln(1); //salto de linea
$pdf->Cell(290, 10, '_______________________________________________', 0, 0, 'C');
$pdf->Ln(5); //SALTO DE LINEA
$pdf->Cell(290, 10, utf8_decode("CONVOCATORIA N° " . '' . $arr['num_con'] . ' - ' . $arr['anio_con']), 0, 0, 'C');
$pdf->Ln(1); //salto de linea
$pdf->Cell(290, 10, '_________________________', 0, 0, 'C');
$pdf->Ln(10); //SALTO DE LINEA
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(290, 10, utf8_decode("RESULTADO FINAL"), 0, 0, 'C');
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 5, utf8_decode("CARGO:"), 0, 0, '');
$pdf->Cell(100, 5, utf8_decode($arr['cargo']), 0, 0, '');
$pdf->Ln(5);
$pdf->Cell(30, 5, utf8_decode("UBICACIÓN:"), 0, 0, '');
$pdf->Cell(100, 5, utf8_decode($arr['direccion_ejec']), 0, 0, '');
$pdf->Ln(5);
$pdf->Cell(30, 5, utf8_decode(""), 0, 0, '');
$pdf->Cell(100, 5, utf8_decode($arr['equipo_ejec']), 0, 0, '');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(5, 12, utf8_decode("N°"), 'L,T,R', 0, 'C');
$pdf->Cell(65, 12, utf8_decode("APELLIDOS Y NOMBRES"), 'L,T,R', 0, 'C');
$pdf->Cell(18, 4, utf8_decode("PUNTAJE"), 'L,T,R', 0, 'C');
$pdf->Cell(18, 8, utf8_decode("PONDERADO"), 'L,T,R', 0, 'C');
$pdf->Cell(18, 4, utf8_decode("ENTREVISTA"), 'L,T,R', 0, 'C');
$pdf->Cell(18, 8, utf8_decode("PONDERADO"), 'L,T,R', 0, 'C');
$pdf->Cell(13, 4, utf8_decode("TOTAL"), 'L,T,R', 0, 'C');
$pdf->Cell(11, 4, utf8_decode("QUIN"), 'L,T,R', 0, 'C');
$pdf->Cell(11, 4, utf8_decode("%"), 'L,T,R', 0, 'C');
$pdf->Cell(11, 4, utf8_decode("VALOR"), 'L,T,R', 0, 'C');
$pdf->Cell(14, 4, utf8_decode("TOTAL"), 'L,T,R', 0, 'C');
$pdf->Cell(19, 12, utf8_decode("DISCAPACIDAD"), 'L,T,R', 0, 'C');
$pdf->Cell(18, 4, utf8_decode("SERVICIO"), 'L,T,R', 0, 'C');
$pdf->Cell(18, 4, utf8_decode("DEPORTISTA"), 'L,T,R', 0, 'C');
$pdf->Cell(18, 4, utf8_decode("PUNTAJE"), 'L,T,R', 0, 'C');
$pdf->Ln(4);
$pdf->Cell(5, 4, utf8_decode(""), 'L,R', 0, 'C');
$pdf->Cell(65, 4, utf8_decode(""), 'L,R', 0, 'C');
$pdf->Cell(18, 4, utf8_decode("CURRICULAR"), 'L,R', 0, 'C');
$pdf->Cell(18, 4, utf8_decode(""), 'L,R', 0, 'C');
$pdf->Cell(18, 4, utf8_decode("PERSONAL"), 'L,R', 0, 'C');
$pdf->Cell(18, 4, utf8_decode(""), 'L,R', 0, 'C');
$pdf->Cell(13, 4, utf8_decode("PUNTAJE"), 'L,R', 0, 'C');
$pdf->Cell(11, 4, utf8_decode("TIL"), 'L,R', 0, 'C');
$pdf->Cell(11, 4, utf8_decode("QUIN"), 'L,R', 0, 'C');
$pdf->Cell(11, 4, utf8_decode("QUINTIL"), 'L,R', 0, 'C');
$pdf->Cell(14, 4, utf8_decode("PUNTAJE"), 'L,R', 0, 'C');
$pdf->Cell(19, 4, utf8_decode(""), 'L,R', 0, 'C');
$pdf->Cell(18, 4, utf8_decode("MILITAR"), 'L,R', 0, 'C');
$pdf->Cell(18, 4, utf8_decode("CALIFICADO"), 'L,R', 0, 'C');
$pdf->Cell(18, 4, utf8_decode("FINAL"), 'L,R', 0, 'C');
$pdf->Ln(4);
$pdf->Cell(5, 4, utf8_decode(""), 'L,R,B', 0, 'C');
$pdf->Cell(65, 4, utf8_decode(""), 'L,R,B', 0, 'C');
$pdf->Cell(18, 4, utf8_decode(""), 'L,B,R', 0, 'C');
$pdf->Cell(18, 4, utf8_decode("($porcen_eva_cu%)"), 'L,B,R', 0, 'C');
$pdf->Cell(18, 4, utf8_decode(""), 'L,B,R', 0, 'C');
$pdf->Cell(18, 4, utf8_decode("($porce_entrevista%)"), 'L,B,R', 0, 'C');
$pdf->Cell(13, 4, utf8_decode("(1)"), 'L,B,R', 0, 'C');
$pdf->Cell(11, 4, utf8_decode(""), 'L,B,R', 0, 'C');
$pdf->Cell(11, 4, utf8_decode("TIL"), 'L,B,R', 0, 'C');
$pdf->Cell(11, 4, utf8_decode("(2)"), 'L,B,R', 0, 'C');
$pdf->Cell(14, 4, utf8_decode("2 (1+2)"), 'L,B,R', 0, 'C');
$pdf->Cell(19, 4, utf8_decode("(15%) 3"), 'L,B,R', 0, 'C');
$pdf->Cell(18, 4, utf8_decode("(10%) 4"), 'L,B,R', 0, 'C');
$pdf->Cell(18, 4, utf8_decode("(n%) 5"), 'L,B,R', 0, 'C');
$pdf->Cell(18, 4, utf8_decode("(2+3+4+5)"), 'L,B,R', 0, 'C');
$pdf->Ln(4); //salto de linea
$pdf->SetFont('Arial', '', 8);
//CONSULTA
$consulta = mysqli_query($con, "SELECT * FROM sistema_seleccion.detalle_convocatoria INNER JOIN sistema_seleccion.resultado_final 
ON detalle_convocatoria.id_resultado_final = resultado_final.idresultado_final INNER JOIN postulante ON detalle_convocatoria.postulante_idpostulante = postulante.idpostulante
WHERE detalle_convocatoria.convocatoria_idcon ='$idcon' AND personal_req_idpersonal = '$idpersonal' AND estado_conv_cas ='APTO'");
$item = 0;
while ($arr = mysqli_fetch_array($consulta)) {
  $item = $item + 1;
  $pdf->Cell(5, 6, $item, 1, 0, 'C');
  $pdf->Cell(65, 6, strtoupper($arr['ape_pat'] . ' ' . $arr['ape_mat'] . ', ' . $arr['nombres']), 1, 0, 'C');
  $pdf->Cell(18, 6, utf8_decode($arr['puntaje_cv']), 1, 0, 'C');
  $pdf->Cell(18, 6, utf8_decode($arr['ponderado_cv']), 1, 0, 'C');
  $pdf->Cell(18, 6, utf8_decode($arr['puntaje_entre']), 1, 0, 'C');
  $pdf->Cell(18, 6, utf8_decode($arr['ponderado_entre']), 1, 0, 'C');
  $pdf->Cell(13, 6, utf8_decode($arr['total_puntaje_1']), 1, 0, 'C');
  $pdf->Cell(11, 6, utf8_decode($arr['quintil_resul']), 1, 0, 'C');
  $pdf->Cell(11, 6, utf8_decode($arr['quintil_porcen']), 1, 0, 'C');
  $pdf->Cell(11, 6, utf8_decode($arr['valor_quintil']), 1, 0, 'C');
  $pdf->Cell(14, 6, utf8_decode($arr['puntaje_total_quintil']), 1, 0, 'C');
  $pdf->Cell(19, 6, utf8_decode($arr['discapacidad_puntaje']), 1, 0, 'C');
  $pdf->Cell(18, 6, utf8_decode($arr['servicio_mili']), 1, 0, 'C');
  $pdf->Cell(18, 6, utf8_decode($arr['deportista_calif']), 1, 0, 'C');
  $pdf->Cell(18, 6, utf8_decode($arr['puntaje_final_total']), 1, 0, 'C');
  $pdf->Ln(6);
}

$pdf->Cell(280, 10, 'TACNA, ' . date('d-m-y') . '', 0, 0, 'R');
$pdf->Ln(15); //salto de linea

//FIRMAS

$pdf->Cell(290, 4, utf8_decode("________________________________________"), 0, 0, 'C');
$pdf->Ln(4); //salto de linea
$pdf->Cell(290, 4, utf8_decode("$namejurado1"), 0, 0, 'C');
$pdf->Ln(4); //salto de linea
$pdf->Cell(290, 4, utf8_decode("$cargojurado1"), 0, 0, 'C');
$pdf->Ln(4); //salto de linea
$pdf->Cell(290, 4, utf8_decode("DIRESA TACNA"), 0, 0, 'C');

$pdf->Ln(20); //salto $pdf->Ln(4);//salto de lineade linea
$pdf->Cell(145, 4, utf8_decode("________________________________________"), 0, 0, 'C');
$pdf->Cell(145, 4, utf8_decode("________________________________________"), 0, 0, 'C');
$pdf->Ln(4); //salto de line
$pdf->Cell(145, 4, utf8_decode("$namejurado2"), 0, 0, 'C');
$pdf->Cell(145, 4, utf8_decode("$namejurado3"), 0, 0, 'C');
$pdf->Ln(4); //salto de linea
$pdf->Cell(145, 4, utf8_decode("$cargojurado2"), 0, 0, 'C');
$pdf->Cell(145, 4, utf8_decode("$cargojurado3"), 0, 0, 'C');
$pdf->Ln(4); //salto de linea
$pdf->Cell(145, 4, utf8_decode("Miembro"), 0, 0, 'C');
$pdf->Cell(145, 4, utf8_decode("Secretaria"), 0, 0, 'C');
$pdf->Ln(4); //salto de linea

$pdf->Output();
