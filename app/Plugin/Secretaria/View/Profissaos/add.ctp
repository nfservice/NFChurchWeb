<?php 
	echo $this->Form->create(array('Profissao', 'role' => 'form', 'class' => 'formModal'));
	echo $this->Form->input('nome', array('label' => 'Nome Profissão:', 'class' => 'form-control col-md-12', 'div' => array('class' => 'form-group col-md-12'), 'required' => 'required'));
	echo $this->Form->input('descricao', array('label' => 'Descrição:', 'class' => 'form-control col-md-12', 'div' => array('class' => 'form-group col-md-12'), 'required' => 'required'));

?>
<div class="form-group col-md-2 fecha-modal">
	<button data-dismiss="modal" class="btn btn-default form-control" type="button">Fechar</button>
</div>
<?php
	echo $this->Form->input('Salvar Profissão', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-4'), 'id' => 'salvar_dados'));
 ?>