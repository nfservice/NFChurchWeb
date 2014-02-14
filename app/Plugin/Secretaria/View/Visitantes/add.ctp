<?php 
	echo $this->Form->create('Visitante');
	echo $this->Form->input('nome', array('label' => 'Nome:'));
	echo $this->Form->input('sexo', array('label' => 'Sexo:', 'options' => array('0' => 'Selecione', '1' => 'Masculino', '2' => 'Feminino')));
	echo $this->Form->input('datanascimento', array('label' => 'Data de Nascimento:', 'type' => 'text'));
	echo $this->Form->input('email', array('label' => 'E-mail:'));
	echo $this->Form->input('fone', array('label' => 'Telefone:'));
	echo $this->Form->input('cel', array('label' => 'Celular:'));
	echo $this->Form->input('estadocivil', array('label' => 'Estado Civil:', 'options' => array('0' => 'Solteiro', '1' => 'Casado', '2' => 'Viuvo', '3' => 'Desquitado')));
	//declarando inputs hidden
	echo $this->Form->input('tipo', array('type' => 'hidden', 'value' => '2'));
	//fim hidden
	echo $this->Form->input('Endereco.cep', array('type' => 'text', 'label' => 'Cep:'));
	echo $this->Form->input('Endereco.logradouro', array('type' => 'text', 'label' => 'Logradouro'));
	echo $this->Form->input('Endereco.numero', array('type' => 'text', 'label' => 'Número'));
	echo $this->Form->input('Endereco.bairro', array('type' => 'text', 'label' => 'Bairro'));
	echo $this->Form->input('Endereco.complemento', array('type' => 'text', 'label' => 'Complemento:'));
	echo $this->Form->input('Endereco.cidade', array('type' => 'text', 'label' => 'Cidade'));
	echo $this->Form->input('Endereco.estado_id', arraY('label' => 'Estado', 'options' => $estados));
	echo $this->Form->input($this->Html->link('Voltar', array('plugin' => 'secretaria', 'controller' => 'visitantes', 'action' => 'index')), array('type' => 'button', 'label' => false));
	echo $this->Form->end('Salvar');
 ?>