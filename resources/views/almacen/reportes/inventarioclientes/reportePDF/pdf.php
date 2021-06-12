<?php
require('fpdf/fpdf.php');
require 'cn.php';

/*$consulta = $ventas;
$vendSed = $mysqli->query($consulta);*/

$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetFont('Arial','I',8);

//$pdf->Image('images/logocf.png',10,3,60);
$pdf->Ln(15); 


    $pdf->SetFillColor(13,16,64);
    $pdf->Cell(70, 15, '', 0,0);
    $pdf->Cell(15, 15, 'REPORTE DE PEDIDOS FILTRADOS: '.$nombre_tipo_reporte, 0,1);

    $pdf->Cell(35, 5, 'Fecha de generacion:  ', 0,0);
    $pdf->Cell(20, 5, date('m-d-Y h:i:s a', time()), 0,1);
    $pdf->Cell(20, 5, 'Inicio: ', 0,0);
    $pdf->Cell(20, 5, $inicio, 0,1);
    $pdf->Cell(20, 5, 'Fin: ', 0,0);
    $pdf->Cell(20, 5, $fin, 0,1);
    $pdf->Cell(20, 5, 'Tipo: ', 0,0);
    $pdf->Cell(20, 5, $nombre_tipo_reporte, 0,1);
    $pdf->Cell(20, 5, '', 0,1);

    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(60,5,'EMPRESA',1,0,"C",true);
    $pdf->Cell(60,5,'NO. PEDIDOS',1,0,"C",true);
    $pdf->Cell(60,5,'NO. PRODUCTOS',1,1,"C",true);
    $pdf->SetTextColor(0,0,1);

    foreach ($pedidos as $ps) {
        $pdf->Cell(60,5,$ps->empresa.' - '.$ps->subempresa,1,0,'C',0);
        $pdf->Cell(60,5,$ps->numero_pedidos,1,0,'C',0);
        $pdf->Cell(60,5,$ps->noproductos,1,1,'C',0);
    }
        
    $pdf->Output('D','RP_PEDIDOS_FILTRADOS_'.$nombre_tipo_reporte.'.pdf','UTF-8');

?>
