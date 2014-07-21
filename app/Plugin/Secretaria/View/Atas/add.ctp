<?php // echo $this->Html->script(array("scripts"); ?>
<script type="text/javascript">
	var cont = 0;
	var next = 1;
	function addMovimentacao()
	{
	    var mov = $('#movimentacao0').clone().html();
	    mov = '<div id="movimentacao'+next+'"">'+mov+'</div>';	    
	    $('#all').append(mov.replaceAll('movimentacao0', 'movimentacao'+next).replaceAll('Movimentacaoata0MembroId', 'Movimentacaoata'+next+'MembroId').replaceAll('Movimentacaoata0CargoId', 'Movimentacaoata'+next+'CargoId').replaceAll('remove0', 'remove'+next).replaceAll('[Movimentacaoata][0][membro_id]', '[Movimentacaoata]['+next+'][membro_id]').replaceAll('[Movimentacaoata][0][cargo_id]', '[Movimentacaoata]['+next+'][cargo_id]').replaceAll('[Movimentacaoata][0][cargo_id]', '[Movimentacaoata]['+next+'][church_id]').replaceAll('Movimentacaoata0ChurchId', 'Movimentacaoata'+next+'ChurchId'));
	    $('#remove'+next).html('<div class="form-group"><a href="javascript:;" onclick="delMovimentacao('+next+');" class="btn btn-danger form-control" style="margin-top: 22px;"><i class="fa fa-trash-o"</i></a></div>');
	    cont++;
	    next++;
	}

	function delMovimentacao(id)
	{
	    $('#movimentacao'+id).remove();
	}
</script>
<div class="col-md-12">
	<?php
	echo $this->Form->create('Ata', array('type' => 'file', 'role' => 'form', 'class' => 'formModal'));
	echo $this->Form->input('num', array('label' => 'Número: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-12')));
	echo $this->Form->input('data', array('label' => 'Data: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-12')));
	echo $this->Form->input('files.', array('type' => 'file', 'multiple', 'class' => 'btn btn-default ', 'div' => array('class' => 'form-group col-md-12')));
	?>
	<div class="col-md-12"><h3>Movimentação Cargos:</h3></div>
	<div id="all">
		<div id="movimentacao0">
			<?php
			echo $this->Form->input('Movimentacaoata.0.church_id', array('type' => 'hidden', 'value' => $this->Session->read('choosed')));
			
			echo $this->Form->input('Movimentacaoata.0.membro_id', array('label' => 'Membro:', 'options' => $membros, 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));
			echo $this->Form->input('Movimentacaoata.0.cargo_id', array('label' => 'Cargo:', 'options' => $cargos, 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-5')));
			?>
			<div id="remove0" class="col-md-1">

			</div>
		</div>
	</div>
	<div class="col-md-11 form-group">
		<a href="javascript:;" class="btn btn-primary form-control" onclick="addMovimentacao();">Adicionar</a>
	</div>
	<div class="form-group col-md-2">	
		<button data-dismiss="modal" class="btn btn-default form-control" type="button">Cancelar</button>
	</div>
	<?php
		//echo $this->Form->input($this->Html->link('Voltar', array('plugin' => 'secretaria', 'controller' => 'visitantes', 'action' => 'index')), array('type' => 'button', 'label' => false, 'class' => 'btn btn-cancel', 'div' => array('class' => 'form-group col-md-1')));
		echo $this->Form->input('Salvar Ata', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-4')));
		echo $this->Form->end(); 
	?>
</div>