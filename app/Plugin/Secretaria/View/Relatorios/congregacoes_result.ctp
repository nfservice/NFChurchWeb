<?php
	//Inicia Uma nova página de PDF
	$pdf->AddPage('L', 'A4');
	$pdf->SetY(6);
	$pdf->SetX(7);
	//Setando valores da margem
	$pdf->SetMargins(7, 5, 9);
	//Quebra de Linha com 1mm
	$pdf->Ln(1);
	//Passa parametros para Fonte
	$pdf->SetFont('Helvetica', 'B', 11);
	//Topo do relatório
	$topo = "NFCHURCH - GESTÃO PARA IGREJAS \nRelatório de Congregações";
	
	$pdf->SetAutoPageBreak(true, 15);
	$pdf->MultiCell(283,7, utf8_decode($topo), 1, 'J', false);
	$pdf->Ln(5);
	
	$header = array(utf8_decode('Nome'), utf8_decode('Endereço'), utf8_decode('CEP'), utf8_decode('Cidade'), utf8_decode('Estado'), utf8_decode('Telefone'), utf8_decode('E-mail'));
    $pdf->SetWidths(array(50,81,20,35,15,22,60));
	// To be implemented in your own inherited class
	// Seleciona fonte Helvetica bold 15
	$pdf->SetFont('Helvetica','B',8);
	// Titulo dentro de uma caixa
	$pdf->Row($header);
	// Quebra de linha	
	$pdf->Ln();

	$pdf->headerRow = $header;
	
	$pdf->headerFont = array('Helvetica', 'B', 8);

	foreach ($congregacoes as $key => $value) {
		
		$pdf->SetFont('Helvetica', '', 8);
		$pdf->Row(array(utf8_decode($value['Congregacao']['nome']), utf8_decode($value['CongregacaoEndereco']['logradouro'].', '.$value['CongregacaoEndereco']['numero'].' - '.$value['CongregacaoEndereco']['bairro']), utf8_decode($value['CongregacaoEndereco']['cep']), utf8_decode($value['CongregacaoEndereco']['cidade']), utf8_decode($value['CongregacaoEndereco']['estado_id']), utf8_decode($value['Congregacao']['telefone']), utf8_decode($value['Congregacao']['email'])));
	}
	$pdf->Output();
?>