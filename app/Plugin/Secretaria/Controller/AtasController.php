<?php
	class AtasController extends SecretariaAppController{
		public function index(){
			
			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro'])) {
				$pattern = '/\d{2}\/\d{2}\/\d{4}/';
				preg_match($pattern, $this->request->data['filtro'], $matches);
				if (!empty($matches)) {
					$conditions['Ata.data LIKE'] = '%'.implode('-', array_reverse(explode('/', $this->request->data['filtro']))).'%';
				} else {
					$conditions['Ata.num LIKE'] = '%'.$this->request->data['filtro'].'%';
				}
			}
			$this->set('atas', $this->paginate(null, $conditions));
		}

		public function add(){
			
			if ($this->request->is('post') || $this->request->is('put')) {
				if (!empty($this->request->data['Ata']['data'])) {
					$this->request->data['Ata']['data'] = implode('-', array_reverse(explode('/', $this->request->data['Ata']['data'])));
				}
				$this->Ata->create();

				$folder = WWW_ROOT.'files/ata/'.$this->Session->read('choosed').'/';
				if (!is_dir($folder)) {
					mkdir($folder, 0777, true);
				}

				$this->request->data['AtaArquivo'] = array();
				foreach ($this->request->data['Ata']['files'] as $key => $file) {
					$this->request->data['AtaArquivo'][$key] = array(
						'nome' => $file['name'],
						'dataupload' => date('Y-m-d')
					);
				}

				if ($this->Ata->saveAll($this->request->data)) {
					echo 'Ata cadastrada com sucesso!';

					foreach ($this->request->data['Ata']['files'] as $key => $file) {
						move_uploaded_file($this->request->data['Ata']['files'][$key]['tmp_name'], $folder.$this->Ata->id.'-'.$key);
					}

					$i = 0;					
				} else {
					echo 'Não foi possível cadastrar a ata.';
				}
				$this->redirect(array('action' => 'index'));
			} else {
				$this->loadModel('Secretaria.Membro');
				$this->loadModel('Secretaria.Cargo');

				$this->set('membros', $this->Membro->find('list', array('conditions' => array('Membro.church_id' => $this->Session->read('choosed')), 'fields' => array('id', 'nome'))));
				$this->set('cargos', $this->Cargo->find('list', array('conditions' => array('Cargo.church_id' => $this->Session->read('choosed')), 'fields' => array('id', 'nome'))));
			}
		}

		public function edit($id = null){
			
			$this->Ata->id = $id;
			if (!$this->Ata->exists()) {
				throw new NotFoundException(__('Ata inválida.'));
			}
			if ($this->request->is('post')||($this->request->is('put'))) {
				if (!empty($this->request->data['Ata']['data'])) {
					$this->request->data['Ata']['data'] = implode('-', array_reverse(explode('/', $this->request->data['Ata']['data'])));
				}
				if (!$this->Ata->exists()) {
					echo "Ata inexistente";
				} elseif (!empty($this->Ata->id)) {
					if ($this->Ata->saveAll($this->request->data)) {
						echo 'Ata Editada Com Sucesso';
					} else {
						echo 'Não Foi Possível Editar a Ata';
					}			
				}
				$this->redirect(array('action' => 'index'));
			} else {

				$this->request->data = $this->Ata->read(null, $id);
				$this->request->data['Ata']['data'] = implode('/', array_reverse(explode('-', $this->request->data['Ata']['data'])));

				$this->loadModel('Secretaria.Membro');
				$this->loadModel('Secretaria.Cargo');

				$this->set('membros', $this->Membro->find('list', array('conditions' => array('Membro.church_id' => $this->Session->read('choosed')), 'fields' => array('id', 'nome'))));
				$this->set('cargos', $this->Cargo->find('list', array('conditions' => array('Cargo.church_id' => $this->Session->read('choosed')), 'fields' => array('id', 'nome'))));
			}
		}

		public function delete($id = null){
			if (!$this->request->is('post') || empty($id)) {
				throw new MethodNotAllowedException();
			}
			$this->request->data = $this->Ata->read(null, $id);
			$this->Ata->id = $id;
			if (!$this->Ata->exists()) {
				throw new NotFoundException(__('Ata inválida.'));
			}
			if ($this->Ata->delete()) {
				$this->Session->setFlash(__('Ata deletada com sucesso.'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('A Ata não pôde ser deletada.'));
		}

		public function download($arquivo_id, $name) {
			$arquivo = $this->Ata->AtaArquivo->read(null, $arquivo_id);

			header("Content-disposition: attachment; filename=".$arquivo['AtaArquivo']['nome']);
			readfile(WWW_ROOT.'files/ata/'.$this->Session->read('choosed').'/'.$name);
		}
	}