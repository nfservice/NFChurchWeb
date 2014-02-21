<div class="form-group">
	<?php 
		echo $this->Form->create('Profissao');
		echo $this->Form->input('nome', array('label' => 'Nome Profissão:', 'disabled', 'class' => 'form-control'));
		echo $this->Form->input('descricao', array('label' => 'Descrição:', 'disabled', 'class' => 'form-control'));
		echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->request->data['Profissao']['id']));
		echo $this->Form->input($this->Html->link('Voltar', array('plugin' => 'secretaria', 'controller' => 'profissaos', 'action' => 'index')), array('type' => 'button', 'label' => false));
		echo $this->Form->input($this->Html->link('Habilitar Edição', array('action' => 'edit', $this->request->data['Profissao']['id'])), array('type' => 'button', 'label' => false));
	?>
</div>