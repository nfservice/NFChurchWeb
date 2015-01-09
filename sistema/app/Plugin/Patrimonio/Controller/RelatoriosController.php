<?php
	App::import('Vendor', 'FPDF', array('file' => 'fpdf/fpdf.php'));
	App::import('Vendor', 'NFPDF', array('file' => 'NFPDF/NFPDF.php'));

	class RelatoriosController extends PatrimonioAppController
	{
		public $uses = '';

		public function beforeFilter(){
			parent::beforeFilter();
			$this->loadModel('Patrimonio.Bem');
			$this->loadModel('Patrimonio.MovimentacaoBem');
			$this->loadModel('Patrimonio.TipoBem');
			$this->loadModel('Secretaria.Congregacao');
		}

		public function bens()
		{
			if ($this->request->is('post') || $this->request->is('put')) {
				$conditions = array();
				if (!empty($this->request->data['Relatorio']['num_ativo'])) {
					$conditions['Bem.num_ativo'] = $this->request->data['Relatorio']['num_ativo'];
				}
				if (!empty($this->request->data['Relatorio']['nome'])) {
					$conditions['Bem.nome LIKE'] = '%'.$this->request->data['Relatorio']['nome'].'%';
				}

				if (!empty($this->request->data['Relatorio']['tipo_id'])) {
					$conditions['Bem.tipo_bem_id'] = $this->request->data['Relatorio']['tipo_id'];
				}
				if (!empty($this->request->data['Relatorio']['data_compra'])) {
					$conditions['Bem.data_compra'] = $this->request->data['Relatorio']['data_compra'];
				}
				if (!empty($this->request->data['Relatorio']['congregacao_id'])) {
					$conditions['Bem.congrecacao_id'] = $this->request->data['Relatorio']['congregacao_id'];
				}
				
				$itens = $this->Bem->find('all', array('conditions' => $conditions));
				$this->layout = 'pdf';
				$pdf = new NFPDF();
				$this->set('pdf', $pdf);
				$this->response->type('application/pdf');
				$this->set('itens', $itens);
				$this->render('bens_result');
			}
			$tipo = $this->TipoBem->find('list', array('conditions' => array('TipoBem.church_id' => $this->Session->read('choosed')), 'fields' => array('id', 'nome')));
			$congregacao = $this->Congregacao->find('list', array('conditions' => array('Congregacao.church_id' => $this->Session->read('choosed')), 'fields' => array('id', 'nome')));
			$this->set('congregacao', $congregacao);
			$this->set('tipo', $tipo);
		}

		public function movimentacao_bens()
		{
			if ($this->request->is('post') || $this->request->is('put')) {
				$conditions = array();
				if (!empty($this->request->data['Relatorio']['bem_id'])) {
					$conditions['MovimentacaoBem.bem_id'] = $this->request->data['Relatorio']['bem_id'];
				}

				$itens = $this->MovimentacaoBem->find('all', array('conditions' => $conditions));

				if (!empty($itens[0]['Bem']['nome'])) {
					$bem = $itens[0]['Bem']['nome'];
				} else {
					$bem = '';
				}
				$this->layout = 'pdf';
				$pdf = new NFPDF();
				$this->set('pdf', $pdf);
				$this->response->type('application/pdf');
				$this->set('itens', $itens);
				$this->set('bem', $bem);
				$this->render('movimentacao_bens_result');
			}
			$bem = $this->Bem->find('list', array('conditions' => array('Bem.church_id' => $this->Session->read('choosed')), 'fields' => array('id', 'nome')));
			$this->set('bem', $bem);
		}
	}