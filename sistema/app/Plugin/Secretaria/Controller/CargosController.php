<?php
	class CargosController extends SecretariaAppController{
		public function index(){
			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro']))
	    	{
	    		//condições para pesquisa
	    		//campos para não entrar na pesquisa
	    		$excludes = array('id', 'sexo', 'estado_id', 'estadocivil', 'escolaridade', 'profissao_id', 'igrejasanteriores', 'created', 'modified', 'uid', 'church_id', 'user_id', 'tipo');
	    		//pega campos da model
	    		$fields = $this->Cargo->schema();
	    		foreach ($fields as $key => $value) {
	    			if (!in_array($key, $excludes)) {
	    				$conditions['OR']['Cargo.'.$key.' LIKE '] = '%'.$this->request->data['filtro'].'%';
	    			}
	    		}
	    		
	    	}
			$this->set('cargos', $this->paginate(null, $conditions));
		}

		public function add(){
			if ($this->request->is('post') || $this->request->is('put')) {
				$this->Cargo->create();
				if ($this->Cargo->saveAll($this->request->data)) {
					echo 'Cargo cadastrado com sucesso!';
				} else {
					echo 'Não foi possível cadastrar o Cargo';
				}
			}
		}

		public function edit($id = null){
			$this->Cargo->id = $id;
			if ($this->request->is('post')||($this->request->is('put'))) {
				if (!$this->Cargo->exists()) {
					echo "Cargo inexistente";
				} elseif (!empty($this->Cargo->id)) {
					if ($this->Cargo->saveAll($this->request->data)) {
						echo 'Cargo cadastrado com sucesso!';
					} else {
						echo 'Não foi possível cadastrar o Cargo';
					}			
				}
			} else {
				$this->request->data = $this->Cargo->read(null, $id);		
			}
		}

		public function delete($id = null){
			if (!$this->request->is('post') || empty($id)) {
				throw new MethodNotAllowedException();
			}
			$this->request->data = $this->Cargo->read(null, $id);
			$this->Cargo->id = $id;
			if (!$this->Cargo->exists()) {
				throw new NotFoundException(__('Cargo inválido.'));
			}
			if ($this->Cargo->delete()) {
				$this->Session->setFlash(__('Cargo deletado com sucesso.'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('O Cargo não pôde ser deletado.'));
		}
	}