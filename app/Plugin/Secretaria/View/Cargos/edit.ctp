<h1>Editar Cargo / Função</h1>
<?php
	echo $this->Form->create('Cargo');
	echo $this->Form->input('id', array('type' => 'hidden'));
	echo $this->Form->input('nome', array('label' => 'Nome: ', 'type' => 'text'));
	echo $this->Form->input('descricao', array('label' => 'Descrição das Funções: ', 'type' => 'textarea'));
	echo $this->Form->input($this->Html->link('Voltar', array('plugin' => 'secretaria', 'controller' => 'cargos', 'action' => 'index')), array('type' => 'button', 'label' => false));
	echo $this->Form->end('Salvar');
?>