<?php
	class BensController extends PatrimonioAppController{

		public $uses = 'Patrimonio.Bem';

		public function beforeFilter()
		{
			parent::beforeFilter();
			$tipo_bens = $this->Bem->TipoBem->find('list', array('fields' => array('id', 'descricao')));
			$this->set('tipo_bens', $tipo_bens);

			$congregacoes = $this->Bem->Congregacao->find('list', array('fields' => array('id', 'nome')));
			$this->set('congregacoes', $congregacoes);

			$membros = $this->Bem->Membro->find('list', array('fields' => array('id', 'nome'), 'conditions' => array('Membro.tipo' => 'Membro')));
			$this->set('membros', $membros);

			$departamentos = $this->Bem->Departamento->find('list', array('fields' => array('id', 'nome')));
			$this->set('departamentos', $departamentos);
		}

		public function index(){
			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro']))
	    	{
	    		//condições para pesquisa
	    		//campos para não entrar na pesquisa
	    		$excludes = array('id', 'sexo', 'estado_id', 'estadocivil', 'escolaridade', 'profissao_id', 'igrejasanteriores', 'created', 'modified', 'uid', 'church_id', 'user_id', 'tipo');
	    		//pega campos da model
	    		$fields = $this->Bem->schema();
	    		foreach ($fields as $key => $value) {
	    			if (!in_array($key, $excludes)) {
	    				$conditions['OR']['Bem.'.$key.' LIKE '] = '%'.$this->request->data['filtro'].'%';
	    			}
	    		}
	    		
	    	}
			$this->set('bens', $this->paginate(null, $conditions));
		}

		public function add(){
			if ($this->request->is('post') || $this->request->is('put')) {
				$this->Bem->create();
				if ($this->Bem->save($this->request->data)) {
					echo 'Bem cadastrado com sucesso!';
				} else {
					echo 'Não foi possível cadastrar o Bem';
				}
			}			
		}

		public function edit($id = null){
			$this->Bem->id = $id;
			if ($this->request->is('post')||($this->request->is('put'))) {
				if (!$this->Bem->exists()) {
					echo "Bem inexistente";
				} elseif (!empty($this->Bem->id)) {
					if ($this->Bem->save($this->request->data)) {
						echo 'Bem cadastrado com sucesso!';
					} else {
						echo 'Não foi possível cadastrar o Bem';
					}			
				}
			} else {
				$this->request->data = $this->Bem->read(null, $id);		
			}
		}

		public function delete($id = null){
			if (!$this->request->is('post') || empty($id)) {
				throw new MethodNotAllowedException();
			}
			$this->request->data = $this->Bem->read(null, $id);
			$this->Bem->id = $id;
			if (!$this->Bem->exists()) {
				throw new NotFoundException(__('Bem inválido.'));
			}
			if ($this->Bem->delete()) {
				$this->Session->setFlash(__('Bem deletado com sucesso.'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('O Bem não pôde ser deletado.'));
		}

		public function movimentar($id) {
			$this->Bem->id = $id;
			if ($this->request->is('post')||($this->request->is('put'))) {

				$bem = $this->Bem->read(null, $this->request->data['MovimentacaoBem']['bem_id']);
				$quantidade = $bem['Bem']['quantidade'];

				if ($this->request->data['MovimentacaoBem']['tipo'] == '1') {
					$this->request->data['MovimentacaoBem']['saldo'] = $quantidade+$this->request->data['MovimentacaoBem']['quantidade'];
				} else {
					$this->request->data['MovimentacaoBem']['saldo'] = $quantidade-$this->request->data['MovimentacaoBem']['quantidade'];
				}

				$this->Bem->MovimentacaoBem->create();
				if ($this->Bem->MovimentacaoBem->save($this->request->data)) {

					$salvar = array(
						'id' => $this->request->data['MovimentacaoBem']['bem_id'],
						'quantidade' => $this->request->data['MovimentacaoBem']['saldo'],
					);
					$this->Bem->save($salvar);

					echo 'Bem cadastrado com sucesso!';
				} else {
					echo 'Não foi possível cadastrar o Bem';
				}
			} else {
				$this->request->data = $this->Bem->read(null, $id);		
			}
		}
	}