<?php
	class CargosController extends SecretariaAppController{
		public function index(){
			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro'])) {;
				$conditions['Cargo.descricao LIKE'] = '%'.$this->request->data['filtro'].'%';
			}
			$this->set('cargos', $this->paginate(null, $conditions));
		}

		public function add(){
			if ($this->request->is('post') || $this->request->is('put')) {
				$this->Cargo->create();
				if ($this->Cargo->saveAll($this->request->data)) {
					echo 'Cargo Cadastrado Com Sucesso';
				} else {
					echo 'Não Foi Possível Cadastrar o Cargo';
				}
			}
		}

		public function edit($id = null){
			$this->Cargo->id = $id;
			if ($this->request->is('post')||($this->request->is('put'))) {
				if (!$this->Cargo->exists()) {
					echo "Cargo Inexistente";
				} elseif (!empty($this->Cargo->id)) {
					if ($this->Cargo->saveAll($this->request->data)) {
						echo 'Cargo Cadastrado Com Sucesso';
					} else {
						echo 'Não Foi Possível Cadastrar o Cargo';
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