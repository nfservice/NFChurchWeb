<?php
class DenominacaosController extends SecretariaAppController{
	public function index(){
		$conditions = array();
		unset($this->request->data['submit']);
		if (!empty($this->request->data['filtro']))
    	{
    		//condições para pesquisa
    		//campos para não entrar na pesquisa
    		$excludes = array('id', 'sexo', 'estado_id', 'estadocivil', 'escolaridade', 'profissao_id', 'igrejasanteriores', 'created', 'modified', 'uid', 'church_id', 'user_id', 'tipo');
    		//pega campos da model
    		$fields = $this->Denominacao->schema();
    		foreach ($fields as $key => $value) {
    			if (!in_array($key, $excludes)) {
    				$conditions['OR']['Denominacao.'.$key.' LIKE '] = '%'.$this->request->data['filtro'].'%';
    			}
    		}
    		
    	}
		$this->set('denominacaos', $this->paginate(null, $conditions));
	}

	public function add(){
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Denominacao->create();
			if ($this->Denominacao->saveAll($this->request->data)) {
				$this->Session->setFlash('Denominação cadastrada com sucesso!');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Não foi possível cadastrar a Denominação');
			}
		}
	}

	public function view($id = null){
		$this->Denominacao->id = $id;
		if (!empty($this->Denominacao->id)) {
			$this->request->data = $this->Denominacao->read(null, $id);
		} else {
			throw new Exception("Denominação inexistente");
		}
	}

	public function edit($id = null){
		$this->Denominacao->id = $id;
		if (empty($this->Denominacao->id)) {
			throw new Exception("Denominação inexistente");				
		}
		if ($this->request->is('post')||($this->request->is('put'))) {
			if (!$this->Denominacao->exists()) {
				throw new Exception("Denominação inexistente");
			}
			if (!empty($this->Denominacao->id)) {
				if ($this->Denominacao->saveAll($this->request->data)) {
					$this->Session->setFlash('Denominação Alterada Com Sucesso');
				} else {
					$this->Session->setFlash('Não foi possível cadastrar a Denominação');
				}			
			}
		} else {
			$this->request->data = $this->Denominacao->read(null, $id);		
		}
	}

	public function delete($id = null)
	{
		$this->autoRender = false;
		if (!$this->request->is('post') || empty($id)) {
			throw new MethodNotAllowedException();
		}

		$this->request->data = $this->Denominacao->read(null, $id);
		$this->Denominacao->id = $id;

		if (!$this->Denominacao->exists()) {
			throw new NotFoundException(__('Denominacao inválido.'));
		}
		if ($this->Denominacao->delete()) {
			$this->Session->setFlash(__('Denominacao deletado com sucesso.'));
		}
		$this->Session->setFlash(__('O Denominacao não pôde ser deletado.'));
	}
}