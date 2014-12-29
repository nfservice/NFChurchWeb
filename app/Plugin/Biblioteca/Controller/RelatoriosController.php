<?php
	App::import('Vendor', 'FPDF', array('file' => 'fpdf/fpdf.php'));
	App::import('Vendor', 'NFPDF', array('file' => 'NFPDF/NFPDF.php'));

	class RelatoriosController extends BibliotecaAppController
	{
		public $uses = 'Biblioteca.Item';

		public function beforeFilter() {
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

		public function itens()
		{
			$this->loadModel('Item');
			if ($this->request->is('post') || $this->request->is('put')) {
				$conditions = array();

				if (!empty($this->request->data['Relatorio']['titulo'])) {
					$conditions['Item.titulo LIKE'] = '%'.$this->request->data['Relatorio']['titulo'].'%';
				}
				if (!empty($this->request->data['Relatorio']['autor'])) {
					$autor = $this->Item->Autor->find('first', array('conditions' => array('Autor.id' => $this->request->data['Relatorio']['autor']), 'fields' => array('id', 'nome')));
					$this->set('autor', $autor);
					$conditions['Item.autor_id'] = $this->request->data['Relatorio']['autor'];
				}
				if (!empty($this->request->data['Relatorio']['tipo'])) {
					$tipo = $this->Item->Tipo->find('first', array('conditions' => array('Tipo.id' => $this->request->data['Relatorio']['tipo']), 'fields' => array('nome')));
					$this->set('tipo', $tipo);
					$conditions['Item.tipo_id'] = $this->request->data['Relatorio']['tipo'];
				}
				if (!empty($this->request->data['Relatorio']['categoria'])) {
					$categoria = $this->Item->Categoria->find('first', array('conditions' => array('Categoria.id' => $this->request->data['Relatorio']['categoria']), 'fields' => array('id', 'nome')));
					$this->set('categoria', $categoria);
					$conditions['Item.categoria_id'] = $this->request->data['Relatorio']['categoria'];
				}
				if (!empty($this->request->data['Relatorio']['editora'])) {
					$editora = $this->Item->Editora->find('first', array('conditions' => array('Editora.id' => $this->request->data['Relatorio']['editora']), 'fields' => array('id', 'nome')));
					$this->set('editora', $editora);
					$conditions['Item.editora_id'] = $this->request->data['Relatorio']['editora'];
				}

				$itens = $this->Item->find('all', array('conditions' => $conditions));

				$this->layout = 'pdf';
				$pdf = new NFPDF();
				$this->set('pdf', $pdf);
				$this->response->type('application/pdf');
				$this->set('itens', $itens);
				$this->render('itens_result');
			}
		}
	}