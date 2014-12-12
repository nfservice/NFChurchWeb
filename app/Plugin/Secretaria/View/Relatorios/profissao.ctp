<?php
	echo $this->Form->create('Profissao');
	echo $this->Form->input('Gerar Relatório', array('type' => 'submit', 'label' => false, 'class' => 'form-control btn btn-success', 'div' => array('class' => ' col-md-3 form-group')));
	echo $this->Form->end();
?>