<div class="col-md-12">
	<h3>Empréstimo - <strong><?php echo $item['Item']['titulo']; ?></strong></h3>
	<?php 
		echo $this->Form->create('MovimentacaoItem', array('role' => 'form', 'class' => 'formModal'));

			echo $this->Form->input('item_id', array('type' => 'hidden', 'value' => $item['Item']['id']));
			echo $this->Form->input('devolvido', array('type' => 'hidden', 'value' => '1'));
			echo $this->Form->input('id', array('label' => 'Membro', 'class' => 'form-control', 'required', 'options' => $membros, 'div' => array('class' => 'form-group col-md-12')));

		echo $this->Form->input('Salvar', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-12')));        
        echo $this->Form->end();
    ?>
</div>