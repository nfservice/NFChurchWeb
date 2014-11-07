<div class="col-lg-12">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="#">Secretaria</a></li>
		<li><a href="#">Visitantes</a></li>
		<li class="active">Adicionar Visitante</li>
	</ul>
	<div class="row">
		<div class="col-md-12">
			<section class="panel">
				<header class="panel-heading">
					Adicionar novo visitante
				</header>
				<div class="panel-body">
					<div class="col-md-12">	
						<div class="row">	
							<div class="nav notify-row">
								<a href="<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'escolaridades', 'action' => 'add')) ?>"><button type="button" class="btn btn-primary "><i class="fa fa-plus"></i> Nova</button></a>
								<a href="<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'escolaridades', 'action' => 'delete')) ?>"><button type="button" class="btn btn-danger "><i class="fa fa-trash-o"></i> Deletar</button></a>
								<!-- Adicionar no botão delete a função ajaxForm para submeter o form com id "ProfissaoDeleteForm" e antes de enviar o form, consultar se a pessoa realmente deseja excluir os registros selecionados-->
							</div>
						</div>
					</div>


					<?php echo $this->Form->create(array('Pesquisa')); ?>
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
						</tr >
						<?php 
						if (!empty($escolaridades)) {
							$i=0;
							foreach ($escolaridades as $escolaridade) { ?>
							<tr class="tr-visitantes-click" onclick="ajaxload(<?php echo $this->Html->url('/'); ?>);">
								<td>
									<?php echo $this->Form->checkbox('set-'.$escolaridade['Escolaridade']['id'], array('hiddenField' => false, 'class' => 'toDelete', 'value' => $escolaridade['Escolaridade']['id'])); ?>
								</td>
								<td>
									<?php echo $escolaridade['Escolaridade']['descricao']; ?>
								</td>
							</tr>
							<?php $i++;
						}
					} else { ?>
					<tr>
						<td cellspacing="100%" cellpadding="100%" colspan="3" align="center">
							<?php echo "Você ainda não cadastrou nenhuma Escolaridade"; ?>
						</td>
					</tr>
					<?php } ?>
				</table>
				<?php echo $this->Form->end(); ?>
			</section>
		</div>
	</div>
</div>