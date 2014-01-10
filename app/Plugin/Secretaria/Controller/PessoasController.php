<?php
class PessoasController extends SecretariaAppController {

	public function index(){

	}

	public function add(){
		$this->Pessoa->create();
		if($this->request->is('post')){
			if($this->Pessoa->save($this->request->data)){
				$this->Session->setFlash('Pessoa Salva com Sucesso!');
				$this->redirect(array('plugin' => null, 'controller' => 'pages', 'action' => 'home'));
			}else{
				$this->Session->setFlash('Pessoa Não Salva!');
				$this->redirect(array('plugin' => null, 'controller' => 'pages', 'action' => 'home'));
			}
		} else {
			$estados = $this->Pessoa->Estado->find('list', array('fields' => array('codibge', 'nome')));
			$profissoes = $this->Pessoa->Profissao->find('list', array('fields' => array('id', 'descricao')));
			$this->set('estados', $estados);
			$profissoes[0] = 'Selecione';
			$this->set('profissoes', $profissoes);
		}
	
	}

	public function edit(){
		
	}

	public function view(){
		
	}

	public function delete(){
		
	}
}
