<h1>Nova Ata</h1>
<?php
	echo $this->Form->create('Ata');
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
	echo $this->Form->input($this->Html->link('Voltar', array('plugin' => 'secretaria', 'controller' => 'atas', 'action' => 'index')), array('type' => 'button', 'label' => false));
	echo $this->Form->end('Salvar');
?>