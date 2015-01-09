<div class="col-md-12">
	<?php
		echo $this->Form->create(array('Cargo', 'role' => 'form', 'class' => 'formModal'));
		echo $this->Form->input('nome', array('label' => 'Nome: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-12')));
		echo $this->Form->input('descricao', array('label' => 'Descrição das Funções: ', 'type' => 'textarea', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-12')));
	?> 
		<div class="form-group col-md-2">
			<button data-dismiss="modal" class="btn btn-default form-control" type="button">Cancelar</button>
		</div>
	<?php
		//echo $this->Form->input($this->Html->link('Voltar', array('plugin' => 'secretaria', 'controller' => 'visitantes', 'action' => 'index')), array('type' => 'button', 'label' => false, 'class' => 'btn btn-cancel', 'div' => array('class' => 'form-group col-md-1')));
		echo $this->Form->input('Salvar Cargo', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-4')));
		echo $this->Form->end(); 
	?>
</div>