<?php
// include 'conexion.php';
require('fpdf/fpdf.php');
$n_convo = 'valor';
$año_actual = '2019';
$ue = '400 REGION TACNA SALUD';
$cargo = 'Especialidad que está postulando';
$ubicacion = 'Direccion ejecutiva nivel 1';
$programa = 'Programa Articulado Nutricional';

$pdf=new FPDF();
$pdf->AddPage('L');
$pdf->SetFont('Arial','B', 8);//idetificar el tipo de letro, fuete, tipo de fuente, tamaño
$pdf->Image('logo.png', 10,6,28,15,'PNG');//traer una imagen 10=x,13=y
$pdf->Cell(290, 4,utf8_decode("DIRECCION REGIONAL DE SALUD TACNA"),0,0,'C');
$pdf->Ln(4);//salto de linea
$pdf->Cell(290, 4,utf8_decode("DIREC. EJEC. DE GESTIÓN Y DESARROLLO DE RECURSOS HUMANOS"),0,0,'C');
$pdf->Ln(10);//salto de linea

$pdf->SetFont('Arial', 'B', 11);//b=negrita, 11 tamaño
$pdf->Cell(290,10, 'CONTRATOS ADMINISTRATIVOS DE SERVICIOS - CAS',0,0,'C');
$pdf->Ln(1);//salto de linea
$pdf->Cell(290,10,'_______________________________________________',0,0,'C');
$pdf->Ln(5);//SALTO DE LINEA
$pdf->Cell(290,10,utf8_decode("CONVOCATORIA N° $n_convo - $año_actual"),0,0,'C');
$pdf->Ln(1);//salto de linea
$pdf->Cell(290,10,'____________________________',0,0,'C');
$pdf->Ln(12);//SALTO DE LINEA
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(290,10,utf8_decode("ADJUDICACIÓN DE CARGO"),0,0,'C');
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30,5,utf8_decode("U.E. :"),0,0,'');
$pdf->Cell(100,5,utf8_decode("$ue"),0,0,'');
$pdf->Ln(5);
$pdf->Cell(30,5,utf8_decode("CARGO:"),0,0,'');
$pdf->Cell(100,5,utf8_decode("$cargo"),0,0,'');
$pdf->Ln(5);
$pdf->Cell(30,5,utf8_decode("UBICACIÓN:"),0,0,'');
$pdf->Cell(100,5,utf8_decode("$ubicacion"),0,0,'');
$pdf->Ln(5);
$pdf->Cell(30,5,utf8_decode(""),0,0,'');
$pdf->Cell(100,5,utf8_decode("$programa"),0,0,'');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(10, 8,utf8_decode("N°"),1,0,'C');
$pdf->Cell(90, 8,utf8_decode("APELLIDOS Y NOMBRES"),1,0,'C');
$pdf->Cell(85, 8,utf8_decode("UBICACIÓN"),1,0,'C');
$pdf->Cell(45, 8,utf8_decode("FIRMA"),1,0,'C');
$pdf->Cell(45, 8,utf8_decode("D.N.I."),1,0,'C');
$pdf->Ln(8);

//CONSULTA
// $datos = mysqli_query($conexion,"SELECT nombres,apellidos,dni,direccion FROM pcd");
$item = 0;

// while($datos2 = mysqli_fetch_array($datos)){
// $item = $item+1;
// $pdf->Cell(10, 20,utf8_decode("$item"),1,0,'C');
// $pdf->Cell(90, 20,utf8_decode("$nombrescompletos"),1,0,'C');
// $pdf->Cell(85, 20,utf8_decode("$ubicacion"),1,0,'C');
// $pdf->Cell(45, 20,utf8_decode(""),1,0,'C');
// $pdf->Cell(45, 20,utf8_decode("$dni"),1,0,'C');
// $pdf->Ln(20);
// }
$pdf->Ln(15);
$pdf->Cell(275, 10, 'TACNA, '.date('d-m-y').'',0,0,'R');
$pdf->Ln(25);//salto de linea

//FIRMAS
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(290, 4,utf8_decode("________________________________________"),0,0,'C');
$pdf->Ln(4);//salto de linea
$pdf->Cell(290, 4,utf8_decode("Dra. SILSA ISABLE SAKURA MONTALVO"),0,0,'C');
$pdf->Ln(4);//salto de linea
$pdf->Cell(290, 4,utf8_decode("Pdte. Comité Evaluación de Dirección requirente"),0,0,'C');
$pdf->Ln(4);//salto de linea
$pdf->Cell(290, 4,utf8_decode("DIRESA TACNA"),0,0,'C');

$pdf->Ln(20);//salto $pdf->Ln(4);//salto de lineade linea

$pdf->Cell(145, 4,utf8_decode("________________________________________"),0,0,'C');
$pdf->Cell(145, 4,utf8_decode("________________________________________"),0,0,'C');
$pdf->Ln(4);//salto de linea
$pdf->Cell(145, 4,utf8_decode("Lic. JAVIER E. SOTOMAYOR GALINDO"),0,0,'C');
$pdf->Cell(145, 4,utf8_decode("Econ. JORGE ALBERTO TORRES PACHECO"),0,0,'C');
$pdf->Ln(4);//salto de linea
$pdf->Cell(145, 4,utf8_decode("Director Ejecutivo de Administración"),0,0,'C');
$pdf->Cell(145, 4,utf8_decode("Director Ejecutivo de Gestión y Desarrollo de RR.HH."),0,0,'C');
$pdf->Ln(4);//salto de linea
$pdf->Cell(145, 4,utf8_decode("Miembro"),0,0,'C');
$pdf->Cell(145, 4,utf8_decode("Secretario"),0,0,'C');
$pdf->Ln(4);//salto de linea

$pdf->Output();
?>