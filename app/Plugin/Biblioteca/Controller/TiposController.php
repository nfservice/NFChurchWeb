<?php
	class TiposController extends BibliotecaAppController{
		public function index(){
			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro']))
	    	{
	    		//condições para pesquisa
	    		//campos para não entrar na pesquisa
	    		$excludes = array('id', 'sexo', 'estado_id', 'estadocivil', 'escolaridade', 'profissao_id', 'igrejasanteriores', 'created', 'modified', 'uid', 'church_id', 'user_id', 'tipo');
	    		//pega campos da model
	    		$fields = $this->Tipo->schema();
	    		foreach ($fields as $key => $value) {
	    			if (!in_array($key, $excludes)) {
	    				$conditions['OR']['Tipo.'.$key.' LIKE '] = '%'.$this->request->data['filtro'].'%';
	    			}
	    		}
	    		
	    	}
			$this->set('tipo_bens', $this->paginate(null, $conditions));
		}

		public function add(){
			if ($this->request->is('post') || $this->request->is('put')) {
				$this->Tipo->create();
				if ($this->Tipo->save($this->request->data)) {
					$this->Session->setFlash('Tipo cadastrado com sucesso!');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Não foi possível cadastrar o tipo');
				}
			}
		}

		public function view($id = null){
			$this->Tipo->id = $id;
			if (!empty($this->Tipo->id)) {
				$this->request->data = $this->Tipo->read(null, $id);
			} else {
				throw new Exception("Tipo inexistente");
			}
		}

		public function edit($id = null){
			$this->Tipo->id = $id;
			if (empty($this->Tipo->id)) {
				throw new Exception("Tipo inexistente");				
			}
			if ($this->request->is('post')||($this->request->is('put'))) {
				if (!$this->Tipo->exists()) {
					throw new Exception("Tipo inexistente");
				}
				if (!empty($this->Tipo->id)) {
					if ($this->Tipo->save($this->request->data)) {
						$this->Session->setFlash('Tipo alterado com sucesso');
					} else {
						$this->Session->setFlash('Não foi possível cadastrar o tipo');
					}			
				}
			} else {
				$this->request->data = $this->Tipo->read(null, $id);		
			}
		}

		public function delete($id = null)
		{
			$this->autoRender = false;
			if (!$this->request->is('post') || empty($id)) {
				throw new MethodNotAllowedException();
			}

			$this->request->data = $this->Tipo->read(null, $id);
			$this->Tipo->id = $id;

			if (!$this->Tipo->exists()) {
				throw new NotFoundException(__('Tipo inválido.'));
			}
			if ($this->Tipo->delete()) {
				$this->Session->setFlash(__('Tipo deletado com sucesso.'));
			}
			$this->Session->setFlash(__('O Tipo não pôde ser deletado.'));
		}
	}