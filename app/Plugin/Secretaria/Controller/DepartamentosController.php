<?php
	class DepartamentosController extends SecretariaAppController{
		public function index(){
			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro']))
	    	{
	    		//condições para pesquisa
	    		//campos para não entrar na pesquisa
	    		$excludes = array('id', 'sexo', 'estado_id', 'estadocivil', 'escolaridade', 'departamento_id', 'igrejasanteriores', 'created', 'modified', 'uid', 'church_id', 'user_id', 'tipo');
	    		//pega campos da model
	    		$fields = $this->Departamento->schema();
	    		foreach ($fields as $key => $value) {
	    			if (!in_array($key, $excludes)) {
	    				$conditions['OR']['Departamento.'.$key.' LIKE '] = '%'.$this->request->data['filtro'].'%';
	    			}
	    		}
	    		
	    	}
			$this->set('departamentos', $this->paginate(null, $conditions));
		}

		public function add(){
			if ($this->request->is('post') || $this->request->is('put')) {
				$this->Departamento->create();
				if ($this->Departamento->save($this->request->data)) {
					$this->Session->setFlash('Departamento cadastrado com sucesso!');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Não foi possível cadastrar o departamento.');
				}
			}
		}

		public function view($id = null){
			$this->Departamento->id = $id;
			if (!empty($this->Departamento->id)) {
				$this->request->data = $this->Departamento->read(null, $id);
			} else {
				throw new Exception("Departamento inexistente");
			}
		}

		public function edit($id = null){
			$this->Departamento->id = $id;
			if (empty($this->Departamento->id)) {
				throw new Exception("Departamento inexistente");				
			}
			if ($this->request->is('post')||($this->request->is('put'))) {
				if (!$this->Departamento->exists()) {
					throw new Exception("Departamento inexistente");
				}
				if (!empty($this->Departamento->id)) {
					if ($this->Departamento->save($this->request->data)) {
						$this->Session->setFlash('Departamento alterado com sucesso!');
					} else {
						$this->Session->setFlash('Não foi possível cadastrar o departamento.');
					}			
				}
			} else {
				$this->request->data = $this->Departamento->read(null, $id);		
			}
		}

		public function delete($id = null)
		{
			$this->autoRender = false;
			if (!$this->request->is('post') || empty($id)) {
				throw new MethodNotAllowedException();
			}

			$this->request->data = $this->Departamento->read(null, $id);
			$this->Departamento->id = $id;

			if (!$this->Departamento->exists()) {
				throw new NotFoundException(__('Departamento inválido.'));
			}
			if ($this->Departamento->delete()) {
				$this->Session->setFlash(__('Departamento deletado com sucesso.'));
			}
			$this->Session->setFlash(__('O Departamento não pôde ser deletado.'));
		}
	}