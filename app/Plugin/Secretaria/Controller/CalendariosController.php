<?php
	class CalendariosController extends SecretariaAppController{

		public function autoComplete() {
			$this->layout = 'ajax';
			$this->autoRender=false;
			$query = $_GET['term'];
			$response = array();
			$i = 0;
			$this->loadModel('User');
			$this->loadModel('Secretaria.Cargo');
			$users = $this->User->find('all', array(
				'conditions' => array('User.username LIKE' => '%'.$query .'%','User.church_id' => $this->Session->read('choosed')),
				'fields' => array( 'id', 'username')
				)
			);
			$cargos = $this->Cargo->find('all', array(
				'conditions' => array('Cargo.nome LIKE' => '%'.$query .'%','Cargo.church_id' => $this->Session->read('choosed')),
				'fields' => array('id', 'nome')
				)
			);

			$i = 0;
			foreach ($cargos as $cargo) {
				$cargos[$i]['Merge']['table'] = 'cargos';
				$cargos[$i]['Merge']['value'] = $cargos[$i]['Cargo']['nome'];
				$cargos[$i]['Merge']['id'] = $cargos[$i]['Cargo']['id'];
				unset($cargos[$i]['Cargo']);
				$i++;
			}
			$i = 0;
			foreach ($users as $user) {
				$users[$i]['Merge']['table'] = 'users';
				$users[$i]['Merge']['value'] = $users[$i]['User']['username'];
				$users[$i]['Merge']['id'] = $users[$i]['User']['id'];
				unset($users[$i]['User']);
				$i++;
			}
			$response = array_merge($users, $cargos);
			echo json_encode($response);
		} 

		public function index(){

			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro'])) {;
				$conditions['Profissao.descricao LIKE'] = '%'.$this->request->data['filtro'].'%';
			}
			$this->set('profissaos', $this->paginate(null, $conditions));
		}

		public function add(){
			$this->loadModel('MembroCargo');

			if ($this->request->is('post') || $this->request->is('put')) {
				$this->Profissao->create();
				if ($this->Profissao->saveAll($this->request->data)) {
					$this->Session->setFlash('Profissão Cadastrada Com Sucesso');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Não Foi Possível Cadastrar a Profissão');
				}
			} else {
				$membros = $this->MembroCargo->find('list', array(
					'conditions' => array(
						'MembroCargo.group_id' => $this->Session->read('choosed'),
						)
					)
				);
			}
		}

		public function edit($id = null){

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
						$this->Session->setFlash('Profissão Alterada Com Sucesso');
					} else {
						$this->Session->setFlash('Não Foi Possível Cadastrar a Profissão');
					}			
				}
			} else {
				$this->request->data = $this->Profissao->read(null, $id);		
			}
		}

		public function delete($id = null){

			$this->autoRender = false;
			if (!$this->request->is('post') || empty($id)) {
				throw new MethodNotAllowedException();
			}

			$this->request->data = $this->Profissao->read(null, $id);
			$this->Profissao->id = $id;

			if (!$this->Profissao->exists()) {
				throw new NotFoundException(__('Profissao inválido.'));
			}
			
			if ($this->Profissao->delete()) {
				$this->Session->setFlash(__('Profissao deletado com sucesso.'));
			}
			
			$this->Session->setFlash(__('O Profissao não pôde ser deletado.'));
		}
	}