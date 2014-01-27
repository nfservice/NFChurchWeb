<?php
class PessoasController extends SecretariaAppController {

	public function index(){
		$this->set('pessoas', $this->paginate(null));
		$this->layout ='';
	}

	public function add()
	{
		$this->Pessoa->create();
		if($this->request->is('post')){
			$this->request->data['Pessoa']['datamembro'] = implode('-', array_reverse(explode('/', $this->request->data['Pessoa']['datamembro'])));
			$this->request->data['Pessoa']['datanascimento'] = implode('-', array_reverse(explode('/', $this->request->data['Pessoa']['datanascimento'])));
			$this->request->data['Pessoa']['databatismo'] = implode('-', array_reverse(explode('/', $this->request->data['Pessoa']['databatismo'])));
			if($this->Pessoa->saveAll($this->request->data['Pessoa'])){
				$this->Session->setFlash('Pessoa Salva com Sucesso!');
				foreach ($this->request->data['Relacionamento'] as $key => $value) {
					$this->request->data['Relacionamento'][$key]['pessoa_id'] = $this->Pessoa->id;
				}
				$this->Pessoa->Relacionamento->saveAll($this->request->data['Relacionamento']);
				$this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash('Pessoa Não Salva!');
				$this->redirect(array('plugin' => null, 'controller' => 'pages', 'action' => 'home'));
			}
		} else {
			$estados = $this->Pessoa->Estado->find('list', array('fields' => array('codibge', 'nome')));
			$profissoes = $this->Pessoa->Profissao->find('list', array('fields' => array('id', 'descricao')));
			$cargos = $this->Pessoa->Cargo->find('list', array('fields' => array('id', 'descricao')));
			$parentes = $this->Pessoa->find('list', array('fields' => array('id', 'nome')));
			$this->loadModel('Secretaria.Tiporelacionamento');
			$relacionamentos = $this->Tiporelacionamento->find('list', array('fields' => array('id', 'descricao')));
			$this->set('relacionamentos', $relacionamentos);
			$this->set('parentes', $parentes);
			$this->set('cargos', $cargos);
			$this->set('estados', $estados);
			$this->set('profissoes', $profissoes);
			$this->layout = '';
		}
	
	}

	public function edit($id = null)
	{
		$this->Pessoa->id = $id;
		if (!$this->Pessoa->exists()) {
			throw new NotFoundException(__('Pessoa inválida.'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Pessoa']['datamembro'] = implode('-', array_reverse(explode('/', $this->request->data['Pessoa']['datamembro'])));
			$this->request->data['Pessoa']['datanascimento'] = implode('-', array_reverse(explode('/', $this->request->data['Pessoa']['datanascimento'])));
			$this->request->data['Pessoa']['databatismo'] = implode('-', array_reverse(explode('/', $this->request->data['Pessoa']['databatismo'])));
			if ($this->Pessoa->saveAll($this->request->data)) {
				$this->Session->setFlash(__('Pessoa salva com sucesso.'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A Pessoa não pôde ser salvo.'));
			}
		} else {
			$this->request->data = $this->Pessoa->read(null, $id);
			$estados = $this->Pessoa->Estado->find('list', array('fields' => array('codibge', 'nome')));
			$profissoes = $this->Pessoa->Profissao->find('list', array('fields' => array('id', 'descricao')));
			$cargos = $this->Pessoa->Cargo->find('list', array('fields' => array('id', 'descricao')));
			$this->set('cargos', $cargos);
			$this->set('estados', $estados);
			$this->set('profissoes', $profissoes);
			$this->request->data['Pessoa']['datamembro'] = implode('/', array_reverse(explode('-', $this->request->data['Pessoa']['datamembro'])));
			$this->request->data['Pessoa']['datanascimento'] = implode('/', array_reverse(explode('-', $this->request->data['Pessoa']['datanascimento'])));
			$this->request->data['Pessoa']['databatismo'] = implode('/', array_reverse(explode('-', $this->request->data['Pessoa']['databatismo'])));
			$this->layout = '';
			/**
			if($this->request->data['Mailling']['group_id'] !== $this->Session->read('choosed')){
				throw new NotFoundException(__('Mailling Inválido.'));
			}
			**/
		}
	}

	public function view($id = null)
	{
		$this->Pessoa->id = $id;
		if (!$this->Pessoa->exists()) {
			throw new NotFoundException(__('Pessoa inválida.'));
		}
		$this->request->data = $this->Pessoa->read(null, $id);
		$estados = $this->Pessoa->Estado->find('list', array('fields' => array('codibge', 'nome')));
		$profissoes = $this->Pessoa->Profissao->find('list', array('fields' => array('id', 'descricao')));
		$cargos = $this->Pessoa->Cargo->find('list', array('fields' => array('id', 'descricao')));
		$this->set('cargos', $cargos);
		$this->set('estados', $estados);
		$this->set('profissoes', $profissoes);
		$this->request->data['Pessoa']['datamembro'] = implode('/', array_reverse(explode('-', $this->request->data['Pessoa']['datamembro'])));
		$this->request->data['Pessoa']['datanascimento'] = implode('/', array_reverse(explode('-', $this->request->data['Pessoa']['datanascimento'])));
		$this->request->data['Pessoa']['databatismo'] = implode('/', array_reverse(explode('-', $this->request->data['Pessoa']['databatismo'])));
		$this->layout = '';
		/**
		if($this->request->data['Mailling']['group_id'] !== $this->Session->read('choosed')){
			throw new NotFoundException(__('Mailling Inválido.'));
		}
			**/
	}

	public function delete($id = null)
	{
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->request->data = $this->Pessoa->read(null, $id);
		/**
		if($this->request->data['Mailling']['group_id'] !== $this->Session->read('choosed')){
			throw new NotFoundException(__('Mailling inválido.'));
		}
		*/
		$this->Pessoa->id = $id;
		if (!$this->Pessoa->exists()) {
			throw new NotFoundException(__('Pessoa inválida.'));
		}
		if ($this->Pessoa->delete()) {
			$this->Session->setFlash(__('Pessoa deletada com sucesso.'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('A Pessoa não pôde ser deletada.'));
		$this->redirect(array('action' => 'index'));
	}
}
