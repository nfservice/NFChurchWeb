<?php 
	echo $this->Form->create('Visitante');
	echo $this->Form->input('nome', array('label' => 'Nome:', 'disabled'));
	echo $this->Form->input('sexo', array('label' => 'Sexo:', 'options' => array('0' => 'Selecione', '1' => 'Masculino', '2' => 'Feminino'), 'disabled'));
	echo $this->Form->input('datanascimento', array('label' => 'Data de Nascimento:', 'type' => 'text', 'disabled'));
	echo $this->Form->input('email', array('label' => 'E-mail:', 'disabled'));
	echo $this->Form->input('fone', array('label' => 'Telefone:', 'disabled'));
	echo $this->Form->input('cel', array('label' => 'Celular:', 'disabled'));
	echo $this->Form->input('estadocivil', array('label' => 'Estado Civil:', 'options' => array('0' => 'Solteiro', '1' => 'Casado', '2' => 'Viuvo', '3' => 'Desquitado'), 'disabled'));
	//declarando inputs hidden
	echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->request->data['Visitante']['id']));
	echo $this->Form->input('tipo', array('type' => 'hidden', 'value' => '2'));
	echo $this->Form->input('Endereco.id', array('type' => 'hidden', 'value' => $this->request->data['Endereco']['id']));
	//fim hidden
	echo $this->Form->input('Endereco.cep', array('type' => 'text', 'label' => 'Cep:', 'disabled'));
	echo $this->Form->input('Endereco.logradouro', array('type' => 'text', 'label' => 'Logradouro', 'disabled'));
	echo $this->Form->input('Endereco.numero', array('type' => 'text', 'label' => 'Número', 'disabled'));
	echo $this->Form->input('Endereco.bairro', array('type' => 'text', 'label' => 'Bairro', 'disabled'));
	echo $this->Form->input('Endereco.complemento', array('type' => 'text', 'label' => 'Complemento:', 'disabled'));
	echo $this->Form->input('Endereco.cidade', array('type' => 'text', 'label' => 'Cidade', 'disabled'));
	echo $this->Form->input('Endereco.estado_id', arraY('label' => 'Estado', 'options' => $estados, 'disabled'));
	echo $this->Form->input($this->Html->link('Voltar', array('plugin' => 'secretaria', 'controller' => 'visitantes', 'action' => 'index')), array('type' => 'button', 'label' => false));
 ?>