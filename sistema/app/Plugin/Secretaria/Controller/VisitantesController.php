<?php
	class VisitantesController extends SecretariaAppController{
		public function index(){
			$this->loadModel('Estado');
			$estados = $this->Estado->find('list', array('fields' => array('codibge', 'sigla')));
			$this->set('estados', $estados);

			$this->Visitante->recursive = -1;

			$conditions = array();
			$conditions['Visitante.tipo ='] = 'Visitante';
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro']))
	    	{
	    		//condições para pesquisa
	    		//campos para não entrar na pesquisa
	    		$excludes = array('id', 'sexo', 'estado_id', 'estadocivil', 'escolaridade', 'profissao_id', 'igrejasanteriores', 'created', 'modified', 'uid', 'church_id', 'user_id', 'tipo');
	    		//pega campos da model
	    		$fields = $this->Visitante->schema();
	    		foreach ($fields as $key => $value) {
	    			if (!in_array($key, $excludes)) {
	    				$conditions['OR']['Visitante.'.$key.' LIKE '] = '%'.$this->request->data['filtro'].'%';
	    			}
	    		}
	    		
	    	}
			$this->set('visitantes', $this->paginate(null, $conditions));
		}
		public function add(){
			$this->loadModel('Estado');
			if ($this->request->is('post') || $this->request->is('put')) {
				if (!empty($this->request->data['Visitante']['datanascimento'])) {
					$this->request->data['Visitante']['datanascimento'] = implode('-', array_reverse(explode('/', $this->request->data['Visitante']['datanascimento'])));
				}

				$this->Visitante->create();

				$address = $this->request->data['Endereco']['logradouro'].', '.$this->request->data['Endereco']['numero'].' - '.$this->request->data['Endereco']['bairro'].' - '.$this->request->data['Endereco']['cidade'].' - SP';
				$prepAddr = str_replace(' ','+',$address);			 
				$geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');			 
				$output = json_decode($geocode);
				 
				$lat = $output->results[0]->geometry->location->lat;
				$long = $output->results[0]->geometry->location->lng;

				$this->request->data['Visitante']['latitude'] = $lat;
				$this->request->data['Visitante']['longitude'] = $long;

				if ($this->Visitante->saveAll($this->request->data)) {
					$this->Session->setFlash('Visitante cadastrado com sucesso!');
					//$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Não foi possível cadastrar o Visitante');
				}
			}
			$estados = $this->Estado->find('list', array('fields' => array('codibge', 'sigla')));
			$this->set('estados', $estados);
			//
		}
		public function edit($id = null){
			$this->Visitante->id = $id;
			if (!$this->Visitante->exists()) {
				throw new NotFoundException(__('Visitante inválido.'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if (!empty($this->request->data['Visitante']['datanascimento'])) {
					$this->request->data['Visitante']['datanascimento'] = implode('-', array_reverse(explode('/', $this->request->data['Visitante']['datanascimento'])));
				}

				$address = $this->request->data['Endereco']['logradouro'].', '.$this->request->data['Endereco']['numero'].' - '.$this->request->data['Endereco']['bairro'].' - '.$this->request->data['Endereco']['cidade'].' - SP';
				$prepAddr = str_replace(' ','+',$address);
				$geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');			 
				$output = json_decode($geocode);
				 
				$lat = $output->results[0]->geometry->location->lat;
				$long = $output->results[0]->geometry->location->lng;

				$this->request->data['Membro']['latitude'] = $lat;
				$this->request->data['Membro']['longitude'] = $long;

				if ($this->Visitante->saveAll($this->request->data)) {
					$this->Session->setFlash('Visitante Editado Com Sucesso!');
					//$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Impossivel Editar o Visitante');
				}
			} else {
				$this->request->data = $this->Visitante->read(null, $id);

				$data_nasc = $this->request->data['Visitante']['datanascimento'];

				$data_nasc = explode(' ', $data_nasc);
				$data_nasc = explode('-', $data_nasc[0]);
				if (!empty($this->request->data['Visitante']['datanascimento'])) {
					$this->request->data['Visitante']['datanascimento'] = $data_nasc[2]."/".$data_nasc[1]."/".$data_nasc[0];
				}

				$this->loadModel('Estado');
				$estados = $this->Estado->find('list', array('fields' => array('codibge', 'sigla')));
				$this->set('estados', $estados);
			}
			//
		}
		public function view($id = null)
		{
			$this->Visitante->id = $id;
			if (!$this->Visitante->exists()) {
				throw new NotFoundException(__('Visitante inválido.'));	
			}
			$this->request->data = $this->Visitante->read(null, $id);
			$this->loadModel('Estado');
			$estados = $this->Estado->find('list', array('fields' => array('codibge', 'sigla')));
			$this->set('estados', $estados);
			//$this->layout = '';
		}
		public function delete($id = null)
		{
			if (!$this->request->is('post') || empty($id)) {
				throw new MethodNotAllowedException();
			}
			$this->request->data = $this->Visitante->read(null, $id);
			$this->Visitante->id = $id;
			if (!$this->Visitante->exists()) {
				throw new NotFoundException(__('Visitante inválido.'));
			}
			if ($this->Visitante->delete()) {
				$this->Session->setFlash(__('Visitante deletado com sucesso.'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('O Visitante não pôde ser deletado.'));
			$this->redirect(array('action' => 'index'));
		}
	}