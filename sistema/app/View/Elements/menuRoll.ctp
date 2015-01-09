<div class="col-md-12">
	<div class="panel menuRoll">
		<div class="panel-body row">
			
			<!-- form -->
			<?php echo $this->Form->create(array('Pesquisa' ,'action' => 'index', 'role' => 'form')); ?>
			<div class="form-group col-md-4">
				<a class="btn btn-success form-control btnModal" onclick="modalLoad('<?php echo $this->Html->url(array("action" => "add")); ?>');"><i class="fa fa-plus"></i> Adicionar</a>
			</div>
			<div class="form-group col-md-2">
				<a href="javascript:;" class="btn btn-danger form-control" data-toggle="modal" data-target="#confirmacaoExclusao"><i class="fa fa-trash-o"></i> Apagar</a>
			</div>
			<div class="form-group col-md-6">
				<div class="input-group m-bot15">
					<input type="text" class="form-control" id="texto" name="filtro" placeholder="Pesquise aqui">
					<span class="input-group-btn">
						<input class="btn btn-success" type="submit" value="Buscar">
					</span>
				</div>
			</div>
			<!-- end form -->
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>