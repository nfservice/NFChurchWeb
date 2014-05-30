<div class="col-lg-12">
	<?php 
		echo $this->Form->create(array('Profissao', 'class' => 'desable-form formModal'));
	?>
	<h3>Editar a profissão <b><?php echo $this->request->data['Profissao']['nome']; ?></b></h3>
	<?php
		echo $this->Form->input('nome', array('label' => 'Nome Profissão:', 'class' => 'form-control col-md-12', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('descricao', array('label' => 'Descrição:', 'class' => 'form-control col-md-12', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->request->data['Profissao']['id']));
	 ?>

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
	<div class="form-group">
		<button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>	
		<a class="btn btn-warning habilita_campos" id="futuro-salvar">Habilitar Edição</a>
		<a class="btn btn-primary" id="salvar-dados" data-toggle="modal" href="#confirmar" style="display:none">Salvar alterações</a>
	</div>
	<?php 
		echo $this->Form->end();
	?>
</div>