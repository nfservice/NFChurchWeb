<?php
	class AtasController extends SecretariaAppController{
		public function index(){

			$this->layout = false;

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

			$this->layout = false;

			if ($this->request->is('post') || $this->request->is('put')) {
				var_dump(WWW_ROOT);
				var_dump($this->request->data['Ata']['files']);
				die();
				$this->Ata->create();
				if (!empty($this->request->data['Ata']['data'])) {
					$this->request->data['Ata']['data'] = implode('-', array_reverse(explode('/', $this->request->data['Ata']['data'])));
				}
				if ($this->Ata->saveAll($this->request->data)) {
					echo 'Ata Cadastrada Com Sucesso';
				} else {
					echo 'Não Foi Possível Cadastrar a Ata';
				}
			}


			// Nas versões do PHP anteriores a 4.1.0, deve ser usado $HTTP_POST_FILES
			// ao invés de $_FILES.
			/*
			$uploaddir = '/var/www/uploads/';
			$uploadfile = $uploaddir . $_FILES['userfile']['name'];
			if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $_FILES['userfile']['name'])) {
			    print "O arquivo é valido e foi carregado com sucesso. Aqui esta alguma informação:\n";
			    print_r($_FILES);
			} else {
			    print "Possivel ataque de upload! Aqui esta alguma informação:\n";
			    print_r($_FILES);
			}
			*/
			
			

		}

		public function edit($id = null){

			$this->layout = false;

			$this->Ata->id = $id;
			if ($this->request->is('post')||($this->request->is('put'))) {
				if (!empty($this->request->data['Ata']['data'])) {
					$this->request->data['Ata']['data'] = implode('-', array_reverse(explode('/', $this->request->data['Ata']['data'])));
				}
				if (!$this->Ata->exists()) {
					echo "Ata Inexistente";
				} elseif (!empty($this->Cargo->id)) {
					if ($this->Cargo->saveAll($this->request->data)) {
						echo 'Ata Cadastrada Com Sucesso';
					} else {
						echo 'Não Foi Possível Cadastrar a Ata';
					}			
				}
			} else {
				$this->request->data = $this->Ata->read(null, $id);
				$this->request->data['Ata']['data'] = implode('/', array_reverse(explode('-', $this->request->data['Ata']['data'])));
			}
		}

		public function delete(){
			$this->layout = false;
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