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
	$topo = "NFCHURCH - GESTÃO PARA IGREJAS \nRelatório de Membros";
	
	$pdf->SetAutoPageBreak(true, 15);
	$pdf->MultiCell(196,7, utf8_decode($topo), 1, 'J', false);
	$pdf->Ln(5);
	
	$header = array(utf8_decode('Nome'), utf8_decode('E-mail'), utf8_decode('Telefone'), utf8_decode('Celular'), utf8_decode('Nascimento'), utf8_decode('Membro desde'));

    $pdf->SetWidths(array(65,40,25,25,18,23));
	// To be implemented in your own inherited class
	// Seleciona fonte Helvetica bold 15
	$pdf->SetFont('Helvetica','B',8);
	// Titulo dentro de uma caixa
	$pdf->Row($header);
	// Quebra de linha	
	$pdf->Ln();

	$pdf->headerRow = $header;
	
	$pdf->headerFont = array('Helvetica', 'B', 8);

	foreach ($membros as $key => $value) {
		
		$pdf->SetFont('Helvetica', '', 8);
		if (!empty($value['Membro']['datanascimento'])) {
			$value['Membro']['datanascimento'] = implode('/', array_reverse(explode('-', $value['Membro']['datanascimento'])));
		}
		if (!empty($value['Membro']['datamembro'])) {
			$value['Membro']['datamembro'] = implode('/', array_reverse(explode('-', $value['Membro']['datamembro'])));
		}
		$pdf->Row(array(utf8_decode($value['Membro']['nome']), utf8_decode($value['Membro']['email']), utf8_decode($value['Membro']['fone']), utf8_decode($value['Membro']['cel']), utf8_decode($value['Membro']['datanascimento']), utf8_decode($value['Membro']['datamembro'])));
	}

	$pdf->Ln(5);
	$pdf->SetWidths(array(196));
	$pdf->Row(['Total de registros: '.count($membros)]);

	$pdf->Output();
?>