<?php
// include 'conexion.php';
require('fpdf/fpdf.php');
$n_convo = 'valor';
$año_actual = '2019';
$cargo = 'Especialidad que está postulando';
$ubicacion = 'Direccion ejecutiva nivel 1';
$programa = 'Programa Articulado Nutricional';

class PDF extends FPDF
{
   //Cabecera de página
   function Header()
   {
   	$this->SetFont('Arial','B', 8);//idetificar el tipo de letro, fuete, tipo de fuente, tamaño
	$this->Image('logo.png' , 10,6,23,14,'PNG');//traer una imagen 10=x,13=y
	$this->Cell(20, 6, '', 0);//nos crea las celdas donde colocas la info:largo,ancho, ,bordes
	$this->Cell(150, 4,utf8_decode("DIRECCION REGIONAL DE SALUD TACNA"),0,0,'C');
	$this->Ln(4);//salto de linea
	$this->Cell(20, 6, '', 0);
	$this->Cell(150, 4,utf8_decode("DIREC. EJEC. DE GESTIÓN Y DESARROLLO DE RECURSOS HUMANOS"),0,0,'C');
    $this->Ln(10);//salto de linea

   }
}

$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 11);//b=negrita, 11 tamaño
$pdf->Cell(190,10, 'CONTRATOS ADMINISTRATIVOS DE SERVICIOS - CAS',0,0,'C');
$pdf->Ln(1);//salto de linea
$pdf->Cell(190,10,'_______________________________________________',0,0,'C');
$pdf->Ln(5);//SALTO DE LINEA
$pdf->Cell(190,10,utf8_decode("CONVOCATORIA N° $n_convo - $año_actual"),0,0,'C');
$pdf->Ln(1);//salto de linea
$pdf->Cell(190,10,'____________________________',0,0,'C');
$pdf->Ln(12);//SALTO DE LINEA
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190,10,utf8_decode("RESULTADO FINAL"),0,0,'C');
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30,5,utf8_decode("CARGO:"),0,0,'');
$pdf->Cell(100,5,utf8_decode("$cargo"),0,0,'');
$pdf->Ln(5);
$pdf->Cell(30,5,utf8_decode("UBICACIÓN:"),0,0,'');
$pdf->Cell(100,5,utf8_decode("$ubicacion"),0,0,'');
$pdf->Ln(5);
$pdf->Cell(30,5,utf8_decode(""),0,0,'');
$pdf->Cell(100,5,utf8_decode("$programa"),0,0,'');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(6, 8,utf8_decode("N°"),'L,T,R',0,'C');
$pdf->Cell(65, 8,utf8_decode("APELLIDOS Y NOMBRES"),'L,T,R',0,'C');
$pdf->Cell(15, 4,utf8_decode("PUNTAJE"),'L,T,R',0,'C');
$pdf->Cell(15, 4,utf8_decode("PONDERADO"),'L,T,R',0,'C');
$pdf->Cell(15, 4,utf8_decode("ENTREVISTA"),'L,T,R',0,'C');
$pdf->Cell(15, 4,utf8_decode("PONDERADO"),'L,T,R',0,'C');
$pdf->Cell(14, 4,utf8_decode("TOTAL"),'L,T,R',0,'C');
$pdf->Cell(6, 4, utf8_decode("QUIN"),'L,T,R',0,'C');
$pdf->Cell(10, 4, utf8_decode("%"),'L,T,R',0,'C');
$pdf->Cell(14, 4, utf8_decode("VALOR"),'L,T,R',0,'C');
$pdf->Cell(14, 4, utf8_decode("PUNTAJE"),'L,T,R',0,'C');
$pdf->Ln(4);
$pdf->Cell(6, 4,utf8_decode(""),'L,R,B',0,'C');
$pdf->Cell(65, 4,utf8_decode(""),'L,R,B',0,'C');
$pdf->Cell(15, 4,utf8_decode("CURRICULAR"),'L,B,R',0,'C');
$pdf->Cell(15, 4,utf8_decode("(70%)"),'L,B,R',0,'C');
$pdf->Cell(15, 4,utf8_decode("PERSONAL"),'L,B,R',0,'C');
$pdf->Cell(15, 4,utf8_decode("(30%)"),'L,B,R',0,'C');
$pdf->Cell(14, 4,utf8_decode("PUNTAJE (1)"),'L,B,R',0,'C');
$pdf->Cell(6, 4, utf8_decode("TIL"),'L,B,R',0,'C');
$pdf->Cell(10, 4, utf8_decode("QUINTIL"),'L,B,R',0,'C');
$pdf->Cell(14, 4, utf8_decode("QUINTIL (2)"),'L,B,R',0,'C');
$pdf->Cell(14, 4, utf8_decode("FINAL (1+2)"),'L,B,R',0,'C');
$pdf->Ln(6);//salto de linea
$pdf->SetFont('Arial', '', 8);
//CONSULTA
// $datos = mysqli_query($conexion,"SELECT nombres,apellidos,dni,direccion FROM pcd");
$item = 0;

// while($datos2 = mysqli_fetch_array($datos)){
// $item = $item+1;
// $pdf->Cell(6, 12,utf8_decode("$item"),1,0,'C');
// $pdf->Cell(65, 12,$datos2['nombrecompleto'],1,0,'L');
// $pdf->Cell(15, 6,$datos2['puntaje'],1,0,'C');
// $pdf->Cell(15, 6,$datos2['ponderado'],1,0,'C');
// $pdf->Cell(15, 6,utf8_decode("ENTREVISTA"),1,0,'C');
// $pdf->Cell(15, 6,utf8_decode("PONDERADO"),1,0,'C');
// $pdf->Cell(14, 6,utf8_decode("TOTAL"),1,0,'C');
// $pdf->Cell(6, 6, utf8_decode("QUIN"),1,0,'C');
// $pdf->Cell(10, 6, utf8_decode("%"),1,0,'C');
// $pdf->Cell(14, 6, utf8_decode("VALOR"),1,0,'C');
// $pdf->Cell(14, 6, utf8_decode("PUNTAJE"),1,0,'C');
// $pdf->Ln(6);
// }

$pdf->Cell(190, 10, 'TACNA, '.date('d-m-y').'',0,0,'R');
$pdf->Ln(15);//salto de linea

//FIRMAS
$pdf->Cell(35, 4,'',0);
$pdf->Cell(120, 4,utf8_decode("________________________________________"),0,0,'C');
$pdf->Ln(4);//salto de linea
$pdf->Cell(35, 4,'',0);
$pdf->Cell(120, 4,utf8_decode("Dra. SILSA ISABLE SAKURA MONTALVO"),0,0,'C');
$pdf->Ln(4);//salto de linea
$pdf->Cell(35, 4,'',0);
$pdf->Cell(120, 4,utf8_decode("Pdte. Comité Evaluación de Dirección requirente"),0,0,'C');

$pdf->Cell(35, 4,'',0);
$pdf->Cell(120, 4,utf8_decode("DIRESA TACNA"),0,0,'C');

$pdf->Ln(20);//salto $pdf->Ln(4);//salto de lineade linea
$pdf->Cell(20, 4,'',0);
$pdf->Cell(60, 4,utf8_decode("________________________________________"),0,0,'C');
$pdf->Cell(25, 4,'',0);
$pdf->Cell(60, 4,utf8_decode("________________________________________"),0,0,'C');
$pdf->Ln(4);//salto de linea
$pdf->Cell(20, 4,'',0);
$pdf->Cell(60, 4,utf8_decode("Lic. JAVIER E. SOTOMAYOR GALINDO"),0,0,'C');
$pdf->Cell(25, 4,'',0);
$pdf->Cell(60, 4,utf8_decode("Econ. JORGE ALBERTO TORRES PACHECO"),0,0,'C');
$pdf->Ln(4);//salto de linea
$pdf->Cell(20, 4,'',0);
$pdf->Cell(60, 4,utf8_decode("Director Ejecutivo de Administración"),0,0,'C');
$pdf->Cell(25, 4,'',0);
$pdf->Cell(60, 4,utf8_decode("Director Ejecutivo de Gestión y Desarrollo de RR.HH."),0,0,'C');
$pdf->Ln(4);//salto de linea
$pdf->Cell(20, 4,'',0);
$pdf->Cell(60, 4,utf8_decode("Miembro"),0,0,'C');
$pdf->Cell(25, 4,'',0);
$pdf->Cell(60, 4,utf8_decode("Miembro"),0,0,'C');
$pdf->Ln(4);//salto de linea

$pdf->Output();
?>