<h1>Nova Escolaridade</h1>
<?php
	echo $this->Form->create('Escolaridade');
	echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->request->data['Escolaridade']['id']));
	echo $this->Form->input('descricao', array('label' => 'Descrição: ', 'type' => 'text', 'value' => $this->request->data['Escolaridade']['descricao']));
	echo $this->Form->input('obs', array('label' => 'Observaões: ', 'type' => 'textarea', 'value' => $this->request->data['Escolaridade']['obs']));
	echo $this->Form->input($this->Html->link('Voltar', array('plugin' => 'secretaria', 'controller' => 'escolaridades', 'action' => 'index')), array('type' => 'button', 'label' => false));
	echo $this->Form->end('Salvar Alterações');
?>