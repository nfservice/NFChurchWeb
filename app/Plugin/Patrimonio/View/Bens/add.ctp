<div class="col-md-12">
	<?php
		echo $this->Form->create(array('Bem', 'role' => 'form', 'class' => 'formModal'));
			echo $this->Form->input('nome', array('label' => 'Nome: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
			echo $this->Form->input('num_ativo', array('label' => 'Num. Ativo: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
			echo $this->Form->input('identificacao', array('label' => 'Identificação: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
			echo $this->Form->input('tipo_bem_id', array('label' => 'Tipo', 'empty' => 'Nenhum', 'id' => 'autocomplete', 'class' => 'form-control', 'required', 'options' => $tipo_bens, 'div' => array('class' => 'form-group col-md-2')));
	?>
	        <div class="form-group col-md-1">
	            <a href="javascript:;" class="form-control btn btn-primary" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "patrimonio", "controller" => "tipo_bem", "action" => "add")); ?>', 'autocomplete', 'autocomplete');" data-toggle="tooltip" data-placement="top" title="Adicionar Tipo" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a>
	        </div>
	<?php			
			echo $this->Form->input('membro_id', array('label' => 'Membro Doador', 'empty' => 'Nenhum', 'id' => 'autocomplete3', 'class' => 'form-control', 'options' => $membros, 'div' => array('class' => 'form-group col-md-5')));
	?>
	        <div class="form-group col-md-1">
	            <a href="javascript:;" class="form-control btn btn-primary" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "membros", "action" => "add")); ?>', 'autocomplete3', 'autocomplete3');" data-toggle="tooltip" data-placement="top" title="Adicionar Membro" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a>
	        </div>
	<?php
			echo $this->Form->input('congregacao_id', array('label' => 'Congregação', 'empty' => 'Nenhuma', 'id' => 'autocomplete2', 'class' => 'form-control', 'options' => $congregacoes, 'div' => array('class' => 'form-group col-md-2')));
	?>
	        <div class="form-group col-md-1">
	            <a href="javascript:;" class="form-control btn btn-primary" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "congregacaos", "action" => "add")); ?>', 'autocomplete2', 'autocomplete2');" data-toggle="tooltip" data-placement="top" title="Adicionar Congregação" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a>
	        </div>
	<?php 
			echo $this->Form->input('num_serie', array('label' => 'Num. Série: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
			echo $this->Form->input('garantia', array('label' => 'Garantia: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
			echo $this->Form->input('data_compra', array('label' => 'Data Compra: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
			echo $this->Form->input('valor_unitario', array('label' => 'Valor Unit.: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
			echo $this->Form->input('datacompra', array('label' => 'Data Compra: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
			echo $this->Form->input('quantidade', array('label' => 'Qtd.: ', 'type' => 'number', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-1')));
			echo $this->Form->input('departamento_id', array('label' => 'Departamento', 'empty' => 'Nenhuma', 'id' => 'autocomplete4', 'class' => 'form-control', 'required', 'options' => $departamentos, 'div' => array('class' => 'form-group col-md-2')));
	?>
	        <div class="form-group col-md-1">
	            <a href="javascript:;" class="form-control btn btn-primary" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "departamentos", "action" => "add")); ?>', 'autocomplete4', 'autocomplete4');" data-toggle="tooltip" data-placement="top" title="Adicionar Departamento" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a>
	        </div>
			<div class="form-group col-md-2">
				<button data-dismiss="modal" class="btn btn-default form-control" type="button">Cancelar</button>
			</div>
	<?php
			echo $this->Form->input('Salvar Bem', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-4')));
		echo $this->Form->end();
	?>
</div>