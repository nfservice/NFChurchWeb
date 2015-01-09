<div class="col-md-12">
	<?php
		echo $this->Form->create(array('Item', 'role' => 'form', 'class' => 'formModal'));
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
			echo $this->Form->input('autor_id', array('label' => 'Autor', 'empty' => 'Nenhum', 'id' => 'autocomplete3', 'class' => 'form-control', 'required', 'options' => $autores, 'div' => array('class' => 'form-group col-md-3')));
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
			echo $this->Form->input('imagem', array('label' => 'Imagem:', 'type' => 'file', 'class' => 'btn btn-default ', 'div' => array('class' => 'form-group col-md-5')));
			echo $this->Form->input('comentarios', array('label' => 'Comentários:', 'class' => 'form-control' , 'type' => 'textarea', 'div' => array('class' => 'form-group col-md-12')));
	?>
			<div class="form-group col-md-2">
				<button data-dismiss="modal" class="btn btn-default form-control" type="button">Cancelar</button>
			</div>
	<?php
			echo $this->Form->input('Salvar Bem', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-4')));
		echo $this->Form->end();
	?>
</div>