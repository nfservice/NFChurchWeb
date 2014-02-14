<div class="row">
	<h2 class="col-lg-2">Profissões</h2>
	<div class="form-group">		
		<div class="nav notify-row">
		<a href="<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'profissaos', 'action' => 'edit')) ?>"><button type="button" class="btn btn-primary "><i class="fa fa-plus"></i> Nova</button></a>
		<a href="<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'profissaos', 'action' => 'edit')) ?>"><button type="button" class="btn btn-danger "><i class="fa fa-trash-o"></i> Deletar</button></a>
		</div>
	</div>
	
</div>
<?php echo $this->Form->create(array('Pesquisa')); ?>
	<div class="form-group">
		<div class="input-group m-bot15">
			<input type="text" size="50" id="texto" name="filtro" placeholder="Filtre aqui" class="form-control"/>
			<span class="input-group-btn">
            	<button class="btn btn-success" type="button">Pesquisar!</button>
            </span>
		</div>
	</div>	
<?php echo $this->Form->end(); ?>
<table class="table table-bordered table-striped table-condensed">
	<tr>
		<th></th>
		<th>
			Nome:
		</th>
		<th>
			Descrição:
		</th>
	</tr>
	<?php 
		$i=0;
		foreach ($profissaos as $profissao) { ?>
		<tr>
			<td>
				<?php echo $this->Form->checkbox('set', array('hiddenField' => false, 'class' => 'toDelete')); ?>
			</td>
			<td>
				<?php echo $profissao['Profissao']['nome']; ?>
			</td>
			<td>
				<?php echo $profissao['Profissao']['descricao']; ?>
			</td>
		</tr>
		<?php $i++;
		} ?>
</table>