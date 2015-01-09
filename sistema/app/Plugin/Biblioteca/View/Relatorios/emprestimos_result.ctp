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
	$topo = "NFCHURCH - GESTÃO PARA IGREJAS \nRelatório de Empréstimos da Biblioteca\n";
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
	
	$header = array(utf8_decode('Data'), utf8_decode('Quantidade'), utf8_decode('Titulo'), utf8_decode('Autor'), utf8_decode('Membro'));

    $pdf->SetWidths(array(20, 20, 60, 41, 55));
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
		$value['MovimentacaoItem']['created'] = explode(' ', $value['MovimentacaoItem']['created']);
		$value['MovimentacaoItem']['created'] = implode('/', array_reverse(explode('-', $value['MovimentacaoItem']['created'][0])));
		$pdf->Row(array(utf8_decode($value['MovimentacaoItem']['created']), $value['MovimentacaoItem']['quantidade'], utf8_decode($value['Item']['titulo']), utf8_decode($value['Item']['Autor']['nome']), utf8_decode($value['Membro']['nome'])));
	}
	$pdf->Output();
?>