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


    if ($valor==1) {
        $pdf->SetFillColor(13,16,64);
        $pdf->Cell(70, 15, '', 0,0);
        $pdf->Cell(15, 15, 'REPORTE DE PEDIDOS MENSUAL GENERAL', 0,1);
        $pdf->Cell(35, 5, 'Fecha de generacion:  ', 0,0);
        $pdf->Cell(20, 5, date('m-d-Y h:i:s a', time()), 0,1);

        $pdf->Cell(20, 5, 'Empresa: ', 0,0);
        $pdf->Cell(20, 5, $nombre_empresa, 0,1);
        $pdf->Cell(20, 5, 'Aliado: ', 0,0);
        $pdf->Cell(20, 5, $nombre_subempresa, 0,1);
        $pdf->Cell(20, 5, 'Inicio: ', 0,0);
        $pdf->Cell(20, 5, $mes_r, 0,1);
        $pdf->Cell(20, 5, 'Fin: ', 0,0);
        $pdf->Cell(20, 5, $mes_final, 0,1);
        $pdf->Cell(20, 5, '', 0,1);

        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(90,5,'FECHA',1,0,"C",true);
        $pdf->Cell(90,5,'NO. PRODUCTOS',1,1,"C",true);
        $pdf->SetTextColor(0,0,1);

        foreach ($pedidos_mensuales as $ps) {
            $pdf->Cell(90,5,$ps->fecha.' - '.$ps->fecha_year,1,0,'C',0);
            $pdf->Cell(90,5,$ps->noproductos,1,1,'C',0);
        }
    }

    if ($valor=='m') {
        $pdf->SetFillColor(13,16,64);
        $pdf->Cell(70, 15, '', 0,0);
        $pdf->Cell(15, 15, 'REPORTE DE PEDIDOS MENSUAL DETALLADO', 0,1);
        $pdf->Cell(35, 5, 'Fecha de generacion:  ', 0,0);
        $pdf->Cell(20, 5, date('m-d-Y h:i:s a', time()), 0,1);

        $pdf->Cell(20, 5, 'Empresa: ', 0,0);
        $pdf->Cell(20, 5, $nombre_empresa, 0,1);
        $pdf->Cell(20, 5, 'Aliado: ', 0,0);
        $pdf->Cell(20, 5, $nombre_subempresa, 0,1);
        $pdf->Cell(20, 5, 'Inicio: ', 0,0);
        $pdf->Cell(20, 5, $mes_r, 0,1);
        $pdf->Cell(20, 5, 'Fin: ', 0,0);
        $pdf->Cell(20, 5, $mes_final, 0,1);
        $pdf->Cell(20, 5, '', 0,1);

        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(90,5,'PRODUCTO',1,0,"C",true);
        $pdf->Cell(90,5,'CANTIDAD',1,1,"C",true);
        $pdf->SetTextColor(0,0,1);

        foreach ($pedidos_mensuales as $ps) {
            $pdf->Cell(90,5,$ps->producto,1,0,'C',0);
            $pdf->Cell(90,5,$ps->noproductos,1,1,'C',0);
        }

    }
        
    $pdf->Output('D','RP_PEDIDOS_MENSUAL_'.$tipo.'.pdf','UTF-8');

?>
