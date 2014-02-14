<?php
	class ProfissaosController extends SecretariaAppController{
		public function index(){

			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro'])) {;
				$conditions['Profissao.descricao LIKE'] = '%'.$this->request->data['filtro'].'%';
			}
			$this->set('profissaos', $this->paginate(null, $conditions));
		}

		public function add(){
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

		public function view(){

		}

		public function edit(){

		}

		public function delete(){
			
		}
	}