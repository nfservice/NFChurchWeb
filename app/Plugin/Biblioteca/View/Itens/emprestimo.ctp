<div class="col-md-12">
	<h3>Empréstimo - <strong><?php echo $item['Item']['titulo']; ?></strong></h3>
	<?php 
		echo $this->Form->create('MovimentacaoItem', array('role' => 'form', 'class' => 'formModal'));

			echo $this->Form->input('item_id', array('type' => 'hidden', 'value' => $item['Item']['id']));
			echo $this->Form->input('quantidade', array('label' => 'Quantidade', 'value' => 1, 'min' => 1, 'max' => $item['Item']['estoque'], 'class' => 'form-control', 'required','div' => array('class' => 'form-group col-md-2')));
			echo $this->Form->input('membro_id', array('label' => 'Membro', 'empty' => 'Selecione um membro', 'class' => 'form-control', 'required', 'options' => $membros, 'div' => array('class' => 'form-group col-md-10')));

		echo $this->Form->input('Salvar', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-12')));        
        echo $this->Form->end();
    ?>
</div>