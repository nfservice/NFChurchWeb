<?php 
	echo $this->Form->create('Visitante');
	echo $this->Form->input('nome', array('label' => 'Nome:'));
	echo $this->Form->input('sexo', array('label' => 'Sexo:', 'options' => array('0' => 'Selecione', '1' => 'Masculino', '2' => 'Feminino')));
	echo $this->Form->input('datanascimento', array('label' => 'Data de Nascimento:', 'type' => 'text'));
	echo $this->Form->input('email', array('label' => 'E-mail:'));
	echo $this->Form->input('fone', array('label' => 'Telefone:'));
	echo $this->Form->input('cel', array('label' => 'Celular:'));
	echo $this->Form->input('estadocivil', array('label' => 'Estado Civil:', 'options' => array('0' => 'Solteiro', '1' => 'Casado', '2' => 'Viuvo', '3' => 'Desquitado')));
	//Falta Inserir campos de Endereço.
 ?>