<?php
	class DonsController extends SecretariaAppController{
		public function beforeRender(){
			$this->layout = false;
		}
		public function index(){
			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro'])) {;
				$conditions['Don.nome LIKE'] = '%'.$this->request->data['filtro'].'%';
			}
			$this->set('dons', $this->paginate(null, $conditions));
		}

		public function add(){
			if ($this->request->is('post') || $this->request->is('put')) {
				$this->Don->create();
				if ($this->Don->saveAll($this->request->data)) {
					echo 'Dom Cadastrado Com Sucesso';
				} else {
					echo 'Não Foi Possível Cadastrar o Dom';
				}
			}
		}

		public function edit($id = null){
			$this->Don->id = $id;
			if ($this->request->is('post')||($this->request->is('put'))) {
				if (!$this->Don->exists()) {
					echo "Dom Inexistente";
				} elseif (!empty($this->Don->id)) {
					if ($this->Don->saveAll($this->request->data)) {
						echo 'Dom Editado Com Sucesso';
					} else {
						echo 'Não Foi Possível Editar o Dom';
					}			
				}
			} else {
				$this->request->data = $this->Don->read(null, $id);
			}
		}

		public function delete($id = null){
			if (!$this->request->is('post') || empty($id)) {
				throw new MethodNotAllowedException();
			}
			$this->request->data = $this->Don->read(null, $id);
			$this->Don->id = $id;
			if (!$this->Don->exists()) {
				throw new NotFoundException(__('Don inválido.'));
			}
			if ($this->Don->delete()) {
				$this->Session->setFlash(__('Don deletada com sucesso.'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('A Don não pôde ser deletada.'));
		}
	}