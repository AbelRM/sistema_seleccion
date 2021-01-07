 <?php
  include '../conexion.php';
  require('fpdf/fpdf.php');

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
  $consulta = mysqli_query($con, "SELECT * FROM sistema_seleccion.detalle_convocatoria INNER JOIN sistema_seleccion.personal_req 
  ON detalle_convocatoria.personal_req_idpersonal = personal_req.idpersonal 
  INNER JOIN convocatoria ON detalle_convocatoria.convocatoria_idcon = convocatoria.idcon INNER JOIN ubicacion ON personal_req.personal_req_idubicacion = ubicacion.iddireccion
  WHERE convocatoria_idcon ='$idcon' AND personal_req_idpersonal = '$idpersonal' AND estado_conv_cas ='APTO'");
  $arr = mysqli_fetch_array($consulta);
  $pdf = new PDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial', 'B', 10); //b=negrita, 11 tamaño
  $pdf->Cell(190, 10, utf8_decode("CONTRATO ADMINISTRATIVO DE SERVICIOS - CAS"), 0, 0, 'C');
  $pdf->Ln(1); //salto de linea
  $pdf->Cell(190, 10, '_____________________________________________________', 0, 0, 'C');
  $pdf->Ln(12); //SALTO DE LINEA
  $pdf->Cell(190, 10, utf8_decode("CONVOCATORIA N°" . ' ' . $arr['num_convoc'] . ' - ' . $arr['anio_convoc']), 0, 0, 'C');
  $pdf->Ln(1); //salto de linea
  $pdf->Cell(190, 10, '_________________________________________________', 0, 0, 'C');
  $pdf->Ln(12); //SALTO DE LINEA

  $pdf->Cell(50, 5, utf8_decode("CARRERA REQUERIDA:"), 0, 0, '');
  $pdf->Cell(100, 5, utf8_decode($arr['carrera_prof']), 0, 0, '');
  $pdf->Ln(5);
  $pdf->Cell(50, 5, utf8_decode("UBICACIÓN:"), 0, 0, '');
  $pdf->Cell(100, 5, utf8_decode($arr['direccion_ejec']), 0, 0, '');
  $pdf->Ln(5);
  $pdf->Cell(50, 5, utf8_decode(""), 0, 0, '');
  $pdf->Cell(100, 5, utf8_decode($arr['equipo_ejec']), 0, 0, '');
  $pdf->Ln(10);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(190, 10, utf8_decode("RELACIÓN DE POSTULANTES CV + ENTREVISTA APTOS"), 0, 0, 'C');
  $pdf->Ln(15);
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->Cell(8, 12, utf8_decode("N°"), 'L,T,R', 0, 'C');
  $pdf->Cell(80, 12, 'APELLIDOS Y NOMBRES', 'L,T,R', 0, 'C');
  $pdf->Cell(25, 6, 'PUNTAJE', 'L,T,R', 0, 'C');
  $pdf->Cell(25, 6, 'PUNTAJE', 'L,T,R', 0, 'C');
  $pdf->Cell(25, 6, 'PUNTAJE', 'L,T,R', 0, 'C');
  $pdf->Cell(25, 6, utf8_decode("ESTADO"), 'L,T,R', 0, 'C');
  $pdf->Ln(6); //salto de linea
  $pdf->Cell(8, 6, utf8_decode(""), 'L,R,B', 0, 'C');
  $pdf->Cell(80, 6, '', 'L,R,B', 0, 'C');
  $pdf->Cell(25, 6, 'CURRICULAR', 'L,R,B', 0, 'C');
  $pdf->Cell(25, 6, 'ENTREVISTA', 'L,R,B', 0, 'C');
  $pdf->Cell(25, 6, 'TOTAL PROM.', 'L,R,B', 0, 'C');
  $pdf->Cell(25, 6, utf8_decode("POSTULANTE"), 'L,R,B', 0, 'C');
  $pdf->Ln(6); //salto de linea
  $pdf->SetFont('Arial', '', 8);
  //CONSULTA

  $consulta = mysqli_query($con, "SELECT * FROM sistema_seleccion.detalle_convocatoria INNER JOIN sistema_seleccion.postulante 
  ON detalle_convocatoria.postulante_idpostulante = postulante.idpostulante INNER JOIN evaluacion_curri_cas ON detalle_convocatoria.id_eva_curri_cas = evaluacion_curri_cas.id_eva_curricular INNER JOIN entrevista_cas ON detalle_convocatoria.id_entrevista_cas = entrevista_cas.id_entrevista_cas
  WHERE detalle_convocatoria.convocatoria_idcon ='$idpracticas' AND personal_req_idpersonal = '$idpersonal' AND estado_conv_cas = 'APTO'");
  $num_consu = mysqli_num_rows($consulta);
  $item = 0;
  if ($num_consu > 0) {
    while ($datos2 = mysqli_fetch_array($consulta)) {
      $item = $item + 1;
      $pdf->Cell(8, 6, $item, 1, 0, 'C');
      $pdf->Cell(80, 6, strtoupper($datos2['ape_pat'] . ' ' . $datos2['ape_mat'] . ', ' . $datos2['nombres']), 1, 0, '');
      $pdf->Cell(25, 6, $datos2['puntos_total_cv'], 1, 0, 'C');
      $pdf->Cell(25, 6, $datos2['puntaje_entrevista'], 1, 0, 'C');
      $pdf->Cell(25, 6, $datos2['puntaje_total_total'], 1, 0, 'C');
      $pdf->Cell(25, 6, $datos2['estado_conv_prac'], 1, 0, 'C');
      $pdf->Ln(6); //salto de linea
    }
  } else {
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(188, 8, "NO EXISTE POSTULANTES PARA ESTA LISTA", 1, 0, 'C');
    $pdf->Ln(6); //salto de linea
  }

  //FIN CONSULTA

  $pdf->SetFont('Arial', 'B', 8);
  $pdf->Cell(190, 10, utf8_decode("NOTA: PUNTAJE MINIMO APROBATORIO 13 PUNTOS"), 0, 0, '');
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
