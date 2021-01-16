<?php
include '../conexion.php';
require('fpdf/fpdf.php');

date_default_timezone_set('America/Lima');
$date = date('Y-m-d');

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
    $this->Ln(10); //salto de linea

  }
}
//CONSULTA
$idpostulante = $_GET['idpostulante'];
$practicas_idcon = $_GET['practicas_idcon'];
$practicante_req = $_GET['practicante_req'];
$consulta = mysqli_query($con, "SELECT * FROM detalle_conv_prac INNER JOIN postulante ON detalle_conv_prac.detalle_prac_idpostulante = postulante.idpostulante INNER JOIN practicas ON detalle_conv_prac.idpracticas_conv = practicas.idpracticas INNER JOIN practicantes_req ON detalle_conv_prac.practicantel_req_idpracticantes_req=practicantes_req.idpracticantes_req WHERE idpracticas_conv='$practicas_idcon' AND detalle_prac_idpostulante='$idpostulante' AND practicantel_req_idpracticantes_req ='$practicante_req'");
$arr = mysqli_fetch_array($consulta);
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(190, 10, utf8_decode('CONCURSO PÚBLICO: MODALIDAD FORMATIVA DE SERVICIOS Nº' . ' ' . $arr['num_convoc'] . ' - ' . $arr['anio_convoc']), 0, 0, 'C');
$pdf->Ln(8);
$pdf->Cell(190, 10, utf8_decode("(Decreto Legislativo N° 1401 Y Decreto Supremo Nº 083-2019-PCM)"), 0, 0, 'C');
$pdf->Ln(12);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 10, utf8_decode("FICHA DE EVALUACIÓN DE ENTREVISTA PERSONAL"), 0, 0, 'C');
$pdf->Ln(1);
$pdf->Cell(190, 10, '______________________________________________', 0, 0, 'C');
$pdf->Ln(10);
// $datos = mysqli_query($conexion,$consulta1);
$pdf->Cell(60, 8, 'APELLIDOS Y NOMBRES	:', 0, 0, '');
$pdf->Cell(130, 8, strtoupper($arr['ape_pat'] . ' ' . $arr['ape_mat'] . ', ' . $arr['nombres']), 0, 0, '');
$pdf->Ln(6);
$pdf->Cell(60, 8, 'PRACTICAS	:', 0, 0, '');
$pdf->Cell(130, 8, $arr['tipo_practicante'], 0, 0, '');
$pdf->Ln(6);
$pdf->Cell(60, 8, 'DEPENDENCIA			:', 0, 0, '');
$pdf->Cell(130, 8, 'DIRESA - UE400', 0, 0, '');
$pdf->Ln(6);
$pdf->Cell(60, 8, 'CONVOCATORIA			:', 0, 0, '');
$pdf->Cell(130, 8, $arr['num_convoc'] . ' - ' . $arr['anio_convoc'], 0, 0, '');
$pdf->Ln(12);

//CONSULTA
$datos = mysqli_query($con, "SELECT * FROM detalle_conv_prac INNER JOIN entrevista_prac ON detalle_conv_prac.detalle_conv_prac_identrevista_prac = entrevista_prac.id_entrevista_prac WHERE idpracticas_conv='$practicas_idcon' AND detalle_prac_idpostulante='$idpostulante' AND practicantel_req_idpracticantes_req ='$practicante_req'");
$array = mysqli_fetch_array($datos);
$aspecto_personal = $array['aspecto_personal'];
$seguridad_estabilidad = $array['seguridad_estabilidad'];
$etica = $array['etica'];
$competencias = $array['competencias'];
$conoc_academico = $array['conoc_academico'];
$puntaje_total_entre = $array['puntaje_total_entre'];
//TABLA DE PUNTAJES
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(150, 8, 'PUNTAJE MAXIMO', 1, 0, '');
$pdf->Cell(40, 8, '(100) CIEN PUNTOS', 1, 0, 'C');
$pdf->Ln(8);
$pdf->Cell(150, 8, utf8_decode("FACTORES DE EVALUACIÓN"), 1, 0, 'C');
$pdf->Cell(40, 8, 'TOTAL', 1, 0, 'C');
$pdf->Ln(8);
$pdf->Cell(150, 8, utf8_decode("1.- ASPECTO PERSONAL:"), 'L,T,R', 0, '');
$pdf->Cell(40, 16, $aspecto_personal, 1, 0, 'C');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(150, 8, utf8_decode("    Mide la presencia, la naturalidad en el vestir, higiene y la limpieza."), 'L,R,B', 0, '');
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(150, 8, utf8_decode("2.- SEGURIDAD Y ESTABILIDAD EMOCIONAL:"), 'L,T,R', 0, '');
$pdf->Cell(40, 20, $seguridad_estabilidad, 1, 0, 'C');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(150, 6, utf8_decode("    Mide el grado de seguridad y serenidad del postulante para expresar sus ideas,"), 'L,R', 0, '');
$pdf->Ln(6);
$pdf->Cell(150, 6, utf8_decode("    aplomo para adaptarse a determinadas circunstancias."), 'L,R,B', 0, '');
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(150, 8, utf8_decode("3.- ETICA:"), 'L,T,R', 0, '');
$pdf->Cell(40, 20, $etica, 1, 0, 'C');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(150, 6, utf8_decode("    Establecer los valores y normas de condcto que debnregir y"), 'L,R', 0, '');
$pdf->Ln(6);
$pdf->Cell(150, 6, utf8_decode("    orientar la conducta de toda persona."), 'L,R,B', 0, '');
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(150, 8, utf8_decode("4.- COMPETENCIAS:"), 'L,T,R', 0, '');
$pdf->Cell(40, 20, $competencias, 1, 0, 'C');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(150, 6, utf8_decode("   Habilidades, capacidades y conocimientos que la persona tiene para"), 'L,R', 0, '');
$pdf->Ln(6);
$pdf->Cell(150, 6, utf8_decode("   cumplir eficientemente determinada tarea. "), 'L,R,B', 0, '');
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(150, 8, utf8_decode("5.- CONOCIMIENTO ACADÉMICO Y CULTURAL GENERAL:"), 'L,T,R', 0, '');
$pdf->Cell(40, 20, $conoc_academico, 1, 0, 'C');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(150, 6, utf8_decode("    Es el conjunto de información acumulada mediante el aprendizaje"), 'L,R', 0, '');
$pdf->Ln(6);
$pdf->Cell(150, 6, utf8_decode("    académica."), 'L,R,B', 0, '');
//FIN TABLA

$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(12);
$pdf->Cell(150, 8, utf8_decode("TOTAL"), 0, 0, 'R');
$pdf->Cell(40, 8, $puntaje_total_entre, 0, 0, 'C');
$pdf->Ln(2);
$pdf->Cell(150, 8, '', 0, 0, 'R');
$pdf->Cell(40, 8, '______________', 0, 0, 'C');


$pdf->SetFont('Arial', '', 11);
$pdf->Ln(16);
$pdf->Cell(190, 8, utf8_decode("Tacna, " . ' ' . $date), 0, 0, 'R');


$pdf->Output();
