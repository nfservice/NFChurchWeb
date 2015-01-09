<h1>Cadastrar Dom</h1>
<?php
	echo $this->Form->create('Don');
	echo $this->Form->input('church_id', array('type' => 'hidden', 'value' => $this->Session->read('choosed')));
	echo $this->Form->input('nome', array('label' => 'Nome: '));
	echo $this->Form->input('observacoes', array('label' => 'Observações:'));
	echo $this->Form->input($this->Html->link('Voltar', array('plugin' => 'secretaria', 'controller' => 'dons', 'action' => 'index')), array('type' => 'button', 'label' => false));
	echo $this->Form->end('Salvar');
?>