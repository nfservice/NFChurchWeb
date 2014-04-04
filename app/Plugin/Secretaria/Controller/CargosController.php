<?php
	class CargosController extends SecretariaAppController{
		public function index(){

			$this->layout = false;

			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro'])) {;
				$conditions['Cargo.descricao LIKE'] = '%'.$this->request->data['filtro'].'%';
			}
			$this->set('cargos', $this->paginate(null, $conditions));
		}

		public function add(){

			$this->layout = false;

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

			$this->layout = false;

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

		public function delete(){
			$this->layout = false;
			$this->autoRender = false;
			if (!empty($this->request->data['Cargo'])) {
				$save = 0;
				$unsave = 0;
				foreach ($this->request->data['Cargo'] as $idCargo) {
					$this->Cargo->id = $idCargo;
					if ($this->Cargo->exists()) {
						$save++;
						$this->Cargo->delete($idCargo);
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