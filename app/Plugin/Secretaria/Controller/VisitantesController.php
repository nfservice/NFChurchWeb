<?php
	class VisitantesController extends SecretariaAppController{
		public function index(){
			$this->layout = false;
			
			$this->loadModel('Estado');
			$estados = $this->Estado->find('list', array('fields' => array('codibge', 'sigla')));
			$this->set('estados', $estados);

			$conditions = array();
			$conditions['Visitante.tipo ='] = 2;
			$this->set('visitantes', $this->paginate(null, $conditions));
		}
		public function add(){
			$this->layout = false;
			$this->loadModel('Estado');
			if ($this->request->is('post') || $this->request->is('put')) {
				if (!empty($this->request->data['Visitante']['datanascimento'])) {
					$this->request->data['Visitante']['datanascimento'] = implode('-', array_reverse(explode('/', $this->request->data['Visitante']['datanascimento'])));
				}

				$this->Visitante->create();
				if ($this->Visitante->saveAll($this->request->data)) {
					$this->Session->setFlash('Visitante Cadastrado Com Sucesso');
					//$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Não Foi Possível Cadastrar o Visitante');
				}
			}
			$estados = $this->Estado->find('list', array('fields' => array('codibge', 'sigla')));
			$this->set('estados', $estados);
			//
		}
		public function edit($id = null){

			$this->layout = false;
			
			$this->Visitante->id = $id;
			if (!$this->Visitante->exists()) {
				throw new NotFoundException(__('Visitante inválido.'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if (!empty($this->request->data['Visitante']['datanascimento'])) {
					$this->request->data['Visitante']['datanascimento'] = implode('-', array_reverse(explode('/', $this->request->data['Visitante']['datanascimento'])));
				}
				if ($this->Visitante->saveAll($this->request->data)) {
					$this->Session->setFlash('Visitante Editado Com Sucesso!');
					//$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Impossivel Editar o Visitante');
				}
			} else {
				$this->request->data = $this->Visitante->read(null, $id);
				$this->loadModel('Estado');
				$estados = $this->Estado->find('list', array('fields' => array('codibge', 'sigla')));
				$this->set('estados', $estados);
			}
			//
		}
		public function view($id = null)
		{
			$this->layout = false;
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
			$this->layout = false;
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