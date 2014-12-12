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
	$topo = "NFCHURCH - GESTÃO PARA IGREJAS \nRelatório de Itens da Biblioteca\n";
	if (!empty($autor)) {
		$topo .= "Autor: ".$autor['Autor']['nome']."\t|";
	}
	if (!empty($categoria)) {
		$topo .= "\tCategoria: ".$categoria['Categoria']['nome']."\t|";
	}
	
	if (!empty($editora)) {
		$topo .= "\tEditora: ".$editora['Editora']['nome']."\t|";
	}

	if (!empty($tipo)) {
		$topo .= "\tTipo: ".$tipo['Tipo']['nome']."\t|";
	}
	
	
	
	$pdf->SetAutoPageBreak(true, 15);
	$pdf->MultiCell(196,7, utf8_decode($topo), 1, 'J', false);
	$pdf->Ln(5);
	
	$header = array(utf8_decode('ISBN'), utf8_decode('Titulo'), utf8_decode('Páginas'), utf8_decode('Estoque'), utf8_decode('Comentários'));

    $pdf->SetWidths(array(22, 70, 15, 15, 74));
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
		$pdf->Row(array(utf8_decode($value['Item']['isbn']), utf8_decode($value['Item']['titulo']), utf8_decode($value['Item']['paginas']), utf8_decode($value['Item']['estoque']), utf8_decode($value['Item']['comentarios'])));
	}
	$pdf->Output();
?>