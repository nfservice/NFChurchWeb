<?php echo $this->Html->script(array('jquery', 'scripts')); ?>
<h1>Editar Ata</h1>
<?php
	echo $this->Form->create('Ata');
	echo $this->Form->input('id', array('type' => 'hidden'));
	echo $this->Form->input('num', array('label' => 'Número: ', 'type' => 'text'));
	echo $this->Form->input('data', array('label' => 'Data: ', 'type' => 'text'));
	?>
	<h4>Arquivos da Ata:</h4>
	<?php
	foreach ($this->request->data['AtaArquivo'] as $file) {
		echo $this->Html->link($file['nome'], DS.'files'.DS.'ata'.DS.$this->Session->read('choosed').DS.$file['id'], array('download'));
		echo '<br/>';
		//$html->link('pdf', $this->webroot('files'.DS.'ata'.DS.$this->Session->read('choosed').DS.$file['id']);
	}
	$i = 0;
	echo '<div id="all">';
	foreach ($this->request->data['Movimentacaoata'] as $movimentacao) {
		echo '<div id="movimentacao'.$i.'">';
		echo $this->Form->input('Movimentacaoata.'.$i.'.id', array('type' => 'hidden', 'value' => $movimentacao['id']));
		echo $this->Form->input('Movimentacaoata.'.$i.'.membro_id', array('label' => 'Membro:', 'options' => $membros, 'value' => $movimentacao['membro_id']));
		echo $this->Form->input('Movimentacaoata.'.$i.'.cargo_id', array('label' => 'Cargo:', 'options' => $cargos, 'value' => $movimentacao['cargo_id']));
		echo '</div>';
		$i++;
	}
	echo '</div>';
	echo $this->Form->input($this->Html->link('Voltar', array('plugin' => 'secretaria', 'controller' => 'atas', 'action' => 'index')), array('type' => 'button', 'label' => false));
	echo $this->Form->end('Salvar');
?>