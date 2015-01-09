<div class="col-md-12">
	<?php echo $this->Form->create(array('Item', 'role' => 'form', 'class' => 'desable-form formModal')); 

		// cadeado para desbloquear o form
    	echo $this->element('desbloquearForm');
			echo $this->Form->input('titulo', array('label' => 'Nome: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-8')));
			echo $this->Form->input('paginas', array('label' => 'Páginas: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-1')));
			echo $this->Form->input('isbn', array('label' => 'ISBN: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
			echo $this->Form->input('tipo_id', array('label' => 'Tipo de Produto', 'empty' => 'Nenhum', 'id' => 'autocomplete', 'class' => 'form-control', 'required', 'options' => $tipos, 'div' => array('class' => 'form-group col-md-3')));
	?>
			<div class="form-group col-md-1">
				<a href="javascript:;" class="form-control btn btn-primary" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "biblioteca", "controller" => "tipos", "action" => "add")); ?>', 'autocomplete', 'autocomplete');" data-toggle="tooltip" data-placement="top" title="Adicionar Tipo" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a>
			</div>
	<?php
			echo $this->Form->input('categoria_id', array('label' => 'Categoria', 'empty' => 'Nenhum', 'id' => 'autocomplete2', 'class' => 'form-control', 'required', 'options' => $categorias, 'div' => array('class' => 'form-group col-md-3')));
	?>
			<div class="form-group col-md-1">
				<a href="javascript:;" class="form-control btn btn-primary" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "biblioteca", "controller" => "categorias", "action" => "add")); ?>', 'autocomplete2', 'autocomplete2');" data-toggle="tooltip" data-placement="top" title="Adicionar Tipo" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a>
			</div>
	<?php
			echo $this->Form->input('autor_id', array('label' => 'Autor', 'empty' => 'Nenhum', 'id' => 'autocomplete3', 'class' => 'form-control', 'options' => $autores, 'div' => array('class' => 'form-group col-md-3')));
	?>
			<div class="form-group col-md-1">
				<a href="javascript:;" class="form-control btn btn-primary" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "biblioteca", "controller" => "autores", "action" => "add")); ?>', 'autocomplete3', 'autocomplete3');" data-toggle="tooltip" data-placement="top" title="Adicionar Tipo" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a>
			</div>
	<?php
			echo $this->Form->input('editora_id', array('label' => 'Editora', 'empty' => 'Nenhum', 'id' => 'autocomplete4', 'class' => 'form-control', 'options' => $editoras, 'div' => array('class' => 'form-group col-md-3')));
	?>
			<div class="form-group col-md-1">
				<a href="javascript:;" class="form-control btn btn-primary" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "biblioteca", "controller" => "editoras", "action" => "add")); ?>', 'autocomplete4', 'autocomplete4');" data-toggle="tooltip" data-placement="top" title="Adicionar Tipo" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a>
			</div>
	<?php
			echo $this->Form->input('estoque', array('label' => 'Estoque: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-1')));
			echo $this->Form->input('preco', array('label' => 'Preço: ', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
			echo $this->Form->input('imagem', array('label' => 'Imagem:', 'type' => 'file', 'class' => 'btn btn-default col-md-11', 'div' => array('class' => 'form-group col-md-4')));
	?>
			<div class="form-group col-md-1">
				<a href="<?php echo $this->Html->url('/files/biblioteca/'.$this->request->data['Item']['church_id'].'/'.$this->request->data['Item']['foto']); ?>" target="_blank"><i class="fa fa-eye"></i></a>
			</div>
	<?php
			echo $this->Form->input('comentarios', array('label' => 'Comentários:', 'class' => 'form-control' , 'type' => 'textarea', 'div' => array('class' => 'form-group col-md-12')));
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
	<?php

        // modal com confirmação de alteração de cadastro
        echo $this->element('modal/controleForm');

        // botoões do formulário
        echo $this->element('botoesForm');

        echo $this->Form->end(); 
    ?>
</div>