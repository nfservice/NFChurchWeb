<div class="col-md-12">
	<?php echo $this->Form->create(array('Bem', 'role' => 'form', 'class' => 'desable-form formModal')); 

		// cadeado para desbloquear o form
    	echo $this->element('desbloquearForm');
		
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
	<?php

        // modal com confirmação de alteração de cadastro
        echo $this->element('modal/controleForm');

        // botoões do formulário
        echo $this->element('botoesForm');

        echo $this->Form->end(); 
    ?>
</div>