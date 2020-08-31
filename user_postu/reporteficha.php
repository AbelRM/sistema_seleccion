<?php
require('../fpdf/fpdf.php');
$idpostulante= $_GET['idpostulante'];

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Arial bold 15
        $this->SetFont('Arial','B',11);
        // Movernos a la derecha
        $this->Cell(60);
        // Título
        $this->Cell(70,10,'Ficha Unica de Datos',0,0,'C');
        // Salto de línea
        $this->Ln(20);

        $this->Cell(30,10,'Datos Personales',0,0);
        $this->Ln(10);
        $this->Cell(30,10,'Datos Familiares:',0,0);
        $this->Ln(10);

        $this->Cell(50, 10, 'Nombre', 1,0,'C',0);
        $this->Cell(50, 10, 'Apelidos', 1,0,'C',0);
        $this->Cell(40, 10, 'DNI', 1,0,'C',0);
        $this->Cell(40, 10, 'Parentesco', 1,1,'C',0);
        
       
    
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }

}



require 'conexion.php';
    $consulta = "SELECT * FROM familia_post where postulante_idpostulante=$idpostulante";
    $resultado = $con->query($consulta);

    $pdf = new PDF();
    $pdf-> AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',16);

    while($row = $resultado->fetch_assoc()){
        $pdf->Cell(50, 10, $row['nombre'], 1,0,'C',0);
        $pdf->Cell(50, 10, $row['apellidos'], 1,0,'C',0);
        $pdf->Cell(40, 10, $row['dni'], 1,0,'C',0);
        $pdf->Cell(40, 10, $row['parentesco'], 1,1,'C',0);
        
    }

    $pdf->Output();
?>