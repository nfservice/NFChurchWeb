<?php
	class CategoriasController extends BibliotecaAppController{
		public function index(){
			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro']))
	    	{
	    		//condições para pesquisa
	    		//campos para não entrar na pesquisa
	    		$excludes = array('id', 'sexo', 'estado_id', 'estadocivil', 'escolaridade', 'profissao_id', 'igrejasanteriores', 'created', 'modified', 'uid', 'church_id', 'user_id', 'tipo');
	    		//pega campos da model
	    		$fields = $this->Categoria->schema();
	    		foreach ($fields as $key => $value) {
	    			if (!in_array($key, $excludes)) {
	    				$conditions['OR']['Categoria.'.$key.' LIKE '] = '%'.$this->request->data['filtro'].'%';
	    			}
	    		}
	    		
	    	}
			$this->set('tipo_bens', $this->paginate(null, $conditions));
		}

		public function add(){
			if ($this->request->is('post') || $this->request->is('put')) {
				$this->Categoria->create();
				if ($this->Categoria->save($this->request->data)) {
					$this->Session->setFlash('Categoria cadastrada com sucesso!');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Não foi possível cadastrar a categoria');
				}
			}
		}

		public function view($id = null){
			$this->Categoria->id = $id;
			if (!empty($this->Categoria->id)) {
				$this->request->data = $this->Categoria->read(null, $id);
			} else {
				throw new Exception("Categoria inexistente");
			}
		}

		public function edit($id = null){
			$this->Categoria->id = $id;
			if (empty($this->Categoria->id)) {
				throw new Exception("Categoria inexistente");				
			}
			if ($this->request->is('post')||($this->request->is('put'))) {
				if (!$this->Categoria->exists()) {
					throw new Exception("Categoria inexistente");
				}
				if (!empty($this->Categoria->id)) {
					if ($this->Categoria->save($this->request->data)) {
						$this->Session->setFlash('Categoria alterada com sucesso');
					} else {
						$this->Session->setFlash('Não foi possível cadastrar a categoria');
					}			
				}
			} else {
				$this->request->data = $this->Categoria->read(null, $id);		
			}
		}

		public function delete($id = null)
		{
			$this->autoRender = false;
			if (!$this->request->is('post') || empty($id)) {
				throw new MethodNotAllowedException();
			}

			$this->request->data = $this->Categoria->read(null, $id);
			$this->Categoria->id = $id;

			if (!$this->Categoria->exists()) {
				throw new NotFoundException(__('Categoria inválida.'));
			}
			if ($this->Categoria->delete()) {
				$this->Session->setFlash(__('Categoria deletada com sucesso.'));
			}
			$this->Session->setFlash(__('A Categoria não pôde ser deletada.'));
		}
	}