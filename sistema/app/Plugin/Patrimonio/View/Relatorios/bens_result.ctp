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
	$topo = "NFCHURCH - GESTÃO PARA IGREJAS \nRelatório de Bens";
	
	$pdf->SetAutoPageBreak(true, 15);
	$pdf->MultiCell(196,7, utf8_decode($topo), 1, 'J', false);
	$pdf->Ln(5);
	
	$header = array(utf8_decode('Nome'), utf8_decode('Num. Ativo'), utf8_decode('Tipo'), utf8_decode('Congregacao'), utf8_decode('Data Compra'));

    $pdf->SetWidths(array(80,30, 28, 38, 20));
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
	foreach ($itens as $key => $value) {

		$datainicio = explode(' ', $value['Bem']['data_compra']);
		$datainicio[0] = implode('/', array_reverse(explode('-', $datainicio[0])));
		$value['Bem']['data_compra'] = $datainicio[0];

		if ($value['Bem']['data_compra'] == '00/00/0000 00:00') {
			$value['Bem']['data_compra'] = '';
		}

		$pdf->Row(array(utf8_decode($value['Bem']['nome']), utf8_decode($value['Bem']['num_ativo']), utf8_decode($value['TipoBem']['nome']), utf8_decode($value['Congregacao']['nome']), utf8_decode($value['Bem']['data_compra'])));
	}
	$pdf->Output();
?>