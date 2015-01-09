<h1>Novo Relacionamento</h1>
<?php
	echo $this->Form->create('Tiporelacionamento');
	echo $this->Form->input('descricao', array('label' => 'Descrição: ', 'type' => 'text'));
	echo $this->Form->input('obs', array('label' => 'Observaões: ', 'type' => 'textarea'));
	echo $this->Form->input($this->Html->link('Voltar', array('plugin' => 'secretaria', 'controller' => 'tiporelacionamentos', 'action' => 'index')), array('type' => 'button', 'label' => false));
	echo $this->Form->end('Salvar');
?>