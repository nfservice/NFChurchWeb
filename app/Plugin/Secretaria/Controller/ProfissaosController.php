<?php
	class ProfissaosController extends SecretariaAppController{
		public function index(){

			$this->layout = false;

			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro'])) {;
				$conditions['Profissao.descricao LIKE'] = '%'.$this->request->data['filtro'].'%';
			}
			$this->set('profissaos', $this->paginate(null, $conditions));
		}

		public function add(){

			$this->layout = false;

			if ($this->request->is('post') || $this->request->is('put')) {
				$this->Profissao->create();
				if ($this->Profissao->saveAll($this->request->data)) {
					$this->Session->setFlash('Profissão Cadastrada Com Sucesso');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Não Foi Possível Cadastrar a Profissão');
				}
			}
		}

		public function view($id = null){

			$this->layout = false;

			$this->Profissao->id = $id;
			if (!empty($this->Profissao->id)) {
				$this->request->data = $this->Profissao->read(null, $id);
			} else {
				throw new Exception("Profissão Inexistente");
			}
		}

		public function edit($id = null){

			$this->layout = false;

			$this->Profissao->id = $id;
			if (empty($this->Profissao->id)) {
				throw new Exception("Profissão Inexistente");
				
			}
			if ($this->request->is('post')||($this->request->is('put'))) {
				if (!$this->Profissao->exists()) {
					throw new Exception("Profissão Inexistente");
				}
				if (!empty($this->Profissao->id)) {
					if ($this->Profissao->saveAll($this->request->data)) {
						$this->Session->setFlash('Profissão Cadastrada Com Sucesso');
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash('Não Foi Possível Cadastrar a Profissão');
					}			
				}
			} else {
				$this->request->data = $this->Profissao->read(null, $id);		
			}
		}

		public function delete(){

			$this->layout = false;
			
			if (!empty($this->request->data['Profissao'])) {
				foreach ($this->request->data['Profissao'] as $idProfissao) {
					$this->Profissao->delete($idProfissao);
				}
				$this->Session->setFlash('Registros Apagados com Sucesso');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Nenhum Registro selecionado para Deletar');
				$this->redirect(array('action' => 'index'));
			}
		}
	}