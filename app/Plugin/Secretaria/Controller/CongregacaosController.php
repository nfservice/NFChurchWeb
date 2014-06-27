<?php
	class CongregacaosController extends SecretariaAppController{
		public function beforeRender(){
			$this->layout = false;
		}

		public function index(){
			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro'])) {
				$pattern = '/\d{2}\/\d{2}\/\d{4}/';
				preg_match($pattern, $this->request->data['filtro'], $matches);
				if (!empty($matches)) {
					$conditions['Congregacao.data LIKE'] = '%'.implode('-', array_reverse(explode('/', $this->request->data['filtro']))).'%';
				} else {
					$conditions['Congregacao.num LIKE'] = '%'.$this->request->data['filtro'].'%';
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
					echo 'Congregação Cadastrada Com Sucesso';
				} else {
					echo 'Não Foi Possível Cadastrar a Congregação';
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
					echo "Congregação Inexistente";
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

		public function delete(){
			
			$this->autoRender = false;
			if (!empty($this->request->data['Congregacao'])) {
				$save = 0;
				$unsave = 0;
				foreach ($this->request->data['Congregacao'] as $idCong) {
					$this->Congregacao->id = $idCong;
					if ($this->Congregacao->exists()) {
						$save++;
						$this->Congregacao->delete($idCong);
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