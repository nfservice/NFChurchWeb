<?php
	class CongregacaosController extends SecretariaAppController{
		public function index(){
			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro']))
	    	{
	    		//condições para pesquisa
	    		//campos para não entrar na pesquisa
	    		$excludes = array('id', 'sexo', 'estado_id', 'estadocivil', 'escolaridade', 'profissao_id', 'igrejasanteriores', 'created', 'modified', 'uid', 'church_id', 'user_id', 'tipo');
	    		//pega campos da model
	    		$fields = $this->Congregacao->schema();
	    		foreach ($fields as $key => $value) {
	    			if (!in_array($key, $excludes)) {
	    				$conditions['OR']['Congregacao.'.$key.' LIKE '] = '%'.$this->request->data['filtro'].'%';
	    			}
	    		}
	    		
	    	}
			$this->set('congregacaos', $this->paginate(null, $conditions));
		}

		public function add(){
			if ($this->request->is('post') || $this->request->is('put')) {
				if (!empty($this->request->data['Congregacao']['telefone'])) {
					$this->request->data['Congregacao']['telefone'] = str_replace('(', '', str_replace(')', '', str_replace('-', '', str_replace(' ', '', $this->request->data['Congregacao']['telefone']))));
				}
				if (!empty($this->request->data['Congregacao']['cnpj'])) {
					$this->request->data['Congregacao']['cnpj'] = str_replace('.', '', str_replace('/', '', str_replace('-', '', $this->request->data['Congregacao']['cnpj'])));
				}
				if (!empty($this->request->data['CongregacaoEndereco'][0]['cep'])) {
					$this->request->data['CongregacaoEndereco'][0]['cep'] = str_replace('-', '', $this->request->data['CongregacaoEndereco'][0]['cep']);
				}
				$i = 0;
				foreach ($this->request->data['Contato'] as $value) {
					if (!empty($this->request->data['Contato'][$i]['telefone'])) {
						$this->request->data['Contato'][$i]['telefone'] = str_replace('(', '', str_replace(')', '', str_replace('-', '', str_replace(' ', '', $this->request->data['Contato'][$i]['telefone']))));
					}
					$i++;
				}
				$this->Congregacao->create();
				if ($this->Congregacao->saveAll($this->request->data)) {
					echo 'Congregação cadastrada com sucesso!';
				} else {
					echo 'Não foi possível cadastrar a Congregação';
				}
				$this->redirect(array('action' => 'index'));
			}
			$this->loadModel('Estado');
			$this->set('estados', $this->Estado->find('list', array('fields' => array('sigla', 'nome'))));
		}

		public function edit($id = null){
			
			$this->Congregacao->id = $id;
			if (!$this->Congregacao->exists()) {
				throw new NotFoundException(__('Congregacao inválida.'));
			}
			if ($this->request->is('post')||($this->request->is('put'))) {
				if (!empty($this->request->data['Congregacao']['telefone'])) {
					$this->request->data['Congregacao']['telefone'] = str_replace('(', '', str_replace(')', '', str_replace('-', '', str_replace(' ', '', $this->request->data['Congregacao']['telefone']))));
				}
				if (!empty($this->request->data['CongregacaoEndereco'][0]['cep'])) {
					$this->request->data['CongregacaoEndereco'][0]['cep'] = str_replace('-', '', $this->request->data['CongregacaoEndereco'][0]['cep']);
				}
				if (!empty($this->request->data['Congregacao']['cnpj'])) {
					$this->request->data['Congregacao']['cnpj'] = str_replace('.', '', str_replace('/', '', str_replace('-', '', $this->request->data['Congregacao']['cnpj'])));
				}
				$i = 0;
				foreach ($this->request->data['Contato'] as $value) {
					if (!empty($this->request->data['Contato'][$i]['telefone'])) {
						$this->request->data['Contato'][$i]['telefone'] = str_replace('(', '', str_replace(')', '', str_replace('-', '', str_replace(' ', '', $this->request->data['Contato'][$i]['telefone']))));
					}
					$i++;
				}
				if (!$this->Congregacao->exists()) {
					echo "Congregação inexistente";
				} elseif (!empty($this->Congregacao->id)) {
					$this->Congregacao->Contato->deleteAll(array('Contato.congregacao_id' => $this->Congregacao->id), false);
					$this->Congregacao->CongregacaoEndereco->deleteAll(array('CongregacaoEndereco.congregacao_id' => $this->Congregacao->id), false);
					if ($this->Congregacao->saveAll($this->request->data)) {
						echo 'Congregacao Editada Com Sucesso';
					} else {
						echo 'Não Foi Possível Editar a Congregacao';
					}			
				}
				$this->redirect(array('action' => 'index'));
			} else {
				$this->request->data = $this->Congregacao->read(null, $id);
				$this->loadModel('Estado');
				$this->set('estados', $this->Estado->find('list', array('fields' => array('sigla', 'nome'))));
			}
		}

		public function delete($id = null){
			if (!$this->request->is('post') || empty($id)) {
				throw new MethodNotAllowedException();
			}
			$this->request->data = $this->Congregacao->read(null, $id);
			$this->Congregacao->id = $id;
			if (!$this->Congregacao->exists()) {
				throw new NotFoundException(__('Congregacao inválida.'));
			}
			if ($this->Congregacao->delete()) {
				$this->Session->setFlash(__('Congregacao deletada com sucesso.'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('A Congregacao não pôde ser deletada.'));
		}
	}