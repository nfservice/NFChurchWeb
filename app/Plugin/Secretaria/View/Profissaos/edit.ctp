<div class="col-md-12">
	<?php 
		echo $this->Form->create(array('Profissao', 'role' => 'form', 'class' => 'desable-form formModal'));
		
		// cadeado para desbloquear o form
   		echo $this->element('desbloquearForm');

		echo $this->Form->input('id', array('type' => 'hidden')); 
		echo $this->Form->input('nome', array('label' => 'Nome Profissão:', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-12')));
		echo $this->Form->input('descricao', array('label' => 'Descrição:', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-12')));
		
        // modal com confirmação de alteração de cadastro
        echo $this->element('modal/controleForm');

        // botoões do formulário
        echo $this->element('botoesForm');

        echo $this->Form->end(); 
    ?>
</div>