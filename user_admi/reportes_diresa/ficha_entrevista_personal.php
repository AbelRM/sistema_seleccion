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
$idcon = $_GET['idcon'];
$idpersonal = $_GET['idpersonal'];
$consulta = mysqli_query($con, "SELECT * FROM postulante INNER JOIN convocatoria ON postulante.id_convocatoria = convocatoria.idcon INNER JOIN personal_req ON personal_req.convocatoria_idcon = convocatoria.idcon INNER JOIN cargo_full ON personal_req.cargo_idcargo = cargo_full.idcargo INNER JOIN ubicacion ON personal_req.personal_req_idubicacion = ubicacion.iddireccion WHERE idpostulante='$idpostulante'");
$arr = mysqli_fetch_array($consulta);
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(190, 10, 'CONTRATO ADMINISTRATIVO DE SERVICIOS - CAS', 0, 0, 'C');
$pdf->Ln(8);
$pdf->Cell(190, 10, utf8_decode("(Decreto Legislativo N° 1057; Decreto Supremo N° 075-2008-PCM)"), 0, 0, 'C');
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
$pdf->Cell(60, 8, 'CARGO AL QUE POSTULA	:', 0, 0, '');
$pdf->Cell(130, 8, $arr['cargo'], 0, 0, '');
$pdf->Ln(6);
$pdf->Cell(60, 8, 'DEPENDENCIA			:', 0, 0, '');
$pdf->Cell(130, 8, $arr['direccion_ejec'], 0, 0, '');
$pdf->Ln(6);
$pdf->Cell(60, 8, 'CONVOCATORIA			:', 0, 0, '');
$pdf->Cell(130, 8, $arr['num_con'] . ' - ' . $arr['anio_con'], 0, 0, '');
$pdf->Ln(12);

//CONSULTA
$datos = mysqli_query($con, "SELECT * FROM detalle_convocatoria INNER JOIN entrevista_cas ON detalle_convocatoria.id_entrevista_cas = entrevista_cas.id_entrevista_cas WHERE convocatoria_idcon='$idcon' AND postulante_idpostulante='$idpostulante' AND personal_req_idpersonal ='$idpersonal'");
$array = mysqli_fetch_array($datos);
$aspecto_personal = $array['aspecto_personal'];
$seguridad_estabilidad = $array['seguridad_estabilidad'];
$capacidad_persu = $array['capacidad_persu'];
$capacidad_decisi = $array['capacidad_decisi'];
$conocimiento_gen = $array['conocimiento_gen'];
$puntaje_total = $array['puntaje_total'];
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
$pdf->Cell(150, 8, utf8_decode("3.- CAPACIDAD DE PERSUASIÓN:"), 'L,T,R', 0, '');
$pdf->Cell(40, 20, $capacidad_persu, 1, 0, 'C');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(150, 6, utf8_decode("    Mide la habilidad en la expresión oral y persuasión del postulante para emitir"), 'L,R', 0, '');
$pdf->Ln(6);
$pdf->Cell(150, 6, utf8_decode("    argumentos válidos a fin de lograr aceptación de sus ideas."), 'L,R,B', 0, '');
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(150, 8, utf8_decode("4.- CAPACIDAD PARA TOMAR DECISIONES:"), 'L,T,R', 0, '');
$pdf->Cell(40, 20, $capacidad_decisi, 1, 0, 'C');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(150, 6, utf8_decode("    Mide el grado de capacidad de análisis, raciocinio y habilidad para sacar conclusiones"), 'L,R', 0, '');
$pdf->Ln(6);
$pdf->Cell(150, 6, utf8_decode("    válidas y elegir la alternativa más adecuada con el fin de conseguir resultados. "), 'L,R,B', 0, '');
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(150, 8, utf8_decode("5.- CONOCIMIENTO DE CULTURA GENERAL:"), 'L,T,R', 0, '');
$pdf->Cell(40, 20, $conocimiento_gen, 1, 0, 'C');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(150, 6, utf8_decode("    Mide el grado de información general y adaptación al medio que lo"), 'L,R', 0, '');
$pdf->Ln(6);
$pdf->Cell(150, 6, utf8_decode("    rodea."), 'L,R,B', 0, '');
//FIN TABLA

$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(12);
$pdf->Cell(150, 8, utf8_decode("TOTAL"), 0, 0, 'R');
$pdf->Cell(40, 8, $puntaje_total, 0, 0, 'C');
$pdf->Ln(2);
$pdf->Cell(150, 8, '', 0, 0, 'R');
$pdf->Cell(40, 8, '______________', 0, 0, 'C');

$pdf->SetFont('Arial', '', 11);
$pdf->Ln(16);
$pdf->Cell(150, 8, utf8_decode("* Cada factor se evalúa sobre 20 puntos."), 0, 0, '');

$pdf->SetFont('Arial', '', 11);
$pdf->Ln(16);
$pdf->Cell(190, 8, utf8_decode("Tacna, " . ' ' . $date), 0, 0, 'R');


$pdf->Output();
