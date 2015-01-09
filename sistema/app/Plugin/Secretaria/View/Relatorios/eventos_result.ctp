<?php
	//Inicia Uma nova página de PDF
	$pdf->AddPage('P', 'A4');
	$pdf->SetY(6);
	$pdf->SetX(7);
	//Setando valores da margem
	$pdf->SetMargins(7, 5, 9);
	//Quebra de Linha com 1mm
	$pdf->Ln(1);
	//Passa parametros para Fonte
	$pdf->SetFont('Helvetica', 'B', 11);
	//Topo do relatório
	$topo = "NFCHURCH - GESTÃO PARA IGREJAS \nRelatório de Eventos";
	
	$pdf->SetAutoPageBreak(true, 15);
	$pdf->MultiCell(196,7, utf8_decode($topo), 1, 'J', false);
	$pdf->Ln(5);
	
	$header = array(utf8_decode('Assunto'), utf8_decode('Descrição'), utf8_decode('Data Inicio'), utf8_decode('Data Final'));

    $pdf->SetWidths(array(50,90, 28, 28));
	// To be implemented in your own inherited class
	// Seleciona fonte Helvetica bold 15
	$pdf->SetFont('Helvetica','B',8);
	// Titulo dentro de uma caixa
	$pdf->Row($header);
	// Quebra de linha	
	$pdf->Ln();

	$pdf->headerRow = $header;
	
	$pdf->headerFont = array('Helvetica', 'B', 8);
	$pdf->SetFont('Helvetica', '', 8);
	foreach ($eventos as $key => $value) {

		$datainicio = explode(' ', $value['Calendario']['datainicio']);
		$datainicio[0] = implode('/', array_reverse(explode('-', $datainicio[0])));
		$value['Calendario']['datainicio'] = $datainicio[0].' '.substr($datainicio[1], 0, -3);

		$datafim = explode(' ', $value['Calendario']['datafim']);
		$datafim[0] = implode('/', array_reverse(explode('-', $datafim[0])));
		$value['Calendario']['datafim'] = $datafim[0].' '.substr($datafim[1], 0, -3);

		if ($value['Calendario']['datafim'] == '00/00/0000 00:00') {
			$value['Calendario']['datafim'] = '';
		}

		$pdf->Row(array(utf8_decode($value['Calendario']['assunto']), utf8_decode($value['Calendario']['descricao']), utf8_decode($value['Calendario']['datainicio']), utf8_decode($value['Calendario']['datafim'])));
	}
	$pdf->Output();
?>