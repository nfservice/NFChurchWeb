<?php
	class TiporelacionamentosController extends SecretariaAppController{
		public function index(){
			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro'])) {;
				$conditions['Tiporelacionamento.descricao LIKE'] = '%'.$this->request->data['filtro'].'%';
			}
			$this->set('tiporelacionamentos', $this->paginate(null, $conditions));
		}

		public function add(){
			if ($this->request->is('post') || $this->request->is('put')) {
				$this->Tiporelacionamento->create();
				if ($this->Tiporelacionamento->saveAll($this->request->data)) {
					echo 'Relacionamento Cadastrado Com Sucesso';
				} else {
					echo 'Não Foi Possível Cadastrar o Relacionamento';
				}
			}
		}

		public function edit($id = null){
			$this->Tiporelacionamento->id = $id;
			if ($this->request->is('post')||($this->request->is('put'))) {
				if (!$this->Tiporelacionamento->exists()) {
					echo "Relacionamento Inexistente";
				} elseif (!empty($this->Tiporelacionamento->id)) {
					if ($this->Tiporelacionamento->saveAll($this->request->data)) {
						echo 'Relacionamento Cadastrado Com Sucesso';
					} else {
						echo 'Não Foi Possível Cadastrar o Relacionamento';
					}			
				}
			} else {
				$this->request->data = $this->Tiporelacionamento->read(null, $id);		
			}
		}

		public function delete(){
			$this->autoRender = false;
			if (!empty($this->request->data['Tiporelacionamento'])) {
				$save = 0;
				$unsave = 0;
				foreach ($this->request->data['Tiporelacionamento'] as $idTiporelacionamento) {
					$this->Tiporelacionamento->id = $idTiporelacionamento;
					if ($this->Tiporelacionamento->exists()) {
						$save++;
						$this->Tiporelacionamento->delete($idTiporelacionamento);
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