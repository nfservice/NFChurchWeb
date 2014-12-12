<?php
	class EditorasController extends BibliotecaAppController{
		public function index(){
			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro']))
	    	{
	    		//condições para pesquisa
	    		//campos para não entrar na pesquisa
	    		$excludes = array('id', 'sexo', 'estado_id', 'estadocivil', 'escolaridade', 'profissao_id', 'igrejasanteriores', 'created', 'modified', 'uid', 'church_id', 'user_id', 'tipo');
	    		//pega campos da model
	    		$fields = $this->Editora->schema();
	    		foreach ($fields as $key => $value) {
	    			if (!in_array($key, $excludes)) {
	    				$conditions['OR']['Editora.'.$key.' LIKE '] = '%'.$this->request->data['filtro'].'%';
	    			}
	    		}
	    		
	    	}
			$this->set('tipo_bens', $this->paginate(null, $conditions));
		}

		public function add(){
			if ($this->request->is('post') || $this->request->is('put')) {
				$this->Editora->create();
				if ($this->Editora->save($this->request->data)) {
					$this->Session->setFlash('Editora cadastrada com sucesso!');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Não foi possível cadastrar a editora');
				}
			}
		}

		public function view($id = null){
			$this->Editora->id = $id;
			if (!empty($this->Editora->id)) {
				$this->request->data = $this->Editora->read(null, $id);
			} else {
				throw new Exception("Editora inexistente");
			}
		}

		public function edit($id = null){
			$this->Editora->id = $id;
			if (empty($this->Editora->id)) {
				throw new Exception("Editora inexistente");				
			}
			if ($this->request->is('post')||($this->request->is('put'))) {
				if (!$this->Editora->exists()) {
					throw new Exception("Editora inexistente");
				}
				if (!empty($this->Editora->id)) {
					if ($this->Editora->save($this->request->data)) {
						$this->Session->setFlash('Editora alterada com sucesso');
					} else {
						$this->Session->setFlash('Não foi possível cadastrar a editora');
					}			
				}
			} else {
				$this->request->data = $this->Editora->read(null, $id);		
			}
		}

		public function delete($id = null)
		{
			$this->autoRender = false;
			if (!$this->request->is('post') || empty($id)) {
				throw new MethodNotAllowedException();
			}

			$this->request->data = $this->Editora->read(null, $id);
			$this->Editora->id = $id;

			if (!$this->Editora->exists()) {
				throw new NotFoundException(__('Editora inválida.'));
			}
			if ($this->Editora->delete()) {
				$this->Session->setFlash(__('Editora deletada com sucesso.'));
			}
			$this->Session->setFlash(__('A Editora não pôde ser deletada.'));
		}
	}