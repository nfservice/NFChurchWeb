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

		public function delete(){
			$this->autoRender = false;
			if (!empty($this->request->data['Don'])) {
				$save = 0;
				$unsave = 0;
				foreach ($this->request->data['Don'] as $idDon) {
					$this->Don->id = $idDon;
					if ($this->Don->exists()) {
						$save++;
						$this->Don->delete($idDon);
					} else {
						$unsave++;
					}
				}
				echo $save.' Registros Apagados com Sucesso. E '.$unsave.' não Apagados';
			} else {
				echo 'Nenhum Registro selecionado para Deletar';
			}
		}
	}