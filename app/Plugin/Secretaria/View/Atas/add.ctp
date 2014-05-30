<?php echo $this->Html->script(array('jquery', 'scripts')); ?>
<script>
	var cont = 0;
	var next = 1;
	function addMovimentacao()
	{
		mov = $('#movimentacao0').clone().outerHTML();		
		
		$('#all').append(mov.replaceAll('movimentacao0', 'movimentacao'+next).replaceAll('Movimentacaoata0MembroId', 'Movimentacaoata'+next+'MembroId').replaceAll('Movimentacaoata0CargoId', 'Movimentacaoata'+next+'CargoId').replaceAll('remove0', 'remove'+next).replaceAll('[Movimentacaoata][0][membro_id]', '[Movimentacaoata]['+next+'][membro_id]').replaceAll('[Movimentacaoata][0][cargo_id]', '[Movimentacaoata]['+next+'][cargo_id]').replaceAll('[Movimentacaoata][0][cargo_id]', '[Movimentacaoata]['+next+'][church_id]').replaceAll('Movimentacaoata0ChurchId', 'Movimentacaoata'+next+'ChurchId'));
		$('#remove'+next).html('<a href="javascript:;" onclick="delMovimentacao('+next+')">Remover</a>');
		cont++;
		next++;
	}

	function delMovimentacao(id)
	{
		$('#movimentacao'+id).remove();
	}
</script>
<h1>Nova Ata</h1>
<?php
	echo $this->Form->create('Ata', array('type' => 'file'));
	echo $this->Form->input('num', array('label' => 'Número: ', 'type' => 'text'));
	echo $this->Form->input('data', array('label' => 'Data: ', 'type' => 'text'));
	echo $this->Form->input('files.', array('type' => 'file', 'multiple'));
	?>
	<h3>Movimentação Cargos:</h3>
	<div id="all">
		<div id="movimentacao0">
			<?php
				echo $this->Form->input('Movimentacaoata.0.church_id', array('type' => 'hidden', 'value' => $this->Session->read('choosed')));
				echo $this->Form->input('Movimentacaoata.0.membro_id', array('label' => 'Membro:', 'options' => $membros));
				echo $this->Form->input('Movimentacaoata.0.cargo_id', array('label' => 'Cargo:', 'options' => $cargos));
			?>
			<div id="remove0">
				
			</div>
		</div>
	</div>
<?php
	echo $this->Html->link('Adicionar', 'javascript:;', array('onclick' => 'addMovimentacao()'));
	echo $this->Form->input($this->Html->link('Voltar', array('plugin' => 'secretaria', 'controller' => 'atas', 'action' => 'index')), array('type' => 'button', 'label' => false));
	echo $this->Form->end('Salvar');
?>