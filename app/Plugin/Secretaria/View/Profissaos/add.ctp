<div class="form-group">
	<?php 
		echo $this->Form->create('Profissao');
		echo $this->Form->input('nome', array('label' => 'Nome Profissão:', 'class' => 'form-control'));
		echo $this->Form->input('descricao', array('label' => 'Descrição:', 'class' => 'form-control'));

		echo $this->Form->input($this->Html->link('Voltar', array('plugin' => 'secretaria', 'controller' => 'profissaos', 'action' => 'index')), array('type' => 'button', 'label' => false));
		echo $this->Form->end('Cadastrar');
	 ?>
 </div>