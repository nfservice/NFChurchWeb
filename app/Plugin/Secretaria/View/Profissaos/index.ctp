<div class="row">
	<div class="form-group">
		<h2 class="col-lg-2">Profissões</h2>
		<div class="nav notify-row">
			<ul class="nav top-menu">
				<li id="header_notification_bar" class="dropdown">
		            <a data-toggle="dropdown" class="dropdown-toggle" href="<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'profissaos', 'action' => 'add')) ?>">
		                <i class="fa fa-plus"></i>
		            </a>
		        </li>
		        <li id="header_notification_bar" class="dropdown">
		            <a data-toggle="dropdown" class="dropdown-toggle" href="<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'profissaos', 'action' => 'edit')) ?>">
		                <i class="fa fa-trash-o"></i>
		            </a>
		        </li>
			</ul>
		</div>
	</div>
</div>
<?php echo $this->Form->create(array('Pesquisa')); ?>
	<div class="form-group">
		<div class="input-group m-bot15">
			<input type="text" size="50" id="texto" name="filtro" placeholder="Descrição:" class="form-control"/>
			<span class="input-group-btn">
            	<button class="btn btn-success" type="button">Pesquisar!</button>
            </span>
		</div>
	</div>	
<?php echo $this->Form->end(); ?>
<table class="table">
	<tr>
		<th class="col-md-1"></th>
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