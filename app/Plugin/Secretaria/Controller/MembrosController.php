<?php
class MembrosController extends SecretariaAppController {

	public function index(){
		$conditions = array();
		$conditions['Membro.tipo ='] = 0;
		$this->set('membros', $this->paginate(null, $conditions));
		$this->layout ='';
	}

	public function add()
	{
		$this->Membro->create();
		if($this->request->is('post')){
			$this->request->data['Membro']['datamembro'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['datamembro'])));
			$this->request->data['Membro']['datanascimento'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['datanascimento'])));
			$this->request->data['Membro']['databatismo'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['databatismo'])));
			if($this->Membro->saveAll($this->request->data['Membro'])){
				$this->Session->setFlash('Membro Salva com Sucesso!');
				foreach ($this->request->data['Relacionamento'] as $key => $value) {
					$this->request->data['Relacionamento'][$key]['membro_id'] = $this->Membro->id;
				}
				$this->Membro->Relacionamento->saveAll($this->request->data['Relacionamento']);
				$this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash('Membro Não Salva!');
				$this->redirect(array('plugin' => null, 'controller' => 'pages', 'action' => 'home'));
			}
		} else {
			$estados = $this->Membro->Estado->find('list', array('fields' => array('codibge', 'nome')));
			$profissoes = $this->Membro->Profissao->find('list', array('fields' => array('id', 'descricao')));
			$cargos = $this->Membro->Cargo->find('list', array('fields' => array('id', 'descricao')));
			$parentes = $this->Membro->find('list', array('fields' => array('id', 'nome')));
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
		/**
		Caso tenha sido passado um id para a função ele seta na model que este é o id do Membro que estamos tratando
		E caso não tenha sido passado parametro ou então seja de outro "group", entra na exception.
		**/
		$this->Membro->id = $id;
		if (!$this->Membro->exists()) {
			throw new NotFoundException(__('Membro inválida.'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			/**
			Se a requisição for Post trata as datas para realizar o save no Banco de Dados
			**/
			$this->request->data['Membro']['datamembro'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['datamembro'])));
			$this->request->data['Membro']['datanascimento'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['datanascimento'])));
			$this->request->data['Membro']['databatismo'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['databatismo'])));
			/**
			Caso salvo com sucesso  Seta o setFlash() e redireciona para a action index.
			Caso contrario, se mantem na mesma action e seta o setFlash() com mensagem de erro.
			**/
			if ($this->Membro->saveAll($this->request->data)) {				
				$this->Session->setFlash(__('Membro salva com sucesso.'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A Membro não pôde ser salvo.'));
			}
		} else {
			/**
			Carregando Models não relacionadas
			**/
			$this->loadModel('Secretaria.Tiporelacionamento');
			/**
			Finds em banco de dados
			**/
			$this->request->data = $this->Membro->read(null, $id);
			$estados = $this->Membro->Estado->find('list', array('fields' => array('codibge', 'nome')));
			$profissoes = $this->Membro->Profissao->find('list', array('fields' => array('id', 'descricao')));
			$cargos = $this->Membro->Cargo->find('list', array('fields' => array('id', 'descricao')));
			$parentes = $this->Membro->find('list', array('fields' => array('id', 'nome')));
			$relacionamentos = $this->Tiporelacionamento->find('list', array('fields' => array('id', 'descricao')));
			/**
			Fim Finds em banco de dados
			**/

			/**
			Setando Variáveis para a view
			**/
			$this->set('cargos', $cargos);
			$this->set('estados', $estados);
			$this->set('profissoes', $profissoes);
			$this->set('parentes', $parentes);
			$this->set('relacionamentos', $relacionamentos);
			/**
			Fim setando Variáveis
			Tratando datas para a view.
			**/
			$this->request->data['Membro']['datamembro'] = implode('/', array_reverse(explode('-', $this->request->data['Membro']['datamembro'])));
			$this->request->data['Membro']['datanascimento'] = implode('/', array_reverse(explode('-', $this->request->data['Membro']['datanascimento'])));
			$this->request->data['Membro']['databatismo'] = implode('/', array_reverse(explode('-', $this->request->data['Membro']['databatismo'])));
			$this->layout = '';
			/**
			Fim Tratando datas para a view.
			**/
		}
	}

	public function view($id = null)
	{
		/**
		Verifica se foi passado algum id para a Action, caso sim, seta este id na Model.
		Caso seja de outro "group" ou nao exista, Entra na Exception.
		**/
		$this->Membro->id = $id;
		if (!$this->Membro->exists()) {
			throw new NotFoundException(__('Membro inválida.'));
		}
		/**
		Carregando Models
		**/
		$this->loadModel('Secretaria.Tiporelacionamento');
		/**
		Finds em Models
		**/
		$this->request->data = $this->Membro->read(null, $id);
		$estados = $this->Membro->Estado->find('list', array('fields' => array('codibge', 'nome')));
		$profissoes = $this->Membro->Profissao->find('list', array('fields' => array('id', 'descricao')));
		$cargos = $this->Membro->Cargo->find('list', array('fields' => array('id', 'descricao')));
		$parentes = $this->Membro->find('list', array('fields' => array('id', 'nome')));
		$relacionamentos = $this->Tiporelacionamento->find('list', array('fields' => array('id', 'descricao')));
		/**
		Setando Variaveis para a View
		**/
		$this->set('cargos', $cargos);
		$this->set('estados', $estados);
		$this->set('profissoes', $profissoes);
		$this->set('parentes', $parentes);
		$this->set('relacionamentos', $relacionamentos);
		/**
		Tratando datas para a View
		**/
		$this->request->data['Membro']['datamembro'] = implode('/', array_reverse(explode('-', $this->request->data['Membro']['datamembro'])));
		$this->request->data['Membro']['datanascimento'] = implode('/', array_reverse(explode('-', $this->request->data['Membro']['datanascimento'])));
		$this->request->data['Membro']['databatismo'] = implode('/', array_reverse(explode('-', $this->request->data['Membro']['databatismo'])));
		$this->layout = '';
	}

	public function delete($id = null)
	{
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->request->data = $this->Membro->read(null, $id);
		/**
		if($this->request->data['Mailling']['group_id'] !== $this->Session->read('choosed')){
			throw new NotFoundException(__('Mailling inválido.'));
		}
		*/
		$this->Membro->id = $id;
		if (!$this->Membro->exists()) {
			throw new NotFoundException(__('Membro inválida.'));
		}
		if ($this->Membro->delete()) {
			$this->Session->setFlash(__('Membro deletada com sucesso.'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('A Membro não pôde ser deletada.'));
		$this->redirect(array('action' => 'index'));
	}
}
