<?php
class PessoasController extends SecretariaAppController {

	public function index(){

	}

	public function add(){
		$estados = $this->Pessoa->Estado->find('list', array('fields' => array('codibge', 'nome')));
		$profissoes = $this->Pessoa->Profissao->find('list', array('fields' => array('id', 'descricao')));
		$this->set('estados', $estados);
		$profissoes[0] = 'Selecione';
		$this->set('profissoes', $profissoes);
	}

	public function edit(){
		
	}

	public function view(){
		
	}

	public function delete(){
		
	}
}
