<div class="col-md-12">
<?php
	echo $this->Form->create(array('Ata', 'role' => 'form', 'class' => 'desable-form formModal'));

	// destravar o form
	echo $this->element('desbloquearForm');

	echo $this->Form->input('id', array('type' => 'hidden'));
	echo $this->Form->input('num', array('label' => 'Número: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-12')));
	echo $this->Form->input('data', array('label' => 'Data: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-12')));
	?>
	<div class="col-md-12 form-group">
		<h4>Arquivos da Ata:</h4>
		<?php
		foreach ($this->request->data['AtaArquivo'] as $key => $file) {
			echo $this->Html->link($file['nome'], array('action' => 'download', $file['id'], $this->request->data['Ata']['id'].'-'.$key), array('download', 'class' => 'btn btn-success'));
			echo '<br/><br />';
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
?>
</div>
	<?php 

        // modal com confirmação de alteração de cadastro
        echo $this->element('modal/controleForm');

        // botoões do formulário
        echo $this->element('botoesForm');

        echo $this->Form->end(); 
    ?>
</div>