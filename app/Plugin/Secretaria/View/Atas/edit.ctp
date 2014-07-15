<div class="col-md-12">
<?php
	echo $this->Form->create(array('Ata', 'role' => 'form', 'class' => 'desable-form formModal'));?>
		<div class="col-md-12">
			<div class="alert alert-warning" id="msg_block">    
			    <p><button type="button" class="btn btn-success habilita_campos" id="futuro-salvar"><i class="fa fa-unlock"></i></button> Clique no cadeado ao lado para desbloquear os campos do formulário</p>
			</div>
		</div>
		<?php
	echo $this->Form->input('id', array('type' => 'hidden'));
	echo $this->Form->input('num', array('label' => 'Número: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-12')));
	echo $this->Form->input('data', array('label' => 'Data: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-12')));
	?>
	<div class="col-md-12 form-group">
		<h4>Arquivos da Ata:</h4>
		<?php
		foreach ($this->request->data['AtaArquivo'] as $file) {
			echo $this->Html->link($file['nome'], DS.'files'.DS.'ata'.DS.$this->Session->read('choosed').DS.$file['id'], array('download', 'class' => 'btn btn-success'));
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
	<div class="modal fade over-hidden" id="confirmar" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content shadowModal">
				<div class="modal-header">
					<h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Confirme as alterações dos dados</h4>
				</div>
				<div class="modal-body">
					Tem certeza de que quer salvar as alterações nesse cadastro?
				</div>
				<div class="modal-footer">
					<button class="btn btn-default nao-salvar" type="button">Não quero mais salvar</button>
					<input class="btn btn-warning" type="submit" value="Sim, quero salvar">
				</div>
			</div>
		</div>
	</div>
	<div class="form-group col-md-2">
		<button data-dismiss="modal" class="btn btn-default form-control" type="button">Fechar</button>	
	</div>
	<div class="form-group col-md-4">
		<a class="btn btn-warning habilita_campos form-control" id="futuro-salvar">Habilitar Edição</a>
		<a class="btn btn-primary form-control" id="salvar-dados" data-toggle="modal" href="#confirmar" style="display:none">Salvar alterações</a>
	</div>
	<?php 
		echo $this->Form->end();
	?>
</div>