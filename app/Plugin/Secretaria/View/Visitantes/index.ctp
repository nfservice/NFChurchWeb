<script type="text/javascript">
	$("#addNewUser").on('click', function(){
		$.get("<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'visitantes', 'action' => 'add')); ?>", function(data) {
			$("#ModalAddNewUser .modal-body").html(data);
			jQuery.noConflict();
			$("#ModalAddNewUser").modal("show");
		});

		return false;
	});
</script>

<div class="col-md-12">		
	<!--breadcrumbs start -->
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="#">Secretaria</a></li>
		<li class="active">Visitantes</li>
	</ul>
	<!--breadcrumbs end -->
</div>
<div class="col-md-12">
	<div class="panel menuRoll">
		<div class="panel-body row">
			<!-- form -->

			<?php echo $this->Form->create(array('action' => 'index', 'role' => 'form')); ?>
			<div class="form-group col-md-3">
				<a class="btn btn-success form-control" id="addNewUser"><i class="fa fa-plus"></i> Adicionar Visitante</a>
			</div>
			<div class="form-group col-md-3">
				<a href="<?php echo $this->Html->url(array('action' => 'add')); ?>" class="btn btn-danger form-control"><i class="fa fa-trash-o"></i> Apagar</a>
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
<div class="col-lg-12 menuRollNext">
	<section class="panel">
		<header class="panel-heading">
			Gerenciar Visitantes
		</header>
		<div class="panel-body">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Telefone</th>
						<th>E-mail</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($visitantes as $visitante) { ?>
					<tr class="tr-visitantes-click" onclick="ajaxload('<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'visitantes', 'action' => 'edit', $visitante['Visitante']['id'])); ?>');">
						<td><?php echo $visitante['Visitante']['nome']; ?></td>
						<td><?php echo $visitante['Visitante']['fone']; ?></td>
						<td><?php echo $visitante['Visitante']['email']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</section>

	<!-- Modal -->
	
	<div class="modal fade" id="ModalAddNewUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Adicionar novo Visitante</h4>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
	
    <!-- modal -->