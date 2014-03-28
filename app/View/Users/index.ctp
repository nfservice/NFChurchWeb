<div class="col-lg-12">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="#">Secretaria</a></li>
		<li class="active">Usuários</li>
	</ul>
	<section class="panel">
		<header class="panel-heading">
			Gerenciar usuários
		</header>
		<div class="panel-body">
			<?php echo $this->Form->create(array('Pesquisa', 'role' => 'form')); ?>
			<div class="col-md-2">
				<div class="row">
					<button type="button" onclick="ajaxload('<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'visitantes', 'action' => 'add')); ?>');" class="btn btn-primary"><i class="fa fa-plus"></i> Novo Usuário</button>
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


			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Nome</th>
						<th>E-mail</th>
						<th>Telefone:</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($users as $user) { ?>
					<tr class="tr-visitantes-click" onclick="ajaxload('<?php echo $this->Html->url(array('plugin' => '', 'controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?>');">
						<td><?php echo $user['User']['nome']; ?></td>
						<td><?php echo $user['User']['username']; ?></td>
						<td><?php echo $user['User']['telefone']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</section>
</div>