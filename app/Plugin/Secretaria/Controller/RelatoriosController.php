<?php
	App::import('Vendor', 'FPDF', array('file' => 'fpdf/fpdf.php'));
	App::import('Vendor', 'NFPDF', array('file' => 'NFPDF/NFPDF.php'));
	
	class RelatoriosController extends SecretariaAppController {
	
		public $uses = array();
		
		public function membros()
		{
			if ($this->request->is('post') || $this->request->is('put')) {
				$this->loadModel('Membro');

				$conditions = array();

				$conditions = array(
					'Membro.church_id' => $this->Session->read('choosed'),
					);

				if (!empty($this->request->data['Relatorio']['datamembro'])) {
					$conditions['Membro.datamembro'] = $this->request->data['Relatorio']['datamembro'];
				}
				if (!empty($this->request->data['Relatorio']['nome'])) {
					$conditions['Membro.nome LIKE'] = '%'.$this->request->data['Relatorio']['nome'].'%';
				}
				if (!empty($this->request->data['Relatorio']['sexo']) or $this->request->data['Relatorio']['sexo'] == 0) {
					$conditions['Membro.sexo'] = $this->request->data['Relatorio']['sexo'];
				}
				if (!empty($this->request->data['Relatorio']['estadocivil'])) {
					$conditions['Membro.estadocivil'] = $this->request->data['Relatorio']['estadocivil'];
				}
				if (!empty($this->request->data['Relatorio']['pastorbatismo'])) {
					$conditions['Membro.pastorbatismo'] = $this->request->data['pastorbatismo'];
				}

				$membros = $this->Membro->find('all', array('conditions' => array($conditions)));

				$this->layout = 'pdf'; //this will use the pdf.ctp layout			
				$pdf = new NFPDF();
				$this->set('pdf', $pdf);
				$this->response->type('application/pdf');

				$this->set('membros', $membros);
				$this->render('membros_result');
			} else {
				$this->loadModel('Escolaridade');

				$escolaridades = array();
				$escolaridades = $this->Escolaridade->find('list', array('fields' => array('id', 'descricao')));

				$this->set('escolaridades', $escolaridades);
			}
		}

		public function usuarios()
		{
			if ($this->request->is('post') || $this->request->is('put')) {
				$this->loadModel('User');

				$conditions = array();

				$conditions = array(
					'User.church_id' => $this->Session->read('choosed'),
					);

				if (!empty($this->request->data['Relatorio']['username'])) {
					$conditions['User.username LIKE'] = '%'.$this->request->data['Relatorio']['username'].'%';
				}
				if (!empty($this->request->data['Relatorio']['nome'])) {
					$conditions['User.nome LIKE'] = '%'.$this->request->data['Relatorio']['nome'].'%';
				}
				if (!empty($this->request->data['Relatorio']['telefone'])) {
					$conditions['User.telefone'] = $this->request->data['Relatorio']['telefone'];
				}
				if (!empty($this->request->data['Relatorio']['cpf'])) {
					$conditions['User.cpf'] = $this->request->data['Relatorio']['cpf'];
				}

				$usuarios = $this->User->find('all', array('conditions' => array($conditions)));

				$this->layout = 'pdf'; //this will use the pdf.ctp layout			
				$pdf = new NFPDF();
				$this->set('pdf', $pdf);
				$this->response->type('application/pdf');

				$this->set('usuarios', $usuarios);
				$this->render('usuarios_result');
			} else {
				$this->loadModel('Escolaridade');

				$escolaridades = array();
				$escolaridades = $this->Escolaridade->find('list', array('fields' => array('id', 'descricao')));

				$this->set('escolaridades', $escolaridades);
			}
		}

		public function cargos() {
			$this->loadModel('Cargo');
			if ($this->request->is('post') || $this->request->is('put')) {
				$cargos = $this->Cargo->find('all');
				$this->layout = 'pdf'; //this will use the pdf.ctp layout			
				$pdf = new NFPDF();
				$this->set('pdf', $pdf);
				$this->response->type('application/pdf');

				$this->set('cargos', $cargos);
				$this->render('cargos_result');
			}
		}

		public function profissao() {
			$this->loadModel('Profissao');
			if ($this->request->is('post') || $this->request->is('put')) {
				$profissoes = $this->Profissao->find('all');
				$this->layout = 'pdf'; //this will use the pdf.ctp layout			
				$pdf = new NFPDF();
				$this->set('pdf', $pdf);
				$this->response->type('application/pdf');
				$this->set('profissoes', $profissoes);
				$this->render('profissao_result');
			}
		}
	}