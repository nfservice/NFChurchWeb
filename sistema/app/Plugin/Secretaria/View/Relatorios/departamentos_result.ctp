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
	$topo = "NFCHURCH - GESTÃO PARA IGREJAS \nRelatório de Departamentos";
	
	$pdf->SetAutoPageBreak(true, 15);
	$pdf->MultiCell(196,7, utf8_decode($topo), 1, 'J', false);
	$pdf->Ln(5);
	
	$header = array(utf8_decode('Nome'), utf8_decode('Descrição'));
    $pdf->SetWidths(array(130, 66));
	// To be implemented in your own inherited class
	// Seleciona fonte Helvetica bold 15
	$pdf->SetFont('Helvetica','B',8);
	// Titulo dentro de uma caixa
	$pdf->Row($header);
	// Quebra de linha	
	$pdf->Ln();

	$pdf->headerRow = $header;
	
	$pdf->headerFont = array('Helvetica', 'B', 8);

	foreach ($departamentos as $key => $value) {
		
		$pdf->SetFont('Helvetica', '', 8);
		$pdf->Row(array(utf8_decode($value['Departamento']['nome']), utf8_decode($value['Departamento']['descricao'])));
	}
	$pdf->Output();
?>