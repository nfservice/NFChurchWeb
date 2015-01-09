<?php
	class AutoresController extends BibliotecaAppController{

		public $uses = array('Biblioteca.Autor');

		public function index(){
			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro']))
	    	{
	    		//condições para pesquisa
	    		//campos para não entrar na pesquisa
	    		$excludes = array('id', 'sexo', 'estado_id', 'estadocivil', 'escolaridade', 'profissao_id', 'igrejasanteriores', 'created', 'modified', 'uid', 'church_id', 'user_id', 'tipo');
	    		//pega campos da model
	    		$fields = $this->Autor->schema();
	    		foreach ($fields as $key => $value) {
	    			if (!in_array($key, $excludes)) {
	    				$conditions['OR']['Autor.'.$key.' LIKE '] = '%'.$this->request->data['filtro'].'%';
	    			}
	    		}
	    		
	    	}
			$this->set('tipo_bens', $this->paginate(null, $conditions));
		}

		public function add(){
			if ($this->request->is('post') || $this->request->is('put')) {
				$this->Autor->create();
				if ($this->Autor->save($this->request->data)) {
					$this->Session->setFlash('Autor cadastrado com sucesso!');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Não foi possível cadastrar o autor');
				}
			}
		}

		public function view($id = null){
			$this->Autor->id = $id;
			if (!empty($this->Autor->id)) {
				$this->request->data = $this->Autor->read(null, $id);
			} else {
				throw new Exception("Autor inexistente");
			}
		}

		public function edit($id = null){
			$this->Autor->id = $id;
			if (empty($this->Autor->id)) {
				throw new Exception("Autor inexistente");				
			}
			if ($this->request->is('post')||($this->request->is('put'))) {
				if (!$this->Autor->exists()) {
					throw new Exception("Autor inexistente");
				}
				if (!empty($this->Autor->id)) {
					if ($this->Autor->save($this->request->data)) {
						$this->Session->setFlash('Autor alterado com sucesso');
					} else {
						$this->Session->setFlash('Não foi possível cadastrar o autor');
					}			
				}
			} else {
				$this->request->data = $this->Autor->read(null, $id);		
			}
		}

		public function delete($id = null)
		{
			$this->autoRender = false;
			if (!$this->request->is('post') || empty($id)) {
				throw new MethodNotAllowedException();
			}

			$this->request->data = $this->Autor->read(null, $id);
			$this->Autor->id = $id;

			if (!$this->Autor->exists()) {
				throw new NotFoundException(__('Autor inexistente.'));
			}
			if ($this->Autor->delete()) {
				$this->Session->setFlash(__('Autor deletado com sucesso.'));
			}
			$this->Session->setFlash(__('O Autor não pôde ser deletado.'));
		}
	}