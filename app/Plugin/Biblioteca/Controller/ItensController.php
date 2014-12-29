<?php
	class ItensController extends BibliotecaAppController{

		public $uses = 'Biblioteca.Item';

		public function beforeFilter()
		{
			parent::beforeFilter();
			$tipos = $this->Item->Tipo->find('list', array('fields' => array('id', 'nome')));
			$this->set('tipos', $tipos);

			$categorias = $this->Item->Categoria->find('list', array('fields' => array('id', 'nome')));
			$this->set('categorias', $categorias);

			$editoras = $this->Item->Editora->find('list', array('fields' => array('id', 'nome')));
			$this->set('editoras', $editoras);

			$autores = $this->Item->Autor->find('list', array('fields' => array('id', 'nome')));
			$this->set('autores', $autores);
		}

		public function index()
		{
			$conditions = array();
			unset($this->request->data['submit']);
			if (!empty($this->request->data['filtro']))
	    	{
	    		//condições para pesquisa
	    		//campos para não entrar na pesquisa
	    		$excludes = array('id', 'sexo', 'estado_id', 'estadocivil', 'escolaridade', 'profissao_id', 'igrejasanteriores', 'created', 'modified', 'uid', 'church_id', 'user_id', 'tipo');
	    		//pega campos da model
	    		$fields = $this->Item->schema();
	    		foreach ($fields as $key => $value) {
	    			if (!in_array($key, $excludes)) {
	    				$conditions['OR']['Item.'.$key.' LIKE '] = '%'.$this->request->data['filtro'].'%';
	    			}
	    		}
	    		
	    	}
			$this->set('itens', $this->paginate(null, $conditions));
		}

		public function add()
		{
			if ($this->request->is('post') || $this->request->is('put')) {
				$this->Item->create();
				if ($this->Item->save($this->request->data)) {

					if (!empty($this->request->data['Item']['imagem'])) {
						$folder = WWW_ROOT.'files/biblioteca/'.$this->Session->read('choosed');
						if (!is_dir($folder)) {
							mkdir($folder, 0777, true);
						}

						$extension = array_reverse(explode('.', $this->request->data['Ata']['files'][$key]['tmp_name']))[0];

						move_uploaded_file($this->request->data['Item']['imagem']['tmp_name'], $folder.$this->Item->id.'.'.$extension);

						$salvar = array(
							'id' => $this->Item->id,
							'foto' => $this->Item->id.'.'.$extension,
						);

						$this->Item->save($salvar);
					}

					echo 'Item cadastrado com sucesso!';
				} else {
					echo 'Não foi possível cadastrar o item.';
				}
			}			
		}

		public function edit($id = null)
		{
			$this->Item->id = $id;
			if ($this->request->is('post')||($this->request->is('put'))) {
				if (!$this->Item->exists()) {
					echo "Item inexistente";
				} elseif (!empty($this->Item->id)) {
					if ($this->Item->save($this->request->data)) {

						if (!empty($this->request->data['Item']['imagem'])) {
							$folder = WWW_ROOT.'files/biblioteca/'.$this->Session->read('choosed').'/';
							if (!is_dir($folder)) {
								mkdir($folder, 0777, true);
							}

							$extension = array_reverse(explode('.', $this->request->data['Item']['imagem']['name']))[0];

							move_uploaded_file($this->request->data['Item']['imagem']['tmp_name'], $folder.$this->Item->id.'.'.$extension);

							$salvar = array(
								'id' => $this->Item->id,
								'foto' => $this->Item->id.'.'.$extension,
							);

							$this->Item->save($salvar);
						}

						echo 'Item cadastrado com sucesso!';
					} else {
						echo 'Não foi possível cadastrar o item.';
					}			
				}
			} else {
				$this->request->data = $this->Item->read(null, $id);		
			}
		}

		public function delete($id = null)
		{
			if (!$this->request->is('post') || empty($id)) {
				throw new MethodNotAllowedException();
			}
			$this->request->data = $this->Item->read(null, $id);
			$this->Item->id = $id;
			if (!$this->Item->exists()) {
				throw new NotFoundException(__('Item inválido.'));
			}
			if ($this->Item->delete()) {
				$this->Session->setFlash(__('Item deletado com sucesso.'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('O Item não pôde ser deletado.'));
		}

		public function consulta()
		{

		}

		public function searchItem($filter) {
			$this->autoRender = false;
			$conditions = array(
				'OR' => array(
					'Item.isbn' => $filter,
					'Item.titulo LIKE' => '%'.$filter.'%',
					'Autor.nome LIKE' => '%'.$filter.'%',					
				)
			);

			$itens = $this->Item->find(
				'all',
				array(
					'conditions' => $conditions
				)
			);

			echo json_encode($itens);
		}

		public function emprestimo($id)
		{
			$item = $this->Item->read(null, $id);
		}

		public function historico($id)
		{
			$historicos = $this->Item->MovimentacaoItem->find(
				'all',
				array(
					'conditions' => array(
						'MovimentacaoItem.item_id' => $id
					),
					'limit' => 30,
					'order' => 'MovimentacaoItem.created DESC'
				)
			);

			$item = $this->Item->read(null, $id);

			$this->set('item', $item);
			$this->set('historicos', $historicos);
		}
	}