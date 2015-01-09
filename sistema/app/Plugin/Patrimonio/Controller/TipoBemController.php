<?php
	class TipoBemController extends PatrimonioAppController{
		public function index(){
			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro']))
	    	{
	    		//condições para pesquisa
	    		//campos para não entrar na pesquisa
	    		$excludes = array('id', 'sexo', 'estado_id', 'estadocivil', 'escolaridade', 'profissao_id', 'igrejasanteriores', 'created', 'modified', 'uid', 'church_id', 'user_id', 'tipo');
	    		//pega campos da model
	    		$fields = $this->TipoBem->schema();
	    		foreach ($fields as $key => $value) {
	    			if (!in_array($key, $excludes)) {
	    				$conditions['OR']['TipoBem.'.$key.' LIKE '] = '%'.$this->request->data['filtro'].'%';
	    			}
	    		}
	    		
	    	}
			$this->set('tipo_bens', $this->paginate(null, $conditions));
		}

		public function add(){
			if ($this->request->is('post') || $this->request->is('put')) {
				$this->TipoBem->create();
				if ($this->TipoBem->save($this->request->data)) {
					$this->Session->setFlash('Tipo cadastrado com sucesso!');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Não foi possível cadastrar o tipo');
				}
			}
		}

		public function view($id = null){
			$this->TipoBem->id = $id;
			if (!empty($this->TipoBem->id)) {
				$this->request->data = $this->TipoBem->read(null, $id);
			} else {
				throw new Exception("Tipo inexistente");
			}
		}

		public function edit($id = null){
			$this->TipoBem->id = $id;
			if (empty($this->TipoBem->id)) {
				throw new Exception("Tipo inexistente");				
			}
			if ($this->request->is('post')||($this->request->is('put'))) {
				if (!$this->TipoBem->exists()) {
					throw new Exception("Tipo inexistente");
				}
				if (!empty($this->TipoBem->id)) {
					if ($this->TipoBem->save($this->request->data)) {
						$this->Session->setFlash('Tipo alterado com sucesso');
					} else {
						$this->Session->setFlash('Não foi possível cadastrar o tipo');
					}			
				}
			} else {
				$this->request->data = $this->TipoBem->read(null, $id);		
			}
		}

		public function delete($id = null)
		{
			$this->autoRender = false;
			if (!$this->request->is('post') || empty($id)) {
				throw new MethodNotAllowedException();
			}

			$this->request->data = $this->TipoBem->read(null, $id);
			$this->TipoBem->id = $id;

			if (!$this->TipoBem->exists()) {
				throw new NotFoundException(__('Tipo inválido.'));
			}
			if ($this->TipoBem->delete()) {
				$this->Session->setFlash(__('Tipo deletado com sucesso.'));
			}
			$this->Session->setFlash(__('O Tipo não pôde ser deletado.'));
		}
	}