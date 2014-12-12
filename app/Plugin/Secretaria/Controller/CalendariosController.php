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

		}

		public function load_events() {
			$this->autoRender = false;
			$eventos = $this->Calendario->find('all', array(
				'conditions' => array(
					'Calendario.church_id' => $this->Session->read('choosed'),
					'OR' => array(
						array(
							'Calendario.datainicio BETWEEN ? and ?' => array(
								$this->request->data['inicio'],
								$this->request->data['fim']
							)
						),
						array(
							'? BETWEEN Calendario.datainicio and Calendario.datafim' => array(
								$this->request->data['inicio'],
							)	
						),
						array(
							'? BETWEEN Calendario.datainicio and Calendario.datafim' => array(
								$this->request->data['fim'],
							)	
						)
					)
					
				)
			));
			echo json_encode($eventos);
		}

		public function add(){
			if ($this->request->is('post') || $this->request->is('put')) {
				$datainicio = explode(' ', $this->request->data['Calendario']['datainicio']);
				$datafim = explode(' ', $this->request->data['Calendario']['datafim']);

				$this->request->data['Calendario']['datainicio'] = implode('-', array_reverse(explode('/', $datainicio[0]))).' '.$datainicio[1];
				$this->request->data['Calendario']['datafim'] = implode('-', array_reverse(explode('/', $datafim[0]))).' '.$datainicio[1];

				$this->Calendario->create();
				if ($this->Calendario->saveAll($this->request->data)) {
					$this->Session->setFlash('Evento salvo com sucesso!');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Não foi possível salvar o evento!');
				}
			}
		}

		public function edit($id = null){

			if ($this->request->is('post') || $this->request->is('put')) {

				
				if (!empty($this->request->data['Calendario']['datafim'])) {
					$datafim = explode(' ', $this->request->data['Calendario']['datafim']);
					$this->request->data['Calendario']['datafim'] = implode('-', array_reverse(explode('/', $datafim[0]))).' '.$datafim[1];
				}
				
				$datainicio = explode(' ', $this->request->data['Calendario']['datainicio']);
				$this->request->data['Calendario']['datainicio'] = implode('-', array_reverse(explode('/', $datainicio[0]))).' '.$datainicio[1];

				$this->Calendario->save($this->request->data);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->request->data = $this->Calendario->read(null, $id);

				$datainicio = explode(' ', $this->request->data['Calendario']['datainicio']);
				$datafim = explode(' ', $this->request->data['Calendario']['datafim']);

				$this->request->data['Calendario']['datainicio'] = implode('/', array_reverse(explode('-', $datainicio[0]))).' '.substr($datainicio[1], 0, -3);
				$this->request->data['Calendario']['datafim'] = implode('/', array_reverse(explode('-', $datafim[0]))).' '.substr($datainicio[1], 0, -3);
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