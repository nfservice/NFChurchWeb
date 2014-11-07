<?php
	class EscolaridadesController extends SecretariaAppController{
		public function index(){

			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro'])) {;
				$conditions['Escolaridade.descricao LIKE'] = '%'.$this->request->data['filtro'].'%';
			}
			$this->set('escolaridades', $this->paginate(null, $conditions));
		}

		public function add(){

			if ($this->request->is('post') || $this->request->is('put')) {
				$this->Escolaridade->create();
				if ($this->Escolaridade->saveAll($this->request->data)) {
					echo 'Escolaridade Cadastrada Com Sucesso';
				} else {
					echo 'Não Foi Possível Cadastrar a Escolaridade';
				}
			}
		}

		public function edit($id = null){

			$this->Escolaridade->id = $id;
			if ($this->request->is('post')||($this->request->is('put'))) {
				if (!$this->Escolaridade->exists()) {
					echo "Escolaridade Inexistente";
				} elseif (!empty($this->Escolaridade->id)) {
					if ($this->Escolaridade->saveAll($this->request->data)) {
						echo 'Escolaridade Cadastrada Com Sucesso';
					} else {
						echo 'Não Foi Possível Cadastrar a Escolaridade';
					}			
				}
			} else {
				$this->request->data = $this->Escolaridade->read(null, $id);		
			}
		}

		public function delete(){
			$this->autoRender = false;
			if (!empty($this->request->data['Escolaridade'])) {
				$save = 0;
				$unsave = 0;
				foreach ($this->request->data['Escolaridade'] as $idEscolaridade) {
					$this->Escolaridade->id = $idEscolaridade;
					if ($this->Escolaridade->exists()) {
						$save++;
						$this->Escolaridade->delete($idEscolaridade);
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