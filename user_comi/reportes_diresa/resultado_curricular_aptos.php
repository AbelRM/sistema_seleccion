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
    $this->Ln(10); //salto de linea

  }
  function Footer()
  {
    $this->SetY(-10);

    $this->SetFont('Arial', 'I', 8);

    $this->Cell(0, 10, utf8_decode("Página ") . $this->PageNo() . '', 0, 0, 'C');
  }
}
//CONSULTA
$idcon = $_GET['idcon'];
$idpersonal = $_GET['idpersonal'];
$consulta = mysqli_query($con, "SELECT * FROM sistema_seleccion.detalle_convocatoria INNER JOIN sistema_seleccion.convocatoria 
ON detalle_convocatoria.convocatoria_idcon = convocatoria.idcon 
INNER JOIN sistema_seleccion.personal_req ON detalle_convocatoria.personal_req_idpersonal = personal_req.idpersonal INNER JOIN cargo_full ON personal_req.cargo_idcargo = cargo_full.idcargo INNER JOIN ubicacion ON personal_req.personal_req_idubicacion = ubicacion.iddireccion
WHERE detalle_convocatoria.convocatoria_idcon ='$idcon' AND personal_req_idpersonal = '$idpersonal' AND estado_conv_cas ='APTO'");
$arr = mysqli_fetch_array($consulta);
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 11); //b=negrita, 11 tamaño
$pdf->Cell(190, 10, utf8_decode("CONVOCATORIA CAS N°" . ' ' . $arr['num_con'] . ' - ' . $arr['anio_con'] . ' ' . "-DRS.T/GOB.REG.TACNA"), 0, 0, 'C');
$pdf->Ln(1); //salto de linea
$pdf->Cell(190, 10, '______________________________________________________', 0, 0, 'C');
$pdf->Ln(12); //SALTO DE LINEA
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190, 10, utf8_decode("RELACIÓN DE POSTULANTES APTOS PARA LA ENTREVISTA PERSONAL"), 0, 0, 'C');
$pdf->Ln(15);
$pdf->Cell(30, 5, utf8_decode("CARGO:"), 0, 0, '');
$pdf->Cell(100, 5, utf8_decode($arr['cargo']), 0, 0, '');
$pdf->Ln(5);
$pdf->Cell(30, 5, utf8_decode("UBICACIÓN:"), 0, 0, '');
$pdf->Cell(100, 5, utf8_decode($arr['direccion_ejec']), 0, 0, '');
$pdf->Ln(5);
$pdf->Cell(30, 5, utf8_decode(""), 0, 0, '');
$pdf->Cell(100, 5, utf8_decode($arr['equipo_ejec']), 0, 0, '');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(8, 12, utf8_decode("N°"), 'L,T,R', 0, 'C');
$pdf->Cell(85, 12, 'APELLIDOS Y NOMBRES', 'L,T,R', 0, 'C');
$pdf->Cell(45, 6, 'PUNTAJE', 'L,T,R', 0, 'C');
$pdf->Cell(50, 12, utf8_decode("OBSERVACIONES"), 'L,T,R', 0, 'C');
$pdf->Ln(6); //salto de linea
$pdf->Cell(8, 6, utf8_decode(""), 'L,R,B', 0, 'C');
$pdf->Cell(85, 6, '', 'L,R,B', 0, 'C');
$pdf->Cell(45, 6, 'CURRICULAR', 'L,R,B', 0, 'C');
$pdf->Cell(50, 6, utf8_decode(""), 'L,R,B', 0, 'C');
$pdf->Ln(6); //salto de linea
$pdf->SetFont('Arial', '', 8);
//CONSULTA
//CONSULTA
$consulta = mysqli_query($con, "SELECT * FROM sistema_seleccion.detalle_convocatoria INNER JOIN sistema_seleccion.postulante 
ON detalle_convocatoria.postulante_idpostulante = postulante.idpostulante INNER JOIN evaluacion_curri_cas ON detalle_convocatoria.id_eva_curri_cas = evaluacion_curri_cas.id_eva_curricular
WHERE detalle_convocatoria.convocatoria_idcon ='$idcon' AND personal_req_idpersonal = '$idpersonal' AND estado_conv_cas='APTO'");

$item = 0;
while ($datos2 = mysqli_fetch_array($consulta)) {
  $item = $item + 1;
  $pdf->Cell(8, 6, $item, 1, 0, 'C');
  $pdf->Cell(85, 6, strtoupper($datos2['ape_pat'] . ' ' . $datos2['ape_mat'] . ', ' . $datos2['nombres']), 1, 0, '');
  $pdf->Cell(45, 6, $datos2['puntaje_total_total'], 1, 0, 'C');
  $pdf->Cell(50, 6, $datos2['observaciones_detalle_cas'], 1, 0, 'C');
  $pdf->Ln(6); //salto de linea
}
//FIN CONSULTA

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(190, 10, utf8_decode("NOTA: PUNTAJE MINIMO APROBATORIO 55 PUNTOS"), 0, 0, '');
$pdf->Ln(10); //salto de linea
$pdf->Cell(190, 10, 'TACNA, ' . date('d-m-y') . '', 0, 0, 'R');
$pdf->Ln(15); //salto de linea

//FIRMAS
$pdf->Cell(35, 4, '', 0);
$pdf->Cell(120, 4, utf8_decode("________________________________________"), 0, 0, 'C');
$pdf->Ln(4); //salto de linea
$pdf->Cell(35, 4, '', 0);
$pdf->Cell(120, 4, utf8_decode("Dra. SILVA SAKURAY MONTALVO"), 0, 0, 'C');
$pdf->Ln(4); //salto de linea
$pdf->Cell(35, 4, '', 0);
$pdf->Cell(120, 4, utf8_decode("Directora Ejecutiva de Salud de las Personas"), 0, 0, 'C');

$pdf->Cell(35, 4, '', 0);
$pdf->Cell(120, 4, utf8_decode("Pdte. Comité Evaluación - Direción requirente"), 0, 0, 'C');

$pdf->Ln(20); //salto $pdf->Ln(4);//salto de lineade linea
$pdf->Cell(20, 4, '', 0);
$pdf->Cell(60, 4, utf8_decode("________________________________________"), 0, 0, 'C');
$pdf->Cell(25, 4, '', 0);
$pdf->Cell(60, 4, utf8_decode("________________________________________"), 0, 0, 'C');
$pdf->Ln(4); //salto de linea
$pdf->Cell(20, 4, '', 0);
$pdf->Cell(60, 4, utf8_decode("Lic. JAVIER E. SOTOMAYOR GALINDO"), 0, 0, 'C');
$pdf->Cell(25, 4, '', 0);
$pdf->Cell(60, 4, utf8_decode("Econ. JORGE ALBERTO TORRES PACHECO"), 0, 0, 'C');
$pdf->Ln(4); //salto de linea
$pdf->Cell(20, 4, '', 0);
$pdf->Cell(60, 4, utf8_decode("Director Ejecutivo de Administración"), 0, 0, 'C');
$pdf->Cell(25, 4, '', 0);
$pdf->Cell(60, 4, utf8_decode("Director Ejecutivo de Gestión y Desarrollo de RR.HH."), 0, 0, 'C');
$pdf->Ln(4); //salto de linea
$pdf->Cell(20, 4, '', 0);
$pdf->Cell(60, 4, utf8_decode("Miembro"), 0, 0, 'C');
$pdf->Cell(25, 4, '', 0);
$pdf->Cell(60, 4, utf8_decode("Miembro"), 0, 0, 'C');
$pdf->Ln(4); //salto de linea

$pdf->Output();
