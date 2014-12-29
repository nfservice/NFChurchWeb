<?php
	App::import('Vendor', 'FPDF', array('file' => 'fpdf/fpdf.php'));
	App::import('Vendor', 'NFPDF', array('file' => 'NFPDF/NFPDF.php'));

	class RelatoriosController extends PatrimonioAppController
	{
		public $uses = '';

		public function bens()
		{
			$this->loadModel('Bem');
			if ($this->request->is('post') || $this->request->is('put')) {
				$conditions = array();
				if ($this->request->data['Relatorio']['ativo'] == '1') {
					$conditions['Bem.quantidade >'] => '0';
				} else if ($this->request->data['Relatorio']['ativo'] == '0') {
					$conditions['Bem.quantidade ='] => '0';
				}
				if (!empty($this->request->data['Relatorio']['titulo'])) {
					$conditions['Bem.membro_id'] = $this->request->data['Relatorio']['membro'];
				}

				if (!empty($this->request->data['Relatorio']['congregacao'])) {
					$conditions['Bem.congregacao_id'] = $this->request->data['Relatorio']['congregacao'];
				}
				if (!empty($this->request->data['Relatorio']['data_compra'])) {
					$conditions['Bem.data_compra'] = $this->request->data['Relatorio']['data_compra'];
				}
				if (!empty($this->request->data['Relatorio']['departamento'])) {
					$conditions['Bem.departamento_id'] = $this->request->data['Relatorio']['departamento'];
				}
				
				$itens = $this->Item->find('all', array('conditions' => $conditions));

				$this->layout = 'pdf';
				$pdf = new NFPDF();
				$this->set('pdf', $pdf);
				$this->response->type('application/pdf');
				$this->set('itens', $itens);
				$this->render('itens_result');
			}
		}
	}