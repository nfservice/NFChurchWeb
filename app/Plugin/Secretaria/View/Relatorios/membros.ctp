<h2>Pesquisar Membros</h2>
<div class="row">
	<?php 
		echo $this->Form->create('Relatorio', array('role' => 'form'));

		echo $this->Form->input('tornouse_de', array('class' => 'form-control', 'label' => 'Tournou-se de:', 'div' => array('class' => 'form-group col-md-2')));
		echo $this->Form->input('tornouse_ate', array('class' => 'form-control', 'label' => 'Tournou-se até:', 'div' => array('class' => 'form-group col-md-2')));

		echo $this->Form->input('nome', array('class' => 'form-control', 'label' => 'Nome:', 'div' => array('class' => 'form-group col-md-5')));

		echo $this->Form->input('sexo', array('class' => 'form-control', 'label' => 'Sexo:', 'options' => array('F' => 'Feminino', 'M' => 'Masculino'), 'div' => array('class' => 'form-group col-md-3')));
	?>
</div>