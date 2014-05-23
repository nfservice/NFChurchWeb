<div class="col-md-12">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="#">Secretaria</a></li>
		<li><a href="#">Profissões</a></li>
		<li class="active">Gerenciar Profissões</li>
	</ul>
</div>
<div class="col-md-12">
	<div class="panel menuRoll">
		<div class="panel-body row">
			
			<!-- form -->
			<?php echo $this->Form->create(array('action' => 'index', 'role' => 'form')); ?>
			<div class="form-group col-md-3">
				<a class="btn btn-success form-control btnModal" onclick="modalLoad('secretaria/visitantes/add');"><i class="fa fa-plus"></i> Adicionar Visitante</a>
			</div>
			<div class="form-group col-md-3">
				<a href="javascript:;" class="btn btn-danger form-control" data-toggle="modal" data-target="#confirmacaoExclusao"><i class="fa fa-trash-o"></i> Apagar</a>
			</div>
			<div class="form-group col-md-6">
				<div class="input-group m-bot15">
					<input type="text" class="form-control" id="texto" name="username" placeholder="Pesquise aqui">
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
<div class="col-md-12">
	<section class="panel">
		<header class="panel-heading">
			Gerenciamento de Profissões
		</header>
		<div class="panel-body">
			<div class="col-md-12">	
				<div class="row">	
					<div class="nav notify-row">
						<a href="<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'profissaos', 'action' => 'add')) ?>"><button type="button" class="btn btn-primary "><i class="fa fa-plus"></i> Nova</button></a>
						<a href="<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'profissaos', 'action' => 'delete')) ?>"><button type="button" class="btn btn-danger "><i class="fa fa-trash-o"></i> Deletar</button></a>
						<!-- Adicionar no botão delete a função ajaxForm para submeter o form com id "ProfissaoDeleteForm" e antes de enviar o form, consultar se a pessoa realmente deseja excluir os registros selecionados-->
					</div>
				</div>
			</div>


			<?php echo $this->Form->create(array('Pesquisa')); ?>
			<div class="col-md-2">
				<div class="row">
					<button type="button" onclick="ajaxload('<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'visitantes', 'action' => 'add')); ?>');" class="btn btn-primary"><i class="fa fa-plus"></i> Novo Visitante</button>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group m-bot15">
					<input type="text" size="50" id="texto" name="filtro" placeholder="Filtre aqui" class="form-control">
					<span class="input-group-btn">
						<button class="btn btn-success" type="button">Pesquisar!</button>
					</span>
				</div>
			</div>
			<?php echo $this->Form->end(); ?>
			<?php echo $this->Form->create(null, array('action' => 'delete')); ?>
			<table class="table table-bordered table-striped table-condensed">
				<tr>
					<th>
						<!-- preparar função para selecionar todos os checkbox-->
						<?php echo $this->Form->checkbox('setAll', array('hiddenField' => false, 'class' => 'toDelete')); ?>
					</th>
					<th>
						Nome:
					</th>
					<th>
						Descrição:
					</th>
				</tr >
				<?php 
				if (!empty($profissaos)) {
					$i=0;
					foreach ($profissaos as $profissao) { ?>
					<tr class="tr-visitantes-click" onclick="ajaxload(<?php echo $this->Html->url('/'); ?>);">
						<td>
							<?php echo $this->Form->checkbox('set-'.$profissao['Profissao']['id'], array('hiddenField' => false, 'class' => 'toDelete', 'value' => $profissao['Profissao']['id'])); ?>
						</td>
						<td>
							<?php echo $profissao['Profissao']['nome']; ?>
						</td>
						<td>
							<?php echo $profissao['Profissao']['descricao']; ?>
						</td>
					</tr>
					<?php $i++;
				}
			} else { ?>
			<tr>
				<td cellspacing="100%" cellpadding="100%" colspan="3" align="center">
					<?php echo "Você Ainda Não Cadastrou Nenhuma Profissão"; ?>
				</td>
			</tr>
			<?php } ?>
		</table>
		<?php echo $this->Form->end(); ?>
	</section>
</div>