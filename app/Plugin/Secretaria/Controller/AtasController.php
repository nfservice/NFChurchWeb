<?php
	class AtasController extends SecretariaAppController{
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
					$conditions['Ata.data LIKE'] = '%'.implode('-', array_reverse(explode('/', $this->request->data['filtro']))).'%';
				} else {
					$conditions['Ata.num LIKE'] = '%'.$this->request->data['filtro'].'%';
				}
			}
			$this->set('atas', $this->paginate(null, $conditions));
		}

		public function add(){
			
			if ($this->request->is('post') || $this->request->is('put')) {
				if (!is_dir(WWW_ROOT.'files/ata/'.$this->Session->read('choosed'))) {
					umask(0);
					mkdir(WWW_ROOT.'files/ata/'.$this->Session->read('choosed').'/', 0777);
				}
				if (!empty($this->request->data['Ata']['data'])) {
					$this->request->data['Ata']['data'] = implode('-', array_reverse(explode('/', $this->request->data['Ata']['data'])));
				}
				$this->Ata->create();
				if ($this->Ata->saveAll($this->request->data)) {
					echo 'Ata Cadastrada Com Sucesso';
					$i = 0;
					foreach ($this->request->data['Ata']['files'] as $file) {
						$this->Ata->AtaArquivo->create();
						$salvar['AtaArquivo']['nome'] = $file['name'];
						$salvar['AtaArquivo']['dataupload'] = date('Y-m-d');
						$salvar['AtaArquivo']['ata_id'] = $this->Ata->id;
						$this->Ata->AtaArquivo->save($salvar);
						move_uploaded_file($this->request->data['Ata']['files'][$i]['tmp_name'], WWW_ROOT.'files/ata/'.$this->Session->read('choosed').'/'.$this->Ata->AtaArquivo->id);
						$i++;
					}
				} else {
					echo 'Não Foi Possível Cadastrar a Ata';
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
					echo "Ata Inexistente";
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

		public function delete(){
			
			$this->autoRender = false;
			if (!empty($this->request->data['Ata'])) {
				$save = 0;
				$unsave = 0;
				foreach ($this->request->data['Ata'] as $idAta) {
					$this->Ata->id = $idAta;
					if ($this->Ata->exists()) {
						$save++;
						$this->Ata->delete($idAta);
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