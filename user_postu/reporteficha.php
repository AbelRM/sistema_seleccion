<?php
require('../fpdf/fpdf.php');
$idpostulante= $_GET['idpostulante'];
$dni = $_GET['dni'];

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
       
       // $this->Image('img/iconodiresa.png',10,8,33);
        $this->Image('img/logo_diresa.png',8,8,40,25); 
        $this->SetFont('Arial','B',16);
        // Movernos a la derecha
        $this->Cell(60);
        // Título
        $this->Cell(70,20,'FICHA UNICA DE DATOS',0,0,'C');
        // Salto de línea
        $this->Ln(20);
        // $this->Cell(30,10,'Datos Personales',0,0);
        //$this->Ln(10);
        //$this->Cell(30,10,'Datos Familiares:',0,0);
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
   

    $pdf = new PDF();
    $pdf-> AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',11);

    $pdf->Ln(15);
    $pdf->Cell(30,10,'DATOS PERSONALES:',0,0,'L');
    $pdf->Ln(10);
    $consulta6 = "SELECT * FROM postulante  where dni=$dni";
    $datos6=mysqli_query($con,$consulta6) or die(mysqli_error()); ;
    $fila6= mysqli_fetch_array($datos6);
    $pdf->Cell(80,13,'Nombres:  '.$fila6['nombres']);
    $pdf->Cell(80,13,'Apellidos:  '.$fila6['ape_pat']."   ".$fila6['ape_mat']); 
    $pdf->Ln(10);
    $pdf->Cell(80,13,'DNI:  '.$fila6['dni']);
    $pdf->Cell(70,13,'Pais:  '.$fila6['Pais']);
    $pdf->Cell(80,13,'RUC:  '.$fila6['ruc']);
    $pdf->Ln(10);
    $pdf->Cell(80,13,'Fecha Nacimiento:  '.$fila6['fech_nac']);
    $pdf->Cell(70,13,'Celular:  '.$fila6['celular']);
    $pdf->Cell(70,13,'Discapacidad:  '.$fila6['discapacidad']);
    $pdf->Ln(10);
    $pdf->Cell(100,13,'Correo Electronico:  '.$fila6['correo']);
    $pdf->Ln(10);
    $pdf->Cell(80,13,'Grupo Sanguineo:  '.$fila6['tipo_sangre']);
    $pdf->Cell(70,13,'Suspension de renta 4ta categoria:  '.$fila6['suspension_cuarta']);
    $pdf->Ln(10);
    $pdf->Cell(80,13,'Estado civil:  '.$fila6['estado_civil']);
    $pdf->Cell(80,13,'Tipo Discapacidad:  '.$fila6['tipo_discap']);

    

    $pdf->Ln(15);
    $pdf->Cell(30,10,'EN CASO DE EMERGENCIA LLAMAR A:',0,0);
    $pdf->Ln(10);
    $pdf->Cell(80,13,'Parentesco:  '.$fila6['parentesco_emer']);
    $pdf->Cell(70,13,'Celular:  '.$fila6['celular_emer']);

    $pdf->Ln(15);
    $pdf->Cell(30,10,'DOMICILIO:',0,0);
    $pdf->Ln(10);
    $sql5 = "SELECT * FROM domicilio_post  where postulante_idpostulante=$idpostulante";
    $datos5=mysqli_query($con,$sql5) or die(mysqli_error()); ;
    $fila5= mysqli_fetch_array($datos5);

    $pdf->Cell(70,13,'Tipo de Via:  '.$fila5['tip_via']);
    $pdf->Cell(80,13,'Nombre de Via:  '.$fila5['nomb_via']);
    $pdf->Cell(60,13,'Numero:  '.$fila5['numero']);
    $pdf->Ln(10);

    $pdf->Cell(70,13,'Tipo de Zona:  '.$fila5['tip_zona']);
    $pdf->Cell(80,13,'Nombre de Zona:  '.$fila5['nomb_zona']);
    $pdf->Cell(60,13,'Numero:  '.$fila5['num_zona']);
    $pdf->Ln(15);

    $pdf->Cell(30,10,'UBICACION GEOGRAFICA:',0,0);
    $pdf->Ln(10);
    $sql5 = "SELECT * FROM domicilio_post  where postulante_idpostulante=$idpostulante";
    $datos5=mysqli_query($con,$sql5) or die(mysqli_error()); ;
    $fila5= mysqli_fetch_array($datos5);
    $distrito=$fila5['distrito_idistrito'];  

    $total="SELECT * FROM total_lugar WHERE iddistrito=$distrito";
    $respuesta=mysqli_query($con,$total) or die(mysqli_error());
    $row2= mysqli_fetch_array($respuesta);
    $pdf->Cell(70,13,'Departamento:  '.$row2['departamento']);
    $pdf->Cell(80,13,'Provincia:  '.$row2['provincia']);
    $pdf->Cell(60,13,'Distrito:  '.$row2['distrito']);
    $pdf->Ln(10);
    $pdf->Cell(90,13,'Referencia:  '.$fila5['referencia']);

    $pdf->Ln(15);
    $pdf->Cell(30,10,'DATOS PROFESIONALES:',0,0);
    $pdf->Ln(10);
    $sql6 = "SELECT * FROM datos_profesionales where postulante_idpostulante=$idpostulante";
    $datos6=mysqli_query($con,$sql6) or die(mysqli_error()); ;
    $fila6= mysqli_fetch_array($datos6);

    $pdf->Cell(90,13,'Profesion:  '.$fila6['profesion']);
    $pdf->Cell(80,13,'Lugar de Colegiatura:  '.$fila6['lugar_cole']);
    $pdf->Ln(10);
    $pdf->Cell(90,13,'Fecha de Colegiatura:  '.$fila6['fecha_cole']);
    $pdf->Cell(80,13,'Fecha hasta donde de encuentra habilitado:  '.$fila6['fecha_habi']);
    $pdf->Ln(10);
    $pdf->Cell(90,13,'Numero de Colegiatura:  '.$fila6['nro_cole']);

    $pdf->Ln(70);

    $pdf->Cell(30,10,'DATOS FAMILIARES:',0,0);
    $pdf->Ln(10);
        $pdf->Cell(50, 10, 'Nombre', 1,0,'C',0);
        $pdf->Cell(50, 10, 'Apelidos', 1,0,'C',0);
        $pdf->Cell(40, 10, 'DNI', 1,0,'C',0);
        $pdf->Cell(40, 10, 'Parentesco', 1,1,'C',0);
        $consulta = "SELECT * FROM familia_post where postulante_idpostulante=$idpostulante";
        $resultado = $con->query($consulta);
        while($row = $resultado->fetch_assoc()){
            $pdf->Cell(50, 10,utf8_decode($row['nombre']), 1,0,'C',0);
            $pdf->Cell(50, 10,utf8_decode ($row['apellidos']), 1,0,'C',0);
            $pdf->Cell(40, 10, $row['dni'], 1,0,'C',0);
            $pdf->Cell(40, 10, $row['parentesco'], 1,1,'C',0);  
    }

    $pdf->Ln(10);
    $pdf->Cell(30,10,'ESTUDIOS SUPERIORES (Universitario - Tecnico):',0,0);
    $pdf->Ln(10);
        $pdf->Cell(40, 10, 'Centro de Estudios', 1,0,'C',0);
        $pdf->Cell(60, 10, 'Especialidad', 1,0,'C',0);
        $pdf->Cell(30, 10, 'Fecha Inicio', 1,0,'C',0);
        $pdf->Cell(30, 10, 'Fecha Termino', 1,0,'C',0);
        $pdf->Cell(30, 10, 'Nivel', 1,1,'C',0);
        $consulta = "SELECT * FROM estudios_superiores where idpostulante_postulante=$idpostulante";
        $resultado = $con->query($consulta);
        while($row = $resultado->fetch_assoc()){
            $pdf->Cell(40, 10,utf8_decode($row['centro_estu']), 1,0,'C',0);
            $pdf->Cell(60, 10,utf8_decode ($row['especialidad']), 1,0,'C',0);
            $pdf->Cell(30, 10, $row['fech_ini'], 1,0,'C',0);
            $pdf->Cell(30, 10, $row['fech_fin'], 1,0,'C',0);
            $pdf->Cell(30, 10, $row['nivel'], 1,1,'C',0);
        
    }

    $pdf->Ln(10);
    $pdf->Cell(30,10,'ESTUDIOS POSTGRADO (Maestria - Doctorado):',0,0);
    $pdf->Ln(10);
        $pdf->Cell(35, 10, 'Centro de Estudios', 1,0,'C',0);
        $pdf->Cell(50, 10, 'Especialidad', 1,0,'C',0);
        $pdf->Cell(25, 10, 'Tipo', 1,0,'C',0);
        $pdf->Cell(25, 10, 'Fecha Inicio', 1,0,'C',0);
        $pdf->Cell(30, 10, 'Fecha Termino', 1,0,'C',0);
        $pdf->Cell(25, 10, 'Nivel', 1,1,'C',0);
        $consulta = "SELECT * FROM maestria_doc where idpostulante_postulante=$idpostulante";
        $resultado = $con->query($consulta);
        while($row = $resultado->fetch_assoc()){
            $pdf->Cell(35, 10, $row['centro_estu'], 1,0,'C',0);
            $pdf->Cell(50, 10,utf8_decode($row['especialidad']), 1,0,'C',0);
            $pdf->Cell(25, 10, $row['tipo_estu'], 1,0,'C',0);
            $pdf->Cell(25, 10, $row['fech_ini'], 1,0,'C',0);
            $pdf->Cell(30, 10, $row['fech_fin'], 1,0,'C',0);
            $pdf->Cell(25, 10, $row['nivel'], 1,1,'C',0);
        
    }

    $pdf->Ln(10);
    $pdf->Cell(30,10,'ESPECILIZACION (Diplomados - Cursos):',0,0);
    $pdf->Ln(10);
        $pdf->Cell(35, 10, 'Centro de Estudios', 1,0,'C',0);
        $pdf->Cell(40, 10, 'Especialidad', 1,0,'C',0);
        $pdf->Cell(13, 10, 'Horas', 1,0,'C',0);
        $pdf->Cell(25, 10, 'Fecha Inicio', 1,0,'C',0);
        $pdf->Cell(28, 10, 'Fecha Termino', 1,0,'C',0);
        $pdf->Cell(25, 10, 'Tipo', 1,0,'C',0);
        $pdf->Cell(25, 10, 'Nivel', 1,1,'C',0);
        $consulta = "SELECT * FROM cursos_extra WHERE postulante_idpostulante = $idpostulante";
        $resultado = $con->query($consulta);
        while($row = $resultado->fetch_assoc()){
            $pdf->Cell(35, 10, $row['centro_estu'], 1,0,'C',0);
            $pdf->Cell(40, 10, $row['materia'], 1,0,'C',0);
            $pdf->Cell(13, 10, $row['horas'], 1,0,'C',0);
            $pdf->Cell(25, 10, $row['fech_ini'], 1,0,'C',0);
            $pdf->Cell(28, 10, $row['fech_fin'], 1,0,'C',0);
            $pdf->Cell(25, 10, $row['tipo'], 1,0,'C',0);
            $pdf->Cell(25, 10, $row['nivel'], 1,1,'C',0);
        
    }

    $pdf->Ln(10);
    $pdf->Cell(30,10,'(Idiomas - Computo):',0,0);
    $pdf->Ln(10);
        $pdf->Cell(50, 10, 'Idioma - Computo', 1,0,'C',0);
        $pdf->Cell(50, 10, 'Nivel', 1,1,'C',0);
        $consulta = "SELECT * FROM idiomas_comp WHERE idpostulante_postulante = $idpostulante";
        $resultado = $con->query($consulta);
        while($row = $resultado->fetch_assoc()){
            $pdf->Cell(50, 10, $row['idioma_comp'], 1,0,'C',0);
            $pdf->Cell(50, 10, $row['nivel'], 1,1,'C',0);     
    }

    $pdf->Ln(10);
    $pdf->Cell(30,10,'EXPERIENCIA LABORAL:',0,0);
    $pdf->Ln(10);
        $pdf->Cell(50, 10, 'Institucion/Empresa', 1,0,'C',0);
        $pdf->Cell(40, 10, 'Cargo', 1,0,'C',0);
        $pdf->Cell(40, 10, 'Fecha Inicio', 1,0,'C',0);
        $pdf->Cell(40, 10, 'Fecha Termino', 1,1,'C',0);
        $consulta = "SELECT * FROM expe_4puntos inner join detalle_convocatoria 
                ON expe_4puntos.expe_4puntos_detalle_con = detalle_convocatoria.iddetalle_convocatoria WHERE postulante_idpostulante = $idpostulante
                UNION
                SELECT * FROM expe_3puntos inner join detalle_convocatoria 
                ON expe_3puntos.expe_3puntos_detalle_con = detalle_convocatoria.iddetalle_convocatoria WHERE postulante_idpostulante = $idpostulante
                UNION
                SELECT * FROM expe_1puntos inner join detalle_convocatoria 
                ON expe_1puntos.expe_1puntos_detalle_con = detalle_convocatoria.iddetalle_convocatoria WHERE postulante_idpostulante = $idpostulante";
        $resultado = $con->query($consulta);
        while($row = $resultado->fetch_assoc()){
            $pdf->Cell(50, 10, $row['lugar'], 1,0,'C',0);
            $pdf->Cell(40, 10, $row['cargo'], 1,0,'C',0);
            $pdf->Cell(40, 10, $row['fecha_inicio'], 1,0,'C',0);
            $pdf->Cell(40, 10, $row['fech_fin'], 1,1,'C',0);
    }

    $pdf->Output();
?>