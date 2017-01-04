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
				if (!empty($this->request->data['Relatorio']['sexo']) || $this->request->data['Relatorio']['sexo'] === '0') {
					$conditions['Membro.sexo'] = (int)$this->request->data['Relatorio']['sexo'];
				}
				if (!empty($this->request->data['Relatorio']['tipo'])) {
					$conditions['Membro.tipo'] = $this->request->data['Relatorio']['tipo'];
				}
				if (!empty($this->request->data['Relatorio']['estadocivil']) || $this->request->data['Relatorio']['estadocivil'] === '0') {
					$conditions['Membro.estadocivil'] = (int)$this->request->data['Relatorio']['estadocivil'];
				}
				if (!empty($this->request->data['Relatorio']['pastorbatismo'])) {
					$conditions['Membro.pastorbatismo'] = $this->request->data['pastorbatismo'];
				}
				$membros = $this->Membro->find(
					'all',
					[
						'conditions' => array($conditions),
						'order' => 'Membro.nome'
					]
				);

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

		public function visitantes()
		{
			if ($this->request->is('post') || $this->request->is('put')) {
				$this->loadModel('Membro');

				$conditions = array();

				$conditions = array(
					'Membro.church_id' => $this->Session->read('choosed'),
					'Membro.tipo' => 'Visitante',
					);
				if (!empty($this->request->data['Relatorio']['datamembro'])) {
					$conditions['Membro.datamembro'] = $this->request->data['Relatorio']['datamembro'];
				}
				if (!empty($this->request->data['Relatorio']['nome'])) {
					$conditions['Membro.nome LIKE'] = '%'.$this->request->data['Relatorio']['nome'].'%';
				}
				if (!empty($this->request->data['Relatorio']['sexo'])) {
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
				$this->render('visitantes_result');
			} else {
				$this->loadModel('Escolaridade');

				$escolaridades = array();
				$escolaridades = $this->Escolaridade->find('list', array('fields' => array('id', 'descricao')));

				$this->set('escolaridades', $escolaridades);
			}
		}

		public function cargos() 
		{
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

		public function profissao()
		{
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

		public function eventos()
		{
			if ($this->request->is('post') || $this->request->is('put')) {
				$this->loadModel('Calendario');				

				$conditions['Calendario.church_id'] = $this->Session->read('choosed');

				if (!empty($this->request->data['Relatorio']['datainicio'])) {
					$datainicio = explode(' ', $this->request->data['Relatorio']['datainicio']);
					$datainicio[0] = implode('-', array_reverse(explode('/', $datainicio[0])));
					$this->request->data['Relatorio']['datainicio'] = $datainicio[0].' '.$datainicio[1].':00';
					$conditions['OR']['Calendario.datainicio >='] = $this->request->data['Relatorio']['datainicio'];
				}

				if (!empty($this->request->data['Relatorio']['datafim'])) {
					$datafim = explode(' ', $this->request->data['Relatorio']['datafim']);
					$datafim[0] = implode('-', array_reverse(explode('/', $datafim[0])));
					$this->request->data['Relatorio']['datafim'] = $datafim[0].' '.$datafim[1].':00';
					$conditions['OR']['Calendario.datafim <='] = $this->request->data['Relatorio']['datafim'];
				}

				if (!empty($this->request->data['Relatorio']['assunto'])) {
					$conditions['OR']['Calendario.assunto LIKE'] = '%'.$this->request->data['Relatorio']['assunto'].'%';
				}
				$eventos = $this->Calendario->find('all', array('conditions' => $conditions));
				$this->layout = 'pdf'; //this will use the pdf.ctp layout
				$pdf = new NFPDF();
				$this->set('pdf', $pdf);
				$this->response->type('application/pdf');
				$this->set('eventos', $eventos);
				$this->render('eventos_result');
			}
		}

		public function departamentos() 
		{
			$this->loadModel('Departamento');
			if ($this->request->is('post') || $this->request->is('put')) {
				$departamentos = $this->Departamento->find('all');
				$this->layout = 'pdf'; //this will use the pdf.ctp layout
				$pdf = new NFPDF();
				$this->set('pdf', $pdf);
				$this->response->type('application/pdf');
				$this->set('departamentos', $departamentos);
				$this->render('departamentos_result');
			}
		}

		public function congregacoes() 
		{
					
			if ($this->request->is('post') || $this->request->is('put')) {
				$this->loadModel('Secretaria.Congregacao');
				if (!empty($this->request->data['Congregacao']['nome'])) {
					$conditions['Congregacao.nome LIKE'] = '%'.$this->request->data['Congregacao']['nome'].'%';
				}

				if (!empty($this->request->data['Congregacao']['bairro'])) {
					$conditions['CongregacaoEndereco.bairro'] = $this->request->data['Congregacao']['bairro'];
				}

				if (!empty($this->request->data['Congregacao']['cidade'])) {
					$conditions['CongregacaoEndereco.cidade'] = $this->request->data['Congregacao']['cidade'];
				}

				if (!empty($this->request->data['Congregacao']['estado'])) {
					$conditions['CongregacaoEndereco.estado_id'] = $this->request->data['Congregacao']['estado'];
				}

				if (empty($conditions)) {
					$congregacoes = $this->Congregacao->CongregacaoEndereco->find('all');
				} else {
					$congregacoes = $this->Congregacao->CongregacaoEndereco->find('all', array('conditions' => $conditions));
				}

				

				$this->layout = 'pdf'; //this will use the pdf.ctp layout
				$pdf = new NFPDF();
				$this->set('pdf', $pdf);
				$this->response->type('application/pdf');
				$this->set('congregacoes', $congregacoes);
				$this->render('congregacoes_result');
			} else {
				$this->loadModel('Estado');

				$estados = $this->Estado->find('list', array('fields' => array('sigla', 'nome')));
				$this->set('estados', $estados);
			}
		}

		public function mapa_membros()
		{
			if ($this->request->is('post') || $this->request->is('put')) {

				$this->loadModel('Secretaria.Membro');

				$conditions = array();

				$this->layout = false;
				if (!empty($this->request->data['Relatorio']['ativo'])) {
					$conditions['Membro.ativo'] = $this->request->data['Relatorio']['ativo'];
					$conditions['Membro.tipo'] = 'Membro';					
				}

				$conditions['Endereco.logradouro !='] = null;

				$this->Membro->all = true;

				$membros = $this->Membro->find('all', array('conditions' => array($conditions)));
				$this->set('membros', $membros);
				$this->render('mapa_membros_result');
			}
		}

		public function grafico_membros()
		{
			if ($this->request->is('post') || $this->request->is('put')) {

				$this->loadModel('Secretaria.Membro');

				$this->request->data['Relatorio']['data_de'] = implode('-', array_reverse(explode('/', $this->request->data['Relatorio']['data_de'])));
				$this->request->data['Relatorio']['data_ate'] = implode('-', array_reverse(explode('/', $this->request->data['Relatorio']['data_ate'])));

				$this->Membro->virtualFields = array('soma' => 'COUNT(datamembro)', 'mes' => 'MONTH(datamembro)', 'ano' => 'YEAR(datamembro)');
				$membros = $this->Membro->find(
					'all',
					array(
						'group' => array('MONTH(datamembro)', 'YEAR(datamembro)'),
						'fields' => array('soma', 'mes', 'ano'),
						'conditions' => array(
							'ativo' => '1',
							'datamembro BETWEEN ? AND ?' => array($this->request->data['Relatorio']['data_de'], $this->request->data['Relatorio']['data_ate'])
						),
						'order' => 'datamembro'
					)
				);
				$this->set('membros', $membros);
				$this->render('grafico_membros_result');
			}
		}
	}