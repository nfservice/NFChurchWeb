<h1>Nova Escolaridade</h1>
<?php
	echo $this->Form->create('Escolaridade');
	echo $this->Form->input('descricao', array('label' => 'Descrição: ', 'type' => 'text'));
	echo $this->Form->input('obs', array('label' => 'Observaões: ', 'type' => 'textarea'));
	echo $this->Form->input($this->Html->link('Voltar', array('plugin' => 'secretaria', 'controller' => 'escolaridades', 'action' => 'index')), array('type' => 'button', 'label' => false));
	echo $this->Form->end('Salvar');
?>