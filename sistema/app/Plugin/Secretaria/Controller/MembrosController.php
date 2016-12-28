<?php
class MembrosController extends SecretariaAppController {
	public function index() {
		$this->Membro->recursive = -1;
    	//verifica se foi feito algum filtro	    	
    	if (!empty($this->request->data['filtro']))
    	{
    		//condições para pesquisa
    		//campos para não entrar na pesquisa
    		$excludes = array('id', 'sexo', 'estado_id', 'estadocivil', 'escolaridade', 'profissao_id', 'igrejasanteriores', 'created', 'modified', 'uid', 'church_id', 'user_id', 'tipo');
    		//pega campos da model
    		$fields = $this->Membro->schema();
    		foreach ($fields as $key => $value) {
    			if (!in_array($key, $excludes)) {
    				$conditions['OR']['Membro.'.$key.' LIKE '] = '%'.$this->request->data['filtro'].'%';
    			}
    		}
    		
    	}
    	else
    	{
    		$conditions = array();
    	}
    	$conditions['Membro.tipo'] = 'Membro';    	
    	//busca todos os regsitros desta igreja
    	$membros = $this->Membro->find('all', array('conditions' => $conditions));
    	//seta registros para a view
    	$this->set('membros', $membros);
    }

	public function add()
	{
		$this->Membro->create();
		if($this->request->is('post') || $this->request->is('put')){
			$this->request->data['Membro']['datamembro'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['datamembro'])));
			$this->request->data['Membro']['datanascimento'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['datanascimento'])));
			$this->request->data['Membro']['databatismo'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['databatismo'])));
			$this->request->data['Membro']['tipo'] = '1';

			$address = $this->request->data['Endereco']['logradouro'].', '.$this->request->data['Endereco']['numero'].' - '.$this->request->data['Endereco']['bairro'].' - '.$this->request->data['Endereco']['cidade'].' - SP';
			$prepAddr = str_replace(' ','+',$address);			 
			$geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');			 
			$output = json_decode($geocode);
			 
			$lat = $output->results[0]->geometry->location->lat;
			$long = $output->results[0]->geometry->location->lng;

			$this->request->data['Membro']['latitude'] = $lat;
			$this->request->data['Membro']['longitude'] = $long;
			$relacionamentos = $this->request->data['Relacionamento'];
			unset($this->request->data['Relacionamento']);
			if($this->Membro->saveAll($this->request->data)){
				foreach ($relacionamentos as $key => $value) {
					$relacionamentos[$key]['membro_id'] = $this->Membro->id;
					if (empty($relacionamentos[$key]['membro2_id'])) {
						unset($relacionamentos[$key]);
					}
				}
				$this->Membro->Relacionamento->saveAll($relacionamentos);
				json_encode('Membro Salvo com Sucesso!');
			}else{
				json_encode('Membro Não Salvo!');
			}
		} else {
			$estados = $this->Membro->Estado->find('list', array('fields' => array('codibge', 'nome')));
			$profissoes = $this->Membro->Profissao->find('list', array('fields' => array('id', 'descricao')));
			$cargos = $this->Membro->Cargo->find('list', array('fields' => array('id', 'nome')));
			$this->Membro->all = true;
			$parentes = $this->Membro->find('list', array('fields' => array('id', 'nome')));
			$this->loadModel('Secretaria.Tiporelacionamento');
			$relacionamentos = $this->Tiporelacionamento->find('list', array('fields' => array('id', 'descricao')));
			$escolaridades = $this->Membro->Escolaridade->find('list', array('fields' => array('id', 'descricao')));
			$denominacaos = $this->Membro->Denominacao->find('list', array('fields' => array('id', 'nome')));
			$this->set('denominacaos', $denominacaos);
			$this->set('escolaridades', $escolaridades);
			$this->set('relacionamentos', $relacionamentos);
			$this->set('parentes', $parentes);
			$this->set('cargos', $cargos);
			$this->set('estados', $estados);
			$this->set('profissoes', $profissoes);
		}
	
	}

	public function edit($id = null)
	{
		/*
		Caso tenha sido passado um id para a função ele seta na model que este é o id do Membro que estamos tratando
		E caso não tenha sido passado parametro ou então seja de outro "group", entra na exception.
		**/
		$this->Membro->id = $id;
		if (!$this->Membro->exists()) {
			throw new NotFoundException(__('Membro inválidó.'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {			
			/*
			Se a requisição for Post trata as datas para realizar o save no Banco de Dados
			**/
			$this->request->data['Membro']['datamembro'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['datamembro'])));
			$this->request->data['Membro']['datanascimento'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['datanascimento'])));
			$this->request->data['Membro']['databatismo'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['databatismo'])));
			$this->request->data['Membro']['tipo'] = '1';

			$address = $this->request->data['Endereco']['logradouro'].', '.$this->request->data['Endereco']['numero'].' - '.$this->request->data['Endereco']['bairro'].' - '.$this->request->data['Endereco']['cidade'].' - SP';
			$prepAddr = str_replace(' ','+',$address);
			$geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
			$output = json_decode($geocode);			
			 
			$lat = $output->results[0]->geometry->location->lat;
			$long = $output->results[0]->geometry->location->lng;

			$this->request->data['Membro']['latitude'] = $lat;
			$this->request->data['Membro']['longitude'] = $long;

			/*
			Caso salvo com sucesso  Seta o setFlash() e redireciona para a action index.
			Caso contrario, se mantem na mesma action e seta o setFlash() com mensagem de erro.
			**/
			$relacionamentos = $this->request->data['Relacionamento'];
			unset($this->request->data['Relacionamento']);
			if($this->Membro->saveAll($this->request->data)){
				foreach ($relacionamentos as $key => $value) {
					$relacionamentos[$key]['membro_id'] = $this->Membro->id;
					if (empty($relacionamentos[$key]['membro2_id'])) {
						unset($relacionamentos[$key]);
					}
				}
				$this->Membro->Relacionamento->saveAll($relacionamentos);
				echo 'Membro Salvo com Sucesso!';
			} else {
				echo 'Membro Não Salvo!';
			}
		} else {
			/*
			Carregando Models não relacionadas
			**/
			$this->loadModel('Secretaria.Tiporelacionamento');
			/*
			Finds em banco de dados
			**/
			$this->Membro->recursive = 2;
			$this->request->data = $this->Membro->read(null, $id);
			$estados = $this->Membro->Estado->find('list', array('fields' => array('codibge', 'nome')));
			$profissoes = $this->Membro->Profissao->find('list', array('fields' => array('id', 'nome')));
			$cargos = $this->Membro->Cargo->find('list', array('fields' => array('id', 'nome')));
			$this->Membro->all = true;
			$parentes = $this->Membro->find('list', array('fields' => array('id', 'nome')));
			$relacionamentos = $this->Tiporelacionamento->find('list', array('fields' => array('id', 'descricao')));
			$escolaridades = $this->Membro->Escolaridade->find('list', array('fields' => array('id', 'descricao')));
			$denominacaos = $this->Membro->Denominacao->find('list', array('fields' => array('id', 'nome')));
			/*
			Fim Finds em banco de dados
			**/

			/*
			Setando Variáveis para a view
			**/
			$this->set('denominacaos', $denominacaos);
			$this->set('cargos', $cargos);
			$this->set('estados', $estados);
			$this->set('profissoes', $profissoes);
			$this->set('parentes', $parentes);
			$this->set('relacionamentos', $relacionamentos);
			$this->set('escolaridades', $escolaridades);
			/*
			Fim setando Variáveis
			Tratando datas para a view.
			**/
			$this->request->data['Membro']['datamembro'] = implode('/', array_reverse(explode('-', $this->request->data['Membro']['datamembro'])));
			$this->request->data['Membro']['datanascimento'] = implode('/', array_reverse(explode('-', $this->request->data['Membro']['datanascimento'])));
			$this->request->data['Membro']['databatismo'] = implode('/', array_reverse(explode('-', $this->request->data['Membro']['databatismo'])));
			/*
			Fim Tratando datas para a view.
			**/
		}
	}

	public function desvincular($id = null){
		$status = false;
		$this->autoRender = false;
		if (!empty($id)) {
			$status = $this->Membro->Relacionamento->delete($id);
		}
		return $status;
	}

	public function delete($id = null)
	{
		$this->autoRender = false;
		//verificando metodo de requisição
		if (!$this->request->is('post'))
		{
			json_encode('Metodo Não Permitido');
		}
		//verificando se este $id existe
		$this->Membro->id = $id;
		if (!$this->Membro->exists())
		{
			json_encode('Membro inexistente!');
		}
		//excluindo usuário
		if ($this->Membro->delete())
		{
			json_encode('Membro Deletado');
		}
		else
		{
			json_encode('O Membro não pôde ser deletado');
		}
	}
}
